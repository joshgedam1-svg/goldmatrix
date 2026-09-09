<?php
/**
 * GoldMatrix ERP - Front Controller
 */

declare(strict_types=1);

// Error reporting settings based on environment
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Load environment configuration manually if .env exists
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value, " \t\n\r\0\x0B\"'");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Register Autoloader
require_once __DIR__ . '/../app/Autoloader.php';
\App\Autoloader::register();

// Security Response Headers
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("X-XSS-Protection: 1; mode=block");

// Load Global Helpers
require_once __DIR__ . '/../app/Helpers/functions.php';

// Configure and Start Hardened Session
if (session_status() === PHP_SESSION_NONE) {
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    $lifetime = (int)($_ENV['SESSION_LIFETIME'] ?? 7200);
    session_set_cookie_params([
        'lifetime' => $lifetime,
        'path'     => '/',
        'domain'   => '',
        'secure'   => $isSecure,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

// Inactivity Session Timeout Verification
if (!empty($_SESSION['logged_in']) && isset($_SESSION['last_activity'])) {
    $maxLifetime = (int)($_ENV['SESSION_LIFETIME'] ?? 7200);
    if ((time() - (int)$_SESSION['last_activity']) > $maxLifetime) {
        \App\Services\AuthService::logout();
        set_flash('danger', 'Session expired due to inactivity. Please log in again.');
        redirect(admin_url('login'));
    }
}
if (!empty($_SESSION['logged_in'])) {
    $_SESSION['last_activity'] = time();
}

// Initialize Router
$router = new \App\Services\Router();

// Register Routes
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../routes/admin.php';

// Dispatch Request
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$requestUri    = $_SERVER['REQUEST_URI'] ?? '/';

try {
    $router->dispatch($requestMethod, $requestUri);
} catch (\Throwable $e) {
    http_response_code(500);
    error_log("Unhandled Exception: " . $e->getMessage() . "\n" . $e->getTraceAsString());
    if (app_config('debug', false)) {
        echo "<div style='padding:20px;background:#Fee2e2;color:#991b1b;border:1px solid #f87171;border-radius:8px;font-family:sans-serif;'>";
        echo "<h3>Application Exception: " . htmlspecialchars($e->getMessage()) . "</h3>";
        echo "<pre style='font-size:12px;overflow:auto;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
        echo "</div>";
    } else {
        echo "<!DOCTYPE html><html><head><title>500 - Server Error</title><style>body{font-family:sans-serif;text-align:center;padding:50px;background:#f8fafc;color:#1e293b;}h1{font-size:36px;margin-bottom:10px;}p{font-size:16px;color:#64748b;}</style></head><body><h1>500 - Internal Server Error</h1><p>Something went wrong on our end. Please try again later.</p></body></html>";
    }
}
