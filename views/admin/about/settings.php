<?php
/**
 * GoldMatrix ERP - Section-by-Section About Us Page CMS Settings
 * Location: views/admin/about/settings.php
 */
$title = 'About Us Page Settings';
$expandedSection = $expandedSection ?? 'hero';

// Parse Stats
$statsJson = $settings['about_stats_items'] ?? '[]';
$stats = json_decode($statsJson, true);
if (!is_array($stats) || empty($stats)) {
    $stats = [
        ['num' => '1,500+', 'label' => 'Jewellery Stores & Factories Powered'],
        ['num' => '15+',    'label' => 'Years of Jewellery Domain Innovation'],
        ['num' => '10+',    'label' => 'Countries with Active Deployments'],
        ['num' => '99.9%',  'label' => 'Customer Retention & Uptime Record']
    ];
}

// Parse Values
$valuesJson = $settings['about_values_items'] ?? '[]';
$values = json_decode($valuesJson, true);
if (!is_array($values) || empty($values)) {
    $values = [
        ['icon' => 'bi-shield-check', 'title' => 'Zero-Tolerance Accuracy', 'desc' => 'Gold, diamond, and multi-currency transactions calculated to four decimal places.'],
        ['icon' => 'bi-cloud-check',  'title' => 'High-Availability Cloud', 'desc' => 'Distributed multi-region infrastructure with automated hourly backups.'],
        ['icon' => 'bi-stars',        'title' => 'Continuous Innovation',    'desc' => 'Quarterly feature rollouts incorporating UHF RFID scanning and live rates.'],
        ['icon' => 'bi-headset',      'title' => 'Dedicated On-Site Support','desc' => 'Direct field engineering and implementation consultants available locally.']
    ];
}

// Parse Timeline
$timelineJson = $settings['about_timeline_items'] ?? '[]';
$timeline = json_decode($timelineJson, true);
if (!is_array($timeline) || empty($timeline)) {
    $timeline = [
        ['year' => '2010', 'title' => 'Founding & POS Launch', 'desc' => 'First-generation retail POS and barcode solution developed.'],
        ['year' => '2015', 'title' => 'Karigar & Jobwork Module', 'desc' => 'Launched complete manufacturing suite tracking metal loss.'],
        ['year' => '2020', 'title' => 'Cloud & RFID Revolution', 'desc' => 'Architected fully-distributed cloud ERP with UHF RFID.'],
        ['year' => '2025+', 'title' => 'International Expansion', 'desc' => 'Established UAE international headquarters in Sharjah Gold Souq.']
    ];
}
?>

