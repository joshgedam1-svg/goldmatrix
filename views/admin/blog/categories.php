<?php
/**
 * Admin Blog Categories Manager
 * views/admin/blog/categories.php
 * Matches reference 2-column layout with search, empty state & pink Save card.
 */
?>

<!-- Page Title -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
  <div>
    <h4 class="fw-bold text-dark mb-0" style="font-size: 1.15rem;">All Blog Categories</h4>
  </div>
  <div>
    <a href="<?= admin_url('blog') ?>" class="btn btn-outline-secondary btn-sm px-3">
      <i class="bi bi-arrow-left me-1"></i> Back to Blog Posts
    </a>
  </div>
</div>

<!-- Flash Alerts -->
<?php if ($msg = get_flash('success')): ?>
  <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i><?= e($msg) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if ($msg = get_flash('danger')): ?>
  <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i><?= e($msg) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<div class="row g-3">

  <!-- LEFT COLUMN: All Categories Table -->
  <div class="col-12 col-lg-7">
    <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
      <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h6 class="fw-bold mb-0 text-dark fs-13">All Categories</h6>
        <div style="width: 180px;">
          <input 
            type="text" 
            id="categorySearchInput" 
            class="form-control form-control-sm" 
            placeholder="Type name & Enter" 
            value="<?= e($search ?? '') ?>" 
            style="border-radius: 4px; border: 1px solid #e2e8f0; font-size: 12px; height: 30px;"
            onkeyup="filterCategoriesTable(this.value)"
            onkeypress="if(event.key==='Enter'){ window.location.href = '<?= admin_url('categories') ?>?search=' + encodeURIComponent(this.value); }"
          >
        </div>
      </div>
      
      <div class="card-body p-0">
        <!-- Categories Table -->
        <div class="table-responsive <?= empty($categories) ? 'd-none' : '' ?>" id="tableWrapper">
          <table class="table align-middle mb-0" id="categoriesTable">
            <thead style="background-color: #fafbfc; border-bottom: 1px solid #f1f5f9;">
              <tr style="color: #475569; font-size: 12px;">
                <th style="width: 50px; padding: 10px 16px;" class="fw-bold">#</th>
                <th style="padding: 10px 14px;" class="fw-bold">Name</th>
                <th style="padding: 10px 16px; width: 100px;" class="fw-bold text-end">Options</th>
              </tr>
            </thead>
            <tbody id="categoryTableBody">
              <?php $idx = 1; foreach ($categories as $cat): ?>
              <tr class="category-row" data-name="<?= strtolower(e($cat['name'])) ?>">
                <td style="padding: 14px 20px; color: #64748b; font-size: 13px;" class="fw-medium row-index"><?= $idx++ ?></td>
                <td style="padding: 14px 16px;">
                  <div class="d-flex align-items-center gap-2">
                    <span class="category-color-dot rounded-circle flex-shrink-0" style="width: 10px; height: 10px; background-color: <?= e($cat['color'] ?: '#E11D48') ?>; display: inline-block;"></span>
                    <span class="fw-semibold text-dark fs-14"><?= e($cat['name']) ?></span>
                    <?php if ((int)$cat['post_count'] > 0): ?>
                      <span class="badge bg-light text-secondary border fs-11 ms-1"><?= (int)$cat['post_count'] ?> posts</span>
                    <?php endif; ?>
                  </div>
                </td>
                <td style="padding: 14px 20px;" class="text-end">
                  <div class="d-inline-flex align-items-center gap-2">
                    <button type="button" class="btn btn-sm btn-light border p-1 px-2 text-primary" title="Edit Category" onclick="editCat(<?= htmlspecialchars(json_encode($cat)) ?>)">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <form method="POST" action="<?= admin_url('categories') ?>" onsubmit="return confirm('Delete category \'<?= e(addslashes($cat['name'])) ?>\'?')" class="d-inline m-0">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="delete_category">
                      <input type="hidden" name="cat_id" value="<?= $cat['id'] ?>">
                      <button type="submit" class="btn btn-sm btn-light border p-1 px-2 text-danger" title="Delete Category">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Empty State (Matches Reference Smiley "Nothing Found") -->
        <div id="nothingFoundContainer" class="text-center py-5 <?= empty($categories) ? '' : 'd-none' ?>">
          <div class="mb-3 d-inline-block">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
              <line x1="9" y1="9" x2="9.01" y2="9"></line>
              <line x1="15" y1="9" x2="15.01" y2="9"></line>
            </svg>
          </div>
          <h5 class="fw-medium text-secondary mb-0" style="color: #475569 !important; font-size: 1.15rem;">Nothing Found</h5>
        </div>
      </div>
    </div>
  </div>

  <!-- RIGHT COLUMN: Add / Edit Category Form -->
  <div class="col-12 col-lg-5">
    <div class="card border-0 shadow-sm rounded-3 bg-white">
      <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="fw-bold mb-0 text-dark" id="form_header_title" style="font-size: 15px;">Add New Blog Category</h6>
      </div>
      <div class="card-body p-4">
        <form method="POST" action="<?= admin_url('categories') ?>" id="categoryForm">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_category">
          <input type="hidden" name="cat_id" id="cat_id_field" value="0">

          <!-- Name Field -->
          <div class="mb-3">
            <label for="cat_name" class="form-label text-secondary fw-semibold fs-13 mb-2">Name</label>
            <input 
              type="text" 
              name="name" 
              id="cat_name" 
              class="form-control" 
              placeholder="Name" 
              required 
              oninput="autoCatSlug(this.value)" 
              style="border-radius: 4px; border: 1px solid #e2e8f0; padding: 8px 12px; font-size: 14px;"
            >
          </div>

          <!-- Advanced / Optional Settings (Slug, Color, Description) -->
          <div class="mb-3">
            <a class="text-decoration-none text-muted fs-12 d-inline-flex align-items-center gap-1" data-bs-toggle="collapse" href="#advancedCatSettings" role="button" aria-expanded="false" id="advancedToggleBtn">
              <i class="bi bi-sliders"></i> Optional settings (Slug, Color) <i class="bi bi-chevron-down fs-10"></i>
            </a>
            <div class="collapse mt-2" id="advancedCatSettings">
              <div class="p-3 bg-light rounded-2 border">
                <div class="mb-2">
                  <label class="form-label text-secondary fs-12 fw-semibold mb-1">URL Slug</label>
                  <input type="text" name="slug" id="cat_slug" class="form-control form-control-sm" placeholder="e.g. inventory-tips">
                </div>
                <div class="mb-2">
                  <label class="form-label text-secondary fs-12 fw-semibold mb-1">Description</label>
                  <textarea name="description" id="cat_desc" class="form-control form-control-sm" rows="2" placeholder="Brief category description"></textarea>
                </div>
                <div>
                  <label class="form-label text-secondary fs-12 fw-semibold mb-1">Badge Color</label>
                  <div class="d-flex align-items-center gap-2">
                    <input type="color" name="color" id="cat_color" value="#E11D48" class="form-control form-control-color p-0 border-0" style="width:36px;height:30px;cursor:pointer;">
                    <span class="text-muted fs-12">Pick accent color</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons (Pink Save button right-aligned) -->
          <div class="d-flex justify-content-end align-items-center gap-2 mt-4 pt-2">
            <button type="button" id="cancel_edit_btn" onclick="resetForm()" class="btn btn-light px-3 py-2 fw-semibold border fs-13" style="display: none; border-radius: 4px;">Cancel</button>
            <button type="submit" id="save_btn" class="btn text-white px-4 py-2 fw-semibold fs-13" style="background-color: #E11D48; border: none; border-radius: 4px; min-width: 80px; box-shadow: 0 2px 8px rgba(225,29,72,0.25);">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<!-- Client-side script for interactive responsiveness -->
