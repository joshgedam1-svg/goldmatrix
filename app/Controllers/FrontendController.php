<?php
namespace App\Controllers;

use App\Services\Database;

class FrontendController {

    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

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

    public function home(): void {
        $data = [
            // ── META/SEO ──
            'meta_title'        => $this->hp('meta_title',         'GoldMatrix — The Complete Jewellery ERP'),
            'meta_desc'         => $this->hp('meta_desc',          'Complete Jewellery ERP Software with Inventory, POS, GST, Manufacturing, and Multi-Branch Management. Trusted by 1500+ jewelers.'),
            'meta_keywords'     => $this->hp('meta_keywords',      'jewelry erp software, jewellery pos system, gold shop software india, jewellery management software'),
            'og_title'          => $this->hp('og_title',           'GoldMatrix — The Complete Jewellery ERP'),
            'og_desc'           => $this->hp('og_desc',            'Complete Jewelry ERP Software trusted by 1500+ jewelers.'),
            'og_image'          => $this->hp('og_image',           ''),

            // ── HERO ──
            'hero_badge'        => $this->hp('hero_badge',         'GOLDMATRIX SOFTWARE'),
            'hero_title_line1'  => $this->hp('hero_title_line1',   'Smart ERP for'),
            'hero_title_line2'  => $this->hp('hero_title_line2',   'Jewellery Businesses'),
            'hero_desc'         => $this->hp('hero_desc',          'Manage your sales, inventory, purchases & more from a single, powerful dashboard.'),
            'hero_btn1_text'    => $this->hp('hero_btn1_text',     'Explore Dashboard'),
            'hero_btn1_link'    => $this->hp('hero_btn1_link',     '#contact'),
            'hero_btn2_text'    => $this->hp('hero_btn2_text',     'Start 7-Day Free Trial'),
            'hero_btn2_link'    => $this->hp('hero_btn2_link',     '#contact'),
            'hero_sub_badge1'   => $this->hp('hero_sub_badge1',    'Real-time Analytics'),
            'hero_sub_badge2'   => $this->hp('hero_sub_badge2',    'Inventory Control'),
            'hero_sub_badge3'   => $this->hp('hero_sub_badge3',    'Sales Tracking'),
            'hero_sub_badge4'   => $this->hp('hero_sub_badge4',    'Secure & Reliable'),
            'hero_image'        => $this->hp('hero_image',         ''),
            'hero_display_mode' => $this->hp('hero_display_mode',  'auto'),
            'hero_slides'       => $this->hpItems('hero_slides'),

            // ── FEATURE SHOWCASE ──
            'showcase_enabled'         => $this->hp('showcase_enabled',         '1'),
            'showcase_badge'           => $this->hp('showcase_badge',           ''),
            'showcase_title'           => $this->hp('showcase_title',           'The only software for Jewelry business'),
            'showcase_title_highlight' => $this->hp('showcase_title_highlight', 'Jewelry business'),
            'showcase_desc'            => $this->hp('showcase_desc',            ''),
            'showcase_items'           => !empty($this->hpItems('feature_showcase')) ? $this->hpItems('feature_showcase') : [
                [
                    'id'           => 1,
                    'title'        => 'Transaction report',
                    'subtitle'     => 'Gain Complete Financial Clarity',
                    'description'  => 'The Transaction Report ensures transparent and detailed tracking of all financial activities within your jewelry business. From purchases and sales to returns and adjustments, this report provides an organized view of every transaction, enabling better financial management and decision-making.',
                    'icon'         => 'bi-bar-chart-fill',
                    'accent_color' => '#DC9423',
                    'alt_text'     => 'Transaction report Dashboard',
                    'image'        => '',
                    'btn1_text'    => '',
                    'btn1_link'    => '#contact',
                    'features'     => '',
                    'sort_order'   => 1,
                    'is_active'    => 1
                ],
                [
                    'id'           => 2,
                    'title'        => 'Marketing Integrations',
                    'subtitle'     => 'Connect, Automate, and Grow',
                    'description'  => 'Seamlessly integrate your business with leading marketing platforms to streamline promotions and customer engagement. From campaign tracking to performance insights, Marketing Integrations help you automate outreach, analyze results, and optimize strategies.',
                    'icon'         => 'bi-person-fill',
                    'accent_color' => '#8B5CF6',
                    'alt_text'     => 'Marketing Integrations',
                    'image'        => '',
                    'btn1_text'    => '',
                    'btn1_link'    => '#contact',
                    'features'     => '',
                    'sort_order'   => 2,
                    'is_active'    => 1
                ]
            ],

            // ── FEATURE SPOTLIGHT (ZIG-ZAG) ──
            'spotlight_enabled'         => $this->hp('spotlight_enabled',         '1'),
            'spotlight_badge'           => $this->hp('spotlight_badge',           ''),
            'spotlight_title'           => $this->hp('spotlight_title',           'Built to Power Every Stage of Jewellery Business'),
            'spotlight_title_highlight' => $this->hp('spotlight_title_highlight', 'Jewellery Business'),
            'spotlight_desc'            => $this->hp('spotlight_desc',            ''),
            'spotlight_items'           => !empty($this->hpItems('feature_spotlight')) ? $this->hpItems('feature_spotlight') : [
                [
                    'id'          => 1,
                    'title'       => 'Retails & Showrooms',
                    'subtitle'    => 'Simplify Jewellery Retail and Showroom Operations',
                    'description' => 'GoldMatrix Jewellery Software is built to support the day-to-day operations of jewellery retail stores and showrooms. It helps businesses maintain control over stock, sales, and customer transactions while ensuring smooth and efficient store management.',
                    'features'    => json_encode([
                        'Track inventory in real time, including available, reserved, and pending items',
                        'Maintain optimal stock levels using smart reorder alerts',
                        'Automate routine processes for sales, purchases, and returns',
                        'Generate barcodes and design custom price tags and labels effortlessly'
                    ]),
                    'alt_text'    => 'Create Sales Invoice Software Interface',
                    'image'       => '',
                    'sort_order'  => 1,
                    'is_active'   => 1
                ],
                [
                    'id'          => 2,
                    'title'       => 'Manufacturing',
                    'subtitle'    => 'Improve Productivity with Jewellery Software',
                    'description' => 'GoldMatrix Manufacturing Software is designed to support jewellery manufacturers by simplifying production management and improving operational control. It helps businesses plan, track, and optimize manufacturing activities while maintaining accuracy and cost efficiency.',
                    'features'    => json_encode([
                        'Plan and manage production jobs with clear task assignments',
                        'Support batch-based manufacturing for better efficiency',
                        'Calculate accurate production costs and track finished goods sales',
                        'Monitor work-in-progress inventory at every stage'
                    ]),
                    'alt_text'    => 'Sales Team Performance Dashboard',
                    'image'       => '',
                    'sort_order'  => 2,
                    'is_active'   => 1
                ]
            ],

            // ── POWERFUL FEATURES (5 CARDS GRID) ──
            'pfeat_enabled'     => $this->hp('pfeat_enabled',      '1'),
            'pfeat_badge'       => $this->hp('pfeat_badge',        'POWERFUL FEATURES'),
            'pfeat_title'       => $this->hp('pfeat_title',        'An Easy-To-Use Cloud Based Jewelry ERP Software'),
            'pfeat_desc'        => $this->hp('pfeat_desc',         'GoldMatrix ERP is designed to simplify and automate every aspect of your jewelry business. From accounting to inventory, everything in one integrated platform.'),
            'pfeat_cta_text'    => $this->hp('pfeat_cta_text',     'Explore All Features →'),
            'pfeat_cta_link'    => $this->hp('pfeat_cta_link',     '#modules'),
            'pfeat_items'       => !empty($this->hpItems('powerful_features')) ? $this->hpItems('powerful_features') : [
                [
                    'id'          => 1,
                    'title'       => 'Accounts Management',
                    'description' => 'Manage financial records, ledgers, payments, and reports with complete accuracy.',
                    'icon'        => 'bi-receipt-cutoff',
                    'link'        => '#contact',
                    'image'       => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=600&auto=format&fit=crop&q=80',
                    'alt_text'    => 'Accounts & Financial Management',
                    'sort_order'  => 1,
                    'is_active'   => 1
                ],
                [
                    'id'          => 2,
                    'title'       => 'Tax Calculation',
                    'description' => 'Automated tax calculations ensure compliance, accuracy, and faster billing processes.',
                    'icon'        => 'bi-calculator',
                    'link'        => '#contact',
                    'image'       => 'https://images.unsplash.com/photo-1586486855514-8c633cc6fd38?w=600&auto=format&fit=crop&q=80',
                    'alt_text'    => 'Tax Calculation & GST Compliance',
                    'sort_order'  => 2,
                    'is_active'   => 1
                ],
                [
                    'id'          => 3,
                    'title'       => 'Stock Management',
                    'description' => 'Track jewellery inventory in real time across stores and branches.',
                    'icon'        => 'bi-box-seam',
                    'link'        => '#contact',
                    'image'       => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=600&auto=format&fit=crop&q=80',
                    'alt_text'    => 'Real-time Stock & Inventory Management',
                    'sort_order'  => 3,
                    'is_active'   => 1
                ],
                [
                    'id'          => 4,
                    'title'       => 'Mobile Application',
                    'description' => 'Access business operations, reports, and inventory anytime using mobile application.',
                    'icon'        => 'bi-phone',
                    'link'        => '#contact',
                    'image'       => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=600&auto=format&fit=crop&q=80',
                    'alt_text'    => 'Mobile Application for Jewellers',
                    'sort_order'  => 4,
                    'is_active'   => 1
                ],
                [
                    'id'          => 5,
                    'title'       => 'QR & Barcode Creation',
                    'description' => 'Generate QR codes and barcodes for fast, accurate item identification.',
                    'icon'        => 'bi-qr-code-scan',
                    'link'        => '#contact',
                    'image'       => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600&auto=format&fit=crop&q=80',
                    'alt_text'    => 'QR & Barcode Tagging for Jewellery',
                    'sort_order'  => 5,
                    'is_active'   => 1
                ]
            ],

            // ── INTEGRATIONS SECTION ──
            'integrations_enabled' => $this->hp('integrations_enabled', '1'),
            'integrations_badge'   => $this->hp('integrations_badge',   'SEAMLESS CONNECTIVITY'),
            'integrations_title'   => $this->hp('integrations_title',   'Seamless integration with all your essential tools'),
            'integrations_desc'    => $this->hp('integrations_desc',    'Connect GoldMatrix Jewellery ERP with the industry\'s leading e-commerce platforms, payment gateways, accounting software, and hardware.'),
            'integrations_items'   => !empty($this->hpItems('integrations')) ? $this->hpItems('integrations') : [
                ['id'=>1, 'title'=>'Shopify', 'description'=>'Sync products, orders, customers, and payments seamlessly in real time', 'icon'=>'bi-shop', 'link'=>'#contact', 'image'=>'https://cdn.worldvectorlogo.com/logos/shopify.svg', 'alt_text'=>'Shopify', 'sort_order'=>1, 'is_active'=>1],
                ['id'=>2, 'title'=>'WooCommerce', 'description'=>'Manage store data, orders, and inventory directly from WordPress', 'icon'=>'bi-wordpress', 'link'=>'#contact', 'image'=>'https://cdn.worldvectorlogo.com/logos/woocommerce.svg', 'alt_text'=>'WooCommerce', 'sort_order'=>2, 'is_active'=>1],
                ['id'=>3, 'title'=>'WhatsApp', 'description'=>'Enable instant customer communication and automated message workflows', 'icon'=>'bi-whatsapp', 'link'=>'#contact', 'image'=>'https://cdn.worldvectorlogo.com/logos/whatsapp-symbol.svg', 'alt_text'=>'WhatsApp', 'sort_order'=>3, 'is_active'=>1],
                ['id'=>4, 'title'=>'Email & SMS', 'description'=>'Send transactional emails, alerts, and notifications with full tracking', 'icon'=>'bi-envelope-at', 'link'=>'#contact', 'image'=>'https://cdn-icons-png.flaticon.com/512/542/542689.png', 'alt_text'=>'Email & SMS', 'sort_order'=>4, 'is_active'=>1],
                ['id'=>5, 'title'=>'Gmail', 'description'=>'Integrate Gmail to manage conversations and email automation centrally', 'icon'=>'bi-google', 'link'=>'#contact', 'image'=>'https://cdn.worldvectorlogo.com/logos/gmail-icon.svg', 'alt_text'=>'Gmail', 'sort_order'=>5, 'is_active'=>1],
                ['id'=>6, 'title'=>'Authorize.Net', 'description'=>'Authorize.Net A Visa Solution - Secure payment gateway processing', 'icon'=>'bi-credit-card-2-front', 'link'=>'#contact', 'image'=>'https://cdn.worldvectorlogo.com/logos/authorize-net.svg', 'alt_text'=>'Authorize.Net', 'sort_order'=>6, 'is_active'=>1],
                ['id'=>7, 'title'=>'HID Global', 'description'=>'Integrate secure identity access and authentication hardware systems', 'icon'=>'bi-shield-lock', 'link'=>'#contact', 'image'=>'https://cdn.worldvectorlogo.com/logos/hid-global.svg', 'alt_text'=>'HID Global', 'sort_order'=>7, 'is_active'=>1],
                ['id'=>8, 'title'=>'QuickBooks', 'description'=>'Automate accounting, invoices, expenses, and financial reporting', 'icon'=>'bi-file-earmark-spreadsheet', 'link'=>'#contact', 'image'=>'https://cdn.worldvectorlogo.com/logos/quickbooks.svg', 'alt_text'=>'QuickBooks', 'sort_order'=>8, 'is_active'=>1],
                ['id'=>9, 'title'=>'Chainway', 'description'=>'Connect barcode scanners and RFID devices for smart operations', 'icon'=>'bi-upc-scan', 'link'=>'#contact', 'image'=>'https://www.chainway.net/Public/Home/images/logo.png', 'alt_text'=>'Chainway', 'sort_order'=>9, 'is_active'=>1],
                ['id'=>10, 'title'=>'Planet Payment', 'description'=>'Accept global card payments with fast and reliable processing', 'icon'=>'bi-globe', 'link'=>'#contact', 'image'=>'https://cdn.worldvectorlogo.com/logos/planet-payment.svg', 'alt_text'=>'Planet', 'sort_order'=>10, 'is_active'=>1],
                ['id'=>11, 'title'=>'E-Way Bill', 'description'=>'E-way Bill E-Way bill system is for GST registered person', 'icon'=>'bi-truck', 'link'=>'#contact', 'image'=>'https://einvoice1.gst.gov.in/Images/logo.png', 'alt_text'=>'E-Way Bill', 'sort_order'=>11, 'is_active'=>1],
                ['id'=>12, 'title'=>'E-Invoice', 'description'=>'E-invoice bill system is for GST registered person', 'icon'=>'bi-file-earmark-check', 'link'=>'#contact', 'image'=>'https://einvoice1.gst.gov.in/Images/logo.png', 'alt_text'=>'E-Invoice', 'sort_order'=>12, 'is_active'=>1],
                ['id'=>13, 'title'=>'AML Compliance', 'description'=>'Jewellery ERP like GoldMatrix can support AML compliance', 'icon'=>'bi-shield-check', 'link'=>'#contact', 'image'=>'https://cdn-icons-png.flaticon.com/512/3135/3135715.png', 'alt_text'=>'AML Compliance', 'sort_order'=>13, 'is_active'=>1],
            ],

            // ── BRAND LOGOS STRIP ──
            'brands_title'      => $this->hp('brands_title',       "Trusted By Leading\nJewellery Brands"),
            'brand_logos'       => $this->hpItems('brand_logos'),

            // ── CONNECTED / ABOUT ──
            'conn_badge'        => $this->hp('conn_badge',         'ONE PLATFORM'),
            'conn_title'        => $this->hp('conn_title',         'Every Part of Your Jewellery Business,'),
            'conn_title2'       => $this->hp('conn_title2',        'Connected.'),
            'conn_desc'         => $this->hp('conn_desc',          'From retail to manufacturing, from inventory to accounting — GoldMatrix brings everything together in one powerful ERP platform.'),

            // ── BUSINESS SOLUTIONS (3 CARDS) ──
            'solutions_enabled' => $this->hp('solutions_enabled', '1'),
            'solutions_badge'   => $this->hp('solutions_badge',   'BUSINESS SOLUTIONS'),
            'solutions_title'   => $this->hp('solutions_title',   'Built for Every Jewellery Business Model'),
            'solutions_desc'    => $this->hp('solutions_desc',    'Whether you run a retail showroom, wholesale operation, or manufacturing unit — GoldMatrix is built to fit your exact workflow.'),
            'solutions_items'   => !empty($this->hpItems('solutions_cards')) ? $this->hpItems('solutions_cards') : [
                [
                    'id'           => 1,
                    'badge'        => 'RETAIL SOFTWARE',
                    'title'        => 'Jewellery Retail & Showroom',
                    'description'  => 'POS billing, inventory, old gold exchange, customer management, gold rates and Tax in one screen — built for showroom counters.',
                    'icon'         => 'bi-shop',
                    'accent_color' => '#D97706',
                    'extra'        => 'bi-gem',
                    'features'     => json_encode([
                        'Fast POS & Touch Billing',
                        'Barcode & RFID Scanning',
                        'Gold Rate Board Sync',
                        'Old Gold Exchange',
                        'Customer CRM & KYC'
                    ]),
                    'btn1_text'    => 'Explore Retail Software',
                    'btn1_link'    => '/solutions/jewellery-retail',
                    'image'        => '/assets/images/solution-retail-rings.jpg',
                    'alt_text'     => 'Jewellery Retail & Showroom POS Software',
                    'sort_order'   => 1,
                    'is_active'    => 1
                ],
                [
                    'id'           => 2,
                    'badge'        => 'WHOLESALE SOFTWARE',
                    'title'        => 'Jewellery Wholesale & Trading',
                    'description'  => 'Manage wholesale orders, branch transfers, vendor accounts, multi-party billing, and stock across locations — all connected.',
                    'icon'         => 'bi-handshake',
                    'accent_color' => '#2563EB',
                    'extra'        => 'bi-bar-chart-fill',
                    'features'     => json_encode([
                        'Wholesale Order Management',
                        'Multi-Branch Stock Control',
                        'Vendor & Party Ledgers',
                        'Branch Transfer & Audit',
                        'Bulk Billing & Pricing'
                    ]),
                    'btn1_text'    => 'Explore Wholesale Software',
                    'btn1_link'    => '/solutions/jewellery-wholesale',
                    'image'        => '/assets/images/solution-wholesale-bullion.jpg',
                    'alt_text'     => 'Jewellery Wholesale & Bullion Trading ERP',
                    'sort_order'   => 2,
                    'is_active'    => 1
                ],
                [
                    'id'           => 3,
                    'badge'        => 'MANUFACTURING SOFTWARE',
                    'title'        => 'Jewellery Manufacturing & Jobwork',
                    'description'  => 'Track production orders, jobwork assignments, metal loss, jobwork queue, outsourced work, and WIP inventory stage by stage.',
                    'icon'         => 'bi-gear-wide-connected',
                    'accent_color' => '#059669',
                    'extra'        => 'bi-hammer',
                    'features'     => json_encode([
                        'Production & Work Orders',
                        'Jobwork & Process Allocation',
                        'Metal Loss & Wastage Tracking',
                        'WIP Stage Tracking',
                        'Manufacturing Reports'
                    ]),
                    'btn1_text'    => 'Explore Manufacturing Software',
                    'btn1_link'    => '/solutions/jewellery-manufacturing',
                    'image'        => '/assets/images/solution-manufacturing-craft.jpg',
                    'alt_text'     => 'Jewellery Manufacturing & Jobwork ERP',
                    'sort_order'   => 3,
                    'is_active'    => 1
                ]
            ],

            // ── MODULES ──
            'modules_title'     => $this->hp('modules_title',      'Modules That Work Seamlessly'),
            'modules_desc'      => $this->hp('modules_desc',       'From access control to offline sync, GoldMatrix ERP is designed to scale with your business and adapt to the way you work — all with enterprise-grade security and customization options.'),
            'modules_items'     => $this->hpItems('modules'),

            // ── WHY SECTION ──
            'why_badge'         => $this->hp('why_badge',          'MADE FOR JEWELLERY BUSINESS'),
            'why_title'         => $this->hp('why_title',          'Built Around How Jewellery'),
            'why_title2'        => $this->hp('why_title2',         'Businesses Actually Work.'),
            'why_video_url'     => $this->hp('why_video_url',      ''),
            'why_explore_text'  => $this->hp('why_explore_text',   'Explore Features →'),
            'why_explore_link'  => $this->hp('why_explore_link',   '#modules'),

            // ── STATS ──
            'stats_stat1_num'   => $this->hp('stats_stat1_num',    '1,500+'),
            'stats_stat1_label' => $this->hp('stats_stat1_label',  'Happy Customers'),
            'stats_stat2_num'   => $this->hp('stats_stat2_num',    '12+'),
            'stats_stat2_label' => $this->hp('stats_stat2_label',  'Countries'),
            'stats_stat3_num'   => $this->hp('stats_stat3_num',    '25+'),
            'stats_stat3_label' => $this->hp('stats_stat3_label',  'Years of Experience'),
            'stats_stat4_num'   => $this->hp('stats_stat4_num',    '24/7'),
            'stats_stat4_label' => $this->hp('stats_stat4_label',  'Dedicated Support'),

            // ── TESTIMONIALS ──
            'testi_tag'         => $this->hp('testi_tag',          'What Our Customers Say'),
            'testi_view_all'    => $this->hp('testi_view_all',     'View All Testimonials →'),

            // ── CTA ──
            'cta_title'         => $this->hp('cta_title',          'Ready to Transform Your Jewelry Business?'),
            'cta_desc'          => $this->hp('cta_desc',           'Join 1000+ jewelers who trust GoldMatrix ERP. Get your free demo today.'),
            'cta_btn1_text'     => $this->hp('cta_btn1_text',      '🚀 Book Free Demo'),
            'cta_btn1_link'     => $this->hp('cta_btn1_link',      '#contact'),
            'cta_btn2_text'     => $this->hp('cta_btn2_text',      '📞 +91 98765 43210'),
            'cta_btn2_link'     => $this->hp('cta_btn2_link',      'tel:+919876543210'),

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

            // ── GLOBAL PRESENCE / SLIDING COUNTRIES ──
            'countries_slider_enabled' => $this->hp('countries_slider_enabled', '1'),
            'countries_badge'          => $this->hp('countries_badge',          'GLOBAL PRESENCE'),
            'countries_title'          => $this->hp('countries_title',          'Trusted by Jewellers Across the Globe'),
            'sliding_countries'        => $this->hpItems('sliding_countries'),

            // ── MOBILE APP SHOWCASE & FEATURE CARDS (BOTTOM) ──
            'mobile_app_enabled'      => $this->hp('mobile_app_enabled',      '1'),
            'mobile_app_badge'        => $this->hp('mobile_app_badge',        'MOBILE JEWELLERY ERP'),
            'mobile_app_title'        => $this->hp('mobile_app_title',        'Start Using Jewellers App Today'),
            'mobile_app_desc'         => $this->hp('mobile_app_desc',         'Empowering Jewellers to Manage, Track & Grow their Business Anytime, Anywhere on Android & iOS.'),
            'mobile_app_banner_image' => $this->hp('mobile_app_banner_image', '/assets/images/jewellers-app-banner.png'),
            'mobile_app_android_link' => $this->hp('mobile_app_android_link', '#contact'),
            'mobile_app_ios_link'     => $this->hp('mobile_app_ios_link',     '#contact'),
            'mobile_app_cta_badge'    => $this->hp('mobile_app_cta_badge',    'Trusted by 1000+ Jewellers Across India'),
            'mobile_app_cards'        => !empty($this->hpItems('mobile_app_cards')) ? $this->hpItems('mobile_app_cards') : [
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
            ],

            // ── AWARDS & RECOGNITION ──
            'awards_enabled'  => $this->hp('awards_enabled', '1'),
            'awards_badge'    => $this->hp('awards_badge', 'AWARDS'),
            'awards_title'    => $this->hp('awards_title', 'Awards'),
            'awards_subtitle' => $this->hp('awards_subtitle', 'Recognized by industry leaders for performance, usability, and customer trust.'),
            'awards_items'    => $this->hpItems('awards'),

            // ── DYNAMIC ITEMS FROM DB ──
            'trust_countries'   => $this->hpItems('trust_countries'),
            'features_items'    => $this->hpItems('features'),
            'solutions_cards'   => $this->hpItems('solutions_cards'),
            'why_features'      => $this->hpItems('why_features'),
            'stats_items'       => $this->hpItems('stats'),
            'testimonials'      => $this->hpItems('testimonials'),
            'brand_logos'       => $this->hpItems('brand_logos'),
            'modules_items'     => $this->hpItems('modules'),
            'faqs'              => $this->hpItems('faqs'),
            'nav_links'         => $this->hpItems('nav_links'),

            // ── DYNAMIC NAVIGATION MENUS ──
            'header_menu'        => $this->getMenu('header'),
            'footer_col1_menu'   => $this->getMenu('footer_col1'),
            'footer_col2_menu'   => $this->getMenu('footer_col2'),
            'footer_col3_menu'   => $this->getMenu('footer_col3'),
            'footer_bottom_menu' => $this->getMenu('footer_bottom'),
        ];

        view('frontend.home', $data);
    }

    /**
     * Services Directory / Listing Page
     */
    public function servicesIndex(): void {
        $services = $this->getServicesData();
        $data = [
            'meta_title'         => 'Jewellery ERP Solutions & Services — GoldMatrix',
            'meta_desc'          => 'Explore GoldMatrix specialized jewellery software solutions: Retail POS, Karigar Manufacturing, RFID Inventory, Bullion Trading, and GST Invoicing.',
            'meta_keywords'      => 'jewellery erp services, jewelry pos software, karigar management, jewelry rfid automation',
            'services'           => $services,
            'header_menu'        => $this->getMenu('header'),
            'footer_col1_menu'   => $this->getMenu('footer_col1'),
            'footer_col2_menu'   => $this->getMenu('footer_col2'),
            'footer_col3_menu'   => $this->getMenu('footer_col3'),
            'footer_bottom_menu' => $this->getMenu('footer_bottom'),
        ];
        view('frontend.services-index', $data);
    }

