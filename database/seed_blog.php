<?php
/**
 * Blog Database Schema + Seed Script
 */
$dbPath = __DIR__ . '/../storage/database.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 1. blog_categories table
$pdo->exec("CREATE TABLE IF NOT EXISTS blog_categories (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    name        TEXT NOT NULL,
    slug        TEXT NOT NULL UNIQUE,
    description TEXT,
    color       TEXT DEFAULT '#F59E0B',
    created_at  TEXT DEFAULT (datetime('now')),
    updated_at  TEXT DEFAULT (datetime('now'))
)");

// 2. blog_posts table
$pdo->exec("CREATE TABLE IF NOT EXISTS blog_posts (
    id               INTEGER PRIMARY KEY AUTOINCREMENT,
    title            TEXT NOT NULL,
    slug             TEXT NOT NULL UNIQUE,
    excerpt          TEXT,
    content          TEXT,
    featured_image   TEXT DEFAULT '',
    category_id      INTEGER DEFAULT 1,
    author_name      TEXT DEFAULT 'GoldMatrix Team',
    status           TEXT DEFAULT 'published',
    meta_title       TEXT,
    meta_description TEXT,
    views            INTEGER DEFAULT 0,
    published_at     TEXT DEFAULT (datetime('now')),
    created_at       TEXT DEFAULT (datetime('now')),
    updated_at       TEXT DEFAULT (datetime('now'))
)");

echo "Tables created.\n";

// Check if already seeded
$count = $pdo->query("SELECT COUNT(*) FROM blog_categories")->fetchColumn();
if ($count > 0) {
    echo "Already seeded. Done.\n";
    exit;
}

// Seed categories
$cats = [
    ['Jewellery ERP Tips',         'jewellery-erp-tips',         'Tips & tricks for jewellery business management',      '#F59E0B'],
    ['GST & Compliance',           'gst-compliance',             'GST filing, tax compliance for jewellers',              '#10B981'],
    ['Inventory Management',       'inventory-management',       'Stock, hallmarking, HUID & inventory best practices',   '#3B82F6'],
    ['Business Growth',            'business-growth',            'How to grow your jewellery retail or manufacturing',    '#8B5CF6'],
    ['Software Features',          'software-features',          'Deep dive into GoldMatrix ERP features',               '#EF4444'],
    ['Industry News',              'industry-news',              'Latest news from the jewellery industry',               '#0EA5E9'],
];
$insertCat = $pdo->prepare("INSERT OR IGNORE INTO blog_categories (name, slug, description, color) VALUES (?, ?, ?, ?)");
foreach ($cats as $c) $insertCat->execute($c);
echo "Categories seeded.\n";

