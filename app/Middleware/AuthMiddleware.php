<?php
namespace App\Middleware;

use App\Services\AuthService;

class AuthMiddleware {
    public function handle(): void {
        if (!AuthService::check()) {
            redirect(admin_url('login'));
        }
    }
}
