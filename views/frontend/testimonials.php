<?php
/**
 * GoldMatrix — Customer Reviews & Testimonials Page
 * Location: views/frontend/testimonials.php
 */
require __DIR__ . '/partials/header.php';

$testiList = !empty($testimonials) ? $testimonials : [
    [
        'title'       => 'Rajesh Varma',
        'subtitle'    => 'Managing Director, Varma Jewellers (Dubai & Sharjah)',
        'description' => 'GoldMatrix revolutionized our 4 retail showrooms in the UAE. Live gold rate updates sync to all counters within seconds, and RFID tray stock audits that used to take 2 hours are now completed in under 4 minutes with 100% precision.',
        'image'       => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
        'badge'       => 'RETAIL CHAIN',
        'extra'       => '5'
    ],
    [
        'title'       => 'Amitabh Shah',
        'subtitle'    => 'Founder, Shah Bullion & Trading Co. (Mumbai)',
        'description' => 'Handling multi-party bullion orders, metal settlement vouchers, and GST e-invoicing was our biggest bottleneck. GoldMatrix handles high-volume wholesale transactions flawlessly without a single decimal calculation error.',
        'image'       => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
        'badge'       => 'BULLION & WHOLESALE',
        'extra'       => '5'
    ],
    [
        'title'       => 'Sunil Mehta',
        'subtitle'    => 'Operations Head, Mehta Ornaments & Manufacturing (Surat)',
        'description' => 'The Karigar Jobwork and Metal Wastage module paid for the entire software within the first month. We now track pure gold alloy allocations down to milligrams across 45 karigars with zero unaccounted loss.',
        'image'       => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&auto=format&fit=crop&q=80',
        'badge'       => 'MANUFACTURING FACTORY',
        'extra'       => '5'
    ],
    [
        'title'       => 'Vikram Soni',
        'subtitle'    => 'Partner, Soni & Sons Jewellers (Jaipur)',
        'description' => 'The old gold exchange and customer advance savings scheme has increased our customer retention by 40%. The touch POS counter interface is so easy that our staff learned it in less than half a day.',
        'image'       => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&auto=format&fit=crop&q=80',
        'badge'       => 'SHOWROOM POS',
        'extra'       => '5'
    ],
    [
        'title'       => 'Faisal Al-Mansoor',
        'subtitle'    => 'Executive Director, Al Mansoor Gold (Gold Souq, Deira)',
        'description' => 'GoldMatrix cloud ERP connects our wholesale office with our retail branches seamlessly. UAE VAT compliance, bilingual receipt printing, and the digital weighing scale integrations work seamlessly 24/7.',
        'image'       => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80',
        'badge'       => 'INTERNATIONAL WHOLESALE',
        'extra'       => '5'
    ],
    [
        'title'       => 'Harish Patel',
        'subtitle'    => 'Managing Partner, Patel Diamond Studio (Ahmedabad)',
        'description' => 'Managing diamond 4Cs (cut, clarity, carat, color) alongside gold mounts was always messy in general accounting software. GoldMatrix handles certification numbers, center stones, and labor charges with ease.',
        'image'       => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=150&auto=format&fit=crop&q=80',
        'badge'       => 'DIAMOND & BRIDAL',
        'extra'       => '5'
    ]
];
?>

<style>
/* ══════════════════════════════════════════════════════
   TESTIMONIALS & REVIEWS STYLING
══════════════════════════════════════════════════════ */
:root {
  --tst-navy: #0A1128;
  --tst-navy-dark: #050B18;
  --tst-gold: #F59E0B;
  --tst-gold-light: #FBBF24;
  --tst-slate-900: #0F172A;
  --tst-slate-800: #1E293B;
  --tst-slate-600: #475569;
  --tst-slate-500: #64748B;
  --tst-slate-200: #E2E8F0;
  --tst-slate-100: #F1F5F9;
  --tst-slate-50: #F8FAFC;
}

