<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
  <div>
    <h4 class="fw-bold mb-1 text-dark fs-5"><i class="bi bi-shield-lock text-primary me-2"></i>Roles & Permissions</h4>
    <p class="text-muted fs-12 mb-0">Define staff access roles, module privileges, and security matrix policies.</p>
  </div>
  <div>
    <a href="<?= admin_url('roles/create') ?>" class="btn btn-primary btn-sm px-3">
      <i class="bi bi-plus-lg me-1"></i> Add New Role
    </a>
  </div>
</div>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0 fs-13">
      <thead class="table-light text-uppercase fs-11 text-secondary">
        <tr>
          <th style="width: 50px;" class="ps-3">ID</th>
          <th>Role Name</th>
          <th>Slug / Key</th>
          <th>Description</th>
          <th>Assigned Users</th>
          <th>Permissions Granted</th>
          <th class="text-end pe-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($roles as $r): ?>
          <tr>
            <td class="ps-3 fw-bold text-secondary">#<?= $r['id'] ?></td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div style="width:32px; height:32px; background:rgba(220, 148, 35, 0.12); color:#DC9423; border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:14px;">
                  <i class="bi bi-shield-shaded"></i>
                </div>
                <div>
                  <div class="fw-bold text-dark"><?= e($r['name']) ?></div>
                </div>
              </div>
            </td>
            <td>
              <code class="text-dark bg-light px-2 py-1 rounded fs-12"><?= e($r['slug']) ?></code>
            </td>
            <td class="text-muted fs-12" style="max-width: 250px;">
              <?= e($r['description'] ?? '—') ?>
            </td>
            <td>
              <span class="badge bg-light text-dark border fs-11">
                <i class="bi bi-people me-1"></i><?= $r['user_count'] ?> User<?= $r['user_count'] == 1 ? '' : 's' ?>
              </span>
            </td>
            <td>
              <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-11">
                <i class="bi bi-check2-all me-1"></i><?= $r['permission_count'] ?> Permissions
              </span>
            </td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm">
                <a href="<?= admin_url('roles/edit?id=' . $r['id']) ?>" class="btn btn-outline-secondary" title="Edit Role & Permissions">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <?php if ((int)$r['id'] !== 1): ?>
                  <form method="POST" action="<?= admin_url('roles/delete') ?>" class="d-inline" onsubmit="return confirm('Are you sure you want to delete role \'<?= e($r['name']) ?>\'?');">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $r['id'] ?>">
                    <button type="submit" class="btn btn-outline-danger" title="Delete Role">
                      <i class="bi bi-trash3"></i>
                    </button>
                  </form>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
