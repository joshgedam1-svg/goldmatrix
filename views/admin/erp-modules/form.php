<?php
/**
 * Feature Page & SEO Editor (Compact & Professional)
 * Location: views/admin/erp-modules/form.php
 */
$isEdit = !empty($module['id']);
$subFeatures = !empty($module['sub_features']) ? (is_array($module['sub_features']) ? $module['sub_features'] : json_decode($module['sub_features'], true)) : [];
$bullets = !empty($module['bullets']) ? (is_array($module['bullets']) ? $module['bullets'] : json_decode($module['bullets'], true)) : [];
$visPoints = !empty($module['visual_points']) ? (is_array($module['visual_points']) ? $module['visual_points'] : json_decode($module['visual_points'], true)) : [];
$faqs = !empty($module['faqs']) ? (is_array($module['faqs']) ? $module['faqs'] : json_decode($module['faqs'], true)) : [];
$related = !empty($module['related']) ? (is_array($module['related']) ? $module['related'] : json_decode($module['related'], true)) : [];

$bulletsText = is_array($bullets) ? implode("\n", $bullets) : '';
$visPointsText = is_array($visPoints) ? implode("\n", $visPoints) : '';
$relatedText = is_array($related) ? implode(', ', $related) : '';
$liveUrl = site_url('features/' . ($module['slug'] ?? ''));
?>