<script>
let catSlugManuallyEdited = false;

function slugify(str) {
  return str.toLowerCase().trim()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/[\s-]+/g, '-');
}

function autoCatSlug(val) {
  if (!catSlugManuallyEdited) {
    const slugField = document.getElementById('cat_slug');
    if (slugField) slugField.value = slugify(val);
  }
}

document.addEventListener('DOMContentLoaded', function() {
  const slugInput = document.getElementById('cat_slug');
  if (slugInput) {
    slugInput.addEventListener('input', function() {
      catSlugManuallyEdited = true;
    });
  }
});

function editCat(cat) {
  document.getElementById('form_header_title').textContent = 'Edit Blog Category';
  document.getElementById('cat_id_field').value  = cat.id;
  document.getElementById('cat_name').value       = cat.name;
  document.getElementById('cat_slug').value       = cat.slug;
  document.getElementById('cat_desc').value       = cat.description || '';
  document.getElementById('cat_color').value      = cat.color || '#E11D48';
  document.getElementById('save_btn').textContent = 'Update';
  document.getElementById('cancel_edit_btn').style.display = 'inline-block';
  catSlugManuallyEdited = true;

  // Open advanced accordion if description or custom slug is present
  const advCollapse = document.getElementById('advancedCatSettings');
  if (advCollapse && typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
    const bsCollapse = new bootstrap.Collapse(advCollapse, { toggle: false });
    bsCollapse.show();
  }

  // Smooth scroll to form on mobile devices
  if (window.innerWidth < 992) {
    document.getElementById('categoryForm').scrollIntoView({ behavior: 'smooth' });
  }
}

function resetForm() {
  document.getElementById('form_header_title').textContent = 'Add New Blog Category';
  document.getElementById('cat_id_field').value  = '0';
  document.getElementById('cat_name').value       = '';
  document.getElementById('cat_slug').value       = '';
  document.getElementById('cat_desc').value       = '';
  document.getElementById('cat_color').value      = '#E11D48';
  document.getElementById('save_btn').textContent = 'Save';
  document.getElementById('cancel_edit_btn').style.display = 'none';
  catSlugManuallyEdited = false;
}

function filterCategoriesTable(query) {
  query = query.toLowerCase().trim();
  const rows = document.querySelectorAll('#categoryTableBody .category-row');
  let visibleCount = 0;

  rows.forEach(function(row) {
    const name = row.getAttribute('data-name') || '';
    if (name.includes(query)) {
      row.style.display = '';
      visibleCount++;
    } else {
      row.style.display = 'none';
    }
  });

  const tableWrapper = document.getElementById('tableWrapper');
  const emptyState = document.getElementById('nothingFoundContainer');

  if (visibleCount === 0) {
    if (tableWrapper) tableWrapper.classList.add('d-none');
    if (emptyState) emptyState.classList.remove('d-none');
  } else {
    if (tableWrapper) tableWrapper.classList.remove('d-none');
    if (emptyState) emptyState.classList.add('d-none');
  }
}
</script>
