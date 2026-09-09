<?php
/**
 * Router script for PHP Built-in CLI Server
 * Routes requests to public/index.php (MVC Front Controller)
 * Usage: php -S localhost:8085 router.php
 */
$url  = parse_url($_SERVER['REQUEST_URI']);
$path = urldecode($url['path']);

// 0. Block direct access to sensitive files and dotfiles
if (preg_match('/^\.|\.(env|sqlite|sql|log|json|lock|bak|git|yml|yaml|md)$/i', basename($path))) {
    http_response_code(403);
    echo "<h1>403 - Access Forbidden</h1>";
    exit;
}

// 1. Direct file requests from root directory (only non-sensitive public assets)
if ($path !== '/' && is_file(__DIR__ . $path)) {
    return false; // Serve file natively
}

// 2. Direct file requests mapped to public/ directory (e.g. /uploads/..., /assets/...)
$publicFile = __DIR__ . '/public' . $path;
if ($path !== '/' && is_file($publicFile)) {
    $ext = strtolower(pathinfo($publicFile, PATHINFO_EXTENSION));
    $mimes = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'webp' => 'image/webp',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
        'ico'  => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
        'ttf'  => 'font/ttf',
    ];
    $mime = $mimes[$ext] ?? mime_content_type($publicFile) ?: 'application/octet-stream';
    header("Content-Type: $mime");
    header("Content-Length: " . filesize($publicFile));
    readfile($publicFile);
    exit;
}

// 3. Delegate all dynamic web and admin requests to public/index.php
require_once __DIR__ . '/public/index.php';
