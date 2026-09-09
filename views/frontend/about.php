<?php
/**
 * GoldMatrix — Executive About Us Page
 * International Standard Minimalist & Premium Design
 * Location: views/frontend/about.php
 */
require __DIR__ . '/partials/header.php';

$heroBgClass = 'bg-theme-' . ($about_hero_bg_style ?? 'dark');
?>

<style>
/* ══════════════════════════════════════════════════════
   ABOUT PAGE INTERNATIONAL MINIMALIST STYLING
══════════════════════════════════════════════════════ */
:root {
  --intl-navy: #0A1128;
  --intl-navy-dark: #050B18;
  --intl-gold: #F59E0B;
  --intl-gold-light: #FBBF24;
  --intl-slate-900: #0F172A;
  --intl-slate-800: #1E293B;
  --intl-slate-600: #475569;
  --intl-slate-500: #64748B;
  --intl-slate-200: #E2E8F0;
  --intl-slate-100: #F1F5F9;
  --intl-slate-50: #F8FAFC;
}

/* Hero Section */
.about-hero {
  background-color: var(--intl-navy-dark);
  padding: 130px 5% 80px;
  color: #FFFFFF;
  position: relative;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.about-hero.bg-theme-gradient {
  background: radial-gradient(circle at 50% 0%, #111C3A 0%, var(--intl-navy-dark) 70%);
}
.about-hero.bg-theme-slate {
  background-color: #0F172A;
}
.about-eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  color: var(--intl-gold);
  margin-bottom: 16px;
  display: inline-block;
}
.about-h1 {
  font-size: clamp(2.4rem, 4.5vw, 3.8rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.03em;
  color: #FFFFFF;
  margin-bottom: 20px;
}
.about-hero-sub {
  font-size: 17px;
  line-height: 1.7;
  color: #94A3B8;
  margin-bottom: 34px;
  max-width: 680px;
}

/* Story Section */
.section-about-story {
  background: #FFFFFF;
  padding: 90px 5%;
}
.about-story-badge {
  font-size: 11px;
  font-weight: 700;
  color: var(--intl-gold);
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.about-story-h2 {
  font-size: clamp(1.8rem, 3vw, 2.4rem);
  font-weight: 800;
  color: var(--intl-slate-900);
  line-height: 1.25;
  letter-spacing: -0.02em;
  margin-bottom: 20px;
}
.about-story-text {
  font-size: 15px;
  color: var(--intl-slate-600);
  line-height: 1.8;
  margin-bottom: 18px;
}
.about-story-img-box {
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid var(--intl-slate-200);
  background: var(--intl-slate-50);
  box-shadow: 0 4px 18px rgba(0,0,0,0.06);
}
.about-story-img {
  width: 100%;
  height: 420px;
  object-fit: cover;
  display: block;
}

/* Stats Strip */
.about-stats-sec {
  background: var(--intl-slate-50);
  padding: 60px 5%;
  border-top: 1px solid var(--intl-slate-200);
  border-bottom: 1px solid var(--intl-slate-200);
}
.about-stat-num {
  font-size: clamp(2rem, 3.5vw, 2.8rem);
  font-weight: 900;
  color: var(--intl-slate-900);
  letter-spacing: -0.02em;
  line-height: 1;
  margin-bottom: 6px;
}
.about-stat-lbl {
  font-size: 13.5px;
  color: var(--intl-slate-500);
  font-weight: 600;
}

/* Values Grid */
.section-about-values {
  background: #FFFFFF;
  padding: 90px 5%;
}
.val-card {
  background: #FFFFFF;
  border: 1px solid var(--intl-slate-200);
  border-radius: 12px;
  padding: 32px 26px;
  height: 100%;
  transition: all 0.25s ease;
}
.val-card:hover {
  border-color: #94A3B8;
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}
.val-icon {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: var(--intl-slate-50);
  border: 1px solid var(--intl-slate-200);
  color: var(--intl-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin-bottom: 20px;
}
.val-title {
  font-size: 18px;
  font-weight: 700;
  color: var(--intl-slate-900);
  margin-bottom: 10px;
}
.val-desc {
  font-size: 14px;
  color: var(--intl-slate-600);
  line-height: 1.65;
  margin: 0;
}

/* Timeline */
.section-timeline {
  background: var(--intl-slate-50);
  padding: 90px 5%;
  border-top: 1px solid var(--intl-slate-200);
}
.tm-card {
  background: #FFFFFF;
  border: 1px solid var(--intl-slate-200);
  border-radius: 12px;
  padding: 28px 24px;
  height: 100%;
  transition: all 0.25s ease;
}
.tm-card:hover {
  border-color: #94A3B8;
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}
.tm-year {
  font-size: 24px;
  font-weight: 800;
  color: var(--intl-gold);
  margin-bottom: 8px;
  line-height: 1;
}
.tm-title {
  font-size: 16px;
  font-weight: 700;
  color: var(--intl-slate-900);
  margin-bottom: 8px;
}
.tm-desc {
  font-size: 13.5px;
  color: var(--intl-slate-600);
  line-height: 1.6;
  margin: 0;
}

/* Locations */
.section-locations {
  background: #FFFFFF;
  padding: 90px 5%;
  border-top: 1px solid var(--intl-slate-200);
}
.loc-card {
  background: #FFFFFF;
  border: 1px solid var(--intl-slate-200);
  border-radius: 14px;
  padding: 34px 28px;
  height: 100%;
}
.loc-badge {
  font-size: 11px;
  font-weight: 700;
  color: var(--intl-gold);
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 8px;
}
.loc-title {
  font-size: 20px;
  font-weight: 800;
  color: var(--intl-slate-900);
  margin-bottom: 16px;
}
.loc-detail-row {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  font-size: 14px;
  color: var(--intl-slate-600);
  line-height: 1.6;
  margin-bottom: 12px;
}
.loc-detail-row i {
  color: var(--intl-slate-900);
  font-size: 16px;
  margin-top: 3px;
}
.loc-detail-row a {
  color: var(--intl-slate-900);
  text-decoration: none;
  font-weight: 600;
}
.loc-detail-row a:hover {
  color: var(--intl-gold);
}

/* Bottom CTA */
.about-bottom-cta {
  background: var(--intl-navy-dark);
  padding: 85px 5%;
  color: #FFFFFF;
  text-align: center;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}
.btn-intl-primary {
  background-color: #FBBF24;
  color: #0F172A;
  font-weight: 700;
  font-size: 14.5px;
  padding: 13px 28px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border: 1px solid #FBBF24;
  transition: all 0.15s ease-in-out;
}
.btn-intl-primary:hover {
  background-color: #F59E0B;
  color: #0F172A;
  transform: translateY(-2px);
}
.btn-intl-secondary {
  background: rgba(255, 255, 255, 0.08);
  color: #FFFFFF;
  font-weight: 600;
  font-size: 14.5px;
  padding: 13px 26px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border: 1px solid rgba(255, 255, 255, 0.15);
  transition: all 0.2s ease;
}
.btn-intl-secondary:hover {
  background: rgba(255, 255, 255, 0.14);
  color: #FFFFFF;
  transform: translateY(-2px);
}
</style>

<!-- ══════════════════════════════════════════════════
     1. HERO BANNER
══════════════════════════════════════════════════ -->
<?php if (($about_hero_enabled ?? '1') === '1'): ?>
<section class="about-hero <?= $heroBgClass ?>">
  <div class="container" style="max-width: 1000px; text-align:center;">
    
    <?php if (!empty($about_hero_eyebrow)): ?>
      <div class="about-eyebrow"><?= e($about_hero_eyebrow) ?></div>
    <?php endif; ?>

    <h1 class="about-h1">
      <?= e($about_hero_title ?? 'Powering the Global Jewellery Industry with Next-Gen ERP') ?>
    </h1>

    <?php if (!empty($about_hero_sub)): ?>
      <p class="about-hero-sub mx-auto">
        <?= nl2br(e($about_hero_sub)) ?>
      </p>
    <?php endif; ?>

    <div class="d-flex flex-wrap align-items-center justify-content-center gap-3">
      <a href="/contact" class="btn-intl-primary">
        <span>Connect with Our Team</span>
        <i class="bi bi-arrow-right"></i>
      </a>
      <a href="/features" class="btn-intl-secondary">
        <span>Explore All 10 Features</span>
      </a>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     2. WHO WE ARE & OUR STORY
══════════════════════════════════════════════════ -->
<?php if (($about_story_enabled ?? '1') === '1'): ?>
<section class="section-about-story">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <?php if (!empty($about_story_badge)): ?>
          <div class="about-story-badge"><?= e($about_story_badge) ?></div>
        <?php endif; ?>

        <h2 class="about-story-h2">
          <?= e($about_story_title ?? 'Engineered Exclusively for the Intricacies of Gold & Diamond Commerce') ?>
        </h2>

        <?php if (!empty($about_story_p1)): ?>
          <p class="about-story-text">
            <?= nl2br(e($about_story_p1)) ?>
          </p>
        <?php endif; ?>

        <?php if (!empty($about_story_p2)): ?>
          <p class="about-story-text">
            <?= nl2br(e($about_story_p2)) ?>
          </p>
        <?php endif; ?>
      </div>

      <div class="col-lg-6">
        <div class="about-story-img-box">
          <img src="<?= e($about_story_image ?? 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=1000&auto=format&fit=crop&q=80') ?>" alt="GoldMatrix Team & Infrastructure" class="about-story-img" loading="lazy">
        </div>
      </div>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     3. KEY STATS STRIP
══════════════════════════════════════════════════ -->
<?php if (($about_stats_enabled ?? '1') === '1' && !empty($stats) && is_array($stats)): ?>
<section class="about-stats-sec">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    <div class="row g-4 text-center">
      <?php foreach ($stats as $st): ?>
        <div class="col-lg-3 col-6">
          <div class="about-stat-num"><?= e($st['num']) ?></div>
          <div class="about-stat-lbl"><?= e($st['label']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     4. CORE VALUES
══════════════════════════════════════════════════ -->
<?php if (($about_values_enabled ?? '1') === '1' && !empty($values) && is_array($values)): ?>
<section class="section-about-values">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <?php if (!empty($about_values_badge)): ?>
        <div class="about-story-badge"><?= e($about_values_badge) ?></div>
      <?php endif; ?>
      <h2 class="about-story-h2 mb-0"><?= e($about_values_title ?? 'What Guides Our Product Engineering') ?></h2>
    </div>

    <div class="row g-4">
      <?php foreach ($values as $v): ?>
        <div class="col-lg-3 col-md-6">
          <div class="val-card">
            <div class="val-icon">
              <i class="bi <?= e($v['icon'] ?? 'bi-stars') ?>"></i>
            </div>
            <h3 class="val-title"><?= e($v['title']) ?></h3>
            <p class="val-desc"><?= e($v['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     5. TIMELINE / MILESTONES
══════════════════════════════════════════════════ -->
<?php if (($about_timeline_enabled ?? '1') === '1' && !empty($timeline) && is_array($timeline)): ?>
<section class="section-timeline">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <?php if (!empty($about_timeline_badge)): ?>
        <div class="about-story-badge"><?= e($about_timeline_badge) ?></div>
      <?php endif; ?>
      <h2 class="about-story-h2 mb-0"><?= e($about_timeline_title ?? '15 Years of Domain Leadership') ?></h2>
    </div>

    <div class="row g-4">
      <?php foreach ($timeline as $tm): ?>
        <div class="col-lg-3 col-md-6">
          <div class="tm-card">
            <div class="tm-year"><?= e($tm['year']) ?></div>
            <h3 class="tm-title"><?= e($tm['title']) ?></h3>
            <p class="tm-desc"><?= e($tm['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     6. GLOBAL HUBS (UAE & INDIA)
══════════════════════════════════════════════════ -->
<?php if (($about_hubs_enabled ?? '1') === '1'): ?>
<section class="section-locations">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <?php if (!empty($about_hubs_badge)): ?>
        <div class="about-story-badge"><?= e($about_hubs_badge) ?></div>
      <?php endif; ?>
      <h2 class="about-story-h2 mb-0"><?= e($about_hubs_title ?? 'Operating Across Key Jewellery Capitals') ?></h2>
    </div>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="loc-card">
          <div class="loc-badge">INTERNATIONAL HEADQUARTER</div>
          <h3 class="loc-title">Sharjah, UAE</h3>
          <div class="loc-detail-row">
            <i class="bi bi-geo-alt"></i>
            <span><?= e(setting('contact_uae_address', 'Shop No. 25/A, Central Gold Souq Block No. 8, Al Majaz -1 King Faisal Road - Sharjah, UAE')) ?></span>
          </div>
          <div class="loc-detail-row">
            <i class="bi bi-telephone"></i>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', setting('contact_uae_phone', '+971 56 324 0319')) ?>"><?= e(setting('contact_uae_phone', '+971 56 324 0319')) ?></a>
          </div>
          <div class="loc-detail-row">
            <i class="bi bi-envelope"></i>
            <a href="mailto:<?= e(setting('contact_uae_email', 'info@goldmatrixsoftware.com')) ?>"><?= e(setting('contact_uae_email', 'info@goldmatrixsoftware.com')) ?></a>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="loc-card">
          <div class="loc-badge">DEVELOPMENT &amp; TECH HUB</div>
          <h3 class="loc-title">Maharashtra, India</h3>
          <div class="loc-detail-row">
            <i class="bi bi-building"></i>
            <span><?= e(setting('contact_india_address', 'India, 01/A, Hingna Rd, M.I.D.C, Maharashtra - 440022')) ?></span>
          </div>
          <div class="loc-detail-row">
            <i class="bi bi-telephone"></i>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', setting('contact_india_phone', '+91 92703 69937')) ?>"><?= e(setting('contact_india_phone', '+91 92703 69937')) ?></a>
          </div>
          <div class="loc-detail-row">
            <i class="bi bi-envelope"></i>
            <a href="mailto:<?= e(setting('contact_india_email', 'goldmatrixsoftware@gmail.com')) ?>"><?= e(setting('contact_india_email', 'goldmatrixsoftware@gmail.com')) ?></a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     7. BOTTOM CONVERSION CTA
══════════════════════════════════════════════════ -->
<?php if (($about_cta_enabled ?? '1') === '1'): ?>
<section class="about-bottom-cta">
  <div class="container" style="max-width: 850px;">
    <h2 class="h2 fw-bold text-white mb-3"><?= e($about_cta_title ?? 'Ready to Modernize Your Jewellery Operations?') ?></h2>
    <?php if (!empty($about_cta_desc)): ?>
      <p class="text-white-50 fs-16 mb-4 max-w-600 mx-auto"><?= nl2br(e($about_cta_desc)) ?></p>
    <?php endif; ?>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <a href="<?= e($about_cta_btn1_link ?? '/contact') ?>" class="btn-intl-primary">
        <span><?= e($about_cta_btn1_text ?? 'Schedule Executive Demo') ?></span>
        <i class="bi bi-arrow-right"></i>
      </a>
      <?php if (!empty($about_cta_btn2_text)): ?>
        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $about_cta_whatsapp ?? '919270369937') ?>" target="_blank" class="btn-intl-secondary">
          <i class="bi bi-whatsapp text-success me-1"></i>
          <span><?= e($about_cta_btn2_text) ?></span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
require __DIR__ . '/partials/footer.php';
?>
