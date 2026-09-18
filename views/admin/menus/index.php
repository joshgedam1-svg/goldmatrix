<?php
/**
 * Navigation & Menus Manager - Professional Enterprise UI
 * Location: views/admin/menus/index.php
 */
$pageTitle = 'Menus & Navigation';
?>

<style>
/* ══════════════════════════════════════
   EXECUTIVE MENUS & NAVIGATION STYLES
══════════════════════════════════════ */
.menu-nav-tabs {
  background: #FFFFFF;
  border-radius: 8px;
  padding: 4px;
  box-shadow: 0 1px 3px rgba(0, 21, 64, 0.02);
  border: 1px solid #E2E8F0;
  display: flex;
  flex-wrap: wrap;
  gap: 4px;
}
.menu-nav-tab {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 500;
  color: #475569;
  text-decoration: none;
  transition: all 0.15s ease;
  border: 1px solid transparent;
}
.menu-nav-tab:hover {
  background: #F8FAFC;
  color: #001540;
}
.menu-nav-tab.active {
  background: #001540;
  color: #FFFFFF;
  font-weight: 600;
  box-shadow: 0 2px 6px rgba(0, 21, 64, 0.15);
}
.menu-nav-tab.active .badge-count {
  background: #DC9423 !important;
  color: #001540 !important;
}
.badge-count {
  font-size: 11px;
  padding: 2px 7px;
  border-radius: 12px;
  background: #F1F5F9;
  color: #64748B;
  font-weight: 700;
}

/* Add Item Cards & Tabs */
.builder-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  box-shadow: 0 4px 16px rgba(0, 21, 64, 0.03);
  overflow: hidden;
}
.builder-card-header {
  padding: 16px 20px;
  background: #FFFFFF;
  border-bottom: 1px solid #F1F5F9;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.builder-nav-pills {
  display: flex;
  gap: 4px;
  padding: 4px;
  background: #F1F5F9;
  border-radius: 8px;
}
.builder-nav-pill {
  flex: 1;
  text-align: center;
  padding: 6px 12px;
  font-size: 12.5px;
  font-weight: 600;
  color: #64748B;
  border-radius: 6px;
  border: none;
  background: transparent;
  transition: all 0.15s ease;
  text-decoration: none;
}
.builder-nav-pill.active {
  background: #FFFFFF;
  color: #001540;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
}

/* Quick Anchor Chips */
.anchor-chip {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 5px 10px;
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 6px;
  font-size: 12px;
  font-weight: 500;
  color: #334155;
  cursor: pointer;
  transition: all 0.18s ease;
}
.anchor-chip:hover {
  background: #FEF3C7;
  border-color: #F59E0B;
  color: #92400E;
  transform: translateY(-1px);
}

/* Menu Tree Item Row */
.menu-card-item {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 12px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  transition: all 0.2s ease;
  position: relative;
}
.menu-card-item:hover {
  border-color: #CBD5E1;
  box-shadow: 0 4px 14px rgba(0, 21, 64, 0.05);
}
.menu-card-item.is-parent {
  border-left: 4px solid #001540;
}
.menu-card-item.is-child {
  border-left: 4px solid #DC9423;
  background: #FBFDFE;
}
.menu-card-item.is-inactive {
  opacity: 0.55;
  background: #F8FAFC;
}
.menu-drag-handle {
  color: #94A3B8;
  font-size: 18px;
  cursor: grab;
  padding: 2px;
  display: flex;
  align-items: center;
}
.menu-item-title {
  font-weight: 700;
  font-size: 14px;
  color: #001540;
  display: flex;
  align-items: center;
  gap: 8px;
}
.menu-item-url {
  font-size: 12px;
  color: #64748B;
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
  background: #F1F5F9;
  padding: 1px 7px;
  border-radius: 4px;
  display: inline-block;
  margin-top: 3px;
}

