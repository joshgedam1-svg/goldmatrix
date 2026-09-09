<?php
namespace App\Controllers\Admin;

use App\Services\Database;

class SettingsController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureDefaults();
    }

    private function ensureDefaults(): void {
        $defaults = [
            // Branding
            ['branding', 'site_logo',               '',                                            'Site Logo (Main / Header)',    'file'],
            ['branding', 'site_logo_dark',          '',                                            'Site Logo (Dark / Admin)',     'file'],
            ['branding', 'site_favicon',            '',                                            'Site Favicon / Site Icon',     'file'],
            ['branding', 'site_logo_height',        '38',                                          'Logo Height (px)',             'number'],
            ['branding', 'show_brand_text',         '1',                                           'Show Brand Text Next to Logo', 'select'],

            // General
            ['general',  'site_title',              'GoldMatrix Jewelry ERP Software',             'Site Title',                   'text'],
            ['general',  'site_tagline',            'Next-Gen Enterprise Jewelry ERP Solution',    'Site Tagline',                 'text'],
            ['general',  'company_name',            'GoldMatrix Software Technologies',            'Company Name',                 'text'],
            ['general',  'contact_email',           'info@goldmatrixerp.com',                      'Contact Email',                'email'],
            ['general',  'contact_phone',           '+91 98765 43210',                             'Contact Phone',                'text'],
            ['general',  'whatsapp_number',         '+91 98765 43210',                             'WhatsApp Number',              'text'],
            ['general',  'address',                 'Mumbai, Maharashtra, India',                  'Company Address',              'textarea'],
            ['general',  'copyright_text',          '© ' . date('Y') . ' GoldMatrix Software Technologies. All Rights Reserved.', 'Footer Copyright', 'text'],

            // SEO
            ['seo',      'default_seo_title',       'Jewelry ERP Software | GoldMatrix ERP',       'Default SEO Title',            'text'],
            ['seo',      'default_meta_description','Complete enterprise Jewelry ERP software for inventory, jobwork manufacturing, sales, bullion trading, accounting, and multi-branch management.', 'Default Meta Description', 'textarea'],
            ['seo',      'default_keywords',        'jewelry erp software, jewellery pos system, gold shop software india', 'Meta Keywords', 'textarea'],

            // Multi-Language & Internationalization
            ['languages', 'enable_multilang',           '1',                                           'Enable Multi-Language Switcher', 'select'],
            ['languages', 'default_language',          'en',                                          'Default Language',             'select'],
            ['languages', 'enabled_languages',         'en,ar,hi,gu,ta,fr,es,de,ru,zh-CN',             'Enabled Languages List',       'text'],
            ['languages', 'language_switcher_pos',     'both',                                        'Switcher Position',            'select'],
            ['languages', 'enable_google_translate',    '1',                                           'Enable Google Cloud Translation', 'select'],
            ['languages', 'enable_hreflang_seo',       '1',                                           'Generate Hreflang SEO Tags',   'select'],
            ['languages', 'enable_auto_browser_detect','0',                                           'Auto-Detect Browser Language', 'select'],

            // Social Media Profiles
            ['social',   'social_facebook',         'https://www.facebook.com/goldmatrixsoftware',  'Facebook Page URL',            'text'],
            ['social',   'social_instagram',        'https://www.instagram.com/goldmatrixsoftware', 'Instagram Profile URL',        'text'],
            ['social',   'social_linkedin',         'https://www.linkedin.com/company/goldmatrix-software', 'LinkedIn Company URL', 'text'],
            ['social',   'social_twitter',          'https://x.com/goldmatrixerp',                  'Twitter / X Profile URL',      'text'],
            ['social',   'social_youtube',          'https://www.youtube.com/@goldmatrixsoftware',  'YouTube Channel URL',          'text'],
            ['social',   'social_whatsapp',         'https://wa.me/971563240319',                   'WhatsApp Direct Link / Channel','text'],
            ['social',   'social_pinterest',        '',                                             'Pinterest URL',                'text'],
            ['social',   'social_telegram',         '',                                             'Telegram Channel / Link',      'text'],
            ['social',   'custom_social_links',     '[]',                                           'Custom Social Links (JSON)',   'textarea'],
        ];

        foreach ($defaults as $d) {
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

    private function handleFileUpload(string $field): string {
        return secure_upload_image($field, 'branding', ['png', 'jpg', 'jpeg', 'svg', 'webp', 'ico', 'gif']) ?? '';
    }

    public function index(): void {
        $activeTab = $_GET['tab'] ?? 'branding';

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $action = $_POST['action'] ?? 'save_settings';

            /* ── 1-CLICK REMOVE LOGO / FAVICON ── */
            if ($action === 'remove_image') {
                $key = $_POST['key'] ?? '';
                if (in_array($key, ['site_logo', 'site_logo_dark', 'site_favicon'])) {
                    $this->db->query("UPDATE settings SET setting_value = '' WHERE setting_key = ?", [$key]);
                    set_flash('success', '✅ Custom logo/favicon removed. Reverted to default.');
                    redirect('/admin/settings?tab=' . urlencode($activeTab));
                    return;
                }
            }

            /* ── 1. HANDLE FILE UPLOADS FIRST ── */
            $uploadedSettings = [];
            $fileUploadKeys = [
                'site_logo_file'    => 'site_logo',
                'site_favicon_file' => 'site_favicon',
                'site_logo'         => 'site_logo',
                'site_favicon'      => 'site_favicon',
                'site_logo_dark'    => 'site_logo_dark'
            ];

            foreach ($fileUploadKeys as $formField => $settingKey) {
                if (!empty($_FILES[$formField]['name'])) {
                    $uploadedPath = $this->handleFileUpload($formField);
                    if ($uploadedPath) {
                        $this->db->query(
                            "UPDATE settings SET setting_value = ? WHERE setting_key = ?",
                            [$uploadedPath, $settingKey]
                        );
                        $uploadedSettings[$settingKey] = true;
                    }
                }
            }

            /* ── 2. HANDLE TEXT FIELDS ── */
            foreach ($_POST as $key => $val) {
                if (in_array($key, ['action', 'csrf_token', 'tab', 'key'])) continue;
                
                // If a file was just uploaded for this key, don't overwrite with text POST
                if (isset($uploadedSettings[$key])) continue;

                // Handle URL override fields if provided
                if ($key === 'site_logo_url') {
                    $valTrim = trim((string)$val);
                    if ($valTrim !== '' && !isset($uploadedSettings['site_logo'])) {
                        $this->db->query("UPDATE settings SET setting_value = ? WHERE setting_key = 'site_logo'", [$valTrim]);
                    }
                    continue;
                }

                if ($key === 'site_favicon_url') {
                    $valTrim = trim((string)$val);
                    if ($valTrim !== '' && !isset($uploadedSettings['site_favicon'])) {
                        $this->db->query("UPDATE settings SET setting_value = ? WHERE setting_key = 'site_favicon'", [$valTrim]);
                    }
                    continue;
                }

                if ($key === 'custom_social' || $key === 'custom_social_links') {
                    $cleaned = [];
                    if (is_array($val)) {
                        foreach ($val as $item) {
                            $platform = trim($item['platform'] ?? $item['title'] ?? '');
                            $url = trim($item['url'] ?? '');
                            $icon = trim($item['icon'] ?? 'bi-link-45deg');
                            if ($url !== '' && $platform !== '') {
                                $cleaned[] = [
                                    'title'    => $platform,
                                    'platform' => $platform,
                                    'url'      => $url,
                                    'icon'     => $icon
                                ];
                            }
                        }
                    }
                    $valStr = json_encode($cleaned, JSON_UNESCAPED_SLASHES);
                    $key = 'custom_social_links';
                } elseif (is_array($val)) {
                    $valStr = implode(',', array_filter(array_map('trim', $val)));
                } else {
                    $valStr = trim((string)$val);
                }

                // Preserve existing image settings if empty in POST and no file uploaded
                if (in_array($key, ['site_logo', 'site_favicon', 'site_logo_dark']) && $valStr === '') {
                    continue;
                }

                // If setting exists update, else insert
                $exists = $this->db->fetch("SELECT id FROM settings WHERE setting_key = ?", [$key]);
                if ($exists) {
                    $this->db->query(
                        "UPDATE settings SET setting_value = ? WHERE setting_key = ?",
                        [$valStr, $key]
                    );
                } else {
                    $groupName = (strpos($key, 'social_') === 0 || $key === 'custom_social_links') ? 'social' : 'general';
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES (?, ?, ?, ?, ?)",
                        [$groupName, $key, $valStr, ucwords(str_replace('_', ' ', $key)), 'text']
                    );
                }
            }

            set_flash('success', '✅ Settings & Branding saved successfully!');
            redirect('/admin/settings?tab=' . urlencode($activeTab));
            return;
        }

        // Load all settings
        $rows = $this->db->fetchAll("SELECT * FROM settings ORDER BY group_name ASC, id ASC");
        $settingsMap = [];
        $groups = [];
        foreach ($rows as $row) {
            $settingsMap[$row['setting_key']] = $row['setting_value'];
            $groups[$row['group_name']][] = $row;
        }

        admin_view('admin.settings.index', [
            'title'       => 'Global Settings & Branding',
            'groups'      => $groups,
            'settings'    => $settingsMap,
            'activeTab'   => $activeTab,
        ]);
    }
}