    /**
     * Single Service Detail Sub-Page
     */
    public function serviceDetail(string $slug): void {
        $aliases = [
            'retail-jewelry-software'          => 'jewelry-retail-pos-software',
            'pos-system-jewelry-store'         => 'jewelry-retail-pos-software',
            'pos-system-for-jewelry-store'     => 'jewelry-retail-pos-software',
            'gold-loan-girvi-software'         => 'jewelry-retail-pos-software',
            'bullion-wholesale-trading'        => 'wholesale-bullion-management',
            'jewelry-e-commerce-omnichannel'   => 'jewelry-ecommerce-catalog',
            'jewelry-accounting-gst'           => 'jewelry-accounting-gst-software',
            'rfid-jewelry'                     => 'rfid-jewelry-automation',
            'manufacturing'                    => 'jewelry-manufacturing-software'
        ];
        if (isset($aliases[$slug])) {
            $slug = $aliases[$slug];
        }

        $services = $this->getServicesData();
        if (!isset($services[$slug])) {
            http_response_code(404);
            view('admin.errors.404', [
                'title'              => '404 - Service Not Found',
                'header_menu'        => $this->getMenu('header'),
                'footer_col1_menu'   => $this->getMenu('footer_col1'),
                'footer_col2_menu'   => $this->getMenu('footer_col2'),
                'footer_col3_menu'   => $this->getMenu('footer_col3'),
                'footer_bottom_menu' => $this->getMenu('footer_bottom'),
            ]);
            return;
        }

        $service = $services[$slug];
        
        // Related services
        $related = [];
        foreach ($service['related_slugs'] as $rSlug) {
            if (isset($services[$rSlug])) {
                $related[] = $services[$rSlug];
            }
        }

        $data = [
            'service'            => $service,
            'related_services'   => $related,
            'all_services'       => $services,
            'meta_title'         => $service['meta_title'],
            'meta_desc'          => $service['meta_desc'],
            'meta_keywords'      => $service['meta_keywords'],
            'og_title'           => $service['title'] . ' | GoldMatrix Jewellery ERP',
            'og_desc'            => $service['meta_desc'],
            'header_menu'        => $this->getMenu('header'),
            'footer_col1_menu'   => $this->getMenu('footer_col1'),
            'footer_col2_menu'   => $this->getMenu('footer_col2'),
            'footer_col3_menu'   => $this->getMenu('footer_col3'),
            'footer_bottom_menu' => $this->getMenu('footer_bottom'),
        ];

        view('frontend.service-detail', $data);
    }