<style>
/* ════════════════════════════════════════════════════�.cms-section-card {
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
}near-gradient(135deg, #E11D48 0%, #BE123C 100%);
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
.item-repeater-row {
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
      <div class="p-3 bg-info-subtle text-info-emphasis rounded-3">
        <i class="bi bi-building-gear fs-3"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2">
          <h2 class="h4 fw-bold text-dark mb-0">About Us Page Settings</h2>
          <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Section CMS</span>
        </div>
        <p class="text-muted small mb-0 mt-1">Edit every section of the About Us page individually. Changes synchronize live to the website instantly.</p>
      </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
      <form method="POST" action="/admin/about-settings" class="d-inline">
        <input type="hidden" name="action" value="clear_cache">
        <input type="hidden" name="section_name" value="<?= e($expandedSection) ?>">
        <button type="submit" class="btn-clear-cache">
          <i class="bi bi-eraser-fill"></i> Clear Cache
        </button>
      </form>

      <a href="/about" target="_blank" class="btn btn-outline-dark btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold">
        <i class="bi bi-box-arrow-up-right"></i>
        <span>Live About Page</span>
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

  <!-- ══════════════════════════════════════════════════════════════════════
       SECTION 1: HERO BANNER SECTION
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-hero">
    <div class="cms-section-header <?= $expandedSection === 'hero' ? 'active' : '' ?>" onclick="toggleSection('hero')">
      <div class="cms-section-title">
        <span class="cms-section-icon"><i class="bi bi-display"></i></span>
        <span>About Hero Banner Section</span>
        <?php if (($settings['about_hero_enabled'] ?? '1') === '1'): ?>
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
      <form method="POST" action="/admin/about-settings">
        <input type="hidden" name="section_name" value="hero">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show About Hero Banner?</div>
            <div class="form-hint">Enable or disable the main dark header at the top of the About page.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="about_hero_enabled" value="1" <?= ($settings['about_hero_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Eyebrow Badge Text</label>
            <input type="text" name="about_hero_eyebrow" class="form-control" value="<?= e($settings['about_hero_eyebrow'] ?? 'ENTERPRISE ARCHITECTURE') ?>" placeholder="e.g. ENTERPRISE ARCHITECTURE">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Background Visual Style</label>
            <select name="about_hero_bg_style" class="form-select">
              <option value="dark" <?= ($settings['about_hero_bg_style'] ?? 'dark') === 'dark' ? 'selected' : '' ?>>Executive Navy Dark (#050B18)</option>
              <option value="gradient" <?= ($settings['about_hero_bg_style'] ?? '') === 'gradient' ? 'selected' : '' ?>>Midnight Gradient (#111C3A Radial)</option>
              <option value="slate" <?= ($settings['about_hero_bg_style'] ?? '') === 'slate' ? 'selected' : '' ?>>Deep Slate (#0F172A)</option>
            </select>
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Main Heading (H1)</label>
          <input type="text" name="about_hero_title" class="form-control form-control-lg fw-bold" value="<?= e($settings['about_hero_title'] ?? 'Powering the Global Jewellery Industry with Next-Gen ERP') ?>" placeholder="e.g. Powering the Global Jewellery Industry...">
        </div>

        <div class="field-group">
          <label class="form-label-section">Hero Subtitle / Mission Statement</label>
          <textarea name="about_hero_sub" class="form-control" rows="3" placeholder="Enter supporting mission statement..."><?= e($settings['about_hero_sub'] ?? 'GoldMatrix Software Technologies is a specialized enterprise solutions provider for retail showrooms, bullion traders, and high-precision manufacturing units across the UAE, India, and worldwide.') ?></textarea>
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
       SECTION 2: COMPANY STORY & VISION
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-story">
    <div class="cms-section-header <?= $expandedSection === 'story' ? 'active' : '' ?>" onclick="toggleSection('story')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FEF3C7; color:#D97706;"><i class="bi bi-book-half"></i></span>
        <span>Company Story & Mission Section</span>
        <?php if (($settings['about_story_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'story' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-story"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'story' ? 'show' : '' ?>" id="secBody-story">
      <form method="POST" action="/admin/about-settings" enctype="multipart/form-data">
        <input type="hidden" name="section_name" value="story">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Company Story Section?</div>
            <div class="form-hint">Display the 2-column story text and featured image.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="about_story_enabled" value="1" <?= ($settings['about_story_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label-section">Story Eyebrow Badge</label>
            <input type="text" name="about_story_badge" class="form-control" value="<?= e($settings['about_story_badge'] ?? 'OUR MISSION & FOUNDATION') ?>" placeholder="e.g. OUR MISSION & FOUNDATION">
          </div>
          <div class="col-md-8">
            <label class="form-label-section">Story Main Heading (H2)</label>
            <input type="text" name="about_story_title" class="form-control fw-bold" value="<?= e($settings['about_story_title'] ?? 'Engineered Exclusively for the Intricacies of Gold & Diamond Commerce') ?>" placeholder="e.g. Engineered Exclusively for...">
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Story Paragraph 1</label>
          <textarea name="about_story_p1" class="form-control" rows="3" placeholder="Paragraph 1 text..."><?= e($settings['about_story_p1'] ?? 'Founded by veteran jewellery domain technologists and enterprise software architects, GoldMatrix was conceived to solve the severe limitations of generic ERP systems when applied to the precious metals trade.') ?></textarea>
        </div>

        <div class="field-group">
          <label class="form-label-section">Story Paragraph 2</label>
          <textarea name="about_story_p2" class="form-control" rows="3" placeholder="Paragraph 2 text..."><?= e($settings['about_story_p2'] ?? 'From real-time bullion rate adjustments to micro-precision Karigar jobwork accounting and RFID stock audibility in under 3 seconds, our platform bridges traditional craftsmanship with modern cloud scalability.') ?></textarea>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Story Featured Image URL</label>
            <input type="text" name="about_story_image" class="form-control" value="<?= e($settings['about_story_image'] ?? 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=1000&auto=format&fit=crop&q=80') ?>" placeholder="https://...">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Or Upload New Image</label>
            <input type="file" name="about_story_image_file" class="form-control" accept="image/*">
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
       SECTION 3: KEY STATISTICS STRIP
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-stats">
    <div class="cms-section-header <?= $expandedSection === 'stats' ? 'active' : '' ?>" onclick="toggleSection('stats')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#ECFDF5; color:#059669;"><i class="bi bi-graph-up-arrow"></i></span>
        <span>Key Statistics Strip (4 Stats)</span>
        <?php if (($settings['about_stats_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active (<?= count($stats) ?> Counters)</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'stats' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-stats"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'stats' ? 'show' : '' ?>" id="secBody-stats">
      <form method="POST" action="/admin/about-settings">
        <input type="hidden" name="section_name" value="stats">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Key Statistics Strip?</div>
            <div class="form-hint">Display the 4-column metric numbers strip.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="about_stats_enabled" value="1" <?= ($settings['about_stats_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3">
          <?php foreach ($stats as $idx => $st): ?>
            <div class="col-md-6 mb-3">
              <div class="item-repeater-row mb-0">
                <div class="fw-bold text-dark fs-12 mb-2">Stat #<?= $idx + 1 ?></div>
                <div class="mb-2">
                  <label class="form-hint mb-1">Metric Number / Value</label>
                  <input type="text" name="stat_nums[]" class="form-control fw-bold" value="<?= e($st['num'] ?? '') ?>" placeholder="e.g. 1,500+" required>
                </div>
                <div>
                  <label class="form-hint mb-1">Metric Label</label>
                  <input type="text" name="stat_labels[]" class="form-control fs-13" value="<?= e($st['label'] ?? '') ?>" placeholder="e.g. Stores & Factories Powered" required>
                </div>
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
       SECTION 4: CORE VALUES SECTION
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-values">
    <div class="cms-section-header <?= $expandedSection === 'values' ? 'active' : '' ?>" onclick="toggleSection('values')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FAF5FF; color:#9333EA;"><i class="bi bi-stars"></i></span>
        <span>Core Values & Principles Section</span>
        <?php if (($settings['about_values_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active (<?= count($values) ?> Values)</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'values' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-values"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'values' ? 'show' : '' ?>" id="secBody-values">
      <form method="POST" action="/admin/about-settings">
        <input type="hidden" name="section_name" value="values">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Core Values Section?</div>
            <div class="form-hint">Display the 4-column principles cards grid.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="about_values_enabled" value="1" <?= ($settings['about_values_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label-section">Section Eyebrow Badge</label>
            <input type="text" name="about_values_badge" class="form-control" value="<?= e($settings['about_values_badge'] ?? 'CORE PRINCIPLES') ?>" placeholder="e.g. CORE PRINCIPLES">
          </div>
          <div class="col-md-8">
            <label class="form-label-section">Section Heading</label>
            <input type="text" name="about_values_title" class="form-control fw-bold" value="<?= e($settings['about_values_title'] ?? 'What Guides Our Product Engineering') ?>" placeholder="e.g. What Guides Our Product Engineering">
          </div>
        </div>

        <div class="row g-3">
          <?php foreach ($values as $idx => $v): ?>
            <div class="col-md-6 mb-3">
              <div class="item-repeater-row mb-0">
                <div class="row g-2 mb-2">
                  <div class="col-4">
                    <label class="form-hint mb-1">Icon Class</label>
                    <input type="text" name="val_icons[]" class="form-control fs-13" value="<?= e($v['icon'] ?? 'bi-stars') ?>" required>
                  </div>
                  <div class="col-8">
                    <label class="form-hint mb-1">Principle Title</label>
                    <input type="text" name="val_titles[]" class="form-control fs-13 fw-bold" value="<?= e($v['title'] ?? '') ?>" required>
                  </div>
                </div>
                <div>
                  <label class="form-hint mb-1">Description</label>
                  <textarea name="val_descs[]" class="form-control fs-13" rows="2" required><?= e($v['desc'] ?? '') ?></textarea>
                </div>
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
       SECTION 5: TIMELINE / MILESTONES
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-timeline">
    <div class="cms-section-header <?= $expandedSection === 'timeline' ? 'active' : '' ?>" onclick="toggleSection('timeline')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#EFF6FF; color:#2563EB;"><i class="bi bi-clock-history"></i></span>
        <span>Company Evolution Timeline (Milestones)</span>
        <?php if (($settings['about_timeline_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active (<?= count($timeline) ?> Milestones)</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'timeline' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-timeline"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'timeline' ? 'show' : '' ?>" id="secBody-timeline">
      <form method="POST" action="/admin/about-settings">
        <input type="hidden" name="section_name" value="timeline">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Evolution Timeline Section?</div>
            <div class="form-hint">Display the 4-stage historical milestone journey.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="about_timeline_enabled" value="1" <?= ($settings['about_timeline_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label-section">Timeline Eyebrow Badge</label>
            <input type="text" name="about_timeline_badge" class="form-control" value="<?= e($settings['about_timeline_badge'] ?? 'OUR EVOLUTION') ?>" placeholder="e.g. OUR EVOLUTION">
          </div>
          <div class="col-md-8">
            <label class="form-label-section">Timeline Main Heading</label>
            <input type="text" name="about_timeline_title" class="form-control fw-bold" value="<?= e($settings['about_timeline_title'] ?? '15 Years of Domain Leadership') ?>" placeholder="e.g. 15 Years of Domain Leadership">
          </div>
        </div>

        <div class="row g-3">
          <?php foreach ($timeline as $idx => $tm): ?>
            <div class="col-md-6 mb-3">
              <div class="item-repeater-row mb-0">
                <div class="row g-2 mb-2">
                  <div class="col-4">
                    <label class="form-hint mb-1">Year / Epoch</label>
                    <input type="text" name="tm_years[]" class="form-control fw-bold text-warning" value="<?= e($tm['year'] ?? '') ?>" placeholder="e.g. 2010" required>
                  </div>
                  <div class="col-8">
                    <label class="form-hint mb-1">Milestone Title</label>
                    <input type="text" name="tm_titles[]" class="form-control fs-13 fw-bold" value="<?= e($tm['title'] ?? '') ?>" placeholder="e.g. Founding" required>
                  </div>
                </div>
                <div>
                  <label class="form-hint mb-1">Milestone Description</label>
                  <textarea name="tm_descs[]" class="form-control fs-13" rows="2" required><?= e($tm['desc'] ?? '') ?></textarea>
                </div>
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
       SECTION 6: DUAL GLOBAL HUBS (UAE & INDIA)
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-hubs">
    <div class="cms-section-header <?= $expandedSection === 'hubs' ? 'active' : '' ?>" onclick="toggleSection('hubs')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FEF3C7; color:#B45309;"><i class="bi bi-geo-alt-fill"></i></span>
        <span>Dual Global Hubs Section (UAE & India)</span>
        <?php if (($settings['about_hubs_enabled'] ?? '1') === '1'): ?>
          <span class="badge bg-success-subtle text-success fs-11 px-2 py-1 ms-2">Active</span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1 ms-2">Hidden</span>
        <?php endif; ?>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'hubs' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-hubs"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'hubs' ? 'show' : '' ?>" id="secBody-hubs">
      <form method="POST" action="/admin/about-settings">
        <input type="hidden" name="section_name" value="hubs">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Global Hubs Section?</div>
            <div class="form-hint">Display the UAE international headquarter and India development hub location cards.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="about_hubs_enabled" value="1" <?= ($settings['about_hubs_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label-section">Section Eyebrow Badge</label>
            <input type="text" name="about_hubs_badge" class="form-control" value="<?= e($settings['about_hubs_badge'] ?? 'INTERNATIONAL INFRASTRUCTURE') ?>" placeholder="e.g. INTERNATIONAL INFRASTRUCTURE">
          </div>
          <div class="col-md-8">
            <label class="form-label-section">Section Main Heading</label>
            <input type="text" name="about_hubs_title" class="form-control fw-bold" value="<?= e($settings['about_hubs_title'] ?? 'Operating Across Key Jewellery Capitals') ?>" placeholder="e.g. Operating Across Key Jewellery Capitals">
          </div>
        </div>

        <div class="p-3 bg-light rounded-3 fs-13 text-muted">
          <i class="bi bi-info-circle-fill text-primary me-1"></i> Office addresses, phone numbers, and WhatsApp hotlines are synchronized seamlessly from the <a href="/admin/contact" class="fw-bold text-primary">Contact Page Settings</a>.
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
       SECTION 7: CONVERSION CTA BANNER
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-cta">
    <div class="cms-section-header <?= $expandedSection === 'cta' ? 'active' : '' ?>" onclick="toggleSection('cta')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FDF2F8; color:#DB2777;"><i class="bi bi-megaphone-fill"></i></span>
        <span>Bottom Demo Conversion CTA Banner</span>
        <?php if (($settings['about_cta_enabled'] ?? '1') === '1'): ?>
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
      <form method="POST" action="/admin/about-settings">
        <input type="hidden" name="section_name" value="cta">

        <div class="field-group d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
          <div>
            <div class="custom-switch-label">Show Bottom Demo CTA Banner?</div>
            <div class="form-hint">Display the demo booking and WhatsApp CTA strip at the bottom of the About page.</div>
          </div>
          <div class="form-check form-switch fs-4 mb-0">
            <input class="form-check-input" type="checkbox" name="about_cta_enabled" value="1" <?= ($settings['about_cta_enabled'] ?? '1') === '1' ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="field-group">
          <label class="form-label-section">CTA Heading</label>
          <input type="text" name="about_cta_title" class="form-control form-control-lg fw-bold" value="<?= e($settings['about_cta_title'] ?? 'Ready to Modernize Your Jewellery Operations?') ?>" placeholder="e.g. Ready to Modernize...">
        </div>

        <div class="field-group">
          <label class="form-label-section">CTA Description</label>
          <textarea name="about_cta_desc" class="form-control" rows="2" placeholder="Enter supporting text..."><?= e($settings['about_cta_desc'] ?? 'Schedule a private simulation with our senior ERP architect to explore how GoldMatrix streamlines your showroom or manufacturing unit.') ?></textarea>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Primary Button Text</label>
            <input type="text" name="about_cta_btn1_text" class="form-control" value="<?= e($settings['about_cta_btn1_text'] ?? 'Schedule Executive Demo') ?>" placeholder="Schedule Executive Demo">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Primary Button Target Link</label>
            <input type="text" name="about_cta_btn1_link" class="form-control" value="<?= e($settings['about_cta_btn1_link'] ?? '/contact') ?>" placeholder="/contact">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">Secondary Button Text</label>
            <input type="text" name="about_cta_btn2_text" class="form-control" value="<?= e($settings['about_cta_btn2_text'] ?? 'WhatsApp Consultant') ?>" placeholder="WhatsApp Consultant">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">WhatsApp Phone Number</label>
            <input type="text" name="about_cta_whatsapp" class="form-control" value="<?= e($settings['about_cta_whatsapp'] ?? '+91 92703 69937') ?>" placeholder="+91 92703 69937">
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
       SECTION 8: ABOUT PAGE SEO & SOCIAL META
  ══════════════════════════════════════════════════════════════════════ -->
  <div class="cms-section-card" id="secCard-seo">
    <div class="cms-section-header <?= $expandedSection === 'seo' ? 'active' : '' ?>" onclick="toggleSection('seo')">
      <div class="cms-section-title">
        <span class="cms-section-icon" style="background:#FFFBEB; color:#D97706;"><i class="bi bi-google"></i></span>
        <span>About Page SEO & Social Meta</span>
        <span class="badge bg-primary-subtle text-primary fs-11 px-2 py-1 ms-2">Search Engine</span>
      </div>
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?= $expandedSection === 'seo' ? 'bi-chevron-up' : 'bi-chevron-down' ?> text-muted fs-14" id="chevron-seo"></i>
      </div>
    </div>

    <div class="cms-section-body <?= $expandedSection === 'seo' ? 'show' : '' ?>" id="secBody-seo">
      <form method="POST" action="/admin/about-settings" enctype="multipart/form-data">
        <input type="hidden" name="section_name" value="seo">

        <div class="field-group">
          <div class="d-flex justify-content-between align-items-center">
            <label class="form-label-section">Meta Title</label>
            <span class="text-muted fs-11" id="seoTitleCounter">0 / 60 chars</span>
          </div>
          <input type="text" name="about_seo_meta_title" id="about_seo_meta_title" class="form-control" value="<?= e($settings['about_seo_meta_title'] ?? 'About Us | GoldMatrix Software Technologies (UAE & India)') ?>" placeholder="About Us Meta Title" oninput="updateCharCount('about_seo_meta_title', 'seoTitleCounter', 60)">
          <div class="form-hint">Recommended length: 50-60 characters for optimal Google SERP ranking.</div>
        </div>

        <div class="field-group">
          <div class="d-flex justify-content-between align-items-center">
            <label class="form-label-section">Meta Description</label>
            <span class="text-muted fs-11" id="seoDescCounter">0 / 160 chars</span>
          </div>
          <textarea name="about_seo_meta_desc" id="about_seo_meta_desc" class="form-control" rows="3" placeholder="Enter compelling summary..." oninput="updateCharCount('about_seo_meta_desc', 'seoDescCounter', 160)"><?= e($settings['about_seo_meta_desc'] ?? 'Discover GoldMatrix Software story, mission, and leadership. Powering 1,500+ jewellery businesses across UAE, India, Hong Kong, and worldwide.') ?></textarea>
          <div class="form-hint">Recommended length: 140-160 characters.</div>
        </div>

        <div class="field-group">
          <label class="form-label-section">Meta Keywords (Comma separated)</label>
          <textarea name="about_seo_keywords" class="form-control" rows="2" placeholder="about goldmatrix, jewellery erp company..."><?= e($settings['about_seo_keywords'] ?? 'about goldmatrix, jewellery erp company, gold software developers, jewelry tech uae india') ?></textarea>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label-section">OpenGraph Social Sharing Image URL</label>
            <input type="text" name="about_seo_og_image" class="form-control" value="<?= e($settings['about_seo_og_image'] ?? '') ?>" placeholder="https://... or /uploads/about/banner.jpg">
          </div>
          <div class="col-md-6">
            <label class="form-label-section">Or Upload New Social Image</label>
            <input type="file" name="about_seo_og_image_file" class="form-control" accept="image/*">
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

<!-- JAVASCRIPT FOR ACCORDION TOGGLE -->
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
  const sections = ['hero', 'story', 'stats', 'values', 'timeline', 'hubs', 'cta', 'seo'];
  
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

document.addEventListener('DOMContentLoaded', function() {
  updateCharCount('about_seo_meta_title', 'seoTitleCounter', 60);
  updateCharCount('about_seo_meta_desc', 'seoDescCounter', 160);
});
</script>
