<?php
namespace App\Middleware;

class CsrfMiddleware {
    public function handle(): void {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (in_array(strtoupper($method), ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
            if (!verify_csrf_token($token)) {

                // Regenerate a fresh CSRF token so next request works
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

                $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
                    || (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false);

                if ($isAjax) {
                    http_response_code(419);
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => false,
                        'message' => 'Session refreshed. Please try again.',
                        'csrf_token' => $_SESSION['csrf_token']
                    ]);
                    exit;
                }

                // For logged-in admin users: silently refresh and redirect back
                // User just clicks Save again — no scary error shown
                $referer = $_SERVER['HTTP_REFERER'] ?? admin_url('dashboard');
                set_flash('warning', '⚠️ Session was refreshed for security. Please save again.');
                redirect($referer);
            }
        }
    }
}
