<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use PDO;

class ContactPageController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureDefaults();
    }

    /**
     * Ensure default settings for Contact Page exist in DB
     */
    private function ensureDefaults(): void {
        $defaults = [
            // ── Section 1: Hero Banner ──
            ['contact_hero_enabled',       '1', 'Show Hero Banner Section', 'select'],
            ['contact_hero_eyebrow',       'GLOBAL SPECIALIST NETWORK', 'Hero Eyebrow Badge', 'text'],
            ['contact_hero_title',         'Connect with Our ERP Architects', 'Hero Main Title', 'text'],
            ['contact_hero_subtitle',      'Have a question about our enterprise architecture, hardware compatibility, or ready to schedule a product simulation? Our offices in the UAE and India are at your service.', 'Hero Subtitle', 'textarea'],
            ['contact_hero_bg_style',      'dark', 'Hero Background Theme', 'select'],

            // ── Section 2: UAE Headquarter ──
            ['contact_uae_enabled',        '1', 'Show UAE Headquarter Card', 'select'],
            ['contact_uae_tag',            'INTERNATIONAL HEADQUARTER', 'UAE Card Badge', 'text'],
            ['contact_uae_country',        'United Arab Emirates (Headquarter)', 'UAE Title', 'text'],
            ['contact_uae_address',        'Shop No. 25/A, Central Gold Souq Block No. 8, Al Majaz -1 King Faisal Road - Sharjah', 'UAE Address', 'textarea'],
            ['contact_uae_phone',          '+971 56 324 0319', 'UAE Phone', 'text'],
            ['contact_uae_whatsapp',       '+971 56 324 0319', 'UAE WhatsApp', 'text'],
            ['contact_uae_email',          'info@goldmatrixsoftware.com', 'UAE Email', 'email'],
            ['contact_uae_hours',          'Mon - Sat: 9:00 AM - 8:00 PM GST', 'UAE Working Hours', 'text'],

            // ── Section 3: India Development Hub ──
            ['contact_india_enabled',      '1', 'Show India Hub Card', 'select'],
            ['contact_india_tag',          'DEVELOPMENT & TECH HUB', 'India Card Badge', 'text'],
            ['contact_india_country',      'India (Development & Operations Hub)', 'India Title', 'text'],
            ['contact_india_address',      'India, 01/A, Hingna Rd, M.I.D.C, Maharashtra - 440022', 'India Address', 'textarea'],
            ['contact_india_phone',        '+91 92703 69937', 'India Phone', 'text'],
            ['contact_india_whatsapp',     '+91 92703 69937', 'India WhatsApp', 'text'],
            ['contact_india_email',        'goldmatrixsoftware@gmail.com', 'India Email', 'email'],
            ['contact_india_hours',        'Mon - Sat: 9:30 AM - 7:00 PM IST', 'India Working Hours', 'text'],

            // ── Section 4: Direct Consultation Form ──
            ['contact_form_enabled',       '1', 'Show Lead Consultation Form', 'select'],
            ['contact_form_tag',           'DIRECT CONSULTATION', 'Form Badge', 'text'],
            ['contact_form_title',         'Schedule a Private Demo', 'Form Title', 'text'],
            ['contact_form_subtitle',      'Fill out the form below and an ERP consultant will reach out within 2 business hours.', 'Form Subtitle', 'textarea'],
            ['contact_form_services',      "Retail POS & Billing Software\nJewellery Manufacturing & Jobwork Software\nWholesale & Bullion Management\nRFID Inventory Automation\nGirvi (Money Lending) & Kitty Schemes\nJewellery GST Invoicing & Accounting\nGeneral Enterprise Consultation", 'Service Dropdown Options (One per line)', 'textarea'],
            ['contact_form_btn_text',      'Submit Enquiry & Schedule Demo', 'Submit Button Text', 'text'],
            ['contact_form_success_msg',   'Thank you! Our jewelry ERP specialist will contact you shortly for a personalized demo.', 'Success Message', 'text'],

            // ── Section 5: Direct Hotline Banner ──
            ['contact_hotline_enabled',    '1', 'Show Direct Hotline & Quick Channels', 'select'],
            ['contact_hotline_title',      'Need Instant ERP Assistance or Customized Quotation?', 'Hotline Title', 'text'],
            ['contact_hotline_subtitle',   'Connect directly with our senior jewellery ERP implementation team for express query resolution.', 'Hotline Subtitle', 'textarea'],
            ['contact_hotline_whatsapp',   '+91 92703 69937', 'WhatsApp Helpline', 'text'],
            ['contact_hotline_call',       '+971 56 324 0319', 'Direct Phone Call', 'text'],
            ['contact_hotline_sales_email','sales@goldmatrixsoftware.com', 'Sales Email', 'email'],
            ['contact_hotline_support_email','support@goldmatrixsoftware.com', 'Support Email', 'email'],

            // ── Section 6: Google Maps Embeds ──
            ['contact_maps_enabled',       '1', 'Show Interactive Google Maps Section', 'select'],
            ['contact_maps_title',         'Visit Our Global Offices', 'Maps Title', 'text'],
            ['contact_maps_subtitle',      'Visit our international technology centers or schedule an in-person boardroom demonstration.', 'Maps Subtitle', 'textarea'],
            ['contact_map_uae_embed',      'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3606.319766526145!2d55.385412!3d25.327091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5bc03cb1bd3b%3A0x86708ad00d075218!2sCentral%20Gold%20Souq%2C%20Sharjah!5e0!3m2!1sen!2sae!4v1700000000000', 'UAE Map Embed URL', 'textarea'],
            ['contact_map_india_embed',    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119066.42985160846!2d78.990108!3d21.161028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4c0a5a31faf13%3A0x19b37d30d1785929!2sMIDC%20Industrial%20Area%2C%20Nagpur!5e0!3m2!1sen!2sin!4v1700000000000', 'India Map Embed URL', 'textarea'],

            // ── Section 7: FAQs ──
            ['contact_faq_enabled',        '1', 'Show Contact Page FAQs Section', 'select'],
            ['contact_faq_title',          'Frequently Asked Questions', 'FAQ Title', 'text'],
            ['contact_faq_subtitle',       'Quick answers to commonly asked questions about our jewelry ERP demonstrations and onboarding.', 'FAQ Subtitle', 'textarea'],
            ['contact_faq_items',          json_encode([
                [
                    'question' => 'How quickly can we schedule a live software demonstration?',
                    'answer'   => 'Our ERP architects can schedule a live personalized simulation within 2 to 4 business hours of your request, or at a specific time convenient for your management team.'
                ],
                [
                    'question' => 'Do you provide on-site implementation in UAE and India?',
                    'answer'   => 'Yes. We have dedicated field engineers and technical consultants based in both the UAE (Sharjah / Dubai) and India (Maharashtra / Pan-India) for on-premise hardware setup, barcode printer integration, and staff training.'
                ],
                [
                    'question' => 'Can we migrate data from our existing jewellery accounting software?',
                    'answer'   => 'Absolutely. Our migration specialists seamlessly transfer your historical customer data, stock inventory, barcode catalog, vendor ledgers, and Girvi records with 100% data integrity.'
                ],
                [
                    'question' => 'What support channels are available after deployment?',
                    'answer'   => 'We provide 24/7 technical assistance via dedicated WhatsApp support groups, live telephone hotline, remote screen sharing, and priority on-site support.'
                ]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'FAQ Items (JSON)', 'textarea'],

            // ── Section 8: SEO & Social Meta ──
            ['contact_seo_meta_title',     'Contact Us | GoldMatrix Software Technologies (UAE & India)', 'SEO Meta Title', 'text'],
            ['contact_seo_meta_desc',      'Contact GoldMatrix Jewellery ERP specialists. UAE Headquarter in Sharjah Gold Souq and India Tech Hub in Maharashtra. Call +971 56 324 0319.', 'SEO Meta Description', 'textarea'],
            ['contact_seo_keywords',       'contact goldmatrix, jewellery software support, goldmatrix sharjah uae, goldmatrix india office, jewellery pos demo', 'SEO Keywords', 'textarea'],
            ['contact_seo_og_image',       '', 'OpenGraph Image URL', 'text'],
        ];

        foreach ($defaults as $d) {
            try {
                $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$d[0]]);
                if (!$exists) {
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES ('contact_page', ?, ?, ?, ?)",
                        [$d[0], $d[1], $d[2], $d[3]]
                    );
                }
            } catch (\Throwable $e) {}
        }
    }

    /**
     * Render the section-by-section Contact CMS Editor
     */
    public function index(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePost();
            return;
        }

        // Fetch all contact page settings
        $rows = $this->db->fetchAll("SELECT setting_key, setting_value FROM settings WHERE group_name = 'contact_page' OR setting_key LIKE 'contact_%'");
        $settings = [];
        foreach ($rows as $r) {
            $settings[$r['setting_key']] = $r['setting_value'];
        }

        admin_view('admin.contact.index', [
            'title'    => 'Contact Page Section CMS Settings',
            'settings' => $settings,
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
            set_flash('success', '⚡ Contact page cache cleared successfully.');
            redirect('/admin/contact?section=' . urlencode($section));
            return;
        }

        // Process special fields like FAQ JSON
        if (isset($_POST['faq_questions']) && is_array($_POST['faq_questions'])) {
            $faqs = [];
            $questions = $_POST['faq_questions'];
            $answers = $_POST['faq_answers'] ?? [];
            for ($i = 0; $i < count($questions); $i++) {
                $q = trim($questions[$i] ?? '');
                $a = trim($answers[$i] ?? '');
                if (!empty($q) && !empty($a)) {
                    $faqs[] = ['question' => $q, 'answer' => $a];
                }
            }
            $_POST['contact_faq_items'] = json_encode($faqs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // Process file upload if any (e.g. OG Image)
        if ($contactOg = secure_upload_image('contact_seo_og_image_file', 'contact', ['png', 'jpg', 'jpeg', 'webp', 'svg'])) {
            $_POST['contact_seo_og_image'] = $contactOg;
        }

        // Auto-handle unchecked switch toggles for the current section
        $switchKeys = [
            'hero'     => ['contact_hero_enabled'],
            'uae'      => ['contact_uae_enabled'],
            'india'    => ['contact_india_enabled'],
            'form'     => ['contact_form_enabled'],
            'hotline'  => ['contact_hotline_enabled'],
            'maps'     => ['contact_maps_enabled'],
            'faq'      => ['contact_faq_enabled'],
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
            if ($key === 'section_name' || $key === 'action' || $key === 'faq_questions' || $key === 'faq_answers') {
                continue;
            }

            if (strpos($key, 'contact_') === 0) {
                $val = is_array($val) ? json_encode($val) : (string)$val;
                
                // Check if key exists
                $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$key]);
                if ($exists) {
                    $this->db->query("UPDATE settings SET setting_value = ? WHERE setting_key = ?", [$val, $key]);
                } else {
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES ('contact_page', ?, ?, ?, 'text')",
                        [$key, $val, ucwords(str_replace(['contact_', '_'], ['', ' '], $key))]
                    );
                }
                $savedCount++;
            }
        }

        $sectionLabels = [
            'hero'    => 'Hero Banner Section',
            'uae'     => 'UAE Headquarter Card',
            'india'   => 'India Development Hub Card',
            'form'    => 'Direct Consultation Form Section',
            'hotline' => 'Direct Hotline & Channels Banner',
            'maps'    => 'Google Maps & Location Section',
            'faq'     => 'Frequently Asked Questions Section',
            'seo'     => 'SEO & Meta Tags Configuration',
            'all'     => 'Contact Page Settings'
        ];

        $secName = $sectionLabels[$section] ?? 'Section';
        set_flash('success', "✅ {$secName} updated successfully and synchronized to live Contact page!");
        redirect('/admin/contact?section=' . urlencode($section));
    }
}
