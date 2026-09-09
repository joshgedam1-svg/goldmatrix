<?php
/**
 * GoldMatrix ERP - Advanced Section & Card Level Page Editor
 */
$slug = ltrim($page['slug'] ?? '', '/');
$template = $page['template'] ?? 'default';
$subtab = $activeSubTab ?? ($_GET['subtab'] ?? 'overview');
$cardsList = $feature_cards ?? [];
$hardwareList = $hardware_cards ?? [];
?>

<div class="container-fluid px-0">

  <!-- TOP TITLE & ACTIONS BAR -->
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center gap-3">
      <div class="p-3 bg-primary-subtle text-primary rounded-3">
        <i class="bi bi-file-earmark-richtext-fill fs-3"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2">
          <h2 class="h4 fw-bold text-dark mb-0"><?= e($page['title']) ?> Editor</h2>
          <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Direct Live Sync</span>
        </div>
        <p class="text-muted small mb-0 mt-1">
          Route: <code class="text-primary fw-bold">/<?= e($slug) ?></code> &bull; Template: <span class="badge bg-light text-dark border"><?= ucfirst(e($template)) ?></span>
        </p>
      </div>
    </div>
    <div class="d-flex align-items-center gap-2">
      <a href="<?= admin_url('pages') ?>" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-2 px-3 py-2">
        <i class="bi bi-arrow-left"></i>
        <span>All Pages</span>
      </a>
      <a href="<?= site_url($slug) ?>" target="_blank" class="btn btn-outline-dark btn-sm d-inline-flex align-items-center gap-2 px-3 py-2">
        <i class="bi bi-box-arrow-up-right"></i>
        <span>View Live Page</span>
      </a>
    </div>
  </div>

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

  <!-- IF FEATURES PAGE: SHOW SUBTABS -->
  <?php if ($template === 'features' || $slug === 'features'): ?>
    <ul class="nav nav-pills bg-white p-2 rounded-3 border mb-4 shadow-sm">
      <li class="nav-item">
        <a class="nav-link fw-semibold <?= $subtab === 'overview' ? 'active bg-primary' : 'text-dark' ?>" href="?id=<?= (int)$page['id'] ?>&subtab=overview">
          <i class="bi bi-layout-text-window-reverse me-1"></i> Hero & Section Settings
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link fw-semibold <?= $subtab === 'cards' ? 'active bg-primary' : 'text-dark' ?>" href="?id=<?= (int)$page['id'] ?>&subtab=cards">
          <i class="bi bi-grid-3x3-gap-fill me-1"></i> Feature Capability Cards (<?= count($cardsList) ?>)
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link fw-semibold <?= $subtab === 'hardware' ? 'active bg-primary' : 'text-dark' ?>" href="?id=<?= (int)$page['id'] ?>&subtab=hardware">
          <i class="bi bi-cpu-fill me-1"></i> Hardware Ecosystem Cards (<?= count($hardwareList) ?>)
        </a>
      </li>
    </ul>
  <?php endif; ?>


  <!-- ══════════════════════════════════════════════════════
       TAB 2: FEATURE CARDS CRUD (ADD / EDIT / DELETE CARDS)
       ══════════════════════════════════════════════════════ -->
  <?php if (($template === 'features' || $slug === 'features') && $subtab === 'cards'): ?>
    
    <div class="row g-4 mb-4">
      <div class="col-lg-8">
        
        <!-- CARD LIST -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <h5 class="card-title fw-bold mb-0 text-dark">
              <i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>Active Feature Capability Cards (<?= count($cardsList) ?>)
            </h5>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-12">Total: <?= count($cardsList) ?></span>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                  <tr>
                    <th class="ps-3 text-uppercase fs-11 text-secondary">Card / Module</th>
                    <th class="text-uppercase fs-11 text-secondary">Category</th>
                    <th class="text-uppercase fs-11 text-secondary">Checklist Items</th>
                    <th class="text-uppercase fs-11 text-secondary">Status</th>
                    <th class="text-end pe-3 text-uppercase fs-11 text-secondary">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($cardsList as $c): 
                    $hlArr = !empty($c['features']) ? (is_array($c['features']) ? $c['features'] : json_decode($c['features'], true)) : [];
                  ?>
                    <tr>
                      <td class="ps-3">
                        <div class="d-flex align-items-center gap-2">
                          <div class="p-2 rounded bg-light border text-primary" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi <?= e($c['icon'] ?: 'bi-star-fill') ?>"></i>
                          </div>
                          <div>
                            <div class="fw-bold text-dark fs-13"><?= e($c['title']) ?></div>
                            <div class="text-muted fs-11"><?= e(substr($c['description'], 0, 48)) ?>...</div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-light text-dark border fs-11"><?= e($c['subtitle'] ?: 'General') ?></span>
                      </td>
                      <td>
                        <span class="badge bg-secondary-subtle text-secondary fs-11"><?= is_array($hlArr) ? count($hlArr) : 0 ?> Bullets</span>
                      </td>
                      <td>
                        <span class="badge bg-<?= !empty($c['is_active']) ? 'success' : 'secondary' ?>-subtle text-<?= !empty($c['is_active']) ? 'success' : 'secondary' ?>">
                          <?= !empty($c['is_active']) ? 'Active' : 'Draft' ?>
                        </span>
                      </td>
                      <td class="text-end pe-3">
                        <div class="d-flex align-items-center justify-content-end gap-1">
                          <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#editCardCollapse_<?= $c['id'] ?>">
                            <i class="bi bi-pencil"></i>
                          </button>
                          <form action="<?= admin_url('pages/delete-item') ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete card: <?= e($c['title']) ?>?');">
                            <input type="hidden" name="page_id" value="<?= (int)$page['id'] ?>">
                            <input type="hidden" name="item_id" value="<?= (int)$c['id'] ?>">
                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>

                    <!-- INLINE EDIT ACCORDION -->
                    <tr class="collapse bg-light" id="editCardCollapse_<?= $c['id'] ?>">
                      <td colspan="5" class="p-4">
                        <form action="<?= admin_url('pages/save-item') ?>" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="page_id" value="<?= (int)$page['id'] ?>">
                          <input type="hidden" name="item_id" value="<?= (int)$c['id'] ?>">
                          <input type="hidden" name="section" value="page_features">
                          <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

                          <div class="card border border-primary p-3">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-pencil-square me-1"></i> Edit Card: <?= e($c['title']) ?></h6>
                            
                            <div class="row g-3">
                              <div class="col-md-6">
                                <label class="form-label fw-bold fs-12">Card Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control form-control-sm" value="<?= e($c['title']) ?>" required>
                              </div>
                              <div class="col-md-3">
                                <label class="form-label fw-bold fs-12">Category</label>
                                <input type="text" name="category" class="form-control form-control-sm" value="<?= e($c['subtitle']) ?>" placeholder="e.g. Retail POS, Finance">
                              </div>
