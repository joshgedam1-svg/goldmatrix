<?php
// Handle static asset requests when running via PHP built-in CLI server
if (php_sapi_name() === 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

/**
 * GoldMatrix Jewelry ERP — Homepage (index.php)
 * Fully editable via Admin CMS Backend
 */
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/helpers.php';

/* ── Load ALL homepage sections from DB ── */
function hp($key, $default = '') {
    global $pdo;
    try {
        $st = $pdo->prepare("SELECT value FROM homepage_sections WHERE section_key = ? LIMIT 1");
        $st->execute([$key]);
        $row = $st->fetch();
        return $row ? $row['value'] : $default;
    } catch (Exception $e) { return $default; }
}

function hp_rows($section, $limit = 20) {
    global $pdo;
    try {
        $st = $pdo->prepare("SELECT * FROM homepage_items WHERE section = ? ORDER BY sort_order ASC LIMIT ?");
        $st->execute([$section, $limit]);
        return $st->fetchAll();
    } catch (Exception $e) { return []; }
}

/* ── META ── */
$meta_title       = hp('meta_title',       'GoldMatrix ERP — #1 Jewelry Software Solution for India');
$meta_desc        = hp('meta_desc',        'Complete Jewelry ERP Software with Inventory, POS, GST, Accounting, Karigar, and Multi-Branch Management. Trusted by 1000+ jewelers.');
$meta_keywords    = hp('meta_keywords',    'jewelry erp software, jewellery pos system, gold shop software india, karigar management');

/* ── HERO ── */
$hero_badge       = hp('hero_badge',       '🏅 #1 Jewelry ERP Software in India');
$hero_title       = hp('hero_title',       'Complete <span class="highlight">Jewelry ERP</span><br>Software for India');
$hero_desc        = hp('hero_desc',        'Manage your entire jewelry business — Inventory, Manufacturing, POS, Accounting, GST, Karigar & Multi-Branch — from one powerful platform.');
$hero_btn1_text   = hp('hero_btn1_text',   'Get Free Demo');
$hero_btn1_link   = hp('hero_btn1_link',   '#contact');
$hero_btn2_text   = hp('hero_btn2_text',   '▶ Watch Video');
$hero_btn2_link   = hp('hero_btn2_link',   '#video');
$hero_stat1_num   = hp('hero_stat1_num',   '1000+');
$hero_stat1_label = hp('hero_stat1_label', 'Jewelers Served');
$hero_stat2_num   = hp('hero_stat2_num',   '15+');
$hero_stat2_label = hp('hero_stat2_label', 'Years Experience');
$hero_stat3_num   = hp('hero_stat3_num',   '50+');
$hero_stat3_label = hp('hero_stat3_label', 'Cities in India');
$hero_stat4_num   = hp('hero_stat4_num',   '99.9%');
$hero_stat4_label = hp('hero_stat4_label', 'Uptime Guaranteed');

/* ── ABOUT ── */
$about_tag        = hp('about_tag',        'About GoldMatrix ERP');
$about_title      = hp('about_title',      'Built Exclusively for the Jewelry Industry');
$about_desc       = hp('about_desc',       'Since 2010, GoldMatrix ERP has been the most trusted software for jewelry retailers, manufacturers, and wholesalers across India. Our software understands the unique needs of the jewelry trade — from gold weight management to karigar tracking to GST compliance.');
$about_points     = hp_rows('about_points');

/* ── MODULES ── */
$modules_tag      = hp('modules_tag',      'ERP Modules');
$modules_title    = hp('modules_title',    'Everything Your Jewelry Business Needs');
$modules_desc     = hp('modules_desc',     'Fully integrated modules that work together to give you complete control over your business.');
$modules          = hp_rows('modules');

/* ── STATS ── */
$stats            = hp_rows('stats');

/* ── TESTIMONIALS ── */
$testi_tag        = hp('testi_tag',        'Customer Reviews');
$testi_title      = hp('testi_title',      'Trusted by Jewelers Across India');
$testimonials     = hp_rows('testimonials');

/* ── INDUSTRIES ── */
$industries_tag   = hp('industries_tag',   'Industries We Serve');
$industries_title = hp('industries_title', 'Made for Every Type of Jewelry Business');
$industries       = hp_rows('industries');

/* ── FAQ ── */
$faq_tag          = hp('faq_tag',          'FAQ');
$faq_title        = hp('faq_title',        'Frequently Asked Questions');
$faqs             = hp_rows('faqs');

/* ── CTA ── */
$cta_title        = hp('cta_title',        'Ready to Transform Your Jewelry Business?');
$cta_desc         = hp('cta_desc',         'Join 1000+ jewelers who trust GoldMatrix ERP. Get your free demo today.');
$cta_btn1_text    = hp('cta_btn1_text',    'Get Free Demo');
$cta_btn1_link    = hp('cta_btn1_link',    '#contact');
$cta_btn2_text    = hp('cta_btn2_text',    'Call: +91 98765 43210');
$cta_btn2_link    = hp('cta_btn2_link',    'tel:+919876543210');

/* ── NAV ── */
$nav_links        = hp_rows('nav_links');

/* ── FOOTER ── */
$footer_tagline   = hp('footer_tagline',   'India\'s most trusted Jewelry ERP software. Powering thousands of jewelry businesses since 2010.');
$footer_email     = hp('footer_email',     'info@goldmatrixerp.com');
$footer_phone     = hp('footer_phone',     '+91 98765 43210');
$footer_address   = hp('footer_address',   'Mumbai, Maharashtra, India');
$copyright        = hp('copyright',        '© ' . date('Y') . ' GoldMatrix Software Technologies Pvt. Ltd. All rights reserved.');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($meta_title) ?></title>
  <meta name="description" content="<?= esc($meta_desc) ?>">
  <meta name="keywords" content="<?= esc($meta_keywords) ?>">
  <meta property="og:title" content="<?= esc($meta_title) ?>">
  <meta property="og:description" content="<?= esc($meta_desc) ?>">
  <meta property="og:type" content="website">
  <link rel="icon" type="image/svg+xml" href="/public/assets/images/favicon.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/public/assets/css/frontend.css">
  <style>
    /* Mini hero dashboard mockup */
    .mini-kpi-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:14px; }
    .mini-kpi { background:rgba(255,255,255,0.07); border-radius:10px; padding:14px 16px; }
    .mini-kpi-label { font-size:11px; color:rgba(255,255,255,0.45); margin-bottom:4px; }
    .mini-kpi-val { font-size:22px; font-weight:800; color:#C9A84C; }
    .mini-chart-row { background:rgba(255,255,255,0.05); border-radius:10px; padding:14px 16px; }
    .mini-chart-label { font-size:11px; color:rgba(255,255,255,0.45); margin-bottom:10px; }
    .mini-bars { display:flex; align-items:flex-end; gap:7px; height:60px; }
    .mini-bar { flex:1; background:rgba(201,168,76,0.3); border-radius:4px 4px 0 0; transition:height 0.5s; }
    .mini-bar.active { background:#C9A84C; }
  </style>
</head>
<body>

<!-- ═══════════════════ NAVBAR ═══════════════════ -->
<nav class="site-navbar" id="main-navbar">
  <a href="/" class="navbar-brand" aria-label="GoldMatrix ERP Home">
    <img src="/public/assets/images/logo-white.svg" alt="GoldMatrix ERP Logo" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
    <div style="display:none;align-items:center;gap:8px;">
      <svg width="28" height="28" viewBox="0 0 48 48"><rect width="48" height="48" rx="8" fill="#C9A84C"/><polygon points="24,6 40,20 24,44 8,20" fill="none" stroke="#0B1F3A" stroke-width="2.5"/><line x1="8" y1="20" x2="40" y2="20" stroke="#0B1F3A" stroke-width="1.5"/></svg>
      <span style="font-size:18px;font-weight:800;color:#fff;letter-spacing:-0.5px;">GoldMatrix<span style="color:#C9A84C;">ERP</span></span>
    </div>
  </a>
  <div class="navbar-menu" id="navMenu">
    <?php foreach($nav_links as $nl): ?>
      <a href="<?= esc($nl['link'] ?? '#') ?>"><?= esc($nl['title'] ?? '') ?></a>
    <?php endforeach; ?>
    <?php if(empty($nav_links)): ?>
      <a href="#about">About</a>
      <a href="#modules">Modules</a>
      <a href="#workflow">Workflow</a>
      <a href="#pricing">Pricing</a>
      <a href="#contact">Contact</a>
      <a href="#contact" class="nav-cta">🚀 Free Demo</a>
    <?php endif; ?>
  </div>
  <button class="navbar-hamburger" id="hamburger" aria-label="Menu">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
  </button>
</nav>

<!-- ═══════════════════ HERO ═══════════════════ -->
<section class="hero-section" id="hero">
  <div class="hero-content">
    <div class="hero-badge"><?= $hero_badge ?></div>
    <h1 class="hero-title"><?= $hero_title ?></h1>
    <p class="hero-desc"><?= $hero_desc ?></p>
    <div class="hero-btns">
      <a href="<?= esc($hero_btn1_link) ?>" class="btn-gold"><?= esc($hero_btn1_text) ?> →</a>
      <a href="<?= esc($hero_btn2_link) ?>" class="btn-outline-white"><?= esc($hero_btn2_text) ?></a>
    </div>
    <div class="hero-stats">
      <div class="hero-stat">
        <div class="hero-stat-num"><?= esc($hero_stat1_num) ?></div>
        <div class="hero-stat-label"><?= esc($hero_stat1_label) ?></div>
      </div>
      <div class="hero-stat" style="border-left:1px solid rgba(255,255,255,0.12);padding-left:32px;">
        <div class="hero-stat-num"><?= esc($hero_stat2_num) ?></div>
        <div class="hero-stat-label"><?= esc($hero_stat2_label) ?></div>
      </div>
      <div class="hero-stat" style="border-left:1px solid rgba(255,255,255,0.12);padding-left:32px;">
        <div class="hero-stat-num"><?= esc($hero_stat3_num) ?></div>
        <div class="hero-stat-label"><?= esc($hero_stat3_label) ?></div>
      </div>
      <div class="hero-stat" style="border-left:1px solid rgba(255,255,255,0.12);padding-left:32px;">
        <div class="hero-stat-num"><?= esc($hero_stat4_num) ?></div>
        <div class="hero-stat-label"><?= esc($hero_stat4_label) ?></div>
      </div>
    </div>
  </div>

  <!-- Mini Dashboard Mockup -->
  <div class="hero-visual">
    <div class="hero-dashboard-mockup">
      <div style="background:rgba(255,255,255,0.06);border-radius:8px;padding:10px 14px;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between;">
        <span style="font-size:12px;font-weight:700;color:#C9A84C;">📊 GoldMatrix Dashboard</span>
        <span style="font-size:11px;color:rgba(255,255,255,0.4);">Live ●</span>
      </div>
      <div class="mini-kpi-grid">
        <div class="mini-kpi">
          <div class="mini-kpi-label">Today Sales</div>
          <div class="mini-kpi-val">₹4.2L</div>
        </div>
        <div class="mini-kpi">
          <div class="mini-kpi-label">Stock Value</div>
          <div class="mini-kpi-val">₹1.8Cr</div>
        </div>
        <div class="mini-kpi">
          <div class="mini-kpi-label">Orders Pending</div>
          <div class="mini-kpi-val">23</div>
        </div>
        <div class="mini-kpi">
          <div class="mini-kpi-label">Karigar Jobs</div>
          <div class="mini-kpi-val">47</div>
        </div>
      </div>
      <div class="mini-chart-row">
        <div class="mini-chart-label">Monthly Sales Trend</div>
        <div class="mini-bars">
          <div class="mini-bar" style="height:40%"></div>
          <div class="mini-bar" style="height:55%"></div>
          <div class="mini-bar" style="height:45%"></div>
          <div class="mini-bar" style="height:70%"></div>
          <div class="mini-bar" style="height:60%"></div>
          <div class="mini-bar" style="height:80%"></div>
          <div class="mini-bar active" style="height:95%"></div>
        </div>
      </div>
      <div style="margin-top:12px;padding:10px 14px;background:rgba(5,150,105,0.15);border-radius:8px;border:1px solid rgba(5,150,105,0.3);">
        <span style="font-size:12px;color:#6EE7B7;">✓ GST Return filed ● Tally synced ● 3 Branches online</span>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ TRUST BAR ═══════════════════ -->
<div class="trust-bar">
  <p>TRUSTED BY</p>
  <div class="trust-logos">
    <span class="trust-logo-item">MEHTA JEWELLERS</span>
    <span class="trust-logo-item">KRISHNA GOLD</span>
    <span class="trust-logo-item">BHAVNA DIAMONDS</span>
    <span class="trust-logo-item">SHAH ORNAMENTS</span>
    <span class="trust-logo-item">RATAN JEWELS</span>
    <span class="trust-logo-item">LALJI SONS</span>
  </div>
</div>

<!-- ═══════════════════ ABOUT ═══════════════════ -->
<section class="section about-section" id="about">
  <div class="about-grid">
    <div class="about-img-wrap">
      <!-- SVG illustration -->
      <svg width="320" height="240" viewBox="0 0 320 240" xmlns="http://www.w3.org/2000/svg">
        <rect width="320" height="240" rx="12" fill="#0B1F3A"/>
        <!-- Diamond shape -->
        <polygon points="160,30 210,80 160,180 110,80" fill="none" stroke="#C9A84C" stroke-width="2.5"/>
        <polygon points="160,30 210,80 160,80" fill="rgba(201,168,76,0.15)"/>
        <polygon points="160,30 110,80 160,80" fill="rgba(201,168,76,0.08)"/>
        <line x1="110" y1="80" x2="210" y2="80" stroke="#C9A84C" stroke-width="1.5" opacity="0.6"/>
        <!-- Connecting lines -->
        <line x1="60" y1="110" x2="110" y2="80" stroke="rgba(201,168,76,0.3)" stroke-width="1" stroke-dasharray="4"/>
        <line x1="260" y1="110" x2="210" y2="80" stroke="rgba(201,168,76,0.3)" stroke-width="1" stroke-dasharray="4"/>
        <line x1="60" y1="170" x2="160" y2="180" stroke="rgba(201,168,76,0.3)" stroke-width="1" stroke-dasharray="4"/>
        <line x1="260" y1="170" x2="160" y2="180" stroke="rgba(201,168,76,0.3)" stroke-width="1" stroke-dasharray="4"/>
        <!-- Module circles -->
        <circle cx="40" cy="110" r="26" fill="rgba(22,58,99,0.8)" stroke="rgba(201,168,76,0.4)" stroke-width="1.5"/>
        <text x="40" y="107" text-anchor="middle" font-size="14">📦</text>
        <text x="40" y="122" text-anchor="middle" font-size="7" fill="rgba(255,255,255,0.6)">Stock</text>
        <circle cx="280" cy="110" r="26" fill="rgba(22,58,99,0.8)" stroke="rgba(201,168,76,0.4)" stroke-width="1.5"/>
        <text x="280" y="107" text-anchor="middle" font-size="14">🏷️</text>
        <text x="280" y="122" text-anchor="middle" font-size="7" fill="rgba(255,255,255,0.6)">POS</text>
        <circle cx="40" cy="175" r="26" fill="rgba(22,58,99,0.8)" stroke="rgba(201,168,76,0.4)" stroke-width="1.5"/>
        <text x="40" y="172" text-anchor="middle" font-size="14">📊</text>
        <text x="40" y="187" text-anchor="middle" font-size="7" fill="rgba(255,255,255,0.6)">GST</text>
        <circle cx="280" cy="175" r="26" fill="rgba(22,58,99,0.8)" stroke="rgba(201,168,76,0.4)" stroke-width="1.5"/>
        <text x="280" y="172" text-anchor="middle" font-size="14">🏭</text>
        <text x="280" y="187" text-anchor="middle" font-size="7" fill="rgba(255,255,255,0.6)">Mfg</text>
        <text x="160" y="220" text-anchor="middle" font-size="11" font-weight="700" fill="#C9A84C">GoldMatrix ERP</text>
      </svg>
    </div>
    <div class="about-content">
      <div class="section-tag"><?= esc($about_tag) ?></div>
      <h2 class="section-title"><?= esc($about_title) ?></h2>
      <p style="color:#6B7280;font-size:15px;line-height:1.75;"><?= esc($about_desc) ?></p>
      <ul class="about-points">
        <?php if(!empty($about_points)): ?>
          <?php foreach($about_points as $pt): ?>
            <li><div class="check-icon">✓</div><?= esc($pt['title']) ?></li>
          <?php endforeach; ?>
        <?php else: ?>
          <li><div class="check-icon">✓</div>Designed exclusively for Jewelry & Gold trade</li>
          <li><div class="check-icon">✓</div>Works Offline & Online — Cloud Ready</li>
          <li><div class="check-icon">✓</div>Full GST compliance & e-Invoice integration</li>
          <li><div class="check-icon">✓</div>Supports Retail, Wholesale & Manufacturing</li>
          <li><div class="check-icon">✓</div>Multi-branch with central management</li>
          <li><div class="check-icon">✓</div>Free training & lifetime technical support</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ═══════════════════ MODULES ═══════════════════ -->
<section class="section modules-section" id="modules">
  <div class="section-header">
    <div class="section-tag"><?= esc($modules_tag) ?></div>
    <h2 class="section-title"><?= esc($modules_title) ?></h2>
    <p class="section-desc"><?= esc($modules_desc) ?></p>
  </div>
  <div class="modules-grid">
    <?php if(!empty($modules)): ?>
      <?php foreach($modules as $m): ?>
        <div class="module-card">
          <div class="module-icon"><?= esc($m['icon'] ?? '💎') ?></div>
          <h3 class="module-title"><?= esc($m['title']) ?></h3>
          <p class="module-desc"><?= esc($m['description'] ?? '') ?></p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <?php $defaultModules = [
        ['icon'=>'📦','title'=>'Inventory Management','desc'=>'Real-time gold, silver, diamond and stone stock tracking with fine/gross weight, purity, and barcode.'],
        ['icon'=>'🏭','title'=>'Manufacturing & Job Work','desc'=>'Complete karigar management, gold issue/return, wastage calculation, and job work tracking.'],
        ['icon'=>'🏷️','title'=>'POS & Billing','desc'=>'Fast retail billing with GST invoice, old gold exchange, EMI tracking, and scheme management.'],
        ['icon'=>'🛒','title'=>'Purchase Management','desc'=>'Vendor management, gold/silver purchases, purchase orders, and payment scheduling.'],
        ['icon'=>'📊','title'=>'Accounting & GST','desc'=>'Full double-entry ledger, GSTR-1/3B filing, balance sheet, cash book, and Tally export.'],
        ['icon'=>'👥','title'=>'CRM & Customer','desc'=>'Customer history, loyalty points, birthday alerts, outstanding balance, and WhatsApp followups.'],
        ['icon'=>'🏢','title'=>'Multi-Branch Control','desc'=>'Central HO view with inter-branch transfers, stock sharing, and branch-wise P&L reports.'],
        ['icon'=>'📈','title'=>'Reports & Analytics','desc'=>'180+ reports — sales vs target, gold rate P&L, karigar efficiency, and custom report builder.'],
      ]; ?>
      <?php foreach($defaultModules as $m): ?>
        <div class="module-card">
          <div class="module-icon"><?= $m['icon'] ?></div>
          <h3 class="module-title"><?= $m['title'] ?></h3>
          <p class="module-desc"><?= $m['desc'] ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<!-- ═══════════════════ WORKFLOW ═══════════════════ -->
<section class="section workflow-section" id="workflow">
  <div class="section-header">
    <div class="section-tag">System Workflow</div>
    <h2 class="section-title">How GoldMatrix ERP Works</h2>
    <p class="section-desc">Complete end-to-end jewelry business automation in 9 integrated steps</p>
  </div>
  <div class="workflow-img-wrap">
    <img src="/public/assets/images/erp-workflow.svg" alt="GoldMatrix Jewelry ERP Complete Workflow — Inventory to Reporting" loading="lazy">
  </div>
</section>

<!-- ═══════════════════ STATS ═══════════════════ -->
<section class="stats-section" id="stats">
  <div class="stats-grid">
    <?php if(!empty($stats)): ?>
      <?php foreach($stats as $s): ?>
        <div class="stat-item">
          <div class="stat-num"><?= esc($s['title']) ?></div>
          <div class="stat-label"><?= esc($s['description'] ?? '') ?></div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="stat-item"><div class="stat-num">1000+</div><div class="stat-label">Jewelers Using GoldMatrix</div></div>
      <div class="stat-item"><div class="stat-num">15+</div><div class="stat-label">Years of Industry Experience</div></div>
      <div class="stat-item"><div class="stat-num">50+</div><div class="stat-label">Cities Across India</div></div>
      <div class="stat-item"><div class="stat-num">180+</div><div class="stat-label">Reports & Analytics</div></div>
      <div class="stat-item"><div class="stat-num">99.9%</div><div class="stat-label">System Uptime</div></div>
    <?php endif; ?>
  </div>
</section>

<!-- ═══════════════════ INDUSTRIES ═══════════════════ -->
<section class="section industries-section" id="industries">
  <div class="section-header">
    <div class="section-tag"><?= esc($industries_tag) ?></div>
    <h2 class="section-title"><?= esc($industries_title) ?></h2>
  </div>
  <div class="industries-grid">
    <?php if(!empty($industries)): ?>
      <?php foreach($industries as $i): ?>
        <div class="industry-card">
          <div class="industry-icon"><?= esc($i['icon'] ?? '💎') ?></div>
          <div class="industry-title"><?= esc($i['title']) ?></div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <?php $defaultIndustries = ['💎 Jewelry Retailers','🏭 Manufacturers','🥇 Gold Wholesalers','💍 Diamond Traders','🏪 Chain Stores','🏅 Bullion Dealers','👰 Bridal Stores','🌐 Online Jewelers']; ?>
      <?php foreach($defaultIndustries as $ind): ?>
        <div class="industry-card">
          <div class="industry-icon"><?= explode(' ',$ind)[0] ?></div>
          <div class="industry-title"><?= implode(' ', array_slice(explode(' ',$ind),1)) ?></div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<!-- ═══════════════════ TESTIMONIALS ═══════════════════ -->
<section class="section testimonials-section" id="testimonials">
  <div class="section-header">
    <div class="section-tag"><?= esc($testi_tag) ?></div>
    <h2 class="section-title"><?= esc($testi_title) ?></h2>
  </div>
  <div class="testimonials-grid">
    <?php if(!empty($testimonials)): ?>
      <?php foreach($testimonials as $t): ?>
        <div class="testimonial-card">
          <div class="stars">★★★★★</div>
          <p class="testimonial-quote">"<?= esc($t['description'] ?? $t['title']) ?>"</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar"><?= strtoupper(substr($t['title'],0,1)) ?></div>
            <div>
              <div class="testimonial-name"><?= esc($t['title']) ?></div>
              <div class="testimonial-company"><?= esc($t['subtitle'] ?? '') ?></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <?php $defaultTestis = [
        ['name'=>'Ramesh Mehta','company'=>'Mehta Jewellers, Mumbai','quote'=>'GoldMatrix ERP has completely transformed our business. Karigar tracking alone saved us lakhs. Best jewelry software in India.'],
        ['name'=>'Priya Shah','company'=>'Shah Ornaments, Surat','quote'=>'GST filing used to take 2 days. Now it\'s done in 20 minutes. The accounting module is simply outstanding.'],
        ['name'=>'Suresh Patel','company'=>'Krishna Gold, Ahmedabad','quote'=>'We have 5 branches and GoldMatrix connects them all in real-time. Stock sharing between branches is seamless.'],
      ]; ?>
      <?php foreach($defaultTestis as $t): ?>
        <div class="testimonial-card">
          <div class="stars">★★★★★</div>
          <p class="testimonial-quote">"<?= $t['quote'] ?>"</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar"><?= $t['name'][0] ?></div>
            <div>
              <div class="testimonial-name"><?= $t['name'] ?></div>
              <div class="testimonial-company"><?= $t['company'] ?></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<!-- ═══════════════════ FAQ ═══════════════════ -->
<section class="section faq-section" id="faq">
  <div class="section-header">
    <div class="section-tag"><?= esc($faq_tag) ?></div>
    <h2 class="section-title"><?= esc($faq_title) ?></h2>
  </div>
  <div class="faq-list">
    <?php if(!empty($faqs)): ?>
      <?php foreach($faqs as $f): ?>
        <div class="faq-item">
          <div class="faq-question"><?= esc($f['title']) ?><span class="faq-arrow">▼</span></div>
          <div class="faq-answer"><?= esc($f['description'] ?? '') ?></div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <?php $defaultFaqs = [
        ['q'=>'Does GoldMatrix ERP work offline?','a'=>'Yes, GoldMatrix ERP works fully offline. When internet is restored, all data automatically syncs to the cloud and other branches.'],
        ['q'=>'Is GoldMatrix ERP GST compliant?','a'=>'Absolutely. GoldMatrix ERP generates GSTR-1, GSTR-3B, and is e-Invoice ready for businesses with turnover above ₹10 Cr.'],
        ['q'=>'Can I manage multiple jewelry branches?','a'=>'Yes, GoldMatrix supports unlimited branches with central HO control, inter-branch stock transfer, and consolidated reporting.'],
        ['q'=>'What type of training is provided?','a'=>'We provide free on-site or online training, video tutorials, and 24/7 WhatsApp support for all our customers.'],
        ['q'=>'Does it support gold rate auto-update?','a'=>'Yes, gold and silver rates update automatically from live market feeds. All valuations are calculated on current rates.'],
      ]; ?>
      <?php foreach($defaultFaqs as $f): ?>
        <div class="faq-item">
          <div class="faq-question"><?= $f['q'] ?><span class="faq-arrow">▼</span></div>
          <div class="faq-answer"><?= $f['a'] ?></div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<!-- ═══════════════════ CTA ═══════════════════ -->
<section class="cta-section" id="contact">
  <div class="section-tag" style="color:#C9A84C;">Get Started Today</div>
  <h2 class="cta-title"><?= esc($cta_title) ?></h2>
  <p class="cta-desc"><?= esc($cta_desc) ?></p>
  <div class="cta-btns">
    <a href="<?= esc($cta_btn1_link) ?>" class="btn-gold"><?= esc($cta_btn1_text) ?> →</a>
    <a href="<?= esc($cta_btn2_link) ?>" class="btn-outline-white">📞 <?= esc($cta_btn2_text) ?></a>
  </div>
</section>

<!-- ═══════════════════ FOOTER ═══════════════════ -->
<footer class="site-footer">
  <div class="footer-grid">
    <div class="footer-brand">
      <img src="/public/assets/images/logo-white.svg" alt="GoldMatrix ERP" onerror="this.style.display='none'">
      <p><?= esc($footer_tagline) ?></p>
      <div style="font-size:13px;">
        📧 <a href="mailto:<?= esc($footer_email) ?>" style="color:rgba(255,255,255,0.45);text-decoration:none;"><?= esc($footer_email) ?></a><br>
        📞 <a href="tel:<?= esc(preg_replace('/[^0-9+]/','',$footer_phone)) ?>" style="color:rgba(255,255,255,0.45);text-decoration:none;"><?= esc($footer_phone) ?></a><br>
        📍 <?= esc($footer_address) ?>
      </div>
    </div>
    <div class="footer-col">
      <h6>Product</h6>
      <a href="#modules">ERP Modules</a>
      <a href="#workflow">How It Works</a>
      <a href="#industries">Industries</a>
      <a href="#pricing">Pricing</a>
    </div>
    <div class="footer-col">
      <h6>Company</h6>
      <a href="#about">About Us</a>
      <a href="#">Careers</a>
      <a href="#">Blog</a>
      <a href="#contact">Contact</a>
    </div>
    <div class="footer-col">
      <h6>Support</h6>
      <a href="#">Documentation</a>
      <a href="#">Video Tutorials</a>
      <a href="#">WhatsApp Support</a>
      <a href="#">Partner Program</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p><?= $copyright ?></p>
    <p><a href="#" style="color:rgba(255,255,255,0.3);text-decoration:none;">Privacy Policy</a> &nbsp;|&nbsp; <a href="#" style="color:rgba(255,255,255,0.3);text-decoration:none;">Terms of Service</a></p>
  </div>
</footer>

<!-- ═══ JS ═══ -->
<script>
// FAQ Toggle
document.querySelectorAll('.faq-question').forEach(q => {
  q.addEventListener('click', () => {
    q.parentElement.classList.toggle('open');
  });
});
// Mobile Nav
document.getElementById('hamburger').addEventListener('click', () => {
  const m = document.getElementById('navMenu');
  m.style.display = m.style.display === 'flex' ? 'none' : 'flex';
  m.style.flexDirection = 'column';
  m.style.position = 'absolute';
  m.style.top = '68px';
  m.style.left = '0';
  m.style.right = '0';
  m.style.background = '#0B1F3A';
  m.style.padding = '16px';
  m.style.gap = '4px';
});
// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if(target) { e.preventDefault(); target.scrollIntoView({behavior:'smooth', block:'start'}); }
  });
});
// Navbar scroll effect
window.addEventListener('scroll', () => {
  const nb = document.getElementById('main-navbar');
  nb.style.boxShadow = window.scrollY > 50 ? '0 4px 24px rgba(0,0,0,0.3)' : 'none';
});
</script>
</body>
</html>
