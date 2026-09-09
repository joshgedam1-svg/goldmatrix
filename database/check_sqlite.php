<?php
$db = new PDO('sqlite:' . __DIR__ . '/../storage/database.sqlite');
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
echo "TABLES IN SQLITE:\n";
print_r($tables);

foreach ($tables as $t) {
    if (in_array($t, ['homepage_sections', 'homepage_items', 'settings', 'media'])) {
        echo "\n--- RECORDS IN $t ---\n";
        $rows = $db->query("SELECT * FROM $t")->fetchAll(PDO::FETCH_ASSOC);
        print_r($rows);
    }
}
