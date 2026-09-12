<?php
/**
 * GoldMatrix — About Us Page
 * Positioning: Technology Built Around the Jewellery Business
 * Location: views/frontend/about.php
 */
require __DIR__ . '/partials/header.php';
?>

<style>
/* ══════════════════════════════════════════════════════
   ABOUT PAGE LUXURY ENTERPRISE STYLING
══════════════════════════════════════════════════════ */
:root {
  --ab-navy-deep: #001540;
  --ab-navy-dark: #000B2A;
  --ab-navy-night: #030816;
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

/* Hero Section */
.about-hero-section {
  background-color: var(--ab-navy-deep);
  background-image: 
    radial-gradient(circle at 50% 0%, rgba(13, 34, 88, 0.8) 0%, rgba(0, 21, 64, 0.98) 70%),
    radial-gradient(rgba(220, 148, 35, 0.08) 1px, transparent 1px);
  background-size: 100% 100%, 32px 32px;
  padding: 130px 5% 90px;
  color: #FFFFFF;
  position: relative;
  border-bottom: 1px solid rgba(220, 148, 35, 0.2);
  text-align: center;
}
.about-eyebrow-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--ab-gold-amber);
  background: rgba(245, 158, 11, 0.1);
  border: 1px solid rgba(245, 158, 11, 0.28);
  padding: 6px 18px;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 20px;
}
.about-hero-h1 {
  font-size: clamp(2.3rem, 4.4vw, 3.6rem);
  font-weight: 800;
  line-height: 1.18;
  letter-spacing: -0.03em;
  color: #FFFFFF;
  margin-bottom: 24px;
  max-width: 980px;
  margin-left: auto;
  margin-right: auto;
}
.about-hero-lead {
  font-size: clamp(16px, 1.8vw, 18.5px);
  line-height: 1.75;
  color: #CBD5E1;
  max-width: 860px;
  margin: 0 auto 20px;
}
.about-hero-subtext {
  font-size: 15.5px;
  line-height: 1.7;
  color: #94A3B8;
  max-width: 820px;
  margin: 0 auto 32px;
}
.about-goal-pill {
  display: inline-block;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(220, 148, 35, 0.35);
  padding: 16px 28px;
  border-radius: 12px;
  color: #F8FAFC;
  font-size: 15px;
  font-weight: 500;
  line-height: 1.6;
  max-width: 820px;
  margin: 0 auto 36px;
  backdrop-filter: blur(8px);
}
.about-goal-pill strong {
  color: var(--ab-gold-light);
}

/* Standard Section Headings */
.ab-section-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--ab-gold);
  font-size: 12px;
  font-weight: 750;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.ab-section-badge::before,
.ab-section-badge::after {
  content: "";
  display: inline-block;
  width: 18px;
  height: 1.5px;
  background: var(--ab-gold);
}
.ab-section-h2 {
  font-size: clamp(1.9rem, 3.2vw, 2.6rem);
  font-weight: 800;
  color: var(--ab-slate-900);
  line-height: 1.25;
  letter-spacing: -0.02em;
  margin-bottom: 16px;
}
.ab-section-p {
  font-size: 15.5px;
  color: var(--ab-slate-600);
  line-height: 1.8;
  max-width: 800px;
}

