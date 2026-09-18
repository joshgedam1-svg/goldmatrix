<?php
/**
 * Admin — Homepage Manager (CMS Backend)
 * Manage all sections of the website homepage
 */
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/helpers.php';
requireLogin();

/* ── CREATE TABLES if not exist ── */
$pdo->exec("CREATE TABLE IF NOT EXISTS homepage_sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_key VARCHAR(120) UNIQUE NOT NULL,
    value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$pdo->exec("CREATE TABLE IF NOT EXISTS homepage_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(80) NOT NULL,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255) DEFAULT '',
    description TEXT DEFAULT '',
    icon VARCHAR(20) DEFAULT '',
    link VARCHAR(255) DEFAULT '',
    image VARCHAR(500) DEFAULT '',
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_section (section)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

/* ── HELPERS ── */
function getHPSetting($pdo, $key, $default = '') {
    $st = $pdo->prepare("SELECT value FROM homepage_sections WHERE section_key = ?");
    $st->execute([$key]);
    $row = $st->fetch();
    return $row ? $row['value'] : $default;
}
function setHPSetting($pdo, $key, $value) {
    $st = $pdo->prepare("INSERT INTO homepage_sections (section_key, value) VALUES (?,?) ON DUPLICATE KEY UPDATE value=VALUES(value)");
    $st->execute([$key, $value]);
}

$msg = ''; $msgType = 'success';
$activeTab = $_GET['tab'] ?? 'hero';

/* ══════════════════ POST HANDLERS ══════════════════ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    /* ── SAVE TEXT SETTINGS ── */
    if ($action === 'save_settings') {
        $section = sanitize($_POST['section'] ?? '');
        foreach ($_POST as $key => $val) {
            if (in_array($key, ['action','section'])) continue;
            setHPSetting($pdo, $key, sanitize($val));
        }
        $msg = '✅ Settings saved successfully!';
        $activeTab = $section;
    }

    /* ── ADD ITEM ── */
    if ($action === 'add_item') {
        $section    = sanitize($_POST['section'] ?? '');
        $title      = sanitize($_POST['title'] ?? '');
        $subtitle   = sanitize($_POST['subtitle'] ?? '');
        $desc       = sanitize($_POST['description'] ?? '');
        $icon       = sanitize($_POST['icon'] ?? '');
        $link       = sanitize($_POST['link'] ?? '');

        // Handle image upload
        $image = '';
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../public/uploads/homepage/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $allowed = ['jpg','jpeg','png','gif','webp','svg'];
            if (in_array(strtolower($ext), $allowed)) {
                $fname = uniqid('hp_') . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fname);
                $image = '/public/uploads/homepage/' . $fname;
            }
        }
        $maxSort = $pdo->prepare("SELECT COALESCE(MAX(sort_order),0)+1 FROM homepage_items WHERE section=?");
        $maxSort->execute([$section]);
        $sortOrder = $maxSort->fetchColumn();
        $st = $pdo->prepare("INSERT INTO homepage_items (section,title,subtitle,description,icon,link,image,sort_order) VALUES (?,?,?,?,?,?,?,?)");
        $st->execute([$section,$title,$subtitle,$desc,$icon,$link,$image,$sortOrder]);
        $msg = '✅ Item added successfully!';
        $activeTab = $section;
    }

    /* ── DELETE ITEM ── */
    if ($action === 'delete_item') {
        $id = (int)($_POST['item_id'] ?? 0);
        $section = sanitize($_POST['section'] ?? '');
        $pdo->prepare("DELETE FROM homepage_items WHERE id=?")->execute([$id]);
        $msg = '🗑️ Item deleted.'; $msgType = 'warning';
        $activeTab = $section;
    }

    /* ── UPDATE ITEM ── */
    if ($action === 'update_item') {
        $id      = (int)($_POST['item_id'] ?? 0);
        $title   = sanitize($_POST['title'] ?? '');
        $sub     = sanitize($_POST['subtitle'] ?? '');
        $desc    = sanitize($_POST['description'] ?? '');
        $icon    = sanitize($_POST['icon'] ?? '');
        $link    = sanitize($_POST['link'] ?? '');
        $section = sanitize($_POST['section'] ?? '');
        $pdo->prepare("UPDATE homepage_items SET title=?,subtitle=?,description=?,icon=?,link=? WHERE id=?")->execute([$title,$sub,$desc,$icon,$link,$id]);
        $msg = '✅ Item updated!';
        $activeTab = $section;
    }

    /* ── REORDER ── */
    if ($action === 'reorder') {
        $ids = json_decode($_POST['ids'] ?? '[]', true);
        $section = sanitize($_POST['section'] ?? '');
        foreach ($ids as $i => $id) {
            $pdo->prepare("UPDATE homepage_items SET sort_order=? WHERE id=?")->execute([$i+1, (int)$id]);
        }
        header('Content-Type: application/json');
        echo json_encode(['status'=>'ok']);
        exit;
    }
}

