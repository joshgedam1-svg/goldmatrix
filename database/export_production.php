<?php
declare(strict_types=1);

$sqlitePath = __DIR__ . '/../storage/database.sqlite';
if (!file_exists($sqlitePath)) {
    die("SQLite database not found.\n");
}

$db = new PDO('sqlite:' . $sqlitePath);
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);

$out = "-- ========================================================\n";
$out .= "-- GoldMatrix ERP - Complete Production Database Export\n";
$out .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$out .= "-- ========================================================\n\n";
$out .= "SET FOREIGN_KEY_CHECKS=0;\n";
$out .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n";
$out .= "SET time_zone = '+00:00';\n\n";

foreach ($tables as $tbl) {
    $rows = $db->query("SELECT * FROM `$tbl`")->fetchAll(PDO::FETCH_ASSOC);
    $out .= "-- --------------------------------------------------------\n";
    $out .= "-- Table structure & data for `$tbl`\n";
    $out .= "-- --------------------------------------------------------\n";
    
    // We get columns
    if (!empty($rows)) {
        $first = $rows[0];
        $cols = array_keys($first);
        $colList = implode('`, `', $cols);
        
        $out .= "TRUNCATE TABLE `$tbl`;\n";
        foreach ($rows as $row) {
            $vals = [];
            foreach ($row as $val) {
                if ($val === null) {
                    $vals[] = 'NULL';
                } else {
                    $vals[] = "'" . addslashes((string)$val) . "'";
                }
            }
            $out .= "INSERT INTO `$tbl` (`$colList`) VALUES (" . implode(', ', $vals) . ");\n";
        }
        $out .= "\n";
    }
}

$out .= "SET FOREIGN_KEY_CHECKS=1;\n";

file_put_contents(__DIR__ . '/production_export.sql', $out);
echo "Exported " . count($tables) . " tables to database/production_export.sql successfully.\n";
