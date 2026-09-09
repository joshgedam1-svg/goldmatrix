<?php
/**
 * Features & Capability Pages Listing (Clean & Compact UI)
 * Location: views/admin/erp-modules/index.php
 */
$publishedCount = count(array_filter($modules, fn($m) => ($m['status'] ?? '') === 'published'));
$totSubs = 0;
$totFaqs = 0;
foreach ($modules as $m) {
    $subs = !empty($m['sub_features']) ? (is_array($m['sub_features']) ? $m['sub_features'] : json_decode($m['sub_features'], true)) : [];
    $faqs = !empty($m['faqs']) ? (is_array($m['faqs']) ? $m['faqs'] : json_decode($m['faqs'], true)) : [];
    $totSubs += is_array($subs) ? count($subs) : 0;
    $totFaqs += is_array($faqs) ? count($faqs) : 0;
}
?>

<div class="container-fluid px-0">

  <!-- COMPACT TOP BAR -->
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
    <div class="d-flex align-items-center gap-2.5">
      <div class="p-2 bg-primary-subtle text-primary rounded-2 d-flex align-items-center justify-content-center" style="width:36px; height:36px;">
        <i class="bi bi-stars fs-5"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2">
          <h1 class="h5 fw-bold text-dark mb-0">Feature Pages &amp; SEO</h1>
          <span class="badge bg-light text-secondary border fs-11 px-2 py-0.5"><?= count($modules) ?> Total</span>
        </div>
        <div class="text-muted fs-11">Manage all 10 feature cluster pages, H1/H2 headings, sub-feature cards, FAQs and Google SEO metadata.</div>
      </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
      <a href="<?= admin_url('features-settings') ?>" class="btn btn-warning text-dark btn-sm py-1 px-2.5 fs-12 fw-bold d-inline-flex align-items-center gap-1.5">
        <i class="bi bi-sliders2-vertical"></i>
        <span>Features Page Section Settings</span>
      </a>
      <a href="<?= site_url('features') ?>" target="_blank" class="btn btn-outline-secondary btn-sm py-1 px-2.5 fs-12 d-inline-flex align-items-center gap-1.5">
        <i class="bi bi-box-arrow-up-right"></i>
        <span>View Live /features</span>
      </a>
      <a href="<?= admin_url('features/create') ?>" class="btn btn-primary btn-sm py-1 px-3 fs-12 fw-semibold d-inline-flex align-items-center gap-1.5 shadow-sm">
        <i class="bi bi-plus-lg"></i>
        <span>Add Feature Page</span>
      </a>
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

  <!-- COMPACT METRICS BAR -->
  <div class="row g-2 mb-3">
    <div class="col-6 col-md-3">
      <div class="bg-white border rounded-2 p-2.5 px-3 d-flex align-items-center justify-content-between shadow-sm">
        <div>
          <div class="text-secondary fs-10 text-uppercase fw-bold">Features</div>
          <div class="fs-5 fw-bold text-dark lh-1 mt-1"><?= count($modules) ?></div>
        </div>
        <div class="text-primary fs-4 opacity-75">
          <i class="bi bi-grid-3x3-gap"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="bg-white border rounded-2 p-2.5 px-3 d-flex align-items-center justify-content-between shadow-sm">
        <div>
          <div class="text-secondary fs-10 text-uppercase fw-bold">Live SEO Pages</div>
          <div class="fs-5 fw-bold text-success lh-1 mt-1"><?= $publishedCount ?></div>
        </div>
        <div class="text-success fs-4 opacity-75">
          <i class="bi bi-check-circle"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="bg-white border rounded-2 p-2.5 px-3 d-flex align-items-center justify-content-between shadow-sm">
        <div>
          <div class="text-secondary fs-10 text-uppercase fw-bold">Sub-Feature Cards</div>
          <div class="fs-5 fw-bold text-dark lh-1 mt-1"><?= $totSubs ?></div>
        </div>
        <div class="text-warning fs-4 opacity-75">
          <i class="bi bi-card-checklist"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="bg-white border rounded-2 p-2.5 px-3 d-flex align-items-center justify-content-between shadow-sm">
        <div>
          <div class="text-secondary fs-10 text-uppercase fw-bold">Total FAQs</div>
          <div class="fs-5 fw-bold text-dark lh-1 mt-1"><?= $totFaqs ?></div>
        </div>
        <div class="text-info fs-4 opacity-75">
          <i class="bi bi-question-circle"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- COMPACT & CLEAN MODULES TABLE -->
  <div class="card border rounded-2 shadow-sm bg-white mb-4">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0 fs-12">
        <thead class="table-light text-secondary fs-11 text-uppercase border-bottom">
          <tr>
            <th class="ps-3 py-2.5 text-center" style="width:40px;">#</th>
            <th class="py-2.5 text-center" style="width:50px;">Icon</th>
            <th class="py-2.5" style="width:280px;">Feature Name &amp; URL</th>
            <th class="py-2.5">SEO H1 Heading &amp; Intro</th>
            <th class="py-2.5 text-center" style="width:130px;">Breakdown</th>
            <th class="py-2.5 text-center" style="width:85px;">Status</th>
            <th class="text-end pe-3 py-2.5" style="width:130px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($modules)): ?>
            <tr>
              <td colspan="7" class="text-center py-4 text-muted fs-12">
                No feature pages found. Click "+ Add Feature Page" to create one.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($modules as $idx => $m): 
              $subs = !empty($m['sub_features']) ? (is_array($m['sub_features']) ? $m['sub_features'] : json_decode($m['sub_features'], true)) : [];
              $faqs = !empty($m['faqs']) ? (is_array($m['faqs']) ? $m['faqs'] : json_decode($m['faqs'], true)) : [];
              $subCount = is_array($subs) ? count($subs) : 0;
              $faqCount = is_array($faqs) ? count($faqs) : 0;
              $liveUrl = site_url('features/' . $m['slug']);
            ?>
              <tr>
                <td class="ps-3 text-center fw-bold text-muted"><?= (int)($m['display_order'] ?? ($idx + 1)) ?></td>
                <td class="text-center">
                  <div class="rounded-2 bg-light border text-primary d-inline-flex align-items-center justify-content-center" style="width:34px; height:34px; font-size:16px;">
                    <i class="bi <?= e($m['icon'] ?: 'bi-stars') ?>"></i>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center flex-wrap gap-1 mb-1">
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle text-uppercase fw-bold" style="font-size:9.5px; letter-spacing:0.3px; padding: 2px 6px;">
                      <?= e($m['badge'] ?: 'FEATURE') ?>
                    </span>
                    <span class="text-secondary small" style="font-size:11px;">&bull; <?= e($m['category'] ?: 'ERP Core') ?></span>
                  </div>
                  <div class="fw-bold text-dark lh-sm mb-1" style="font-size:13.5px;">
                    <?= e($m['name']) ?>
                  </div>
                  <div>
                    <a href="<?= e($liveUrl) ?>" target="_blank" class="text-primary text-decoration-none font-monospace d-inline-flex align-items-center gap-1" style="font-size:11px;">
                      <span>/features/<?= e($m['slug']) ?></span>
                      <i class="bi bi-box-arrow-up-right" style="font-size:9.5px;"></i>
                    </a>
                  </div>
                </td>
                <td>
                  <div class="fw-semibold text-dark lh-sm mb-1" style="font-size:12.5px;">
                    <?= e($m['h1'] ?: $m['name']) ?>
                  </div>
                  <div class="text-muted" style="font-size:11.5px; line-height:1.45; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                    <?= e($m['intro'] ?: $m['description']) ?>
                  </div>
                </td>
                <td class="text-center">
                  <div class="d-flex flex-column align-items-center gap-1">
                    <span class="badge bg-light text-secondary border px-2 py-0.5" style="font-size:10.5px; width: fit-content;" title="<?= $subCount ?> Sub-Feature Cards">
                      <i class="bi bi-grid text-primary me-1"></i><?= $subCount ?> cards
                    </span>
                    <span class="badge bg-light text-secondary border px-2 py-0.5" style="font-size:10.5px; width: fit-content;" title="<?= $faqCount ?> FAQ Accordions">
                      <i class="bi bi-question-circle text-info me-1"></i><?= $faqCount ?> faqs
                    </span>
                  </div>
                </td>
                <td class="text-center">
                  <?php if (($m['status'] ?? 'published') === 'published'): ?>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 fw-semibold" style="font-size:10.5px;">
                      <i class="bi bi-check2 me-0.5"></i> Live
                    </span>
                  <?php else: ?>
                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1" style="font-size:10.5px;">
                      Draft
                    </span>
                  <?php endif; ?>
                </td>
                <td class="text-end pe-3">
                  <div class="d-flex align-items-center justify-content-end gap-1">
                    <a href="<?= admin_url('features/edit?id=' . $m['id']) ?>" class="btn btn-outline-primary btn-sm px-2 py-1 d-inline-flex align-items-center gap-1" style="font-size:11px;" title="Edit Feature Page">
                      <i class="bi bi-pencil-square"></i>
                      <span>Edit</span>
                    </a>
                    <a href="<?= e($liveUrl) ?>" target="_blank" class="btn btn-outline-secondary btn-sm px-2 py-1 d-inline-flex align-items-center" style="font-size:11px;" title="Open Live Page">
                      <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                    <form method="POST" action="<?= admin_url('features/delete') ?>" onsubmit="return confirm('Delete feature page <?= e(addslashes($m['name'])) ?>?');" class="d-inline m-0 p-0">
                      <?= csrf_field() ?>
                      <input type="hidden" name="id" value="<?= $m['id'] ?>">
                      <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-1 d-inline-flex align-items-center" style="font-size:11px;" title="Delete Feature">
                        <i class="bi bi-trash3"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
