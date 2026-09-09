<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use PDO;

class LegalPageController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureDefaults();
    }

    /**
     * Ensure default settings for Terms and Privacy Pages exist in DB
     */
    private function ensureDefaults(): void {
        $defaultTermsSections = [
            [
                'title'   => '1. Acceptance of Terms & Services',
                'content' => 'By accessing, installing, or utilizing the GoldMatrix Jewellery ERP software suites, mobile applications, or cloud APIs, you agree to be bound by these Terms and Conditions. If you are entering into this agreement on behalf of a jewelry showroom, bullion dealership, or manufacturing entity, you represent that you possess the full corporate authority to bind such entity.'
            ],
            [
                'title'   => '2. License Grant & Permitted Usage',
                'content' => 'GoldMatrix Software Technologies grants you a non-exclusive, non-transferable, revocable license to utilize the ERP modules strictly for your internal business operations across licensed retail stores, back-office locations, and workshop production plants. You shall not reverse engineer, decompile, or sublicense the software.'
            ],
            [
                'title'   => '3. Hardware Integrations & Certified Devices',
                'content' => 'GoldMatrix provides direct device drivers for supported barcode printers, digital weighing scales, UHF RFID tray scanners, and TV rate boards. The customer is responsible for ensuring compliant hardware specifications and standard voltage operating environments.'
            ],
            [
                'title'   => '4. Financial Records & Data Ownership',
                'content' => 'All customer information, bullion transactions, itemized sales records, Karigar work orders, and ledger entries entered into GoldMatrix remain the exclusive proprietary property of the customer. GoldMatrix will not access customer transaction records except upon authorized support requests.'
            ],
            [
                'title'   => '5. Service Level Agreement (SLA) & Technical Support',
                'content' => 'We maintain a 99.9% uptime standard for cloud-hosted environments. Standard support includes priority WhatsApp assistance, telephone helpdesk, remote screen-share troubleshooting, and scheduled quarterly feature rollouts.'
            ],
            [
                'title'   => '6. Subscription, Billing & Termination',
                'content' => 'Subscription licenses are billed according to the agreed multi-branch pricing plan. Either party may terminate services with thirty (30) days written notice. Upon termination, full data exports in CSV/Excel/SQL formats are provided to the customer.'
            ]
        ];

        $defaultPrivacySections = [
            [
                'title'   => '1. Information Collection & Scope',
                'content' => 'GoldMatrix collects business contact details (name, corporate email, showroom telephone number, showroom address) and system telemetry required for license activation, automatic software updates, and support delivery.'
            ],
            [
                'title'   => '2. Confidentiality of Precious Metals & Financial Data',
                'content' => 'We recognize the extraordinary confidentiality required in the jewellery and bullion industry. We do not sell, share, or monetize any financial, inventory, or customer data entered into your ERP database.'
            ],
            [
                'title'   => '3. Enterprise Cloud Encryption & Infrastructure Security',
                'content' => 'All cloud-hosted database transmissions are encrypted in transit via TLS 1.3 and at rest utilizing AES-256 bit encryption standards. Automated encrypted backups are generated hourly across geo-redundant secure cloud data centers.'
            ],
            [
                'title'   => '4. Third-Party Hardware & API Gateways',
                'content' => 'Integrations with third-party SMS providers, WhatsApp Business APIs, payment gateways, and accounting portals communicate solely via secure encrypted endpoints with strict authentication tokens.'
            ],
            [
                'title'   => '5. Data Retention & Right to Erasure',
                'content' => 'Customers maintain complete rights to request comprehensive database backups or complete data erasure from backup archives upon cessation of subscription contracts.'
            ],
            [
                'title'   => '6. Contact Our Data Protection Officer',
                'content' => 'For inquiries regarding data security, audits, or compliance policies, contact our security desk at privacy@goldmatrixsoftware.com or info@goldmatrixsoftware.com.'
            ]
        ];

        $defaults = [
            // ── Terms & Conditions ──
            ['terms_hero_enabled',       '1', 'Show Terms Hero Section', 'select'],
            ['terms_hero_eyebrow',       'LEGAL COMPLIANCE & GOVERNANCE', 'Terms Eyebrow', 'text'],
            ['terms_hero_title',         'Terms & Conditions of Service', 'Terms Title', 'text'],
            ['terms_hero_subtitle',      'Standard software license, enterprise SLA, multi-branch service agreement and operational policies.', 'Terms Subtitle', 'textarea'],
            ['terms_last_updated',       'September 2026', 'Terms Last Updated', 'text'],
            ['terms_sections',           json_encode($defaultTermsSections, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Terms Clauses (JSON)', 'textarea'],
            ['terms_seo_meta_title',     'Terms & Conditions | GoldMatrix Jewellery ERP', 'Terms SEO Title', 'text'],
            ['terms_seo_meta_desc',      'Review GoldMatrix Software Technologies Terms of Service, licensing policy, SLA commitments and operational terms.', 'Terms SEO Desc', 'textarea'],
            ['terms_seo_keywords',       'goldmatrix terms, jewellery software terms, erp software license agreement', 'Terms SEO Keywords', 'textarea'],

            // ── Privacy Policy ──
            ['privacy_hero_enabled',     '1', 'Show Privacy Hero Section', 'select'],
            ['privacy_hero_eyebrow',     'DATA PROTECTION & PRIVACY COMMITMENT', 'Privacy Eyebrow', 'text'],
            ['privacy_hero_title',       'Privacy Policy & Data Security', 'Privacy Title', 'text'],
            ['privacy_hero_subtitle',    'How GoldMatrix collects, protects, encrypts, and safeguards enterprise jewellery showroom and bullion data.', 'Privacy Subtitle', 'textarea'],
            ['privacy_last_updated',     'September 2026', 'Privacy Last Updated', 'text'],
            ['privacy_sections',         json_encode($defaultPrivacySections, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'Privacy Clauses (JSON)', 'textarea'],
            ['privacy_seo_meta_title',   'Privacy Policy & Data Protection | GoldMatrix ERP', 'Privacy SEO Title', 'text'],
            ['privacy_seo_meta_desc',    'Read GoldMatrix Privacy Policy. Strict AES-256 cloud encryption and zero-sharing guarantee for jewellery inventory and financial records.', 'Privacy SEO Desc', 'textarea'],
            ['privacy_seo_keywords',     'goldmatrix privacy policy, jewellery data security, cloud erp privacy', 'Privacy SEO Keywords', 'textarea'],
        ];

        foreach ($defaults as $d) {
            try {
                $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$d[0]]);
                if (!$exists) {
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES ('legal_pages', ?, ?, ?, ?)",
                        [$d[0], $d[1], $d[2], $d[3]]
                    );
                }
            } catch (\Throwable $e) {}
        }
    }

    /**
     * Render the section-by-section Legal CMS Editor
     */
    public function index(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePost();
            return;
        }

        $rows = $this->db->fetchAll("SELECT setting_key, setting_value FROM settings WHERE group_name = 'legal_pages' OR setting_key LIKE 'terms_%' OR setting_key LIKE 'privacy_%'");
        $settings = [];
        foreach ($rows as $r) {
            $settings[$r['setting_key']] = $r['setting_value'];
        }

        $activeTab = $_GET['tab'] ?? 'terms';

        admin_view('admin.legal.settings', [
            'title'           => 'Legal & Policy Pages Section CMS',
            'settings'        => $settings,
            'activeTab'       => $activeTab,
            'expandedSection' => $_GET['section'] ?? 'hero'
        ]);
    }

    /**
     * Handle updating an individual section or all sections
     */
    private function handlePost(): void {
        $section = $_POST['section_name'] ?? 'all';
        $activeTab = $_POST['tab'] ?? 'terms';

        if (isset($_POST['action']) && $_POST['action'] === 'clear_cache') {
            set_flash('success', '⚡ Legal pages cache cleared successfully.');
            redirect('/admin/legal-settings?tab=' . urlencode($activeTab) . '&section=' . urlencode($section));
            return;
        }

        // Process Terms clauses JSON
        if (isset($_POST['terms_clause_titles']) && is_array($_POST['terms_clause_titles'])) {
            $tClauses = [];
            $titles = $_POST['terms_clause_titles'];
            $contents = $_POST['terms_clause_contents'] ?? [];
            for ($i = 0; $i < count($titles); $i++) {
                $t = trim($titles[$i] ?? '');
                $c = trim($contents[$i] ?? '');
                if (!empty($t)) {
                    $tClauses[] = ['title' => $t, 'content' => $c];
                }
            }
            $_POST['terms_sections'] = json_encode($tClauses, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // Process Privacy clauses JSON
        if (isset($_POST['privacy_clause_titles']) && is_array($_POST['privacy_clause_titles'])) {
            $pClauses = [];
            $titles = $_POST['privacy_clause_titles'];
            $contents = $_POST['privacy_clause_contents'] ?? [];
            for ($i = 0; $i < count($titles); $i++) {
                $t = trim($titles[$i] ?? '');
                $c = trim($contents[$i] ?? '');
                if (!empty($t)) {
                    $pClauses[] = ['title' => $t, 'content' => $c];
                }
            }
            $_POST['privacy_sections'] = json_encode($pClauses, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // Handle switches
        $switchKeys = [
            'terms_hero'    => ['terms_hero_enabled'],
            'privacy_hero'  => ['privacy_hero_enabled'],
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
            if ($key === 'section_name' || $key === 'action' || $key === 'tab' || $key === 'terms_clause_titles' || $key === 'terms_clause_contents' || $key === 'privacy_clause_titles' || $key === 'privacy_clause_contents') {
                continue;
            }

            if (strpos($key, 'terms_') === 0 || strpos($key, 'privacy_') === 0) {
                $val = is_array($val) ? json_encode($val) : (string)$val;
                
                $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$key]);
                if ($exists) {
                    $this->db->query("UPDATE settings SET setting_value = ? WHERE setting_key = ?", [$val, $key]);
                } else {
                    $this->db->query(
                        "INSERT INTO settings (group_name, setting_key, setting_value, label, type) VALUES ('legal_pages', ?, ?, ?, 'text')",
                        [$key, $val, ucwords(str_replace(['terms_', 'privacy_', '_'], ['', '', ' '], $key))]
                    );
                }
                $savedCount++;
            }
        }

        set_flash('success', "✅ Legal section updated successfully and synchronized to live website!");
        redirect('/admin/legal-settings?tab=' . urlencode($activeTab) . '&section=' . urlencode($section));
    }
}
