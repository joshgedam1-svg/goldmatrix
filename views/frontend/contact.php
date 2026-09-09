<?php
/**
 * GoldMatrix — Executive Contact Us Page
 * International Standard Minimalist & Premium Design
 * Location: views/frontend/contact.php
 */
require __DIR__ . '/partials/header.php';

$heroStyleClass = 'bg-theme-' . ($hero_bg_style ?? 'dark');
?>

<style>
/* ══════════════════════════════════════════════════════
   CONTACT PAGE INTERNATIONAL MINIMALIST STYLING
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
.contact-hero {
  background: var(--intl-navy-dark);
  background: radial-gradient(circle at 50% 0%, #111C3A 0%, var(--intl-navy-dark) 70%);
  padding: 130px 5% 80px;
  color: #FFFFFF;
  text-align: center;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.contact-hero.bg-theme-gradient {
  background: radial-gradient(circle at 50% 0%, #1E293B 0%, #0A1128 70%);
}
.contact-hero.bg-theme-slate {
  background: #0F172A;
}
.contact-eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  color: var(--intl-gold);
  margin-bottom: 16px;
  display: inline-block;
}
.contact-h1 {
  font-size: clamp(2.3rem, 4.2vw, 3.5rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.03em;
  color: #FFFFFF;
  margin-bottom: 18px;
}
.contact-sub {
  font-size: 16.5px;
  color: #94A3B8;
  max-width: 680px;
  margin: 0 auto;
  line-height: 1.7;
}

/* Offices & Channels Grid */
.section-contact-content {
  background: var(--intl-slate-50);
  padding: 85px 5%;
}
.contact-office-card {
  background: #FFFFFF;
  border: 1px solid var(--intl-slate-200);
  border-radius: 14px;
  padding: 32px 28px;
  height: 100%;
  box-shadow: 0 2px 6px rgba(0,0,0,0.02);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.contact-office-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}
.contact-card-icon {
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
  margin-bottom: 16px;
}
.contact-card-title {
  font-size: 18px;
  font-weight: 800;
  color: var(--intl-slate-900);
  margin-bottom: 14px;
}
.contact-row-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  font-size: 14px;
  color: var(--intl-slate-600);
  line-height: 1.6;
  margin-bottom: 12px;
}
.contact-row-item i {
  color: var(--intl-slate-900);
  font-size: 16px;
  margin-top: 3px;
}
.contact-row-item a {
  color: var(--intl-slate-900);
  text-decoration: none;
  font-weight: 600;
}
.contact-row-item a:hover {
  color: var(--intl-gold);
}

/* Form Container */
.contact-form-container {
  background: #FFFFFF;
  border: 1px solid var(--intl-slate-200);
  border-radius: 16px;
  padding: 40px 36px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}
.form-label-custom {
  font-size: 13px;
  font-weight: 700;
  color: var(--intl-slate-800);
  margin-bottom: 8px;
  display: block;
}
.form-control-custom {
  width: 100%;
  padding: 12px 16px;
  font-size: 14.5px;
  border: 1px solid var(--intl-slate-200);
  border-radius: 8px;
  background: #FFFFFF;
  transition: border-color 0.2s ease;
}
.form-control-custom:focus {
  border-color: var(--intl-gold);
  box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
  outline: none;
}
.btn-intl-primary {
  background-color: #FBBF24;
  color: #0F172A;
  font-weight: 700;
  font-size: 15px;
  padding: 14px 28px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  border: 1px solid #FBBF24;
  transition: all 0.2s ease-in-out;
  cursor: pointer;
}
.btn-intl-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(245, 158, 11, 0.4);
}

