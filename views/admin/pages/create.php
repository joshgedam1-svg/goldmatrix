<?php
/**
 * GoldMatrix ERP - Create New Page
 */
?>
<div class="container-fluid px-0">

  <!-- PAGE HEADER & ACTIONS -->
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center gap-3">
      <div class="p-3 bg-primary-subtle text-primary rounded-3">
        <i class="bi bi-file-earmark-plus-fill fs-3"></i>
      </div>
      <div>
        <h2 class="h4 fw-bold text-dark mb-0">Create New Website Page</h2>
        <p class="text-muted small mb-0 mt-1">Add a new page with custom content, URL route, and SEO configuration.</p>
      </div>
    </div>
    <div class="d-flex align-items-center gap-2">
      <a href="<?= admin_url('pages') ?>" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-2 px-3 py-2">
        <i class="bi bi-arrow-left"></i>
        <span>Back to Pages</span>
      </a>
    </div>
  </div>

  <!-- CREATE FORM -->
  <form action="<?= admin_url('pages/create') ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

    <div class="row g-4">
      
      <!-- LEFT COLUMN: MAIN CONTENT (8 Cols) -->
      <div class="col-lg-8">
        
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0 text-dark">
              <i class="bi bi-card-heading text-primary me-2"></i>Page Content & Information
            </h5>
          </div>
          <div class="card-body p-4">
            
            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Page Heading / Title <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control form-control-lg" required placeholder="e.g. Retail POS Billing System">
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Hero Subtitle / Tagline</label>
              <textarea name="subtitle" class="form-control" rows="2" placeholder="Brief introduction banner subtitle..."></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Main Body Content / Details</label>
              <textarea name="content" class="form-control" rows="12" placeholder="Write detailed page content or HTML sections..."></textarea>
            </div>

          </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0 text-dark">
              <i class="bi bi-google text-primary me-2"></i>SEO & Meta Tags
            </h5>
          </div>
          <div class="card-body p-4">
            
            <div class="mb-3">
              <label class="form-label fw-bold text-dark">SEO Meta Title</label>
              <input type="text" name="meta_title" class="form-control" placeholder="e.g. Retail POS Billing Software | GoldMatrix ERP">
            </div>

            <div class="mb-0">
              <label class="form-label fw-bold text-dark">SEO Meta Description</label>
              <textarea name="meta_description" class="form-control" rows="3" placeholder="Compelling summary for Google search results..."></textarea>
            </div>

          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN: SETTINGS & PUBLISHING (4 Cols) -->
      <div class="col-lg-4">
        
        <div class="card border-0 shadow-sm mb-4 border-top border-4 border-primary">
          <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold mb-0 text-dark">
              <i class="bi bi-cloud-arrow-up-fill text-primary me-2"></i>Publishing Actions
            </h5>
          </div>
          <div class="card-body p-4">
            
            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Status</label>
              <select name="status" class="form-select">
                <option value="published">Published (Live on Website)</option>
                <option value="draft">Draft (Hidden)</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold text-dark">URL Slug / Path</label>
              <div class="input-group">
                <span class="input-group-text bg-light">/</span>
                <input type="text" name="slug" class="form-control" placeholder="auto-generated-from-title">
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label fw-bold text-dark">Page Layout Template</label>
              <select name="template" class="form-select">
                <option value="default">Default Template</option>
                <option value="features">Features & Capabilities</option>
                <option value="about">About Us & Story</option>
                <option value="contact">Contact & Consultation</option>
                <option value="services">Services & Modules Hub</option>
              </select>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg fw-bold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm">
                <i class="bi bi-plus-circle fs-5"></i>
                <span>Publish Page</span>
              </button>
            </div>

          </div>
        </div>

      </div>

    </div>
  </form>

</div>
