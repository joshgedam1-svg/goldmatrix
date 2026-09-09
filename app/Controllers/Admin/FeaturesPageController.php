<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use PDO;

class FeaturesPageController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureDefaults();
    }

    /**
     * Ensure default settings for Features Page exist in DB
     */
    private function ensureDefaults(): void {
        $defaults = [
            // ── Section 1: Hero Banner ──
            ['features_hero_enabled',     '1', 'Show Hero Banner Section', 'select'],
            ['features_hero_badge',       '10 Integrated Modules', 'Hero Eyebrow Badge', 'text'],
            ['features_hero_title',       'Every Capability Engineered for', 'Hero Main Title', 'text'],
            ['features_hero_highlight',   'Jewellery Business ERP', 'Hero Title Highlight Word', 'text'],
            ['features_hero_desc',        'Explore all 10 core modules powering jewellery retail showrooms, wholesale bullion traders, and manufacturing workshop units worldwide.', 'Hero Subtitle', 'textarea'],
            ['features_hero_bg_style',    'navy', 'Hero Background Theme', 'select'],

            // ── Section 2: Category Filter Bar ──
            ['features_filter_enabled',   '1', 'Show Category Filter Tabs Bar', 'select'],
            ['features_filter_categories',"All 10 Modules|all\nRetail & Billing|Retail & Operations\nManufacturing & Jobwork|Manufacturing\nAccounting & GST|Finance\nStock & RFID|Inventory\nStaff & Admin|Admin", 'Filter Tabs (Label|FilterTag)', 'textarea'],

            // ── Section 3: Modules Grid Overview ──
            ['features_grid_enabled',     '1', 'Show 10 Core Modules Grid', 'select'],
            ['features_grid_title',       '10 Enterprise Jewellery Modules', 'Grid Section Title', 'text'],
            ['features_grid_subtitle',    'Complete end-to-end integration across all operational departments.', 'Grid Subtitle', 'textarea'],

            // ── Section 4: Hardware Compatibility Bar ──
            ['features_hardware_enabled', '1', 'Show Hardware Compatibility Section', 'select'],
            ['features_hardware_badge',   'PLUG & PLAY ECOSYSTEM', 'Hardware Badge', 'text'],
            ['features_hardware_title',   'Certified Compatibility with Showroom & Factory Hardware', 'Hardware Title', 'text'],
            ['features_hardware_items',   json_encode([
                [
                    'icon'  => 'bi-printer',
                    'title' => 'Barcode & RFID Printers',
                    'desc'  => 'Direct drivers for Zebra, TSC, Citizen, and Honeywell dumbbell and rat-tail jewellery tags.'
                ],
                [
                    'icon'  => 'bi-speedometer2',
                    'title' => 'Certified Weighing Scales',
                    'desc'  => 'Serial RS-232 & USB connectivity for Essae, Mettler Toledo, and Contech precision balances.'
                ],
                [
                    'icon'  => 'bi-broadcast-pin',
                    'title' => 'High-Speed UHF RFID Trays',
                    'desc'  => 'High-speed tray readers from Chainway, CSL, and smart counter pads for 3-second audits.'
                ],
                [
                    'icon'  => 'bi-tv',
                    'title' => 'Digital TV Rate Boards',
                    'desc'  => 'Dedicated HDMI URL stream showing live 24K, 22K, 18K and Silver market rates with custom branding.'
                ]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Hardware Items (JSON)', 'textarea'],

            // ── Section 5: Bottom CTA Banner ──
            ['features_cta_enabled',      '1', 'Show Bottom Demo CTA Banner', 'select'],
            ['features_cta_title',        'See All 10 Modules in a Live Personalized Demo', 'CTA Main Heading', 'text'],
            ['features_cta_desc',         'Schedule a private 30-minute walkthrough with a jewellery ERP specialist to see how GoldMatrix automates your showroom, factory, and multi-branch operations.', 'CTA Description', 'textarea'],
            ['features_cta_btn1_text',    'Book Free Live Demo', 'Primary Button Text', 'text'],
            ['features_cta_btn1_link',    '#bookDemoModal', 'Primary Button Target', 'text'],
            ['features_cta_btn2_text',    'Chat on WhatsApp', 'Secondary Button Text', 'text'],
            ['features_cta_whatsapp',     '+91 92703 69937', 'WhatsApp Number', 'text'],

            // ── Section 6: SEO & Social Meta ──
            ['features_seo_meta_title',   'Complete Jewellery ERP Features & 10 Core Modules | GoldMatrix', 'SEO Meta Title', 'text'],
            ['features_seo_meta_desc',    'Explore all 10 core modules of GoldMatrix Jewellery ERP: Dashboard & Live Rates, Opening Setup, Operations, Order Management, Production, Financial Statements, Report Analysis, Employee Management, Stock Management, and Settings.', 'SEO Meta Description', 'textarea'],
            ['features_seo_keywords',     'jewellery erp modules, jewellery features, gold erp features, jewellery production software, jewellery stock management, jewellery accounting', 'SEO Keywords', 'textarea'],
            ['features_seo_og_image',     '', 'OpenGraph Social Image URL', 'text'],
        ];

        foreach ($defaults as $d) {
            try {
                $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$d[0]]);
                if (!$exists) {
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES ('features_page', ?, ?, ?, ?)",
                        [$d[0], $d[1], $d[2], $d[3]]
                    );
                }
            } catch (\Throwable $e) {}
        }
    }

    /**
     * Render the section-by-section Features CMS Editor
     */
    public function index(): void {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $this->handlePost();
            return;
        }

        // Fetch all features page settings
        $rows = $this->db->fetchAll("SELECT setting_key, setting_value FROM settings WHERE group_name = 'features_page' OR setting_key LIKE 'features_%'");
        $settings = [];
        foreach ($rows as $r) {
            $settings[$r['setting_key']] = $r['setting_value'];
        }

        // Count total active ERP modules
        $moduleCount = 0;
        try {
            $row = $this->db->fetch("SELECT COUNT(*) as cnt FROM erp_modules WHERE status = 'published'");
            $moduleCount = (int)($row['cnt'] ?? 0);
        } catch (\Throwable $e) {}

        admin_view('admin.features.settings', [
            'title'           => 'Features Page Section CMS Settings',
            'settings'        => $settings,
            'moduleCount'     => $moduleCount,
            'expandedSection' => $_GET['section'] ?? 'hero'
        ]);
    }

    /**
     * Handle updating an individual section or all sections
     */
    private function handlePost(): void {
        $section = $_POST['section_name'] ?? 'all';

        // Check if clearing cache
        if (isset($_POST['action']) && $_POST['action'] === 'clear_cache') {
            set_flash('success', '⚡ Features page cache cleared successfully.');
            redirect('/admin/features-settings?section=' . urlencode($section));
            return;
        }

        // Process special fields like Hardware Items JSON
        if (isset($_POST['hw_titles']) && is_array($_POST['hw_titles'])) {
            $hwItems = [];
            $titles = $_POST['hw_titles'];
            $icons  = $_POST['hw_icons'] ?? [];
            $descs  = $_POST['hw_descs'] ?? [];
            for ($i = 0; $i < count($titles); $i++) {
                $t = trim($titles[$i] ?? '');
                $ic = trim($icons[$i] ?? 'bi-cpu');
                $d = trim($descs[$i] ?? '');
                if (!empty($t)) {
                    $hwItems[] = ['icon' => $ic, 'title' => $t, 'desc' => $d];
                }
            }
            $_POST['features_hardware_items'] = json_encode($hwItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // Process file upload if any (e.g. OG Image)
        if ($featuresOg = secure_upload_image('features_seo_og_image_file', 'features', ['png', 'jpg', 'jpeg', 'webp', 'svg'])) {
            $_POST['features_seo_og_image'] = $featuresOg;
        }

        // Auto-handle unchecked switch toggles for the current section
        $switchKeys = [
            'hero'     => ['features_hero_enabled'],
            'filter'   => ['features_filter_enabled'],
            'grid'     => ['features_grid_enabled'],
            'hardware' => ['features_hardware_enabled'],
            'cta'      => ['features_cta_enabled'],
        ];

        if (isset($switchKeys[$section])) {
            foreach ($switchKeys[$section] as $swKey) {
                if (!isset($_POST[$swKey])) {
                    $_POST[$swKey] = '0';
                }
            }
        }

        // Save keys
        $savedCount = 0;
        foreach ($_POST as $key => $val) {
            if ($key === 'section_name' || $key === 'action' || $key === 'hw_titles' || $key === 'hw_icons' || $key === 'hw_descs') {
                continue;
            }

            if (strpos($key, 'features_') === 0) {
                $val = is_array($val) ? json_encode($val) : (string)$val;
                
                // Check if key exists
                $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$key]);
                if ($exists) {
                    $this->db->query("UPDATE settings SET setting_value = ? WHERE setting_key = ?", [$val, $key]);
                } else {
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES ('features_page', ?, ?, ?, 'text')",
                        [$key, $val, ucwords(str_replace(['features_', '_'], ['', ' '], $key))]
                    );
                }
                $savedCount++;
            }
        }

        $sectionLabels = [
            'hero'     => 'Hero Banner Section',
            'filter'   => 'Category Filter Tabs Bar',
            'grid'     => '10 Core Modules Grid Section',
            'hardware' => 'Hardware Compatibility Section',
            'cta'      => 'Bottom Conversion & Demo CTA Banner',
            'seo'      => 'Features SEO & Social Meta Configuration',
            'all'      => 'Features Page Settings'
        ];

        $secName = $sectionLabels[$section] ?? 'Section';
        set_flash('success', "✅ {$secName} updated successfully and synchronized to live Features page!");
        redirect('/admin/features-settings?section=' . urlencode($section));
    }
}
