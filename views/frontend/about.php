<?php
/**
 * GoldMatrix — International Standard About Us Page
 * Structure: Company First, Technology Second (13 Clean Sections)
 * Location: views/frontend/about.php
 */
require __DIR__ . '/partials/header.php';
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
    url('https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=1600&auto=format&fit=crop&q=80');
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
        <h1 class="ab-h1">About GoldMatrix</h1>
        <p class="ab-lead ab-lead-dark mb-4">
          GoldMatrix is a jewellery business software company helping jewellery businesses simplify operations, improve control and grow with confidence.
        </p>
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start gap-3">
          <button type="button" class="btn-ab-gold" data-bs-toggle="modal" data-bs-target="#bookDemoModal">
            <span>Book a Free Demo</span>
            <i class="bi bi-arrow-right"></i>
          </button>
          <a href="/solutions" class="btn-ab-outline">
            <span>Explore Solutions</span>
          </a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="ab-img-wrapper">
          <img src="https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=1000&auto=format&fit=crop&q=80" alt="GoldMatrix International Jewellery Environment" class="ab-img-fluid" loading="eager">
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
          <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1000&auto=format&fit=crop&q=80" alt="GoldMatrix Company Team & Workspace" class="ab-img-fluid" loading="lazy">
        </div>
      </div>

      <div class="col-lg-6 order-1 order-lg-2">
        <h2 class="ab-h2">Who We Are</h2>
        <p class="ab-lead">
          We build practical business solutions for jewellery retailers, wholesalers, manufacturers and growing jewellery enterprises.
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
        <h2 class="ab-h2">Our Purpose</h2>
        <p class="ab-lead">
          To make complex jewellery business operations simpler, more accurate and easier to manage.
        </p>
      </div>

      <div class="col-lg-6">
        <div class="ab-img-wrapper">
          <img src="https://images.unsplash.com/photo-1531973576160-7125cd663d86?w=1000&auto=format&fit=crop&q=80" alt="Jewellery Business Operations & Retail Integration" class="ab-img-fluid" loading="lazy">
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
      <h2 class="ab-h2">Our Journey</h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        Our journey is shaped by continuous experience, customer relationships and a deep understanding of jewellery business operations.
      </p>
    </div>

    <div class="timeline-track-wrap">
      
      <div class="timeline-step-card">
        <div class="timeline-step-num">PHASE 01</div>
        <h3 class="timeline-step-title">Experience</h3>
        <p class="timeline-step-desc">Direct engagement with jewellery merchants, retailers and bullion counters.</p>
      </div>

      <div class="timeline-step-card">
        <div class="timeline-step-num">PHASE 02</div>
        <h3 class="timeline-step-title">Industry Understanding</h3>
        <p class="timeline-step-desc">Deep mastering of Karigar jobwork, metal purities, stone calculations and retail workflows.</p>
      </div>

      <div class="timeline-step-card">
        <div class="timeline-step-num">PHASE 03</div>
        <h3 class="timeline-step-title">Software Evolution</h3>
        <p class="timeline-step-desc">Purpose-built cloud software bringing inventory, sales, RFID and accounting together.</p>
      </div>

      <div class="timeline-step-card">
        <div class="timeline-step-num">PHASE 04</div>
        <h3 class="timeline-step-title">Global Growth</h3>
        <p class="timeline-step-desc">Expanding across international jewellery capitals with continuous product refinement.</p>
      </div>

    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     5. WHAT WE DO (REAL SOFTWARE SHOWCASE)