/* Action Icon Buttons */
.action-btn-group {
  display: flex;
  align-items: center;
  gap: 4px;
}
.action-btn {
  width: 32px;
  height: 32px;
  border-radius: 6px;
  border: 1px solid #E2E8F0;
  background: #FFFFFF;
  color: #475569;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  transition: all 0.15s ease;
  cursor: pointer;
  padding: 0;
}
.action-btn:hover {
  background: #F8FAFC;
  color: #001540;
  border-color: #CBD5E1;
}
.action-btn.btn-active-toggle {
  color: #10B981;
}
.action-btn.btn-active-toggle.is-off {
  color: #94A3B8;
}
.action-btn.btn-edit:hover {
  background: #EFF6FF;
  color: #2563EB;
  border-color: #BFDBFE;
}
.action-btn.btn-delete:hover {
  background: #FEF2F2;
  color: #DC2626;
  border-color: #FECACA;
}

/* Submenu Connectors */
.submenu-container {
  margin-left: 28px;
  padding-left: 16px;
  border-left: 2px dashed #CBD5E1;
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-top: 8px;
}
</style>

<div class="container-fluid px-0">

  <!-- TOP TITLE & HEADER BAR -->
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center gap-3">
      <div class="p-3 bg-primary-subtle text-primary rounded-3">
        <i class="bi bi-menu-button-wide-fill fs-3"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2">
          <h2 class="h4 fw-bold text-dark mb-0">Menus & Navigation Manager</h2>
          <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Live Sync</span>
        </div>
        <p class="text-muted small mb-0 mt-1">Easily customize, reorder, and structure your website's navigation menus and footer link columns.</p>
      </div>
    </div>

    <!-- Quick Preview / Home Link -->
    <div class="d-flex align-items-center gap-2">
      <a href="/" target="_blank" class="btn btn-outline-secondary btn-sm px-3 fw-semibold">
        <i class="bi bi-box-arrow-up-right me-1"></i> Preview Website
      </a>
    </div>
  </div>

  <!-- MENU LOCATION SELECTOR TABS -->
  <div class="mb-4">
    <div class="menu-nav-tabs">
      <?php foreach ($locationsMeta as $locKey => $locInfo): ?>
        <a class="menu-nav-tab <?= $location === $locKey ? 'active' : '' ?>" href="/admin/navigation?location=<?= urlencode($locKey) ?>">
          <i class="bi <?= $locInfo['icon'] ?>"></i>
          <span><?= $locInfo['label'] ?></span>
          <span class="badge-count"><?= $counts[$locKey] ?? 0 ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- MAIN 2-COLUMN BUILDER -->
  <div class="row g-4">

    <!-- LEFT COLUMN: ADD MENU ITEMS CARD -->
    <div class="col-lg-4">
      <div class="sticky-top" style="top: 20px; z-index: 10;">
        
        <div class="builder-card">
          <div class="builder-card-header">
            <h6 class="fw-bold text-dark mb-0"><i class="bi bi-plus-circle-fill text-primary me-2"></i>Add Menu Items</h6>
          </div>
          
          <div class="p-3">
            <!-- Nav Switcher for Add Forms -->
            <ul class="nav builder-nav-pills mb-3" id="addMenuTabs" role="tablist">
              <li class="nav-item flex-fill" role="presentation">
                <button class="builder-nav-pill active w-100" id="tab-custom-btn" data-bs-toggle="tab" data-bs-target="#tab-custom" type="button" role="tab">
                  <i class="bi bi-link-45deg me-1"></i> Custom Link
                </button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button class="builder-nav-pill w-100" id="tab-pages-btn" data-bs-toggle="tab" data-bs-target="#tab-pages" type="button" role="tab">
                  <i class="bi bi-file-earmark-text me-1"></i> Pages
                </button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button class="builder-nav-pill w-100" id="tab-anchors-btn" data-bs-toggle="tab" data-bs-target="#tab-anchors" type="button" role="tab">
                  <i class="bi bi-lightning-charge me-1"></i> Sections
                </button>
              </li>
            </ul>

            <div class="tab-content" id="addMenuTabContent">
              
              <!-- 1. CUSTOM LINK TAB -->
              <div class="tab-pane fade show active" id="tab-custom" role="tabpanel">
                <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>">
                  <?= csrf_field() ?>
                  <input type="hidden" name="action" value="add_item">
                  <input type="hidden" name="location" value="<?= e($location) ?>">

                  <div class="mb-3">
                    <label class="form-label fs-12 fw-semibold text-secondary mb-1">Navigation Label <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="customLinkTitle" class="form-control" placeholder="e.g. Products, About Us" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fs-12 fw-semibold text-secondary mb-1">URL / Link Target <span class="text-danger">*</span></label>
                    <input type="text" name="url" id="customLinkUrl" class="form-control" placeholder="e.g. /about, #solutions, https://..." required>
                  </div>

                  <?php if ($location === 'header' && !empty($parentCandidates)): ?>
                    <div class="mb-3">
                      <label class="form-label fs-12 fw-semibold text-secondary mb-1">Parent Item (For Dropdown Submenu)</label>
                      <select name="parent_id" class="form-select fs-13">
                        <option value="0">— None (Top-Level Menu) —</option>
                        <?php foreach ($parentCandidates as $p): ?>
                          <option value="<?= $p['id'] ?>">Dropdown under: <?= e($p['title']) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <?php endif; ?>

                  <div class="row g-2 mb-3">
                    <div class="col-6">
                      <label class="form-label fs-12 fw-semibold text-secondary mb-1">Open In</label>
                      <select name="target" class="form-select fs-13">
                        <option value="_self">Same Tab</option>
                        <option value="_blank">New Tab (↗)</option>
                      </select>
                    </div>
                    <div class="col-6">
                      <label class="form-label fs-12 fw-semibold text-secondary mb-1">Icon Class</label>
                      <input type="text" name="icon" class="form-control" placeholder="bi-star">
                    </div>
                  </div>

                  <button type="submit" class="btn btn-navy w-100 py-2 fw-semibold fs-13">
                    <i class="bi bi-plus-circle me-1"></i> Add to Menu
                  </button>
                </form>
              </div>

              <!-- 2. CMS PAGES TAB -->
              <div class="tab-pane fade" id="tab-pages" role="tabpanel">
                <?php if (empty($pages)): ?>
                  <div class="p-3 text-center text-muted bg-light rounded-3 fs-12">
                    <i class="bi bi-file-earmark-x fs-3 d-block mb-1 text-secondary"></i>
                    No published CMS pages found in database.
                  </div>
                <?php else: ?>
                  <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="add_from_pages">
                    <input type="hidden" name="location" value="<?= e($location) ?>">

                    <div class="mb-3 border rounded-3 p-2 bg-light overflow-auto" style="max-height: 200px;">
                      <?php foreach ($pages as $pg): ?>
                        <div class="form-check fs-13 py-1 border-bottom border-light">
                          <input class="form-check-input" type="checkbox" name="page_ids[]" value="<?= $pg['id'] ?>" id="page_<?= $pg['id'] ?>">
                          <label class="form-check-label text-dark fw-medium" for="page_<?= $pg['id'] ?>">
                            <?= e($pg['title']) ?>
                            <span class="text-muted fs-11 ms-1">(/<?= e($pg['slug']) ?>)</span>
                          </label>
                        </div>
                      <?php endforeach; ?>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2 fw-semibold fs-13">
                      <i class="bi bi-check-all me-1"></i> Add Selected Pages
                    </button>
                  </form>
                <?php endif; ?>
              </div>

              <!-- 3. SECTION ANCHORS TAB -->
              <div class="tab-pane fade" id="tab-anchors" role="tabpanel">
                <div class="mb-2 fs-12 text-muted">Click any section to quickly populate the Custom Link form:</div>
                <div class="d-flex flex-column gap-2 mb-3">
                  <div class="anchor-chip" onclick="applySectionAnchor('Solutions', '#solutions')">
                    <i class="bi bi-grid text-primary"></i> <strong>Solutions Section</strong> <code>#solutions</code>
                  </div>
                  <div class="anchor-chip" onclick="applySectionAnchor('ERP Modules', '#modules')">
                    <i class="bi bi-cpu text-primary"></i> <strong>ERP Modules</strong> <code>#modules</code>
                  </div>
                  <div class="anchor-chip" onclick="applySectionAnchor('Integrations', '#integrations')">
                    <i class="bi bi-puzzle text-primary"></i> <strong>Tools & Integrations</strong> <code>#integrations</code>
                  </div>
                  <div class="anchor-chip" onclick="applySectionAnchor('Global Reach', '#global-reach')">
                    <i class="bi bi-globe text-primary"></i> <strong>Global Presence Map</strong> <code>#global-reach</code>
                  </div>
                  <div class="anchor-chip" onclick="applySectionAnchor('Why GoldMatrix', '#why')">
                    <i class="bi bi-shield-check text-primary"></i> <strong>Why GoldMatrix</strong> <code>#why</code>
                  </div>
                  <div class="anchor-chip" onclick="applySectionAnchor('Customer Reviews', '#testimonials')">
                    <i class="bi bi-star text-primary"></i> <strong>Testimonials</strong> <code>#testimonials</code>
                  </div>
                  <div class="anchor-chip" onclick="applySectionAnchor('Book Free Demo', '#contact')">
                    <i class="bi bi-envelope text-primary"></i> <strong>Contact / Demo</strong> <code>#contact</code>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- RIGHT COLUMN: CURRENT MENU STRUCTURE -->
    <div class="col-lg-8">
      <div class="builder-card">
        
        <!-- Header Bar -->
        <div class="builder-card-header">
          <div>
            <h5 class="fw-bold text-dark mb-0 fs-15">
              <i class="bi <?= $locationsMeta[$location]['icon'] ?> text-primary me-2"></i>
              <?= $locationsMeta[$location]['label'] ?>
            </h5>
            <div class="text-muted fs-12 mt-1"><?= $locationsMeta[$location]['desc'] ?></div>
          </div>
          <span class="badge bg-light text-dark border px-3 py-2 fs-12 rounded-pill">
            <strong class="text-primary"><?= count($allItems) ?></strong> Total Items
          </span>
        </div>

        <!-- Menu Items List -->
        <div class="p-3 p-md-4">
          <?php if (empty($menuTree)): ?>
            <div class="text-center py-5">
              <i class="bi bi-list-nested fs-1 text-muted opacity-50 d-block mb-2"></i>
              <h6 class="fw-bold text-dark">No Menu Items Found</h6>
              <p class="fs-13 text-muted mb-0">Use the "Add Menu Items" tools on the left to add links or pages to this menu.</p>
            </div>
          <?php else: ?>
            <div class="d-flex flex-column gap-2">
              <?php foreach ($menuTree as $item): ?>
                
                <!-- TOP LEVEL PARENT ITEM -->
                <div class="menu-card-item is-parent <?= $item['is_active'] ? '' : 'is-inactive' ?>">
                  
                  <!-- Left Info -->
                  <div class="d-flex align-items-center gap-3">
                    <div class="menu-drag-handle" title="Sort Order">
                      <i class="bi bi-grip-vertical"></i>
                    </div>
                    <div>
                      <div class="menu-item-title">
                        <?php if (!empty($item['icon'])): ?>
                          <i class="bi <?= e($item['icon']) ?> text-warning"></i>
                        <?php endif; ?>
                        <span><?= e($item['title']) ?></span>
                        
                        <?php if (!empty($item['children'])): ?>
                          <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-10">Dropdown (<?= count($item['children']) ?>)</span>
                        <?php endif; ?>
                        <?php if ($item['target'] === '_blank'): ?>
                          <span class="badge bg-light text-secondary border fs-10">↗ New Tab</span>
                        <?php endif; ?>
                        <?php if (!$item['is_active']): ?>
                          <span class="badge bg-secondary-subtle text-secondary fs-10">Hidden</span>
                        <?php endif; ?>
                      </div>
                      <div class="menu-item-url">
                        <i class="bi bi-link-45deg"></i> <?= e($item['url']) ?>
                      </div>
                    </div>
                  </div>

                  <!-- Right Action Buttons -->
                  <div class="action-btn-group">
                    <!-- Move Up -->
                    <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="move_item">
                      <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                      <input type="hidden" name="direction" value="up">
                      <button type="submit" class="action-btn" title="Move Up"><i class="bi bi-arrow-up"></i></button>
                    </form>

                    <!-- Move Down -->
                    <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="move_item">
                      <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                      <input type="hidden" name="direction" value="down">
                      <button type="submit" class="action-btn" title="Move Down"><i class="bi bi-arrow-down"></i></button>
                    </form>

                    <!-- Toggle Visibility -->
                    <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="toggle_active">
                      <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                      <button type="submit" class="action-btn btn-active-toggle <?= $item['is_active'] ? '' : 'is-off' ?>" title="<?= $item['is_active'] ? 'Click to Hide' : 'Click to Show' ?>">
                        <i class="bi <?= $item['is_active'] ? 'bi-eye-fill' : 'bi-eye-slash' ?>"></i>
                      </button>
                    </form>

                    <!-- Edit Modal Trigger -->
                    <button type="button" class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editMenuModal<?= $item['id'] ?>" title="Edit Link">
                      <i class="bi bi-pencil-fill"></i>
                    </button>

                    <!-- Delete Button -->
                    <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>" onsubmit="return confirm('Delete this menu item?');" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="delete_item">
                      <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                      <button type="submit" class="action-btn btn-delete" title="Delete">
                        <i class="bi bi-trash3-fill"></i>
                      </button>
                    </form>
                  </div>
                </div>

                <!-- EDIT MODAL FOR PARENT -->
                <div class="modal fade" id="editMenuModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                      <div class="modal-header bg-light">
                        <h6 class="modal-title fw-bold text-dark"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Menu Item</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="update_item">
                        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">

                        <div class="modal-body p-4">
                          <div class="mb-3">
                            <label class="form-label fs-12 fw-semibold text-secondary">Navigation Label <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="<?= e($item['title']) ?>" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label fs-12 fw-semibold text-secondary">URL / Link Target <span class="text-danger">*</span></label>
                            <input type="text" name="url" class="form-control" value="<?= e($item['url']) ?>" required>
                          </div>
                          <div class="row g-2 mb-3">
                            <div class="col-6">
                              <label class="form-label fs-12 fw-semibold text-secondary">Target Window</label>
                              <select name="target" class="form-select fs-13">
                                <option value="_self" <?= $item['target'] === '_self' ? 'selected' : '' ?>>Same Tab (_self)</option>
                                <option value="_blank" <?= $item['target'] === '_blank' ? 'selected' : '' ?>>New Tab (_blank)</option>
                              </select>
                            </div>
                            <div class="col-6">
                              <label class="form-label fs-12 fw-semibold text-secondary">Icon Class</label>
                              <input type="text" name="icon" class="form-control" value="<?= e($item['icon']) ?>" placeholder="bi-star">
                            </div>
                          </div>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="act_<?= $item['id'] ?>" <?= $item['is_active'] ? 'checked' : '' ?>>
                            <label class="form-check-label fs-13 fw-semibold text-dark" for="act_<?= $item['id'] ?>">Item Visible on Website</label>
                          </div>
                        </div>
                        <div class="modal-footer bg-light">
                          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary btn-sm fw-bold px-3">Save Changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- NESTED SUBMENU ITEMS (IF ANY) -->
                <?php if (!empty($item['children'])): ?>
                  <div class="submenu-container">
                    <?php foreach ($item['children'] as $child): ?>
                      <div class="menu-card-item is-child <?= $child['is_active'] ? '' : 'is-inactive' ?>">
                        
                        <div class="d-flex align-items-center gap-2">
                          <i class="bi bi-arrow-return-right text-warning fs-5"></i>
                          <div>
                            <div class="menu-item-title">
                              <span><?= e($child['title']) ?></span>
                              <span class="badge bg-warning-subtle text-warning border border-warning-subtle fs-10">Submenu</span>
                              <?php if (!$child['is_active']): ?>
                                <span class="badge bg-secondary-subtle text-secondary fs-10">Hidden</span>
                              <?php endif; ?>
                            </div>
                            <div class="menu-item-url">
                              <i class="bi bi-link-45deg"></i> <?= e($child['url']) ?>
                            </div>
                          </div>
                        </div>

                        <!-- Child Actions -->
                        <div class="action-btn-group">
                          <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="toggle_active">
                            <input type="hidden" name="item_id" value="<?= $child['id'] ?>">
                            <button type="submit" class="action-btn btn-active-toggle <?= $child['is_active'] ? '' : 'is-off' ?>" title="Toggle Visibility">
                              <i class="bi <?= $child['is_active'] ? 'bi-eye-fill' : 'bi-eye-slash' ?>"></i>
                            </button>
                          </form>

                          <button type="button" class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editMenuModal<?= $child['id'] ?>" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                          </button>

                          <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>" onsubmit="return confirm('Delete submenu item?');" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="delete_item">
                            <input type="hidden" name="item_id" value="<?= $child['id'] ?>">
                            <button type="submit" class="action-btn btn-delete" title="Delete">
                              <i class="bi bi-trash3-fill"></i>
                            </button>
                          </form>
                        </div>
                      </div>

                      <!-- Edit Modal for Child -->
                      <div class="modal fade" id="editMenuModal<?= $child['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content border-0 shadow">
                            <div class="modal-header bg-light">
                              <h6 class="modal-title fw-bold text-dark"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Submenu Item</h6>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="/admin/navigation?location=<?= urlencode($location) ?>">
                              <?= csrf_field() ?>
                              <input type="hidden" name="action" value="update_item">
                              <input type="hidden" name="item_id" value="<?= $child['id'] ?>">

                              <div class="modal-body p-4">
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Navigation Label <span class="text-danger">*</span></label>
                                  <input type="text" name="title" class="form-control" value="<?= e($child['title']) ?>" required>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">URL / Link Target <span class="text-danger">*</span></label>
                                  <input type="text" name="url" class="form-control" value="<?= e($child['url']) ?>" required>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label fs-12 fw-semibold text-secondary">Parent Menu</label>
                                  <select name="parent_id" class="form-select fs-13">
                                    <option value="0">— None (Convert to Top Level) —</option>
                                    <?php foreach ($parentCandidates as $p): ?>
                                      <option value="<?= $p['id'] ?>" <?= $child['parent_id'] == $p['id'] ? 'selected' : '' ?>><?= e($p['title']) ?></option>
                                    <?php endforeach; ?>
                                  </select>
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
                  </div>
                <?php endif; ?>

              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>

  </div>

</div>

<script>
function applySectionAnchor(label, anchor) {
  // Switch to custom link tab
  const customTabTrigger = document.getElementById('tab-custom-btn');
  if (customTabTrigger && typeof bootstrap !== 'undefined') {
    const tab = new bootstrap.Tab(customTabTrigger);
    tab.show();
  }
  const titleInput = document.getElementById('customLinkTitle');
  const urlInput = document.getElementById('customLinkUrl');
  if (titleInput) titleInput.value = label;
  if (urlInput) urlInput.value = anchor;
}
</script>