/* Hotline Banner */
.contact-hotline-strip {
  background: linear-gradient(135deg, #0A1128 0%, #111C3A 100%);
  color: #FFFFFF;
  border-radius: 16px;
  padding: 38px 42px;
  margin-top: 60px;
  border: 1px solid rgba(255,255,255,0.08);
}
.btn-whatsapp-pill {
  background: #25D366;
  color: #FFFFFF;
  font-weight: 700;
  font-size: 14px;
  padding: 10px 22px;
  border-radius: 50px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.15s ease;
}
.btn-whatsapp-pill:hover {
  background: #20BA5A;
  color: #FFFFFF;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(37, 211, 102, 0.35);
}
.btn-call-pill {
  background: rgba(255,255,255,0.12);
  color: #FFFFFF;
  font-weight: 700;
  font-size: 14px;
  padding: 10px 22px;
  border-radius: 50px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border: 1px solid rgba(255,255,255,0.2);
  transition: all 0.15s ease;
}
.btn-call-pill:hover {
  background: rgba(255,255,255,0.22);
  color: #FFFFFF;
  transform: translateY(-2px);
}

/* Maps & FAQs Section */
.section-maps-faq {
  background: #FFFFFF;
  padding: 85px 5%;
  border-top: 1px solid var(--intl-slate-200);
}
.map-frame-box {
  border-radius: 12px;
  overflow: hidden;
  border: 1px solid var(--intl-slate-200);
  background: #F8FAFC;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.faq-accordion-custom .accordion-item {
  border: 1px solid var(--intl-slate-200);
  border-radius: 10px !important;
  margin-bottom: 12px;
  overflow: hidden;
}
.faq-accordion-custom .accordion-button {
  font-weight: 700;
  font-size: 15px;
  color: var(--intl-slate-900);
  background: #FFFFFF;
  padding: 18px 22px;
}
.faq-accordion-custom .accordion-button:not(.collapsed) {
  background: #F8FAFC;
  color: #D97706;
  box-shadow: none;
}
.faq-accordion-custom .accordion-body {
  font-size: 14.5px;
  line-height: 1.7;
  color: var(--intl-slate-600);
  background: #FFFFFF;
  padding: 18px 22px;
}
</style>

<!-- ══════════════════════════════════════════════════
     1. HERO BANNER
══════════════════════════════════════════════════ -->
<?php if (($hero_enabled ?? '1') === '1'): ?>
<section class="contact-hero <?= $heroStyleClass ?>">
  <div class="container" style="max-width: 1000px;">
    
    <?php if (!empty($hero_eyebrow)): ?>
      <div class="contact-eyebrow"><?= e($hero_eyebrow) ?></div>
    <?php endif; ?>

    <h1 class="contact-h1">
      <?= e($hero_title ?? 'Connect with Our ERP Architects') ?>
    </h1>

    <?php if (!empty($hero_subtitle)): ?>
      <p class="contact-sub">
        <?= nl2br(e($hero_subtitle)) ?>
      </p>
    <?php endif; ?>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     2. DUAL OFFICES & CONTACT FORM
══════════════════════════════════════════════════ -->
<section class="section-contact-content">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1360px;">
    
    <div class="row g-5">
      
      <!-- LEFT: Office Locations & Channels -->
      <div class="col-lg-5">
        <div class="d-flex flex-column gap-4">
          
          <!-- UAE Card -->
          <?php if (($uae_enabled ?? '1') === '1'): ?>
          <div class="contact-office-card">
            <div class="contact-card-icon">
              <i class="bi <?= e($uae_office['icon'] ?? 'bi-geo-alt') ?>"></i>
            </div>
            <div class="text-uppercase fw-bold text-muted fs-11 mb-2" style="letter-spacing:1.5px;"><?= e($uae_office['tag'] ?? 'INTERNATIONAL HEADQUARTER') ?></div>
            <h3 class="contact-card-title"><?= e($uae_office['country']) ?></h3>
            
            <div class="contact-row-item">
              <i class="bi bi-pin-map"></i>
              <span><?= e($uae_office['address']) ?></span>
            </div>

            <div class="contact-row-item">
              <i class="bi bi-telephone"></i>
              <a href="tel:<?= preg_replace('/[^0-9+]/', '', $uae_office['phone']) ?>"><?= e($uae_office['phone']) ?></a>
            </div>

            <?php if (!empty($uae_office['whatsapp'])): ?>
            <div class="contact-row-item">
              <i class="bi bi-whatsapp text-success"></i>
              <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $uae_office['whatsapp']) ?>" target="_blank"><?= e($uae_office['whatsapp']) ?></a>
            </div>
            <?php endif; ?>

            <div class="contact-row-item">
              <i class="bi bi-envelope"></i>
              <a href="mailto:<?= e($uae_office['email']) ?>"><?= e($uae_office['email']) ?></a>
            </div>

            <div class="contact-row-item">
              <i class="bi bi-clock"></i>
              <span><?= e($uae_office['hours']) ?></span>
            </div>
          </div>
          <?php endif; ?>

          <!-- India Hub Card -->
          <?php if (($india_enabled ?? '1') === '1'): ?>
          <div class="contact-office-card">
            <div class="contact-card-icon">
              <i class="bi <?= e($india_office['icon'] ?? 'bi-building') ?>"></i>
            </div>
            <div class="text-uppercase fw-bold text-muted fs-11 mb-2" style="letter-spacing:1.5px;"><?= e($india_office['tag'] ?? 'DEVELOPMENT & TECH HUB') ?></div>
            <h3 class="contact-card-title"><?= e($india_office['country']) ?></h3>
            
            <div class="contact-row-item">
              <i class="bi bi-pin-map"></i>
              <span><?= e($india_office['address']) ?></span>
            </div>

            <div class="contact-row-item">
              <i class="bi bi-telephone"></i>
              <a href="tel:<?= preg_replace('/[^0-9+]/', '', $india_office['phone']) ?>"><?= e($india_office['phone']) ?></a>
            </div>

            <?php if (!empty($india_office['whatsapp'])): ?>
            <div class="contact-row-item">
              <i class="bi bi-whatsapp text-success"></i>
              <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $india_office['whatsapp']) ?>" target="_blank"><?= e($india_office['whatsapp']) ?></a>
            </div>
            <?php endif; ?>

            <div class="contact-row-item">
              <i class="bi bi-envelope"></i>
              <a href="mailto:<?= e($india_office['email']) ?>"><?= e($india_office['email']) ?></a>
            </div>

            <div class="contact-row-item">
              <i class="bi bi-clock"></i>
              <span><?= e($india_office['hours']) ?></span>
            </div>
          </div>
          <?php endif; ?>

        </div>
      </div>

      <!-- RIGHT: Clean Minimalist Lead Form -->
      <div class="col-lg-7">
        <?php if (($form_enabled ?? '1') === '1'): ?>
        <div class="contact-form-container">
          
          <div class="text-uppercase fw-bold text-muted fs-11 mb-1" style="letter-spacing:1.5px;"><?= e($form_tag ?? 'DIRECT CONSULTATION') ?></div>
          <h2 class="h3 fw-bold text-dark mb-2"><?= e($form_title ?? 'Schedule a Private Demo') ?></h2>
          <p class="text-muted fs-14 mb-4"><?= e($form_subtitle ?? 'Fill out the form below and an ERP consultant will reach out within 2 business hours.') ?></p>

          <form id="mainContactForm" onsubmit="handleContactSubmit(event)">
            
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label-custom">Your Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-custom w-100" placeholder="e.g. Alexander Vance" required>
              </div>
              <div class="col-md-6">
                <label class="form-label-custom">Phone / Mobile <span class="text-danger">*</span></label>
                <input type="tel" name="phone" class="form-control form-control-custom w-100" placeholder="+971 50 123 4567 / +1 212 555 0199" required>
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label-custom">Work Email Address</label>
                <input type="email" name="email" class="form-control form-control-custom w-100" placeholder="alexander@aurumjewellers.com">
              </div>
              <div class="col-md-6">
                <label class="form-label-custom">Jewellery Enterprise / Brand</label>
                <input type="text" name="company" class="form-control form-control-custom w-100" placeholder="e.g. Aurum Fine Jewellery LLC">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label-custom">Primary Area of Interest</label>
              <select name="service" class="form-select form-control-custom w-100">
                <?php if (!empty($form_services) && is_array($form_services)): ?>
                  <?php foreach ($form_services as $srv): ?>
                    <option value="<?= e($srv) ?>"><?= e($srv) ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="Luxury Retail POS & Showroom Management">Luxury Retail POS & Showroom Management</option>
                  <option value="Manufacturing & Jobwork ERP Suite">Manufacturing & Jobwork ERP Suite</option>
                  <option value="Wholesale & Bullion Trading Hub">Wholesale & Bullion Trading Hub</option>
                  <option value="RFID Automated Inventory System">RFID Automated Inventory System</option>
                  <option value="Multi-Branch Enterprise Cloud Consolidation">Multi-Branch Enterprise Cloud Consolidation</option>
                  <option value="General Enterprise Consultation">General Enterprise Consultation</option>
                <?php endif; ?>
              </select>
            </div>

            <div class="mb-4">
              <label class="form-label-custom">How Can We Help You?</label>
              <textarea name="message" class="form-control form-control-custom w-100" rows="3" placeholder="Tell us about your branches, current software, or challenges..."></textarea>
            </div>

            <button type="submit" id="contactSubmitBtn" class="btn-intl-primary w-100 py-3">
              <span id="contactBtnText"><?= e($form_btn_text ?? 'Submit Enquiry & Schedule Demo') ?></span>
              <i class="bi bi-arrow-right ms-1"></i>
            </button>

            <div id="contactFormFeedback" class="mt-3" style="display:none;"></div>
          </form>

        </div>
        <?php endif; ?>
      </div>

    </div>

    <!-- ══════════════════════════════════════════════════
         3. DIRECT HOTLINE & EXPRESS CHANNELS STRIP
    ══════════════════════════════════════════════════ -->
    <?php if (($hotline_enabled ?? '1') === '1'): ?>
    <div class="contact-hotline-strip">
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <div class="text-uppercase fw-bold text-warning fs-11 mb-2" style="letter-spacing:1.5px;">DIRECT ENTERPRISE HOTLINE</div>
          <h3 class="h4 fw-bold text-white mb-2"><?= e($hotline_title ?? 'Need Instant ERP Assistance or Customized Quotation?') ?></h3>
          <p class="text-white-50 fs-14 mb-0"><?= e($hotline_subtitle ?? 'Connect directly with our senior jewellery ERP implementation team for express query resolution.') ?></p>
        </div>
        <div class="col-lg-5 text-lg-end">
          <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
            <?php if (!empty($hotline_whatsapp)): ?>
              <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $hotline_whatsapp) ?>" target="_blank" class="btn-whatsapp-pill">
                <i class="bi bi-whatsapp fs-5"></i>
                <span>WhatsApp: <?= e($hotline_whatsapp) ?></span>
              </a>
            <?php endif; ?>
            <?php if (!empty($hotline_call)): ?>
              <a href="tel:<?= preg_replace('/[^0-9+]/', '', $hotline_call) ?>" class="btn-call-pill">
                <i class="bi bi-telephone fs-5"></i>
                <span>Call: <?= e($hotline_call) ?></span>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     4. INTERACTIVE GOOGLE MAPS & DIRECTIONS
