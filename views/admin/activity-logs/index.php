<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
  <div>
    <h4 class="fw-bold mb-1 text-dark fs-5"><i class="bi bi-clock-history text-primary me-2"></i>System Activity Logs & Audit Trail</h4>
    <p class="text-muted fs-12 mb-0">Immutable forensic log of admin logins, CRUD operations, configuration updates, and security events.</p>
  </div>
  <div>
    <form method="POST" action="<?= admin_url('activity-logs/clear') ?>" class="d-inline" onsubmit="return confirm('Clear activity logs older than 30 days?');">
      <?= csrf_field() ?>
      <input type="hidden" name="days" value="30">
      <button type="submit" class="btn btn-outline-danger btn-sm">
        <i class="bi bi-trash3 me-1"></i> Clear Old Logs (>30 Days)
      </button>
    </form>
  </div>
</div>

<!-- Search & Filters -->
<div class="card border-0 shadow-sm rounded-3 mb-3">
  <div class="card-body p-3">
    <form method="GET" action="<?= admin_url('activity-logs') ?>" class="row g-2 align-items-center">
      <div class="col-md-4">
        <div class="input-group input-group-sm">
          <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
          <input type="text" name="search" class="form-control" placeholder="Search description or IP..." value="<?= e($search ?? '') ?>">
        </div>
      </div>
      <div class="col-md-3">
        <select name="module" class="form-select form-select-sm">
          <option value="">All Modules</option>
          <?php foreach ($modules as $m): ?>
            <option value="<?= e($m) ?>" <?= ($moduleFilter ?? '') === $m ? 'selected' : '' ?>><?= ucfirst($m) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <select name="action_type" class="form-select form-select-sm">
          <option value="">All Actions</option>
          <?php foreach ($actions as $a): ?>
            <option value="<?= e($a) ?>" <?= ($actionFilter ?? '') === $a ? 'selected' : '' ?>><?= ucfirst($a) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <select name="user_id" class="form-select form-select-sm">
          <option value="">All Users</option>
          <?php foreach ($users as $u): ?>
            <option value="<?= $u['id'] ?>" <?= ($userFilter ?? '') == $u['id'] ? 'selected' : '' ?>><?= e($u['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-1 d-flex gap-1">
        <button type="submit" class="btn btn-dark btn-sm w-100">Filter</button>
      </div>
    </form>
  </div>
</div>

<!-- Logs Table Card -->
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0 fs-13">
      <thead class="table-light text-uppercase fs-11 text-secondary">
        <tr>
          <th style="width: 50px;" class="ps-3">ID</th>
          <th>User</th>
          <th>Action</th>
          <th>Module</th>
          <th>Description</th>
          <th>IP Address</th>
          <th class="pe-3">Timestamp</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($logs)): ?>
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">No activity logs recorded.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($logs as $l): 
            $actionBadge = 'bg-secondary-subtle text-secondary';
            $actLower = strtolower($l['action']);
            if (in_array($actLower, ['login', 'create', 'publish'])) $actionBadge = 'bg-success-subtle text-success border-success-subtle';
            elseif (in_array($actLower, ['update', 'edit', 'save'])) $actionBadge = 'bg-primary-subtle text-primary border-primary-subtle';
            elseif (in_array($actLower, ['delete', 'destroy', 'clear'])) $actionBadge = 'bg-danger-subtle text-danger border-danger-subtle';
          ?>
            <tr>
              <td class="ps-3 fw-bold text-secondary">#<?= $l['id'] ?></td>
              <td>
                <div class="fw-semibold text-dark"><?= e($l['user_name'] ?? 'System / Anonymous') ?></div>
                <?php if (!empty($l['user_email'])): ?>
                  <div class="text-muted fs-11"><?= e($l['user_email']) ?></div>
                <?php endif; ?>
              </td>
              <td>
                <span class="badge border fs-11 <?= $actionBadge ?>">
                  <?= ucfirst(e($l['action'])) ?>
                </span>
              </td>
              <td>
                <code class="text-dark bg-light px-2 py-1 rounded fs-11"><?= e($l['module']) ?></code>
              </td>
              <td style="max-width: 380px;">
                <div class="text-dark fs-12"><?= e($l['description'] ?? '—') ?></div>
              </td>
              <td>
                <span class="text-secondary font-monospace fs-11"><?= e($l['ip_address'] ?? '—') ?></span>
              </td>
              <td class="pe-3 text-muted fs-11 text-nowrap">
                <i class="bi bi-clock me-1"></i><?= !empty($l['created_at']) ? date('M d, Y h:i A', strtotime($l['created_at'])) : '—' ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
