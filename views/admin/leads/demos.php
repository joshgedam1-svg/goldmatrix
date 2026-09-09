<?php $title = 'Demo Requests'; ?>

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
</style>

<!-- Header & Breadcrumb -->
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2">
  <div>
    <h3 class="fw-bold mb-1" style="font-size: 22px; color: #2B3674;">Demo Requests</h3>
    <p class="fs-13 mb-0" style="color: #707EAE;">Manage 1-on-1 jewellery software walkthrough requests matching the booking form.</p>
  </div>

  <div class="d-flex align-items-center gap-2">
    <a href="/admin/leads" class="btn btn-sm px-3 py-1.5 fw-medium" style="background: #F4F7FE; color: #2B3674; border: 1px solid #E2E8F0; border-radius: 8px;">
      <i class="bi bi-person-lines-fill me-1"></i> Contact Enquiries
    </a>
  </div>
</div>

<?php if (empty($demos)): ?>
  <div class="sober-card text-center py-5 text-muted">
    <div class="mb-3">
      <i class="bi bi-calendar-x text-secondary opacity-50" style="font-size: 40px;"></i>
    </div>
    <h6 class="fw-bold mb-1" style="color: #2B3674;">No demo requests booked yet</h6>
    <p class="fs-13 text-muted mb-0">When visitors request a live jewellery ERP walkthrough, they will appear here.</p>
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
            <th>Business Type</th>
            <th>Branches</th>
            <th>Preferred Slot</th>
            <th>Date</th>
            <th>Status</th>
            <th style="width: 40px; text-align: right;"></th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $sn = 1;
        foreach($demos as $demo): 
          $st = $demo['status'] ?? 'new';
          $formattedDate = date('d-m-Y', strtotime($demo['created_at']));
          
          if ($st === 'new') {
            $statusBadge = '<span class="badge-sober-amber">New Request</span>';
          } elseif ($st === 'contacted') {
            $statusBadge = '<span class="badge-sober-blue">Pending</span>';
          } elseif ($st === 'cancelled') {
            $statusBadge = '<span class="badge-sober-red">Cancelled</span>';
          } else {
            $statusBadge = '<span class="badge-sober-green">Active</span>';
          }

          $slotText = !empty($demo['preferred_time']) ? e($demo['preferred_time']) : 'Flexible';
          $businessType = !empty($demo['business_type']) ? e($demo['business_type']) : 'Retail Jewellery';
          $branches = !empty($demo['number_of_branches']) ? e($demo['number_of_branches']) : '1 Store';
        ?>
        <tr id="demo-<?= $demo['id'] ?>">
          <!-- # -->
          <td style="color: #707EAE; font-size: 14px;"><?= $sn++ ?></td>

          <!-- Name -->
          <td style="color: #2B3674; font-weight: 600; font-size: 14px;">
            <?= e($demo['name'] ?? 'Manoj bhoyar') ?>
          </td>

          <!-- Showroom / Company -->
          <td style="color: #707EAE; font-size: 14px;">
            <?= e($demo['company'] ?: 'Showroom') ?>
            <?php if (!empty($demo['country'])): ?>
              <span class="text-muted" style="font-size: 12px;">• <?= e($demo['country']) ?></span>
            <?php endif; ?>
          </td>

          <!-- Phone -->
          <td style="color: #2B3674; font-size: 14px;">
            <a href="tel:<?= e($demo['phone']) ?>" style="color: #2B3674; text-decoration: none;">
              <?= e($demo['phone']) ?>
            </a>
          </td>

          <!-- Email -->
          <td style="color: #707EAE; font-size: 14px;">
            <?php if (!empty($demo['email'])): ?>
              <a href="mailto:<?= e($demo['email']) ?>" style="color: #707EAE; text-decoration: none;">
                <?= e($demo['email']) ?>
              </a>
            <?php else: ?>
              <span class="text-muted">-</span>
            <?php endif; ?>
          </td>

          <!-- Business Type -->
          <td style="color: #2B3674; font-size: 14px;">
            <?= $businessType ?>
          </td>

          <!-- Branches -->
          <td style="color: #707EAE; font-size: 14px;">
            <?= $branches ?>
          </td>

          <!-- Preferred Slot (Amber Pill) -->
          <td>
            <span class="badge-sober-amber">
              <?= $slotText ?>
            </span>
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
                <?php foreach(['new' => 'New Request', 'contacted' => 'Pending', 'scheduled' => 'Active (Scheduled)', 'completed' => 'Active (Completed)', 'cancelled' => 'Cancelled'] as $k => $label): ?>
                  <li>
                    <form method="POST" action="/admin/demo-requests" class="m-0">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="update_status">
                      <input type="hidden" name="demo_id" value="<?= $demo['id'] ?>">
                      <input type="hidden" name="status" value="<?= $k ?>">
                      <button type="submit" class="dropdown-item py-1.5 <?= $st === $k ? 'fw-bold text-primary bg-light' : '' ?>">
                        <?= $label ?>
                      </button>
                    </form>
                  </li>
                <?php endforeach; ?>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                  <form method="POST" action="/admin/demo-requests" class="m-0" onsubmit="return confirm('Permanently delete this demo request?');">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="demo_id" value="<?= $demo['id'] ?>">
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
