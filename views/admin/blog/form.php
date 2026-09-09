<?php
/**
 * Professional WordPress / RankMath Style Blog Editor
 * Location: views/admin/blog/form.php
 */
$isEdit     = !empty($post);
$postId     = $isEdit ? (int)$post['id'] : 0;
$formAction = $isEdit ? admin_url('blog/update') : admin_url('blog/store');
?>

<!-- Quill Rich Text Editor CSS -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

<style>
/* WordPress / RankMath Admin Editor Style */
.ql-toolbar.ql-snow {
  position: sticky;
  top: 64px;
  z-index: 1015;
  background: #FFFFFF;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  border-color: #E2E8F0;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  transition: box-shadow 0.2s ease;
}
.ql-container.ql-snow {
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
  border-color: #E2E8F0;
  font-size: 15px;
  font-family: 'Inter', system-ui, sans-serif;
  min-height: 420px;
  background: #FFFFFF;
}
.ql-editor {
  min-height: 420px;
  line-height: 1.7;
}
.ql-editor h2 {
  font-weight: 700;
  color: #001540;
  margin-top: 1.5rem;
  margin-bottom: 0.75rem;
}
.ql-editor h3 {
  font-weight: 600;
  color: #001540;
  margin-top: 1.25rem;
  margin-bottom: 0.5rem;
}
.ql-editor p {
  margin-bottom: 1rem;
}
.google-preview-box {
  background: #FFFFFF;
  border: 1px solid #DFE1E5;
  border-radius: 8px;
  padding: 14px 16px;
  font-family: Arial, sans-serif;
}
.google-preview-url {
  color: #202124;
  font-size: 12px;
  line-height: 1.3;
  margin-bottom: 4px;
}
.google-preview-title {
  color: #1A0DAB;
  font-size: 18px;
  line-height: 1.3;
  font-weight: 400;
  cursor: pointer;
}
.google-preview-title:hover {
  text-decoration: underline;
}
.google-preview-desc {
  color: #4D5156;
  font-size: 13px;
  line-height: 1.4;
  margin-top: 4px;
}
.seo-score-circle {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 18px;
}
.sticky-seo-sidebar {
  position: sticky;
  top: 74px;
  z-index: 10;
}
</style>

<!-- Top Bar -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
  <div>
    <h4 class="fw-bold text-dark mb-1">
      <i class="bi bi-file-earmark-richtext-fill text-warning me-2"></i>
      <?= $isEdit ? 'Edit Blog Post' : 'Add New Blog Post' ?>
    </h4>
    <div class="fs-13 text-muted">
      RankMath & WordPress-style editor with real-time SEO content scoring
    </div>
  </div>
  <div class="d-flex align-items-center gap-2">
    <?php if ($isEdit): ?>
      <a href="<?= site_url('blog/' . $post['slug']) ?>" target="_blank" class="btn btn-outline-success btn-sm px-3 fw-semibold">
        <i class="bi bi-box-arrow-up-right me-1"></i> View Live
      </a>
    <?php endif; ?>
    <a href="<?= admin_url('blog') ?>" class="btn btn-outline-secondary btn-sm px-3">
      <i class="bi bi-arrow-left me-1"></i> All Posts
    </a>
  </div>
</div>

<!-- Flash Alerts -->
<?php if ($msg = get_flash('success')): ?>
  <div class="alert alert-success alert-dismissible border-0 shadow-sm mb-4"><i class="bi bi-check-circle-fill me-2"></i><?= e($msg) ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if ($msg = get_flash('danger')): ?>
  <div class="alert alert-danger alert-dismissible border-0 shadow-sm mb-4"><i class="bi bi-exclamation-triangle-fill me-2"></i><?= e($msg) ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<!-- Main Form -->
