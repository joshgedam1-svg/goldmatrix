<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use PDO;

class ErpModulesController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureSchema();
        $this->seedDefaultsIfEmpty();
    }

    private function ensureSchema(): void {
        $pdo = $this->db->getPdo();
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS erp_modules (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                badge TEXT NULL,
                category TEXT NULL,
                icon TEXT NULL,
                h1 TEXT NULL,
                h2 TEXT NULL,
                headline TEXT NULL,
                subtitle TEXT NULL,
                intro TEXT NULL,
                description TEXT NULL,
                short_description TEXT NULL,
                full_description TEXT NULL,
                bullets TEXT NULL,
                target_persona TEXT NULL,
                persona_desc TEXT NULL,
                sub_features TEXT NULL,
                visual_title TEXT NULL,
                visual_desc TEXT NULL,
                visual_points TEXT NULL,
                visual_image TEXT NULL,
                faqs TEXT NULL,
                related TEXT NULL,
                meta_title TEXT NULL,
                meta_desc TEXT NULL,
                meta_keywords TEXT NULL,
                canonical_url TEXT NULL,
                status TEXT NOT NULL DEFAULT 'published',
                display_order INTEGER NOT NULL DEFAULT 0,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        // Ensure all columns exist
        $cols = $pdo->query("PRAGMA table_info(erp_modules)")->fetchAll(PDO::FETCH_COLUMN, 1);
        $neededCols = [
            'badge' => 'TEXT NULL',
            'category' => 'TEXT NULL',
            'icon' => 'TEXT NULL',
            'h1' => 'TEXT NULL',
            'h2' => 'TEXT NULL',
            'headline' => 'TEXT NULL',
            'subtitle' => 'TEXT NULL',
            'intro' => 'TEXT NULL',
            'description' => 'TEXT NULL',
            'bullets' => 'TEXT NULL',
            'target_persona' => 'TEXT NULL',
            'persona_desc' => 'TEXT NULL',
            'sub_features' => 'TEXT NULL',
            'visual_title' => 'TEXT NULL',
            'visual_desc' => 'TEXT NULL',
            'visual_points' => 'TEXT NULL',
            'visual_image' => 'TEXT NULL',
            'faqs' => 'TEXT NULL',
            'related' => 'TEXT NULL',
            'meta_title' => 'TEXT NULL',
            'meta_desc' => 'TEXT NULL',
            'meta_keywords' => 'TEXT NULL',
            'canonical_url' => 'TEXT NULL',
            'status' => "TEXT NOT NULL DEFAULT 'published'",
            'display_order' => 'INTEGER NOT NULL DEFAULT 0'
        ];

        foreach ($neededCols as $col => $def) {
            if (!in_array($col, $cols)) {
                $pdo->exec("ALTER TABLE erp_modules ADD COLUMN {$col} {$def}");
            }
        }
    }

    public function index(): void {
        $pdo = $this->db->getPdo();
        $modules = $pdo->query("SELECT * FROM erp_modules ORDER BY display_order ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);

        admin_view('admin.erp-modules.index', [
            'modules' => $modules,
            'title'   => 'ERP Feature Modules & SEO Pages'
        ]);
    }

    public function create(): void {
        admin_view('admin.erp-modules.form', [
            'module' => [
                'id'            => 0,
                'name'          => '',
                'slug'          => '',
                'badge'         => 'FEATURE MODULE',
                'category'      => 'Core Modules',
                'icon'          => 'bi-speedometer2',
                'h1'            => '',
                'h2'            => '',
                'intro'         => '',
                'description'   => '',
                'bullets'       => "[]",
                'target_persona'=> '',
                'persona_desc'  => '',
                'sub_features'  => "[]",
                'visual_title'  => '',
                'visual_desc'   => '',
                'visual_points' => "[]",
                'visual_image'  => '',
                'faqs'          => "[]",
                'meta_title'    => '',
                'meta_desc'     => '',
                'meta_keywords' => '',
                'canonical_url' => '',
                'status'        => 'published',
                'display_order' => 0
            ],
            'title'  => 'Create New Feature Module'
        ]);
    }

    public function store(): void {
        $pdo = $this->db->getPdo();
        $data = $this->extractFormData();

        if (empty($data['name'])) {
            set_flash('danger', 'Module Name is required.');
            redirect(admin_url('erp-modules/create'));
            return;
        }

        if (empty($data['slug'])) {
            $data['slug'] = slugify($data['name']);
        } else {
            $data['slug'] = slugify($data['slug']);
        }

        // Check duplicate slug
        $exists = $pdo->prepare("SELECT id FROM erp_modules WHERE slug = ?");
        $exists->execute([$data['slug']]);
        if ($exists->fetch()) {
            set_flash('danger', "A module with slug '{$data['slug']}' already exists.");
            redirect(admin_url('erp-modules/create'));
            return;
        }

        // Handle image upload if provided
        if (!empty($_FILES['visual_image_file']['name']) && $_FILES['visual_image_file']['error'] === UPLOAD_ERR_OK) {
            $uploaded = $this->handleFileUpload('visual_image_file');
            if ($uploaded) {
                $data['visual_image'] = $uploaded;
            }
        }

        $stmt = $pdo->prepare("
            INSERT INTO erp_modules (
                name, slug, badge, category, icon, h1, h2, headline, subtitle, intro, description,
                bullets, target_persona, persona_desc, sub_features, visual_title, visual_desc,
                visual_points, visual_image, faqs, related, meta_title, meta_desc, meta_keywords,
                canonical_url, status, display_order, created_at, updated_at
            ) VALUES (
                :name, :slug, :badge, :category, :icon, :h1, :h2, :headline, :subtitle, :intro, :description,
                :bullets, :target_persona, :persona_desc, :sub_features, :visual_title, :visual_desc,
                :visual_points, :visual_image, :faqs, :related, :meta_title, :meta_desc, :meta_keywords,
                :canonical_url, :status, :display_order, datetime('now'), datetime('now')
            )
        ");

        $stmt->execute([
            ':name'           => $data['name'],
            ':slug'           => $data['slug'],
            ':badge'          => $data['badge'],
            ':category'       => $data['category'],
            ':icon'           => $data['icon'],
            ':h1'             => $data['h1'],
            ':h2'             => $data['h2'],
            ':headline'       => $data['h1'],
            ':subtitle'       => $data['h2'],
            ':intro'          => $data['intro'],
            ':description'    => $data['description'],
            ':bullets'        => $data['bullets'],
            ':target_persona' => $data['target_persona'],
            ':persona_desc'   => $data['persona_desc'],
            ':sub_features'   => $data['sub_features'],
            ':visual_title'   => $data['visual_title'],
            ':visual_desc'    => $data['visual_desc'],
            ':visual_points'  => $data['visual_points'],
            ':visual_image'   => $data['visual_image'],
            ':faqs'           => $data['faqs'],
            ':related'        => $data['related'],
            ':meta_title'     => $data['meta_title'],
            ':meta_desc'      => $data['meta_desc'],
            ':meta_keywords'  => $data['meta_keywords'],
            ':canonical_url'  => $data['canonical_url'],
            ':status'         => $data['status'],
            ':display_order'  => (int)$data['display_order']
        ]);

        set_flash('success', "Feature Module '{$data['name']}' created successfully!");
        redirect(admin_url('erp-modules'));
    }

    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);
        $slug = trim($_GET['slug'] ?? '');

        $pdo = $this->db->getPdo();
        if ($id > 0) {
            $stmt = $pdo->prepare("SELECT * FROM erp_modules WHERE id = ?");
            $stmt->execute([$id]);
        } elseif (!empty($slug)) {
            $stmt = $pdo->prepare("SELECT * FROM erp_modules WHERE slug = ?");
            $stmt->execute([$slug]);
        } else {
            set_flash('danger', 'Invalid module ID or slug.');
            redirect(admin_url('erp-modules'));
            return;
        }

        $module = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$module) {
            set_flash('danger', 'Module not found.');
            redirect(admin_url('erp-modules'));
            return;
        }

        admin_view('admin.erp-modules.form', [
            'module' => $module,
            'title'  => 'Edit Module: ' . $module['name']
        ]);
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            set_flash('danger', 'Invalid module ID.');
            redirect(admin_url('erp-modules'));
            return;
        }

        $pdo = $this->db->getPdo();
        $data = $this->extractFormData();

        if (empty($data['name'])) {
            set_flash('danger', 'Module Name is required.');
            redirect(admin_url('erp-modules/edit?id=' . $id));
            return;
        }

        if (empty($data['slug'])) {
            $data['slug'] = slugify($data['name']);
        } else {
            $data['slug'] = slugify($data['slug']);
        }

        // Check duplicate slug with another ID
        $exists = $pdo->prepare("SELECT id FROM erp_modules WHERE slug = ? AND id != ?");
        $exists->execute([$data['slug'], $id]);
        if ($exists->fetch()) {
            set_flash('danger', "A module with slug '{$data['slug']}' already exists.");
            redirect(admin_url('erp-modules/edit?id=' . $id));
            return;
        }

        // Handle image upload if provided
        if (!empty($_FILES['visual_image_file']['name']) && $_FILES['visual_image_file']['error'] === UPLOAD_ERR_OK) {
            $uploaded = $this->handleFileUpload('visual_image_file');
            if ($uploaded) {
                $data['visual_image'] = $uploaded;
            }
        }

        $stmt = $pdo->prepare("
            UPDATE erp_modules SET
                name = :name,
                slug = :slug,
                badge = :badge,
                category = :category,
                icon = :icon,
                h1 = :h1,
                h2 = :h2,
                headline = :headline,
                subtitle = :subtitle,
                intro = :intro,
                description = :description,
                bullets = :bullets,
                target_persona = :target_persona,
                persona_desc = :persona_desc,
                sub_features = :sub_features,
                visual_title = :visual_title,
                visual_desc = :visual_desc,
                visual_points = :visual_points,
                visual_image = :visual_image,
                faqs = :faqs,
                related = :related,
                meta_title = :meta_title,
                meta_desc = :meta_desc,
                meta_keywords = :meta_keywords,
                canonical_url = :canonical_url,
                status = :status,
                display_order = :display_order,
                updated_at = datetime('now')
            WHERE id = :id
        ");

        $stmt->execute([
            ':id'             => $id,
            ':name'           => $data['name'],
            ':slug'           => $data['slug'],
            ':badge'          => $data['badge'],
            ':category'       => $data['category'],
            ':icon'           => $data['icon'],
            ':h1'             => $data['h1'],
            ':h2'             => $data['h2'],
            ':headline'       => $data['h1'],
            ':subtitle'       => $data['h2'],
            ':intro'          => $data['intro'],
            ':description'    => $data['description'],
            ':bullets'        => $data['bullets'],
            ':target_persona' => $data['target_persona'],
            ':persona_desc'   => $data['persona_desc'],
            ':sub_features'   => $data['sub_features'],
            ':visual_title'   => $data['visual_title'],
            ':visual_desc'    => $data['visual_desc'],
            ':visual_points'  => $data['visual_points'],
            ':visual_image'   => $data['visual_image'],
            ':faqs'           => $data['faqs'],
            ':related'        => $data['related'],
            ':meta_title'     => $data['meta_title'],
            ':meta_desc'      => $data['meta_desc'],
            ':meta_keywords'  => $data['meta_keywords'],
            ':canonical_url'  => $data['canonical_url'],
            ':status'         => $data['status'],
            ':display_order'  => (int)$data['display_order']
        ]);

        set_flash('success', "Module '{$data['name']}' & SEO page updated successfully!");
        redirect(admin_url('erp-modules/edit?id=' . $id));
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $pdo = $this->db->getPdo();
            $stmt = $pdo->prepare("DELETE FROM erp_modules WHERE id = ?");
            $stmt->execute([$id]);
            set_flash('success', 'Module deleted successfully.');
        }
        redirect(admin_url('erp-modules'));
    }

    private function extractFormData(): array {
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $badge = trim($_POST['badge'] ?? 'FEATURE MODULE');
        $category = trim($_POST['category'] ?? 'Core Modules');
        $icon = trim($_POST['icon'] ?? 'bi-speedometer2');
        $h1 = trim($_POST['h1'] ?? $name);
        $h2 = trim($_POST['h2'] ?? '');
        $intro = trim($_POST['intro'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $target_persona = trim($_POST['target_persona'] ?? '');
        $persona_desc = trim($_POST['persona_desc'] ?? '');
        $visual_title = trim($_POST['visual_title'] ?? '');
        $visual_desc = trim($_POST['visual_desc'] ?? '');
        $visual_image = trim($_POST['visual_image'] ?? '');
        $meta_title = trim($_POST['meta_title'] ?? ($h1 ?: $name) . ' | GoldMatrix ERP');
        $meta_desc = trim($_POST['meta_desc'] ?? substr($intro ?: $description, 0, 160));
        $meta_keywords = trim($_POST['meta_keywords'] ?? strtolower($name) . ', jewellery erp software, gold software india uae');
        $canonical_url = trim($_POST['canonical_url'] ?? '');
        $status = $_POST['status'] ?? 'published';
        $display_order = (int)($_POST['display_order'] ?? 0);

        // Process Bullets (from newline textarea or raw JSON)
        $bulletsInput = trim($_POST['bullets'] ?? '');
        if (!empty($_POST['bullets_raw'])) {
            $bulletsJson = $_POST['bullets_raw'];
        } else {
            $bulletLines = array_filter(array_map('trim', explode("\n", $bulletsInput)));
            $bulletsJson = json_encode(array_values($bulletLines), JSON_UNESCAPED_UNICODE);
        }

        // Process Visual Points
        $visPointsInput = trim($_POST['visual_points'] ?? '');
        if (!empty($_POST['visual_points_raw'])) {
            $visPointsJson = $_POST['visual_points_raw'];
        } else {
            $visLines = array_filter(array_map('trim', explode("\n", $visPointsInput)));
            $visPointsJson = json_encode(array_values($visLines), JSON_UNESCAPED_UNICODE);
        }

        // Process Sub Features
        $subFeaturesJson = "[]";
        if (isset($_POST['sub_features_json'])) {
            $subFeaturesJson = $_POST['sub_features_json'];
        } elseif (isset($_POST['sub_title']) && is_array($_POST['sub_title'])) {
            $subs = [];
            foreach ($_POST['sub_title'] as $i => $st) {
                if (empty(trim($st))) continue;
                $pText = $_POST['sub_points'][$i] ?? '';
                $pList = array_filter(array_map('trim', explode("\n", $pText)));
                $subs[] = [
                    'icon'   => $_POST['sub_icon'][$i] ?? 'bi-star',
                    'title'  => trim($st),
                    'desc'   => trim($_POST['sub_desc'][$i] ?? ''),
                    'points' => array_values($pList)
                ];
            }
            $subFeaturesJson = json_encode($subs, JSON_UNESCAPED_UNICODE);
        }

        // Process FAQs
        $faqsJson = "[]";
        if (isset($_POST['faqs_json'])) {
            $faqsJson = $_POST['faqs_json'];
        } elseif (isset($_POST['faq_q']) && is_array($_POST['faq_q'])) {
            $faqArr = [];
            foreach ($_POST['faq_q'] as $i => $q) {
                if (empty(trim($q))) continue;
                $faqArr[] = [
                    'q' => trim($q),
                    'a' => trim($_POST['faq_a'][$i] ?? '')
                ];
            }
            $faqsJson = json_encode($faqArr, JSON_UNESCAPED_UNICODE);
        }

        // Process Related Slugs
        $relatedInput = trim($_POST['related'] ?? '');
        $relatedList = array_filter(array_map('trim', explode(',', $relatedInput)));
        $relatedJson = json_encode(array_values($relatedList), JSON_UNESCAPED_UNICODE);

        return [
            'name'           => $name,
            'slug'           => $slug,
            'badge'          => $badge,
            'category'       => $category,
            'icon'           => $icon,
            'h1'             => $h1,
            'h2'             => $h2,
            'intro'          => $intro,
            'description'    => $description,
            'bullets'        => $bulletsJson,
            'target_persona' => $target_persona,
            'persona_desc'   => $persona_desc,
            'sub_features'   => $subFeaturesJson,
            'visual_title'   => $visual_title,
            'visual_desc'    => $visual_desc,
            'visual_points'  => $visPointsJson,
            'visual_image'   => $visual_image,
            'faqs'           => $faqsJson,
            'related'        => $relatedJson,
            'meta_title'     => $meta_title,
            'meta_desc'      => $meta_desc,
            'meta_keywords'  => $meta_keywords,
            'canonical_url'  => $canonical_url,
            'status'         => $status,
            'display_order'  => $display_order
        ];
    }

    private function handleFileUpload(string $field): ?string {
        return secure_upload_image($field, 'modules', ['jpg', 'jpeg', 'png', 'webp', 'svg', 'gif']);
    }

    public function seedDefaultsIfEmpty(): void {
        try {
            $pdo = $this->db->getPdo();
            $count = (int)$pdo->query("SELECT COUNT(*) FROM erp_modules")->fetchColumn();
            if ($count > 0) return;

            // Load all 10 default modules from FrontendController
            $frontendCtrl = new \App\Controllers\FrontendController();
            $defaults = $frontendCtrl->getModulesData();

            $order = 1;
            foreach ($defaults as $slug => $mod) {
                $bulletsJson = json_encode($mod['bullets'] ?? [], JSON_UNESCAPED_UNICODE);
                $subFeatsJson = json_encode($mod['sub_features'] ?? [], JSON_UNESCAPED_UNICODE);
                $visPointsJson = json_encode($mod['visual_points'] ?? [], JSON_UNESCAPED_UNICODE);
                $faqsJson = json_encode($mod['faqs'] ?? [], JSON_UNESCAPED_UNICODE);
                $relatedJson = json_encode($mod['related'] ?? [], JSON_UNESCAPED_UNICODE);

                $h1 = $mod['h1'] ?? $mod['headline'] ?? $mod['title'];
                $h2 = $mod['h2'] ?? $mod['subtitle'] ?? '';
                $intro = $mod['intro'] ?? $mod['description'] ?? '';

                $stmt = $pdo->prepare("
                    INSERT INTO erp_modules (
                        name, slug, badge, category, icon, h1, h2, headline, subtitle, intro, description,
                        bullets, target_persona, persona_desc, sub_features, visual_title, visual_desc,
                        visual_points, visual_image, faqs, related, meta_title, meta_desc, meta_keywords,
                        canonical_url, status, display_order, created_at, updated_at
                    ) VALUES (
                        :name, :slug, :badge, :category, :icon, :h1, :h2, :headline, :subtitle, :intro, :description,
                        :bullets, :target_persona, :persona_desc, :sub_features, :visual_title, :visual_desc,
                        :visual_points, :visual_image, :faqs, :related, :meta_title, :meta_desc, :meta_keywords,
                        :canonical_url, 'published', :display_order, datetime('now'), datetime('now')
                    )
                ");

                $stmt->execute([
                    ':name'           => $mod['title'] ?? ucfirst(str_replace('-', ' ', $slug)),
                    ':slug'           => $slug,
                    ':badge'          => $mod['badge'] ?? 'CORE MODULE',
                    ':category'       => $mod['category'] ?? 'Core Modules',
                    ':icon'           => $mod['icon'] ?? 'bi-speedometer2',
                    ':h1'             => $h1,
                    ':h2'             => $h2,
                    ':headline'       => $h1,
                    ':subtitle'       => $h2,
                    ':intro'          => $intro,
                    ':description'    => $mod['description'] ?? $intro,
                    ':bullets'        => $bulletsJson,
                    ':target_persona' => $mod['target_persona'] ?? '',
                    ':persona_desc'   => $mod['persona_desc'] ?? '',
                    ':sub_features'   => $subFeatsJson,
                    ':visual_title'   => $mod['visual_title'] ?? '',
                    ':visual_desc'    => $mod['visual_desc'] ?? '',
                    ':visual_points'  => $visPointsJson,
                    ':visual_image'   => $mod['visual_image'] ?? '',
                    ':faqs'           => $faqsJson,
                    ':related'        => $relatedJson,
                    ':meta_title'     => ($h1 ?: $mod['title']) . ' | GoldMatrix ERP',
                    ':meta_desc'      => substr($intro ?: $h2, 0, 160),
                    ':meta_keywords'  => strtolower($mod['title']) . ', jewellery erp software, gold software, jewelry business system',
                    ':canonical_url'  => '/features/' . $slug,
                    ':display_order'  => $order++
                ]);
            }
        } catch (\Throwable $e) {}
    }
}