/* Section: Realities & 10 Workflows */
.section-ab-realities {
  background: #FFFFFF;
  padding: 95px 5%;
}
.realities-intro-card {
  background: var(--ab-slate-50);
  border: 1px solid var(--ab-slate-200);
  border-radius: 16px;
  padding: 32px 36px;
  margin-bottom: 40px;
}
.workflow-grid-card {
  background: #FFFFFF;
  border: 1px solid var(--ab-slate-200);
  border-radius: 12px;
  padding: 20px 22px;
  height: 100%;
  display: flex;
  align-items: center;
  gap: 16px;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
.workflow-grid-card:hover {
  transform: translateY(-4px);
  border-color: var(--ab-gold);
  box-shadow: 0 10px 24px -6px rgba(0, 21, 64, 0.08);
}
.workflow-icon-box {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: rgba(220, 148, 35, 0.1);
  color: var(--ab-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.workflow-name {
  font-size: 14.5px;
  font-weight: 700;
  color: var(--ab-slate-900);
  margin: 0;
}

/* Section: One Connected Platform (6 Modules) */
.section-ab-platform {
  background: var(--ab-slate-50);
  padding: 100px 5%;
  border-top: 1px solid var(--ab-slate-200);
  border-bottom: 1px solid var(--ab-slate-200);
}
.module-connected-card {
  background: #FFFFFF;
  border: 1px solid var(--ab-slate-200);
  border-radius: 16px;
  padding: 34px 28px;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
}
.module-connected-card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 3.5px;
  background: transparent;
  transition: background 0.3s ease;
}
.module-connected-card:hover {
  transform: translateY(-6px);
  border-color: #CBD5E1;
  box-shadow: 0 14px 30px -8px rgba(0, 21, 64, 0.1);
}
.module-connected-card:hover::before {
  background: var(--ab-gold);
}
.module-card-icon {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  background: rgba(0, 21, 64, 0.05);
  color: var(--ab-navy-deep);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  margin-bottom: 22px;
  transition: all 0.25s ease;
}
.module-connected-card:hover .module-card-icon {
  background: var(--ab-navy-deep);
  color: var(--ab-gold);
}
.module-card-title {
  font-size: 19px;
  font-weight: 750;
  color: var(--ab-slate-900);
  margin-bottom: 12px;
}
.module-card-desc {
  font-size: 14.5px;
  color: var(--ab-slate-600);
  line-height: 1.65;
  margin-bottom: 0;
  flex-grow: 1;
}

/* Section: Jewellery Industry Expertise (5 Tenets) */
.section-ab-expertise {
  background: #FFFFFF;
  padding: 95px 5%;
}
.expertise-tenet-card {
  background: #FFFFFF;
  border: 1px solid var(--ab-slate-200);
  border-radius: 14px;
  padding: 30px 26px;
  height: 100%;
  transition: all 0.25s ease;
}
.expertise-tenet-card:hover {
  border-color: var(--ab-gold);
  transform: translateY(-4px);
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.06);
}
.tenet-num {
  font-size: 13px;
  font-weight: 800;
  color: var(--ab-gold);
  letter-spacing: 1.5px;
  margin-bottom: 12px;
}
.tenet-title {
  font-size: 17.5px;
  font-weight: 750;
  color: var(--ab-slate-900);
  margin-bottom: 10px;
}
.tenet-desc {
  font-size: 14px;
  color: var(--ab-slate-600);
  line-height: 1.65;
  margin: 0;
}

/* Section: Designed for Business Growth */
.section-ab-growth {
  background: var(--ab-navy-deep);
  padding: 95px 5%;
  color: #FFFFFF;
  position: relative;
  overflow: hidden;
}
.section-ab-growth::before {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 80% 20%, rgba(220, 148, 35, 0.12) 0%, transparent 60%);
  pointer-events: none;
}
.growth-badge-chip {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 999px;
  padding: 10px 22px;
  color: #FFFFFF;
  font-size: 14px;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  transition: all 0.2s ease;
}
.growth-badge-chip:hover {
  background: rgba(220, 148, 35, 0.18);
  border-color: var(--ab-gold);
  transform: translateY(-2px);
}
.growth-badge-chip i {
  color: var(--ab-gold-light);
}