══════════════════════════════════════════════════ -->
<section class="sec-light" id="what-we-do">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-4">
      <h2 class="ab-h2">What We Do</h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        We provide connected business solutions covering the key operations of modern jewellery businesses.
      </p>
    </div>

    <div class="software-collage-box text-center">
      <div class="software-chip-row">
        <div class="software-chip"><i class="bi bi-cart-check"></i> POS &amp; Billing</div>
        <div class="software-chip"><i class="bi bi-boxes"></i> Inventory &amp; RFID</div>
        <div class="software-chip"><i class="bi bi-gear"></i> Manufacturing &amp; Jobwork</div>
        <div class="software-chip"><i class="bi bi-calculator"></i> Accounting &amp; Tax</div>
        <div class="software-chip"><i class="bi bi-people"></i> CRM &amp; Loyalty</div>
        <div class="software-chip"><i class="bi bi-graph-up"></i> Reports &amp; Analytics</div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-10">
          <img src="/uploads/homepage/hp_6a9207ee140eb.png" alt="GoldMatrix Jewellery ERP Software Suite" class="software-preview-img" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&auto=format&fit=crop&q=80'">
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     6. OUR SOLUTIONS (6 CLEAN CARDS)
══════════════════════════════════════════════════ -->
<section class="sec-white" id="our-solutions">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <h2 class="ab-h2">Our Solutions</h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        Explore our dedicated solution modules built exclusively for jewellery commerce.
      </p>
    </div>

    <div class="row g-4">
      
      <!-- 1. Retail -->
      <div class="col-lg-4 col-md-6">
        <div class="sol-clean-card">
          <div class="sol-icon-box">
            <i class="bi bi-shop"></i>
          </div>
          <div>
            <h3 class="sol-card-title">Jewellery Retail</h3>
            <p class="sol-card-text">Sales, quick billing, customer profiles and daily store management.</p>
          </div>
        </div>
      </div>

      <!-- 2. Wholesale -->
      <div class="col-lg-4 col-md-6">
        <div class="sol-clean-card">
          <div class="sol-icon-box">
            <i class="bi bi-boxes"></i>
          </div>
          <div>
            <h3 class="sol-card-title">Wholesale Management</h3>
            <p class="sol-card-text">B2B orders, approval memos, dealer accounts and bulk trade control.</p>
          </div>
        </div>
      </div>

      <!-- 3. Manufacturing -->
      <div class="col-lg-4 col-md-6">
        <div class="sol-clean-card">
          <div class="sol-icon-box">
            <i class="bi bi-gear-wide-connected"></i>
          </div>
          <div>
            <h3 class="sol-card-title">Manufacturing &amp; Jobwork</h3>
            <p class="sol-card-text">Department allocations, Karigar jobbags, loss tracking and worklogs.</p>
          </div>
        </div>
      </div>

      <!-- 4. Inventory -->
      <div class="col-lg-4 col-md-6">
        <div class="sol-clean-card">
          <div class="sol-icon-box">
            <i class="bi bi-layers"></i>
          </div>
          <div>
            <h3 class="sol-card-title">Inventory Management</h3>
            <p class="sol-card-text">Precious metal purity, diamond weights, barcode and RFID audits.</p>
          </div>
        </div>
      </div>

      <!-- 5. Accounting -->
      <div class="col-lg-4 col-md-6">
        <div class="sol-clean-card">
          <div class="sol-icon-box">
            <i class="bi bi-calculator"></i>
          </div>
          <div>
            <h3 class="sol-card-title">Accounting &amp; Finance</h3>
            <p class="sol-card-text">Automated ledgers, tax compliance, metal balance and financial statements.</p>
          </div>
        </div>
      </div>

      <!-- 6. CRM -->
      <div class="col-lg-4 col-md-6">
        <div class="sol-clean-card">
          <div class="sol-icon-box">
            <i class="bi bi-people"></i>
          </div>
          <div>
            <h3 class="sol-card-title">CRM &amp; Customer Management</h3>
            <p class="sol-card-text">Customer history, gold saving schemes and relationship workflows.</p>
          </div>
        </div>
      </div>

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
        <h2 class="ab-h2">How We Work</h2>
        <p class="ab-lead mb-4">
          A structured, customer-first approach to deploying software that fits your operations.
        </p>

        <div class="work-step-row">
          <div class="work-step-num">1</div>
          <div>
            <h3 class="work-step-title">Understand</h3>
            <p class="work-step-desc">We understand your business processes and operational requirements.</p>
          </div>
        </div>

        <div class="work-step-row">
          <div class="work-step-num">2</div>
          <div>
            <h3 class="work-step-title">Implement</h3>
            <p class="work-step-desc">We configure solutions around your jewellery business workflows.</p>
          </div>
        </div>

        <div class="work-step-row mb-0">
          <div class="work-step-num">3</div>
          <div>
            <h3 class="work-step-title">Support</h3>
            <p class="work-step-desc">We continue to support your business as your operations grow.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="ab-img-wrapper">
          <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=1000&auto=format&fit=crop&q=80" alt="GoldMatrix Customer Consultation & Implementation" class="ab-img-fluid" loading="lazy">
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
      <h2 class="ab-h2">Built for Jewellery Businesses</h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        Our solutions are designed around the unique requirements of jewellery retail, wholesale, manufacturing and business operations.
      </p>
    </div>

    <div class="row g-4">
      
      <!-- 1. Retail Showroom -->
      <div class="col-lg-3 col-md-6">
        <div class="quad-grid-card">
          <img src="https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=600&auto=format&fit=crop&q=80" alt="Retail Showroom" class="quad-grid-img" loading="lazy">
          <div class="quad-grid-caption">
            <h3 class="quad-grid-title">Retail Showroom</h3>
            <p class="quad-grid-desc">POS, barcode and counter sales</p>
          </div>
        </div>
      </div>

      <!-- 2. Wholesale Operation -->
      <div class="col-lg-3 col-md-6">
        <div class="quad-grid-card">
          <img src="https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?w=600&auto=format&fit=crop&q=80" alt="Wholesale Operation" class="quad-grid-img" loading="lazy">
          <div class="quad-grid-caption">
            <h3 class="quad-grid-title">Wholesale Operation</h3>
            <p class="quad-grid-desc">B2B orders and stock transfer</p>
          </div>
        </div>
      </div>

      <!-- 3. Jewellery Manufacturing -->
      <div class="col-lg-3 col-md-6">
        <div class="quad-grid-card">
          <img src="https://images.unsplash.com/photo-1535632787350-4e68ef0ac584?w=600&auto=format&fit=crop&q=80" alt="Jewellery Manufacturing" class="quad-grid-img" loading="lazy">
          <div class="quad-grid-caption">
            <h3 class="quad-grid-title">Jewellery Manufacturing</h3>
            <p class="quad-grid-desc">Jobwork and production queues</p>
          </div>
        </div>
      </div>

      <!-- 4. Business & CRM Management -->
      <div class="col-lg-3 col-md-6">
        <div class="quad-grid-card">
          <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=600&auto=format&fit=crop&q=80" alt="Business & CRM Management" class="quad-grid-img" loading="lazy">
          <div class="quad-grid-caption">
            <h3 class="quad-grid-title">Business Management</h3>
            <p class="quad-grid-desc">CRM, schemes and analytics</p>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     9. WHY GOLDMATRIX (6 BENEFIT CARDS)
