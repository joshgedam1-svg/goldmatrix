<?php
/**
 * GoldMatrix ERP - Pages Manager
 * views/admin/pages/index.php
 */
?>

<!-- PAGE HEADER -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 pb-2 border-bottom">
  <div>
    <h4 class="fw-bold text-dark mb-1" style="font-size: 1.15rem;"><i class="bi bi-file-earmark-text text-secondary me-2"></i>Website Pages</h4>
    <p class="text-muted fs-12 mb-0">Manage and edit all frontend website pages and modular content.</p>
  </div>
  <div class="d-flex align-items-center gap-2">
    <a href="<?= admin_url('pages/create') ?>" class="btn btn-navy btn-sm px-3 py-1">
      <i class="bi bi-plus-circle-fill me-1"></i> Add New Page
    </a>
    <a href="<?= site_url('/') ?>" target="_blank" class="btn btn-outline-secondary btn-sm px-3 py-1">
      <i class="bi bi-box-arrow-up-right me-1"></i> Live Website
    </a>
  </div>
</div>

<!-- PAGES TABLE CARD -->
<div class="card border-0 shadow-sm rounded-3">
  <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between">
    <h6 class="fw-bold mb-0 text-dark fs-13">All Pages (<?= count($pages) ?>)</h6>
    <span class="badge bg-success-subtle text-success border border-success-subtle fs-11">Active CMS Pages</span>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0 fs-13">
        <thead style="background-color: #FAFBFC; border-bottom: 1px solid #F1F5F9;">
          <tr style="color: #475569; font-size: 12px; text-transform: uppercase; letter-spacing: 0.3px;">
            <th style="width: 50px; padding: 10px 16px;" class="fw-bold">#</th>
            <th style="padding: 10px 14px;" class="fw-bold">Page Title</th>
            <th style="padding: 10px 14px;" class="fw-bold">URL Route</th>
            <th style="padding: 10px 14px;" class="fw-bold">Template</th>
            <th style="padding: 10px 14px;" class="fw-bold">Status</th>
            <th style="padding: 10px 16px; width: 140px;" class="fw-bold text-end">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $idx = 1; foreach ($pages as $p): ?>
            <tr>
              <td style="padding: 10px 16px; color: #64748B;" class="fw-medium"><?= $idx++ ?></td>
              <td style="padding: 10px 14px;">
                <div class="d-flex align-items-center gap-2">
                  <div class="d-inline-flex align-items-center justify-content-center text-primary" style="width: 24px; height: 24px;">
                    <i class="bi <?= !empty($p['is_home']) ? 'bi-house-door-fill text-warning' : 'bi-file-earmark-richtext text-primary' ?> fs-6"></i>
                  </div>
                  <span class="fw-semibold text-dark fs-13"><?= e($p['title']) ?></span>
                </div>
              </td>
              <td style="padding: 10px 14px;">
                <code class="text-primary bg-light px-2 py-0 rounded fs-12 border"><?= e($p['slug']) ?></code>
              </td>
              <td style="padding: 10px 14px;">
                <span class="badge bg-light text-secondary border fs-11"><?= e($p['template']) ?></span>
              </td>
              <td style="padding: 10px 14px;">
                <span class="badge bg-<?= ($p['status'] ?? 'published') === 'published' ? 'success' : 'warning' ?>-subtle text-<?= ($p['status'] ?? 'published') === 'published' ? 'success' : 'dark' ?> border border-<?= ($p['status'] ?? 'published') === 'published' ? 'success' : 'warning' ?>-subtle fs-11">
                  <i class="bi bi-check-circle-fill me-1"></i> <?= ucfirst(e($p['status'] ?? 'published')) ?>
                </span>
              </td>
              <td style="padding: 10px 16px;" class="text-end">
                <div class="d-inline-flex align-items-center gap-1">
                  <a href="<?= e($p['edit_url']) ?>" class="btn btn-sm btn-navy px-2 py-1 fs-12" title="Edit Content">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                  </a>
                  <a href="<?= e($p['live_url']) ?>" target="_blank" class="btn btn-sm btn-light border px-2 py-1 text-secondary fs-12" title="View Live">
                    <i class="bi bi-box-arrow-up-right"></i>
                  </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
