<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use PDO;

class BlogController {
    private Database $db;
    private \PDO $pdo;

    public function __construct() {
        $this->db  = Database::getInstance();
        $this->pdo = $this->db->getPdo();
        $this->ensureSchema();
    }

    /* ─────────────────────────────────────────────
     *  SCHEMA GUARD
     * ───────────────────────────────────────────── */
    private function ensureSchema(): void {
        if (\App\Services\Database::getInstance()->getDriver() !== 'sqlite') {
            return;
        }
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS blog_categories (
            id          INTEGER PRIMARY KEY AUTOINCREMENT,
            name        TEXT NOT NULL,
            slug        TEXT NOT NULL UNIQUE,
            description TEXT,
            color       TEXT DEFAULT '#F59E0B',
            created_at  TEXT DEFAULT (datetime('now')),
            updated_at  TEXT DEFAULT (datetime('now'))
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS blog_posts (
            id               INTEGER PRIMARY KEY AUTOINCREMENT,
            title            TEXT NOT NULL,
            slug             TEXT NOT NULL UNIQUE,
            excerpt          TEXT,
            content          TEXT,
            featured_image   TEXT DEFAULT '',
            alt_text         TEXT DEFAULT '',
            category_id      INTEGER DEFAULT 1,
            tags             TEXT DEFAULT '',
            author_name      TEXT DEFAULT 'GoldMatrix Team',
            status           TEXT DEFAULT 'published',
            focus_keyword    TEXT DEFAULT '',
            meta_title       TEXT,
            meta_description TEXT,
            canonical_url    TEXT DEFAULT '',
            robots           TEXT DEFAULT 'index,follow',
            og_title         TEXT DEFAULT '',
            og_description   TEXT DEFAULT '',
            og_image         TEXT DEFAULT '',
            schema_type      TEXT DEFAULT 'BlogPosting',
            reading_time     INTEGER DEFAULT 0,
            views            INTEGER DEFAULT 0,
            published_at     TEXT DEFAULT (datetime('now')),
            created_at       TEXT DEFAULT (datetime('now')),
            updated_at       TEXT DEFAULT (datetime('now'))
        )");
    }

    /* ─────────────────────────────────────────────
     *  AJAX Image Upload for Rich Text Editor
     * ───────────────────────────────────────────── */
    public function uploadEditorImage(): void {
        header('Content-Type: application/json');
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $url = $this->uploadImage('image', 'blog');
            if ($url) {
                echo json_encode(['success' => true, 'url' => site_url($url)]);
                exit;
            }
        }
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Upload failed']);
        exit;
    }

    /* ─────────────────────────────────────────────
     *  LIST ALL POSTS
     * ───────────────────────────────────────────── */
    public function index(): void {
        $search   = trim($_GET['search'] ?? '');
        $catFilter = (int)($_GET['category'] ?? 0);
        $status   = trim($_GET['status'] ?? '');

        $where  = ['1=1'];
        $params = [];

        if ($search !== '') {
            $where[]  = "(bp.title LIKE :s OR bp.excerpt LIKE :s2 OR bp.focus_keyword LIKE :s3)";
            $params[':s']  = "%{$search}%";
            $params[':s2'] = "%{$search}%";
            $params[':s3'] = "%{$search}%";
        }
        if ($catFilter > 0) {
            $where[]  = "bp.category_id = :cat";
            $params[':cat'] = $catFilter;
        }
        if (in_array($status, ['published', 'draft'])) {
            $where[]  = "bp.status = :status";
            $params[':status'] = $status;
        }

        $sql   = "SELECT bp.*, bc.name AS category_name, bc.color AS category_color
                  FROM blog_posts bp
                  LEFT JOIN blog_categories bc ON bc.id = bp.category_id
                  WHERE " . implode(' AND ', $where) . "
                  ORDER BY bp.published_at DESC";
        $stmt  = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = $this->pdo->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);

