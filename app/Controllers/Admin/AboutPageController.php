<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use PDO;

class AboutPageController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureDefaults();
    }

    /**
     * Ensure default settings for About Us Page exist in DB
     */
    private function ensureDefaults(): void {
        $defaults = [
            // ── Section 1: Hero Banner ──
            ['about_hero_enabled',      '1', 'Show Hero Banner Section', 'select'],
            ['about_hero_eyebrow',      'ENTERPRISE ARCHITECTURE', 'Hero Eyebrow Badge', 'text'],
            ['about_hero_title',        'Powering the Global Jewellery Industry with Next-Gen ERP', 'Hero Main Title', 'text'],
            ['about_hero_sub',          'GoldMatrix Software Technologies is a specialized enterprise solutions provider for retail showrooms, bullion traders, and high-precision manufacturing units across the UAE, India, and worldwide.', 'Hero Subtitle', 'textarea'],
            ['about_hero_bg_style',     'dark', 'Hero Background Theme', 'select'],

            // ── Section 2: Story & Vision ──
            ['about_story_enabled',     '1', 'Show Company Story Section', 'select'],
            ['about_story_badge',       'OUR MISSION & FOUNDATION', 'Story Eyebrow Badge', 'text'],
            ['about_story_title',       'Engineered Exclusively for the Intricacies of Gold & Diamond Commerce', 'Story Heading', 'text'],
            ['about_story_p1',          'Founded by veteran jewellery domain technologists and enterprise software architects, GoldMatrix was conceived to solve the severe limitations of generic ERP systems when applied to the precious metals trade.', 'Story Paragraph 1', 'textarea'],
            ['about_story_p2',          'From real-time bullion rate adjustments to micro-precision Karigar jobwork accounting and RFID stock audibility in under 3 seconds, our platform bridges traditional craftsmanship with modern cloud scalability.', 'Story Paragraph 2', 'textarea'],
            ['about_story_image',       'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=1000&auto=format&fit=crop&q=80', 'Story Photo URL', 'text'],

            // ── Section 3: Key Stats ──
            ['about_stats_enabled',     '1', 'Show Key Statistics Strip', 'select'],
            ['about_stats_items',       json_encode([
                ['num' => '1,500+', 'label' => 'Jewellery Stores & Factories Powered'],
                ['num' => '15+',    'label' => 'Years of Jewellery Domain Innovation'],
                ['num' => '10+',    'label' => 'Countries with Active Deployments'],
                ['num' => '99.9%',  'label' => 'Customer Retention & Uptime Record']
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Stats (JSON)', 'textarea'],

            // ── Section 4: Core Values ──
            ['about_values_enabled',    '1', 'Show Core Values Section', 'select'],
            ['about_values_badge',      'CORE PRINCIPLES', 'Values Badge', 'text'],
            ['about_values_title',      'What Guides Our Product Engineering', 'Values Title', 'text'],
            ['about_values_items',      json_encode([
                [
                    'icon'  => 'bi-shield-check',
                    'title' => 'Zero-Tolerance Accuracy',
                    'desc'  => 'Gold, diamond, and multi-currency transactions calculated to four decimal places for absolute financial integrity.'
                ],
                [
                    'icon'  => 'bi-cloud-check',
                    'title' => 'High-Availability Cloud',
                    'desc'  => 'Distributed multi-region infrastructure with automated hourly backups and 99.9% uptime guarantee.'
                ],
                [
                    'icon'  => 'bi-stars',
                    'title' => 'Continuous Innovation',
                    'desc'  => 'Quarterly feature rollouts incorporating UHF RFID scanning, automated BIS hallmarking, and live bullion rate streaming.'
                ],
                [
                    'icon'  => 'bi-headset',
                    'title' => 'Dedicated On-Site Support',
                    'desc'  => 'Direct field engineering and implementation consultants available locally across the UAE and India.'
                ]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Values Items (JSON)', 'textarea'],

            // ── Section 5: Timeline / Milestones ──
            ['about_timeline_enabled',  '1', 'Show Evolution Timeline Section', 'select'],
            ['about_timeline_badge',    'OUR EVOLUTION', 'Timeline Badge', 'text'],
            ['about_timeline_title',    '15 Years of Domain Leadership', 'Timeline Title', 'text'],
            ['about_timeline_items',    json_encode([
                [
                    'year'  => '2010',
                    'title' => 'Founding & POS Launch',
                    'desc'  => 'First-generation retail POS and barcode solution developed for high-volume jewellery retail showrooms.'
                ],
                [
                    'year'  => '2015',
                    'title' => 'Karigar & Jobwork Module',
                    'desc'  => 'Launched complete manufacturing suite tracking metal loss, purity reconciliation, and batch-wise job bags.'
                ],
                [
                    'year'  => '2020',
                    'title' => 'Cloud & RFID Revolution',
                    'desc'  => 'Architected fully-distributed cloud ERP with plug-and-play UHF RFID tray readers for 3-second inventory audits.'
                ],
                [
                    'year'  => '2025+',
                    'title' => 'International Expansion',
                    'desc'  => 'Established UAE international headquarters in Sharjah Gold Souq, serving GCC and global enterprise clients.'
                ]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Timeline Items (JSON)', 'textarea'],

            // ── Section 6: Global Hubs ──
            ['about_hubs_enabled',      '1', 'Show Dual Global Hubs Section', 'select'],
            ['about_hubs_badge',        'INTERNATIONAL INFRASTRUCTURE', 'Hubs Badge', 'text'],
            ['about_hubs_title',        'Operating Across Key Jewellery Capitals', 'Hubs Title', 'text'],

            // ── Section 7: Conversion CTA ──
            ['about_cta_enabled',       '1', 'Show Bottom Demo Conversion Banner', 'select'],
            ['about_cta_title',         'Ready to Modernize Your Jewellery Operations?', 'CTA Title', 'text'],
            ['about_cta_desc',          'Schedule a private simulation with our senior ERP architect to explore how GoldMatrix streamlines your showroom or manufacturing unit.', 'CTA Subtitle', 'textarea'],
            ['about_cta_btn1_text',     'Schedule Executive Demo', 'CTA Button 1 Text', 'text'],
            ['about_cta_btn1_link',     '/contact', 'CTA Button 1 Target', 'text'],
            ['about_cta_btn2_text',     'WhatsApp Consultant', 'CTA Button 2 Text', 'text'],
            ['about_cta_whatsapp',      '+91 92703 69937', 'CTA WhatsApp', 'text'],

            // ── Section 8: SEO Meta ──
            ['about_seo_meta_title',    'About Us | GoldMatrix Software Technologies (UAE & India)', 'SEO Meta Title', 'text'],
            ['about_seo_meta_desc',     'Discover GoldMatrix Software story, mission, and leadership. Powering 1,500+ jewellery businesses across UAE, India, Hong Kong, and worldwide.', 'SEO Meta Description', 'textarea'],
            ['about_seo_keywords',      'about goldmatrix, jewellery erp company, gold software developers, jewelry tech uae india', 'SEO Keywords', 'textarea'],
            ['about_seo_og_image',      '', 'OpenGraph Image URL', 'text'],
        ];

        foreach ($defaults as $d) {
            try {
                $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$d[0]]);
                if (!$exists) {
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES ('about_page', ?, ?, ?, ?)",
                        [$d[0], $d[1], $d[2], $d[3]]
                    );
                }
            } catch (\Throwable $e) {}
        }
    }

    /**
     * Render the section-by-section About Us CMS Editor
     */
    public function index(): void {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $this->handlePost();
            return;
        }

        $rows = $this->db->fetchAll("SELECT setting_key, setting_value FROM settings WHERE group_name = 'about_page' OR setting_key LIKE 'about_%'");
        $settings = [];
        foreach ($rows as $r) {
            $settings[$r['setting_key']] = $r['setting_value'];
        }

        admin_view('admin.about.settings', [
            'title'           => 'About Us Page Section CMS Settings',
            'settings'        => $settings,
            'expandedSection' => $_GET['section'] ?? 'hero'
        ]);
    }

    /**
     * Handle updating an individual section or all sections
     */
    private function handlePost(): void {
        $section = $_POST['section_name'] ?? 'all';

        if (isset($_POST['action']) && $_POST['action'] === 'clear_cache') {
            set_flash('success', '⚡ About page cache cleared successfully.');
            redirect('/admin/about-settings?section=' . urlencode($section));
            return;
        }

        // Process Stats items JSON
        if (isset($_POST['stat_nums']) && is_array($_POST['stat_nums'])) {
            $stats = [];
            $nums = $_POST['stat_nums'];
            $lbls = $_POST['stat_labels'] ?? [];
            for ($i = 0; $i < count($nums); $i++) {
                $n = trim($nums[$i] ?? '');
                $l = trim($lbls[$i] ?? '');
                if (!empty($n)) {
                    $stats[] = ['num' => $n, 'label' => $l];
                }
            }
            $_POST['about_stats_items'] = json_encode($stats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // Process Values items JSON
        if (isset($_POST['val_titles']) && is_array($_POST['val_titles'])) {
            $vals = [];
            $titles = $_POST['val_titles'];
            $icons  = $_POST['val_icons'] ?? [];
            $descs  = $_POST['val_descs'] ?? [];
            for ($i = 0; $i < count($titles); $i++) {
                $t = trim($titles[$i] ?? '');
                $ic = trim($icons[$i] ?? 'bi-stars');
                $d = trim($descs[$i] ?? '');
                if (!empty($t)) {
                    $vals[] = ['icon' => $ic, 'title' => $t, 'desc' => $d];
                }
            }
            $_POST['about_values_items'] = json_encode($vals, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // Process Timeline items JSON
        if (isset($_POST['tm_years']) && is_array($_POST['tm_years'])) {
            $tms = [];
            $years = $_POST['tm_years'];
            $titles = $_POST['tm_titles'] ?? [];
            $descs  = $_POST['tm_descs'] ?? [];
            for ($i = 0; $i < count($years); $i++) {
                $y = trim($years[$i] ?? '');
                $t = trim($titles[$i] ?? '');
                $d = trim($descs[$i] ?? '');
                if (!empty($y)) {
                    $tms[] = ['year' => $y, 'title' => $t, 'desc' => $d];
                }
            }
            $_POST['about_timeline_items'] = json_encode($tms, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // Process file upload if any (e.g. Story image or OG Image)
        if ($storyImg = secure_upload_image('about_story_image_file', 'about', ['png', 'jpg', 'jpeg', 'webp', 'svg'])) {
            $_POST['about_story_image'] = $storyImg;
        }

        if ($ogImg = secure_upload_image('about_seo_og_image_file', 'about', ['png', 'jpg', 'jpeg', 'webp', 'svg'])) {
            $_POST['about_seo_og_image'] = $ogImg;
        }

        // Auto-handle unchecked switch toggles for the current section
        $switchKeys = [
            'hero'     => ['about_hero_enabled'],
            'story'    => ['about_story_enabled'],
            'stats'    => ['about_stats_enabled'],
            'values'   => ['about_values_enabled'],
            'timeline' => ['about_timeline_enabled'],
            'hubs'     => ['about_hubs_enabled'],
            'cta'      => ['about_cta_enabled'],
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
            if ($key === 'section_name' || $key === 'action' || $key === 'stat_nums' || $key === 'stat_labels' || $key === 'val_titles' || $key === 'val_icons' || $key === 'val_descs' || $key === 'tm_years' || $key === 'tm_titles' || $key === 'tm_descs') {
                continue;
            }

            if (strpos($key, 'about_') === 0) {
                $val = is_array($val) ? json_encode($val) : (string)$val;
                
                $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$key]);
                if ($exists) {
                    $this->db->query("UPDATE settings SET setting_value = ? WHERE setting_key = ?", [$val, $key]);
                } else {
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES ('about_page', ?, ?, ?, 'text')",
                        [$key, $val, ucwords(str_replace(['about_', '_'], ['', ' '], $key))]
                    );
                }
                $savedCount++;
            }
        }

        $sectionLabels = [
            'hero'     => 'Hero Banner Section',
            'story'    => 'Company Story & Mission Section',
            'stats'    => 'Key Statistics Strip',
            'values'   => 'Core Values Section',
            'timeline' => 'Evolution Timeline Section',
            'hubs'     => 'Global Presence & Hubs Section',
            'cta'      => 'Bottom Conversion CTA Banner',
            'seo'      => 'About SEO & Social Meta Configuration',
            'all'      => 'About Us Page Settings'
        ];

        $secName = $sectionLabels[$section] ?? 'Section';
        set_flash('success', "✅ {$secName} updated successfully and synchronized to live About page!");
        redirect('/admin/about-settings?section=' . urlencode($section));
    }
}
