<?php $title = 'Contact Enquiries'; ?>

<style>
/* ── Clean, Clear & Sober Admin Table UI (Matching Form Fields 1:1) ── */
.sober-card {
  background: #FFFFFF;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
  border: 1px solid #F1F5F9;
  padding: 8px 16px;
  overflow: hidden;
  width: 100%;
}
.sober-table {
  width: 100%;
  border-collapse: collapse;
  margin: 0;
}
.sober-table th {
  font-size: 13px;
  font-weight: 500;
  color: #A3AED0;
  padding: 16px 14px;
  border-bottom: 1px solid #F4F7FE;
  text-align: left;
  white-space: nowrap;
}
.sober-table td {
  padding: 18px 14px;
  border-bottom: 1px solid #F4F7FE;
  vertical-align: middle;
  font-size: 14px;
  color: #2B3674;
  font-weight: 500;
  background: #FFFFFF;
  white-space: nowrap;
}
.sober-table tr:hover td {
  background-color: #F8FAFC;
}
.sober-table tr:last-child td {
  border-bottom: none;
}

/* Reference Exact Badges */
.badge-sober-amber {
  background: #FFB547;
  color: #FFFFFF;
  font-size: 12px;
  font-weight: 500;
  padding: 5px 12px;
  border-radius: 6px;
  display: inline-block;
  text-decoration: none;
}
.badge-sober-green {
  background: #01B574;
  color: #FFFFFF;
  font-size: 12px;
  font-weight: 500;
  padding: 5px 12px;
  border-radius: 6px;
  display: inline-block;
  text-decoration: none;
}
.badge-sober-blue {
  background: #3965FF;
  color: #FFFFFF;
  font-size: 12px;
  font-weight: 500;
  padding: 5px 12px;
  border-radius: 6px;
  display: inline-block;
  text-decoration: none;
}
.badge-sober-red {
  background: #EE5D50;
  color: #FFFFFF;
  font-size: 12px;
  font-weight: 500;
  padding: 5px 12px;
  border-radius: 6px;
  display: inline-block;
  text-decoration: none;
}

/* 3-Dots Menu */
.btn-sober-action {
  background: transparent;
  border: none;
  color: #A3AED0;
  font-size: 18px;
  padding: 4px 8px;
  cursor: pointer;
  border-radius: 4px;
}
.btn-sober-action:hover, .btn-sober-action:focus {
  color: #2B3674;
  background: #F4F7FE;
}

.nav-pills-ref .nav-link {
  color: #707EAE;
  font-size: 13px;
  font-weight: 500;
  padding: 6px 14px;
  border-radius: 8px;
  background: #F4F7FE;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  border: 1px solid transparent;
  transition: all 0.15s ease;
}
.nav-pills-ref .nav-link:hover {
  color: #2B3674;
  background: #EAEFFC;
}
.nav-pills-ref .nav-link.active {
  background: #2B3674;
  color: #FFFFFF;
}
</style>

<!-- Header & Breadcrumb -->
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2">
  <div>
    <h3 class="fw-bold mb-1" style="font-size: 22px; color: #2B3674;">Contact Enquiries</h3>
    <p class="fs-13 mb-0" style="color: #707EAE;">View, manage and update client inquiries matching the contact form.</p>
  </div>

  <div class="d-flex align-items-center gap-2">
    <a href="/admin/demo-requests" class="btn btn-sm px-3 py-1.5 fw-medium" style="background: #F4F7FE; color: #2B3674; border: 1px solid #E2E8F0; border-radius: 8px;">
      <i class="bi bi-calendar2-check me-1"></i> Demo Requests
    </a>
    
    <form method="GET" action="/admin/leads" class="d-flex align-items-center gap-1">
      <div class="input-group input-group-sm" style="width: 220px;">
        <span class="input-group-text bg-white border-end-0 text-muted">
          <i class="bi bi-search"></i>
        </span>
        <input type="text" 
               name="q" 
               value="<?= e($search ?? '') ?>" 
               class="form-control border-start-0" 
               placeholder="Search client, email...">
      </div>
      <button class="btn btn-sm btn-dark px-2.5" style="background: #2B3674; border: none; border-radius: 6px;">Filter</button>
      <?php if (!empty($search)): ?>
        <a href="/admin/leads" class="btn btn-sm btn-light border text-secondary">Reset</a>
      <?php endif; ?>
    </form>
  </div>
</div>

<!-- Nav Filter Tabs -->
<ul class="nav nav-pills-ref gap-2 mb-3">
  <li class="nav-item">
    <a href="/admin/leads" class="nav-link <?= empty($status) ? 'active' : '' ?>">
      <span>All Enquiries</span>
      <span class="badge <?= empty($status) ? 'bg-light text-dark' : 'bg-secondary-subtle text-secondary' ?>"><?= $counts['all'] ?></span>
    </a>
  </li>
  <li class="nav-item">
    <a href="/admin/leads?status=new" class="nav-link <?= $status==='new' ? 'active' : '' ?>">
      <span>New</span>
      <span class="badge <?= $status==='new' ? 'bg-light text-dark' : 'bg-warning-subtle text-warning' ?>"><?= $counts['new'] ?></span>
    </a>
  </li>
  <li class="nav-item">
    <a href="/admin/leads?status=contacted" class="nav-link <?= $status==='contacted' ? 'active' : '' ?>">
      <span>Contacted</span>
      <span class="badge <?= $status==='contacted' ? 'bg-light text-dark' : 'bg-info-subtle text-info' ?>"><?= $counts['contacted'] ?></span>
    </a>
  </li>
  <li class="nav-item">
    <a href="/admin/leads?status=converted" class="nav-link <?= $status==='converted' ? 'active' : '' ?>">
      <span>Converted</span>
      <span class="badge <?= $status==='converted' ? 'bg-light text-dark' : 'bg-success-subtle text-success' ?>"><?= $counts['converted'] ?></span>
    </a>
  </li>
