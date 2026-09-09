<?php
/**
 * Database Seed Script for Homepage Sections & Hero Slides
 */
require_once __DIR__ . '/../includes/db.php';

try {
    // 1. Create homepage_sections table if not exists (MySQL compatible)
    $pdo->exec("CREATE TABLE IF NOT EXISTS homepage_sections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        section_key VARCHAR(120) UNIQUE NOT NULL,
        value TEXT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // 2. Create homepage_items table if not exists (MySQL compatible)
    $pdo->exec("CREATE TABLE IF NOT EXISTS homepage_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        section VARCHAR(80) NOT NULL,
        title VARCHAR(255) NOT NULL DEFAULT '',
        subtitle VARCHAR(255) DEFAULT '',
        description TEXT DEFAULT '',
        icon VARCHAR(80) DEFAULT '',
        link VARCHAR(255) DEFAULT '',
        image VARCHAR(500) DEFAULT '',
        mobile_image VARCHAR(500) DEFAULT '',
        alt_text VARCHAR(255) DEFAULT '',
        badge VARCHAR(120) DEFAULT '',
        btn1_text VARCHAR(120) DEFAULT '',
        btn1_link VARCHAR(255) DEFAULT '',
        btn2_text VARCHAR(120) DEFAULT '',
        btn2_link VARCHAR(255) DEFAULT '',
        features TEXT DEFAULT '',
        accent_color VARCHAR(30) DEFAULT '#F59E0B',
        extra TEXT DEFAULT '',
        sort_order INT DEFAULT 0,
        is_active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_section (section)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    echo "Tables ensured successfully.\n";

    // 3. Seed homepage_sections
    $sections = [
        'meta_title'        => 'GoldMatrix — #1 Jewellery ERP & POS Software in India',
        'meta_desc'         => 'Complete Jewellery ERP Software for Inventory, Karigar Management, POS, GST Billing, Accounting & Multi-Branch. Trusted by 1500+ jewelers.',
        'meta_keywords'     => 'jewellery erp, gold shop software, karigar management, jewellery pos billing',
        'hero_badge'        => '🏅 #1 JEWELLERY ERP SOFTWARE IN INDIA',
        'hero_title_line1'  => 'The Complete Jewellery ERP',
        'hero_title_line2'  => 'Built for Indian Jewelers',
        'hero_desc'         => 'Manage your inventory, sales, karigar tracking, GST billing & multi-branch operations from a single powerful platform.',
        'hero_image'        => '/public/assets/images/why-goldmatrix-mockup.png',
        'hero_btn1_text'    => 'Book a Free Demo',
        'hero_btn1_link'    => '#contact',
        'hero_btn2_text'    => 'Watch Video Demo',
        'hero_btn2_link'    => '#contact',
        'hero_sub_badge1'   => 'Cloud Based',
        'hero_sub_badge2'   => 'Multi-Branch Sync',
        'hero_sub_badge3'   => 'Real-time GST',
        'hero_sub_badge4'   => '100% Data Security',
    ];

    $stSec = $pdo->prepare("INSERT INTO homepage_sections (section_key, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
    foreach ($sections as $k => $v) {
        $stSec->execute([$k, $v]);
    }

    // 4. Seed hero_slides into homepage_items if empty
    $stCount = $pdo->query("SELECT COUNT(*) FROM homepage_items WHERE section = 'hero_slides'");
    if ((int)$stCount->fetchColumn() === 0) {
        $slides = [
            [
                'section'      => 'hero_slides',
                'title'        => 'The Complete Jewellery ERP Built to Run Your Business.',
                'subtitle'     => 'Manage inventory, sales, manufacturing & accounting.',
                'description'  => 'Manage inventory, sales, manufacturing, accounting, POS, CRM, wholesale and multi-branch operations from one powerful platform.',
                'badge'        => 'ALL-IN-ONE JEWELLERY ERP',
                'btn1_text'    => 'Book a Free Demo',
                'btn1_link'    => '#contact',
                'btn2_text'    => 'Start 7-Day Free Trial',
                'btn2_link'    => '#contact',
                'image'        => '/public/assets/images/why-goldmatrix-mockup.png',
                'features'     => json_encode(['Cloud Based', 'Multi Branch', 'Real-time Data', 'Secure & Scalable']),
                'accent_color' => '#F59E0B',
                'sort_order'   => 1
            ],
            [
                'section'      => 'hero_slides',
                'title'        => 'High-Speed POS & Smart GST Billing for Jewellery Shops.',
                'subtitle'     => 'Instant Invoicing, Old Gold Exchange & Barcode Scanning.',
                'description'  => 'Generate accurate GST invoices in seconds, track old gold exchange, hallmark details, and manage multiple sales counters with ease.',
                'badge'        => 'JEWELLERY POS & BILLING',
                'btn1_text'    => 'Explore Billing Features',
                'btn1_link'    => '#features',
                'btn2_text'    => 'Schedule Live Demo',
                'btn2_link'    => '#contact',
                'image'        => '/public/assets/images/jewellers-app-banner.png',
                'features'     => json_encode(['Fast GST Billing', 'Barcode Scanning', 'Old Gold Calculation', 'Multi-Counter']),
                'accent_color' => '#10B981',
                'sort_order'   => 2
            ],
            [
                'section'      => 'hero_slides',
                'title'        => 'Karigar & Manufacturing Work Order Management.',
                'subtitle'     => 'Zero Gold Leakage with Accurate Issue, Receive & Loss Tracking.',
                'description'  => 'Complete tracking of raw gold issued to Karigars, daily melting reports, wastage calculations, and finished item stock entry.',
                'badge'        => 'KARIGAR & MANUFACTURING',
                'btn1_text'    => 'See Manufacturing Workflow',
                'btn1_link'    => '#workflow',
                'btn2_text'    => 'Contact Specialist',
                'btn2_link'    => '#contact',
                'image'        => '/public/assets/images/erp-workflow.svg',
                'features'     => json_encode(['Wastage Control', 'Melting Reports', 'Karigar Job Cards', 'Gold Purity Check']),
                'accent_color' => '#3B82F6',
                'sort_order'   => 3
            ]
        ];

        $stItem = $pdo->prepare("INSERT INTO homepage_items 
            (section, title, subtitle, description, badge, btn1_text, btn1_link, btn2_text, btn2_link, image, features, accent_color, sort_order) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        foreach ($slides as $s) {
            $stItem->execute([
                $s['section'], $s['title'], $s['subtitle'], $s['description'], $s['badge'],
                $s['btn1_text'], $s['btn1_link'], $s['btn2_text'], $s['btn2_link'],
                $s['image'], $s['features'], $s['accent_color'], $s['sort_order']
            ]);
        }
        echo "Hero slides seeded successfully.\n";
    }

    // 5. Seed brand_logos into homepage_items if empty
    $stBrandCount = $pdo->query("SELECT COUNT(*) FROM homepage_items WHERE section = 'brand_logos'");
    if ((int)$stBrandCount->fetchColumn() === 0) {
        $brands = [
            ['title' => 'Tanishq', 'image' => '/public/assets/images/brands/tanishq.svg', 'sort_order' => 1],
            ['title' => 'Kalyan Jewellers', 'image' => '/public/assets/images/brands/kalyan.svg', 'sort_order' => 2],
            ['title' => 'PC Jeweller', 'image' => '/public/assets/images/brands/pcjeweller.svg', 'sort_order' => 3],
            ['title' => 'Malabar Gold', 'image' => '/public/assets/images/brands/malabar.svg', 'sort_order' => 4],
            ['title' => 'Senco Gold', 'image' => '/public/assets/images/brands/senco.svg', 'sort_order' => 5],
            ['title' => 'Jos Alukkas', 'image' => '/public/assets/images/brands/josalukkas.svg', 'sort_order' => 6],
        ];
        $stBrand = $pdo->prepare("INSERT INTO homepage_items (section, title, image, sort_order) VALUES ('brand_logos', ?, ?, ?)");
        foreach ($brands as $b) {
            $stBrand->execute([$b['title'], $b['image'], $b['sort_order']]);
        }
        echo "Brand logos seeded successfully.\n";
    }

    echo "Seeding completed successfully.\n";
} catch (Exception $e) {
    echo "Error during seeding: " . $e->getMessage() . "\n";
}
