<?php
namespace App\Services;

use PDO;
use PDOException;
use Exception;

class Database {
    private static ?Database $instance = null;
    private PDO $pdo;
    private string $driver = 'mysql';

    private function __construct() {
        $connection = $_ENV['DB_CONNECTION'] ?? 'sqlite';
        $storageDir = dirname(__DIR__, 2) . '/storage';
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0777, true);
        }
        $sqlitePath = $storageDir . '/database.sqlite';

        if ($connection === 'sqlite') {
            $this->pdo = new PDO("sqlite:" . $sqlitePath, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $this->driver = 'sqlite';
            $this->ensureSqliteInitialized();
            return;
        }

        $config = require __DIR__ . '/../../config/database.php';
        $dsn = sprintf(
            "mysql:host=%s;port=%s;dbname=%s;charset=%s",
            $config['host'],
            $config['port'],
            $config['database'],
            $config['charset']
        );

        try {
            $options = $config['options'] ?? [];
            $options[PDO::ATTR_TIMEOUT] = 1;
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], $options);
            $this->driver = 'mysql';
        } catch (PDOException $e) {
            $this->pdo = new PDO("sqlite:" . $sqlitePath, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $this->driver = 'sqlite';
            $this->ensureSqliteInitialized();
        }
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }

    public function getDriver(): string {
        return $this->driver;
    }

    public function lastInsertId(?string $name = null): string {
        return $this->pdo->lastInsertId($name);
    }

    /**
     * Automatically initialize SQLite schema & initial seed user if MySQL is off
     */
    private function ensureSqliteInitialized(): void {
        $sql = "
        CREATE TABLE IF NOT EXISTS roles (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          name TEXT NOT NULL UNIQUE,
          slug TEXT NOT NULL UNIQUE,
          description TEXT NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS permissions (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          module TEXT NOT NULL,
          action TEXT NOT NULL,
          slug TEXT NOT NULL UNIQUE,
          description TEXT NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS role_permissions (
          role_id INTEGER NOT NULL,
          permission_id INTEGER NOT NULL,
          PRIMARY KEY (role_id, permission_id)
        );

        CREATE TABLE IF NOT EXISTS users (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          name TEXT NOT NULL,
          email TEXT NOT NULL UNIQUE,
          password TEXT NOT NULL,
          role_id INTEGER NOT NULL,
          status TEXT NOT NULL DEFAULT 'active',
          remember_token TEXT NULL,
          last_login DATETIME NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS pages (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          title TEXT NOT NULL,
          slug TEXT NOT NULL UNIQUE,
          template TEXT NOT NULL DEFAULT 'default',
          status TEXT NOT NULL DEFAULT 'draft',
          featured_image_id INTEGER NULL,
          excerpt TEXT NULL,
          created_by INTEGER NULL,
          updated_by INTEGER NULL,
          published_at DATETIME NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          deleted_at DATETIME NULL
        );

        CREATE TABLE IF NOT EXISTS erp_modules (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          name TEXT NOT NULL,
          slug TEXT NOT NULL UNIQUE,
          short_description TEXT NULL,
          full_description TEXT NULL,
          icon TEXT NULL,
          featured_image_id INTEGER NULL,
          benefits TEXT NULL,
          status TEXT NOT NULL DEFAULT 'published',
          display_order INTEGER NOT NULL DEFAULT 0,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS blog_posts (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          title TEXT NOT NULL,
          slug TEXT NOT NULL UNIQUE,
          excerpt TEXT NULL,
          content TEXT NOT NULL,
          featured_image_id INTEGER NULL,
          category_id INTEGER NULL,
          author_id INTEGER NULL,
          status TEXT NOT NULL DEFAULT 'draft',
          published_at DATETIME NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          deleted_at DATETIME NULL
        );

        CREATE TABLE IF NOT EXISTS media (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          filename TEXT NOT NULL,
          original_name TEXT NOT NULL,
          mime_type TEXT NOT NULL,
          file_size INTEGER NOT NULL,
          path TEXT NOT NULL,
          width INTEGER NULL,
          height INTEGER NULL,
          alt_text TEXT NULL,
          title TEXT NULL,
          caption TEXT NULL,
          uploaded_by INTEGER NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS seo_metadata (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          entity_type TEXT NOT NULL,
          entity_id INTEGER NOT NULL,
          seo_title TEXT NULL,
          meta_description TEXT NULL,
          canonical_url TEXT NULL,
          robots_index TEXT NOT NULL DEFAULT 'index',
          robots_follow TEXT NOT NULL DEFAULT 'follow',
          og_title TEXT NULL,
          og_description TEXT NULL,
          og_image_id INTEGER NULL,
          twitter_title TEXT NULL,
          twitter_description TEXT NULL,
          twitter_image_id INTEGER NULL,
          schema_type TEXT NOT NULL DEFAULT 'WebPage',
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS leads (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          name TEXT NOT NULL,
          company TEXT NULL,
          email TEXT NOT NULL,
          phone TEXT NULL,
          country TEXT NULL,
          message TEXT NULL,
          source TEXT NOT NULL DEFAULT 'Contact Form',
          page_url TEXT NULL,
          utm_source TEXT NULL,
          utm_medium TEXT NULL,
          utm_campaign TEXT NULL,
          status TEXT NOT NULL DEFAULT 'new',
          notes TEXT NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS demo_requests (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          name TEXT NOT NULL,
          company TEXT NOT NULL,
          email TEXT NOT NULL,
          phone TEXT NOT NULL,
          country TEXT NULL,
          business_type TEXT NULL,
          number_of_branches TEXT NULL,
          current_software TEXT NULL,
          requirements TEXT NULL,
          preferred_date DATE NULL,
          preferred_time TEXT NULL,
          source TEXT NOT NULL DEFAULT 'Demo Form',
          status TEXT NOT NULL DEFAULT 'new',
          notes TEXT NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS settings (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          group_name TEXT NOT NULL DEFAULT 'general',
          setting_key TEXT NOT NULL UNIQUE,
          setting_value TEXT NULL,
          label TEXT NOT NULL,
          type TEXT NOT NULL DEFAULT 'text',
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS activity_logs (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          user_id INTEGER NULL,
          action TEXT NOT NULL,
          module TEXT NOT NULL,
          record_id INTEGER NULL,
          description TEXT NULL,
          ip_address TEXT NULL,
          user_agent TEXT NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        INSERT OR IGNORE INTO roles (id, name, slug, description) VALUES (1, 'Super Admin', 'super-admin', 'Full access to system');
        INSERT OR IGNORE INTO users (id, name, email, password, role_id, status) VALUES (1, 'Super Administrator', 'admin@example.com', '\$2y\$10\$VG6L2GFrnx.lyBwPvwML6OZmgbWD/KnOWiR/DFc13Bmus3jlXgqFi', 1, 'active');
        ";

        $this->pdo->exec($sql);
    }

    /**
     * Execute a prepared query and return PDOStatement
     */
    public function query(string $sql, array $params = []): \PDOStatement {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Fetch all matching rows
     */
    public function fetchAll(string $sql, array $params = []): array {
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Fetch single matching row
     */
    public function fetch(string $sql, array $params = []): ?array {
        $result = $this->query($sql, $params)->fetch();
        return $result !== false ? $result : null;
    }

    /**
     * Fetch single column value
     */
    public function fetchColumn(string $sql, array $params = [], int $column = 0) {
        return $this->query($sql, $params)->fetchColumn($column);
    }

    /**
     * Insert row and return last inserted ID
     */
    public function insert(string $table, array $data): int {
        $fields = array_keys($data);
        $placeholders = array_map(fn($f) => ":$f", $fields);

        $sql = sprintf(
            "INSERT INTO `%s` (`%s`) VALUES (%s)",
            $table,
            implode('`, `', $fields),
            implode(', ', $placeholders)
        );

        $this->query($sql, $data);
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Update rows matching condition
     */
    public function update(string $table, array $data, string $where, array $whereParams = []): int {
        $setClauses = [];
        foreach (array_keys($data) as $field) {
            $setClauses[] = "`$field` = :set_$field";
        }

        $params = [];
        foreach ($data as $k => $v) {
            $params["set_$k"] = $v;
        }
        $params = array_merge($params, $whereParams);

        $sql = sprintf(
            "UPDATE `%s` SET %s WHERE %s",
            $table,
            implode(', ', $setClauses),
            $where
        );

        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    /**
     * Delete rows
     */
    public function delete(string $table, string $where, array $params = []): int {
        $sql = sprintf("DELETE FROM `%s` WHERE %s", $table, $where);
        return $this->query($sql, $params)->rowCount();
    }

    /**
     * Begin transaction
     */
    public function beginTransaction(): bool {
        return $this->pdo->beginTransaction();
    }

    public function commit(): bool {
        return $this->pdo->commit();
    }

    public function rollBack(): bool {
        return $this->pdo->rollBack();
    }
}
