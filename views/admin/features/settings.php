<?php
/**
 * GoldMatrix ERP - Section-by-Section Features Page CMS Settings
 * Location: views/admin/features/settings.php
 */
$title = 'Features Page Settings';
$expandedSection = $expandedSection ?? 'hero';

// Parse Hardware Items
$hwJson = $settings['features_hardware_items'] ?? '[]';
$hwItems = json_decode($hwJson, true);
if (!is_array($hwItems) || empty($hwItems)) {
    $hwItems = [
        [
            'icon'  => 'bi-printer',
            'title' => 'Barcode & RFID Printers',
            'desc'  => 'Direct drivers for Zebra, TSC, Citizen, and Honeywell dumbbell and rat-tail jewellery tags.'
        ],
        [
            'icon'  => 'bi-speedometer2',
            'title' => 'Certified Weighing Scales',
            'desc'  => 'Serial RS-232 & USB connectivity for Essae, Mettler Toledo, and Contech precision balances.'
        ],
        [
            'icon'  => 'bi-broadcast-pin',
            'title' => 'High-Speed UHF RFID Trays',
            'desc'  => 'High-speed tray readers from Chainway, CSL, and smart counter pads for 3-second audits.'
        ],
        [
            'icon'  => 'bi-tv',
            'title' => 'Digital TV Rate Boards',
            'desc'  => 'Dedicated HDMI URL stream showing live 24K, 22K, 18K and Silver market rates with custom branding.'
        ]
    ];
}
?>