══════════════════════════════════════════════════ -->
<section class="sec-light" id="why-goldmatrix">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <h2 class="ab-h2">Why GoldMatrix</h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        Engineered specifically for the demands and operational integrity of the jewellery industry.
      </p>
    </div>

    <div class="row g-4">
      
      <div class="col-lg-4 col-md-6">
        <div class="benefit-clean-card">
          <h3 class="benefit-title">
            <i class="bi bi-gem"></i>
            <span>Jewellery Expertise</span>
          </h3>
          <p class="benefit-text">Purpose-built around jewellery business operations.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="benefit-clean-card">
          <h3 class="benefit-title">
            <i class="bi bi-link-45deg"></i>
            <span>Connected Operations</span>
          </h3>
          <p class="benefit-text">Manage essential business processes in one ecosystem.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="benefit-clean-card">
          <h3 class="benefit-title">
            <i class="bi bi-check2-circle"></i>
            <span>Practical Solutions</span>
          </h3>
          <p class="benefit-text">Designed for real-world jewellery workflows.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="benefit-clean-card">
          <h3 class="benefit-title">
            <i class="bi bi-graph-up-arrow"></i>
            <span>Scalable Business</span>
          </h3>
          <p class="benefit-text">Suitable for growing businesses and multi-location operations.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="benefit-clean-card">
          <h3 class="benefit-title">
            <i class="bi bi-headset"></i>
            <span>Customer Support</span>
          </h3>
          <p class="benefit-text">Focused on long-term customer relationships.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="benefit-clean-card">
          <h3 class="benefit-title">
            <i class="bi bi-globe2"></i>
            <span>Global Approach</span>
          </h3>
          <p class="benefit-text">Built to support modern jewellery businesses across markets.</p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     10. WHO WE SERVE
