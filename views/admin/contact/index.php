<?php
/**
 * GoldMatrix ERP - Section-by-Section Contact Page CMS Settings
 * Location: views/admin/contact/index.php
 */
$title = 'Contact Page Settings';
$expandedSection = $expandedSection ?? 'hero';

// Parse FAQs
$faqsJson = $settings['contact_faq_items'] ?? '[]';
$faqs = json_decode($faqsJson, true);
if (!is_array($faqs) || empty($faqs)) {
    $faqs = [
        [
            'question' => 'How quickly can we schedule a live software demonstration?',
            'answer'   => 'Our ERP architects can schedule a live personalized simulation within 2 to 4 business hours of your request.'
        ],
        [
            'question' => 'Do you provide on-site implementation in UAE and India?',
            'answer'   => 'Yes. We have dedicated field engineers and technical consultants based in both UAE (Sharjah/Dubai) and India (Maharashtra/Pan-India).'
        ]
    ];
}
?>

<style>
/* ══════════════════════════════════════════════════════
   SECTION-BY-SECTION CMS ACCORDION STYLING (Inspired by Reference UI)
══════════════════════════════════════════════════════ */
.cms-section-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  margin-bottom: 20px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.03);
  overflow: hidden;
  transition: all 0.2s ease;
}
.cms-section-card:hover {
  border-color: #CBD5E1;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.cms-section-header {
  padding: 18px 24px;
  cursor: pointer;
  background: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: space-between;
  user-select: none;
  border-bottom: 1px solid transparent;
  transition: background 0.15s ease, border-color 0.15s ease;
}
.cms-section-header:hover {
  background: #F8FAFC;
}
.cms-section-header.active {
  border-bottom-color: #E2E8F0;
  background: #F8FAFC;
}
.cms-section-title {
  font-size: 16px;
  font-weight: 700;
  color: #1E293B;
  display: flex;
  align-items: center;
  gap: 12px;
  margin: 0;
}
.cms-section-icon {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  background: #EEF2FF;
  color: #4F46E5;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
}
.cms-section-body {
  padding: 28px 26px;
  display: none;
  background: #FFFFFF;
}
.cms-section-body.show {
  display: block;
}
.btn-update-pink {
  background: #E11D48;
  background: linear-gradient(135deg, #E11D48 0%, #BE123C 100%);
  color: #FFFFFF;
  font-weight: 700;
  font-size: 14px;
  padding: 10px 32px;
  border-radius: 8px;
  border: none;
  box-shadow: 0 3px 10px rgba(225, 29, 72, 0.25);
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-update-pink:hover {
  background: linear-gradient(135deg, #BE123C 0%, #9F1239 100%);
  color: #FFFFFF;
  transform: translateY(-1px);
  box-shadow: 0 5px 14px rgba(225, 29, 72, 0.35);
}
.btn-clear-cache {
  color: #E11D48;
  background: #FFF1F2;
  border: 1px solid #FFE4E6;
  font-size: 13px;
  font-weight: 600;
  padding: 8px 18px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
  transition: all 0.15s ease;
}
.btn-clear-cache:hover {
  background: #FFE4E6;
  color: #BE123C;
}
.form-label-section {
  font-size: 13px;
  font-weight: 700;
  color: #334155;
  margin-bottom: 6px;
}
.form-hint {
  font-size: 12px;
  color: #64748B;
  margin-top: 4px;
}
.custom-switch-label {
  font-size: 14px;
  font-weight: 600;
  color: #1E293B;
}
.field-group {
  margin-bottom: 22px;
}
.faq-item-row {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 18px;
  margin-bottom: 14px;
  position: relative;
}
</style>

<div class="container-fluid px-0" style="max-width: 1140px; margin: 0 auto;">

  <!-- TOP HEADER & CONTROLS -->
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center gap-3">
      <div class="p-3 bg-danger-subtle text-danger rounded-3">
        <i class="bi bi-headset fs-3"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2">
          <h2 class="h4 fw-bold text-dark mb-0">Contact Page Settings</h2>
          <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Section CMS</span>
        </div>
        <p class="text-muted small mb-0 mt-1">Edit every section of the Contact Us page individually. Changes synchronize live to the website instantly.</p>
      </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
      <form method="POST" action="/admin/contact" class="d-inline">
        <input type="hidden" name="action" value="clear_cache">
        <input type="hidden" name="section_name" value="<?= e($expandedSection) ?>">
        <button type="submit" class="btn-clear-cache">
          <i class="bi bi-eraser-fill"></i> Clear Cache
        </button>
      </form>

      <a href="/contact" target="_blank" class="btn btn-outline-dark btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold">
        <i class="bi bi-box-arrow-up-right"></i>
        <span>Live Contact Page</span>
      </a>

      <button type="button" class="btn btn-light btn-sm border px-3 py-2 fw-semibold" onclick="toggleAllSections()">
        <i class="bi bi-arrows-expand me-1"></i> <span id="toggleAllText">Expand All</span>
      </button>
    </div>
  </div>

  <!-- FLASH MESSAGES -->
  <?php if ($msg = get_flash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2 mb-4" role="alert">
      <i class="bi bi-check-circle-fill text-success fs-5"></i>
      <div><?= e($msg) ?></div>
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if ($msg = get_flash('danger')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2 mb-4" role="alert">
      <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
      <div><?= e($msg) ?></div>
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- ══════════════════════════════════════════════════════════════════════
       SECTION 1: HERO BANNER SECTION
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-hero">
    <div class="cms-section-header <?= $expandedSection === 'hero' ? 'active' : '' ?>" onclick="toggleSection('hero')">
      <div class="cms-section-title">
        <span class="cms-section-icon"><i class="bi bi-display"></i></span>
        <span>Hero Banner Section</span>
        <?php if (($settings['contact_hero_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'hero' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-hero"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'hero' ? 'show' : '' ?>" id="secBody-hero">
      <form method="POST" action="/admin/contact">
        <input type="hidden" name="section_name" value="hero">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Contact Hero Banner?</div>
            <div class="form-hint">Enable or disable the main dark header at the top of the Contact page.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="contact_hero_enabled" value="1" <?= ($settings['contact_hero_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Eyebrow Badge Text</label>
            <input type="text" name="contact_hero_eyebrow" class="form-control" value="<?= e($settings['contact_hero_eyebrow'] ?? 'GLOBAL SPECIALIST NETWORK') ?>" placeholder="e.g. GLOBAL SPECIALIST NETWORK">
            <div class="form-hint">Small golden uppercase badge displayed above the title.</div>
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Background Visual Style</label>
            <select name="contact_hero_bg_style" class="form-select">
              <option value="dark" <?= ($settings['contact_hero_bg_style'] ?? 'dark') === 'dark' ? 'selected' : '' ?>>Executive Navy Dark (#050B18)</option>
              <option value="gradient" <?= ($settings['contact_hero_bg_style'] ?? '') === 'gradient' ? 'selected' : '' ?>>Midnight Gradient (#111C3A Radial)</option>
              <option value="slate" <?= ($settings['contact_hero_bg_style'] ?? '') === 'slate' ? 'selected' : '' ?>>Deep Slate (#0F172A)</option>
            </select>
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Main Heading (H1)</label>
          <input type="text" name="contact_hero_title" class="form-control form-control-lg fw-bold" value="<?= e($settings['contact_hero_title'] ?? 'Connect with Our ERP Architects') ?>" placeholder="e.g. Connect with Our ERP Architects">
        </div>

        <div class="field-group">
          <label class="form-label-section">Hero Subtitle / Description</label>
          <textarea name="contact_hero_subtitle" class="form-control" rows="3" placeholder="Enter supporting subtitle text..."><?= e($settings['contact_hero_subtitle'] ?? 'Have a question about our enterprise architecture, hardware compatibility, or ready to schedule a product simulation? Our offices in the UAE and India are at your service.') ?></textarea>
        </div>

        <div class="d-flex justify-content-end mt-4 pt-2 border-top">
          <button type="submit" class="btn-update-pink">
            <i class="bi bi-check2-circle fs-6"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ══════════════════════════════════════════════════════════════════════
       SECTION 2: UAE HEADQUARTER OFFICE CARD
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-uae">
    <div class="cms-section-header <?= $expandedSection === 'uae' ? 'active' : '' ?>" onclick="toggleSection('uae')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FEF3C7; color:#D97706;"><i class="bi bi-geo-alt-fill"></i></span>
        <span>International Headquarter (UAE Office)</span>
        <?php if (($settings['contact_uae_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'uae' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-uae"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'uae' ? 'show' : '' ?>" id="secBody-uae">
      <form method="POST" action="/admin/contact">
        <input type="hidden" name="section_name" value="uae">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show UAE Headquarter Office Card?</div>
            <div class="form-hint">Display the United Arab Emirates official branch card on the contact page.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="contact_uae_enabled" value="1" <?= ($settings['contact_uae_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Card Eyebrow Tag</label>
            <input type="text" name="contact_uae_tag" class="form-control" value="<?= e($settings['contact_uae_tag'] ?? 'INTERNATIONAL HEADQUARTER') ?>" placeholder="e.g. INTERNATIONAL HEADQUARTER">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Country / Branch Title</label>
            <input type="text" name="contact_uae_country" class="form-control fw-bold" value="<?= e($settings['contact_uae_country'] ?? 'United Arab Emirates (Headquarter)') ?>" placeholder="e.g. United Arab Emirates (Headquarter)">
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Physical Address</label>
          <textarea name="contact_uae_address" class="form-control" rows="2" placeholder="Full office address..."><?= e($settings['contact_uae_address'] ?? 'Shop No. 25/A, Central Gold Souq Block No. 8, Al Majaz -1 King Faisal Road - Sharjah') ?></textarea>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label-section">Direct Telephone / Call</label>
            <input type="text" name="contact_uae_phone" class="form-control" value="<?= e($settings['contact_uae_phone'] ?? '+971 56 324 0319') ?>" placeholder="+971 56 324 0319">
          </div>
          <div class="col-md-4">
            <label class="form-label-section">WhatsApp Number</label>
            <input type="text" name="contact_uae_whatsapp" class="form-control" value="<?= e($settings['contact_uae_whatsapp'] ?? '+971 56 324 0319') ?>" placeholder="+971 56 324 0319">
          </div>
          <div class="col-md-4">
            <label class="form-label-section">Official Email Address</label>
            <input type="email" name="contact_uae_email" class="form-control" value="<?= e($settings['contact_uae_email'] ?? 'info@goldmatrixsoftware.com') ?>" placeholder="info@goldmatrixsoftware.com">
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Business & Operation Hours</label>
          <input type="text" name="contact_uae_hours" class="form-control" value="<?= e($settings['contact_uae_hours'] ?? 'Mon - Sat: 9:00 AM - 8:00 PM GST') ?>" placeholder="e.g. Mon - Sat: 9:00 AM - 8:00 PM GST">
        </div>

        <div class="d-flex justify-content-end mt-4 pt-2 border-top">
          <button type="submit" class="btn-update-pink">
            <i class="bi bi-check2-circle fs-6"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ══════════════════════════════════════════════════════════════════════
       SECTION 3: INDIA DEVELOPMENT & TECH HUB CARD
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-india">
    <div class="cms-section-header <?= $expandedSection === 'india' ? 'active' : '' ?>" onclick="toggleSection('india')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#ECFDF5; color:#059669;"><i class="bi bi-building"></i></span>
        <span>Development & Tech Hub (India Office)</span>
        <?php if (($settings['contact_india_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'india' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-india"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'india' ? 'show' : '' ?>" id="secBody-india">
      <form method="POST" action="/admin/contact">
        <input type="hidden" name="section_name" value="india">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show India Development Hub Card?</div>
            <div class="form-hint">Display the India technical center & operations hub card on the contact page.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="contact_india_enabled" value="1" <?= ($settings['contact_india_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Card Eyebrow Tag</label>
            <input type="text" name="contact_india_tag" class="form-control" value="<?= e($settings['contact_india_tag'] ?? 'DEVELOPMENT & TECH HUB') ?>" placeholder="e.g. DEVELOPMENT & TECH HUB">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Country / Branch Title</label>
            <input type="text" name="contact_india_country" class="form-control fw-bold" value="<?= e($settings['contact_india_country'] ?? 'India (Development & Operations Hub)') ?>" placeholder="e.g. India (Development & Operations Hub)">
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Physical Address</label>
          <textarea name="contact_india_address" class="form-control" rows="2" placeholder="Full office address..."><?= e($settings['contact_india_address'] ?? 'India, 01/A, Hingna Rd, M.I.D.C, Maharashtra - 440022') ?></textarea>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label-section">Direct Telephone / Call</label>
            <input type="text" name="contact_india_phone" class="form-control" value="<?= e($settings['contact_india_phone'] ?? '+91 92703 69937') ?>" placeholder="+91 92703 69937">
          </div>
          <div class="col-md-4">
            <label class="form-label-section">WhatsApp Support Number</label>
            <input type="text" name="contact_india_whatsapp" class="form-control" value="<?= e($settings['contact_india_whatsapp'] ?? '+91 92703 69937') ?>" placeholder="+91 92703 69937">
          </div>
          <div class="col-md-4">
            <label class="form-label-section">Official Email Address</label>
            <input type="email" name="contact_india_email" class="form-control" value="<?= e($settings['contact_india_email'] ?? 'goldmatrixsoftware@gmail.com') ?>" placeholder="goldmatrixsoftware@gmail.com">
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Business & Operation Hours</label>
          <input type="text" name="contact_india_hours" class="form-control" value="<?= e($settings['contact_india_hours'] ?? 'Mon - Sat: 9:30 AM - 7:00 PM IST') ?>" placeholder="e.g. Mon - Sat: 9:30 AM - 7:00 PM IST">
        </div>

        <div class="d-flex justify-content-end mt-4 pt-2 border-top">
          <button type="submit" class="btn-update-pink">
            <i class="bi bi-check2-circle fs-6"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ══════════════════════════════════════════════════════════════════════
       SECTION 4: DIRECT CONSULTATION & DEMO FORM
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-form">
    <div class="cms-section-header <?= $expandedSection === 'form' ? 'active' : '' ?>" onclick="toggleSection('form')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FDF2F8; color:#DB2777;"><i class="bi bi-ui-checks"></i></span>
        <span>Direct Consultation & Demo Form</span>
        <?php if (($settings['contact_form_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'form' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-form"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'form' ? 'show' : '' ?>" id="secBody-form">
      <form method="POST" action="/admin/contact">
        <input type="hidden" name="section_name" value="form">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Lead Consultation Form?</div>
            <div class="form-hint">Display the interactive private demo booking form on the contact page.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="contact_form_enabled" value="1" <?= ($settings['contact_form_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Form Eyebrow Badge</label>
            <input type="text" name="contact_form_tag" class="form-control" value="<?= e($settings['contact_form_tag'] ?? 'DIRECT CONSULTATION') ?>" placeholder="e.g. DIRECT CONSULTATION">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Form Main Title</label>
            <input type="text" name="contact_form_title" class="form-control fw-bold" value="<?= e($settings['contact_form_title'] ?? 'Schedule a Private Demo') ?>" placeholder="e.g. Schedule a Private Demo">
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Form Subtitle / Promise</label>
          <textarea name="contact_form_subtitle" class="form-control" rows="2" placeholder="e.g. Fill out the form below and an ERP consultant will reach out within 2 business hours."><?= e($settings['contact_form_subtitle'] ?? 'Fill out the form below and an ERP consultant will reach out within 2 business hours.') ?></textarea>
        </div>

        <div class="field-group">
          <label class="form-label-section">Service / Product Dropdown Options (One per line)</label>
          <textarea name="contact_form_services" class="form-control font-monospace fs-13" rows="6" placeholder="Enter one option per line..."><?= e($settings['contact_form_services'] ?? "Retail POS & Billing Software\nJewellery Manufacturing & Jobwork Software\nWholesale & Bullion Management\nRFID Inventory Automation\nGirvi (Money Lending) & Kitty Schemes\nJewellery GST Invoicing & Accounting\nGeneral Enterprise Consultation") ?></textarea>
          <div class="form-hint">Each line entered above will appear as a selectable option in the "Primary Area of Interest" dropdown.</div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Submit Button Text</label>
            <input type="text" name="contact_form_btn_text" class="form-control" value="<?= e($settings['contact_form_btn_text'] ?? 'Submit Enquiry & Schedule Demo') ?>" placeholder="e.g. Submit Enquiry & Schedule Demo">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Success Message Text</label>
            <input type="text" name="contact_form_success_msg" class="form-control" value="<?= e($settings['contact_form_success_msg'] ?? 'Thank you! Our jewelry ERP specialist will contact you shortly for a personalized demo.') ?>" placeholder="Success message text...">
          </div>
        </div>

        <div class="d-flex justify-content-end mt-4 pt-2 border-top">
          <button type="submit" class="btn-update-pink">
            <i class="bi bi-check2-circle fs-6"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ══════════════════════════════════════════════════════════════════════
       SECTION 5: DIRECT HOTLINE & QUICK CHANNELS BANNER
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-hotline">
    <div class="cms-section-header <?= $expandedSection === 'hotline' ? 'active' : '' ?>" onclick="toggleSection('hotline')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#F0FDF4; color:#16A34A;"><i class="bi bi-whatsapp"></i></span>
        <span>Direct Hotline & Channels Banner</span>
        <?php if (($settings['contact_hotline_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'hotline' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-hotline"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'hotline' ? 'show' : '' ?>" id="secBody-hotline">
      <form method="POST" action="/admin/contact">
        <input type="hidden" name="section_name" value="hotline">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Direct Hotline & Express Channels Banner?</div>
            <div class="form-hint">Display the prominent WhatsApp, direct phone, and quick email helpline strip.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="contact_hotline_enabled" value="1" <?= ($settings['contact_hotline_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Banner Main Headline</label>
            <input type="text" name="contact_hotline_title" class="form-control fw-bold" value="<?= e($settings['contact_hotline_title'] ?? 'Need Instant ERP Assistance or Customized Quotation?') ?>" placeholder="e.g. Need Instant ERP Assistance?">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Banner Subtitle</label>
            <input type="text" name="contact_hotline_subtitle" class="form-control" value="<?= e($settings['contact_hotline_subtitle'] ?? 'Connect directly with our senior jewellery ERP implementation team for express query resolution.') ?>" placeholder="e.g. Connect directly with our team...">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-3">
            <label class="form-label-section">WhatsApp Direct Hotline</label>
            <input type="text" name="contact_hotline_whatsapp" class="form-control" value="<?= e($settings['contact_hotline_whatsapp'] ?? '+91 92703 69937') ?>" placeholder="+91 92703 69937">
          </div>
          <div class="col-md-3">
            <label class="form-label-section">Direct Telephone Hotline</label>
            <input type="text" name="contact_hotline_call" class="form-control" value="<?= e($settings['contact_hotline_call'] ?? '+971 56 324 0319') ?>" placeholder="+971 56 324 0319">
          </div>
          <div class="col-md-3">
            <label class="form-label-section">Sales Inquiries Email</label>
            <input type="email" name="contact_hotline_sales_email" class="form-control" value="<?= e($settings['contact_hotline_sales_email'] ?? 'sales@goldmatrixsoftware.com') ?>" placeholder="sales@goldmatrixsoftware.com">
          </div>
          <div class="col-md-3">
            <label class="form-label-section">Technical Support Email</label>
            <input type="email" name="contact_hotline_support_email" class="form-control" value="<?= e($settings['contact_hotline_support_email'] ?? 'support@goldmatrixsoftware.com') ?>" placeholder="support@goldmatrixsoftware.com">
          </div>
        </div>

        <div class="d-flex justify-content-end mt-4 pt-2 border-top">
          <button type="submit" class="btn-update-pink">
            <i class="bi bi-check2-circle fs-6"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ══════════════════════════════════════════════════════════════════════
       SECTION 6: GOOGLE MAPS & LOCATION EMBEDS
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-maps">
    <div class="cms-section-header <?= $expandedSection === 'maps' ? 'active' : '' ?>" onclick="toggleSection('maps')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#EFF6FF; color:#2563EB;"><i class="bi bi-map-fill"></i></span>
        <span>Interactive Google Maps & Directions</span>
        <?php if (($settings['contact_maps_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'maps' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-maps"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'maps' ? 'show' : '' ?>" id="secBody-maps">
      <form method="POST" action="/admin/contact">
        <input type="hidden" name="section_name" value="maps">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Google Maps Section?</div>
            <div class="form-hint">Display interactive dual Google Maps for both UAE and India technology centers.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="contact_maps_enabled" value="1" <?= ($settings['contact_maps_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Section Main Heading</label>
            <input type="text" name="contact_maps_title" class="form-control fw-bold" value="<?= e($settings['contact_maps_title'] ?? 'Visit Our Global Offices') ?>" placeholder="e.g. Visit Our Global Offices">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Section Subtitle</label>
            <input type="text" name="contact_maps_subtitle" class="form-control" value="<?= e($settings['contact_maps_subtitle'] ?? 'Visit our international technology centers or schedule an in-person boardroom demonstration.') ?>" placeholder="e.g. Visit our international technology centers...">
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">UAE Office Google Maps Embed Iframe URL</label>
          <input type="text" name="contact_map_uae_embed" class="form-control font-monospace fs-12" value="<?= e($settings['contact_map_uae_embed'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3606.319766526145!2d55.385412!3d25.327091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5bc03cb1bd3b%3A0x86708ad00d075218!2sCentral%20Gold%20Souq%2C%20Sharjah!5e0!3m2!1sen!2sae!4v1700000000000') ?>" placeholder="https://www.google.com/maps/embed?...">
          <div class="form-hint">Paste the URL from Google Maps -> Share -> Embed a map (the "src" attribute only).</div>
        </div>

        <div class="field-group">
          <label class="form-label-section">India Tech Hub Google Maps Embed Iframe URL</label>
          <input type="text" name="contact_map_india_embed" class="form-control font-monospace fs-12" value="<?= e($settings['contact_map_india_embed'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119066.42985160846!2d78.990108!3d21.161028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4c0a5a31faf13%3A0x19b37d30d1785929!2sMIDC%20Industrial%20Area%2C%20Nagpur!5e0!3m2!1sen!2sin!4v1700000000000') ?>" placeholder="https://www.google.com/maps/embed?...">
          <div class="form-hint">Paste the URL from Google Maps -> Share -> Embed a map for India location.</div>
        </div>

        <div class="d-flex justify-content-end mt-4 pt-2 border-top">
          <button type="submit" class="btn-update-pink">
            <i class="bi bi-check2-circle fs-6"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ══════════════════════════════════════════════════════════════════════
       SECTION 7: CONTACT PAGE FAQS
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-faq">
    <div class="cms-section-header <?= $expandedSection === 'faq' ? 'active' : '' ?>" onclick="toggleSection('faq')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FAF5FF; color:#9333EA;"><i class="bi bi-question-circle-fill"></i></span>
        <span>Contact Page Frequently Asked Questions (FAQ)</span>
        <?php if (($settings['contact_faq_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active (<?= count($faqs) ?>)</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'faq' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-faq"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'faq' ? 'show' : '' ?>" id="secBody-faq">
      <form method="POST" action="/admin/contact">
        <input type="hidden" name="section_name" value="faq">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Contact Page FAQ Accordion?</div>
            <div class="form-hint">Display expandable questions and answers section right below the office cards.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="contact_faq_enabled" value="1" <?= ($settings['contact_faq_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label-section">FAQ Section Title</label>
            <input type="text" name="contact_faq_title" class="form-control fw-bold" value="<?= e($settings['contact_faq_title'] ?? 'Frequently Asked Questions') ?>" placeholder="e.g. Frequently Asked Questions">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">FAQ Section Subtitle</label>
            <input type="text" name="contact_faq_subtitle" class="form-control" value="<?= e($settings['contact_faq_subtitle'] ?? 'Quick answers to commonly asked questions about our jewelry ERP demonstrations and onboarding.') ?>" placeholder="e.g. Quick answers to commonly asked questions...">
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3">
          <label class="form-label-section mb-0"><i class="bi bi-patch-question-fill text-primary me-1"></i> Manage Questions & Answers</label>
          <button type="button" class="btn btn-sm btn-outline-primary fw-semibold" onclick="addNewFaqRow()">
            <i class="bi bi-plus-circle-fill me-1"></i> Add Question
          </button>
        </div>

        <div id="faqItemsContainer">
          <?php foreach ($faqs as $idx => $f): ?>
            <div class="faq-item-row" id="faqRow_<?= $idx ?>">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="badge bg-light text-dark border fs-12 fw-bold">FAQ #<span class="faq-num"><?= $idx + 1 ?></span></span>
                <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" onclick="removeFaqRow('faqRow_<?= $idx ?>')">
                  <i class="bi bi-trash3-fill"></i> Remove
                </button>
              </div>
              <div class="mb-2">
                <input type="text" name="faq_questions[]" class="form-control fw-semibold" value="<?= e($f['question'] ?? '') ?>" placeholder="Enter question..." required>
              </div>
              <div>
                <textarea name="faq_answers[]" class="form-control fs-13" rows="2" placeholder="Enter comprehensive answer..." required><?= e($f['answer'] ?? '') ?></textarea>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="d-flex justify-content-end mt-4 pt-2 border-top">
          <button type="submit" class="btn-update-pink">
            <i class="bi bi-check2-circle fs-6"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ══════════════════════════════════════════════════════════════════════
       SECTION 8: CONTACT PAGE SEO & SOCIAL META
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-seo">
    <div class="cms-section-header <?= $expandedSection === 'seo' ? 'active' : '' ?>" onclick="toggleSection('seo')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FFFBEB; color:#D97706;"><i class="bi bi-google"></i></span>
        <span>Contact Page SEO & Social Meta</span>
        <span class="badge bg-primary-subtle text-primary fs-11 px-2 py-1 ms-2">Search Engine</span>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'seo' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-seo"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'seo' ? 'show' : '' ?>" id="secBody-seo">
      <form method="POST" action="/admin/contact" enctype="multipart/form-data">
        <input type="hidden" name="section_name" value="seo">

        <div class="field-group">
          <div class="d-flex justify-content-between align-items-center">
            <label class="form-label-section">Meta Title</label>
            <span class="text-muted fs-11" id="seoTitleCounter">0 / 60 chars</span>
          </div>
          <input type="text" name="contact_seo_meta_title" id="contact_seo_meta_title" class="form-control" value="<?= e($settings['contact_seo_meta_title'] ?? 'Contact Us | GoldMatrix Software Technologies (UAE & India)') ?>" placeholder="Contact Us | GoldMatrix Software Technologies" oninput="updateCharCount('contact_seo_meta_title', 'seoTitleCounter', 60)">
          <div class="form-hint">Recommended length: 50-60 characters for optimal Google SERP ranking.</div>
        </div>

        <div class="field-group">
          <div class="d-flex justify-content-between align-items-center">
            <label class="form-label-section">Meta Description</label>
            <span class="text-muted fs-11" id="seoDescCounter">0 / 160 chars</span>
          </div>
          <textarea name="contact_seo_meta_desc" id="contact_seo_meta_desc" class="form-control" rows="3" placeholder="Enter compelling description summarizing UAE & India offices..." oninput="updateCharCount('contact_seo_meta_desc', 'seoDescCounter', 160)"><?= e($settings['contact_seo_meta_desc'] ?? 'Contact GoldMatrix Jewellery ERP specialists. UAE Headquarter in Sharjah Gold Souq and India Tech Hub in Maharashtra. Call +971 56 324 0319.') ?></textarea>
          <div class="form-hint">Recommended length: 140-160 characters.</div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Meta Keywords (Comma separated)</label>
          <textarea name="contact_seo_keywords" class="form-control" rows="2" placeholder="contact goldmatrix, jewellery software support, goldmatrix sharjah uae, goldmatrix india office"><?= e($settings['contact_seo_keywords'] ?? 'contact goldmatrix, jewellery software support, goldmatrix sharjah uae, goldmatrix india office, jewellery pos demo') ?></textarea>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">OpenGraph Social Sharing Image URL</label>
            <input type="text" name="contact_seo_og_image" class="form-control" value="<?= e($settings['contact_seo_og_image'] ?? '') ?>" placeholder="https://... or /uploads/contact/banner.jpg">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Or Upload New Social Image</label>
            <input type="file" name="contact_seo_og_image_file" class="form-control" accept="image/*">
          </div>
        </div>

        <div class="d-flex justify-content-end mt-4 pt-2 border-top">
          <button type="submit" class="btn-update-pink">
            <i class="bi bi-check2-circle fs-6"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>

</div>

<!-- JAVASCRIPT FOR ACCORDION TOGGLE & FAQ BUILDER -->
<script>
let allExpanded = false;

function toggleSection(sectionId) {
  const body = document.getElementById('secBody-' + sectionId);
  const header = document.querySelector('#secCard-' + sectionId + ' .cms-section-header');
  const chevron = document.getElementById('chevron-' + sectionId);

  if (!body) return;

  const isShowing = body.classList.contains('show');

  if (isShowing) {
    body.classList.remove('show');
    header.classList.remove('active');
    chevron.className = 'bi bi-chevron-down text-muted fs-14';
  } else {
    body.classList.add('show');
    header.classList.add('active');
    chevron.className = 'bi bi-chevron-up text-muted fs-14';
  }
}

function toggleAllSections() {
  allExpanded = !allExpanded;
  const sections = ['hero', 'uae', 'india', 'form', 'hotline', 'maps', 'faq', 'seo'];
  
  sections.forEach(sec => {
    const body = document.getElementById('secBody-' + sec);
    const header = document.querySelector('#secCard-' + sec + ' .cms-section-header');
    const chevron = document.getElementById('chevron-' + sec);
    if (body) {
      if (allExpanded) {
        body.classList.add('show');
        header.classList.add('active');
        chevron.className = 'bi bi-chevron-up text-muted fs-14';
      } else {
        body.classList.remove('show');
        header.classList.remove('active');
        chevron.className = 'bi bi-chevron-down text-muted fs-14';
      }
    }
  });

  document.getElementById('toggleAllText').innerText = allExpanded ? 'Collapse All' : 'Expand All';
}

function updateCharCount(inputId, counterId, maxLen) {
  const el = document.getElementById(inputId);
  const counter = document.getElementById(counterId);
  if (el && counter) {
    const len = el.value.length;
    counter.innerText = len + ' / ' + maxLen + ' chars';
    if (len > maxLen) {
      counter.className = 'text-danger fw-bold fs-11';
    } else {
      counter.className = 'text-muted fs-11';
    }
  }
}

let faqCounter = <?= count($faqs) + 10 ?>;

function addNewFaqRow() {
  faqCounter++;
  const container = document.getElementById('faqItemsContainer');
  const rowId = 'faqRow_' + faqCounter;
  
  const div = document.createElement('div');
  div.className = 'faq-item-row';
  div.id = rowId;
  div.innerHTML = `
    <div class="d-flex align-items-center justify-content-between mb-2">
      <span class="badge bg-light text-dark border fs-12 fw-bold">FAQ #<span class="faq-num">New</span></span>
      <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" onclick="removeFaqRow('${rowId}')">
        <i class="bi bi-trash3-fill"></i> Remove
      </button>
    </div>
    <div class="mb-2">
      <input type="text" name="faq_questions[]" class="form-control fw-semibold" placeholder="Enter question..." required>
    </div>
    <div>
      <textarea name="faq_answers[]" class="form-control fs-13" rows="2" placeholder="Enter comprehensive answer..." required></textarea>
    </div>
  `;
  container.appendChild(div);
}

function removeFaqRow(rowId) {
  const row = document.getElementById(rowId);
  if (row) {
    row.remove();
  }
}

// Initialize character counters
document.addEventListener('DOMContentLoaded', function() {
  updateCharCount('contact_seo_meta_title', 'seoTitleCounter', 60);
  updateCharCount('contact_seo_meta_desc', 'seoDescCounter', 160);
});
</script>