<div class="container-fluid px-0">

  <!-- COMPACT FORM HEADER -->
  <form method="POST" action="<?= $isEdit ? admin_url('features/update') : admin_url('features/store') ?>" enctype="multipart/form-data" id="featureForm">
    <?= csrf_field() ?>
    <?php if ($isEdit): ?>
      <input type="hidden" name="id" value="<?= $module['id'] ?>">
    <?php endif; ?>

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
      <div class="d-flex align-items-center gap-2">
        <div class="p-2 bg-primary-subtle text-primary rounded-2 d-flex align-items-center justify-content-center" style="width:34px; height:34px;">
          <i class="bi <?= e($module['icon'] ?: 'bi-stars') ?> fs-5"></i>
        </div>
        <div>
          <div class="d-flex align-items-center gap-2">
            <h1 class="h5 fw-bold text-dark mb-0">
              <?= $isEdit ? 'Edit Feature: ' . e($module['name']) : 'New Feature Page' ?>
            </h1>
            <span class="badge bg-success-subtle text-success border border-success-subtle fs-10 px-2 py-0.5">Live Page</span>
          </div>
          <div class="text-muted fs-11 font-monospace">/features/<?= e($module['slug'] ?? 'new-feature') ?></div>
        </div>
      </div>

      <div class="d-flex align-items-center gap-2">
        <a href="<?= admin_url('features') ?>" class="btn btn-outline-secondary btn-sm py-1 px-2.5 fs-12 d-inline-flex align-items-center gap-1">
          <i class="bi bi-arrow-left"></i>
          <span>All Features</span>
        </a>
        <?php if ($isEdit && !empty($module['slug'])): ?>
          <a href="<?= e($liveUrl) ?>" target="_blank" class="btn btn-outline-dark btn-sm py-1 px-2.5 fs-12 d-inline-flex align-items-center gap-1">
            <i class="bi bi-box-arrow-up-right"></i>
            <span>View Live</span>
          </a>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary btn-sm py-1 px-3 fs-12 fw-bold d-inline-flex align-items-center gap-1 shadow-sm">
          <i class="bi bi-check-lg"></i>
          <span><?= $isEdit ? 'Save Changes' : 'Publish Feature' ?></span>
        </button>
      </div>
    </div>

    <?php if ($msg = get_flash('success')): ?>
      <div class="alert alert-success alert-dismissible fade show py-2 px-3 fs-12 shadow-sm border-0 d-flex align-items-center gap-2 mb-3" role="alert">
        <i class="bi bi-check-circle-fill text-success fs-6"></i>
        <div><?= e($msg) ?></div>
        <button type="button" class="btn-close py-2.5" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php if ($msg = get_flash('danger')): ?>
      <div class="alert alert-danger alert-dismissible fade show py-2 px-3 fs-12 shadow-sm border-0 d-flex align-items-center gap-2 mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill text-danger fs-6"></i>
        <div><?= e($msg) ?></div>
        <button type="button" class="btn-close py-2.5" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <div class="row g-3">
      
      <!-- MAIN CONTENT (LEFT 8 COLS) -->
      <div class="col-lg-8">

        <!-- COMPACT TABS -->
        <ul class="nav nav-pills bg-white p-1.5 rounded-2 border mb-3 shadow-sm" id="featTabs" role="tablist">
          <li class="nav-item">
            <button class="nav-link active py-1 px-2.5 fs-12 fw-semibold" id="tab-hero-btn" data-bs-toggle="pill" data-bs-target="#tab-hero" type="button">
              <i class="bi bi-card-heading me-1"></i> Hero &amp; H1/H2
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link py-1 px-2.5 fs-12 fw-semibold" id="tab-bullets-btn" data-bs-toggle="pill" data-bs-target="#tab-bullets" type="button">
              <i class="bi bi-list-check me-1"></i> Key Bullets (4)
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link py-1 px-2.5 fs-12 fw-semibold" id="tab-subfeats-btn" data-bs-toggle="pill" data-bs-target="#tab-subfeats" type="button">
              <i class="bi bi-grid-3x3-gap me-1"></i> Sub-Features (<?= count($subFeatures) ?>)
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link py-1 px-2.5 fs-12 fw-semibold" id="tab-visual-btn" data-bs-toggle="pill" data-bs-target="#tab-visual" type="button">
              <i class="bi bi-image me-1"></i> UI Showcase
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link py-1 px-2.5 fs-12 fw-semibold" id="tab-faqs-btn" data-bs-toggle="pill" data-bs-target="#tab-faqs" type="button">
              <i class="bi bi-question-circle me-1"></i> FAQs (<?= count($faqs) ?>)
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link py-1 px-2.5 fs-12 fw-semibold" id="tab-seo-btn" data-bs-toggle="pill" data-bs-target="#tab-seo" type="button">
              <i class="bi bi-search me-1"></i> SEO &amp; Schema
            </button>
          </li>
        </ul>

        <!-- TAB PANES -->
        <div class="tab-content" id="featTabsContent">

          <!-- TAB 1: HERO & HEADINGS -->
          <div class="tab-pane fade show active" id="tab-hero" role="tabpanel">
            <div class="card border rounded-2 shadow-sm p-3 bg-white mb-3">
              <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <h6 class="fw-bold text-dark mb-0 fs-13">Hero Section &amp; Headings</h6>
                <span class="badge bg-light text-secondary border fs-10">SEO Headings</span>
              </div>

              <div class="row g-2.5">
                <div class="col-md-6">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Feature Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" value="<?= e($module['name'] ?? '') ?>" class="form-control form-control-sm fw-bold" placeholder="e.g. Dashboards &amp; Live Rates" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">URL Slug <span class="text-danger">*</span></label>
                  <input type="text" name="slug" value="<?= e($module['slug'] ?? '') ?>" class="form-control form-control-sm font-monospace" placeholder="e.g. dashboard-live-rates" required>
                </div>

                <div class="col-12">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">H1 Page Heading (Main SEO Title) <span class="text-danger">*</span></label>
                  <input type="text" name="h1" value="<?= e($module['h1'] ?? '') ?>" class="form-control form-control-sm fw-bold text-primary" placeholder="e.g. Role-Based Dashboards &amp; Live Gold Rate System for Jewellery Businesses" required>
                </div>

                <div class="col-12">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">H2 Subtitle / Value Hook</label>
                  <input type="text" name="h2" value="<?= e($module['h2'] ?? '') ?>" class="form-control form-control-sm" placeholder="e.g. One Screen. Every Branch. Real-Time Retail, Wholesale, Manufacturing, Sales &amp; Stock Intelligence.">
                </div>

                <div class="col-12">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Hero Introduction Paragraph <span class="text-danger">*</span></label>
                  <textarea name="intro" rows="3" class="form-control fs-12" required><?= e($module['intro'] ?? '') ?></textarea>
                </div>

                <div class="col-md-6">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Target Persona Title</label>
                  <input type="text" name="target_persona" value="<?= e($module['target_persona'] ?? '') ?>" class="form-control form-control-sm" placeholder="e.g. Jewellery Retailers &amp; Wholesalers">
                </div>

                <div class="col-md-6">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Target Audience Summary</label>
                  <textarea name="persona_desc" rows="1" class="form-control form-control-sm fs-12"><?= e($module['persona_desc'] ?? '') ?></textarea>
                </div>
              </div>
            </div>
          </div>

          <!-- TAB 2: KEY BULLETS -->
          <div class="tab-pane fade" id="tab-bullets" role="tabpanel">
            <div class="card border rounded-2 shadow-sm p-3 bg-white mb-3">
              <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <h6 class="fw-bold text-dark mb-0 fs-13">Hero Key Checkpoints (4 Bullets)</h6>
                <span class="badge bg-success-subtle text-success border border-success-subtle fs-10">4 Green Ticks</span>
              </div>

              <div class="p-2.5 bg-light rounded-2 border mb-2">
                <label class="form-label fs-11 fw-bold text-dark mb-1">
                  <i class="bi bi-check-circle-fill text-success me-1"></i>Enter 1 bullet point per line
                </label>
                <textarea name="bullets" rows="5" class="form-control fs-12 font-monospace" placeholder="Bullet 1&#10;Bullet 2&#10;Bullet 3&#10;Bullet 4"><?= e($bulletsText) ?></textarea>
              </div>
              <div class="fs-11 text-muted">These 4 bullet points are displayed prominently in the hero section alongside green checkmarks.</div>
            </div>
          </div>

          <!-- TAB 3: SUB-FEATURES -->
          <div class="tab-pane fade" id="tab-subfeats" role="tabpanel">
            <div class="card border rounded-2 shadow-sm p-3 bg-white mb-3">
              <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <div>
                  <h6 class="fw-bold text-dark mb-0 fs-13">Sub-Feature Cards Grid (<?= count($subFeatures) ?> Cards)</h6>
                  <div class="text-muted fs-11">6 cards displayed on the feature cluster page.</div>
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm py-0.5 px-2 fs-11" onclick="addSubCard()">
                  <i class="bi bi-plus-lg me-0.5"></i> Add Card
                </button>
              </div>

              <div id="subCardsList" class="d-flex flex-column gap-2.5">
                <?php foreach ($subFeatures as $idx => $sf): 
                  $sfPts = !empty($sf['points']) && is_array($sf['points']) ? implode("\n", $sf['points']) : '';
                ?>
                  <div class="p-2.5 bg-light rounded-2 border sub-card-box">
                    <div class="d-flex align-items-center justify-content-between mb-1.5">
                      <span class="badge bg-primary fs-10">Card #<?= $idx + 1 ?></span>
                      <button type="button" class="btn btn-outline-danger btn-sm py-0 px-1.5 fs-10" onclick="this.closest('.sub-card-box').remove()">
                        <i class="bi bi-trash3"></i>
                      </button>
                    </div>
                    <div class="row g-2">
                      <div class="col-3">
                        <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Icon</label>
                        <input type="text" name="sub_icon[]" value="<?= e($sf['icon'] ?? 'bi-star') ?>" class="form-control form-control-sm fs-11">
                      </div>
                      <div class="col-9">
                        <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Title</label>
                        <input type="text" name="sub_title[]" value="<?= e($sf['title'] ?? '') ?>" class="form-control form-control-sm fs-11 fw-bold" required>
                      </div>
                      <div class="col-12">
                        <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Description</label>
                        <textarea name="sub_desc[]" rows="2" class="form-control form-control-sm fs-11"><?= e($sf['desc'] ?? '') ?></textarea>
                      </div>
                      <div class="col-12">
                        <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Checklist Points (1 per line)</label>
                        <textarea name="sub_points[]" rows="2" class="form-control form-control-sm fs-11 font-monospace"><?= e($sfPts) ?></textarea>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <!-- TAB 4: UI SHOWCASE -->
          <div class="tab-pane fade" id="tab-visual" role="tabpanel">
            <div class="card border rounded-2 shadow-sm p-3 bg-white mb-3">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 fs-13">Dashboard / Interactive UI Showcase</h6>

              <div class="row g-2.5">
                <div class="col-12">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Showcase Headline</label>
                  <input type="text" name="visual_title" value="<?= e($module['visual_title'] ?? '') ?>" class="form-control form-control-sm fw-bold">
                </div>
                <div class="col-12">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Showcase Paragraph</label>
                  <textarea name="visual_desc" rows="2" class="form-control fs-12"><?= e($module['visual_desc'] ?? '') ?></textarea>
                </div>
                <div class="col-12">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Feature Bullets (1 per line)</label>
                  <textarea name="visual_points" rows="3" class="form-control fs-12 font-monospace"><?= e($visPointsText) ?></textarea>
                </div>
                <div class="col-6">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Upload UI Image</label>
                  <input type="file" name="visual_image_file" accept="image/*" class="form-control form-control-sm fs-11">
                </div>
                <div class="col-6">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Or Image Direct URL</label>
                  <input type="text" name="visual_image" value="<?= e($module['visual_image'] ?? '') ?>" class="form-control form-control-sm fs-11">
                </div>
              </div>
            </div>
          </div>

          <!-- TAB 5: FAQS -->
          <div class="tab-pane fade" id="tab-faqs" role="tabpanel">
            <div class="card border rounded-2 shadow-sm p-3 bg-white mb-3">
              <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                <div>
                  <h6 class="fw-bold text-dark mb-0 fs-13">Frequently Asked Questions (FAQPage Schema)</h6>
                  <div class="text-muted fs-11">Automated Schema generator for Google Rich Answers.</div>
                </div>
                <button type="button" class="btn btn-outline-info btn-sm py-0.5 px-2 fs-11" onclick="addFaqBox()">
                  <i class="bi bi-plus-lg me-0.5"></i> Add FAQ
                </button>
              </div>

              <div id="faqBoxList" class="d-flex flex-column gap-2.5">
                <?php foreach ($faqs as $fIdx => $faq): ?>
                  <div class="p-2.5 bg-light rounded-2 border faq-box">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                      <span class="badge bg-info text-dark fs-10">FAQ #<?= $fIdx + 1 ?></span>
                      <button type="button" class="btn btn-outline-danger btn-sm py-0 px-1.5 fs-10" onclick="this.closest('.faq-box').remove()">
                        <i class="bi bi-trash3"></i>
                      </button>
                    </div>
                    <div class="mb-1.5">
                      <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Question</label>
                      <input type="text" name="faq_q[]" value="<?= e($faq['q'] ?? '') ?>" class="form-control form-control-sm fs-11 fw-bold" required>
                    </div>
                    <div>
                      <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Answer</label>
                      <textarea name="faq_a[]" rows="2" class="form-control form-control-sm fs-11" required><?= e($faq['a'] ?? '') ?></textarea>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <!-- TAB 6: SEO & SCHEMA -->
          <div class="tab-pane fade" id="tab-seo" role="tabpanel">
            <div class="card border rounded-2 shadow-sm p-3 bg-white mb-3">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 fs-13">SEO Metadata &amp; Google Search Snippet</h6>

              <!-- COMPACT SERP SNIPPET PREVIEW -->
              <div class="p-2.5 rounded-2 bg-light border mb-3">
                <div class="text-secondary fs-10 text-uppercase fw-bold mb-1">Google Search Preview</div>
                <div class="fs-11 text-success font-monospace mb-0.5">https://goldmatrixsoftware.com/features/<?= e($module['slug'] ?? 'module') ?></div>
                <div class="fs-14 fw-bold text-primary mb-0.5 text-decoration-underline" id="serpTitle">
                  <?= e($module['meta_title'] ?: ($module['h1'] ?? $module['name'] ?? '') . ' | GoldMatrix ERP') ?>
                </div>
                <div class="fs-11 text-secondary" id="serpDesc">
                  <?= e($module['meta_desc'] ?: substr($module['intro'] ?? '', 0, 160)) ?>
                </div>
              </div>

              <div class="row g-2.5">
                <div class="col-12">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Meta Title (50–60 chars) <span class="text-danger">*</span></label>
                  <input type="text" name="meta_title" id="metaTitleIn" value="<?= e($module['meta_title'] ?? '') ?>" class="form-control form-control-sm fw-semibold">
                </div>
                <div class="col-12">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Meta Description (140–160 chars) <span class="text-danger">*</span></label>
                  <textarea name="meta_desc" id="metaDescIn" rows="2" class="form-control form-control-sm fs-12"><?= e($module['meta_desc'] ?? '') ?></textarea>
                </div>
                <div class="col-6">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Meta Keywords</label>
                  <input type="text" name="meta_keywords" value="<?= e($module['meta_keywords'] ?? '') ?>" class="form-control form-control-sm fs-11">
                </div>
                <div class="col-6">
                  <label class="form-label fs-11 fw-semibold text-secondary mb-1">Canonical URL</label>
                  <input type="text" name="canonical_url" value="<?= e($module['canonical_url'] ?? '') ?>" class="form-control form-control-sm fs-11 font-monospace">
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- SIDEBAR CONTROLS (RIGHT 4 COLS) -->
      <div class="col-lg-4">

        <div class="card border rounded-2 shadow-sm p-3 bg-white mb-3">
          <h6 class="fw-bold text-dark border-bottom pb-2 mb-2.5 fs-13">Settings &amp; Classification</h6>

          <div class="mb-2.5">
            <label class="form-label fs-11 fw-semibold text-secondary mb-1">Status</label>
            <select name="status" class="form-select form-select-sm fs-12">
              <option value="published" <?= ($module['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Published (Live)</option>
              <option value="draft" <?= ($module['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft (Hidden)</option>
            </select>
          </div>

          <div class="mb-2.5">
            <label class="form-label fs-11 fw-semibold text-secondary mb-1">Display Order (# on /features)</label>
            <input type="number" name="display_order" value="<?= (int)($module['display_order'] ?? 1) ?>" class="form-control form-control-sm fs-12">
          </div>

          <div class="mb-2.5">
            <label class="form-label fs-11 fw-semibold text-secondary mb-1">Badge Tag</label>
            <input type="text" name="badge" value="<?= e($module['badge'] ?? 'CORE MODULE') ?>" class="form-control form-control-sm fs-12 fw-semibold">
          </div>

          <div class="mb-2.5">
            <label class="form-label fs-11 fw-semibold text-secondary mb-1">Category</label>
            <input type="text" name="category" value="<?= e($module['category'] ?? 'Core Modules') ?>" class="form-control form-control-sm fs-12">
          </div>

          <div class="mb-2.5">
            <label class="form-label fs-11 fw-semibold text-secondary mb-1">Icon</label>
            <input type="text" name="icon" value="<?= e($module['icon'] ?? 'bi-stars') ?>" class="form-control form-control-sm fs-12">
          </div>

          <div class="mb-3">
            <label class="form-label fs-11 fw-semibold text-secondary mb-1">Related Slugs (comma separated)</label>
            <input type="text" name="related" value="<?= e($relatedText) ?>" class="form-control form-control-sm fs-11 font-monospace">
          </div>

          <button type="submit" class="btn btn-primary btn-sm w-100 py-1.5 fw-bold shadow-sm">
            <i class="bi bi-check2-circle me-1"></i> Save &amp; Sync Live
          </button>
        </div>

      </div>

    </div>
  </form>

</div>

<script>
document.getElementById('metaTitleIn')?.addEventListener('input', function() {
  document.getElementById('serpTitle').innerText = this.value || 'Feature Title | GoldMatrix ERP';
});
document.getElementById('metaDescIn')?.addEventListener('input', function() {
  document.getElementById('serpDesc').innerText = this.value || 'Feature description...';
});

function addSubCard() {
  const container = document.getElementById('subCardsList');
  const count = container.querySelectorAll('.sub-card-box').length + 1;
  const div = document.createElement('div');
  div.className = 'p-2.5 bg-light rounded-2 border sub-card-box';
  div.innerHTML = `
    <div class="d-flex align-items-center justify-content-between mb-1.5">
      <span class="badge bg-primary fs-10">Card #${count}</span>
      <button type="button" class="btn btn-outline-danger btn-sm py-0 px-1.5 fs-10" onclick="this.closest('.sub-card-box').remove()">
        <i class="bi bi-trash3"></i>
      </button>
    </div>
    <div class="row g-2">
      <div class="col-3">
        <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Icon</label>
        <input type="text" name="sub_icon[]" value="bi-star" class="form-control form-control-sm fs-11">
      </div>
      <div class="col-9">
        <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Title</label>
        <input type="text" name="sub_title[]" value="" class="form-control form-control-sm fs-11 fw-bold" placeholder="Card Title" required>
      </div>
      <div class="col-12">
        <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Description</label>
        <textarea name="sub_desc[]" rows="2" class="form-control form-control-sm fs-11"></textarea>
      </div>
      <div class="col-12">
        <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Checklist Points (1 per line)</label>
        <textarea name="sub_points[]" rows="2" class="form-control form-control-sm fs-11 font-monospace"></textarea>
      </div>
    </div>
  `;
  container.appendChild(div);
}

function addFaqBox() {
  const container = document.getElementById('faqBoxList');
  const count = container.querySelectorAll('.faq-box').length + 1;
  const div = document.createElement('div');
  div.className = 'p-2.5 bg-light rounded-2 border faq-box';
  div.innerHTML = `
    <div class="d-flex align-items-center justify-content-between mb-1">
      <span class="badge bg-info text-dark fs-10">FAQ #${count}</span>
      <button type="button" class="btn btn-outline-danger btn-sm py-0 px-1.5 fs-10" onclick="this.closest('.faq-box').remove()">
        <i class="bi bi-trash3"></i>
      </button>
    </div>
    <div class="mb-1.5">
      <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Question</label>
      <input type="text" name="faq_q[]" value="" class="form-control form-control-sm fs-11 fw-bold" placeholder="Question..." required>
    </div>
    <div>
      <label class="form-label fs-10 fw-semibold text-secondary mb-0.5">Answer</label>
      <textarea name="faq_a[]" rows="2" class="form-control form-control-sm fs-11" placeholder="Answer..." required></textarea>
    </div>
  `;
  container.appendChild(div);
}
</script>
