<?php
namespace App\Controllers\Admin;

use App\Services\Database;
use PDO;

class PagesController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureSchema();
    }

    private function ensureSchema(): void {
        $pdo = $this->db->getPdo();
        $cols = $pdo->query("PRAGMA table_info(pages)")->fetchAll(PDO::FETCH_COLUMN, 1);
        if (!in_array('content', $cols)) {
            $pdo->exec("ALTER TABLE pages ADD COLUMN content TEXT NULL");
        }
        if (!in_array('meta_title', $cols)) {
            $pdo->exec("ALTER TABLE pages ADD COLUMN meta_title TEXT NULL");
        }
        if (!in_array('meta_description', $cols)) {
            $pdo->exec("ALTER TABLE pages ADD COLUMN meta_description TEXT NULL");
        }
        if (!in_array('subtitle', $cols)) {
            $pdo->exec("ALTER TABLE pages ADD COLUMN subtitle TEXT NULL");
        }
    }

    public function index(): void {
        $pdo = $this->db->getPdo();
        $stmt = $pdo->query("SELECT * FROM pages WHERE deleted_at IS NULL ORDER BY id ASC");
        $dbPages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Prepend Homepage for unified navigation
        $homePageItem = [
            'id' => 0,
            'title' => 'Home Page',
            'slug' => '/',
            'subtitle' => 'Main front-facing landing page with Hero Slider, 14 ERP Modules, Trust Bar, and Client Brands',
            'template' => 'Home Page Layout (Jewellery ERP)',
            'status' => 'published',
            'edit_url' => admin_url('homepage'),
            'live_url' => site_url('/'),
            'updated_at' => date('d M Y, h:i A'),
            'is_home' => true
        ];

        $featuresPageItem = [
            'id' => -1,
            'title' => 'Features Overview Page',
            'slug' => '/features',
            'subtitle' => 'Section-by-section CMS: Hero Banner, Category Filters, 10 Core Modules Grid, Hardware Ecosystem & Conversion CTA',
            'template' => 'Features Pillar Layout',
            'status' => 'published',
            'edit_url' => admin_url('features-settings'),
            'live_url' => site_url('features'),
            'updated_at' => date('d M Y, h:i A'),
            'is_home' => false,
            'is_features' => true
        ];

        $aboutPageItem = [
            'id' => -2,
            'title' => 'About Us Page',
            'slug' => '/about',
            'subtitle' => 'Section-by-section CMS: Hero, Story & Heritage, Key Stats, Core Values, 15-Yr Milestones, Global Hubs & CTA',
            'template' => 'Executive About Us Layout',
            'status' => 'published',
            'edit_url' => admin_url('about-settings'),
            'live_url' => site_url('about'),
            'updated_at' => date('d M Y, h:i A'),
            'is_home' => false
        ];

        $whyPageItem = [
            'id' => -3,
            'title' => 'Why Choose Us',
            'slug' => '/why-us',
            'subtitle' => 'Specialized Jewellery ERP vs Generic ERPs (SAP/Tally), 6 Core Architecture Pillars & Proven ROI Metrics',
            'template' => 'Pillar Comparison Layout',
            'status' => 'published',
            'edit_url' => site_url('why-us'),
            'live_url' => site_url('why-us'),
            'updated_at' => date('d M Y, h:i A'),
            'is_home' => false
        ];

        $contactPageItem = [
            'id' => -4,
            'title' => 'Contact Us Page',
            'slug' => '/contact',
            'subtitle' => 'Section-by-section CMS: UAE Headquarter, India Tech Hub, Demo Booking Form, Direct Hotline, Google Maps & FAQs',
            'template' => 'Executive Contact Layout',
            'status' => 'published',
            'edit_url' => admin_url('contact'),
            'live_url' => site_url('contact'),
            'updated_at' => date('d M Y, h:i A'),
            'is_home' => false,
            'is_contact' => true
        ];

        $termsPageItem = [
            'id' => -5,
            'title' => 'Terms & Conditions',
            'slug' => '/terms',
            'subtitle' => 'Section-by-section CMS: Hero, Table of Clauses Sidebar, License, Cloud Security, SLAs & Policy Management',
            'template' => 'Legal Compliance Layout',
            'status' => 'published',
            'edit_url' => admin_url('legal-settings?tab=terms'),
            'live_url' => site_url('terms'),
            'updated_at' => date('d M Y, h:i A'),
            'is_home' => false
        ];

        $privacyPageItem = [
            'id' => -6,
            'title' => 'Privacy Policy & Security',
            'slug' => '/privacy',
            'subtitle' => 'Section-by-section CMS: Precious Metals Confidentiality, Cloud AES-256 Encryption, Data Retention & KYC',
            'template' => 'Data Privacy Layout',
            'status' => 'published',
            'edit_url' => admin_url('legal-settings?tab=privacy'),
            'live_url' => site_url('privacy'),
            'updated_at' => date('d M Y, h:i A'),
            'is_home' => false
        ];

        $pages = [$homePageItem, $featuresPageItem, $aboutPageItem, $whyPageItem, $contactPageItem, $termsPageItem, $privacyPageItem];
        $customSectionSlugs = ['contact', 'contact-us', 'features', 'features-overview', 'about', 'about-us', 'why-us', 'why-choose-us', 'why-choose-goldmatrix', 'terms', 'terms-and-conditions', 'terms-of-service', 'privacy', 'privacy-policy'];
        foreach ($dbPages as $p) {
            $cleanSlug = ltrim($p['slug'], '/');
            if (in_array($cleanSlug, $customSectionSlugs)) {
                continue; // Handled by dedicated Section CMS
            }
            $pages[] = [
                'id' => (int)$p['id'],
                'title' => $p['title'],
                'slug' => '/' . $cleanSlug,
                'subtitle' => $p['subtitle'] ?? '',
                'template' => ucfirst($p['template'] ?? 'default'),
                'status' => $p['status'] ?? 'published',
                'edit_url' => admin_url('pages/edit?id=' . $p['id']),
                'live_url' => site_url($cleanSlug),
                'updated_at' => !empty($p['updated_at']) ? date('d M Y, h:i A', strtotime($p['updated_at'])) : date('d M Y, h:i A'),
                'is_home' => false
            ];
        }

        admin_view('admin.pages.index', [
            'pages' => $pages,
            'title' => 'Manage Website Pages'
        ]);
    }

    public function create(): void {
        admin_view('admin.pages.create', [
            'title' => 'Create New Website Page'
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $template = trim($_POST['template'] ?? 'default');
        $content = $_POST['content'] ?? '';
        $meta_title = trim($_POST['meta_title'] ?? '');
        $meta_description = trim($_POST['meta_description'] ?? '');
        $status = $_POST['status'] ?? 'published';

        if (empty($title)) {
            set_flash('danger', 'Page title is required.');
            redirect(admin_url('pages/create'));
            return;
        }

        if (empty($slug)) {
            $slug = slugify($title);
        } else {
            $slug = slugify($slug);
        }

        $pdo = $this->db->getPdo();
        $now = date('Y-m-d H:i:s');
        $stmt = $pdo->prepare("INSERT INTO pages (title, slug, subtitle, template, status, content, meta_title, meta_description, created_at, updated_at) VALUES (:title, :slug, :subtitle, :template, :status, :content, :meta_title, :meta_description, :now, :now)");
        $stmt->execute([
            'title' => $title,
            'slug' => $slug,
            'subtitle' => $subtitle,
            'template' => $template,
            'status' => $status,
            'content' => $content,
            'meta_title' => $meta_title ?: $title . ' | GoldMatrix ERP',
            'meta_description' => $meta_description ?: substr(strip_tags($content), 0, 160),
            'now' => $now
        ]);

        set_flash('success', "Page '{$title}' created successfully!");
        redirect(admin_url('pages'));
    }

    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            set_flash('danger', 'Invalid page ID.');
            redirect(admin_url('pages'));
            return;
        }

        $pdo = $this->db->getPdo();
        $stmt = $pdo->prepare("SELECT * FROM pages WHERE id = :id AND deleted_at IS NULL LIMIT 1");
        $stmt->execute(['id' => $id]);
        $page = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$page) {
            set_flash('danger', 'Page not found.');
            redirect(admin_url('pages'));
            return;
        }

        // Fetch section cards
        $feature_cards = $pdo->query("SELECT * FROM homepage_items WHERE section = 'page_features' ORDER BY sort_order ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);
        $hardware_cards = $pdo->query("SELECT * FROM homepage_items WHERE section = 'page_hardware' ORDER BY sort_order ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);

        admin_view('admin.pages.edit', [
            'page'           => $page,
            'feature_cards'  => $feature_cards,
            'hardware_cards' => $hardware_cards,
            'activeSubTab'   => $_GET['subtab'] ?? 'overview',
            'title'          => 'Edit Page: ' . $page['title']
        ]);
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            set_flash('danger', 'Invalid page ID.');
            redirect(admin_url('pages'));
            return;
        }

        $title = trim($_POST['title'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $template = trim($_POST['template'] ?? 'default');
        $content = $_POST['content'] ?? '';
        $meta_title = trim($_POST['meta_title'] ?? '');
        $meta_description = trim($_POST['meta_description'] ?? '');
        $status = $_POST['status'] ?? 'published';

        $pdo = $this->db->getPdo();

        // 1. Handle file uploads (Images)
        if (!empty($_FILES['feat_spotlight_img_file']['name']) && $_FILES['feat_spotlight_img_file']['error'] === UPLOAD_ERR_OK) {
            $imgPath = $this->handleFileUpload('feat_spotlight_img_file', 'features');
            if (!empty($imgPath)) {
                $this->saveSetting('feat_spotlight_img', $imgPath);
            }
        }
        if (!empty($_FILES['about_hero_img_file']['name']) && $_FILES['about_hero_img_file']['error'] === UPLOAD_ERR_OK) {
            $imgPath = $this->handleFileUpload('about_hero_img_file', 'about');
            if (!empty($imgPath)) {
                $this->saveSetting('about_hero_img', $imgPath);
            }
        }
        if (!empty($_FILES['about_story_img_file']['name']) && $_FILES['about_story_img_file']['error'] === UPLOAD_ERR_OK) {
            $imgPath = $this->handleFileUpload('about_story_img_file', 'about');
            if (!empty($imgPath)) {
                $this->saveSetting('about_story_img', $imgPath);
            }
        }

        // 2. Save all section-specific settings keys dynamically from POST
        $settingKeys = [
            // Features Page
            'feat_hero_label', 'feat_hero_title', 'feat_hero_desc', 'feat_hero_btn',
            'feat_spotlight_badge', 'feat_spotlight_title', 'feat_spotlight_desc',
            'feat_cta_title', 'feat_cta_desc', 'feat_cta_btn1',

            // About Us Page
            'about_hero_badge', 'about_hero_title', 'about_hero_desc', 'about_hero_tag',
            'about_story_h2', 'about_story_p1', 'about_story_p2',
            'about_stat_1_val', 'about_stat_1_lbl',
            'about_stat_2_val', 'about_stat_2_lbl',
            'about_stat_3_val', 'about_stat_3_lbl',
            'about_stat_4_val', 'about_stat_4_lbl',

            // Contact Us Page
            'contact_hero_badge', 'contact_hero_title', 'contact_hero_desc',
            'contact_uae_address', 'contact_uae_phone', 'contact_uae_email',
            'contact_india_address', 'contact_india_phone', 'contact_india_email'
        ];

        foreach ($settingKeys as $k) {
            if (isset($_POST[$k])) {
                $this->saveSetting($k, trim($_POST[$k]));
            }
        }

        // 3. Update main page record
        if (empty($title)) {
            $tStmt = $pdo->prepare("SELECT title FROM pages WHERE id = ?");
            $tStmt->execute([(int)$id]);
            $currentTitle = $tStmt->fetchColumn();
            $title = $currentTitle ?: 'Page ' . (int)$id;
        }

        if (empty($slug)) {
            $slug = slugify($title);
        } else {
            $slug = slugify($slug);
        }

        $now = date('Y-m-d H:i:s');
        $stmt = $pdo->prepare("UPDATE pages SET title = :title, slug = :slug, subtitle = :subtitle, template = :template, content = :content, meta_title = :meta_title, meta_description = :meta_description, status = :status, updated_at = :now WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'title' => $title,
            'slug' => $slug,
            'subtitle' => $subtitle,
            'template' => $template,
            'content' => $content,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'status' => $status,
            'now' => $now
        ]);

        set_flash('success', "Page '{$title}' content and settings saved & synced successfully!");
        redirect(admin_url('pages/edit?id=' . $id));
    }

    /**
     * Add or Update Card Item (e.g. Feature Card, Hardware Card)
     */
    public function saveItem(): void {
        $pageId    = (int)($_POST['page_id'] ?? 1);
        $itemId    = (int)($_POST['item_id'] ?? 0);
        $section   = trim($_POST['section'] ?? 'page_features');
        $title     = trim($_POST['title'] ?? '');
        $category  = trim($_POST['category'] ?? ($_POST['subtitle'] ?? 'Retail POS'));
        $badge     = trim($_POST['badge'] ?? 'CAPABILITY');
        $icon      = trim($_POST['icon'] ?? 'bi-stars');
        $desc      = trim($_POST['description'] ?? '');
        $sortOrder = (int)($_POST['sort_order'] ?? 0);
        $isActive  = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 1;

        // Parse highlights / bullet points from newline textarea
        $rawHighlights = trim($_POST['highlights'] ?? '');
        $highlightsArr = array_values(array_filter(array_map('trim', explode("\n", $rawHighlights))));
        $featuresJson = json_encode($highlightsArr, JSON_UNESCAPED_UNICODE);

        if (empty($title)) {
            set_flash('danger', 'Card Title is required.');
            redirect(admin_url('pages/edit?id=' . $pageId . '&subtab=cards'));
            return;
        }

        $pdo = $this->db->getPdo();

        // Optional card image upload
        $imagePath = '';
        if (!empty($_FILES['card_image']['name']) && $_FILES['card_image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->handleFileUpload('card_image', 'features');
        }

        if ($itemId > 0) {
            // Update existing card
            if (!empty($imagePath)) {
                $stmt = $pdo->prepare("UPDATE homepage_items SET title = :title, subtitle = :subtitle, badge = :badge, icon = :icon, description = :desc, features = :feats, image = :img, sort_order = :sort, is_active = :act WHERE id = :id");
                $stmt->execute([
                    'id'       => $itemId,
                    'title'    => $title,
                    'subtitle' => $category,
                    'badge'    => $badge,
                    'icon'     => $icon,
                    'desc'     => $desc,
                    'feats'    => $featuresJson,
                    'img'      => $imagePath,
                    'sort'     => $sortOrder,
                    'act'      => $isActive
                ]);
            } else {
                $stmt = $pdo->prepare("UPDATE homepage_items SET title = :title, subtitle = :subtitle, badge = :badge, icon = :icon, description = :desc, features = :feats, sort_order = :sort, is_active = :act WHERE id = :id");
                $stmt->execute([
                    'id'       => $itemId,
                    'title'    => $title,
                    'subtitle' => $category,
                    'badge'    => $badge,
                    'icon'     => $icon,
                    'desc'     => $desc,
                    'feats'    => $featuresJson,
                    'sort'     => $sortOrder,
                    'act'      => $isActive
                ]);
            }
            set_flash('success', "Card '{$title}' updated successfully!");
        } else {
            // Insert new card
            $now = date('Y-m-d H:i:s');
            $stmt = $pdo->prepare("INSERT INTO homepage_items (section, title, subtitle, badge, icon, description, features, image, sort_order, is_active, created_at) VALUES (:sec, :title, :subtitle, :badge, :icon, :desc, :feats, :img, :sort, :act, :now)");
            $stmt->execute([
                'sec'      => $section,
                'title'    => $title,
                'subtitle' => $category,
                'badge'    => $badge,
                'icon'     => $icon,
                'desc'     => $desc,
                'feats'    => $featuresJson,
                'img'      => $imagePath,
                'sort'     => $sortOrder,
                'act'      => $isActive,
                'now'      => $now
            ]);
            set_flash('success', "New card '{$title}' created successfully!");
        }

        redirect(admin_url('pages/edit?id=' . $pageId . '&subtab=cards'));
    }

    /**
     * Delete Card Item
     */
    public function deleteItem(): void {
        $pageId = (int)($_POST['page_id'] ?? 1);
        $itemId = (int)($_POST['item_id'] ?? 0);

        if ($itemId > 0) {
            $pdo = $this->db->getPdo();
            $stmt = $pdo->prepare("DELETE FROM homepage_items WHERE id = :id");
            $stmt->execute(['id' => $itemId]);
            set_flash('success', 'Card deleted successfully!');
        }

        redirect(admin_url('pages/edit?id=' . $pageId . '&subtab=cards'));
    }

    private function saveSetting(string $key, string $val): void {
        $pdo = $this->db->getPdo();
        $exists = $pdo->prepare("SELECT 1 FROM settings WHERE setting_key = :k LIMIT 1");
        $exists->execute(['k' => $key]);
        $now = date('Y-m-d H:i:s');
        if ($exists->fetchColumn()) {
            $update = $pdo->prepare("UPDATE settings SET setting_value = :v, updated_at = :now WHERE setting_key = :k");
            $update->execute(['v' => $val, 'k' => $key, 'now' => $now]);
        } else {
            $insert = $pdo->prepare("INSERT INTO settings (group_name, setting_key, setting_value, label, type, created_at, updated_at) VALUES ('page_content', :k, :v, :k, 'text', :now, :now)");
            $insert->execute(['k' => $key, 'v' => $val, 'now' => $now]);
        }
    }

    private function handleFileUpload(string $field, string $subfolder): string {
        return secure_upload_image($field, $subfolder, ['png', 'jpg', 'jpeg', 'svg', 'webp', 'avif']) ?? '';
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $pdo = $this->db->getPdo();
            $now = date('Y-m-d H:i:s');
            $stmt = $pdo->prepare("UPDATE pages SET deleted_at = :now WHERE id = :id");
            $stmt->execute(['id' => $id, 'now' => $now]);
            set_flash('success', 'Page deleted successfully.');
        }
        redirect(admin_url('pages'));
    }
}