══════════════════════════════════════════════════ -->
<?php if (($maps_enabled ?? '1') === '1'): ?>
<section class="section-maps-faq">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1360px;">
    
    <div class="text-center mb-5">
      <div class="text-uppercase fw-bold text-muted fs-11 mb-2" style="letter-spacing:1.5px;">LOCATION OVERVIEW</div>
      <h2 class="h3 fw-bold text-dark"><?= e($maps_title ?? 'Visit Our Global Offices') ?></h2>
      <p class="text-muted fs-15 max-w-600 mx-auto"><?= e($maps_subtitle ?? 'Visit our international technology centers or schedule an in-person boardroom demonstration.') ?></p>
    </div>

    <div class="row g-4">
      <?php if (!empty($map_uae_embed)): ?>
      <div class="col-lg-6">
        <div class="map-frame-box p-3 h-100">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fs-11 fw-bold">UAE HEADQUARTER</span>
              <div class="fw-bold text-dark fs-14 mt-1">Sharjah Gold Souq Technology Center</div>
            </div>
            <a href="https://maps.google.com/?q=Central+Gold+Souq+Sharjah" target="_blank" class="btn btn-sm btn-light border fs-12 fw-semibold">
              <i class="bi bi-box-arrow-up-right me-1"></i> Open in Maps
            </a>
          </div>
          <iframe src="<?= e($map_uae_embed) ?>" width="100%" height="320" style="border:0; border-radius:8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
      <?php endif; ?>

      <?php if (!empty($map_india_embed)): ?>
      <div class="col-lg-6">
        <div class="map-frame-box p-3 h-100">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle fs-11 fw-bold">INDIA OPERATIONS HUB</span>
              <div class="fw-bold text-dark fs-14 mt-1">Maharashtra Software Development Hub</div>
            </div>
            <a href="https://maps.google.com/?q=MIDC+Hingna+Rd+Nagpur+Maharashtra" target="_blank" class="btn btn-sm btn-light border fs-12 fw-semibold">
              <i class="bi bi-box-arrow-up-right me-1"></i> Open in Maps
            </a>
          </div>
          <iframe src="<?= e($map_india_embed) ?>" width="100%" height="320" style="border:0; border-radius:8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
      <?php endif; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════
     5. CONTACT FREQUENTLY ASKED QUESTIONS (FAQ)
