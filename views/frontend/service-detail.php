<?php
/**
 * Universal High-End Service Detail Sub-Page Template
 * Location: views/frontend/service-detail.php
 */
require __DIR__ . '/partials/header.php';

// Format title with gold highlight
$rawTitle = $service['title'];
$formattedTitle = e($rawTitle);
$highlights = ['POS & Showroom', 'Manufacturing ERP', 'Bullion Trading', 'Inventory Automation', 'Digital Catalog', 'Compliance', 'Management', 'Software'];
foreach ($highlights as $h) {
    if (stripos($rawTitle, $h) !== false) {
        $formattedTitle = preg_replace('/(' . preg_quote($h, '/') . ')/i', '<span class="h1-gold">$1</span>', $formattedTitle, 1);
        break;
    }
}
?>

<!-- ══════════════════════════════════════════════════
     SCHEMA.ORG JSON-LD STRUCTURED DATA (SEO SUPERIORITY)
══════════════════════════════════════════════════ -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "<?= e(app_config('url')) ?>/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Solutions",
          "item": "<?= e(app_config('url')) ?>/services"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "<?= e($service['title']) ?>",
          "item": "<?= e(app_config('url')) ?>/services/<?= e($service['slug']) ?>"
        }
      ]
    },
    {
      "@type": "SoftwareApplication",
      "name": "<?= e($service['title']) ?> - GoldMatrix ERP",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web, Windows, Android, iOS",
      "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "INR",
        "availability": "https://schema.org/InStock",
        "description": "Free Live Demo Available"
      },
      "description": "<?= e($service['meta_desc']) ?>"
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        <?php foreach ($service['faqs'] as $fIdx => $faq): ?>
        {
          "@type": "Question",
          "name": <?= json_encode($faq['q']) ?>,
          "acceptedAnswer": {
            "@type": "Answer",
            "text": <?= json_encode($faq['a']) ?>
          }
        }<?= $fIdx < count($service['faqs']) - 1 ? ',' : '' ?>
        <?php endforeach; ?>
      ]
    }
  ]
}
</script>

<style>
/* ══════════════════════════════════════
   EXECUTIVE SERVICE SUB-PAGE DESIGN SYSTEM
══════════════════════════════════════ */
.srv-hero-section {
  background: linear-gradient(135deg, #000B2A 0%, #001540 55%, #001E5A 100%);
  padding: 130px 5% 80px;
  color: #FFFFFF;
  position: relative;
  overflow: hidden;
  border-bottom: 1px solid rgba(220,148,35,0.18);
}
.srv-hero-section::before {
  content: '';
  position: absolute;
  top: -20%;
  right: -10%;
  width: 600px;
  height: 600px;
  background: radial-gradient(circle, rgba(220,148,35,0.12) 0%, transparent 70%);
  pointer-events: none;
}

.srv-breadcrumb-bar {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.12);
  padding: 5px 14px;
  border-radius: 20px;
  font-size: 12px;
  margin-bottom: 22px;
  backdrop-filter: blur(8px);
}
.srv-breadcrumb-bar a {
  color: #94A3B8;
  text-decoration: none;
  transition: color 0.2s ease;
}
.srv-breadcrumb-bar a:hover {
  color: var(--gm-luxury-gold);
}
.srv-breadcrumb-bar span {
  color: #475569;
}
.srv-breadcrumb-bar .active-crumb {
  color: var(--gm-luxury-gold);
  font-weight: 600;
}

