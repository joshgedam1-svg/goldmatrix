<?php
$sqlite = new PDO('sqlite:' . __DIR__ . '/../storage/database.sqlite');
$mysql  = new PDO('mysql:host=localhost;dbname=jewelry_erp_cms;charset=utf8mb4', 'root', '');

echo "--- FULL DATA SYNC FROM SQLITE TO MYSQL ---\n";

// 1. Create navigation_menus table if not exists in MySQL
$mysql->exec("CREATE TABLE IF NOT EXISTS navigation_menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    menu_type VARCHAR(50) DEFAULT 'header',
    title VARCHAR(150) NOT NULL,
    url VARCHAR(255) NOT NULL,
    target VARCHAR(20) DEFAULT '_self',
    icon VARCHAR(80) DEFAULT '',
    parent_id INT DEFAULT 0,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// 2. Sync navigation_menus
$mysql->exec("TRUNCATE TABLE navigation_menus");
$navRows = $sqlite->query("SELECT * FROM navigation_menus")->fetchAll(PDO::FETCH_ASSOC);
$stNav = $mysql->prepare("INSERT INTO navigation_menus (id, menu_type, title, url, target, icon, parent_id, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
foreach ($navRows as $r) {
    $stNav->execute([
        $r['id'] ?? null,
        $r['menu_type'] ?? 'header',
        $r['title'] ?? '',
        $r['url'] ?? '',
        $r['target'] ?? '_self',
        $r['icon'] ?? '',
        $r['parent_id'] ?? 0,
        $r['sort_order'] ?? 0,
        $r['is_active'] ?? 1
    ]);
}
echo "Synced " . count($navRows) . " navigation_menus rows.\n";

// 3. Sync settings
$mysql->exec("TRUNCATE TABLE settings");
$setRows = $sqlite->query("SELECT * FROM settings")->fetchAll(PDO::FETCH_ASSOC);
$stSet = $mysql->prepare("INSERT INTO settings (id, group_name, setting_key, setting_value, label, type, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
foreach ($setRows as $r) {
    $stSet->execute([
        $r['id'] ?? null,
        $r['group_name'] ?? 'general',
        $r['setting_key'] ?? '',
        $r['setting_value'] ?? '',
        $r['label'] ?? '',
        $r['type'] ?? 'text',
        $r['created_at'] ?? date('Y-m-d H:i:s'),
        $r['updated_at'] ?? date('Y-m-d H:i:s')
    ]);
}
echo "Synced " . count($setRows) . " settings rows.\n";

// 4. Sync leads
$mysql->exec("TRUNCATE TABLE leads");
$leadRows = $sqlite->query("SELECT * FROM leads")->fetchAll(PDO::FETCH_ASSOC);
if (!empty($leadRows)) {
    $stLead = $mysql->prepare("INSERT INTO leads (id, name, email, phone, company, message, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($leadRows as $r) {
        $stLead->execute([
            $r['id'] ?? null,
            $r['name'] ?? '',
            $r['email'] ?? '',
            $r['phone'] ?? '',
            $r['company'] ?? '',
            $r['message'] ?? '',
            $r['status'] ?? 'new',
            $r['created_at'] ?? date('Y-m-d H:i:s')
        ]);
    }
}
echo "Synced " . count($leadRows) . " leads rows.\n";

// 5. Sync activity_logs
$mysql->exec("TRUNCATE TABLE activity_logs");
$logRows = $sqlite->query("SELECT * FROM activity_logs")->fetchAll(PDO::FETCH_ASSOC);
if (!empty($logRows)) {
    $stLog = $mysql->prepare("INSERT INTO activity_logs (id, user_id, action, description, ip_address, module, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($logRows as $r) {
        $stLog->execute([
            $r['id'] ?? null,
            $r['user_id'] ?? null,
            $r['action'] ?? '',
            $r['description'] ?? '',
            $r['ip_address'] ?? '',
            $r['module'] ?? 'general',
            $r['created_at'] ?? date('Y-m-d H:i:s')
        ]);
    }
}
echo "Synced " . count($logRows) . " activity_logs rows.\n";

// 6. Ensure homepage_sections and homepage_items are synced
$secRows = $sqlite->query("SELECT * FROM homepage_sections")->fetchAll(PDO::FETCH_ASSOC);
$stSec = $mysql->prepare("INSERT INTO homepage_sections (section_key, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
foreach ($secRows as $r) {
    $stSec->execute([$r['section_key'], $r['value']]);
}
echo "Synced " . count($secRows) . " homepage_sections rows.\n";

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
echo "Synced " . count($itemRows) . " homepage_items rows.\n";

echo "ALL DATA SYNC COMPLETED SUCCESSFULLY.\n";
