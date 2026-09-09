<?php
/**
 * GoldMatrix — Unified Feature Cluster Page Template (7-Section Architecture)
 * Reusable for all 10 Core Modules
 * Location: views/frontend/features/feature-page.php
 */
require __DIR__ . '/../partials/header.php';

$mod = $module ?? [];
$slug = $mod['slug'] ?? '';
$hasTabs = !empty($mod['tabs']);
?>

<style>
/* ══════════════════════════════════════════════════════
   FEATURE CLUSTER PAGE STYLING (7 SECTIONS)
   - Clean Bootstrap 5 Architecture
   - Solid Colors (No Gradients, No Glow Effects)
   - Professional Enterprise B2B SaaS Layout
══════════════════════════════════════════════════════ */
:root {
  --feat-navy: #0F172A;
  --feat-navy-sub: #1E293B;
  --feat-gold: #D97706;
  --feat-gold-hover: #B45309;
  --feat-gold-bg: #FEF3C7;
  --feat-gold-text: #92400E;
  --feat-slate-900: #0F172A;
  --feat-slate-700: #334155;
  --feat-slate-600: #475569;
  --feat-slate-500: #64748B;
  --feat-slate-200: #E2E8F0;
  --feat-slate-100: #F1F5F9;
  --feat-slate-50: #F8FAFC;
}

/* Section 1: Hero */
.clust-hero {
  background-color: var(--feat-navy);
  padding: 120px 5% 70px;
  position: relative;
  border-bottom: 1px solid var(--feat-navy-sub);
}
.clust-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  color: #94A3B8;
  margin-bottom: 20px;
}
.clust-breadcrumb a {
  color: #94A3B8;
  text-decoration: none;
  transition: color 0.15s ease;
}
.clust-breadcrumb a:hover {
  color: #FFFFFF;
}
.clust-breadcrumb-sep {
  color: #475569;
}
.clust-breadcrumb-cur {
  color: #FBBF24;
  font-weight: 600;
}
.clust-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background-color: rgba(251, 191, 36, 0.1);
  color: #FBBF24;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 6px 14px;
  border-radius: 50rem;
  border: 1px solid rgba(251, 191, 36, 0.25);
  margin-bottom: 18px;
}
.clust-h1 {
  font-size: clamp(2rem, 3.8vw, 3.1rem);
  font-weight: 800;
  color: #FFFFFF;
  line-height: 1.2;
  margin-bottom: 16px;
  max-width: 920px;
}
.clust-h2-sub {
  font-size: 18px;
  font-weight: 600;
  color: #CBD5E1;
  margin-bottom: 16px;
  max-width: 850px;
  line-height: 1.5;
}
.clust-desc {
  font-size: 15.5px;
  color: #94A3B8;
  max-width: 780px;
  line-height: 1.75;
  margin-bottom: 32px;
}

/* Section 2: Feature Detail Grid & Interactive Sub-Tabs */
.clust-detail-sec {
  background-color: #FFFFFF;
  padding: 80px 5% 90px;
}
.clust-sec-header {
  text-align: center;
  margin-bottom: 48px;
}
.clust-sec-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background-color: var(--feat-gold-bg);
  color: var(--feat-gold-text);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 5px 14px;
  border-radius: 50rem;
  border: 1px solid #FDE68A;
  margin-bottom: 12px;
}
.clust-sec-h2 {
  font-size: clamp(1.7rem, 2.8vw, 2.3rem);
  font-weight: 800;
  color: var(--feat-slate-900);
  margin: 0;
}

/* Tabs Navigation for Stock Management */
.clust-tabs-nav {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 8px;
  max-width: 980px;
  margin: 0 auto 40px;
  padding: 6px;
  background-color: var(--feat-slate-50);
  border: 1px solid var(--feat-slate-200);
  border-radius: 50rem;
}
.clust-tab-btn {
  background-color: transparent;
  border: 1px solid transparent;
  color: var(--feat-slate-600);
  padding: 9px 20px;
  border-radius: 50rem;
  font-size: 13.5px;
  font-weight: 600;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.15s ease-in-out;
}
.clust-tab-btn:hover {
  color: var(--feat-slate-900);
  background-color: rgba(0,0,0,0.04);
}
.clust-tab-btn.active {
  background-color: #0F172A;
  color: #FFFFFF;
  font-weight: 700;
  border-color: #0F172A;
}

