<?php
namespace App\Middleware;

use App\Services\AuthService;

class PermissionMiddleware {
    private string $permission;

    public function __construct(string $permission = '') {
        $this->permission = $permission;
    }

    public function handle(): void {
        if (!empty($this->permission) && !AuthService::hasPermission($this->permission)) {
            http_response_code(403);
            set_flash('danger', 'Access Denied: You do not have permission for this action.');
            redirect(admin_url('dashboard'));
        }
    }
}
