<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
  <div>
    <h4 class="fw-bold mb-1 text-dark fs-5">
      <i class="bi bi-<?= $isEdit ? 'person-check' : 'person-plus' ?> text-primary me-2"></i>
      <?= $isEdit ? 'Edit Admin User' : 'Create New Admin User' ?>
    </h4>
    <p class="text-muted fs-12 mb-0"><?= $isEdit ? 'Update administrator credentials, role and status.' : 'Register a new administrator with role-based access.' ?></p>
  </div>
  <div>
    <a href="<?= admin_url('users') ?>" class="btn btn-outline-secondary btn-sm px-3">
      <i class="bi bi-arrow-left me-1"></i> Back to Users
    </a>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-header bg-white border-bottom py-2 px-3">
        <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-shield-lock text-secondary me-2"></i>Account Details</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="<?= admin_url($isEdit ? 'users/update' : 'users/store') ?>">
          <?= csrf_field() ?>
          <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
          <?php endif; ?>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">Full Name <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control" value="<?= e($user['name'] ?? '') ?>" placeholder="e.g. John Doe" required>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">Email Address <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" value="<?= e($user['email'] ?? '') ?>" placeholder="john@example.com" required>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">
                Password <?= $isEdit ? '<span class="text-muted fw-normal">(Leave blank to keep current)</span>' : '<span class="text-danger">*</span>' ?>
              </label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="bi bi-key"></i></span>
                <input type="password" name="password" class="form-control" placeholder="<?= $isEdit ? '••••••••' : 'Min 6 characters' ?>" <?= $isEdit ? '' : 'required' ?>>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">Role <span class="text-danger">*</span></label>
              <select name="role_id" class="form-select form-select-sm" required>
                <?php foreach ($roles as $r): ?>
                  <option value="<?= $r['id'] ?>" <?= (($user['role_id'] ?? 1) == $r['id']) ? 'selected' : '' ?>>
                    <?= e($r['name']) ?> (<?= e($r['slug']) ?>)
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">Account Status</label>
              <select name="status" class="form-select form-select-sm">
                <option value="active" <?= (($user['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= (($user['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive (Suspended)</option>
              </select>
            </div>
          </div>

          <div class="mt-4 pt-3 border-top d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm px-4">
              <i class="bi bi-check2-circle me-1"></i> <?= $isEdit ? 'Update Admin User' : 'Create User' ?>
            </button>
            <a href="<?= admin_url('users') ?>" class="btn btn-light btn-sm border px-3">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