══════════════════════════════════════════════════ -->
<?php if (($faq_enabled ?? '1') === '1' && !empty($faq_items) && is_array($faq_items)): ?>
<section class="section-maps-faq bg-light">
  <div class="container" style="max-width: 900px;">
    
    <div class="text-center mb-5">
      <div class="text-uppercase fw-bold text-muted fs-11 mb-2" style="letter-spacing:1.5px;">HAVE QUESTIONS?</div>
      <h2 class="h3 fw-bold text-dark"><?= e($faq_title ?? 'Frequently Asked Questions') ?></h2>
      <p class="text-muted fs-15"><?= e($faq_subtitle ?? 'Quick answers to commonly asked questions about our jewelry ERP demonstrations and onboarding.') ?></p>
    </div>

    <div class="accordion faq-accordion-custom" id="contactFaqAccordion">
      <?php foreach ($faq_items as $fIndex => $faq): ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading_<?= $fIndex ?>">
            <button class="accordion-button <?= $fIndex === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?= $fIndex ?>" aria-expanded="<?= $fIndex === 0 ? 'true' : 'false' ?>" aria-controls="collapse_<?= $fIndex ?>">
              <i class="bi bi-question-circle-fill text-warning me-2 fs-14"></i>
              <span><?= e($faq['question'] ?? '') ?></span>
            </button>
          </h2>
          <div id="collapse_<?= $fIndex ?>" class="accordion-collapse collapse <?= $fIndex === 0 ? 'show' : '' ?>" aria-labelledby="heading_<?= $fIndex ?>" data-bs-parent="#contactFaqAccordion">
            <div class="accordion-body">
              <?= nl2br(e($faq['answer'] ?? '')) ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<script>
