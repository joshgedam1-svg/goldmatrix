<?php
namespace App\Services;

use App\Services\Database;

class ActivityService {
    public static function log(string $action, string $module, ?int $recordId = null, ?string $description = null): void {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $userId = $_SESSION['user_id'] ?? null;
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $userAgent = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);

            $db = Database::getInstance();
            $db->insert('activity_logs', [
                'user_id'     => $userId,
                'action'      => $action,
                'module'      => $module,
                'record_id'   => $recordId,
                'description' => $description,
                'ip_address'  => $ip,
                'user_agent'  => $userAgent,
                'created_at'  => date('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            error_log("ActivityLog failed: " . $e->getMessage());
        }
    }
}