        admin_view('admin.blog.index', [
            'title'      => 'Blog Posts',
            'posts'      => $posts,
            'categories' => $categories,
            'search'     => $search,
            'catFilter'  => $catFilter,
            'status'     => $status,
        ]);
    }

    /* ─────────────────────────────────────────────
     *  CREATE FORM + STORE
     * ───────────────────────────────────────────── */
    public function create(): void {
        $categories = $this->pdo->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
        admin_view('admin.blog.form', [
            'title'      => 'Create New Blog Post',
            'post'       => null,
            'categories' => $categories,
        ]);
    }

    public function store(): void {
        $this->savePost(0);
    }

    /* ─────────────────────────────────────────────
     *  EDIT FORM + UPDATE
     * ───────────────────────────────────────────── */
    public function edit(): void {
        $id   = (int)($_GET['id'] ?? 0);
        $post = $this->findPost($id);
        if (!$post) {
            set_flash('danger', 'Post not found.');
            redirect(admin_url('blog'));
            return;
        }
        $categories = $this->pdo->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
        admin_view('admin.blog.form', [
            'title'      => 'Edit: ' . $post['title'],
            'post'       => $post,
            'categories' => $categories,
        ]);
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $this->savePost($id);
    }

    /* ─────────────────────────────────────────────
     *  DELETE
     * ───────────────────────────────────────────── */
    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->pdo->prepare("DELETE FROM blog_posts WHERE id = ?")->execute([$id]);
            set_flash('success', 'Post deleted.');
        }
        redirect(admin_url('blog'));
    }

    /* ─────────────────────────────────────────────
     *  CATEGORIES INDEX + SAVE + DELETE
     * ───────────────────────────────────────────── */
    public function categories(): void {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'save_category') {
                $catId = (int)($_POST['cat_id'] ?? 0);
                $name  = trim($_POST['name'] ?? '');
                $slug  = trim($_POST['slug'] ?? '');
                $desc  = trim($_POST['description'] ?? '');
                $color = trim($_POST['color'] ?? '#E11D48');
                if (empty($slug)) $slug = slugify($name);

                if (empty($name)) {
                    set_flash('danger', 'Category name is required.');
                } else {
                    if ($catId > 0) {
                        $now = date('Y-m-d H:i:s');
                        $this->pdo->prepare("UPDATE blog_categories SET name=?, slug=?, description=?, color=?, updated_at=? WHERE id=?")
                            ->execute([$name, $slug, $desc, $color, $now, $catId]);
                        set_flash('success', "Category '{$name}' updated successfully.");
                    } else {
                        // Ensure unique slug
                        $stmtCheck = $this->pdo->prepare("SELECT COUNT(*) FROM blog_categories WHERE slug=?");
                        $stmtCheck->execute([$slug]);
                        if ((int)$stmtCheck->fetchColumn() > 0) {
                            $slug = $slug . '-' . time();
                        }
                        $this->pdo->prepare("INSERT INTO blog_categories (name, slug, description, color) VALUES (?,?,?,?)")
                            ->execute([$name, $slug, $desc, $color]);
                        set_flash('success', "Category '{$name}' created successfully.");
                    }
                }
            }

            if ($action === 'delete_category') {
                $catId = (int)($_POST['cat_id'] ?? 0);
                if ($catId > 0) {
                    $postCheck = $this->pdo->prepare("SELECT COUNT(*) FROM blog_posts WHERE category_id=?");
                    $postCheck->execute([$catId]);
                    $cnt = (int)$postCheck->fetchColumn();
                    if ($cnt > 0) {
                        set_flash('danger', "Cannot delete category: {$cnt} post(s) are assigned to it.");
                    } else {
                        $this->pdo->prepare("DELETE FROM blog_categories WHERE id=?")->execute([$catId]);
                        set_flash('success', 'Category deleted successfully.');
                    }
                }
            }

            redirect(admin_url('categories'));
            return;
        }

        $search = trim($_GET['search'] ?? '');
        if ($search !== '') {
            $stmt = $this->pdo->prepare("SELECT bc.*, (SELECT COUNT(*) FROM blog_posts WHERE category_id = bc.id) AS post_count FROM blog_categories bc WHERE bc.name LIKE ? OR bc.slug LIKE ? ORDER BY bc.id ASC");
            $stmt->execute(["%{$search}%", "%{$search}%"]);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $categories = $this->pdo->query("SELECT bc.*, (SELECT COUNT(*) FROM blog_posts WHERE category_id = bc.id) AS post_count FROM blog_categories bc ORDER BY bc.id ASC")->fetchAll(PDO::FETCH_ASSOC);
        }

        admin_view('admin.blog.categories', [
            'title'      => 'All Blog Categories',
            'categories' => $categories,
            'search'     => $search,
        ]);
    }

    /* ─────────────────────────────────────────────
     *  SHARED SAVE LOGIC
     * ───────────────────────────────────────────── */
    private function savePost(int $id): void {
        $title         = trim($_POST['title'] ?? '');
        $slug          = trim($_POST['slug'] ?? '');
        $excerpt       = trim($_POST['excerpt'] ?? '');
        $content       = $_POST['content'] ?? '';
        $categoryId    = (int)($_POST['category_id'] ?? 1);
        $authorName    = trim($_POST['author_name'] ?? 'GoldMatrix Team');
        $status        = in_array($_POST['status'] ?? '', ['published', 'draft']) ? $_POST['status'] : 'published';
        $focusKeyword  = trim($_POST['focus_keyword'] ?? '');
        $altText       = trim($_POST['alt_text'] ?? '');
        $metaTitle     = trim($_POST['meta_title'] ?? '');
        $metaDesc      = trim($_POST['meta_description'] ?? '');
        $canonicalUrl  = trim($_POST['canonical_url'] ?? '');
        $robots        = trim($_POST['robots'] ?? 'index,follow');
        $ogTitle       = trim($_POST['og_title'] ?? '');
        $ogDesc        = trim($_POST['og_description'] ?? '');
        $ogImage       = trim($_POST['og_image'] ?? '');
        $schemaType    = trim($_POST['schema_type'] ?? 'BlogPosting');
        $tags          = trim($_POST['tags'] ?? '');
        $publishedAt   = !empty($_POST['published_at']) ? $_POST['published_at'] : date('Y-m-d H:i:s');

        // Reading time calculation (word count / 200)
        $cleanText   = strip_tags($content);
        $wordCount   = str_word_count($cleanText);
        $readingTime = max(1, (int)ceil($wordCount / 200));

        if (empty($title)) {
            set_flash('danger', 'Post title is required.');
            redirect($id > 0 ? admin_url('blog/edit?id=' . $id) : admin_url('blog/create'));
            return;
        }

        if (empty($slug)) $slug = slugify($title);
        else $slug = slugify($slug);

        // Handle featured image upload
        $featuredImage = trim($_POST['existing_image'] ?? '');
        if (!empty($_FILES['featured_image']['name']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $uploaded = $this->uploadImage('featured_image', 'blog');
            if ($uploaded) $featuredImage = $uploaded;
        }

        // Handle OG image upload if given
        if (!empty($_FILES['og_image_file']['name']) && $_FILES['og_image_file']['error'] === UPLOAD_ERR_OK) {
            $uploadedOg = $this->uploadImage('og_image_file', 'blog');
            if ($uploadedOg) $ogImage = $uploadedOg;
        }

        if ($id > 0) {
            $stmt = $this->pdo->prepare("UPDATE blog_posts SET 
                title=?, slug=?, excerpt=?, content=?, featured_image=?, alt_text=?,
                category_id=?, tags=?, author_name=?, status=?, focus_keyword=?,
                meta_title=?, meta_description=?, canonical_url=?, robots=?,
            $now = date('Y-m-d H:i:s');
            $stmt = $this->pdo->prepare("UPDATE blog_posts SET 
                title=?, slug=?, excerpt=?, content=?, featured_image=?, alt_text=?,
                category_id=?, tags=?, author_name=?, status=?, focus_keyword=?,
                meta_title=?, meta_description=?, canonical_url=?, robots=?,
                og_title=?, og_description=?, og_image=?, schema_type=?,
                reading_time=?, published_at=?, updated_at=? 
                WHERE id=?");
            $stmt->execute([
                $title, $slug, $excerpt, $content, $featuredImage, $altText,
                $categoryId, $tags, $authorName, $status, $focusKeyword,
                $metaTitle ?: $title, $metaDesc, $canonicalUrl, $robots,
                $ogTitle, $ogDesc, $ogImage, $schemaType,
                $readingTime, $publishedAt, $now, $id
            ]);
            set_flash('success', "Post '{$title}' updated successfully.");
            redirect(admin_url('blog/edit?id=' . $id));
        } else {
            $now = date('Y-m-d H:i:s');
            $stmt = $this->pdo->prepare("INSERT INTO blog_posts (
                title, slug, excerpt, content, featured_image, alt_text,
                category_id, tags, author_name, status, focus_keyword,
                meta_title, meta_description, canonical_url, robots,
                og_title, og_description, og_image, schema_type,
                reading_time, published_at, created_at, updated_at
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute([
                $title, $slug, $excerpt, $content, $featuredImage, $altText,
                $categoryId, $tags, $authorName, $status, $focusKeyword,
                $metaTitle ?: $title, $metaDesc, $canonicalUrl, $robots,
                $ogTitle, $ogDesc, $ogImage, $schemaType,
                $readingTime, $publishedAt, $now, $now
            ]);
            $newId = (int)$this->pdo->lastInsertId();
            set_flash('success', "Post '{$title}' created successfully.");
            redirect(admin_url('blog/edit?id=' . $newId));
        }
    }

    private function findPost(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT bp.*, bc.name AS category_name FROM blog_posts bp LEFT JOIN blog_categories bc ON bc.id = bp.category_id WHERE bp.id = ? LIMIT 1");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    private function uploadImage(string $field, string $subfolder): string {
        return secure_upload_image($field, $subfolder, ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif']) ?? '';
    }
}
