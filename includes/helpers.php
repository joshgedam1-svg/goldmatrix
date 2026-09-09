<?php
/**
 * includes/helpers.php — Common helpers for frontend & admin
 */

if (!function_exists('esc')) {
    function esc($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
}

if (!function_exists('sanitize')) {
    function sanitize($v) { return trim(strip_tags((string)$v)); }
}

if (!function_exists('sanitizeHtml')) {
    /** Allow basic HTML for rich text fields */
    function sanitizeHtml($v) {
        $allowed = '<p><br><b><strong><i><em><ul><ol><li><a><span><h2><h3><h4>';
        return strip_tags(trim((string)$v), $allowed);
    }
}

if (!function_exists('redirect')) {
    function redirect($url) { header('Location: ' . $url); exit; }
}

if (!function_exists('flash')) {
    function flash($msg, $type = 'success') {
        $_SESSION['flash_msg']  = $msg;
        $_SESSION['flash_type'] = $type;
    }
}

if (!function_exists('getFlash')) {
    function getFlash() {
        if (!empty($_SESSION['flash_msg'])) {
            $m = ['msg' => $_SESSION['flash_msg'], 'type' => $_SESSION['flash_type'] ?? 'success'];
            unset($_SESSION['flash_msg'], $_SESSION['flash_type']);
            return $m;
        }
        return null;
    }
}

if (!function_exists('formatINR')) {
    function formatINR($n) { return '₹' . number_format((float)$n, 2); }
}

if (!function_exists('timeAgo')) {
    function timeAgo($ts) {
        $diff = time() - strtotime($ts);
        if ($diff < 60)   return 'just now';
        if ($diff < 3600) return floor($diff/60) . 'm ago';
        if ($diff < 86400) return floor($diff/3600) . 'h ago';
        return floor($diff/86400) . 'd ago';
    }
}

// Start session if not started
if (session_status() === PHP_SESSION_NONE) session_start();