.clust-tab-pane {
  display: none;
}
.clust-tab-pane.active {
  display: block;
}

/* Sub-Feature Card */
.subfeat-card {
  background-color: #FFFFFF;
  border: 1px solid var(--feat-slate-200);
  border-radius: 10px;
  padding: 26px 22px;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}
.subfeat-card:hover {
  border-color: #94A3B8;
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);
}
.subfeat-icon-box {
  width: 42px;
  height: 42px;
  border-radius: 8px;
  background-color: var(--feat-gold-bg);
  border: 1px solid #FDE68A;
  color: var(--feat-gold-text);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 19px;
  margin-bottom: 16px;
}
.subfeat-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--feat-slate-900);
  margin-bottom: 8px;
}
.subfeat-desc {
  font-size: 13.5px;
  color: var(--feat-slate-600);
  line-height: 1.6;
  margin-bottom: 16px;
}
.subfeat-points {
  list-style: none;
  padding: 0;
  margin: auto 0 0;
  display: flex;
  flex-direction: column;
  gap: 7px;
  padding-top: 14px;
  border-top: 1px solid var(--feat-slate-100);
}
.subfeat-point-item {
  font-size: 12.5px;
  color: var(--feat-slate-700);
  display: flex;
  align-items: baseline;
  gap: 8px;
  line-height: 1.45;
}
.subfeat-point-item i {
  color: var(--feat-gold);
  font-size: 12px;
  flex-shrink: 0;
}

/* Section 3: Alternating Visual Showcase */
.clust-visual-sec {
  background-color: var(--feat-slate-50);
  padding: 80px 5%;
  border-top: 1px solid var(--feat-slate-200);
  border-bottom: 1px solid var(--feat-slate-200);
}
.clust-visual-frame {
  background-color: #FFFFFF;
  border: 1px solid var(--feat-slate-200);
  border-radius: 12px;
  padding: 12px;
  box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
}
.clust-visual-img {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 8px;
  object-fit: cover;
}

/* Section 4: "Who It's For" Persona Callout */
.clust-persona-sec {
  background-color: #FFFFFF;
  padding: 65px 5%;
}
.clust-persona-box {
  background-color: var(--feat-slate-50);
  border: 1px solid var(--feat-slate-200);
  border-left: 4px solid var(--feat-gold);
  border-radius: 8px;
  padding: 32px 28px;
  max-width: 1100px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  gap: 24px;
}
.clust-persona-icon {
  width: 52px;
  height: 52px;
  border-radius: 10px;
  background-color: var(--feat-gold-bg);
  border: 1px solid #FDE68A;
  color: var(--feat-gold-text);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  flex-shrink: 0;
}
.clust-persona-title {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: var(--feat-gold-text);
  margin-bottom: 4px;
}
.clust-persona-h3 {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--feat-slate-900);
  margin-bottom: 8px;
}
.clust-persona-desc {
  font-size: 14px;
  color: var(--feat-slate-600);
  line-height: 1.65;
  margin: 0;
}

