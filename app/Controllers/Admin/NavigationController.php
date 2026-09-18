<?php
namespace App\Controllers\Admin;

use App\Services\Database;

class NavigationController {

    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureSchema();
    }

    private function ensureSchema(): void {
        $this->db->query("CREATE TABLE IF NOT EXISTS navigation_menus (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            location TEXT NOT NULL DEFAULT 'header',
            title TEXT NOT NULL,
            url TEXT NOT NULL,
            target TEXT DEFAULT '_self',
            icon TEXT DEFAULT '',
            parent_id INTEGER DEFAULT 0,
            badge TEXT DEFAULT '',
            sort_order INTEGER DEFAULT 0,
            is_active INTEGER DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Seed default menu items if empty
        $count = (int)$this->db->fetchColumn("SELECT COUNT(*) FROM navigation_menus");
        if ($count === 0) {
            $this->seedDefaults();
        }
    }

    private function seedDefaults(): void {
        $items = [
            // ── HEADER MENU ──
            ['location' => 'header', 'title' => 'Home',        'url' => '/',             'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 1],
            ['location' => 'header', 'title' => 'Solutions',   'url' => '#solutions',    'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 2],
            ['location' => 'header', 'title' => 'Features',    'url' => '#modules',      'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 3],
            ['location' => 'header', 'title' => 'Industries',  'url' => '#industries',   'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 4],
            ['location' => 'header', 'title' => 'Resources',   'url' => '#testimonials', 'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 5],
            ['location' => 'header', 'title' => 'Company',     'url' => '#about',        'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 6],
            ['location' => 'header', 'title' => 'Contact',     'url' => '#contact',      'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 7],

            // ── FOOTER COL 1: PRODUCT ──
            ['location' => 'footer_col1', 'title' => 'ERP Modules',      'url' => '#modules',      'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 1],
            ['location' => 'footer_col1', 'title' => 'Solutions',        'url' => '#solutions',    'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 2],
            ['location' => 'footer_col1', 'title' => 'How It Works',     'url' => '#why',          'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 3],
            ['location' => 'footer_col1', 'title' => 'Customer Reviews', 'url' => '#testimonials', 'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 4],

            // ── FOOTER COL 2: COMPANY ──
            ['location' => 'footer_col2', 'title' => 'About Us',         'url' => '#about',        'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 1],
            ['location' => 'footer_col2', 'title' => 'Careers',          'url' => '#',             'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 2],
            ['location' => 'footer_col2', 'title' => 'Blog',             'url' => '#',             'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 3],
            ['location' => 'footer_col2', 'title' => 'Contact',          'url' => '#contact',      'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 4],

            // ── FOOTER COL 3: SUPPORT ──
            ['location' => 'footer_col3', 'title' => 'Documentation',    'url' => '#',             'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 1],
            ['location' => 'footer_col3', 'title' => 'Video Tutorials',  'url' => '#',             'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 2],
            ['location' => 'footer_col3', 'title' => 'WhatsApp Support', 'url' => '#contact',      'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 3],
            ['location' => 'footer_col3', 'title' => 'Partner Program',  'url' => '#',             'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 4],

            // ── FOOTER BOTTOM: LEGAL ──
            ['location' => 'footer_bottom', 'title' => 'Privacy Policy',   'url' => '#',           'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 1],
            ['location' => 'footer_bottom', 'title' => 'Terms of Service', 'url' => '#',           'target' => '_self', 'icon' => '', 'parent_id' => 0, 'badge' => '', 'sort_order' => 2],
        ];

        foreach ($items as $item) {
            $this->db->query(
                "INSERT INTO navigation_menus (location, title, url, target, icon, parent_id, badge, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)",
                [$item['location'], $item['title'], $item['url'], $item['target'], $item['icon'], $item['parent_id'], $item['badge'], $item['sort_order']]
            );
        }
    }

    public function index(): void {
        $location = $_GET['location'] ?? 'header';
        $validLocations = ['header', 'footer_col1', 'footer_col2', 'footer_col3', 'footer_bottom'];
        if (!in_array($location, $validLocations, true)) {
            $location = 'header';
        }

        // Handle POST actions
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
                set_flash('danger', '❌ Invalid CSRF session token. Please try again.');
                redirect('/admin/navigation?location=' . urlencode($location));
                return;
            }

            $action = $_POST['action'] ?? '';

            /* ── ADD CUSTOM MENU ITEM ── */
            if ($action === 'add_item') {
                $itemLocation = strip_tags(trim($_POST['location'] ?? $location));
                $title        = strip_tags(trim($_POST['title'] ?? ''));
                $url          = strip_tags(trim($_POST['url'] ?? ''));
                $target       = strip_tags(trim($_POST['target'] ?? '_self'));
                $icon         = strip_tags(trim($_POST['icon'] ?? ''));
                $parentId     = (int)($_POST['parent_id'] ?? 0);
                $badge        = strip_tags(trim($_POST['badge'] ?? ''));
                $sortOrder    = (int)($_POST['sort_order'] ?? 0);

                if ($title !== '' && $url !== '') {
                    if ($sortOrder === 0) {
                        $maxOrder = (int)$this->db->fetchColumn(
                            "SELECT MAX(sort_order) FROM navigation_menus WHERE location = ? AND parent_id = ?",
                            [$itemLocation, $parentId]
                        );
                        $sortOrder = $maxOrder + 1;
                    }

                    $this->db->query(
                        "INSERT INTO navigation_menus (location, title, url, target, icon, parent_id, badge, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)",
                        [$itemLocation, $title, $url, $target, $icon, $parentId, $badge, $sortOrder]
                    );
                    set_flash('success', '✅ Menu item "' . e($title) . '" added successfully!');
                } else {
                    set_flash('danger', '❌ Menu title and URL are required.');
                }

                redirect('/admin/navigation?location=' . urlencode($itemLocation));
                return;
            }

            /* ── ADD MULTIPLE ITEMS FROM PAGES ── */
            if ($action === 'add_from_pages') {
                $pageItems    = $_POST['page_items'] ?? [];
                $pageIds      = $_POST['page_ids'] ?? [];
                $itemLocation = strip_tags(trim($_POST['location'] ?? $location));

                $itemsToAdd = [];

                if (!empty($pageItems) && is_array($pageItems)) {
                    foreach ($pageItems as $itemRaw) {
                        $itemData = json_decode((string)$itemRaw, true);
                        if (!empty($itemData['title']) && !empty($itemData['url'])) {
                            $itemsToAdd[] = [
                                'title' => strip_tags(trim($itemData['title'])),
                                'url'   => strip_tags(trim($itemData['url']))
                            ];
                        }
                    }
                }

                if (!empty($pageIds) && is_array($pageIds)) {
                    foreach ($pageIds as $pageId) {
                        $page = $this->db->fetch("SELECT * FROM pages WHERE id = ?", [(int)$pageId]);
                        if ($page) {
                            $itemsToAdd[] = [
                                'title' => $page['title'],
                                'url'   => '/' . ltrim($page['slug'], '/')
                            ];
                        }
                    }
                }

                if (!empty($itemsToAdd)) {
                    $maxOrder = (int)$this->db->fetchColumn(
                        "SELECT MAX(sort_order) FROM navigation_menus WHERE location = ?",
                        [$itemLocation]
                    );
                    $addedCount = 0;
                    foreach ($itemsToAdd as $item) {
                        $maxOrder++;
                        $this->db->query(
                            "INSERT INTO navigation_menus (location, title, url, target, icon, parent_id, badge, sort_order, is_active) VALUES (?, ?, ?, '_self', '', 0, '', ?, 1)",
                            [$itemLocation, $item['title'], $item['url'], $maxOrder]
                        );
                        $addedCount++;
                    }
                    set_flash('success', "✅ {$addedCount} page(s) added to menu successfully!");
                } else {
                    set_flash('warning', '⚠️ Please select at least one page to add.');
                }

                redirect('/admin/navigation?location=' . urlencode($itemLocation));
                return;
            }

            /* ── UPDATE MENU ITEM ── */
            if ($action === 'update_item') {
                $id        = (int)($_POST['item_id'] ?? 0);
                $title     = strip_tags(trim($_POST['title'] ?? ''));
                $url       = strip_tags(trim($_POST['url'] ?? ''));
                $target    = strip_tags(trim($_POST['target'] ?? '_self'));
                $icon      = strip_tags(trim($_POST['icon'] ?? ''));
                $parentId  = (int)($_POST['parent_id'] ?? 0);
                $badge     = strip_tags(trim($_POST['badge'] ?? ''));
                $sortOrder = (int)($_POST['sort_order'] ?? 0);
                $isActive  = isset($_POST['is_active']) ? 1 : 0;

                if ($id > 0 && $title !== '' && $url !== '') {
                    $this->db->query(
                        "UPDATE navigation_menus SET title = ?, url = ?, target = ?, icon = ?, parent_id = ?, badge = ?, sort_order = ?, is_active = ? WHERE id = ?",
                        [$title, $url, $target, $icon, $parentId, $badge, $sortOrder, $isActive, $id]
                    );
                    set_flash('success', '✅ Menu item updated successfully!');
                }
                redirect('/admin/navigation?location=' . urlencode($location));
                return;
            }

            /* ── DELETE MENU ITEM ── */
            if ($action === 'delete_item') {
                $id = (int)($_POST['item_id'] ?? 0);
                if ($id > 0) {
                    // Delete item and any children
                    $this->db->query("DELETE FROM navigation_menus WHERE id = ? OR parent_id = ?", [$id, $id]);
                    set_flash('success', '✅ Menu item deleted successfully.');
                }
                redirect('/admin/navigation?location=' . urlencode($location));
                return;
            }

            /* ── MOVE ITEM UP / DOWN ── */
            if ($action === 'move_item') {
                $id        = (int)($_POST['item_id'] ?? 0);
                $direction = $_POST['direction'] ?? 'up';

                if ($id > 0) {
                    $current = $this->db->fetch("SELECT * FROM navigation_menus WHERE id = ?", [$id]);
                    if ($current) {
                        $loc = $current['location'];
                        $pId = (int)$current['parent_id'];
                        $curOrder = (int)$current['sort_order'];

                        if ($direction === 'up') {
                            $sibling = $this->db->fetch(
                                "SELECT * FROM navigation_menus WHERE location = ? AND parent_id = ? AND sort_order < ? ORDER BY sort_order DESC LIMIT 1",
                                [$loc, $pId, $curOrder]
                            );
                        } else {
                            $sibling = $this->db->fetch(
                                "SELECT * FROM navigation_menus WHERE location = ? AND parent_id = ? AND sort_order > ? ORDER BY sort_order ASC LIMIT 1",
                                [$loc, $pId, $curOrder]
                            );
                        }

                        if ($sibling) {
                            $this->db->query("UPDATE navigation_menus SET sort_order = ? WHERE id = ?", [$sibling['sort_order'], $current['id']]);
                            $this->db->query("UPDATE navigation_menus SET sort_order = ? WHERE id = ?", [$curOrder, $sibling['id']]);
                            set_flash('success', '✅ Menu order updated.');
                        }
                    }
                }
                redirect('/admin/navigation?location=' . urlencode($location));
                return;
            }

            /* ── TOGGLE ACTIVE / INACTIVE ── */
            if ($action === 'toggle_active') {
                $id = (int)($_POST['item_id'] ?? 0);
                if ($id > 0) {
                    $this->db->query("UPDATE navigation_menus SET is_active = CASE WHEN is_active = 1 THEN 0 ELSE 1 END WHERE id = ?", [$id]);
                    set_flash('success', '✅ Status toggled.');
                }
                redirect('/admin/navigation?location=' . urlencode($location));
                return;
            }
        }

        // Fetch items for current location (Hierarchical)
        $allItems = $this->db->fetchAll(
            "SELECT * FROM navigation_menus WHERE location = ? ORDER BY sort_order ASC, id ASC",
            [$location]
        ) ?? [];

        // Organize into Parents & Children
        $menuTree = [];
        $childrenMap = [];
        foreach ($allItems as $item) {
            if ((int)$item['parent_id'] === 0) {
                $menuTree[$item['id']] = $item;
                $menuTree[$item['id']]['children'] = [];
            } else {
                $childrenMap[$item['parent_id']][] = $item;
            }
        }
        foreach ($childrenMap as $parentId => $children) {
            if (isset($menuTree[$parentId])) {
                $menuTree[$parentId]['children'] = $children;
            } else {
                // If parent missing, append to root
                foreach ($children as $c) {
                    $menuTree[$c['id']] = $c;
                    $menuTree[$c['id']]['children'] = [];
                }
            }
        }

        // Fetch parent candidates for dropdown assignment
        $parentCandidates = $this->db->fetchAll(
            "SELECT id, title FROM navigation_menus WHERE location = ? AND parent_id = 0 ORDER BY sort_order ASC",
            [$location]
        ) ?? [];

        // Fetch existing CMS pages
        $pages = [];
        try {
            $pages = $this->db->fetchAll("SELECT id, title, slug, status FROM pages WHERE deleted_at IS NULL ORDER BY title ASC") ?? [];
        } catch (\Throwable $e) {}

        // Standard predefined system pages
        $systemPages = [
            ['title' => 'Home',                          'url' => '/'],
            ['title' => 'Solutions Overview',            'url' => '/solutions'],
            ['title' => 'Retail Jewellery POS',          'url' => '/solutions/jewellery-retail'],
            ['title' => 'Wholesale Jewellery ERP',       'url' => '/solutions/jewellery-wholesale'],
            ['title' => 'Manufacturing & Bullion',       'url' => '/solutions/jewellery-manufacturing'],
            ['title' => 'ERP Features & Capabilities',   'url' => '/features'],
            ['title' => 'POS & Smart Inventory',         'url' => '/features/pos-inventory'],
            ['title' => 'Manufacturing & Jobwork',       'url' => '/features/manufacturing-jobwork'],
            ['title' => 'Accounting & GST Compliance',   'url' => '/features/accounting-gst'],
            ['title' => 'Gold & Diamond Management',     'url' => '/features/gold-diamond-management'],
            ['title' => 'RFID & Barcode Automation',     'url' => '/features/crm-rfid-barcode'],
            ['title' => 'Industries Served',             'url' => '/industries'],
            ['title' => 'Integrations & Ecosystem',      'url' => '/integrations'],
            ['title' => 'Why Choose GoldMatrix',         'url' => '/why-us'],
            ['title' => 'Customer Reviews & Stories',    'url' => '/testimonials'],
            ['title' => 'About GoldMatrix ERP',          'url' => '/about'],
            ['title' => 'Contact & Support',             'url' => '/contact'],
            ['title' => 'Book Free Demo',                'url' => '/request-demo'],
            ['title' => 'Blog & Industry Insights',      'url' => '/blog'],
            ['title' => 'Terms & Conditions',            'url' => '/terms'],
            ['title' => 'Privacy Policy',                'url' => '/privacy'],
        ];

        // Counts per location
        $counts = [];
        $locCounts = $this->db->fetchAll("SELECT location, COUNT(*) as cnt FROM navigation_menus GROUP BY location") ?? [];
        foreach ($locCounts as $lc) {
            $counts[$lc['location']] = (int)$lc['cnt'];
        }

        $locationsMeta = [
            'header'        => ['label' => 'Main Header Navigation',  'icon' => 'bi-window-dock',          'desc' => 'Links displayed in the top navbar and mobile drawer.'],
            'footer_col1'   => ['label' => 'Footer: Product / Modules','icon' => 'bi-layout-sidebar-inset', 'desc' => 'First column links in the website footer.'],
            'footer_col2'   => ['label' => 'Footer: Company',          'icon' => 'bi-building',             'desc' => 'Second column links in the website footer.'],
            'footer_col3'   => ['label' => 'Footer: Support',          'icon' => 'bi-headset',              'desc' => 'Third column links in the website footer.'],
            'footer_bottom' => ['label' => 'Footer: Legal & Policy',   'icon' => 'bi-shield-check',         'desc' => 'Bottom bar copyright and policy links.'],
        ];

        admin_view('admin.menus.index', [
            'location'         => $location,
            'locationsMeta'    => $locationsMeta,
            'counts'           => $counts,
            'menuTree'         => $menuTree,
            'parentCandidates' => $parentCandidates,
            'pages'            => $pages,
            'systemPages'      => $systemPages,
            'allItems'         => $allItems
        ]);
    }
}