/* ── LOAD current settings ── */
function hp($pdo, $key, $default = '') { return getHPSetting($pdo, $key, $default); }
function hpItems($pdo, $section) {
    $st = $pdo->prepare("SELECT * FROM homepage_items WHERE section=? ORDER BY sort_order ASC");
    $st->execute([$section]);
    return $st->fetchAll();
}

$tabs = [
    'hero'         => ['label'=>'🚀 Hero',         'icon'=>'rocket'],
    'about'        => ['label'=>'ℹ️ About',          'icon'=>'info-circle'],
    'modules'      => ['label'=>'📦 Modules',       'icon'=>'grid'],
    'stats'        => ['label'=>'📊 Stats',          'icon'=>'bar-chart'],
    'testimonials' => ['label'=>'⭐ Testimonials',  'icon'=>'star'],
    'industries'   => ['label'=>'🏭 Industries',    'icon'=>'building'],
    'faqs'         => ['label'=>'❓ FAQ',            'icon'=>'question-circle'],
    'cta'          => ['label'=>'📣 CTA',            'icon'=>'megaphone'],
    'nav_links'    => ['label'=>'🔗 Nav Links',     'icon'=>'link'],
    'footer'       => ['label'=>'🦶 Footer',         'icon'=>'layout-bottom'],
    'seo'          => ['label'=>'🔍 SEO',            'icon'=>'search'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage Manager — GoldMatrix Admin</title>
  <link rel="stylesheet" href="/public/assets/css/admin.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    .hp-tabs { display:flex; flex-wrap:wrap; gap:6px; margin-bottom:24px; }
    .hp-tab { padding:8px 16px; border-radius:8px; border:1px solid var(--border); background:#fff; font-size:13px; font-weight:600; cursor:pointer; color:var(--text-muted); text-decoration:none; transition:all 0.2s; }
    .hp-tab:hover { border-color:var(--navy); color:var(--navy); }
    .hp-tab.active { background:var(--navy); color:#fff; border-color:var(--navy); }
    .section-card { background:#fff; border:1px solid var(--border); border-radius:12px; overflow:hidden; margin-bottom:24px; }
    .section-card-head { background:var(--navy); color:#fff; padding:14px 20px; font-size:14px; font-weight:700; display:flex; align-items:center; gap:10px; }
    .section-card-body { padding:24px; }
    .items-table { width:100%; border-collapse:collapse; }
    .items-table th { font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:var(--text-muted); padding:10px 14px; background:#f8f9fc; border-bottom:1px solid var(--border); text-align:left; }
    .items-table td { padding:12px 14px; font-size:14px; border-bottom:1px solid var(--border); vertical-align:middle; }
    .items-table tr:last-child td { border:none; }
    .items-table tr:hover td { background:#fafbff; }
    .form-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:14px; }
    .live-preview-btn { background:linear-gradient(135deg,#059669,#065F46); color:#fff; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none; border:none; cursor:pointer; }
    .drag-handle { cursor:grab; color:#94A3B8; font-size:18px; }
    .drag-handle:active { cursor:grabbing; }
  </style>
</head>
<body class="admin-body">
<?php include 'partials/sidebar.php'; ?>
<div class="admin-main">
<?php include 'partials/topbar.php'; ?>

<div class="admin-content">
  <!-- Page Header -->
  <div class="page-header">
    <div>
      <h1 class="page-title">🏠 Homepage Manager</h1>
      <p class="page-subtitle">Edit all sections of your website homepage. Changes go live instantly.</p>
    </div>
    <div style="display:flex;gap:10px;">
      <a href="/" target="_blank" class="live-preview-btn">🌐 Preview Live Site</a>
    </div>
  </div>

  <?php if($msg): ?>
    <div class="alert alert-<?= $msgType ?>" style="margin-bottom:20px;">
      <?= $msg ?>
    </div>
  <?php endif; ?>

  <!-- TABS -->
  <div class="hp-tabs">
    <?php foreach($tabs as $key => $tab): ?>
      <a href="?tab=<?= $key ?>" class="hp-tab <?= $activeTab === $key ? 'active' : '' ?>"><?= $tab['label'] ?></a>
    <?php endforeach; ?>
  </div>

  <!-- ════════ HERO TAB ════════ -->
  <?php if($activeTab === 'hero'): ?>
  <div class="section-card">
    <div class="section-card-head">🚀 Hero Section Settings</div>
    <div class="section-card-body">
      <form method="POST">
        <input type="hidden" name="action" value="save_settings">
        <input type="hidden" name="section" value="hero">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Hero Badge Text</label>
            <input type="text" name="hero_badge" value="<?= esc(hp($pdo,'hero_badge','🏅 #1 Jewelry ERP Software in India')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Button 1 Text</label>
            <input type="text" name="hero_btn1_text" value="<?= esc(hp($pdo,'hero_btn1_text','Get Free Demo')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Button 1 Link</label>
            <input type="text" name="hero_btn1_link" value="<?= esc(hp($pdo,'hero_btn1_link','#contact')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Button 2 Text</label>
            <input type="text" name="hero_btn2_text" value="<?= esc(hp($pdo,'hero_btn2_text','▶ Watch Video')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Button 2 Link</label>
            <input type="text" name="hero_btn2_link" value="<?= esc(hp($pdo,'hero_btn2_link','#video')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Stat 1 Number (e.g. 1000+)</label>
            <input type="text" name="hero_stat1_num" value="<?= esc(hp($pdo,'hero_stat1_num','1000+')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Stat 1 Label</label>
            <input type="text" name="hero_stat1_label" value="<?= esc(hp($pdo,'hero_stat1_label','Jewelers Served')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Stat 2 Number</label>
            <input type="text" name="hero_stat2_num" value="<?= esc(hp($pdo,'hero_stat2_num','15+')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Stat 2 Label</label>
            <input type="text" name="hero_stat2_label" value="<?= esc(hp($pdo,'hero_stat2_label','Years Experience')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Stat 3 Number</label>
            <input type="text" name="hero_stat3_num" value="<?= esc(hp($pdo,'hero_stat3_num','50+')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Stat 3 Label</label>
            <input type="text" name="hero_stat3_label" value="<?= esc(hp($pdo,'hero_stat3_label','Cities in India')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Stat 4 Number</label>
            <input type="text" name="hero_stat4_num" value="<?= esc(hp($pdo,'hero_stat4_num','99.9%')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Stat 4 Label</label>
            <input type="text" name="hero_stat4_label" value="<?= esc(hp($pdo,'hero_stat4_label','Uptime Guaranteed')) ?>" class="form-control">
          </div>
        </div>
        <div class="form-group" style="margin-top:14px;">
          <label class="form-label">Hero Title (HTML allowed: use &lt;span class="highlight"&gt;word&lt;/span&gt; for gold color)</label>
          <textarea name="hero_title" rows="2" class="form-control"><?= hp($pdo,'hero_title','Complete <span class="highlight">Jewelry ERP</span><br>Software for India') ?></textarea>
        </div>
        <div class="form-group" style="margin-top:14px;">
          <label class="form-label">Hero Description</label>
          <textarea name="hero_desc" rows="3" class="form-control"><?= esc(hp($pdo,'hero_desc','Manage your entire jewelry business — Inventory, Manufacturing, POS, Accounting, GST, Karigar & Multi-Branch — from one powerful platform.')) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:18px;">💾 Save Hero Settings</button>
      </form>
    </div>
  </div>

  <!-- ════════ ABOUT TAB ════════ -->
  <?php elseif($activeTab === 'about'): ?>
  <div class="section-card">
    <div class="section-card-head">ℹ️ About Section Settings</div>
    <div class="section-card-body">
      <form method="POST">
        <input type="hidden" name="action" value="save_settings">
        <input type="hidden" name="section" value="about">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Section Tag</label>
            <input type="text" name="about_tag" value="<?= esc(hp($pdo,'about_tag','About GoldMatrix ERP')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Section Title</label>
            <input type="text" name="about_title" value="<?= esc(hp($pdo,'about_title','Built Exclusively for the Jewelry Industry')) ?>" class="form-control">
          </div>
        </div>
        <div class="form-group" style="margin-top:14px;">
          <label class="form-label">Description</label>
          <textarea name="about_desc" rows="4" class="form-control"><?= esc(hp($pdo,'about_desc','Since 2010, GoldMatrix ERP has been the most trusted software for jewelry retailers, manufacturers, and wholesalers across India.')) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:18px;">💾 Save About Settings</button>
      </form>
    </div>
  </div>
  <?php include 'partials/items_manager.php'; renderItemsManager($pdo, 'about_points', '✅ About Points (Feature Checklist)', ['title'=>'Point Text', 'icon'=>'Emoji (optional)']); ?>

  <!-- ════════ MODULES TAB ════════ -->
  <?php elseif($activeTab === 'modules'): ?>
  <div class="section-card">
    <div class="section-card-head">📦 Modules Section Settings</div>
    <div class="section-card-body">
      <form method="POST">
        <input type="hidden" name="action" value="save_settings">
        <input type="hidden" name="section" value="modules">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Section Tag</label>
            <input type="text" name="modules_tag" value="<?= esc(hp($pdo,'modules_tag','ERP Modules')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Section Title</label>
            <input type="text" name="modules_title" value="<?= esc(hp($pdo,'modules_title','Everything Your Jewelry Business Needs')) ?>" class="form-control">
          </div>
        </div>
        <div class="form-group" style="margin-top:14px;">
          <label class="form-label">Description</label>
          <textarea name="modules_desc" rows="2" class="form-control"><?= esc(hp($pdo,'modules_desc','Fully integrated modules that work together.')) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:18px;">💾 Save</button>
      </form>
    </div>
  </div>
  <?php include 'partials/items_manager.php'; renderItemsManager($pdo, 'modules', '📦 ERP Modules', ['icon'=>'Emoji Icon (📦)', 'title'=>'Module Name', 'description'=>'Short Description']); ?>

  <!-- ════════ STATS TAB ════════ -->
  <?php elseif($activeTab === 'stats'): ?>
  <?php include 'partials/items_manager.php'; renderItemsManager($pdo, 'stats', '📊 Stats Counter', ['title'=>'Number (e.g. 1000+)', 'description'=>'Label (e.g. Jewelers Served)']); ?>

  <!-- ════════ TESTIMONIALS TAB ════════ -->
  <?php elseif($activeTab === 'testimonials'): ?>
  <div class="section-card">
    <div class="section-card-head">⭐ Testimonials Settings</div>
    <div class="section-card-body">
      <form method="POST">
        <input type="hidden" name="action" value="save_settings">
        <input type="hidden" name="section" value="testimonials">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Section Tag</label>
            <input type="text" name="testi_tag" value="<?= esc(hp($pdo,'testi_tag','Customer Reviews')) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Section Title</label>
            <input type="text" name="testi_title" value="<?= esc(hp($pdo,'testi_title','Trusted by Jewelers Across India')) ?>" class="form-control">
          </div>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:14px;">💾 Save</button>
      </form>
    </div>
  </div>
  <?php include 'partials/items_manager.php'; renderItemsManager($pdo, 'testimonials', '⭐ Reviews', ['title'=>'Customer Name', 'subtitle'=>'Company & City', 'description'=>'Review Text']); ?>

  <!-- ════════ INDUSTRIES TAB ════════ -->
  <?php elseif($activeTab === 'industries'): ?>
  <?php include 'partials/items_manager.php'; renderItemsManager($pdo, 'industries', '🏭 Industries', ['icon'=>'Emoji Icon', 'title'=>'Industry Name']); ?>

  <!-- ════════ FAQ TAB ════════ -->
  <?php elseif($activeTab === 'faqs'): ?>
  <?php include 'partials/items_manager.php'; renderItemsManager($pdo, 'faqs', '❓ FAQ Items', ['title'=>'Question', 'description'=>'Answer']); ?>

  <!-- ════════ CTA TAB ════════ -->
  <?php elseif($activeTab === 'cta'): ?>
  <div class="section-card">
    <div class="section-card-head">📣 Call-to-Action Section</div>
    <div class="section-card-body">
      <form method="POST">
        <input type="hidden" name="action" value="save_settings">
        <input type="hidden" name="section" value="cta">
        <div class="form-grid">
          <div class="form-group"><label class="form-label">CTA Title</label><input type="text" name="cta_title" value="<?= esc(hp($pdo,'cta_title','Ready to Transform Your Jewelry Business?')) ?>" class="form-control"></div>
          <div class="form-group"><label class="form-label">Button 1 Text</label><input type="text" name="cta_btn1_text" value="<?= esc(hp($pdo,'cta_btn1_text','Get Free Demo')) ?>" class="form-control"></div>
          <div class="form-group"><label class="form-label">Button 1 Link</label><input type="text" name="cta_btn1_link" value="<?= esc(hp($pdo,'cta_btn1_link','#contact')) ?>" class="form-control"></div>
          <div class="form-group"><label class="form-label">Button 2 Text</label><input type="text" name="cta_btn2_text" value="<?= esc(hp($pdo,'cta_btn2_text','Call: +91 98765 43210')) ?>" class="form-control"></div>
          <div class="form-group"><label class="form-label">Button 2 Link</label><input type="text" name="cta_btn2_link" value="<?= esc(hp($pdo,'cta_btn2_link','tel:+919876543210')) ?>" class="form-control"></div>
        </div>
        <div class="form-group" style="margin-top:14px;"><label class="form-label">CTA Description</label><textarea name="cta_desc" rows="2" class="form-control"><?= esc(hp($pdo,'cta_desc','Join 1000+ jewelers who trust GoldMatrix ERP. Get your free demo today.')) ?></textarea></div>
        <button type="submit" class="btn btn-primary" style="margin-top:18px;">💾 Save CTA Settings</button>
      </form>
    </div>
  </div>

  <!-- ════════ NAV LINKS TAB ════════ -->
  <?php elseif($activeTab === 'nav_links'): ?>
  <?php include 'partials/items_manager.php'; renderItemsManager($pdo, 'nav_links', '🔗 Navigation Menu Links', ['title'=>'Link Label', 'link'=>'URL (e.g. #modules or /pricing)']); ?>

  <!-- ════════ FOOTER TAB ════════ -->
  <?php elseif($activeTab === 'footer'): ?>
  <div class="section-card">
    <div class="section-card-head">🦶 Footer Settings</div>
    <div class="section-card-body">
      <form method="POST">
        <input type="hidden" name="action" value="save_settings">
        <input type="hidden" name="section" value="footer">
        <div class="form-grid">
          <div class="form-group"><label class="form-label">Email</label><input type="email" name="footer_email" value="<?= esc(hp($pdo,'footer_email','info@goldmatrixerp.com')) ?>" class="form-control"></div>
          <div class="form-group"><label class="form-label">Phone</label><input type="text" name="footer_phone" value="<?= esc(hp($pdo,'footer_phone','+91 98765 43210')) ?>" class="form-control"></div>
          <div class="form-group"><label class="form-label">Address</label><input type="text" name="footer_address" value="<?= esc(hp($pdo,'footer_address','Mumbai, Maharashtra, India')) ?>" class="form-control"></div>
          <div class="form-group"><label class="form-label">Copyright Text</label><input type="text" name="copyright" value="<?= esc(hp($pdo,'copyright','© '.date('Y').' GoldMatrix Software Technologies Pvt. Ltd. All rights reserved.')) ?>" class="form-control"></div>
        </div>
        <div class="form-group" style="margin-top:14px;"><label class="form-label">Footer Tagline</label><textarea name="footer_tagline" rows="2" class="form-control"><?= esc(hp($pdo,'footer_tagline',"India's most trusted Jewelry ERP software.")) ?></textarea></div>
        <button type="submit" class="btn btn-primary" style="margin-top:18px;">💾 Save Footer Settings</button>
      </form>
    </div>
  </div>

  <!-- ════════ SEO TAB ════════ -->
  <?php elseif($activeTab === 'seo'): ?>
  <div class="section-card">
    <div class="section-card-head">🔍 Homepage SEO Settings</div>
    <div class="section-card-body">
      <form method="POST">
        <input type="hidden" name="action" value="save_settings">
        <input type="hidden" name="section" value="seo">
        <div class="form-group">
          <label class="form-label">Meta Title <small style="color:#94A3B8;">(keep under 60 chars)</small></label>
          <input type="text" name="meta_title" maxlength="70" value="<?= esc(hp($pdo,'meta_title','GoldMatrix ERP — #1 Jewelry Software Solution for India')) ?>" class="form-control">
        </div>
        <div class="form-group" style="margin-top:14px;">
          <label class="form-label">Meta Description <small style="color:#94A3B8;">(keep under 160 chars)</small></label>
          <textarea name="meta_desc" rows="3" maxlength="170" class="form-control"><?= esc(hp($pdo,'meta_desc','Complete Jewelry ERP Software with Inventory, POS, GST, Accounting, Karigar, and Multi-Branch Management. Trusted by 1000+ jewelers.')) ?></textarea>
        </div>
        <div class="form-group" style="margin-top:14px;">
          <label class="form-label">Meta Keywords</label>
          <input type="text" name="meta_keywords" value="<?= esc(hp($pdo,'meta_keywords','jewelry erp software, jewellery pos system, gold shop software india')) ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:18px;">💾 Save SEO Settings</button>
      </form>
    </div>
  </div>
  <?php endif; ?>

</div><!-- /admin-content -->
</div><!-- /admin-main -->
</body>
</html>
