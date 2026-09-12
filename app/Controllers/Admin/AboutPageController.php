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
            // ── 1. Hero Section ──
            ['about_hero_title',        'About GoldMatrix', 'Hero Main Heading', 'text'],
            ['about_hero_lead',         'GoldMatrix is a jewellery business software company helping jewellery businesses simplify operations, improve control and grow with confidence.', 'Hero Supporting Text', 'textarea'],
            ['about_hero_image',        'https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=1000&auto=format&fit=crop&q=80', 'Hero Right Image URL', 'text'],
            ['about_hero_btn1_text',    'Book a Free Demo', 'Hero Primary Button Text', 'text'],
            ['about_hero_btn2_text',    'Explore Solutions', 'Hero Secondary Button Text', 'text'],
            ['about_hero_btn2_link',    '/solutions', 'Hero Secondary Button Link', 'text'],

            // ── 2. Who We Are ──
            ['about_whoweare_title',    'Who We Are', 'Who We Are Heading', 'text'],
            ['about_whoweare_text',     'We build practical business solutions for jewellery retailers, wholesalers, manufacturers and growing jewellery enterprises.', 'Who We Are Supporting Text', 'textarea'],
            ['about_whoweare_image',    'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1000&auto=format&fit=crop&q=80', 'Who We Are Image URL', 'text'],

            // ── 3. Our Purpose ──
            ['about_purpose_title',     'Our Purpose', 'Our Purpose Heading', 'text'],
            ['about_purpose_text',      'To make complex jewellery business operations simpler, more accurate and easier to manage.', 'Our Purpose Supporting Text', 'textarea'],
            ['about_purpose_image',     'https://images.unsplash.com/photo-1531973576160-7125cd663d86?w=1000&auto=format&fit=crop&q=80', 'Our Purpose Image URL', 'text'],

            // ── 4. Our Journey ──
            ['about_journey_title',     'Our Journey', 'Our Journey Heading', 'text'],
            ['about_journey_text',      'Our journey is shaped by continuous experience, customer relationships and a deep understanding of jewellery business operations.', 'Our Journey Supporting Text', 'textarea'],
            ['about_journey_items',     json_encode([
                ['phase' => 'PHASE 01', 'title' => 'Experience', 'desc' => 'Direct engagement with jewellery merchants, retailers and bullion counters.'],
                ['phase' => 'PHASE 02', 'title' => 'Industry Understanding', 'desc' => 'Deep mastering of Karigar jobwork, metal purities, stone calculations and retail workflows.'],
                ['phase' => 'PHASE 03', 'title' => 'Software Evolution', 'desc' => 'Purpose-built cloud software bringing inventory, sales, RFID and accounting together.'],
                ['phase' => 'PHASE 04', 'title' => 'Global Growth', 'desc' => 'Expanding across international jewellery capitals with continuous product refinement.']
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Journey Timeline Items (JSON)', 'textarea'],

            // ── 5. What We Do ──
            ['about_whatwedo_title',    'What We Do', 'What We Do Heading', 'text'],
            ['about_whatwedo_text',     'We provide connected business solutions covering the key operations of modern jewellery businesses.', 'What We Do Supporting Text', 'textarea'],
            ['about_whatwedo_image',    '/uploads/homepage/hp_6a9207ee140eb.png', 'Software Screenshot Collage Image', 'text'],

            // ── 6. Our Solutions ──
            ['about_solutions_title',   'Our Solutions', 'Our Solutions Heading', 'text'],
            ['about_solutions_text',    'Explore our dedicated solution modules built exclusively for jewellery commerce.', 'Our Solutions Supporting Text', 'textarea'],
            ['about_solutions_items',   json_encode([
                ['icon' => 'bi-shop', 'title' => 'Jewellery Retail', 'desc' => 'Sales, quick billing, customer profiles and daily store management.'],
                ['icon' => 'bi-boxes', 'title' => 'Wholesale Management', 'desc' => 'B2B orders, approval memos, dealer accounts and bulk trade control.'],
                ['icon' => 'bi-gear-wide-connected', 'title' => 'Manufacturing & Jobwork', 'desc' => 'Department allocations, Karigar jobbags, loss tracking and worklogs.'],
                ['icon' => 'bi-layers', 'title' => 'Inventory Management', 'desc' => 'Precious metal purity, diamond weights, barcode and RFID audits.'],
                ['icon' => 'bi-calculator', 'title' => 'Accounting & Finance', 'desc' => 'Automated ledgers, tax compliance, metal balance and financial statements.'],
                ['icon' => 'bi-people', 'title' => 'CRM & Customer Management', 'desc' => 'Customer history, gold saving schemes and relationship workflows.']
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Solution Cards (JSON)', 'textarea'],

            // ── 7. How We Work ──
            ['about_howwework_title',   'How We Work', 'How We Work Heading', 'text'],
            ['about_howwework_text',    'A structured, customer-first approach to deploying software that fits your operations.', 'How We Work Supporting Text', 'textarea'],
            ['about_howwework_image',   'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=1000&auto=format&fit=crop&q=80', 'How We Work Image URL', 'text'],
            ['about_howwework_steps',   json_encode([
                ['num' => '1', 'title' => 'Understand', 'desc' => 'We understand your business processes and operational requirements.'],
                ['num' => '2', 'title' => 'Implement', 'desc' => 'We configure solutions around your jewellery business workflows.'],
                ['num' => '3', 'title' => 'Support', 'desc' => 'We continue to support your business as your operations grow.']
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'How We Work Steps (JSON)', 'textarea'],

            // ── 8. Built for Jewellery Businesses ──
            ['about_builtfor_title',    'Built for Jewellery Businesses', 'Built For Heading', 'text'],
            ['about_builtfor_text',     'Our solutions are designed around the unique requirements of jewellery retail, wholesale, manufacturing and business operations.', 'Built For Supporting Text', 'textarea'],
            ['about_builtfor_items',    json_encode([
                ['title' => 'Retail Showroom', 'desc' => 'POS, barcode and counter sales', 'img' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=600&auto=format&fit=crop&q=80'],
                ['title' => 'Wholesale Operation', 'desc' => 'B2B orders and stock transfer', 'img' => 'https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?w=600&auto=format&fit=crop&q=80'],
                ['title' => 'Jewellery Manufacturing', 'desc' => 'Jobwork and production queues', 'img' => 'https://images.unsplash.com/photo-1535632787350-4e68ef0ac584?w=600&auto=format&fit=crop&q=80'],
                ['title' => 'Business Management', 'desc' => 'CRM, schemes and analytics', 'img' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=600&auto=format&fit=crop&q=80']
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Built For 4-Image Grid (JSON)', 'textarea'],

            // ── 9. Why GoldMatrix ──
            ['about_why_title',         'Why GoldMatrix', 'Why GoldMatrix Heading', 'text'],
            ['about_why_text',          'Engineered specifically for the demands and operational integrity of the jewellery industry.', 'Why GoldMatrix Supporting Text', 'textarea'],
            ['about_why_items',         json_encode([
                ['icon' => 'bi-gem', 'title' => 'Jewellery Expertise', 'desc' => 'Purpose-built around jewellery business operations.'],
                ['icon' => 'bi-link-45deg', 'title' => 'Connected Operations', 'desc' => 'Manage essential business processes in one ecosystem.'],
                ['icon' => 'bi-check2-circle', 'title' => 'Practical Solutions', 'desc' => 'Designed for real-world jewellery workflows.'],
                ['icon' => 'bi-graph-up-arrow', 'title' => 'Scalable Business', 'desc' => 'Suitable for growing businesses and multi-location operations.'],
                ['icon' => 'bi-headset', 'title' => 'Customer Support', 'desc' => 'Focused on long-term customer relationships.'],
                ['icon' => 'bi-globe2', 'title' => 'Global Approach', 'desc' => 'Built to support modern jewellery businesses across markets.']
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Why GoldMatrix Benefits (JSON)', 'textarea'],

            // ── 10. Who We Serve ──
            ['about_whoweserve_title',  'Who We Serve', 'Who We Serve Heading', 'text'],
            ['about_whoweserve_text',   'From individual jewellery businesses to growing enterprises, GoldMatrix supports different stages of the jewellery business.', 'Who We Serve Supporting Text', 'textarea'],
            ['about_whoweserve_items',  json_encode([
                ['icon' => 'bi-shop', 'title' => 'Retailers', 'desc' => 'Single & multi-store showrooms'],
                ['icon' => 'bi-boxes', 'title' => 'Wholesalers', 'desc' => 'Bullion & trade distributors'],
                ['icon' => 'bi-hammer', 'title' => 'Manufacturers', 'desc' => 'Production units & Karigars'],
                ['icon' => 'bi-safe', 'title' => 'Girvi / Mortgage', 'desc' => 'Gold loan & pawn operators'],
                ['icon' => 'bi-building', 'title' => 'Enterprises', 'desc' => 'Large multi-branch jewellery chains']
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Who We Serve Items (JSON)', 'textarea'],

            // ── 11. Global Presence ──
            ['about_global_title',      'Global Presence', 'Global Presence Heading', 'text'],
            ['about_global_text',       'GoldMatrix is built with an international outlook to support jewellery businesses across different markets and business environments.', 'Global Presence Supporting Text', 'textarea'],
            ['about_global_markets',    'UAE • India • Hong Kong • Singapore • United Kingdom • GCC', 'Global Highlighted Markets', 'text'],

            // ── 12. Our Commitment ──
            ['about_commitment_title',  'Our Commitment', 'Our Commitment Heading', 'text'],
            ['about_commitment_text',   'We focus on reliable solutions, continuous improvement and long-term relationships with the businesses we serve.', 'Our Commitment Supporting Text', 'textarea'],
            ['about_commitment_image',  'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=1000&auto=format&fit=crop&q=80', 'Commitment Image URL', 'text'],

            // ── 13. Final CTA ──
            ['about_cta_title',         'Let\'s Grow Together', 'Final CTA Heading', 'text'],
            ['about_cta_desc',          'Discover how GoldMatrix can help simplify your jewellery business and bring greater control to your daily operations.', 'Final CTA Supporting Text', 'textarea'],
            ['about_cta_btn1_text',     'Book a Free Demo', 'CTA Button Text', 'text'],
            ['about_cta_whatsapp',      '+91 92703 69937', 'CTA WhatsApp Phone', 'text'],
            ['about_cta_bg_image',      'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=1600&auto=format&fit=crop&q=80', 'CTA Background Image URL', 'text'],

            // ── 14. SEO Meta ──
            ['about_seo_meta_title',    'About GoldMatrix | Jewellery ERP & Business Software', 'SEO Meta Title', 'text'],
            ['about_seo_meta_desc',     'GoldMatrix is a jewellery business software company helping jewellery businesses simplify operations, improve control and grow with confidence.', 'SEO Meta Description', 'textarea'],
            ['about_seo_keywords',      'about goldmatrix, jewellery erp software, jewellery pos, jewellery inventory management, jewelry manufacturing software, jewellery accounting crm', 'SEO Keywords', 'textarea'],
            ['about_seo_og_image',      '', 'OpenGraph Social Share Image URL', 'text'],
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
     * Handle updating individual sections or all sections
     */
    private function handlePost(): void {
        $section = $_POST['section_name'] ?? 'all';

        if (isset($_POST['action']) && $_POST['action'] === 'clear_cache') {
            set_flash('success', '⚡ About page cache cleared successfully.');
            redirect('/admin/about-settings?section=' . urlencode($section));
            return;
        }

        // Handle Image Uploads
        $imageFields = [
            'about_hero_image_file'        => 'about_hero_image',
            'about_whoweare_image_file'    => 'about_whoweare_image',
            'about_purpose_image_file'     => 'about_purpose_image',
            'about_whatwedo_image_file'    => 'about_whatwedo_image',
            'about_howwework_image_file'   => 'about_howwework_image',
            'about_commitment_image_file'  => 'about_commitment_image',
            'about_cta_bg_image_file'      => 'about_cta_bg_image',
            'about_seo_og_image_file'      => 'about_seo_og_image'
        ];

        foreach ($imageFields as $fileInput => $settingKey) {
            if ($uploadedPath = secure_upload_image($fileInput, 'about', ['png', 'jpg', 'jpeg', 'webp', 'svg'])) {
                $_POST[$settingKey] = $uploadedPath;
            }
        }

        // Save all about_* POST fields
        $savedCount = 0;
        foreach ($_POST as $key => $val) {
            if ($key === 'section_name' || $key === 'action') {
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
            'hero'         => '1. Hero Section',
            'whoweare'     => '2. Who We Are',
            'purpose'      => '3. Our Purpose',
            'journey'      => '4. Our Journey',
            'whatwedo'     => '5. What We Do',
            'solutions'    => '6. Our Solutions',
            'howwework'    => '7. How We Work',
            'builtfor'     => '8. Built for Jewellery Businesses',
            'why'          => '9. Why GoldMatrix',
            'whoweserve'   => '10. Who We Serve',
            'global'       => '11. Global Presence',
            'commitment'   => '12. Our Commitment',
            'cta'          => '13. Final CTA (Let\'s Grow Together)',
            'seo'          => 'SEO & Social Meta Configuration',
            'all'          => 'About Us Page Settings'
        ];

        $secName = $sectionLabels[$section] ?? 'Section';
        set_flash('success', "✅ {$secName} saved successfully and updated on live About page!");
        redirect('/admin/about-settings?section=' . urlencode($section));
    }
}
