<?php
namespace App\Services;

use App\Models\User;
use App\Services\Database;

class AuthService {
    /**
     * Check if an action key is throttled (Brute-Force & Credential-Stuffing Defense)
     */
    public static function isThrottled(string $key, int $maxAttempts = 5, int $decaySeconds = 900): int {
        $cacheDir = dirname(__DIR__, 2) . '/storage/cache';
        if (!is_dir($cacheDir)) {
            @mkdir($cacheDir, 0755, true);
        }
        $file = $cacheDir . '/throttle_' . md5($key) . '.json';
        if (!file_exists($file)) {
            return 0; // Not throttled
        }
        $data = @json_decode(file_get_contents($file), true) ?: [];
        $now = time();
        $attempts = array_filter($data['attempts'] ?? [], fn($t) => ($now - $t) < $decaySeconds);
        if (count($attempts) >= $maxAttempts) {
            $oldestInWindow = min($attempts);
            $retryAfter = $decaySeconds - ($now - $oldestInWindow);
            return max(1, $retryAfter);
        }
        return 0; // Not throttled
    }

    /**
     * Record a failed attempt
     */
    public static function recordAttempt(string $key, int $decaySeconds = 900): void {
        $cacheDir = dirname(__DIR__, 2) . '/storage/cache';
        if (!is_dir($cacheDir)) {
            @mkdir($cacheDir, 0755, true);
        }
        $file = $cacheDir . '/throttle_' . md5($key) . '.json';
        $data = file_exists($file) ? (@json_decode(file_get_contents($file), true) ?: []) : [];
        $now = time();
        $attempts = array_filter($data['attempts'] ?? [], fn($t) => ($now - $t) < $decaySeconds);
        $attempts[] = $now;
        @file_put_contents($file, json_encode(['attempts' => array_values($attempts)]));
    }

    /**
     * Clear recorded attempts upon success
     */
    public static function clearAttempts(string $key): void {
        $cacheDir = dirname(__DIR__, 2) . '/storage/cache';
        $file = $cacheDir . '/throttle_' . md5($key) . '.json';
        if (file_exists($file)) {
            @unlink($file);
        }
    }

    /**
     * Attempt login with email and password
     */
    public static function attempt(string $email, string $password): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // LPDoS (Long Password Denial of Service) Guard
        if (strlen($password) > 256) {
            return false;
        }

        $db = Database::getInstance();
        $user = $db->fetch(
            "SELECT u.*, r.name as role_name, r.slug as role_slug 
             FROM users u 
             JOIN roles r ON u.role_id = r.id 
             WHERE u.email = :email AND u.status = 'active'",
            ['email' => $email]
        );

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        // Session regeneration for security against session fixation
        session_regenerate_id(true);

        // Fetch user permissions
        $permissions = $db->fetchAll(
            "SELECT p.slug 
             FROM role_permissions rp 
             JOIN permissions p ON rp.permission_id = p.id 
             WHERE rp.role_id = :role_id",
            ['role_id' => $user['role_id']]
        );

        $permSlugs = array_column($permissions, 'slug');

        $_SESSION['user_id']     = $user['id'];
        $_SESSION['user_name']   = $user['name'];
        $_SESSION['user_email']  = $user['email'];
        $_SESSION['role_id']     = $user['role_id'];
        $_SESSION['role_name']   = $user['role_name'];
        $_SESSION['role_slug']   = $user['role_slug'];
        $_SESSION['permissions'] = $permSlugs;
        $_SESSION['logged_in']   = true;

        // Update last login timestamp
        $db->update('users', ['last_login' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $user['id']]);

        // Log activity
        ActivityService::log('Login', 'Auth', $user['id'], "User logged into admin panel");

        return true;
    }

    public static function check(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return !empty($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public static function user(): ?array {
        if (!self::check()) {
            return null;
        }
        return [
            'id'          => $_SESSION['user_id'] ?? null,
            'name'        => $_SESSION['user_name'] ?? '',
            'email'       => $_SESSION['user_email'] ?? '',
            'role_id'     => $_SESSION['role_id'] ?? null,
            'role_name'   => $_SESSION['role_name'] ?? '',
            'role_slug'   => $_SESSION['role_slug'] ?? '',
            'permissions' => $_SESSION['permissions'] ?? []
        ];
    }

    public static function hasPermission(string $permissionSlug): bool {
        $user = self::user();
        if (!$user) {
            return false;
        }
        // Super admin has full permissions always
        if ($user['role_slug'] === 'super-admin') {
            return true;
        }
        return in_array($permissionSlug, $user['permissions'] ?? [], true);
    }

    public static function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            ActivityService::log('Logout', 'Auth', $_SESSION['user_id'], "User logged out");
        }
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }
}
