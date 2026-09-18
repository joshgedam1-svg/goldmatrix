<?php
/**
 * Features & Capability Pages Listing (Executive & Modern Enterprise UI)
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

<style>
/* ─────────────────────────────────────────────
   EXECUTIVE FEATURE PAGES & SEO UI STYLES
───────────────────────────────────────────── */
.feat-page-header {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 16px 20px;
  margin-bottom: 20px;
  box-shadow: 0 1px 3px rgba(0, 21, 64, 0.03);
}

.feat-header-avatar {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: linear-gradient(135deg, #0B1F3A 0%, #163A63 100%);
  color: #F59E0B;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  box-shadow: 0 4px 10px rgba(11, 31, 58, 0.15);
  flex-shrink: 0;
}

/* Stat Cards */
.feat-stat-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 18px 20px;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
  transition: all 0.2s ease;
  position: relative;
  overflow: hidden;
}

.feat-stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0, 21, 64, 0.06);
  border-color: #CBD5E1;
}

.feat-stat-label {
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  color: #64748B;
  margin-bottom: 4px;
}

.feat-stat-value {
  font-size: 24px;
  font-weight: 800;
  color: #0F172A;
  line-height: 1.1;
  letter-spacing: -0.5px;
}

.feat-stat-hint {
  font-size: 11px;
  color: #94A3B8;
  margin-top: 4px;
  font-weight: 500;
}

.feat-stat-icon {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}

.feat-stat-icon.icon-blue {
  background: #EFF6FF;
  color: #2563EB;
}

.feat-stat-icon.icon-green {
  background: #ECFDF5;
  color: #059669;
}

.feat-stat-icon.icon-amber {
  background: #FFFBEB;
  color: #D97706;
}

.feat-stat-icon.icon-purple {
  background: #F5F3FF;
  color: #7C3AED;
}

/* Table Card */
.feat-table-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
  overflow: hidden;
}

.feat-table-toolbar {
  padding: 14px 20px;
  background: #FFFFFF;
  border-bottom: 1px solid #F1F5F9;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}

.feat-table {
  margin-bottom: 0;
}

.feat-table thead th {
  background: #F8FAFC;
  color: #475569;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  padding: 12px 16px;
  border-bottom: 1px solid #E2E8F0;
  border-top: none;
  white-space: nowrap;
}

.feat-table tbody tr {
  transition: background-color 0.15s ease;
}

.feat-table tbody tr:hover {
  background-color: #F8FAFC;
}

.feat-table tbody td {
  padding: 14px 16px;
  vertical-align: middle;
  border-bottom: 1px solid #F1F5F9;
  color: #1E293B;
}

/* Icon Box */
.feat-icon-box {
  width: 40px;
  height: 40px;
  border-radius: 8px;
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  color: #0B1F3A;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  transition: all 0.2s ease;
}

.feat-table tbody tr:hover .feat-icon-box {
  background: #0B1F3A;
  color: #F59E0B;
  border-color: #0B1F3A;
  box-shadow: 0 3px 8px rgba(11, 31, 58, 0.15);
}

/* Category Badge */
.feat-category-pill {
  display: inline-flex;
  align-items: center;
  font-size: 9.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 2px 7px;
  border-radius: 4px;
  background: #FEF3C7;
  color: #92400E;
  border: 1px solid #FDE68A;
}

/* Slug Pill */
.feat-slug-pill {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 11px;
  font-weight: 500;
  color: #0284C7;
  background: #F0F9FF;
  border: 1px solid #E0F2FE;
  padding: 2px 8px;
  border-radius: 5px;
  text-decoration: none;
  transition: all 0.15s ease;
}

.feat-slug-pill:hover {
  background: #0284C7;
  color: #FFFFFF;
  border-color: #0284C7;
}

/* Breakdown Pills */
.feat-count-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 11px;
  font-weight: 600;
  padding: 3px 8px;
  border-radius: 6px;
  white-space: nowrap;
}

.feat-count-badge.badge-cards {
  background: #EEF2FF;
  color: #4338CA;
  border: 1px solid #E0E7FF;
}

.feat-count-badge.badge-faqs {
  background: #F0FDF4;
  color: #15803D;
  border: 1px solid #DCFCE7;
}

/* Status Indicator */
.status-pill-live {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #ECFDF5;
  color: #059669;
  border: 1px solid #A7F3D0;
  font-size: 11px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 20px;
}

.status-dot-pulse {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #10B981;
  box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
}

.status-pill-draft {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #F1F5F9;
  color: #64748B;
  border: 1px solid #CBD5E1;
  font-size: 11px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 20px;
}

