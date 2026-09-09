<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use App\Services\ActivityService;

class RolesController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensurePermissions();
    }

    private function ensurePermissions(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM permissions");
            if ($count === 0) {
                $defaultPerms = [
                    ['dashboard',   'view',    'dashboard.view',    'View Admin Dashboard'],
                    ['pages',       'view',    'pages.view',        'View CMS Pages'],
                    ['pages',       'create',  'pages.create',      'Create CMS Pages'],
                    ['pages',       'edit',    'pages.edit',        'Edit CMS Pages'],
                    ['pages',       'delete',  'pages.delete',      'Delete CMS Pages'],
                    ['erp_modules', 'view',    'erp_modules.view',  'View ERP Modules'],
                    ['erp_modules', 'manage',  'erp_modules.manage','Manage ERP Modules'],
                    ['blog',        'view',    'blog.view',         'View Blog Posts'],
                    ['blog',        'create',  'blog.create',       'Create Blog Posts'],
                    ['blog',        'edit',    'blog.edit',         'Edit Blog Posts'],
                    ['blog',        'delete',  'blog.delete',       'Delete Blog Posts'],
                    ['leads',       'view',    'leads.view',        'View Leads & Enquiries'],
                    ['leads',       'manage',  'leads.manage',      'Manage Leads & Demo Requests'],
                    ['settings',    'manage',  'settings.manage',   'Manage Global Settings & Branding'],
                    ['seo',         'manage',  'seo.manage',        'Manage SEO & Webmaster'],
                    ['users',       'view',    'users.view',        'View Admin Users'],
                    ['users',       'manage',  'users.manage',      'Manage Admin Users & Roles'],
                    ['logs',        'view',    'logs.view',         'View Activity Audit Logs'],
                ];

                foreach ($defaultPerms as $p) {
                    $this->db->query(
                        "INSERT INTO permissions (module, action, slug, description) VALUES (?, ?, ?, ?)",
                        [$p[0], $p[1], $p[2], $p[3]]
                    );
                }

                // Grant all to role 1 (Super Admin)
                $allPermIds = $this->db->fetchAll("SELECT id FROM permissions");
                foreach ($allPermIds as $p) {
                    $this->db->query("INSERT OR IGNORE INTO role_permissions (role_id, permission_id) VALUES (1, ?)", [$p['id']]);
                }
            }
        } catch (\Throwable $e) {}
    }

    public function index(): void {
        $roles = $this->db->fetchAll("
            SELECT r.*, 
                   (SELECT COUNT(*) FROM users u WHERE u.role_id = r.id) AS user_count,
                   (SELECT COUNT(*) FROM role_permissions rp WHERE rp.role_id = r.id) AS permission_count
            FROM roles r 
            ORDER BY r.id ASC
        ");

        admin_view('admin.roles.index', [
            'title' => 'Roles & Permissions',
            'roles' => $roles
        ]);
    }

    public function create(): void {
        $permissions = $this->db->fetchAll("SELECT * FROM permissions ORDER BY module ASC, id ASC");
        $grouped = [];
        foreach ($permissions as $p) {
            $grouped[$p['module']][] = $p;
        }

        admin_view('admin.roles.form', [
            'title'               => 'Create New Role',
            'role'                => null,
            'groupedPermissions'  => $grouped,
            'assignedPermissions' => [],
            'isEdit'              => false
        ]);
    }

    public function store(): void {
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $perms = $_POST['permissions'] ?? [];

        if ($name === '') {
            set_flash('error', 'Role name is required.');
            redirect('/admin/roles/create');
            return;
        }

        if ($slug === '') {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        }

        $exists = $this->db->fetch("SELECT id FROM roles WHERE slug = ?", [$slug]);
        if ($exists) {
            set_flash('error', 'A role with this slug already exists.');
            redirect('/admin/roles/create');
            return;
        }

        $this->db->query(
            "INSERT INTO roles (name, slug, description, created_at) VALUES (?, ?, ?, datetime('now'))",
            [$name, $slug, $description]
        );
        $newId = (int)$this->db->lastInsertId();

        if (is_array($perms)) {
            foreach ($perms as $permId) {
                $this->db->query("INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)", [$newId, (int)$permId]);
            }
        }

        ActivityService::log('create', 'roles', $newId, "Created role: $name ($slug)");
        set_flash('success', "✅ Role '$name' created successfully.");
        redirect('/admin/roles');
    }

    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);
        $role = $this->db->fetch("SELECT * FROM roles WHERE id = ?", [$id]);

        if (!$role) {
            set_flash('error', 'Role not found.');
            redirect('/admin/roles');
            return;
        }

        $permissions = $this->db->fetchAll("SELECT * FROM permissions ORDER BY module ASC, id ASC");
        $grouped = [];
        foreach ($permissions as $p) {
            $grouped[$p['module']][] = $p;
        }

        $assigned = $this->db->fetchAll("SELECT permission_id FROM role_permissions WHERE role_id = ?", [$id]);
        $assignedIds = array_column($assigned, 'permission_id');

        admin_view('admin.roles.form', [
            'title'               => 'Edit Role: ' . $role['name'],
            'role'                => $role,
            'groupedPermissions'  => $grouped,
            'assignedPermissions' => $assignedIds,
            'isEdit'              => true
        ]);
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $role = $this->db->fetch("SELECT * FROM roles WHERE id = ?", [$id]);

        if (!$role) {
            set_flash('error', 'Role not found.');
            redirect('/admin/roles');
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $perms = $_POST['permissions'] ?? [];

        if ($name === '') {
            set_flash('error', 'Role name is required.');
            redirect('/admin/roles/edit?id=' . $id);
            return;
        }

        $this->db->query(
            "UPDATE roles SET name = ?, description = ? WHERE id = ?",
            [$name, $description, $id]
        );

        // Update permissions (if not super-admin id=1, or update for all)
        $this->db->query("DELETE FROM role_permissions WHERE role_id = ?", [$id]);
        if (is_array($perms)) {
            foreach ($perms as $permId) {
                $this->db->query("INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)", [$id, (int)$permId]);
            }
        }

        ActivityService::log('update', 'roles', $id, "Updated role: $name");
        set_flash('success', "✅ Role '$name' updated successfully.");
        redirect('/admin/roles');
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);

        if ($id === 1) {
            set_flash('error', 'Super Admin role cannot be deleted.');
            redirect('/admin/roles');
            return;
        }

        $role = $this->db->fetch("SELECT name FROM roles WHERE id = ?", [$id]);
        if ($role) {
            // Reassign any users with this role to Super Admin (1)
            $this->db->query("UPDATE users SET role_id = 1 WHERE role_id = ?", [$id]);
            $this->db->query("DELETE FROM role_permissions WHERE role_id = ?", [$id]);
            $this->db->query("DELETE FROM roles WHERE id = ?", [$id]);

            ActivityService::log('delete', 'roles', $id, "Deleted role: {$role['name']}");
            set_flash('success', "✅ Role '{$role['name']}' deleted.");
        }

        redirect('/admin/roles');
    }
}
