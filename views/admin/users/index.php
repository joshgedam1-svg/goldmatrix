<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
  <div>
    <h4 class="fw-bold mb-1 text-dark fs-5"><i class="bi bi-person-gear text-primary me-2"></i>Admin Users Management</h4>
    <p class="text-muted fs-12 mb-0">Manage system administrators, roles, access permissions, and account statuses.</p>
  </div>
  <div>
    <a href="<?= admin_url('users/create') ?>" class="btn btn-primary btn-sm px-3">
      <i class="bi bi-person-plus-fill me-1"></i> Add New Admin User
    </a>
  </div>
</div>

<!-- Search & Filters -->
<div class="card border-0 shadow-sm rounded-3 mb-3">
  <div class="card-body p-3">
    <form method="GET" action="<?= admin_url('users') ?>" class="row g-2 align-items-center">
      <div class="col-md-5">
        <div class="input-group input-group-sm">
          <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
          <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="<?= e($search ?? '') ?>">
        </div>
      </div>
      <div class="col-md-3">
        <select name="role" class="form-select form-select-sm">
          <option value="">All Roles</option>
          <?php foreach ($roles as $r): ?>
            <option value="<?= $r['id'] ?>" <?= ($roleFilter ?? '') == $r['id'] ? 'selected' : '' ?>><?= e($r['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <select name="status" class="form-select form-select-sm">
          <option value="">All Statuses</option>
          <option value="active" <?= ($statusFilter ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
          <option value="inactive" <?= ($statusFilter ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
      </div>
      <div class="col-md-2 d-flex gap-1">
        <button type="submit" class="btn btn-dark btn-sm flex-grow-1">Filter</button>
        <?php if (!empty($search) || !empty($roleFilter) || !empty($statusFilter)): ?>
          <a href="<?= admin_url('users') ?>" class="btn btn-light btn-sm border" title="Reset Filters"><i class="bi bi-x-lg"></i></a>
        <?php endif; ?>
      </div>
    </form>
  </div>
</div>

<!-- Users Table Card -->
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0 fs-13">
      <thead class="table-light text-uppercase fs-11 text-secondary">
        <tr>
          <th style="width: 50px;" class="ps-3">ID</th>
          <th>User Info</th>
          <th>Role</th>
          <th>Status</th>
          <th>Last Login</th>
          <th>Created</th>
          <th class="text-end pe-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($users)): ?>
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">No admin users found.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($users as $u): 
            $isSelf = ($currentUser && (int)$currentUser['id'] === (int)$u['id']);
          ?>
            <tr>
              <td class="ps-3 fw-bold text-secondary">#<?= $u['id'] ?></td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div style="width:34px; height:34px; background:linear-gradient(135deg, #1E293B, #0F172A); color:#FBBF24; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:13px;">
                    <?= strtoupper(substr($u['name'], 0, 1)) ?>
                  </div>
                  <div>
                    <div class="fw-bold text-dark">
                      <?= e($u['name']) ?>
                      <?php if ($isSelf): ?>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-10 ms-1">You</span>
                      <?php endif; ?>
                    </div>
                    <div class="text-muted fs-11"><i class="bi bi-envelope me-1"></i><?= e($u['email']) ?></div>
                  </div>
                </div>
              </td>
              <td>
                <span class="badge bg-secondary-subtle text-secondary border fs-11">
                  <i class="bi bi-shield-lock me-1"></i><?= e($u['role_name'] ?? 'Admin') ?>
                </span>
              </td>
              <td>
                <?php if ($u['status'] === 'active'): ?>
                  <span class="badge bg-success-subtle text-success border border-success-subtle fs-11">
                    <i class="bi bi-check-circle me-1"></i>Active
                  </span>
                <?php else: ?>
                  <span class="badge bg-danger-subtle text-danger border border-danger-subtle fs-11">
                    <i class="bi bi-dash-circle me-1"></i>Inactive
                  </span>
                <?php endif; ?>
              </td>
              <td class="text-muted fs-12">
                <?= !empty($u['last_login']) ? date('M d, Y h:i A', strtotime($u['last_login'])) : 'Never' ?>
              </td>
              <td class="text-muted fs-12">
                <?= !empty($u['created_at']) ? date('M d, Y', strtotime($u['created_at'])) : '—' ?>
              </td>
              <td class="text-end pe-3">
                <div class="btn-group btn-group-sm">
                  <a href="<?= admin_url('users/edit?id=' . $u['id']) ?>" class="btn btn-outline-secondary" title="Edit User">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <?php if (!$isSelf && (int)$u['id'] !== 1): ?>
                    <form method="POST" action="<?= admin_url('users/delete') ?>" class="d-inline" onsubmit="return confirm('Are you sure you want to delete user \'<?= e($u['name']) ?>\'?');">
                      <?= csrf_field() ?>
                      <input type="hidden" name="id" value="<?= $u['id'] ?>">
                      <button type="submit" class="btn btn-outline-danger" title="Delete User">
                        <i class="bi bi-trash3"></i>
                      </button>
                    </form>
                  <?php endif; ?>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