/* Action Buttons */
.btn-action-edit {
  background: #EFF6FF;
  color: #1D4ED8;
  border: 1px solid #DBEAFE;
  font-size: 11.5px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  text-decoration: none;
  transition: all 0.15s ease;
}

.btn-action-edit:hover {
  background: #1D4ED8;
  color: #FFFFFF;
  border-color: #1D4ED8;
  box-shadow: 0 2px 6px rgba(29, 78, 216, 0.2);
}

.btn-action-icon {
  width: 28px;
  height: 28px;
  border-radius: 6px;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  color: #64748B;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  text-decoration: none;
  transition: all 0.15s ease;
}

.btn-action-icon:hover {
  background: #F8FAFC;
  color: #0F172A;
  border-color: #CBD5E1;
}

.btn-action-delete {
  width: 28px;
  height: 28px;
  border-radius: 6px;
  background: #FEF2F2;
  border: 1px solid #FEE2E2;
  color: #DC2626;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  transition: all 0.15s ease;
  cursor: pointer;
}

.btn-action-delete:hover {
  background: #DC2626;
  color: #FFFFFF;
  border-color: #DC2626;
  box-shadow: 0 2px 6px rgba(220, 38, 38, 0.2);
}

/* Primary Top Buttons */
.btn-top-primary {
  background: #0B1F3A;
  color: #FFFFFF;
  border: 1px solid #0B1F3A;
  font-size: 12.5px;
  font-weight: 600;
  padding: 6px 14px;
  border-radius: 7px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
  box-shadow: 0 2px 6px rgba(11, 31, 58, 0.18);
  transition: all 0.2s ease;
}

.btn-top-primary:hover {
  background: #163A63;
  color: #FFFFFF;
  box-shadow: 0 4px 10px rgba(11, 31, 58, 0.25);
  transform: translateY(-1px);
}

.btn-top-secondary {
  background: #FFFFFF;
  color: #334155;
  border: 1px solid #CBD5E1;
  font-size: 12.5px;
  font-weight: 600;
  padding: 6px 12px;
  border-radius: 7px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
  transition: all 0.15s ease;
}

.btn-top-secondary:hover {
  background: #F8FAFC;
  color: #0F172A;
  border-color: #94A3B8;
}

.btn-top-settings {
  background: #FFFBEB;
  color: #92400E;
  border: 1px solid #FDE68A;
  font-size: 12.5px;
  font-weight: 600;
  padding: 6px 12px;
  border-radius: 7px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
  transition: all 0.15s ease;
}

.btn-top-settings:hover {
  background: #FEF3C7;
  color: #78350F;
  border-color: #FCD34D;
}
</style>

