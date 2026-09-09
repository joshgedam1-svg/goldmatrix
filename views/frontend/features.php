<?php
/**
 * GoldMatrix — Enterprise Features Overview (Pillar Page)
 * 10 Core ERP Modules Architecture
 * Location: views/frontend/features.php
 */
require __DIR__ . '/partials/header.php';

$heroBgClass = 'bg-theme-' . ($hero_bg_style ?? 'navy');
?>

<style>
/* ══════════════════════════════════════════════════════
   ENTERPRISE FEATURES PILLAR PAGE DESIGN
   - Clean Bootstrap 5 Architecture
   - Solid Corporate Colors (No Gradients, No Glow)
   - Crisp Borders & High Legibility
══════════════════════════════════════════════════════ */
:root {
  --gm-navy: #0F172A;
  --gm-navy-sub: #1E293B;
  --gm-gold: #D97706;
  --gm-gold-hover: #B45309;
  --gm-gold-bg: #FEF3C7;
  --gm-gold-text: #92400E;
  --gm-slate-900: #0F172A;
  --gm-slate-700: #334155;
  --gm-slate-600: #475569;
  --gm-slate-500: #64748B;
  --gm-slate-200: #E2E8F0;
  --gm-slate-100: #F1F5F9;
  --gm-slate-50: #F8FAFC;
}

/* Hero Section */
.feat-hero {
  background-color: var(--gm-navy);
  padding: 120px 5% 70px;
  color: #FFFFFF;
  text-align: center;
  border-bottom: 1px solid var(--gm-navy-sub);
}
.feat-hero.bg-theme-gradient {
  background: radial-gradient(circle at 50% 0%, #1E293B 0%, #0F172A 70%);
}
.feat-hero.bg-theme-slate {
  background-color: #0A1128;
}
.feat-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: #FBBF24;
  background-color: rgba(251, 191, 36, 0.1);
  border: 1px solid rgba(251, 191, 36, 0.25);
  padding: 6px 16px;
  border-radius: 50rem;
  margin-bottom: 20px;
}
.feat-hero-title {
  font-size: clamp(2.2rem, 4vw, 3.2rem);
  font-weight: 800;
  line-height: 1.2;
  color: #FFFFFF;
  margin-bottom: 18px;
  max-width: 900px;
  margin-left: auto;
  margin-right: auto;
}
.feat-hero-title span {
  color: #FBBF24;
}
.feat-hero-desc {
  font-size: 16px;
  color: #94A3B8;
  max-width: 720px;
  margin: 0 auto 32px;
  line-height: 1.7;
}

/* Category Filter Bar */
.feat-filter-wrap {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 8px;
  max-width: 960px;
  margin: 0 auto;
  padding: 8px;
  background-color: var(--gm-navy-sub);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 50rem;
}
.feat-filter-btn {
  background-color: transparent;
  border: 1px solid transparent;
  color: #CBD5E1;
  padding: 8px 20px;
  border-radius: 50rem;
  font-size: 13.5px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.15s ease-in-out;
}
.feat-filter-btn:hover {
  color: #FFFFFF;
  background-color: rgba(255, 255, 255, 0.08);
}
.feat-filter-btn.active {
  background-color: #FBBF24;
  color: #0F172A;
  font-weight: 700;
  border-color: #FBBF24;
}

/* 10 Module Cards Grid */
.feat-grid-section {
  background-color: #FFFFFF;
  padding: 80px 5% 90px;
}
.feat-module-card {
  background-color: #FFFFFF;
  border: 1px solid var(--gm-slate-200);
  border-radius: 12px;
  padding: 28px 24px;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}
.feat-module-card:hover {
  border-color: #94A3B8;
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);
}
.feat-card-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 18px;
}
.feat-icon-box {
  width: 44px;
  height: 44px;
  border-radius: 8px;
  background-color: var(--gm-gold-bg);
  border: 1px solid #FDE68A;
  color: var(--gm-gold-text);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.feat-eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: var(--gm-slate-600);
  background-color: var(--gm-slate-100);
  border: 1px solid var(--gm-slate-200);
  padding: 4px 10px;
  border-radius: 4px;
}
.feat-card-h3 {
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--gm-slate-900);
  margin-bottom: 10px;
  line-height: 1.35;
}
.feat-card-p {
  font-size: 13.5px;
  color: var(--gm-slate-600);
  line-height: 1.6;
  margin-bottom: 18px;
}
.feat-card-bullets {
  list-style: none;
  padding: 0;
  margin: 0 0 22px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  flex-grow: 1;
}
.feat-bullet-item {
  font-size: 13px;
  color: var(--gm-slate-700);
  display: flex;
  align-items: flex-start;
  gap: 8px;
  line-height: 1.45;
}
.feat-bullet-item i {
  color: var(--gm-gold);
  font-size: 14px;
  margin-top: 1px;
  flex-shrink: 0;
}
.feat-card-btn {
  display: inline-flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 9px 16px;
  border-radius: 6px;
  background-color: #FFFFFF;
  border: 1px solid var(--gm-slate-200);
  color: var(--gm-slate-900);
  font-size: 13.5px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.15s ease-in-out;
  margin-top: auto;
}
.feat-card-btn:hover {
  background-color: var(--gm-navy);
  color: #FFFFFF;
  border-color: var(--gm-navy);
}
.feat-card-btn:hover i {
  color: #FBBF24;
}

