<?php
/**
 * includes/auth.php — Admin session auth guard
 */
if (session_status() === PHP_SESSION_NONE) session_start();

function requireLogin() {
    if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: /admin/login.php?redirect=' . urlencode($_SERVER['REQUEST_URI'] ?? ''));
        exit;
    }
}

function isLoggedIn() {
    return !empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function adminUser() {
    return $_SESSION['admin_user'] ?? ['name' => 'Admin', 'email' => 'admin@goldmatrix.com', 'role' => 'admin'];
}
