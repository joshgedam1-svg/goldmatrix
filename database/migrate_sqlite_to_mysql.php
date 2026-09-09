<?php
$sqlite = new PDO('sqlite:' . __DIR__ . '/../storage/database.sqlite');
$mysql = new PDO('mysql:host=localhost;dbname=jewelry_erp_cms;charset=utf8mb4', 'root', '');

echo "--- MIGRATING EVERYTHING FROM SQLITE TO MYSQL ---\n";

// 1. Migrate homepage_sections
$secRows = $sqlite->query("SELECT * FROM homepage_sections")->fetchAll(PDO::FETCH_ASSOC);
$stSec = $mysql->prepare("INSERT INTO homepage_sections (section_key, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
foreach ($secRows as $r) {
    $stSec->execute([$r['section_key'], $r['value']]);
}
echo "Migrated " . count($secRows) . " homepage_sections rows.\n";

// 2. Clear seeded homepage_items and migrate real SQLite items
$mysql->exec("TRUNCATE TABLE homepage_items");
$itemRows = $sqlite->query("SELECT * FROM homepage_items")->fetchAll(PDO::FETCH_ASSOC);

$stItem = $mysql->prepare("INSERT INTO homepage_items 
    (id, section, title, subtitle, description, icon, link, image, mobile_image, alt_text, badge, btn1_text, btn1_link, btn2_text, btn2_link, features, accent_color, extra, sort_order, is_active) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($itemRows as $r) {
    $stItem->execute([
        $r['id'] ?? null,
        $r['section'] ?? '',
        $r['title'] ?? '',
        $r['subtitle'] ?? '',
        $r['description'] ?? '',
        $r['icon'] ?? '',
        $r['link'] ?? '',
        $r['image'] ?? '',
        $r['mobile_image'] ?? '',
        $r['alt_text'] ?? '',
        $r['badge'] ?? '',
        $r['btn1_text'] ?? '',
        $r['btn1_link'] ?? '',
        $r['btn2_text'] ?? '',
        $r['btn2_link'] ?? '',
        $r['features'] ?? '',
        $r['accent_color'] ?? '#F59E0B',
        $r['extra'] ?? '',
        $r['sort_order'] ?? 0,
        $r['is_active'] ?? 1
    ]);
}
echo "Migrated " . count($itemRows) . " homepage_items rows.\n";
