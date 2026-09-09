<?php
declare(strict_types=1);

$sqlite = new PDO('sqlite:' . __DIR__ . '/../storage/database.sqlite');
$tables = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);

$out = "-- ========================================================\n";
$out .= "-- GoldMatrix Complete Hostinger MySQL Schema & Seed Dump\n";
$out .= "-- Compatible with MySQL 5.7 / 8.0 / MariaDB\n";
$out .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$out .= "-- ========================================================\n\n";
$out .= "SET FOREIGN_KEY_CHECKS=0;\n";
$out .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n\n";

foreach ($tables as $tbl) {
    // Get column definitions from pragma
    $cols = $sqlite->query("PRAGMA table_info(`$tbl`)")->fetchAll(PDO::FETCH_ASSOC);
    
    $out .= "-- --------------------------------------------------------\n";
    $out .= "-- Table: `$tbl`\n";
    $out .= "-- --------------------------------------------------------\n";
    $out .= "DROP TABLE IF EXISTS `$tbl`;\n";
    $out .= "CREATE TABLE `$tbl` (\n";
    
    $colDefs = [];
    $pkCols = [];
    
    // Check how many pk columns
    foreach ($cols as $c) {
        if ($c['pk'] > 0) {
            $pkCols[] = $c['name'];
        }
    }
    
    foreach ($cols as $c) {
        $cName = $c['name'];
        $cType = strtoupper(trim($c['type']));
        $notNull = ($c['notnull'] == 1) ? ' NOT NULL' : '';
        $dflt = '';
        if ($c['dflt_value'] !== null) {
            $dVal = $c['dflt_value'];
            // Normalize datetime defaults
            if (stripos($dVal, 'CURRENT_TIMESTAMP') !== false || stripos($dVal, 'now') !== false) {
                $dflt = " DEFAULT CURRENT_TIMESTAMP";
            } elseif (is_numeric($dVal)) {
                $dflt = " DEFAULT $dVal";
            } else {
                $dflt = " DEFAULT " . $dVal;
            }
        }
        
        $isSinglePkId = (count($pkCols) === 1 && $cName === 'id' && $c['pk'] > 0);
        
        if ($isSinglePkId) {
            $mysqlType = "INT UNSIGNED NOT NULL AUTO_INCREMENT";
            $colDefs[] = "  `$cName` $mysqlType";
            continue;
        } elseif (strpos($cType, 'INT') !== false || in_array($cName, ['role_id', 'permission_id', 'user_id', 'category_id', 'parent_id', 'sort_order', 'is_active', 'views', 'hits', 'display_order', 'uploaded_by', 'og_image_id', 'twitter_image_id', 'featured_image_id', 'status_code'])) {
            $mysqlType = "INT";
        } elseif ($cType === 'DATETIME' || $cType === 'TIMESTAMP' || strpos($cName, '_at') !== false) {
            $mysqlType = "DATETIME";
        } elseif ($cType === 'DATE') {
            $mysqlType = "DATE";
        } elseif ($cType === 'DECIMAL' || $cType === 'FLOAT' || $cType === 'DOUBLE') {
            $mysqlType = "DECIMAL(12,4)";
        } elseif (in_array($cName, ['slug', 'setting_key', 'section_key', 'source_url', 'target_url', 'email', 'name', 'status', 'group_name', 'location', 'module', 'action'])) {
            $mysqlType = "VARCHAR(255)";
        } else {
            $mysqlType = "LONGTEXT";
        }
        
        $colDefs[] = "  `$cName` $mysqlType$notNull$dflt";
    }
    
    if (!empty($pkCols)) {
        $pkEscaped = array_map(function($p) { return "`$p`"; }, $pkCols);
        $colDefs[] = "  PRIMARY KEY (" . implode(', ', $pkEscaped) . ")";
    }
    
    $out .= implode(",\n", $colDefs) . "\n";
    $out .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";
    
    // Insert rows
    $rows = $sqlite->query("SELECT * FROM `$tbl`")->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
        $first = $rows[0];
        $colNames = array_keys($first);
        $colList = implode('`, `', $colNames);
        
        foreach ($rows as $r) {
            $vals = [];
            foreach ($r as $val) {
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

file_put_contents(__DIR__ . '/hostinger_database_ready.sql', $out);
echo "Successfully generated robust database/hostinger_database_ready.sql (" . strlen($out) . " bytes)\n";
