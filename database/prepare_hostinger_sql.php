<?php
declare(strict_types=1);

$sqlite = new PDO('sqlite:' . __DIR__ . '/../storage/database.sqlite');
$tables = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);

$schemaFile = file_get_contents(__DIR__ . '/jewelry_erp.sql');
// Remove CREATE DATABASE and USE statements
$schemaClean = preg_replace('/CREATE DATABASE[^;]+;/i', '', $schemaFile);
$schemaClean = preg_replace('/USE `?[^`]+`?;/i', '', $schemaClean);

$export = "-- ========================================================\n";
$export .= "-- GoldMatrix Hostinger Production Database SQL Import\n";
$export .= "-- Database: Hostinger MySQL\n";
$export .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$export .= "-- ========================================================\n\n";
$export .= "SET FOREIGN_KEY_CHECKS=0;\n";
$export .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n\n";
$export .= $schemaClean . "\n\n";

foreach ($tables as $tbl) {
    $rows = $sqlite->query("SELECT * FROM `$tbl`")->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
        $first = $rows[0];
        $cols = array_keys($first);
        $colList = implode('`, `', $cols);

        $export .= "-- --------------------------------------------------------\n";
        $export .= "-- Data for `$tbl`\n";
        $export .= "-- --------------------------------------------------------\n";
        foreach ($rows as $r) {
            $vals = [];
            foreach ($r as $val) {
                if ($val === null) {
                    $vals[] = 'NULL';
                } else {
                    $vals[] = "'" . addslashes((string)$val) . "'";
                }
            }
            $export .= "INSERT IGNORE INTO `$tbl` (`$colList`) VALUES (" . implode(', ', $vals) . ");\n";
        }
        $export .= "\n";
    }
}

$export .= "SET FOREIGN_KEY_CHECKS=1;\n";

file_put_contents(__DIR__ . '/hostinger_database_ready.sql', $export);
echo "Generated database/hostinger_database_ready.sql successfully (" . strlen($export) . " bytes)\n";
