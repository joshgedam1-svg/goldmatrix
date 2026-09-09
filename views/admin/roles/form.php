<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
  <div>
    <h4 class="fw-bold mb-1 text-dark fs-5">
      <i class="bi bi-shield-<?= $isEdit ? 'check' : 'plus' ?> text-primary me-2"></i>
      <?= $isEdit ? 'Edit Role: ' . e($role['name']) : 'Create New Access Role' ?>
    </h4>
    <p class="text-muted fs-12 mb-0">Define role details and toggle permissions across admin modules.</p>
  </div>
  <div>
    <a href="<?= admin_url('roles') ?>" class="btn btn-outline-secondary btn-sm px-3">
      <i class="bi bi-arrow-left me-1"></i> Back to Roles
    </a>
  </div>
</div>

<form method="POST" action="<?= admin_url($isEdit ? 'roles/update' : 'roles/store') ?>">
  <?= csrf_field() ?>
  <?php if ($isEdit): ?>
    <input type="hidden" name="id" value="<?= $role['id'] ?>">
  <?php endif; ?>

  <div class="row g-3">
    <!-- LEFT: Role Details -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-3 h-100">
        <div class="card-header bg-white border-bottom py-2 px-3">
          <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-card-heading text-secondary me-2"></i>Role Information</h6>
        </div>
        <div class="card-body p-3">
          <div class="mb-3">
            <label class="form-label fs-12 fw-semibold">Role Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control form-control-sm" value="<?= e($role['name'] ?? '') ?>" placeholder="e.g. Content Manager" required>
          </div>

          <?php if (!$isEdit): ?>
            <div class="mb-3">
              <label class="form-label fs-12 fw-semibold">Role Slug</label>
              <input type="text" name="slug" class="form-control form-control-sm font-monospace" placeholder="e.g. content-manager (auto-generated)">
              <div class="form-text fs-11 text-muted">Unique key used in access checks.</div>
            </div>
          <?php else: ?>
            <div class="mb-3">
              <label class="form-label fs-12 fw-semibold">Role Slug</label>
              <input type="text" class="form-control form-control-sm font-monospace bg-light" value="<?= e($role['slug'] ?? '') ?>" readonly>
            </div>
          <?php endif; ?>

          <div class="mb-3">
            <label class="form-label fs-12 fw-semibold">Description</label>
            <textarea name="description" rows="3" class="form-control form-control-sm" placeholder="Brief description of this role's responsibilities..."><?= e($role['description'] ?? '') ?></textarea>
          </div>

          <div class="pt-3 border-top d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm px-4 flex-grow-1">
              <i class="bi bi-check2-circle me-1"></i> <?= $isEdit ? 'Update Role' : 'Save Role' ?>
            </button>
            <a href="<?= admin_url('roles') ?>" class="btn btn-light btn-sm border px-3">Cancel</a>
          </div>
        </div>
      </div>
    </div>

    <!-- RIGHT: Permissions Checklist Matrix -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-check2-square text-success me-2"></i>Module Permissions Matrix</h6>
            <div class="text-muted fs-11">Check the capabilities allowed for users assigned to this role.</div>
          </div>
          <div class="d-flex gap-1">
            <button type="button" class="btn btn-outline-secondary btn-xs py-0 px-2 fs-11" onclick="toggleAllPerms(true)">Select All</button>
            <button type="button" class="btn btn-outline-secondary btn-xs py-0 px-2 fs-11" onclick="toggleAllPerms(false)">Deselect All</button>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row g-3">
            <?php foreach ($groupedPermissions as $module => $perms): ?>
              <div class="col-md-6">
                <div class="border rounded-2 p-3 bg-light-subtle h-100">
                  <div class="fw-bold text-dark fs-12 text-uppercase mb-2 pb-1 border-bottom d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-folder2-open text-primary me-1"></i><?= ucwords(str_replace('_', ' ', $module)) ?></span>
                    <span class="badge bg-light text-secondary border fs-10"><?= count($perms) ?></span>
                  </div>
                  <div class="d-flex flex-column gap-2">
                    <?php foreach ($perms as $p): 
                      $checked = in_array((int)$p['id'], array_map('intval', $assignedPermissions), true);
                    ?>
                      <label class="form-check d-flex align-items-center gap-2 mb-0 cursor-pointer" style="cursor:pointer;">
                        <input class="form-check-input mt-0 perm-checkbox" type="checkbox" name="permissions[]" value="<?= $p['id'] ?>" <?= $checked ? 'checked' : '' ?>>
                        <span class="fs-12 text-dark"><?= e($p['description'] ?: $p['slug']) ?></span>
                      </label>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
function toggleAllPerms(check) {
  document.querySelectorAll('.perm-checkbox').forEach(cb => cb.checked = check);
}
</script>