function handleContactSubmit(e) {
  e.preventDefault();
  const form = document.getElementById('mainContactForm');
  const btn = document.getElementById('contactSubmitBtn');
  const btnText = document.getElementById('contactBtnText');
  const feedback = document.getElementById('contactFormFeedback');

  btn.disabled = true;
  const originalText = btnText.innerText;
  btnText.innerText = 'Submitting...';

  const formData = new FormData(form);

  fetch('/api/contact-lead', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    feedback.style.display = 'block';
    if (data.success) {
      feedback.className = 'alert alert-success py-2 px-3 fs-13 mt-3 shadow-sm border-0';
      feedback.innerHTML = '<i class="bi bi-check-circle-fill text-success me-1"></i> ' + (data.message || '<?= e($form_success_msg ?? "Thank you! We will reach out shortly.") ?>');
      form.reset();
    } else {
      feedback.className = 'alert alert-danger py-2 px-3 fs-13 mt-3 shadow-sm border-0';
      feedback.innerHTML = '<i class="bi bi-exclamation-triangle-fill text-danger me-1"></i> ' + (data.message || 'Please check form inputs.');
    }
  })
  .catch(err => {
    feedback.style.display = 'block';
    feedback.className = 'alert alert-danger py-2 px-3 fs-13 mt-3 shadow-sm border-0';
    feedback.innerHTML = '<i class="bi bi-exclamation-circle-fill text-danger me-1"></i> Network error. Please WhatsApp us directly.';
  })
  .finally(() => {
    btn.disabled = false;
    btnText.innerText = originalText;
  });
}
</script>

<?php
require __DIR__ . '/partials/footer.php';
?>
