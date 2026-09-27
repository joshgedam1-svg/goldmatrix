<?php
namespace App\Middleware;

class CsrfMiddleware {
    public function handle(): void {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (!in_array(strtoupper($method), ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            return; // Only check on write requests
        }

        // Logged-in admin users are already authenticated — skip CSRF check
        if (!empty($_SESSION['logged_in'])) {
            // Ensure token exists in session for future form renders
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
            return; // Allow the request through
        }

        // For non-authenticated requests (e.g. public forms), enforce CSRF
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        if (!verify_csrf_token($token)) {
            $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
                || (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false);

            if ($isAjax) {
                http_response_code(419);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Session expired. Please refresh the page.']);
                exit;
            }

            set_flash('danger', 'Security verification failed. Please try again.');
            redirect($_SERVER['HTTP_REFERER'] ?? admin_url('dashboard'));
        }
    }
}