/* Hardware Ecosystem Bar */
.feat-hardware-sec {
  background-color: var(--gm-slate-50);
  padding: 65px 5%;
  border-top: 1px solid var(--gm-slate-200);
  border-bottom: 1px solid var(--gm-slate-200);
}
.hw-box {
  background-color: #FFFFFF;
  border: 1px solid var(--gm-slate-200);
  border-radius: 8px;
  padding: 20px;
  height: 100%;
  transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.hw-box:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.hw-icon {
  font-size: 24px;
  color: var(--gm-navy);
  margin-bottom: 10px;
  display: block;
}
.hw-title {
  font-size: 14.5px;
  font-weight: 700;
  color: var(--gm-slate-900);
  margin-bottom: 4px;
}
.hw-desc {
  font-size: 12.5px;
  color: var(--gm-slate-500);
  line-height: 1.5;
  margin: 0;
}

/* Bottom Conversion Section */
.feat-bottom-cta {
  background-color: var(--gm-navy);
  padding: 75px 5%;
  color: #FFFFFF;
  text-align: center;
  border-top: 1px solid var(--gm-navy-sub);
}
.feat-bottom-cta-h2 {
  font-size: clamp(1.8rem, 3vw, 2.4rem);
  font-weight: 800;
  margin-bottom: 12px;
  color: #FFFFFF;
}
.feat-bottom-cta-p {
  color: #94A3B8;
  font-size: 15.5px;
  max-width: 640px;
  margin: 0 auto 28px;
  line-height: 1.65;
}
</style>

<!-- ══════════════════════════════════════════════════
     SECTION 1: HERO & DYNAMIC MODULE FILTER
══════════════════════════════════════════════════ -->
<?php if (($hero_enabled ?? '1') === '1'): ?>
<section class="feat-hero <?= $heroBgClass ?>">
  <div class="container" style="max-width: 1100px;">
    
    <?php if (!empty($hero_badge)): ?>
    <div class="feat-hero-badge">
      <i class="bi bi-grid-fill me-1"></i>
      <?= e($hero_badge) ?>
    </div>
    <?php endif; ?>
    
    <h1 class="feat-hero-title">
      <?= e($hero_title ?? 'Every Capability Engineered for') ?>
      <?php if (!empty($hero_highlight)): ?>
        <span><?= e($hero_highlight) ?></span>
      <?php endif; ?>
    </h1>

    <?php if (!empty($hero_desc)): ?>
    <p class="feat-hero-desc">
      <?= nl2br(e($hero_desc)) ?>
    </p>
    <?php endif; ?>

    <!-- Category Filter Bar -->
    <?php if (($filter_enabled ?? '1') === '1' && !empty($category_filters)): ?>
    <div class="feat-filter-wrap">
      <?php foreach ($category_filters as $idx => $cFilter): ?>
        <button class="feat-filter-btn <?= $idx === 0 ? 'active' : '' ?>" onclick="filterModules('<?= e($cFilter['tag']) ?>', this)">
          <?= e($cFilter['label']) ?>
        </button>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     SECTION 2: 10 MODULES CARD GRID (3 COLUMNS)
══════════════════════════════════════════════════ -->
<?php if (($grid_enabled ?? '1') === '1'): ?>
<section class="feat-grid-section">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1380px;">
    
    <?php if (!empty($grid_title)): ?>
    <div class="text-center mb-5">
      <h2 class="h3 fw-bold text-dark"><?= e($grid_title) ?></h2>
      <?php if (!empty($grid_subtitle)): ?>
        <p class="text-muted fs-15"><?= e($grid_subtitle) ?></p>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="row g-4" id="modulesGrid">
      <?php 
      $moduleList = !empty($modules) ? $modules : [];
      $moduleIndex = 1;
      foreach ($moduleList as $mSlug => $mod): 
        // Category grouping tags for filter
        $filterTag = 'General';
        if (in_array($mSlug, ['dashboard-live-rates', 'business-opening', 'opening-setup', 'order-management'])) {
          $filterTag = 'Retail & Operations';
        } elseif (in_array($mSlug, ['production'])) {
          $filterTag = 'Manufacturing';
        } elseif (in_array($mSlug, ['operations', 'financial-statement', 'report-analysis'])) {
          $filterTag = 'Finance';
        } elseif (in_array($mSlug, ['stock-management'])) {
          $filterTag = 'Inventory';
        } elseif (in_array($mSlug, ['employee-management', 'settings-admin'])) {
          $filterTag = 'Admin';
        }
      ?>
        <div class="col-lg-4 col-md-6 module-card-col" data-filter="<?= e($filterTag) ?>">
          <div class="feat-module-card">
            
            <div class="feat-card-top">
              <div class="feat-icon-box">
                <i class="bi <?= e($mod['icon'] ?? 'bi-stars') ?>"></i>
              </div>
              <span class="feat-eyebrow"><?= e($mod['badge'] ?? 'MODULE ' . $moduleIndex) ?></span>
            </div>

            <h3 class="feat-card-h3"><?= e($mod['title']) ?></h3>
            <p class="feat-card-p"><?= e($mod['description']) ?></p>

            <ul class="feat-card-bullets">
              <?php foreach (($mod['bullets'] ?? []) as $bullet): ?>
                <li class="feat-bullet-item">
                  <i class="bi bi-check-circle-fill"></i>
                  <span><?= e($bullet) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>

            <a href="/features/<?= e($mod['slug']) ?>" class="feat-card-btn">
              <span>Explore <?= e($mod['title']) ?></span>
              <i class="bi bi-arrow-right"></i>
            </a>

          </div>
        </div>
      <?php 
      $moduleIndex++;
      endforeach; 
      ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     SECTION 3: HARDWARE & SYSTEM COMPATIBILITY
══════════════════════════════════════════════════ -->
<?php if (($hardware_enabled ?? '1') === '1' && !empty($hardware_items) && is_array($hardware_items)): ?>
<section class="feat-hardware-sec">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-4">
      <?php if (!empty($hardware_badge)): ?>
        <div class="text-uppercase fw-bold text-muted small mb-1" style="letter-spacing:1.5px;"><?= e($hardware_badge) ?></div>
      <?php endif; ?>
      <h3 class="h4 fw-bold text-dark mb-0"><?= e($hardware_title ?? 'Certified Compatibility with Showroom & Factory Hardware') ?></h3>
    </div>

    <div class="row g-3">
      <?php foreach ($hardware_items as $hw): ?>
      <div class="col-lg-3 col-md-6">
        <div class="hw-box">
          <i class="bi <?= e($hw['icon'] ?? 'bi-cpu') ?> hw-icon"></i>
          <div class="hw-title"><?= e($hw['title'] ?? '') ?></div>
          <p class="hw-desc"><?= e($hw['desc'] ?? '') ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     SECTION 4: BOTTOM CONVERSION BANNER
══════════════════════════════════════════════════ -->
<?php if (($cta_enabled ?? '1') === '1'): ?>
<section class="feat-bottom-cta">
  <div class="container" style="max-width: 850px;">
    <h2 class="feat-bottom-cta-h2"><?= e($cta_title ?? 'See All 10 Modules in a Live Personalized Demo') ?></h2>
    <?php if (!empty($cta_desc)): ?>
    <p class="feat-bottom-cta-p">
      <?= nl2br(e($cta_desc)) ?>
    </p>
    <?php endif; ?>

    <div class="d-flex flex-wrap justify-content-center gap-3">
      <?php if (!empty($cta_btn1_text)): ?>
        <a href="<?= e($cta_btn1_link ?? '#bookDemoModal') ?>" <?= strpos($cta_btn1_link ?? '', '#') === 0 ? 'data-bs-toggle="modal" data-bs-target="' . e($cta_btn1_link) . '"' : '' ?> class="btn btn-warning text-dark fw-bold px-4 py-3">
          <i class="bi bi-calendar-check-fill me-1"></i> <?= e($cta_btn1_text) ?>
        </a>
      <?php endif; ?>

      <?php if (!empty($cta_btn2_text)): ?>
        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $cta_whatsapp ?? '919270369937') ?>?text=Hello%20GoldMatrix%20Team%2C%20I%20would%20like%20to%20see%20a%20demo%20of%20all%20features" target="_blank" class="btn btn-outline-light fw-semibold px-4 py-3">
          <i class="bi bi-whatsapp text-success me-1"></i> <?= e($cta_btn2_text) ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<script>
function filterModules(category, btn) {
  document.querySelectorAll('.feat-filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  const items = document.querySelectorAll('.module-card-col');
  items.forEach(item => {
    const itemCat = item.getAttribute('data-filter') || '';
    if (category === 'all' || itemCat === category) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}
</script>

<?php require __DIR__ . '/partials/footer.php'; ?>
