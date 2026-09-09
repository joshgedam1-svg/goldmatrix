<?php
$sqlite = new PDO('sqlite:' . __DIR__ . '/../storage/database.sqlite');
$mysql  = new PDO('mysql:host=localhost;dbname=jewelry_erp_cms;charset=utf8mb4', 'root', '');

echo "--- SYNCING NAVIGATION MENUS WITH CORRECT SCHEMA ---\n";

// 1. Drop & Recreate navigation_menus table in MySQL
$mysql->exec("DROP TABLE IF EXISTS navigation_menus");
$mysql->exec("CREATE TABLE navigation_menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(50) DEFAULT 'header',
    title VARCHAR(150) NOT NULL,
    url VARCHAR(255) NOT NULL,
    target VARCHAR(20) DEFAULT '_self',
    icon VARCHAR(80) DEFAULT '',
    parent_id INT DEFAULT 0,
    badge VARCHAR(50) DEFAULT '',
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// 2. Sync navigation_menus
$navRows = $sqlite->query("SELECT * FROM navigation_menus")->fetchAll(PDO::FETCH_ASSOC);
$stNav = $mysql->prepare("INSERT INTO navigation_menus (id, location, title, url, target, icon, parent_id, badge, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
foreach ($navRows as $r) {
    $stNav->execute([
        $r['id'] ?? null,
        $r['location'] ?? $r['menu_type'] ?? 'header',
        $r['title'] ?? '',
        $r['url'] ?? '',
        $r['target'] ?? '_self',
        $r['icon'] ?? '',
        $r['parent_id'] ?? 0,
        $r['badge'] ?? '',
        $r['sort_order'] ?? 0,
        $r['is_active'] ?? 1
    ]);
}
echo "Successfully synced " . count($navRows) . " navigation_menus rows to MySQL.\n";
