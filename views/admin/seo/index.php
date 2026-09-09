<?php
/**
 * Universal SEO & Webmaster Manager View
 * Location: views/admin/seo/index.php
 */
$activeTab = $activeTab ?? 'general';
$s = $seoSettings ?? [];
?>

<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-3 pb-2 border-bottom">
  <div>
    <h4 class="fw-bold mb-1 text-dark" style="font-size: 1.15rem;">
      <i class="bi bi-search text-secondary me-2"></i>SEO & Webmaster Manager
    </h4>
    <p class="text-muted fs-12 mb-0">Configure site-wide search engine optimization, Open Graph social cards, analytics scripts & XML Sitemap.</p>
  </div>
  <div class="d-flex align-items-center gap-2">
    <a href="<?= site_url('sitemap.xml') ?>" target="_blank" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
      <i class="bi bi-diagram-3 text-primary"></i> <span>Sitemap.xml</span>
    </a>
    <a href="<?= site_url('robots.txt') ?>" target="_blank" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
      <i class="bi bi-file-earmark-code"></i> <span>Robots.txt</span>
    </a>
  </div>
</div>

<!-- SEO AUDIT MINI METRIC OVERVIEW -->
<div class="row g-3 mb-4">
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100 border-start border-4 border-<?= $seoHealthScore >= 80 ? 'success' : ($seoHealthScore >= 50 ? 'warning' : 'danger') ?>">
      <div class="d-flex align-items-center justify-content-between mb-1">
        <span class="text-muted fs-12 fw-bold text-uppercase">SEO Health Score</span>
        <i class="bi bi-shield-check fs-4 text-<?= $seoHealthScore >= 80 ? 'success' : 'warning' ?>"></i>
      </div>
      <div class="d-flex align-items-baseline gap-2">
        <h3 class="fw-bold text-dark mb-0"><?= $seoHealthScore ?>%</h3>
        <span class="badge bg-<?= $seoHealthScore >= 80 ? 'success' : 'warning' ?>-subtle text-<?= $seoHealthScore >= 80 ? 'success' : 'warning' ?> fs-12"><?= $seoHealthScore >= 80 ? 'Optimal' : 'Needs Attention' ?></span>
      </div>
      <div class="progress mt-2" style="height: 6px;">
        <div class="progress-bar bg-<?= $seoHealthScore >= 80 ? 'success' : 'warning' ?>" style="width: <?= $seoHealthScore ?>%"></div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100 border-start border-4 border-primary">
      <div class="d-flex align-items-center justify-content-between mb-1">
        <span class="text-muted fs-12 fw-bold text-uppercase">Total Indexed Items</span>
        <i class="bi bi-files fs-4 text-primary"></i>
      </div>
      <h3 class="fw-bold text-dark mb-0"><?= $totalAudited ?></h3>
      <p class="text-muted fs-12 mb-0 mt-1">Pages, Features & Blog Posts</p>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100 border-start border-4 border-warning">
      <div class="d-flex align-items-center justify-content-between mb-1">
        <span class="text-muted fs-12 fw-bold text-uppercase">Missing Meta Titles</span>
        <i class="bi bi-exclamation-triangle-fill fs-4 text-warning"></i>
      </div>
      <h3 class="fw-bold text-dark mb-0"><?= $missingTitles ?></h3>
      <p class="text-muted fs-12 mb-0 mt-1"><?= $missingTitles > 0 ? 'Using universal fallback title' : 'All items have custom titles' ?></p>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100 border-start border-4 border-info">
      <div class="d-flex align-items-center justify-content-between mb-1">
        <span class="text-muted fs-12 fw-bold text-uppercase">Active 301 Redirects</span>
        <i class="bi bi-arrow-return-right fs-4 text-info"></i>
      </div>
      <h3 class="fw-bold text-dark mb-0"><?= count($redirects) ?></h3>
      <p class="text-muted fs-12 mb-0 mt-1">Permanent URL mapping rules</p>
    </div>
  </div>
</div>