/* Section 5: FAQ Accordion */
.clust-faq-sec {
  background-color: var(--feat-slate-50);
  padding: 80px 5%;
  border-top: 1px solid var(--feat-slate-200);
}
.clust-faq-wrap {
  max-width: 850px;
  margin: 0 auto;
}
.clust-faq-item {
  background-color: #FFFFFF;
  border: 1px solid var(--feat-slate-200);
  border-radius: 8px;
  margin-bottom: 10px;
  overflow: hidden;
}
.clust-faq-item:hover {
  border-color: #CBD5E1;
}
.clust-faq-header {
  padding: 16px 20px;
  font-size: 15px;
  font-weight: 700;
  color: var(--feat-slate-900);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.clust-faq-header i {
  font-size: 14px;
  color: var(--feat-gold);
  transition: transform 0.2s ease;
}
.clust-faq-item.open .clust-faq-header i {
  transform: rotate(180deg);
}
.clust-faq-body {
  padding: 0 20px 16px;
  font-size: 14px;
  color: var(--feat-slate-600);
  line-height: 1.7;
  display: none;
}
.clust-faq-item.open .clust-faq-body {
  display: block;
}

/* Section 6: Related Features */
.clust-related-sec {
  background-color: #FFFFFF;
  padding: 75px 5%;
  border-top: 1px solid var(--feat-slate-200);
}
.related-mod-card {
  background-color: #FFFFFF;
  border: 1px solid var(--feat-slate-200);
  border-radius: 8px;
  padding: 22px;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: transform 0.15s ease, border-color 0.15s ease;
  text-decoration: none;
  color: inherit;
}
.related-mod-card:hover {
  border-color: #94A3B8;
  transform: translateY(-2px);
}
.related-mod-title {
  font-size: 15px;
  font-weight: 700;
  color: var(--feat-slate-900);
  margin-bottom: 6px;
}
.related-mod-desc {
  font-size: 13px;
  color: var(--feat-slate-500);
  line-height: 1.55;
  margin-bottom: 14px;
}
.related-mod-link {
  font-size: 13px;
  font-weight: 600;
  color: var(--feat-gold);
  display: inline-flex;
  align-items: center;
  gap: 4px;
  margin-top: auto;
}

/* Section 7: Bottom CTA Banner */
.clust-bottom-cta {
  background-color: var(--feat-navy);
  padding: 75px 5%;
  color: #FFFFFF;
  text-align: center;
  border-top: 1px solid var(--feat-navy-sub);
}
.clust-bottom-cta-h2 {
  font-size: clamp(1.8rem, 3vw, 2.4rem);
  font-weight: 800;
  margin-bottom: 12px;
  color: #FFFFFF;
}
.clust-bottom-cta-p {
  color: #94A3B8;
  font-size: 15.5px;
  max-width: 640px;
  margin: 0 auto 28px;
  line-height: 1.65;
}
</style>

<!-- ══════════════════════════════════════════════════
     SECTION 1: HERO & BREADCRUMB
══════════════════════════════════════════════════ -->
<section class="clust-hero">
  <div class="container" style="max-width: 1100px;">
    
    <!-- Breadcrumb -->
    <div class="clust-breadcrumb">
      <a href="/">Home</a>
      <span class="clust-breadcrumb-sep">/</span>
      <a href="/features">Features</a>
      <span class="clust-breadcrumb-sep">/</span>
      <span class="clust-breadcrumb-cur"><?= e($mod['title'] ?? 'Module') ?></span>
    </div>

    <!-- Badge -->
    <div class="clust-badge">
      <i class="bi <?= e($mod['icon'] ?? 'bi-gear-fill') ?> me-1"></i>
      <?= e($mod['badge'] ?? 'ENTERPRISE CAPABILITY') ?>
    </div>

    <!-- H1 Title -->
    <h1 class="clust-h1">
      <?= e($mod['h1'] ?? $mod['title']) ?>
    </h1>

    <!-- H2 Subheading -->
    <?php if (!empty($mod['h2'])): ?>
      <div class="clust-h2-sub">
        <?= e($mod['h2']) ?>
      </div>
    <?php endif; ?>

    <!-- Intro Description -->
    <p class="clust-desc">
      <?= e($mod['intro'] ?? $mod['description'] ?? '') ?>
    </p>

    <!-- Hero CTA Buttons -->
    <div class="d-flex flex-wrap gap-3">
      <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-warning text-dark fw-bold px-4 py-3">
        <i class="bi bi-calendar-check-fill me-1"></i> Book Live Module Demo
      </a>
      <a href="https://wa.me/919270369937?text=Hello%20GoldMatrix%20Team%2C%20I%20want%20to%20know%20more%20about%20<?= urlencode($mod['title'] ?? 'this feature') ?>" target="_blank" class="btn btn-outline-light fw-semibold px-4 py-3">
        <i class="bi bi-whatsapp text-success me-1"></i> Chat with Specialist
      </a>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 2: FEATURE DETAIL GRID & SUB-TABS
══════════════════════════════════════════════════ -->
<section class="clust-detail-sec" id="features">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1360px;">
    
    <div class="clust-sec-header">
      <div class="clust-sec-eyebrow">
        <i class="bi bi-cpu-fill"></i>
        CORE CAPABILITIES
      </div>
      <h2 class="clust-sec-h2">
        Engineered Specifically for <?= e($mod['title']) ?>
      </h2>
    </div>

    <?php if ($hasTabs): ?>
      <!-- 4 Interactive Sub-Tabs for Stock Management -->
      <div class="clust-tabs-nav">
        <?php foreach ($mod['tabs'] as $tIndex => $tab): ?>
          <button class="clust-tab-btn <?= $tIndex === 0 ? 'active' : '' ?>" onclick="switchTab('<?= e($tab['id']) ?>', this)">
            <i class="bi <?= e($tab['icon'] ?? 'bi-folder-fill') ?>"></i>
            <span><?= e($tab['label']) ?></span>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- Tab Panes -->
      <?php foreach ($mod['tabs'] as $tIndex => $tab): ?>
        <div class="clust-tab-pane <?= $tIndex === 0 ? 'active' : '' ?>" id="tab-<?= e($tab['id']) ?>">
          <div class="row g-4">
            <?php foreach (($tab['sub_features'] ?? []) as $feat): ?>
              <div class="col-lg-3 col-md-6">
                <div class="subfeat-card">
                  <div class="subfeat-icon-box">
                    <i class="bi <?= e($feat['icon'] ?? 'bi-check-circle') ?>"></i>
                  </div>
                  <h3 class="subfeat-title"><?= e($feat['title']) ?></h3>
                  <p class="subfeat-desc"><?= e($feat['desc']) ?></p>
                  
                  <?php if (!empty($feat['points'])): ?>
                    <ul class="subfeat-points">
                      <?php foreach ($feat['points'] as $pt): ?>
                        <li class="subfeat-point-item">
                          <i class="bi bi-check-circle-fill"></i>
                          <span><?= e($pt) ?></span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>

    <?php else: ?>
      <!-- Standard Sub-Features Grid (For Modules 1 to 8 & 10) -->
      <div class="row g-4">
        <?php foreach (($mod['sub_features'] ?? []) as $feat): ?>
          <div class="col-lg-4 col-md-6">
            <div class="subfeat-card">
              <div class="subfeat-icon-box">
                <i class="bi <?= e($feat['icon'] ?? 'bi-check2-circle') ?>"></i>
              </div>
              <h3 class="subfeat-title"><?= e($feat['title']) ?></h3>
              <p class="subfeat-desc"><?= e($feat['desc']) ?></p>

              <?php if (!empty($feat['points'])): ?>
                <ul class="subfeat-points">
                  <?php foreach ($feat['points'] as $pt): ?>
                    <li class="subfeat-point-item">
                      <i class="bi bi-check-circle-fill"></i>
                      <span><?= e($pt) ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 3: ALTERNATING VISUAL / SCREENSHOT SHOWCASE
══════════════════════════════════════════════════ -->
<section class="clust-visual-sec">
  <div class="container" style="max-width: 1200px;">
    
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="clust-sec-eyebrow">
          <i class="bi bi-display"></i>
          LIVE INTERFACE PREVIEW
        </div>
        <h2 class="h3 fw-bold text-dark mb-3">
          <?= e($mod['visual_title'] ?? 'Designed for High-Speed Showroom & Factory Operations') ?>
        </h2>
        <p class="text-muted mb-4" style="line-height:1.7;">
          <?= e($mod['visual_desc'] ?? 'Experience intuitive data entry, real-time calculation feeds, and instant search designed specifically for jewellery personnel.') ?>
        </p>

        <?php if (!empty($mod['visual_points'])): ?>
          <ul class="list-unstyled d-flex flex-column gap-3 mb-4">
            <?php foreach ($mod['visual_points'] as $vPoint): ?>
              <li class="d-flex align-items-start gap-3">
                <div class="badge bg-warning text-dark p-2 rounded-2 mt-1">
                  <i class="bi bi-check2"></i>
                </div>
                <span class="text-dark fw-medium" style="font-size:14.5px;"><?= e($vPoint) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-outline-dark fw-semibold px-4 py-2">
          Request Interface Walkthrough <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>

      <div class="col-lg-6">
        <div class="clust-visual-frame">
          <img src="<?= e($mod['visual_image'] ?? 'https://goldmatrixsoftware.com/wp-content/uploads/2026/02/imgi_53_erp-mockup01.png') ?>" 
               alt="<?= e($mod['title']) ?> Software Interface" 
               class="clust-visual-img" 
               loading="lazy">
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 4: WHO IT'S FOR (TARGET PERSONA CALLOUT)
══════════════════════════════════════════════════ -->
<section class="clust-persona-sec">
  <div class="container" style="max-width: 1100px;">
    <div class="clust-persona-box">
      <div class="clust-persona-icon">
        <i class="bi bi-building-check"></i>
      </div>
      <div>
        <div class="clust-persona-title">BUILT SPECIFICALLY FOR</div>
        <h3 class="clust-persona-h3"><?= e($mod['target_persona'] ?? 'Jewellery Businesses') ?></h3>
        <p class="clust-persona-desc"><?= e($mod['persona_desc'] ?? '') ?></p>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 5: FAQ ACCORDION (4 Q&AS)
══════════════════════════════════════════════════ -->
<?php if (!empty($mod['faqs'])): ?>
<section class="clust-faq-sec">
  <div class="container" style="max-width: 850px;">
    
    <div class="text-center mb-4">
      <div class="clust-sec-eyebrow">
        <i class="bi bi-patch-question-fill"></i>
        FREQUENTLY ASKED QUESTIONS
      </div>
      <h2 class="h3 fw-bold text-dark">
        Questions About <?= e($mod['title']) ?>
      </h2>
    </div>

    <div class="clust-faq-wrap">
      <?php foreach ($mod['faqs'] as $fIndex => $faq): ?>
        <div class="clust-faq-item <?= $fIndex === 0 ? 'open' : '' ?>">
          <div class="clust-faq-header" onclick="toggleFaq(this)">
            <span><?= e($faq['q']) ?></span>
            <i class="bi bi-chevron-down"></i>
          </div>
          <div class="clust-faq-body">
            <?= e($faq['a']) ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     SECTION 6: RELATED MODULES
══════════════════════════════════════════════════ -->
<?php if (!empty($related_modules)): ?>
<section class="clust-related-sec">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1280px;">
    
    <div class="d-flex align-items-center justify-content-between mb-4">
      <div>
        <div class="text-uppercase fw-bold text-muted small" style="letter-spacing:1px;">CONNECTED ERP CAPABILITIES</div>
        <h3 class="h4 fw-bold text-dark mb-0">Explore Related Modules</h3>
      </div>
      <a href="/features" class="btn btn-outline-secondary btn-sm fw-semibold">
        View All 10 Modules <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </div>

    <div class="row g-4">
      <?php foreach ($related_modules as $relMod): ?>
        <div class="col-lg-4 col-md-6">
          <a href="/features/<?= e($relMod['slug']) ?>" class="related-mod-card">
            <div class="d-flex align-items-center gap-2 mb-2">
              <i class="bi <?= e($relMod['icon'] ?? 'bi-stars') ?> text-warning"></i>
              <span class="badge bg-light text-dark border"><?= e($relMod['badge'] ?? 'MODULE') ?></span>
            </div>
            <h4 class="related-mod-title"><?= e($relMod['title']) ?></h4>
            <p class="related-mod-desc"><?= e($relMod['description']) ?></p>
            <div class="related-mod-link">
              <span>Learn More</span>
              <i class="bi bi-arrow-right"></i>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     SECTION 7: BOTTOM CONVERSION BANNER
══════════════════════════════════════════════════ -->
<section class="clust-bottom-cta">
  <div class="container" style="max-width: 850px;">
    <h2 class="clust-bottom-cta-h2">
      Ready to Experience <?= e($mod['title']) ?> in Action?
    </h2>
    <p class="clust-bottom-cta-p">
      Join 1,500+ jewellery businesses who have simplified operations and eliminated errors with GoldMatrix ERP.
    </p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-warning text-dark fw-bold px-4 py-3">
        <i class="bi bi-calendar-check-fill me-1"></i> Request Free 1-on-1 Demo
      </a>
      <a href="https://wa.me/919270369937?text=Hello%20GoldMatrix%20Team%2C%20I%20would%20like%20a%20demo%20of%20<?= urlencode($mod['title'] ?? 'ERP') ?>" target="_blank" class="btn btn-outline-light fw-semibold px-4 py-3">
        <i class="bi bi-whatsapp text-success me-1"></i> Contact via WhatsApp
      </a>
    </div>
  </div>
</section>

<script>
function switchTab(tabId, btn) {
  document.querySelectorAll('.clust-tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  document.querySelectorAll('.clust-tab-pane').forEach(p => p.classList.remove('active'));
  const target = document.getElementById('tab-' + tabId);
  if (target) {
    target.classList.add('active');
  }
}

function toggleFaq(header) {
  const item = header.parentElement;
  item.classList.toggle('open');
}
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
