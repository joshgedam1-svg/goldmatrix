<?php
$sqlite = new PDO('sqlite:' . __DIR__ . '/../storage/database.sqlite');
$mysql = new PDO('mysql:host=localhost;dbname=jewelry_erp_cms;charset=utf8mb4', 'root', '');

$sqlTables = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);

echo "=== SQLITE TABLES vs MYSQL TABLES COMPARISON ===\n";
foreach ($sqlTables as $t) {
    if (in_array($t, ['sqlite_sequence'])) continue;
    
    $sqCount = (int)$sqlite->query("SELECT COUNT(*) FROM \"$t\"")->fetchColumn();
    
    try {
        $myCount = (int)$mysql->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
        echo sprintf("%-25s | SQLite: %-5d | MySQL: %-5d\n", $t, $sqCount, $myCount);
    } catch (Exception $e) {
        echo sprintf("%-25s | SQLite: %-5d | MySQL: TABLE MISSING IN MYSQL!\n", $t, $sqCount);
    }
}