══════════════════════════════════════════════════ -->
<section class="sec-white" id="who-we-serve">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="text-center mb-5">
      <h2 class="ab-h2">Who We Serve</h2>
      <p class="ab-lead mx-auto" style="max-width: 750px;">
        From individual jewellery businesses to growing enterprises, GoldMatrix supports different stages of the jewellery business.
      </p>
    </div>

    <div class="row g-3 justify-content-center">
      
      <div class="col-lg-2 col-md-4 col-6">
        <div class="serve-chip-card">
          <i class="bi bi-shop serve-icon"></i>
          <h3 class="serve-name">Retailers</h3>
          <p class="serve-desc">Single &amp; multi-store showrooms</p>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <div class="serve-chip-card">
          <i class="bi bi-boxes serve-icon"></i>
          <h3 class="serve-name">Wholesalers</h3>
          <p class="serve-desc">Bullion &amp; trade distributors</p>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <div class="serve-chip-card">
          <i class="bi bi-hammer serve-icon"></i>
          <h3 class="serve-name">Manufacturers</h3>
          <p class="serve-desc">Production units &amp; Karigars</p>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <div class="serve-chip-card">
          <i class="bi bi-safe serve-icon"></i>
          <h3 class="serve-name">Girvi / Mortgage</h3>
          <p class="serve-desc">Gold loan &amp; pawn operators</p>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <div class="serve-chip-card">
          <i class="bi bi-building serve-icon"></i>
          <h3 class="serve-name">Enterprises</h3>
          <p class="serve-desc">Large multi-branch jewellery chains</p>
        </div>
      </div>

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
        <h2 class="ab-h2">Global Presence</h2>
        <p class="ab-lead mb-4">
          GoldMatrix is built with an international outlook to support jewellery businesses across different markets and business environments.
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
            UAE • India • Hong Kong • Singapore • United Kingdom • GCC
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
          <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=1000&auto=format&fit=crop&q=80" alt="GoldMatrix Team Long-term Partnership" class="ab-img-fluid" loading="lazy">
        </div>
      </div>

      <div class="col-lg-6">
        <h2 class="ab-h2">Our Commitment</h2>
        <p class="ab-lead">
          We focus on reliable solutions, continuous improvement and long-term relationships with the businesses we serve.
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
    <h2 class="ab-h1 mb-3">Let's Grow Together</h2>
    <p class="ab-lead ab-lead-dark mb-4 mx-auto" style="max-width: 700px;">
      Discover how GoldMatrix can help simplify your jewellery business and bring greater control to your daily operations.
    </p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <button type="button" class="btn-ab-gold" data-bs-toggle="modal" data-bs-target="#bookDemoModal">
        <span>Book a Free Demo</span>
        <i class="bi bi-arrow-right"></i>
      </button>
      <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', setting('contact_india_phone', '919270369937')) ?>?text=Hello%20GoldMatrix%20Team%2C%20I%20would%20like%20to%20learn%20more%20about%20your%20Jewellery%20ERP%20software." target="_blank" class="btn-ab-outline">
        <i class="bi bi-whatsapp text-success me-1"></i>
        <span>Chat on WhatsApp</span>
      </a>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/partials/footer.php';
?>
