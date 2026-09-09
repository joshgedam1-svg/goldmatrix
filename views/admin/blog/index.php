<?php
/**
 * Admin Blog Posts List
 * views/admin/blog/index.php
 */
?>

<!-- Page Header -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 pb-2 border-bottom">
  <div>
    <h4 class="fw-bold text-dark mb-1" style="font-size: 1.15rem;"><i class="bi bi-newspaper text-secondary me-2"></i>Blog Posts</h4>
    <p class="text-muted fs-12 mb-0">Manage all blog articles, case studies, and industry guides.</p>
  </div>
  <div class="d-flex gap-2">
    <a href="<?= admin_url('categories') ?>" class="btn btn-outline-secondary btn-sm px-3">
      <i class="bi bi-tags me-1"></i> Categories
    </a>
    <a href="<?= admin_url('blog/create') ?>" class="btn btn-navy btn-sm px-3">
      <i class="bi bi-plus-circle-fill me-1"></i> New Post
    </a>
  </div>
</div>

<!-- Flash messages -->
<?php if ($msg = get_flash('success')): ?>
  <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i><?= e($msg) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>
<?php if ($msg = get_flash('danger')): ?>
  <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i><?= e($msg) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<!-- Filters Card -->
<div class="card border-0 shadow-sm mb-3">
  <div class="card-body p-2 px-3">
    <form method="GET" action="<?= admin_url('blog') ?>" class="row g-2 align-items-center">
      <div class="col-md-4">
        <input type="text" name="search" value="<?= e($search ?? '') ?>" class="form-control form-control-sm" placeholder="Search title or excerpt...">
      </div>
      <div class="col-md-3">
        <select name="category" class="form-select form-select-sm">
          <option value="">All Categories</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= ($catFilter ?? 0) == $cat['id'] ? 'selected' : '' ?>><?= e($cat['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <select name="status" class="form-select form-select-sm">
          <option value="">All Status</option>
          <option value="published" <?= ($status ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
          <option value="draft"     <?= ($status ?? '') === 'draft'     ? 'selected' : '' ?>>Draft</option>
        </select>
      </div>
      <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-navy btn-sm px-3"><i class="bi bi-search me-1"></i>Filter</button>
        <a href="<?= admin_url('blog') ?>" class="btn btn-light border btn-sm px-3 text-secondary">Reset</a>
      </div>
    </form>
  </div>
</div>

<!-- Posts Table -->
<div class="card border-0 shadow-sm rounded-3">
  <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between">
    <span class="fw-semibold fs-13 text-dark"><i class="bi bi-list-ul me-2"></i>All Posts (<?= count($posts) ?>)</span>
    <a href="<?= site_url('blog') ?>" target="_blank" class="btn btn-outline-secondary btn-sm px-2.5 py-0.5 fs-12">
      <i class="bi bi-box-arrow-up-right me-1"></i> View Live Blog
    </a>
  </div>
  <div class="card-body p-0">
    <?php if (empty($posts)): ?>
      <div class="text-center py-5 text-muted">
        <div class="mb-2">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
            <line x1="9" y1="9" x2="9.01" y2="9"></line>
            <line x1="15" y1="9" x2="15.01" y2="9"></line>
          </svg>
        </div>
        <p class="mb-2 fs-13">No blog posts found matching your filter.</p>
        <a href="<?= admin_url('blog/create') ?>" class="btn btn-navy btn-sm px-3">Create First Post</a>
      </div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 fs-13">
          <thead style="background-color: #FAFBFC; border-bottom: 1px solid #F1F5F9;">
            <tr style="color: #475569; font-size: 12px;">
              <th class="ps-3" style="width:35%">Title</th>
              <th>Focus Keyword</th>
              <th>Category</th>
              <th>Author</th>
              <th>Status</th>
              <th>Views</th>
              <th>Published</th>
              <th class="text-end pe-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
              <td class="ps-3">
                <div class="fw-semibold text-dark fs-13"><?= e($post['title']) ?></div>
                <div class="text-muted fs-11">/blog/<?= e($post['slug']) ?></div>
              </td>
              <td>
                <?php if (!empty($post['focus_keyword'])): ?>
                  <span class="badge bg-light text-primary border fs-11">
                    <i class="bi bi-bullseye me-1"></i><?= e($post['focus_keyword']) ?>
                  </span>
                <?php else: ?>
                  <span class="text-muted fs-11 fst-italic">—</span>
                <?php endif; ?>
              </td>
              <td>
                <span class="badge rounded-pill fs-11" style="background:<?= e($post['category_color'] ?? '#E11D48') ?>18;color:<?= e($post['category_color'] ?? '#E11D48') ?>;border:1px solid <?= e($post['category_color'] ?? '#E11D48') ?>35">
                  <?= e($post['category_name'] ?? 'General') ?>
                </span>
              </td>
              <td class="text-muted fs-12"><?= e($post['author_name']) ?></td>
              <td>
                <?php if ($post['status'] === 'published'): ?>
                  <span class="badge bg-success-subtle text-success border border-success-subtle fs-11">Published</span>
                <?php else: ?>
                  <span class="badge bg-warning-subtle text-warning border border-warning-subtle fs-11">Draft</span>
                <?php endif; ?>
              </td>
              <td class="text-muted fs-12"><?= number_format((int)$post['views']) ?></td>
              <td class="text-muted fs-12"><?= date('d M Y', strtotime($post['published_at'])) ?></td>
              <td class="text-end pe-3">
                <div class="d-inline-flex align-items-center gap-1">
                  <a href="<?= site_url('blog/' . $post['slug']) ?>" target="_blank" class="btn btn-sm btn-light border text-secondary px-2 py-1 fs-12" title="View Live">
                    <i class="bi bi-box-arrow-up-right"></i>
                  </a>
                  <a href="<?= admin_url('blog/edit?id=' . $post['id']) ?>" class="btn btn-sm btn-navy px-2 py-1 fs-12" title="Edit Post">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form method="POST" action="<?= admin_url('blog/delete') ?>" onsubmit="return confirm('Delete this post permanently?')" class="d-inline m-0">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <button class="btn btn-sm btn-light border text-danger px-2 py-1 fs-12" title="Delete Post"><i class="bi bi-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>
