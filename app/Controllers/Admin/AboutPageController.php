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
            ['about_hero_eyebrow',      'ABOUT GOLDMATRIX', 'Hero Eyebrow Badge', 'text'],
            ['about_hero_title',        'Technology Built Around the Jewellery Business', 'Hero Main Title', 'text'],
            ['about_hero_sub',          'GoldMatrix is a jewellery-focused software technology provider helping businesses manage the complexity of modern jewellery operations through connected, purpose-built business software.', 'Hero Subtitle', 'textarea'],
            ['about_hero_bg_style',     'dark', 'Hero Background Theme', 'select'],

            // ── Section 2: Story & Vision ──
            ['about_story_enabled',     '1', 'Show Company Story Section', 'select'],
            ['about_story_badge',       'PURPOSE-BUILT ARCHITECTURE', 'Story Eyebrow Badge', 'text'],
            ['about_story_title',       'Built for the Realities of Jewellery Businesses', 'Story Heading', 'text'],
            ['about_story_p1',          'Jewellery businesses operate differently from conventional retail and trading businesses. Products can involve precious metals, diamonds and stones, varying purity and carat values, weight-based transactions, changing rates, manufacturing processes, jobwork, repairs, stock transfers and high-value inventory.', 'Story Paragraph 1', 'textarea'],
            ['about_story_p2',          'GoldMatrix brings these requirements together in a single business-management environment.', 'Story Paragraph 2', 'textarea'],
            ['about_story_image',       'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=1000&auto=format&fit=crop&q=80', 'Story Photo URL', 'text'],

            // ── Section 3: Key Stats ──
            ['about_stats_enabled',     '1', 'Show Key Statistics Strip', 'select'],
            ['about_stats_items',       json_encode([
                ['num' => '10+',    'label' => 'Core Operational Modules'],
                ['num' => '100%',   'label' => 'Jewellery-Specific Domain Logic'],
                ['num' => 'Global', 'label' => 'Multi-Country Cloud Deployments'],
                ['num' => '24/7',   'label' => 'Dedicated Enterprise Support']
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Stats (JSON)', 'textarea'],

            // ── Section 4: Core Values ──
            ['about_values_enabled',    '1', 'Show Core Values Section', 'select'],
            ['about_values_badge',      'OUR APPROACH', 'Values Badge', 'text'],
            ['about_values_title',      'Technology With a Customer-First Approach', 'Values Title', 'text'],
            ['about_values_items',      json_encode([
                [
                    'icon'  => 'bi-lightbulb',
                    'title' => 'Industry Understanding',
                    'desc'  => 'Software designed around real jewellery workflows rather than generic retail assumptions.'
                ],
                [
                    'icon'  => 'bi-check2-square',
                    'title' => 'Accuracy & Control',
                    'desc'  => 'Structured processes and reporting designed to improve operational visibility and reduce manual errors.'
                ],
                [
                    'icon'  => 'bi-diagram-3',
                    'title' => 'Scalable Technology',
                    'desc'  => 'A technology platform designed to support growing business requirements and connected operations.'
                ],
                [
                    'icon'  => 'bi-ui-checks',
                    'title' => 'Practical Usability',
                    'desc'  => 'Interfaces and workflows designed to help teams perform everyday tasks efficiently.'
                ],
                [
                    'icon'  => 'bi-handshake',
                    'title' => 'Long-Term Partnership',
                    'desc'  => 'Supporting businesses beyond software deployment with ongoing product improvements and customer assistance.'
                ]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Values Items (JSON)', 'textarea'],

            // ── Section 5: Timeline / Milestones ──
            ['about_timeline_enabled',  '1', 'Show Evolution Timeline Section', 'select'],
            ['about_timeline_badge',    'DOMAIN MASTERY', 'Timeline Badge', 'text'],
            ['about_timeline_title',    'Jewellery Industry Expertise at the Core', 'Timeline Title', 'text'],
            ['about_timeline_items',    json_encode([
                [
                    'year'  => '01',
                    'title' => 'Precious-Metal Inventory',
                    'desc'  => 'Manage products where weight, purity, carat and metal type matter with complete calculation precision.'
                ],
                [
                    'year'  => '02',
                    'title' => 'Manufacturing & Jobwork',
                    'desc'  => 'Follow production activities through departments and manufacturing stages with granular jobcard and loss tracking.'
                ],
                [
                    'year'  => '03',
                    'title' => 'High-Value Inventory',
                    'desc'  => 'Maintain greater visibility over products, stock movements, approvals and high-security vault inventory information.'
                ],
                [
                    'year'  => '04',
                    'title' => 'Multi-Location Operations',
                    'desc'  => 'Support businesses that need centralized visibility across stores, branches, wholesale counters or operational locations.'
                ],
                [
                    'year'  => '05',
                    'title' => 'Customer Relationships',
                    'desc'  => 'Bring customer information, purchase activity, gold saving schemes and business interactions into a connected environment.'
                ]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Timeline Items (JSON)', 'textarea'],

            // ── Section 6: Global Hubs ──
            ['about_hubs_enabled',      '1', 'Show Dual Global Hubs Section', 'select'],
            ['about_hubs_badge',        'GLOBAL PRESENCE', 'Hubs Badge', 'text'],
            ['about_hubs_title',        'Built for Jewellery Businesses Worldwide', 'Hubs Title', 'text'],

            // ── Section 7: Conversion CTA ──
            ['about_cta_enabled',       '1', 'Show Bottom Demo Conversion Banner', 'select'],
            ['about_cta_title',         'Ready to Modernize Your Jewellery Business?', 'CTA Title', 'text'],
            ['about_cta_desc',          'Discover how GoldMatrix can bring your sales, inventory, manufacturing, accounting, customer management and reporting into one connected software platform.', 'CTA Subtitle', 'textarea'],
            ['about_cta_btn1_text',     'Book a Personal Demo', 'CTA Button 1 Text', 'text'],
            ['about_cta_btn1_link',     '/contact', 'CTA Button 1 Target', 'text'],
            ['about_cta_btn2_text',     'Talk to Our Team', 'CTA Button 2 Text', 'text'],
            ['about_cta_whatsapp',      '+91 92703 69937', 'CTA WhatsApp', 'text'],

            // ── Section 8: SEO Meta ──
            ['about_seo_meta_title',    'About GoldMatrix | Jewellery ERP & Business Software', 'SEO Meta Title', 'text'],
            ['about_seo_meta_desc',     'Learn about GoldMatrix, a jewellery-focused software provider delivering ERP, POS, inventory, manufacturing, accounting, CRM and business management solutions for jewellery businesses.', 'SEO Meta Description', 'textarea'],
            ['about_seo_keywords',      'about goldmatrix, jewellery erp software, jewellery pos, jewellery inventory management, jewelry manufacturing software, jewellery accounting crm', 'SEO Keywords', 'textarea'],
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
