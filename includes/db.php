<?php
/**
 * includes/db.php — Database bridge
 * Loads config and returns $pdo globally
 */

// Load .env if available
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            [$k, $v] = explode('=', $line, 2);
            $_ENV[trim($k)] = trim($v);
            putenv(trim($k) . '=' . trim($v));
        }
    }
}

$dbConfig = require __DIR__ . '/../config/database.php';

$dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
    $dbConfig['host'],
    $dbConfig['port'],
    $dbConfig['database'],
    $dbConfig['charset']
);

try {
    $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], $dbConfig['options']);
} catch (PDOException $e) {
    // Silently fail on homepage (show static defaults), fatal on admin
    if (strpos($_SERVER['REQUEST_URI'] ?? '', '/admin/') !== false) {
        http_response_code(500);
        die('<div style="font-family:Arial;padding:40px;color:#dc2626;"><h2>⚠️ Database Connection Error</h2><p>' . htmlspecialchars($e->getMessage()) . '</p><p>Check your .env file and make sure MySQL is running.</p></div>');
    }
    // Return a mock PDO-like object for homepage that always returns defaults
    $pdo = new class {
        public function prepare($q) { return new class { public function execute($a=[]) {} public function fetch() { return false; } public function fetchAll() { return []; } public function fetchColumn() { return 0; } }; }
        public function exec($q) {}
    };
}
