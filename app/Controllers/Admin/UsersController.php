<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use App\Services\AuthService;
use App\Services\ActivityService;

class UsersController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function index(): void {
        $search = trim($_GET['search'] ?? '');
        $roleFilter = trim($_GET['role'] ?? '');
        $statusFilter = trim($_GET['status'] ?? '');

        $sql = "SELECT u.*, r.name AS role_name, r.slug AS role_slug 
                FROM users u 
                LEFT JOIN roles r ON u.role_id = r.id 
                WHERE 1=1";
        $params = [];

        if ($search !== '') {
            $sql .= " AND (u.name LIKE ? OR u.email LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if ($roleFilter !== '') {
            $sql .= " AND u.role_id = ?";
            $params[] = $roleFilter;
        }

        if ($statusFilter !== '') {
            $sql .= " AND u.status = ?";
            $params[] = $statusFilter;
        }

        $sql .= " ORDER BY u.id ASC";
        $users = $this->db->fetchAll($sql, $params);
        $roles = $this->db->fetchAll("SELECT * FROM roles ORDER BY id ASC");

        admin_view('admin.users.index', [
            'title'        => 'Admin Users Management',
            'users'        => $users,
            'roles'        => $roles,
            'search'       => $search,
            'roleFilter'   => $roleFilter,
            'statusFilter' => $statusFilter,
            'currentUser'  => AuthService::user()
        ]);
    }

    public function create(): void {
        $roles = $this->db->fetchAll("SELECT * FROM roles ORDER BY id ASC");
        admin_view('admin.users.form', [
            'title'  => 'Create Admin User',
            'user'   => null,
            'roles'  => $roles,
            'isEdit' => false
        ]);
    }

    public function store(): void {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $roleId = (int)($_POST['role_id'] ?? 1);
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive']) ? $_POST['status'] : 'active';

        if ($name === '' || $email === '' || $password === '') {
            set_flash('error', 'Please fill in all required fields (Name, Email, Password).');
            redirect('/admin/users/create');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            set_flash('error', 'Please enter a valid email address.');
            redirect('/admin/users/create');
            return;
        }

        if (strlen($password) < 6) {
            set_flash('error', 'Password must be at least 6 characters long.');
            redirect('/admin/users/create');
            return;
        }

        // Check unique email
        $exists = $this->db->fetch("SELECT id FROM users WHERE email = ?", [$email]);
        if ($exists) {
            set_flash('error', 'An admin user with this email already exists.');
            redirect('/admin/users/create');
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->db->query(
            "INSERT INTO users (name, email, password, role_id, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, datetime('now'), datetime('now'))",
            [$name, $email, $hash, $roleId, $status]
        );

        $newId = $this->db->lastInsertId();
        ActivityService::log('create', 'users', (int)$newId, "Created new admin user: $name ($email)");

        set_flash('success', "✅ Admin user '$name' created successfully.");
        redirect('/admin/users');
    }

    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);
        $user = $this->db->fetch("SELECT * FROM users WHERE id = ?", [$id]);

        if (!$user) {
            set_flash('error', 'User not found.');
            redirect('/admin/users');
            return;
        }

        $roles = $this->db->fetchAll("SELECT * FROM roles ORDER BY id ASC");
        admin_view('admin.users.form', [
            'title'  => 'Edit Admin User',
            'user'   => $user,
            'roles'  => $roles,
            'isEdit' => true
        ]);
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $user = $this->db->fetch("SELECT * FROM users WHERE id = ?", [$id]);

        if (!$user) {
            set_flash('error', 'User not found.');
            redirect('/admin/users');
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $roleId = (int)($_POST['role_id'] ?? $user['role_id']);
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive']) ? $_POST['status'] : 'active';

        if ($name === '' || $email === '') {
            set_flash('error', 'Name and Email are required.');
            redirect('/admin/users/edit?id=' . $id);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            set_flash('error', 'Please enter a valid email address.');
            redirect('/admin/users/edit?id=' . $id);
            return;
        }

        // Check unique email except current
        $exists = $this->db->fetch("SELECT id FROM users WHERE email = ? AND id != ?", [$email, $id]);
        if ($exists) {
            set_flash('error', 'Another admin user with this email already exists.');
            redirect('/admin/users/edit?id=' . $id);
            return;
        }

        if (!empty($password)) {
            if (strlen($password) < 6) {
                set_flash('error', 'New password must be at least 6 characters.');
                redirect('/admin/users/edit?id=' . $id);
                return;
            }
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $this->db->query(
                "UPDATE users SET name = ?, email = ?, password = ?, role_id = ?, status = ?, updated_at = datetime('now') WHERE id = ?",
                [$name, $email, $hash, $roleId, $status, $id]
            );
        } else {
            $this->db->query(
                "UPDATE users SET name = ?, email = ?, role_id = ?, status = ?, updated_at = datetime('now') WHERE id = ?",
                [$name, $email, $roleId, $status, $id]
            );
        }

        ActivityService::log('update', 'users', $id, "Updated admin user: $name ($email)");

        set_flash('success', "✅ Admin user '$name' updated successfully.");
        redirect('/admin/users');
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        $currentUser = AuthService::user();

        if ($currentUser && (int)$currentUser['id'] === $id) {
            set_flash('error', 'You cannot delete your own admin account.');
            redirect('/admin/users');
            return;
        }

        if ($id === 1) {
            set_flash('error', 'Primary Super Administrator cannot be deleted.');
            redirect('/admin/users');
            return;
        }

        $user = $this->db->fetch("SELECT name, email FROM users WHERE id = ?", [$id]);
        if ($user) {
            $this->db->query("DELETE FROM users WHERE id = ?", [$id]);
            ActivityService::log('delete', 'users', $id, "Deleted admin user: {$user['name']} ({$user['email']})");
            set_flash('success', "✅ Admin user '{$user['name']}' deleted.");
        }

        redirect('/admin/users');
    }
}