/* Hero Section */
.testi-hero {
  background: var(--tst-navy-dark);
  background: radial-gradient(circle at 50% 0%, #111C3A 0%, var(--tst-navy-dark) 70%);
  padding: 135px 5% 85px;
  color: #FFFFFF;
  text-align: center;
  position: relative;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.testi-eyebrow {
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  color: var(--tst-gold);
  margin-bottom: 16px;
  display: inline-block;
}
.testi-h1 {
  font-size: clamp(2.3rem, 4.2vw, 3.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.03em;
  color: #FFFFFF;
  margin-bottom: 20px;
}
.testi-hero-sub {
  font-size: 17px;
  line-height: 1.7;
  color: #94A3B8;
  max-width: 740px;
  margin: 0 auto 34px;
}

/* Testimonials Grid */
.section-testi-grid {
  background: #FFFFFF;
  padding: 90px 5%;
}
.testi-card-box {
  background: #FFFFFF;
  border: 1px solid var(--tst-slate-200);
  border-radius: 16px;
  padding: 34px 28px;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: all 0.25s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.testi-card-box:hover {
  border-color: #94A3B8;
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(0,0,0,0.06);
}
.testi-stars {
  color: var(--tst-gold);
  font-size: 16px;
  margin-bottom: 18px;
  display: flex;
  gap: 3px;
}
.testi-quote-text {
  font-size: 15px;
  color: var(--tst-slate-600);
  line-height: 1.75;
  margin-bottom: 24px;
  flex-grow: 1;
}
.testi-author-row {
  display: flex;
  align-items: center;
  gap: 14px;
  padding-top: 18px;
  border-top: 1px solid var(--tst-slate-100);
}
.testi-avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid var(--tst-gold-light);
}
.testi-author-name {
  font-size: 15.5px;
  font-weight: 800;
  color: var(--tst-slate-900);
  margin-bottom: 2px;
}
.testi-author-title {
  font-size: 12.5px;
  color: var(--tst-slate-500);
  line-height: 1.4;
}
.testi-tag-badge {
  font-size: 10px;
  font-weight: 700;
  color: #059669;
  background: #ECFDF5;
  border: 1px solid #A7F3D0;
  padding: 3px 8px;
  border-radius: 20px;
  display: inline-block;
  margin-bottom: 8px;
}

/* Trust Stats */
.section-testi-stats {
  background: var(--tst-slate-50);
  padding: 60px 5%;
  border-top: 1px solid var(--tst-slate-200);
  border-bottom: 1px solid var(--tst-slate-200);
}
.testi-stat-item {
  text-align: center;
}
.testi-stat-num {
  font-size: clamp(2rem, 3.5vw, 2.8rem);
  font-weight: 900;
  color: var(--tst-slate-900);
  line-height: 1;
  margin-bottom: 6px;
}
.testi-stat-lbl {
  font-size: 13.5px;
  color: var(--tst-slate-500);
  font-weight: 600;
}

/* CTA */
.testi-cta-sec {
  background: var(--tst-navy-dark);
  padding: 85px 5%;
  color: #FFFFFF;
  text-align: center;
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
<section class="testi-hero">
  <div class="container" style="max-width: 950px;">
    
    <div class="testi-eyebrow">VERIFIED CUSTOMER SUCCESS</div>

    <h1 class="testi-h1">
      Trusted by 1,500+ Jewellers Across UAE, India &amp; Worldwide
    </h1>

    <p class="testi-hero-sub">
      Read how independent jewellery retailers, multi-branch showroom chains, wholesale bullion dealers, and manufacturing workshops scale their businesses with GoldMatrix ERP.
    </p>

    <div class="d-flex flex-wrap align-items-center justify-content-center gap-3">
      <a href="/request-demo" class="btn-intl-primary">
        <span>Book Free 1-on-1 Demo</span>
        <i class="bi bi-arrow-right"></i>
      </a>
      <a href="/why-us" class="btn-intl-secondary">
        <span>Why Choose GoldMatrix</span>
      </a>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     2. TRUST STATS STRIP
══════════════════════════════════════════════════ -->
<section class="section-testi-stats">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1200px;">
    <div class="row g-4 text-center">
      <div class="col-lg-3 col-6">
        <div class="testi-stat-item">
          <div class="testi-stat-num">1,500+</div>
          <div class="testi-stat-lbl">Active Store Deployments</div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="testi-stat-item">
          <div class="testi-stat-num">15+</div>
          <div class="testi-stat-lbl">Years Domain Experience</div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="testi-stat-item">
          <div class="testi-stat-num">99.9%</div>
          <div class="testi-stat-lbl">Customer Retention Rate</div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="testi-stat-item">
          <div class="testi-stat-num">4.9/5</div>
          <div class="testi-stat-lbl">Average Jeweller Satisfaction</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════
     3. REVIEWS GRID
══════════════════════════════════════════════════ -->
<section class="section-testi-grid">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1300px;">
    
    <div class="row g-4">
      <?php foreach ($testiList as $t): ?>
        <div class="col-lg-4 col-md-6">
          <div class="testi-card-box">
            
            <?php if (!empty($t['badge'])): ?>
              <div><span class="testi-tag-badge"><?= e($t['badge']) ?></span></div>
            <?php endif; ?>

            <div class="testi-stars">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>

            <p class="testi-quote-text">
              "<?= e($t['description']) ?>"
            </p>

            <div class="testi-author-row">
              <img src="<?= e($t['image'] ?: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80') ?>" alt="<?= e($t['title']) ?>" class="testi-avatar" loading="lazy">
              <div>
                <div class="testi-author-name"><?= e($t['title']) ?></div>
                <div class="testi-author-title"><?= e($t['subtitle']) ?></div>
              </div>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     4. CONVERSION CTA
══════════════════════════════════════════════════ -->
<section class="testi-cta-sec">
  <div class="container" style="max-width: 800px;">
    <h2 class="h2 fw-bold text-white mb-3">Join 1,500+ Successful Jewellery Businesses</h2>
    <p class="text-white-50 fs-16 mb-4">See how GoldMatrix gives you total operational control, faster billing, and zero inventory loss.</p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <a href="/request-demo" class="btn-intl-primary">
        <span>Book Free Personalized Demo</span>
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
