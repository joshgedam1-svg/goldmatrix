<?php
/**
 * GoldMatrix — Why Choose Us / Why GoldMatrix ERP
 * Deeply Aligned with 10 Core Enterprise Modules & Domain Differentiators
 * Location: views/frontend/why-us.php
 */
require __DIR__ . '/partials/header.php';
?>

<style>
/* ══════════════════════════════════════════════════════
   WHY CHOOSE GOLDMATRIX STYLING
══════════════════════════════════════════════════════ */
:root {
  --why-navy: #0A1128;
  --why-navy-dark: #050B18;
  --why-gold: #F59E0B;
  --why-gold-light: #FBBF24;
  --why-slate-900: #0F172A;
  --why-slate-800: #1E293B;
  --why-slate-600: #475569;
  --why-slate-500: #64748B;
  --why-slate-200: #E2E8F0;
  --why-slate-100: #F1F5F9;
  --why-slate-50: #F8FAFC;
}

/* 1. Hero Section */
.why-hero {
  background: var(--why-navy-dark);
  background: radial-gradient(circle at 50% 0%, #111C3A 0%, var(--why-navy-dark) 70%);
  padding: 135px 5% 85px;
  color: #FFFFFF;
  text-align: center;
  position: relative;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.why-eyebrow {
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  color: var(--why-gold);
  margin-bottom: 16px;
  display: inline-block;
}
.why-h1 {
  font-size: clamp(2.3rem, 4.2vw, 3.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.03em;
  color: #FFFFFF;
  margin-bottom: 20px;
}
.why-hero-sub {
  font-size: 17px;
  line-height: 1.7;
  color: #94A3B8;
  max-width: 760px;
  margin: 0 auto 34px;
}

/* 2. 10 Features Breakdown Cards Grid */
.section-why-features {
  background: #FFFFFF;
  padding: 90px 5%;
}
.why-feat-card {
  background: #FFFFFF;
  border: 1px solid var(--why-slate-200);
  border-radius: 14px;
  padding: 28px 24px;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: all 0.25s ease;
  position: relative;
}
.why-feat-card:hover {
  border-color: #94A3B8;
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(0,0,0,0.06);
}
.why-feat-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 18px;
}
.why-feat-icon {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: var(--why-slate-50);
  border: 1px solid var(--why-slate-200);
  color: var(--why-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}
.why-module-badge {
  font-size: 10.5px;
  font-weight: 700;
  color: var(--why-slate-500);
  background: var(--why-slate-100);
  padding: 4px 10px;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.why-feat-title {
  font-size: 17.5px;
  font-weight: 800;
  color: var(--why-slate-900);
  margin-bottom: 10px;
  line-height: 1.3;
}
.why-feat-desc {
  font-size: 13.8px;
  color: var(--why-slate-600);
  line-height: 1.65;
  margin-bottom: 16px;
  flex-grow: 1;
}
.why-feat-highlight {
  font-size: 12.5px;
  font-weight: 600;
  color: #059669;
  background: #ECFDF5;
  border: 1px solid #A7F3D0;
  padding: 8px 12px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}

/* 3. Comparison Section */
.section-comparison {
  background: var(--why-slate-50);
  padding: 90px 5%;
  border-top: 1px solid var(--why-slate-200);
}
.comp-table-card {
  background: #FFFFFF;
  border: 1px solid var(--why-slate-200);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
.comp-header-row {
  display: grid;
  grid-template-columns: 2fr 1.6fr 1.4fr;
  padding: 22px 28px;
  background: var(--why-slate-50);
  border-bottom: 2px solid var(--why-slate-200);
  font-weight: 700;
  font-size: 15px;
  color: var(--why-slate-900);
}
.comp-data-row {
  display: grid;
  grid-template-columns: 2fr 1.6fr 1.4fr;
  padding: 18px 28px;
  border-bottom: 1px solid var(--why-slate-200);
  align-items: center;
  font-size: 14px;
  transition: background 0.15s ease;
}
.comp-data-row:last-child {
  border-bottom: none;
}
.comp-data-row:hover {
  background: #F8FAFC;
}
.comp-goldmatrix-col {
  color: #059669;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 8px;
}
.comp-generic-col {
  color: #94A3B8;
  display: flex;
  align-items: center;
  gap: 8px;
}

/* 4. ROI Metrics Strip */
.section-why-metrics {
  background: var(--why-navy-dark);
  padding: 75px 5%;
  color: #FFFFFF;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.metric-box-item {
  text-align: center;
  padding: 20px;
}
.metric-num {
  font-size: clamp(2.2rem, 3.8vw, 3.2rem);
  font-weight: 900;
  color: var(--why-gold-light);
  line-height: 1;
  margin-bottom: 8px;
}
.metric-lbl {
  font-size: 14px;
  color: #94A3B8;
  font-weight: 600;
}

/* 5. Buttons & CTA */
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
.why-cta-sec {
  background: var(--why-navy-dark);
  padding: 85px 5%;
  color: #FFFFFF;
  text-align: center;
}

@media (max-width: 991px) {
  .comp-header-row, .comp-data-row {
    grid-template-columns: 1fr;
    gap: 8px;
  }
}
</style>

<!-- ══════════════════════════════════════════════════
     1. HERO BANNER
══════════════════════════════════════════════════ -->
<section class="why-hero">
  <div class="container" style="max-width: 960px;">
    
    <div class="why-eyebrow">PURPOSE-BUILT JEWELLERY ERP</div>

    <h1 class="why-h1">
      Why Leading Jewellers Choose GoldMatrix Over Generic ERPs
    </h1>

    <p class="why-hero-sub">
      Generic software like Tally, SAP, or Zoho cannot handle daily gold rate fluctuations, 4-decimal karat purities, Karigar metal loss, or 3-second RFID tray audits. GoldMatrix combines all 10 core jewellery operations in one connected platform.
    </p>

    <div class="d-flex flex-wrap align-items-center justify-content-center gap-3">
      <a href="/request-demo" class="btn-intl-primary">
        <span>Book Free 1-on-1 Demo</span>
        <i class="bi bi-arrow-right"></i>
      </a>
      <a href="/features" class="btn-intl-secondary">
        <span>Explore All 10 Features</span>
      </a>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     2. 10 FEATURE-ALIGNED ADVANTAGES
══════════════════════════════════════════════════ -->
<section class="section-why-features">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <div class="why-eyebrow">10 CORE MODULE ADVANTAGES</div>
      <h2 class="h2 fw-bold text-dark mb-2">How Each Module Powers Your Business</h2>
      <p class="text-muted fs-15 max-w-600 mx-auto">Engineered to eliminate calculation errors, lost inventory, and manual spreadsheet work across all departments.</p>
    </div>

    <div class="row g-4">
      
      <!-- Module 1 -->
      <div class="col-lg-4 col-md-6">
        <div class="why-feat-card">
          <div class="why-feat-top">
            <div class="why-feat-icon"><i class="bi bi-graph-up-arrow"></i></div>
            <span class="why-module-badge">Module 01</span>
          </div>
          <h3 class="why-feat-title">Dashboard &amp; Live Market Rates</h3>
          <p class="why-feat-desc">Broadcasts real-time 24K, 22K, 18K &amp; Silver market rates instantly to all showroom counter POS screens and HDMI TV rate boards.</p>
          <div class="why-feat-highlight">
            <i class="bi bi-check-circle-fill"></i>
            <span>Instant rate sync across 50+ stores</span>
          </div>
        </div>
      </div>

      <!-- Module 2 -->
      <div class="col-lg-4 col-md-6">
        <div class="why-feat-card">
          <div class="why-feat-top">
            <div class="why-feat-icon"><i class="bi bi-gear-wide-connected"></i></div>
            <span class="why-module-badge">Module 02</span>
          </div>
          <h3 class="why-feat-title">Opening Setup &amp; Decimal Accuracy</h3>
          <p class="why-feat-desc">Configures purity masters, stone classifications, and multi-currency registers with 0.0001g mathematical precision.</p>
          <div class="why-feat-highlight">
            <i class="bi bi-check-circle-fill"></i>
            <span>Zero rounding-off metal leakage</span>
          </div>
        </div>
      </div>

      <!-- Module 3 -->
      <div class="col-lg-4 col-md-6">
        <div class="why-feat-card">
          <div class="why-feat-top">
            <div class="why-feat-icon"><i class="bi bi-receipt"></i></div>
            <span class="why-module-badge">Module 03</span>
          </div>
          <h3 class="why-feat-title">Showroom Operations &amp; Touch POS</h3>
          <p class="why-feat-desc">3-second fast touch counter billing with barcode tag scanning, old gold melting exchange calculations, and customer saving schemes.</p>
          <div class="why-feat-highlight">
            <i class="bi bi-check-circle-fill"></i>
            <span>3x faster counter checkout</span>
          </div>
        </div>
      </div>

      <!-- Module 4 -->
      <div class="col-lg-4 col-md-6">
        <div class="why-feat-card">
          <div class="why-feat-top">
            <div class="why-feat-icon"><i class="bi bi-gem"></i></div>
            <span class="why-module-badge">Module 04</span>
          </div>
          <h3 class="why-feat-title">Custom Order &amp; Bridal Tracking</h3>
          <p class="why-feat-desc">End-to-end custom bridal order workflows with reference sample photos, gold rate advance locks, and delivery milestone alerts.</p>
          <div class="why-feat-highlight">
            <i class="bi bi-check-circle-fill"></i>
            <span>100% on-time bridal deliveries</span>
          </div>
        </div>
      </div>

      <!-- Module 5 -->
      <div class="col-lg-4 col-md-6">
        <div class="why-feat-card">
          <div class="why-feat-top">
            <div class="why-feat-icon"><i class="bi bi-hammer"></i></div>
            <span class="why-module-badge">Module 05</span>
          </div>
          <h3 class="why-feat-title">Manufacturing &amp; Karigar Wastage</h3>
          <p class="why-feat-desc">Tracks pure gold alloy issue, batch-wise work-in-progress (WIP), daily metal recovery, and enforces Karigar wastage % caps.</p>
          <div class="why-feat-highlight">
            <i class="bi bi-check-circle-fill"></i>
            <span>Strict metal loss accountability</span>
          </div>
        </div>
      </div>

      <!-- Module 6 -->
      <div class="col-lg-4 col-md-6">
        <div class="why-feat-card">
          <div class="why-feat-top">
            <div class="why-feat-icon"><i class="bi bi-calculator"></i></div>
            <span class="why-module-badge">Module 06</span>
          </div>
          <h3 class="why-feat-title">Financial Statements &amp; GST/VAT</h3>
          <p class="why-feat-desc">Automated split gold value and making charges GST/VAT invoices, 1-click E-Way bills, E-Invoicing JSON, and dual party ledgers.</p>
          <div class="why-feat-highlight">
            <i class="bi bi-check-circle-fill"></i>
            <span>Audit-ready tax compliance</span>
          </div>
        </div>
      </div>

      <!-- Module 7 -->
      <div class="col-lg-4 col-md-6">
        <div class="why-feat-card">
          <div class="why-feat-top">
            <div class="why-feat-icon"><i class="bi bi-bar-chart-line"></i></div>
            <span class="why-module-badge">Module 07</span>
          </div>
          <h3 class="why-feat-title">Report Analysis &amp; Business Intelligence</h3>
          <p class="why-feat-desc">Real-time stock valuation by karat purity, Karigar productivity analytics, trending diamond design reports, and store profit margins.</p>
          <div class="why-feat-highlight">
            <i class="bi bi-check-circle-fill"></i>
            <span>Instant bullion &amp; jewelry balance sheet</span>
          </div>
        </div>
      </div>

      <!-- Module 8 -->
      <div class="col-lg-4 col-md-6">
        <div class="why-feat-card">
          <div class="why-feat-top">
            <div class="why-feat-icon"><i class="bi bi-shield-lock"></i></div>
            <span class="why-module-badge">Module 08</span>
          </div>
          <h3 class="why-feat-title">Employee Governance &amp; Security</h3>
          <p class="why-feat-desc">Granular role-based access, counter cash limits, sales commission calculation, and immutable audit logs preventing staff manipulation.</p>
          <div class="why-feat-highlight">
            <i class="bi bi-check-circle-fill"></i>
            <span>Full cashier audit trails</span>
          </div>
        </div>
      </div>

      <!-- Module 9 -->
      <div class="col-lg-4 col-md-6">
        <div class="why-feat-card">
          <div class="why-feat-top">
            <div class="why-feat-icon"><i class="bi bi-broadcast"></i></div>
            <span class="why-module-badge">Module 09</span>
          </div>
          <h3 class="why-feat-title">Stock &amp; UHF RFID Automation</h3>
          <p class="why-feat-desc">Scan 500+ items on display trays in 3 seconds. Certified digital scale connectivity (Essae, Mettler) and multi-branch stock transfers.</p>
          <div class="why-feat-highlight">
            <i class="bi bi-check-circle-fill"></i>
            <span>85% faster physical audits</span>
          </div>
        </div>
      </div>

      <!-- Module 10 -->
      <div class="col-lg-12">
        <div class="why-feat-card bg-light border-2">
          <div class="why-feat-top">
            <div class="why-feat-icon bg-white"><i class="bi bi-cloud-check text-primary"></i></div>
            <span class="why-module-badge bg-white">Module 10 • Enterprise Architecture</span>
          </div>
          <h3 class="why-feat-title">Enterprise Cloud Infrastructure &amp; Multi-Branch Synchronization</h3>
          <p class="why-feat-desc">Connect unlimited retail stores, wholesale hubs, and manufacturing facilities into a single unified database with conflict-free offline counter resilience and automated hourly backups.</p>
          <div class="why-feat-highlight bg-white">
            <i class="bi bi-shield-check"></i>
            <span>99.9% Uptime Guarantee • AES-256 Encryption • UAE &amp; India Data Compliance</span>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     3. HEAD-TO-HEAD COMPARISON TABLE
══════════════════════════════════════════════════ -->
<section class="section-comparison">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1200px;">
    
    <div class="text-center mb-5">
      <div class="why-eyebrow">HEAD-TO-HEAD COMPARISON</div>
      <h2 class="h2 fw-bold text-dark mb-2">Generic ERP vs. GoldMatrix Jewellery Engine</h2>
      <p class="text-muted fs-15 max-w-600 mx-auto">Compare critical domain workflows between generic accounting tools and our purpose-built jewellery solution.</p>
    </div>

    <div class="comp-table-card">
      <div class="comp-header-row">
        <div>Operational Requirement</div>
        <div class="text-success"><i class="bi bi-patch-check-fill me-1"></i> GoldMatrix Jewellery ERP</div>
        <div class="text-muted"><i class="bi bi-x-circle-fill me-1"></i> Generic ERPs (SAP, Tally, Zoho)</div>
      </div>

      <div class="comp-data-row">
        <div class="fw-bold text-dark">Karat Purity &amp; Weight Calculation</div>
        <div class="comp-goldmatrix-col">
          <i class="bi bi-check-circle-fill"></i>
          <span>Calculates Gross, Net, Stone, and Fine weight to 4 decimals</span>
        </div>
        <div class="comp-generic-col">
          <i class="bi bi-x-circle"></i>
          <span>Requires clumsy manual formulas &amp; spreadsheets</span>
        </div>
      </div>

      <div class="comp-data-row">
        <div class="fw-bold text-dark">Live Market Gold &amp; Silver Rates</div>
        <div class="comp-goldmatrix-col">
          <i class="bi bi-check-circle-fill"></i>
          <span>Automatic board sync for 24K, 22K, 18K &amp; Silver</span>
        </div>
        <div class="comp-generic-col">
          <i class="bi bi-x-circle"></i>
          <span>Static price lists only; manual daily price updates</span>
        </div>
      </div>

      <div class="comp-data-row">
        <div class="fw-bold text-dark">UHF RFID 3-Second Tray Audits</div>
        <div class="comp-goldmatrix-col">
          <i class="bi bi-check-circle-fill"></i>
          <span>Native drivers for Chainway, Zebra &amp; tray readers</span>
        </div>
        <div class="comp-generic-col">
          <i class="bi bi-x-circle"></i>
          <span>No native jewelry RFID support; expensive plugins</span>
        </div>
      </div>

      <div class="comp-data-row">
        <div class="fw-bold text-dark">Old Gold Exchange &amp; Melting Purity</div>
        <div class="comp-goldmatrix-col">
          <i class="bi bi-check-circle-fill"></i>
          <span>Automated purity test entry, melting loss &amp; credit vouchers</span>
        </div>
        <div class="comp-generic-col">
          <i class="bi bi-x-circle"></i>
          <span>Treated as standard trade-in; zero metal purity tracking</span>
        </div>
      </div>

      <div class="comp-data-row">
        <div class="fw-bold text-dark">Karigar Jobwork &amp; Wastage Control</div>
        <div class="comp-goldmatrix-col">
          <i class="bi bi-check-circle-fill"></i>
          <span>Issue metal, track daily wastage %, recovery &amp; balance ledger</span>
        </div>
        <div class="comp-generic-col">
          <i class="bi bi-x-circle"></i>
          <span>Generic bill of materials (BOM) without metal loss logic</span>
        </div>
      </div>

      <div class="comp-data-row">
        <div class="fw-bold text-dark">Certified Weighing Scale Integration</div>
        <div class="comp-goldmatrix-col">
          <i class="bi bi-check-circle-fill"></i>
          <span>Direct RS-232 &amp; USB reading from Essae, Mettler &amp; Contech</span>
        </div>
        <div class="comp-generic-col">
          <i class="bi bi-x-circle"></i>
          <span>Staff manually type weights — high risk of fraud/typos</span>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     4. ROI & IMPACT METRICS
══════════════════════════════════════════════════ -->
<section class="section-why-metrics">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1200px;">
    <div class="row g-4">
      <div class="col-lg-3 col-6">
        <div class="metric-box-item">
          <div class="metric-num">85%</div>
          <div class="metric-lbl">Faster Inventory Audits with RFID</div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="metric-box-item">
          <div class="metric-num">0%</div>
          <div class="metric-lbl">Calculation Discrepancies in Karat Purity</div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="metric-box-item">
          <div class="metric-num">3x</div>
          <div class="metric-lbl">Faster POS Checkout &amp; Invoicing</div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="metric-box-item">
          <div class="metric-num">99.9%</div>
          <div class="metric-lbl">Cloud Uptime &amp; Customer Retention</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     5. CONVERSION CTA
══════════════════════════════════════════════════ -->
<section class="why-cta-sec">
  <div class="container" style="max-width: 800px;">
    <h2 class="h2 fw-bold text-white mb-3">Transform Your Jewellery Business with GoldMatrix</h2>
    <p class="text-white-50 fs-16 mb-4">Join 1,500+ jewellery showrooms and manufacturing units experiencing complete control and clarity.</p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <a href="/request-demo" class="btn-intl-primary">
        <span>Request Personalized Demo</span>
        <i class="bi bi-arrow-right"></i>
      </a>
      <a href="https://wa.me/919270369937" target="_blank" class="btn-intl-secondary">
        <i class="bi bi-whatsapp text-success me-1"></i>
        <span>Chat on WhatsApp</span>
      </a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