    /**
     * Why Choose Us Page
     */
    public function whyUs(): void {
        $breadcrumbsSchema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => site_url('/')
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'Why Choose GoldMatrix',
                    'item'     => site_url('why-us')
                ]
            ]
        ];

        $data = [
            'meta_title'         => 'Why Choose GoldMatrix ERP — Specialized Jewellery Management Software',
            'meta_desc'          => 'Discover why 1,500+ jewellery retail, wholesale, and manufacturing businesses choose GoldMatrix ERP over generic ERP software like SAP, Tally, and Zoho.',
            'meta_keywords'      => 'why choose goldmatrix, jewellery erp comparison, jewelry erp vs generic erp, gold shop software benefits',
            'canonical_url'      => site_url('why-us'),
            'og_title'           => 'Why Choose GoldMatrix ERP — Specialized Jewellery Management Software',
            'og_desc'            => 'Discover why 1,500+ jewellery businesses choose GoldMatrix ERP over generic ERP software.',
            'og_image'           => '/assets/images/why-goldmatrix-mockup.png',
            'schema_json'        => [$breadcrumbsSchema],

            'header_menu'        => $this->getMenu('header'),
            'footer_col1_menu'   => $this->getMenu('footer_col1'),
            'footer_col2_menu'   => $this->getMenu('footer_col2'),
            'footer_col3_menu'   => $this->getMenu('footer_col3'),
            'footer_bottom_menu' => $this->getMenu('footer_bottom'),
        ];

        view('frontend.why-us', $data);
    }

    /**
     * Customer Testimonials & Reviews Page
     */
    public function testimonials(): void {
        $testimonials = $this->hpItems('testimonials');

        $breadcrumbsSchema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => site_url('/')
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'Customer Testimonials',
                    'item'     => site_url('testimonials')
                ]
            ]
        ];

        $data = [
            'meta_title'         => 'Customer Reviews & Case Studies | GoldMatrix Jewellery ERP',
            'meta_desc'          => 'Read reviews from 1,500+ jewellery retail stores, bullion wholesalers, and manufacturing workshops using GoldMatrix ERP across UAE, India, and worldwide.',
            'meta_keywords'      => 'goldmatrix reviews, jewellery software testimonials, gold shop erp ratings, customer case studies',
            'canonical_url'      => site_url('testimonials'),
            'og_title'           => 'Customer Reviews & Case Studies | GoldMatrix Jewellery ERP',
            'og_desc'            => 'Read reviews from 1,500+ jewellery businesses using GoldMatrix ERP.',
            'og_image'           => '',
            'schema_json'        => [$breadcrumbsSchema],

            'testimonials'       => $testimonials,
            'header_menu'        => $this->getMenu('header'),
            'footer_col1_menu'   => $this->getMenu('footer_col1'),
            'footer_col2_menu'   => $this->getMenu('footer_col2'),
            'footer_col3_menu'   => $this->getMenu('footer_col3'),
            'footer_bottom_menu' => $this->getMenu('footer_bottom'),
        ];

        view('frontend.testimonials', $data);
    }

    /**
     * About Us Page
     */
    public function about(): void {
        // Values array
        $rawValues = setting('about_values_items', setting('about_values_json', ''));
        $values = !empty($rawValues) ? json_decode($rawValues, true) : null;
        if (!is_array($values) || empty($values)) {
            $values = [
                ['icon' => 'bi-gem', 'title' => 'Domain Expertise', 'desc' => 'Engineered exclusively for jewellery retail, wholesale, manufacturing, and bullion workflows.'],
                ['icon' => 'bi-shield-check', 'title' => 'Data Integrity', 'desc' => 'Zero margin for calculation errors in gold karats, purity wastage, stones, and multi-currency billing.'],
                ['icon' => 'bi-lightning-charge', 'title' => 'Speed & Automation', 'desc' => 'Instant barcode generation, RFID tray audits in 3 seconds, and automated GST/VAT returns.'],
                ['icon' => 'bi-globe2', 'title' => 'Global Standards', 'desc' => 'Multi-branch cloud architecture compliant with UAE VAT, India GST, and international jewellery laws.']
            ];
        }

        // Stats array
        $rawStats = setting('about_stats_items', setting('about_stats_json', ''));
        $stats = !empty($rawStats) ? json_decode($rawStats, true) : null;
        if (!is_array($stats) || empty($stats)) {
            $stats = [
                ['num' => '1,500+', 'label' => 'Jewellery Stores & Factories Powered'],
                ['num' => '15+',    'label' => 'Years of Jewellery Domain Innovation'],
                ['num' => '10+',    'label' => 'Countries with Active Deployments'],
                ['num' => '99.9%',  'label' => 'Customer Retention & Uptime Record']
            ];
        }

        // Timeline array
        $rawTimeline = setting('about_timeline_items', setting('about_timeline_json', ''));
        $timeline = !empty($rawTimeline) ? json_decode($rawTimeline, true) : null;
        if (!is_array($timeline) || empty($timeline)) {
            $timeline = [
                ['year' => '2010', 'title' => 'Company Founded', 'desc' => 'Started development of specialized desktop software for gold merchants in Sharjah Gold Souq.'],
                ['year' => '2016', 'title' => 'Cloud ERP Transition', 'desc' => 'Launched GoldMatrix Cloud, enabling real-time multi-branch inventory and remote live rates.'],
                ['year' => '2020', 'title' => 'RFID & IoT Hardware Suite', 'desc' => 'Integrated automated high-speed UHF RFID counter trays and direct digital weighing balances.'],
                ['year' => '2026', 'title' => 'Next-Gen Global Platform', 'desc' => 'Powering 1500+ enterprises across UAE, India, Hong Kong, Singapore, and the UK.']
            ];
        }

        $breadcrumbsSchema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => site_url('/')
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'About Us',
                    'item'     => site_url('about')
                ]
            ]
        ];

        $orgSchema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Organization',
            'name'        => 'GoldMatrix Software Technologies',
            'url'         => site_url('/'),
            'description' => setting('about_seo_meta_desc', 'Discover GoldMatrix Software story, mission, and leadership.'),
            'contactPoint' => [
                '@type'       => 'ContactPoint',
                'telephone'   => setting('contact_uae_phone', '+971 56 324 0319'),
                'contactType' => 'customer service'
            ]
        ];

        $data = [
            // SEO Meta
            'meta_title'             => setting('about_seo_meta_title', 'About Us | GoldMatrix — Leading Jewellery ERP Software Company'),
            'meta_desc'              => setting('about_seo_meta_desc', 'Discover GoldMatrix Software story, mission, and leadership. Powering 1,500+ jewellery businesses across UAE, India, Hong Kong, and worldwide since 2010.'),
            'meta_keywords'          => setting('about_seo_keywords', 'about goldmatrix, jewellery erp company, gold software developers, jewelry tech uae india'),
            'canonical_url'          => site_url('about'),
            'og_title'               => setting('about_seo_meta_title', 'About Us | GoldMatrix — Leading Jewellery ERP Software Company'),
            'og_desc'                => setting('about_seo_meta_desc', 'Discover GoldMatrix Software story, mission, and leadership.'),
            'og_image'               => setting('about_seo_og_image', ''),
            'schema_json'            => [$breadcrumbsSchema, $orgSchema],

            // Section 1: Hero
            'about_hero_enabled'     => setting('about_hero_enabled', '1'),
            'about_hero_eyebrow'     => setting('about_hero_eyebrow', 'COMPANY & LEADERSHIP'),
            'about_hero_title'       => setting('about_hero_title', 'Powering the Global Jewellery Industry with Next-Gen ERP'),
            'about_hero_sub'         => setting('about_hero_sub', 'From boutique showrooms to multi-factory bullion networks, GoldMatrix provides precision-engineered software that turns intricate jewellery operations into seamless growth.'),
            'about_hero_bg_style'    => setting('about_hero_bg_style', 'dark'),

            // Section 2: Story
            'about_story_enabled'    => setting('about_story_enabled', '1'),
            'about_story_badge'      => setting('about_story_badge', 'OUR STORY & HERITAGE'),
            'about_story_title'      => setting('about_story_title', 'Engineered Exclusively for the Intricacies of Gold & Diamond Commerce'),
            'about_story_p1'         => setting('about_story_p1', 'GoldMatrix was born out of a simple observation: generic ERP software cannot handle the real-world complexities of the jewellery business — varying metal purities, wastage calculations, fluctuating market gold rates, Karigar manufacturing loss, and multi-branch inventory.'),
            'about_story_p2'         => setting('about_story_p2', 'Over the past 15+ years, we have collaborated with master goldsmiths, retail chain owners, and bullion traders across Dubai, India, and East Asia to craft an end-to-end platform combining deep industry-specific logic with enterprise cloud technology.'),
            'about_story_image'      => setting('about_story_image', 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=1000&auto=format&fit=crop&q=80'),

            // Section 3: Stats
            'about_stats_enabled'    => setting('about_stats_enabled', '1'),
            'stats'                  => $stats,

            // Section 4: Values
            'about_values_enabled'   => setting('about_values_enabled', '1'),
            'about_values_badge'     => setting('about_values_badge', 'OUR CORE PRINCIPLES'),
            'about_values_title'     => setting('about_values_title', 'What Guides Our Product Engineering'),
            'values'                 => $values,

            // Section 5: Timeline
            'about_timeline_enabled' => setting('about_timeline_enabled', '1'),
            'about_timeline_badge'   => setting('about_timeline_badge', 'MILESTONES'),
            'about_timeline_title'   => setting('about_timeline_title', '15 Years of Domain Leadership'),
            'timeline'               => $timeline,

            // Section 6: Global Hubs
            'about_hubs_enabled'     => setting('about_hubs_enabled', '1'),
            'about_hubs_badge'       => setting('about_hubs_badge', 'GLOBAL PRESENCE'),
            'about_hubs_title'       => setting('about_hubs_title', 'Operating Across Key Jewellery Capitals'),

            // Section 7: CTA
            'about_cta_enabled'      => setting('about_cta_enabled', '1'),
            'about_cta_title'        => setting('about_cta_title', 'Ready to Modernize Your Jewellery Operations?'),
            'about_cta_desc'         => setting('about_cta_desc', 'Join 1,500+ jewellery businesses running faster, more accurate, and more profitable operations with GoldMatrix ERP.'),
            'about_cta_btn1_text'    => setting('about_cta_btn1_text', 'Schedule Executive Demo'),
            'about_cta_btn1_link'    => setting('about_cta_btn1_link', '/contact'),
            'about_cta_btn2_text'    => setting('about_cta_btn2_text', 'Chat on WhatsApp'),
            'about_cta_whatsapp'     => setting('about_cta_whatsapp', '+91 92703 69937'),

            // Menus
            'header_menu'            => $this->getMenu('header'),
            'footer_col1_menu'       => $this->getMenu('footer_col1'),
            'footer_col2_menu'       => $this->getMenu('footer_col2'),
            'footer_col3_menu'       => $this->getMenu('footer_col3'),
            'footer_bottom_menu'     => $this->getMenu('footer_bottom'),
        ];
        view('frontend.about', $data);
    }

    /**
     * Terms & Conditions Page
     */
    public function terms(): void {
        $breadcrumbsSchema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => site_url('/')
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'Terms & Conditions',
                    'item'     => site_url('terms')
                ]
            ]
        ];

        $data = [
            'meta_title'            => setting('terms_seo_meta_title', 'Terms & Conditions | GoldMatrix Jewellery ERP'),
            'meta_desc'             => setting('terms_seo_meta_desc', 'Terms and Conditions, Software License, Multi-Branch Service Level Agreement, and Operational Policies of GoldMatrix Software Technologies.'),
            'meta_keywords'         => setting('terms_seo_keywords', 'goldmatrix terms, software license agreement, jewellery erp terms, goldmatrix sla'),
            'canonical_url'         => site_url('terms'),
            'og_title'              => setting('terms_seo_meta_title', 'Terms & Conditions | GoldMatrix Jewellery ERP'),
            'og_desc'               => setting('terms_seo_meta_desc', 'Terms and Conditions of GoldMatrix Software Technologies.'),
            'og_image'              => setting('terms_seo_og_image', ''),
            'schema_json'           => [$breadcrumbsSchema],

            'terms_hero_enabled'    => setting('terms_hero_enabled', '1'),
            'terms_hero_eyebrow'    => setting('terms_hero_eyebrow', 'LEGAL COMPLIANCE & GOVERNANCE'),
            'terms_hero_title'      => setting('terms_hero_title', 'Terms & Conditions of Service'),
            'terms_hero_subtitle'   => setting('terms_hero_subtitle', 'Standard software license, enterprise SLA, multi-branch service agreement and operational policies.'),
            'terms_last_updated'    => setting('terms_last_updated', 'September 2026'),

            'header_menu'           => $this->getMenu('header'),
            'footer_col1_menu'      => $this->getMenu('footer_col1'),
            'footer_col2_menu'      => $this->getMenu('footer_col2'),
            'footer_col3_menu'      => $this->getMenu('footer_col3'),
            'footer_bottom_menu'    => $this->getMenu('footer_bottom'),
        ];
        view('frontend.terms', $data);
    }

    /**
     * Privacy Policy Page
     */
    public function privacy(): void {
        $breadcrumbsSchema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => site_url('/')
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'Privacy Policy',
                    'item'     => site_url('privacy')
                ]
            ]
        ];

        $data = [
            'meta_title'            => setting('privacy_seo_meta_title', 'Privacy Policy & Data Security | GoldMatrix Jewellery ERP'),
            'meta_desc'             => setting('privacy_seo_meta_desc', 'Learn how GoldMatrix Software protects and safeguards confidential jewellery transactions, bullion records, customer KYC, and cloud data.'),
            'meta_keywords'         => setting('privacy_seo_keywords', 'goldmatrix privacy policy, jewellery erp data security, cloud encryption, kyc data privacy'),
            'canonical_url'         => site_url('privacy'),
            'og_title'              => setting('privacy_seo_meta_title', 'Privacy Policy & Data Security | GoldMatrix Jewellery ERP'),
            'og_desc'               => setting('privacy_seo_meta_desc', 'Privacy Policy and Data Security Standards of GoldMatrix Software Technologies.'),
            'og_image'              => setting('privacy_seo_og_image', ''),
            'schema_json'           => [$breadcrumbsSchema],

            'privacy_hero_enabled'  => setting('privacy_hero_enabled', '1'),
            'privacy_hero_eyebrow'  => setting('privacy_hero_eyebrow', 'DATA PROTECTION & SECURITY'),
            'privacy_hero_title'    => setting('privacy_hero_title', 'Privacy Policy & Data Security Standards'),
            'privacy_hero_subtitle' => setting('privacy_hero_subtitle', 'Our strict commitment to protecting trade secrets, financial records, precious metal stocks, and customer privacy.'),
            'privacy_last_updated'  => setting('privacy_last_updated', 'September 2026'),

            'header_menu'           => $this->getMenu('header'),
            'footer_col1_menu'      => $this->getMenu('footer_col1'),
            'footer_col2_menu'      => $this->getMenu('footer_col2'),
            'footer_col3_menu'      => $this->getMenu('footer_col3'),
            'footer_bottom_menu'    => $this->getMenu('footer_bottom'),
        ];
        view('frontend.privacy', $data);
    }

    /**
     * Features Overview Page (Dynamic Section-by-Section CMS Powered)
     */
    public function features(): void {
        $modules = $this->getModulesData();

        // Parse category filter categories
        $rawFilters = setting('features_filter_categories', "All 10 Modules|all\nRetail & Billing|Retail & Operations\nManufacturing & Jobwork|Manufacturing\nAccounting & GST|Finance\nStock & RFID|Inventory\nStaff & Admin|Admin");
        $filterLines = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", "", $rawFilters)))));
        $categoryFilters = [];
        foreach ($filterLines as $fLine) {
            $parts = explode('|', $fLine, 2);
            $categoryFilters[] = [
                'label' => trim($parts[0]),
                'tag'   => trim($parts[1] ?? $parts[0])
            ];
        }

        // Parse Hardware Items
        $rawHw = setting('features_hardware_items', '');
        $hwList = [];
        if (!empty($rawHw)) {
            $hwList = json_decode($rawHw, true);
        }
        if (!is_array($hwList) || empty($hwList)) {
            $hwList = [
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
            ];
        }

        $breadcrumbsSchema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => site_url('/')
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'Features & Capabilities',
                    'item'     => site_url('features')
                ]
            ]
        ];

        $softwareSchema = [
            '@context'            => 'https://schema.org',
            '@type'               => 'SoftwareApplication',
            'name'                => 'GoldMatrix Jewellery ERP — 10 Core Enterprise Modules',
            'operatingSystem'     => 'Web Browser, Windows, Android, iOS',
            'applicationCategory' => 'BusinessApplication',
            'description'         => 'Complete Jewellery ERP Software with Inventory, POS, GST, Manufacturing, and Multi-Branch Management.',
            'offers'              => [
                '@type'         => 'Offer',
                'price'         => '0',
                'priceCurrency' => 'INR',
                'description'   => 'Free 1-on-1 Interactive Demo & Trial'
            ],
            'publisher'           => [
                '@type' => 'Organization',
                'name'  => 'GoldMatrix Software Technologies',
                'url'   => site_url('/')
            ]
        ];

        $data = [
            // ── SEO & Meta ──
            'meta_title'         => setting('features_seo_meta_title', 'Complete Jewellery ERP Features & 10 Core Modules | GoldMatrix'),
            'meta_desc'          => setting('features_seo_meta_desc', 'Explore all 10 core modules of GoldMatrix Jewellery ERP: Dashboard & Live Rates, Opening Setup, Operations, Order Management, Production, Financial Statements, Report Analysis, Employee Management, Stock Management, and Settings.'),
            'meta_keywords'      => setting('features_seo_keywords', 'jewellery erp modules, jewellery features, gold erp features, jewellery production software, jewellery stock management, jewellery accounting'),
            'canonical_url'      => site_url('features'),
            'og_title'           => setting('features_seo_meta_title', 'Complete Jewellery ERP Features & 10 Core Modules | GoldMatrix'),
            'og_desc'            => setting('features_seo_meta_desc', 'Explore all 10 core modules of GoldMatrix Jewellery ERP.'),
            'og_image'           => setting('features_seo_og_image', ''),
            'schema_json'        => [$breadcrumbsSchema, $softwareSchema],

            // ── 1. Hero Section ──
            'hero_enabled'       => setting('features_hero_enabled', '1'),
            'hero_badge'         => setting('features_hero_badge', '10 Integrated Modules'),
            'hero_title'         => setting('features_hero_title', 'Every Capability Engineered for'),
            'hero_highlight'     => setting('features_hero_highlight', 'Jewellery Business ERP'),
            'hero_desc'          => setting('features_hero_desc', 'Explore all 10 core modules powering jewellery retail showrooms, wholesale bullion traders, and manufacturing workshop units worldwide.'),
            'hero_bg_style'      => setting('features_hero_bg_style', 'navy'),

            // ── 2. Category Filter ──
            'filter_enabled'     => setting('features_filter_enabled', '1'),
            'category_filters'   => $categoryFilters,

            // ── 3. Modules Grid ──
            'grid_enabled'       => setting('features_grid_enabled', '1'),
            'grid_title'         => setting('features_grid_title', '10 Enterprise Jewellery Modules'),
            'grid_subtitle'      => setting('features_grid_subtitle', 'Complete end-to-end integration across all operational departments.'),
            'modules'            => $modules,

            // ── 4. Hardware Ecosystem ──
            'hardware_enabled'   => setting('features_hardware_enabled', '1'),
            'hardware_badge'     => setting('features_hardware_badge', 'PLUG & PLAY ECOSYSTEM'),
            'hardware_title'     => setting('features_hardware_title', 'Certified Compatibility with Showroom & Factory Hardware'),
            'hardware_items'     => $hwList,

            // ── 5. Bottom Conversion CTA ──
            'cta_enabled'        => setting('features_cta_enabled', '1'),
            'cta_title'          => setting('features_cta_title', 'See All 10 Modules in a Live Personalized Demo'),
            'cta_desc'           => setting('features_cta_desc', 'Schedule a private 30-minute walkthrough with a jewellery ERP specialist to see how GoldMatrix automates your showroom, factory, and multi-branch operations.'),
            'cta_btn1_text'      => setting('features_cta_btn1_text', 'Book Free Live Demo'),
            'cta_btn1_link'      => setting('features_cta_btn1_link', '#bookDemoModal'),
            'cta_btn2_text'      => setting('features_cta_btn2_text', 'Chat on WhatsApp'),
            'cta_whatsapp'       => setting('features_cta_whatsapp', '+91 92703 69937'),

            // ── Menus ──
            'header_menu'        => $this->getMenu('header'),
            'footer_col1_menu'   => $this->getMenu('footer_col1'),
            'footer_col2_menu'   => $this->getMenu('footer_col2'),
            'footer_col3_menu'   => $this->getMenu('footer_col3'),
            'footer_bottom_menu' => $this->getMenu('footer_bottom'),
        ];

        view('frontend.features', $data);
    }

    /**
     * Contact Us Page - Dynamic Section-by-Section CMS Powered
     */
    public function contact(): void {
        // Parse services list
        $rawServices = setting('contact_form_services', "Retail POS & Billing Software\nJewellery Manufacturing & Jobwork Software\nWholesale & Bullion Management\nRFID Inventory Automation\nGirvi (Money Lending) & Kitty Schemes\nJewellery GST Invoicing & Accounting\nGeneral Enterprise Consultation");
        $servicesList = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", "", $rawServices)))));

        // Parse FAQs
        $rawFaqs = setting('contact_faq_items', '');
        $faqsList = [];
        if (!empty($rawFaqs)) {
            $faqsList = json_decode($rawFaqs, true);
        }
        if (!is_array($faqsList) || empty($faqsList)) {
            $faqsList = [
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
            ];
        }

        $breadcrumbsSchema = [
            '@context' => 'https://schema.org',
            '@type'    => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => site_url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Contact Us', 'item' => site_url('contact')]
            ]
        ];

        $data = [
            // ── SEO & Meta ──
            'meta_title'         => setting('contact_seo_meta_title', 'Contact Us | GoldMatrix Software Technologies (UAE & India)'),
            'meta_desc'          => setting('contact_seo_meta_desc', 'Contact GoldMatrix Jewellery ERP specialists. UAE Headquarter in Sharjah Gold Souq and India Tech Hub in Maharashtra. Call +971 56 324 0319.'),
            'meta_keywords'      => setting('contact_seo_keywords', 'contact goldmatrix, jewellery software support, goldmatrix sharjah uae, goldmatrix india office, jewellery pos demo'),
            'canonical_url'      => site_url('contact'),
            'og_title'           => setting('contact_seo_meta_title', 'Contact Us | GoldMatrix Software Technologies (UAE & India)'),
            'og_desc'            => setting('contact_seo_meta_desc', 'Contact GoldMatrix Jewellery ERP specialists.'),
            'og_image'           => setting('contact_seo_og_image', ''),
            'schema_json'        => [$breadcrumbsSchema],

            // ── 1. HERO SECTION ──
            'hero_enabled'       => setting('contact_hero_enabled', '1'),
            'hero_eyebrow'       => setting('contact_hero_eyebrow', 'GLOBAL SPECIALIST NETWORK'),
            'hero_title'         => setting('contact_hero_title', 'Connect with Our ERP Architects'),
            'hero_subtitle'      => setting('contact_hero_subtitle', 'Have a question about our enterprise architecture, hardware compatibility, or ready to schedule a product simulation? Our offices in the UAE and India are at your service.'),
            'hero_bg_style'      => setting('contact_hero_bg_style', 'dark'),

            // ── 2. UAE OFFICE ──
            'uae_enabled'        => setting('contact_uae_enabled', '1'),
            'uae_office'         => [
                'tag'      => setting('contact_uae_tag', 'INTERNATIONAL HEADQUARTER'),
                'country'  => setting('contact_uae_country', 'United Arab Emirates (Headquarter)'),
                'address'  => setting('contact_uae_address', 'Shop No. 25/A, Central Gold Souq Block No. 8, Al Majaz -1 King Faisal Road - Sharjah'),
                'phone'    => setting('contact_uae_phone', '+971 56 324 0319'),
                'whatsapp' => setting('contact_uae_whatsapp', '+971 56 324 0319'),
                'email'    => setting('contact_uae_email', 'info@goldmatrixsoftware.com'),
                'hours'    => setting('contact_uae_hours', 'Mon - Sat: 9:00 AM - 8:00 PM GST'),
                'icon'     => 'bi-geo-alt-fill'
            ],

            // ── 3. INDIA OFFICE ──
            'india_enabled'      => setting('contact_india_enabled', '1'),
            'india_office'       => [
                'tag'      => setting('contact_india_tag', 'DEVELOPMENT & TECH HUB'),
                'country'  => setting('contact_india_country', 'India (Development & Operations Hub)'),
                'address'  => setting('contact_india_address', 'India, 01/A, Hingna Rd, M.I.D.C, Maharashtra - 440022'),
                'phone'    => setting('contact_india_phone', '+91 92703 69937'),
                'whatsapp' => setting('contact_india_whatsapp', '+91 92703 69937'),
                'email'    => setting('contact_india_email', 'goldmatrixsoftware@gmail.com'),
                'hours'    => setting('contact_india_hours', 'Mon - Sat: 9:30 AM - 7:00 PM IST'),
                'icon'     => 'bi-building'
            ],

            // ── 4. CONSULTATION FORM ──
            'form_enabled'       => setting('contact_form_enabled', '1'),
            'form_tag'           => setting('contact_form_tag', 'DIRECT CONSULTATION'),
            'form_title'         => setting('contact_form_title', 'Schedule a Private Demo'),
            'form_subtitle'      => setting('contact_form_subtitle', 'Fill out the form below and an ERP consultant will reach out within 2 business hours.'),
            'form_services'      => $servicesList,
            'form_btn_text'      => setting('contact_form_btn_text', 'Submit Enquiry & Schedule Demo'),
            'form_success_msg'   => setting('contact_form_success_msg', 'Thank you! Our jewelry ERP specialist will contact you shortly for a personalized demo.'),

            // ── 5. DIRECT HOTLINE & CHANNELS ──
            'hotline_enabled'    => setting('contact_hotline_enabled', '1'),
            'hotline_title'      => setting('contact_hotline_title', 'Need Instant ERP Assistance or Customized Quotation?'),
            'hotline_subtitle'   => setting('contact_hotline_subtitle', 'Connect directly with our senior jewellery ERP implementation team for express query resolution.'),
            'hotline_whatsapp'   => setting('contact_hotline_whatsapp', '+91 92703 69937'),
            'hotline_call'       => setting('contact_hotline_call', '+971 56 324 0319'),
            'hotline_sales_email'=> setting('contact_hotline_sales_email', 'sales@goldmatrixsoftware.com'),
            'hotline_support_email'=> setting('contact_hotline_support_email', 'support@goldmatrixsoftware.com'),

            // ── 6. GOOGLE MAPS ──
            'maps_enabled'       => setting('contact_maps_enabled', '1'),
            'maps_title'         => setting('contact_maps_title', 'Visit Our Global Offices'),
            'maps_subtitle'      => setting('contact_maps_subtitle', 'Visit our international technology centers or schedule an in-person boardroom demonstration.'),
            'map_uae_embed'      => setting('contact_map_uae_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3606.319766526145!2d55.385412!3d25.327091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5bc03cb1bd3b%3A0x86708ad00d075218!2sCentral%20Gold%20Souq%2C%20Sharjah!5e0!3m2!1sen!2sae!4v1700000000000'),
            'map_india_embed'    => setting('contact_map_india_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119066.42985160846!2d78.990108!3d21.161028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4c0a5a31faf13%3A0x19b37d30d1785929!2sMIDC%20Industrial%20Area%2C%20Nagpur!5e0!3m2!1sen!2sin!4v1700000000000'),

            // ── 7. FAQS ──
            'faq_enabled'        => setting('contact_faq_enabled', '1'),
            'faq_title'          => setting('contact_faq_title', 'Frequently Asked Questions'),
            'faq_subtitle'       => setting('contact_faq_subtitle', 'Quick answers to commonly asked questions about our jewelry ERP demonstrations and onboarding.'),
            'faq_items'          => $faqsList,

            // ── Menus ──
            'header_menu'        => $this->getMenu('header'),
            'footer_col1_menu'   => $this->getMenu('footer_col1'),
            'footer_col2_menu'   => $this->getMenu('footer_col2'),
            'footer_col3_menu'   => $this->getMenu('footer_col3'),
            'footer_bottom_menu' => $this->getMenu('footer_bottom'),
        ];

        view('frontend.contact', $data);
    }

    /**
     * Handle lead / demo submission
     */
    /**
     * Handle lead / demo submission
     */
    public function submitLead(): void {
        header('Content-Type: application/json');
        try {
            // Anti-Bot Honeypot trap
            if (!empty($_POST['website_hp']) || !empty($_POST['hp_field'])) {
                echo json_encode(['success' => true, 'message' => 'Thank you! Our jewelry ERP specialist will contact you shortly for a personalized demo.']);
                return;
            }

            // IP Rate Limiting (Max 10 submissions / hour)
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $throttleKey = 'lead_api_' . $ip;
            if (\App\Services\AuthService::isThrottled($throttleKey, 10, 3600) > 0) {
                http_response_code(429);
                echo json_encode(['success' => false, 'message' => 'Too many requests from this IP. Please wait a while or contact us directly on WhatsApp.']);
                return;
            }

            $name    = substr(trim($_POST['name'] ?? ''), 0, 150);
            $email   = substr(trim($_POST['email'] ?? ''), 0, 150);
            $phone   = substr(trim($_POST['phone'] ?? ''), 0, 50);
            $company = substr(trim($_POST['company'] ?? ''), 0, 150);
            $service = substr(trim($_POST['service'] ?? 'General Enquiry'), 0, 150);
            $message = substr(trim($_POST['message'] ?? ''), 0, 3000);

            if (empty($name) || empty($phone)) {
                echo json_encode(['success' => false, 'message' => 'Please provide your name and phone number.']);
                return;
            }

            if (empty($email)) {
                $email = 'not-provided@' . preg_replace('/[^0-9]/', '', $phone) . '.com';
            }

            $fullMessage = "Service Interested: " . $service . "\n" . $message;

            $this->db->query(
                "INSERT INTO leads (name, company, email, phone, message, source, status) VALUES (?, ?, ?, ?, ?, ?, 'new')",
                [$name, $company, $email, $phone, $fullMessage, 'Service Sub-Page Demo Form']
            );

            \App\Services\AuthService::recordAttempt($throttleKey, 3600);

            echo json_encode(['success' => true, 'message' => 'Thank you! Our jewelry ERP specialist will contact you shortly for a personalized demo.']);
        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'message' => 'An error occurred while submitting your request. Please try again.']);
        }
    }

    /**
     * Services Knowledge Repository
     */
    public function getServicesData(): array {
        return [
            'jewelry-retail-pos-software' => [
                'slug'           => 'jewelry-retail-pos-software',
                'title'          => 'Jewelry Retail POS & Showroom Management',
                'badge'          => 'ENTERPRISE RETAIL POS',
                'category'       => 'Retail & Billing Automation',
                'hero_subtitle'  => 'High-speed billing, live gold rate valuation, touch-screen estimations, and automated purity conversion for modern jewellery retailers.',
                'hero_desc'      => 'GoldMatrix Retail POS transforms your jewellery store counter operations into a frictionless, ultra-fast checkout experience. Built specifically for complex weight calculations, making charges, gemstone valuation, and instant GST invoicing.',
                'hero_image'     => '/assets/images/why-goldmatrix-mockup.png',
                'meta_title'     => 'Jewelry Retail POS & Billing Software | GoldMatrix ERP',
                'meta_desc'      => 'High-speed Jewelry Retail POS software for modern jewelers. Touch-screen billing, automated weight calculations, old gold exchange, and instant GST invoices.',
                'meta_keywords'  => 'jewelry retail pos software, jewellery store billing system, gold billing software, jewellery counter pos, jewelry estimation to invoice',
                'accent_color'   => '#DC9423',
                'icon'           => 'bi-shop',
                'challenges'     => [
                    [
                        'pain' => 'Slow counter queues during festive seasons due to manual calculation of net weight, wastage, and making charges.',
                        'solution' => 'Instant 3-second barcode/RFID item scan with automated purity, weight, and rate lookup directly at the POS counter.'
                    ],
                    [
                        'pain' => 'Errors in calculating Old Gold exchange purity, melt loss, and dynamic tax adjustments.',
                        'solution' => 'Built-in Old Gold Purchase calculator with instant touchscreen estimation slips, photo capture, and ledger adjustments.'
                    ],
                    [
                        'pain' => 'Discrepancies between showroom counter inventory and backend accounting.',
                        'solution' => 'Real-time stock deduction the exact millisecond a bill is paid, synced across multiple branch counters simultaneously.'
                    ]
                ],
                'capabilities'   => [
                    [
                        'icon'  => 'bi-speedometer2',
                        'title' => 'Lightning-Fast Multi-Counter Billing',
                        'desc'  => 'Generate GST invoices, customer estimates, advance receipts, and delivery challans in under 5 seconds with barcode/RFID integration.',
                        'points'=> ['Barcode & RFID instant scanning', 'Touchscreen POS interface', 'Thermal & A4/A5 custom print templates', 'Offline billing with auto-sync']
                    ],
                    [
                        'icon'  => 'bi-coin',
                        'title' => 'Old Gold Exchange & Valuation',
                        'desc'  => 'Process customer old gold, silver, and diamond exchanges with automated purity deduction, melting loss formulas, and customer verification.',
                        'points'=> ['Digital photo capture of old items', 'Automated scrap ledger settlement', 'Purity karam calculations', 'Instant voucher generation']
                    ],
                    [
                        'icon'  => 'bi-currency-exchange',
                        'title' => 'Dynamic Gold Rate Board Sync',
                        'desc'  => 'Link your counter prices live to the market gold rate board. Daily 24K, 22K, 18K, 14K, and 925 Silver rates update automatically across all branches.',
                        'points'=> ['Real-time rate board integration', 'Multi-metal price fixing', 'Board rate display for customers', 'Margin & discount control']
                    ],
                    [
                        'icon'  => 'bi-person-badge',
                        'title' => 'Salesman Commission & Incentives',
                        'desc'  => 'Track counter staff performance, sales targets, and custom commission structures (flat, percentage on making charges, or category-wise).',
                        'points'=> ['Individual & shared sales attribution', 'Monthly target tracking dashboards', 'Automated commission payroll slips', 'Staff activity logs']
                    ],
                    [
                        'icon'  => 'bi-phone-flip',
                        'title' => 'Digital Estimation & WhatsApp Bills',
                        'desc'  => 'Send professional estimation slips and official tax invoices directly to customer WhatsApp and SMS with a single tap.',
                        'points'=> ['1-Click WhatsApp invoice sharing', 'QR code payment links embedded', 'PDF invoice download link', 'Opt-in promotional notifications']
                    ],
                    [
                        'icon'  => 'bi-shield-check',
                        'title' => 'Role-Based Fraud Protection',
                        'desc'  => 'Protect showroom profits with granular staff permissions, manager approval for discounts, and audit logs on cancelled/edited bills.',
                        'points'=> ['Manager OTP for price overrides', 'Void bill audit trail', 'Cash drawer reconciliation', 'Biometric login support']
                    ]
                ],
                'workflow'       => [
                    ['step' => '01', 'title' => 'Scan & Identify', 'desc' => 'Scan jewellery tags via barcode or RFID scanner. Weight, purity, hallmark, and stone details populate instantly.'],
                    ['step' => '02', 'title' => 'Calculate & Apply Rates', 'desc' => 'System automatically fetches current metal board rates, adds making charges, applies promotions, and calculates GST.'],
                    ['step' => '03', 'title' => 'Settle & Pay', 'desc' => 'Accept split payments (Cash, Card, UPI, Old Gold exchange, Saving Scheme redemption) with instant validation.'],
                    ['step' => '04', 'title' => 'Print & Sync', 'desc' => 'Print professional tax invoice, dispatch WhatsApp notification, and auto-update stock and accounts in real time.']
                ],
                'kpis'           => [
                    ['stat' => '3x', 'label' => 'Faster Counter Checkout', 'sub' => 'Zero manual calculations'],
                    ['stat' => '100%', 'label' => 'GST & E-Way Bill Compliance', 'sub' => 'Automated HSN and tax splits'],
                    ['stat' => '0%', 'label' => 'Discrepancy in Old Gold Exchange', 'sub' => 'Standardized purity loss formula'],
                    ['stat' => '99.9%', 'label' => 'Real-Time Inventory Precision', 'sub' => 'Instant stock decrement']
                ],
                'faqs'           => [
                    ['q' => 'Can GoldMatrix POS handle different purity categories (22K, 18K, 14K, 9K)?', 'a' => 'Yes! GoldMatrix supports all precious metal purities (Gold, Silver, Platinum, Palladium) and handles stone weight, diamond carat, and certification details separately from net metal weight.'],
                    ['q' => 'Does the POS software work if the showroom internet goes down?', 'a' => 'Absolutely. GoldMatrix features built-in offline billing resilience. You can continue scanning items and printing invoices; once internet connectivity resumes, all transactions sync seamlessly to the cloud.'],
                    ['q' => 'Can we customize invoice print templates with our logo, terms, and hallmark QR code?', 'a' => 'Yes. You have full control over invoice layouts, including A4, A5, and thermal roll formats with your showroom branding, BIS Hallmark QR codes, GST numbers, and bank payment QR codes.'],
                    ['q' => 'How does Old Gold purchase and exchange work at the counter?', 'a' => 'The software provides a dedicated Old Gold calculation module where you input gross weight, estimated purity, melting loss, and stone deduction. The net credit is instantly applied as a payment method on the new purchase.']
                ],
                'related_slugs'  => ['rfid-jewelry-automation', 'jewelry-accounting-gst-software', 'jewelry-ecommerce-catalog']
            ],

            'jewelry-manufacturing-software' => [
                'slug'           => 'jewelry-manufacturing-software',
                'title'          => 'Jewelry Manufacturing & Jobwork Software',
                'badge'          => 'PRODUCTION & WORKFLOW CONTROL',
                'category'       => 'Manufacturing & Jobwork Management',
                'hero_subtitle'  => 'Track metal issue, receipt, melting loss, jobwork slips, stone setting, and production payroll with zero metal leakage.',
                'hero_desc'      => 'A specialized manufacturing ERP built for jewellery casting, stamping, CAD/CAM, handmade production, and outsourced jobwork. Gain total visibility into Work-in-Progress (WIP), metal balances, and stone inventory from melting to final polish.',
                'hero_image'     => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?w=800&auto=format&fit=crop&q=80',
                'meta_title'     => 'Jewelry Manufacturing & Jobwork Software | GoldMatrix ERP',
                'meta_desc'      => 'End-to-end Jewelry Manufacturing ERP. Production work orders, jobwork management, metal loss tracking, purity conversion, WIP monitoring, and stone setting control.',
                'meta_keywords'  => 'jewelry manufacturing software, jewelry jobwork software, jewelry production tracking, metal loss calculation, jobwork slip software',
                'accent_color'   => '#F59E0B',
                'icon'           => 'bi-hammer',
                'challenges'     => [
                    [
                        'pain' => 'Uncontrolled gold and silver metal loss during casting, filing, setting, and polishing stages.',
                        'solution' => 'Stage-by-stage metal issue and return tracking with automated standard vs actual loss variance alerts.'
                    ],
                    [
                        'pain' => 'Confusion in tracking jobwork orders, due dates, and metal balances in hand.',
                        'solution' => 'Digital Jobwork Ledgers with barcode jobwork sheets, live metal balance status, and wage calculation.'
                    ],
                    [
                        'pain' => 'Lack of real-time visibility into Work-In-Progress (WIP) order status for showroom customers.',
                        'solution' => 'Color-coded digital Kanban board showing order stages: CAD, Wax, Casting, Stone Setting, Hallmarking, and Finishing.'
                    ]
                ],
                'capabilities'   => [
                    [
                        'icon'  => 'bi-receipt-cutoff',
                        'title' => 'Barcode Jobwork Slip Generation',
                        'desc'  => 'Create digital job sheets with customer design photos, exact metal weight issued, purity, required stone count, and delivery deadlines.',
                        'points'=> ['Custom design attachment', 'Unique barcode per job bag', 'Stage-wise routing definition', 'Priority flag for urgent orders']
                    ],
                    [
                        'icon'  => 'bi-percent',
                        'title' => 'Metal Loss & Wastage Tracking',
                        'desc'  => 'Set standard allowable wastage percentages by jewelry category. System automatically highlights abnormal metal loss during filing, casting, and buffing.',
                        'points'=> ['Standard vs actual loss reports', 'Scrap & dust recovery tracking', 'Karigar-wise loss scorecards', 'Purity conversion calculator']
                    ],
                    [
                        'icon'  => 'bi-kanban',
                        'title' => 'Live WIP Production Dashboard',
                        'desc'  => 'Track hundreds of active jewellery orders across multiple departments (Melting, Casting, Filing, Setting, Meena, Rhodium, Quality Check).',
                        'points'=> ['Visual production pipeline', 'Department bottleneck alerts', 'Automated customer SMS on stage completion', 'Target delivery monitoring']
                    ],
                    [
                        'icon'  => 'bi-gem',
                        'title' => 'Stone & Findings Inventory Control',
                        'desc'  => 'Manage diamond packets, color stones, pearls, and pre-cast findings issued to karigars. Track broken stones and unused returns with precision.',
                        'points'=> ['Carat, cut, color, clarity tracking', 'Broken stone approval workflow', 'Sieve size classification', 'Findings weight reconciliation']
                    ],
                    [
                        'icon'  => 'bi-wallet2',
                        'title' => 'Karigar Payroll & Labor Settlement',
                        'desc'  => 'Automate karigar labor calculations based on piece rate, weight-based labor, stone setting count, or daily wages with advance deductions.',
                        'points'=> ['Piece-wise & gram-wise labor tariffs', 'Karigar advance payment ledger', 'Automated TDS calculation', 'Biometric attendance sync']
                    ],
                    [
                        'icon'  => 'bi-patch-check',
                        'title' => 'Quality Control & BIS Hallmarking',
                        'desc'  => 'Integrated QC inspection checklists before dispatching to hallmarking centres and transferring finished goods to retail showrooms.',
                        'points'=> ['HUID number assignment', 'XRF purity testing logs', 'Reject & rework routing', 'Finished stock barcode tagging']
                    ]
                ],
                'workflow'       => [
                    ['step' => '01', 'title' => 'Design & Job Card Creation', 'desc' => 'Generate barcode job sheet with 3D CAD design, metal specification, purity, and diamond count.'],
                    ['step' => '02', 'title' => 'Metal & Material Issue', 'desc' => 'Issue gold/silver alloy, stones, and findings to karigar. System records exact gross and net weight.'],
                    ['step' => '03', 'title' => 'Stage Processing & Loss Audit', 'desc' => 'Track order through casting, filing, setting, and polishing. Calculate stage-wise metal recovery and loss.'],
                    ['step' => '04', 'title' => 'QC, Hallmarking & Transfer', 'desc' => 'Conduct final quality audit, assign HUID barcode tag, and transfer finished jewelry to showroom inventory.']
                ],
                'kpis'           => [
                    ['stat' => '0%', 'label' => 'Untracked Metal Leakage', 'sub' => 'Strict issue-return balance'],
                    ['stat' => '35%', 'label' => 'Shorter Production Cycles', 'sub' => 'Live stage tracking'],
                    ['stat' => '100%', 'label' => 'Karigar Ledger Clarity', 'sub' => 'Automated labor & metal accounts'],
                    ['stat' => '99.5%', 'label' => 'First-Time Quality Pass Rate', 'sub' => 'Integrated stage-wise QC']
                ],
                'faqs'           => [
                    ['q' => 'Can GoldMatrix track both in-house workshops and third-party outside karigars?', 'a' => 'Yes. GoldMatrix supports internal manufacturing workshops as well as external jobwork contractors with dedicated metal ledgers, labor billing, and GST e-way bills for jobwork.'],
                    ['q' => 'How does the software handle gold purity differences (e.g. issuing 24K and receiving 22K finished jewelry)?', 'a' => 'The software includes an automated purity conversion engine (Fine Gold Equivalency) that converts all purities to 100% pure fine gold, ensuring accurate accounting across different karatages.'],
                    ['q' => 'Can we track diamond setting and stone breakage during manufacturing?', 'a' => 'Yes. Stones are issued in exact quantities/carats. If a stone breaks during setting, a supervisor can log it under broken stone loss with reason codes, maintaining complete diamond accountability.'],
                    ['q' => 'Can the karigar view their assigned job sheets on a mobile app?', 'a' => 'Yes. We offer a Karigar Companion App where artisans can view assigned job cards, upload progress photos, request additional materials, and view their labor earnings.']
                ],
                'related_slugs'  => ['jewelry-retail-pos-software', 'rfid-jewelry-automation', 'wholesale-bullion-management']
            ],

            'wholesale-bullion-management' => [
                'slug'           => 'wholesale-bullion-management',
                'title'          => 'Wholesale Jewellery & Bullion Trading ERP',
                'badge'          => 'B2B & BULLION DEALER SYSTEM',
                'category'       => 'Wholesale & Bullion Operations',
                'hero_subtitle'  => 'Live metal rate fixing, bulk order allocation, bullion dealing, inter-branch stock transfers, and B2B party ledger reconciliation.',
                'hero_desc'      => 'Engineered specifically for jewellery wholesalers, bullion merchants, and multi-branch distribution networks. Manage forward rate booking, fine metal settlements, bulk order packing lists, and multi-currency international transactions.',
                'hero_image'     => 'https://images.unsplash.com/photo-1610375461246-83df859d849d?w=800&auto=format&fit=crop&q=80',
                'meta_title'     => 'Wholesale Jewelry & Bullion Trading Software | GoldMatrix ERP',
                'meta_desc'      => 'Enterprise wholesale jewelry and bullion trading ERP. Live gold rate fixing, B2B order management, fine metal ledger reconciliation, and bullion dealing.',
                'meta_keywords'  => 'wholesale jewelry software, bullion trading erp, gold rate fixing software, bullion merchant management, b2b jewelry erp',
                'accent_color'   => '#EAB308',
                'icon'           => 'bi-box-seam',
                'challenges'     => [
                    [
                        'pain' => 'High market volatility risk when dealing in unhedged forward gold rates and bulk delivery orders.',
                        'solution' => 'Real-time Bullion Position Book with live exposure tracking, rate fixing contracts, and automatic stop-loss alerts.'
                    ],
                    [
                        'pain' => 'Complex B2B settlement involving cash, fine gold metal return, and partial bank transfers.',
                        'solution' => 'Dual-Currency Party Ledgers tracking both Rupee/USD monetary balances and Grams fine gold balances simultaneously.'
                    ],
                    [
                        'pain' => 'Difficulties in managing multi-branch stock transfers, transit insurance, and transit approvals.',
                        'solution' => 'Automated Inter-Branch Transfer vouchers with digital gate passes, delivery challans, and real-time receiving verification.'
                    ]
                ],
                'capabilities'   => [
                    [
                        'icon'  => 'bi-graph-up-arrow',
                        'title' => 'Live Bullion Rate Fixing & Booking',
                        'desc'  => 'Book spot and forward metal rates with wholesale buyers and suppliers. Lock in MCX/international market rates instantly with contract confirmations.',
                        'points'=> ['Live MCX / Kitco feed integration', 'Contract note generation', 'Exposure & position monitoring', 'Delivery date tracking']
                    ],
                    [
                        'icon'  => 'bi-journals',
                        'title' => 'Dual Metal & Currency B2B Ledgers',
                        'desc'  => 'Manage party statements with separate columns for Money (INR/AED/USD) and Pure Metal (Fine Gold/Silver Grams), with automatic cross-settlement.',
                        'points'=> ['Fine gold ledger balance', 'Currency balance statement', 'Interest calculation on overdue metal', '1-Click WhatsApp statement dispatch']
                    ],
                    [
                        'icon'  => 'bi-boxes',
                        'title' => 'Bulk Order & Packing List Automation',
                        'desc'  => 'Create wholesale packing boxes, assign barcode tags, and generate comprehensive delivery manifests with item-wise weights, purity, and gross values.',
                        'points'=> ['Batch packing list generation', 'Gross to net weight breakdown', 'Multi-carton shipping labels', 'Export invoice compliance']
                    ],
                    [
                        'icon'  => 'bi-buildings',
                        'title' => 'Multi-Branch & Warehouse Hubs',
                        'desc'  => 'Transfer stock seamlessly between main manufacturing hubs, regional wholesale offices, and retail franchises with zero transit shrinkage.',
                        'points'=> ['Transfer in-transit tracking', 'Digital delivery confirmation', 'Transit insurance logging', 'Centralized stock visibility']
                    ],
                    [
                        'icon'  => 'bi-file-earmark-spreadsheet',
                        'title' => 'Wholesale Catalog & Order Booking',
                        'desc'  => 'Empower your B2B sales team and retailers to browse product catalogs and place bulk pre-orders through a secure wholesale portal.',
                        'points'=> ['Private B2B dealer portal', 'Custom price lists per customer tier', 'Order status tracking', 'Credit limit enforcement']
                    ],
                    [
                        'icon'  => 'bi-shield-shaded',
                        'title' => 'Anti-Money Laundering & KYC Compliance',
                        'desc'  => 'Meet strict regulatory guidelines with automated KYC documentation, PAN/Aadhaar/Emirates ID verification, and high-value cash transaction alerts.',
                        'points'=> ['KYC document vault', 'Cash transaction threshold alerts', 'Audit-ready compliance reports', 'Suspicious activity logging']
                    ]
                ],
                'workflow'       => [
                    ['step' => '01', 'title' => 'Rate Fixing & Contract', 'desc' => 'Fix live bullion rate with B2B buyer. System locks position and issues digital contract note.'],
                    ['step' => '02', 'title' => 'Order Picking & Packing', 'desc' => 'Pick finished goods from wholesale vaults. Scan barcode tags to compile automated packing list.'],
                    ['step' => '03', 'title' => 'Dispatch & E-Way Bill', 'desc' => 'Generate GST tax invoice, delivery challan, and automated government E-Way bill with transit tracking.'],
                    ['step' => '04', 'title' => 'Dual Settlement', 'desc' => 'Receive payment via bank wire or pure metal bar deposit. Party dual ledger updates instantly.']
                ],
                'kpis'           => [
                    ['stat' => 'Real-Time', 'label' => 'Bullion Exposure Tracking', 'sub' => 'Zero unhedged risk'],
                    ['stat' => '100%', 'label' => 'Dual Ledger Accuracy', 'sub' => 'Money + Fine Gold balance'],
                    ['stat' => '5x', 'label' => 'Faster Bulk Order Dispatch', 'sub' => 'Automated packing lists'],
                    ['stat' => 'Multi-Branch', 'label' => 'Centralized Stock Control', 'sub' => 'Full transit tracking']
                ],
                'faqs'           => [
                    ['q' => 'How does the Dual Ledger system work for wholesale customers?', 'a' => 'A wholesale customer can pay for jewellery using cash, bank transfer, or by returning 99.9% pure gold bars (Kaccha/Chokha gold). The software maintains two parallel running balances (Money and Fine Metal) and allows cross-conversion at agreed rates.'],
                    ['q' => 'Can the software integrate with live market gold rate feeds?', 'a' => 'Yes. GoldMatrix connects to real-time market API feeds (MCX, LBMA, Dubai Gold Rate) to display live rates on your terminals and auto-populate rates into sales and purchase contracts.'],
                    ['q' => 'Can we set custom credit limits and credit periods for different wholesale parties?', 'a' => 'Yes. You can configure custom credit limits (in both currency and fine metal grams) as well as payment terms. The system will automatically block new orders if limits are exceeded.']
                ],
                'related_slugs'  => ['jewelry-retail-pos-software', 'jewelry-manufacturing-software', 'jewelry-accounting-gst-software']
            ],

            'rfid-jewelry-automation' => [
                'slug'           => 'rfid-jewelry-automation',
                'title'          => 'RFID & Barcode Jewelry Inventory Automation',
                'badge'          => 'NEXT-GEN INVENTORY AUDIT',
                'category'       => 'Inventory & RFID Technology',
                'hero_subtitle'  => 'Audit 1,000+ jewellery items in under 60 seconds, eliminate stock theft, and speed up showroom billing with smart RFID tags.',
                'hero_desc'      => 'GoldMatrix RFID Automation integrates UHF RFID hardware, mobile handheld readers, smart trays, and RFID tag printers directly into your Jewellery ERP. Perform daily stock audits in seconds, locate missing pieces instantly, and prevent showroom shrinkage.',
                'hero_image'     => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=800&auto=format&fit=crop&q=80',
                'meta_title'     => 'Jewelry RFID & Barcode Inventory Software | GoldMatrix ERP',
                'meta_desc'      => 'Speed up jewelry inventory counting with RFID technology. Audit showroom stock in seconds, find misplaced items with Geiger counter mode, and prevent shrinkage.',
                'meta_keywords'  => 'jewelry rfid software, rfid stock audit jewelry, rfid jewelry tags, jewelry barcode automation, smart jewelry inventory',
                'accent_color'   => '#10B981',
                'icon'           => 'bi-upc-scan',
                'challenges'     => [
                    [
                        'pain' => 'Daily manual counting of thousands of jewelry pieces takes 2-3 hours every morning and evening.',
                        'solution' => 'Scan entire trays and display cases in 30 seconds using handheld RFID wands, reducing audit time by 95%.'
                    ],
                    [
                        'pain' => 'Stock shrinkage, theft, and misplaced high-value items discovered days or weeks later.',
                        'solution' => 'Instant missing item reports showing exact SKU, category, counter location, and image of unaccounted pieces.'
                    ],
                    [
                        'pain' => 'Counter congestion as staff manually key in serial numbers or scan barcode tags one by one.',
                        'solution' => 'Place the customer selection on an RFID smart tray for instant simultaneous multi-item billing.'
                    ]
                ],
                'capabilities'   => [
                    [
                        'icon'  => 'bi-broadcast',
                        'title' => 'Ultra-High Speed Tray & Shelf Audit',
                        'desc'  => 'Wave handheld RFID scanner over display showcases to read up to 700 tags per second. Instant visual matching against ERP stock.',
                        'points'=> ['700+ tags/second read rate', 'Audits full store in under 15 minutes', 'Green/Red match indicators', 'Export discrepancy reports']
                    ],
                    [
                        'icon'  => 'bi-search',
                        'title' => 'Geiger Counter Item Locator',
                        'desc'  => 'Need to find a specific misplaced necklace or diamond ring? Set the RFID reader to Search Mode; it beeps faster as you get closer to the tag.',
                        'points'=> ['Geiger audio signal guidance', 'Locate hidden/misplaced items', 'Works through showcases & boxes', 'Saves hours of search time']
                    ],
                    [
                        'icon'  => 'bi-layers',
                        'title' => 'Smart RFID Counter Trays',
                        'desc'  => 'Integrate smart RFID pads into sales counters. Placing jewelry on the pad displays high-res images, purity, weight, and pricing on customer-facing screens.',
                        'points'=> ['Instant multi-item detection', 'Customer display mirror', 'Tracks customer interest time', 'Zero barcode alignment needed']
                    ],
                    [
                        'icon'  => 'bi-tag',
                        'title' => 'Tamper-Evident RFID Jewelry Tags',
                        'desc'  => 'Print and encode printable RFID tags (tail tags, dumbbell tags, string tags) with chip verification that prevents tag switching fraud.',
                        'points'=> ['Direct thermal RFID printing', 'Encrypted chip encoding', 'Tamper-proof loop design', 'Water & chemical resistant']
                    ],
                    [
                        'icon'  => 'bi-shield-lock',
                        'title' => 'Security & Anti-Theft Overhead Gates',
                        'desc'  => 'Connect showroom exit gates with RFID sensors. Unauthorized jewelry leaving the counter triggers discreet real-time alerts to security.',
                        'points'=> ['Overhead gate integration', 'Instant security buzzer alert', 'Mobile notification to managers', 'Camera snapshot trigger']
                    ],
                    [
                        'icon'  => 'bi-clock-history',
                        'title' => 'Tray-Out / Tray-In Safe Audit',
                        'desc'  => 'Track the movement of jewelry trays from night strongrooms to daytime showroom display cases with timestamped digital audits.',
                        'points'=> ['Vault in/out verification', 'Custodian handover logs', 'Shift-change count verification', 'Discrepancy push alerts']
                    ]
                ],
                'workflow'       => [
                    ['step' => '01', 'title' => 'Print & Tag', 'desc' => 'Print jewelry tag with barcode and write unique EPC chip data using RFID tag printer.'],
                    ['step' => '02', 'title' => 'Assign Showcase Location', 'desc' => 'Scan tray or counter tag to assign jewelry items to specific showroom display locations.'],
                    ['step' => '03', 'title' => 'Perform 60s Audit', 'desc' => 'Wave handheld RFID scanner across the showcase. System checks all tags against live ERP inventory.'],
                    ['step' => '04', 'title' => 'Review Audit Variance', 'desc' => 'System instantly highlights matched, extra, and missing items with photos and descriptions.']
                ],
                'kpis'           => [
                    ['stat' => '95%', 'label' => 'Reduction in Stock Audit Time', 'sub' => 'From 3 hours to 10 minutes'],
                    ['stat' => '700+', 'label' => 'Tags Read Per Second', 'sub' => 'High-gain UHF RFID readers'],
                    ['stat' => '100%', 'label' => 'Shrinkage & Theft Prevention', 'sub' => 'Instant missing item alarms'],
                    ['stat' => '0', 'label' => 'Billing Entry Errors', 'sub' => 'Multi-item tray scanning']
                ],
                'faqs'           => [
                    ['q' => 'Will RFID tags damage delicate gold, diamonds, or silver jewelry?', 'a' => 'Not at all. Our specialized jewelry RFID tags are lightweight, non-abrasive, and use medical-grade adhesive tail loops designed specifically for gold chains, rings, bangles, and gemstone necklaces.'],
                    ['q' => 'Can we use our existing barcode numbers alongside RFID?', 'a' => 'Yes! The RFID tag has a physical printable surface that includes your barcode, logo, weight, and price, while the internal RFID microchip contains the encrypted digital identifier.'],
                    ['q' => 'Which RFID readers and printers are compatible with GoldMatrix?', 'a' => 'GoldMatrix supports all industry-standard hardware, including Zebra, Chainway, CSL, Honeywell, and Sato RFID printers and handheld mobile terminals.']
                ],
                'related_slugs'  => ['jewelry-retail-pos-software', 'jewelry-manufacturing-software', 'wholesale-bullion-management']
            ],

            'jewelry-ecommerce-catalog' => [
                'slug'           => 'jewelry-ecommerce-catalog',
                'title'          => 'Jewellery E-Commerce, Digital Catalog & Mobile App',
                'badge'          => 'OMNICHANNEL RETAIL',
                'category'       => 'Online Showroom & Cataloging',
                'hero_subtitle'  => 'Turn showroom stock into an interactive digital catalog, share collections on WhatsApp, and sell online with live ERP stock sync.',
                'hero_desc'      => 'Expand your jewellery brand beyond the physical store. GoldMatrix Omnichannel Suite connects your physical inventory to a stunning online catalog, B2B wholesale portal, mobile shopping app, and automated WhatsApp catalog sharing.',
                'hero_image'     => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=800&auto=format&fit=crop&q=80',
                'meta_title'     => 'Jewellery E-Commerce & Digital Catalog Software | GoldMatrix ERP',
                'meta_desc'      => 'Showcase jewelry collections online with digital cataloging software. Live ERP inventory sync, WhatsApp product sharing, and mobile customer showroom app.',
                'meta_keywords'  => 'jewelry digital catalog software, jewelry ecommerce platform, whatsapp jewelry catalog, online jewelry showroom, jewelry mobile app',
                'accent_color'   => '#8B5CF6',
                'icon'           => 'bi-phone',
                'challenges'     => [
                    [
                        'pain' => 'Taking photos, editing backgrounds, and creating PDF catalogs for customers is time-consuming and outdated.',
                        'solution' => '1-Click Catalog Studio converts raw phone photos into studio-grade product lookbooks with watermarks and weight details.'
                    ],
                    [
                        'pain' => 'Selling items online that are already sold in the physical showroom creates customer frustration and refunds.',
                        'solution' => '2-Way Real-time Sync: Selling an item in-store instantly removes it from the online catalog and website.'
                    ],
                    [
                        'pain' => 'Customers wanting to view new arrivals must visit the store physically, limiting customer retention.',
                        'solution' => 'Branded Mobile App and WhatsApp interactive catalog allowing VIP customers to reserve items from home.'
                    ]
                ],
                'capabilities'   => [
                    [
                        'icon'  => 'bi-images',
                        'title' => 'Automated AI Catalog Studio',
                        'desc'  => 'Upload jewellery photos taken from a smartphone. The system removes backgrounds, applies branded jewelry mockups, and embeds purity tags.',
                        'points'=> ['Instant white/custom background', 'Watermark & logo branding', 'Automatic weight & hallmark badge', 'High-res zoom rendering']
                    ],
                    [
                        'icon'  => 'bi-whatsapp',
                        'title' => 'WhatsApp Interactive Product Catalog',
                        'desc'  => 'Share curated lookbooks directly to customer WhatsApp chats. Customers can view HD photos, inquire about price, and book appointments in one tap.',
                        'points'=> ['Curated collection links', 'Live price calculation based on daily gold rate', 'Inquiry to POS conversion', 'Automated festive broadcast']
                    ],
                    [
                        'icon'  => 'bi-bag-check',
                        'title' => 'E-Commerce Website Sync (Shopify/Woo)',
                        'desc'  => 'Connect your GoldMatrix ERP with Shopify, WooCommerce, or custom storefronts. Products, prices, orders, and customer data sync automatically.',
                        'points'=> ['2-way inventory sync', 'Dynamic daily price updates', 'Online order dispatch workflow', 'Abandoned cart WhatsApp reminders']
                    ],
                    [
                        'icon'  => 'bi-phone-vibrate',
                        'title' => 'Branded Customer Mobile App (iOS & Android)',
                        'desc'  => 'Launch your own mobile app on Google Play and Apple App Store. Enable customers to view collections, manage Kitty saving schemes, and earn loyalty points.',
                        'points'=> ['Native iOS & Android app', 'Digital Gold saving scheme portal', 'Live gold rate ticker', 'Push notification marketing']
                    ],
                    [
                        'icon'  => 'bi-camera-video',
                        'title' => 'Virtual Video Call Shopping',
                        'desc'  => 'Allow showroom sales staff to host private video shopping sessions, add items to a shared digital tray, and generate instant payment links.',
                        'points'=> ['Video call scheduler', 'Virtual customer tray', 'Live price breakdown sharing', 'Integrated payment gateway']
                    ],
                    [
                        'icon'  => 'bi-heart',
                        'title' => 'Customer Wishlist & Try-At-Home',
                        'desc'  => 'Enable customers to shortlist their favorite bridal collections and book showroom try-on visits or home-service appointments.',
                        'points'=> ['Digital wishlist management', 'Showroom appointment calendar', 'Home try-on security deposit', 'Sales rep assignment']
                    ]
                ],
                'workflow'       => [
                    ['step' => '01', 'title' => 'Snap & Auto-Catalog', 'desc' => 'Take phone photos of new jewellery. System automatically removes background and attaches ERP stock data.'],
                    ['step' => '02', 'title' => 'Publish & Share', 'desc' => 'Publish to online catalog, e-commerce store, and send curated WhatsApp lookbooks to VIP clients.'],
                    ['step' => '03', 'title' => 'Customer Orders / Inquires', 'desc' => 'Customer browses HD jewelry, checks live calculated price, and submits order or inquiry.'],
                    ['step' => '04', 'title' => 'Counter Fulfillment', 'desc' => 'POS alerts counter staff, marks item as reserved, and processes online payment or store pickup.']
                ],
                'kpis'           => [
                    ['stat' => '300%', 'label' => 'Higher Catalog Engagement', 'sub' => 'Interactive WhatsApp lookbooks'],
                    ['stat' => 'Real-Time', 'label' => '2-Way Inventory Sync', 'sub' => 'Zero stock overselling'],
                    ['stat' => '2x', 'label' => 'Repeat Purchases via Mobile App', 'sub' => 'Integrated saving schemes'],
                    ['stat' => '1-Click', 'label' => 'Catalog Generation', 'sub' => 'Automated background removal']
                ],
                'faqs'           => [
                    ['q' => 'How does live gold pricing work on the online digital catalog?', 'a' => 'Unlike generic eCommerce stores where prices are static, GoldMatrix dynamically computes the live product price based on the daily gold rate + making charges + diamond cost + GST.'],
                    ['q' => 'Can we hide prices for certain high-end bridal collections?', 'a' => 'Yes. You can configure catalogs with "Price on Request" mode, where customers click to enquire via WhatsApp or request a private video call.'],
                    ['q' => 'Does the digital catalog support saving schemes (Kitty plans)?', 'a' => 'Yes! Customers using your branded mobile app can view their monthly scheme installment status, make UPI payments, and redeem matured funds directly on online purchases.']
                ],
                'related_slugs'  => ['jewelry-retail-pos-software', 'rfid-jewelry-automation', 'jewelry-accounting-gst-software']
            ],

            'jewelry-accounting-gst-software' => [
                'slug'           => 'jewelry-accounting-gst-software',
                'title'          => 'Jewellery GST Invoicing, Accounting & Compliance',
                'badge'          => '100% TAX & GST COMPLIANT',
                'category'       => 'Accounting & Financial Management',
                'hero_subtitle'  => 'Automated GST invoices, E-Way bills, e-Invoicing, dual metal accounting, P&L statements, and audit-ready reports tailored for jewelers.',
                'hero_desc'      => 'Eliminate tax filing headaches and audit stress. GoldMatrix Accounting is designed exclusively for the jewellery sector\'s unique taxation rules, including 3% GST on gold, making charges split, RCM on old gold purchases, TCS on high-value cash transactions, and government e-Invoicing.',
                'hero_image'     => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&auto=format&fit=crop&q=80',
                'meta_title'     => 'Jewelry GST Billing & Accounting Software | GoldMatrix ERP',
                'meta_desc'      => 'Comprehensive GST billing and financial accounting software for jewellers. Auto GSTR-1, GSTR-3B reports, automated e-Way bills, and dual currency ledgers.',
                'meta_keywords'  => 'jewelry gst billing software, gold accounting software, jewelry e-way bill, gstr-1 jewelry format, jewelry tax compliance erp',
                'accent_color'   => '#0284C7',
                'icon'           => 'bi-calculator',
                'challenges'     => [
                    [
                        'pain' => 'Complex manual calculation of separate GST on gold metal value vs making charges and gemstone valuation.',
                        'solution' => 'Automatic HSN-code tax splitting (e.g. 7113) with precise 3% GST computation on invoices.'
                    ],
                    [
                        'pain' => 'Generating separate government E-Way bills and e-Invoices manually on the government portal.',
                        'solution' => '1-Click Direct API integration with the GST e-Invoice and E-Way Bill portal directly inside the billing screen.'
                    ],
                    [
                        'pain' => 'Auditing differences between physical gold stock weight and financial book values.',
                        'solution' => 'Synchronized Stock-Ledger integration where every gram movement has a corresponding accounting voucher entry.'
                    ]
                ],
                'capabilities'   => [
                    [
                        'icon'  => 'bi-receipt',
                        'title' => 'Automated GST Invoicing & Split Tax',
                        'desc'  => 'Compliant tax invoices with automated CGST, SGST, IGST, HSN code classification, Hallmarking fees, and making charges breakdowns.',
                        'points'=> ['Auto HSN code 7113 classification', 'Making charge tax separation', 'Round-off & discount handling', 'B2B & B2C invoice formats']
                    ],
                    [
                        'icon'  => 'bi-truck',
                        'title' => 'Direct E-Way Bill & e-Invoicing API',
                        'desc'  => 'Generate government-compliant E-Way bills and IRN QR codes without logging into external tax portals. Avoid transit delays.',
                        'points'=> ['NIC direct API integration', 'IRN QR code printed on invoice', 'Auto vehicle number update', 'Cancel/amend e-way bills']
                    ],
                    [
                        'icon'  => 'bi-file-earmark-bar-graph',
                        'title' => 'GSTR-1, GSTR-3B & GSTR-9 Tax Reports',
                        'desc'  => 'Export GST filing summaries in official Excel and JSON formats ready to upload to the GST portal or share with your Chartered Accountant.',
                        'points'=> ['B2B, B2CL, B2CS sales tables', 'HSN-wise summary reports', 'GSTR-2B purchase reconciliation', 'Advance receipt tax tracking']
                    ],
                    [
                        'icon'  => 'bi-book',
                        'title' => 'Complete General Ledger & Profit/Loss',
                        'desc'  => 'Full-fledged financial accounting: Balance Sheets, Profit & Loss statements, Trial Balances, Cash Flow, Bank Reconciliation, and Expense books.',
                        'points'=> ['Multi-branch consolidated balance sheet', 'Automated bank statement reconciliation', 'Depreciation & asset registers', 'Cost center accounting']
                    ],
                    [
                        'icon'  => 'bi-cash-coin',
                        'title' => 'Old Gold RCM & TCS Compliance',
                        'desc'  => 'Comply with Reverse Charge Mechanism (RCM) on purchases from unregistered individuals and automated TCS collection on cash transactions > ₹2 Lakhs.',
                        'points'=> ['RCM self-invoice generation', 'TCS 1% deduction tracking', 'PAN card verification', 'Section 206C compliance alerts']
                    ],
                    [
                        'icon'  => 'bi-shield-check',
                        'title' => 'Audit Trail & CA Access Portal',
                        'desc'  => 'Give your CA or tax consultant secure, restricted access to financial reports and audit logs without exposing customer data or operational settings.',
                        'points'=> ['Dedicated CA login role', 'Immutable transaction audit logs', 'Year-end financial rollover', 'Export to Tally & Excel']
                    ]
                ],
                'workflow'       => [
                    ['step' => '01', 'title' => 'Bill Generation', 'desc' => 'Cashier generates sales invoice. System auto-calculates HSN codes, GST rates, and TCS thresholds.'],
                    ['step' => '02', 'title' => '1-Click e-Way / IRN', 'desc' => 'If invoice exceeds legal threshold, system generates IRN number and E-Way bill via direct government API.'],
                    ['step' => '03', 'title' => 'Ledger Posting', 'desc' => 'Customer ledger, sales revenue, tax liability, and inventory accounts update simultaneously.'],
                    ['step' => '04', 'title' => '1-Click GST Filing', 'desc' => 'At month-end, export GSTR-1 and GSTR-3B JSON data ready for direct submission to the GST portal.']
                ],
                'kpis'           => [
                    ['stat' => '100%', 'label' => 'Tax Audit Compliance', 'sub' => 'Error-free GST calculations'],
                    ['stat' => '1-Click', 'label' => 'E-Way Bill & IRN Generation', 'sub' => 'Direct API connectivity'],
                    ['stat' => '10x', 'label' => 'Faster Month-End Filing', 'sub' => 'Automated GSTR-1 JSON exports'],
                    ['stat' => 'Zero', 'label' => 'Manual Ledger Entry', 'sub' => 'Auto-posting from POS and factory']
                ],
                'faqs'           => [
                    ['q' => 'Does GoldMatrix support both B2C retail invoices and B2B wholesale tax invoices?', 'a' => 'Yes. The system automatically differentiates between unregistered retail buyers (B2C) and GST-registered wholesale jewelers (B2B), producing compliant tax invoices with recipient GSTIN numbers and IRN QR codes.'],
                    ['q' => 'Can we export financial data to Tally if our Chartered Accountant uses it?', 'a' => 'Yes. While GoldMatrix contains a complete accounting engine, you can also export sales, purchases, receipts, and payments directly into Tally XML and Excel formats anytime.'],
                    ['q' => 'How does the software handle Section 206C TCS on high-value cash transactions?', 'a' => 'If a cash transaction exceeds the statutory limit (e.g. ₹2,00,000), the software prompts for mandatory customer PAN/Aadhaar details and calculates 1% TCS automatically on the invoice.']
                ],
                'related_slugs'  => ['jewelry-retail-pos-software', 'wholesale-bullion-management', 'jewelry-manufacturing-software']
            ]
        ];
    }

    public function getMenu(string $location): array {
        try {
            $items = $this->db->fetchAll(
                "SELECT * FROM navigation_menus WHERE location = ? AND is_active = 1 ORDER BY sort_order ASC, id ASC",
                [$location]
            ) ?? [];

            $tree = [];
            $childrenMap = [];
            foreach ($items as $item) {
                if ((int)$item['parent_id'] === 0) {
                    $tree[$item['id']] = $item;
                    $tree[$item['id']]['children'] = [];
                } else {
                    $childrenMap[$item['parent_id']][] = $item;
                }
            }
            foreach ($childrenMap as $parentId => $children) {
                if (isset($tree[$parentId])) {
                    $tree[$parentId]['children'] = $children;
                } else {
                    foreach ($children as $c) {
                        $tree[$c['id']] = $c;
                        $tree[$c['id']]['children'] = [];
                    }
                }
            }
            return array_values($tree);
        } catch (\Throwable $e) {
            return [];
        }
    }

    /* ─────────────────────────────────────────────────────────────
                "SELECT bp.*, bc.name AS category_name, bc.color AS category_color FROM blog_posts bp LEFT JOIN blog_categories bc ON bc.id = bp.category_id WHERE bp.category_id = ? AND bp.status = 'published' ORDER BY bp.published_at DESC",
                [$category['id']]
            ) ?? [];
        } catch (\Throwable $e) { $posts = []; }

        $footerData = $this->footerData();

        view('frontend.blog-category', array_merge($footerData, [
            'category'      => $category,
            'allCategories' => $this->blogCategories(),
            'posts'         => $posts,
            'meta_title'    => $category['name'] . ' Articles | GoldMatrix Blog',
            'meta_desc'     => $category['description'] ?? 'Browse articles in ' . $category['name'] . ' on the GoldMatrix blog.',
        ]));
    }

    /* ─────────────────────────────────────────────────────────────
     *  FOOTER DATA helper (shared across all pages)
     * ───────────────────────────────────────────────────────────── */
    private function footerData(): array {
        return [
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
        ];
    }

    /* ─────────────────────────────────────────────────────────────
     *  BLOG: Helpers
     * ───────────────────────────────────────────────────────────── */
    private function blogCategories(): array {
        try {
            return $this->db->fetchAll(
                "SELECT bc.*, (SELECT COUNT(*) FROM blog_posts WHERE category_id = bc.id AND status='published') AS post_count FROM blog_categories bc ORDER BY bc.name ASC"
            ) ?? [];
        } catch (\Throwable $e) { return []; }
    }

    private function recentBlogPosts(int $limit = 4, int $excludeId = 0): array {
        try {
            return $this->db->fetchAll(
                "SELECT id, title, slug, featured_image, published_at FROM blog_posts WHERE status='published' AND id != ? ORDER BY published_at DESC LIMIT ?",
                [$excludeId, $limit]
            ) ?? [];
        } catch (\Throwable $e) { return []; }
    }

    /* ─────────────────────────────────────────────────────────────
     *  BLOG: Listing page  /blog
     * ───────────────────────────────────────────────────────────── */
    public function blogIndex(): void {
        try {
            $posts = $this->db->fetchAll(
                "SELECT bp.*, bc.name AS category_name, bc.color AS category_color, bc.slug AS category_slug
                 FROM blog_posts bp
                 LEFT JOIN blog_categories bc ON bc.id = bp.category_id
                 WHERE bp.status = 'published'
                 ORDER BY bp.published_at DESC"
            ) ?? [];
        } catch (\Throwable $e) { $posts = []; }

        $categories = $this->blogCategories();

        view('frontend.blog-index', array_merge($this->footerData(), [
            'posts'      => $posts,
            'categories' => $categories,
            'meta_title' => 'Blog — Jewellery ERP Tips, GST Guides & Business Insights | GoldMatrix',
            'meta_desc'  => 'Expert articles on jewellery ERP software, GST compliance, inventory management, karigar tracking and business growth for jewellers.',
        ]));
    }

    /* ─────────────────────────────────────────────────────────────
     *  BLOG: Single post  /blog/{slug}
     * ───────────────────────────────────────────────────────────── */
    public function blogPost(string $slug): void {
        try {
            $post = $this->db->fetch(
                "SELECT bp.*, bc.name AS category_name, bc.color AS category_color, bc.slug AS category_slug
                 FROM blog_posts bp
                 LEFT JOIN blog_categories bc ON bc.id = bp.category_id
                 WHERE bp.slug = ? AND bp.status = 'published' LIMIT 1",
                [$slug]
            );
        } catch (\Throwable $e) { $post = null; }

        if (!$post) {
            http_response_code(404);
            echo '<h1>404 Post Not Found</h1><p><a href="' . site_url('blog') . '">Back to Blog</a></p>';
            return;
        }

        try {
            $this->db->query("UPDATE blog_posts SET views = views + 1 WHERE id = ?", [$post['id']]);
        } catch (\Throwable $e) {}

        try {
            $relatedPosts = $this->db->fetchAll(
                "SELECT bp.*, bc.name AS category_name, bc.color AS category_color FROM blog_posts bp LEFT JOIN blog_categories bc ON bc.id = bp.category_id WHERE bp.category_id = ? AND bp.id != ? AND bp.status = 'published' ORDER BY bp.published_at DESC LIMIT 4",
                [$post['category_id'], $post['id']]
            ) ?? [];
        } catch (\Throwable $e) { $relatedPosts = []; }

        // Build Automated JSON-LD Schema (BlogPosting / Article)
        $postUrl = site_url('blog/' . $post['slug']);
        $schemaType = !empty($post['schema_type']) ? $post['schema_type'] : 'BlogPosting';
        $schemaJson = [
            '@context' => 'https://schema.org',
            '@type' => $schemaType,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $postUrl
            ],
            'headline' => $post['meta_title'] ?: $post['title'],
            'description' => $post['meta_description'] ?: $post['excerpt'],
            'image' => !empty($post['featured_image']) ? [site_url($post['featured_image'])] : [],
            'datePublished' => !empty($post['published_at']) ? date('c', strtotime($post['published_at'])) : date('c'),
            'dateModified' => !empty($post['updated_at']) ? date('c', strtotime($post['updated_at'])) : date('c'),
            'author' => [
                '@type' => 'Person',
                'name' => $post['author_name'] ?: 'GoldMatrix Team'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => setting('company_name', 'GoldMatrix Software'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => site_url('assets/images/logo.png')
                ]
            ]
        ];

        view('frontend.blog-post', array_merge($this->footerData(), [
            'post'          => $post,
            'relatedPosts'  => $relatedPosts,
            'recentPosts'   => $this->recentBlogPosts(5, (int)$post['id']),
            'categories'    => $this->blogCategories(),
            'meta_title'    => $post['meta_title'] ?: $post['title'] . ' | GoldMatrix Blog',
            'meta_desc'     => $post['meta_description'] ?: $post['excerpt'],
            'meta_robots'   => $post['robots'] ?: 'index,follow',
            'canonical_url' => $post['canonical_url'] ?: $postUrl,
            'og_type'       => 'article',
            'og_title'      => $post['og_title'] ?: ($post['meta_title'] ?: $post['title']),
            'og_desc'       => $post['og_description'] ?: ($post['meta_description'] ?: $post['excerpt']),
            'og_image'      => $post['og_image'] ?: $post['featured_image'],
            'og_url'        => $postUrl,
            'schema_json'   => $schemaJson,
        ]));
    }

        /**
     * BLOG: Category archive /blog/category/{slug}
     */
    public function blogCategory(string $slug): void {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM blog_categories WHERE slug = ? LIMIT 1");
        $stmt->execute([$slug]);
        $category = $stmt->fetch();
        if (!$category) {
            header("HTTP/1.0 404 Not Found");
            view("errors.404");
            return;
        }

        $page = max(1, (int)($_GET["page"] ?? 1));
        $perPage = 9;
        $offset = ($page - 1) * $perPage;

        $countStmt = $db->prepare("SELECT COUNT(*) FROM blog_posts WHERE status = 'published' AND category_id = ?");
        $countStmt->execute([$category["id"]]);
        $totalPosts = (int)$countStmt->fetchColumn();
        $totalPages = max(1, (int)ceil($totalPosts / $perPage));

        $postsStmt = $db->prepare("SELECT p.*, c.name AS category_name, c.slug AS category_slug, c.color AS category_color FROM blog_posts p LEFT JOIN blog_categories c ON p.category_id = c.id WHERE p.status = 'published' AND p.category_id = ? ORDER BY p.published_at DESC LIMIT ? OFFSET ?");
        $postsStmt->execute([$category["id"], $perPage, $offset]);
        $posts = $postsStmt->fetchAll();

        $canonicalUrl = site_url("/blog/category/" . $category["slug"]);
        $categories = $this->blogCategories();
        $recentPosts = $this->recentBlogPosts(5);

        view("frontend.blog-category", array_merge($this->footerData(), [
            "category"      => $category,
            "posts"         => $posts,
            "categories"    => $categories,
            "recent_posts"  => $recentPosts,
            "current_page"  => $page,
            "total_pages"   => $totalPages,
            "total_posts"   => $totalPosts,
            "meta_title"    => ($category["name"] ?? "Category") . " Articles & Insights | GoldMatrix Blog",
            "meta_desc"     => $category["description"] ?? ("Read the latest articles on " . $category["name"]),
            "meta_robots"   => "index,follow",
            "canonical_url" => $canonicalUrl,
            "og_type"       => "website",
            "og_title"      => ($category["name"] ?? "Category") . " | GoldMatrix Blog",
            "og_desc"       => $category["description"] ?? "",
            "og_url"        => $canonicalUrl,
            "header_menu"   => $this->getMenu("header"),
        ]));
    }

    public function submitDemo(): void {
        header('Content-Type: application/json');

        // Anti-Bot Honeypot trap
        if (!empty($_POST['website_hp']) || !empty($_POST['hp_field'])) {
            echo json_encode(['success' => true, 'message' => 'Demo request confirmed! Our Senior ERP Specialist will call you to conduct a live 1-on-1 walkthrough.']);
            exit;
        }

        // IP Rate Limiting (Max 10 submissions / hour)
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $throttleKey = 'demo_api_' . $ip;
        if (\App\Services\AuthService::isThrottled($throttleKey, 10, 3600) > 0) {
            http_response_code(429);
            echo json_encode(['success' => false, 'message' => 'Too many demo requests from this IP. Please wait a while or contact us directly on WhatsApp.']);
            exit;
        }
        
        $name             = substr(trim($_POST['name'] ?? ''), 0, 150);
        $company          = substr(trim($_POST['company'] ?? ($_POST['showroom_name'] ?? '')), 0, 150);
        $phone            = substr(trim($_POST['phone'] ?? ''), 0, 50);
        $email            = substr(trim($_POST['email'] ?? ''), 0, 150);
        $country          = substr(trim($_POST['country'] ?? 'India'), 0, 100);
        $businessType     = substr(trim($_POST['business_type'] ?? 'Retail Jewellery Showroom'), 0, 150);
        $branches         = substr(trim($_POST['number_of_branches'] ?? '1'), 0, 50);
        $currentSoftware  = substr(trim($_POST['current_software'] ?? ''), 0, 150);
        $requirements     = substr(trim($_POST['requirements'] ?? ($_POST['notes'] ?? '')), 0, 3000);
        $preferredDate    = substr(trim($_POST['preferred_date'] ?? date('Y-m-d')), 0, 20);
        $preferredTime    = substr(trim($_POST['preferred_time'] ?? 'Morning (11:00 AM - 02:00 PM)'), 0, 100);
        $source           = substr(trim($_POST['source'] ?? 'Book a Free Demo Modal'), 0, 150);

        if (empty($name) || empty($phone)) {
            http_response_code(422);
            echo json_encode([
                'success' => false,
                'message' => 'Please enter your name and phone number so we can coordinate your demo.'
            ]);
            exit;
        }

        try {
            $pdo = $this->db->getPdo();
            $now = date('Y-m-d H:i:s');
            
            // 1. Insert into demo_requests
            $stmt = $pdo->prepare("INSERT INTO demo_requests (name, company, email, phone, country, business_type, number_of_branches, current_software, requirements, preferred_date, preferred_time, source, status, created_at, updated_at) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'new', ?, ?)");
            $stmt->execute([
                $name, $company, $email, $phone, $country, $businessType, $branches, $currentSoftware, $requirements, $preferredDate, $preferredTime, $source, $now, $now
            ]);

            // 2. Also log as a high-priority lead in leads table
            $leadMsg = "Requested Free Live Demo for {$company} ({$businessType}, {$branches} branch). Requirements: {$requirements}";
            $leadStmt = $pdo->prepare("INSERT INTO leads (name, company, email, phone, country, message, source, status, created_at, updated_at) 
                                       VALUES (?, ?, ?, ?, ?, ?, 'Free Demo Request', 'new', ?, ?)");
            $leadStmt->execute([$name, $company, $email, $phone, $country, $leadMsg, $now, $now]);

            \App\Services\AuthService::recordAttempt($throttleKey, 3600);

            echo json_encode([
                'success' => true,
                'message' => 'Demo request confirmed! Our Senior ERP Specialist will call you to conduct a live 1-on-1 walkthrough.'
            ]);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to register demo. Please contact us on WhatsApp (+91 92703 69937).'
            ]);
        }
        exit;
    }

    // ════════════════════════════════════════════════════════
    // SOLUTIONS PAGES
    // ════════════════════════════════════════════════════════

    private function solutionBaseData(): array {
        return [
            'header_menu'        => $this->getMenu('header'),
            'footer_col1_menu'   => $this->getMenu('footer_col1'),
            'footer_col2_menu'   => $this->getMenu('footer_col2'),
            'footer_col3_menu'   => $this->getMenu('footer_col3'),
            'footer_bottom_menu' => $this->getMenu('footer_bottom'),
        ];
    }

    public function solutionsIndex(): void {
        $data = array_merge($this->solutionBaseData(), [
            'meta_title'    => 'Jewellery Software Solutions | GoldMatrix ERP',
            'meta_desc'     => 'GoldMatrix offers complete jewellery software for retail showrooms, wholesale trading and manufacturing units. Choose your business type.',
            'meta_keywords' => 'jewellery software solutions, jewellery retail software, jewellery wholesale software, jewellery manufacturing software',
            'page_title'    => 'Solutions for Every Jewellery Business',
            'page_subtitle' => 'Whether you run a retail showroom, wholesale trading business, or manufacturing unit — GoldMatrix is built for your exact workflow.',
        ]);
        // Redirect to homepage solutions section for now, or render a solutions index page
        view('frontend.solutions.index', $data);
    }

    public function solutionRetail(): void {
        $data = array_merge($this->solutionBaseData(), [
            'meta_title'    => 'Jewellery Retail Software | POS, Inventory & CRM | GoldMatrix',
            'meta_desc'     => 'Complete jewellery retail software for showrooms. Fast POS billing, RFID inventory, old gold exchange, customer CRM, GST invoicing and gold rate management.',
            'meta_keywords' => 'jewellery retail software, jewellery pos software, jewellery showroom software, jewellery billing software, gold shop software india',
            'page_type'     => 'retail',
            'page_title'    => 'Jewellery Retail Software',
            'page_badge'    => 'RETAIL SOFTWARE',
            'page_headline' => 'Built for Jewellery Showrooms & Retail Stores',
            'page_subtitle' => 'POS billing, inventory, old gold exchange, customer management, gold rates and GST — all in one screen built for counter operations.',
            'page_icon'     => 'bi-shop',
            'features'      => [
                ['icon'=>'bi-speedometer2',    'title'=>'Fast POS & Touch Billing',        'desc'=>'Generate GST invoices in seconds with barcode/RFID scan, auto weight/rate calculation, and one-click print.'],
                ['icon'=>'bi-upc-scan',        'title'=>'Barcode & RFID Scanning',         'desc'=>'Scan individual items or tray-full RFID batches instantly. Stock updates automatically on every transaction.'],
                ['icon'=>'bi-graph-up-arrow',  'title'=>'Live Gold Rate Board Sync',       'desc'=>'Daily 22K/24K/18K gold rates update automatically across all counters and branches in real time.'],
                ['icon'=>'bi-recycle',         'title'=>'Old Gold Exchange',               'desc'=>'Process old gold/silver exchange with automated purity, melt-loss calculations and instant voucher.'],
                ['icon'=>'bi-people-fill',     'title'=>'Customer CRM & KYC',              'desc'=>'Maintain complete customer profiles, purchase history, KYC documents, loyalty points and scheme tracking.'],
                ['icon'=>'bi-receipt-cutoff',  'title'=>'GST Invoicing & Compliance',      'desc'=>'100% GST-compliant tax invoices, e-way bills, IRN e-invoicing and GSTR auto-preparation.'],
            ],
            'workflow'      => [
                ['step'=>'01','title'=>'Scan Item',      'desc'=>'Scan barcode/RFID — weight, purity, rate populate instantly.'],
                ['step'=>'02','title'=>'Apply Rates',    'desc'=>'Auto-fetch gold rate, making charges, GST. Add discount if needed.'],
                ['step'=>'03','title'=>'Accept Payment', 'desc'=>'Cash, card, UPI, old gold, saving scheme — split as needed.'],
                ['step'=>'04','title'=>'Print & Send',   'desc'=>'Print invoice, dispatch WhatsApp/SMS, update stock & accounts.'],
            ],
        ]);
        view('frontend.solutions.solution-page', $data);
    }

    public function solutionWholesale(): void {
        $data = array_merge($this->solutionBaseData(), [
            'meta_title'    => 'Jewellery Wholesale Software | Stock, Orders & Branches | GoldMatrix',
            'meta_desc'     => 'Complete jewellery wholesale management software. Manage bulk orders, vendor accounts, branch transfers, multi-party billing and stock across locations.',
            'meta_keywords' => 'jewellery wholesale software, jewellery trading software, bullion wholesale software, jewellery stock management software',
            'page_type'     => 'wholesale',
            'page_title'    => 'Jewellery Wholesale Software',
            'page_badge'    => 'WHOLESALE SOFTWARE',
            'page_headline' => 'Built for Jewellery Wholesale & Trading Businesses',
            'page_subtitle' => 'Manage bulk orders, vendor accounts, branch stock transfers and multi-party billing across your entire wholesale operation.',
            'page_icon'     => 'bi-boxes',
            'features'      => [
                ['icon'=>'bi-cart-check-fill', 'title'=>'Wholesale Order Management',    'desc'=>'Manage bulk customer orders, quotations, advances, delivery scheduling and order fulfillment tracking.'],
                ['icon'=>'bi-diagram-3-fill',  'title'=>'Multi-Branch Stock Control',    'desc'=>'Real-time stock visibility across all branches and warehouse locations. Transfer with full audit trail.'],
                ['icon'=>'bi-person-lines-fill','title'=>'Vendor & Party Ledgers',       'desc'=>'Complete accounts payable/receivable for vendors, parties and customers with automated reconciliation.'],
                ['icon'=>'bi-arrow-left-right', 'title'=>'Branch Transfer & Audit',      'desc'=>'Issue/receive stock between branches with full RFID/barcode verification and signed delivery notes.'],
                ['icon'=>'bi-tag-fill',         'title'=>'Bulk Billing & Pricing',       'desc'=>'Wholesale rate cards, customer-wise pricing tiers, bulk invoice generation and payment collection.'],
                ['icon'=>'bi-bar-chart-fill',   'title'=>'Trading Reports & Analytics',  'desc'=>'Turnover reports, party outstanding, metal movement, profitability and branch performance dashboards.'],
            ],
            'workflow'      => [
                ['step'=>'01','title'=>'Receive Stock',    'desc'=>'Purchase from vendors with weight-based invoice, purity verification and landing cost calculation.'],
                ['step'=>'02','title'=>'Manage Inventory', 'desc'=>'Track all stock by category, branch, counter, purity and weight in real time.'],
                ['step'=>'03','title'=>'Process Orders',   'desc'=>'Create wholesale orders, approve and dispatch with proper challan documentation.'],
                ['step'=>'04','title'=>'Settle Accounts',  'desc'=>'Track payments, outstanding, vendor dues and auto-generate financial reports.'],
            ],
        ]);
        view('frontend.solutions.solution-page', $data);
    }

    public function solutionManufacturing(): void {
        $data = array_merge($this->solutionBaseData(), [
            'meta_title'    => 'Jewellery Manufacturing Software | Jobwork, Production & Workshop | GoldMatrix',
            'meta_desc'     => 'Complete jewellery manufacturing software. Manage production work orders, jobwork, metal loss tracking, WIP inventory and manufacturing reports.',
            'meta_keywords' => 'jewellery manufacturing software, jewellery jobwork software, workshop management software, jewellery production software',
            'page_type'     => 'manufacturing',
            'page_title'    => 'Jewellery Manufacturing Software',
            'page_badge'    => 'MANUFACTURING SOFTWARE',
            'page_headline' => 'Built for Jewellery Manufacturers & Workshop Operations',
            'page_subtitle' => 'Plan production, assign jobwork, track metal loss, manage WIP stages and control outsourced manufacturing from one platform.',
            'page_icon'     => 'bi-hammer',
            'features'      => [
                ['icon'=>'bi-clipboard-check',  'title'=>'Production Work Orders',        'desc'=>'Create and track manufacturing work orders with design, weight specs, timeline and jobwork assignment.'],
                ['icon'=>'bi-person-badge-fill','title'=>'Jobwork Process Allocation',    'desc'=>'Assign jobwork to in-house or outsourced units, track issue/receipt and calculate labor charges.'],
                ['icon'=>'bi-exclamation-triangle-fill','title'=>'Metal Loss & Wastage', 'desc'=>'Track actual vs. allowable metal wastage by process, workshop and item type with automatic reconciliation.'],
                ['icon'=>'bi-layers-fill',      'title'=>'WIP Stage Tracking',           'desc'=>'Monitor work-in-progress inventory at each manufacturing stage — casting, polishing, setting, finishing.'],
                ['icon'=>'bi-arrow-repeat',     'title'=>'Outsourced Manufacturing',      'desc'=>'Track items sent for outsourced manufacturing, follow up status, receive finished goods and verify weight.'],
                ['icon'=>'bi-graph-up',         'title'=>'Manufacturing Reports',         'desc'=>'Production efficiency, metal consumption, process performance, WIP status and cost-per-item analytics.'],
            ],
            'workflow'      => [
                ['step'=>'01','title'=>'Create Work Order',  'desc'=>'Design specification, metal weight, purity, process assignment and target date.'],
                ['step'=>'02','title'=>'Issue Metal',        'desc'=>'Issue gold/silver from stock to workshop with proper voucher and weight record.'],
                ['step'=>'03','title'=>'Track Production',   'desc'=>'Monitor WIP stages, receive partial completions, track metal balance.'],
                ['step'=>'04','title'=>'Receive & Audit',    'desc'=>'Receive finished goods, weigh, verify, calculate loss allowance and close order.'],
            ],
        ]);
        view('frontend.solutions.solution-page', $data);
    }

    // ════════════════════════════════════════════════════════
    // 10 ENTERPRISE FEATURE MODULES DATA REPOSITORY
    // ════════════════════════════════════════════════════════

    public function getModulesData(): array {
        try {
            $rows = $this->db->fetchAll("SELECT * FROM erp_modules WHERE status = 'published' ORDER BY display_order ASC, id ASC");
            if (!empty($rows)) {
                $result = [];
                foreach ($rows as $r) {
                    $slug = $r['slug'];
                    $bullets = !empty($r['bullets']) ? (is_array($r['bullets']) ? $r['bullets'] : json_decode($r['bullets'], true)) : [];
                    $subFeats = !empty($r['sub_features']) ? (is_array($r['sub_features']) ? $r['sub_features'] : json_decode($r['sub_features'], true)) : [];
                    $visPoints = !empty($r['visual_points']) ? (is_array($r['visual_points']) ? $r['visual_points'] : json_decode($r['visual_points'], true)) : [];
                    $faqs = !empty($r['faqs']) ? (is_array($r['faqs']) ? $r['faqs'] : json_decode($r['faqs'], true)) : [];
                    $related = !empty($r['related']) ? (is_array($r['related']) ? $r['related'] : json_decode($r['related'], true)) : [];

                    $h1 = !empty($r['h1']) ? $r['h1'] : (!empty($r['headline']) ? $r['headline'] : $r['name']);
                    $h2 = !empty($r['h2']) ? $r['h2'] : (!empty($r['subtitle']) ? $r['subtitle'] : '');
                    $intro = !empty($r['intro']) ? $r['intro'] : (!empty($r['description']) ? $r['description'] : '');

                    $result[$slug] = [
                        'id'             => (int)$r['id'],
                        'slug'           => $slug,
                        'title'          => $r['name'],
                        'badge'          => $r['badge'] ?: 'CORE MODULE',
                        'category'       => $r['category'] ?: 'Core Modules',
                        'icon'           => $r['icon'] ?: 'bi-speedometer2',
                        'h1'             => $h1,
                        'h2'             => $h2,
                        'headline'       => $h1,
                        'subtitle'       => $h2,
                        'intro'          => $intro,
                        'description'    => $r['description'] ?: $intro,
                        'bullets'        => is_array($bullets) ? $bullets : [],
                        'target_persona' => $r['target_persona'] ?: '',
                        'persona_desc'   => $r['persona_desc'] ?: '',
                        'sub_features'   => is_array($subFeats) ? $subFeats : [],
                        'visual_title'   => $r['visual_title'] ?: '',
                        'visual_desc'    => $r['visual_desc'] ?: '',
                        'visual_points'  => is_array($visPoints) ? $visPoints : [],
                        'visual_image'   => $r['visual_image'] ?: '',
                        'faqs'           => is_array($faqs) ? $faqs : [],
                        'related'        => is_array($related) ? $related : [],
                        'meta_title'     => $r['meta_title'] ?: ($h1 . ' | GoldMatrix ERP'),
                        'meta_desc'      => $r['meta_desc'] ?: substr($intro ?: $h2, 0, 160),
                        'meta_keywords'  => $r['meta_keywords'] ?: (strtolower($r['name']) . ', jewellery erp software, gold software, jewelry tech'),
                        'canonical_url'  => $r['canonical_url'] ?: ('/features/' . $slug),
                    ];
                }
                return $result;
            }
        } catch (\Throwable $e) {}

        return [
            // ── MODULE 1: Dashboard & Live Rates ──
            'dashboard-live-rates' => [
                'slug'           => 'dashboard-live-rates',
                'title'          => 'Dashboards & Live Rates',
                'badge'          => 'MULTI-ROLE INTELLIGENCE',
                'category'       => 'Executive & Operational Dashboards',
                'icon'           => 'bi-speedometer2',
                'h1'             => 'Role-Based Dashboards & Live Gold Rate System for Jewellery Businesses',
                'h2'             => 'One Screen. Every Branch. Real-Time Retail, Wholesale, Manufacturing, Sales & Stock Intelligence.',
                'headline'       => 'Role-Based Dashboards & Live Gold Rate System for Jewellery Businesses',
                'subtitle'       => 'One Screen. Every Branch. Real-Time Retail, Wholesale, Manufacturing, Sales & Stock Intelligence.',
                'intro'          => 'Generic ERP software gives everyone the same cluttered screen — but a retail showroom manager needs completely different metrics than a factory production supervisor, a bullion wholesaler, or a floor salesperson. GoldMatrix provides 6 dedicated role-based and operational dashboards: Retailer, Wholesaler, Manufacturing / Job Worker, Sales Person, Live Gold Rates, and Real-Time Stock. Each dashboard surfaces the exact numbers, live tickers, jobwork queues, and inventory alerts relevant to that role, while syncing live 24K, 22K, 18K, 14K gold and 925 silver market rates across all branch locations.',
                'description'    => 'Dedicated role dashboards for Retailers, Wholesalers, Manufacturers, Sales Teams, Live Gold Rates, and Multi-Branch Stock balances.',
                'bullets'        => [
                    'Retailer, Wholesaler, Manufacturing & Sales Person Role Dashboards',
                    'Live Gold & Silver Rates Dashboard (24K/22K/18K/14K/925) with Multi-Branch Sync',
                    'Stock Dashboard with Real-Time Vault Balances & Reorder Alerts',
                    'Date-Based Business Snapshot & Real-Time Multi-Store Analytics'
                ],
                'target_persona' => 'Jewellery Retailers, Wholesalers, Manufacturers, Sales Teams & Showroom Owners',
                'persona_desc'   => 'Built for multi-branch jewellery retailers, high-volume wholesalers, manufacturing units, and showroom sales teams who need role-specific operational dashboards and up-to-the-second gold price synchronization.',
                'sub_features'   => [
                    [
                        'icon'   => 'bi-shop',
                        'title'  => 'Retailer Dashboard',
                        'desc'   => 'Real-time showroom command center tracking counter sales, footfall conversion, top-selling design categories, customer receivables, and daily cash, card, and UPI collections.',
                        'points' => ['Live counter billing metrics & daily collection', 'Top-selling ornament categories & fast movers', 'Customer outstanding & credit balance alerts', 'Showroom sales target vs achievement gauge']
                    ],
                    [
                        'icon'   => 'bi-truck',
                        'title'  => 'Wholesaler Dashboard',
                        'desc'   => 'Engineered for high-volume wholesale operations, tracking B2B party outstandings, bulk order dispatches, credit limits, and unhedged bullion exposures.',
                        'points' => ['B2B party balance & credit limit alerts', 'Bulk order dispatch pipeline tracking', 'Bullion fixing contracts & exposure ledger', 'Wholesale gross margin & volume analytics']
                    ],
                    [
                        'icon'   => 'bi-tools',
                        'title'  => 'Manufacturing / Job Worker Dashboard',
                        'desc'   => 'Workshop floor monitor tracking active jobcards, station WIP (Melting, Casting, Setting, Polishing), Karigar queue delays, and daily metal loss tolerances.',
                        'points' => ['Stage-by-stage workshop WIP monitoring', 'Karigar queue & turnaround time tracking', 'Live metal loss & permissible ghat variance flags', 'Daily finished piece handover log']
                    ],
                    [
                        'icon'   => 'bi-person-badge',
                        'title'  => 'Sales Person Dashboard',
                        'desc'   => 'Empower floor staff with individual daily sales targets, customer commission earnings on making charges, assigned showcase tray custody, and incentive leaderboards.',
                        'points' => ['Personal sales vs target achievement dial', 'Commission & incentive calculation on making charges', 'Assigned showcase tray custody check-in/out', 'Showroom floor performance leaderboard']
                    ],
                    [
                        'icon'   => 'bi-graph-up-arrow',
                        'title'  => 'Gold Rates Dashboard (Live Ticker)',
                        'desc'   => 'Automated live rate board syncing 24K, 22K, 18K, 14K gold and 925 silver market feeds directly to POS billing counters and customer-facing digital TV displays.',
                        'points' => ['Continuous live market price feed', 'Showroom TV digital board output', 'Custom margin/markup per branch location', 'Zero manual entry pricing errors']
                    ],
                    [
                        'icon'   => 'bi-boxes',
                        'title'  => 'Stock Dashboard',
                        'desc'   => 'Instant 360° inventory overview showing total showroom stock, pure bullion vault weight, in-transit branch transfers, approval memos, and reorder alerts.',
                        'points' => ['Total gross & net weight in vaults and counters', 'Memo In / Memo Out balance tracking', 'Low-stock reorder alerts per showcase tray', 'Multi-branch stock distribution map']
                    ]
                ],
                'visual_title'   => 'Multi-Role Dashboards: Role Selection & Live Gold Rate Ticker',
                'visual_desc'    => 'Interface showcasing the 6 specialized dashboards (Retailer, Wholesaler, Manufacturing/Jobworker, Salesperson, Gold Rates, Stock) alongside the live multi-karat rate ticker and branch summary tiles.',
                'visual_points'  => [
                    'Switch between Retailer, Wholesaler, Manufacturing, and Salesperson views',
                    'Live rate numbers updating in real time (24K/22K/18K/14K and 925 Silver)',
                    'Multi-branch stock and sales summary tiles updating live from one login'
                ],
                'visual_image'   => '/assets/images/why-goldmatrix-mockup.png',
                'faqs'           => [
                    [
                        'q' => 'How do role-based dashboards benefit different teams in a jewellery enterprise?',
                        'a' => 'Showroom owners see top-line group profits; retail managers see counter collections; workshop supervisors track Karigar jobs; and sales staff monitor their personal commissions — all from custom, permission-controlled screens.'
                    ],
                    [
                        'q' => 'How often does the Gold Rates dashboard update market prices?',
                        'a' => 'The rate engine continuously syncs 24K, 22K, 18K, 14K gold and 925 silver market prices, instantly broadcasting them to connected POS billing counters and digital showroom display boards.'
                    ],
                    [
                        'q' => 'Can each branch apply different margins on the shared Gold Rates feed?',
                        'a' => 'Yes. Centralized headquarters can manage the base market rate while allowing individual branches to configure location-specific markups or premiums.'
                    ],
                    [
                        'q' => 'What metrics does the Stock Dashboard highlight?',
                        'a' => 'The Stock Dashboard gives real-time visibility into total pure metal weight, mounted diamond carats, items currently out on customer approval (Memo), and fast-depleting showcase trays.'
                    ]
                ],
                'related'        => ['business-opening', 'operations', 'stock-management']
            ],

            // ── MODULE 2: Opening & Financial Ledgers ──
            'business-opening' => [
                'slug'           => 'business-opening',
                'title'          => 'Opening & Financial Ledgers',
                'badge'          => 'FINANCIAL & STOCK BASELINE',
                'category'       => 'Opening & Core Ledgers',
                'icon'           => 'bi-box-seam',
                'h1'             => 'Jewellery Opening Stock, Account Ledgers & Metal Conversion Software',
                'h2'             => 'Accurate Product Opening, Dual Metal-Rupee Ledgers & Real-Time Bank Reconciliation.',
                'headline'       => 'Jewellery Opening Stock, Account Ledgers & Metal Conversion Software',
                'subtitle'       => 'Accurate Product Opening, Dual Metal-Rupee Ledgers & Real-Time Bank Reconciliation.',
                'intro'          => 'Starting your jewellery operations with 100% accurate stock and financial baselines is essential for error-free accounting. GoldMatrix\'s Opening module gives you complete control over your foundational data: record product opening with weight and purity specifications, maintain dual-balance account ledgers (gold grams + rupees) for customers, suppliers and Karigars, perform instant bidirectional Metal ↔ Amount conversions, and reconcile bank accounts seamlessly from day one.',
                'description'    => 'Manage product opening, customer & supplier account ledgers, bidirectional metal-amount conversions, and multi-bank reconciliation.',
                'bullets'        => [
                    'Product Opening with weight, purity & cost recording',
                    'Account Ledger with dual gold & rupee balances',
                    'Metal to Amount & Amount to Metal dynamic conversion',
                    'Bank Reconciliation for multiple linked accounts'
                ],
                'target_persona' => 'Jewellery Showroom Owners, Accountants, Bullion Dealers & Karigar Units',
                'persona_desc'   => 'Ideal for jewellery business owners, showroom managers, and accountants who need metal and money tracked together as one unified financial baseline right from opening.',
                'sub_features'   => [
                    [
                        'icon'   => 'bi-box-arrow-in-down',
                        'title'  => 'Product Opening',
                        'desc'   => 'Record opening stock and new product entries into your operational ledger with accurate cost, gross weight, net weight, and karat purity data captured at the point of entry.',
                        'points' => ['Capture gross, net & stone weight', 'Purity and karat recording', 'Cost and landing value entry', 'Continuous & baseline product logging']
                    ],
                    [
                        'icon'   => 'bi-journal-bookmark-fill',
                        'title'  => 'Account Ledger',
                        'desc'   => 'Maintain complete customer, supplier, Karigar, and internal account ledgers with dual metal-weight and currency balances, fully searchable and exportable for audits or GST filing.',
                        'points' => ['Dual pure gold & currency balances', 'Searchable transaction history', 'Exportable for CA & GST filing', 'Voucher-level transaction drill-down']
                    ],
                    [
                        'icon'   => 'bi-layers-fill',
                        'title'  => 'Metal to Amount Conversion',
                        'desc'   => 'Instantly convert gold or silver weight into monetary value using live market ticker rates or locked contract prices — essential for bullion purchases, old gold settlements, and scrap buybacks.',
                        'points' => ['Live market or fixed rate conversion', 'Instant conversion voucher creation', 'Essential for gold exchange & pledges', 'Realized rate gain/loss tracking']
                    ],
                    [
                        'icon'   => 'bi-arrow-left-right',
                        'title'  => 'Amount to Metal Conversion',
                        'desc'   => 'Seamlessly convert cash deposits, customer advances, or booking amounts into equivalent pure gold or silver grams, protecting against future market price escalations.',
                        'points' => ['Convert cash advances into locked gold grams', 'Rate-hedged customer bookings', 'Accurate weight credit in customer ledger', 'Zero calculation discrepancies']
                    ],
                    [
                        'icon'   => 'bi-bank2',
                        'title'  => 'Bank Reconciliation',
                        'desc'   => 'Match your internal accounting books against bank statements directly within the software, catching discrepancies, uncleared cheques, and card swipe settlements early.',
                        'points' => ['Multi-account bank statement matching', 'Detect uncleared cheques & POS swipes', 'Detailed reconciliation audit trail', 'Zero month-end closing panic']
                    ]
                ],
                'visual_title'   => 'Product Opening, Metal ↔ Amount Calculator & Bank Reconciliation',
                'visual_desc'    => 'Interface showcasing the Product Opening form, the live bidirectional Metal ↔ Amount conversion calculator, and the bank statement reconciliation screen with matched vs. unmatched transactions.',
                'visual_points'  => [
                    'Product opening form capturing gross/net weight and purity',
                    'Bidirectional Metal ↔ Amount calculator with real-time math',
                    'Multi-account bank statement matching screen'
                ],
                'visual_image'   => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=900&auto=format&fit=crop&q=80',
                'faqs'           => [
                    [
                        'q' => 'Is Product Opening a one-time entry or ongoing per new stock?',
                        'a' => 'Product Opening is used both at initial onboarding to set starting stock and on an ongoing basis whenever new inventory batches enter your system with weight and purity details.'
                    ],
                    [
                        'q' => 'How does the Account Ledger track both metal weight and currency balances?',
                        'a' => 'Every ledger account in GoldMatrix maintains dual columns — pure metal weight (grams/karat) and rupee amounts — ensuring complete balance integrity.'
                    ],
                    [
                        'q' => 'How does Metal to Amount and Amount to Metal conversion handle price fluctuations?',
                        'a' => 'Conversions can be calculated against the live rate at the time of transaction or a fixed agreed rate, ensuring complete accuracy for advance bookings or scrap settlements.'
                    ],
                    [
                        'q' => 'Does Bank Reconciliation support multiple bank accounts?',
                        'a' => 'Yes, the reconciliation module supports matching transactions across multiple linked bank accounts and payment gateways within the same dashboard.'
                    ]
                ],
                'related'        => ['dashboard-live-rates', 'operations', 'stock-management']
            ],

            // ── MODULE 3: Operations (Finance Core) ──
            'operations' => [
                'slug'           => 'operations',
                'title'          => 'Operations (Finance Core)',
                'badge'          => 'FINANCE & BANKING CORE',
                'category'       => 'Core Accounting',
                'icon'           => 'bi-currency-exchange',
                'h1'             => 'Jewellery Accounting & Metal Ledger Software — Operations Module',
                'h2'             => 'Track Money and Metal Together, Not in Two Separate Systems',
                'headline'       => 'Jewellery Accounting & Metal Ledger Software — Operations Module',
                'subtitle'       => 'Track Money and Metal Together, Not in Two Separate Systems',
                'intro'          => 'Jewellery accounting isn\'t just rupees and paise — it\'s gold grams, silver kilos, and constantly shifting metal value, all of which need to reconcile with your bank and cash position. Most accounting software treats jewellery businesses like any other retailer, forcing manual workarounds to track metal-to-money conversions. GoldMatrix\'s Operations module is built around this core reality: it manages product opening, account ledgers, metal-to-amount conversion, and bank reconciliation as one connected financial core, so your books balance in both currency and karat.',
                'description'    => 'Manage product opening, account ledgers, metal-to-amount conversion, and bank reconciliation as one connected financial core.',
                'bullets'        => [
                    'Product Opening with cost, weight & purity entry',
                    'Account Ledger for customers, suppliers & karigars',
                    'Metal ↔ Amount dynamic rate conversion',
                    'Direct Bank Reconciliation matching'
                ],
                'target_persona' => 'Jewellery Business Owners, Accountants & Bullion Traders',
                'persona_desc'   => 'Built for jewellery business owners and accountants who need metal and money tracked as one system — particularly relevant for businesses handling gold exchange, pledge settlement, or bullion transactions where standard rupee-only accounting software falls short.',
                'sub_features'   => [
                    [
                        'icon'   => 'bi-box-arrow-in-down',
                        'title'  => 'Product Opening',
                        'desc'   => 'Record new product entries into your operational ledger with accurate cost, weight, and purity data captured at the point of entry.',
                        'points' => ['Capture gross, net & stone weight', 'Purity and karat recording', 'Cost and landing value entry', 'Continuous product logging']
                    ],
                    [
                        'icon'   => 'bi-journal-bookmark-fill',
                        'title'  => 'Account Ledger',
                        'desc'   => 'Maintain complete customer, supplier, and internal account ledgers with full transaction history, searchable and exportable for audits or GST filing.',
                        'points' => ['Dual pure gold & currency balances', 'Searchable transaction history', 'Exportable for CA & GST filing', 'Voucher-level drill-down']
                    ],
                    [
                        'icon'   => 'bi-arrow-left-right',
                        'title'  => 'Metal to Amount / Amount to Metal Conversion',
                        'desc'   => 'Instantly convert between gold/silver weight and monetary value using live or fixed rates — essential for pledge settlements, exchange transactions, and bullion trading where customers pay or receive in metal rather than cash.',
                        'points' => ['Live market or fixed rate conversion', 'Instant conversion voucher creation', 'Essential for gold exchange & pledges', 'Realized rate gain/loss tracking']
                    ],
                    [
                        'icon'   => 'bi-bank2',
                        'title'  => 'Bank Reconciliation',
                        'desc'   => 'Match your books against bank statements directly within the system, catching discrepancies early instead of discovering them at month-end closing.',
                        'points' => ['Multi-account bank matching', 'Detect uncleared cheques & swipes', 'Reconciliation audit trail', 'Zero month-end closing panic']
                    ]
                ],
                'visual_title'   => 'Metal ↔ Amount Calculator & Direct Bank Reconciliation',
                'visual_desc'    => 'Split view showing the Metal ↔ Amount conversion calculator with live conversion examples, alongside the bank reconciliation screen with matched vs. unmatched transactions.',
                'visual_points'  => [
                    'Live metal-to-currency conversion calculator with real-time math',
                    'Bank statement reconciliation matching screen',
                    'Seamless double-entry integrity between gold grams and liquid currency'
                ],
                'visual_image'   => 'https://images.unsplash.com/photo-1586486855514-8c633cc6fd38?w=900&auto=format&fit=crop&q=80',
                'faqs'           => [
                    [
                        'q' => 'How does metal-to-amount conversion handle daily rate fluctuations?',
                        'a' => 'Conversions can be calculated against the live rate at the time of transaction or a fixed rate you set, ensuring accuracy whether you\'re settling same-day or against a locked-in price.'
                    ],
                    [
                        'q' => 'Can the Account Ledger export data for GST filing or CA review?',
                        'a' => 'Yes, ledger data is exportable in standard formats suitable for handoff to accountants or for GST return preparation.'
                    ],
                    [
                        'q' => 'Does bank reconciliation support multiple bank accounts?',
                        'a' => 'Yes, the reconciliation module supports matching transactions across multiple linked bank accounts within the same operations dashboard.'
                    ],
                    [
                        'q' => 'Is Product Opening a one-time entry or ongoing per new stock?',
                        'a' => 'Product Opening is used on an ongoing basis — every time new inventory enters your system, whether from purchase, manufacturing, or exchange, it\'s logged here with weight and purity captured at entry.'
                    ]
                ],
                'related'        => ['financial-statement', 'order-management', 'stock-management']
            ],

            // ── MODULE 4: Order Management ──
            'order-management' => [
                'slug'           => 'order-management',
                'title'          => 'Order Management',
                'badge'          => 'SALES & ORDER PIPELINE',
                'category'       => 'Order Lifecycle',
                'icon'           => 'bi-cart-check',
                'h1'             => 'Jewellery Order Management & Custom Manufacturing Work Order Software',
                'h2'             => 'From Custom Bridal Design & Repair to Factory Work Orders & Delivery',
                'headline'       => 'Jewellery Order Management & Custom Manufacturing Work Order Software',
                'subtitle'       => 'From Custom Bridal Design & Repair to Factory Work Orders & Delivery',
                'intro'          => 'Managing custom bridal jewellery, customer repairs, and wholesale production on paper slips leads to missed delivery dates, misplaced packets, and angry customers. GoldMatrix\'s Order Management module connects your sales counter directly to your workshop and outside vendors. Log custom sale orders with photos and advance receipts, track repair orders through every stage of fixing, generate manufacturing work orders for karigars, and manage outsourced vendor jobs — all with automated customer WhatsApp status updates.',
                'description'    => 'Manage customer custom sale orders, repair jobs, manufacturing work orders, and outsourced vendor dispatch with automated milestone alerts.',
                'bullets'        => [
                    'Sale Order & Repair Order with photo & weight tracking',
                    'Manufacturing Work Order & Karigar Jobcard creation',
                    'Outsourced Manufacturing dispatch & return reconciliation',
                    'Design Quotation CAD approval & Sales Register'
                ],
                'target_persona' => 'Custom Jewellery Designers, Bridal Showroom Desks & Wholesale Order Teams',
                'persona_desc'   => 'Built for custom jewellery designers, bridal showroom order desks, repair centers, and wholesale coordinators who need total accountability over bespoke customer orders and strict delivery deadlines.',
                'sub_features'   => [
                    [
                        'icon'   => 'bi-file-earmark-text',
                        'title'  => 'Sale Order',
                        'desc'   => 'Capture custom customer orders with design photos, target metal weight, diamond 4Cs specifications, delivery deadlines, and advance cash/old gold payments.',
                        'points' => ['Multi-photo design attachment', 'Advance cash & old gold credit log', 'Target delivery date scheduling', 'WhatsApp confirmation with receipt']
                    ],
                    [
                        'icon'   => 'bi-tools',
                        'title'  => 'Repair Order',
                        'desc'   => 'Log customer repair jobs (resizing, stone replacement, soldering, rhodium) with received gross weight, photo verification, and digital repair barcodes.',
                        'points' => ['Received vs delivery weight audit', 'Digital repair packet barcode', 'Customer photo verification slip', 'Ready for pickup WhatsApp alert']
                    ],
                    [
                        'icon'   => 'bi-arrow-repeat',
                        'title'  => 'Order & Repair Processing',
                        'desc'   => 'Move orders seamlessly through visual status stages (Design Approved > In Workshop > Setting > Polishing > Ready) with real-time bottleneck alerts.',
                        'points' => ['Visual stage progression', 'Delayed order alerts', 'Staff accountability tracking', 'Live customer status look-up']
                    ],
                    [
                        'icon'   => 'bi-gear-wide-connected',
                        'title'  => 'Manufacturing Work Order',
                        'desc'   => 'Automatically convert approved customer sale orders into factory work orders with Bill of Materials (BOM), allocated pure gold, and assigned karigar units.',
                        'points' => ['Automated BOM generation', 'Karigar work order printing', 'Raw metal issue linkage', 'Target delivery milestone control']
                    ],
                    [
                        'icon'   => 'bi-box-arrow-up-right',
                        'title'  => 'Outsourced Manufacturing',
                        'desc'   => 'Track orders sent to external specialized workshops (micro-pave diamond setting, laser engraving) with vendor challans and weight audit upon return.',
                        'points' => ['Outsourced vendor delivery notes', 'Weight verification upon return', 'Labor charge settlement voucher', 'Third-party status tracking']
                    ],
                    [
                        'icon'   => 'bi-gem',
                        'title'  => 'Design Quotation',
                        'desc'   => 'Create high-converting 3D CAD design quotations with live metal rate estimates, making charge calculations, and shareable WhatsApp PDF links.',
                        'points' => ['Live rate price estimation', '3D CAD rendering attachments', 'Instant 1-click customer approval', 'Convert quotation to order seamlessly']
                    ],
                    [
                        'icon'   => 'bi-table',
                        'title'  => 'Sales Register',
                        'desc'   => 'Comprehensive searchable register tracking every customer order, delivery challan, pending balance, and sales executive attribution.',
                        'points' => ['Search by customer or design code', 'Sales executive commission log', 'Pending delivery countdown', 'Complete audit history']
                    ]
                ],
                'visual_title'   => 'Order Pipeline & Manufacturing Work Order Workflow',
                'visual_desc'    => 'Visual representation of custom bridal orders moving from initial customer CAD quotation to factory work orders, outsourced vendor tracking, and final delivery.',
                'visual_points'  => [
                    'Live status progression from quotation to manufacturing work order',
                    'Repair packet barcode tracking with received vs delivered weight',
                    'Automated customer WhatsApp status update dispatch'
                ],
                'visual_image'   => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=900&auto=format&fit=crop&q=80',
                'faqs'           => [
                    [
                        'q' => 'Can customers receive automated WhatsApp updates when their order status changes?',
                        'a' => 'Yes. When an order moves to "In Production" or "Ready for Pickup", GoldMatrix sends automated WhatsApp notifications to the customer.'
                    ],
                    [
                        'q' => 'How are customer advance payments in cash or old gold adjusted at final billing?',
                        'a' => 'Advance cash, card deposits, and old gold exchange credits are linked to the Order ID and automatically deducted from the final GST tax invoice.'
                    ],
                    [
                        'q' => 'Does it generate printable jobcards with barcodes for workshop karigars?',
                        'a' => 'Yes. Work orders print complete jobcards containing reference photos, metal weight, stone counts, and barcodes for quick workshop scanning.'
                    ],
                    [
                        'q' => 'Can we track orders sent to outside third-party manufacturers?',
                        'a' => 'Yes. The Outsourced Manufacturing module generates external vendor challans, tracks transit status, and reconciles return weight before final assembly.'
                    ]
                ],
                'related'        => ['production', 'stock-management', 'operations']
            ],

            // ── MODULE 5: Production & Manufacturing ──
            'production' => [
                'slug'           => 'production',
                'title'          => 'Production',
                'badge'          => 'PROPRIETARY WORKSHOP USP',
                'category'       => 'Manufacturing & Jobwork',
                'icon'           => 'bi-tools',
                'h1'             => 'Jewellery Manufacturing, Karigar Jobwork & Metal Loss Tracking Software',
                'h2'             => 'Milligram-Precision Control Across Every Insource, Outsource & Workshop Process',
                'headline'       => 'Jewellery Manufacturing, Karigar Jobwork & Metal Loss Tracking Software',
                'subtitle'       => 'Milligram-Precision Control Across Every Insource, Outsource & Workshop Process',
                'intro'          => 'Uncontrolled metal loss and delayed karigar jobwork destroy jewellery manufacturing profit margins. GoldMatrix\'s Production module is purpose-built for jewellery workshops and factory floors. Manage department-wise workflows (Melting, Casting, Filing, Setting, Polishing, Rhodium), track real-time jobwork queues, generate barcode jobcards, audit allowable vs. actual metal loss, and print daily manufacturing summaries with 0.001g accuracy.',
                'description'    => 'Full-cycle jewellery manufacturing software tracking WIP departments, karigar jobwork queues, metal loss, and daily closing summaries.',
                'bullets'        => [
                    'Department-wise Insource & Outsource reports',
                    'Jobwork Queue + Real-time Queue Report',
                    'Loss Tracking & Daily Manufacturing Closing Report',
                    'Worklog, Jobcard Report & Barcode Jobcard Print'
                ],
                'target_persona' => 'Jewellery Manufacturers, Karigar Workshops & Factory Production Heads',
                'persona_desc'   => 'Built for fine jewellery manufacturers, casting houses, karigar workshops, and factory production directors who need to eliminate unaccounted metal leakage and streamline jobwork delivery.',
                'sub_features'   => [
                    [
                        'icon'   => 'bi-diagram-3-fill',
                        'title'  => 'Department',
                        'desc'   => 'Configure specialized workshop departments (Melting, Casting, Filing, Diamond Setting, Polishing, Rhodium, Hallmarking) with custom stage sequences.',
                        'points' => ['Multi-stage department routing', 'Stage-wise WIP inventory balance', 'Department capacity scheduling', 'Operator station mapping']
                    ],
                    [
                        'icon'   => 'bi-person-workspace',
                        'title'  => 'Insource Department Report',
                        'desc'   => 'Track production volume, fine gold issued, scrap returned, and cycle times across all internal workshop departments with operator efficiency KPIs.',
                        'points' => ['Internal station productivity', 'Stage-by-stage metal weight ledger', 'Scrap recovery tracking', 'WIP inventory valuation']
                    ],
                    [
                        'icon'   => 'bi-share-fill',
                        'title'  => 'Outsource Department Report',
                        'desc'   => 'Monitor metal issued to external jobworkers and outside casting units with transit tracking, delivery challans, and return weight audits.',
                        'points' => ['Outside contractor metal balance', 'External jobwork challans', 'Return weight reconciliation', 'Labor charge settlement']
                    ],
                    [
                        'icon'   => 'bi-list-task',
                        'title'  => 'Jobwork Queue & Queue Report',
                        'desc'   => 'Live visual queue of all pending, in-progress, and completed jobcards across workshops with express order prioritization flags.',
                        'points' => ['Live factory floor queue', 'Express order prioritization', 'Karigar workload allocation', 'Real-time bottleneck alerts']
                    ],
                    [
                        'icon'   => 'bi-gear',
                        'title'  => 'Manufacturing Process',
                        'desc'   => 'Define standard process parameters, allowable wastage percentages, labor charge rates (per gram or per piece), and target turnaround hours.',
                        'points' => ['Process-wise wastage standards', 'Labor calculation formulas', 'Standard operating workflows', 'Quality check checkpoints']
                    ],
                    [
                        'icon'   => 'bi-exclamation-triangle-fill',
                        'title'  => 'Loss Tracking & Closing Report',
                        'desc'   => 'Calculate actual vs allowable metal loss per karigar and process. Generate daily closing reports showing total metal balance and scrap recovery.',
                        'points' => ['Milligram-precision loss calculation', 'Allowable vs actual variance flags', 'Karigar loss liability recovery', 'Daily factory closing balance sheet']
                    ],
                    [
                        'icon'   => 'bi-clock-history',
                        'title'  => 'Worklog Report',
                        'desc'   => 'Maintain timestamped audit logs of worker clock-ins, jobcard station handovers, labor time spent, and process completions.',
                        'points' => ['Worker station timestamps', 'Time spent per manufacturing stage', 'Operator productivity log', 'Audit-ready job history']
                    ],
                    [
                        'icon'   => 'bi-qr-code-scan',
                        'title'  => 'Jobcard Report & Jobcard Print',
                        'desc'   => 'Generate detailed jobcard summaries and print durable barcode tags with design photos, metal specs, and stone requirements for quick scanning.',
                        'points' => ['Barcode & QR jobcard printouts', 'Design photo attachment', 'Required gold & stone specifications', 'Direct finished stock tag conversion']
                    ],
                    [
                        'icon'   => 'bi-pie-chart-fill',
                        'title'  => 'Daily Manufacturing Summary',
                        'desc'   => 'Executive daily summary showing total metal melted, fine gold issued, finished pieces produced, total scrap recovered, and labor accrued.',
                        'points' => ['Daily production yield efficiency', 'Metal balance reconciliation', 'Total labor cost accrued', 'Finished goods transferred to retail stock']
                    ]
                ],
                'visual_title'   => 'Factory Floor Control: Jobwork Queue & Metal Loss Tracking',
                'visual_desc'    => 'Visual representation of the live Jobwork Queue dashboard showing stage progression alongside the Metal Loss Tracking audit report.',
                'visual_points'  => [
                    'Live jobwork queue with department-wise WIP status',
                    'Milligram-precision loss tracking comparing issued gold vs finished pieces',
                    '1-Click barcode jobcard printing for station scanning'
                ],
                'visual_image'   => '/assets/images/why-goldmatrix-mockup.png',
                'faqs'           => [
                    [
                        'q' => 'How does GoldMatrix calculate karigar metal loss and wastage allowance?',
                        'a' => 'GoldMatrix compares pure metal issued against finished product weight plus recovered scrap, evaluating the variance against your pre-configured allowable wastage limits.'
                    ],
                    [
                        'q' => 'Can workers update job progress using barcode scanners on the shop floor?',
                        'a' => 'Yes. Workers scan the barcode on their printed jobcard at each workstation kiosk to log start and completion timestamps in real time.'
                    ],
                    [
                        'q' => 'Does it handle both in-house factory staff and independent outside karigars?',
                        'a' => 'Yes. You can track internal employee worklogs as well as external contractor metal ledgers, labor bills, and tax deduction vouchers.'
                    ],
                    [
                        'q' => 'Can finished manufactured goods be directly converted into barcode-tagged retail inventory?',
                        'a' => 'Yes. One click transfers completed production batches into tagged stock ready for showroom billing.'
                    ]
                ],
                'related'        => ['order-management', 'stock-management', 'financial-statement']
            ],

            // ── MODULE 6: Financial Statement ──
            'financial-statement' => [
                'slug'           => 'financial-statement',
                'title'          => 'Financial Statement',
                'badge'          => 'COMPLIANCE & AUDIT',
                'category'       => 'Financial Reporting',
                'icon'           => 'bi-receipt-cutoff',
                'h1'             => 'Jewellery Accounting, Trial Balance & GST Financial Statement Software',
                'h2'             => 'Live Balance Sheets, Metal-Aware P&L & 100% Tax-Compliant Reporting',
                'headline'       => 'Jewellery Accounting, Trial Balance & GST Financial Statement Software',
                'subtitle'       => 'Live Balance Sheets, Metal-Aware P&L & 100% Tax-Compliant Reporting',
                'intro'          => 'General accounting packages fail when handling changing bullion prices, dual metal-and-rupee balances, and complex jewellery GST rules. GoldMatrix\'s Financial Statement module automatically compiles real-time Trial Balances, Balance Sheets, Profit & Loss statements, Cash/Fund Flows, and Sales/Purchase registers directly from your daily counter billing and workshop vouchers. Audit-ready, CA-friendly, and 100% compliant with GSTR-1, GSTR-3B, E-Invoicing, and E-Way bills.',
                'description'    => 'Real-time balance sheet, profit & loss statement, cash/fund flow, chart of accounts, and automated GST returns (GSTR-1, GSTR-3B, E-Invoicing).',
                'bullets'        => [
                    'Trial Balance, Balance Sheet & Profit Loss statements',
                    'Cash Flow, Fund Flow & Chart of Accounts',
                    'Tax Return (GSTR-1, GSTR-3B, E-Invoice, E-Way Bill)',
                    'Sale Reports, Purchase Reports & Detailed Trial Balance'
                ],
                'target_persona' => 'Business Owners, Chartered Accountants, Tax Consultants & Auditors',
                'persona_desc'   => 'Built for jewellery business owners, Chief Financial Officers, Chartered Accountants, and tax consultants who need audit-ready financial statements without manual spreadsheets.',
                'sub_features'   => [
                    [
                        'icon'   => 'bi-calculator-fill',
                        'title'  => 'Trial Balance & Trial Balance Detailed Report',
                        'desc'   => 'Generate standard, periodic, and hierarchical trial balances with instant drill-down from primary account groups all the way to source transaction vouchers.',
                        'points' => ['Hierarchical group structure', 'Drill-down to original voucher', 'Opening, movement & closing balances', 'Export to Excel & PDF for audit']
                    ],
                    [
                        'icon'   => 'bi-bank',
                        'title'  => 'Balance Sheet',
                        'desc'   => 'Live balance sheet reflecting inventory valuation at live or cost rates, liquid cash, bank accounts, customer receivables, and vendor liabilities.',
                        'points' => ['Schedule-III compliant format', 'Stock asset valuation at market rate', 'Debtor and creditor breakdown', 'Multi-branch balance sheet consolidation']
                    ],
                    [
                        'icon'   => 'bi-graph-up-arrow',
                        'title'  => 'Profit Loss',
                        'desc'   => 'Comprehensive P&L reporting showing gross profit from metal, making charge margins, stone sales, and net profit after operating expenses.',
                        'points' => ['Metal trading margin vs making charge profit', 'Operating expense categorization', 'Monthly & quarterly comparative views', 'Karat-wise gross margin breakdown']
                    ],
                    [
                        'icon'   => 'bi-water',
                        'title'  => 'Cash Flow & Fund Flow',
                        'desc'   => 'Track cash inflows and outflows across operating, investing, and financing activities to ensure healthy liquidity and working capital.',
                        'points' => ['Direct & indirect cash flow models', 'Working capital tracking', 'Monthly cash inflow/outflow forecast', 'Liquidity health ratios']
                    ],
                    [
                        'icon'   => 'bi-diagram-2-fill',
                        'title'  => 'Chart Of Account',
                        'desc'   => 'Structure your financial accounts with customizable primary and secondary groups conforming to statutory jewellery accounting standards.',
                        'points' => ['Pre-configured jewellery account trees', 'Custom ledger group creation', 'Multi-currency ledger support', 'Audit protection locks']
                    ],
                    [
                        'icon'   => 'bi-percent',
                        'title'  => 'Tax Return',
                        'desc'   => 'Auto-generate GSTR-1, GSTR-3B summaries ready for direct portal upload, along with built-in IRN e-invoicing and E-way bill generation.',
                        'points' => ['GSTR-1 & GSTR-3B JSON exports', 'Direct NIC E-Invoice IRN API', '1-Click E-Way Bill generation', 'Input Tax Credit (ITC) reconciliation']
                    ],
                    [
                        'icon'   => 'bi-receipt',
                        'title'  => 'Sale Reports & Purchase Reports',
                        'desc'   => 'Detailed registers of B2B and B2C sales and purchases filterable by HSN code, tax slab, branch, payment mode, and customer state.',
                        'points' => ['B2B vs B2C sales register', 'HSN-wise tax summaries', 'Purchase invoice register with ITC', 'Branch and state-wise filtering']
                    ]
                ],
                'visual_title'   => 'Real-Time Financial Statements & Automated Tax Return Dashboard',
                'visual_desc'    => 'Visual display showing live Balance Sheet, Trial Balance drill-down, and GST return portal-ready JSON export summaries.',
                'visual_points'  => [
                    'Live stock valuation reflects on your balance sheet automatically',
                    'Direct JSON export for GSTR-1 and GSTR-3B saves your CA dozens of hours',
                    'Full audit trail logs every voucher creation, edit, and cancellation'
                ],
                'visual_image'   => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=900&auto=format&fit=crop&q=80',
                'faqs'           => [
                    [
                        'q' => 'Does the Balance Sheet update automatically when gold rates change?',
                        'a' => 'Yes. GoldMatrix supports both historical cost and live replacement valuation, reflecting current inventory asset value accurately on your balance sheet.'
                    ],
                    [
                        'q' => 'Can we export GSTR-1 and GSTR-3B data for direct government portal filing?',
                        'a' => 'Yes. GoldMatrix generates portal-ready JSON files and Excel summaries for GSTR-1, GSTR-3B, and HSN-wise tax reports.'
                    ],
                    [
                        'q' => 'Can our external Chartered Accountant access our financial statements securely?',
                        'a' => 'Yes. You can grant read-only auditor access with permissions restricted solely to financial statements, ledgers, and tax reports.'
                    ],
                    [
                        'q' => 'Does the system support E-Invoicing (IRN) and E-Way bill generation?',
                        'a' => 'Yes. GoldMatrix integrates directly with the government GST portal to generate IRN QR codes and E-Way bills directly from the invoice screen.'
                    ]
                ],
                'related'        => ['operations', 'report-analysis', 'dashboard-live-rates']
            ],

            // ── MODULE 7: Report Analysis ──
            'report-analysis' => [
                'slug'           => 'report-analysis',
                'title'          => 'Report Analysis',
                'badge'          => 'BUSINESS INTELLIGENCE',
                'category'       => 'Deep BI & Analytics',
                'icon'           => 'bi-bar-chart-line',
                'h1'             => 'Jewellery Business Intelligence & Report Analysis Software',
                'h2'             => '100+ Deep Reports: Transactions, Ageing, Karatwise P&L & Audit Trails',
                'headline'       => 'Jewellery Business Intelligence & Report Analysis Software',
                'subtitle'       => '100+ Deep Reports: Transactions, Ageing, Karatwise P&L & Audit Trails',
                'intro'          => 'You can\'t grow what you don\'t measure. GoldMatrix\'s Report Analysis module delivers 100+ actionable business intelligence reports covering every corner of your jewellery enterprise. From daily transaction registers and debtor ageing buckets to customer KYC history, Karatwise P&L breakdown, gold fixing positions, and physical barcode scan audit logs — give your leadership the exact data needed to increase profitability and eliminate inventory shrinkage.',
                'description'    => '100+ deep reports including transaction ledgers, customer KYC & ageing, Karatwise P&L, reward point balances, and barcode scan discrepancy logs.',
                'bullets'        => [
                    'Transactions, Ledger, Day & Ageing reports',
                    'Customer / KYC & Ledger Balance reports',
                    'Fixing Position & Karatwise Profit & Loss',
                    'Reward Point & Barcode Scan discrepancy reports'
                ],
                'target_persona' => 'Jewellery Enterprise Owners, Store Directors, Bullion Traders & Auditors',
                'persona_desc'   => 'Built for jewellery enterprise owners, store managers, bullion traders, and inventory auditors who require deep, granular visibility to optimize stock turn and cash flow.',
                'sub_features'   => [
                    [
                        'icon'   => 'bi-receipt',
                        'title'  => 'Transactions Report & Day Report',
                        'desc'   => 'Detailed register of all sales, purchases, estimates, returns, and counter adjustments filterable by date, branch, salesperson, and payment mode.',
                        'points' => ['Daily transaction register', 'Payment mode breakdown', 'Cancelled & void bill register', 'Estimate-to-bill conversion stats']
                    ],
                    [
                        'icon'   => 'bi-journal-text',
                        'title'  => 'Account Ledger Report & Ledger Balance Report',
                        'desc'   => 'Party-wise statement showing running balances in both currency and fine gold weight with 1-click WhatsApp and PDF export.',
                        'points' => ['Dual pure gold & cash ledger statement', 'Summary of all debtor/creditor balances', '1-Click WhatsApp statement dispatch', 'Multi-branch balance compilation']
                    ],
                    [
                        'icon'   => 'bi-clock-history',
                        'title'  => 'Ageing Report',
                        'desc'   => 'Identify overdue customer and vendor balances with 30/60/90/120+ day aging buckets and automatic payment reminder triggers.',
                        'points' => ['Aging bucket reports (30-120+ days)', 'High-risk debtor alerts', 'Automated payment reminder messages', 'Credit limit compliance tracking']
                    ],
                    [
                        'icon'   => 'bi-person-vcard',
                        'title'  => 'Customer / KYC Report',
                        'desc'   => 'Comprehensive customer database tracking purchase frequency, lifetime value (LTV), government KYC compliance (PAN/Aadhaar/ID), and birthdays/anniversaries.',
                        'points' => ['KYC compliance register', 'High-value customer ranking (RFM)', 'Special date reminder lists', 'Customer preference analysis']
                    ],
                    [
                        'icon'   => 'bi-shield-exclamation',
                        'title'  => 'Fixing Position',
                        'desc'   => 'Monitor open bullion rate-fix contracts, unpriced metal receipts, and hedging exposure to protect against sudden market price swings.',
                        'points' => ['Net unhedged gold weight position', 'Bullion contract rate fixing ledger', 'Rate fluctuation risk analysis', 'Live market valuation exposure']
                    ],
                    [
                        'icon'   => 'bi-gem',
                        'title'  => 'Karatwise Profit & Loss',
                        'desc'   => 'Deep profitability breakdown across 24K, 22K, 18K, 14K, 9K gold, platinum, and diamond categories to discover high-margin product lines.',
                        'points' => ['Purity-wise gross margin', 'Category profitability ranking', 'Slow-moving metal analysis', 'Making charge yield per karat']
                    ],
                    [
                        'icon'   => 'bi-award-fill',
                        'title'  => 'Reward Point Report',
                        'desc'   => 'Track customer loyalty point accruals, kitty scheme installment collections, maturity dates, and bonus redemption statistics.',
                        'points' => ['Active kitty scheme balances', 'Overdue installment reports', 'Reward points liability statement', 'Scheme redemption ROI analytics']
                    ],
                    [
                        'icon'   => 'bi-upc-scan',
                        'title'  => 'Barcode Scan Report',
                        'desc'   => 'Compare physical stock scan counts against system records to identify missing items, misplaced trays, or unaccounted shrinkage.',
                        'points' => ['Physical vs system variance logs', 'Misplaced tray identification', 'Missing item audit register', 'Auditor sign-off reports']
                    ]
                ],
                'visual_title'   => 'Analytics Command Center: Karatwise P&L & Stock Scan Variance',
                'visual_desc'    => 'Visual representation of the Report Analysis dashboard showing Karatwise P&L graphical charts and the physical Barcode Scan discrepancy report.',
                'visual_points'  => [
                    'Karatwise gross profit charts split across 24K, 22K, 18K, and Diamond lines',
                    'Physical stock scan audit report highlighting matched, missing, and extra items',
                    'Export any report to Excel, PDF, or CSV with 1 click'
                ],
                'visual_image'   => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=900&auto=format&fit=crop&q=80',
                'faqs'           => [
                    [
                        'q' => 'Can reports be exported to Excel, PDF, or CSV?',
                        'a' => 'Yes. Every report in GoldMatrix can be exported with 1 click to Excel, PDF, or CSV format with custom date filters and column arrangements.'
                    ],
                    [
                        'q' => 'What is the Fixing Position report used for?',
                        'a' => 'It tracks your net open gold weight position (unhedged gold bought vs sold), protecting bullion traders and jewelers from adverse market fluctuations.'
                    ],
                    [
                        'q' => 'How does the Barcode Scan discrepancy report work?',
                        'a' => 'You scan physical showroom trays using a handheld barcode/RFID reader; the system instantly compares scanned tags against book stock, flagging missing or misplaced pieces.'
                    ],
                    [
                        'q' => 'Can we schedule automated daily summary reports to our mobile phone?',
                        'a' => 'Yes. GoldMatrix can automatically dispatch daily executive closing summaries and sales digests directly to your WhatsApp or email every evening.'
                    ]
                ],
                'related'        => ['financial-statement', 'stock-management', 'dashboard-live-rates']
            ],

            // ── MODULE 8: Employee Management ──
            'employee-management' => [
                'slug'           => 'employee-management',
                'title'          => 'Employee Management',
                'badge'          => 'WORKFORCE & SECURITY',
                'category'       => 'HR & Staff Control',
                'icon'           => 'bi-people',
                'h1'             => 'Jewellery Staff Attendance, Incentive Math & Inventory Assignment Software',
                'h2'             => 'Motivate Sales Staff, Automate Payroll & Secure Showcase Inventory',
                'headline'       => 'Jewellery Staff Attendance, Incentive Math & Inventory Assignment Software',
                'subtitle'       => 'Motivate Sales Staff, Automate Payroll & Secure Showcase Inventory',
                'intro'          => 'Managing showroom sales teams, cashiers, and workshop staff requires both performance incentives and strict inventory accountability. GoldMatrix\'s Employee Management module combines HR automation with jewellery-specific security. Track biometric attendance, calculate sales commissions on making charges, process monthly salaries and advances, and assign specific showcase inventory trays to sales associates with morning checkout and evening check-in audits.',
                'description'    => 'Manage staff attendance, calculate sales commissions and incentives, generate payroll, and assign/unassign showroom inventory to sales staff with full accountability.',
                'bullets'        => [
                    'Employee Dashboard, Attendance & Attendance Report',
                    'Employee Advance, Advance Request & Incentive math',
                    'Employee Reports, Salary & Digital Pay Slips',
                    'Assign / UnAssign Inventory To Sales Team with item logs'
                ],
                'target_persona' => 'Multi-Counter Jewellery Showrooms, Retail Chains & HR Managers',
                'persona_desc'   => 'Built for multi-counter jewellery showrooms, retail chains, and workshop managers who want to motivate high-performing staff while securing high-value showcase inventory.',
                'sub_features'   => [
                    [
                        'icon'   => 'bi-speedometer2',
                        'title'  => 'Employee Dashboard',
                        'desc'   => 'Live salesperson leaderboard tracking daily sales, conversion rates, average ticket size, and monthly target achievements.',
                        'points' => ['Real-time showroom leaderboard', 'Conversion rate & footfall stats', 'Average billing value per staff', 'Monthly star performer badge']
                    ],
                    [
                        'icon'   => 'bi-fingerprint',
                        'title'  => 'Employee Attendance & Attendance Report',
                        'desc'   => 'Biometric hardware sync (fingerprint/face) and mobile geolocation check-in with automated late-mark and overtime tracking.',
                        'points' => ['Biometric hardware device sync', 'Multi-shift scheduling', 'Overtime & late-mark rules', 'Detailed monthly attendance reports']
                    ],
                    [
                        'icon'   => 'bi-cash-coin',
                        'title'  => 'Employee Advance & Advance Request',
                        'desc'   => 'Manage staff loan applications, salary advances, and automated monthly installment deductions from payroll.',
                        'points' => ['Staff advance request portal', 'Owner approval workflow', 'Automated payroll deduction', 'Staff loan balance ledger']
                    ],
                    [
                        'icon'   => 'bi-percent',
                        'title'  => 'Employee Incentive',
                        'desc'   => 'Automate complex jewellery commissions based on making charge percentages, flat amount per gram sold, or target tier bonuses.',
                        'points' => ['Making charge margin-based bonus', 'Rupees-per-gram commission rules', 'Tiered milestone bonuses', 'Monthly commission pay slip']
                    ],
                    [
                        'icon'   => 'bi-cash-stack',
                        'title'  => 'Employee Salary & Employee Reports',
                        'desc'   => '1-Click monthly payroll calculation factoring in attendance, incentives, advances, and taxes with printable digital salary slips.',
                        'points' => ['1-Click monthly payroll processing', 'Staff advance deduction', 'Digital salary slip generation', 'Bank salary transfer sheet export']
                    ],
                    [
                        'icon'   => 'bi-boxes',
                        'title'  => 'Assign Inventory To Sales Team',
                        'desc'   => 'Assign showcase trays to specific sales staff at store opening and verify 100% item return at store closing.',
                        'points' => ['Morning showcase tray assignment', 'Evening hand-back audit scan', 'Salesperson stock custody log', 'Missing piece liability attribution']
                    ],
                    [
                        'icon'   => 'bi-box-arrow-right',
                        'title'  => 'Assign Inventory & UnAssign Inventory',
                        'desc'   => 'Quickly transfer or release custody of jewellery pieces between counters and salespersons during busy showroom hours.',
                        'points' => ['Counter-to-counter handover log', 'Manager sign-off on transfers', 'Instant custody update', 'Zero untracked showcase pieces']
                    ],
                    [
                        'icon'   => 'bi-tag-fill',
                        'title'  => 'Assign Inventory Items',
                        'desc'   => 'Item-level accountability ensuring any missing showcase piece is instantly attributed to the responsible counter staff member.',
                        'points' => ['Individual barcode item custody', 'High-value solitaire assignment', 'Audit scan verification', 'Complete staff action audit trail']
                    ]
                ],
                'visual_title'   => 'Showroom Staff Accountability & Commission Dashboard',
                'visual_desc'    => 'Visual display showing the Assign Inventory to Sales Team interface with tray checkout/check-in logs, alongside the Salesperson Commission Calculation dashboard.',
                'visual_points'  => [
                    'Showcase tray custody assigned to individual sales associates',
                    'Commission calculation linked directly to making charges earned',
                    'Biometric attendance sync and 1-click digital pay slip generation'
                ],
                'visual_image'   => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=900&auto=format&fit=crop&q=80',
                'faqs'           => [
                    [
                        'q' => 'How does the showcase inventory assignment protect against counter theft?',
                        'a' => 'Sales associates scan assigned trays into their personal custody at morning opening. At closing, a return scan verifies all pieces are accounted for before staff depart.'
                    ],
                    [
                        'q' => 'Can commission be calculated on making charges instead of gross sale value?',
                        'a' => 'Yes. GoldMatrix supports flexible commission rules including % on making charges, fixed rupees per gram, or target milestone bonuses.'
                    ],
                    [
                        'q' => 'Does it connect directly with biometric fingerprint/face attendance machines?',
                        'a' => 'Yes. GoldMatrix syncs with major biometric attendance devices (eSSL, ZKTeco, Realtime) to pull shift attendance automatically.'
                    ],
                    [
                        'q' => 'Can staff request salary advances through the system?',
                        'a' => 'Yes. Employees or managers can submit advance requests, which upon owner approval are logged in the employee ledger and deducted from monthly payroll.'
                    ]
                ],
                'related'        => ['stock-management', 'settings-admin', 'dashboard-live-rates']
            ],

            // ── MODULE 9: Stock Management ──
            'stock-management' => [
                'slug'           => 'stock-management',
                'title'          => 'Stock Management',
                'badge'          => 'ENTERPRISE INVENTORY ENGINE',
                'category'       => 'Inventory & Stock Control',
                'icon'           => 'bi-box-seam',
                'h1'             => 'Jewellery Inventory Management, RFID & Consignment Software',
                'h2'             => 'Complete Control Across 4 Sub-Groups: Catalogue, Consignment, Precious Metals & RFID',
                'headline'       => 'Jewellery Inventory Management, RFID & Consignment Software',
                'subtitle'       => 'Complete Control Across 4 Sub-Groups: Catalogue, Consignment, Precious Metals & RFID',
                'intro'          => 'Jewellery inventory represents your largest capital investment and your highest operational risk. GoldMatrix\'s Stock Management module is the industry\'s most comprehensive inventory engine, structured across 4 specialized sub-groups: Digital Catalogue & Barcode Re-printing, Consignments (Memo In/Out) & Branch Transfers, Gold/Platinum/Diamond Vaults, and Imitation/Watches with UHF RFID Automation. Track every milligram of precious metal and every carat of certified diamond with 100% precision.',
                'description'    => 'The largest jewellery inventory module covering Product Catalogue, Barcodes, Consignment & Memos, Branch Transfers, Gold/Platinum/Diamond vaults, Imitation, and RFID auditing.',
                'bullets'        => [
                    'Catalogue & Stock: Product Catalogue & Barcode Re-Print',
                    'Consignment & Transfer: Memo In/Out & Branch Transfers',
                    'Gold, Platinum & Diamond: Category-wise precious inventory',
                    'Imitation, Services & Reports: Watches, RFID & Valuation'
                ],
                'target_persona' => 'Inventory Controllers, Showroom Managers, Stock Auditors & Multi-Branch Chains',
                'persona_desc'   => 'Built for inventory controllers, showroom managers, stock auditors, and multi-branch jewellery chain operators who need 100% tamper-proof inventory accuracy.',
                // 4 SUB-TABS REQUIREMENT
                'tabs'           => [
                    [
                        'id'           => 'catalogue-stock',
                        'label'        => 'Catalogue & Stock',
                        'icon'         => 'bi-grid-3x3-gap-fill',
                        'sub_features' => [
                            [
                                'icon'   => 'bi-images',
                                'title'  => 'Product Catalogue',
                                'desc'   => 'High-resolution digital catalogue with multi-angle photography, design code lookup, and customer presentation kiosk mode.',
                                'points' => ['High-res multi-angle photo gallery', 'Customer presentation kiosk mode', 'Instant design code search', 'Shareable WhatsApp catalogue links']
                            ],
                            [
                                'icon'   => 'bi-printer-fill',
                                'title'  => 'Barcode Re-Print',
                                'desc'   => 'Instant reprinting of damaged dumbbell and rat-tail jewellery tags with custom label layouts for Zebra, TSC, and Citizen printers.',
                                'points' => ['Dumbbell & rat-tail label support', 'Dynamic HUID & purity print', '1-Click damaged tag reprinting', 'Custom label designer included']
                            ],
                            [
                                'icon'   => 'bi-layout-three-columns',
                                'title'  => 'Showcase Tray Allocation',
                                'desc'   => 'Organize showroom stock by physical trays (e.g. Tray 14: 22K Ladies Rings, 24 Pcs) with tray-level weight validation and fast count audits.',
                                'points' => ['Tray capacity & weight limits', 'Tray-level barcode tagging', 'Quick visual tray balancing', 'Showcase location hierarchy']
                            ],
                            [
                                'icon'   => 'bi-clock-history',
                                'title'  => 'Stock History Log',
                                'desc'   => 'Complete chronological movement history for every single item from initial purchase/production to final sale.',
                                'points' => ['Lifecycle audit trail', 'Price change logs', 'Branch transfer history', 'Sale and return tracking']
                            ]
                        ]
                    ],
                    [
                        'id'           => 'consignment-transfer',
                        'label'        => 'Consignment & Transfer',
                        'icon'         => 'bi-arrow-left-right',
                        'sub_features' => [
                            [
                                'icon'   => 'bi-file-earmark-arrow-up',
                                'title'  => 'Memo Out (Customer Approvals)',
                                'desc'   => 'Issue jewellery on approval/memo to VIP customers with time-limited approval slips, partial returns, and automatic conversion to tax invoice.',
                                'points' => ['Time-bound customer approval slips', 'Partial item return handling', 'Automatic invoicing upon acceptance', 'Overdue memo reminder alerts']
                            ],
                            [
                                'icon'   => 'bi-file-earmark-arrow-down',
                                'title'  => 'Memo In (Vendor Consignments)',
                                'desc'   => 'Receive goods on consignment from manufacturers and traders with weight verification, approval tracking, and supplier return challans.',
                                'points' => ['Consignment vendor ledger', 'Weight & purity verification on arrival', 'Vendor return challan generation', 'Consignment sales margin tracking']
                            ],
                            [
                                'icon'   => 'bi-box-seam',
                                'title'  => 'Memo Inventory',
                                'desc'   => 'Dedicated real-time tracking of all items currently out on customer approval or in on vendor consignment.',
                                'points' => ['Live memo inventory status', 'Vendor consignment valuation', 'Customer approval aging', 'Automatic stock isolation']
                            ],
                            [
                                'icon'   => 'bi-truck',
                                'title'  => 'Branch Transfer, Transfer History & Receive History',
                                'desc'   => 'Transfer stock securely between branches or from central warehouse with gate pass documentation, transit tracking, and signed receiving logs.',
                                'points' => ['Branch dispatch & transit tracking', 'Destination receiving verification', 'Transit loss detection alerts', 'Signed delivery note generation']
                            ]
                        ]
                    ],
                    [
                        'id'           => 'gold-platinum-diamond',
                        'label'        => 'Gold, Platinum & Diamond',
                        'icon'         => 'bi-gem',
                        'sub_features' => [
                            [
                                'icon'   => 'bi-coin',
                                'title'  => 'Gold & Silver / Gold & Silver Inventory',
                                'desc'   => 'Track 24K, 22K, 18K, 14K, 9K gold and 925 silver stock separately by gross weight, net weight, fine weight, and current market replacement value.',
                                'points' => ['Fine gold conversion per karat', 'Scrap and raw bullion tracking', 'Hallmark HUID center mapping', 'Live replacement valuation']
                            ],
                            [
                                'icon'   => 'bi-award',
                                'title'  => 'Platinum / Platinum Inventory',
                                'desc'   => 'Dedicated platinum stock tracking (Pt950, Pt900) with alloy details, special making charges, and certified authenticity logging.',
                                'points' => ['Pt950 purity grade tracking', 'Alloy specification logging', 'Dedicated platinum price board', 'Platinum certificate linkage']
                            ],
                            [
                                'icon'   => 'bi-diamond-fill',
                                'title'  => 'Diamond & Stone Inventory / Diamond Inventory',
                                'desc'   => 'Manage diamond jewellery and loose solitaire parcels with 4Cs tracking (Carat, Cut, Clarity, Color), per-carat rates, and certificate numbers (GIA, IGI).',
                                'points' => ['GIA / IGI certificate lookup', '4Cs grading attribute matrix', 'Loose parcel weight deductions', 'Per-carat & piece pricing']
                            ],
                            [
                                'icon'   => 'bi-stars',
                                'title'  => 'Precious Colored Gemstones Vault',
                                'desc'   => 'Track precious stones (Ruby, Emerald, Sapphire, Polki, Pearls) by piece count, carat weight, origin, treatment, and certificate details.',
                                'points' => ['Stone weight vs gross weight math', 'Certificate document storage', 'Loose gem packet barcode tags', 'Stone cost per carat valuation']
                            ]
                        ]
                    ],
                    [
                        'id'           => 'imitation-services-reports',
                        'label'        => 'Imitation, Services & Reports',
                        'icon'         => 'bi-broadcast',
                        'sub_features' => [
                            [
                                'icon'   => 'bi-smartwatch',
                                'title'  => 'Imitation / Watches Inventory',
                                'desc'   => 'Manage high-end watches, imitation jewellery, and accessories with serial number tracking, warranty cards, and piece-based billing.',
                                'points' => ['Watch serial number logging', 'Warranty period tracking', 'Imitation piece-based inventory', 'Brand & model categorization']
                            ],
                            [
                                'icon'   => 'bi-tools',
                                'title'  => 'Service Management & Service Analytics',
                                'desc'   => 'Track after-sales services including rhodium plating, resizing, stringing, and ultrasonic cleaning with customer service history.',
                                'points' => ['Service job card creation', 'Estimated completion date alerts', 'Customer service history log', 'Service billing & GST invoices']
                            ],
                            [
                                'icon'   => 'bi-broadcast-pin',
                                'title'  => 'RFID & Barcode Scanner / RFID & Barcode Tag Management',
                                'desc'   => 'Scan entire showcase trays containing 50+ items in under 3 seconds using UHF RFID readers for instant inventory auditing and POS checkout.',
                                'points' => ['Tray-full RFID bulk scanning', 'Chainway / CSL hardware sync', 'Instant audit discrepancy flags', 'Anti-theft gate reader support']
                            ],
                            [
                                'icon'   => 'bi-pie-chart-fill',
                                'title'  => 'Inventory Valuation, Summary, Purity Analysis & Procurement',
                                'desc'   => 'Generate multi-method inventory valuations (FIFO, Weighted Average, Live Market Rate) with karatwise purity breakdowns and procurement reorder alerts.',
                                'points' => ['FIFO & Market Rate valuation', 'Reorder level alerts', 'Dead stock identification', 'Procurement purchase planning']
                            ]
                        ]
                    ]
                ],
                'sub_features'   => [],
                'visual_title'   => '4-Subgroup Inventory Architecture & UHF RFID Bulk Scanning',
                'visual_desc'    => 'Visual display showing the 4 interactive inventory sub-tabs (Catalogue & Stock, Consignment & Transfer, Gold/Platinum/Diamond, Imitation/Services/Reports) with RFID tray scan verification.',
                'visual_points'  => [
                    'UHF RFID tray scanning verifies 50 items in 3 seconds',
                    'Consignment Memo In / Memo Out approval tracking with 1-click billing',
                    'Multi-valuation engine computes exact inventory worth at purchase cost and live replacement value'
                ],
                'visual_image'   => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=900&auto=format&fit=crop&q=80',
                'faqs'           => [
                    [
                        'q' => 'How fast is RFID tray inventory scanning in GoldMatrix?',
                        'a' => 'You can scan an entire showcase tray containing 50+ tagged jewellery items in under 3 seconds, turning a 4-hour physical audit into a 5-minute task.'
                    ],
                    [
                        'q' => 'How does Memo Out (approval) work for VIP customers?',
                        'a' => 'You generate an approval slip with photos and weights. If the customer keeps 2 items and returns 1, GoldMatrix auto-bills the 2 items and returns the 3rd to stock in 1 click.'
                    ],
                    [
                        'q' => 'Can we track certified diamonds with GIA/IGI certificate numbers?',
                        'a' => 'Yes. You can record 4Cs parameters, certificate numbers, carat weights, and per-carat pricing with automatic stone weight deduction during counter billing.'
                    ],
                    [
                        'q' => 'Does the system alert us to dead or slow-moving stock?',
                        'a' => 'Yes. The Inventory Valuation report highlights items sitting in stock beyond your defined holding threshold so you can melt, remodel, or discount them.'
                    ]
                ],
                'related'        => ['order-management', 'production', 'operations']
            ],

            // ── MODULE 10: Settings & Admin ──
            'settings-admin' => [
                'slug'           => 'settings-admin',
                'title'          => 'Settings & Admin',
                'badge'          => 'ENTERPRISE SECURITY & CONFIG',
                'category'       => 'Administration',
                'icon'           => 'bi-gear-wide-connected',
                'h1'             => 'Jewellery ERP Administration, User Roles, Voucher Types & CRM Software',
                'h2'             => 'Enterprise Security, Custom Voucher Numbering, Activity Logs & WhatsApp CRM',
                'headline'       => 'Jewellery ERP Administration, User Roles, Voucher Types & CRM Software',
                'subtitle'       => 'Enterprise Security, Custom Voucher Numbering, Activity Logs & WhatsApp CRM',
                'intro'          => 'Enterprise jewellery software must adapt to your company\'s hierarchy, security standards, and customer communication channels. GoldMatrix\'s Settings & Admin module provides complete administrative control. Configure custom voucher types with branch-specific prefixes, enforce granular role-based permissions, monitor an immutable real-time activity log for forensic auditability, and set up automated WhatsApp CRM rules for customer birthday greetings, scheme reminders, and rate updates.',
                'description'    => 'Custom voucher types, user management with role-based permissions, live activity logs, WhatsApp CRM configuration, and software customization.',
                'bullets'        => [
                    'Set Software: Company, branch & fiscal configuration',
                    'Voucher Type: Custom voucher prefixes & numbering',
                    'User Management: Granular role-based permissions',
                    'Activity Log: Forensic audit trail & WhatsApp CRM'
                ],
                'target_persona' => 'Enterprise Owners, IT Directors & Showroom System Administrators',
                'persona_desc'   => 'Built for enterprise owners, IT directors, and system administrators who require bank-grade access security, customized voucher numbering, and automated customer marketing.',
                'sub_features'   => [
                    [
                        'icon'   => 'bi-laptop',
                        'title'  => 'Set Software',
                        'desc'   => 'Configure company details, multiple branch entities, fiscal calendars, currency symbols, and default gold/silver purity standards.',
                        'points' => ['Multi-branch entity configuration', 'Fiscal calendar settings', 'Purity standard definitions', 'Branding & logo setup']
                    ],
                    [
                        'icon'   => 'bi-file-earmark-ruled',
                        'title'  => 'Voucher Type',
                        'desc'   => 'Create custom voucher series for retail tax invoices, wholesale bills, estimate slips, repair receipts, and jobwork with custom prefix numbering.',
                        'points' => ['Branch-specific voucher prefixes', 'Automatic sequential numbering', 'Custom voucher layout mapping', 'Separate tax & estimate series']
                    ],
                    [
                        'icon'   => 'bi-person-gear',
                        'title'  => 'User Management',
                        'desc'   => 'Define granular roles (Director, Store Manager, Cashier, Accountant, Karigar Head) with button-level read, write, edit, and delete permissions.',
                        'points' => ['Granular module permissions', 'Manager OTP approval rules', 'Session timeout & multi-device control', 'Biometric login support']
                    ],
                    [
                        'icon'   => 'bi-shield-check',
                        'title'  => 'Activity Log',
                        'desc'   => 'Immutable security log recording every user action, IP address, timestamp, old value, and new value for 100% internal fraud prevention.',
                        'points' => ['IP address & timestamp tracking', 'Before & after value comparison', 'Bill modification / deletion alerts', 'Exportable audit logs for compliance']
                    ],
                    [
                        'icon'   => 'bi-whatsapp',
                        'title'  => 'CRM',
                        'desc'   => 'Set up automated WhatsApp and SMS triggers for customer birthday wishes, anniversary offers, kitty scheme due dates, and live rate alerts.',
                        'points' => ['WhatsApp Business API integration', 'Automated birthday & anniversary triggers', 'Payment reminder templates', 'Promotional campaign broadcast']
                    ]
                ],
                'visual_title'   => 'Role Permission Matrix & Immutable Activity Audit Log',
                'visual_desc'    => 'Visual display showing the User Role Permission Matrix with granular button-level access checkboxes, alongside the Live Activity Log tracking user edits with timestamps.',
                'visual_points'  => [
                    'Button-level user permissions prevent unauthorized discounts and data export',
                    'Immutable activity log records forensic before-and-after values with timestamps',
                    'Automated WhatsApp CRM workflows engage customers and boost repeat store visits'
                ],
                'visual_image'   => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=900&auto=format&fit=crop&q=80',
                'faqs'           => [
                    [
                        'q' => 'Can we customize invoice numbering prefixes for each branch showroom?',
                        'a' => 'Yes. You can create independent voucher numbering series with custom prefixes (e.g. DXB-INV-2026-0001, MUM-RET-2026-0001) for each branch.'
                    ],
                    [
                        'q' => 'How does the Activity Log prevent employee fraud?',
                        'a' => 'The immutable activity log records every critical action — bill cancellations, discount overrides, backdated entries, and stock adjustments — with the staff member\'s name, IP, and timestamp.'
                    ],
                    [
                        'q' => 'How does the WhatsApp CRM automation work?',
                        'a' => 'GoldMatrix connects with the WhatsApp Business API to automatically send transactional bills, payment receipts, order ready alerts, and promotional greetings on customer birthdays.'
                    ],
                    [
                        'q' => 'Can we restrict cashiers from giving discounts without manager approval?',
                        'a' => 'Yes. You can configure permission rules requiring a manager OTP or biometric authorization whenever a cashier attempts to apply a discount above a set limit.'
                    ]
                ],
                'related'        => ['employee-management', 'dashboard-live-rates', 'operations']
            ]
        ];
    }

    /**
     * Dedicated Single Feature Cluster Page Handler
     */
    public function featureModule(string $slug): void {
        $aliases = [
            'dashboard'                  => 'dashboard-live-rates',
            'dashboards'                 => 'dashboard-live-rates',
            'live-rates'                 => 'dashboard-live-rates',
            'opening'                    => 'business-opening',
            'opening-setup'              => 'business-opening',
            'opening-business-setup'     => 'business-opening',
            'business-setup'             => 'business-opening',
            'finance-operations'         => 'operations',
            'operations-finance-core'    => 'operations',
            'orders'                     => 'order-management',
            'order'                      => 'order-management',
            'manufacturing-jobwork'      => 'production',
            'manufacturing'              => 'production',
            'production-manufacturing'   => 'production',
            'accounting-gst'             => 'financial-statement',
            'accounting'                 => 'financial-statement',
            'financial-statements'       => 'financial-statement',
            'reports'                    => 'report-analysis',
            'report'                     => 'report-analysis',
            'reports-analysis'           => 'report-analysis',
            'employee'                   => 'employee-management',
            'hr-employee-management'     => 'employee-management',
            'staff-management'           => 'employee-management',
            'pos-inventory'              => 'stock-management',
            'inventory'                  => 'stock-management',
            'stock'                      => 'stock-management',
            'gold-diamond-management'    => 'stock-management',
            'crm-rfid-barcode'           => 'settings-admin',
            'settings'                   => 'settings-admin',
            'admin-settings'             => 'settings-admin'
        ];

        if (isset($aliases[$slug])) {
            $slug = $aliases[$slug];
        }

        $allModules = $this->getModulesData();

        if (!isset($allModules[$slug])) {
            http_response_code(404);
            view('admin.errors.404', [
                'title'              => '404 - Feature Module Not Found',
                'header_menu'        => $this->getMenu('header'),
                'footer_col1_menu'   => $this->getMenu('footer_col1'),
                'footer_col2_menu'   => $this->getMenu('footer_col2'),
                'footer_col3_menu'   => $this->getMenu('footer_col3'),
                'footer_bottom_menu' => $this->getMenu('footer_bottom'),
            ]);
            return;
        }

        $module = $allModules[$slug];

        // Resolve related modules
        $relatedModules = [];
        if (!empty($module['related'])) {
            foreach ($module['related'] as $relSlug) {
                if (isset($allModules[$relSlug])) {
                    $relatedModules[] = $allModules[$relSlug];
                }
            }
        }

        // Build JSON-LD Structured Data Schema (BreadcrumbList + SoftwareApplication + FAQPage)
        $breadcrumbsSchema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Home',
                    'item'     => site_url('/')
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'Features & Modules',
                    'item'     => site_url('features')
                ],
                [
                    '@type'    => 'ListItem',
                    'position' => 3,
                    'name'     => $module['title'],
                    'item'     => site_url('features/' . $slug)
                ]
            ]
        ];

        $softwareSchema = [
            '@context'            => 'https://schema.org',
            '@type'               => 'SoftwareApplication',
            'name'                => 'GoldMatrix Jewellery ERP — ' . $module['title'],
            'operatingSystem'     => 'Web Browser, Windows, Android, iOS',
            'applicationCategory' => 'BusinessApplication',
            'description'         => $module['intro'] ?? $module['description'] ?? '',
            'offers'              => [
                '@type'         => 'Offer',
                'price'         => '0',
                'priceCurrency' => 'INR',
                'description'   => 'Free 1-on-1 Interactive Demo & Trial'
            ],
            'publisher'           => [
                '@type' => 'Organization',
                'name'  => 'GoldMatrix Software Technologies',
                'url'   => site_url('/')
            ]
        ];

        $schemaArray = [$breadcrumbsSchema, $softwareSchema];

        if (!empty($module['faqs']) && is_array($module['faqs'])) {
            $faqElements = [];
            foreach ($module['faqs'] as $faqItem) {
                if (!empty($faqItem['q']) && !empty($faqItem['a'])) {
                    $faqElements[] = [
                        '@type'          => 'Question',
                        'name'           => $faqItem['q'],
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text'  => $faqItem['a']
                        ]
                    ];
                }
            }
            if (!empty($faqElements)) {
                $schemaArray[] = [
                    '@context'   => 'https://schema.org',
                    '@type'      => 'FAQPage',
                    'mainEntity' => $faqElements
                ];
            }
        }

        $canonicalUrl = !empty($module['canonical_url']) ? site_url(ltrim($module['canonical_url'], '/')) : site_url('features/' . $slug);

        $data = array_merge($this->solutionBaseData(), [
            'module'             => $module,
            'all_modules'        => $allModules,
            'related_modules'    => $relatedModules,
            'page_title'         => $module['title'],
            'page_badge'         => $module['badge'],
            'page_headline'      => $module['h1'] ?? $module['headline'] ?? $module['title'],
            'page_subtitle'      => $module['h2'] ?? $module['subtitle'] ?? '',
            'page_intro'         => $module['intro'] ?? $module['description'] ?? '',
            'page_icon'          => $module['icon'],
            'meta_title'         => $module['meta_title'] ?? (($module['h1'] ?? $module['title']) . ' | GoldMatrix ERP'),
            'meta_desc'          => $module['meta_desc'] ?? substr($module['intro'] ?? $module['subtitle'] ?? '', 0, 160),
            'meta_keywords'      => $module['meta_keywords'] ?? (strtolower($module['title']) . ', jewellery erp software, gold software, jewelry business management'),
            'canonical_url'      => $canonicalUrl,
            'og_title'           => ($module['title']) . ' — GoldMatrix Jewellery ERP',
            'og_desc'            => $module['meta_desc'] ?? substr($module['intro'] ?? $module['subtitle'] ?? '', 0, 160),
            'og_url'             => $canonicalUrl,
            'schema_json'        => $schemaArray,
        ]);

        view('frontend.features.feature-page', $data);
    }

    // Backward-compatible feature routes
    public function featurePosInventory(): void {
        $this->featureModule('stock-management');
    }

    public function featureManufacturingJobwork(): void {
        $this->featureModule('production');
    }

    public function featureAccountingGst(): void {
        $this->featureModule('financial-statement');
    }

    public function featureGoldDiamond(): void {
        $this->featureModule('stock-management');
    }

    public function featureCrmRfid(): void {
        $this->featureModule('settings-admin');
    }

    // ════════════════════════════════════════════════════════
    // INDUSTRIES, INTEGRATIONS, REQUEST DEMO
    // ════════════════════════════════════════════════════════

    public function industries(): void {
        $data = array_merge($this->solutionBaseData(), [
            'meta_title'    => 'Jewellery Business Software | GoldMatrix ERP for All Jewellery Industries',
            'meta_desc'     => 'GoldMatrix ERP serves jewellery retailers, wholesalers, manufacturers, gold & silver dealers and multi-branch businesses across India, UAE and worldwide.',
            'meta_keywords' => 'jewellery business software, jewellery industry software, gold silver dealer software, multi branch jewellery software',
            'page_title'    => 'Built for the Jewellery Industry',
            'page_subtitle' => 'GoldMatrix serves every segment of the jewellery industry — from single-counter showrooms to multi-branch enterprises.',
        ]);
        view('frontend.industries', $data);
    }

    public function integrations(): void {
        $data = array_merge($this->solutionBaseData(), [
            'meta_title'    => 'Jewellery Software Integrations | GoldMatrix ERP',
            'meta_desc'     => 'Connect GoldMatrix Jewellery ERP with Shopify, WooCommerce, WhatsApp, Payment Systems, Accounting Software, Barcode/RFID, E-Invoice and E-Way Bill.',
            'meta_keywords' => 'jewellery software integrations, jewellery erp shopify, jewellery whatsapp integration, rfid barcode integration',
        ]);
        view('frontend.integrations', $data);
    }

    public function requestDemo(): void {
        $data = array_merge($this->solutionBaseData(), [
            'meta_title'    => 'Request Free Demo | Jewellery ERP Software | GoldMatrix',
            'meta_desc'     => 'Book a free personalized demo of GoldMatrix Jewellery ERP Software. See how it works for your retail, wholesale or manufacturing business.',
            'meta_keywords' => 'jewellery erp software demo, free jewellery software demo, goldmatrix demo request',
        ]);
        view('frontend.request-demo', $data);
    }

    // ════════════════════════════════════════════════════════
    // DYNAMIC XML SITEMAP & ROBOTS.TXT
    // ════════════════════════════════════════════════════════

    public function sitemapXml(): void {
        header('Content-Type: application/xml; charset=utf-8');

        $baseUrl = rtrim(site_url(), '/');
        $now = date('Y-m-d');

        $urls = [
            ['loc' => $baseUrl . '/', 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => $baseUrl . '/solutions', 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => $baseUrl . '/solutions/jewellery-retail', 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => $baseUrl . '/solutions/jewellery-wholesale', 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => $baseUrl . '/solutions/jewellery-manufacturing', 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => $baseUrl . '/features', 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => $baseUrl . '/industries', 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => $baseUrl . '/integrations', 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => $baseUrl . '/about', 'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => $baseUrl . '/contact', 'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => $baseUrl . '/request-demo', 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => $baseUrl . '/blog', 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '0.8'],
        ];

        // 1. Dynamic Pages
        try {
            $pages = $this->db->fetchAll("SELECT slug, updated_at FROM pages WHERE deleted_at IS NULL AND status = 'published'");
            foreach ($pages as $p) {
                $cleanSlug = ltrim($p['slug'] ?? '', '/');
                if ($cleanSlug !== '' && $cleanSlug !== '#') {
                    $urls[] = [
                        'loc' => $baseUrl . '/' . $cleanSlug,
                        'lastmod' => !empty($p['updated_at']) ? date('Y-m-d', strtotime($p['updated_at'])) : $now,
                        'changefreq' => setting('sitemap_changefreq', 'weekly'),
                        'priority' => setting('sitemap_priority', '0.8'),
                    ];
                }
            }
        } catch (\Throwable $e) {}

        // 2. Published Blog Posts
        try {
            $blogs = $this->db->fetchAll("SELECT slug, updated_at, published_at FROM blog_posts WHERE status = 'published'");
            foreach ($blogs as $b) {
                $urls[] = [
                    'loc' => $baseUrl . '/blog/' . ltrim($b['slug'], '/'),
                    'lastmod' => !empty($b['updated_at']) ? date('Y-m-d', strtotime($b['updated_at'])) : (!empty($b['published_at']) ? date('Y-m-d', strtotime($b['published_at'])) : $now),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ];
            }
        } catch (\Throwable $e) {}

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
        
        $added = [];
        foreach ($urls as $u) {
            if (isset($added[$u['loc']])) continue;
            $added[$u['loc']] = true;
            echo "  <url>\n";
            echo "    <loc>" . htmlspecialchars($u['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            echo "    <lastmod>" . $u['lastmod'] . "</lastmod>\n";
            echo "    <changefreq>" . $u['changefreq'] . "</changefreq>\n";
            echo "    <priority>" . $u['priority'] . "</priority>\n";
            echo "  </url>\n";
        }
        echo '</urlset>';
        exit;
    }

    public function robotsTxt(): void {
        header('Content-Type: text/plain; charset=utf-8');
        $default = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /storage/\nDisallow: /app/\nDisallow: /config/\nDisallow: /routes/\nDisallow: /database/\n\nSitemap: " . site_url('sitemap.xml');
        $content = setting('robots_txt_content', $default);
        if (strpos($content, '{SITEMAP_URL}') !== false) {
            $content = str_replace('{SITEMAP_URL}', site_url('sitemap.xml'), $content);
        }
        echo $content;
        exit;
    }
}