// Seed sample posts
$posts = [
    [
        'title'       => 'How GoldMatrix ERP Transformed a Mumbai Jewellery Showroom',
        'slug'        => 'goldmatrix-erp-transformed-mumbai-jewellery-showroom',
        'excerpt'     => 'A busy Mumbai showroom with 3 branches was struggling with stock discrepancies and GST filing chaos. Here is how GoldMatrix ERP solved their problems in 30 days.',
        'content'     => '<h2>The Challenge</h2><p>Ravi Jewellers, a well-established showroom in Dadar, Mumbai, was dealing with daily headaches — wrong stock counts, duplicate billing, and a nightmare during GST filing month.</p><h2>The Solution</h2><p>After implementing GoldMatrix ERP, they achieved:</p><ul><li>Real-time inventory across all 3 branches</li><li>Automated GST invoicing with e-invoice generation</li><li>Karigar job tracking with zero manual errors</li><li>Daily closing reports in under 2 minutes</li></ul><h2>Results After 30 Days</h2><p>Stock accuracy improved to 99.8%. GST filing time reduced from 4 hours to 20 minutes. Staff productivity improved by 40%.</p>',
        'category_id' => 1,
        'author_name' => 'GoldMatrix Team',
        'status'      => 'published',
        'meta_title'  => 'How GoldMatrix ERP Helped a Mumbai Jewellery Showroom | Case Study',
        'meta_description' => 'Read how GoldMatrix ERP transformed a 3-branch Mumbai jewellery showroom with automated GST, real-time inventory, and karigar management.',
    ],
    [
        'title'       => 'Complete Guide to GST for Jewellers in India (2025)',
        'slug'        => 'complete-guide-gst-jewellers-india-2025',
        'excerpt'     => 'Everything jewellers need to know about GST — rates on gold, making charges, HUID, e-invoice, and how to stay fully compliant with zero penalties.',
        'content'     => '<h2>GST Rates on Gold Jewellery</h2><p>As of 2025, gold jewellery attracts 3% GST on the value of gold, and 5% GST on making charges. It is critical to separate these in your invoices.</p><h2>HUID and Hallmarking</h2><p>All gold jewellery above 2 grams must carry BIS hallmark with a unique HUID (Hallmark Unique ID). GoldMatrix ERP automatically records and prints HUID on every invoice.</p><h2>E-Invoice for Jewellers</h2><p>If your annual turnover exceeds Rs 5 crore, e-invoice is mandatory. GoldMatrix integrates with the GST portal to generate IRN and QR codes instantly.</p><h2>Filing Returns</h2><p>GSTR-1 must be filed by the 11th of every month. GoldMatrix generates ready-to-upload JSON files so your CA can file in minutes.</p>',
        'category_id' => 2,
        'author_name' => 'GoldMatrix Team',
        'status'      => 'published',
        'meta_title'  => 'Complete GST Guide for Jewellers India 2025 | GoldMatrix',
        'meta_description' => 'Complete guide on GST rates, HUID, e-invoice and GST return filing for jewellers in India. Stay compliant with GoldMatrix ERP.',
    ],
    [
        'title'       => '7 Signs Your Jewellery Shop Needs an ERP Software Right Now',
        'slug'        => '7-signs-jewellery-shop-needs-erp-software',
        'excerpt'     => 'Is your jewellery business still running on manual registers or basic billing software? Here are 7 clear signs that you need a dedicated Jewellery ERP.',
        'content'     => '<h2>1. Stock Discrepancies Every Month</h2><p>If your physical count never matches your software count, it means your inventory system cannot handle jewellery-specific units like grams, karats, and pieces simultaneously.</p><h2>2. GST Filing Takes Days</h2><p>If your accountant is manually matching invoices, this is a clear sign of missing automation.</p><h2>3. No Visibility Across Branches</h2><p>If you have to call each branch to know what stock they have, real-time multi-branch ERP is what you need.</p><h2>4. Karigar Records Are on Paper</h2><p>Paper-based karigar job cards cause disputes. ERP tracks every job with weight-in and weight-out.</p><h2>5. Customer Ledgers Are Manual</h2><p>Kitty schemes, outstanding payments, and custom orders managed on paper lead to errors and lost revenue.</h2><h2>6. No Sales Analytics</h2><p>If you cannot answer "which product sold best this month?", your business is operating blind.</p><h2>7. Old Software Does Not Support HUID</h2><p>Since HUID is mandatory for gold jewellery, any software not supporting it puts you at legal risk.</p>',
        'category_id' => 4,
        'author_name' => 'GoldMatrix Team',
        'status'      => 'published',
        'meta_title'  => '7 Signs Your Jewellery Shop Needs ERP Software | GoldMatrix',
        'meta_description' => 'Discover 7 clear signs that your jewellery business needs a dedicated ERP software. From stock errors to GST chaos — GoldMatrix solves them all.',
    ],
    [
        'title'       => 'RFID Jewellery Automation: The Future of Inventory Management',
        'slug'        => 'rfid-jewellery-automation-future-inventory',
        'excerpt'     => 'RFID technology is changing how jewellery showrooms track their stock. Learn how RFID-enabled ERP can reduce pilferage, speed up billing, and provide real-time inventory.',
        'content'     => '<h2>What is RFID in Jewellery?</h2><p>RFID (Radio Frequency Identification) tags are tiny chips attached to each jewellery piece. A scanner can read hundreds of items in seconds without line of sight.</p><h2>Benefits for Jewellery Showrooms</h2><ul><li>Full inventory count in minutes, not days</li><li>Anti-theft alerts at exit points</li><li>Instant item location on the showroom floor</li><li>Faster billing — scan the item, not type a code</li></ul><h2>GoldMatrix RFID Integration</h2><p>GoldMatrix ERP supports RFID scanners for automatic stock taking, customer-facing display of product details, and loss prevention alerts.</p>',
        'category_id' => 5,
        'author_name' => 'GoldMatrix Team',
        'status'      => 'published',
        'meta_title'  => 'RFID Jewellery Automation & Inventory Management | GoldMatrix ERP',
        'meta_description' => 'Learn how RFID technology combined with GoldMatrix ERP provides real-time jewellery inventory, anti-theft alerts, and faster billing.',
    ],
];

$insertPost = $pdo->prepare("INSERT OR IGNORE INTO blog_posts 
    (title, slug, excerpt, content, category_id, author_name, status, meta_title, meta_description, views, published_at, created_at, updated_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, datetime('now'), datetime('now'), datetime('now'))");
foreach ($posts as $p) {
    $insertPost->execute([
        $p['title'], $p['slug'], $p['excerpt'], $p['content'],
        $p['category_id'], $p['author_name'], $p['status'],
        $p['meta_title'], $p['meta_description'],
        rand(45, 480)
    ]);
}

echo "Posts seeded.\n";
echo "Done! Blog tables ready.\n";
