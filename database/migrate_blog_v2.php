<?php
/**
 * Blog v2 Migration Script
 * Adds RankMath / WordPress style fields to blog_posts
 */

$dbPath = __DIR__ . '/../storage/database.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check existing columns in blog_posts
$cols = $pdo->query("PRAGMA table_info(blog_posts)")->fetchAll(PDO::FETCH_COLUMN, 1);

$newColumns = [
    'focus_keyword'  => "TEXT DEFAULT ''",
    'alt_text'       => "TEXT DEFAULT ''",
    'canonical_url'  => "TEXT DEFAULT ''",
    'robots'         => "TEXT DEFAULT 'index,follow'",
    'og_title'       => "TEXT DEFAULT ''",
    'og_description' => "TEXT DEFAULT ''",
    'og_image'       => "TEXT DEFAULT ''",
    'schema_type'    => "TEXT DEFAULT 'BlogPosting'",
    'tags'           => "TEXT DEFAULT ''",
    'reading_time'   => "INTEGER DEFAULT 0"
];

foreach ($newColumns as $col => $definition) {
    if (!in_array($col, $cols)) {
        $pdo->exec("ALTER TABLE blog_posts ADD COLUMN {$col} {$definition}");
        echo "Added column: {$col}\n";
    } else {
        echo "Column {$col} already exists.\n";
    }
}

// Create blog_tags table for autocomplete / management if needed
$pdo->exec("CREATE TABLE IF NOT EXISTS blog_tags (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    name       TEXT NOT NULL UNIQUE,
    slug       TEXT NOT NULL UNIQUE,
    created_at TEXT DEFAULT (datetime('now'))
)");

echo "Migration blog v2 completed successfully.\n";
