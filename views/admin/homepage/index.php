<?php
/**
 * GoldMatrix ERP - Professional Homepage CMS
 * Powered by Bootstrap 5 & Flat/Bootstrap Icons
 */
$title     = 'Homepage Manager';
$activeTab = $activeTab ?? 'hero';

$tabs = [
    'hero'         => ['label' => 'Hero Banner',                 'icon' => 'bi-display',               'badge' => 'Main'],
    'brands'       => ['label' => 'Brand Logos',                 'icon' => 'bi-award-fill',            'badge' => count($brand_logos ?? [])],
    'solutions'    => ['label' => 'Digital Jewellery Catalogue', 'icon' => 'bi-images',                'badge' => count($solutions_cards ?? []) ?: '4'],
    'spotlight'    => ['label' => 'Feature Spotlight',           'icon' => 'bi-layout-split',          'badge' => count($spotlight_items ?? []) ?: 'ZigZag'],
    'features'     => ['label' => 'Connected Platform',          'icon' => 'bi-grid-3x3-gap',          'badge' => count($features_items ?? [])],
    'modules'      => ['label' => 'ERP Modules',                 'icon' => 'bi-cpu-fill',              'badge' => count($modules_items ?? []) ?: '14'],
    'countries'    => ['label' => 'Sliding Countries',           'icon' => 'bi-globe-americas',        'badge' => count($sliding_countries ?? []) ?: 'Map'],
    'integrations' => ['label' => 'Integrations',                'icon' => 'bi-puzzle-fill',           'badge' => count($integrations_items ?? []) ?: 'Tools'],
    'why'          => ['label' => 'Why GoldMatrix',              'icon' => 'bi-shield-check',          'badge' => count($why_features ?? [])],
    'stats'        => ['label' => 'Stats Counters',              'icon' => 'bi-graph-up-arrow',        'badge' => '4'],
    'testimonials' => ['label' => 'Testimonials',                'icon' => 'bi-star-fill',             'badge' => count($testimonials ?? [])],
    'mobile_app'   => ['label' => 'Mobile App',                  'icon' => 'bi-phone-fill',            'badge' => count($mobile_app_cards ?? []) ?: 'App'],
    'awards'       => ['label' => 'Awards & Recognition',        'icon' => 'bi-trophy-fill',           'badge' => count($awards_items ?? []) ?: 'Awards'],
    'faqs'         => ['label' => 'FAQ Accordion',               'icon' => 'bi-question-circle',       'badge' => count($faqs ?? [])],
    'cta'          => ['label' => 'CTA Banner',                  'icon' => 'bi-megaphone',             'badge' => 'Bottom'],
    'footer'       => ['label' => 'Footer Info',                 'icon' => 'bi-layout-text-window',    'badge' => 'Global'],
    'seo'          => ['label' => 'SEO & Social',                'icon' => 'bi-google',                'badge' => 'Meta'],
];

if (!isset($tabs[$activeTab])) {
    $activeTab = 'hero';
}
?>

