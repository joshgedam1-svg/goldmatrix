<?php
/**
 * GoldMatrix — Terms & Conditions
 * Location: views/frontend/terms.php
 */
require __DIR__ . '/partials/header.php';

$termsJson = setting('terms_sections', '[]');
$termsClauses = json_decode($termsJson, true);
if (!is_array($termsClauses) || empty($termsClauses)) {
    $termsClauses = [
        [
            'title'   => '1. Acceptance of Terms & Services',
            'content' => 'By accessing, installing, or utilizing the GoldMatrix Jewellery ERP software suites, mobile applications, or cloud APIs, you agree to be bound by these Terms and Conditions.'
        ],
        [
            'title'   => '2. License Grant & Permitted Usage',
            'content' => 'GoldMatrix Software Technologies grants you a non-exclusive, non-transferable license to utilize the ERP modules strictly for your internal business operations across licensed stores.'
        ],
        [
            'title'   => '3. Hardware Integrations & Certified Devices',
            'content' => 'GoldMatrix provides direct device drivers for supported barcode printers, digital weighing scales, UHF RFID tray scanners, and TV rate boards.'
        ],
        [
            'title'   => '4. Financial Records & Data Ownership',
            'content' => 'All customer information, bullion transactions, itemized sales records, Karigar work orders, and ledger entries entered into GoldMatrix remain your exclusive property.'
        ],
        [
            'title'   => '5. Service Level Agreement (SLA) & Technical Support',
            'content' => 'We maintain a 99.9% uptime standard for cloud-hosted environments with priority WhatsApp and hotline helpdesk.'
        ]
    ];
}
?>

<style>
/* ══════════════════════════════════════════════════════
   LEGAL PAGES STYLING (Terms & Privacy)
══════════════════════════════════════════════════════ */
.legal-hero {
  background: #0A1128;
  background: radial-gradient(circle at 50% 0%, #111C3A 0%, #050B18 70%);
  padding: 125px 5% 75px;
  color: #FFFFFF;
  text-align: center;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.legal-eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #F59E0B;
  margin-bottom: 14px;
  display: inline-block;
}
.legal-h1 {
  font-size: clamp(2.2rem, 4vw, 3.4rem);
  font-weight: 800;
  line-height: 1.15;
  color: #FFFFFF;
  margin-bottom: 16px;
}
.legal-sub {
  font-size: 16px;
  color: #94A3B8;
  max-width: 680px;
  margin: 0 auto 20px;
  line-height: 1.7;
}
.legal-content-sec {
  background: #F8FAFC;
  padding: 80px 5%;
}
.legal-card-box {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 34px 30px;
  margin-bottom: 24px;
  box-shadow: 0 1px 4px rgba(0,0,0,0.03);
  transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.legal-card-box:hover {
  box-shadow: 0 6px 18px rgba(0,0,0,0.05);
}
.legal-clause-title {
  font-size: 18px;
  font-weight: 800;
  color: #0F172A;
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.legal-clause-text {
  font-size: 14.5px;
  color: #475569;
  line-height: 1.8;
  margin: 0;
}
.legal-sidebar-nav {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px;
  position: sticky;
  top: 100px;
}
.legal-nav-link {
  display: block;
  font-size: 13.5px;
  font-weight: 600;
  color: #64748B;
  text-decoration: none;
  padding: 8px 12px;
  border-radius: 6px;
  margin-bottom: 4px;
  transition: all 0.15s ease;
}
.legal-nav-link:hover {
  background: #F1F5F9;
  color: #0F172A;
}
</style>

<!-- ══════════════════════════════════════════════════
     1. HERO BANNER
══════════════════════════════════════════════════ -->
<?php if (($terms_hero_enabled ?? '1') === '1'): ?>
<section class="legal-hero">
  <div class="container" style="max-width: 900px;">
    
    <div class="legal-eyebrow"><?= e($terms_hero_eyebrow ?? 'LEGAL COMPLIANCE & GOVERNANCE') ?></div>

    <h1 class="legal-h1">
      <?= e($terms_hero_title ?? 'Terms & Conditions of Service') ?>
    </h1>

    <p class="legal-sub">
      <?= e($terms_hero_subtitle ?? 'Standard software license, enterprise SLA, multi-branch service agreement and operational policies.') ?>
    </p>

    <span class="badge bg-light text-dark px-3 py-2 rounded-pill fs-12 border">
      <i class="bi bi-calendar-event me-1 text-warning"></i> Last Updated: <?= e($terms_last_updated ?? 'September 2026') ?>
    </span>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     2. TERMS CLAUSES CONTENT
══════════════════════════════════════════════════ -->
<section class="legal-content-sec">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1240px;">
    
    <div class="row g-5">
      
      <!-- LEFT: Sticky Navigation -->
      <div class="col-lg-4 d-none d-lg-block">
        <div class="legal-sidebar-nav">
          <div class="text-uppercase fw-bold text-muted fs-11 mb-3" style="letter-spacing:1px;">TABLE OF CLAUSES</div>
          <?php foreach ($termsClauses as $idx => $cl): ?>
            <a href="#clause_<?= $idx ?>" class="legal-nav-link">
              <i class="bi bi-chevron-right fs-11 me-1 text-muted"></i>
              <?= e($cl['title']) ?>
            </a>
          <?php endforeach; ?>

          <hr class="my-3">
          <div class="p-3 bg-light rounded-2 fs-12 text-muted">
            <i class="bi bi-shield-lock-fill text-primary me-1"></i> Need a customized multi-branch master SLA? Contact our enterprise legal desk at <a href="mailto:info@goldmatrixsoftware.com" class="fw-bold text-dark">info@goldmatrixsoftware.com</a>.
          </div>
        </div>
      </div>

      <!-- RIGHT: Clauses List -->
      <div class="col-lg-8">
        <?php foreach ($termsClauses as $idx => $cl): ?>
          <div class="legal-card-box" id="clause_<?= $idx ?>">
            <h2 class="legal-clause-title">
              <i class="bi bi-patch-check-fill text-warning fs-5"></i>
              <span><?= e($cl['title']) ?></span>
            </h2>
            <div class="legal-clause-text">
              <?= nl2br(e($cl['content'])) ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>

  </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
