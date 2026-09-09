<?php
namespace App\Middleware;

use App\Services\AuthService;

class AuthMiddleware {
    public function handle(): void {
        if (!AuthService::check()) {
            set_flash('danger', 'Please sign in to access the admin area.');
            redirect(admin_url('login'));
        }
    }
}
