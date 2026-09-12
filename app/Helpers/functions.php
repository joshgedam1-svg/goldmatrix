<?php
/**
 * GoldMatrix ERP - Global Helper Functions
 */

if (!function_exists('app_config')) {
    function app_config(string $key, $default = null) {
        static $config = null;
        if ($config === null) {
            $config = require __DIR__ . '/../../config/app.php';
        }
        return $config[$key] ?? $default;
    }
}

if (!function_exists('site_url')) {
    function site_url(string $path = ''): string {
        if (!empty($_SERVER['HTTP_HOST'])) {
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
            $baseUrl = $scheme . $_SERVER['HTTP_HOST'];
        } else {
            $baseUrl = app_config('url', 'http://localhost:8085');
        }
        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('admin_url')) {
    function admin_url(string $path = ''): string {
        return site_url('admin/' . ltrim($path, '/'));
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string {
        $cleanPath = ltrim($path, '/');
        // If path already starts with 'assets/', avoid duplication
        if (strpos($cleanPath, 'assets/') === 0) {
            return site_url($cleanPath);
        }
        return site_url('assets/' . $cleanPath);
    }
}

if (!function_exists('e')) {
    function e(?string $value): string {
        return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('slugify')) {
    function slugify(string $text): string {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        return empty($text) ? 'n-a' : $text;
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token(): string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string {
        return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
    }
}

if (!function_exists('verify_csrf_token')) {
    function verify_csrf_token(?string $token): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token ?? '');
    }
}

if (!function_exists('set_flash')) {
    function set_flash(string $type, string $message): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'][$type] = $message;
    }
}

if (!function_exists('get_flash')) {
    function get_flash(string $type): ?string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['flash'][$type])) {
            $msg = $_SESSION['flash'][$type];
            unset($_SESSION['flash'][$type]);
            return $msg;
        }
        return null;
    }
}

if (!function_exists('redirect')) {
    function redirect(string $url): void {
        header("Location: " . $url);
        exit;
    }
}

if (!function_exists('view')) {
    function view(string $path, array $data = []): void {
        extract($data);
        $viewFile = __DIR__ . '/../../views/' . str_replace('.', '/', $path) . '.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            throw new Exception("View file [{$path}] not found at {$viewFile}");
        }
    }
}

if (!function_exists('admin_view')) {
    function admin_view(string $path, array $data = []): void {
        $contentFile = __DIR__ . '/../../views/' . str_replace('.', '/', $path) . '.php';
        $data['contentFile'] = $contentFile;
        view('admin.layouts.app', $data);
    }
}

if (!function_exists('sanitize_input')) {
    function sanitize_input($data) {
        if (is_array($data)) {
            return array_map('sanitize_input', $data);
        }
        return trim(htmlspecialchars(strip_tags((string)$data), ENT_QUOTES, 'UTF-8'));
    }
}

if (!function_exists('setting')) {
    function setting(string $key, $default = null) {
        static $settings = null;
        if ($settings === null) {
            try {
                $db = \App\Services\Database::getInstance();
                $rows = $db->fetchAll("SELECT setting_key, setting_value FROM settings");
                $settings = [];
                foreach ($rows as $row) {
                    $settings[$row['setting_key']] = $row['setting_value'];
                }
            } catch (\Exception $e) {
                $settings = [];
            }
        }
        return $settings[$key] ?? $default;
    }
}

if (!function_exists('get_supported_languages')) {
    function get_supported_languages(): array {
        return [
            'en'    => ['code' => 'en',    'name' => 'English',    'native' => 'English',    'flag' => '🇬🇧', 'flag_code' => 'gb', 'flag_img' => 'https://flagcdn.com/w40/gb.png', 'dir' => 'ltr', 'country' => 'Global'],
            'ar'    => ['code' => 'ar',    'name' => 'Arabic',     'native' => 'العربية',     'flag' => '🇦🇪', 'flag_code' => 'ae', 'flag_img' => 'https://flagcdn.com/w40/ae.png', 'dir' => 'rtl', 'country' => 'UAE & Middle East'],
            'hi'    => ['code' => 'hi',    'name' => 'Hindi',      'native' => 'हिन्दी',      'flag' => '🇮🇳', 'flag_code' => 'in', 'flag_img' => 'https://flagcdn.com/w40/in.png', 'dir' => 'ltr', 'country' => 'India'],
            'gu'    => ['code' => 'gu',    'name' => 'Gujarati',   'native' => 'ગુજરાતી',    'flag' => '🇮🇳', 'flag_code' => 'in', 'flag_img' => 'https://flagcdn.com/w40/in.png', 'dir' => 'ltr', 'country' => 'Surat & Gujarat'],
            'ta'    => ['code' => 'ta',    'name' => 'Tamil',      'native' => 'தமிழ்',      'flag' => '🇮🇳', 'flag_code' => 'in', 'flag_img' => 'https://flagcdn.com/w40/in.png', 'dir' => 'ltr', 'country' => 'Chennai & South India'],
            'fr'    => ['code' => 'fr',    'name' => 'French',     'native' => 'Français',   'flag' => '🇫🇷', 'flag_code' => 'fr', 'flag_img' => 'https://flagcdn.com/w40/fr.png', 'dir' => 'ltr', 'country' => 'France & Europe'],
            'es'    => ['code' => 'es',    'name' => 'Spanish',    'native' => 'Español',    'flag' => '🇪🇸', 'flag_code' => 'es', 'flag_img' => 'https://flagcdn.com/w40/es.png', 'dir' => 'ltr', 'country' => 'Spain & Americas'],
            'de'    => ['code' => 'de',    'name' => 'German',     'native' => 'Deutsch',    'flag' => '🇩🇪', 'flag_code' => 'de', 'flag_img' => 'https://flagcdn.com/w40/de.png', 'dir' => 'ltr', 'country' => 'Germany & Swiss'],
            'ru'    => ['code' => 'ru',    'name' => 'Russian',    'native' => 'Русский',    'flag' => '🇷🇺', 'flag_code' => 'ru', 'flag_img' => 'https://flagcdn.com/w40/ru.png', 'dir' => 'ltr', 'country' => 'CIS & Eurasia'],
            'zh-CN' => ['code' => 'zh-CN', 'name' => 'Chinese',    'native' => '简体中文',    'flag' => '🇨🇳', 'flag_code' => 'cn', 'flag_img' => 'https://flagcdn.com/w40/cn.png', 'dir' => 'ltr', 'country' => 'Hong Kong & China'],
        ];
    }
}