<?php
$presetIcons = [
    'bi-gem'                => 'Diamond / Jewellery',
    'bi-cash-coin'          => 'Money / Bullion Ledger',
    'bi-bank2'              => 'Bank / Finance / Girvi Loan',
    'bi-upc-scan'           => 'Barcode / HUID Scanner',
    'bi-speedometer2'       => 'Weighing Scale Sync',
    'bi-printer'            => 'Jewellery Tag Printer',
    'bi-shield-check'       => 'BIS Hallmark / Security',
    'bi-buildings'          => 'Multi-Branch Showroom',
    'bi-phone-fill'         => 'Mobile App / WhatsApp',
    'bi-hammer'             => 'Workshop / Karigar',
    'bi-receipt-cutoff'     => 'GST Invoicing / Tax',
    'bi-piggy-bank-fill'    => 'Kitty / Savings Scheme',
    'bi-award-fill'         => 'Loyalty / VIP Member',
    'bi-bar-chart-fill'     => 'Reports / Analytics',
    'bi-box-seam'           => 'Wholesale / Inventory',
    'bi-cart-check-fill'    => 'E-Commerce / Online',
    'bi-people-fill'        => 'Customer CRM / Staff',
    'bi-globe2'             => 'Global / Multi-Currency',
    'bi-calculator'         => 'Accounting / Ledgers',
    'bi-clock-history'      => 'Custom Orders / Repairs',
    'bi-boxes'              => 'Inventory / Stock Vault',
    'bi-currency-exchange'  => 'Digital Gold / Wallet',
    'bi-images'             => 'Cataloging / Lookbook',
    'bi-tag-fill'           => 'Barcode / HUID Tagging',
    'bi-stars'              => 'Special Feature'
];
?>
                              <div class="col-md-3">
                                <label class="form-label fw-bold fs-12">Select Icon</label>
                                <select name="icon" class="form-select form-select-sm" onchange="this.previousElementSibling ? null : null;">
                                  <?php foreach ($presetIcons as $iClass => $iLabel): ?>
                                    <option value="<?= e($iClass) ?>" <?= ($c['icon'] === $iClass) ? 'selected' : '' ?>><?= e($iLabel) ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                              <div class="col-12">
                                <label class="form-label fw-bold fs-12">Short Description</label>
                                <textarea name="description" class="form-control form-control-sm" rows="2"><?= e($c['description']) ?></textarea>
                              </div>
                              <div class="col-12">
                                <label class="form-label fw-bold fs-12">Feature Checklist Bullets (One per line)</label>
                                <textarea name="highlights" class="form-control form-control-sm" rows="4"><?= is_array($hlArr) ? e(implode("\n", $hlArr)) : e($c['features']) ?></textarea>
                                <div class="form-text fs-11">Type each checkmark bullet point on a new line.</div>
                              </div>
                              <div class="col-md-4">
                                <label class="form-label fw-bold fs-12">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control form-control-sm" value="<?= (int)$c['sort_order'] ?>">
                              </div>
                              <div class="col-md-4">
                                <label class="form-label fw-bold fs-12">Status</label>
                                <select name="is_active" class="form-select form-select-sm">
                                  <option value="1" <?= !empty($c['is_active']) ? 'selected' : '' ?>>Active (Visible)</option>
                                  <option value="0" <?= empty($c['is_active']) ? 'selected' : '' ?>>Hidden (Draft)</option>
                                </select>
                              </div>
                              <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-sm w-100 fw-bold">
                                  <i class="bi bi-check-circle me-1"></i> Update Card
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN: ADD NEW CARD FORM WITH VISUAL PICKER -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm border-top border-4 border-success sticky-top" style="top:20px;">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0 text-dark">
              <i class="bi bi-plus-circle-fill text-success me-2"></i>Add New Feature Card
            </h5>
          </div>
          <div class="card-body p-4">
            <form action="<?= admin_url('pages/save-item') ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="page_id" value="<?= (int)$page['id'] ?>">
              <input type="hidden" name="item_id" value="0">
              <input type="hidden" name="section" value="page_features">
              <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

              <div class="mb-3">
                <label class="form-label fw-bold fs-12">Card Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. RFID Tray Scanning">
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold fs-12">Category / Tag</label>
                <select name="category" class="form-select form-select-sm">
                  <option value="Retail POS">Retail POS & Showroom</option>
                  <option value="Finance & Schemes">Finance & Schemes (Girvi / Kitty)</option>
                  <option value="Manufacturing">Manufacturing & Karigar</option>
                  <option value="Accounting & Tax">Accounting & GST Tax</option>
                  <option value="Smart Hardware">Smart Hardware & RFID</option>
                  <option value="B2B Wholesale">B2B Wholesale & Bullion</option>
                  <option value="CRM & Retention">CRM & Loyalty Program</option>
                  <option value="Omnichannel">Omnichannel & Mobile App</option>
                  <option value="Enterprise Control">Enterprise Control</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold fs-12">Choose Visual Icon</label>
                <select name="icon" class="form-select form-select-sm mb-2" id="addCardIconSelect">
                  <?php foreach ($presetIcons as $iClass => $iLabel): ?>
                    <option value="<?= e($iClass) ?>"><?= e($iLabel) ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="form-text fs-11">Aap drop-down list se koi bhi visual icon select kar sakte hain.</div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold fs-12">Card Description</label>
                <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Feature ka short summary likhein..."></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold fs-12">Checklist Highlights (1 per line)</label>
                <textarea name="highlights" class="form-control form-control-sm" rows="4" placeholder="Point 1&#10;Point 2&#10;Point 3"></textarea>
                <div class="form-text fs-11">Har line me 1 checkmark point likhein.</div>
              </div>

              <div class="d-grid gap-2 pt-2">
                <button type="submit" class="btn btn-success fw-bold">
                  <i class="bi bi-plus-lg me-1"></i> Add Feature Card
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  <!-- ══════════════════════════════════════════════════════
       TAB 3: HARDWARE CARDS CRUD
       ══════════════════════════════════════════════════════ -->
  <?php elseif (($template === 'features' || $slug === 'features') && $subtab === 'hardware'): ?>
    
    <div class="row g-4 mb-4">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0 text-dark">
              <i class="bi bi-cpu-fill text-primary me-2"></i>Hardware Ecosystem Cards (<?= count($hardwareList) ?>)
            </h5>
          </div>
          <div class="card-body p-4">
            <?php foreach ($hardwareList as $h): ?>
              <form action="<?= admin_url('pages/save-item') ?>" method="POST" class="border rounded p-3 mb-3 bg-light">
                <input type="hidden" name="page_id" value="<?= (int)$page['id'] ?>">
                <input type="hidden" name="item_id" value="<?= (int)$h['id'] ?>">
                <input type="hidden" name="section" value="page_hardware">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

                <div class="row g-3 align-items-center">
                  <div class="col-md-5">
                    <label class="form-label fw-bold fs-12">Hardware Device Title</label>
                    <input type="text" name="title" class="form-control form-control-sm" value="<?= e($h['title']) ?>" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fw-bold fs-12">Bootstrap Icon</label>
                    <input type="text" name="icon" class="form-control form-control-sm" value="<?= e($h['icon']) ?>">
                  </div>
                  <div class="col-md-3 text-end">
                    <button type="submit" class="btn btn-primary btn-sm fw-bold mt-4">
                      <i class="bi bi-check2"></i> Save
                    </button>
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-12">Description</label>
                    <textarea name="description" class="form-control form-control-sm" rows="2"><?= e($h['description']) ?></textarea>
                  </div>
                </div>
              </form>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>


  <!-- ══════════════════════════════════════════════════════
       TAB 1 / DEFAULT: SECTION-BY-SECTION & IMAGES FORM
       ══════════════════════════════════════════════════════ -->
  <?php else: ?>

    <form action="<?= admin_url('pages/edit') ?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= (int)$page['id'] ?>">
      <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

      <div class="row g-4">

        <!-- LEFT COLUMN: SECTION-BY-SECTION EDITORS (8 COLS) -->
        <div class="col-lg-8">

          <!-- ══════════════════════════════════════════════════════
               FEATURES & CAPABILITIES PAGE SECTION EDITOR
               ══════════════════════════════════════════════════════ -->
          <?php if ($template === 'features' || $slug === 'features'): ?>
            
            <!-- SECTION 1: Features Hero Banner -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <h5 class="card-title fw-bold mb-0 text-dark">
                  <i class="bi bi-display text-primary me-2"></i>1. Hero Banner Section
                </h5>
                <span class="badge bg-light text-secondary border">Top Section</span>
              </div>
              <div class="card-body p-4">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label fw-bold fs-13">Eyebrow Badge Text</label>
                    <input type="text" name="feat_hero_label" class="form-control" value="<?= e(setting('feat_hero_label', 'Comprehensive ERP Capabilities')) ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold fs-13">Primary Button Text</label>
                    <input type="text" name="feat_hero_btn" class="form-control" value="<?= e(setting('feat_hero_btn', 'Explore Modules')) ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Main Hero Headline</label>
                    <input type="text" name="feat_hero_title" class="form-control form-control-lg" value="<?= e(setting('feat_hero_title', 'Engineered exclusively for jewellery businesses.')) ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Hero Description Paragraph</label>
                    <textarea name="feat_hero_desc" class="form-control" rows="3"><?= e(setting('feat_hero_desc', 'From retail POS billing with real-time gold rates to workshop job cards and multi-branch inventory tracking, GoldMatrix ERP provides a complete, unified operational foundation.')) ?></textarea>
                  </div>
                </div>
              </div>
            </div>

            <!-- SECTION 2: Spotlight Software Feature & Mockup Image -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <h5 class="card-title fw-bold mb-0 text-dark">
                  <i class="bi bi-laptop text-primary me-2"></i>2. Hardware & POS Spotlight (Image & Description)
                </h5>
                <span class="badge bg-light text-secondary border">Image Section</span>
              </div>
              <div class="card-body p-4">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label fw-bold fs-13">Spotlight Eyebrow Badge</label>
                    <input type="text" name="feat_spotlight_badge" class="form-control" value="<?= e(setting('feat_spotlight_badge', 'BIS HALLMARKING & TRACEABILITY')) ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold fs-13">Spotlight Headline</label>
                    <input type="text" name="feat_spotlight_title" class="form-control" value="<?= e(setting('feat_spotlight_title', '1-Click BIS Hallmark HUID & Barcode Tracking')) ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Spotlight Description</label>
                    <textarea name="feat_spotlight_desc" class="form-control" rows="3"><?= e(setting('feat_spotlight_desc', 'Complete traceability from raw gold bar receipt to finished showcase tag. Scan 6-digit HUID codes, calculate purity, gross, and net weights in seconds, and eliminate counter billing mistakes.')) ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Spotlight Software Mockup Image</label>
                    <div class="d-flex align-items-center gap-3">
                      <?php $currentImg = setting('feat_spotlight_img', '/assets/images/why-goldmatrix-mockup.png'); ?>
                      <?php if (!empty($currentImg)): ?>
                        <img src="<?= e($currentImg) ?>" alt="Preview" class="rounded border p-1 bg-light" style="height:70px;width:auto;object-fit:contain;">
                      <?php endif; ?>
                      <div class="flex-grow-1">
                        <input type="file" name="feat_spotlight_img_file" class="form-control" accept="image/*">
                        <div class="form-text fs-11">Upload new screenshot image (PNG, JPG, WebP) or leave empty to keep current.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- SECTION 3: CTA Conversion Banner -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0 text-dark">
                  <i class="bi bi-megaphone-fill text-primary me-2"></i>3. Conversion Banner (Bottom CTA)
                </h5>
              </div>
              <div class="card-body p-4">
                <div class="row g-3">
                  <div class="col-md-7">
                    <label class="form-label fw-bold fs-13">CTA Heading</label>
                    <input type="text" name="feat_cta_title" class="form-control" value="<?= e(setting('feat_cta_title', 'Ready to scale your jewellery business?')) ?>">
                  </div>
                  <div class="col-md-5">
                    <label class="form-label fw-bold fs-13">Button 1 Text & Link</label>
                    <input type="text" name="feat_cta_btn1" class="form-control" value="<?= e(setting('feat_cta_btn1', 'Schedule a Free Demo')) ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">CTA Subtitle</label>
                    <input type="text" name="feat_cta_desc" class="form-control" value="<?= e(setting('feat_cta_desc', 'Join 1,200+ top jewellery retailers and manufacturers who trust GoldMatrix ERP for precision management.')) ?>">
                  </div>
                </div>
              </div>
            </div>


          <!-- ══════════════════════════════════════════════════════
               ABOUT US PAGE SECTION EDITOR
               ══════════════════════════════════════════════════════ -->
          <?php elseif ($template === 'about' || $slug === 'about'): ?>
            
            <!-- SECTION 1: About Hero Banner & Image -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0 text-dark">
                  <i class="bi bi-building text-primary me-2"></i>1. About Us Hero Section & Hero Image
                </h5>
              </div>
              <div class="card-body p-4">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label fw-bold fs-13">Eyebrow Badge</label>
                    <input type="text" name="about_hero_badge" class="form-control" value="<?= e(setting('about_hero_badge', 'THE JEWELLERY TECH SPECIALISTS')) ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold fs-13">Founded Tagline</label>
                    <input type="text" name="about_hero_tag" class="form-control" value="<?= e(setting('about_hero_tag', 'Founded in 2011 &bull; UAE & India')) ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Main Heading</label>
                    <input type="text" name="about_hero_title" class="form-control form-control-lg" value="<?= e(setting('about_hero_title', 'Precision Engineering for the Global Jewellery Industry')) ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Hero Subtitle</label>
                    <textarea name="about_hero_desc" class="form-control" rows="3"><?= e(setting('about_hero_desc', 'Since 2010, GoldMatrix has built software engineered exclusively for precious jewellery retailers, manufacturers, and bullion wholesalers — eliminating metal leakage and driving multi-branch scalability.')) ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Hero Architecture Mockup Image</label>
                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded border">
                      <?php $currentHeroImg = setting('about_hero_img', '/assets/images/why-goldmatrix-mockup.png'); ?>
                      <img src="<?= e($currentHeroImg) ?>" alt="Hero Preview" class="rounded border p-1 bg-white" style="height:70px;width:auto;object-fit:contain;">
                      <div class="flex-grow-1">
                        <input type="file" name="about_hero_img_file" class="form-control form-control-sm" accept="image/*">
                        <div class="form-text fs-11">Upload new hero banner screenshot (PNG, JPG, WebP) or leave empty to keep current.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- SECTION 2: 4 Metric Counters -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0 text-dark">
                  <i class="bi bi-graph-up-arrow text-primary me-2"></i>2. Four Growth Metric Counters
                </h5>
              </div>
              <div class="card-body p-4">
                <div class="row g-3">
                  <div class="col-md-3 col-6">
                    <label class="form-label fw-bold fs-12">Stat 1 Value</label>
                    <input type="text" name="about_stat_1_val" class="form-control" value="<?= e(setting('about_stat_1_val', '1,200+')) ?>">
                    <input type="text" name="about_stat_1_lbl" class="form-control form-control-sm mt-1" value="<?= e(setting('about_stat_1_lbl', 'Jewellery Stores & Factories Powered')) ?>">
                  </div>
                  <div class="col-md-3 col-6">
                    <label class="form-label fw-bold fs-12">Stat 2 Value</label>
                    <input type="text" name="about_stat_2_val" class="form-control" value="<?= e(setting('about_stat_2_val', '15+ Yrs')) ?>">
                    <input type="text" name="about_stat_2_lbl" class="form-control form-control-sm mt-1" value="<?= e(setting('about_stat_2_lbl', 'Years of Jewellery Domain Innovation')) ?>">
                  </div>
                  <div class="col-md-3 col-6">
                    <label class="form-label fw-bold fs-12">Stat 3 Value</label>
                    <input type="text" name="about_stat_3_val" class="form-control" value="<?= e(setting('about_stat_3_val', '4 Countries')) ?>">
                    <input type="text" name="about_stat_3_lbl" class="form-control form-control-sm mt-1" value="<?= e(setting('about_stat_3_lbl', 'Global Presence')) ?>">
                  </div>
                  <div class="col-md-3 col-6">
                    <label class="form-label fw-bold fs-12">Stat 4 Value</label>
                    <input type="text" name="about_stat_4_val" class="form-control" value="<?= e(setting('about_stat_4_val', '99.9%')) ?>">
                    <input type="text" name="about_stat_4_lbl" class="form-control form-control-sm mt-1" value="<?= e(setting('about_stat_4_lbl', 'System Uptime Record')) ?>">
                  </div>
                </div>
              </div>
            </div>

            <!-- SECTION 3: Company Story & Story Image (Who We Are) -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0 text-dark">
                  <i class="bi bi-book-half text-primary me-2"></i>3. "Who We Are" Story & Craftsmanship Image
                </h5>
              </div>
              <div class="card-body p-4">
                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Story Heading</label>
                    <input type="text" name="about_story_h2" class="form-control" value="<?= e(setting('about_story_h2', 'Born in the Heart of the Jewellery Industry')) ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Story Paragraph 1</label>
                    <textarea name="about_story_p1" class="form-control" rows="3"><?= e(setting('about_story_p1', 'Generic ERPs fall short in the jewellery sector because precious metals require milligram-level weight accounting, real-time board rate calculations, karigar wastage loss formulas, and strict hallmarking compliance.')) ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Story Paragraph 2</label>
                    <textarea name="about_story_p2" class="form-control" rows="3"><?= e(setting('about_story_p2', 'GoldMatrix was created by pairing veteran software architects with bullion and retail jewellery masters. Today, we power single-counter showrooms and 50+ branch enterprises across the UAE, India, Hong Kong, Southeast Asia, and North America.')) ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">"Who We Are" Image (Right Side Box)</label>
                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded border">
                      <?php 
                      $currentStoryImg = setting('about_story_img');
                      $displayImg = !empty($currentStoryImg) ? $currentStoryImg : '/assets/images/craftsmanship.svg';
                      ?>
                      <img src="<?= e($displayImg) ?>" alt="Story Preview" class="rounded border p-1 bg-white" style="height:70px;width:auto;object-fit:contain;">
                      <div class="flex-grow-1">
                        <input type="file" name="about_story_img_file" class="form-control form-control-sm" accept="image/*">
                        <div class="form-text fs-11">Upload new image for "Born in the Heart of the Jewellery Industry" section (PNG, JPG, SVG, WebP).</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          <!-- ══════════════════════════════════════════════════════
               CONTACT US PAGE SECTION EDITOR
               ══════════════════════════════════════════════════════ -->
          <?php elseif ($template === 'contact' || $slug === 'contact'): ?>
            
            <!-- SECTION 1: Contact Hero -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0 text-dark">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>1. Contact Hero Banner
                </h5>
              </div>
              <div class="card-body p-4">
                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Hero Eyebrow Badge</label>
                    <input type="text" name="contact_hero_badge" class="form-control" value="<?= e(setting('contact_hero_badge', 'Direct Support & Consultation')) ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Hero Main Title</label>
                    <input type="text" name="contact_hero_title" class="form-control form-control-lg" value="<?= e(setting('contact_hero_title', 'We are here to help scale your jewellery business.')) ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold fs-13">Hero Subtitle</label>
                    <textarea name="contact_hero_desc" class="form-control" rows="3"><?= e(setting('contact_hero_desc', 'Connect with our senior jewellery industry solution consultants in UAE and India for tailored demonstrations, custom migration assessments, and pricing details.')) ?></textarea>
                  </div>
                </div>
              </div>
            </div>

            <!-- SECTION 2: Dual Office Locations -->
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0 text-dark">
                  <i class="bi bi-geo-alt-fill text-primary me-2"></i>2. Dual Office Details (UAE & India)
                </h5>
              </div>
              <div class="card-body p-4">
                <div class="row g-4">
                  
                  <!-- UAE Headquarter -->
                  <div class="col-md-6 border-end">
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-building me-1"></i> Headquarter — UAE</h6>
                    <div class="mb-3">
                      <label class="form-label fw-bold fs-12">UAE Address</label>
                      <textarea name="contact_uae_address" class="form-control" rows="2"><?= e(setting('contact_uae_address', "Shop No. 25/A, Central Gold Souq Block No. 8, Al Majaz -1 King Faisal Road - Sharjah, UAE")) ?></textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label fw-bold fs-12">UAE Phone</label>
                      <input type="text" name="contact_uae_phone" class="form-control" value="<?= e(setting('contact_uae_phone', '+971 56 324 0319')) ?>">
                    </div>
                    <div class="mb-3">
                      <label class="form-label fw-bold fs-12">UAE Email</label>
                      <input type="email" name="contact_uae_email" class="form-control" value="<?= e(setting('contact_uae_email', 'info@goldmatrixsoftware.com')) ?>">
                    </div>
                  </div>

                  <!-- India Operations -->
                  <div class="col-md-6">
                    <h6 class="fw-bold text-success mb-3"><i class="bi bi-building me-1"></i> Operations — India</h6>
                    <div class="mb-3">
                      <label class="form-label fw-bold fs-12">India Address</label>
                      <textarea name="contact_india_address" class="form-control" rows="2"><?= e(setting('contact_india_address', "01/A, Hingna Rd, M.I.D.C, Nagpur, Maharashtra - 440022, India")) ?></textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label fw-bold fs-12">India Phone</label>
                      <input type="text" name="contact_india_phone" class="form-control" value="<?= e(setting('contact_india_phone', '+91 92703 69937')) ?>">
                    </div>
                    <div class="mb-3">
                      <label class="form-label fw-bold fs-12">India Email</label>
                      <input type="email" name="contact_india_email" class="form-control" value="<?= e(setting('contact_india_email', 'goldmatrixsoftware@gmail.com')) ?>">
                    </div>
                  </div>

                </div>
              </div>
            </div>


          <!-- ══════════════════════════════════════════════════════
               DEFAULT CMS / CUSTOM PAGES SECTION EDITOR
               ══════════════════════════════════════════════════════ -->
          <?php else: ?>
            
            <div class="card border-0 shadow-sm mb-4">
              <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold mb-0 text-dark">
                  <i class="bi bi-card-heading text-primary me-2"></i>Page Content & Information
                </h5>
              </div>
              <div class="card-body p-4">
                
                <div class="mb-3">
                  <label class="form-label fw-bold text-dark">Page Heading / Title <span class="text-danger">*</span></label>
                  <input type="text" name="title" class="form-control form-control-lg" value="<?= e($page['title']) ?>" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold text-dark">Hero Subtitle / Tagline</label>
                  <textarea name="subtitle" class="form-control" rows="2"><?= e($page['subtitle'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold text-dark">Main Body Content</label>
                  <textarea name="content" class="form-control" rows="12"><?= e($page['content'] ?? '') ?></textarea>
                </div>

              </div>
            </div>

          <?php endif; ?>

          <!-- COMMON CARD: Search Engine Optimization (SEO) -->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
              <h5 class="card-title fw-bold mb-0 text-dark">
                <i class="bi bi-google text-primary me-2"></i>Search Engine Optimization (SEO)
              </h5>
            </div>
            <div class="card-body p-4">
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label fw-bold text-dark">SEO Meta Title</label>
                  <input type="text" name="meta_title" class="form-control" value="<?= e($page['meta_title'] ?? '') ?>">
                </div>
                <div class="col-12">
                  <label class="form-label fw-bold text-dark">SEO Meta Description</label>
                  <textarea name="meta_description" class="form-control" rows="3"><?= e($page['meta_description'] ?? '') ?></textarea>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- RIGHT COLUMN: SETTINGS & PUBLISHING (4 COLS) -->
        <div class="col-lg-4">
          
          <div class="card border-0 shadow-sm mb-4 border-top border-4 border-primary sticky-top" style="top:20px; z-index:10;">
            <div class="card-header bg-white py-3">
              <h5 class="card-title fw-bold mb-0 text-dark">
                <i class="bi bi-cloud-arrow-up-fill text-primary me-2"></i>Publishing Actions
              </h5>
            </div>
            <div class="card-body p-4">
              
              <div class="mb-3">
                <label class="form-label fw-bold text-dark">Status</label>
                <select name="status" class="form-select">
                  <option value="published" <?= ($page['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Published (Live on Website)</option>
                  <option value="draft" <?= ($page['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft (Hidden)</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold text-dark">URL Slug / Path <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light">/</span>
                  <input type="text" name="slug" class="form-control" value="<?= ltrim(e($page['slug']), '/') ?>" required>
                </div>
              </div>

              <div class="mb-4">
                <label class="form-label fw-bold text-dark">Page Layout Template</label>
                <select name="template" class="form-select">
                  <option value="features" <?= ($page['template'] ?? '') === 'features' ? 'selected' : '' ?>>Features & Capabilities</option>
                  <option value="about" <?= ($page['template'] ?? '') === 'about' ? 'selected' : '' ?>>About Us & Story</option>
                  <option value="contact" <?= ($page['template'] ?? '') === 'contact' ? 'selected' : '' ?>>Contact & Consultation</option>
                  <option value="services" <?= ($page['template'] ?? '') === 'services' ? 'selected' : '' ?>>Services & Modules Hub</option>
                  <option value="default" <?= ($page['template'] ?? 'default') === 'default' ? 'selected' : '' ?>>Default Template</option>
                </select>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg fw-bold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm">
                  <i class="bi bi-check2-circle fs-5"></i>
                  <span>Save & Sync Changes</span>
                </button>
              </div>

            </div>
          </div>

        </div>

      </div>
    </form>

  <?php endif; ?>

</div>