<form id="blog_post_form" method="POST" action="<?= $formAction ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <?php if ($isEdit): ?>
    <input type="hidden" name="id" value="<?= $postId ?>">
  <?php endif; ?>
  <input type="hidden" name="existing_image" value="<?= e($post['featured_image'] ?? '') ?>">

  <div class="row g-4">

    <!-- ═══════════════════════════════════════════════════════════════
         LEFT COLUMN: The Article Editor (WordPress Flow)
         ═══════════════════════════════════════════════════════════════ -->
    <div class="col-lg-8">

      <!-- Title & Slug -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
          <div class="mb-3">
            <label class="form-label fw-bold fs-14 text-dark">
              Post Title <span class="text-danger">*</span>
            </label>
            <input type="text" 
                   name="title" 
                   id="post_title" 
                   value="<?= e($post['title'] ?? '') ?>" 
                   class="form-control form-control-lg fw-bold fs-18" 
                   placeholder="Enter a compelling, keyword-rich title..." 
                   required>
          </div>

          <!-- Permalinks / Slug -->
          <div class="bg-light p-2 rounded-2 border">
            <div class="d-flex align-items-center gap-2 flex-wrap">
              <span class="fs-12 fw-semibold text-secondary">
                <i class="bi bi-link-45deg me-1"></i>Permalink:
              </span>
              <span class="fs-12 text-muted"><?= site_url('blog/') ?></span>
              <input type="text" 
                     name="slug" 
                     id="post_slug" 
                     value="<?= e($post['slug'] ?? '') ?>" 
                     class="form-control form-control-sm d-inline-block w-auto fs-12 py-0 px-2" 
                     style="min-width: 220px;" 
                     placeholder="post-url-slug">
              <button type="button" class="btn btn-link btn-sm p-0 fs-12 text-decoration-none" onclick="regenerateSlug()">
                Auto-generate
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Featured Image & Alt Text -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
          <h6 class="fw-bold mb-0 text-dark">
            <i class="bi bi-image-fill text-warning me-2"></i>Featured Image & Media SEO
          </h6>
          <span class="badge bg-light text-secondary border fs-11">OpenGraph & SERP Hero</span>
        </div>
        <div class="card-body p-4">
          <div class="row g-3 align-items-center">
            <div class="col-md-5">
              <div class="border rounded-3 p-2 text-center bg-light" style="min-height: 160px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <?php $hasImg = !empty($post['featured_image']); ?>
                <img id="featured_img_preview" 
                     src="<?= $hasImg ? e($post['featured_image']) : '' ?>" 
                     class="img-fluid rounded <?= $hasImg ? '' : 'd-none' ?>" 
                     style="max-height: 150px; width: 100%; object-fit: cover;" 
                     alt="Preview">
                <div id="featured_img_placeholder" class="<?= $hasImg ? 'd-none' : '' ?> text-muted py-4">
                  <i class="bi bi-cloud-arrow-up fs-1 d-block mb-1 opacity-50"></i>
                  <span class="fs-12">No image selected</span>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <label class="form-label fw-semibold fs-13 text-dark mb-1">Upload New Image</label>
              <input type="file" 
                     name="featured_image" 
                     id="featured_image_input" 
                     class="form-control form-control-sm mb-3" 
                     accept="image/*" 
                     onchange="previewFeaturedImage(this)">

              <label class="form-label fw-semibold fs-13 text-dark mb-1">
                Image Alt Text (Crucial for Image SEO)
              </label>
              <input type="text" 
                     name="alt_text" 
                     id="alt_text" 
                     value="<?= e($post['alt_text'] ?? '') ?>" 
                     class="form-control form-control-sm" 
                     placeholder="e.g. GoldMatrix Jewellery ERP barcode billing system">
              <div class="form-text fs-11">Describe what's in the image. Include your focus keyword naturally.</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Rich Text Content Editor (Quill) -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
          <h6 class="fw-bold mb-0 text-dark">
            <i class="bi bi-textarea-t text-primary me-2"></i>Article Content
          </h6>
          <div class="d-flex align-items-center gap-3 fs-12 text-muted">
            <span><i class="bi bi-fonts me-1"></i>Words: <strong id="editor_word_count">0</strong></span>
            <span><i class="bi bi-clock me-1"></i>Read: <strong id="editor_read_time">1 min</strong></span>
          </div>
        </div>
        <div class="card-body p-4">
          <!-- Hidden textarea that stores clean HTML for form submission -->
          <textarea name="content" id="post_content" class="d-none"><?= htmlspecialchars($post['content'] ?? '', ENT_QUOTES) ?></textarea>
          
          <!-- Quill Editor Container -->
          <div id="quill_editor_container"><?= $post['content'] ?? '' ?></div>
          
          <div class="d-flex align-items-center justify-content-between mt-2 pt-2 border-top fs-11 text-muted">
            <span>Tip: Use <strong>H2</strong> and <strong>H3</strong> headings to organize content. Insert bullet lists for readability.</span>
            <span>Image drag/drop enabled</span>
          </div>
        </div>
      </div>

      <!-- Excerpt & Taxonomy -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 border-bottom">
          <h6 class="fw-bold mb-0 text-dark">
            <i class="bi bi-tags-fill text-info me-2"></i>Excerpt, Categories & Tags
          </h6>
        </div>
        <div class="card-body p-4">
          <div class="mb-3">
            <label class="form-label fw-semibold fs-13 text-dark">Short Excerpt (Summary)</label>
            <textarea name="excerpt" 
                      id="post_excerpt" 
                      class="form-control" 
                      rows="2" 
                      placeholder="A short, catchy summary shown on archive and social media cards..."><?= e($post['excerpt'] ?? '') ?></textarea>
            <div class="form-text fs-11">Recommended: 120–160 characters.</div>
          </div>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold fs-13 text-dark">Category</label>
              <select name="category_id" class="form-select">
                <?php foreach ($categories as $cat): ?>
                  <option value="<?= $cat['id'] ?>" <?= ($post['category_id'] ?? 1) == $cat['id'] ? 'selected' : '' ?>>
                    <?= e($cat['name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold fs-13 text-dark">Tags (Comma-separated)</label>
              <input type="text" 
                     name="tags" 
                     id="post_tags" 
                     value="<?= e($post['tags'] ?? '') ?>" 
                     class="form-control" 
                     placeholder="e.g. ERP, GST Billing, Jewellery POS, RFID">
              <div class="form-text fs-11">Separate tags with commas.</div>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /col-lg-8 -->


    <!-- ═══════════════════════════════════════════════════════════════
         RIGHT COLUMN: Real-Time RankMath-Style SEO Sidebar
         ═══════════════════════════════════════════════════════════════ -->
    <div class="col-lg-4">
      <div class="sticky-seo-sidebar">

        <!-- 1. Publish & Status Box -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-send-fill text-primary me-2"></i>Publish</h6>
            <span class="badge <?= ($post['status'] ?? 'published') === 'published' ? 'bg-success' : 'bg-warning text-dark' ?> fs-11">
              <?= ucfirst($post['status'] ?? 'published') ?>
            </span>
          </div>
          <div class="card-body p-3">
            <div class="mb-3">
              <label class="form-label fw-semibold fs-12 text-secondary mb-1">Status</label>
              <select name="status" class="form-select form-select-sm">
                <option value="published" <?= ($post['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Published (Live on Site)</option>
                <option value="draft"     <?= ($post['status'] ?? '') === 'draft'     ? 'selected' : '' ?>>Draft (Internal)</option>
              </select>
            </div>

            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label fw-semibold fs-12 text-secondary mb-1">Author</label>
                <input type="text" name="author_name" value="<?= e($post['author_name'] ?? 'GoldMatrix Team') ?>" class="form-control form-control-sm">
              </div>
              <div class="col-6">
                <label class="form-label fw-semibold fs-12 text-secondary mb-1">Publish Date</label>
                <input type="text" name="published_at" value="<?= e($post['published_at'] ?? date('Y-m-d H:i:s')) ?>" class="form-control form-control-sm fs-11">
              </div>
            </div>

            <div class="d-grid gap-2 pt-2 border-top">
              <button type="submit" class="btn btn-warning fw-bold py-2 shadow-sm">
                <i class="bi bi-check2-circle me-1"></i>
                <?= $isEdit ? 'Update Post' : 'Publish Post' ?>
              </button>
              <?php if ($isEdit): ?>
                <a href="<?= admin_url('blog') ?>" class="btn btn-outline-secondary btn-sm">Discard Changes</a>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- 2. Live SEO Score & Focus Keyword Card -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <h6 class="fw-bold mb-0 text-dark">
              <i class="bi bi-graph-up-arrow text-success me-2"></i>SEO Analysis
            </h6>
            <span class="fs-12 fw-bold" id="seo_score_level" style="color: #10B981;">Good SEO</span>
          </div>
          <div class="card-body p-3">
            
            <!-- Overall Score Progress -->
            <div class="d-flex align-items-center gap-3 mb-3 p-2 bg-light rounded-3">
              <div class="seo-score-circle shadow-sm" id="seo_score_badge" style="background-color: #10B981; color:#fff;">
                <span id="seo_score_text">0</span>
              </div>
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="fs-12 fw-bold text-dark">Overall SEO Score</span>
                  <span class="fs-11 text-muted">Max: 100</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div id="seo_score_progress" class="progress-bar" style="width: 0%; background-color: #10B981;"></div>
                </div>
              </div>
            </div>

            <!-- Focus Keyword Input -->
            <div class="mb-3">
              <label class="form-label fw-bold fs-13 text-dark d-flex justify-content-between align-items-center mb-1">
                <span><i class="bi bi-bullseye text-danger me-1"></i>Focus Keyword</span>
                <span class="badge bg-light text-secondary border fs-10">Primary Target</span>
              </label>
              <input type="text" 
                     name="focus_keyword" 
                     id="focus_keyword" 
                     value="<?= e($post['focus_keyword'] ?? '') ?>" 
                     class="form-control form-control-sm fw-semibold" 
                     placeholder="e.g. jewellery erp software">
              <div class="form-text fs-11">The search term you want this post to rank for on Google.</div>
            </div>

            <!-- Live Google SERP Snippet Preview -->
            <div class="mb-3">
              <label class="form-label fw-bold fs-12 text-secondary mb-1">
                <i class="bi bi-google me-1"></i>Google Search Preview
              </label>
              <div class="google-preview-box">
                <div class="google-preview-url" id="preview_google_url"><?= site_url('blog/' . ($post['slug'] ?? 'sample-slug')) ?></div>
                <div class="google-preview-title" id="preview_google_title"><?= e($post['meta_title'] ?? $post['title'] ?? 'Title Preview') ?></div>
                <div class="google-preview-desc" id="preview_google_desc"><?= e($post['meta_description'] ?? $post['excerpt'] ?? 'Meta description snippet will appear here...') ?></div>
              </div>
            </div>

            <!-- SEO Title & Meta Description Inputs -->
            <div class="mb-3">
              <label class="form-label fw-semibold fs-12 text-dark mb-1">SEO Title</label>
              <input type="text" 
                     name="meta_title" 
                     id="meta_title" 
                     value="<?= e($post['meta_title'] ?? '') ?>" 
                     class="form-control form-control-sm" 
                     placeholder="Google SERP Title...">
              <div class="d-flex justify-content-between fs-10 text-muted mt-1">
                <span>Target: 40–60 chars</span>
                <span id="meta_title_counter">0 chars</span>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold fs-12 text-dark mb-1">Meta Description</label>
              <textarea name="meta_description" 
                        id="meta_description" 
                        class="form-control form-control-sm" 
                        rows="3" 
                        placeholder="Snippet shown beneath title in Google results..."><?= e($post['meta_description'] ?? '') ?></textarea>
              <div class="d-flex justify-content-between fs-10 text-muted mt-1">
                <span>Target: 120–160 chars</span>
                <span id="meta_desc_counter">0 chars</span>
              </div>
            </div>

            <!-- Live Checklist Accordion (RankMath Style) -->
            <div class="border rounded-3 p-3 bg-white">
              <div class="fw-bold fs-12 text-dark mb-2 d-flex align-items-center justify-content-between">
                <span><i class="bi bi-list-check me-1 text-primary"></i>Live SEO Audit</span>
                <span class="badge bg-light text-muted border fs-10">Real-Time</span>
              </div>
              <div id="seo_checklist_results">
                <!-- Injected live by blog-seo-analyzer.js -->
              </div>
            </div>

            <!-- Advanced SEO Accordion -->
            <div class="accordion mt-3" id="advancedSeoAccordion">
              <div class="accordion-item border-0">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed bg-light py-2 fs-12 fw-semibold text-secondary rounded" type="button" data-bs-toggle="collapse" data-bs-target="#advancedSeoBody">
                    <i class="bi bi-gear-fill me-2"></i>Advanced SEO & Schema
                  </button>
                </h2>
                <div id="advancedSeoBody" class="accordion-collapse collapse" data-bs-parent="#advancedSeoAccordion">
                  <div class="accordion-body p-2 pt-3 fs-12">
                    <div class="mb-2">
                      <label class="form-label fw-semibold fs-11 text-secondary mb-1">Canonical URL</label>
                      <input type="text" name="canonical_url" value="<?= e($post['canonical_url'] ?? '') ?>" class="form-control form-control-sm fs-11" placeholder="Leave empty for auto self-canonical">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-semibold fs-11 text-secondary mb-1">Robots Meta</label>
                      <select name="robots" class="form-select form-select-sm fs-11">
                        <option value="index,follow" <?= ($post['robots'] ?? 'index,follow') === 'index,follow' ? 'selected' : '' ?>>index, follow (Default)</option>
                        <option value="noindex,follow" <?= ($post['robots'] ?? '') === 'noindex,follow' ? 'selected' : '' ?>>noindex, follow</option>
                        <option value="noindex,nofollow" <?= ($post['robots'] ?? '') === 'noindex,nofollow' ? 'selected' : '' ?>>noindex, nofollow</option>
                      </select>
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-semibold fs-11 text-secondary mb-1">Schema Type</label>
                      <select name="schema_type" class="form-select form-select-sm fs-11">
                        <option value="BlogPosting" <?= ($post['schema_type'] ?? 'BlogPosting') === 'BlogPosting' ? 'selected' : '' ?>>BlogPosting (Recommended)</option>
                        <option value="Article" <?= ($post['schema_type'] ?? '') === 'Article' ? 'selected' : '' ?>>Article</option>
                        <option value="NewsArticle" <?= ($post['schema_type'] ?? '') === 'NewsArticle' ? 'selected' : '' ?>>NewsArticle</option>
                      </select>
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-semibold fs-11 text-secondary mb-1">Custom OG Title</label>
                      <input type="text" name="og_title" value="<?= e($post['og_title'] ?? '') ?>" class="form-control form-control-sm fs-11" placeholder="Defaults to SEO Title">
                    </div>
                    <div class="mb-2">
                      <label class="form-label fw-semibold fs-11 text-secondary mb-1">Custom OG Description</label>
                      <textarea name="og_description" class="form-control form-control-sm fs-11" rows="2" placeholder="Defaults to Meta Description"><?= e($post['og_description'] ?? '') ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /advancedSeoAccordion -->

          </div>
        </div><!-- /card -->

      </div>
    </div><!-- /col-lg-4 -->

  </div><!-- /row -->
</form>

<!-- Quill Rich Text Editor Script -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<!-- SEO Analyzer JS -->
<script src="<?= asset('js/blog-seo-analyzer.js') ?>"></script>

<script>
// 1. Initialize Quill Rich Text Editor
document.addEventListener('DOMContentLoaded', function() {
  const toolbarOptions = [
    [{ 'header': [2, 3, false] }],
    ['bold', 'italic', 'underline', 'strike'],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    ['blockquote'],
    ['link', 'image'],
    ['clean']
  ];

  window.quillEditor = new Quill('#quill_editor_container', {
    theme: 'snow',
    placeholder: 'Write your article here... Structure with H2/H3 headings, short paragraphs, and bullet points.',
    modules: {
      toolbar: toolbarOptions
    }
  });

  // Sync Quill HTML to hidden textarea on text-change
  const hiddenContent = document.getElementById('post_content');
  window.quillEditor.on('text-change', function() {
    hiddenContent.value = window.quillEditor.root.innerHTML;
    updateWordMetrics();
    if (window.seoAnalyzer) {
      window.seoAnalyzer.analyze();
    }
  });

  // Image Upload handler for Quill
  const toolbar = window.quillEditor.getModule('toolbar');
  toolbar.addHandler('image', function() {
    selectLocalImage();
  });

  function selectLocalImage() {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.click();

    input.onchange = function() {
      const file = input.files[0];
      if (/^image\//.test(file.type)) {
        saveImageToServer(file);
      }
    };
  }

  function saveImageToServer(file) {
    const fd = new FormData();
    fd.append('image', file);
    fd.append('csrf_token', '<?= csrf_token() ?>');

    fetch('<?= admin_url('blog/upload-image') ?>', {
      method: 'POST',
      body: fd
    })
    .then(r => r.json())
    .then(data => {
      if (data.success && data.url) {
        const range = window.quillEditor.getSelection(true);
        window.quillEditor.insertEmbed(range.index, 'image', data.url);
      } else {
        alert('Failed to upload image');
      }
    })
    .catch(err => {
      console.error(err);
      alert('Upload error');
    });
  }

  // 2. Initialize Real-Time SEO Analyzer
  window.seoAnalyzer = window.initBlogSeoAnalyzer({
    siteBaseUrl: '<?= site_url('blog/') ?>'
  });

  // 3. Setup Character Counters
  setupCharCounters();
  updateWordMetrics();
});

// Auto slug generation
let slugManuallyEdited = <?= ($isEdit && !empty($post['slug'])) ? 'true' : 'false' ?>;
document.getElementById('post_title').addEventListener('input', function() {
  if (!slugManuallyEdited) {
    document.getElementById('post_slug').value = slugifyText(this.value);
  }
});
document.getElementById('post_slug').addEventListener('input', function() {
  slugManuallyEdited = true;
});
function regenerateSlug() {
  const title = document.getElementById('post_title').value;
  document.getElementById('post_slug').value = slugifyText(title);
  slugManuallyEdited = false;
  if (window.seoAnalyzer) window.seoAnalyzer.analyze();
}
function slugifyText(text) {
  return text.toString().toLowerCase()
    .trim()
    .replace(/[^a-z0-9 -]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-');
}

// Featured Image Preview
function previewFeaturedImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById('featured_img_preview');
      const placeholder = document.getElementById('featured_img_placeholder');
      preview.src = e.target.result;
      preview.classList.remove('d-none');
      if (placeholder) placeholder.classList.add('d-none');
      if (window.seoAnalyzer) window.seoAnalyzer.analyze();
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Word & Reading Metrics
function updateWordMetrics() {
  const text = window.quillEditor ? window.quillEditor.getText() : '';
  const words = text.trim() ? text.trim().split(/\s+/).filter(w => w.length > 0) : [];
  const count = words.length;
  const readTime = Math.max(1, Math.ceil(count / 200));

  const wordEl = document.getElementById('editor_word_count');
  const readEl = document.getElementById('editor_read_time');
  if (wordEl) wordEl.textContent = count;
  if (readEl) readEl.textContent = readTime + ' min';
}

// Character Counters
function setupCharCounters() {
  const titleInput = document.getElementById('meta_title');
  const descInput = document.getElementById('meta_description');
  const titleCounter = document.getElementById('meta_title_counter');
  const descCounter = document.getElementById('meta_desc_counter');

  function update() {
    if (titleCounter && titleInput) {
      const len = titleInput.value.length;
      titleCounter.textContent = `${len}/60 chars`;
      titleCounter.className = (len >= 40 && len <= 65) ? 'fs-10 text-success fw-bold' : 'fs-10 text-muted';
    }
    if (descCounter && descInput) {
      const len = descInput.value.length;
      descCounter.textContent = `${len}/160 chars`;
      descCounter.className = (len >= 110 && len <= 165) ? 'fs-10 text-success fw-bold' : 'fs-10 text-muted';
    }
  }

  if (titleInput) titleInput.addEventListener('input', update);
  if (descInput) descInput.addEventListener('input', update);
  update();
}

// Before submitting form, make sure Quill content is in textarea
document.getElementById('blog_post_form').addEventListener('submit', function() {
  if (window.quillEditor) {
    document.getElementById('post_content').value = window.quillEditor.root.innerHTML;
  }
});
</script>
