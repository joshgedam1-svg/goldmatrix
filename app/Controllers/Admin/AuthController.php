<?php
namespace App\Controllers\Admin;

use App\Services\AuthService;

class AuthController {
    public function showLogin(): void {
        if (AuthService::check()) {
            redirect(admin_url('dashboard'));
        }
        view('admin.auth.login', ['title' => 'Admin Login — GoldMatrix ERP']);
    }

    public function login(): void {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $throttleKey = 'login_' . $ip;

        // 1. Brute-Force & Credential Stuffing Throttling (Max 5 attempts / 15 mins)
        $retryAfter = AuthService::isThrottled($throttleKey, 5, 900);
        if ($retryAfter > 0) {
            $mins = ceil($retryAfter / 60);
            set_flash('danger', "Too many failed login attempts. For security, your IP has been temporarily paused. Please try again in {$mins} minute(s).");
            redirect(admin_url('login'));
        }

        // 2. CSRF Token Verification
        $token = $_POST['csrf_token'] ?? '';
        if (!verify_csrf_token($token)) {
            set_flash('danger', 'Session expired. Please try logging in again.');
            redirect(admin_url('login'));
        }

        $email = sanitize_input($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // 3. LPDoS (Long Password Denial of Service) Guard
        if (strlen($password) > 256) {
            AuthService::recordAttempt($throttleKey, 900);
            set_flash('danger', 'Invalid credentials or inactive account.');
            redirect(admin_url('login'));
        }

        if (empty($email) || empty($password)) {
            set_flash('danger', 'Please provide both email address and password.');
            redirect(admin_url('login'));
        }

        if (AuthService::attempt($email, $password)) {
            AuthService::clearAttempts($throttleKey);
            set_flash('success', 'Welcome back! You have successfully signed in.');
            redirect(admin_url('dashboard'));
        } else {
            AuthService::recordAttempt($throttleKey, 900);
            set_flash('danger', 'Invalid credentials or inactive account.');
            redirect(admin_url('login'));
        }
    }

    public function logout(): void {
        AuthService::logout();
        set_flash('success', 'You have been logged out safely.');
        redirect(admin_url('login'));
    }
}