<style>
/* ══════════════════════════════════════════════════════
   SECTION-BY-SECTION.cms-section-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  margin-bottom: 12px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.02);
  overflow: hidden;
  transition: all 0.2s ease;
}
.cms-section-card:hover {
  border-color: #CBD5E1;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.cms-section-header {
  padding: 12px 18px;
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
  font-size: 13.5px;
  font-weight: 600;
  color: #1E293B;
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 0;
}
.cms-section-icon {
  width: 28px;
  height: 28px;
  border-radius: 6px;
  background: #EEF2FF;
  color: #4F46E5;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
}
.cms-section-body {
  padding: 18px 20px;
  display: none;
  background: #FFFFFF;
}
.cms-section-body.show {
  display: block;
}
.btn-update-pink {
  background: #E11D48;
  color: #FFFFFF;
  font-weight: 600;
  font-size: 13px;
  padding: 6px 20px;
  border-radius: 6px;
  border: none;
  box-shadow: 0 2px 6px rgba(225, 29, 72, 0.2);
}
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
.hw-item-row {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 18px;
  margin-bottom: 14px;
}
</style>

<div class="container-fluid px-0" style="max-width: 1140px; margin: 0 auto;">

  <!-- TOP HEADER & CONTROLS -->
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center gap-3">
      <div class="p-3 bg-warning-subtle text-warning-emphasis rounded-3">
        <i class="bi bi-stars fs-3"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2">
          <h2 class="h4 fw-bold text-dark mb-0">Features Page Settings</h2>
          <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Section CMS</span>
        </div>
        <p class="text-muted small mb-0 mt-1">Edit every section of the Features (/features) overview page. Changes synchronize live to the website instantly.</p>
      </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
      <a href="/admin/features" class="btn btn-navy btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold">
        <i class="bi bi-grid-3x3-gap-fill"></i>
        <span>Manage 10 Individual Modules</span>
      </a>

      <form method="POST" action="/admin/features-settings" class="d-inline">
        <input type="hidden" name="action" value="clear_cache">
        <input type="hidden" name="section_name" value="<?= e($expandedSection) ?>">
        <button type="submit" class="btn-clear-cache">
          <i class="bi bi-eraser-fill"></i> Clear Cache
        </button>
      </form>

      <a href="/features" target="_blank" class="btn btn-outline-dark btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold">
        <i class="bi bi-box-arrow-up-right"></i>
        <span>Live Features Page</span>
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
        <span>Features Hero Banner Section</span>
        <?php if (($settings['features_hero_enabled'] ?? '1') === '1'): ?>
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
      <form method="POST" action="/admin/features-settings">
        <input type="hidden" name="section_name" value="hero">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Features Hero Banner?</div>
            <div class="form-hint">Enable or disable the top header banner of the Features page.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="features_hero_enabled" value="1" <?= ($settings['features_hero_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Eyebrow Badge Text</label>
            <input type="text" name="features_hero_badge" class="form-control" value="<?= e($settings['features_hero_badge'] ?? '10 Integrated Modules') ?>" placeholder="e.g. 10 Integrated Modules">
            <div class="form-hint">Pill badge shown with an icon above the main heading.</div>
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Background Visual Style</label>
            <select name="features_hero_bg_style" class="form-select">
              <option value="navy" <?= ($settings['features_hero_bg_style'] ?? 'navy') === 'navy' ? 'selected' : '' ?>>Enterprise Navy Dark (#0F172A)</option>
              <option value="gradient" <?= ($settings['features_hero_bg_style'] ?? '') === 'gradient' ? 'selected' : '' ?>>Midnight Gradient (#1E293B)</option>
              <option value="slate" <?= ($settings['features_hero_bg_style'] ?? '') === 'slate' ? 'selected' : '' ?>>Deep Slate (#0A1128)</option>
            </select>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-7">
            <label class="form-label-section">Main Heading (H1 Prefix)</label>
            <input type="text" name="features_hero_title" class="form-control form-control-lg fw-bold" value="<?= e($settings['features_hero_title'] ?? 'Every Capability Engineered for') ?>" placeholder="e.g. Every Capability Engineered for">
          </div>
          <div class="col-md-5">
            <label class="form-label-section">Highlighted Words (Gold)</label>
            <input type="text" name="features_hero_highlight" class="form-control form-control-lg fw-bold text-warning" value="<?= e($settings['features_hero_highlight'] ?? 'Jewellery Business ERP') ?>" placeholder="e.g. Jewellery Business ERP">
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Hero Subtitle / Description</label>
          <textarea name="features_hero_desc" class="form-control" rows="3" placeholder="Enter supporting subtitle text..."><?= e($settings['features_hero_desc'] ?? 'Explore all 10 core modules powering jewellery retail showrooms, wholesale bullion traders, and manufacturing workshop units worldwide.') ?></textarea>
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
       SECTION 2: CATEGORY FILTER TABS BAR
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-filter">
    <div class="cms-section-header <?= $expandedSection === 'filter' ? 'active' : '' ?>" onclick="toggleSection('filter')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FEF3C7; color:#D97706;"><i class="bi bi-segmented-nav"></i></span>
        <span>Category Filter Tabs Bar</span>
        <?php if (($settings['features_filter_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'filter' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-filter"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'filter' ? 'show' : '' ?>" id="secBody-filter">
      <form method="POST" action="/admin/features-settings">
        <input type="hidden" name="section_name" value="filter">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Dynamic Category Filter Bar?</div>
            <div class="form-hint">Enables 1-click category pills (Retail, Manufacturing, Finance, Inventory, Staff) below the hero.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="features_filter_enabled" value="1" <?= ($settings['features_filter_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Category Filter Tabs (Format: Label|FilterTag, one per line)</label>
          <textarea name="features_filter_categories" class="form-control font-monospace fs-13" rows="6" placeholder="All 10 Modules|all..."><?= e($settings['features_filter_categories'] ?? "All 10 Modules|all\nRetail & Billing|Retail & Operations\nManufacturing & Jobwork|Manufacturing\nAccounting & GST|Finance\nStock & RFID|Inventory\nStaff & Admin|Admin") ?></textarea>
          <div class="form-hint">Each line defines a clickable filter button on the frontend.</div>
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
       SECTION 3: 10 CORE MODULES GRID OVERVIEW
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-grid">
    <div class="cms-section-header <?= $expandedSection === 'grid' ? 'active' : '' ?>" onclick="toggleSection('grid')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#ECFDF5; color:#059669;"><i class="bi bi-grid-3x3-gap-fill"></i></span>
        <span>10 Core Modules Grid Section</span>
        <?php if (($settings['features_grid_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active (<?= $moduleCount ?> Modules)</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'grid' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-grid"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'grid' ? 'show' : '' ?>" id="secBody-grid">
      <form method="POST" action="/admin/features-settings">
        <input type="hidden" name="section_name" value="grid">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show 10 Core Modules Grid?</div>
            <div class="form-hint">Display the 3-column cards grid for all 10 ERP modules.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="features_grid_enabled" value="1" <?= ($settings['features_grid_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Grid Section Title</label>
            <input type="text" name="features_grid_title" class="form-control fw-bold" value="<?= e($settings['features_grid_title'] ?? '10 Enterprise Jewellery Modules') ?>" placeholder="e.g. 10 Enterprise Jewellery Modules">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Grid Subtitle</label>
            <input type="text" name="features_grid_subtitle" class="form-control" value="<?= e($settings['features_grid_subtitle'] ?? 'Complete end-to-end integration across all operational departments.') ?>" placeholder="e.g. Complete end-to-end integration...">
          </div>
        </div>

        <div class="p-3 bg-primary-subtle border border-primary-subtle rounded-3 mb-3 d-flex align-items-center justify-content-between">
          <div>
            <div class="fw-bold text-primary fs-14"><i class="bi bi-info-circle-fill me-1"></i> Individual Module Content Manager</div>
            <div class="text-muted fs-12">Edit descriptions, bullet points, sub-features, and SEO for each of the 10 modules individually.</div>
          </div>
          <a href="/admin/features" class="btn btn-primary btn-sm px-3 py-2 fw-semibold">
            <i class="bi bi-pencil-square me-1"></i> Open Modules Editor (<?= $moduleCount ?>)
          </a>
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
       SECTION 4: HARDWARE & ECOSYSTEM COMPATIBILITY BAR
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-hardware">
    <div class="cms-section-header <?= $expandedSection === 'hardware' ? 'active' : '' ?>" onclick="toggleSection('hardware')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#EFF6FF; color:#2563EB;"><i class="bi bi-cpu-fill"></i></span>
        <span>Hardware & Ecosystem Compatibility Bar</span>
        <?php if (($settings['features_hardware_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active (<?= count($hwItems) ?> Cards)</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'hardware' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-hardware"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'hardware' ? 'show' : '' ?>" id="secBody-hardware">
      <form method="POST" action="/admin/features-settings">
        <input type="hidden" name="section_name" value="hardware">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Hardware Compatibility Section?</div>
            <div class="form-hint">Display the plug & play hardware integration strip (Printers, Weighing Scales, RFID, TV Rate Boards).</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="features_hardware_enabled" value="1" <?= ($settings['features_hardware_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label-section">Eyebrow Badge</label>
            <input type="text" name="features_hardware_badge" class="form-control" value="<?= e($settings['features_hardware_badge'] ?? 'PLUG & PLAY ECOSYSTEM') ?>" placeholder="e.g. PLUG & PLAY ECOSYSTEM">
          </div>
          <div class="col-md-8">
            <label class="form-label-section">Section Main Heading</label>
            <input type="text" name="features_hardware_title" class="form-control fw-bold" value="<?= e($settings['features_hardware_title'] ?? 'Certified Compatibility with Showroom & Factory Hardware') ?>" placeholder="e.g. Certified Compatibility...">
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3">
          <label class="form-label-section mb-0"><i class="bi bi-hdd-network-fill text-primary me-1"></i> Manage Hardware Cards</label>
          <button type="button" class="btn btn-sm btn-outline-primary fw-semibold" onclick="addNewHwRow()">
            <i class="bi bi-plus-circle-fill me-1"></i> Add Hardware Card
          </button>
        </div>

        <div id="hwItemsContainer">
          <?php foreach ($hwItems as $idx => $hw): ?>
            <div class="hw-item-row" id="hwRow_<?= $idx ?>">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="badge bg-light text-dark border fs-12 fw-bold">Hardware Card #<span class="hw-num"><?= $idx + 1 ?></span></span>
                <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" onclick="removeHwRow('hwRow_<?= $idx ?>')">
                  <i class="bi bi-trash3-fill"></i> Remove
                </button>
              </div>
              <div class="row g-2 mb-2">
                <div class="col-md-4">
                  <label class="form-hint mb-1">Bootstrap Icon Class</label>
                  <input type="text" name="hw_icons[]" class="form-control fs-13" value="<?= e($hw['icon'] ?? 'bi-cpu') ?>" placeholder="e.g. bi-printer" required>
                </div>
                <div class="col-md-8">
                  <label class="form-hint mb-1">Hardware Card Title</label>
                  <input type="text" name="hw_titles[]" class="form-control fs-13 fw-semibold" value="<?= e($hw['title'] ?? '') ?>" placeholder="e.g. Barcode & RFID Printers" required>
                </div>
              </div>
              <div>
                <label class="form-hint mb-1">Short Description / Compatible Brands</label>
                <textarea name="hw_descs[]" class="form-control fs-13" rows="2" placeholder="Supported brands..." required><?= e($hw['desc'] ?? '') ?></textarea>
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
       SECTION 5: BOTTOM CONVERSION & DEMO CTA BANNER
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-cta">
    <div class="cms-section-header <?= $expandedSection === 'cta' ? 'active' : '' ?>" onclick="toggleSection('cta')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FDF2F8; color:#DB2777;"><i class="bi bi-megaphone-fill"></i></span>
        <span>Bottom Conversion & Demo CTA Banner</span>
        <?php if (($settings['features_cta_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'cta' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-cta"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'cta' ? 'show' : '' ?>" id="secBody-cta">
      <form method="POST" action="/admin/features-settings">
        <input type="hidden" name="section_name" value="cta">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Bottom Conversion CTA Banner?</div>
            <div class="form-hint">Display the prominent demo walkthrough and WhatsApp lead banner at the bottom.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="features_cta_enabled" value="1" <?= ($settings['features_cta_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">CTA Main Heading</label>
          <input type="text" name="features_cta_title" class="form-control form-control-lg fw-bold" value="<?= e($settings['features_cta_title'] ?? 'See All 10 Modules in a Live Personalized Demo') ?>" placeholder="e.g. See All 10 Modules in a Live Demo">
        </div>

        <div class="field-group">
          <label class="form-label-section">CTA Description</label>
          <textarea name="features_cta_desc" class="form-control" rows="2" placeholder="Enter supporting text..."><?= e($settings['features_cta_desc'] ?? 'Schedule a private 30-minute walkthrough with a jewellery ERP specialist to see how GoldMatrix automates your showroom, factory, and multi-branch operations.') ?></textarea>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Primary Button Text</label>
            <input type="text" name="features_cta_btn1_text" class="form-control" value="<?= e($settings['features_cta_btn1_text'] ?? 'Book Free Live Demo') ?>" placeholder="Book Free Live Demo">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Primary Button Link / Modal Target</label>
            <input type="text" name="features_cta_btn1_link" class="form-control" value="<?= e($settings['features_cta_btn1_link'] ?? '#bookDemoModal') ?>" placeholder="#bookDemoModal or /contact">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Secondary Button Text</label>
            <input type="text" name="features_cta_btn2_text" class="form-control" value="<?= e($settings['features_cta_btn2_text'] ?? 'Chat on WhatsApp') ?>" placeholder="Chat on WhatsApp">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">WhatsApp Support Number</label>
            <input type="text" name="features_cta_whatsapp" class="form-control" value="<?= e($settings['features_cta_whatsapp'] ?? '+91 92703 69937') ?>" placeholder="+91 92703 69937">
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
       SECTION 6: FEATURES PAGE SEO & SOCIAL META
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-seo">
    <div class="cms-section-header <?= $expandedSection === 'seo' ? 'active' : '' ?>" onclick="toggleSection('seo')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FFFBEB; color:#D97706;"><i class="bi bi-google"></i></span>
        <span>Features Page SEO & Social Meta</span>
        <span class="badge bg-primary-subtle text-primary fs-11 px-2 py-1 ms-2">Search Engine</span>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'seo' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-seo"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'seo' ? 'show' : '' ?>" id="secBody-seo">
      <form method="POST" action="/admin/features-settings" enctype="multipart/form-data">
        <input type="hidden" name="section_name" value="seo">

        <div class="field-group">
          <div class="d-flex justify-content-between align-items-center">
            <label class="form-label-section">Meta Title</label>
            <span class="text-muted fs-11" id="seoTitleCounter">0 / 60 chars</span>
          </div>
          <input type="text" name="features_seo_meta_title" id="features_seo_meta_title" class="form-control" value="<?= e($settings['features_seo_meta_title'] ?? 'Complete Jewellery ERP Features & 10 Core Modules | GoldMatrix') ?>" placeholder="Features Meta Title" oninput="updateCharCount('features_seo_meta_title', 'seoTitleCounter', 60)">
          <div class="form-hint">Recommended length: 50-60 characters for optimal Google ranking.</div>
        </div>

        <div class="field-group">
          <div class="d-flex justify-content-between align-items-center">
            <label class="form-label-section">Meta Description</label>
            <span class="text-muted fs-11" id="seoDescCounter">0 / 160 chars</span>
          </div>
          <textarea name="features_seo_meta_desc" id="features_seo_meta_desc" class="form-control" rows="3" placeholder="Enter compelling description of all 10 ERP modules..." oninput="updateCharCount('features_seo_meta_desc', 'seoDescCounter', 160)"><?= e($settings['features_seo_meta_desc'] ?? 'Explore all 10 core modules of GoldMatrix Jewellery ERP: Dashboard & Live Rates, Opening Setup, Operations, Order Management, Production, Financial Statements, Report Analysis, Employee Management, Stock Management, and Settings.') ?></textarea>
          <div class="form-hint">Recommended length: 140-160 characters.</div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Meta Keywords (Comma separated)</label>
          <textarea name="features_seo_keywords" class="form-control" rows="2" placeholder="jewellery erp modules, jewellery features, gold erp features..."><?= e($settings['features_seo_keywords'] ?? 'jewellery erp modules, jewellery features, gold erp features, jewellery production software, jewellery stock management, jewellery accounting') ?></textarea>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">OpenGraph Social Sharing Image URL</label>
            <input type="text" name="features_seo_og_image" class="form-control" value="<?= e($settings['features_seo_og_image'] ?? '') ?>" placeholder="https://... or /uploads/features/banner.jpg">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Or Upload New Social Image</label>
            <input type="file" name="features_seo_og_image_file" class="form-control" accept="image/*">
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

<!-- JAVASCRIPT FOR ACCORDION TOGGLE & HARDWARE REPEATER -->
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
  const sections = ['hero', 'filter', 'grid', 'hardware', 'cta', 'seo'];
  
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

let hwCounter = <?= count($hwItems) + 10 ?>;

function addNewHwRow() {
  hwCounter++;
  const container = document.getElementById('hwItemsContainer');
  const rowId = 'hwRow_' + hwCounter;
  
  const div = document.createElement('div');
  div.className = 'hw-item-row';
  div.id = rowId;
  div.innerHTML = `
    <div class="d-flex align-items-center justify-content-between mb-2">
      <span class="badge bg-light text-dark border fs-12 fw-bold">Hardware Card #<span class="hw-num">New</span></span>
      <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" onclick="removeHwRow('${rowId}')">
        <i class="bi bi-trash3-fill"></i> Remove
      </button>
    </div>
    <div class="row g-2 mb-2">
      <div class="col-md-4">
        <label class="form-hint mb-1">Bootstrap Icon Class</label>
        <input type="text" name="hw_icons[]" class="form-control fs-13" value="bi-hdd" placeholder="e.g. bi-printer" required>
      </div>
      <div class="col-md-8">
        <label class="form-hint mb-1">Hardware Card Title</label>
        <input type="text" name="hw_titles[]" class="form-control fs-13 fw-semibold" placeholder="e.g. Touch POS Terminals" required>
      </div>
    </div>
    <div>
      <label class="form-hint mb-1">Short Description / Compatible Brands</label>
      <textarea name="hw_descs[]" class="form-control fs-13" rows="2" placeholder="Supported devices..." required></textarea>
    </div>
  `;
  container.appendChild(div);
}

function removeHwRow(rowId) {
  const row = document.getElementById(rowId);
  if (row) {
    row.remove();
  }
}

// Initialize character counters
document.addEventListener('DOMContentLoaded', function() {
  updateCharCount('features_seo_meta_title', 'seoTitleCounter', 60);
  updateCharCount('features_seo_meta_desc', 'seoDescCounter', 160);
});
</script>