<!-- MAIN TABBED INTERFACE -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
  <div class="card-header bg-white border-bottom p-0">
    <ul class="nav nav-tabs nav-tabs-custom border-0 px-3 pt-2" id="seoTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= $activeTab === 'general' ? 'active' : '' ?>" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-pane" type="button" role="tab">
          <i class="bi bi-globe me-2 text-primary"></i>Global Meta & Titles
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= $activeTab === 'social' ? 'active' : '' ?>" id="social-tab" data-bs-toggle="tab" data-bs-target="#social-pane" type="button" role="tab">
          <i class="bi bi-share me-2 text-info"></i>Social & OpenGraph
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= $activeTab === 'tracking' ? 'active' : '' ?>" id="tracking-tab" data-bs-toggle="tab" data-bs-target="#tracking-pane" type="button" role="tab">
          <i class="bi bi-code-slash me-2 text-success"></i>Webmaster & Tracking
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= $activeTab === 'schema' ? 'active' : '' ?>" id="schema-tab" data-bs-toggle="tab" data-bs-target="#schema-pane" type="button" role="tab">
          <i class="bi bi-diagram-2 me-2 text-warning"></i>Schema.org JSON-LD
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= $activeTab === 'sitemap' ? 'active' : '' ?>" id="sitemap-tab" data-bs-toggle="tab" data-bs-target="#sitemap-pane" type="button" role="tab">
          <i class="bi bi-diagram-3 me-2 text-danger"></i>XML Sitemap & Robots
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= $activeTab === 'audit' ? 'active' : '' ?>" id="audit-tab" data-bs-toggle="tab" data-bs-target="#audit-pane" type="button" role="tab">
          <i class="bi bi-speedometer2 me-2 text-secondary"></i>On-Page SEO Auditor
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= $activeTab === 'redirects' ? 'active' : '' ?>" id="redirects-tab" data-bs-toggle="tab" data-bs-target="#redirects-pane" type="button" role="tab">
          <i class="bi bi-arrow-left-right me-2 text-dark"></i>301 Redirects
        </button>
      </li>
    </ul>
  </div>

  <div class="card-body p-4">
    <div class="tab-content" id="seoTabsContent">

      <!-- ═══════════════════════════════════════════════════════════
           TAB 1: GLOBAL META & TITLES
      ════════════════════════════════════════════════════════════ -->
      <div class="tab-pane fade <?= $activeTab === 'general' ? 'show active' : '' ?>" id="general-pane" role="tabpanel">
        <form action="<?= admin_url('seo') ?>?tab=general" method="POST">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">

          <div class="row g-4">
            <div class="col-12 col-lg-7">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-sliders2 text-primary me-2"></i>Default Meta Tags & Title Structure
              </h6>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Default Website Meta Title <span class="text-danger">*</span></label>
                <input type="text" 
                       name="settings[default_seo_title]" 
                       id="input_meta_title"
                       class="form-control" 
                       value="<?= e($s['default_seo_title'] ?? 'GoldMatrix — The Complete Jewellery ERP Software in India') ?>" 
                       required>
                <div class="d-flex justify-content-between align-items-center mt-1">
                  <span class="fs-12 text-muted">Recommended: 50-60 characters</span>
                  <span id="title_counter" class="fs-12 fw-bold text-success">0 chars</span>
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Title Separator</label>
                  <select name="settings[site_title_separator]" class="form-select">
                    <option value="|" <?= ($s['site_title_separator'] ?? '|') === '|' ? 'selected' : '' ?>>| (Pipe)</option>
                    <option value="-" <?= ($s['site_title_separator'] ?? '') === '-' ? 'selected' : '' ?>>- (Hyphen)</option>
                    <option value="•" <?= ($s['site_title_separator'] ?? '') === '•' ? 'selected' : '' ?>>• (Bullet)</option>
                    <option value="—" <?= ($s['site_title_separator'] ?? '') === '—' ? 'selected' : '' ?>>— (Em Dash)</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Site Name Suffix</label>
                  <input type="text" name="settings[site_name_suffix]" class="form-control" value="<?= e($s['site_name_suffix'] ?? 'GoldMatrix ERP') ?>">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Default Meta Description <span class="text-danger">*</span></label>
                <textarea name="settings[default_meta_description]" 
                          id="input_meta_desc"
                          class="form-control" 
                          rows="3" 
                          required><?= e($s['default_meta_description'] ?? 'All-in-one Jewellery ERP software for inventory, billing, POS, manufacturing, Karigar tracking, GST accounting & multi-branch showroom control.') ?></textarea>
                <div class="d-flex justify-content-between align-items-center mt-1">
                  <span class="fs-12 text-muted">Recommended: 140-160 characters</span>
                  <span id="desc_counter" class="fs-12 fw-bold text-success">0 chars</span>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Universal Meta Keywords</label>
                <textarea name="settings[default_keywords]" class="form-control" rows="2" placeholder="comma-separated keywords"><?= e($s['default_keywords'] ?? 'jewellery erp, jewelry software india, jewellery pos billing, karigar management software, gold shop accounting software') ?></textarea>
                <span class="fs-12 text-muted">Separate keywords with commas. Used by search engines for categorization.</span>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Default Robots Directive</label>
                  <select name="settings[default_robots]" class="form-select">
                    <option value="index, follow" <?= ($s['default_robots'] ?? 'index, follow') === 'index, follow' ? 'selected' : '' ?>>index, follow (Standard Indexing)</option>
                    <option value="noindex, follow" <?= ($s['default_robots'] ?? '') === 'noindex, follow' ? 'selected' : '' ?>>noindex, follow (Do not index, follow links)</option>
                    <option value="index, nofollow" <?= ($s['default_robots'] ?? '') === 'index, nofollow' ? 'selected' : '' ?>>index, nofollow (Index, do not follow)</option>
                    <option value="noindex, nofollow" <?= ($s['default_robots'] ?? '') === 'noindex, nofollow' ? 'selected' : '' ?>>noindex, nofollow (Block completely)</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Canonical Domain (Optional)</label>
                  <input type="text" name="settings[canonical_domain]" class="form-control" placeholder="https://www.yourdomain.com" value="<?= e($s['canonical_domain'] ?? '') ?>">
                </div>
              </div>

              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 mt-4">
                <i class="bi bi-geo-alt text-danger me-2"></i>Local SEO & Geo Meta Tags
              </h6>

              <div class="row g-3 mb-3">
                <div class="col-sm-4">
                  <label class="form-label fw-semibold fs-13 text-dark">Geo Region</label>
                  <input type="text" name="settings[geo_region]" class="form-control" value="<?= e($s['geo_region'] ?? 'IN-MH') ?>" placeholder="IN-MH">
                </div>
                <div class="col-sm-4">
                  <label class="form-label fw-semibold fs-13 text-dark">Geo Placename</label>
                  <input type="text" name="settings[geo_placename]" class="form-control" value="<?= e($s['geo_placename'] ?? 'Mumbai, Maharashtra, India') ?>">
                </div>
                <div class="col-sm-4">
                  <label class="form-label fw-semibold fs-13 text-dark">Geo Coordinates (Lat;Long)</label>
                  <input type="text" name="settings[geo_position]" class="form-control" value="<?= e($s['geo_position'] ?? '19.0760;72.8777') ?>" placeholder="19.0760;72.8777">
                </div>
              </div>
            </div>

            <!-- LIVE SERP PREVIEW BOX -->
            <div class="col-12 col-lg-5">
              <div class="card border rounded-3 p-3 bg-light position-sticky" style="top: 20px;">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                  <span class="fw-bold fs-13 text-dark"><i class="bi bi-google text-primary me-2"></i>Live Google SERP Snippet Preview</span>
                  <span class="badge bg-white text-dark border fs-12">Desktop & Mobile</span>
                </div>

                <!-- Google Search Card Preview -->
                <div class="google-serp-box p-3 bg-white rounded-3 shadow-sm border mb-3">
                  <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center fw-bold text-dark" style="width:24px; height:24px; font-size:10px;">GM</div>
                    <div>
                      <div class="fs-12 text-dark fw-semibold" style="line-height:1.2;"><?= e(setting('company_name', 'GoldMatrix ERP')) ?></div>
                      <div class="fs-11 text-muted text-truncate" style="max-width:280px;"><?= site_url() ?></div>
                    </div>
                  </div>
                  <h6 id="serp_preview_title" class="fw-medium text-primary mb-1 text-decoration-underline" style="cursor:pointer; line-height:1.3; font-size:16px;">
                    <?= e($s['default_seo_title'] ?? 'GoldMatrix — The Complete Jewellery ERP Software in India') ?>
                  </h6>
                  <p id="serp_preview_desc" class="fs-13 text-secondary mb-0" style="line-height:1.4;">
                    <?= e($s['default_meta_description'] ?? 'All-in-one Jewellery ERP software for inventory, billing, POS, manufacturing, Karigar tracking, GST accounting & multi-branch showroom control.') ?>
                  </p>
                </div>

                <div class="alert alert-info border-0 rounded-3 fs-12 mb-0">
                  <i class="bi bi-info-circle-fill me-1"></i>
                  <strong>SEO Tip:</strong> Keep your meta title between <strong>50-60 characters</strong> and meta description between <strong>140-160 characters</strong> to prevent truncation in Google search results.
                </div>
              </div>
            </div>
          </div>

          <div class="mt-4 pt-3 border-top d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" style="background-color:#0B1F3A; border-color:#0B1F3A;">
              <i class="bi bi-check2-circle me-1"></i> Save Global SEO Settings
            </button>
          </div>
        </form>
      </div>

      <!-- ═══════════════════════════════════════════════════════════
           TAB 2: SOCIAL MEDIA & OPEN GRAPH
      ════════════════════════════════════════════════════════════ -->
      <div class="tab-pane fade <?= $activeTab === 'social' ? 'show active' : '' ?>" id="social-pane" role="tabpanel">
        <form action="<?= admin_url('seo') ?>?tab=social" method="POST" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">

          <div class="row g-4">
            <div class="col-12 col-lg-7">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-share text-info me-2"></i>OpenGraph & Social Sharing Meta Settings
              </h6>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Default OpenGraph Share Image (WhatsApp / Facebook / LinkedIn)</label>
                <div class="d-flex align-items-center gap-3">
                  <div class="border rounded p-1 bg-light text-center" style="width:120px; height:70px; overflow:hidden;">
                    <?php $ogImg = $s['default_og_image'] ?? '/assets/images/why-goldmatrix-mockup.png'; ?>
                    <img id="og_image_preview" src="<?= e(strpos($ogImg, 'http') === 0 ? $ogImg : site_url($ogImg)) ?>" alt="OG Preview" style="width:100%; height:100%; object-fit:cover;">
                  </div>
                  <div class="flex-grow-1">
                    <input type="file" name="default_og_image_file" class="form-control form-control-sm mb-1" accept="image/*" onchange="previewOgImage(this)">
                    <span class="fs-12 text-muted">Recommended size: <strong>1200 × 630 px</strong> (JPG, PNG, WebP)</span>
                  </div>
                </div>
                <input type="hidden" name="settings[default_og_image]" value="<?= e($ogImg) ?>">
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">OG Site Name</label>
                  <input type="text" name="settings[og_sitename]" class="form-control" value="<?= e($s['og_sitename'] ?? 'GoldMatrix Jewelry ERP') ?>">
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">OG Type</label>
                  <select name="settings[og_type]" class="form-select">
                    <option value="website" <?= ($s['og_type'] ?? 'website') === 'website' ? 'selected' : '' ?>>website</option>
                    <option value="article" <?= ($s['og_type'] ?? '') === 'article' ? 'selected' : '' ?>>article</option>
                    <option value="business.business" <?= ($s['og_type'] ?? '') === 'business.business' ? 'selected' : '' ?>>business.business</option>
                  </select>
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Twitter / X Handle</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-twitter-x"></i></span>
                    <input type="text" name="settings[twitter_handle]" class="form-control" value="<?= e($s['twitter_handle'] ?? '@goldmatrixerp') ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Twitter Card Type</label>
                  <select name="settings[twitter_card_type]" class="form-select">
                    <option value="summary_large_image" <?= ($s['twitter_card_type'] ?? 'summary_large_image') === 'summary_large_image' ? 'selected' : '' ?>>summary_large_image (Big Banner)</option>
                    <option value="summary" <?= ($s['twitter_card_type'] ?? '') === 'summary' ? 'selected' : '' ?>>summary (Square Thumbnail)</option>
                  </select>
                </div>
              </div>

              <div class="alert alert-light border rounded-3 p-3 mt-4 mb-3 d-flex align-items-center justify-content-between">
                <div>
                  <div class="fw-bold text-dark fs-13 mb-1"><i class="bi bi-share text-primary me-2"></i>Official Social Media Profiles</div>
                  <div class="text-muted fs-12">Social media links and custom profiles are managed centrally under Global Settings.</div>
                </div>
                <a href="/admin/settings?tab=social" class="btn btn-sm btn-primary text-nowrap">
                  <i class="bi bi-sliders me-1"></i> Manage Social Media Links
                </a>
              </div>
            </div>

            <!-- LIVE SOCIAL SHARE CARD PREVIEWS -->
            <div class="col-12 col-lg-5">
              <div class="card border rounded-3 p-3 bg-light position-sticky" style="top: 20px;">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                  <span class="fw-bold fs-13 text-dark"><i class="bi bi-share-fill text-info me-2"></i>Social Card Live Preview</span>
                  <span class="badge bg-primary text-white fs-12">WhatsApp / Facebook</span>
                </div>

                <!-- Simulated Facebook / WhatsApp Card -->
                <div class="facebook-card-preview bg-white rounded-3 shadow-sm border overflow-hidden mb-3">
                  <div style="height: 160px; overflow: hidden; background:#111;">
                    <img id="social_banner_preview" src="<?= e(strpos($ogImg, 'http') === 0 ? $ogImg : site_url($ogImg)) ?>" alt="Social Banner" style="width:100%; height:100%; object-fit:cover;">
                  </div>
                  <div class="p-3 bg-light border-top">
                    <div class="fs-11 text-uppercase text-muted fw-bold"><?= parse_url(site_url(), PHP_URL_HOST) ?></div>
                    <div class="fw-bold text-dark fs-14 text-truncate mt-1"><?= e($s['default_seo_title'] ?? 'GoldMatrix — The Complete Jewellery ERP') ?></div>
                    <div class="fs-12 text-muted text-truncate mt-1"><?= e($s['default_meta_description'] ?? 'All-in-one Jewellery ERP software...') ?></div>
                  </div>
                </div>

                <div class="alert alert-secondary border-0 rounded-3 fs-12 mb-0">
                  <i class="bi bi-stars text-warning me-1"></i>
                  When clients share your link on WhatsApp, Facebook, or LinkedIn, this exact banner and description will appear automatically.
                </div>
              </div>
            </div>
          </div>

          <div class="mt-4 pt-3 border-top d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" style="background-color:#0B1F3A; border-color:#0B1F3A;">
              <i class="bi bi-check2-circle me-1"></i> Save Social & OpenGraph Settings
            </button>
          </div>
        </form>
      </div>

      <!-- ═══════════════════════════════════════════════════════════
           TAB 3: WEBMASTER & TRACKING SCRIPTS
      ════════════════════════════════════════════════════════════ -->
      <div class="tab-pane fade <?= $activeTab === 'tracking' ? 'show active' : '' ?>" id="tracking-pane" role="tabpanel">
        <form action="<?= admin_url('seo') ?>?tab=tracking" method="POST">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">

          <div class="row g-4">
            <div class="col-12 col-lg-6">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-shield-lock text-success me-2"></i>Search Engine Verification Tags
              </h6>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Google Search Console Verification Code</label>
                <input type="text" 
                       name="settings[google_site_verification]" 
                       class="form-control font-monospace fs-13" 
                       placeholder="e.g. google-site-verification=abc123xyz or abc123xyz"
                       value="<?= e($s['google_site_verification'] ?? '') ?>">
                <span class="fs-12 text-muted">Paste your Google site verification HTML meta tag content.</span>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Bing Webmaster Tools Verification Tag</label>
                <input type="text" 
                       name="settings[bing_site_verification]" 
                       class="form-control font-monospace fs-13" 
                       placeholder="e.g. 7A1B2C3D4E5F6G7H8I9J0K"
                       value="<?= e($s['bing_site_verification'] ?? '') ?>">
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Yandex Verification Code (Optional)</label>
                <input type="text" name="settings[yandex_site_verification]" class="form-control font-monospace fs-13" value="<?= e($s['yandex_site_verification'] ?? '') ?>">
              </div>

              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3 mt-4">
                <i class="bi bi-graph-up-arrow text-primary me-2"></i>Analytics & Pixel Tracking
              </h6>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Google Analytics 4 (GA4) Measurement ID</label>
                <input type="text" 
                       name="settings[google_analytics_id]" 
                       class="form-control font-monospace fs-13" 
                       placeholder="G-XXXXXXXXXX" 
                       value="<?= e($s['google_analytics_id'] ?? '') ?>">
                <span class="fs-12 text-muted">Automatically injects the latest Google gtag.js analytics tracker.</span>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Google Tag Manager (GTM) Container ID</label>
                <input type="text" 
                       name="settings[google_tag_manager_id]" 
                       class="form-control font-monospace fs-13" 
                       placeholder="GTM-XXXXXXX" 
                       value="<?= e($s['google_tag_manager_id'] ?? '') ?>">
                <span class="fs-12 text-muted">Injects both &lt;head&gt; script and &lt;body&gt; noscript fallback.</span>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Meta / Facebook Pixel ID</label>
                <input type="text" 
                       name="settings[facebook_pixel_id]" 
                       class="form-control font-monospace fs-13" 
                       placeholder="e.g. 1234567890123456" 
                       value="<?= e($s['facebook_pixel_id'] ?? '') ?>">
              </div>
            </div>

            <div class="col-12 col-lg-6">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-code-square text-dark me-2"></i>Custom Header & Footer Scripts
              </h6>

              <div class="mb-4">
                <label class="form-label fw-semibold fs-13 text-dark">
                  Custom Header Code (Injected into <code>&lt;head&gt;</code>)
                </label>
                <textarea name="settings[custom_header_scripts]" 
                          class="form-control font-monospace fs-12" 
                          rows="7" 
                          placeholder="<!-- Custom <script>, <style>, or <meta> tags here -->"><?= e($s['custom_header_scripts'] ?? '') ?></textarea>
                <span class="fs-12 text-muted">Ideal for custom CSS, tracking tags, fonts, or third-party widgets.</span>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">
                  Custom Body/Footer Code (Injected before <code>&lt;/body&gt;</code>)
                </label>
                <textarea name="settings[custom_footer_scripts]" 
                          class="form-control font-monospace fs-12" 
                          rows="7" 
                          placeholder="<!-- Custom chat widgets, live chat, or body analytics here -->"><?= e($s['custom_footer_scripts'] ?? '') ?></textarea>
                <span class="fs-12 text-muted">Ideal for live chat widgets (Tawk.to, WhatsApp bot, Crisp) & conversion pixels.</span>
              </div>
            </div>
          </div>

          <div class="mt-4 pt-3 border-top d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" style="background-color:#0B1F3A; border-color:#0B1F3A;">
              <i class="bi bi-check2-circle me-1"></i> Save Webmaster & Tracking Settings
            </button>
          </div>
        </form>
      </div>

      <!-- ═══════════════════════════════════════════════════════════
           TAB 4: SCHEMA.ORG JSON-LD STRUCTURED DATA
      ════════════════════════════════════════════════════════════ -->
      <div class="tab-pane fade <?= $activeTab === 'schema' ? 'show active' : '' ?>" id="schema-pane" role="tabpanel">
        <form action="<?= admin_url('seo') ?>?tab=schema" method="POST">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">

          <div class="row g-4">
            <div class="col-12 col-lg-7">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-diagram-2 text-warning me-2"></i>Structured Data / Rich Results Settings
              </h6>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Enable Universal Schema.org JSON-LD</label>
                <select name="settings[schema_enabled]" class="form-select">
                  <option value="1" <?= ($s['schema_enabled'] ?? '1') === '1' ? 'selected' : '' ?>>Enabled (Auto-inject Structured Data)</option>
                  <option value="0" <?= ($s['schema_enabled'] ?? '') === '0' ? 'selected' : '' ?>>Disabled</option>
                </select>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Primary Schema Entity Type</label>
                  <select name="settings[schema_org_type]" class="form-select">
                    <option value="SoftwareApplication" <?= ($s['schema_org_type'] ?? 'SoftwareApplication') === 'SoftwareApplication' ? 'selected' : '' ?>>SoftwareApplication (Recommended)</option>
                    <option value="Organization" <?= ($s['schema_org_type'] ?? '') === 'Organization' ? 'selected' : '' ?>>Organization</option>
                    <option value="LocalBusiness" <?= ($s['schema_org_type'] ?? '') === 'LocalBusiness' ? 'selected' : '' ?>>LocalBusiness</option>
                    <option value="Corporation" <?= ($s['schema_org_type'] ?? '') === 'Corporation' ? 'selected' : '' ?>>Corporation</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Software / Brand Name</label>
                  <input type="text" name="settings[schema_org_name]" class="form-control" value="<?= e($s['schema_org_name'] ?? 'GoldMatrix Jewellery ERP') ?>">
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Legal Company Name</label>
                  <input type="text" name="settings[schema_org_legal_name]" class="form-control" value="<?= e($s['schema_org_legal_name'] ?? 'GoldMatrix Software Technologies Pvt. Ltd.') ?>">
                </div>
                <div class="col-sm-3">
                  <label class="form-label fw-semibold fs-13 text-dark">Price Range</label>
                  <input type="text" name="settings[schema_org_price_range]" class="form-control" value="<?= e($s['schema_org_price_range'] ?? '₹₹') ?>" placeholder="₹₹">
                </div>
                <div class="col-sm-3">
                  <label class="form-label fw-semibold fs-13 text-dark">Currency</label>
                  <input type="text" name="settings[schema_org_currency]" class="form-control" value="<?= e($s['schema_org_currency'] ?? 'INR') ?>" placeholder="INR">
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Application Category</label>
                  <input type="text" name="settings[schema_software_category]" class="form-control" value="<?= e($s['schema_software_category'] ?? 'BusinessApplication, ERP, POS') ?>">
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Supported Operating Systems</label>
                  <input type="text" name="settings[schema_software_os]" class="form-control" value="<?= e($s['schema_software_os'] ?? 'Cloud Web, Windows 10/11, Android, iOS') ?>">
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Aggregate Rating (Stars)</label>
                  <input type="text" name="settings[schema_software_rating]" class="form-control" value="<?= e($s['schema_software_rating'] ?? '4.9') ?>" placeholder="4.9">
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Total Review Count</label>
                  <input type="number" name="settings[schema_software_review_count]" class="form-control" value="<?= e($s['schema_software_review_count'] ?? '385') ?>">
                </div>
              </div>
            </div>

            <!-- LIVE SCHEMA JSON PREVIEW -->
            <div class="col-12 col-lg-5">
              <div class="card border rounded-3 p-3 bg-light position-sticky" style="top: 20px;">
                <div class="d-flex align-items-center justify-content-between mb-2 border-bottom pb-2">
                  <span class="fw-bold fs-13 text-dark"><i class="bi bi-braces text-warning me-2"></i>Generated JSON-LD Output</span>
                  <span class="badge bg-success-subtle text-success fs-12">Schema.org Valid</span>
                </div>
                <pre class="bg-dark text-light p-3 rounded-3 fs-11 font-monospace mb-0" style="max-height: 380px; overflow: auto;">{
  "@context": "https://schema.org",
  "@type": "<?= e($s['schema_org_type'] ?? 'SoftwareApplication') ?>",
  "name": "<?= e($s['schema_org_name'] ?? 'GoldMatrix Jewellery ERP') ?>",
  "applicationCategory": "<?= e($s['schema_software_category'] ?? 'BusinessApplication') ?>",
  "operatingSystem": "<?= e($s['schema_software_os'] ?? 'Cloud Web') ?>",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "<?= e($s['schema_org_currency'] ?? 'INR') ?>"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?= e($s['schema_software_rating'] ?? '4.9') ?>",
    "reviewCount": "<?= e($s['schema_software_review_count'] ?? '385') ?>"
  }
}</pre>
              </div>
            </div>
          </div>

          <div class="mt-4 pt-3 border-top d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" style="background-color:#0B1F3A; border-color:#0B1F3A;">
              <i class="bi bi-check2-circle me-1"></i> Save Schema.org Settings
            </button>
          </div>
        </form>
      </div>

      <!-- ═══════════════════════════════════════════════════════════
           TAB 5: XML SITEMAP & ROBOTS.TXT
      ════════════════════════════════════════════════════════════ -->
      <div class="tab-pane fade <?= $activeTab === 'sitemap' ? 'show active' : '' ?>" id="sitemap-pane" role="tabpanel">
        <form action="<?= admin_url('seo') ?>?tab=sitemap" method="POST">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save_settings">

          <div class="row g-4">
            <div class="col-12 col-lg-6">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-diagram-3 text-danger me-2"></i>Dynamic XML Sitemap Configuration
              </h6>

              <div class="alert alert-light border rounded-3 p-3 d-flex align-items-center justify-content-between mb-4">
                <div>
                  <div class="fw-bold fs-13 text-dark">Live Sitemap XML Endpoint:</div>
                  <a href="<?= site_url('sitemap.xml') ?>" target="_blank" class="fs-13 text-primary fw-medium text-decoration-none">
                    <?= site_url('sitemap.xml') ?> <i class="bi bi-box-arrow-up-right ms-1"></i>
                  </a>
                </div>
                <a href="<?= site_url('sitemap.xml') ?>" target="_blank" class="btn btn-sm btn-outline-primary px-3">
                  <i class="bi bi-eye me-1"></i> Test Sitemap
                </a>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Enable Dynamic XML Sitemap</label>
                <select name="settings[sitemap_enabled]" class="form-select">
                  <option value="1" <?= ($s['sitemap_enabled'] ?? '1') === '1' ? 'selected' : '' ?>>Enabled</option>
                  <option value="0" <?= ($s['sitemap_enabled'] ?? '') === '0' ? 'selected' : '' ?>>Disabled</option>
                </select>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Default Change Frequency</label>
                  <select name="settings[sitemap_changefreq]" class="form-select">
                    <option value="daily" <?= ($s['sitemap_changefreq'] ?? '') === 'daily' ? 'selected' : '' ?>>daily</option>
                    <option value="weekly" <?= ($s['sitemap_changefreq'] ?? 'weekly') === 'weekly' ? 'selected' : '' ?>>weekly (Recommended)</option>
                    <option value="monthly" <?= ($s['sitemap_changefreq'] ?? '') === 'monthly' ? 'selected' : '' ?>>monthly</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="form-label fw-semibold fs-13 text-dark">Default Priority</label>
                  <input type="text" name="settings[sitemap_priority]" class="form-control" value="<?= e($s['sitemap_priority'] ?? '0.8') ?>" placeholder="0.8">
                </div>
              </div>

              <div class="card p-3 bg-light border-0 rounded-3 mb-3">
                <span class="fw-semibold fs-13 text-dark mb-2 d-block">Automatic Sitemap Inclusions:</span>
                <div class="form-check form-switch mb-2">
                  <input class="form-check-input" type="checkbox" name="settings[sitemap_include_pages]" value="1" id="sm_pages" <?= ($s['sitemap_include_pages'] ?? '1') === '1' ? 'checked' : '' ?>>
                  <label class="form-check-label fs-13" for="sm_pages">Include Static & Dynamic Pages (Home, About, Contact, Solutions)</label>
                </div>
                <div class="form-check form-switch mb-2">
                  <input class="form-check-input" type="checkbox" name="settings[sitemap_include_modules]" value="1" id="sm_modules" <?= ($s['sitemap_include_modules'] ?? '1') === '1' ? 'checked' : '' ?>>
                  <label class="form-check-label fs-13" for="sm_modules">Include ERP Features & Module Pages (/features/...)</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" name="settings[sitemap_include_blog]" value="1" id="sm_blog" <?= ($s['sitemap_include_blog'] ?? '1') === '1' ? 'checked' : '' ?>>
                  <label class="form-check-label fs-13" for="sm_blog">Include Published Blog Posts & Categories (/blog/...)</label>
                </div>
              </div>
            </div>

            <!-- ROBOTS.TXT EDITOR -->
            <div class="col-12 col-lg-6">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-file-earmark-code text-secondary me-2"></i>Robots.txt Configuration
              </h6>

              <div class="alert alert-light border rounded-3 p-3 d-flex align-items-center justify-content-between mb-3">
                <div>
                  <div class="fw-bold fs-13 text-dark">Live Robots.txt Endpoint:</div>
                  <a href="<?= site_url('robots.txt') ?>" target="_blank" class="fs-13 text-secondary fw-medium text-decoration-none">
                    <?= site_url('robots.txt') ?> <i class="bi bi-box-arrow-up-right ms-1"></i>
                  </a>
                </div>
                <a href="<?= site_url('robots.txt') ?>" target="_blank" class="btn btn-sm btn-outline-secondary px-3">
                  <i class="bi bi-eye me-1"></i> View Robots.txt
                </a>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold fs-13 text-dark">Robots.txt Content</label>
                <textarea name="settings[robots_txt_content]" 
                          class="form-control font-monospace fs-12" 
                          rows="10"><?= e($s['robots_txt_content'] ?? "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /storage/\nDisallow: /app/\nDisallow: /config/\nDisallow: /routes/\nDisallow: /database/\n\nSitemap: " . site_url('sitemap.xml')) ?></textarea>
                <span class="fs-12 text-muted">Instructs search engine bots (Googlebot, Bingbot) which directories to crawl or ignore.</span>
              </div>
            </div>
          </div>

          <div class="mt-4 pt-3 border-top d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" style="background-color:#0B1F3A; border-color:#0B1F3A;">
              <i class="bi bi-check2-circle me-1"></i> Save Sitemap & Robots.txt Settings
            </button>
          </div>
        </form>
      </div>

      <!-- ═══════════════════════════════════════════════════════════
           TAB 6: ON-PAGE SEO AUDITOR
      ════════════════════════════════════════════════════════════ -->
      <div class="tab-pane fade <?= $activeTab === 'audit' ? 'show active' : '' ?>" id="audit-pane" role="tabpanel">
        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
          <h6 class="fw-bold text-dark mb-0">
            <i class="bi bi-speedometer2 text-secondary me-2"></i>On-Page SEO Health Scan (<?= count($auditPages) ?> Items)
          </h6>
          <span class="badge bg-light text-dark border">Auto Scanned</span>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle border mb-0">
            <thead class="table-light">
              <tr>
                <th>Page / Content Item</th>
                <th>URL Slug</th>
                <th>Meta Title Status</th>
                <th>Meta Description Status</th>
                <th>Status</th>
                <th class="text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($auditPages as $p): ?>
                <?php 
                $titleLen = mb_strlen($p['meta_title'] ?? '');
                $descLen  = mb_strlen($p['meta_description'] ?? '');
                ?>
                <tr>
                  <td>
                    <div class="fw-semibold text-dark"><?= e($p['title']) ?></div>
                    <span class="badge bg-secondary-subtle text-secondary fs-11 text-uppercase"><?= e($p['content_type']) ?></span>
                  </td>
                  <td>
                    <code class="text-dark fs-12"><?= e($p['slug']) ?></code>
                  </td>
                  <td>
                    <?php if ($titleLen === 0): ?>
                      <span class="badge bg-warning-subtle text-warning"><i class="bi bi-exclamation-circle me-1"></i> Missing (Uses Default)</span>
                    <?php elseif ($titleLen > 70): ?>
                      <span class="badge bg-danger-subtle text-danger"><?= $titleLen ?> chars (Too Long)</span>
                    <?php else: ?>
                      <span class="badge bg-success-subtle text-success"><i class="bi bi-check-circle me-1"></i> <?= $titleLen ?> chars (Good)</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($descLen === 0): ?>
                      <span class="badge bg-warning-subtle text-warning"><i class="bi bi-exclamation-circle me-1"></i> Missing</span>
                    <?php elseif ($descLen > 165): ?>
                      <span class="badge bg-danger-subtle text-danger"><?= $descLen ?> chars (Too Long)</span>
                    <?php else: ?>
                      <span class="badge bg-success-subtle text-success"><i class="bi bi-check-circle me-1"></i> <?= $descLen ?> chars (Good)</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <span class="badge bg-<?= ($p['status'] ?? 'published') === 'published' ? 'success' : 'secondary' ?>">
                      <?= e(ucfirst($p['status'] ?? 'published')) ?>
                    </span>
                  </td>
                  <td class="text-end">
                    <?php if (($p['content_type'] ?? '') === 'home'): ?>
                      <a href="<?= admin_url('homepage') ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
                    <?php elseif (($p['content_type'] ?? '') === 'blog'): ?>
                      <a href="<?= admin_url('blog/edit?id=' . $p['id']) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
                    <?php else: ?>
                      <a href="<?= admin_url('pages/edit?id=' . $p['id']) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ═══════════════════════════════════════════════════════════
           TAB 7: 301/302 URL REDIRECTS MANAGER
      ════════════════════════════════════════════════════════════ -->
      <div class="tab-pane fade <?= $activeTab === 'redirects' ? 'show active' : '' ?>" id="redirects-pane" role="tabpanel">
        <div class="row g-4">
          <!-- Add Redirect Form -->
          <div class="col-12 col-lg-4">
            <div class="card border rounded-3 p-3 bg-light">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-plus-circle-fill text-success me-2"></i>Create New Redirect Rule
              </h6>
              <form action="<?= admin_url('seo') ?>?tab=redirects" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="add_redirect">

                <div class="mb-3">
                  <label class="form-label fw-semibold fs-13 text-dark">Source URL Path <span class="text-danger">*</span></label>
                  <input type="text" name="source_url" class="form-control" placeholder="/old-jewellery-page" required>
                  <span class="fs-12 text-muted">The old or broken link (e.g. <code>/old-services</code>).</span>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold fs-13 text-dark">Target Destination URL <span class="text-danger">*</span></label>
                  <input type="text" name="target_url" class="form-control" placeholder="/solutions/jewellery-retail or https://..." required>
                  <span class="fs-12 text-muted">Where the visitor/bot should be redirected.</span>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold fs-13 text-dark">Redirect Status Code</label>
                  <select name="status_code" class="form-select">
                    <option value="301" selected>301 Moved Permanently (SEO Recommended)</option>
                    <option value="302">302 Temporary Redirect</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-semibold" style="background-color:#0B1F3A; border-color:#0B1F3A;">
                  <i class="bi bi-plus-lg me-1"></i> Add Redirect Rule
                </button>
              </form>
            </div>
          </div>

          <!-- Existing Redirects Table -->
          <div class="col-12 col-lg-8">
            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
              <i class="bi bi-arrow-left-right text-primary me-2"></i>Active URL Redirection Rules (<?= count($redirects) ?>)
            </h6>

            <div class="table-responsive">
              <table class="table table-hover align-middle border mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Old Source URL</th>
                    <th>Target Destination</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Hits</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($redirects)): ?>
                    <?php foreach ($redirects as $r): ?>
                      <tr>
                        <td><code class="text-danger"><?= e($r['source_url']) ?></code></td>
                        <td><code class="text-success"><?= e($r['target_url']) ?></code></td>
                        <td><span class="badge bg-primary-subtle text-primary"><?= e($r['status_code']) ?></span></td>
                        <td>
                          <form action="<?= admin_url('seo') ?>?tab=redirects" method="POST" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="toggle_redirect">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <input type="hidden" name="status" value="<?= $r['is_active'] ?>">
                            <button type="submit" class="btn btn-sm btn-link p-0 text-decoration-none">
                              <span class="badge bg-<?= !empty($r['is_active']) ? 'success' : 'secondary' ?>">
                                <?= !empty($r['is_active']) ? 'Active' : 'Disabled' ?>
                              </span>
                            </button>
                          </form>
                        </td>
                        <td><span class="badge bg-light text-dark border"><?= (int)($r['hits'] ?? 0) ?></span></td>
                        <td class="text-end">
                          <form action="<?= admin_url('seo') ?>?tab=redirects" method="POST" class="d-inline" onsubmit="return confirm('Delete this redirect rule?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="delete_redirect">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="6" class="text-center py-4 text-muted">
                        <i class="bi bi-arrow-repeat fs-3 d-block mb-2"></i>
                        No 301/302 redirect rules created yet.
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
// Live Google SERP Snippet & Counter Sync
document.addEventListener('DOMContentLoaded', function() {
  const titleInput = document.getElementById('input_meta_title');
  const descInput  = document.getElementById('input_meta_desc');
  const serpTitle  = document.getElementById('serp_preview_title');
  const serpDesc   = document.getElementById('serp_preview_desc');
  const titleCount = document.getElementById('title_counter');
  const descCount  = document.getElementById('desc_counter');

  function updateCounters() {
    if (titleInput && serpTitle && titleCount) {
      const tLen = titleInput.value.length;
      serpTitle.textContent = titleInput.value || 'GoldMatrix — The Complete Jewellery ERP';
      titleCount.textContent = tLen + ' chars';
      titleCount.className = (tLen >= 45 && tLen <= 65) ? 'fs-12 fw-bold text-success' : 'fs-12 fw-bold text-warning';
    }
    if (descInput && serpDesc && descCount) {
      const dLen = descInput.value.length;
      serpDesc.textContent = descInput.value || 'All-in-one Jewellery ERP software...';
      descCount.textContent = dLen + ' chars';
      descCount.className = (dLen >= 130 && dLen <= 165) ? 'fs-12 fw-bold text-success' : 'fs-12 fw-bold text-warning';
    }
  }

  if (titleInput) titleInput.addEventListener('input', updateCounters);
  if (descInput)  descInput.addEventListener('input', updateCounters);
  updateCounters();
});

function previewOgImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const prev1 = document.getElementById('og_image_preview');
      const prev2 = document.getElementById('social_banner_preview');
      if (prev1) prev1.src = e.target.result;
      if (prev2) prev2.src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
