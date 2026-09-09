<?php
/**
 * GoldMatrix ERP - Section-by-Section Legal & Policy Pages CMS Settings
 * Location: views/admin/legal/settings.php
 */
$title = 'Legal & Policy Pages Settings';
$activeTab = $activeTab ?? 'terms';
$expandedSection = $expandedSection ?? 'hero';

// Parse Terms Clauses
$termsJson = $settings['terms_sections'] ?? '[]';
$termsClauses = json_decode($termsJson, true);
if (!is_array($termsClauses) || empty($termsClauses)) {
    $termsClauses = [
        ['title' => '1. Acceptance of Terms & Services', 'content' => 'By accessing, installing, or utilizing the GoldMatrix Jewellery ERP software suites...'],
        ['title' => '2. License Grant & Permitted Usage', 'content' => 'GoldMatrix Software Technologies grants you a non-exclusive license...']
    ];
}

// Parse Privacy Clauses
$privacyJson = $settings['privacy_sections'] ?? '[]';
$privacyClauses = json_decode($privacyJson, true);
if (!is_array($privacyClauses) || empty($privacyClauses)) {
    $privacyClauses = [
        ['title' => '1. Information Collection & Scope', 'content' => 'GoldMatrix collects business contact details required for license activation...'],
        ['title' => '2. Confidentiality of Precious Metals Data', 'content' => 'We do not sell, share, or monetize any customer inventory records...']
    ];
}
?>

