<?php
/**
 * GoldMatrix — International Standard About Us Page
 * Structure: Company First, Technology Second (13 Clean Sections)
 * Dynamic CMS: 100% Editable via Admin (/admin/about-settings)
 * Location: views/frontend/about.php
 */
require __DIR__ . '/partials/header.php';

// Decode JSON repeaters from DB settings with fallback defaults
$defaultJourney = [
  ['phase' => 'PHASE 01', 'title' => 'Experience', 'desc' => 'Direct engagement with jewellery merchants, retailers and bullion counters.'],
  ['phase' => 'PHASE 02', 'title' => 'Industry Understanding', 'desc' => 'Deep mastering of Karigar jobwork, metal purities, stone calculations and retail workflows.'],
  ['phase' => 'PHASE 03', 'title' => 'Software Evolution', 'desc' => 'Purpose-built cloud software bringing inventory, sales, RFID and accounting together.'],
  ['phase' => 'PHASE 04', 'title' => 'Global Growth', 'desc' => 'Expanding across international jewellery capitals with continuous product refinement.']
];
$journeyItems = json_decode(setting('about_journey_items', ''), true) ?: $defaultJourney;

$defaultSolutions = [
  ['icon' => 'bi-speedometer2', 'title' => 'Dashboards & Live Rates', 'desc' => 'Role-based command centers with real-time 24K, 22K, 18K and 925 silver market ticker synchronization.'],
  ['icon' => 'bi-box-seam', 'title' => 'Opening & Financial Ledgers', 'desc' => 'Foundational stock baselines, dual gold-and-rupee account ledgers, and automated multi-bank reconciliation.'],
  ['icon' => 'bi-currency-exchange', 'title' => 'Operations & Metal Accounting', 'desc' => 'Unified financial core for bullion trade, pledge settlements, and bidirectional metal-to-rupee conversions.'],
  ['icon' => 'bi-cart-check', 'title' => 'Order Management & Custom Orders', 'desc' => 'Custom bridal order tracking, repair jobs, CAD design quotations, and automated customer WhatsApp updates.'],
  ['icon' => 'bi-tools', 'title' => 'Manufacturing & Karigar Loss Tracking', 'desc' => 'Departmental workshop WIP (Casting, Setting, Polishing), Karigar queues, and milligram-precision metal loss audits.'],
  ['icon' => 'bi-receipt-cutoff', 'title' => 'Financial Statements & Tax Compliance', 'desc' => 'Live Balance Sheets, Profit & Loss, Trial Balance drill-downs, and automated GST, E-Invoice and E-Way Bill exports.'],
  ['icon' => 'bi-bar-chart-line', 'title' => 'Report Analysis & BI Intelligence', 'desc' => '100+ granular business reports, customer KYC, debtor ageing analysis, Karatwise P&L, and full audit logs.'],
  ['icon' => 'bi-layers', 'title' => 'Inventory & RFID Stock Management', 'desc' => 'High-speed UHF RFID showcase audits, precious stone & purity tracking, approval memos, and vault transfers.'],
  ['icon' => 'bi-people', 'title' => 'Employee & Workforce Management', 'desc' => 'Granular role permissions, counter sales targets, making-charge incentive formulas, and attendance logs.'],
  ['icon' => 'bi-translate', 'title' => 'Multi-Language Support & Global Admin', 'desc' => 'Native internationalization across English, Arabic, Hindi, and regional languages with multi-currency and security controls.']
];
$solutionsItems = json_decode(setting('about_solutions_items', ''), true) ?: $defaultSolutions;

$defaultHowWeWork = [
  ['num' => '1', 'title' => 'Understand', 'desc' => 'We understand your business processes and operational requirements.'],
  ['num' => '2', 'title' => 'Implement', 'desc' => 'We configure solutions around your jewellery business workflows.'],
  ['num' => '3', 'title' => 'Support', 'desc' => 'We continue to support your business as your operations grow.']
];
$howWeWorkSteps = json_decode(setting('about_howwework_steps', ''), true) ?: $defaultHowWeWork;