if (!function_exists('get_active_language')) {
    function get_active_language(): string {
        // 1. Query parameter ?lang=
        if (!empty($_GET['lang'])) {
            $code = strtolower(trim((string)$_GET['lang']));
            $supported = get_supported_languages();
            if (isset($supported[$code])) {
                return $code;
            }
        }
        // 2. Cookie site_lang or googtrans
        if (!empty($_COOKIE['site_lang'])) {
            $code = strtolower(trim((string)$_COOKIE['site_lang']));
            $supported = get_supported_languages();
            if (isset($supported[$code])) {
                return $code;
            }
        }
        if (!empty($_COOKIE['googtrans'])) {
            $parts = explode('/', trim($_COOKIE['googtrans'], '/'));
            if (count($parts) >= 2) {
                $target = $parts[1];
                $supported = get_supported_languages();
                if (isset($supported[$target])) {
                    return $target;
                }
            }
        }
        // 3. Default from settings
        return setting('default_language', 'en');
    }
}

if (!function_exists('get_enabled_languages')) {
    function get_enabled_languages(): array {
        $all = get_supported_languages();
        $enabledStr = setting('enabled_languages', 'en,ar,hi,gu,ta,fr,es,de,ru,zh-CN');
        $enabledKeys = array_map('trim', explode(',', (string)$enabledStr));
        $result = [];
        foreach ($enabledKeys as $key) {
            if (isset($all[$key])) {
                $result[$key] = $all[$key];
            }
        }
        if (empty($result)) {
            $result['en'] = $all['en'];
        }
        return $result;
    }
}

if (!function_exists('secure_upload_image')) {
    /**
     * Upload an image securely with binary MIME inspection, extension validation, and SVG sanitization
     */
    function secure_upload_image(string $field, string $subfolder = 'general', array $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif', 'svg', 'ico'], int $maxBytes = 10485760): ?string {
        if (empty($_FILES[$field]['name']) || empty($_FILES[$field]['tmp_name']) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $tmpPath = $_FILES[$field]['tmp_name'];
        if (!is_uploaded_file($tmpPath) || filesize($tmpPath) > $maxBytes) {
            return null;
        }

        $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions, true)) {
            return null;
        }

        // Deep binary MIME type inspection via fileinfo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $tmpPath);
        finfo_close($finfo);

        $allowedMimes = [
            'jpg'  => ['image/jpeg', 'image/pjpeg'],
            'jpeg' => ['image/jpeg', 'image/pjpeg'],
            'png'  => ['image/png'],
            'webp' => ['image/webp'],
            'gif'  => ['image/gif'],
            'avif' => ['image/avif', 'image/heif'],
            'ico'  => ['image/x-icon', 'image/vnd.microsoft.icon'],
            'svg'  => ['image/svg+xml', 'image/svg', 'text/xml', 'text/plain', 'application/xml'],
        ];

        if (!isset($allowedMimes[$ext]) || !in_array($mime, $allowedMimes[$ext], true)) {
            return null;
        }

        // SVG XSS Protection: Inspect contents for script tags, event handlers, or foreign objects
        if ($ext === 'svg') {
            $svgContent = (string)file_get_contents($tmpPath);
            if (stripos($svgContent, '<svg') === false) {
                return null;
            }
            if (preg_match('/<script|onload\s*=|onerror\s*=|onclick\s*=|javascript:|<foreignObject/i', $svgContent)) {
                return null; // Malicious SVG blocked
            }
        }

        $upDir = dirname(__DIR__, 2) . '/public/uploads/' . preg_replace('/[^a-zA-Z0-9_\-]/', '', $subfolder) . '/';
        if (!is_dir($upDir)) {
            @mkdir($upDir, 0755, true);
        }

        $filename = $subfolder . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
        $targetPath = $upDir . $filename;

        if (move_uploaded_file($tmpPath, $targetPath)) {
            // Also mirror to root uploads/ if directory exists
            $rootUpDir = dirname(__DIR__, 2) . '/uploads/' . preg_replace('/[^a-zA-Z0-9_\-]/', '', $subfolder) . '/';
            if (!is_dir($rootUpDir)) {
                @mkdir($rootUpDir, 0755, true);
            }
            @copy($targetPath, $rootUpDir . $filename);

            return '/uploads/' . $subfolder . '/' . $filename;
        }

        return null;
    }
}
