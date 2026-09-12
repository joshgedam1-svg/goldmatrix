<?php
namespace App\Controllers\Admin;

use App\Services\Database;

class HomepageController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureTables();
    }

    /* ─────────────────────────────────────────────────
     *  AUTO-CREATE TABLES (SQLite / MySQL compatible)
     * ───────────────────────────────────────────────── */
    private function ensureTables(): void {
        // Key-value store for all text settings
        $this->db->query("CREATE TABLE IF NOT EXISTS homepage_sections (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            section_key TEXT UNIQUE NOT NULL,
            value TEXT,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Repeatable items (hero slides, modules, stats, testimonials, etc.)
        $this->db->query("CREATE TABLE IF NOT EXISTS homepage_items (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            section TEXT NOT NULL,
            title TEXT NOT NULL DEFAULT '',
            subtitle TEXT DEFAULT '',
            description TEXT DEFAULT '',
            icon TEXT DEFAULT '',
            link TEXT DEFAULT '',
            image TEXT DEFAULT '',
            mobile_image TEXT DEFAULT '',
            alt_text TEXT DEFAULT '',
            badge TEXT DEFAULT '',
            btn1_text TEXT DEFAULT '',
            btn1_link TEXT DEFAULT '',
            btn2_text TEXT DEFAULT '',
            btn2_link TEXT DEFAULT '',
            features TEXT DEFAULT '',
            extra TEXT DEFAULT '',
            sort_order INTEGER DEFAULT 0,
            is_active INTEGER DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Add new columns to existing tables if they don't exist (SQLite safe)
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN mobile_image TEXT DEFAULT ''"); } catch (\Throwable $e) {}
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN alt_text TEXT DEFAULT ''"); } catch (\Throwable $e) {}
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN badge TEXT DEFAULT ''"); } catch (\Throwable $e) {}
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN btn1_text TEXT DEFAULT ''"); } catch (\Throwable $e) {}
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN btn1_link TEXT DEFAULT ''"); } catch (\Throwable $e) {}
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN btn2_text TEXT DEFAULT ''"); } catch (\Throwable $e) {}
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN btn2_link TEXT DEFAULT ''"); } catch (\Throwable $e) {}
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN features TEXT DEFAULT ''"); } catch (\Throwable $e) {}
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN accent_color TEXT DEFAULT '#F59E0B'"); } catch (\Throwable $e) {}
        try { $this->db->query("ALTER TABLE homepage_items ADD COLUMN extra TEXT DEFAULT ''"); } catch (\Throwable $e) {}

        // Seed default slides if none exist
        $this->seedDefaultHeroSlides();
        $this->seedDefaultShowcaseFeatures();
        $this->seedDefaultSpotlightFeatures();
        $this->seedDefaultSlidingCountries();
        $this->seedDefaultPowerfulFeatures();
        $this->seedDefaultIntegrations();
        $this->seedDefaultMobileApp();
        $this->seedDefaultSolutionsCards();
        $this->seedDefaultBrandLogos();
        $this->seedDefaultTestimonials();
        $this->seedDefaultAwards();
    }

    private function seedDefaultTestimonials(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'testimonials'");
            if ($count === 0) {
                $testis = [
                    [
                        'title'       => 'Rajesh Mehta',
                        'subtitle'    => 'Owner, Mehta Jewellers (Mumbai)',
                        'description' => 'GoldMatrix has completely transformed the way we manage our retail jewellery counters. Real-time billing, barcode tagging, and old gold exchange are seamless.',
                        'image'       => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
                        'extra'       => '5',
                        'badge'       => 'RETAIL SHOWROOM',
                        'sort_order'  => 1
                    ],
                    [
                        'title'       => 'Anita Shah',
                        'subtitle'    => 'Director, Shah Gold Palace (Surat)',
                        'description' => 'Excellent support and best software for jewellery business management. Multi-branch stock audits that used to take days are now done in minutes.',
                        'image'       => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&auto=format&fit=crop&q=80',
                        'extra'       => '5',
                        'badge'       => 'SHOWROOM CHAIN',
                        'sort_order'  => 2
                    ],
                    [
                        'title'       => 'Vikram Malhotra',
                        'subtitle'    => 'Managing Partner, Malhotra Jewellers (Delhi)',
                        'description' => 'We can now manage 5 showroom branches and manufacturing inventory in real-time with 100% accuracy and GST hallmark compliance.',
                        'image'       => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
                        'extra'       => '5',
                        'badge'       => 'MULTI-BRANCH ERP',
                        'sort_order'  => 3
                    ],
                    [
                        'title'       => 'Rajesh Varma',
                        'subtitle'    => 'Managing Director, Varma Jewellers (Dubai & Sharjah)',
                        'description' => 'GoldMatrix revolutionized our 4 retail showrooms in the UAE. Live gold rate updates sync to all counters within seconds, and RFID tray audits are instant.',
                        'image'       => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&auto=format&fit=crop&q=80',
                        'extra'       => '5',
                        'badge'       => 'INTERNATIONAL RETAIL',
                        'sort_order'  => 4
                    ],
                    [
                        'title'       => 'Amitabh Shah',
                        'subtitle'    => 'Founder, Shah Bullion & Trading Co. (Mumbai)',
                        'description' => 'Handling multi-party bullion orders, metal settlement vouchers, and GST e-invoicing was our biggest bottleneck. GoldMatrix handles wholesale transactions flawlessly.',
                        'image'       => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&auto=format&fit=crop&q=80',
                        'extra'       => '5',
                        'badge'       => 'BULLION & WHOLESALE',
                        'sort_order'  => 5
                    ],
                    [
                        'title'       => 'Harish Patel',
                        'subtitle'    => 'Managing Partner, Patel Diamond Studio (Ahmedabad)',
                        'description' => 'Managing diamond 4Cs (cut, clarity, carat, color) alongside gold mounts was always messy. GoldMatrix handles certification numbers, center stones, and labor charges with ease.',
                        'image'       => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=150&auto=format&fit=crop&q=80',
                        'extra'       => '5',
                        'badge'       => 'DIAMOND & BRIDAL',
                        'sort_order'  => 6
                    ]
                ];
                foreach ($testis as $t) {
                    $this->db->query(
                        "INSERT INTO homepage_items (section, title, subtitle, description, image, extra, badge, sort_order, is_active) VALUES ('testimonials', ?, ?, ?, ?, ?, ?, ?, 1)",
                        [$t['title'], $t['subtitle'], $t['description'], $t['image'], $t['extra'], $t['badge'], $t['sort_order']]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedDefaultBrandLogos(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'brand_logos'");
            if ($count === 0) {
                $brands = [
                    ['title' => 'PC Jeweller', 'image' => '/assets/images/brands/pcjeweller.svg', 'link' => 'https://www.pcjeweller.com/', 'sort_order' => 1],
                    ['title' => 'Kalyan Jewellers', 'image' => '/assets/images/brands/kalyan.svg', 'link' => 'https://www.kalyanjewellers.net/', 'sort_order' => 2],
                    ['title' => 'Jos Alukkas', 'image' => '/assets/images/brands/josalukkas.svg', 'link' => 'https://www.josalukkas.com/', 'sort_order' => 3],
                    ['title' => 'Senco Gold & Diamonds', 'image' => '/assets/images/brands/senco.svg', 'link' => 'https://sencogoldanddiamonds.com/', 'sort_order' => 4],
                    ['title' => 'Tanishq (A TATA Product)', 'image' => '/assets/images/brands/tanishq.svg', 'link' => 'https://www.tanishq.co.in/', 'sort_order' => 5],
                    ['title' => 'Malabar Gold & Diamonds', 'image' => '/assets/images/brands/malabar.svg', 'link' => 'https://www.malabargoldanddiamonds.com/', 'sort_order' => 6],
                    ['title' => 'Joyalukkas', 'image' => '/assets/images/brands/joyalukkas.svg', 'link' => 'https://www.joyalukkas.in/', 'sort_order' => 7],
                    ['title' => 'TBZ The Original', 'image' => '/assets/images/brands/tbz.svg', 'link' => 'https://www.tbztheoriginal.com/', 'sort_order' => 8],
                    ['title' => 'PNG Jewellers', 'image' => '/assets/images/brands/png.svg', 'link' => 'https://www.pngjewellers.com/', 'sort_order' => 9],
                    ['title' => 'Bhima Jewellers', 'image' => '/assets/images/brands/bhima.svg', 'link' => 'https://www.bhimajewellers.com/', 'sort_order' => 10],
                ];
                foreach ($brands as $b) {
                    $this->db->query(
                        "INSERT INTO homepage_items (section, title, image, link, sort_order, is_active) VALUES ('brand_logos', ?, ?, ?, ?, 1)",
                        [$b['title'], $b['image'], $b['link'], $b['sort_order']]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedDefaultSolutionsCards(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'solutions_cards'");
            if ($count === 0) {
                $defaults = [
                    [
                        'badge'        => 'DIGITAL CATALOGUE & WHATSAPP',
                        'title'        => 'Interactive Jewellery Catalogue & 1-Click WhatsApp Sharing',
                        'description'  => 'Create stunning digital catalogues with real-time metal rates and weight calculations. Share product photos, item codes, and prices directly to your customer\'s WhatsApp with one click.',
                        'features'     => json_encode([
                            'Category-Wise Showcase (Gold, Diamond, Platinum, Silver)',
                            'Real-Time Metal Rate & Net Weight Calculation',
                            '1-Click Direct WhatsApp Share with Photo & Price',
                            'Instant Quotation & Customer Order Generation'
                        ], JSON_UNESCAPED_SLASHES),
                        'icon'         => 'bi-images',
                        'extra'        => 'bi-whatsapp',
                        'accent_color' => '#D97706',
                        'image'        => '/assets/images/digital-jewellery-catalogue.png',
                        'alt_text'     => 'GoldMatrix Premium Jewellery Digital Catalogue with WhatsApp Sharing',
                        'btn1_text'    => 'Explore Digital Catalogue',
                        'btn1_link'    => '/features',
                        'sort_order'   => 1
                    ],
                    [
                        'badge'        => 'MULTI-CURRENCY & BULLION',
                        'title'        => 'Live Bullion Rate Auto-Sync & Multi-Currency Billing',
                        'description'  => 'Auto-sync live market rates from Dubai Gold & Commodities Exchange (DGCX) and bullion boards. Bill seamlessly in AED, USD, SAR, and INR with zero counter errors.',
                        'features'     => json_encode([
                            'Auto-Sync Live Gold & Silver Market Feeds',
                            'Multi-Currency Invoicing (AED, USD, SAR, INR)',
                            'Automated Karat, Purity & Touch Calculation',
                            'Locked Counter Rates with Zero Manipulation'
                        ], JSON_UNESCAPED_SLASHES),
                        'icon'         => 'bi-currency-exchange',
                        'extra'        => 'bi-globe2',
                        'accent_color' => '#2563EB',
                        'image'        => '/assets/images/solution-wholesale-bullion.jpg',
                        'alt_text'     => 'Live Bullion Rate Auto-Sync & Multi-Currency Billing',
                        'btn1_text'    => 'Explore Multi-Currency',
                        'btn1_link'    => '/solutions/jewellery-wholesale',
                        'sort_order'   => 2
                    ],
                    [
                        'badge'        => 'HIGH-SPEED AUDIT',
                        'title'        => 'RFID Instant Vault & Tray Inventory Tally',
                        'description'  => 'Audit 10,000+ jewellery items across showroom trays and vaults in under 5 minutes. Detect missing items instantly with automated discrepancy alerts.',
                        'features'     => json_encode([
                            'Scan Entire Trays in 5 Seconds Flat',
                            '100% Real-Time Stock & Vault Tally',
                            'Zero Stock Leakage with Anti-Theft Alerts',
                            'Tamper-Evident RFID & Barcode Tracking'
                        ], JSON_UNESCAPED_SLASHES),
                        'icon'         => 'bi-upc-scan',
                        'extra'        => 'bi-shield-check',
                        'accent_color' => '#059669',
                        'image'        => '/assets/images/solution-manufacturing-craft.jpg',
                        'alt_text'     => 'RFID Instant Vault & Tray Inventory Audit',
                        'btn1_text'    => 'Explore RFID Audit',
                        'btn1_link'    => '/features',
                        'sort_order'   => 3
                    ],
                    [
                        'badge'        => '100% COMPLIANCE',
                        'title'        => 'UAE FTA VAT & International Hallmark Compliance',
                        'description'  => 'Pre-configured for UAE Federal Tax Authority (FTA) 5% VAT, Indian Tax e-Invoicing, and 1-click BIS Hallmark HUID verification for audit-proof operations.',
                        'features'     => json_encode([
                            '100% UAE FTA 5% VAT & Tax Invoicing',
                            '1-Click BIS Hallmark & HUID Verification',
                            'Customs Bullion Import & Export Documentation',
                            'Automated P&L, Balance Sheet & Day Book'
                        ], JSON_UNESCAPED_SLASHES),
                        'icon'         => 'bi-receipt-cutoff',
                        'extra'        => 'bi-award',
                        'accent_color' => '#7C3AED',
                        'image'        => '/assets/images/solution-retail-rings.jpg',
                        'alt_text'     => 'UAE FTA VAT & International Hallmark Compliance',
                        'btn1_text'    => 'Explore Compliance',
                        'btn1_link'    => '/solutions/jewellery-retail',
                        'sort_order'   => 4
                    ]
                ];

                foreach ($defaults as $item) {
                    $this->db->query(
                        "INSERT INTO homepage_items 
                            (section, badge, title, description, icon, accent_color, extra, features, btn1_text, btn1_link, image, alt_text, sort_order, is_active)
                         VALUES ('solutions_cards', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)",
                        [
                            $item['badge'], $item['title'], $item['description'], $item['icon'],
                            $item['accent_color'], $item['extra'], $item['features'], $item['btn1_text'],
                            $item['btn1_link'], $item['image'], $item['alt_text'], $item['sort_order']
                        ]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedDefaultMobileApp(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'mobile_app_cards'");
            if ($count === 0) {
                $cards = [
                    [
                        'title'       => 'Real-Time Stock & Inventory',
                        'description' => 'Track your complete jewellery stock, weight categories, and branch balances instantly on your smartphone.',
                        'icon'        => 'bi-box-seam-fill',
                        'image'       => '',
                        'link'        => '#contact',
                        'sort_order'  => 1
                    ],
                    [
                        'title'       => 'Mobile POS & Instant Billing',
                        'description' => 'Create GST invoices, calculate making charges, and generate estimates directly from your tablet or mobile.',
                        'icon'        => 'bi-receipt',
                        'image'       => '',
                        'link'        => '#contact',
                        'sort_order'  => 2
                    ],
                    [
                        'title'       => 'Digital Gold Saving Schemes',
                        'description' => 'Manage monthly customer kitty and advance booking schemes with automatic receipts and payment tracking.',
                        'icon'        => 'bi-piggy-bank-fill',
                        'image'       => '',
                        'link'        => '#contact',
                        'sort_order'  => 3
                    ],
                    [
                        'title'       => 'Live Gold & Silver Rates',
                        'description' => 'Display automatic real-time 22K/24K gold rates with custom showroom board pricing and push notifications.',
                        'icon'        => 'bi-graph-up-arrow',
                        'image'       => '',
                        'link'        => '#contact',
                        'sort_order'  => 4
                    ],
                    [
                        'title'       => 'Customer Digital Catalog',
                        'description' => 'Showcase your trending diamond rings, necklaces, and bridal sets to customers with custom price visibility.',
                        'icon'        => 'bi-gem',
                        'image'       => '',
                        'link'        => '#contact',
                        'sort_order'  => 5
                    ],
                    [
                        'title'       => 'Cloud Backup & 24/7 Support',
                        'description' => 'End-to-end encrypted cloud storage with automatic daily backups and round-the-clock priority assistance.',
                        'icon'        => 'bi-shield-check',
                        'image'       => '',
                        'link'        => '#contact',
                        'sort_order'  => 6
                    ]
                ];
                foreach ($cards as $c) {
                    $this->db->query(
                        "INSERT INTO homepage_items (section, title, description, icon, image, link, sort_order, is_active) VALUES ('mobile_app_cards', ?, ?, ?, ?, ?, ?, 1)",
                        [$c['title'], $c['description'], $c['icon'], $c['image'], $c['link'], $c['sort_order']]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedDefaultIntegrations(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'integrations'");
            if ($count === 0) {
                $defaults = [
                    [
                        'title'       => 'Shopify',
                        'description' => 'Sync products, orders, customers, and payments seamlessly in real time',
                        'icon'        => 'bi-shop',
                        'link'        => '#contact',
                        'image'       => 'https://cdn.worldvectorlogo.com/logos/shopify.svg',
                        'alt_text'    => 'Shopify Integration',
                        'sort_order'  => 1
                    ],
                    [
                        'title'       => 'WooCommerce',
                        'description' => 'Manage store data, orders, and inventory directly from WordPress',
                        'icon'        => 'bi-wordpress',
                        'link'        => '#contact',
                        'image'       => 'https://cdn.worldvectorlogo.com/logos/woocommerce.svg',
                        'alt_text'    => 'WooCommerce WordPress Integration',
                        'sort_order'  => 2
                    ],
                    [
                        'title'       => 'WhatsApp',
                        'description' => 'Enable instant customer communication and automated message workflows',
                        'icon'        => 'bi-whatsapp',
                        'link'        => '#contact',
                        'image'       => '/assets/images/integrations/whatsapp.svg',
                        'alt_text'    => 'WhatsApp Business Automation',
                        'sort_order'  => 3
                    ],
                    [
                        'title'       => 'Email & SMS',
                        'description' => 'Send transactional emails, alerts, and notifications with full tracking',
                        'icon'        => 'bi-envelope-at',
                        'link'        => '#contact',
                        'image'       => 'https://cdn-icons-png.flaticon.com/512/542/542689.png',
                        'alt_text'    => 'Transactional Email & SMS Alerts',
                        'sort_order'  => 4
                    ],
                    [
                        'title'       => 'Gmail',
                        'description' => 'Integrate Gmail to manage conversations and email automation centrally',
                        'icon'        => 'bi-google',
                        'link'        => '#contact',
                        'image'       => 'https://cdn.worldvectorlogo.com/logos/gmail-icon.svg',
                        'alt_text'    => 'Gmail & Google Workspace Integration',
                        'sort_order'  => 5
                    ],
                    [
                        'title'       => 'Authorize.Net',
                        'description' => 'Authorize.Net A Visa Solution - Secure payment gateway processing',
                        'icon'        => 'bi-credit-card-2-front',
                        'link'        => '#contact',
                        'image'       => 'https://cdn.worldvectorlogo.com/logos/authorize-net.svg',
                        'alt_text'    => 'Authorize.Net Visa Payment Solution',
                        'sort_order'  => 6
                    ],
                    [
                        'title'       => 'HID Global',
                        'description' => 'Integrate secure identity access and authentication hardware systems',
                        'icon'        => 'bi-shield-lock',
                        'link'        => '#contact',
                        'image'       => 'https://cdn.worldvectorlogo.com/logos/hid-global.svg',
                        'alt_text'    => 'HID Global Biometric & RFID Authentication',
                        'sort_order'  => 7
                    ],
                    [
                        'title'       => 'QuickBooks',
                        'description' => 'Automate accounting, invoices, expenses, and financial reporting',
                        'icon'        => 'bi-file-earmark-spreadsheet',
                        'link'        => '#contact',
                        'image'       => 'https://cdn.worldvectorlogo.com/logos/quickbooks.svg',
                        'alt_text'    => 'Intuit QuickBooks Accounting Integration',
                        'sort_order'  => 8
                    ],
                    [
                        'title'       => 'Chainway',
                        'description' => 'Connect barcode scanners and RFID devices for smart operations',
                        'icon'        => 'bi-upc-scan',
                        'link'        => '#contact',
                        'image'       => 'https://www.chainway.net/Public/Home/images/logo.png',
                        'alt_text'    => 'Chainway RFID & Barcode Readers',
                        'sort_order'  => 9
                    ],
                    [
                        'title'       => 'Planet Payment',
                        'description' => 'Accept global card payments with fast and reliable processing',
                        'icon'        => 'bi-globe',
                        'link'        => '#contact',
                        'image'       => 'https://cdn.worldvectorlogo.com/logos/planet-payment.svg',
                        'alt_text'    => 'Planet Global Card Payment Processing',
                        'sort_order'  => 10
                    ],
                    [
                        'title'       => 'E-Way Bill',
                        'description' => 'E-way Bill E-Way bill system is for GST registered person',
                        'icon'        => 'bi-truck',
                        'link'        => '#contact',
                        'image'       => 'https://einvoice1.gst.gov.in/Images/logo.png',
                        'alt_text'    => 'National E-Way Bill GST Portal System',
                        'sort_order'  => 11
                    ],
                    [
                        'title'       => 'E-Invoice',
                        'description' => 'E-invoice bill system is for GST registered person',
                        'icon'        => 'bi-file-earmark-check',
                        'link'        => '#contact',
                        'image'       => 'https://einvoice1.gst.gov.in/Images/logo.png',
                        'alt_text'    => 'GST E-Invoice System for Jewellery',
                        'sort_order'  => 12
                    ],
                    [
                        'title'       => 'AML Compliance',
                        'description' => 'Jewellery ERP like GoldMatrix can support AML compliance',
                        'icon'        => 'bi-shield-check',
                        'link'        => '#contact',
                        'image'       => 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png',
                        'alt_text'    => 'Anti-Money Laundering AML Compliance Support',
                        'sort_order'  => 13
                    ]
                ];

                foreach ($defaults as $item) {
                    $this->db->query(
                        "INSERT INTO homepage_items 
                            (section, title, description, icon, link, image, alt_text, sort_order, is_active)
                         VALUES ('integrations', ?, ?, ?, ?, ?, ?, ?, 1)",
                        [$item['title'], $item['description'], $item['icon'], $item['link'], $item['image'], $item['alt_text'], $item['sort_order']]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedDefaultPowerfulFeatures(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'powerful_features'");
            if ($count === 0) {
                $defaults = [
                    [
                        'title'       => 'Accounts Management',
                        'description' => 'Manage financial records, ledgers, payments, and reports with complete accuracy.',
                        'icon'        => 'bi-receipt-cutoff',
                        'link'        => '#contact',
                        'image'       => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=600&auto=format&fit=crop&q=80',
                        'alt_text'    => 'Accounts & Financial Management',
                        'sort_order'  => 1
                    ],
                    [
                        'title'       => 'Tax Calculation',
                        'description' => 'Automated tax calculations ensure compliance, accuracy, and faster billing processes.',
                        'icon'        => 'bi-calculator',
                        'link'        => '#contact',
                        'image'       => 'https://images.unsplash.com/photo-1586486855514-8c633cc6fd38?w=600&auto=format&fit=crop&q=80',
                        'alt_text'    => 'Tax Calculation & GST Compliance',
                        'sort_order'  => 2
                    ],
                    [
                        'title'       => 'Stock Management',
                        'description' => 'Track jewellery inventory in real time across stores and branches.',
                        'icon'        => 'bi-box-seam',
                        'link'        => '#contact',
                        'image'       => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=600&auto=format&fit=crop&q=80',
                        'alt_text'    => 'Real-time Stock & Inventory Management',
                        'sort_order'  => 3
                    ],
                    [
                        'title'       => 'Mobile Application',
                        'description' => 'Access business operations, reports, and inventory anytime using mobile application.',
                        'icon'        => 'bi-phone',
                        'link'        => '#contact',
                        'image'       => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=600&auto=format&fit=crop&q=80',
                        'alt_text'    => 'Mobile Application for Jewellers',
                        'sort_order'  => 4
                    ],
                    [
                        'title'       => 'QR & Barcode Creation',
                        'description' => 'Generate QR codes and barcodes for fast, accurate item identification.',
                        'icon'        => 'bi-qr-code-scan',
                        'link'        => '#contact',
                        'image'       => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600&auto=format&fit=crop&q=80',
                        'alt_text'    => 'QR & Barcode Tagging for Jewellery',
                        'sort_order'  => 5
                    ]
                ];

                foreach ($defaults as $item) {
                    $this->db->query(
                        "INSERT INTO homepage_items 
                            (section, title, description, icon, link, image, alt_text, sort_order, is_active)
                         VALUES ('powerful_features', ?, ?, ?, ?, ?, ?, ?, 1)",
                        [$item['title'], $item['description'], $item['icon'], $item['link'], $item['image'], $item['alt_text'], $item['sort_order']]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedDefaultSlidingCountries(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'sliding_countries'");
            if ($count === 0) {
                $defaults = [
                    ['title' => 'UAE',           'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/imgi_57_United-Arab-Emirates.png', 'sort_order' => 1],
                    ['title' => 'United States', 'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/imgi_58_United-States.png',       'sort_order' => 2],
                    ['title' => 'Indonesia',     'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/pngegg-1.png',                     'sort_order' => 3],
                    ['title' => 'Malaysia',      'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/pngtree-malaysia-flag-map-region-png-image_10768067.png', 'sort_order' => 4],
                    ['title' => 'Mexico',        'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/imgi_61_Mexico.png',             'sort_order' => 5],
                    ['title' => 'Italy',         'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/imgi_62_Italy.png',              'sort_order' => 6],
                    ['title' => 'Spain',         'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/imgi_63_spain.png',              'sort_order' => 7],
                    ['title' => 'India',         'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/imgi_54_india01.png',            'sort_order' => 8],
                    ['title' => 'Thailand',      'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/imgi_55_thailand.png',           'sort_order' => 9],
                    ['title' => 'Hong Kong',     'image' => 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/imgi_56_HK.png',                 'sort_order' => 10],
                ];
                foreach ($defaults as $d) {
                    $this->db->query(
                        "INSERT INTO homepage_items (section, title, image, sort_order, is_active) VALUES ('sliding_countries', ?, ?, ?, 1)",
                        [$d['title'], $d['image'], $d['sort_order']]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedDefaultSpotlightFeatures(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'feature_spotlight'");
            if ($count === 0) {
                $defaults = [
                    [
                        'title'       => 'Retails & Showrooms',
                        'subtitle'    => 'Simplify Jewellery Retail and Showroom Operations',
                        'description' => 'GoldMatrix Jewellery Software is built to support the day-to-day operations of jewellery retail stores and showrooms. It helps businesses maintain control over stock, sales, and customer transactions while ensuring smooth and efficient store management.',
                        'features'    => json_encode([
                            'Track inventory in real time, including available, reserved, and pending items',
                            'Maintain optimal stock levels using smart reorder alerts',
                            'Automate routine processes for sales, purchases, and returns',
                            'Generate barcodes and design custom price tags and labels effortlessly'
                        ]),
                        'alt_text'    => 'Jewellery Retail & Showroom Software Interface',
                        'image'       => '/uploads/homepage/hp_6a9207ee140eb.png',
                        'sort_order'  => 1
                    ],
                    [
                        'title'       => "Manufacturer's",
                        'subtitle'    => 'Improve Productivity with Jewellery Manufacturing Software',
                        'description' => 'GoldMatrix Manufacturing Software is designed to support jewellery manufacturers by simplifying production management and improving operational control. It helps businesses plan, track, and optimize manufacturing activities while maintaining accuracy and cost efficiency.',
                        'features'    => json_encode([
                            'Plan and manage production jobs with clear task assignments',
                            'Support batch-based manufacturing for better efficiency',
                            'Calculate accurate production costs and track finished goods sales',
                            'Monitor work-in-progress inventory at every stage'
                        ]),
                        'alt_text'    => 'Jewellery Manufacturing & Production Dashboard',
                        'image'       => '/uploads/homepage/hp_6a92088a510d9.png',
                        'sort_order'  => 2
                    ],
                    [
                        'title'       => 'Girvi ( Mortgage)',
                        'subtitle'    => 'Streamline Gold Loan & Girvi Operations with Automated Interest',
                        'description' => 'GoldMatrix Girvi (Mortgage) Software provides a secure, reliable pawn broking and gold loan system built specifically for jewellery businesses. Calculate daily, monthly, or compounding interest accurately, issue legal pledge receipts, and maintain safe vault management.',
                        'features'    => json_encode([
                            'Automate daily, monthly, and compounding interest calculations with penalty rules',
                            'Instant Girvi pawn receipt, pledge token, and legal agreement printing with customer photo',
                            'Real-time valuation of gold and silver ornaments based on live market rates and tested purity',
                            'Automated WhatsApp and SMS payment reminders, interest notices, and settlement tracking'
                        ]),
                        'alt_text'    => 'Girvi Mortgage & Gold Loan Software Interface',
                        'image'       => '',
                        'sort_order'  => 3
                    ],
                    [
                        'title'       => 'CRM',
                        'subtitle'    => 'Jewellery Customer Relationship Management & Loyalty Schemes',
                        'description' => 'GoldMatrix Jewellery CRM Software helps retail jewellers nurture customer relationships, increase repeat showroom visits, and boost customer lifetime value. Seamlessly manage 11+1 monthly gold savings schemes, automated festive wishes, and personalized WhatsApp catalogs.',
                        'features'    => json_encode([
                            '360° customer profile with lifetime purchase history, design preferences, and ring sizes',
                            'Manage monthly gold savings schemes (Swarna Nidhi / 11+1 BC) with digital passbooks',
                            'Automated personalized WhatsApp greetings for birthdays, anniversaries, and festival promotions',
                            'Tiered customer loyalty reward points program with VIP discounts and referral bonus incentives'
                        ]),
                        'alt_text'    => 'Jewellery CRM & Customer Loyalty Software Interface',
                        'image'       => '',
                        'sort_order'  => 4
                    ]
                ];

                foreach ($defaults as $d) {
                    $this->db->query(
                        "INSERT INTO homepage_items
                            (section, title, subtitle, description, features, alt_text, image, sort_order, is_active)
                         VALUES ('feature_spotlight', ?, ?, ?, ?, ?, ?, ?, 1)",
                        [$d['title'], $d['subtitle'], $d['description'], $d['features'], $d['alt_text'], $d['image'], $d['sort_order']]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedDefaultShowcaseFeatures(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'feature_showcase'");
            if ($count === 0) {
                $defaults = [
                    [
                        'title'        => 'Transaction Reports',
                        'subtitle'     => 'Gain Complete Financial Clarity',
                        'description'  => 'Track all your financial transactions with detailed reports and real-time analytics.',
                        'icon'         => 'bi-bar-chart-fill',
                        'accent_color' => '#DC9423',
                        'alt_text'     => 'Transaction Reports Dashboard',
                        'btn1_text'    => 'Explore Reports',
                        'btn1_link'    => '#contact',
                        'features'     => json_encode([
                            ['title' => 'Real-time Analytics', 'desc' => 'Live transaction tracking', 'icon' => 'bi-graph-up-arrow'],
                            ['title' => 'Export Reports',      'desc' => 'Download in multiple formats', 'icon' => 'bi-download'],
                            ['title' => 'Smart Filters',       'desc' => 'Find data quickly', 'icon' => 'bi-funnel']
                        ]),
                        'sort_order'   => 1
                    ],
                    [
                        'title'        => 'Manage Your Profile',
                        'subtitle'     => 'Business & Account Control',
                        'description'  => 'Keep your business profile updated with easy management and quick access.',
                        'icon'         => 'bi-person-fill',
                        'accent_color' => '#8B5CF6',
                        'alt_text'     => 'Manage Business Profile',
                        'btn1_text'    => 'Learn More',
                        'btn1_link'    => '#contact',
                        'features'     => json_encode([
                            ['title' => 'Easy Updates', 'desc' => 'Modify info anytime', 'icon' => 'bi-pencil-square'],
                            ['title' => 'Secure & Safe', 'desc' => 'Your data is protected', 'icon' => 'bi-shield-check'],
                            ['title' => 'Quick Access', 'desc' => 'Everything at one place', 'icon' => 'bi-search']
                        ]),
                        'sort_order'   => 2
                    ]
                ];

                foreach ($defaults as $item) {
                    $this->db->query(
                        "INSERT INTO homepage_items 
                            (section, title, subtitle, description, icon, accent_color, alt_text, btn1_text, btn1_link, features, sort_order, is_active)
                         VALUES ('feature_showcase', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)",
                        [
                            $item['title'], $item['subtitle'], $item['description'], $item['icon'],
                            $item['accent_color'], $item['alt_text'], $item['btn1_text'], $item['btn1_link'],
                            $item['features'], $item['sort_order']
                        ]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    private function seedDefaultHeroSlides(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'hero_slides'");
            if ($count === 0) {
                $defaultSlides = [
                    [
                        'badge'       => 'ALL-IN-ONE JEWELLERY ERP',
                        'title'       => 'The Complete Jewellery ERP Built to Run Your Business.',
                        'description' => 'Manage inventory, sales, manufacturing, accounting, POS, CRM, wholesale and multi-branch operations from one powerful platform.',
                        'features'    => json_encode(['Cloud Based', 'Multi Branch', 'Real-time Data', 'Secure & Scalable']),
                        'btn1_text'   => 'Book a Free Demo',
                        'btn1_link'   => '#contact',
                        'btn2_text'   => 'Start 7-Day Free Trial',
                        'btn2_link'   => '#contact',
                        'alt_text'    => 'GoldMatrix Jewellery ERP Dashboard',
                        'sort_order'  => 1
                    ],
                    [
                        'badge'       => 'RETAIL & SHOWROOM POS',
                        'title'       => 'Jewellery POS Software for Modern Retail Showrooms.',
                        'description' => 'High-speed billing, barcode scanning, old gold exchange, advance booking, and automated GST invoices in seconds.',
                        'features'    => json_encode(['Fast Billing', 'Old Gold Exchange', 'Barcode & RFID', 'GST Invoices']),
                        'btn1_text'   => 'Explore POS Features',
                        'btn1_link'   => '#features',
                        'btn2_text'   => 'Request Demo',
                        'btn2_link'   => '#contact',
                        'alt_text'    => 'Jewellery POS Software Showcase',
                        'sort_order'  => 2
                    ],
                    [
                        'badge'       => 'FACTORY & WORKSHOP',
                        'title'       => 'Jewellery Manufacturing & Karigar Management ERP.',
                        'description' => 'Track metal loss, daily issue/receipt, work-in-progress orders, melting purity, and artisan ledger with zero leakage.',
                        'features'    => json_encode(['Metal Loss Tracking', 'Karigar Ledger', 'WIP Job Cards', 'Purity Control']),
                        'btn1_text'   => 'See Manufacturing ERP',
                        'btn1_link'   => '#modules',
                        'btn2_text'   => 'Book a Demo',
                        'btn2_link'   => '#contact',
                        'alt_text'    => 'Jewellery Manufacturing ERP',
                        'sort_order'  => 3
                    ],
                    [
                        'badge'       => 'ACCURATE STOCK CONTROL',
                        'title'       => 'Inventory & RFID Stock Management Solution.',
                        'description' => 'Count 10,000+ jewellery items in 5 minutes with RFID scanners. Real-time gross/net weight calculation and vault audit.',
                        'features'    => json_encode(['RFID 5-Min Audit', 'Gross & Net Weight', 'Multi-Vault Sync', 'Stock Alerts']),
                        'btn1_text'   => 'Discover RFID System',
                        'btn1_link'   => '#solutions',
                        'btn2_text'   => 'Get Free Trial',
                        'btn2_link'   => '#contact',
                        'alt_text'    => 'Inventory & Stock Management',
                        'sort_order'  => 4
                    ]
                ];

                foreach ($defaultSlides as $s) {
                    $this->db->query(
                        "INSERT INTO homepage_items 
                            (section, badge, title, description, features, btn1_text, btn1_link, btn2_text, btn2_link, alt_text, sort_order, is_active)
                         VALUES ('hero_slides', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)",
                        [
                            $s['badge'], $s['title'], $s['description'], $s['features'],
                            $s['btn1_text'], $s['btn1_link'], $s['btn2_text'], $s['btn2_link'],
                            $s['alt_text'], $s['sort_order']
                        ]
                    );
                }
            }
        } catch (\Throwable $e) {}
    }

    /* ─────────────────────────────────────────────────
     *  HELPERS
     * ───────────────────────────────────────────────── */
    private function hp(string $key, string $default = ''): string {
        try {
            $row = $this->db->fetch(
                "SELECT value FROM homepage_sections WHERE section_key = ?",
                [$key]
            );
            return ($row && $row['value'] !== null) ? $row['value'] : $default;
        } catch (\Exception $e) {
            return $default;
        }
    }

    private function setHP(string $key, string $value): void {
        $existing = $this->db->fetch(
            "SELECT id FROM homepage_sections WHERE section_key = ?",
            [$key]
        );
        if ($existing) {
            $this->db->query(
                "UPDATE homepage_sections SET value = ?, updated_at = CURRENT_TIMESTAMP WHERE section_key = ?",
                [$value, $key]
            );
        } else {
            $this->db->query(
                "INSERT INTO homepage_sections (section_key, value) VALUES (?, ?)",
                [$key, $value]
            );
        }
    }

    private function hpItems(string $section): array {
        try {
            return $this->db->fetchAll(
                "SELECT * FROM homepage_items WHERE section = ? AND is_active = 1 ORDER BY sort_order ASC",
                [$section]
            ) ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function allHeroSlides(): array {
        try {
            return $this->db->fetchAll(
                "SELECT * FROM homepage_items WHERE section = 'hero_slides' ORDER BY sort_order ASC, id ASC"
            ) ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function allAwards(): array {
        try {
            return $this->db->fetchAll(
                "SELECT * FROM homepage_items WHERE section = 'awards' ORDER BY sort_order ASC, id ASC"
            ) ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function seedDefaultAwards(): void {
        try {
            $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM homepage_items WHERE section = 'awards'");
            if ($count === 0) {
                $awards = [
                    [
                        'title'       => 'High Performer',
                        'subtitle'    => 'Winter 2023',
                        'badge'       => 'SoftwareSuggest',
                        'description' => 'SoftwareSuggest High Performer Award Winter 2023',
                        'image'       => '/assets/images/awards/award-high-performer.svg',
                        'sort_order'  => 1
                    ],
                    [
                        'title'       => 'Customers Choice',
                        'subtitle'    => 'Summer 2022',
                        'badge'       => 'SoftwareSuggest',
                        'description' => 'SoftwareSuggest Customers Choice Award Summer 2022',
                        'image'       => '/assets/images/awards/award-customers-choice.svg',
                        'sort_order'  => 2
                    ],
                    [
                        'title'       => 'Best Usability',
                        'subtitle'    => '2021',
                        'badge'       => 'SoftwareSuggest',
                        'description' => 'SoftwareSuggest Best Usability Award 2021',
                        'image'       => '/assets/images/awards/award-best-usability.svg',
                        'sort_order'  => 3
                    ],
                    [
                        'title'       => 'Best Support',
                        'subtitle'    => '2021',
                        'badge'       => 'SoftwareSuggest',
                        'description' => 'SoftwareSuggest Best Support Award 2021',
                        'image'       => '/assets/images/awards/award-best-support.svg',
                        'sort_order'  => 4
                    ],
                    [
                        'title'       => 'Most Popular',
                        'subtitle'    => 'Fall 2020',
                        'badge'       => 'SoftwareSuggest',
                        'description' => 'SoftwareSuggest Most Popular Award Fall 2020',
                        'image'       => '/assets/images/awards/award-most-popular.svg',
                        'sort_order'  => 5
                    ]
                ];
                foreach ($awards as $a) {
                    $this->db->query(
                        "INSERT INTO homepage_items (section, title, subtitle, badge, description, image, sort_order, is_active)
                         VALUES ('awards', ?, ?, ?, ?, ?, ?, 1)",
                        [$a['title'], $a['subtitle'], $a['badge'], $a['description'], $a['image'], $a['sort_order']]
                    );
                }
            }
        } catch (\Exception $e) {}
    }

    private function handleImageUpload(string $field = 'image'): string {
        return secure_upload_image($field, 'homepage', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']) ?? '';
    }

    public function testimonials(): void {
        if (!isset($_GET['tab'])) {
            $_GET['tab'] = 'testimonials';
        }
        $this->index();
    }

    public function faqs(): void {
        if (!isset($_GET['tab'])) {
            $_GET['tab'] = 'faqs';
        }
        $this->index();
    }

    public function team(): void {
        if (!isset($_GET['tab'])) {
            $_GET['tab'] = 'team';
        }
        $this->index();
    }

    /* ─────────────────────────────────────────────────
     *  MAIN CONTROLLER INDEX
     * ───────────────────────────────────────────────── */
    public function index(): void {
        $activeTab = $_GET['tab'] ?? 'hero';

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $action = $_POST['action'] ?? '';

            /* ── SAVE TEXT SETTINGS ── */
            if ($action === 'save_settings') {
                foreach ($_POST as $key => $val) {
                    if (in_array($key, ['action', 'section', 'csrf_token', 'remove_hero_image'])) continue;
                    $cleanVal = trim((string)$val);
                    $this->setHP($key, $cleanVal);
                    try {
                        $exists = $this->db->fetch("SELECT 1 FROM settings WHERE setting_key = ?", [$key]);
                        if ($exists) {
                            $this->db->query("UPDATE settings SET setting_value = ? WHERE setting_key = ?", [$cleanVal, $key]);
                        } else {
                            $this->db->query("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)", [$key, $cleanVal]);
                        }
                    } catch (\Throwable $t) {}
                }

                // Remove image if requested
                if (!empty($_POST['remove_hero_image'])) {
                    $this->setHP('hero_image', '');
                }

                // Handle file uploads
                if (!empty($_FILES)) {
                    foreach ($_FILES as $field => $fileData) {
                        if (!empty($fileData['name'])) {
                            $uploaded = $this->handleImageUpload($field);
                            if ($uploaded) {
                                $this->setHP($field, $uploaded);
                            }
                        }
                    }
                }

                set_flash('success', '✅ Hero banner & settings saved successfully!');
                redirect('/admin/homepage?tab=' . urlencode($activeTab));
                return;
            }

            /* ── ADD HERO SLIDE ── */
            if ($action === 'add_slide') {
                $badge       = strip_tags(trim($_POST['badge'] ?? ''));
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $desc        = strip_tags(trim($_POST['description'] ?? ''));
                $accentColor = strip_tags(trim($_POST['accent_color'] ?? '#F59E0B'));
                $btn1Text    = strip_tags(trim($_POST['btn1_text'] ?? ''));
                $btn1Link    = strip_tags(trim($_POST['btn1_link'] ?? '#contact'));
                $btn2Text    = strip_tags(trim($_POST['btn2_text'] ?? ''));
                $btn2Link    = strip_tags(trim($_POST['btn2_link'] ?? '#contact'));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);

                // Collect feature points
                $rawFeatures = $_POST['features'] ?? [];
                $featuresArr = [];
                if (is_array($rawFeatures)) {
                    foreach ($rawFeatures as $f) {
                        $f = strip_tags(trim((string)$f));
                        if ($f !== '') $featuresArr[] = $f;
                    }
                }
                $featuresJson = json_encode($featuresArr);

                // Upload images
                $desktopImg = $this->handleImageUpload('image');
                $mobileImg  = $this->handleImageUpload('mobile_image');

                if ($sortOrder === 0) {
                    $sortOrder = (int)$this->db->fetchColumn(
                        "SELECT COALESCE(MAX(sort_order), 0) + 1 FROM homepage_items WHERE section = 'hero_slides'"
                    );
                }

                $this->db->query(
                    "INSERT INTO homepage_items
                        (section, badge, title, description, features, accent_color, btn1_text, btn1_link, btn2_text, btn2_link, alt_text, image, mobile_image, sort_order, is_active)
                     VALUES ('hero_slides', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                    [$badge, $title, $desc, $featuresJson, $accentColor, $btn1Text, $btn1Link, $btn2Text, $btn2Link, $altText, $desktopImg, $mobileImg, $sortOrder, $isActive]
                );

                set_flash('success', '✅ Hero slide added successfully!');
                redirect('/admin/homepage?tab=hero');
                return;
            }

            /* ── UPDATE HERO SLIDE ── */
            if ($action === 'update_slide') {
                $id          = (int)($_POST['slide_id'] ?? 0);
                $badge       = strip_tags(trim($_POST['badge'] ?? ''));
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $desc        = strip_tags(trim($_POST['description'] ?? ''));
                $accentColor = strip_tags(trim($_POST['accent_color'] ?? '#F59E0B'));
                $btn1Text    = strip_tags(trim($_POST['btn1_text'] ?? ''));
                $btn1Link    = strip_tags(trim($_POST['btn1_link'] ?? '#contact'));
                $btn2Text    = strip_tags(trim($_POST['btn2_text'] ?? ''));
                $btn2Link    = strip_tags(trim($_POST['btn2_link'] ?? '#contact'));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);

                $rawFeatures = $_POST['features'] ?? [];
                $featuresArr = [];
                if (is_array($rawFeatures)) {
                    foreach ($rawFeatures as $f) {
                        $f = strip_tags(trim((string)$f));
                        if ($f !== '') $featuresArr[] = $f;
                    }
                }
                $featuresJson = json_encode($featuresArr);

                $this->db->query(
                    "UPDATE homepage_items SET 
                        badge = ?, title = ?, description = ?, features = ?, accent_color = ?,
                        btn1_text = ?, btn1_link = ?, btn2_text = ?, btn2_link = ?, 
                        alt_text = ?, sort_order = ?, is_active = ?
                     WHERE id = ? AND section = 'hero_slides'",
                    [$badge, $title, $desc, $featuresJson, $accentColor, $btn1Text, $btn1Link, $btn2Text, $btn2Link, $altText, $sortOrder, $isActive, $id]
                );

                // Handle desktop image
                if (!empty($_POST['remove_desktop_image'])) {
                    $this->db->query("UPDATE homepage_items SET image = '' WHERE id = ?", [$id]);
                } else {
                    $newDesktop = $this->handleImageUpload('image');
                    if ($newDesktop) {
                        $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ?", [$newDesktop, $id]);
                    }
                }

                // Handle mobile image
                if (!empty($_POST['remove_mobile_image'])) {
                    $this->db->query("UPDATE homepage_items SET mobile_image = '' WHERE id = ?", [$id]);
                } else {
                    $newMobile = $this->handleImageUpload('mobile_image');
                    if ($newMobile) {
                        $this->db->query("UPDATE homepage_items SET mobile_image = ? WHERE id = ?", [$newMobile, $id]);
                    }
                }

                set_flash('success', '✅ Hero slide updated successfully!');
                redirect('/admin/homepage?tab=hero');
                return;
            }

            /* ── REMOVE SLIDE IMAGE QUICK ACTION ── */
            if ($action === 'remove_slide_image') {
                $id = (int)($_POST['slide_id'] ?? 0);
                $target = $_POST['target'] ?? 'desktop';
                if ($target === 'mobile') {
                    $this->db->query("UPDATE homepage_items SET mobile_image = '' WHERE id = ? AND section = 'hero_slides'", [$id]);
                } else {
                    $this->db->query("UPDATE homepage_items SET image = '' WHERE id = ? AND section = 'hero_slides'", [$id]);
                }
                set_flash('success', '🗑️ Slide image removed successfully.');
                redirect('/admin/homepage?tab=hero');
                return;
            }

            /* ── DUPLICATE HERO SLIDE ── */
            if ($action === 'duplicate_slide') {
                $id = (int)($_POST['slide_id'] ?? 0);
                $slide = $this->db->fetch("SELECT * FROM homepage_items WHERE id = ? AND section = 'hero_slides'", [$id]);
                if ($slide) {
                    $maxSort = (int)$this->db->fetchColumn("SELECT COALESCE(MAX(sort_order), 0) + 1 FROM homepage_items WHERE section = 'hero_slides'");
                    $this->db->query(
                        "INSERT INTO homepage_items
                            (section, badge, title, description, features, accent_color, btn1_text, btn1_link, btn2_text, btn2_link, alt_text, image, mobile_image, sort_order, is_active)
                         VALUES ('hero_slides', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                        [
                            $slide['badge'],
                            'Copy of ' . $slide['title'],
                            $slide['description'],
                            $slide['features'],
                            $slide['accent_color'] ?? '#F59E0B',
                            $slide['btn1_text'],
                            $slide['btn1_link'],
                            $slide['btn2_text'],
                            $slide['btn2_link'],
                            $slide['alt_text'],
                            $slide['image'],
                            $slide['mobile_image'],
                            $maxSort,
                            $slide['is_active']
                        ]
                    );
                    set_flash('success', '📋 Slide duplicated successfully!');
                }
                redirect('/admin/homepage?tab=hero');
                return;
            }

            /* ── DELETE HERO SLIDE ── */
            if ($action === 'delete_slide') {
                $id = (int)($_POST['slide_id'] ?? 0);
                $this->db->query("DELETE FROM homepage_items WHERE id = ? AND section = 'hero_slides'", [$id]);
                set_flash('success', '🗑️ Slide deleted successfully.');
                redirect('/admin/homepage?tab=hero');
                return;
            }

            /* ── TOGGLE HERO SLIDE ── */
            if ($action === 'toggle_slide') {
                $id = (int)($_POST['slide_id'] ?? 0);
                $cur = (int)$this->db->fetchColumn("SELECT is_active FROM homepage_items WHERE id = ? AND section = 'hero_slides'", [$id]);
                $this->db->query("UPDATE homepage_items SET is_active = ? WHERE id = ?", [$cur ? 0 : 1, $id]);
                set_flash('success', $cur ? 'Slide disabled.' : 'Slide enabled.');
                redirect('/admin/homepage?tab=hero');
                return;
            }

            /* ── ADD SOLUTION CARD ── */
            if ($action === 'add_solution_card') {
                $badge       = strip_tags(trim($_POST['badge'] ?? ''));
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $desc        = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-shop'));
                $extra       = strip_tags(trim($_POST['extra'] ?? 'bi-gem'));
                $accentColor = strip_tags(trim($_POST['accent_color'] ?? '#D97706'));
                $btn1Text    = strip_tags(trim($_POST['btn1_text'] ?? 'Explore Solution'));
                $btn1Link    = strip_tags(trim($_POST['btn1_link'] ?? '#'));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? $title));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $rawFeatures = $_POST['features'] ?? [];
                $featuresArr = [];
                if (is_array($rawFeatures)) {
                    foreach ($rawFeatures as $f) {
                        $f = strip_tags(trim((string)$f));
                        if ($f !== '') $featuresArr[] = $f;
                    }
                } elseif (is_string($rawFeatures)) {
                    $lines = explode("\n", $rawFeatures);
                    foreach ($lines as $line) {
                        $line = trim($line);
                        if ($line !== '') $featuresArr[] = $line;
                    }
                }
                $featuresJson = json_encode($featuresArr);

                $image = $this->handleImageUpload('image');
                if (empty($image) && !empty($_POST['image_url'])) {
                    $image = strip_tags(trim($_POST['image_url']));
                }

                $this->db->query(
                    "INSERT INTO homepage_items 
                        (section, badge, title, description, icon, extra, accent_color, features, btn1_text, btn1_link, image, alt_text, sort_order, is_active)
                     VALUES ('solutions_cards', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                    [$badge, $title, $desc, $icon, $extra, $accentColor, $featuresJson, $btn1Text, $btn1Link, $image, $altText, $sortOrder, $isActive]
                );

                set_flash('success', '✅ Business Solution card added successfully!');
                redirect('/admin/homepage?tab=solutions');
                return;
            }

            /* ── EDIT SOLUTION CARD ── */
            if ($action === 'edit_solution_card') {
                $id          = (int)($_POST['item_id'] ?? 0);
                $badge       = strip_tags(trim($_POST['badge'] ?? ''));
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $desc        = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-shop'));
                $extra       = strip_tags(trim($_POST['extra'] ?? 'bi-gem'));
                $accentColor = strip_tags(trim($_POST['accent_color'] ?? '#D97706'));
                $btn1Text    = strip_tags(trim($_POST['btn1_text'] ?? 'Explore Solution'));
                $btn1Link    = strip_tags(trim($_POST['btn1_link'] ?? '#'));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? $title));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $rawFeatures = $_POST['features'] ?? [];
                $featuresArr = [];
                if (is_array($rawFeatures)) {
                    foreach ($rawFeatures as $f) {
                        $f = strip_tags(trim((string)$f));
                        if ($f !== '') $featuresArr[] = $f;
                    }
                } elseif (is_string($rawFeatures)) {
                    $lines = explode("\n", $rawFeatures);
                    foreach ($lines as $line) {
                        $line = trim($line);
                        if ($line !== '') $featuresArr[] = $line;
                    }
                }
                $featuresJson = json_encode($featuresArr);

                $image = $this->handleImageUpload('image');
                if (empty($image) && !empty($_POST['image_url'])) {
                    $image = strip_tags(trim($_POST['image_url']));
                }

                if ($image) {
                    $this->db->query(
                        "UPDATE homepage_items SET 
                            badge = ?, title = ?, description = ?, icon = ?, extra = ?, accent_color = ?,
                            features = ?, btn1_text = ?, btn1_link = ?, image = ?, alt_text = ?, sort_order = ?, is_active = ?
                         WHERE id = ? AND section = 'solutions_cards'",
                        [$badge, $title, $desc, $icon, $extra, $accentColor, $featuresJson, $btn1Text, $btn1Link, $image, $altText, $sortOrder, $isActive, $id]
                    );
                } else {
                    $this->db->query(
                        "UPDATE homepage_items SET 
                            badge = ?, title = ?, description = ?, icon = ?, extra = ?, accent_color = ?,
                            features = ?, btn1_text = ?, btn1_link = ?, alt_text = ?, sort_order = ?, is_active = ?
                         WHERE id = ? AND section = 'solutions_cards'",
                        [$badge, $title, $desc, $icon, $extra, $accentColor, $featuresJson, $btn1Text, $btn1Link, $altText, $sortOrder, $isActive, $id]
                    );
                }

                set_flash('success', '✅ Business Solution card updated successfully!');
                redirect('/admin/homepage?tab=solutions');
                return;
            }

            /* ── ADD ITEM ── */
            if ($action === 'add_item') {
                $section  = strip_tags(trim($_POST['section'] ?? ''));
                $title    = strip_tags(trim($_POST['title'] ?? ''));
                $sub      = strip_tags(trim($_POST['subtitle'] ?? ''));
                $desc     = strip_tags(trim($_POST['description'] ?? ''));
                $icon     = strip_tags(trim($_POST['icon'] ?? ''));
                $link     = strip_tags(trim($_POST['link'] ?? ''));
                $badge    = strip_tags(trim($_POST['badge'] ?? ''));
                $extra    = strip_tags(trim($_POST['extra'] ?? ''));
                $image    = $this->handleImageUpload('image');

                $maxSort = (int)$this->db->fetchColumn(
                    "SELECT COALESCE(MAX(sort_order), 0) + 1 FROM homepage_items WHERE section = ?",
                    [$section]
                );

                $this->db->query(
                    "INSERT INTO homepage_items
                        (section, title, subtitle, description, icon, link, image, badge, extra, sort_order)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                    [$section, $title, $sub, $desc, $icon, $link, $image, $badge, $extra, $maxSort]
                );

                set_flash('success', '✅ Item added!');
                redirect('/admin/homepage?tab=' . urlencode($section));
                return;
            }

            /* ── UPDATE ITEM ── */
            if ($action === 'update_item') {
                $id       = (int)($_POST['item_id'] ?? 0);
                $section  = strip_tags(trim($_POST['section'] ?? ''));
                $title    = strip_tags(trim($_POST['title'] ?? ''));
                $sub      = strip_tags(trim($_POST['subtitle'] ?? ''));
                $desc     = strip_tags(trim($_POST['description'] ?? ''));
                $icon     = strip_tags(trim($_POST['icon'] ?? ''));
                $link     = strip_tags(trim($_POST['link'] ?? ''));
                $badge    = strip_tags(trim($_POST['badge'] ?? ''));
                $extra    = isset($_POST['extra']) ? strip_tags(trim($_POST['extra'])) : '';
                $sort     = (int)($_POST['sort_order'] ?? 0);
                $active   = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $image = $this->handleImageUpload('image');
                if (empty($image) && !empty($_POST['image_url'])) {
                    $image = strip_tags(trim($_POST['image_url']));
                }

                if ($image) {
                    $this->db->query(
                        "UPDATE homepage_items SET title = ?, subtitle = ?, description = ?, icon = ?, link = ?, badge = ?, extra = ?, image = ?, sort_order = ?, is_active = ? WHERE id = ?",
                        [$title, $sub, $desc, $icon, $link, $badge, $extra, $image, $sort, $active, $id]
                    );
                } else {
                    $this->db->query(
                        "UPDATE homepage_items SET title = ?, subtitle = ?, description = ?, icon = ?, link = ?, badge = ?, extra = ?, sort_order = ?, is_active = ? WHERE id = ?",
                        [$title, $sub, $desc, $icon, $link, $badge, $extra, $sort, $active, $id]
                    );
                }

                set_flash('success', '✅ Item updated successfully!');
                redirect('/admin/homepage?tab=' . urlencode($section));
                return;
            }

            /* ── DELETE ITEM ── */
            if ($action === 'delete_item') {
                $id      = (int)($_POST['item_id'] ?? 0);
                $section = strip_tags(trim($_POST['section'] ?? ''));
                $this->db->query("DELETE FROM homepage_items WHERE id = ?", [$id]);
                set_flash('success', '🗑️ Item deleted.');
                redirect('/admin/homepage?tab=' . urlencode($section));
                return;
            }

            /* ── TOGGLE ITEM ACTIVE ── */
            if ($action === 'toggle_item') {
                $id  = (int)($_POST['item_id'] ?? 0);
                $cur = (int)$this->db->fetchColumn("SELECT is_active FROM homepage_items WHERE id = ?", [$id]);
                $this->db->query("UPDATE homepage_items SET is_active = ? WHERE id = ?", [$cur ? 0 : 1, $id]);
                header('Content-Type: application/json');
                echo json_encode(['status' => 'ok', 'is_active' => !$cur]);
                exit;
            }

            /* ── UPDATE ITEM (AJAX inline edit) ── */
            if ($action === 'update_item') {
                $id = (int)($_POST['item_id'] ?? 0);
                foreach (['title','subtitle','description','icon','link','badge','extra'] as $f) {
                    if (isset($_POST[$f])) {
                        $this->db->query(
                            "UPDATE homepage_items SET $f = ? WHERE id = ?",
                            [strip_tags(trim($_POST[$f])), $id]
                        );
                    }
                }
                // Image update
                $newImg = $this->handleImageUpload('image');
                if ($newImg) {
                    $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ?", [$newImg, $id]);
                }
                header('Content-Type: application/json');
                echo json_encode(['status' => 'ok']);
                exit;
            }

            /* ── REORDER (drag-drop) ── */
            if ($action === 'reorder') {
                $ids = json_decode($_POST['ids'] ?? '[]', true);
                foreach ($ids as $order => $id) {
                    $this->db->query("UPDATE homepage_items SET sort_order = ? WHERE id = ?", [$order, (int)$id]);
                }
                header('Content-Type: application/json');
                echo json_encode(['status' => 'ok']);
                exit;
            }

            /* ── ADD BRAND LOGO ── */
            if ($action === 'add_brand_logo' || ($action === 'add_item' && ($_POST['section'] ?? '') === 'brand_logos')) {
                $title = strip_tags(trim($_POST['title'] ?? ''));
                $link  = strip_tags(trim($_POST['link'] ?? '#'));
                $sort  = (int)($_POST['sort_order'] ?? 0);
                $image = $this->handleImageUpload('image');
                if (empty($image) && !empty($_POST['image_url'])) {
                    $image = strip_tags(trim($_POST['image_url']));
                }

                if ($title !== '') {
                    $this->db->query(
                        "INSERT INTO homepage_items (section, title, image, link, sort_order, is_active) VALUES ('brand_logos', ?, ?, ?, ?, 1)",
                        [$title, $image, $link, $sort]
                    );
                    set_flash('success', '✅ Brand logo added successfully!');
                } else {
                    set_flash('danger', '❌ Please enter brand name.');
                }
                redirect('/admin/homepage?tab=brands');
                return;
            }

            /* ── DELETE BRAND LOGO ── */
            if ($action === 'delete_brand_logo' || ($action === 'delete_item' && ($_POST['section'] ?? '') === 'brand_logos')) {
                $id = (int)($_POST['item_id'] ?? 0);
                if ($id > 0) {
                    $this->db->query("DELETE FROM homepage_items WHERE id = ? AND section = 'brand_logos'", [$id]);
                    set_flash('success', '✅ Brand logo deleted.');
                }
                redirect('/admin/homepage?tab=brands');
                return;
            }

            /* ── UPDATE BRAND LOGO ── */
            if ($action === 'update_brand_logo') {
                $id    = (int)($_POST['item_id'] ?? 0);
                $title = strip_tags(trim($_POST['title'] ?? ''));
                $link  = strip_tags(trim($_POST['link'] ?? '#'));
                $sort  = (int)($_POST['sort_order'] ?? 0);

                if ($id > 0 && $title !== '') {
                    $uploaded = $this->handleImageUpload('image');
                    if (!empty($uploaded)) {
                        $this->db->query(
                            "UPDATE homepage_items SET title = ?, image = ?, link = ?, sort_order = ? WHERE id = ? AND section = 'brand_logos'",
                            [$title, $uploaded, $link, $sort, $id]
                        );
                    } elseif (!empty($_POST['image_url'])) {
                        $this->db->query(
                            "UPDATE homepage_items SET title = ?, image = ?, link = ?, sort_order = ? WHERE id = ? AND section = 'brand_logos'",
                            [$title, strip_tags(trim($_POST['image_url'])), $link, $sort, $id]
                        );
                    } else {
                        $this->db->query(
                            "UPDATE homepage_items SET title = ?, link = ?, sort_order = ? WHERE id = ? AND section = 'brand_logos'",
                            [$title, $link, $sort, $id]
                        );
                    }
                    set_flash('success', '✅ Brand logo updated successfully!');
                }
                redirect('/admin/homepage?tab=brands');
                return;
            }

            /* ── SAVE MOBILE APP SECTION SETTINGS ── */
            if ($action === 'save_mobile_app_settings') {
                $enabled  = isset($_POST['mobile_app_enabled']) ? '1' : '0';
                $badge    = strip_tags(trim($_POST['mobile_app_badge'] ?? 'MOBILE JEWELLERY ERP'));
                $title    = strip_tags(trim($_POST['mobile_app_title'] ?? 'Start Using Jewellers App Today'));
                $desc     = strip_tags(trim($_POST['mobile_app_desc'] ?? ''));
                $android  = strip_tags(trim($_POST['mobile_app_android_link'] ?? '#contact'));
                $ios      = strip_tags(trim($_POST['mobile_app_ios_link'] ?? '#contact'));
                $ctaBadge = strip_tags(trim($_POST['mobile_app_cta_badge'] ?? 'Trusted by 1000+ Jewellers Across India'));

                $this->setHP('mobile_app_enabled', $enabled);
                $this->setHP('mobile_app_badge', $badge);
                $this->setHP('mobile_app_title', $title);
                $this->setHP('mobile_app_desc', $desc);
                $this->setHP('mobile_app_android_link', $android);
                $this->setHP('mobile_app_ios_link', $ios);
                $this->setHP('mobile_app_cta_badge', $ctaBadge);

                // Handle Banner Image Upload or URL
                $bannerUploaded = $this->handleImageUpload('mobile_app_banner_image');
                if (!empty($bannerUploaded)) {
                    $this->setHP('mobile_app_banner_image', $bannerUploaded);
                } elseif (!empty($_POST['mobile_app_banner_image_url'])) {
                    $this->setHP('mobile_app_banner_image', strip_tags(trim($_POST['mobile_app_banner_image_url'])));
                }

                if (!empty($_POST['remove_mobile_app_banner'])) {
                    $this->setHP('mobile_app_banner_image', '');
                }

                set_flash('success', '✅ Mobile App Showcase settings saved successfully!');
                redirect('/admin/homepage?tab=mobile_app');
                return;
            }

            /* ── ADD MOBILE APP FEATURE CARD ── */
            if ($action === 'add_mobile_app_card') {
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-box-seam-fill'));
                $link        = strip_tags(trim($_POST['link'] ?? '#contact'));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $image       = $this->handleImageUpload('image');
                if (empty($image) && !empty($_POST['image_url'])) {
                    $image = strip_tags(trim($_POST['image_url']));
                }

                if ($title !== '') {
                    $this->db->query(
                        "INSERT INTO homepage_items (section, title, description, icon, image, link, sort_order, is_active) VALUES ('mobile_app_cards', ?, ?, ?, ?, ?, ?, 1)",
                        [$title, $description, $icon, $image, $link, $sortOrder]
                    );
                    set_flash('success', '✅ Feature card added successfully!');
                } else {
                    set_flash('danger', '❌ Card title is required.');
                }
                redirect('/admin/homepage?tab=mobile_app');
                return;
            }

            /* ── UPDATE MOBILE APP FEATURE CARD ── */
            if ($action === 'update_mobile_app_card') {
                $id          = (int)($_POST['item_id'] ?? 0);
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-box-seam-fill'));
                $link        = strip_tags(trim($_POST['link'] ?? '#contact'));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                if ($id > 0 && $title !== '') {
                    $uploaded = $this->handleImageUpload('image');
                    if (!empty($uploaded)) {
                        $this->db->query(
                            "UPDATE homepage_items SET title = ?, description = ?, icon = ?, image = ?, link = ?, sort_order = ?, is_active = ? WHERE id = ? AND section = 'mobile_app_cards'",
                            [$title, $description, $icon, $uploaded, $link, $sortOrder, $isActive, $id]
                        );
                    } elseif (!empty($_POST['image_url'])) {
                        $this->db->query(
                            "UPDATE homepage_items SET title = ?, description = ?, icon = ?, image = ?, link = ?, sort_order = ?, is_active = ? WHERE id = ? AND section = 'mobile_app_cards'",
                            [$title, $description, $icon, strip_tags(trim($_POST['image_url'])), $link, $sortOrder, $isActive, $id]
                        );
                    } else {
                        $this->db->query(
                            "UPDATE homepage_items SET title = ?, description = ?, icon = ?, link = ?, sort_order = ?, is_active = ? WHERE id = ? AND section = 'mobile_app_cards'",
                            [$title, $description, $icon, $link, $sortOrder, $isActive, $id]
                        );
                    }
                    set_flash('success', '✅ Feature card updated successfully!');
                }
                redirect('/admin/homepage?tab=mobile_app');
                return;
            }

            /* ── DELETE MOBILE APP FEATURE CARD ── */
            if ($action === 'delete_mobile_app_card') {
                $id = (int)($_POST['item_id'] ?? 0);
                if ($id > 0) {
                    $this->db->query("DELETE FROM homepage_items WHERE id = ? AND section = 'mobile_app_cards'", [$id]);
                    set_flash('success', '✅ Feature card deleted.');
                }
                redirect('/admin/homepage?tab=mobile_app');
                return;
            }

            /* ── SAVE FEATURE SHOWCASE SETTINGS ── */
            if ($action === 'save_showcase_settings') {
                $enabled   = isset($_POST['showcase_enabled']) ? '1' : '0';
                $badge     = strip_tags(trim($_POST['showcase_badge'] ?? 'POWERFUL FEATURES'));
                $title     = strip_tags(trim($_POST['showcase_title'] ?? 'Everything You Need to Run Your Business'));
                $highlight = strip_tags(trim($_POST['showcase_title_highlight'] ?? 'Smarter'));
                $desc      = strip_tags(trim($_POST['showcase_desc'] ?? ''));

                $this->setHP('showcase_enabled', $enabled);
                $this->setHP('showcase_badge', $badge);
                $this->setHP('showcase_title', $title);
                $this->setHP('showcase_title_highlight', $highlight);
                $this->setHP('showcase_desc', $desc);

                set_flash('success', '✅ Feature Showcase settings saved!');
                redirect('/admin/homepage?tab=showcase');
                return;
            }

            /* ── ADD SHOWCASE FEATURE CARD ── */
            if ($action === 'add_showcase_item') {
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $subtitle    = strip_tags(trim($_POST['subtitle'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-bar-chart-fill'));
                $accentColor = strip_tags(trim($_POST['accent_color'] ?? '#DC9423'));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $btnText     = strip_tags(trim($_POST['btn1_text'] ?? ''));
                $btnLink     = strip_tags(trim($_POST['btn1_link'] ?? '#contact'));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                // Micro features JSON array (3 items)
                $featTitles = $_POST['feat_title'] ?? [];
                $featDescs  = $_POST['feat_desc'] ?? [];
                $featIcons  = $_POST['feat_icon'] ?? [];
                $featuresArr = [];
                for ($i = 0; $i < count($featTitles); $i++) {
                    $t = strip_tags(trim((string)($featTitles[$i] ?? '')));
                    if ($t !== '') {
                        $featuresArr[] = [
                            'title' => $t,
                            'desc'  => strip_tags(trim((string)($featDescs[$i] ?? ''))),
                            'icon'  => strip_tags(trim((string)($featIcons[$i] ?? 'bi-check2-circle')))
                        ];
                    }
                }
                $featuresJson = json_encode($featuresArr);

                $image = $this->handleImageUpload('image');

                if ($sortOrder === 0) {
                    $sortOrder = (int)$this->db->fetchColumn(
                        "SELECT COALESCE(MAX(sort_order), 0) + 1 FROM homepage_items WHERE section = 'feature_showcase'"
                    );
                }

                $this->db->query(
                    "INSERT INTO homepage_items
                        (section, title, subtitle, description, icon, accent_color, alt_text, btn1_text, btn1_link, image, features, sort_order, is_active)
                     VALUES ('feature_showcase', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                    [$title, $subtitle, $description, $icon, $accentColor, $altText, $btnText, $btnLink, $image, $featuresJson, $sortOrder, $isActive]
                );

                set_flash('success', '✅ Feature card added to Showcase!');
                redirect('/admin/homepage?tab=showcase');
                return;
            }

            /* ── UPDATE SHOWCASE FEATURE CARD ── */
            if ($action === 'update_showcase_item') {
                $id          = (int)($_POST['item_id'] ?? 0);
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $subtitle    = strip_tags(trim($_POST['subtitle'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-bar-chart-fill'));
                $accentColor = strip_tags(trim($_POST['accent_color'] ?? '#DC9423'));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $btnText     = strip_tags(trim($_POST['btn1_text'] ?? ''));
                $btnLink     = strip_tags(trim($_POST['btn1_link'] ?? '#contact'));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $featTitles = $_POST['feat_title'] ?? [];
                $featDescs  = $_POST['feat_desc'] ?? [];
                $featIcons  = $_POST['feat_icon'] ?? [];
                $featuresArr = [];
                for ($i = 0; $i < count($featTitles); $i++) {
                    $t = strip_tags(trim((string)($featTitles[$i] ?? '')));
                    if ($t !== '') {
                        $featuresArr[] = [
                            'title' => $t,
                            'desc'  => strip_tags(trim((string)($featDescs[$i] ?? ''))),
                            'icon'  => strip_tags(trim((string)($featIcons[$i] ?? 'bi-check2-circle')))
                        ];
                    }
                }
                $featuresJson = json_encode($featuresArr);

                $this->db->query(
                    "UPDATE homepage_items SET
                        title = ?, subtitle = ?, description = ?, icon = ?, accent_color = ?,
                        alt_text = ?, btn1_text = ?, btn1_link = ?, features = ?, sort_order = ?, is_active = ?
                     WHERE id = ? AND section = 'feature_showcase'",
                    [$title, $subtitle, $description, $icon, $accentColor, $altText, $btnText, $btnLink, $featuresJson, $sortOrder, $isActive, $id]
                );

                if (!empty($_POST['remove_showcase_image'])) {
                    $this->db->query("UPDATE homepage_items SET image = '' WHERE id = ? AND section = 'feature_showcase'", [$id]);
                } else {
                    $newImg = $this->handleImageUpload('image');
                    if ($newImg) {
                        $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ? AND section = 'feature_showcase'", [$newImg, $id]);
                    }
                }

                set_flash('success', '✅ Feature card updated successfully!');
                redirect('/admin/homepage?tab=showcase');
                return;
            }

            /* ── REMOVE SHOWCASE IMAGE ── */
            if ($action === 'remove_showcase_image') {
                $id = (int)($_POST['item_id'] ?? 0);
                $this->db->query("UPDATE homepage_items SET image = '' WHERE id = ? AND section = 'feature_showcase'", [$id]);
                set_flash('success', '🗑️ Feature image removed.');
                redirect('/admin/homepage?tab=showcase');
                return;
            }

            /* ── DELETE SHOWCASE FEATURE CARD ── */
            if ($action === 'delete_showcase_item') {
                $id = (int)($_POST['item_id'] ?? 0);
                $this->db->query("DELETE FROM homepage_items WHERE id = ? AND section = 'feature_showcase'", [$id]);
                set_flash('success', '🗑️ Feature card deleted.');
                redirect('/admin/homepage?tab=showcase');
                return;
            }

            /* ── TOGGLE SHOWCASE ACTIVE ── */
            if ($action === 'toggle_showcase_item') {
                $id  = (int)($_POST['item_id'] ?? 0);
                $cur = (int)$this->db->fetchColumn("SELECT is_active FROM homepage_items WHERE id = ? AND section = 'feature_showcase'", [$id]);
                $this->db->query("UPDATE homepage_items SET is_active = ? WHERE id = ?", [$cur ? 0 : 1, $id]);
                set_flash('success', $cur ? 'Feature card disabled.' : 'Feature card enabled.');
                redirect('/admin/homepage?tab=showcase');
                return;
            }

            /* ── SAVE SPOTLIGHT SECTION SETTINGS ── */
            if ($action === 'save_spotlight_settings') {
                $enabled   = isset($_POST['spotlight_enabled']) ? '1' : '0';
                $badge     = strip_tags(trim($_POST['spotlight_badge'] ?? 'CORE ERP MODULES'));
                $title     = strip_tags(trim($_POST['spotlight_title'] ?? 'Built to Power Every Stage of Jewellery Business'));
                $highlight = strip_tags(trim($_POST['spotlight_title_highlight'] ?? 'Jewellery Business'));
                $desc      = strip_tags(trim($_POST['spotlight_desc'] ?? ''));

                $this->setHP('spotlight_enabled', $enabled);
                $this->setHP('spotlight_badge', $badge);
                $this->setHP('spotlight_title', $title);
                $this->setHP('spotlight_title_highlight', $highlight);
                $this->setHP('spotlight_desc', $desc);

                set_flash('success', '✅ Feature Spotlight settings saved!');
                redirect('/admin/homepage?tab=spotlight');
                return;
            }

            /* ── ADD SPOTLIGHT MODULE ITEM ── */
            if ($action === 'add_spotlight_item') {
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $subtitle    = strip_tags(trim($_POST['subtitle'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                // Checklist lines
                $rawPoints = $_POST['feat_points'] ?? [];
                $pointsArr = [];
                if (is_array($rawPoints)) {
                    foreach ($rawPoints as $p) {
                        $p = strip_tags(trim((string)$p));
                        if ($p !== '') $pointsArr[] = $p;
                    }
                }
                $featuresJson = json_encode($pointsArr);
                $image = $this->handleImageUpload('image');

                if ($sortOrder === 0) {
                    $sortOrder = (int)$this->db->fetchColumn(
                        "SELECT COALESCE(MAX(sort_order), 0) + 1 FROM homepage_items WHERE section = 'feature_spotlight'"
                    );
                }

                $this->db->query(
                    "INSERT INTO homepage_items
                        (section, title, subtitle, description, alt_text, image, features, sort_order, is_active)
                     VALUES ('feature_spotlight', ?, ?, ?, ?, ?, ?, ?, ?)",
                    [$title, $subtitle, $description, $altText, $image, $featuresJson, $sortOrder, $isActive]
                );

                set_flash('success', '✅ Spotlight module card added!');
                redirect('/admin/homepage?tab=spotlight');
                return;
            }

            /* ── UPDATE SPOTLIGHT MODULE ITEM ── */
            if ($action === 'update_spotlight_item') {
                $id          = (int)($_POST['item_id'] ?? 0);
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $subtitle    = strip_tags(trim($_POST['subtitle'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $rawPoints = $_POST['feat_points'] ?? [];
                $pointsArr = [];
                if (is_array($rawPoints)) {
                    foreach ($rawPoints as $p) {
                        $p = strip_tags(trim((string)$p));
                        if ($p !== '') $pointsArr[] = $p;
                    }
                }
                $featuresJson = json_encode($pointsArr);

                $this->db->query(
                    "UPDATE homepage_items SET
                        title = ?, subtitle = ?, description = ?, alt_text = ?, features = ?, sort_order = ?, is_active = ?
                     WHERE id = ? AND section = 'feature_spotlight'",
                    [$title, $subtitle, $description, $altText, $featuresJson, $sortOrder, $isActive, $id]
                );

                if (!empty($_POST['remove_spotlight_image'])) {
                    $this->db->query("UPDATE homepage_items SET image = '' WHERE id = ? AND section = 'feature_spotlight'", [$id]);
                } else {
                    $newImg = $this->handleImageUpload('image');
                    if ($newImg) {
                        $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ? AND section = 'feature_spotlight'", [$newImg, $id]);
                    }
                }

                set_flash('success', '✅ Spotlight module card updated!');
                redirect('/admin/homepage?tab=spotlight');
                return;
            }

            /* ── DELETE SPOTLIGHT ITEM ── */
            if ($action === 'delete_spotlight_item') {
                $id = (int)($_POST['item_id'] ?? 0);
                $this->db->query("DELETE FROM homepage_items WHERE id = ? AND section = 'feature_spotlight'", [$id]);
                set_flash('success', '🗑️ Spotlight module card deleted.');
                redirect('/admin/homepage?tab=spotlight');
                return;
            }

            /* ── TOGGLE SPOTLIGHT ACTIVE ── */
            if ($action === 'toggle_spotlight_item') {
                $id  = (int)($_POST['item_id'] ?? 0);
                $cur = (int)$this->db->fetchColumn("SELECT is_active FROM homepage_items WHERE id = ? AND section = 'feature_spotlight'", [$id]);
                $this->db->query("UPDATE homepage_items SET is_active = ? WHERE id = ?", [$cur ? 0 : 1, $id]);
                set_flash('success', $cur ? 'Module card disabled.' : 'Module card enabled.');
                redirect('/admin/homepage?tab=spotlight');
                return;
            }

            /* ── SAVE COUNTRIES SLIDER SETTINGS ── */
            if ($action === 'save_countries_slider_settings') {
                $badge   = strip_tags(trim($_POST['countries_badge'] ?? 'GLOBAL PRESENCE'));
                $title   = strip_tags(trim($_POST['countries_title'] ?? 'Trusted by Jewellers Across the Globe'));
                $enabled = isset($_POST['countries_slider_enabled']) ? '1' : '0';

                $this->setHP('countries_badge', $badge);
                $this->setHP('countries_title', $title);
                $this->setHP('countries_slider_enabled', $enabled);

                set_flash('success', '✅ Global Presence Slider settings saved!');
                redirect('/admin/homepage?tab=countries');
                return;
            }

            /* ── ADD SLIDING COUNTRY ── */
            if ($action === 'add_country') {
                $name      = strip_tags(trim($_POST['title'] ?? ''));
                $flagUrl   = strip_tags(trim($_POST['flag_url'] ?? ''));
                $mapUrl    = strip_tags(trim($_POST['map_url'] ?? ''));
                $sortOrder = (int)($_POST['sort_order'] ?? 0);
                $isActive  = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $flagUpload = $this->handleImageUpload('image');
                $flagImage  = $flagUpload ?: $flagUrl;

                $mapUpload  = $this->handleImageUpload('map_image');
                $mapImage   = $mapUpload ?: $mapUrl;

                if ($sortOrder === 0) {
                    $sortOrder = (int)$this->db->fetchColumn(
                        "SELECT COALESCE(MAX(sort_order), 0) + 1 FROM homepage_items WHERE section = 'sliding_countries'"
                    );
                }

                $this->db->query(
                    "INSERT INTO homepage_items (section, title, image, alt_text, sort_order, is_active) VALUES ('sliding_countries', ?, ?, ?, ?, ?)",
                    [$name, $flagImage, $mapImage, $sortOrder, $isActive]
                );

                set_flash('success', '✅ Country added to Global Slider!');
                redirect('/admin/homepage?tab=countries');
                return;
            }

            /* ── UPDATE SLIDING COUNTRY ── */
            if ($action === 'update_country') {
                $id        = (int)($_POST['item_id'] ?? 0);
                $name      = strip_tags(trim($_POST['title'] ?? ''));
                $flagUrl   = strip_tags(trim($_POST['flag_url'] ?? ''));
                $mapUrl    = strip_tags(trim($_POST['map_url'] ?? ''));
                $sortOrder = (int)($_POST['sort_order'] ?? 0);
                $isActive  = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $flagUpload = $this->handleImageUpload('image');
                $flagImage  = $flagUpload ?: (!empty($flagUrl) ? $flagUrl : null);

                $mapUpload  = $this->handleImageUpload('map_image');
                $mapImage   = $mapUpload ?: (!empty($mapUrl) ? $mapUrl : null);

                if ($flagImage !== null && $mapImage !== null) {
                    $this->db->query("UPDATE homepage_items SET title = ?, image = ?, alt_text = ?, sort_order = ?, is_active = ? WHERE id = ? AND section = 'sliding_countries'", [$name, $flagImage, $mapImage, $sortOrder, $isActive, $id]);
                } elseif ($flagImage !== null) {
                    $this->db->query("UPDATE homepage_items SET title = ?, image = ?, sort_order = ?, is_active = ? WHERE id = ? AND section = 'sliding_countries'", [$name, $flagImage, $sortOrder, $isActive, $id]);
                } elseif ($mapImage !== null) {
                    $this->db->query("UPDATE homepage_items SET title = ?, alt_text = ?, sort_order = ?, is_active = ? WHERE id = ? AND section = 'sliding_countries'", [$name, $mapImage, $sortOrder, $isActive, $id]);
                } else {
                    $this->db->query("UPDATE homepage_items SET title = ?, sort_order = ?, is_active = ? WHERE id = ? AND section = 'sliding_countries'", [$name, $sortOrder, $isActive, $id]);
                }

                set_flash('success', '✅ Country updated successfully!');
                redirect('/admin/homepage?tab=countries');
                return;
            }

            /* ── DELETE SLIDING COUNTRY ── */
            if ($action === 'delete_country') {
                $id = (int)($_POST['item_id'] ?? 0);
                $this->db->query("DELETE FROM homepage_items WHERE id = ? AND section = 'sliding_countries'", [$id]);
                set_flash('success', '🗑️ Country removed from slider.');
                redirect('/admin/homepage?tab=countries');
                return;
            }

            /* ── TOGGLE SLIDING COUNTRY ── */
            if ($action === 'toggle_country') {
                $id  = (int)($_POST['item_id'] ?? 0);
                $cur = (int)$this->db->fetchColumn("SELECT is_active FROM homepage_items WHERE id = ? AND section = 'sliding_countries'", [$id]);
                $this->db->query("UPDATE homepage_items SET is_active = ? WHERE id = ?", [$cur ? 0 : 1, $id]);
                set_flash('success', $cur ? 'Country disabled.' : 'Country enabled.');
                redirect('/admin/homepage?tab=countries');
                return;
            }

            /* ── SAVE POWERFUL FEATURES SETTINGS ── */
            if ($action === 'save_pfeat_settings') {
                $enabled   = isset($_POST['pfeat_enabled']) ? '1' : '0';
                $badge     = strip_tags(trim($_POST['pfeat_badge'] ?? 'POWERFUL FEATURES'));
                $title     = strip_tags(trim($_POST['pfeat_title'] ?? 'An Easy-To-Use Cloud Based Jewelry ERP Software'));
                $desc      = strip_tags(trim($_POST['pfeat_desc'] ?? ''));
                $ctaText   = strip_tags(trim($_POST['pfeat_cta_text'] ?? 'Explore All Features →'));
                $ctaLink   = strip_tags(trim($_POST['pfeat_cta_link'] ?? '#modules'));

                $this->setHP('pfeat_enabled', $enabled);
                $this->setHP('pfeat_badge', $badge);
                $this->setHP('pfeat_title', $title);
                $this->setHP('pfeat_desc', $desc);
                $this->setHP('pfeat_cta_text', $ctaText);
                $this->setHP('pfeat_cta_link', $ctaLink);

                set_flash('success', '✅ Powerful Features settings saved!');
                redirect('/admin/homepage?tab=pfeatures');
                return;
            }

            /* ── ADD POWERFUL FEATURE CARD ── */
            if ($action === 'add_pfeat_item') {
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-box-seam'));
                $link        = strip_tags(trim($_POST['link'] ?? '#contact'));
                $imageUrl    = strip_tags(trim($_POST['image_url'] ?? ''));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $upload = $this->handleImageUpload('image');
                $image  = $upload ?: $imageUrl;

                if ($sortOrder === 0) {
                    $sortOrder = (int)$this->db->fetchColumn(
                        "SELECT COALESCE(MAX(sort_order), 0) + 1 FROM homepage_items WHERE section = 'powerful_features'"
                    );
                }

                $this->db->query(
                    "INSERT INTO homepage_items
                        (section, title, description, icon, link, image, alt_text, sort_order, is_active)
                     VALUES ('powerful_features', ?, ?, ?, ?, ?, ?, ?, ?)",
                    [$title, $description, $icon, $link, $image, $altText, $sortOrder, $isActive]
                );

                set_flash('success', '✅ Feature card added!');
                redirect('/admin/homepage?tab=pfeatures');
                return;
            }

            /* ── UPDATE POWERFUL FEATURE CARD ── */
            if ($action === 'update_pfeat_item') {
                $id          = (int)($_POST['item_id'] ?? 0);
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-box-seam'));
                $link        = strip_tags(trim($_POST['link'] ?? '#contact'));
                $imageUrl    = strip_tags(trim($_POST['image_url'] ?? ''));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $upload = $this->handleImageUpload('image');

                $this->db->query(
                    "UPDATE homepage_items SET
                        title = ?, description = ?, icon = ?, link = ?, alt_text = ?, sort_order = ?, is_active = ?
                     WHERE id = ? AND section = 'powerful_features'",
                    [$title, $description, $icon, $link, $altText, $sortOrder, $isActive, $id]
                );

                if (!empty($_POST['remove_pfeat_image'])) {
                    $this->db->query("UPDATE homepage_items SET image = '' WHERE id = ? AND section = 'powerful_features'", [$id]);
                } elseif ($upload) {
                    $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ? AND section = 'powerful_features'", [$upload, $id]);
                } elseif (!empty($imageUrl)) {
                    $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ? AND section = 'powerful_features'", [$imageUrl, $id]);
                }

                set_flash('success', '✅ Feature card updated!');
                redirect('/admin/homepage?tab=pfeatures');
                return;
            }

            /* ── DELETE POWERFUL FEATURE CARD ── */
            if ($action === 'delete_pfeat_item') {
                $id = (int)($_POST['item_id'] ?? 0);
                $this->db->query("DELETE FROM homepage_items WHERE id = ? AND section = 'powerful_features'", [$id]);
                set_flash('success', '🗑️ Feature card deleted.');
                redirect('/admin/homepage?tab=pfeatures');
                return;
            }

            /* ── TOGGLE POWERFUL FEATURE ACTIVE ── */
            if ($action === 'toggle_pfeat_item') {
                $id  = (int)($_POST['item_id'] ?? 0);
                $cur = (int)$this->db->fetchColumn("SELECT is_active FROM homepage_items WHERE id = ? AND section = 'powerful_features'", [$id]);
                $this->db->query("UPDATE homepage_items SET is_active = ? WHERE id = ?", [$cur ? 0 : 1, $id]);
                set_flash('success', $cur ? 'Feature card disabled.' : 'Feature card enabled.');
                redirect('/admin/homepage?tab=pfeatures');
                return;
            }

            /* ── SAVE INTEGRATIONS SETTINGS ── */
            if ($action === 'save_integrations_settings') {
                $enabled = isset($_POST['integrations_enabled']) ? '1' : '0';
                $badge   = strip_tags(trim($_POST['integrations_badge'] ?? 'SEAMLESS CONNECTIVITY'));
                $title   = strip_tags(trim($_POST['integrations_title'] ?? 'Seamless integration with all your essential tools'));
                $desc    = strip_tags(trim($_POST['integrations_desc'] ?? ''));

                $this->setHP('integrations_enabled', $enabled);
                $this->setHP('integrations_badge', $badge);
                $this->setHP('integrations_title', $title);
                $this->setHP('integrations_desc', $desc);

                set_flash('success', '✅ Integration section settings saved!');
                redirect('/admin/homepage?tab=integrations');
                return;
            }

            /* ── ADD INTEGRATION ITEM ── */
            if ($action === 'add_integration_item') {
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-puzzle'));
                $link        = strip_tags(trim($_POST['link'] ?? '#contact'));
                $imageUrl    = strip_tags(trim($_POST['image_url'] ?? ''));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $upload = $this->handleImageUpload('image');
                $image  = $upload ?: $imageUrl;

                if ($sortOrder === 0) {
                    $sortOrder = (int)$this->db->fetchColumn(
                        "SELECT COALESCE(MAX(sort_order), 0) + 1 FROM homepage_items WHERE section = 'integrations'"
                    );
                }

                $this->db->query(
                    "INSERT INTO homepage_items
                        (section, title, description, icon, link, image, alt_text, sort_order, is_active)
                     VALUES ('integrations', ?, ?, ?, ?, ?, ?, ?, ?)",
                    [$title, $description, $icon, $link, $image, $altText, $sortOrder, $isActive]
                );

                set_flash('success', '✅ Integration tool added!');
                redirect('/admin/homepage?tab=integrations');
                return;
            }

            /* ── UPDATE INTEGRATION ITEM ── */
            if ($action === 'update_integration_item') {
                $id          = (int)($_POST['item_id'] ?? 0);
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $icon        = strip_tags(trim($_POST['icon'] ?? 'bi-puzzle'));
                $link        = strip_tags(trim($_POST['link'] ?? '#contact'));
                $imageUrl    = strip_tags(trim($_POST['image_url'] ?? ''));
                $altText     = strip_tags(trim($_POST['alt_text'] ?? ''));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $upload = $this->handleImageUpload('image');

                $this->db->query(
                    "UPDATE homepage_items SET
                        title = ?, description = ?, icon = ?, link = ?, alt_text = ?, sort_order = ?, is_active = ?
                     WHERE id = ? AND section = 'integrations'",
                    [$title, $description, $icon, $link, $altText, $sortOrder, $isActive, $id]
                );

                if (!empty($_POST['remove_integration_logo'])) {
                    $this->db->query("UPDATE homepage_items SET image = '' WHERE id = ? AND section = 'integrations'", [$id]);
                } elseif ($upload) {
                    $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ? AND section = 'integrations'", [$upload, $id]);
                } elseif (!empty($imageUrl)) {
                    $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ? AND section = 'integrations'", [$imageUrl, $id]);
                }

                set_flash('success', '✅ Integration tool updated!');
                redirect('/admin/homepage?tab=integrations');
                return;
            }

            /* ── DELETE INTEGRATION ITEM ── */
            if ($action === 'delete_integration_item') {
                $id = (int)($_POST['item_id'] ?? 0);
                $this->db->query("DELETE FROM homepage_items WHERE id = ? AND section = 'integrations'", [$id]);
                set_flash('success', '🗑️ Integration tool deleted.');
                redirect('/admin/homepage?tab=integrations');
                return;
            }

            /* ── TOGGLE INTEGRATION ACTIVE ── */
            if ($action === 'toggle_integration_item') {
                $id  = (int)($_POST['item_id'] ?? 0);
                $cur = (int)$this->db->fetchColumn("SELECT is_active FROM homepage_items WHERE id = ? AND section = 'integrations'", [$id]);
                $this->db->query("UPDATE homepage_items SET is_active = ? WHERE id = ?", [$cur ? 0 : 1, $id]);
                set_flash('success', $cur ? 'Integration disabled.' : 'Integration enabled.');
                redirect('/admin/homepage?tab=integrations');
                return;
            }

            /* ── SAVE AWARDS SETTINGS ── */
            if ($action === 'save_awards_settings') {
                $enabled  = isset($_POST['awards_enabled']) ? '1' : '0';
                $badge    = strip_tags(trim($_POST['awards_badge'] ?? 'AWARDS'));
                $title    = strip_tags(trim($_POST['awards_title'] ?? 'Awards'));
                $subtitle = strip_tags(trim($_POST['awards_subtitle'] ?? ''));

                $this->setHP('awards_enabled', $enabled);
                $this->setHP('awards_badge', $badge);
                $this->setHP('awards_title', $title);
                $this->setHP('awards_subtitle', $subtitle);

                set_flash('success', '✅ Awards section settings updated successfully!');
                redirect('/admin/homepage?tab=awards');
                return;
            }

            /* ── ADD AWARD ITEM ── */
            if ($action === 'add_award_item') {
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $subtitle    = strip_tags(trim($_POST['subtitle'] ?? ''));
                $badge       = strip_tags(trim($_POST['badge'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $link        = strip_tags(trim($_POST['link'] ?? ''));
                $imageUrl    = strip_tags(trim($_POST['image_url'] ?? ''));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $upload = $this->handleImageUpload('image');
                $finalImage = $upload ?: $imageUrl;

                if (!$sortOrder) {
                    $sortOrder = (int)$this->db->fetchColumn(
                        "SELECT COALESCE(MAX(sort_order), 0) + 1 FROM homepage_items WHERE section = 'awards'"
                    );
                }

                $this->db->query(
                    "INSERT INTO homepage_items (section, title, subtitle, badge, description, image, link, sort_order, is_active)
                     VALUES ('awards', ?, ?, ?, ?, ?, ?, ?, ?)",
                    [$title, $subtitle, $badge, $description, $finalImage, $link, $sortOrder, $isActive]
                );

                set_flash('success', '🏆 New award added successfully!');
                redirect('/admin/homepage?tab=awards');
                return;
            }

            /* ── UPDATE AWARD ITEM ── */
            if ($action === 'update_award_item') {
                $id          = (int)($_POST['item_id'] ?? 0);
                $title       = strip_tags(trim($_POST['title'] ?? ''));
                $subtitle    = strip_tags(trim($_POST['subtitle'] ?? ''));
                $badge       = strip_tags(trim($_POST['badge'] ?? ''));
                $description = strip_tags(trim($_POST['description'] ?? ''));
                $link        = strip_tags(trim($_POST['link'] ?? ''));
                $imageUrl    = strip_tags(trim($_POST['image_url'] ?? ''));
                $sortOrder   = (int)($_POST['sort_order'] ?? 0);
                $isActive    = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

                $upload = $this->handleImageUpload('image');

                $this->db->query(
                    "UPDATE homepage_items SET
                        title = ?, subtitle = ?, badge = ?, description = ?, link = ?, sort_order = ?, is_active = ?
                     WHERE id = ? AND section = 'awards'",
                    [$title, $subtitle, $badge, $description, $link, $sortOrder, $isActive, $id]
                );

                if (!empty($_POST['remove_award_image'])) {
                    $this->db->query("UPDATE homepage_items SET image = '' WHERE id = ? AND section = 'awards'", [$id]);
                } elseif ($upload) {
                    $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ? AND section = 'awards'", [$upload, $id]);
                } elseif (isset($_POST['image_url'])) {
                    $this->db->query("UPDATE homepage_items SET image = ? WHERE id = ? AND section = 'awards'", [$imageUrl, $id]);
                }

                set_flash('success', '✅ Award updated successfully!');
                redirect('/admin/homepage?tab=awards');
                return;
            }

            /* ── DELETE AWARD ITEM ── */
            if ($action === 'delete_award_item') {
                $id = (int)($_POST['item_id'] ?? 0);
                $this->db->query("DELETE FROM homepage_items WHERE id = ? AND section = 'awards'", [$id]);
                set_flash('success', '🗑️ Award deleted.');
                redirect('/admin/homepage?tab=awards');
                return;
            }

            /* ── TOGGLE AWARD ITEM ── */
            if ($action === 'toggle_award_item') {
                $id  = (int)($_POST['item_id'] ?? 0);
                $cur = (int)$this->db->fetchColumn("SELECT is_active FROM homepage_items WHERE id = ? AND section = 'awards'", [$id]);
                $this->db->query("UPDATE homepage_items SET is_active = ? WHERE id = ?", [$cur ? 0 : 1, $id]);
                set_flash('success', $cur ? 'Award hidden.' : 'Award published.');
                redirect('/admin/homepage?tab=awards');
                return;
            }
        }

        /* ── LOAD ALL DATA FOR VIEW ── */
        $data = [
            'activeTab'          => $activeTab,

            // ── AWARDS SECTION ──
            'awards_enabled'  => $this->hp('awards_enabled',  '1'),
            'awards_badge'    => $this->hp('awards_badge',    'AWARDS'),
            'awards_title'    => $this->hp('awards_title',    'Awards'),
            'awards_subtitle' => $this->hp('awards_subtitle', 'Recognized by industry leaders for performance, usability, and customer trust.'),
            'awards_items'    => $this->allAwards(),

            // ── INTEGRATIONS SECTION ──
            'integrations_enabled' => $this->hp('integrations_enabled', '1'),
            'integrations_badge'   => $this->hp('integrations_badge',   'SEAMLESS CONNECTIVITY'),
            'integrations_title'   => $this->hp('integrations_title',   'Seamless integration with all your essential tools'),
            'integrations_desc'    => $this->hp('integrations_desc',    'Connect GoldMatrix Jewellery ERP with the industry\'s leading e-commerce platforms, payment gateways, accounting software, and hardware.'),
            'integrations_items'   => $this->hpItems('integrations'),

            // ── POWERFUL FEATURES (5 CARDS) ──
            'pfeat_enabled'      => $this->hp('pfeat_enabled',      '1'),
            'pfeat_badge'        => $this->hp('pfeat_badge',        'POWERFUL FEATURES'),
            'pfeat_title'        => $this->hp('pfeat_title',        'An Easy-To-Use Cloud Based Jewelry ERP Software'),
            'pfeat_desc'         => $this->hp('pfeat_desc',         'GoldMatrix ERP is designed to simplify and automate every aspect of your jewelry business. From accounting to inventory, everything in one integrated platform.'),
            'pfeat_cta_text'     => $this->hp('pfeat_cta_text',     'Explore All Features →'),
            'pfeat_cta_link'     => $this->hp('pfeat_cta_link',     '#modules'),
            'pfeat_items'        => $this->hpItems('powerful_features'),

            // ── GLOBAL PRESENCE / COUNTRIES SLIDER ──
            'countries_slider_enabled' => $this->hp('countries_slider_enabled', '1'),
            'countries_badge'          => $this->hp('countries_badge',          'GLOBAL PRESENCE'),
            'countries_title'          => $this->hp('countries_title',          'Trusted by Jewellers Across the Globe'),
            'sliding_countries'        => $this->hpItems('sliding_countries'),

            // ── FEATURE SHOWCASE ──
            'showcase_enabled'         => $this->hp('showcase_enabled',         '1'),
            'showcase_badge'           => $this->hp('showcase_badge',           'POWERFUL FEATURES'),
            'showcase_title'           => $this->hp('showcase_title',           'Everything You Need to Run Your Business'),
            'showcase_title_highlight' => $this->hp('showcase_title_highlight', 'Smarter'),
            'showcase_desc'            => $this->hp('showcase_desc',            ''),
            'showcase_items'           => $this->hpItems('feature_showcase'),

            // ── FEATURE SPOTLIGHT (ZIG-ZAG) ──
            'spotlight_enabled'         => $this->hp('spotlight_enabled',         '1'),
            'spotlight_badge'           => $this->hp('spotlight_badge',           ''),
            'spotlight_title'           => $this->hp('spotlight_title',           'Built to Power Every Stage of Jewellery Business'),
            'spotlight_title_highlight' => $this->hp('spotlight_title_highlight', 'Jewellery Business'),
            'spotlight_desc'            => $this->hp('spotlight_desc',            ''),
            'spotlight_items'           => $this->hpItems('feature_spotlight'),

            // ── HERO ──
            'hero_badge'         => $this->hp('hero_badge',         'GOLDMATRIX SOFTWARE'),
            'hero_title_line1'   => $this->hp('hero_title_line1',   'Smart ERP for'),
            'hero_title_line2'   => $this->hp('hero_title_line2',   'Jewellery Businesses'),
            'hero_desc'          => $this->hp('hero_desc',          'Manage your sales, inventory, purchases & more from a single, powerful dashboard.'),
            'hero_btn1_text'     => $this->hp('hero_btn1_text',     'Explore Dashboard'),
            'hero_btn1_link'     => $this->hp('hero_btn1_link',     '#contact'),
            'hero_btn2_text'     => $this->hp('hero_btn2_text',     'Start 7-Day Free Trial'),
            'hero_btn2_link'     => $this->hp('hero_btn2_link',     '#contact'),
            'hero_sub_badge1'    => $this->hp('hero_sub_badge1',    'Real-time Analytics'),
            'hero_sub_badge2'    => $this->hp('hero_sub_badge2',    'Inventory Control'),
            'hero_sub_badge3'    => $this->hp('hero_sub_badge3',    'Sales Tracking'),
            'hero_sub_badge4'    => $this->hp('hero_sub_badge4',    'Secure & Reliable'),
            'hero_image'         => $this->hp('hero_image',         ''),
            'hero_slides'        => $this->allHeroSlides(),

            // ── BRAND LOGOS STRIP ──
            'brands_title'       => $this->hp('brands_title',       "Trusted By Leading\nJewellery Brands"),
            'brand_logos'        => $this->hpItems('brand_logos'),

            // ── CONNECTED SECTION (about) ──
            'conn_badge'         => $this->hp('conn_badge',         'ONE PLATFORM'),
            'conn_title'         => $this->hp('conn_title',         'Every Part of Your Jewellery Business,'),
            'conn_title2'        => $this->hp('conn_title2',        'Connected.'),
            'conn_desc'          => $this->hp('conn_desc',          'From retail to manufacturing, from inventory to accounting — GoldMatrix brings everything together in one powerful ERP platform.'),

            // ── SOLUTIONS SECTION ──
            'solutions_title'    => $this->hp('solutions_title',    'GoldMatrix Solutions'),

            // ── MODULES SECTION ──
            'modules_title'      => $this->hp('modules_title',      'Modules That Work Seamlessly'),
            'modules_desc'       => $this->hp('modules_desc',       'From access control to offline sync, GoldMatrix ERP is designed to scale with your business and adapt to the way you work — all with enterprise-grade security and customization options.'),
            'modules_items'      => $this->hpItems('modules'),

            // ── WHY SECTION ──
            'why_badge'          => $this->hp('why_badge',          'MADE FOR JEWELLERY BUSINESS'),
            'why_title'          => $this->hp('why_title',          'Built Around How Jewellery'),
            'why_title2'         => $this->hp('why_title2',         'Businesses Actually Work.'),
            'why_video_url'      => $this->hp('why_video_url',      ''),
            'why_explore_text'   => $this->hp('why_explore_text',   'Explore Features →'),
            'why_explore_link'   => $this->hp('why_explore_link',   '#modules'),

            // ── STATS ──
            'stats_stat1_num'    => $this->hp('stats_stat1_num',    '1,500+'),
            'stats_stat1_label'  => $this->hp('stats_stat1_label',  'Happy Customers'),
            'stats_stat2_num'    => $this->hp('stats_stat2_num',    '12+'),
            'stats_stat2_label'  => $this->hp('stats_stat2_label',  'Countries'),
            'stats_stat3_num'    => $this->hp('stats_stat3_num',    '25+'),
            'stats_stat3_label'  => $this->hp('stats_stat3_label',  'Years of Experience'),
            'stats_stat4_num'    => $this->hp('stats_stat4_num',    '24/7'),
            'stats_stat4_label'  => $this->hp('stats_stat4_label',  'Dedicated Support'),

            // ── TESTIMONIALS ──
            'testi_tag'          => $this->hp('testi_tag',          'What Our Customers Say'),
            'testi_view_all'     => $this->hp('testi_view_all',     'View All Testimonials →'),

            // ── CTA ──
            'cta_title'          => $this->hp('cta_title',          'Ready to Transform Your Jewelry Business?'),
            'cta_desc'           => $this->hp('cta_desc',           'Join 1000+ jewelers who trust GoldMatrix ERP. Get your free demo today.'),
            'cta_btn1_text'      => $this->hp('cta_btn1_text',      '🚀 Book Free Demo'),
            'cta_btn1_link'      => $this->hp('cta_btn1_link',      '#contact'),
            'cta_btn2_text'      => $this->hp('cta_btn2_text',      '📞 +91 98765 43210'),
            'cta_btn2_link'      => $this->hp('cta_btn2_link',      'tel:+919876543210'),

            // ── FOOTER ──
            'footer_tagline'       => $this->hp('footer_tagline',       'We build jewellery-specific software delivering accuracy, control, scalability, and business growth'),
            'footer_uae_title'     => $this->hp('footer_uae_title',     'Headquarter - UAE'),
            'footer_uae_address'   => $this->hp('footer_uae_address',   "Shop No. 25/A\nCentral Gold Souq Block No. 8,\nAl Majaz -1 King Faisal Road - Sharjah"),
            'footer_uae_phone'     => $this->hp('footer_uae_phone',     '+971 56 324 0319'),
            'footer_india_title'   => $this->hp('footer_india_title',   'India'),
            'footer_india_address' => $this->hp('footer_india_address', "India, 01/A, Hingna Rd,\nM.I.D.C, Maharashtra - 440022"),
            'footer_india_phone'   => $this->hp('footer_india_phone',   '+91 92703 69937'),
            'footer_email'         => $this->hp('footer_email',         'info@goldmatrixsoftware.com'),
            'footer_email_2'       => $this->hp('footer_email_2',       'goldmatrixsoftware@gmail.com'),
            'social_facebook'      => $this->hp('social_facebook',      '#'),
            'social_twitter'       => $this->hp('social_twitter',       '#'),
            'social_instagram'     => $this->hp('social_instagram',     '#'),
            'social_linkedin'      => $this->hp('social_linkedin',      '#'),
            'footer_copyright'     => $this->hp('footer_copyright',     '© ' . date('Y') . ' GoldMatrix Software. All Rights Reserved.'),

            // ── SEO ──
            'meta_title'         => $this->hp('meta_title',         'GoldMatrix — The Complete Jewellery ERP'),
            'meta_desc'          => $this->hp('meta_desc',          'Complete Jewelry ERP Software with Inventory, POS, GST, Karigar, and Multi-Branch Management. Trusted by 1500+ jewelers.'),
            'meta_keywords'      => $this->hp('meta_keywords',      'jewelry erp software, jewellery pos system, gold shop software india'),
            'og_title'           => $this->hp('og_title',           'GoldMatrix — The Complete Jewellery ERP'),
            'og_desc'            => $this->hp('og_desc',            'Complete Jewelry ERP Software trusted by 1500+ jewelers.'),
            'og_image'           => $this->hp('og_image',           ''),

            // ── MOBILE APP (BOTTOM SHOWCASE) ──
            'mobile_app_enabled'      => $this->hp('mobile_app_enabled',      '1'),
            'mobile_app_badge'        => $this->hp('mobile_app_badge',        'MOBILE JEWELLERY ERP'),
            'mobile_app_title'        => $this->hp('mobile_app_title',        'Start Using Jewellers App Today'),
            'mobile_app_desc'         => $this->hp('mobile_app_desc',         'Empowering Jewellers to Manage, Track & Grow their Business Anytime, Anywhere on Android & iOS.'),
            'mobile_app_banner_image' => $this->hp('mobile_app_banner_image', '/assets/images/jewellers-app-banner.png'),
            'mobile_app_android_link' => $this->hp('mobile_app_android_link', '#contact'),
            'mobile_app_ios_link'     => $this->hp('mobile_app_ios_link',     '#contact'),
            'mobile_app_cta_badge'    => $this->hp('mobile_app_cta_badge',    'Trusted by 1000+ Jewellers Across India'),
            'mobile_app_cards'        => $this->hpItems('mobile_app_cards'),

            // ── DYNAMIC ITEM LISTS ──
            'trust_countries'    => $this->hpItems('trust_countries'),
            'features_items'     => $this->hpItems('features'),
            'solutions_enabled'  => $this->hp('solutions_enabled',  '1'),
            'solutions_badge'    => $this->hp('solutions_badge',    'BUSINESS SOLUTIONS'),
            'solutions_title'    => $this->hp('solutions_title',    'Built for Every Jewellery Business Model'),
            'solutions_desc'     => $this->hp('solutions_desc',     'Whether you run a retail showroom, wholesale operation, or manufacturing unit — GoldMatrix is built to fit your exact workflow.'),
            'solutions_cards'    => $this->hpItems('solutions_cards'),
            'solutions_items'    => $this->hpItems('solutions_cards'),
            'why_features'       => $this->hpItems('why_features'),
            'stats_items'        => $this->hpItems('stats'),
            'testimonials'       => $this->hpItems('testimonials'),
            'brand_logos'        => $this->hpItems('brand_logos'),
            'modules_items'      => $this->hpItems('modules'),
            'faqs'               => $this->hpItems('faqs'),
            'nav_links'          => $this->hpItems('nav_links'),
        ];

        admin_view('admin.homepage.index', $data);
    }
}