</ul>

<?php if (empty($leads)): ?>
  <div class="sober-card text-center py-5 text-muted">
    <div class="mb-3">
      <i class="bi bi-inbox text-secondary opacity-50" style="font-size: 40px;"></i>
    </div>
    <h6 class="fw-bold mb-1" style="color: #2B3674;">No enquiries found</h6>
    <p class="fs-13 text-muted mb-0">There are no contact inquiries matching your selected criteria.</p>
  </div>
<?php else: ?>

  <!-- Clean Sober Table Matching Form Fields -->
  <div class="sober-card">
    <div class="table-responsive" style="overflow-x: auto;">
      <table class="sober-table">
        <thead>
          <tr>
            <th style="width: 45px;">#</th>
            <th>Name</th>
            <th>Showroom / Company</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Interest / Service</th>
            <th>Message / Note</th>
            <th>Date</th>
            <th>Status</th>
            <th style="width: 40px; text-align: right;"></th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $sn = 1;
        foreach($leads as $lead): 
          $st = $lead['status'] ?? 'new';
          $formattedDate = date('d-m-Y', strtotime($lead['created_at']));
          
          if ($st === 'new') {
            $statusBadge = '<span class="badge-sober-amber">New</span>';
          } elseif ($st === 'contacted' || $st === 'qualified' || $st === 'demo_scheduled') {
            $statusBadge = '<span class="badge-sober-blue">Pending</span>';
          } elseif ($st === 'converted') {
            $statusBadge = '<span class="badge-sober-green">Active</span>';
          } else {
            $statusBadge = '<span class="badge-sober-red">Lost</span>';
          }

          $serviceInterest = !empty($lead['source']) ? e($lead['source']) : 'General Enquiry';
          $msgNote = !empty($lead['message']) ? e(substr($lead['message'], 0, 40)) . (strlen($lead['message']) > 40 ? '...' : '') : '-';
        ?>
        <tr id="lead-<?= $lead['id'] ?>">
          <!-- # -->
          <td style="color: #707EAE; font-size: 14px;"><?= $sn++ ?></td>

          <!-- Name -->
          <td style="color: #2B3674; font-weight: 600; font-size: 14px;">
            <?= e($lead['name']) ?>
          </td>

          <!-- Showroom / Company -->
          <td style="color: #707EAE; font-size: 14px;">
            <?= e($lead['company'] ?: 'Direct Client') ?>
          </td>

          <!-- Phone -->
          <td style="color: #2B3674; font-size: 14px;">
            <?php if (!empty($lead['phone'])): ?>
              <a href="tel:<?= e($lead['phone']) ?>" style="color: #2B3674; text-decoration: none;">
                <?= e($lead['phone']) ?>
              </a>
            <?php else: ?>
              <span class="text-muted">No Phone</span>
            <?php endif; ?>
          </td>

          <!-- Email -->
          <td style="color: #707EAE; font-size: 14px;">
            <?php if (!empty($lead['email']) && strpos($lead['email'], 'not-provided') === false): ?>
              <a href="mailto:<?= e($lead['email']) ?>" style="color: #707EAE; text-decoration: none;">
                <?= e($lead['email']) ?>
              </a>
            <?php else: ?>
              <span class="text-muted">-</span>
            <?php endif; ?>
          </td>

          <!-- Interest / Service (Amber Pill) -->
          <td>
            <span class="badge-sober-amber">
              <?= $serviceInterest ?>
            </span>
          </td>

          <!-- Message / Note -->
          <td style="color: #707EAE; font-size: 13px;" title="<?= e($lead['message'] ?? '') ?>">
            <?= $msgNote ?>
          </td>

          <!-- Date -->
          <td style="color: #707EAE; font-size: 14px;">
            <?= e($formattedDate) ?>
          </td>

          <!-- Status -->
          <td>
            <?= $statusBadge ?>
          </td>

          <!-- 3-Dots Action -->
          <td style="text-align: right;">
            <div class="dropdown">
              <button class="btn-sober-action" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Actions">
                <i class="bi bi-three-dots-vertical"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow-sm border py-1 fs-13">
                <li class="dropdown-header text-muted fs-11 py-1 text-uppercase fw-bold">Update Status</li>
                <?php foreach(['new' => 'New Request', 'contacted' => 'Pending / Contacted', 'qualified' => 'Qualified', 'demo_scheduled' => 'Scheduled', 'converted' => 'Active / Converted', 'lost' => 'Lost'] as $k => $label): ?>
                  <li>
                    <form method="POST" action="/admin/leads" class="m-0">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="update_status">
                      <input type="hidden" name="lead_id" value="<?= $lead['id'] ?>">
                      <input type="hidden" name="status" value="<?= $k ?>">
                      <button type="submit" class="dropdown-item py-1.5 <?= $st === $k ? 'fw-bold text-primary bg-light' : '' ?>">
                        <?= $label ?>
                      </button>
                    </form>
                  </li>
                <?php endforeach; ?>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                  <form method="POST" action="/admin/leads" class="m-0" onsubmit="return confirm('Delete this enquiry record permanently?');">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="lead_id" value="<?= $lead['id'] ?>">
                    <button type="submit" class="dropdown-item text-danger py-1.5">
                      <i class="bi bi-trash3 me-1.5"></i> Delete Record
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

<?php endif; ?>
