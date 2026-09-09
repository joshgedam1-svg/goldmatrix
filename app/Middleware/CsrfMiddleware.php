<?php
namespace App\Middleware;

class CsrfMiddleware {
    public function handle(): void {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (in_array(strtoupper($method), ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
            if (!verify_csrf_token($token)) {
                $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
                    || (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false);
                
                if ($isAjax) {
                    http_response_code(419);
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => false,
                        'message' => 'CSRF token mismatch or session expired. Please refresh the page.'
                    ]);
                    exit;
                }

                http_response_code(419);
                set_flash('danger', 'Security verification failed or session expired. Please try again.');
                $referer = $_SERVER['HTTP_REFERER'] ?? admin_url('dashboard');
                redirect($referer);
            }
        }
    }
}
