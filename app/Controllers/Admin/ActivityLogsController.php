<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use App\Services\ActivityService;

class ActivityLogsController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function index(): void {
        $search = trim($_GET['search'] ?? '');
        $moduleFilter = trim($_GET['module'] ?? '');
        $actionFilter = trim($_GET['action_type'] ?? '');
        $userFilter = trim($_GET['user_id'] ?? '');

        $sql = "SELECT a.*, u.name AS user_name, u.email AS user_email 
                FROM activity_logs a 
                LEFT JOIN users u ON a.user_id = u.id 
                WHERE 1=1";
        $params = [];

        if ($search !== '') {
            $sql .= " AND (a.description LIKE ? OR a.ip_address LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if ($moduleFilter !== '') {
            $sql .= " AND a.module = ?";
            $params[] = $moduleFilter;
        }

        if ($actionFilter !== '') {
            $sql .= " AND a.action = ?";
            $params[] = $actionFilter;
        }

        if ($userFilter !== '') {
            $sql .= " AND a.user_id = ?";
            $params[] = $userFilter;
        }

        $sql .= " ORDER BY a.id DESC LIMIT 150";
        $logs = $this->db->fetchAll($sql, $params);

        $modules = $this->db->fetchAll("SELECT DISTINCT module FROM activity_logs WHERE module IS NOT NULL AND module != '' ORDER BY module ASC");
        $actions = $this->db->fetchAll("SELECT DISTINCT action FROM activity_logs WHERE action IS NOT NULL AND action != '' ORDER BY action ASC");
        $users = $this->db->fetchAll("SELECT id, name, email FROM users ORDER BY name ASC");

        admin_view('admin.activity-logs.index', [
            'title'        => 'System Activity Logs & Audit Trail',
            'logs'         => $logs,
            'modules'      => array_column($modules, 'module'),
            'actions'      => array_column($actions, 'action'),
            'users'        => $users,
            'search'       => $search,
            'moduleFilter' => $moduleFilter,
            'actionFilter' => $actionFilter,
            'userFilter'   => $userFilter
        ]);
    }

    public function clear(): void {
        $days = (int)($_POST['days'] ?? 30);
        if ($days > 0) {
            $this->db->query("DELETE FROM activity_logs WHERE created_at < datetime('now', '-' || ? || ' days')", [$days]);
            ActivityService::log('delete', 'logs', 0, "Cleared activity logs older than $days days");
            set_flash('success', "✅ Activity logs older than $days days have been cleared.");
        }
        redirect('/admin/activity-logs');
    }
}