<div class="container-fluid px-0">

  <!-- TOP TITLE & ACTIONS BAR -->
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center gap-3">
      <div class="p-3 bg-primary-subtle text-primary rounded-3">
        <i class="bi bi-house-gear-fill fs-3"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2">
          <h2 class="h4 fw-bold text-dark mb-0">Homepage Content Manager</h2>
          <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Live Sync Active</span>
        </div>
        <p class="text-muted small mb-0 mt-1">Manage content, media, and features displayed on the front-facing website. Changes reflect instantly.</p>
      </div>
    </div>
    <div class="d-flex align-items-center gap-2">
      <a href="/" target="_blank" class="btn btn-outline-dark btn-sm d-inline-flex align-items-center gap-2 px-3 py-2">
        <i class="bi bi-box-arrow-up-right"></i>
        <span>View Live Website</span>
      </a>
      <a href="/admin/homepage?tab=<?= $activeTab ?>" class="btn btn-light btn-sm border d-inline-flex align-items-center gap-2 px-3 py-2">
        <i class="bi bi-arrow-clockwise"></i>
        <span>Refresh</span>
      </a>
    </div>
  </div>

  <!-- NAVIGATION TABS PILLS -->
  <div class="cms-nav-pills shadow-sm mb-4">
    <?php foreach ($tabs as $key => $tab): ?>
      <a href="?tab=<?= $key ?>" class="cms-nav-link <?= $activeTab === $key ? 'active' : '' ?>">
        <i class="bi <?= $tab['icon'] ?>"></i>
        <span><?= $tab['label'] ?></span>
        <?php if (!empty($tab['badge'])): ?>
          <span class="badge rounded-pill bg-light text-dark fs-11 ms-1"><?= $tab['badge'] ?></span>
        <?php endif; ?>
      </a>
    <?php endforeach; ?>
  </div>

  <?php if ($msg = get_flash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2 mb-4" role="alert">
      <i class="bi bi-check-circle-fill text-success fs-5"></i>
      <div><?= e($msg) ?></div>
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- TAB CONTENT -->

  <?php /* ══════════════════════════════════════════════════
          TAB: HERO SLIDER (MULTI-SLIDE MANAGEMENT)
          ══════════════════════════════════════════════════ */
  if ($activeTab === 'hero'): ?>

    <!-- HERO SLIDER MANAGEMENT -->
    <div class="row g-4 mb-4">
      <div class="col-lg-8">
        
        <!-- 1. HERO SLIDER LIST CARD -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div>
              <div class="text-muted fs-11 text-uppercase fw-bold mb-1">
                <span>Home</span> <i class="bi bi-chevron-right fs-10 mx-1"></i> <span class="text-primary">Hero Slider</span>
              </div>
              <h5 class="card-title fw-bold mb-0 text-dark">
                <i class="bi bi-collection-play-fill text-warning me-2"></i>Hero Slider Slides
              </h5>
            </div>
            <button class="btn btn-navy btn-sm d-inline-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="collapse" data-bs-target="#addSlideCollapse">
              <i class="bi bi-plus-circle-fill text-warning"></i>
              <span class="fw-bold">+ Add New Slide</span>
            </button>
          </div>

          <!-- ADD NEW SLIDE COLLAPSIBLE FORM -->
          <div class="collapse <?= empty($hero_slides) ? 'show' : '' ?>" id="addSlideCollapse">
            <div class="card-body bg-light border-bottom p-4">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold text-dark mb-0">
                  <i class="bi bi-plus-square-fill text-primary me-2"></i>Add New Hero Slide
                </h6>
                <button type="button" class="btn-close btn-sm" data-bs-toggle="collapse" data-bs-target="#addSlideCollapse"></button>
              </div>

              <form method="POST" action="/admin/homepage?tab=hero" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="add_slide">

                <div class="row g-4">
                  <!-- LEFT COLUMN: Content & Features -->
                  <div class="col-md-7">
                    <div class="mb-3">
                      <label class="form-label fs-12 fw-semibold text-secondary">Small Label / Badge</label>
                      <input type="text" name="badge" class="form-control form-control-sm" placeholder="e.g. ALL-IN-ONE JEWELLERY ERP">
                    </div>

                    <div class="mb-3">
                      <label class="form-label fs-12 fw-semibold text-secondary">Main Heading <span class="text-danger">*</span></label>
                      <input type="text" name="title" class="form-control fw-bold" placeholder="e.g. The Complete Jewellery ERP Built to Run Your Business." required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label fs-12 fw-semibold text-secondary">Description</label>
                      <textarea name="description" rows="3" class="form-control fs-13" placeholder="Manage inventory, sales, manufacturing, accounting..."></textarea>
                    </div>

                    <div class="p-3 bg-white rounded-3 border">
                      <label class="form-label fs-12 fw-bold text-dark mb-2">
                        <i class="bi bi-check2-all text-success me-1"></i>Feature Points (4 Bullet Badges)
                      </label>
                      <div class="row g-2">
                        <div class="col-6">
                          <input type="text" name="features[]" class="form-control form-control-sm" placeholder="e.g. Cloud Based">
                        </div>
                        <div class="col-6">
                          <input type="text" name="features[]" class="form-control form-control-sm" placeholder="e.g. Multi Branch">
                        </div>
                        <div class="col-6">
                          <input type="text" name="features[]" class="form-control form-control-sm" placeholder="e.g. Real-time Data">
                        </div>
                        <div class="col-6">
                          <input type="text" name="features[]" class="form-control form-control-sm" placeholder="e.g. Secure & Scalable">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- RIGHT COLUMN: Images & Settings -->
                  <div class="col-md-5">
                    <!-- Desktop Image Upload -->
                    <div class="mb-3">
                      <label class="form-label fs-12 fw-semibold text-secondary">Desktop Image (WebP / PNG / JPG / SVG)</label>
                      <input type="file" name="image" accept=".webp,.png,.jpg,.jpeg,.svg,.avif,image/webp,image/png,image/jpeg,image/svg+xml" class="form-control form-control-sm">
                      <div class="fs-11 text-muted mt-1">Supports WebP (Fastest), PNG (Transparent), JPG, SVG. Recommended: 1200×800px</div>
                    </div>

                    <!-- Mobile Image Upload -->
                    <div class="mb-3">
                      <label class="form-label fs-12 fw-semibold text-secondary">Mobile Image (WebP / PNG / JPG / SVG)</label>
                      <input type="file" name="mobile_image" accept=".webp,.png,.jpg,.jpeg,.svg,.avif,image/webp,image/png,image/jpeg,image/svg+xml" class="form-control form-control-sm">
                      <div class="fs-11 text-muted mt-1">Supports WebP, PNG, JPG, SVG. Optimized for mobile screens</div>
                    </div>

                    <!-- Theme & Accent Color Selector -->
                    <div class="mb-3">
                      <label class="form-label fs-12 fw-semibold text-secondary">
                        <i class="bi bi-palette-fill text-warning me-1"></i>Theme &amp; Accent Color (Matching Image)
                      </label>
                      <div class="d-flex align-items-center gap-2">
                        <input type="color" name="accent_color" class="form-control form-control-color form-control-sm" value="#F59E0B" id="addAccentColor" style="width:42px;height:32px;cursor:pointer;">
                        <input type="text" id="addAccentHex" class="form-control form-control-sm font-monospace" value="#F59E0B" style="max-width:95px;" oninput="document.getElementById('addAccentColor').value=this.value">
                        <div class="d-flex gap-1 flex-wrap align-items-center">
                          <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#DC9423;" title="Luxury Gold (#DC9423)" onclick="setAccent('#DC9423','addAccentColor','addAccentHex')"></button>
                          <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#F6B828;" title="Bright Gold (#F6B828)" onclick="setAccent('#F6B828','addAccentColor','addAccentHex')"></button>
                          <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#F8D850;" title="Champagne Gold (#F8D850)" onclick="setAccent('#F8D850','addAccentColor','addAccentHex')"></button>
                          <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#A58F6E;" title="Soft Gold (#A58F6E)" onclick="setAccent('#A58F6E','addAccentColor','addAccentHex')"></button>
                          <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#001540;" title="GoldMatrix Navy (#001540)" onclick="setAccent('#001540','addAccentColor','addAccentHex')"></button>
                          <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#072554;" title="Technology Navy (#072554)" onclick="setAccent('#072554','addAccentColor','addAccentHex')"></button>
                          <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#10B981;" title="Emerald Green (#10B981)" onclick="setAccent('#10B981','addAccentColor','addAccentHex')"></button>
                          <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#3B82F6;" title="Sapphire Blue (#3B82F6)" onclick="setAccent('#3B82F6','addAccentColor','addAccentHex')"></button>
                        </div>
                      </div>
                      <div class="fs-11 text-muted mt-1">Dynamically sets button, glowing text, badge, and icon highlight color to match your image.</div>
                    </div>

                    <!-- Image Alt Text -->
                    <div class="mb-3">
                      <label class="form-label fs-12 fw-semibold text-secondary">Image Alt Text (SEO)</label>
                      <input type="text" name="alt_text" class="form-control form-control-sm" placeholder="e.g. GoldMatrix Jewellery ERP Dashboard">
                    </div>

                    <!-- Status & Order -->
                    <div class="row g-2">
                      <div class="col-6">
                        <label class="form-label fs-11 fw-semibold text-secondary">Status</label>
                        <select name="is_active" class="form-select form-select-sm">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="form-label fs-11 fw-semibold text-secondary">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control form-control-sm" value="<?= count($hero_slides ?? []) + 1 ?>">
                      </div>
                    </div>
                  </div>

                  <!-- BUTTON OPTIONS ROW -->
                  <div class="col-12">
                    <div class="p-3 bg-white rounded-3 border">
                      <h6 class="fw-bold fs-12 text-dark mb-2"><i class="bi bi-cursor-fill text-warning me-1"></i>Buttons &amp; Links</h6>
                      <div class="row g-3">
                        <div class="col-md-3 col-6">
                          <label class="form-label fs-11 text-muted">Primary Button Text</label>
                          <input type="text" name="btn1_text" value="Connect with Our Team" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 col-6">
                          <label class="form-label fs-11 text-muted">Primary Button Link</label>
                          <input type="text" name="btn1_link" value="#contact" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 col-6">
                          <label class="form-label fs-11 text-muted">Secondary Button Text</label>
                          <input type="text" name="btn2_text" value="Start 7-Day Free Trial" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 col-6">
                          <label class="form-label fs-11 text-muted">Secondary Button Link</label>
                          <input type="text" name="btn2_link" value="#contact" class="form-control form-control-sm">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                  <button type="button" class="btn btn-light btn-sm px-3" data-bs-toggle="collapse" data-bs-target="#addSlideCollapse">Cancel</button>
                  <button type="submit" class="btn btn-gold btn-sm px-4 fw-bold">
                    <i class="bi bi-plus-circle me-1"></i> Save &amp; Add Slide
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- SLIDES TABLE LIST -->
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light fs-12 text-uppercase text-secondary">
                <tr>
                  <th style="width:50px;">#</th>
                  <th style="width:120px;">Slide Image</th>
                  <th>Title &amp; Subtitle</th>
                  <th style="width:100px;">Status</th>
                  <th style="width:180px;" class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($hero_slides)): ?>
                  <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                      <i class="bi bi-images fs-2 d-block mb-2 text-warning"></i>
                      <div class="fw-bold">No custom slides found.</div>
                      <p class="fs-12 mb-0">Click <strong>"+ Add New Slide"</strong> above to create your first Hero Slider slide.</p>
                    </td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($hero_slides as $idx => $slide): 
                    $feats = !empty($slide['features']) ? json_decode($slide['features'], true) : [];
                    $accent = !empty($slide['accent_color']) ? $slide['accent_color'] : '#F59E0B';
                  ?>
                    <tr>
                      <td class="fw-bold text-muted"><?= $idx + 1 ?></td>
                      <td>
                        <?php if (!empty($slide['image'])): ?>
                          <div class="position-relative d-inline-block">
                            <img src="<?= e($slide['image']) ?>" alt="<?= e($slide['title']) ?>" class="rounded border shadow-sm" style="width:85px;height:52px;object-fit:cover;">
                            <!-- 1-Click Quick Delete Image Button -->
                            <form method="POST" action="/admin/homepage?tab=hero" class="position-absolute top-0 end-0" onsubmit="return confirm('Remove desktop image for this slide?');">
                              <?= csrf_field() ?>
                              <input type="hidden" name="action" value="remove_slide_image">
                              <input type="hidden" name="slide_id" value="<?= $slide['id'] ?>">
                              <input type="hidden" name="target" value="desktop">
                              <button type="submit" class="btn btn-danger btn-sm p-0 rounded-circle d-flex align-items-center justify-content-center shadow" style="width:20px;height:20px;transform:translate(30%, -30%);" title="Quick Remove Image">
                                <i class="bi bi-x-lg" style="font-size:10px;"></i>
                              </button>
                            </form>
                          </div>
                        <?php else: ?>
                          <div class="bg-dark rounded text-center d-flex align-items-center justify-content-center border" style="width:85px;height:52px;">
                            <span class="fs-10 text-secondary fw-bold">Plain Black</span>
                          </div>
                        <?php endif; ?>
                      </td>
                      <td>
                        <div class="d-flex align-items-center gap-1 mb-1 flex-wrap">
                          <?php if (!empty($slide['badge'])): ?>
                            <span class="badge bg-warning-subtle text-dark border border-warning fs-10"><?= e($slide['badge']) ?></span>
                          <?php endif; ?>
                          <span class="badge rounded-pill border" style="background:<?= e($accent) ?>; color:#000; font-size:10px; font-weight:700;">
                            ● Theme Accent
                          </span>
                        </div>
                        <div class="fw-bold text-dark fs-13"><?= e($slide['title']) ?></div>
                        <div class="text-muted fs-11 text-truncate" style="max-width:320px;"><?= e($slide['description']) ?></div>
                      </td>
                      <td>
                        <form method="POST" action="/admin/homepage?tab=hero" class="d-inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="action" value="toggle_slide">
                          <input type="hidden" name="slide_id" value="<?= $slide['id'] ?>">
                          <?php if (!empty($slide['is_active'])): ?>
                            <button type="submit" class="btn badge bg-success-subtle text-success border border-success-subtle px-2 py-1" title="Click to Disable">Active</button>
                          <?php else: ?>
                            <button type="submit" class="btn badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1" title="Click to Enable">Inactive</button>
                          <?php endif; ?>
                        </form>
                      </td>
                      <td class="text-end">
                        <div class="d-inline-flex gap-1">
                          <!-- Edit Button -->
                          <button class="btn btn-outline-primary btn-sm p-1 px-2" data-bs-toggle="modal" data-bs-target="#editSlideModal<?= $slide['id'] ?>" title="Edit Slide">
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          <!-- Duplicate Button -->
                          <form method="POST" action="/admin/homepage?tab=hero" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="duplicate_slide">
                            <input type="hidden" name="slide_id" value="<?= $slide['id'] ?>">
                            <button type="submit" class="btn btn-outline-secondary btn-sm p-1 px-2" title="Duplicate Slide">
                              <i class="bi bi-copy"></i>
                            </button>
                          </form>
                          <!-- Delete Button -->
                          <form method="POST" action="/admin/homepage?tab=hero" class="d-inline" onsubmit="return confirm('Delete this slide?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="delete_slide">
                            <input type="hidden" name="slide_id" value="<?= $slide['id'] ?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm p-1 px-2" title="Delete Slide">
                              <i class="bi bi-trash3-fill"></i>
                            </button>
                          </form>
                        </div>

                        <!-- EDIT MODAL FOR SLIDE -->
                        <div class="modal fade text-start" id="editSlideModal<?= $slide['id'] ?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                              <div class="modal-header bg-navy text-white py-3">
                                <h6 class="modal-title fw-bold text-white mb-0">
                                  <i class="bi bi-pencil-square text-warning me-2"></i>Edit Hero Slide #<?= $idx + 1 ?>
                                </h6>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                              </div>
                              <form method="POST" action="/admin/homepage?tab=hero" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="action" value="update_slide">
                                <input type="hidden" name="slide_id" value="<?= $slide['id'] ?>">

                                <div class="modal-body p-4">
                                  <div class="row g-3">
                                    <div class="col-md-6">
                                      <label class="form-label fs-12 fw-semibold text-secondary">Small Label / Badge</label>
                                      <input type="text" name="badge" value="<?= e($slide['badge'] ?? '') ?>" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                                      <input type="number" name="sort_order" value="<?= e($slide['sort_order'] ?? 1) ?>" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-12">
                                      <label class="form-label fs-12 fw-semibold text-secondary">Main Heading <span class="text-danger">*</span></label>
                                      <input type="text" name="title" value="<?= e($slide['title'] ?? '') ?>" class="form-control fw-bold" required>
                                    </div>
                                    <div class="col-12">
                                      <label class="form-label fs-12 fw-semibold text-secondary">Description</label>
                                      <textarea name="description" rows="3" class="form-control fs-13"><?= e($slide['description'] ?? '') ?></textarea>
                                    </div>

                                    <!-- Theme & Accent Color Selector -->
                                    <div class="col-12">
                                      <div class="p-3 bg-light rounded-3 border">
                                        <label class="form-label fs-12 fw-semibold text-secondary mb-1">
                                          <i class="bi bi-palette-fill text-warning me-1"></i>Theme &amp; Accent Color (Matching Image)
                                        </label>
                                        <div class="d-flex align-items-center gap-2">
                                          <input type="color" name="accent_color" class="form-control form-control-color form-control-sm" value="<?= e($accent) ?>" id="editAccentColor<?= $slide['id'] ?>" style="width:42px;height:32px;cursor:pointer;">
                                          <input type="text" id="editAccentHex<?= $slide['id'] ?>" class="form-control form-control-sm font-monospace" value="<?= e($accent) ?>" style="max-width:95px;" oninput="document.getElementById('editAccentColor<?= $slide['id'] ?>').value=this.value">
                                          <div class="d-flex gap-1 flex-wrap align-items-center">
                                            <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#DC9423;" title="Luxury Gold (#DC9423)" onclick="setAccent('#DC9423','editAccentColor<?= $slide['id'] ?>','editAccentHex<?= $slide['id'] ?>')"></button>
                                            <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#F6B828;" title="Bright Gold (#F6B828)" onclick="setAccent('#F6B828','editAccentColor<?= $slide['id'] ?>','editAccentHex<?= $slide['id'] ?>')"></button>
                                            <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#F8D850;" title="Champagne Gold (#F8D850)" onclick="setAccent('#F8D850','editAccentColor<?= $slide['id'] ?>','editAccentHex<?= $slide['id'] ?>')"></button>
                                            <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#A58F6E;" title="Soft Gold (#A58F6E)" onclick="setAccent('#A58F6E','editAccentColor<?= $slide['id'] ?>','editAccentHex<?= $slide['id'] ?>')"></button>
                                            <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#001540;" title="GoldMatrix Navy (#001540)" onclick="setAccent('#001540','editAccentColor<?= $slide['id'] ?>','editAccentHex<?= $slide['id'] ?>')"></button>
                                            <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#072554;" title="Technology Navy (#072554)" onclick="setAccent('#072554','editAccentColor<?= $slide['id'] ?>','editAccentHex<?= $slide['id'] ?>')"></button>
                                            <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#10B981;" title="Emerald Green (#10B981)" onclick="setAccent('#10B981','editAccentColor<?= $slide['id'] ?>','editAccentHex<?= $slide['id'] ?>')"></button>
                                            <button type="button" class="btn btn-sm p-0 rounded-circle border shadow-sm" style="width:22px;height:22px;background:#3B82F6;" title="Sapphire Blue (#3B82F6)" onclick="setAccent('#3B82F6','editAccentColor<?= $slide['id'] ?>','editAccentHex<?= $slide['id'] ?>')"></button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- 4 Feature Points -->
                                    <div class="col-12">
                                      <div class="p-3 bg-light rounded-3 border">
                                        <label class="form-label fs-12 fw-bold text-dark mb-2">Feature Points (4 Bullet Badges)</label>
                                        <div class="row g-2">
                                          <div class="col-6">
                                            <input type="text" name="features[]" value="<?= e($feats[0] ?? '') ?>" class="form-control form-control-sm" placeholder="Feature 1">
                                          </div>
                                          <div class="col-6">
                                            <input type="text" name="features[]" value="<?= e($feats[1] ?? '') ?>" class="form-control form-control-sm" placeholder="Feature 2">
                                          </div>
                                          <div class="col-6">
                                            <input type="text" name="features[]" value="<?= e($feats[2] ?? '') ?>" class="form-control form-control-sm" placeholder="Feature 3">
                                          </div>
                                          <div class="col-6">
                                            <input type="text" name="features[]" value="<?= e($feats[3] ?? '') ?>" class="form-control form-control-sm" placeholder="Feature 4">
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Desktop Image -->
                                    <div class="col-md-6">
                                      <label class="form-label fs-12 fw-semibold text-secondary">Desktop Image (WebP / PNG / JPG / SVG)</label>
                                      <?php if (!empty($slide['image'])): ?>
                                        <div class="d-flex align-items-center gap-2 mb-2 p-2 bg-light rounded border">
                                          <img src="<?= e($slide['image']) ?>" class="rounded border" style="width:60px;height:40px;object-fit:cover;">
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remove_desktop_image" value="1" id="remDesk<?= $slide['id'] ?>">
                                            <label class="form-check-label fs-11 text-danger fw-semibold" for="remDesk<?= $slide['id'] ?>">Remove Image</label>
                                          </div>
                                        </div>
                                      <?php endif; ?>
                                      <input type="file" name="image" accept=".webp,.png,.jpg,.jpeg,.svg,.avif,image/webp,image/png,image/jpeg,image/svg+xml" class="form-control form-control-sm">
                                      <div class="fs-11 text-muted mt-1">Supports WebP, PNG, JPG, SVG</div>
                                    </div>

                                    <!-- Mobile Image -->
                                    <div class="col-md-6">
                                      <label class="form-label fs-12 fw-semibold text-secondary">Mobile Image (WebP / PNG / JPG / SVG)</label>
                                      <?php if (!empty($slide['mobile_image'])): ?>
                                        <div class="d-flex align-items-center gap-2 mb-2 p-2 bg-light rounded border">
                                          <img src="<?= e($slide['mobile_image']) ?>" class="rounded border" style="width:60px;height:40px;object-fit:cover;">
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remove_mobile_image" value="1" id="remMob<?= $slide['id'] ?>">
                                            <label class="form-check-label fs-11 text-danger fw-semibold" for="remMob<?= $slide['id'] ?>">Remove Image</label>
                                          </div>
                                        </div>
                                      <?php endif; ?>
                                      <input type="file" name="mobile_image" accept=".webp,.png,.jpg,.jpeg,.svg,.avif,image/webp,image/png,image/jpeg,image/svg+xml" class="form-control form-control-sm">
                                      <div class="fs-11 text-muted mt-1">Supports WebP, PNG, JPG, SVG</div>
                                    </div>

                                    <!-- Alt Text -->
                                    <div class="col-md-6">
                                      <label class="form-label fs-12 fw-semibold text-secondary">Image Alt Text</label>
                                      <input type="text" name="alt_text" value="<?= e($slide['alt_text'] ?? '') ?>" class="form-control form-control-sm">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                      <label class="form-label fs-12 fw-semibold text-secondary">Status</label>
                                      <select name="is_active" class="form-select form-select-sm">
                                        <option value="1" <?= !empty($slide['is_active']) ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= empty($slide['is_active']) ? 'selected' : '' ?>>Inactive</option>
                                      </select>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="col-md-3 col-6">
                                      <label class="form-label fs-11 text-muted">Primary Button Text</label>
                                      <input type="text" name="btn1_text" value="<?= e($slide['btn1_text'] ?? 'Connect with Our Team') ?>" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 col-6">
                                      <label class="form-label fs-11 text-muted">Primary Button Link</label>
                                      <input type="text" name="btn1_link" value="<?= e($slide['btn1_link'] ?? '#contact') ?>" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 col-6">
                                      <label class="form-label fs-11 text-muted">Secondary Button Text</label>
                                      <input type="text" name="btn2_text" value="<?= e($slide['btn2_text'] ?? 'Start 7-Day Free Trial') ?>" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 col-6">
                                      <label class="form-label fs-11 text-muted">Secondary Button Link</label>
                                      <input type="text" name="btn2_link" value="<?= e($slide['btn2_link'] ?? '#contact') ?>" class="form-control form-control-sm">
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer bg-light py-2">
                                  <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-navy btn-sm px-4">Update Slide</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer bg-white py-2 px-3 border-top text-muted fs-11 d-flex align-items-center justify-content-between">
            <span><i class="bi bi-info-circle text-primary me-1"></i>Active slides automatically rotate in a loop on the live website.</span>
            <span class="badge bg-light text-dark border"><?= count($hero_slides ?? []) ?> Total Slides</span>
          </div>
        </div>

      </div>

      <!-- RIGHT SIDEBAR: HOW IT WORKS & INFO -->
      <div class="col-lg-4">
        <!-- HOW IT WORKS INFOGRAPHIC CARD -->
        <div class="card border-0 shadow-sm mb-4" style="background:#0F172A;color:#fff;">
          <div class="card-header bg-transparent py-3 border-bottom border-secondary">
            <h6 class="fw-bold text-warning mb-0"><i class="bi bi-lightning-charge-fill me-2"></i>HOW IT WORKS</h6>
          </div>
          <div class="card-body p-4">
            <div class="d-flex align-items-start gap-3 mb-3">
              <div class="p-2 bg-white bg-opacity-10 text-warning rounded-3 fs-5">
                <i class="bi bi-sliders2-vertical"></i>
              </div>
              <div>
                <div class="fw-bold fs-13 text-white">1. Add / Edit Slides</div>
                <p class="text-white-50 fs-12 mb-0">Add unlimited hero slides with custom headings, feature badges, and action buttons.</p>
              </div>
            </div>

            <div class="d-flex align-items-start gap-3 mb-3">
              <div class="p-2 bg-white bg-opacity-10 text-warning rounded-3 fs-5">
                <i class="bi bi-images"></i>
              </div>
              <div>
                <div class="fw-bold fs-13 text-white">2. Set Images</div>
                <p class="text-white-50 fs-12 mb-0">Upload desktop and mobile visuals for seamless, pixel-perfect rendering.</p>
              </div>
            </div>

            <div class="d-flex align-items-start gap-3 mb-3">
              <div class="p-2 bg-white bg-opacity-10 text-warning rounded-3 fs-5">
                <i class="bi bi-check2-circle"></i>
              </div>
              <div>
                <div class="fw-bold fs-13 text-white">3. Save &amp; Publish</div>
                <p class="text-white-50 fs-12 mb-0">Changes reflect instantly on the front-end live website with zero build delay.</p>
              </div>
            </div>

            <div class="d-flex align-items-start gap-3">
              <div class="p-2 bg-white bg-opacity-10 text-warning rounded-3 fs-5">
                <i class="bi bi-phone-flip"></i>
              </div>
              <div>
                <div class="fw-bold fs-13 text-white">4. Fully Responsive</div>
                <p class="text-white-50 fs-12 mb-0">Looks crisp, clean and luxurious on desktop, tablet, and mobile displays.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="card border-0 shadow-sm p-3">
          <h6 class="fw-bold text-dark fs-13 mb-2"><i class="bi bi-shield-check text-success me-2"></i>Design Philosophy</h6>
          <p class="text-muted fs-12 mb-0">Admin manages <strong>Content</strong> (texts, slides, images). Laravel controls <strong>Design &amp; Layout</strong> for speed, SEO, and visual excellence.</p>
        </div>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: FEATURE SPOTLIGHT (ZIG-ZAG DEEP DIVE)
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'spotlight'): ?>

    <!-- 1. SECTION GLOBAL SETTINGS -->
    <div class="row g-4 mb-4">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
            <h5 class="card-title fw-bold mb-0">
              <i class="bi bi-layout-split text-primary me-2"></i>Feature Spotlight Settings (Zig-Zag Section)
            </h5>
            <span class="badge bg-primary-subtle text-primary border px-2 py-1">Deep Dive Modules</span>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=spotlight">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="save_spotlight_settings">

              <!-- Enable/Disable Switch -->
              <div class="form-check form-switch mb-3 p-3 bg-light rounded-3 border">
                <input class="form-check-input ms-0 me-2" type="checkbox" name="spotlight_enabled" value="1" id="spotlightEnabled" <?= ($spotlight_enabled ?? '1') == '1' ? 'checked' : '' ?>>
                <label class="form-check-label fw-bold text-dark fs-13" for="spotlightEnabled">
                  Enable Feature Spotlight (Zig-Zag) Section on Homepage
                </label>
                <div class="fs-11 text-muted mt-1">If turned off, this deep-dive section will be hidden on the live website.</div>
              </div>

              <div class="row g-3">
                <!-- Eyebrow Badge -->
                <div class="col-md-4">
                  <label class="form-label fw-semibold fs-12 text-secondary">Section Eyebrow / Badge (Optional)</label>
                  <input type="text" name="spotlight_badge" value="<?= e($spotlight_badge ?? '') ?>" class="form-control fw-bold fs-13" placeholder="e.g. IN-DEPTH MODULES">
                </div>

                <!-- Main Heading -->
                <div class="col-md-4">
                  <label class="form-label fw-semibold fs-12 text-secondary">Main Section Heading <span class="text-danger">*</span></label>
                  <input type="text" name="spotlight_title" value="<?= e($spotlight_title ?? 'Built to Power Every Stage of Jewellery Business') ?>" class="form-control fw-bold fs-13" placeholder="Built to Power Every Stage of Jewellery Business" required>
                </div>

                <!-- Heading Highlight Text -->
                <div class="col-md-4">
                  <label class="form-label fw-semibold fs-12 text-secondary">
                    <i class="bi bi-stars text-warning me-1"></i>Heading Highlight Word (Gold Accent)
                  </label>
                  <input type="text" name="spotlight_title_highlight" value="<?= e($spotlight_title_highlight ?? 'Jewellery Business') ?>" class="form-control fw-bold fs-13 text-warning border-warning" placeholder="Jewellery Business">
                  <div class="fs-11 text-muted mt-1">Highlighted in brand gold.</div>
                </div>

                <!-- Optional Description -->
                <div class="col-12">
                  <label class="form-label fw-semibold fs-12 text-secondary">Optional Section Description</label>
                  <textarea name="spotlight_desc" rows="2" class="form-control fs-13" placeholder="Explore specialized deep-dive workflows for retail stores and factories..."><?= e($spotlight_desc ?? '') ?></textarea>
                </div>
              </div>

              <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-navy px-4 py-2 fw-bold">
                  <i class="bi bi-floppy-fill me-1"></i> Save Section Settings
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- 2. REPEATABLE SPOTLIGHT MODULE CARDS -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
          <h5 class="card-title fw-bold mb-0">
            <i class="bi bi-collection-play text-warning me-2"></i>Spotlight Deep-Dive Modules (<?= count($spotlight_items ?? []) ?>)
          </h5>
          <p class="text-muted fs-12 mb-0">Rows automatically alternate left and right (Row 1: Text Left / Image Right; Row 2: Image Left / Text Right).</p>
        </div>
        <button class="btn btn-gold btn-sm d-inline-flex align-items-center gap-1 fw-bold shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#addSpotlightCollapse" aria-expanded="false">
          <i class="bi bi-plus-lg"></i>
          <span>+ Add New Spotlight Module</span>
        </button>
      </div>

      <!-- COLLAPSIBLE: ADD NEW SPOTLIGHT MODULE -->
      <div class="collapse border-bottom bg-light" id="addSpotlightCollapse">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="fw-bold text-dark mb-0">
              <i class="bi bi-plus-circle-fill text-success me-2"></i>Create New Spotlight Module Card
            </h6>
            <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#addSpotlightCollapse"></button>
          </div>

          <form method="POST" action="/admin/homepage?tab=spotlight" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="add_spotlight_item">

            <div class="row g-3">
              <div class="col-md-7">
                <div class="row g-2 mb-3">
                  <div class="col-md-6">
                    <label class="form-label fs-12 fw-semibold text-secondary">Card Subtitle / Tagline</label>
                    <input type="text" name="subtitle" class="form-control form-control-sm" placeholder="e.g. Simplify Jewellery Retail Operations">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control form-control-sm" value="<?= count($spotlight_items ?? []) + 1 ?>">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label fs-12 fw-semibold text-secondary">Module Title <span class="text-danger">*</span></label>
                  <input type="text" name="title" class="form-control fw-bold" placeholder="e.g. Retails & Showrooms" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fs-12 fw-semibold text-secondary">Detailed Description Paragraph <span class="text-danger">*</span></label>
                  <textarea name="description" rows="3" class="form-control fs-13" placeholder="GoldMatrix Jewellery Software is built to support..." required></textarea>
                </div>

                <!-- 4 CHECKLIST POINTS -->
                <div class="p-3 bg-white rounded-3 border mb-3">
                  <label class="form-label fs-12 fw-bold text-dark mb-2">
                    <i class="bi bi-check-circle-fill text-warning me-1"></i>4 Key Feature Bullet Points
                  </label>
                  <div class="mb-2">
                    <input type="text" name="feat_points[]" class="form-control form-control-sm" placeholder="1. Track inventory in real time...">
                  </div>
                  <div class="mb-2">
                    <input type="text" name="feat_points[]" class="form-control form-control-sm" placeholder="2. Maintain optimal stock levels...">
                  </div>
                  <div class="mb-2">
                    <input type="text" name="feat_points[]" class="form-control form-control-sm" placeholder="3. Automate routine processes...">
                  </div>
                  <div class="mb-2">
                    <input type="text" name="feat_points[]" class="form-control form-control-sm" placeholder="4. Generate barcodes and price tags...">
                  </div>
                </div>
              </div>

              <!-- RIGHT COLUMN: Dashboard Screenshot Upload -->
              <div class="col-md-5">
                <div class="p-3 bg-white rounded-3 border h-100 d-flex flex-column justify-content-between">
                  <div>
                    <label class="form-label fs-12 fw-bold text-dark mb-2">
                      <i class="bi bi-image text-primary me-1"></i>Dashboard Screenshot (16:10 Ratio)
                    </label>
                    <div class="image-upload-dropzone p-3 text-center border rounded-3 bg-light mb-2">
                      <i class="bi bi-cloud-arrow-up-fill text-secondary fs-2"></i>
                      <div class="fs-12 text-muted mt-1">Upload software dashboard screenshot</div>
                      <input type="file" name="image" accept="image/*" class="form-control form-control-sm mt-2">
                    </div>
                    <div class="form-text fs-11 text-muted">Equal proportions (16:10 / 1200x750px recommended).</div>

                    <div class="mt-3">
                      <label class="form-label fs-12 fw-semibold text-secondary">Image Alt Text (SEO)</label>
                      <input type="text" name="alt_text" class="form-control form-control-sm" placeholder="e.g. Sales Invoice Dashboard">
                    </div>
                  </div>

                  <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="collapse" data-bs-target="#addSpotlightCollapse">Cancel</button>
                    <button type="submit" class="btn btn-navy btn-sm px-4 fw-bold">Save Spotlight Module</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- SPOTLIGHT ITEMS TABLE -->
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light fs-12 text-secondary">
            <tr>
              <th width="40">#</th>
              <th width="110">Screenshot</th>
              <th>Module &amp; Subtitle</th>
              <th>Checklist Points</th>
              <th width="80">Status</th>
              <th width="120" class="text-end pe-3">Actions</th>
            </tr>
          </thead>
          <tbody class="fs-13">
            <?php if (empty($spotlight_items)): ?>
              <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                  <i class="bi bi-layout-split fs-2 d-block mb-2 text-warning"></i>
                  <div class="fw-bold">No spotlight module cards found.</div>
                  <p class="fs-12 mb-0">Click <strong>"+ Add New Spotlight Module"</strong> above to create your first module.</p>
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($spotlight_items as $idx => $card): 
                $points = !empty($card['features']) ? json_decode($card['features'], true) : [];
              ?>
                <tr>
                  <td class="fw-bold text-muted"><?= $idx + 1 ?></td>
                  <td>
                    <?php if (!empty($card['image'])): ?>
                      <div class="position-relative d-inline-block">
                        <img src="<?= e($card['image']) ?>" alt="<?= e($card['title']) ?>" class="rounded border shadow-sm" style="width:95px;height:58px;object-fit:contain;background:#000B2A;">
                        <form method="POST" action="/admin/homepage?tab=spotlight" class="position-absolute top-0 end-0" onsubmit="return confirm('Remove screenshot for this module?');">
                          <?= csrf_field() ?>
                          <input type="hidden" name="action" value="remove_spotlight_image">
                          <input type="hidden" name="item_id" value="<?= $card['id'] ?>">
                          <button type="submit" class="btn btn-danger btn-sm p-0 rounded-circle d-flex align-items-center justify-content-center shadow" style="width:18px;height:18px;transform:translate(30%, -30%);" title="Remove Image">
                            <i class="bi bi-x" style="font-size:11px;"></i>
                          </button>
                        </form>
                      </div>
                    <?php else: ?>
                      <div class="rounded text-center d-flex align-items-center justify-content-center border text-muted" style="width:95px;height:58px;background:#000B2A;">
                        <i class="bi bi-image text-warning fs-4"></i>
                      </div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (!empty($card['subtitle'])): ?>
                      <div class="text-warning fw-bold fs-11 text-uppercase mb-1"><?= e($card['subtitle']) ?></div>
                    <?php endif; ?>
                    <div class="fw-bold text-dark fs-14"><?= e($card['title']) ?></div>
                    <div class="text-muted fs-11 text-truncate" style="max-width:340px;"><?= e($card['description']) ?></div>
                  </td>
                  <td>
                    <div class="d-flex flex-column gap-1" style="max-width:280px;">
                      <?php if (!empty($points) && is_array($points)): ?>
                        <?php foreach ($points as $p): ?>
                          <span class="badge bg-light text-dark border text-start fs-10 text-truncate">
                            <i class="bi bi-check-circle-fill text-warning me-1"></i><?= e($p) ?>
                          </span>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <span class="text-muted fs-11">None</span>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td>
                    <form method="POST" action="/admin/homepage?tab=spotlight">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="toggle_spotlight_item">
                      <input type="hidden" name="item_id" value="<?= $card['id'] ?>">
                      <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent" title="Click to Toggle">
                        <?php if ($card['is_active']): ?>
                          <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 cursor-pointer">Active</span>
                        <?php else: ?>
                          <span class="badge bg-secondary-subtle text-secondary border px-2 py-1 cursor-pointer">Draft</span>
                        <?php endif; ?>
                      </button>
                    </form>
                  </td>
                  <td class="text-end pe-3">
                    <div class="btn-group btn-group-sm">
                      <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSpotlightModal<?= $card['id'] ?>">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                      <form method="POST" action="/admin/homepage?tab=spotlight" onsubmit="return confirm('Delete this spotlight module?');" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="delete_spotlight_item">
                        <input type="hidden" name="item_id" value="<?= $card['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger">
                          <i class="bi bi-trash3-fill"></i>
                        </button>
                      </form>
                    </div>

                    <!-- EDIT MODAL FOR SPOTLIGHT CARD -->
                    <div class="modal fade" id="editSpotlightModal<?= $card['id'] ?>" tabindex="-1">
                      <div class="modal-dialog modal-lg modal-dialog-centered text-start">
                        <div class="modal-content border-0 shadow">
                          <div class="modal-header bg-navy text-white">
                            <h6 class="modal-title fw-bold text-white">
                              <i class="bi bi-pencil-square text-warning me-2"></i>Edit Spotlight Module: <?= e($card['title']) ?>
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                          </div>
                          <form method="POST" action="/admin/homepage?tab=spotlight" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="update_spotlight_item">
                            <input type="hidden" name="item_id" value="<?= $card['id'] ?>">

                            <div class="modal-body p-4">
                              <div class="row g-3">
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Card Subtitle / Tagline</label>
                                  <input type="text" name="subtitle" value="<?= e($card['subtitle'] ?? '') ?>" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                                  <input type="number" name="sort_order" value="<?= e($card['sort_order'] ?? 1) ?>" class="form-control form-control-sm">
                                </div>

                                <div class="col-12">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Module Title <span class="text-danger">*</span></label>
                                  <input type="text" name="title" value="<?= e($card['title'] ?? '') ?>" class="form-control fw-bold" required>
                                </div>

                                <div class="col-12">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Detailed Description Paragraph <span class="text-danger">*</span></label>
                                  <textarea name="description" rows="3" class="form-control fs-13" required><?= e($card['description'] ?? '') ?></textarea>
                                </div>

                                <!-- 4 CHECKLIST POINTS -->
                                <div class="col-12">
                                  <div class="p-3 bg-light rounded-3 border">
                                    <label class="form-label fs-12 fw-bold text-dark mb-2">
                                      <i class="bi bi-check-circle-fill text-warning me-1"></i>Key Feature Bullet Points
                                    </label>
                                    <?php for ($pi = 0; $pi < 4; $pi++): ?>
                                      <div class="mb-2">
                                        <input type="text" name="feat_points[]" value="<?= e($points[$pi] ?? '') ?>" class="form-control form-control-sm" placeholder="Point <?= $pi + 1 ?>">
                                      </div>
                                    <?php endfor; ?>
                                  </div>
                                </div>

                                <!-- Screenshot Upload -->
                                <div class="col-md-8">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Replace Dashboard Screenshot</label>
                                  <input type="file" name="image" accept="image/*" class="form-control form-control-sm">
                                  <?php if (!empty($card['image'])): ?>
                                    <div class="mt-2 d-flex align-items-center gap-2">
                                      <img src="<?= e($card['image']) ?>" class="rounded border" style="height:40px;object-fit:contain;">
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_spotlight_image" value="1" id="rmImg<?= $card['id'] ?>">
                                        <label class="form-check-label fs-11 text-danger" for="rmImg<?= $card['id'] ?>">Remove existing image</label>
                                      </div>
                                    </div>
                                  <?php endif; ?>
                                </div>

                                <div class="col-md-4">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Status</label>
                                  <select name="is_active" class="form-select form-select-sm">
                                    <option value="1" <?= ($card['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>Active / Visible</option>
                                    <option value="0" <?= ($card['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>Draft / Hidden</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer bg-light py-2">
                              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-gold btn-sm fw-bold px-4">
                                <i class="bi bi-check2-circle me-1"></i> Update Spotlight Module
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Card Title <span class="text-danger">*</span></label>
                                  <input type="text" name="title" value="<?= e($card['title'] ?? '') ?>" class="form-control fw-bold" required>
                                </div>
                                <div class="col-md-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Icon</label>
                                  <input type="text" name="icon" value="<?= e($card['icon'] ?? '') ?>" class="form-control">
                                </div>
                                <div class="col-md-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                                  <input type="number" name="sort_order" value="<?= e($card['sort_order'] ?? 1) ?>" class="form-control">
                                </div>

                                <div class="col-12">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Short Description <span class="text-danger">*</span></label>
                                  <textarea name="description" rows="3" class="form-control fs-13" required><?= e($card['description'] ?? '') ?></textarea>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Learn More Link</label>
                                  <input type="text" name="link" value="<?= e($card['link'] ?? '#contact') ?>" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Status</label>
                                  <select name="is_active" class="form-select form-select-sm">
                                    <option value="1" <?= ($card['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>Active / Visible</option>
                                    <option value="0" <?= ($card['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>Draft / Hidden</option>
                                  </select>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Upload New Photo</label>
                                  <input type="file" name="image" accept="image/*" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Or Photo Direct URL / Path</label>
                                  <input type="text" name="image_url" value="<?= e($card['image'] ?? '') ?>" class="form-control form-control-sm" placeholder="https://... or /assets/images/...">
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer bg-light py-2">
                              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-gold btn-sm fw-bold px-4">
                                <i class="bi bi-check2-circle me-1"></i> Update Card
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: FEATURES GRID (6 CARDS)
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'features'): ?>

    <!-- Section Header Settings -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white py-3">
        <h5 class="card-title fw-bold mb-0"><i class="bi bi-card-heading text-primary me-2"></i>"Connected Business" Section Text</h5>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="/admin/homepage?tab=features">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">
          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label fw-semibold fs-13 text-secondary">Section Badge</label>
              <input type="text" name="conn_badge" value="<?= e($conn_badge ?? '') ?>" class="form-control" placeholder="ONE PLATFORM">
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold fs-13 text-secondary">Title Line 1</label>
              <input type="text" name="conn_title" value="<?= e($conn_title ?? '') ?>" class="form-control fw-bold" placeholder="Every Part of Your Jewellery Business,">
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold fs-13 text-secondary">Title Line 2 (Gold Underline)</label>
              <input type="text" name="conn_title2" value="<?= e($conn_title2 ?? '') ?>" class="form-control fw-bold text-warning" placeholder="Connected.">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold fs-13 text-secondary">Section Description (Right Column)</label>
            <textarea name="conn_desc" rows="2" class="form-control"><?= e($conn_desc ?? '') ?></textarea>
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-navy px-4 py-2">
              <i class="bi bi-floppy-fill me-1"></i> Save Section Text
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Feature Cards Manager -->
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h5 class="fw-bold text-dark mb-0"><i class="bi bi-grid-fill text-primary me-2"></i>6 Connected Modules (Retail, POS, Mfg, Wholesale, etc.)</h5>
      <button class="btn btn-success btn-sm d-inline-flex align-items-center gap-2" data-bs-toggle="collapse" data-bs-target="#addFeatureCollapse">
        <i class="bi bi-plus-circle-fill"></i>
        <span>Add Feature Card</span>
      </button>
    </div>

    <!-- Add Feature Collapse Form -->
    <div class="collapse mb-4" id="addFeatureCollapse">
      <div class="card border-0 shadow-sm border-top border-4 border-success">
        <div class="card-body p-4">
          <h6 class="fw-bold text-success mb-3"><i class="bi bi-plus-circle me-1"></i> New Feature Card</h6>
          <form method="POST" action="/admin/homepage?tab=features">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="add_item">
            <input type="hidden" name="section" value="features">
            <div class="row g-3">
              <div class="col-md-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Bootstrap Icon Class</label>
                <input type="text" name="icon" class="form-control" placeholder="e.g. bi-gem or bi-shop" required>
              </div>
              <div class="col-md-4">
                <label class="form-label fs-12 fw-semibold text-secondary">Feature Title</label>
                <input type="text" name="title" class="form-control" placeholder="e.g. Retail & POS" required>
              </div>
              <div class="col-md-5">
                <label class="form-label fs-12 fw-semibold text-secondary">Target Link (Optional)</label>
                <input type="text" name="link" class="form-control" placeholder="#retail">
              </div>
              <div class="col-12">
                <label class="form-label fs-12 fw-semibold text-secondary">Short Description</label>
                <textarea name="description" rows="2" class="form-control" placeholder="Fast billing, customer management..." required></textarea>
              </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-3">
              <button type="button" class="btn btn-light btn-sm" data-bs-toggle="collapse" data-bs-target="#addFeatureCollapse">Cancel</button>
              <button type="submit" class="btn btn-success btn-sm px-4">Create Card</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Cards Grid -->
    <div class="row g-3">
      <?php if (empty($features_items)): ?>
        <div class="col-12">
          <div class="p-4 bg-light rounded-3 text-center text-muted border">
            <i class="bi bi-info-circle fs-3 text-primary mb-2 d-block"></i>
            <p class="mb-0 fs-13">Default 6 cards active: Retail & POS, Manufacturing, Wholesale, Inventory, Accounting, CRM.</p>
          </div>
        </div>
      <?php else: ?>
        <?php foreach ($features_items as $item): ?>
          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm p-3 position-relative">
              <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="item-icon-box fs-4 bg-primary-subtle text-primary border-primary-subtle">
                  <?= e($item['icon']) ?>
                </div>
                <form method="POST" action="/admin/homepage?tab=features" onsubmit="return confirm('Delete this card?');">
                  <?= csrf_field() ?>
                  <input type="hidden" name="action" value="delete_item">
                  <input type="hidden" name="section" value="features">
                  <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                  <button type="submit" class="btn btn-outline-danger btn-sm p-1 border-0" title="Delete">
                    <i class="bi bi-trash3-fill"></i>
                  </button>
                </form>
              </div>
              <h6 class="fw-bold text-dark mb-1"><?= e($item['title']) ?></h6>
              <p class="text-muted fs-13 mb-0 flex-grow-1"><?= e($item['description']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: DIGITAL JEWELLERY CATALOGUE & SOLUTIONS
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'solutions'): ?>

    <!-- 1. Section Header Settings Form -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <h5 class="card-title fw-bold mb-0 text-dark">
          <i class="bi bi-images text-primary me-2"></i>Digital Jewellery Catalogue &amp; Business Solutions
        </h5>
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1">Position #3 on Homepage</span>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="/admin/homepage?tab=solutions">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">

          <div class="form-check form-switch mb-3 p-3 bg-light rounded-3 border">
            <input class="form-check-input ms-0 me-2" type="checkbox" name="solutions_enabled" value="1" id="solutionsEnabled" <?= ($solutions_enabled ?? '1') == '1' ? 'checked' : '' ?>>
            <label class="form-check-label fw-bold text-dark fs-13" for="solutionsEnabled">
              Enable Digital Catalogue &amp; Business Solutions Section on Homepage
            </label>
            <div class="fs-11 text-muted mt-1">Displayed directly below the Brand Logos banner on the live website.</div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label fw-semibold fs-12 text-secondary">Section Eyebrow / Badge</label>
              <input type="text" name="solutions_badge" value="<?= e($solutions_badge ?? 'GLOBAL JEWELLERY PLATFORM') ?>" class="form-control form-control-sm" placeholder="GLOBAL JEWELLERY PLATFORM">
            </div>
            <div class="col-md-8">
              <label class="form-label fw-semibold fs-12 text-secondary">Main Section Heading <span class="text-danger">*</span></label>
              <input type="text" name="solutions_title" value="<?= e($solutions_title ?? 'Built for Every Jewellery Business Model') ?>" class="form-control form-control-sm fw-bold" required>
            </div>
            <div class="col-12">
              <label class="form-label fw-semibold fs-12 text-secondary">Section Description Paragraph</label>
              <textarea name="solutions_desc" rows="2" class="form-control fs-13" placeholder="Engineered for high-growth jewellery retail, wholesale, and export brands..."><?= e($solutions_desc ?? '') ?></textarea>
            </div>
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-navy btn-sm fw-semibold px-4 py-2">
              <i class="bi bi-floppy-fill me-1 text-warning"></i> Save Section Settings
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- 2. Cards Management (List & Add/Edit) -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2 border-bottom">
        <div>
          <h5 class="card-title fw-bold mb-0 text-dark">
            <i class="bi bi-collection-fill text-primary me-2"></i>Showcase &amp; Companion Solution Cards
          </h5>
          <p class="text-muted fs-12 mb-0 mt-0.5">Card #1 is the Top Featured Showcase (Digital Jewellery Catalogue). Cards #2, #3, #4 are companion solution cards.</p>
        </div>
        <button class="btn btn-navy btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#addSolutionCardCollapse" aria-expanded="false">
          <i class="bi bi-plus-circle-fill text-warning"></i>
          <span>Add New Card</span>
        </button>
      </div>

      <!-- COLLAPSIBLE ADD CARD FORM -->
      <div class="collapse border-bottom bg-light" id="addSolutionCardCollapse">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="fw-bold text-dark mb-0">
              <i class="bi bi-plus-circle-fill text-success me-2"></i>Create New Solution Card
            </h6>
            <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#addSolutionCardCollapse"></button>
          </div>
          <form method="POST" action="/admin/homepage?tab=solutions" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="add_solution_card">

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label fs-12 fw-semibold text-secondary">Card Eyebrow / Badge <span class="text-muted">(Optional)</span></label>
                <input type="text" name="badge" class="form-control form-control-sm" placeholder="e.g. MULTI-CURRENCY">
              </div>
              <div class="col-md-5">
                <label class="form-label fs-12 fw-semibold text-secondary">Card Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control form-control-sm fw-bold" placeholder="e.g. Digital Jewellery Catalogue" required>
              </div>
              <div class="col-md-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                <input type="number" name="sort_order" class="form-control form-control-sm" value="<?= count($solutions_cards ?? []) + 1 ?>">
              </div>

              <div class="col-12">
                <label class="form-label fs-12 fw-semibold text-secondary">Card Description <span class="text-danger">*</span></label>
                <textarea name="description" rows="2" class="form-control fs-13" placeholder="Create instant digital catalogues with live gold rates..." required></textarea>
              </div>

              <!-- 5 BULLET CHECKPOINTS -->
              <div class="col-md-6">
                <div class="p-3 bg-white rounded-3 border h-100">
                  <label class="form-label fs-12 fw-bold text-dark mb-2">
                    <i class="bi bi-check-circle-fill text-success me-1"></i>Feature Checkpoints (1 bullet per line)
                  </label>
                  <textarea name="features" rows="5" class="form-control fs-13" placeholder="Category-Wise Jewellery Showcase&#10;Real-Time Gold Rate &amp; Weight Sync&#10;1-Click WhatsApp Share with Photos&#10;Instant Customer Quotations"></textarea>
                  <div class="fs-11 text-muted mt-1">Enter each bullet point on a new line.</div>
                </div>
              </div>

              <!-- ICONS & THEME PRESET -->
              <div class="col-md-6">
                <div class="p-3 bg-white rounded-3 border h-100">
                  <div class="row g-2 mb-2">
                    <div class="col-6">
                      <label class="form-label fs-12 fw-semibold text-secondary">Main Card Icon</label>
                      <input type="text" name="icon" class="form-control form-control-sm" placeholder="e.g. bi-images" value="bi-images">
                    </div>
                    <div class="col-6">
                      <label class="form-label fs-12 fw-semibold text-secondary">Watermark Icon</label>
                      <input type="text" name="extra" class="form-control form-control-sm" placeholder="e.g. bi-whatsapp" value="bi-whatsapp">
                    </div>
                  </div>
                  <div class="row g-2 mb-2">
                    <div class="col-6">
                      <label class="form-label fs-12 fw-semibold text-secondary">Button CTA Text</label>
                      <input type="text" name="btn1_text" class="form-control form-control-sm" value="Explore Digital Catalogue">
                    </div>
                    <div class="col-6">
                      <label class="form-label fs-12 fw-semibold text-secondary">Button Link URL</label>
                      <input type="text" name="btn1_link" class="form-control form-control-sm" value="/features">
                    </div>
                  </div>
                  <div class="row g-2">
                    <div class="col-12">
                      <label class="form-label fs-12 fw-semibold text-secondary">Theme Color / Preset</label>
                      <select name="accent_color" class="form-select form-select-sm">
                        <option value="#D97706">Gold &amp; Warm Amber (Catalogue Showcase)</option>
                        <option value="#2563EB">Luxury Dark Navy &amp; Blue (Multi-Currency)</option>
                        <option value="#059669">Emerald Green (RFID Audit)</option>
                        <option value="#7C3AED">Royal Purple (VAT &amp; Compliance)</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <!-- IMAGE UPLOAD -->
              <div class="col-md-6">
                <label class="form-label fs-12 fw-semibold text-secondary">Upload 3D Product Image / Screenshot</label>
                <input type="file" name="image" accept="image/*" class="form-control form-control-sm">
              </div>
              <div class="col-md-6">
                <label class="form-label fs-12 fw-semibold text-secondary">Or Image Direct URL</label>
                <input type="text" name="image_url" class="form-control form-control-sm" placeholder="/assets/images/digital-jewellery-catalogue.png">
              </div>

              <div class="col-12 text-end pt-2 border-top">
                <button type="button" class="btn btn-light btn-sm me-2" data-bs-toggle="collapse" data-bs-target="#addSolutionCardCollapse">Cancel</button>
                <button type="submit" class="btn btn-navy btn-sm fw-semibold px-4">
                  <i class="bi bi-plus-circle me-1 text-warning"></i> Save Card
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- CARDS TABLE LIST -->
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light text-secondary fs-12 text-uppercase fw-semibold border-bottom" style="background-color:#F8FAFC;">
            <tr>
              <th class="ps-3 py-3" style="width:50px;">#</th>
              <th style="width:110px;">Visual</th>
              <th style="width:340px;">Title &amp; Pillar</th>
              <th>Feature Checkpoints</th>
              <th style="width:100px;">Status</th>
              <th style="width:130px;" class="text-end pe-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($solutions_cards)): ?>
              <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                  <i class="bi bi-inbox fs-3 d-block mb-1 text-secondary"></i>
                  No solution cards configured. Default cards are active on the website.
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($solutions_cards as $idx => $card): 
                $feats = !empty($card['features']) ? (is_array($card['features']) ? $card['features'] : json_decode($card['features'], true)) : [];
                $cardImg = !empty($card['image']) ? $card['image'] : '';
                $isFirst = ($idx === 0);
              ?>
                <tr>
                  <td class="ps-3 fw-bold text-muted"><?= $idx + 1 ?></td>
                  <td>
                    <?php if (!empty($cardImg)): ?>
                      <div class="bg-white rounded-2 border p-1 shadow-xs d-inline-flex align-items-center justify-content-center" style="width:75px;height:52px;">
                        <img src="<?= e($cardImg) ?>" alt="<?= e($card['title']) ?>" style="max-width:100%;max-height:100%;object-fit:contain;" class="rounded">
                      </div>
                    <?php else: ?>
                      <div class="bg-light rounded-2 text-center d-inline-flex align-items-center justify-content-center border" style="width:75px;height:52px;">
                        <i class="bi <?= e($card['icon'] ?: 'bi-images') ?> fs-4 text-secondary"></i>
                      </div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($isFirst): ?>
                      <span class="badge mb-1.5 fs-11 fw-semibold d-inline-flex align-items-center gap-1" style="background:#FEF3C7;color:#92400E;border:1px solid #FCD34D;">
                        <i class="bi bi-stars" style="color:#D97706;"></i> Featured Showcase (Card #1)
                      </span>
                    <?php elseif (!empty($card['badge'])): ?>
                      <span class="badge mb-1.5 fs-11 fw-semibold text-uppercase" style="background:#EFF6FF;color:#1E40AF;border:1px solid #BFDBFE;">
                        <?= e($card['badge']) ?>
                      </span>
                    <?php else: ?>
                      <span class="badge mb-1.5 fs-11 fw-semibold text-muted bg-light border">
                        Companion Card
                      </span>
                    <?php endif; ?>
                    <div class="fw-bold text-dark fs-13 mb-0.5"><?= e($card['title']) ?></div>
                    <div class="text-muted fs-12 text-truncate" style="max-width:300px;"><?= e($card['description']) ?></div>
                  </td>
                  <td>
                    <div class="d-flex flex-column gap-1 fs-12">
                      <?php if (!empty($feats) && is_array($feats)): ?>
                        <?php foreach (array_slice($feats, 0, 3) as $f): ?>
                          <div class="d-flex align-items-center gap-2 text-secondary">
                            <i class="bi bi-check2-circle fs-13 flex-shrink-0" style="color:#10B981;"></i>
                            <span class="text-truncate"><?= e($f) ?></span>
                          </div>
                        <?php endforeach; ?>
                        <?php if (count($feats) > 3): ?>
                          <span class="badge bg-light text-muted border align-self-start fs-10 mt-0.5">+<?= count($feats) - 3 ?> more features</span>
                        <?php endif; ?>
                      <?php else: ?>
                        <span class="text-muted">Standard 4 features</span>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td>
                    <form method="POST" action="/admin/homepage?tab=solutions" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="toggle_solution_status">
                      <input type="hidden" name="item_id" value="<?= $card['id'] ?>">
                      <input type="hidden" name="is_active" value="<?= ($card['is_active'] ?? 1) ? 0 : 1 ?>">
                      <button type="submit" class="border-0 bg-transparent p-0" title="Click to toggle status">
                        <?php if ($card['is_active'] ?? 1): ?>
                          <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill fs-11 fw-semibold d-inline-flex align-items-center gap-1">
                            <span style="width:6px;height:6px;border-radius:50%;background:#16A34A;display:inline-block;"></span> Active
                          </span>
                        <?php else: ?>
                          <span class="badge bg-secondary-subtle text-secondary border px-2.5 py-1 rounded-pill fs-11 fw-semibold">Draft</span>
                        <?php endif; ?>
                      </button>
                    </form>
                  </td>
                  <td class="text-end pe-3">
                    <div class="btn-group btn-group-sm rounded-2">
                      <button type="button" class="btn btn-outline-primary btn-sm px-2.5 py-1" data-bs-toggle="modal" data-bs-target="#editSolutionModal<?= $card['id'] ?>" title="Edit Card">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                      <form method="POST" action="/admin/homepage?tab=solutions" onsubmit="return confirm('Delete this solution card?');" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="delete_item">
                        <input type="hidden" name="section" value="solutions_cards">
                        <input type="hidden" name="item_id" value="<?= $card['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm px-2.5 py-1" title="Delete Card">
                          <i class="bi bi-trash3-fill"></i>
                        </button>
                      </form>
                    </div>

                    <!-- EDIT MODAL -->
                    <div class="modal fade" id="editSolutionModal<?= $card['id'] ?>" tabindex="-1">
                      <div class="modal-dialog modal-lg modal-dialog-centered text-start">
                        <div class="modal-content border-0 shadow-lg rounded-3">
                          <div class="modal-header bg-navy text-white py-3">
                            <h6 class="modal-title fw-bold text-white mb-0">
                              <i class="bi bi-pencil-square text-warning me-2"></i>Edit Solution Card: <?= e($card['title']) ?>
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                          </div>
                          <form method="POST" action="/admin/homepage?tab=solutions" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="edit_solution_card">
                            <input type="hidden" name="item_id" value="<?= $card['id'] ?>">

                            <div class="modal-body p-4">
                              <div class="row g-3">
                                <div class="col-md-4">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Card Eyebrow / Badge <span class="text-muted">(Optional)</span></label>
                                  <input type="text" name="badge" value="<?= e($card['badge'] ?? '') ?>" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-5">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Card Title <span class="text-danger">*</span></label>
                                  <input type="text" name="title" value="<?= e($card['title'] ?? '') ?>" class="form-control form-control-sm fw-bold" required>
                                </div>
                                <div class="col-md-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                                  <input type="number" name="sort_order" value="<?= e($card['sort_order'] ?? 1) ?>" class="form-control form-control-sm">
                                </div>

                                <div class="col-12">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Description <span class="text-danger">*</span></label>
                                  <textarea name="description" rows="2" class="form-control fs-13" required><?= e($card['description'] ?? '') ?></textarea>
                                </div>

                                <!-- BULLET POINTS -->
                                <div class="col-md-6">
                                  <div class="p-3 bg-light rounded-3 border h-100">
                                    <label class="form-label fs-12 fw-bold text-dark mb-2">
                                      <i class="bi bi-check-circle-fill text-success me-1"></i>Feature Checkpoints (1 bullet per line)
                                    </label>
                                    <?php 
                                      $featText = '';
                                      if (!empty($feats) && is_array($feats)) {
                                          $featText = implode("\n", $feats);
                                      }
                                    ?>
                                    <textarea name="features" rows="5" class="form-control fs-13"><?= e($featText) ?></textarea>
                                  </div>
                                </div>

                                <!-- ICONS & COLOR -->
                                <div class="col-md-6">
                                  <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="row g-2 mb-2">
                                      <div class="col-6">
                                        <label class="form-label fs-12 fw-semibold text-secondary">Main Icon</label>
                                        <input type="text" name="icon" value="<?= e($card['icon'] ?? 'bi-images') ?>" class="form-control form-control-sm">
                                      </div>
                                      <div class="col-6">
                                        <label class="form-label fs-12 fw-semibold text-secondary">Watermark Icon</label>
                                        <input type="text" name="extra" value="<?= e($card['extra'] ?? 'bi-whatsapp') ?>" class="form-control form-control-sm">
                                      </div>
                                    </div>
                                    <div class="row g-2 mb-2">
                                      <div class="col-6">
                                        <label class="form-label fs-12 fw-semibold text-secondary">Button Text</label>
                                        <input type="text" name="btn1_text" value="<?= e($card['btn1_text'] ?? 'Explore Digital Catalogue') ?>" class="form-control form-control-sm">
                                      </div>
                                      <div class="col-6">
                                        <label class="form-label fs-12 fw-semibold text-secondary">Button Link</label>
                                        <input type="text" name="btn1_link" value="<?= e($card['btn1_link'] ?? '/features') ?>" class="form-control form-control-sm">
                                      </div>
                                    </div>
                                    <div class="row g-2">
                                      <div class="col-12">
                                        <label class="form-label fs-12 fw-semibold text-secondary">Theme Color Preset</label>
                                        <select name="accent_color" class="form-select form-select-sm">
                                          <option value="#D97706" <?= ($card['accent_color'] ?? '') === '#D97706' ? 'selected' : '' ?>>Gold &amp; Warm Amber (Catalogue Showcase)</option>
                                          <option value="#2563EB" <?= ($card['accent_color'] ?? '') === '#2563EB' ? 'selected' : '' ?>>Luxury Dark Navy &amp; Blue (Multi-Currency)</option>
                                          <option value="#059669" <?= ($card['accent_color'] ?? '') === '#059669' ? 'selected' : '' ?>>Emerald Green (RFID Audit)</option>
                                          <option value="#7C3AED" <?= ($card['accent_color'] ?? '') === '#7C3AED' ? 'selected' : '' ?>>Royal Purple (VAT &amp; Compliance)</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <!-- IMAGE -->
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Upload New 3D Visual</label>
                                  <input type="file" name="image" accept="image/*" class="form-control form-control-sm">
                                  <?php if (!empty($card['image'])): ?>
                                    <div class="mt-2 d-flex align-items-center gap-2">
                                      <img src="<?= e($card['image']) ?>" class="rounded border bg-light" style="height:40px;object-fit:contain;">
                                      <span class="fs-11 text-muted"><?= e(basename($card['image'])) ?></span>
                                    </div>
                                  <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Or Visual URL</label>
                                  <input type="text" name="image_url" value="<?= e($card['image'] ?? '') ?>" class="form-control form-control-sm">
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer bg-light py-2">
                              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-navy btn-sm fw-semibold px-4">
                                <i class="bi bi-check2-circle me-1 text-warning"></i> Update Card
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: ERP MODULES (14 SEAMLESS MODULES)
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'modules'): 
    $presetModuleIcons = [
      'bi-grid-fill'           => 'Masters',
      'bi-box-seam'            => 'Opening',
      'bi-file-earmark-text'   => 'Operations',
      'bi-boxes'               => 'Stock Management',
      'bi-cart-check'          => 'Order Management',
      'bi-hammer'              => 'Production',
      'bi-pie-chart'           => 'Financial Statement',
      'bi-file-earmark-bar-graph' => 'Report Analysis',
      'bi-percent'             => 'GST Reports',
      'bi-people-fill'         => 'Employee Management',
      'bi-gear-fill'           => 'Settings',
      'bi-calculator'          => 'Accounting & Ledgers',
      'bi-receipt-cutoff'      => 'GST & Tax Compliance',
      'bi-upc-scan'            => 'RFID Automation & Audit',
      'bi-shield-check'        => 'BIS Hallmark & Security',
      'bi-speedometer2'        => 'Weighing Scale Sync',
      'bi-printer'             => 'Jewellery Tag Printer',
      'bi-buildings'           => 'Multi-Branch Showroom',
      'bi-stars'               => 'Special Capability'
    ];
  ?>

    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-cpu-fill text-warning fs-5"></i>
          <h5 class="card-title fw-bold mb-0">"Modules That Work Seamlessly" Section</h5>
        </div>
        <button class="btn btn-success btn-sm d-inline-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="collapse" data-bs-target="#addModuleCollapse">
          <i class="bi bi-plus-circle-fill"></i>
          <span>Add New Module Card</span>
        </button>
      </div>
      <div class="card-body p-4">

        <!-- Header Settings Form -->
        <form method="POST" action="/admin/homepage?tab=modules" class="mb-4 p-3 bg-light rounded-3 border">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold fs-13 text-secondary">Main Section Title</label>
              <input type="text" name="modules_title" value="<?= e($modules_title ?? 'Modules That Work Seamlessly') ?>" class="form-control fw-bold">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold fs-13 text-secondary">Subtitle / Description</label>
              <input type="text" name="modules_desc" value="<?= e($modules_desc ?? 'From access control to offline sync, GoldMatrix ERP is designed to scale with your business and adapt to the way you work — all with enterprise-grade security and customization options.') ?>" class="form-control">
            </div>
          </div>
          <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-navy btn-sm px-4">
              <i class="bi bi-floppy-fill me-1"></i> Save Section Headings
            </button>
          </div>
        </form>

        <!-- Add Module Collapse Form -->
        <div class="collapse mb-4" id="addModuleCollapse">
          <div class="card border-0 shadow-sm border-top border-4 border-success">
            <div class="card-body p-4">
              <h6 class="fw-bold text-success mb-3"><i class="bi bi-plus-circle me-1"></i> Add Custom ERP Module Card</h6>
              <form method="POST" action="/admin/homepage?tab=modules">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="add_item">
                <input type="hidden" name="section" value="modules">
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label fs-12 fw-semibold text-secondary">Choose Visual Icon</label>
                    <select name="icon" class="form-select">
                      <?php foreach ($presetModuleIcons as $iClass => $iLabel): ?>
                        <option value="<?= e($iClass) ?>"><?= e($iLabel) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fs-12 fw-semibold text-secondary">Module Name / Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. RFID Stock Audit" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fs-12 fw-semibold text-secondary">Target Link (Optional)</label>
                    <input type="text" name="link" class="form-control" placeholder="#modules or /services/...">
                  </div>
                  <div class="col-12">
                    <label class="form-label fs-12 fw-semibold text-secondary">Module Description</label>
                    <textarea name="description" rows="2" class="form-control" placeholder="Describe module capabilities..." required></textarea>
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-3">
                  <button type="button" class="btn btn-light btn-sm" data-bs-toggle="collapse" data-bs-target="#addModuleCollapse">Cancel</button>
                  <button type="submit" class="btn btn-success btn-sm px-4 fw-bold">
                    <i class="bi bi-plus-lg me-1"></i> Create Module Card
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- 14 Module Cards Grid & Editable Cards -->
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h6 class="fw-bold fs-14 text-dark mb-0">
            <i class="bi bi-grid-fill text-primary me-2"></i>Active Module Cards (<?= count($modules_items ?? []) ?>)
          </h6>
          <span class="badge bg-light text-dark border">Click ✏️ Edit on any card to update title, icon or description</span>
        </div>

        <div class="row g-3">
          <?php foreach (($modules_items ?? []) as $mod): ?>
            <div class="col-lg-4 col-md-6">
              <div class="card h-100 border shadow-sm p-3 position-relative bg-white" style="border-radius:14px;">
                
                <!-- Action Buttons: Edit & Delete -->
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width:42px;height:42px;background:linear-gradient(135deg,#F59E0B 0%,#D97706 100%);box-shadow:0 3px 8px rgba(245,158,11,0.3);">
                    <i class="bi <?= e($mod['icon'] ?: 'bi-cpu') ?> fs-5"></i>
                  </div>
                  <div class="d-flex align-items-center gap-1">
                    <button type="button" class="btn btn-outline-primary btn-sm px-2 py-1" data-bs-toggle="collapse" data-bs-target="#editModCollapse_<?= $mod['id'] ?>" title="Edit Card">
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                    <form method="POST" action="/admin/homepage?tab=modules" onsubmit="return confirm('Delete module card: <?= e($mod['title']) ?>?');">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="delete_item">
                      <input type="hidden" name="section" value="modules">
                      <input type="hidden" name="item_id" value="<?= $mod['id'] ?>">
                      <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-1" title="Delete Card">
                        <i class="bi bi-trash3-fill"></i>
                      </button>
                    </form>
                  </div>
                </div>

                <h6 class="fw-bold text-dark mb-1 fs-14"><?= e($mod['title']) ?></h6>
                <p class="text-muted fs-12 mb-2 flex-grow-1"><?= e($mod['description']) ?></p>
                
                <?php if (!empty($mod['link'])): ?>
                  <div class="text-muted fs-11"><i class="bi bi-link-45deg me-1"></i>Link: <code><?= e($mod['link']) ?></code></div>
                <?php endif; ?>

                <!-- INLINE EDIT COLLAPSE FORM -->
                <div class="collapse mt-3 pt-3 border-top" id="editModCollapse_<?= $mod['id'] ?>">
                  <form method="POST" action="/admin/homepage?tab=modules">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="update_item">
                    <input type="hidden" name="section" value="modules">
                    <input type="hidden" name="item_id" value="<?= $mod['id'] ?>">

                    <div class="mb-2">
                      <label class="form-label fs-11 fw-bold text-secondary mb-1">Module Name</label>
                      <input type="text" name="title" class="form-control form-control-sm" value="<?= e($mod['title']) ?>" required>
                    </div>

                    <div class="mb-2">
                      <label class="form-label fs-11 fw-bold text-secondary mb-1">Visual Icon</label>
                      <select name="icon" class="form-select form-select-sm">
                        <?php foreach ($presetModuleIcons as $iClass => $iLabel): ?>
                          <option value="<?= e($iClass) ?>" <?= ($mod['icon'] === $iClass) ? 'selected' : '' ?>><?= e($iLabel) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="mb-2">
                      <label class="form-label fs-11 fw-bold text-secondary mb-1">Description</label>
                      <textarea name="description" class="form-control form-control-sm" rows="2" required><?= e($mod['description']) ?></textarea>
                    </div>

                    <div class="mb-2">
                      <label class="form-label fs-11 fw-bold text-secondary mb-1">Target Link</label>
                      <input type="text" name="link" class="form-control form-control-sm" value="<?= e($mod['link'] ?? '') ?>" placeholder="#modules">
                    </div>

                    <div class="d-flex align-items-center justify-content-between gap-2 mt-3">
                      <select name="is_active" class="form-select form-select-sm w-auto">
                        <option value="1" <?= !empty($mod['is_active']) ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= empty($mod['is_active']) ? 'selected' : '' ?>>Draft</option>
                      </select>
                      <button type="submit" class="btn btn-primary btn-sm fw-bold px-3">
                        <i class="bi bi-check2"></i> Save Card
                      </button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: SLIDING COUNTRIES (GLOBAL PRESENCE & MAP)
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'countries'): ?>

    <div class="row g-4 mb-4">
      <!-- LEFT COLUMN: Section Settings & Live Map Preview Info -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0">
              <i class="bi bi-sliders text-primary me-2"></i>Slider Section Settings
            </h5>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=countries">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="save_countries_slider_settings">

              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="countries_slider_enabled" value="1" id="sliderEnabled" <?= ($countries_slider_enabled ?? '1') == '1' ? 'checked' : '' ?>>
                <label class="form-check-label fw-bold text-dark fs-13" for="sliderEnabled">Enable Global Countries Slider</label>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-secondary">Section Badge</label>
                <input type="text" name="countries_badge" value="<?= e($countries_badge ?? 'GLOBAL PRESENCE') ?>" class="form-control" placeholder="GLOBAL PRESENCE">
              </div>

              <div class="mb-4">
                <label class="form-label fw-semibold fs-13 text-secondary">Section Main Heading</label>
                <input type="text" name="countries_title" value="<?= e($countries_title ?? 'Trusted by Jewellers Across the Globe') ?>" class="form-control fw-bold" placeholder="Trusted by Jewellers Across the Globe">
              </div>

              <button type="submit" class="btn btn-navy w-100 py-2">
                <i class="bi bi-floppy-fill me-1"></i> Save Slider Settings
              </button>
            </form>
          </div>
        </div>

        <!-- Info Map Watermark Helper Card -->
        <div class="card border-0 shadow-sm bg-primary-subtle text-primary-emphasis p-4">
          <div class="d-flex align-items-start gap-3">
            <i class="bi bi-geo-alt-fill fs-3 text-primary"></i>
            <div>
              <h6 class="fw-bold mb-1">World Map Watermark Included</h6>
              <p class="fs-12 mb-0 opacity-90">Every country card automatically displays a subtle vector world map background watermark and pause-on-hover marquee animation. You can upload custom flag images or paste image URLs below.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT COLUMN: Add New Country & Countries Management Grid -->
      <div class="col-lg-8">
        <!-- Add Country Card -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
            <h5 class="card-title fw-bold mb-0">
              <i class="bi bi-plus-circle-fill text-success me-2"></i>Add New Country Card
            </h5>
            <span class="badge bg-light text-muted border">Live Marquee Item</span>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=countries" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="add_country">

              <div class="row g-3">
                <div class="col-md-5">
                  <label class="form-label fs-12 fw-semibold text-secondary">Country Name <span class="text-danger">*</span></label>
                  <input type="text" name="title" class="form-control" placeholder="e.g. Dubai (UAE)" required>
                </div>

                <div class="col-md-4">
                  <label class="form-label fs-12 fw-semibold text-secondary">Upload Flag Image</label>
                  <input type="file" name="image" accept="image/*" class="form-control form-control-sm">
                </div>

                <div class="col-md-3">
                  <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                  <input type="number" name="sort_order" class="form-control" value="0" placeholder="Auto">
                </div>

                <div class="col-md-8">
                  <label class="form-label fs-12 fw-semibold text-secondary">Or Flag Image URL / CDN Link</label>
                  <input type="text" name="flag_url" class="form-control form-control-sm" placeholder="https://flagcdn.com/w80/ae.png or /assets/...">
                </div>

                <div class="col-md-4 d-flex align-items-end">
                  <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                    <i class="bi bi-plus-lg me-1"></i> Add Country
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Configured Countries List -->
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h6 class="fw-bold fs-14 text-dark mb-0">
            <i class="bi bi-globe-americas text-primary me-2"></i>Active Sliding Countries (<?= count($sliding_countries ?? []) ?>)
          </h6>
          <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1 fs-11">
            Infinite Continuous Loop Active
          </span>
        </div>

        <div class="row g-3">
          <?php if (empty($sliding_countries)): ?>
            <div class="col-12">
              <div class="p-4 bg-light rounded-3 text-center text-muted border">
                <i class="bi bi-globe fs-2 mb-2 d-block text-secondary"></i>
                <p class="mb-0 fs-13">Showing default 10 countries (UAE, USA, Indonesia, Malaysia, Mexico, Italy, Spain, India, Thailand, Hong Kong).</p>
              </div>
            </div>
          <?php else: ?>
            <?php foreach ($sliding_countries as $item): ?>
              <div class="col-md-6 col-xl-4">
                <div class="card h-100 border shadow-sm p-3 position-relative" style="border-radius:14px; background:#fff;">
                  
                  <!-- Top Badge & Actions -->
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge bg-light text-dark border fs-11">#<?= (int)$item['sort_order'] ?></span>
                    <div class="d-flex align-items-center gap-1">
                      <!-- Quick Toggle Active Status -->
                      <form method="POST" action="/admin/homepage?tab=countries" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="toggle_country">
                        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn btn-sm p-1 border-0 <?= ($item['is_active'] ?? 1) ? 'text-success' : 'text-muted' ?>" title="Toggle Visibility">
                          <i class="bi <?= ($item['is_active'] ?? 1) ? 'bi-toggle2-on fs-5' : 'bi-toggle2-off fs-5' ?>"></i>
                        </button>
                      </form>

                      <!-- Edit Country Modal Trigger -->
                      <button type="button" class="btn btn-outline-primary btn-sm p-1 border-0" data-bs-toggle="modal" data-bs-target="#editCountryModal<?= $item['id'] ?>" title="Edit Country">
                        <i class="bi bi-pencil-square"></i>
                      </button>

                      <!-- Delete Country -->
                      <form method="POST" action="/admin/homepage?tab=countries" onsubmit="return confirm('Delete <?= e($item['title']) ?> from slider?');" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="delete_country">
                        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm p-1 border-0" title="Delete">
                          <i class="bi bi-trash3-fill"></i>
                        </button>
                      </form>
                    </div>
                  </div>

                  <!-- Flag & Map Watermark Preview Box -->
                  <div class="rounded-3 p-3 text-center mb-2 position-relative overflow-hidden d-flex align-items-center justify-content-center" style="background:#f8fafc; min-height:100px; border:1px solid #e2e8f0;">
                    <!-- Map watermark preview -->
                    <div style="position:absolute; inset:0; background-image:url('https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg'); background-repeat:no-repeat; background-position:center; background-size:80%; opacity:0.12; pointer-events:none;"></div>
                    
                    <?php if (!empty($item['image'])): ?>
                      <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>" style="max-height:55px; max-width:85px; object-fit:contain; position:relative; z-index:1;">
                    <?php else: ?>
                      <i class="bi bi-flag fs-2 text-muted" style="position:relative; z-index:1;"></i>
                    <?php endif; ?>
                  </div>

                  <!-- Country Name -->
                  <div class="text-center">
                    <h6 class="fw-bold text-dark mb-0 fs-14"><?= e($item['title']) ?></h6>
                  </div>

                </div>
              </div>

              <!-- EDIT COUNTRY MODAL -->
              <div class="modal fade" id="editCountryModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-navy text-white py-3">
                      <h6 class="modal-title fw-bold text-white mb-0">
                        <i class="bi bi-pencil-square text-warning me-2"></i>Edit Country: <?= e($item['title']) ?>
                      </h6>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST" action="/admin/homepage?tab=countries" enctype="multipart/form-data">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="update_country">
                      <input type="hidden" name="item_id" value="<?= $item['id'] ?>">

                      <div class="modal-body p-4">
                        <div class="mb-3">
                          <label class="form-label fs-12 fw-semibold text-secondary">Country Name</label>
                          <input type="text" name="title" value="<?= e($item['title']) ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                          <label class="form-label fs-12 fw-semibold text-secondary">Flag Image URL / CDN</label>
                          <input type="text" name="flag_url" value="<?= e($item['image']) ?>" class="form-control form-control-sm" placeholder="https://... or /assets/...">
                        </div>

                        <div class="mb-3">
                          <label class="form-label fs-12 fw-semibold text-secondary">Or Upload New Flag Image</label>
                          <input type="file" name="image" accept="image/*" class="form-control form-control-sm">
                        </div>

                        <div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                            <input type="number" name="sort_order" value="<?= (int)$item['sort_order'] ?>" class="form-control form-control-sm">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label fs-12 fw-semibold text-secondary">Status</label>
                            <select name="is_active" class="form-select form-select-sm">
                              <option value="1" <?= ($item['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>Active / Visible</option>
                              <option value="0" <?= ($item['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>Draft / Hidden</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer bg-light py-2">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-gold btn-sm fw-bold px-4">
                          <i class="bi bi-check2-circle me-1"></i> Update Country
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: INTEGRATIONS (TOOLS & PLATFORMS)
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'integrations'): ?>

    <!-- 1. SECTION GLOBAL SETTINGS -->
    <div class="row g-4 mb-4">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
            <h5 class="card-title fw-bold mb-0">
              <i class="bi bi-puzzle-fill text-primary me-2"></i>Integration Section Settings
            </h5>
            <span class="badge bg-primary-subtle text-primary border px-2 py-1">Directly Below Trust Bar</span>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=integrations">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="save_integrations_settings">

              <!-- Enable/Disable Switch -->
              <div class="form-check form-switch mb-3 p-3 bg-light rounded-3 border">
                <input class="form-check-input ms-0 me-2" type="checkbox" name="integrations_enabled" value="1" id="integEnabled" <?= ($integrations_enabled ?? '1') == '1' ? 'checked' : '' ?>>
                <label class="form-check-label fw-bold text-dark fs-13" for="integEnabled">
                  Enable Integrations Section on Homepage
                </label>
                <div class="fs-11 text-muted mt-1">Displayed directly below the "Trusted by Jewellers Across the Globe" slider.</div>
              </div>

              <div class="row g-3">
                <!-- Eyebrow Badge -->
                <div class="col-md-4">
                  <label class="form-label fw-semibold fs-12 text-secondary">Section Eyebrow / Badge</label>
                  <input type="text" name="integrations_badge" value="<?= e($integrations_badge ?? 'SEAMLESS CONNECTIVITY') ?>" class="form-control fw-bold fs-13" placeholder="SEAMLESS CONNECTIVITY">
                </div>

                <!-- Main Heading -->
                <div class="col-md-8">
                  <label class="form-label fw-semibold fs-12 text-secondary">Main Section Heading <span class="text-danger">*</span></label>
                  <input type="text" name="integrations_title" value="<?= e($integrations_title ?? 'Seamless integration with all your essential tools') ?>" class="form-control fw-bold fs-13" required>
                </div>

                <!-- Description -->
                <div class="col-12">
                  <label class="form-label fw-semibold fs-12 text-secondary">Section Subtitle / Description</label>
                  <textarea name="integrations_desc" rows="2" class="form-control fs-13"><?= e($integrations_desc ?? '') ?></textarea>
                </div>
              </div>

              <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-navy px-4 py-2 fw-bold">
                  <i class="bi bi-floppy-fill me-1"></i> Save Section Settings
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- 2. REPEATABLE INTEGRATION TOOLS MANAGER -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
          <h5 class="card-title fw-bold mb-0">
            <i class="bi bi-grid-fill text-warning me-2"></i>Integration Tools &amp; Platforms (<?= count($integrations_items ?? []) ?>)
          </h5>
          <p class="text-muted fs-12 mb-0">Manage tool logos, names, descriptions, and links for each integration card.</p>
        </div>
        <button class="btn btn-gold btn-sm d-inline-flex align-items-center gap-1 fw-bold shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#addIntegCollapse" aria-expanded="false">
          <i class="bi bi-plus-lg"></i>
          <span>+ Add New Integration Tool</span>
        </button>
      </div>

      <!-- COLLAPSIBLE: ADD NEW INTEGRATION CARD -->
      <div class="collapse border-bottom bg-light" id="addIntegCollapse">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="fw-bold text-dark mb-0">
              <i class="bi bi-plus-circle-fill text-success me-2"></i>Create New Integration Card
            </h6>
            <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#addIntegCollapse"></button>
          </div>

          <form method="POST" action="/admin/homepage?tab=integrations" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="add_integration_item">

            <div class="row g-3">
              <div class="col-md-7">
                <div class="row g-2 mb-3">
                  <div class="col-md-6">
                    <label class="form-label fs-12 fw-semibold text-secondary">Tool Name <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control fw-bold" placeholder="e.g. Shopify, WhatsApp, QuickBooks" required>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label fs-12 fw-semibold text-secondary">Fallback Icon</label>
                    <input type="text" name="icon" class="form-control" placeholder="bi-puzzle" value="bi-puzzle">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= count($integrations_items ?? []) + 1 ?>">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label fs-12 fw-semibold text-secondary">Short Description <span class="text-danger">*</span></label>
                  <textarea name="description" rows="3" class="form-control fs-13" placeholder="Sync products, orders, customers..." required></textarea>
                </div>

                <div class="row g-2">
                  <div class="col-md-6">
                    <label class="form-label fs-12 fw-semibold text-secondary">Link (Optional)</label>
                    <input type="text" name="link" class="form-control form-control-sm" placeholder="#contact" value="#contact">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fs-12 fw-semibold text-secondary">Logo Alt Text (SEO)</label>
                    <input type="text" name="alt_text" class="form-control form-control-sm" placeholder="e.g. Shopify Logo">
                  </div>
                </div>
              </div>

              <!-- RIGHT COLUMN: Logo Upload -->
              <div class="col-md-5">
                <div class="p-3 bg-white rounded-3 border h-100 d-flex flex-column justify-content-between">
                  <div>
                    <label class="form-label fs-12 fw-bold text-dark mb-2">
                      <i class="bi bi-image text-primary me-1"></i>Tool Brand Logo Upload
                    </label>
                    <div class="image-upload-dropzone p-3 text-center border rounded-3 bg-light mb-2">
                      <i class="bi bi-cloud-arrow-up-fill text-secondary fs-2"></i>
                      <div class="fs-12 text-muted mt-1">Upload PNG/SVG brand logo</div>
                      <input type="file" name="image" accept="image/*" class="form-control form-control-sm mt-2">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fs-11 text-secondary">Or Logo Direct URL / Path:</label>
                      <input type="text" name="image_url" class="form-control form-control-sm" placeholder="https://... or /assets/images/integrations/...">
                    </div>
                  </div>

                  <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="collapse" data-bs-target="#addIntegCollapse">Cancel</button>
                    <button type="submit" class="btn btn-navy btn-sm px-4 fw-bold">Save Tool</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- CARDS TABLE -->
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light fs-12 text-secondary">
            <tr>
              <th width="40">#</th>
              <th width="120">Logo Preview</th>
              <th>Tool Name &amp; Description</th>
              <th width="120">Link</th>
              <th width="80">Status</th>
              <th width="120" class="text-end pe-3">Actions</th>
            </tr>
          </thead>
          <tbody class="fs-13">
            <?php if (empty($integrations_items)): ?>
              <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                  <i class="bi bi-puzzle fs-2 d-block mb-2 text-warning"></i>
                  <div class="fw-bold">No integration tools found.</div>
                  <p class="fs-12 mb-0">Click <strong>"+ Add New Integration Tool"</strong> above to create your first card.</p>
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($integrations_items as $idx => $tool): ?>
                <tr>
                  <td class="fw-bold text-muted"><?= $idx + 1 ?></td>
                  <td>
                    <?php if (!empty($tool['image'])): ?>
                      <div class="position-relative d-inline-block p-2 bg-white rounded border" style="width:100px; height:50px; display:flex; align-items:center; justify-content:center;">
                        <img src="<?= e($tool['image']) ?>" alt="<?= e($tool['title']) ?>" style="max-width:85px; max-height:36px; object-fit:contain;">
                        <form method="POST" action="/admin/homepage?tab=integrations" class="position-absolute top-0 end-0" onsubmit="return confirm('Remove logo for this tool?');">
                          <?= csrf_field() ?>
                          <input type="hidden" name="action" value="remove_integration_logo">
                          <input type="hidden" name="item_id" value="<?= $tool['id'] ?>">
                          <button type="submit" class="btn btn-danger btn-sm p-0 rounded-circle d-flex align-items-center justify-content-center shadow" style="width:18px;height:18px;transform:translate(30%, -30%);" title="Remove Logo">
                            <i class="bi bi-x" style="font-size:11px;"></i>
                          </button>
                        </form>
                      </div>
                    <?php else: ?>
                      <div class="rounded text-center d-flex align-items-center justify-content-center border bg-light text-muted" style="width:100px;height:50px;">
                        <i class="bi <?= e($tool['icon'] ?: 'bi-puzzle') ?> text-secondary fs-4"></i>
                      </div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="fw-bold text-dark fs-14"><?= e($tool['title']) ?></div>
                    <div class="text-muted fs-12 text-truncate" style="max-width:420px;"><?= e($tool['description']) ?></div>
                  </td>
                  <td>
                    <span class="badge bg-light text-dark border"><?= e($tool['link'] ?: '#contact') ?></span>
                  </td>
                  <td>
                    <form method="POST" action="/admin/homepage?tab=integrations">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="toggle_integration_item">
                      <input type="hidden" name="item_id" value="<?= $tool['id'] ?>">
                      <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent" title="Click to Toggle">
                        <?php if ($tool['is_active']): ?>
                          <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 cursor-pointer">Active</span>
                        <?php else: ?>
                          <span class="badge bg-secondary-subtle text-secondary border px-2 py-1 cursor-pointer">Draft</span>
                        <?php endif; ?>
                      </button>
                    </form>
                  </td>
                  <td class="text-end pe-3">
                    <div class="btn-group btn-group-sm">
                      <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editIntegModal<?= $tool['id'] ?>">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                      <form method="POST" action="/admin/homepage?tab=integrations" onsubmit="return confirm('Delete this integration tool?');" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="delete_integration_item">
                        <input type="hidden" name="item_id" value="<?= $tool['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger">
                          <i class="bi bi-trash3-fill"></i>
                        </button>
                      </form>
                    </div>

                    <!-- EDIT MODAL -->
                    <div class="modal fade" id="editIntegModal<?= $tool['id'] ?>" tabindex="-1">
                      <div class="modal-dialog modal-lg modal-dialog-centered text-start">
                        <div class="modal-content border-0 shadow">
                          <div class="modal-header bg-navy text-white">
                            <h6 class="modal-title fw-bold text-white">
                              <i class="bi bi-pencil-square text-warning me-2"></i>Edit Integration Tool: <?= e($tool['title']) ?>
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                          </div>
                          <form method="POST" action="/admin/homepage?tab=integrations" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="update_integration_item">
                            <input type="hidden" name="item_id" value="<?= $tool['id'] ?>">

                            <div class="modal-body p-4">
                              <div class="row g-3">
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Tool Name <span class="text-danger">*</span></label>
                                  <input type="text" name="title" value="<?= e($tool['title'] ?? '') ?>" class="form-control fw-bold" required>
                                </div>
                                <div class="col-md-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Fallback Icon</label>
                                  <input type="text" name="icon" value="<?= e($tool['icon'] ?? 'bi-puzzle') ?>" class="form-control">
                                </div>
                                <div class="col-md-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                                  <input type="number" name="sort_order" value="<?= e($tool['sort_order'] ?? 1) ?>" class="form-control">
                                </div>

                                <div class="col-12">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Short Description <span class="text-danger">*</span></label>
                                  <textarea name="description" rows="3" class="form-control fs-13" required><?= e($tool['description'] ?? '') ?></textarea>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Link</label>
                                  <input type="text" name="link" value="<?= e($tool['link'] ?? '#contact') ?>" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Status</label>
                                  <select name="is_active" class="form-select form-select-sm">
                                    <option value="1" <?= ($tool['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>Active / Visible</option>
                                    <option value="0" <?= ($tool['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>Draft / Hidden</option>
                                  </select>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Upload New Logo Image</label>
                                  <input type="file" name="image" accept="image/*" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Or Logo Direct URL / Path</label>
                                  <input type="text" name="image_url" value="<?= e($tool['image'] ?? '') ?>" class="form-control form-control-sm" placeholder="https://... or /assets/images/integrations/...">
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer bg-light py-2">
                              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-gold btn-sm fw-bold px-4">
                                <i class="bi bi-check2-circle me-1"></i> Update Tool
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: WHY GOLDMATRIX (CHECKLIST)
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'why'): ?>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0"><i class="bi bi-pencil-square text-primary me-2"></i>Headings & Video Link</h5>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=why">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="save_settings">
              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-secondary">Badge Label</label>
                <input type="text" name="why_badge" value="<?= e($why_badge ?? '') ?>" class="form-control" placeholder="MADE FOR JEWELLERY BUSINESS">
              </div>
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-13 text-secondary">Title Line 1</label>
                  <input type="text" name="why_title" value="<?= e($why_title ?? '') ?>" class="form-control fw-bold" placeholder="Built Around How">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-13 text-secondary">Title Line 2 (Gold)</label>
                  <input type="text" name="why_title2" value="<?= e($why_title2 ?? '') ?>" class="form-control fw-bold text-warning" placeholder="Businesses Actually Work.">
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-secondary">Video URL (YouTube embed or MP4)</label>
                <input type="text" name="why_video_url" value="<?= e($why_video_url ?? '') ?>" class="form-control" placeholder="https://www.youtube.com/embed/...">
              </div>
              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-13 text-secondary">Button Text</label>
                  <input type="text" name="why_explore_text" value="<?= e($why_explore_text ?? '') ?>" class="form-control" placeholder="Explore Features →">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-13 text-secondary">Button Link</label>
                  <input type="text" name="why_explore_link" value="<?= e($why_explore_link ?? '') ?>" class="form-control" placeholder="#modules">
                </div>
              </div>
              <button type="submit" class="btn btn-navy w-100 py-2">
                <i class="bi bi-floppy-fill me-1"></i> Save Why Us Settings
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <!-- Add Checklist Item -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0"><i class="bi bi-plus-circle-fill text-success me-2"></i>Add Checklist Item</h5>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=why">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="add_item">
              <input type="hidden" name="section" value="why_features">
              <div class="input-group">
                <input type="text" name="title" class="form-control" placeholder="e.g. Weight-Based Inventory" required>
                <button type="submit" class="btn btn-success px-4">
                  <i class="bi bi-plus-lg me-1"></i> Add Point
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Checklist Items -->
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white py-3">
            <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-check2-circle text-success me-2"></i>Active Checklist Features (<?= count($why_features ?? []) ?>)</h6>
          </div>
          <div class="card-body p-3">
            <div class="row g-2">
              <?php if (empty($why_features)): ?>
                <div class="col-12">
                  <p class="text-muted fs-13 text-center mb-0 py-2">Default 10 feature points active.</p>
                </div>
              <?php else: ?>
                <?php foreach ($why_features as $w): ?>
                  <div class="col-md-6">
                    <div class="p-2 border rounded-3 d-flex align-items-center justify-content-between bg-light">
                      <span class="fs-13 fw-semibold text-dark"><i class="bi bi-check-circle-fill text-warning me-2"></i><?= e($w['title']) ?></span>
                      <form method="POST" action="/admin/homepage?tab=why" onsubmit="return confirm('Remove item?');">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="delete_item">
                        <input type="hidden" name="section" value="why_features">
                        <input type="hidden" name="item_id" value="<?= $w['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm p-1 border-0" title="Delete">
                          <i class="bi bi-trash3-fill"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: STATS COUNTERS
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'stats'): ?>

    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white py-3">
        <h5 class="card-title fw-bold mb-0"><i class="bi bi-bar-chart-fill text-primary me-2"></i>4 Statistics Numbers & Labels</h5>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="/admin/homepage?tab=stats">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">
          <div class="row g-4 mb-4">
            <!-- Stat 1 -->
            <div class="col-lg-3 col-md-6">
              <div class="p-3 bg-light rounded-3 border">
                <div class="d-flex align-items-center gap-2 mb-2 text-primary">
                  <i class="bi bi-people-fill fs-5"></i>
                  <span class="fw-bold fs-13">Stat 1 (Customers)</span>
                </div>
                <div class="mb-2">
                  <label class="form-label fs-11 text-muted">Value / Metric</label>
                  <input type="text" name="stats_stat1_num" value="<?= e($stats_stat1_num ?? '') ?>" class="form-control fw-bold" placeholder="1,500+">
                </div>
                <div>
                  <label class="form-label fs-11 text-muted">Label</label>
                  <input type="text" name="stats_stat1_label" value="<?= e($stats_stat1_label ?? '') ?>" class="form-control" placeholder="Happy Customers">
                </div>
              </div>
            </div>

            <!-- Stat 2 -->
            <div class="col-lg-3 col-md-6">
              <div class="p-3 bg-light rounded-3 border">
                <div class="d-flex align-items-center gap-2 mb-2 text-success">
                  <i class="bi bi-globe2 fs-5"></i>
                  <span class="fw-bold fs-13">Stat 2 (Countries)</span>
                </div>
                <div class="mb-2">
                  <label class="form-label fs-11 text-muted">Value / Metric</label>
                  <input type="text" name="stats_stat2_num" value="<?= e($stats_stat2_num ?? '') ?>" class="form-control fw-bold" placeholder="12+">
                </div>
                <div>
                  <label class="form-label fs-11 text-muted">Label</label>
                  <input type="text" name="stats_stat2_label" value="<?= e($stats_stat2_label ?? '') ?>" class="form-control" placeholder="Countries">
                </div>
              </div>
            </div>

            <!-- Stat 3 -->
            <div class="col-lg-3 col-md-6">
              <div class="p-3 bg-light rounded-3 border">
                <div class="d-flex align-items-center gap-2 mb-2 text-warning">
                  <i class="bi bi-clock-history fs-5"></i>
                  <span class="fw-bold fs-13">Stat 3 (Experience)</span>
                </div>
                <div class="mb-2">
                  <label class="form-label fs-11 text-muted">Value / Metric</label>
                  <input type="text" name="stats_stat3_num" value="<?= e($stats_stat3_num ?? '') ?>" class="form-control fw-bold" placeholder="25+">
                </div>
                <div>
                  <label class="form-label fs-11 text-muted">Label</label>
                  <input type="text" name="stats_stat3_label" value="<?= e($stats_stat3_label ?? '') ?>" class="form-control" placeholder="Years of Experience">
                </div>
              </div>
            </div>

            <!-- Stat 4 -->
            <div class="col-lg-3 col-md-6">
              <div class="p-3 bg-light rounded-3 border">
                <div class="d-flex align-items-center gap-2 mb-2 text-info">
                  <i class="bi bi-headset fs-5"></i>
                  <span class="fw-bold fs-13">Stat 4 (Support)</span>
                </div>
                <div class="mb-2">
                  <label class="form-label fs-11 text-muted">Value / Metric</label>
                  <input type="text" name="stats_stat4_num" value="<?= e($stats_stat4_num ?? '') ?>" class="form-control fw-bold" placeholder="24/7">
                </div>
                <div>
                  <label class="form-label fs-11 text-muted">Label</label>
                  <input type="text" name="stats_stat4_label" value="<?= e($stats_stat4_label ?? '') ?>" class="form-control" placeholder="Dedicated Support">
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-navy px-4 py-2">
              <i class="bi bi-floppy-fill me-1"></i> Save All Statistics
            </button>
          </div>
        </form>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: TESTIMONIALS
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'testimonials'): ?>

    <div class="row g-4">
      <div class="col-lg-4">
        <!-- Add Testimonial -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0"><i class="bi bi-person-plus-fill text-success me-2"></i>Add Testimonial</h5>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=testimonials" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="add_item">
              <input type="hidden" name="section" value="testimonials">

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Client / Owner Name</label>
                <input type="text" name="title" class="form-control" placeholder="e.g. Rajesh Mehta" required>
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Designation &amp; Store</label>
                <input type="text" name="subtitle" class="form-control" placeholder="e.g. Mehta Jewellers, Mumbai" required>
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Rating (Stars)</label>
                <select name="extra" class="form-select">
                  <option value="5">5 Stars (Excellent)</option>
                  <option value="4">4 Stars (Good)</option>
                  <option value="3">3 Stars (Average)</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Client Photo (Optional)</label>
                <div class="image-upload-dropzone">
                  <i class="bi bi-cloud-arrow-up fs-3 text-muted"></i>
                  <div class="fs-12 text-muted mt-1">Upload Photo</div>
                  <input type="file" name="image" accept="image/*">
                </div>
              </div>

              <div class="mb-4">
                <label class="form-label fs-12 fw-semibold text-secondary">Review / Quote Text</label>
                <textarea name="description" rows="3" class="form-control" placeholder="GoldMatrix has transformed the way..." required></textarea>
              </div>

              <button type="submit" class="btn btn-success w-100 py-2">
                <i class="bi bi-plus-lg me-1"></i> Add Testimonial
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <!-- Section Header Settings -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0"><i class="bi bi-chat-quote-fill text-primary me-2"></i>Testimonials Section Heading</h5>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=testimonials">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="save_settings">
              <div class="row g-3 align-items-end">
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-13 text-secondary">Section Title</label>
                  <input type="text" name="testi_tag" value="<?= e($testi_tag ?? '') ?>" class="form-control fw-bold" placeholder="What Our Customers Say">
                </div>
                <div class="col-md-4">
                  <label class="form-label fw-semibold fs-13 text-secondary">"View All" Button Text</label>
                  <input type="text" name="testi_view_all" value="<?= e($testi_view_all ?? '') ?>" class="form-control" placeholder="View All Testimonials →">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-navy w-100 py-2">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Cards List -->
        <h6 class="fw-bold fs-14 text-dark mb-3"><i class="bi bi-card-text text-primary me-2"></i>Customer Reviews (<?= count($testimonials ?? []) ?>)</h6>
        <div class="row g-3">
          <?php if (empty($testimonials)): ?>
            <div class="col-12">
              <div class="p-4 bg-light rounded-3 text-center text-muted border">
                <p class="mb-0 fs-13">No custom reviews found. Click "Add Testimonial" on the left to add one.</p>
              </div>
            </div>
          <?php else: ?>
            <?php foreach ($testimonials as $t): ?>
              <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm p-3 position-relative">
                  <div class="d-flex align-items-start justify-content-between mb-2">
                    <div class="d-flex align-items-center gap-2">
                      <div class="text-warning fs-13">
                        <?= str_repeat('★', (int)($t['extra'] ?: 5)) ?>
                      </div>
                      <?php if (!empty($t['badge'])): ?>
                        <span class="badge bg-light text-secondary border fs-10"><?= e($t['badge']) ?></span>
                      <?php endif; ?>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                      <button type="button" class="btn btn-outline-primary btn-sm p-1 border-0" data-bs-toggle="modal" data-bs-target="#editTestiModal<?= $t['id'] ?>" title="Edit Review">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                      <form method="POST" action="/admin/homepage?tab=testimonials" onsubmit="return confirm('Delete review?');" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="delete_item">
                        <input type="hidden" name="section" value="testimonials">
                        <input type="hidden" name="item_id" value="<?= $t['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm p-1 border-0" title="Delete">
                          <i class="bi bi-trash3-fill"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                  <p class="fs-13 text-secondary fst-italic mb-3 flex-grow-1">"<?= e($t['description']) ?>"</p>
                  <div class="d-flex align-items-center gap-2 pt-2 border-top">
                    <?php if (!empty($t['image'])): ?>
                      <img src="<?= e($t['image']) ?>" class="rounded-circle border" width="38" height="38" style="object-fit:cover;">
                    <?php else: ?>
                      <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center border" style="width:38px;height:38px;font-size:14px;">
                        <?= mb_substr(e($t['title']), 0, 1) ?>
                      </div>
                    <?php endif; ?>
                    <div>
                      <div class="fw-bold fs-13 text-dark"><?= e($t['title']) ?></div>
                      <div class="text-muted fs-11"><?= e($t['subtitle']) ?></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Edit Testimonial Modal -->
              <div class="modal fade" id="editTestiModal<?= $t['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-light">
                      <h6 class="modal-title fw-bold"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Testimonial</h6>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="/admin/homepage?tab=testimonials" enctype="multipart/form-data">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="update_item">
                      <input type="hidden" name="section" value="testimonials">
                      <input type="hidden" name="item_id" value="<?= $t['id'] ?>">
                      <div class="modal-body p-4">
                        <div class="mb-3">
                          <label class="form-label fs-12 fw-semibold text-secondary">Client / Owner Name <span class="text-danger">*</span></label>
                          <input type="text" name="title" class="form-control" value="<?= e($t['title']) ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fs-12 fw-semibold text-secondary">Designation &amp; Store <span class="text-danger">*</span></label>
                          <input type="text" name="subtitle" class="form-control" value="<?= e($t['subtitle']) ?>" required>
                        </div>
                        <div class="row g-2 mb-3">
                          <div class="col-6">
                            <label class="form-label fs-12 fw-semibold text-secondary">Rating (Stars)</label>
                            <select name="extra" class="form-select">
                              <option value="5" <?= ($t['extra'] ?? '5') == '5' ? 'selected' : '' ?>>5 Stars (★★★★★)</option>
                              <option value="4" <?= ($t['extra'] ?? '') == '4' ? 'selected' : '' ?>>4 Stars (★★★★)</option>
                              <option value="3" <?= ($t['extra'] ?? '') == '3' ? 'selected' : '' ?>>3 Stars (★★★)</option>
                            </select>
                          </div>
                          <div class="col-6">
                            <label class="form-label fs-12 fw-semibold text-secondary">Category Badge</label>
                            <input type="text" name="badge" class="form-control" value="<?= e($t['badge'] ?? '') ?>" placeholder="e.g. RETAIL SHOWROOM">
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fs-12 fw-semibold text-secondary">Client Photo</label>
                          <?php if (!empty($t['image'])): ?>
                            <div class="d-flex align-items-center gap-2 mb-2 p-2 border rounded bg-light">
                              <img src="<?= e($t['image']) ?>" class="rounded-circle" width="34" height="34" style="object-fit:cover;">
                              <span class="fs-11 text-muted text-truncate" style="max-width:260px;"><?= e($t['image']) ?></span>
                            </div>
                          <?php endif; ?>
                          <input type="file" name="image" class="form-control" accept="image/*">
                          <div class="form-text fs-11">Choose new file to replace existing photo.</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fs-12 fw-semibold text-secondary">Or Direct Photo URL</label>
                          <input type="text" name="image_url" class="form-control" value="<?= e($t['image'] ?? '') ?>" placeholder="https://...">
                        </div>
                        <div class="mb-3">
                          <label class="form-label fs-12 fw-semibold text-secondary">Review / Quote Text <span class="text-danger">*</span></label>
                          <textarea name="description" rows="3" class="form-control" required><?= e($t['description']) ?></textarea>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                          <input type="number" name="sort_order" class="form-control" value="<?= (int)($t['sort_order'] ?? 0) ?>">
                        </div>
                      </div>
                      <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Save Changes</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: BRAND LOGOS
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'brands'): ?>

    <!-- Section Heading Settings -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white py-3">
        <h5 class="card-title fw-bold mb-0"><i class="bi bi-type-h1 text-primary me-2"></i>Brand Strip Heading</h5>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="/admin/homepage?tab=brands">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">
          <div class="mb-0">
            <label class="form-label fw-semibold fs-13 text-secondary mb-1.5">Section Label / Heading (Shown on Homepage)</label>
            <div class="input-group">
              <input type="text" name="brands_title" value="<?= e($brands_title ?? 'Trusted By Leading Jewellery Brands') ?>" class="form-control fw-bold fs-14" placeholder="Trusted By Leading Jewellery Brands">
              <button type="submit" class="btn btn-navy px-4 fw-bold">
                <i class="bi bi-floppy-fill me-1"></i> Save Heading
              </button>
            </div>
            <div class="form-text fs-11 text-muted mt-1">This heading appears right before your customer brand logos strip on the frontend.</div>
          </div>
        </form>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0"><i class="bi bi-plus-circle-fill text-success me-2"></i>Add Brand Logo</h5>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=brands" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="add_brand_logo">

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Brand Name <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="e.g. Tanishq, Kalyan" required>
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Brand Website (Optional)</label>
                <input type="text" name="link" class="form-control" placeholder="https://...">
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Upload Logo Image (PNG / SVG / WebP)</label>
                <div class="image-upload-dropzone">
                  <i class="bi bi-image fs-3 text-muted"></i>
                  <div class="fs-12 text-muted mt-1">Select Brand Logo File</div>
                  <input type="file" name="image" accept="image/*">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Or Direct Image URL</label>
                <input type="text" name="image_url" class="form-control" placeholder="/assets/images/brands/brand.svg or https://...">
              </div>

              <div class="mb-4">
                <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="<?= (count($brand_logos ?? []) + 1) ?>">
              </div>

              <button type="submit" class="btn btn-success w-100 py-2 fw-bold shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Brand Logo
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
            <h5 class="card-title fw-bold mb-0"><i class="bi bi-award-fill text-primary me-2"></i>Trusted Client Brand Logos Strip</h5>
            <span class="badge bg-primary text-white rounded-pill px-3"><?= count($brand_logos ?? []) ?> Brands</span>
          </div>
          <div class="card-body p-4">
            <div class="row g-3">
              <?php if (empty($brand_logos)): ?>
                <div class="col-12">
                  <div class="p-4 bg-light rounded-3 text-center text-muted border">
                    <p class="mb-0 fs-13">No custom brand logos added yet.</p>
                  </div>
                </div>
              <?php else: ?>
                <?php foreach ($brand_logos as $b): ?>
                  <div class="col-md-6 col-sm-12">
                    <div class="p-3 border rounded-3 d-flex align-items-center justify-content-between bg-white shadow-sm">
                      <div class="d-flex align-items-center gap-3">
                        <div style="width:70px;height:42px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;display:flex;align-items:center;justify-content:center;padding:4px;">
                          <?php if (!empty($b['image'])): ?>
                            <img src="<?= e($b['image']) ?>" alt="<?= e($b['title']) ?>" style="max-height:34px;max-width:100%;object-fit:contain;">
                          <?php else: ?>
                            <i class="bi bi-building fs-4 text-muted"></i>
                          <?php endif; ?>
                        </div>
                        <div>
                          <div class="fw-bold fs-14 text-dark"><?= e($b['title']) ?></div>
                          <?php if (!empty($b['link']) && $b['link'] !== '#'): ?>
                            <a href="<?= e($b['link']) ?>" target="_blank" class="fs-12 text-primary text-decoration-none"><i class="bi bi-box-arrow-up-right me-1"></i>Visit</a>
                          <?php else: ?>
                            <span class="fs-12 text-muted">No link</span>
                          <?php endif; ?>
                        </div>
                      </div>

                      <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBrandModal<?= $b['id'] ?>" title="Edit Brand">
                          <i class="bi bi-pencil-fill"></i>
                        </button>
                        <form method="POST" action="/admin/homepage?tab=brands" onsubmit="return confirm('Remove this brand logo?');" class="d-inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="action" value="delete_brand_logo">
                          <input type="hidden" name="item_id" value="<?= $b['id'] ?>">
                          <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                            <i class="bi bi-trash3-fill"></i>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Edit Brand Modal -->
                  <div class="modal fade" id="editBrandModal<?= $b['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-light">
                          <h6 class="modal-title fw-bold"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Brand Logo</h6>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="/admin/homepage?tab=brands" enctype="multipart/form-data">
                          <?= csrf_field() ?>
                          <input type="hidden" name="action" value="update_brand_logo">
                          <input type="hidden" name="item_id" value="<?= $b['id'] ?>">
                          <div class="modal-body p-4">
                            <div class="mb-3">
                              <label class="form-label fs-12 fw-semibold text-secondary">Brand Name <span class="text-danger">*</span></label>
                              <input type="text" name="title" class="form-control" value="<?= e($b['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label fs-12 fw-semibold text-secondary">Brand Website Link</label>
                              <input type="text" name="link" class="form-control" value="<?= e($b['link'] ?? '#') ?>">
                            </div>
                            <div class="mb-3">
                              <label class="form-label fs-12 fw-semibold text-secondary">Current Logo</label>
                              <?php if (!empty($b['image'])): ?>
                                <div class="p-2 border rounded bg-light text-center mb-2">
                                  <img src="<?= e($b['image']) ?>" alt="<?= e($b['title']) ?>" style="max-height:45px;max-width:160px;object-fit:contain;">
                                </div>
                              <?php endif; ?>
                              <input type="file" name="image" class="form-control" accept="image/*">
                              <div class="form-text fs-11">Choose a new file to replace the existing logo.</div>
                            </div>
                            <div class="mb-3">
                              <label class="form-label fs-12 fw-semibold text-secondary">Or Direct Image URL</label>
                              <input type="text" name="image_url" class="form-control" value="<?= e($b['image'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                              <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                              <input type="number" name="sort_order" class="form-control" value="<?= (int)($b['sort_order'] ?? 0) ?>">
                            </div>
                          </div>
                          <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Save Changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: CTA BANNER
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'cta'): ?>

    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white py-3">
        <h5 class="card-title fw-bold mb-0"><i class="bi bi-megaphone-fill text-warning me-2"></i>Bottom Call To Action (CTA) Banner</h5>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="/admin/homepage?tab=cta">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">

          <div class="mb-3">
            <label class="form-label fw-semibold fs-13 text-secondary">CTA Headline</label>
            <input type="text" name="cta_title" value="<?= e($cta_title ?? '') ?>" class="form-control fw-bold" placeholder="Ready to Transform Your Jewelry Business?">
          </div>

          <div class="mb-4">
            <label class="form-label fw-semibold fs-13 text-secondary">CTA Subtitle / Paragraph</label>
            <textarea name="cta_desc" rows="2" class="form-control"><?= e($cta_desc ?? '') ?></textarea>
          </div>

          <div class="p-3 bg-light rounded-3 mb-4 border">
            <h6 class="fw-bold fs-13 text-dark mb-3"><i class="bi bi-cursor text-primary me-2"></i>Action Buttons</h6>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fs-12 fw-semibold text-muted">Primary Button Text (Demo)</label>
                <input type="text" name="cta_btn1_text" value="<?= e($cta_btn1_text ?? '') ?>" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label fs-12 fw-semibold text-muted">Primary Button Link</label>
                <input type="text" name="cta_btn1_link" value="<?= e($cta_btn1_link ?? '') ?>" class="form-control" placeholder="#contact">
              </div>
              <div class="col-md-6">
                <label class="form-label fs-12 fw-semibold text-muted">Secondary Button Text (Call / Phone)</label>
                <input type="text" name="cta_btn2_text" value="<?= e($cta_btn2_text ?? '') ?>" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label fs-12 fw-semibold text-muted">Secondary Button Link (tel:+91...)</label>
                <input type="text" name="cta_btn2_link" value="<?= e($cta_btn2_link ?? '') ?>" class="form-control" placeholder="tel:+919876543210">
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-navy px-4 py-2">
              <i class="bi bi-floppy-fill me-1"></i> Save CTA Banner
            </button>
          </div>
        </form>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: FOOTER
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'footer'): ?>

    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white py-3">
        <h5 class="card-title fw-bold mb-0"><i class="bi bi-layout-text-window-reverse text-primary me-2"></i>Global Website Footer &amp; Contact Info</h5>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="/admin/homepage?tab=footer">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">

          <!-- 1. Tagline & Brand Bio -->
          <div class="mb-4">
            <label class="form-label fw-bold fs-13 text-secondary">Footer Tagline &amp; Bio Paragraph</label>
            <textarea name="footer_tagline" rows="2" class="form-control"><?= e($footer_tagline ?? 'We build jewellery-specific software delivering accuracy, control, scalability, and business growth') ?></textarea>
            <div class="form-text fs-11">Appears directly below the footer logo.</div>
          </div>

          <!-- 2. UAE Office Details -->
          <div class="card border mb-4 bg-light">
            <div class="card-header bg-white py-2">
              <h6 class="fw-bold text-dark mb-0 fs-13"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Headquarter Office (UAE)</h6>
            </div>
            <div class="card-body p-3">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">UAE Office Title</label>
                  <input type="text" name="footer_uae_title" value="<?= e($footer_uae_title ?? 'Headquarter - UAE') ?>" class="form-control form-control-sm">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">UAE Phone Number</label>
                  <input type="text" name="footer_uae_phone" value="<?= e($footer_uae_phone ?? '+971 56 324 0319') ?>" class="form-control form-control-sm">
                </div>
                <div class="col-12">
                  <label class="form-label fw-semibold fs-12 text-secondary">UAE Full Physical Address</label>
                  <textarea name="footer_uae_address" rows="2" class="form-control form-control-sm"><?= e($footer_uae_address ?? "Shop No. 25/A\nCentral Gold Souq Block No. 8,\nAl Majaz -1 King Faisal Road - Sharjah") ?></textarea>
                </div>
              </div>
            </div>
          </div>

          <!-- 3. India Office Details -->
          <div class="card border mb-4 bg-light">
            <div class="card-header bg-white py-2">
              <h6 class="fw-bold text-dark mb-0 fs-13"><i class="bi bi-geo-alt-fill text-primary me-1"></i> India Operations Office</h6>
            </div>
            <div class="card-body p-3">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">India Office Title</label>
                  <input type="text" name="footer_india_title" value="<?= e($footer_india_title ?? 'India') ?>" class="form-control form-control-sm">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">India Phone Number</label>
                  <input type="text" name="footer_india_phone" value="<?= e($footer_india_phone ?? '+91 92703 69937') ?>" class="form-control form-control-sm">
                </div>
                <div class="col-12">
                  <label class="form-label fw-semibold fs-12 text-secondary">India Full Physical Address</label>
                  <textarea name="footer_india_address" rows="2" class="form-control form-control-sm"><?= e($footer_india_address ?? "India, 01/A, Hingna Rd,\nM.I.D.C, Maharashtra - 440022") ?></textarea>
                </div>
              </div>
            </div>
          </div>

          <!-- 4. Emails & Social Links -->
          <div class="card border mb-4 bg-light">
            <div class="card-header bg-white py-2">
              <h6 class="fw-bold text-dark mb-0 fs-13"><i class="bi bi-envelope-at-fill text-success me-1"></i> Contact Emails &amp; Social Links</h6>
            </div>
            <div class="card-body p-3">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">Primary Contact Email</label>
                  <input type="email" name="footer_email" value="<?= e($footer_email ?? 'info@goldmatrixsoftware.com') ?>" class="form-control form-control-sm">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">Secondary / Support Email</label>
                  <input type="email" name="footer_email_2" value="<?= e($footer_email_2 ?? 'goldmatrixsoftware@gmail.com') ?>" class="form-control form-control-sm">
                </div>
                <div class="col-md-3 col-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">Facebook URL</label>
                  <input type="text" name="social_facebook" value="<?= e($social_facebook ?? setting('social_facebook', '#')) ?>" class="form-control form-control-sm" placeholder="https://facebook.com/...">
                </div>
                <div class="col-md-3 col-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">Twitter / X URL</label>
                  <input type="text" name="social_twitter" value="<?= e($social_twitter ?? setting('social_twitter', '#')) ?>" class="form-control form-control-sm" placeholder="https://x.com/...">
                </div>
                <div class="col-md-3 col-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">Instagram URL</label>
                  <input type="text" name="social_instagram" value="<?= e($social_instagram ?? setting('social_instagram', '#')) ?>" class="form-control form-control-sm" placeholder="https://instagram.com/...">
                </div>
                <div class="col-md-3 col-6">
                  <label class="form-label fw-semibold fs-12 text-secondary">LinkedIn URL</label>
                  <input type="text" name="social_linkedin" value="<?= e($social_linkedin ?? setting('social_linkedin', '#')) ?>" class="form-control form-control-sm" placeholder="https://linkedin.com/...">
                </div>
              </div>
            </div>
          </div>

          <!-- 5. Copyright Notice -->
          <div class="mb-4">
            <label class="form-label fw-bold fs-13 text-secondary">Copyright Notice</label>
            <input type="text" name="footer_copyright" value="<?= e($footer_copyright ?? '© ' . date('Y') . ' GoldMatrix Software. All Rights Reserved.') ?>" class="form-control">
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-navy px-4 py-2 fw-bold">
              <i class="bi bi-floppy-fill me-1"></i> Save Footer Settings
            </button>
          </div>
        </form>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: SEO & META
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'seo'): ?>

    <div class="row g-4">
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0"><i class="bi bi-google text-primary me-2"></i>Search Engine Optimization (SEO)</h5>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=seo">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="save_settings">

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-secondary">Meta Title (Google Tab Title)</label>
                <input type="text" name="meta_title" value="<?= e($meta_title ?? '') ?>" class="form-control" maxlength="80">
                <div class="form-text fs-11">Recommended length: 50–60 characters.</div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-secondary">Meta Description</label>
                <textarea name="meta_desc" rows="3" class="form-control" maxlength="200"><?= e($meta_desc ?? '') ?></textarea>
                <div class="form-text fs-11">Recommended length: 140–160 characters.</div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-secondary">Meta Keywords (Comma separated)</label>
                <input type="text" name="meta_keywords" value="<?= e($meta_keywords ?? '') ?>" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-secondary">Social Share (OG) Title</label>
                <input type="text" name="og_title" value="<?= e($og_title ?? '') ?>" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-secondary">Social Share (OG) Description</label>
                <textarea name="og_desc" rows="2" class="form-control"><?= e($og_desc ?? '') ?></textarea>
              </div>

              <div class="mb-4">
                <label class="form-label fw-semibold fs-13 text-secondary">OG Social Preview Image URL</label>
                <input type="text" name="og_image" value="<?= e($og_image ?? '') ?>" class="form-control" placeholder="https://...or /uploads/...">
              </div>

              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-navy px-4 py-2">
                  <i class="bi bi-floppy-fill me-1"></i> Save SEO Settings
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <!-- Google SERP Preview Card -->
        <div class="card border-0 shadow-sm p-3 mb-3">
          <h6 class="fw-bold fs-13 text-dark mb-3"><i class="bi bi-search text-primary me-2"></i>Google SERP Preview</h6>
          <div class="p-3 bg-light rounded-3 border">
            <div class="fs-12 text-success mb-1">https://goldmatrixerp.com/</div>
            <div class="fs-14 fw-bold text-primary mb-1 text-truncate"><?= e($meta_title ?? 'GoldMatrix — The Complete Jewellery ERP') ?></div>
            <div class="fs-12 text-muted"><?= e($meta_desc ?? 'Complete Jewelry ERP Software with Inventory, POS, GST, Karigar, and Multi-Branch Management.') ?></div>
          </div>
        </div>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: MOBILE APP SHOWCASE & FEATURE CARDS (BOTTOM)
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'mobile_app'): ?>

    <div class="row g-4">
      <!-- Left: Section Settings & Banner Poster -->
      <div class="col-lg-5">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0"><i class="bi bi-gear-fill text-primary me-2"></i>Mobile App Section Settings</h5>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="/admin/homepage?tab=mobile_app" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="save_mobile_app_settings">

              <!-- Enable Toggle -->
              <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between mb-3 border">
                <div>
                  <div class="fw-bold text-dark fs-13">Enable Mobile App Section</div>
                  <div class="text-muted fs-11">Show this app showcase container on the homepage bottom</div>
                </div>
                <div class="form-check form-switch m-0">
                  <input class="form-check-input" type="checkbox" name="mobile_app_enabled" value="1" <?= ($mobile_app_enabled ?? '1') == '1' ? 'checked' : '' ?> style="width:2.4em;height:1.2em;">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Eyebrow Badge</label>
                <input type="text" name="mobile_app_badge" class="form-control" value="<?= e($mobile_app_badge ?? 'MOBILE JEWELLERY ERP') ?>">
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Main Heading <span class="text-danger">*</span></label>
                <input type="text" name="mobile_app_title" class="form-control" value="<?= e($mobile_app_title ?? 'Start Using Jewellers App Today') ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Subtitle Description</label>
                <textarea name="mobile_app_desc" class="form-control" rows="3"><?= e($mobile_app_desc ?? 'Empowering Jewellers to Manage, Track & Grow their Business Anytime, Anywhere.') ?></textarea>
              </div>

              <!-- Poster Banner Image -->
              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Featured App Poster Banner Image</label>
                <?php if (!empty($mobile_app_banner_image)): ?>
                  <div class="p-2 border rounded bg-light text-center mb-2 position-relative">
                    <img src="<?= e($mobile_app_banner_image) ?>" alt="Mobile App Showcase" style="max-height:140px;max-width:100%;object-fit:cover;border-radius:8px;">
                    <div class="mt-2">
                      <button type="submit" name="remove_mobile_app_banner" value="1" class="btn btn-outline-danger btn-sm fs-11" onclick="return confirm('Remove current banner image?');">
                        <i class="bi bi-trash me-1"></i> Remove Banner
                      </button>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="image-upload-dropzone">
                  <i class="bi bi-image fs-3 text-muted"></i>
                  <div class="fs-12 text-muted mt-1">Upload New Poster Banner (PNG / JPG / WebP)</div>
                  <input type="file" name="mobile_app_banner_image" accept="image/*">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Or Direct Banner Image URL</label>
                <input type="text" name="mobile_app_banner_image_url" class="form-control" value="<?= e($mobile_app_banner_image ?? '') ?>" placeholder="/assets/images/... or https://...">
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Google Play Store Link (Android)</label>
                <input type="text" name="mobile_app_android_link" class="form-control" value="<?= e($mobile_app_android_link ?? '#contact') ?>">
              </div>

              <div class="mb-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Apple App Store Link (iOS)</label>
                <input type="text" name="mobile_app_ios_link" class="form-control" value="<?= e($mobile_app_ios_link ?? '#contact') ?>">
              </div>

              <div class="mb-4">
                <label class="form-label fs-12 fw-semibold text-secondary">Trust Badge Text</label>
                <input type="text" name="mobile_app_cta_badge" class="form-control" value="<?= e($mobile_app_cta_badge ?? 'Trusted by 1000+ Jewellers Across India') ?>">
              </div>

              <button type="submit" class="btn btn-navy w-100 py-2 fw-bold">
                <i class="bi bi-floppy-fill me-1"></i> Save Section Settings
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Right: Feature Cards CRUD Manager -->
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
            <h5 class="card-title fw-bold mb-0"><i class="bi bi-grid-fill text-warning me-2"></i>Mobile App Feature Cards Grid</h5>
            <button class="btn btn-success btn-sm fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#addCardCollapse">
              <i class="bi bi-plus-lg me-1"></i> Add New Feature Card
            </button>
          </div>

          <!-- Add Card Form Collapse -->
          <div class="collapse" id="addCardCollapse">
            <div class="card-body bg-light border-bottom p-4">
              <h6 class="fw-bold text-dark mb-3"><i class="bi bi-plus-circle-fill text-success me-2"></i>New Feature Card Details</h6>
              <form method="POST" action="/admin/homepage?tab=mobile_app" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="add_mobile_app_card">

                <div class="row g-3">
                  <div class="col-md-7">
                    <label class="form-label fs-12 fw-semibold text-secondary">Feature Card Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Real-Time Stock & Inventory" required>
                  </div>
                  <div class="col-md-5">
                    <label class="form-label fs-12 fw-semibold text-secondary">Bootstrap Icon Class</label>
                    <input type="text" name="icon" class="form-control" value="bi-box-seam-fill" placeholder="bi-phone-fill">
                  </div>
                  <div class="col-12">
                    <label class="form-label fs-12 fw-semibold text-secondary">Description</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Explain what this mobile feature offers..."></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fs-12 fw-semibold text-secondary">Upload Icon / Image File</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fs-12 fw-semibold text-secondary">Or Direct Image URL</label>
                    <input type="text" name="image_url" class="form-control" placeholder="https://... or /assets/...">
                  </div>
                  <div class="col-md-8">
                    <label class="form-label fs-12 fw-semibold text-secondary">Card Click Link (Optional)</label>
                    <input type="text" name="link" class="form-control" value="#contact">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= (count($mobile_app_cards ?? []) + 1) ?>">
                  </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#addCardCollapse">Cancel</button>
                  <button type="submit" class="btn btn-success btn-sm fw-bold px-3">Add Feature Card</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Active Cards Table -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                  <tr>
                    <th class="ps-4" style="width:60px;">Icon</th>
                    <th>Feature Title & Description</th>
                    <th style="width:80px;">Order</th>
                    <th class="text-end pe-4" style="width:120px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($mobile_app_cards)): ?>
                    <tr>
                      <td colspan="4" class="text-center py-4 text-muted">No feature cards added yet. Click "Add New Feature Card" above.</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($mobile_app_cards as $c): ?>
                      <tr>
                        <td class="ps-4">
                          <?php if (!empty($c['image'])): ?>
                            <img src="<?= e($c['image']) ?>" alt="<?= e($c['title']) ?>" style="height:32px;width:32px;object-fit:contain;">
                          <?php else: ?>
                            <div class="p-2 bg-light rounded text-warning text-center" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
                              <i class="bi <?= e($c['icon'] ?: 'bi-phone') ?> fs-5"></i>
                            </div>
                          <?php endif; ?>
                        </td>
                        <td>
                          <div class="fw-bold text-dark fs-13"><?= e($c['title']) ?></div>
                          <div class="text-muted fs-11 text-truncate" style="max-width:320px;"><?= e($c['description']) ?></div>
                        </td>
                        <td>
                          <span class="badge bg-light text-dark border"><?= (int)$c['sort_order'] ?></span>
                        </td>
                        <td class="text-end pe-4">
                          <div class="d-inline-flex gap-1">
                            <button type="button" class="btn btn-outline-primary btn-sm p-1 px-2" data-bs-toggle="modal" data-bs-target="#editCardModal<?= $c['id'] ?>" title="Edit Card">
                              <i class="bi bi-pencil-fill"></i>
                            </button>
                            <form method="POST" action="/admin/homepage?tab=mobile_app" onsubmit="return confirm('Delete this feature card?');" class="d-inline">
                              <?= csrf_field() ?>
                              <input type="hidden" name="action" value="delete_mobile_app_card">
                              <input type="hidden" name="item_id" value="<?= $c['id'] ?>">
                              <button type="submit" class="btn btn-outline-danger btn-sm p-1 px-2" title="Delete">
                                <i class="bi bi-trash3-fill"></i>
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>

                      <!-- Edit Card Modal -->
                      <div class="modal fade" id="editCardModal<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content border-0 shadow">
                            <div class="modal-header bg-light">
                              <h6 class="modal-title fw-bold"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Feature Card</h6>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="/admin/homepage?tab=mobile_app" enctype="multipart/form-data">
                              <?= csrf_field() ?>
                              <input type="hidden" name="action" value="update_mobile_app_card">
                              <input type="hidden" name="item_id" value="<?= $c['id'] ?>">

                              <div class="modal-body p-4">
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Card Title <span class="text-danger">*</span></label>
                                  <input type="text" name="title" class="form-control" value="<?= e($c['title']) ?>" required>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Bootstrap Icon Class</label>
                                  <input type="text" name="icon" class="form-control" value="<?= e($c['icon']) ?>" placeholder="bi-box-seam-fill">
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Description</label>
                                  <textarea name="description" class="form-control" rows="3"><?= e($c['description']) ?></textarea>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Upload Icon / Image File</label>
                                  <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Or Direct Image URL</label>
                                  <input type="text" name="image_url" class="form-control" value="<?= e($c['image']) ?>">
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Card Link</label>
                                  <input type="text" name="link" class="form-control" value="<?= e($c['link'] ?? '#contact') ?>">
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                                  <input type="number" name="sort_order" class="form-control" value="<?= (int)$c['sort_order'] ?>">
                                </div>
                              </div>
                              <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-sm fw-bold">Save Changes</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php /* ══════════════════════════════════════════════════
          TAB: AWARDS & RECOGNITION
          ══════════════════════════════════════════════════ */
  elseif ($activeTab === 'awards'): ?>

    <!-- 1. SECTION SETTINGS CARD -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <h5 class="card-title fw-bold mb-0 text-dark">
          <i class="bi bi-trophy-fill text-warning me-2"></i>Awards Section Settings
        </h5>
        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1 fw-bold">Live Below Mobile App</span>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="/admin/homepage?tab=awards">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_awards_settings">

          <div class="row g-3 align-items-center mb-3">
            <div class="col-md-3">
              <div class="form-check form-switch fs-14">
                <input class="form-check-input" type="checkbox" name="awards_enabled" id="awardsEnabled" value="1" <?= ($awards_enabled ?? '1') == '1' ? 'checked' : '' ?>>
                <label class="form-check-label fw-bold" for="awardsEnabled">Enable Awards Section</label>
              </div>
            </div>
            <div class="col-md-3">
              <label class="form-label fs-12 fw-semibold text-secondary">Badge / Eyebrow</label>
              <input type="text" name="awards_badge" class="form-control form-control-sm" value="<?= e($awards_badge ?? 'AWARDS') ?>" placeholder="AWARDS">
            </div>
            <div class="col-md-3">
              <label class="form-label fs-12 fw-semibold text-secondary">Section Title</label>
              <input type="text" name="awards_title" class="form-control form-control-sm fw-bold" value="<?= e($awards_title ?? 'Awards') ?>" placeholder="Awards">
            </div>
            <div class="col-md-3">
              <label class="form-label fs-12 fw-semibold text-secondary">Section Subtitle</label>
              <input type="text" name="awards_subtitle" class="form-control form-control-sm" value="<?= e($awards_subtitle ?? 'Recognized by industry leaders for performance, usability, and customer trust.') ?>" placeholder="Subtitle...">
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-navy btn-sm px-4 fw-bold">
              <i class="bi bi-check2-circle me-1"></i> Save Section Settings
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- 2. AWARDS LIST & ADD CARD -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
          <h5 class="card-title fw-bold mb-0 text-dark">
            <i class="bi bi-award-fill text-warning me-2"></i>Awards & Badges List
          </h5>
          <div class="text-muted fs-12 mt-1">Manage, upload, and reorder awards displayed on the homepage.</div>
        </div>
        <button class="btn btn-navy btn-sm d-inline-flex align-items-center gap-2 px-3 py-2" data-bs-toggle="collapse" data-bs-target="#addAwardCollapse">
          <i class="bi bi-plus-circle-fill text-warning"></i>
          <span class="fw-bold">+ Add New Award</span>
        </button>
      </div>

      <!-- ADD NEW AWARD COLLAPSIBLE FORM -->
      <div class="collapse <?= empty($awards_items) ? 'show' : '' ?>" id="addAwardCollapse">
        <div class="card-body bg-light border-bottom p-4">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="fw-bold text-dark mb-0">
              <i class="bi bi-plus-square-fill text-primary me-2"></i>Add New Award / Accolade
            </h6>
            <button type="button" class="btn-close btn-sm" data-bs-toggle="collapse" data-bs-target="#addAwardCollapse"></button>
          </div>

          <form method="POST" action="/admin/homepage?tab=awards" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="add_award_item">

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label fs-12 fw-semibold text-secondary">Award Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control fw-bold" placeholder="e.g. High Performer / Best Usability" required>
              </div>
              <div class="col-md-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Season / Year</label>
                <input type="text" name="subtitle" class="form-control" placeholder="e.g. Winter 2023 / 2022">
              </div>
              <div class="col-md-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Platform / Issuer</label>
                <input type="text" name="badge" class="form-control" placeholder="e.g. SoftwareSuggest / G2 / Capterra">
              </div>
              <div class="col-md-2">
                <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" placeholder="1, 2, 3...">
              </div>

              <div class="col-md-6">
                <label class="form-label fs-12 fw-semibold text-secondary">Upload Award Badge Image (PNG, SVG, JPG, WebP)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <div class="form-text fs-11">Recommended: Clean PNG with transparent background or SVG badge.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label fs-12 fw-semibold text-secondary">Or Direct Image URL / Path</label>
                <input type="text" name="image_url" class="form-control" placeholder="https://... or /assets/images/awards/...">
              </div>

              <div class="col-md-6">
                <label class="form-label fs-12 fw-semibold text-secondary">External Link (Optional)</label>
                <input type="text" name="link" class="form-control" placeholder="https://www.softwaresuggest.com/...">
              </div>
              <div class="col-md-3">
                <label class="form-label fs-12 fw-semibold text-secondary">Status</label>
                <select name="is_active" class="form-select">
                  <option value="1">Active / Published</option>
                  <option value="0">Draft / Hidden</option>
                </select>
              </div>
              <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-navy w-100 py-2 fw-bold">
                  <i class="bi bi-cloud-arrow-up-fill me-1"></i> Save Award
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- AWARDS LIST TABLE -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-secondary fs-12">
              <tr>
                <th style="width:70px;" class="ps-3">Order</th>
                <th style="width:110px;">Badge</th>
                <th>Award Details</th>
                <th>Platform</th>
                <th>Status</th>
                <th style="width:150px;" class="text-end pe-3">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($awards_items)): ?>
                <tr>
                  <td colspan="6" class="text-center py-5 text-muted">
                    <i class="bi bi-award fs-1 d-block mb-2 text-warning opacity-50"></i>
                    No awards added yet. Click <strong>+ Add New Award</strong> to get started.
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($awards_items as $item): ?>
                  <tr>
                    <td class="ps-3 fw-bold text-muted"><?= (int)$item['sort_order'] ?></td>
                    <td>
                      <?php if (!empty($item['image'])): ?>
                        <div style="width:65px; height:65px; background:#F8FAFC; border:1px solid #E2E8F0; border-radius:12px; display:flex; align-items:center; justify-content:center; padding:6px;">
                          <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>" style="max-width:100%; max-height:100%; object-fit:contain;">
                        </div>
                      <?php else: ?>
                        <div style="width:65px; height:65px; background:#FEF3C7; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#D97706; font-size:24px;">
                          <i class="bi bi-award"></i>
                        </div>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div class="fw-bold text-dark fs-14"><?= e($item['title']) ?></div>
                      <div class="text-muted fs-12"><?= e($item['subtitle']) ?></div>
                    </td>
                    <td>
                      <span class="badge bg-light text-dark border fs-12"><?= e($item['badge'] ?: 'Award') ?></span>
                    </td>
                    <td>
                      <?php if ($item['is_active']): ?>
                        <span class="badge bg-success-subtle text-success border border-success-subtle fs-11">Active</span>
                      <?php else: ?>
                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle fs-11">Hidden</span>
                      <?php endif; ?>
                    </td>
                    <td class="text-end pe-3">
                      <div class="d-inline-flex gap-1">
                        <!-- Toggle Button -->
                        <form method="POST" action="/admin/homepage?tab=awards" class="d-inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="action" value="toggle_award_item">
                          <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                          <button type="submit" class="btn btn-sm btn-light border" title="<?= $item['is_active'] ? 'Hide' : 'Publish' ?>">
                            <i class="bi bi-<?= $item['is_active'] ? 'eye-slash' : 'eye' ?>"></i>
                          </button>
                        </form>

                        <!-- Edit Button -->
                        <button type="button" class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#editAwardModal<?= $item['id'] ?>" title="Edit">
                          <i class="bi bi-pencil-square"></i>
                        </button>

                        <!-- Delete Button -->
                        <form method="POST" action="/admin/homepage?tab=awards" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this award?')">
                          <?= csrf_field() ?>
                          <input type="hidden" name="action" value="delete_award_item">
                          <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                          <button type="submit" class="btn btn-sm btn-light border text-danger" title="Delete">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>

                  <!-- EDIT AWARD MODAL -->
                  <div class="modal fade" id="editAwardModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-navy text-white">
                          <h6 class="modal-title fw-bold text-white">
                            <i class="bi bi-pencil-square text-warning me-2"></i>Edit Award: <?= e($item['title']) ?>
                          </h6>
                          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST" action="/admin/homepage?tab=awards" enctype="multipart/form-data">
                          <?= csrf_field() ?>
                          <input type="hidden" name="action" value="update_award_item">
                          <input type="hidden" name="item_id" value="<?= $item['id'] ?>">

                          <div class="modal-body p-4">
                            <div class="row g-3">
                              <div class="col-md-5">
                                <label class="form-label fs-12 fw-semibold text-secondary">Award Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control fw-bold" value="<?= e($item['title']) ?>" required>
                              </div>
                              <div class="col-md-4">
                                <label class="form-label fs-12 fw-semibold text-secondary">Season / Year</label>
                                <input type="text" name="subtitle" class="form-control" value="<?= e($item['subtitle']) ?>" placeholder="Winter 2023">
                              </div>
                              <div class="col-md-3">
                                <label class="form-label fs-12 fw-semibold text-secondary">Platform / Issuer</label>
                                <input type="text" name="badge" class="form-control" value="<?= e($item['badge']) ?>" placeholder="SoftwareSuggest">
                              </div>

                              <div class="col-12">
                                <label class="form-label fs-12 fw-semibold text-secondary">Current Badge Image</label>
                                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded border">
                                  <?php if (!empty($item['image'])): ?>
                                    <div style="width:70px; height:70px; background:#FFFFFF; border:1px solid #CBD5E1; border-radius:10px; display:flex; align-items:center; justify-content:center; padding:6px;">
                                      <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>" style="max-width:100%; max-height:100%; object-fit:contain;">
                                    </div>
                                    <div>
                                      <div class="fs-12 text-secondary font-monospace"><?= e($item['image']) ?></div>
                                      <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" name="remove_award_image" id="remImg<?= $item['id'] ?>" value="1">
                                        <label class="form-check-label fs-12 text-danger" for="remImg<?= $item['id'] ?>">Remove Image</label>
                                      </div>
                                    </div>
                                  <?php else: ?>
                                    <span class="text-muted fs-12">No image uploaded</span>
                                  <?php endif; ?>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <label class="form-label fs-12 fw-semibold text-secondary">Upload New Badge File</label>
                                <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                              </div>
                              <div class="col-md-6">
                                <label class="form-label fs-12 fw-semibold text-secondary">Or Direct Image URL / Path</label>
                                <input type="text" name="image_url" class="form-control form-control-sm" value="<?= e($item['image']) ?>" placeholder="https://... or /assets/images/awards/...">
                              </div>

                              <div class="col-md-6">
                                <label class="form-label fs-12 fw-semibold text-secondary">External Link</label>
                                <input type="text" name="link" class="form-control form-control-sm" value="<?= e($item['link']) ?>">
                              </div>
                              <div class="col-md-3">
                                <label class="form-label fs-12 fw-semibold text-secondary">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control form-control-sm" value="<?= (int)$item['sort_order'] ?>">
                              </div>
                              <div class="col-md-3">
                                <label class="form-label fs-12 fw-semibold text-secondary">Status</label>
                                <select name="is_active" class="form-select form-select-sm">
                                  <option value="1" <?= $item['is_active'] ? 'selected' : '' ?>>Active / Visible</option>
                                  <option value="0" <?= !$item['is_active'] ? 'selected' : '' ?>>Draft / Hidden</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-gold btn-sm fw-bold px-4">
                              <i class="bi bi-check2-circle me-1"></i> Save Changes
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  <?php endif; ?>

</div>

<script>
function setAccent(hex, colorInputId, hexInputId) {
  const cIn = document.getElementById(colorInputId);
  const hIn = document.getElementById(hexInputId);
  if (cIn) cIn.value = hex;
  if (hIn) hIn.value = hex;
}
</script>