<style>
/* ══════════════════════════════════════════════════════
   SECTION-BY-SECTION CMS ACCORDION STYLING
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
.clause-item-row {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 18px;
  margin-bottom: 14px;
}
.nav-tab-legal {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 24px;
  font-size: 14px;
  font-weight: 700;
  border-radius: 8px;
  text-decoration: none;
  color: #64748B;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  transition: all 0.15s ease;
}
.nav-tab-legal:hover {
  color: #0F172A;
  border-color: #CBD5E1;
}
.nav-tab-legal.active {
  background: #0F172A;
  color: #FFFFFF;
  border-color: #0F172A;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
}
</style>

<div class="container-fluid px-0" style="max-width: 1140px; margin: 0 auto;">

  <!-- TOP HEADER & CONTROLS -->
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center gap-3">
      <div class="p-3 bg-secondary-subtle text-secondary rounded-3">
        <i class="bi bi-shield-lock-fill fs-3"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2">
          <h2 class="h4 fw-bold text-dark mb-0">Legal & Policy Pages Settings</h2>
          <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Section CMS</span>
        </div>
        <p class="text-muted small mb-0 mt-1">Manage Terms & Conditions (/terms) and Privacy Policy (/privacy) clauses and meta tags.</p>
      </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
      <form method="POST" action="/admin/legal-settings" class="d-inline">
        <input type="hidden" name="action" value="clear_cache">
        <input type="hidden" name="tab" value="<?= e($activeTab) ?>">
        <input type="hidden" name="section_name" value="<?= e($expandedSection) ?>">
        <button type="submit" class="btn-clear-cache">
          <i class="bi bi-eraser-fill"></i> Clear Cache
        </button>
      </form>

      <a href="<?= $activeTab === 'privacy' ? '/privacy' : '/terms' ?>" target="_blank" class="btn btn-outline-dark btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold">
        <i class="bi bi-box-arrow-up-right"></i>
        <span>View Live <?= $activeTab === 'privacy' ? 'Privacy Policy' : 'Terms & Conditions' ?></span>
      </a>

      <button type="button" class="btn btn-light btn-sm border px-3 py-2 fw-semibold" onclick="toggleAllSections()">
        <i class="bi bi-arrows-expand me-1"></i> <span id="toggleAllText">Expand All</span>
      </button>
    </div>
  </div>

  <!-- LEGAL PAGE TABS -->
  <div class="d-flex align-items-center gap-2 mb-4">
    <a href="?tab=terms" class="nav-tab-legal <?= $activeTab === 'terms' ? 'active' : '' ?>">
      <i class="bi bi-file-earmark-text-fill"></i> Terms &amp; Conditions (/terms)
    </a>
    <a href="?tab=privacy" class="nav-tab-legal <?= $activeTab === 'privacy' ? 'active' : '' ?>">
      <i class="bi bi-shield-check"></i> Privacy Policy (/privacy)
    </a>
  </div>

  <!-- FLASH MESSAGES -->
  <?php if ($msg = get_flash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2 mb-4" role="alert">
      <i class="bi bi-check-circle-fill text-success fs-5"></i>
      <div><?= e($msg) ?></div>
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if ($activeTab === 'terms'): ?>
    <!-- ══════════════════════════════════════════════════════════════════════
         TERMS TAB: SECTION 1 - HERO BANNER
    ══════════════════════════════════════════════════════════════════════ -->
    <div class="cms-section-card" id="secCard-terms_hero">
      <div class="cms-section-header <?= $expandedSection === 'hero' ? 'active' : '' ?>" onclick="toggleSection('terms_hero')">
        <div class="cms-section-title">
          <span class="cms-section-icon"><i class="bi bi-display"></i></span>
          <span>Terms Hero Header Section</span>
          <?php if (($settings['terms_hero_enabled'] ?? '1') === '1'): ?>
            <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
          <?php else: ?>
            <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
          <?php endif; ?>
        </div>
        <i class="bi <?= $expandedSection === 'hero' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-terms_hero"></i>
      </div>

      <div class="cms-section-body <?= $expandedSection === 'hero' ? 'show' : '' ?>" id="secBody-terms_hero">
        <form method="POST" action="/admin/legal-settings">
          <input type="hidden" name="tab" value="terms">
          <input type="hidden" name="section_name" value="terms_hero">

          <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
            <div>
              <div class="custom-switch-label">Show Terms Hero Banner?</div>
              <div class="form-hint">Display the executive header banner on /terms.</div>
            </div>
            <div class="form-check form-switch fs-4 mb-0">
              <input class="form-check-input" type="checkbox" name="terms_hero_enabled" value="1" <?= ($settings['terms_hero_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label-section">Eyebrow Badge</label>
              <input type="text" name="terms_hero_eyebrow" class="form-control" value="<?= e($settings['terms_hero_eyebrow'] ?? 'LEGAL COMPLIANCE & GOVERNANCE') ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label-section">Last Updated Text</label>
              <input type="text" name="terms_last_updated" class="form-control" value="<?= e($settings['terms_last_updated'] ?? 'September 2026') ?>">
            </div>
          </div>

          <div class="field-group">
            <label class="form-label-section">Main Heading (H1)</label>
            <input type="text" name="terms_hero_title" class="form-control fw-bold form-control-lg" value="<?= e($settings['terms_hero_title'] ?? 'Terms & Conditions of Service') ?>">
          </div>

          <div class="field-group">
            <label class="form-label-section">Subtitle</label>
            <textarea name="terms_hero_subtitle" class="form-control" rows="2"><?= e($settings['terms_hero_subtitle'] ?? 'Standard software license, enterprise SLA, multi-branch service agreement and operational policies.') ?></textarea>
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
         TERMS TAB: SECTION 2 - CLAUSES BUILDER
    ══════════════════════════════════════════════════════════════════════ -->
    <div class="cms-section-card" id="secCard-terms_clauses">
      <div class="cms-section-header active" onclick="toggleSection('terms_clauses')">
        <div class="cms-section-title">
          <span class="cms-section-icon" style="background:#FEF3C7; color:#D97706;"><i class="bi bi-card-checklist"></i></span>
          <span>Terms &amp; Conditions Clauses (<?= count($termsClauses) ?> Clauses)</span>
          <span class="badge bg-primary-subtle text-primary fs-11 px-2 py-1 ms-2">Editable</span>
        </div>
        <i class="bi bi-chevron-up text-muted fs-14" id="chevron-terms_clauses"></i>
      </div>

      <div class="cms-section-body show" id="secBody-terms_clauses">
        <form method="POST" action="/admin/legal-settings">
          <input type="hidden" name="tab" value="terms">
          <input type="hidden" name="section_name" value="terms_clauses">

          <div class="d-flex align-items-center justify-content-between mb-3">
            <label class="form-label-section mb-0"><i class="bi bi-patch-check-fill text-primary me-1"></i> Manage Terms Clauses</label>
            <button type="button" class="btn btn-sm btn-outline-primary fw-semibold" onclick="addNewClauseRow('termsContainer', 'terms_clause')">
              <i class="bi bi-plus-circle-fill me-1"></i> Add New Clause
            </button>
          </div>

          <div id="termsContainer">
            <?php foreach ($termsClauses as $idx => $cl): ?>
              <div class="clause-item-row" id="termsRow_<?= $idx ?>">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="badge bg-light text-dark border fs-12 fw-bold">Clause #<span class="cl-num"><?= $idx + 1 ?></span></span>
                  <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" onclick="removeRow('termsRow_<?= $idx ?>')">
                    <i class="bi bi-trash3-fill"></i> Remove
                  </button>
                </div>
                <div class="mb-2">
                  <input type="text" name="terms_clause_titles[]" class="form-control fw-bold" value="<?= e($cl['title'] ?? '') ?>" placeholder="e.g. 1. Acceptance of Terms" required>
                </div>
                <div>
                  <textarea name="terms_clause_contents[]" class="form-control fs-13" rows="4" placeholder="Detailed legal clause text..." required><?= e($cl['content'] ?? '') ?></textarea>
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
         TERMS TAB: SECTION 3 - SEO META
    ══════════════════════════════════════════════════════════════════════ -->
    <div class="cms-section-card" id="secCard-terms_seo">
      <div class="cms-section-header" onclick="toggleSection('terms_seo')">
        <div class="cms-section-title">
          <span class="cms-section-icon" style="background:#FFFBEB; color:#D97706;"><i class="bi bi-google"></i></span>
          <span>Terms Page SEO Meta</span>
        </div>
        <i class="bi bi-chevron-down text-muted fs-14" id="chevron-terms_seo"></i>
      </div>

      <div class="cms-section-body" id="secBody-terms_seo">
        <form method="POST" action="/admin/legal-settings">
          <input type="hidden" name="tab" value="terms">
          <input type="hidden" name="section_name" value="terms_seo">

          <div class="field-group">
            <label class="form-label-section">Meta Title</label>
            <input type="text" name="terms_seo_meta_title" class="form-control" value="<?= e($settings['terms_seo_meta_title'] ?? 'Terms & Conditions | GoldMatrix Jewellery ERP') ?>">
          </div>
          <div class="field-group">
            <label class="form-label-section">Meta Description</label>
            <textarea name="terms_seo_meta_desc" class="form-control" rows="2"><?= e($settings['terms_seo_meta_desc'] ?? 'Review GoldMatrix Software Technologies Terms of Service, licensing policy, SLA commitments and operational terms.') ?></textarea>
          </div>
          <div class="field-group">
            <label class="form-label-section">Meta Keywords</label>
            <textarea name="terms_seo_keywords" class="form-control" rows="2"><?= e($settings['terms_seo_keywords'] ?? 'goldmatrix terms, jewellery software terms, erp software license agreement') ?></textarea>
          </div>

          <div class="d-flex justify-content-end mt-4 pt-2 border-top">
            <button type="submit" class="btn-update-pink">
              <i class="bi bi-check2-circle fs-6"></i> Update
            </button>
          </div>
        </form>
      </div>
    </div>

  <?php else: ?>
    <!-- ══════════════════════════════════════════════════════════════════════
         PRIVACY TAB: SECTION 1 - HERO BANNER
    ══════════════════════════════════════════════════════════════════════ -->
    <div class="cms-section-card" id="secCard-privacy_hero">
      <div class="cms-section-header <?= $expandedSection === 'hero' ? 'active' : '' ?>" onclick="toggleSection('privacy_hero')">
        <div class="cms-section-title">
          <span class="cms-section-icon"><i class="bi bi-shield-check"></i></span>
          <span>Privacy Policy Hero Header Section</span>
          <?php if (($settings['privacy_hero_enabled'] ?? '1') === '1'): ?>
            <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
          <?php else: ?>
            <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
          <?php endif; ?>
        </div>
        <i class="bi <?= $expandedSection === 'hero' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-privacy_hero"></i>
      </div>

      <div class="cms-section-body <?= $expandedSection === 'hero' ? 'show' : '' ?>" id="secBody-privacy_hero">
        <form method="POST" action="/admin/legal-settings">
          <input type="hidden" name="tab" value="privacy">
          <input type="hidden" name="section_name" value="privacy_hero">

          <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
            <div>
              <div class="custom-switch-label">Show Privacy Policy Hero Banner?</div>
              <div class="form-hint">Display the header banner on /privacy.</div>
            </div>
            <div class="form-check form-switch fs-4 mb-0">
              <input class="form-check-input" type="checkbox" name="privacy_hero_enabled" value="1" <?= ($settings['privacy_hero_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label-section">Eyebrow Badge</label>
              <input type="text" name="privacy_hero_eyebrow" class="form-control" value="<?= e($settings['privacy_hero_eyebrow'] ?? 'DATA PROTECTION & PRIVACY COMMITMENT') ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label-section">Last Updated Text</label>
              <input type="text" name="privacy_last_updated" class="form-control" value="<?= e($settings['privacy_last_updated'] ?? 'September 2026') ?>">
            </div>
          </div>

          <div class="field-group">
            <label class="form-label-section">Main Heading (H1)</label>
            <input type="text" name="privacy_hero_title" class="form-control fw-bold form-control-lg" value="<?= e($settings['privacy_hero_title'] ?? 'Privacy Policy & Data Security') ?>">
          </div>

          <div class="field-group">
            <label class="form-label-section">Subtitle</label>
            <textarea name="privacy_hero_subtitle" class="form-control" rows="2"><?= e($settings['privacy_hero_subtitle'] ?? 'How GoldMatrix collects, protects, encrypts, and safeguards enterprise jewellery showroom and bullion data.') ?></textarea>
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
         PRIVACY TAB: SECTION 2 - CLAUSES BUILDER
    ══════════════════════════════════════════════════════════════════════ -->
    <div class="cms-section-card" id="secCard-privacy_clauses">
      <div class="cms-section-header active" onclick="toggleSection('privacy_clauses')">
        <div class="cms-section-title">
          <span class="cms-section-icon" style="background:#ECFDF5; color:#059669;"><i class="bi bi-shield-lock-fill"></i></span>
          <span>Privacy &amp; Data Protection Clauses (<?= count($privacyClauses) ?> Clauses)</span>
          <span class="badge bg-primary-subtle text-primary fs-11 px-2 py-1 ms-2">Editable</span>
        </div>
        <i class="bi bi-chevron-up text-muted fs-14" id="chevron-privacy_clauses"></i>
      </div>

      <div class="cms-section-body show" id="secBody-privacy_clauses">
        <form method="POST" action="/admin/legal-settings">
          <input type="hidden" name="tab" value="privacy">
          <input type="hidden" name="section_name" value="privacy_clauses">

          <div class="d-flex align-items-center justify-content-between mb-3">
            <label class="form-label-section mb-0"><i class="bi bi-patch-check-fill text-success me-1"></i> Manage Privacy Clauses</label>
            <button type="button" class="btn btn-sm btn-outline-success fw-semibold" onclick="addNewClauseRow('privacyContainer', 'privacy_clause')">
              <i class="bi bi-plus-circle-fill me-1"></i> Add New Clause
            </button>
          </div>

          <div id="privacyContainer">
            <?php foreach ($privacyClauses as $idx => $cl): ?>
              <div class="clause-item-row" id="privacyRow_<?= $idx ?>">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="badge bg-light text-dark border fs-12 fw-bold">Clause #<span class="cl-num"><?= $idx + 1 ?></span></span>
                  <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" onclick="removeRow('privacyRow_<?= $idx ?>')">
                    <i class="bi bi-trash3-fill"></i> Remove
                  </button>
                </div>
                <div class="mb-2">
                  <input type="text" name="privacy_clause_titles[]" class="form-control fw-bold" value="<?= e($cl['title'] ?? '') ?>" placeholder="e.g. 1. Information Collection" required>
                </div>
                <div>
                  <textarea name="privacy_clause_contents[]" class="form-control fs-13" rows="4" placeholder="Detailed privacy clause text..." required><?= e($cl['content'] ?? '') ?></textarea>
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
         PRIVACY TAB: SECTION 3 - SEO META
    ══════════════════════════════════════════════════════════════════════ -->
    <div class="cms-section-card" id="secCard-privacy_seo">
      <div class="cms-section-header" onclick="toggleSection('privacy_seo')">
        <div class="cms-section-title">
          <span class="cms-section-icon" style="background:#FFFBEB; color:#D97706;"><i class="bi bi-google"></i></span>
          <span>Privacy Page SEO Meta</span>
        </div>
        <i class="bi bi-chevron-down text-muted fs-14" id="chevron-privacy_seo"></i>
      </div>

      <div class="cms-section-body" id="secBody-privacy_seo">
        <form method="POST" action="/admin/legal-settings">
          <input type="hidden" name="tab" value="privacy">
          <input type="hidden" name="section_name" value="privacy_seo">

          <div class="field-group">
            <label class="form-label-section">Meta Title</label>
            <input type="text" name="privacy_seo_meta_title" class="form-control" value="<?= e($settings['privacy_seo_meta_title'] ?? 'Privacy Policy & Data Protection | GoldMatrix ERP') ?>">
          </div>
          <div class="field-group">
            <label class="form-label-section">Meta Description</label>
            <textarea name="privacy_seo_meta_desc" class="form-control" rows="2"><?= e($settings['privacy_seo_meta_desc'] ?? 'Read GoldMatrix Privacy Policy. Strict AES-256 cloud encryption and zero-sharing guarantee for jewellery inventory and financial records.') ?></textarea>
          </div>
          <div class="field-group">
            <label class="form-label-section">Meta Keywords</label>
            <textarea name="privacy_seo_keywords" class="form-control" rows="2"><?= e($settings['privacy_seo_keywords'] ?? 'goldmatrix privacy policy, jewellery data security, cloud erp privacy') ?></textarea>
          </div>

          <div class="d-flex justify-content-end mt-4 pt-2 border-top">
            <button type="submit" class="btn-update-pink">
              <i class="bi bi-check2-circle fs-6"></i> Update
            </button>
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>

</div>

<!-- JAVASCRIPT FOR ACCORDION TOGGLE & CLAUSE REPEATER -->
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
    if (header) header.classList.remove('active');
    if (chevron) chevron.className = 'bi bi-chevron-down text-muted fs-14';
  } else {
    body.classList.add('show');
    if (header) header.classList.add('active');
    if (chevron) chevron.className = 'bi bi-chevron-up text-muted fs-14';
  }
}

function toggleAllSections() {
  allExpanded = !allExpanded;
  const cards = document.querySelectorAll('.cms-section-card');
  cards.forEach(card => {
    const body = card.querySelector('.cms-section-body');
    const header = card.querySelector('.cms-section-header');
    const chevron = card.querySelector('.cms-section-header i.bi-chevron-down, .cms-section-header i.bi-chevron-up');
    if (body) {
      if (allExpanded) {
        body.classList.add('show');
        if (header) header.classList.add('active');
        if (chevron) chevron.className = 'bi bi-chevron-up text-muted fs-14';
      } else {
        body.classList.remove('show');
        if (header) header.classList.remove('active');
        if (chevron) chevron.className = 'bi bi-chevron-down text-muted fs-14';
      }
    }
  });

  document.getElementById('toggleAllText').innerText = allExpanded ? 'Collapse All' : 'Expand All';
}

let rowCounter = 100;

function addNewClauseRow(containerId, prefix) {
  rowCounter++;
  const container = document.getElementById(containerId);
  const rowId = prefix + '_row_' + rowCounter;
  
  const div = document.createElement('div');
  div.className = 'clause-item-row';
  div.id = rowId;
  div.innerHTML = `
    <div class="d-flex align-items-center justify-content-between mb-2">
      <span class="badge bg-light text-dark border fs-12 fw-bold">Clause #<span class="cl-num">New</span></span>
      <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" onclick="removeRow('${rowId}')">
        <i class="bi bi-trash3-fill"></i> Remove
      </button>
    </div>
    <div class="mb-2">
      <input type="text" name="${prefix}_titles[]" class="form-control fw-bold" placeholder="Clause Title..." required>
    </div>
    <div>
      <textarea name="${prefix}_contents[]" class="form-control fs-13" rows="4" placeholder="Detailed legal text..." required></textarea>
    </div>
  `;
  container.appendChild(div);
}

function removeRow(rowId) {
  const row = document.getElementById(rowId);
  if (row) {
    row.remove();
  }
}
</script>
