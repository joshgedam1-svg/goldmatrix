<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use PDO;

class SeoController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureTablesAndDefaults();
    }

    /**
     * Ensure settings defaults & redirects table exist
     */
    private function ensureTablesAndDefaults(): void {
        $pdo = $this->db->getPdo();

        // 1. Create redirects table if not exists (compatible with SQLite & MySQL)
        try {
            $pdo->exec("CREATE TABLE IF NOT EXISTS redirects (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                source_url VARCHAR(255) NOT NULL UNIQUE,
                target_url VARCHAR(255) NOT NULL,
                status_code INT NOT NULL DEFAULT 301,
                is_active INT NOT NULL DEFAULT 1,
                hits INT NOT NULL DEFAULT 0,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
        } catch (\Throwable $e) {
            try {
                // Fallback for MySQL
                $pdo->exec("CREATE TABLE IF NOT EXISTS redirects (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    source_url VARCHAR(255) NOT NULL UNIQUE,
                    target_url VARCHAR(255) NOT NULL,
                    status_code INT NOT NULL DEFAULT 301,
                    is_active TINYINT(1) NOT NULL DEFAULT 1,
                    hits INT NOT NULL DEFAULT 0,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
            } catch (\Throwable $ex) {}
        }

        // 2. Ensure comprehensive universal SEO defaults
        $defaultRobotsTxt = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /storage/\nDisallow: /app/\nDisallow: /config/\nDisallow: /routes/\nDisallow: /database/\n\nSitemap: " . site_url('sitemap.xml');

        $seoDefaults = [
            // ── Global Meta & Title ──
            ['seo', 'default_seo_title',        'GoldMatrix — The Complete Jewellery ERP Software in India', 'Default SEO Title', 'text'],
            ['seo', 'site_title_separator',     '|', 'Title Separator', 'text'],
            ['seo', 'site_name_suffix',         'GoldMatrix ERP', 'Site Name Suffix', 'text'],
            ['seo', 'default_meta_description', 'All-in-one Jewellery ERP software for inventory, billing, POS, manufacturing, Karigar tracking, GST accounting & multi-branch showroom control.', 'Default Meta Description', 'textarea'],
            ['seo', 'default_keywords',         'jewellery erp, jewelry software india, jewellery pos billing, karigar management software, gold shop accounting software, rfid jewellery software', 'Meta Keywords', 'textarea'],
            ['seo', 'default_robots',           'index, follow', 'Default Robots Tag', 'select'],
            ['seo', 'meta_author',              'GoldMatrix Software Technologies Pvt Ltd', 'Meta Author', 'text'],
            ['seo', 'meta_publisher',           'GoldMatrix Software Technologies', 'Meta Publisher', 'text'],
            ['seo', 'canonical_domain',         '', 'Canonical Domain Override', 'text'],
            ['seo', 'geo_region',               'IN-MH', 'Geo Region', 'text'],
            ['seo', 'geo_placename',            'Mumbai, Maharashtra, India', 'Geo Placename', 'text'],
            ['seo', 'geo_position',             '19.0760;72.8777', 'Geo Position (Lat;Long)', 'text'],

            // ── Social & OpenGraph ──
            ['seo', 'default_og_image',         '/assets/images/why-goldmatrix-mockup.png', 'Default OG Image', 'file'],
            ['seo', 'og_sitename',              'GoldMatrix Jewelry ERP', 'OpenGraph Site Name', 'text'],
            ['seo', 'og_type',                  'website', 'Default OG Type', 'select'],
            ['seo', 'facebook_app_id',          '', 'Facebook App ID', 'text'],
            ['seo', 'facebook_page_url',        'https://www.facebook.com/goldmatrixsoftware', 'Facebook Page URL', 'text'],
            ['seo', 'twitter_handle',           '@goldmatrixerp', 'Twitter / X Handle', 'text'],
            ['seo', 'twitter_card_type',        'summary_large_image', 'Twitter Card Type', 'select'],
            ['seo', 'linkedin_page_url',        'https://www.linkedin.com/company/goldmatrix-software', 'LinkedIn Company URL', 'text'],
            ['seo', 'instagram_url',            'https://www.instagram.com/goldmatrixsoftware', 'Instagram Profile URL', 'text'],
            ['seo', 'youtube_url',              'https://www.youtube.com/@goldmatrixsoftware', 'YouTube Channel URL', 'text'],

            // ── Webmaster & Analytics ──
            ['seo', 'google_site_verification', '', 'Google Search Console Verification Tag', 'text'],
            ['seo', 'bing_site_verification',   '', 'Bing Webmaster Tools Verification Tag', 'text'],
            ['seo', 'yandex_site_verification', '', 'Yandex Verification Code', 'text'],
            ['seo', 'google_analytics_id',      '', 'Google Analytics 4 Measurement ID (G-XXXXXXXXXX)', 'text'],
            ['seo', 'google_tag_manager_id',    '', 'Google Tag Manager ID (GTM-XXXXXXX)', 'text'],
            ['seo', 'facebook_pixel_id',        '', 'Meta / Facebook Pixel ID', 'text'],
            ['seo', 'custom_header_scripts',    '', 'Custom Header Scripts (<head>)', 'textarea'],
            ['seo', 'custom_footer_scripts',    '', 'Custom Body/Footer Scripts (</body>)', 'textarea'],

            // ── Schema.org Structured Data ──
            ['seo', 'schema_enabled',           '1', 'Enable Schema.org JSON-LD', 'select'],
            ['seo', 'schema_org_type',          'SoftwareApplication', 'Primary Schema Type', 'select'],
            ['seo', 'schema_org_name',          'GoldMatrix Jewellery ERP', 'Schema Business / Software Name', 'text'],
            ['seo', 'schema_org_legal_name',    'GoldMatrix Software Technologies Pvt. Ltd.', 'Schema Legal Name', 'text'],
            ['seo', 'schema_org_price_range',   '₹₹', 'Schema Price Range', 'text'],
            ['seo', 'schema_org_currency',      'INR', 'Schema Currency', 'text'],
            ['seo', 'schema_software_category', 'BusinessApplication, ERP, POS', 'Software Application Category', 'text'],
            ['seo', 'schema_software_os',       'Cloud Web, Windows 10/11, Android, iOS', 'Supported Operating Systems', 'text'],
            ['seo', 'schema_software_rating',   '4.9', 'Aggregate Rating Value', 'text'],
            ['seo', 'schema_software_review_count', '385', 'Rating Review Count', 'text'],

            // ── Sitemap & Robots.txt ──
            ['seo', 'sitemap_enabled',          '1', 'Enable Dynamic XML Sitemap', 'select'],
            ['seo', 'sitemap_include_pages',    '1', 'Include Core Pages in Sitemap', 'select'],
            ['seo', 'sitemap_include_modules',  '1', 'Include ERP Feature Modules in Sitemap', 'select'],
            ['seo', 'sitemap_include_blog',     '1', 'Include Blog Posts in Sitemap', 'select'],
            ['seo', 'sitemap_changefreq',       'weekly', 'Default Sitemap Change Frequency', 'select'],
            ['seo', 'sitemap_priority',         '0.8', 'Default Sitemap Priority', 'text'],
            ['seo', 'robots_txt_content',       $defaultRobotsTxt, 'Robots.txt Content', 'textarea'],
        ];

        foreach ($seoDefaults as $d) {
            try {
                $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$d[1]]);
                if (!$exists) {
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES (?, ?, ?, ?, ?)",
                        [$d[0], $d[1], $d[2], $d[3], $d[4]]
                    );
                }
            } catch (\Throwable $e) {}
        }
    }

    /**
     * Handle OG Image Upload
     */
    private function handleImageUpload(string $field): string {
        return secure_upload_image($field, 'seo', ['png', 'jpg', 'jpeg', 'webp', 'svg', 'gif']) ?? '';
    }

    /**
     * Main SEO Manager Page
     */
    public function index(): void {
        $activeTab = $_GET['tab'] ?? 'general';

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $action = $_POST['action'] ?? 'save_settings';

            // 1. ADD REDIRECT
            if ($action === 'add_redirect') {
                $source = trim($_POST['source_url'] ?? '');
                $target = trim($_POST['target_url'] ?? '');
                $code   = (int)($_POST['status_code'] ?? 301);

                if (!empty($source) && !empty($target)) {
                    if (strpos($source, '/') !== 0) $source = '/' . $source;
                    try {
                        $this->db->query(
                            "INSERT INTO redirects (source_url, target_url, status_code, is_active) VALUES (?, ?, ?, 1)",
                            [$source, $target, $code]
                        );
                        set_flash('success', "✅ 301/302 Redirect rule added successfully for {$source} → {$target}");
                    } catch (\Throwable $e) {
                        set_flash('error', "❌ Error: A redirect rule for '{$source}' already exists!");
                    }
                } else {
                    set_flash('error', "❌ Source and Target URLs are required.");
                }
                redirect('/admin/seo?tab=redirects');
                return;
            }

            // 2. DELETE REDIRECT
            if ($action === 'delete_redirect') {
                $id = (int)($_POST['id'] ?? 0);
                if ($id > 0) {
                    $this->db->query("DELETE FROM redirects WHERE id = ?", [$id]);
                    set_flash('success', "✅ Redirect rule deleted successfully.");
                }
                redirect('/admin/seo?tab=redirects');
                return;
            }

            // 3. TOGGLE REDIRECT STATUS
            if ($action === 'toggle_redirect') {
                $id = (int)($_POST['id'] ?? 0);
                $status = (int)($_POST['status'] ?? 1);
                if ($id > 0) {
                    $this->db->query("UPDATE redirects SET is_active = ? WHERE id = ?", [$status ? 0 : 1, $id]);
                    set_flash('success', "✅ Redirect rule status updated.");
                }
                redirect('/admin/seo?tab=redirects');
                return;
            }

            // 4. SAVE GENERAL SEO SETTINGS
            if ($action === 'save_settings') {
                $fields = $_POST['settings'] ?? [];

                // Handle file upload for OG image
                if (!empty($_FILES['default_og_image_file']['name'])) {
                    $ogImg = $this->handleImageUpload('default_og_image_file');
                    if ($ogImg) {
                        $fields['default_og_image'] = $ogImg;
                    }
                }

                foreach ($fields as $key => $val) {
                    $val = is_string($val) ? trim($val) : $val;
                    try {
                        $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$key]);
                        if ($exists) {
                            $this->db->query("UPDATE settings SET setting_value = ? WHERE setting_key = ?", [$val, $key]);
                        } else {
                            $this->db->query("INSERT INTO settings (group_name, setting_key, setting_value) VALUES ('seo', ?, ?)", [$key, $val]);
                        }
                    } catch (\Throwable $e) {}
                }

                set_flash('success', '🎉 All Universal SEO & Webmaster settings saved successfully!');
                redirect('/admin/seo?tab=' . urlencode($activeTab));
                return;
            }
        }

        // Fetch all SEO Settings
        $rawSettings = $this->db->fetchAll("SELECT setting_key, setting_value FROM settings WHERE group_name = 'seo'");
        $seoSettings = [];
        foreach ($rawSettings as $row) {
            $seoSettings[$row['setting_key']] = $row['setting_value'];
        }

        // Fetch Redirects
        $redirects = [];
        try {
            $redirects = $this->db->fetchAll("SELECT * FROM redirects ORDER BY id DESC") ?? [];
        } catch (\Throwable $e) {}

        // Fetch On-Page SEO Audit Data (Pages, Feature Modules, Blog Posts)
        $auditPages = [];
        try {
            $pages = $this->db->fetchAll("SELECT id, title, slug, meta_title, meta_description, status, 'page' as content_type FROM pages WHERE deleted_at IS NULL ORDER BY id ASC") ?? [];
            $blogs = $this->db->fetchAll("SELECT id, title, slug, meta_title, meta_description, status, 'blog' as content_type FROM blog_posts ORDER BY id DESC") ?? [];
            
            // Add Homepage
            $homeAudit = [
                'id' => 0,
                'title' => 'Home Page (Main Landing)',
                'slug' => '/',
                'meta_title' => setting('default_seo_title', 'GoldMatrix — The Complete Jewellery ERP'),
                'meta_description' => setting('default_meta_description', ''),
                'status' => 'published',
                'content_type' => 'home'
            ];
            $auditPages = array_merge([$homeAudit], $pages, $blogs);
        } catch (\Throwable $e) {}

        // Compute Audit Stats
        $totalAudited = count($auditPages);
        $missingTitles = 0;
        $missingDesc   = 0;
        $goodSeoCount  = 0;

        foreach ($auditPages as $item) {
            $t = trim($item['meta_title'] ?? '');
            $d = trim($item['meta_description'] ?? '');
            $isTitleMissing = empty($t);
            $isDescMissing  = empty($d);

            if ($isTitleMissing) $missingTitles++;
            if ($isDescMissing)  $missingDesc++;
            if (!$isTitleMissing && !$isDescMissing) $goodSeoCount++;
        }

        $seoHealthScore = $totalAudited > 0 ? round(($goodSeoCount / $totalAudited) * 100) : 100;

        admin_view('admin.seo.index', [
            'title'          => 'Universal SEO & Webmaster Manager — GoldMatrix CMS',
            'activeTab'      => $activeTab,
            'seoSettings'    => $seoSettings,
            'redirects'      => $redirects,
            'auditPages'     => $auditPages,
            'seoHealthScore' => $seoHealthScore,
            'missingTitles'  => $missingTitles,
            'missingDesc'    => $missingDesc,
            'goodSeoCount'   => $goodSeoCount,
            'totalAudited'   => $totalAudited,
        ]);
    }

    /**
     * Shortcut for Sitemap tab
     */
    public function sitemap(): void {
        redirect('/admin/seo?tab=sitemap');
    }

    /**
     * Shortcut for Redirects tab
     */
    public function redirects(): void {
        redirect('/admin/seo?tab=redirects');
    }
}