.srv-eyebrow-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--gm-luxury-gold);
  background: rgba(220, 148, 35, 0.12);
  border: 1px solid rgba(220, 148, 35, 0.3);
  padding: 6px 14px;
  border-radius: 20px;
  margin-bottom: 14px;
}
.srv-hero-title {
  font-size: clamp(2.3rem, 4vw, 3.4rem);
  font-weight: 800;
  line-height: 1.18;
  letter-spacing: -0.5px;
  color: #FFFFFF;
  margin-bottom: 20px;
}
.srv-hero-title .h1-gold {
  color: var(--gm-luxury-gold);
  background: linear-gradient(135deg, #FCD34D, var(--gm-luxury-gold));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.srv-hero-p {
  font-size: 16px;
  line-height: 1.7;
  color: #94A3B8;
  margin-bottom: 32px;
  max-width: 600px;
}

.srv-hero-mockup-frame {
  background: rgba(0, 15, 50, 0.75);
  border: 1px solid rgba(255, 255, 255, 0.14);
  border-radius: 18px;
  padding: 12px;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 30px rgba(220,148,35,0.1);
  backdrop-filter: blur(12px);
  position: relative;
}
.srv-mockup-header {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 6px 10px 12px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  margin-bottom: 10px;
}
.srv-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
}
.srv-dot-red { background: #EF4444; }
.srv-dot-yellow { background: #F59E0B; }
.srv-dot-green { background: #10B981; }
.srv-mockup-url {
  background: rgba(255, 255, 255, 0.06);
  border-radius: 4px;
  padding: 3px 12px;
  font-size: 11px;
  color: #94A3B8;
  margin-left: 10px;
  flex-grow: 1;
  max-width: 260px;
}
.srv-hero-screen {
  width: 100%;
  max-height: 380px;
  object-fit: cover;
  border-radius: 8px;
  display: block;
}

/* ══════════════════════════════════════
   EXECUTIVE SPOTLIGHT ZIG-ZAG SECTIONS
══════════════════════════════════════ */
.srv-section-spotlight {
  background: #FFFFFF;
  padding: 95px 5%;
}
.srv-spotlight-header {
  text-align: center;
  margin-bottom: 60px;
}
.srv-gold-line {
  display: block;
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, transparent, var(--gm-luxury-gold), transparent);
  margin: 14px auto 0;
  border-radius: 2px;
}

.srv-spotlight-row {
  margin-bottom: 75px;
}
.srv-spotlight-row:last-child {
  margin-bottom: 0;
}
.srv-spotlight-card-text {
  padding: 10px 0;
}
.srv-spotlight-category {
  font-size: 11.5px;
  font-weight: 800;
  color: var(--gm-luxury-gold);
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.srv-spotlight-h2 {
  font-size: 26px;
  font-weight: 800;
  color: #001540;
  line-height: 1.3;
  margin-bottom: 16px;
}
.srv-spotlight-desc {
  font-size: 15px;
  color: #475569;
  line-height: 1.7;
  margin-bottom: 22px;
}
.srv-spotlight-points {
  list-style: none;
  padding: 0;
  margin: 0 0 24px 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.srv-spotlight-point {
  font-size: 14px;
  color: #1E293B;
  display: flex;
  align-items: flex-start;
  gap: 10px;
  line-height: 1.5;
}
.srv-spotlight-point i {
  color: var(--gm-luxury-gold);
  font-size: 16px;
  flex-shrink: 0;
  margin-top: 2px;
}

.srv-spotlight-img-box {
  background: #001540;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 16px 40px rgba(0, 21, 64, 0.12);
  border: 1px solid #E2E8F0;
  position: relative;
}
.srv-spotlight-img {
  width: 100%;
  height: 340px;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}
.srv-spotlight-img-box:hover .srv-spotlight-img {
  transform: scale(1.03);
}

/* ══════════════════════════════════════
   CAPABILITIES 6-PILLAR ENTERPRISE GRID
══════════════════════════════════════ */
.srv-section-capabilities {
  background: #001540;
  padding: 95px 5%;
  color: #FFFFFF;
}
.srv-cap-card {
  background: rgba(255, 255, 255, 0.035);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  padding: 32px 26px;
  height: 100%;
  transition: all 0.28s ease;
}
.srv-cap-card:hover {
  background: rgba(255, 255, 255, 0.065);
  border-color: rgba(220, 148, 35, 0.5);
  transform: translateY(-5px);
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35);
}
.srv-cap-icon-wrap {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  background: rgba(220, 148, 35, 0.12);
  border: 1px solid rgba(220, 148, 35, 0.3);
  color: var(--gm-luxury-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 20px;
  transition: all 0.25s ease;
}
.srv-cap-card:hover .srv-cap-icon-wrap {
  background: var(--gm-luxury-gold);
  color: #000B2A;
  transform: scale(1.08);
}
.srv-cap-title {
  font-size: 18px;
  font-weight: 750;
  color: #FFFFFF;
  margin-bottom: 12px;
}
.srv-cap-desc {
  font-size: 13.5px;
  color: #94A3B8;
  line-height: 1.65;
  margin-bottom: 20px;
}
.srv-cap-checklist {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.srv-cap-check-item {
  font-size: 13px;
  color: #CBD5E1;
  display: flex;
  align-items: center;
  gap: 8px;
}
.srv-cap-check-item i {
  color: var(--gm-luxury-gold);
  font-size: 14px;
}

/* ══════════════════════════════════════
   STEP-BY-STEP WORKFLOW PIPELINE
══════════════════════════════════════ */
.srv-section-workflow {
  background: #F8FAFC;
  padding: 90px 5%;
}
.srv-wf-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 16px;
  padding: 30px 24px;
  height: 100%;
  box-shadow: 0 4px 15px rgba(0, 21, 64, 0.03);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  position: relative;
}
.srv-wf-card:hover {
  transform: translateY(-4px);
  border-color: var(--gm-luxury-gold);
  box-shadow: 0 12px 30px rgba(0, 21, 64, 0.08);
}
.srv-wf-step-num {
  font-size: 32px;
  font-weight: 900;
  color: var(--gm-luxury-gold);
  line-height: 1;
  margin-bottom: 14px;
}
.srv-wf-title {
  font-size: 17px;
  font-weight: 750;
  color: #001540;
  margin-bottom: 10px;
}
.srv-wf-desc {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}

/* ══════════════════════════════════════
   LIVE IMPACT METRICS / STATS BAR
══════════════════════════════════════ */
.srv-section-stats {
  background: #000B2A;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  padding: 65px 5%;
  color: #FFFFFF;
}
.srv-stat-num {
  font-size: clamp(2.4rem, 3.8vw, 3.2rem);
  font-weight: 900;
  color: var(--gm-luxury-gold);
  line-height: 1.1;
  margin-bottom: 6px;
}
.srv-stat-lbl {
  font-size: 15px;
  font-weight: 700;
  color: #F1F5F9;
  margin-bottom: 3px;
}
.srv-stat-sub {
  font-size: 12.5px;
  color: #94A3B8;
}

/* ══════════════════════════════════════
   FAQ ACCORDION
══════════════════════════════════════ */
.srv-section-faq {
  background: #FFFFFF;
  padding: 90px 5%;
}
.srv-faq-box .accordion-item {
  border: 1px solid #E2E8F0;
  border-radius: 12px !important;
  margin-bottom: 12px;
  overflow: hidden;
}
.srv-faq-box .accordion-button {
  font-weight: 700;
  font-size: 15.5px;
  color: #001540;
  padding: 18px 22px;
  background: #FFFFFF;
}
.srv-faq-box .accordion-button:not(.collapsed) {
  background: #FAF8F5;
  color: var(--gm-luxury-gold);
  box-shadow: none;
}
.srv-faq-box .accordion-body {
  font-size: 14.5px;
  color: #475569;
  line-height: 1.7;
  padding: 18px 22px 24px;
  background: #FFFFFF;
}

/* ══════════════════════════════════════
   EXECUTIVE CTA & LEAD CAPTURE
══════════════════════════════════════ */
.srv-cta-container {
  background: linear-gradient(135deg, #000B2A 0%, #001540 60%, #001F5C 100%);
  border: 1px solid rgba(220,148,35,0.25);
  border-radius: 24px;
  padding: 50px 40px;
  color: #FFFFFF;
  box-shadow: 0 25px 60px rgba(0, 11, 42, 0.4);
}
</style>

<!-- ══════════════════════════════════════════════════
     1. EXECUTIVE HERO BANNER & BREADCRUMB
══════════════════════════════════════════════════ -->
<section class="srv-hero-section">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1440px;">
    
    <!-- Breadcrumb -->
    <div class="srv-breadcrumb-bar">
      <a href="/"><i class="bi bi-house-door me-1"></i>Home</a>
      <span>/</span>
      <a href="/services">Solutions</a>
      <span>/</span>
      <span class="active-crumb"><?= e($service['title']) ?></span>
    </div>

    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        
        <div class="srv-eyebrow-pill">
          <i class="bi <?= e($service['icon']) ?>"></i>
          <span><?= e($service['badge']) ?></span>
        </div>

        <h1 class="srv-hero-title">
          <?= $formattedTitle ?>
        </h1>

        <p class="srv-hero-p">
          <?= e($service['hero_subtitle']) ?>
        </p>

        <!-- CTA Buttons -->
        <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
          <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn-gold-solid py-3 px-4 open-demo-modal" role="button">
            <span>Book a Free 1-on-1 Live Demo</span>
            <i class="bi bi-arrow-right"></i>
          </a>
          <a href="https://wa.me/919270369937?text=Hello%2C%20I%20am%20interested%20in%20<?= urlencode($service['title']) ?>" target="_blank" class="btn-ghost py-3 px-4">
            <i class="bi bi-whatsapp text-success me-2"></i>
            <span>Chat on WhatsApp</span>
          </a>
        </div>

        <!-- 4 Trust Badges -->
        <div class="row g-2 pt-3 border-top border-white border-opacity-10">
          <div class="col-6 col-md-3">
            <div class="fs-12 text-light"><i class="bi bi-cloud-check text-warning me-1"></i> 100% Cloud Native</div>
          </div>
          <div class="col-6 col-md-3">
            <div class="fs-12 text-light"><i class="bi bi-shield-check text-warning me-1"></i> Bank-Grade SSL</div>
          </div>
          <div class="col-6 col-md-3">
            <div class="fs-12 text-light"><i class="bi bi-receipt text-warning me-1"></i> GST Compliant</div>
          </div>
          <div class="col-6 col-md-3">
            <div class="fs-12 text-light"><i class="bi bi-buildings text-warning me-1"></i> Multi-Branch Sync</div>
          </div>
        </div>

      </div>

      <div class="col-lg-6">
        <div class="srv-hero-mockup-frame">
          <div class="srv-mockup-header">
            <span class="srv-dot srv-dot-red"></span>
            <span class="srv-dot srv-dot-yellow"></span>
            <span class="srv-dot srv-dot-green"></span>
            <div class="srv-mockup-url">goldmatrix.app/<?= e($service['slug']) ?></div>
          </div>
          <img src="<?= e($service['hero_image']) ?>" alt="<?= e($service['title']) ?>" class="srv-hero-screen" loading="eager" fetchpriority="high">
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     2. SPOTLIGHT DEEP DIVE (HOMEPAGE-STYLE ZIG-ZAG)
══════════════════════════════════════════════════ -->
<section class="srv-section-spotlight">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1400px;">
    
    <div class="srv-spotlight-header">
      <div class="srv-eyebrow-pill">INDUSTRY-SPECIFIC ENGINEERING</div>
      <h2 class="h2 fw-bold text-dark mb-0">Built Exclusively for Precious Jewellery Operations</h2>
      <span class="srv-gold-line"></span>
    </div>

    <!-- Spotlight Row 1: Core Engine & Automation -->
    <div class="row align-items-center g-5 srv-spotlight-row">
      <div class="col-lg-6">
        <div class="srv-spotlight-card-text pe-lg-4">
          <div class="srv-spotlight-category">
            <i class="bi bi-cpu"></i> CORE CALCULATION ENGINE
          </div>
          <h3 class="srv-spotlight-h2">Eliminate Manual Errors with Automated Purity & Weight Math</h3>
          <p class="srv-spotlight-desc">
            Jewellery retailing and manufacturing require millimeter and milligram precision. GoldMatrix automatically separates gross weight, stone weight, diamond carats, and net fine gold values in milliseconds.
          </p>
          <ul class="srv-spotlight-points">
            <li class="srv-spotlight-point">
              <i class="bi bi-check-circle-fill"></i>
              <span><strong>Live Board Rates:</strong> Dynamic daily metal rate lookup across 24K, 22K, 18K, 14K, 9K, and 925 Silver.</span>
            </li>
            <li class="srv-spotlight-point">
              <i class="bi bi-check-circle-fill"></i>
              <span><strong>Making Charge Matrix:</strong> Flat, gram-wise, percentage, or piece-based making charge automation.</span>
            </li>
            <li class="srv-spotlight-point">
              <i class="bi bi-check-circle-fill"></i>
              <span><strong>Old Gold Purchase:</strong> Purity karam deduction formulas, melting loss logs, and customer KYC capture.</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="srv-spotlight-img-box">
          <img src="/assets/images/why-goldmatrix-mockup.png" alt="Calculation Engine" class="srv-spotlight-img" loading="lazy">
        </div>
      </div>
    </div>

    <!-- Spotlight Row 2: Workflow & Traceability -->
    <div class="row align-items-center g-5 srv-spotlight-row flex-lg-row-reverse">
      <div class="col-lg-6">
        <div class="srv-spotlight-card-text ps-lg-4">
          <div class="srv-spotlight-category">
            <i class="bi bi-shield-check"></i> TOTAL TRACEABILITY & SECURITY
          </div>
          <h3 class="srv-spotlight-h2">100% Stock Visibility Across Showrooms, Vaults & Workshops</h3>
          <p class="srv-spotlight-desc">
            Never lose track of a single gram. Every piece is tracked with unique barcode/RFID identifiers, HUID hallmarking numbers, and audit logs.
          </p>
          <ul class="srv-spotlight-points">
            <li class="srv-spotlight-point">
              <i class="bi bi-check-circle-fill"></i>
              <span><strong>Instant Stock Audits:</strong> Scan entire showcase trays in seconds to verify presence and detect missing pieces.</span>
            </li>
            <li class="srv-spotlight-point">
              <i class="bi bi-check-circle-fill"></i>
              <span><strong>Inter-Branch Transfers:</strong> Digital gate passes, transit insurance logs, and real-time counter receiving verification.</span>
            </li>
            <li class="srv-spotlight-point">
              <i class="bi bi-check-circle-fill"></i>
              <span><strong>Fraud Protection:</strong> Role-based access, manager OTP approval for discounts, and tamper-evident audit trails.</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="srv-spotlight-img-box">
          <img src="/assets/images/why-goldmatrix-mockup.png" alt="Stock Visibility" class="srv-spotlight-img" loading="lazy">
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     3. CAPABILITIES 6-PILLAR ENTERPRISE GRID
══════════════════════════════════════════════════ -->
<section class="srv-section-capabilities">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1400px;">
    
    <div class="text-center mb-5">
      <div class="srv-eyebrow-pill">COMPLETE CAPABILITY SUITE</div>
      <h2 class="h2 fw-bold text-white mb-0">Engineered to Accelerate Growth</h2>
      <span class="srv-gold-line"></span>
    </div>

    <div class="row g-4">
      <?php foreach ($service['capabilities'] as $cap): ?>
        <div class="col-lg-4 col-md-6">
          <div class="srv-cap-card">
            <div class="srv-cap-icon-wrap">
              <i class="bi <?= e($cap['icon']) ?>"></i>
            </div>
            <h3 class="srv-cap-title"><?= e($cap['title']) ?></h3>
            <p class="srv-cap-desc"><?= e($cap['desc']) ?></p>

            <?php if (!empty($cap['workflow_text'])): ?>
              <div class="srv-cap-workflow-box my-2 p-2 rounded" style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.14); font-size:11.5px;">
                <div class="d-flex align-items-center gap-1 fw-bold text-uppercase mb-1" style="font-size:10px; color:#FBBF24; letter-spacing:0.8px;">
                  <i class="bi bi-diagram-3-fill"></i> Production Workflow Pipeline
                </div>
                <div class="text-light fw-medium" style="line-height:1.45; font-size:11.5px;">
                  <?= e($cap['workflow_text']) ?>
                </div>
              </div>
            <?php endif; ?>

            <ul class="srv-cap-checklist">
              <?php foreach ($cap['points'] as $pt): ?>
                <li class="srv-cap-check-item">
                  <i class="bi bi-check2"></i>
                  <span><?= e($pt) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     4. STEP-BY-STEP WORKFLOW PIPELINE
══════════════════════════════════════════════════ -->
<section class="srv-section-workflow">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1400px;">
    
    <div class="text-center mb-5">
      <div class="srv-eyebrow-pill">STANDARDIZED WORKFLOW</div>
      <h2 class="h2 fw-bold text-dark mb-0">How the Workflow Operates</h2>
      <span class="srv-gold-line"></span>
    </div>

    <div class="row g-4">
      <?php foreach ($service['workflow'] as $wf): ?>
        <div class="col-lg-3 col-md-6">
          <div class="srv-wf-card">
            <div class="srv-wf-step-num"><?= e($wf['step']) ?></div>
            <h4 class="srv-wf-title"><?= e($wf['title']) ?></h4>
            <p class="srv-wf-desc"><?= e($wf['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     5. LIVE IMPACT STATS BAR
══════════════════════════════════════════════════ -->
<section class="srv-section-stats">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1400px;">
    <div class="row g-4 text-center">
      <?php foreach ($service['kpis'] as $kpi): ?>
        <div class="col-lg-3 col-6">
          <div class="srv-stat-num"><?= e($kpi['stat']) ?></div>
          <div class="srv-stat-lbl"><?= e($kpi['label']) ?></div>
          <div class="srv-stat-sub"><?= e($kpi['sub']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     6. FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)
══════════════════════════════════════════════════ -->
<section class="srv-section-faq">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 980px;">
    
    <div class="text-center mb-5">
      <div class="srv-eyebrow-pill">FREQUENTLY ASKED QUESTIONS</div>
      <h2 class="h2 fw-bold text-dark mb-0">Common Implementation & Technical Queries</h2>
      <span class="srv-gold-line"></span>
    </div>

    <div class="accordion srv-faq-box" id="serviceFaqAcc">
      <?php foreach ($service['faqs'] as $fIdx => $faq): ?>
        <div class="accordion-item">
          <h3 class="accordion-header" id="faqH<?= $fIdx ?>">
            <button class="accordion-button <?= $fIdx === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faqC<?= $fIdx ?>" aria-expanded="<?= $fIdx === 0 ? 'true' : 'false' ?>">
              <?= e($faq['q']) ?>
            </button>
          </h3>
          <div id="faqC<?= $fIdx ?>" class="accordion-collapse collapse <?= $fIdx === 0 ? 'show' : '' ?>" data-bs-parent="#serviceFaqAcc">
            <div class="accordion-body">
              <?= e($faq['a']) ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     7. EXECUTIVE CTA & LEAD CAPTURE
══════════════════════════════════════════════════ -->
<section class="py-5" id="lead-form" style="background:#F8FAFC;">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1240px;">
    
    <div class="srv-cta-container">
      <div class="row align-items-center g-5">
        
        <div class="col-lg-6">
          <div class="srv-eyebrow-pill" style="background:rgba(220,148,35,0.2);">SCHEDULE FREE CONSULTATION</div>
          <h2 class="h2 fw-bold text-white mb-3">Ready to Transform Your Jewellery Operations?</h2>
          <p class="text-light text-opacity-75 fs-15 mb-4">
            Get a tailored live demonstration with our senior jewellery ERP architects. We will show you live estimation slips, barcode generation, jobwork accounts, and multi-branch management.
          </p>

          <div class="d-flex flex-column gap-3 mb-4">
            <div class="d-flex align-items-center gap-3 text-light fs-14">
              <i class="bi bi-check-circle-fill text-warning fs-5"></i>
              <span>Live software simulation with your jewellery inventory data</span>
            </div>
            <div class="d-flex align-items-center gap-3 text-light fs-14">
              <i class="bi bi-check-circle-fill text-warning fs-5"></i>
              <span>Hardware setup guidance (Barcode, RFID, Weighing Scale, Printers)</span>
            </div>
            <div class="d-flex align-items-center gap-3 text-light fs-14">
              <i class="bi bi-check-circle-fill text-warning fs-5"></i>
              <span>Transparent pricing & turnkey data migration roadmap</span>
            </div>
          </div>

          <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-10">
            <div class="fs-12 text-warning fw-bold text-uppercase mb-1">Direct Consultant Helpline</div>
            <div class="fs-15 fw-bold text-white"><i class="bi bi-telephone-fill text-warning me-2"></i>+971 56 324 0319 / +91 92703 69937</div>
          </div>
        </div>

        <!-- Lead Form -->
        <div class="col-lg-6">
          <div class="bg-white rounded-4 p-4 p-md-5 text-dark shadow-lg">
            <h4 class="fw-bold text-dark mb-1 fs-20">Book Your Free Live Demo</h4>
            <p class="text-muted fs-13 mb-4">Enter your details and our team will coordinate a screen share demo.</p>

            <form id="serviceLeadForm" onsubmit="handleLeadSubmit(event)">
              <input type="hidden" name="service" value="<?= e($service['title']) ?>">

              <div class="mb-3">
                <label class="form-label fs-12 fw-bold text-secondary mb-1">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Rajesh Mehta" required>
              </div>

              <div class="row g-2 mb-3">
                <div class="col-md-6">
                  <label class="form-label fs-12 fw-bold text-secondary mb-1">Mobile / WhatsApp <span class="text-danger">*</span></label>
                  <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fs-12 fw-bold text-secondary mb-1">Email Address</label>
                  <input type="email" name="email" class="form-control" placeholder="rajesh@jewellers.com">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-bold text-secondary mb-1">Company / Showroom Name</label>
                <input type="text" name="company" class="form-control" placeholder="e.g. Mehta Jewellers">
              </div>

              <div class="mb-4">
                <label class="form-label fs-12 fw-bold text-secondary mb-1">Requirements / Message (Optional)</label>
                <textarea name="message" class="form-control" rows="2" placeholder="Tell us about your showroom branches or manufacturing units..."></textarea>
              </div>

              <button type="submit" id="submitLeadBtn" class="btn btn-navy w-100 py-3 fw-bold fs-15 text-white" style="background:#001540;">
                <span id="btnText">Connect with Our Team Now</span>
                <i class="bi bi-arrow-right ms-1"></i>
              </button>

              <div id="leadFormFeedback" class="mt-3" style="display:none;"></div>
            </form>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

<script>
function handleLeadSubmit(e) {
  e.preventDefault();
  const form = document.getElementById('serviceLeadForm');
  const btn = document.getElementById('submitLeadBtn');
  const btnText = document.getElementById('btnText');
  const feedback = document.getElementById('leadFormFeedback');

  btn.disabled = true;
  btnText.innerText = 'Submitting Request...';

  const formData = new FormData(form);

  fetch('/api/contact-lead', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    feedback.style.display = 'block';
    if (data.success) {
      feedback.className = 'alert alert-success py-2 px-3 fs-13 mt-3';
      feedback.innerText = data.message;
      form.reset();
    } else {
      feedback.className = 'alert alert-danger py-2 px-3 fs-13 mt-3';
      feedback.innerText = data.message || 'Please check form inputs.';
    }
  })
  .catch(err => {
    feedback.style.display = 'block';
    feedback.className = 'alert alert-danger py-2 px-3 fs-13 mt-3';
    feedback.innerText = 'Network error. Please WhatsApp us at +91 92703 69937.';
  })
  .finally(() => {
    btn.disabled = false;
    btnText.innerText = 'Connect with Our Team Now';
  });
}
</script>

<?php
require __DIR__ . '/partials/footer.php';
?>