<div class="container-fluid px-0">

  <!-- ════════════════════════════════
       EXECUTIVE TOP BAR
  ════════════════════════════════ -->
  <div class="feat-page-header d-flex flex-wrap align-items-center justify-content-between gap-3">
    <div class="d-flex align-items-center gap-3">
      <div class="feat-header-avatar">
        <i class="bi bi-stars"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
          <h1 class="h4 fw-bold text-dark mb-0" style="letter-spacing: -0.02em;">Feature Pages &amp; SEO Architecture</h1>
          <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-11 px-2.5 py-1 fw-bold"><?= count($modules) ?> Modules</span>
        </div>
        <div class="text-muted fs-12 mt-1">Manage all jewellery ERP capability cluster pages, H1/H2 headings, sub-feature cards, FAQs and search engine ranking assets.</div>
      </div>
    </div>
    
    <div class="d-flex align-items-center flex-wrap gap-2">
      <a href="<?= admin_url('features-settings') ?>" class="btn-top-settings" title="Customize Section Title, Subtitle, and Layouts">
        <i class="bi bi-sliders2-vertical text-warning-emphasis"></i>
        <span>Section Settings</span>
      </a>
      <a href="<?= site_url('features') ?>" target="_blank" class="btn-top-secondary" title="View Frontend Index Page">
        <i class="bi bi-box-arrow-up-right text-muted"></i>
        <span>View Live /features</span>
      </a>
      <a href="<?= admin_url('features/create') ?>" class="btn-top-primary">
        <i class="bi bi-plus-circle-fill text-warning"></i>
        <span>Add Feature Page</span>
      </a>
    </div>
  </div>

  <!-- FLASH MESSAGES -->
  <?php if ($msg = get_flash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show py-2.5 px-3 fs-13 shadow-sm border-0 d-flex align-items-center gap-2 mb-3 rounded-3" role="alert">
      <i class="bi bi-check-circle-fill text-success fs-5"></i>
      <div class="fw-medium"><?= e($msg) ?></div>
      <button type="button" class="btn-close py-3" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if ($msg = get_flash('danger')): ?>
    <div class="alert alert-danger alert-dismissible fade show py-2.5 px-3 fs-13 shadow-sm border-0 d-flex align-items-center gap-2 mb-3 rounded-3" role="alert">
      <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
      <div class="fw-medium"><?= e($msg) ?></div>
      <button type="button" class="btn-close py-3" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- ════════════════════════════════
       EXECUTIVE METRICS ROW
  ════════════════════════════════ -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
      <div class="feat-stat-card">
        <div>
          <div class="feat-stat-label">Total Features</div>
          <div class="feat-stat-value"><?= count($modules) ?></div>
          <div class="feat-stat-hint"><i class="bi bi-shield-check text-primary me-1"></i>Full ERP Suite</div>
        </div>
        <div class="feat-stat-icon icon-blue">
          <i class="bi bi-grid-3x3-gap-fill"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="feat-stat-card">
        <div>
          <div class="feat-stat-label">Live SEO Pages</div>
          <div class="feat-stat-value text-success"><?= $publishedCount ?></div>
          <div class="feat-stat-hint"><i class="bi bi-broadcast text-success me-1"></i>100% Indexable</div>
        </div>
        <div class="feat-stat-icon icon-green">
          <i class="bi bi-check-circle-fill"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="feat-stat-card">
        <div>
          <div class="feat-stat-label">Sub-Feature Cards</div>
          <div class="feat-stat-value"><?= $totSubs ?></div>
          <div class="feat-stat-hint"><i class="bi bi-collection text-warning me-1"></i>Interactive Cards</div>
        </div>
        <div class="feat-stat-icon icon-amber">
          <i class="bi bi-card-checklist"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="feat-stat-card">
        <div>
          <div class="feat-stat-label">Total FAQs</div>
          <div class="feat-stat-value"><?= $totFaqs ?></div>
          <div class="feat-stat-hint"><i class="bi bi-patch-question text-purple me-1"></i>FAQ Schema Active</div>
        </div>
        <div class="feat-stat-icon icon-purple">
          <i class="bi bi-question-circle-fill"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- ════════════════════════════════
       FEATURE MODULES TABLE CARD
  ════════════════════════════════ -->
  <div class="feat-table-card mb-4">
    <div class="feat-table-toolbar">
      <div class="d-flex align-items-center gap-2">
        <span class="fw-bold text-dark fs-14">All Feature Modules</span>
        <span class="badge bg-light text-secondary border fs-11" id="featureCountBadge"><?= count($modules) ?> items</span>
      </div>

      <div class="d-flex align-items-center gap-2 ms-auto flex-wrap">
        <!-- Live Instant Search -->
        <div class="input-group input-group-sm" style="width: 240px;">
          <span class="input-group-text bg-white border-end-0 text-muted ps-2.5 pe-1"><i class="bi bi-search"></i></span>
          <input type="text" id="featureTableSearch" class="form-control border-start-0 ps-1 fs-12 shadow-none" placeholder="Search features by name, slug...">
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table feat-table align-middle" id="featureListingTable">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th class="text-center" style="width: 60px;">Icon</th>
            <th style="min-width: 260px;">Feature Name &amp; URL</th>
            <th style="min-width: 320px;">SEO H1 Heading &amp; Intro</th>
            <th class="text-center" style="width: 140px;">Breakdown</th>
            <th class="text-center" style="width: 100px;">Status</th>
            <th class="text-end pe-4" style="width: 130px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($modules)): ?>
            <tr id="emptyTableNotice">
              <td colspan="7" class="text-center py-5 text-muted fs-13">
                <div class="mb-2"><i class="bi bi-folder2-open fs-2 text-secondary opacity-50"></i></div>
                <div>No feature pages found. Click <strong>"+ Add Feature Page"</strong> to create one.</div>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($modules as $idx => $m): 
              $subs = !empty($m['sub_features']) ? (is_array($m['sub_features']) ? $m['sub_features'] : json_decode($m['sub_features'], true)) : [];
              $faqs = !empty($m['faqs']) ? (is_array($m['faqs']) ? $m['faqs'] : json_decode($m['faqs'], true)) : [];
              $subCount = is_array($subs) ? count($subs) : 0;
              $faqCount = is_array($faqs) ? count($faqs) : 0;
              $liveUrl = site_url('features/' . $m['slug']);
              $orderVal = (int)($m['display_order'] ?? ($idx + 1));
            ?>
              <tr class="feature-table-row" data-search="<?= strtolower(e($m['name'] . ' ' . $m['slug'] . ' ' . ($m['badge'] ?? '') . ' ' . ($m['category'] ?? '') . ' ' . ($m['h1'] ?? ''))) ?>">
                <td class="text-center">
                  <span class="badge bg-light text-secondary border fw-bold fs-11" style="min-width: 24px;"><?= $orderVal ?></span>
                </td>
                <td class="text-center">
                  <div class="feat-icon-box" title="<?= e($m['icon'] ?: 'bi-stars') ?>">
                    <i class="bi <?= e($m['icon'] ?: 'bi-stars') ?>"></i>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center flex-wrap gap-1.5 mb-1">
                    <span class="feat-category-pill">
                      <?= e($m['badge'] ?: 'FEATURE') ?>
                    </span>
                    <span class="text-muted small fw-medium" style="font-size: 11px;">&bull; <?= e($m['category'] ?: 'ERP Core') ?></span>
                  </div>
                  <div class="fw-bold text-dark mb-1" style="font-size: 13.5px; letter-spacing: -0.01em;">
                    <?= e($m['name']) ?>
                  </div>
                  <div>
                    <a href="<?= e($liveUrl) ?>" target="_blank" class="feat-slug-pill" title="Preview live page on frontend">
                      <span>/features/<?= e($m['slug']) ?></span>
                      <i class="bi bi-box-arrow-up-right" style="font-size: 9px;"></i>
                    </a>
                  </div>
                </td>
                <td>
                  <div class="fw-semibold text-dark mb-1" style="font-size: 12.5px; line-height: 1.35;">
                    <?= e($m['h1'] ?: $m['name']) ?>
                  </div>
                  <div class="text-muted" style="font-size: 11.5px; line-height: 1.45; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    <?= e($m['intro'] ?: $m['description']) ?>
                  </div>
                </td>
                <td class="text-center">
                  <div class="d-flex flex-column align-items-center gap-1">
                    <span class="feat-count-badge badge-cards" title="<?= $subCount ?> Sub-Feature Cards configured">
                      <i class="bi bi-grid-fill"></i>
                      <span><?= $subCount ?> cards</span>
                    </span>
                    <span class="feat-count-badge badge-faqs" title="<?= $faqCount ?> FAQ Accordions configured">
                      <i class="bi bi-question-circle-fill"></i>
                      <span><?= $faqCount ?> faqs</span>
                    </span>
                  </div>
                </td>
                <td class="text-center">
                  <?php if (($m['status'] ?? 'published') === 'published'): ?>
                    <span class="status-pill-live" title="Page is live and published">
                      <span class="status-dot-pulse"></span>
                      <span>Live</span>
                    </span>
                  <?php else: ?>
                    <span class="status-pill-draft" title="Page is hidden in draft mode">
                      <i class="bi bi-eye-slash-fill" style="font-size: 10px;"></i>
                      <span>Draft</span>
                    </span>
                  <?php endif; ?>
                </td>
                <td class="text-end pe-4">
                  <div class="d-flex align-items-center justify-content-end gap-1.5">
                    <a href="<?= admin_url('features/edit?id=' . $m['id']) ?>" class="btn-action-edit" title="Edit Feature Page Details">
                      <i class="bi bi-pencil-square"></i>
                      <span>Edit</span>
                    </a>
                    <a href="<?= e($liveUrl) ?>" target="_blank" class="btn-action-icon" title="View Live Page">
                      <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                    <form method="POST" action="<?= admin_url('features/delete') ?>" onsubmit="return confirm('Are you sure you want to delete feature page: <?= e(addslashes($m['name'])) ?>?');" class="d-inline m-0 p-0">
                      <?= csrf_field() ?>
                      <input type="hidden" name="id" value="<?= $m['id'] ?>">
                      <button type="submit" class="btn-action-delete" title="Delete Feature">
                        <i class="bi bi-trash3"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
            <tr id="noResultsRow" style="display: none;">
              <td colspan="7" class="text-center py-4 text-muted fs-12">
                <i class="bi bi-search me-1"></i> No matching features found for your search query.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- Client-side Instant Filter JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('featureTableSearch');
  const rows = document.querySelectorAll('.feature-table-row');
  const noResultsRow = document.getElementById('noResultsRow');
  const countBadge = document.getElementById('featureCountBadge');

  if (searchInput && rows.length > 0) {
    searchInput.addEventListener('input', function() {
      const q = this.value.trim().toLowerCase();
      let visibleCount = 0;

      rows.forEach(function(row) {
        const text = row.getAttribute('data-search') || '';
        if (q === '' || text.includes(q)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      if (noResultsRow) {
        noResultsRow.style.display = (visibleCount === 0 && q !== '') ? '' : 'none';
      }

      if (countBadge) {
        countBadge.textContent = visibleCount + ' items';
      }
    });
  }
});
</script>
