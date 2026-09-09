<?php
namespace App\Services;

use Exception;

class Router {
    private array $routes = [];

    public function get(string $path, $handler, array $middleware = []): void {
        $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(string $path, $handler, array $middleware = []): void {
        $this->addRoute('POST', $path, $handler, $middleware);
    }

    private function addRoute(string $method, string $path, $handler, array $middleware): void {
        // Convert route path like /admin/pages/edit/{id} to regex pattern
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_\-]+)', $path);
        $pattern = '#^' . rtrim($pattern, '/') . '/?$#';

        $this->routes[] = [
            'method'     => $method,
            'path'       => $path,
            'pattern'    => $pattern,
            'handler'    => $handler,
            'middleware' => $middleware,
        ];
    }

    public function dispatch(string $requestMethod, string $requestUri): void {
        // Strip query string and base subfolder path
        $path = parse_url($requestUri, PHP_URL_PATH);
        
        // Remove project subfolder prefix if running under localhost/goldmatrixsoft
        $baseFolder = parse_url(app_config('url'), PHP_URL_PATH) ?? '';
        if ($baseFolder && strpos($path, $baseFolder) === 0) {
            $path = substr($path, strlen($baseFolder));
        }
        $path = '/' . trim($path, '/');

        // Check for Active 301/302 Redirect Rules
        try {
            $db = \App\Services\Database::getInstance();
            $redirect = $db->fetch("SELECT id, target_url, status_code FROM redirects WHERE source_url = ? AND is_active = 1", [$path]);
            if ($redirect && !empty($redirect['target_url'])) {
                try {
                    $db->query("UPDATE redirects SET hits = hits + 1 WHERE id = ?", [$redirect['id']]);
                } catch (\Throwable $e) {}
                $code = (int)($redirect['status_code'] ?? 301);
                http_response_code($code === 302 ? 302 : 301);
                $target = (strpos($redirect['target_url'], 'http') === 0) ? $redirect['target_url'] : site_url($redirect['target_url']);
                header("Location: " . $target);
                exit;
            }
        } catch (\Throwable $e) {}

        $method = strtoupper($requestMethod);
        if ($method === 'HEAD') {
            $method = 'GET';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $path, $matches)) {
                // Extract named route parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Run middlewares
                foreach ($route['middleware'] as $mwClass) {
                    $mw = new $mwClass();
                    if (method_exists($mw, 'handle')) {
                        $mw->handle();
                    }
                }

                // Execute handler
                if (is_callable($route['handler'])) {
                    call_user_func_array($route['handler'], $params);
                    return;
                }

                if (is_array($route['handler']) && count($route['handler']) === 2) {
                    [$controllerClass, $methodName] = $route['handler'];
                    $controller = new $controllerClass();
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        // If no route matched
        http_response_code(404);
        if (strpos($path, '/admin') === 0) {
            view('admin.errors.404', ['title' => '404 - Page Not Found']);
        } else {
            echo "<h1>404 - Page Not Found</h1>";
        }
    }
}