/* Section: Customer-First Methodology (5 Pillars) */
.section-ab-approach {
  background: #FFFFFF;
  padding: 95px 5%;
}
.approach-card {
  background: var(--ab-slate-50);
  border: 1px solid var(--ab-slate-200);
  border-radius: 14px;
  padding: 30px 24px;
  height: 100%;
  transition: all 0.25s ease;
}
.approach-card:hover {
  background: #FFFFFF;
  border-color: var(--ab-gold);
  transform: translateY(-4px);
  box-shadow: 0 12px 26px -6px rgba(0, 21, 64, 0.08);
}
.approach-icon-wrap {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: #FFFFFF;
  border: 1px solid var(--ab-slate-200);
  color: var(--ab-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 20px;
}
.approach-title {
  font-size: 17.5px;
  font-weight: 750;
  color: var(--ab-slate-900);
  margin-bottom: 10px;
}
.approach-desc {
  font-size: 14px;
  color: var(--ab-slate-600);
  line-height: 1.65;
  margin: 0;
}

/* Section: Global Presence & Dual Hubs */
.section-ab-hubs {
  background: var(--ab-slate-50);
  padding: 95px 5%;
  border-top: 1px solid var(--ab-slate-200);
}
.hub-location-card {
  background: #FFFFFF;
  border: 1px solid var(--ab-slate-200);
  border-radius: 16px;
  padding: 36px 32px;
  height: 100%;
  box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
}
.hub-tag {
  font-size: 11px;
  font-weight: 800;
  color: var(--ab-gold);
  letter-spacing: 1.8px;
  text-transform: uppercase;
  margin-bottom: 10px;
}
.hub-city-title {
  font-size: 22px;
  font-weight: 800;
  color: var(--ab-slate-900);
  margin-bottom: 20px;
}
.hub-info-row {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  font-size: 14.5px;
  color: var(--ab-slate-600);
  line-height: 1.6;
  margin-bottom: 14px;
}
.hub-info-row i {
  color: var(--ab-navy-deep);
  font-size: 17px;
  margin-top: 2px;
  flex-shrink: 0;
}
.hub-info-row a {
  color: var(--ab-slate-900);
  text-decoration: none;
  font-weight: 600;
}
.hub-info-row a:hover {
  color: var(--ab-gold);
}

/* Section: Commitment & Creed */
.section-ab-creed {
  background: #FFFFFF;
  padding: 85px 5%;
  border-top: 1px solid var(--ab-slate-200);
}
.creed-box {
  background: linear-gradient(145deg, #06153B 0%, #000B2A 100%);
  border: 1px solid rgba(220, 148, 35, 0.35);
  border-radius: 20px;
  padding: 50px 40px;
  color: #FFFFFF;
  text-align: center;
  box-shadow: 0 16px 40px -10px rgba(0, 21, 64, 0.2);
}
.creed-pillars-wrap {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  margin: 30px 0 24px;
}
.creed-pillar-item {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(220, 148, 35, 0.4);
  border-radius: 50px;
  padding: 12px 28px;
  font-size: 16px;
  font-weight: 700;
  color: #FFFFFF;
  display: inline-flex;
  align-items: center;
  gap: 10px;
}
.creed-pillar-item i {
  color: var(--ab-gold-light);
}

/* Bottom CTA Banner */
.about-bottom-cta-banner {
  background: var(--ab-navy-deep);
  padding: 90px 5%;
  color: #FFFFFF;
  text-align: center;
  border-top: 1px solid rgba(220, 148, 35, 0.2);
}
.btn-ab-primary {
  background-color: var(--ab-gold-light);
  color: var(--ab-slate-900);
  font-weight: 750;
  font-size: 15px;
  padding: 14px 32px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  border: 1px solid var(--ab-gold-light);
  transition: all 0.2s ease-in-out;
  cursor: pointer;
}
.btn-ab-primary:hover {
  background-color: var(--ab-gold);
  color: var(--ab-slate-900);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(220, 148, 35, 0.3);
}
.btn-ab-secondary {
  background: rgba(255, 255, 255, 0.08);
  color: #FFFFFF;
  font-weight: 650;
  font-size: 15px;
  padding: 14px 28px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.2s ease;
}
.btn-ab-secondary:hover {
  background: rgba(255, 255, 255, 0.16);
  color: #FFFFFF;
  transform: translateY(-2px);
}
</style>

<!-- ══════════════════════════════════════════════════
     1. HERO BANNER & CORE POSITIONING
══════════════════════════════════════════════════ -->
<section class="about-hero-section">
  <div class="container" style="max-width: 1060px;">
    
    <div class="about-eyebrow-badge">
      <i class="bi bi-gem"></i>
      <span>ABOUT GOLDMATRIX</span>
    </div>

    <h1 class="about-hero-h1">
      Technology Built Around the Jewellery Business
    </h1>

    <p class="about-hero-lead">
      GoldMatrix is a jewellery-focused software technology provider helping businesses manage the complexity of modern jewellery operations through connected, purpose-built business software.
    </p>

    <p class="about-hero-subtext">
      Unlike generic business management systems, GoldMatrix is designed around the workflows that matter to jewellery businesses—from inventory and sales to manufacturing, jobwork, accounting, customer management and business reporting.
    </p>

    <div class="about-goal-pill">
      <strong>Our goal is simple:</strong> give jewellery businesses greater control over their operations, better visibility into their data, and the technology they need to grow with confidence.
    </div>

    <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 pt-2">
      <button type="button" class="btn-ab-primary" data-bs-toggle="modal" data-bs-target="#bookDemoModal">
        <span>Book a Personal Demo</span>
        <i class="bi bi-arrow-right"></i>
      </button>
      <a href="/features" class="btn-ab-secondary">
        <span>Explore Platform Features</span>
        <i class="bi bi-grid"></i>
      </a>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     2. BUILT FOR THE REALITIES OF JEWELLERY BUSINESSES
══════════════════════════════════════════════════ -->
<section class="section-ab-realities">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1320px;">
    
    <div class="text-center mb-5">
      <div class="ab-section-badge">PURPOSE-BUILT ARCHITECTURE</div>
      <h2 class="ab-section-h2">Built for the Realities of Jewellery Businesses</h2>
      <p class="ab-section-p mx-auto">
        Jewellery businesses operate differently from conventional retail and trading businesses. Products can involve precious metals, diamonds and stones, varying purity and carat values, weight-based transactions, changing rates, manufacturing processes, jobwork, repairs, stock transfers and high-value inventory. GoldMatrix brings these requirements together in a single business-management environment.
      </p>
    </div>

    <!-- 10 Core Operational Capability Workflows -->
    <div class="row g-3">
      <?php
      $workflowAreas = [
        ['title' => 'Retail & Showrooms',                       'icon' => 'bi-shop'],
        ['title' => 'Wholesale & Trading',                      'icon' => 'bi-box-seam'],
        ['title' => 'Jewellery Manufacturing',                  'icon' => 'bi-hammer'],
        ['title' => 'Jobwork & Production',                     'icon' => 'bi-gear-wide-connected'],
        ['title' => 'Inventory & Stock Management',             'icon' => 'bi-boxes'],
        ['title' => 'Accounting & Financial Operations',        'icon' => 'bi-calculator'],
        ['title' => 'Customer Relationship Management (CRM)',   'icon' => 'bi-people'],
        ['title' => 'Gold, Silver, Platinum & Stone Workflows', 'icon' => 'bi-gem'],
        ['title' => 'Barcode & RFID Workflows',                 'icon' => 'bi-upc-scan'],
        ['title' => 'Business Reporting & Analytics',           'icon' => 'bi-graph-up-arrow']
      ];
      ?>
      <?php foreach ($workflowAreas as $wf): ?>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="workflow-grid-card">
            <div class="workflow-icon-box">
              <i class="bi <?= e($wf['icon']) ?>"></i>
            </div>
            <h3 class="workflow-name"><?= e($wf['title']) ?></h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="realities-intro-card mt-4 text-center">
      <p class="mb-0 text-secondary fs-15">
        <i class="bi bi-info-circle text-warning me-2"></i>
        These capabilities are reflected in the documented GoldMatrix product structure, which includes dedicated modules for inventory, orders, production, financial statements, reports, employees and business controls.
      </p>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     3. ONE PLATFORM FOR CONNECTED JEWELLERY OPERATIONS
══════════════════════════════════════════════════ -->
<section class="section-ab-platform">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1320px;">
    
    <div class="text-center mb-5">
      <div class="ab-section-badge">CONNECTED ECOSYSTEM</div>
      <h2 class="ab-section-h2">One Platform for Connected Jewellery Operations</h2>
      <p class="ab-section-p mx-auto">
        GoldMatrix brings important business processes together instead of leaving teams dependent on disconnected systems. From product catalogue and stock management to sales orders, manufacturing work orders, jobwork queues, financial statements and business reports, the platform is designed to create a more connected flow of information across the business. This helps jewellery businesses work with greater consistency while giving owners and management teams clearer visibility into day-to-day operations.
      </p>
    </div>

    <!-- 6 Pillar Modules -->
    <div class="row g-4">
      
      <!-- 1. Retail & POS -->
      <div class="col-lg-4 col-md-6">
        <div class="module-connected-card">
          <div class="module-card-icon">
            <i class="bi bi-cart-check"></i>
          </div>
          <h3 class="module-card-title">Retail &amp; POS</h3>
          <p class="module-card-desc">
            Manage jewellery sales, billing, customer information, inventory and store operations through a dedicated retail environment.
          </p>
        </div>
      </div>

      <!-- 2. Inventory Management -->
      <div class="col-lg-4 col-md-6">
        <div class="module-connected-card">
          <div class="module-card-icon">
            <i class="bi bi-boxes"></i>
          </div>
          <h3 class="module-card-title">Inventory Management</h3>
          <p class="module-card-desc">
            Manage jewellery products and stock across precious metals, diamonds, stones and other inventory categories, with support for barcode and RFID-based workflows.
          </p>
        </div>
      </div>

      <!-- 3. Manufacturing & Jobwork -->
      <div class="col-lg-4 col-md-6">
        <div class="module-connected-card">
          <div class="module-card-icon">
            <i class="bi bi-gear-wide-connected"></i>
          </div>
          <h3 class="module-card-title">Manufacturing &amp; Jobwork</h3>
          <p class="module-card-desc">
            Organize production through departments, manufacturing processes, jobwork queues, worklogs, jobcards and production reporting.
          </p>
        </div>
      </div>

      <!-- 4. Accounting & Tax -->
      <div class="col-lg-4 col-md-6">
        <div class="module-connected-card">
          <div class="module-card-icon">
            <i class="bi bi-receipt-cutoff"></i>
          </div>
          <h3 class="module-card-title">Accounting &amp; Tax</h3>
          <p class="module-card-desc">
            Connect financial operations with business activity through ledgers, financial statements, sales and purchase reporting and tax-related workflows.
          </p>
        </div>
      </div>

      <!-- 5. CRM & Customer Management -->
      <div class="col-lg-4 col-md-6">
        <div class="module-connected-card">
          <div class="module-card-icon">
            <i class="bi bi-people"></i>
          </div>
          <h3 class="module-card-title">CRM &amp; Customer Management</h3>
          <p class="module-card-desc">
            Maintain customer information and support relationship-driven jewellery sales and service workflows.
          </p>
        </div>
      </div>

      <!-- 6. Reporting & Analytics -->
      <div class="col-lg-4 col-md-6">
        <div class="module-connected-card">
          <div class="module-card-icon">
            <i class="bi bi-graph-up-arrow"></i>
          </div>
          <h3 class="module-card-title">Reporting &amp; Analytics</h3>
          <p class="module-card-desc">
            Turn operational and financial data into structured reports for business monitoring and decision-making.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     4. JEWELLERY INDUSTRY EXPERTISE AT THE CORE
══════════════════════════════════════════════════ -->
<section class="section-ab-expertise">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1320px;">
    
    <div class="text-center mb-5">
      <div class="ab-section-badge">DOMAIN MASTERY</div>
      <h2 class="ab-section-h2">Jewellery Industry Expertise at the Core</h2>
      <p class="ab-section-p mx-auto">
        GoldMatrix is built around an understanding of how jewellery businesses actually operate. This industry-specific approach is one of the central reasons GoldMatrix positions itself differently from generic ERP software.
      </p>
    </div>

    <!-- 5 Specific Tenets -->
    <div class="row g-4 justify-content-center">
      
      <!-- 1 -->
      <div class="col-lg-4 col-md-6">
        <div class="expertise-tenet-card">
          <div class="tenet-num">TENET 01</div>
          <h3 class="tenet-title">Precious-Metal Inventory</h3>
          <p class="tenet-desc">
            Manage products where weight, purity, carat and metal type matter with complete calculation precision.
          </p>
        </div>
      </div>

      <!-- 2 -->
      <div class="col-lg-4 col-md-6">
        <div class="expertise-tenet-card">
          <div class="tenet-num">TENET 02</div>
          <h3 class="tenet-title">Manufacturing &amp; Jobwork</h3>
          <p class="tenet-desc">
            Follow production activities through departments and manufacturing stages with granular jobcard and loss tracking.
          </p>
        </div>
      </div>

      <!-- 3 -->
      <div class="col-lg-4 col-md-6">
        <div class="expertise-tenet-card">
          <div class="tenet-num">TENET 03</div>
          <h3 class="tenet-title">High-Value Inventory</h3>
          <p class="tenet-desc">
            Maintain greater visibility over products, stock movements, approvals and high-security vault inventory information.
          </p>
        </div>
      </div>

      <!-- 4 -->
      <div class="col-lg-4 col-md-6">
        <div class="expertise-tenet-card">
          <div class="tenet-num">TENET 04</div>
          <h3 class="tenet-title">Multi-Location Operations</h3>
          <p class="tenet-desc">
            Support businesses that need centralized visibility across stores, branches, wholesale counters or operational locations.
          </p>
        </div>
      </div>

      <!-- 5 -->
      <div class="col-lg-4 col-md-6">
        <div class="expertise-tenet-card">
          <div class="tenet-num">TENET 05</div>
          <h3 class="tenet-title">Customer Relationships</h3>
          <p class="tenet-desc">
            Bring customer information, purchase activity, gold saving schemes and business interactions into a connected environment.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     5. DESIGNED FOR BUSINESS GROWTH
══════════════════════════════════════════════════ -->
<section class="section-ab-growth">
  <div class="container-fluid px-3 px-xl-5 position-relative" style="max-width: 1320px;">
    
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="ab-section-badge text-warning" style="border-color: rgba(245, 158, 11, 0.4);">SCALE WITHOUT LIMITS</div>
        <h2 class="ab-section-h2 text-white">Designed for Sustainable Business Growth</h2>
        <p class="text-white-50 fs-16 lh-lg mb-4">
          Technology should not become another limitation as a jewellery business grows. GoldMatrix is designed to support businesses from individual retail operations through more complex multi-location and manufacturing environments.
        </p>
        <p class="text-white-50 fs-16 lh-lg mb-4">
          As operations become more sophisticated, businesses can use connected software to improve their operational foundation.
        </p>
        <div class="p-3 rounded-3 bg-white bg-opacity-10 border border-white border-opacity-15">
          <p class="mb-0 text-white fs-15">
            <strong>The objective is simple:</strong> Not merely to digitize individual tasks, but to create a stronger operational foundation for sustainable business growth.
          </p>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="d-flex flex-wrap gap-3">
          <div class="growth-badge-chip">
            <i class="bi bi-eye"></i>
            <span>Operational Visibility</span>
          </div>
          <div class="growth-badge-chip">
            <i class="bi bi-shield-check"></i>
            <span>Inventory Control</span>
          </div>
          <div class="growth-badge-chip">
            <i class="bi bi-arrow-repeat"></i>
            <span>Process Consistency</span>
          </div>
          <div class="growth-badge-chip">
            <i class="bi bi-file-earmark-bar-graph"></i>
            <span>Structured Reporting</span>
          </div>
          <div class="growth-badge-chip">
            <i class="bi bi-person-heart"></i>
            <span>Customer Management</span>
          </div>
          <div class="growth-badge-chip">
            <i class="bi bi-cpu"></i>
            <span>Production Monitoring</span>
          </div>
          <div class="growth-badge-chip">
            <i class="bi bi-check2-circle"></i>
            <span>Informed Decision-Making</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     6. TECHNOLOGY WITH A CUSTOMER-FIRST APPROACH
══════════════════════════════════════════════════ -->
<section class="section-ab-approach">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1320px;">
    
    <div class="text-center mb-5">
      <div class="ab-section-badge">OUR METHODOLOGY</div>
      <h2 class="ab-section-h2">Technology With a Customer-First Approach</h2>
      <p class="ab-section-p mx-auto">
        Successful software implementation goes beyond features. GoldMatrix combines jewellery-domain understanding with software development and customer support to help businesses adopt technology that fits their operational requirements.
      </p>
    </div>

    <!-- 5 Pillars -->
    <div class="row g-4">
      
      <!-- 1 -->
      <div class="col-lg-4 col-md-6">
        <div class="approach-card">
          <div class="approach-icon-wrap">
            <i class="bi bi-lightbulb"></i>
          </div>
          <h3 class="approach-title">Industry Understanding</h3>
          <p class="approach-desc">
            Software designed around real jewellery workflows rather than generic retail assumptions.
          </p>
        </div>
      </div>

      <!-- 2 -->
      <div class="col-lg-4 col-md-6">
        <div class="approach-card">
          <div class="approach-icon-wrap">
            <i class="bi bi-check2-square"></i>
          </div>
          <h3 class="approach-title">Accuracy &amp; Control</h3>
          <p class="approach-desc">
            Structured processes and reporting designed to improve operational visibility and reduce manual errors.
          </p>
        </div>
      </div>

      <!-- 3 -->
      <div class="col-lg-4 col-md-6">
        <div class="approach-card">
          <div class="approach-icon-wrap">
            <i class="bi bi-diagram-3"></i>
          </div>
          <h3 class="approach-title">Scalable Technology</h3>
          <p class="approach-desc">
            A technology platform designed to support growing business requirements and connected operations.
          </p>
        </div>
      </div>

      <!-- 4 -->
      <div class="col-lg-4 col-md-6">
        <div class="approach-card">
          <div class="approach-icon-wrap">
            <i class="bi bi-ui-checks"></i>
          </div>
          <h3 class="approach-title">Practical Usability</h3>
          <p class="approach-desc">
            Interfaces and workflows designed to help showroom and manufacturing teams perform everyday tasks efficiently.
          </p>
        </div>
      </div>

      <!-- 5 -->
      <div class="col-lg-4 col-md-6">
        <div class="approach-card">
          <div class="approach-icon-wrap">
            <i class="bi bi-handshake"></i>
          </div>
          <h3 class="approach-title">Long-Term Partnership</h3>
          <p class="approach-desc">
            Supporting businesses beyond software deployment with ongoing product improvements and customer assistance.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     7. BUILT FOR JEWELLERY BUSINESSES WORLDWIDE
══════════════════════════════════════════════════ -->
<section class="section-ab-hubs">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1320px;">
    
    <div class="text-center mb-5">
      <div class="ab-section-badge">GLOBAL HUBS &amp; REACH</div>
      <h2 class="ab-section-h2">Built for Jewellery Businesses Worldwide</h2>
      <p class="ab-section-p mx-auto">
        GoldMatrix serves jewellery businesses across key international jewellery markets, including the UAE, India, Hong Kong, Singapore and the UK. Our dual operational presence combines an international corporate office in Sharjah, UAE, alongside our core development and technology engineering centre in Maharashtra, India.
      </p>
    </div>

    <div class="row g-4">
      
      <!-- Hub 1: UAE -->
      <div class="col-lg-6">
        <div class="hub-location-card">
          <div class="hub-tag">INTERNATIONAL HEADQUARTER</div>
          <h3 class="hub-city-title">Sharjah, UAE</h3>
          <div class="hub-info-row">
            <i class="bi bi-geo-alt"></i>
            <span><?= e(setting('contact_uae_address', 'Shop No. 25/A, Central Gold Souq Block No. 8, Al Majaz -1 King Faisal Road - Sharjah, UAE')) ?></span>
          </div>
          <div class="hub-info-row">
            <i class="bi bi-telephone"></i>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', setting('contact_uae_phone', '+971 56 324 0319')) ?>"><?= e(setting('contact_uae_phone', '+971 56 324 0319')) ?></a>
          </div>
          <div class="hub-info-row">
            <i class="bi bi-envelope"></i>
            <a href="mailto:<?= e(setting('contact_uae_email', 'info@goldmatrixsoftware.com')) ?>"><?= e(setting('contact_uae_email', 'info@goldmatrixsoftware.com')) ?></a>
          </div>
        </div>
      </div>

      <!-- Hub 2: India -->
      <div class="col-lg-6">
        <div class="hub-location-card">
          <div class="hub-tag">DEVELOPMENT &amp; TECH HUB</div>
          <h3 class="hub-city-title">Maharashtra, India</h3>
          <div class="hub-info-row">
            <i class="bi bi-building"></i>
            <span><?= e(setting('contact_india_address', 'India, 01/A, Hingna Rd, M.I.D.C, Maharashtra - 440022')) ?></span>
          </div>
          <div class="hub-info-row">
            <i class="bi bi-telephone"></i>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', setting('contact_india_phone', '+91 92703 69937')) ?>"><?= e(setting('contact_india_phone', '+91 92703 69937')) ?></a>
          </div>
          <div class="hub-info-row">
            <i class="bi bi-envelope"></i>
            <a href="mailto:<?= e(setting('contact_india_email', 'goldmatrixsoftware@gmail.com')) ?>"><?= e(setting('contact_india_email', 'goldmatrixsoftware@gmail.com')) ?></a>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     8. OUR COMMITMENT & BRAND CREED
══════════════════════════════════════════════════ -->
<section class="section-ab-creed">
  <div class="container" style="max-width: 1060px;">
    
    <div class="creed-box">
      <div class="ab-section-badge text-warning" style="border-color: rgba(245, 158, 11, 0.4);">OUR COMMITMENT</div>
      <h2 class="h2 fw-bold text-white mb-3">Dedicated to the Future of Jewellery Technology</h2>
      <p class="text-white-50 fs-16 max-w-750 mx-auto mb-4">
        At GoldMatrix, we believe jewellery businesses deserve technology that understands their industry. We are committed to continuously improving our software around the evolving needs of jewellery retailers, wholesalers, manufacturers and other jewellery businesses.
      </p>

      <div class="creed-pillars-wrap">
        <div class="creed-pillar-item">
          <i class="bi bi-shield-lock"></i>
          <span>Better Control</span>
        </div>
        <div class="creed-pillar-item">
          <i class="bi bi-eye"></i>
          <span>Better Visibility</span>
        </div>
        <div class="creed-pillar-item">
          <i class="bi bi-link-45deg"></i>
          <span>Better-Connected Operations</span>
        </div>
      </div>

      <p class="text-white fs-15 fst-italic mb-0">
        "And ultimately, technology that helps jewellery businesses operate more efficiently and build for the future."
      </p>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     9. READY TO MODERNIZE YOUR JEWELLERY BUSINESS? (CTA)
══════════════════════════════════════════════════ -->
<section class="about-bottom-cta-banner">
  <div class="container" style="max-width: 900px;">
    
    <h2 class="h2 fw-bold text-white mb-3">Ready to Modernize Your Jewellery Business?</h2>
    
    <p class="text-white-50 fs-16 mb-4 max-w-700 mx-auto">
      Discover how GoldMatrix can bring your sales, inventory, manufacturing, accounting, customer management and reporting into one connected software platform.
    </p>

    <div class="d-flex flex-wrap justify-content-center gap-3">
      <button type="button" class="btn-ab-primary" data-bs-toggle="modal" data-bs-target="#bookDemoModal">
        <span>Book a Personal Demo</span>
        <i class="bi bi-arrow-right"></i>
      </button>
      <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', setting('contact_india_phone', '919270369937')) ?>?text=Hello%20GoldMatrix%20Team%2C%20I%20would%20like%20to%20learn%20more%20about%20your%20Jewellery%20ERP%20software." target="_blank" class="btn-ab-secondary">
        <i class="bi bi-whatsapp text-success me-1"></i>
        <span>Talk to Our Team</span>
      </a>
    </div>

  </div>
</section>

<?php
require __DIR__ . '/partials/footer.php';
?>
