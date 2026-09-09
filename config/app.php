<?php
/**
 * GoldMatrix ERP - Main Application Configuration
 */

return [
    'name'     => $_ENV['APP_NAME'] ?? 'GoldMatrix ERP',
    'url'      => rtrim($_ENV['APP_URL'] ?? 'http://localhost/goldmatrixsoft', '/'),
    'env'      => $_ENV['APP_ENV'] ?? 'development',
    'debug'    => filter_var($_ENV['APP_DEBUG'] ?? true, FILTER_VALIDATE_BOOLEAN),
    'timezone' => $_ENV['APP_TIMEZONE'] ?? 'Asia/Kolkata',

    'paths' => [
        'root'     => dirname(__DIR__),
        'storage'  => dirname(__DIR__) . '/storage',
        'uploads'  => dirname(__DIR__) . '/storage/uploads',
        'views'    => dirname(__DIR__) . '/views',
        'public'   => dirname(__DIR__) . '/public',
    ]
];