$defaultBuiltFor = [
  ['title' => 'Retail Showroom', 'desc' => 'POS, barcode and counter sales', 'img' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=600&auto=format&fit=crop&q=80'],
  ['title' => 'Wholesale Operation', 'desc' => 'B2B orders and stock transfer', 'img' => 'https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?w=600&auto=format&fit=crop&q=80'],
  ['title' => 'Jewellery Manufacturing', 'desc' => 'Jobwork and production queues', 'img' => 'https://images.unsplash.com/photo-1535632787350-4e68ef0ac584?w=600&auto=format&fit=crop&q=80'],
  ['title' => 'Business Management', 'desc' => 'CRM, schemes and analytics', 'img' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=600&auto=format&fit=crop&q=80']
];
$builtForItems = json_decode(setting('about_builtfor_items', ''), true) ?: $defaultBuiltFor;

$defaultWhy = [
  ['icon' => 'bi-gem', 'title' => 'Jewellery Expertise', 'desc' => 'Purpose-built around jewellery business operations.'],
  ['icon' => 'bi-link-45deg', 'title' => 'Connected Operations', 'desc' => 'Manage essential business processes in one ecosystem.'],
  ['icon' => 'bi-check2-circle', 'title' => 'Practical Solutions', 'desc' => 'Designed for real-world jewellery workflows.'],
  ['icon' => 'bi-graph-up-arrow', 'title' => 'Scalable Business', 'desc' => 'Suitable for growing businesses and multi-location operations.'],
  ['icon' => 'bi-headset', 'title' => 'Customer Support', 'desc' => 'Focused on long-term customer relationships.'],
  ['icon' => 'bi-globe2', 'title' => 'Global Approach', 'desc' => 'Built to support modern jewellery businesses across markets.']
];
$whyItems = json_decode(setting('about_why_items', ''), true) ?: $defaultWhy;

$defaultWhoWeServe = [
  ['icon' => 'bi-shop', 'title' => 'Retailers', 'desc' => 'Single & multi-store showrooms'],
  ['icon' => 'bi-boxes', 'title' => 'Wholesalers', 'desc' => 'Bullion & trade distributors'],
  ['icon' => 'bi-hammer', 'title' => 'Manufacturers', 'desc' => 'Production units & Karigars'],
  ['icon' => 'bi-safe', 'title' => 'Girvi / Mortgage', 'desc' => 'Gold loan & pawn operators'],
  ['icon' => 'bi-building', 'title' => 'Enterprises', 'desc' => 'Large multi-branch jewellery chains']
];
$whoWeServeItems = json_decode(setting('about_whoweserve_items', ''), true) ?: $defaultWhoWeServe;

$ctaBg = setting('about_cta_bg_image', 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=1600&auto=format&fit=crop&q=80');
?>

<style>
/* ══════════════════════════════════════════════════════
   ABOUT US — INTERNATIONAL STANDARD CLEAN & LUXURY STYLING
══════════════════════════════════════════════════════ */
:root {
  --ab-navy: #001540;
  --ab-navy-dark: #000B2A;
  --ab-navy-subtle: #081a4a;
  --ab-gold: #DC9423;
  --ab-gold-amber: #F59E0B;
  --ab-gold-light: #FBBF24;
  --ab-slate-900: #0F172A;
  --ab-slate-800: #1E293B;
  --ab-slate-700: #334155;
  --ab-slate-600: #475569;
  --ab-slate-500: #64748B;
  --ab-slate-200: #E2E8F0;
  --ab-slate-100: #F1F5F9;
  --ab-slate-50: #F8FAFC;
}

/* Base Typography & Headings */
.ab-h1 {
  font-size: clamp(2.4rem, 4.5vw, 3.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.03em;
  color: #FFFFFF;
  margin-bottom: 16px;
}
.ab-h2 {
  font-size: clamp(1.85rem, 3.2vw, 2.5rem);
  font-weight: 800;
  line-height: 1.22;
  letter-spacing: -0.025em;
  color: var(--ab-slate-900);
  margin-bottom: 12px;
}
.ab-h2-dark {
  color: #FFFFFF;
}
.ab-lead {
  font-size: clamp(15.5px, 1.6vw, 17.5px);
  line-height: 1.7;
  color: var(--ab-slate-600);
  margin-bottom: 0;
}
.ab-lead-dark {
  color: #CBD5E1;
}
.ab-img-wrapper {
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 12px 35px -10px rgba(0, 21, 64, 0.12);
  border: 1px solid var(--ab-slate-200);
  background: var(--ab-slate-100);
  position: relative;
}
.ab-img-fluid {
  width: 100%;
  height: 100%;
  min-height: 340px;
  max-height: 460px;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}
.ab-img-wrapper:hover .ab-img-fluid {
  transform: scale(1.03);
}

/* Button System */
.btn-ab-gold {
  background-color: var(--ab-gold-light);
  color: var(--ab-slate-900);
  font-weight: 700;
  font-size: 14.5px;
  padding: 13px 28px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border: 1px solid var(--ab-gold-light);
  transition: all 0.2s ease;
  cursor: pointer;
}
.btn-ab-gold:hover {
  background-color: var(--ab-gold);
  color: var(--ab-slate-900);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(220, 148, 35, 0.3);
}
.btn-ab-outline {
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
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.2s ease;
}
.btn-ab-outline:hover {
  background: rgba(255, 255, 255, 0.16);
  color: #FFFFFF;
  transform: translateY(-2px);
}

/* 1. Hero Section */
.sec-hero {
  background-color: var(--ab-navy);
  background-image: radial-gradient(circle at 80% 20%, #0d276b 0%, var(--ab-navy) 65%);
  padding: 130px 5% 85px;
  color: #FFFFFF;
  position: relative;
  border-bottom: 1px solid rgba(220, 148, 35, 0.2);
}

/* Alternating Content Sections */
.sec-white {
  background: #FFFFFF;
  padding: 90px 5%;
}
.sec-light {
  background: var(--ab-slate-50);
  padding: 90px 5%;
  border-top: 1px solid var(--ab-slate-200);
  border-bottom: 1px solid var(--ab-slate-200);
}

/* 4. Journey Timeline */
.timeline-track-wrap {
  display: flex;
  flex-wrap: wrap;
  align-items: stretch;
  gap: 16px;
  margin-top: 36px;
}
.timeline-step-card {
  flex: 1 1 210px;
  background: #FFFFFF;
  border: 1px solid var(--ab-slate-200);
  border-radius: 14px;
  padding: 26px 22px;
  position: relative;
  transition: all 0.25s ease;
  box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}
.timeline-step-card:hover {
  transform: translateY(-4px);
  border-color: var(--ab-gold);
  box-shadow: 0 10px 25px -5px rgba(0, 21, 64, 0.08);
}
.timeline-step-num {
  font-size: 12px;
  font-weight: 800;
  color: var(--ab-gold);
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 8px;
}
.timeline-step-title {
  font-size: 17px;
  font-weight: 750;
  color: var(--ab-slate-900);
  margin-bottom: 8px;
}
.timeline-step-desc {
  font-size: 13.5px;
  color: var(--ab-slate-600);
  line-height: 1.55;
  margin: 0;
}

/* 5. What We Do — Software Showcase Collage */
.software-collage-box {
  background: linear-gradient(145deg, #001133 0%, #000B2A 100%);
  border: 1px solid rgba(220, 148, 35, 0.3);
  border-radius: 20px;
  padding: 40px 32px;
  color: #FFFFFF;
  margin-top: 36px;
  box-shadow: 0 16px 40px -10px rgba(0, 21, 64, 0.25);
}
.software-chip-row {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
  margin-bottom: 28px;
}
.software-chip {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(220, 148, 35, 0.35);
  border-radius: 50px;
  padding: 7px 18px;
  font-size: 13.5px;
  font-weight: 650;
  color: #FFFFFF;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.software-chip i {
  color: var(--ab-gold-light);
}
.software-preview-img {
  width: 100%;
  border-radius: 12px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.5);
  border: 1px solid rgba(255, 255, 255, 0.15);
  display: block;
}

/* 6. Our Solutions (6 Clean Cards) */
.sol-clean-card {
  background: #FFFFFF;
  border: 1px solid var(--ab-slate-200);
  border-radius: 14px;
  padding: 30px 24px;
  height: 100%;
  transition: all 0.25s ease;
  display: flex;
  align-items: flex-start;
  gap: 18px;
}
.sol-clean-card:hover {
  transform: translateY(-4px);
  border-color: var(--ab-gold);
  box-shadow: 0 10px 25px -5px rgba(0, 21, 64, 0.08);
}
.sol-icon-box {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: rgba(220, 148, 35, 0.1);
  color: var(--ab-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.sol-card-title {
  font-size: 17.5px;
  font-weight: 750;
  color: var(--ab-slate-900);
  margin-bottom: 6px;
}
.sol-card-text {
  font-size: 13.5px;
  color: var(--ab-slate-600);
  line-height: 1.55;
  margin: 0;
}

/* 7. How We Work Steps */
.work-step-row {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  margin-bottom: 24px;
}
.work-step-num {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: var(--ab-navy);
  color: var(--ab-gold-light);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  font-weight: 800;
  flex-shrink: 0;
}
.work-step-title {
  font-size: 17.5px;
  font-weight: 750;
  color: var(--ab-slate-900);
  margin-bottom: 4px;
}
.work-step-desc {
  font-size: 14.5px;
  color: var(--ab-slate-600);
  line-height: 1.6;
  margin: 0;
}

/* 8. Built for Jewellery Businesses (4-Image Grid) */
.quad-grid-card {
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid var(--ab-slate-200);
  background: #FFFFFF;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
  height: 100%;
}
.quad-grid-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  display: block;
}
.quad-grid-caption {
  padding: 16px 20px;
}
.quad-grid-title {
  font-size: 16px;
  font-weight: 750;
  color: var(--ab-slate-900);
  margin-bottom: 4px;
}
.quad-grid-desc {
  font-size: 13px;
  color: var(--ab-slate-500);
  margin: 0;
}

/* 9. Why GoldMatrix (6 Benefit Cards) */
.benefit-clean-card {
  background: #FFFFFF;
  border: 1px solid var(--ab-slate-200);
  border-radius: 12px;
  padding: 26px 22px;
  height: 100%;
  transition: all 0.25s ease;
}
.benefit-clean-card:hover {
  transform: translateY(-4px);
  border-color: var(--ab-gold);
  box-shadow: 0 8px 22px -5px rgba(0, 21, 64, 0.08);
}
.benefit-title {
  font-size: 16.5px;
  font-weight: 750;
  color: var(--ab-slate-900);
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.benefit-title i {
  color: var(--ab-gold);
  font-size: 18px;
}
.benefit-text {
  font-size: 13.5px;
  color: var(--ab-slate-600);
  line-height: 1.6;
  margin: 0;
}

/* 10. Who We Serve (5 Cards) */
.serve-chip-card {
  background: var(--ab-slate-50);
  border: 1px solid var(--ab-slate-200);
  border-radius: 14px;
  padding: 24px 20px;
  text-align: center;
  height: 100%;
  transition: all 0.25s ease;
}
.serve-chip-card:hover {
  background: #FFFFFF;
  border-color: var(--ab-gold);
  transform: translateY(-4px);
  box-shadow: 0 10px 24px -5px rgba(0, 21, 64, 0.08);
}
.serve-icon {
  font-size: 28px;
  color: var(--ab-navy);
  margin-bottom: 12px;
  display: inline-block;
}
.serve-name {
  font-size: 16px;
  font-weight: 750;
  color: var(--ab-slate-900);
  margin-bottom: 6px;
}
.serve-desc {
  font-size: 13px;
  color: var(--ab-slate-500);
  margin: 0;
}

/* 11. Global Presence */
.global-map-box {
  background: var(--ab-navy-dark);
  border: 1px solid rgba(220, 148, 35, 0.3);
  border-radius: 16px;
  padding: 30px;
  color: #FFFFFF;
  text-align: center;
  box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}
.hub-capsule {
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 10px;
  padding: 16px 20px;
  text-align: left;
  margin-top: 14px;
}
.hub-capsule-badge {
  font-size: 11px;
  font-weight: 800;
  color: var(--ab-gold-light);
  letter-spacing: 1px;
  text-transform: uppercase;
  margin-bottom: 4px;
}
.hub-capsule-title {
  font-size: 16px;
  font-weight: 750;
  color: #FFFFFF;
  margin-bottom: 2px;
}
.hub-capsule-desc {
  font-size: 13px;
  color: #94A3B8;
  margin: 0;
}

/* 13. Final CTA (Let's Grow Together) */
.sec-final-cta {
  background-color: var(--ab-navy);
  background-image: 
    linear-gradient(rgba(0, 21, 64, 0.92), rgba(0, 11, 42, 0.95)),
    url('<?= e($ctaBg) ?>');
  background-size: cover;
  background-position: center;
  padding: 105px 5%;
  color: #FFFFFF;
  text-align: center;
  border-top: 1px solid rgba(220, 148, 35, 0.25);
}
</style>

<!-- ══════════════════════════════════════════════════
     1. HERO SECTION
══════════════════════════════════════════════════ -->
<section class="sec-hero">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    <div class="row align-items-center g-5">
      
      <div class="col-lg-6 text-center text-lg-start">
        <h1 class="ab-h1"><?= e(setting('about_hero_title', 'About GoldMatrix')) ?></h1>
        <p class="ab-lead ab-lead-dark mb-4">
          <?= e(setting('about_hero_lead', 'GoldMatrix is a jewellery business software company helping jewellery businesses simplify operations, improve control and grow with confidence.')) ?>
        </p>
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start gap-3">
          <button type="button" class="btn-ab-gold" data-bs-toggle="modal" data-bs-target="#bookDemoModal">
            <span><?= e(setting('about_hero_btn1_text', 'Book a Free Demo')) ?></span>
            <i class="bi bi-arrow-right"></i>
          </button>
          <a href="<?= e(setting('about_hero_btn2_link', '/solutions')) ?>" class="btn-ab-outline">
            <span><?= e(setting('about_hero_btn2_text', 'Explore Solutions')) ?></span>
          </a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="ab-img-wrapper">
          <img src="<?= e(setting('about_hero_image', 'https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=1000&auto=format&fit=crop&q=80')) ?>" alt="GoldMatrix International Jewellery Environment" class="ab-img-fluid" loading="eager" fetchpriority="high" decoding="async">
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     2. WHO WE ARE
══════════════════════════════════════════════════ -->
<section class="sec-white" id="who-we-are">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    <div class="row align-items-center g-5">
      
      <div class="col-lg-6 order-2 order-lg-1">
        <div class="ab-img-wrapper">
          <img src="<?= e(setting('about_whoweare_image', 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1000&auto=format&fit=crop&q=80')) ?>" alt="GoldMatrix Company Team & Workspace" class="ab-img-fluid" loading="lazy" decoding="async">
        </div>
      </div>

      <div class="col-lg-6 order-1 order-lg-2">
        <h2 class="ab-h2"><?= e(setting('about_whoweare_title', 'Who We Are')) ?></h2>
        <p class="ab-lead">
          <?= e(setting('about_whoweare_text', 'We build practical business solutions for jewellery retailers, wholesalers, manufacturers and growing jewellery enterprises.')) ?>
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     3. OUR PURPOSE
══════════════════════════════════════════════════ -->
<section class="sec-light" id="our-purpose">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    <div class="row align-items-center g-5">
      
      <div class="col-lg-6">
        <h2 class="ab-h2"><?= e(setting('about_purpose_title', 'Our Purpose')) ?></h2>
        <p class="ab-lead">
          <?= e(setting('about_purpose_text', 'To make complex jewellery business operations simpler, more accurate and easier to manage.')) ?>
        </p>
      </div>

      <div class="col-lg-6">
        <div class="ab-img-wrapper">
          <img src="<?= e(setting('about_purpose_image', 'https://images.unsplash.com/photo-1531973576160-7125cd663d86?w=1000&auto=format&fit=crop&q=80')) ?>" alt="Jewellery Business Operations & Retail Integration" class="ab-img-fluid" loading="lazy" decoding="async">
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     4. OUR JOURNEY (HORIZONTAL TIMELINE)
══════════════════════════════════════════════════ -->
<section class="sec-white" id="our-journey">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-4">
      <h2 class="ab-h2"><?= e(setting('about_journey_title', 'Our Journey')) ?></h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        <?= e(setting('about_journey_text', 'Our journey is shaped by continuous experience, customer relationships and a deep understanding of jewellery business operations.')) ?>
      </p>
    </div>

    <div class="timeline-track-wrap">
      <?php foreach ($journeyItems as $j): ?>
        <div class="timeline-step-card">
          <div class="timeline-step-num"><?= e($j['phase'] ?? 'PHASE') ?></div>
          <h3 class="timeline-step-title"><?= e($j['title'] ?? '') ?></h3>
          <p class="timeline-step-desc"><?= e($j['desc'] ?? '') ?></p>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     5. WHAT WE DO (REAL SOFTWARE SHOWCASE)
══════════════════════════════════════════════════ -->
<section class="sec-light" id="what-we-do">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-4">
      <h2 class="ab-h2"><?= e(setting('about_whatwedo_title', 'What We Do')) ?></h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        <?= e(setting('about_whatwedo_text', 'We provide connected business solutions covering the key operations of modern jewellery businesses.')) ?>
      </p>
    </div>

    <div class="software-collage-box text-center">
      <div class="software-chip-row">
        <div class="software-chip"><i class="bi bi-speedometer2"></i> Live Rates &amp; Dashboards</div>
        <div class="software-chip"><i class="bi bi-cart-check"></i> POS &amp; Billing</div>
        <div class="software-chip"><i class="bi bi-boxes"></i> Inventory &amp; RFID</div>
        <div class="software-chip"><i class="bi bi-gear"></i> Manufacturing &amp; Jobwork</div>
        <div class="software-chip"><i class="bi bi-calculator"></i> Accounting &amp; Tax</div>
        <div class="software-chip"><i class="bi bi-graph-up"></i> BI Reports &amp; Analytics</div>
        <div class="software-chip"><i class="bi bi-translate"></i> Multi-Language Support</div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-10">
          <img src="<?= e(setting('about_whatwedo_image', '/uploads/homepage/hp_6a9207ee140eb.png')) ?>" alt="GoldMatrix Jewellery ERP Software Suite" class="software-preview-img" loading="lazy" decoding="async" onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&auto=format&fit=crop&q=80'">
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     6. OUR CORE FEATURES & ERP MODULES (10 MODULES)
══════════════════════════════════════════════════ -->
<section class="sec-white" id="our-features">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: rgba(220, 148, 35, 0.1); border: 1px solid rgba(220, 148, 35, 0.25); color: var(--ab-gold); font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
        <i class="bi bi-stars"></i>
        <span>10 Core ERP Modules</span>
      </div>
      <h2 class="ab-h2"><?= e(setting('about_solutions_title', 'Our Features & Core Modules')) ?></h2>
      <p class="ab-lead mx-auto" style="max-width: 780px;">
        <?= e(setting('about_solutions_text', 'An integrated ERP architecture designed exclusively for jewellery commerce — spanning real-time market rates, workshop loss tracking, RFID inventory, and native multi-language internationalization.')) ?>
      </p>
    </div>

    <div class="row g-4">
      <?php foreach ($solutionsItems as $sol): ?>
        <div class="col-lg-4 col-md-6">
          <div class="sol-clean-card">
            <div class="sol-icon-box">
              <i class="bi <?= e($sol['icon'] ?? 'bi-gem') ?>"></i>
            </div>
            <div>
              <h3 class="sol-card-title"><?= e($sol['title'] ?? '') ?></h3>
              <p class="sol-card-text"><?= e($sol['desc'] ?? '') ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     7. HOW WE WORK (3 SIMPLE STEPS)
══════════════════════════════════════════════════ -->
<section class="sec-light" id="how-we-work">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    <div class="row align-items-center g-5">
      
      <div class="col-lg-6">
        <h2 class="ab-h2"><?= e(setting('about_howwework_title', 'How We Work')) ?></h2>
        <p class="ab-lead mb-4">
          <?= e(setting('about_howwework_text', 'A structured, customer-first approach to deploying software that fits your operations.')) ?>
        </p>

        <?php foreach ($howWeWorkSteps as $step): ?>
          <div class="work-step-row">
            <div class="work-step-num"><?= e($step['num'] ?? '') ?></div>
            <div>
              <h3 class="work-step-title"><?= e($step['title'] ?? '') ?></h3>
              <p class="work-step-desc"><?= e($step['desc'] ?? '') ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="col-lg-6">
        <div class="ab-img-wrapper">
          <img src="<?= e(setting('about_howwework_image', 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=1000&auto=format&fit=crop&q=80')) ?>" alt="GoldMatrix Customer Consultation & Implementation" class="ab-img-fluid" loading="lazy" decoding="async">
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     8. BUILT FOR JEWELLERY BUSINESSES (4-IMAGE GRID)
══════════════════════════════════════════════════ -->
<section class="sec-white" id="built-for-jewellery">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <h2 class="ab-h2"><?= e(setting('about_builtfor_title', 'Built for Jewellery Businesses')) ?></h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        <?= e(setting('about_builtfor_text', 'Our solutions are designed around the unique requirements of jewellery retail, wholesale, manufacturing and business operations.')) ?>
      </p>
    </div>

    <div class="row g-4">
      <?php foreach ($builtForItems as $bf): ?>
        <div class="col-lg-3 col-md-6">
          <div class="quad-grid-card">
            <img src="<?= e($bf['img'] ?? '') ?>" alt="<?= e($bf['title'] ?? '') ?>" class="quad-grid-img" loading="lazy" decoding="async">
            <div class="quad-grid-caption">
              <h3 class="quad-grid-title"><?= e($bf['title'] ?? '') ?></h3>
              <p class="quad-grid-desc"><?= e($bf['desc'] ?? '') ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     9. WHY GOLDMATRIX (6 BENEFIT CARDS)
══════════════════════════════════════════════════ -->
<section class="sec-light" id="why-goldmatrix">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <h2 class="ab-h2"><?= e(setting('about_why_title', 'Why GoldMatrix')) ?></h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        <?= e(setting('about_why_text', 'Engineered specifically for the demands and operational integrity of the jewellery industry.')) ?>
      </p>
    </div>

    <div class="row g-4">
      <?php foreach ($whyItems as $why): ?>
        <div class="col-lg-4 col-md-6">
          <div class="benefit-clean-card">
            <h3 class="benefit-title">
              <i class="bi <?= e($why['icon'] ?? 'bi-check2-circle') ?>"></i>
              <span><?= e($why['title'] ?? '') ?></span>
            </h3>
            <p class="benefit-text"><?= e($why['desc'] ?? '') ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     10. WHO WE SERVE
══════════════════════════════════════════════════ -->
<section class="sec-white" id="who-we-serve">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <h2 class="ab-h2"><?= e(setting('about_whoweserve_title', 'Who We Serve')) ?></h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        <?= e(setting('about_whoweserve_text', 'From individual jewellery businesses to growing enterprises, GoldMatrix supports different stages of the jewellery business.')) ?>
      </p>
    </div>

    <div class="row g-3 justify-content-center">
      <?php foreach ($whoWeServeItems as $ws): ?>
        <div class="col-lg-2 col-md-4 col-6">
          <div class="serve-chip-card">
            <i class="bi <?= e($ws['icon'] ?? 'bi-building') ?> serve-icon"></i>
            <h3 class="serve-name"><?= e($ws['title'] ?? '') ?></h3>
            <p class="serve-desc"><?= e($ws['desc'] ?? '') ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     11. GLOBAL PRESENCE
══════════════════════════════════════════════════ -->
<section class="sec-light" id="global-presence">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    <div class="row align-items-center g-5">
      
      <div class="col-lg-6">
        <h2 class="ab-h2"><?= e(setting('about_global_title', 'Global Presence')) ?></h2>
        <p class="ab-lead mb-4">
          <?= e(setting('about_global_text', 'GoldMatrix is built with an international outlook to support jewellery businesses across different markets and business environments.')) ?>
        </p>

        <div class="hub-capsule">
          <div class="hub-capsule-badge">INTERNATIONAL HEADQUARTER</div>
          <h3 class="hub-capsule-title">Sharjah, UAE</h3>
          <p class="hub-capsule-desc"><?= e(setting('contact_uae_address', 'Shop No. 25/A, Central Gold Souq Block No. 8, Al Majaz -1 King Faisal Road - Sharjah, UAE')) ?></p>
        </div>

        <div class="hub-capsule">
          <div class="hub-capsule-badge">DEVELOPMENT &amp; TECH HUB</div>
          <h3 class="hub-capsule-title">Maharashtra, India</h3>
          <p class="hub-capsule-desc"><?= e(setting('contact_india_address', 'India, 01/A, Hingna Rd, M.I.D.C, Maharashtra - 440022')) ?></p>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="global-map-box">
          <i class="bi bi-globe-americas text-warning display-3 mb-3 d-inline-block"></i>
          <h3 class="h4 fw-bold text-white mb-2">Connected Across Key Jewellery Markets</h3>
          <p class="text-white-50 fs-14 mb-0">
            <?= e(setting('about_global_markets', 'UAE • India • Hong Kong • Singapore • United Kingdom • GCC')) ?>
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     12. OUR COMMITMENT
══════════════════════════════════════════════════ -->
<section class="sec-white" id="our-commitment">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    <div class="row align-items-center g-5">
      
      <div class="col-lg-6">
        <div class="ab-img-wrapper">
          <img src="<?= e(setting('about_commitment_image', 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=1000&auto=format&fit=crop&q=80')) ?>" alt="GoldMatrix Team Long-term Partnership" class="ab-img-fluid" loading="lazy" decoding="async">
        </div>
      </div>

      <div class="col-lg-6">
        <h2 class="ab-h2"><?= e(setting('about_commitment_title', 'Our Commitment')) ?></h2>
        <p class="ab-lead">
          <?= e(setting('about_commitment_text', 'We focus on reliable solutions, continuous improvement and long-term relationships with the businesses we serve.')) ?>
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     13. FINAL CTA (LET'S GROW TOGETHER)
══════════════════════════════════════════════════ -->
<section class="sec-final-cta">
  <div class="container" style="max-width: 850px;">
    <h2 class="ab-h1 mb-3"><?= e(setting('about_cta_title', 'Let\'s Grow Together')) ?></h2>
    <p class="ab-lead ab-lead-dark mb-4 mx-auto" style="max-width: 700px;">
      <?= e(setting('about_cta_desc', 'Discover how GoldMatrix can help simplify your jewellery business and bring greater control to your daily operations.')) ?>
    </p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <button type="button" class="btn-ab-gold" data-bs-toggle="modal" data-bs-target="#bookDemoModal">
        <span><?= e(setting('about_cta_btn1_text', 'Book a Free Demo')) ?></span>
        <i class="bi bi-arrow-right"></i>
      </button>
      <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', setting('about_cta_whatsapp', '919270369937')) ?>?text=Hello%20GoldMatrix%20Team%2C%20I%20would%20like%20to%20learn%20more%20about%20your%20Jewellery%20ERP%20software." target="_blank" class="btn-ab-outline">
        <i class="bi bi-whatsapp text-success me-1"></i>
        <span>Chat on WhatsApp</span>
      </a>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/partials/footer.php';
?>
