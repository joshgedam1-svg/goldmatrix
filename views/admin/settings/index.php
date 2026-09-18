<?php 
$title = 'Global Settings & Branding';
$currentLogo = $settings['site_logo'] ?? '';
$currentLogoDark = $settings['site_logo_dark'] ?? '';
$currentFavicon = $settings['site_favicon'] ?? '';
$activeTab = $activeTab ?? 'branding';
?>

<!-- Header -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
  <div>
    <h4 class="fw-bold mb-1 text-dark" style="font-size: 1.15rem;"><i class="bi bi-sliders text-secondary me-2"></i>Global Settings & Brand Manager</h4>
    <p class="text-muted fs-12 mb-0">Manage your website logo, favicon, brand identity, contact details and SEO.</p>
  </div>
  <div>
    <a href="/" target="_blank" class="btn btn-outline-secondary btn-sm px-3">
      <i class="bi bi-box-arrow-up-right me-1"></i> Preview Website
    </a>
  </div>
</div>

<!-- Tabs Navigation -->
<ul class="nav nav-pills bg-white p-1 rounded-2 border mb-3 gap-1">
  <li class="nav-item">
    <a class="nav-link <?= $activeTab === 'branding' ? 'active' : '' ?>" href="?tab=branding">
      <i class="bi bi-palette me-1"></i> Logo & Branding
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $activeTab === 'general' ? 'active' : '' ?>" href="?tab=general">
      <i class="bi bi-sliders me-1"></i> General Details
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $activeTab === 'social' ? 'active' : '' ?>" href="?tab=social">
      <i class="bi bi-share me-1"></i> Social Media Links
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $activeTab === 'contact' ? 'active' : '' ?>" href="?tab=contact">
      <i class="bi bi-telephone me-1"></i> Contact & Support
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $activeTab === 'seo' ? 'active' : '' ?>" href="?tab=seo">
      <i class="bi bi-search me-1"></i> SEO & Meta
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $activeTab === 'languages' ? 'active' : '' ?>" href="?tab=languages">
      <i class="bi bi-translate me-1"></i> Languages & Translation
    </a>
  </li>
</ul>

<form method="POST" action="/admin/settings?tab=<?= e($activeTab) ?>" enctype="multipart/form-data" class="mb-4">
  <?= csrf_field() ?>

  <!-- ════════════════════════════════════════════════════
       TAB 1: LOGO & BRANDING
  ════════════════════════════════════════════════════ -->
  <?php if ($activeTab === 'branding'): ?>
  <div class="row g-3">
    
    <!-- MAIN SITE LOGO -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm rounded-2 h-100">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-image text-primary me-2"></i>Header Logo (Main / Navbar)</h6>
            <div class="text-muted fs-11">Displayed on website navbar, header and footer.</div>
          </div>
          <?php if (!empty($currentLogo)): ?>
            <span class="badge bg-success-subtle text-success border border-success-subtle fs-11">Custom Logo Active</span>
          <?php else: ?>
            <span class="badge bg-secondary-subtle text-secondary border fs-11">Default GM Badge</span>
          <?php endif; ?>
        </div>
        <div class="card-body p-3">
          <!-- Live Preview Box -->
          <label class="form-label text-secondary fs-12 mb-1">Live Navbar Preview</label>
          <div class="p-2 mb-3 rounded-2 text-center d-flex align-items-center justify-content-center" 
               style="background:#08080A; min-height:75px; border:1px dashed rgba(255,255,255,0.25); position:relative; overflow:hidden;">
            
            <div id="preview_site_logo_default" class="<?= !empty($currentLogo) ? 'd-none' : 'd-flex' ?> align-items-center gap-2">
              <div style="width:30px;height:30px;background:linear-gradient(135deg,#FDE68A 0%,#F59E0B 50%,#B45309 100%);border-radius:6px;display:flex;align-items:center;justify-content:center;font-weight:900;color:#08080A;font-size:12px;">GM</div>
              <span class="text-white fw-bold fs-13">GoldMatrix</span>
            </div>

            <img src="<?= e($currentLogo) ?>" alt="Site Logo Preview" id="preview_site_logo" style="max-height: 44px; max-width: 90%; object-fit: contain; <?= empty($currentLogo) ? 'display:none;' : 'display:block;' ?>">
          </div>

          <div class="mb-3">
            <label class="form-label fs-12">Choose Logo File (WebP, PNG, SVG, JPG)</label>
            <input type="file" name="site_logo_file" id="input_site_logo" class="form-control form-control-sm" accept=".png,.svg,.webp,.jpg,.jpeg">
            <div class="form-text fs-11 text-muted">Recommended: Transparent background image with height ~40-60px.</div>
          </div>

          <div class="mb-3">
            <label class="form-label text-secondary fs-12">Or Custom Image URL / Path</label>
            <input type="text" name="site_logo_url" value="<?= e($currentLogo) ?>" class="form-control form-control-sm font-monospace" placeholder="/uploads/branding/logo.webp or https://...">
          </div>

          <?php if (!empty($currentLogo)): ?>
            <div class="pt-2 border-top">
              <button type="submit" name="action" value="remove_image" onclick="document.getElementById('remove_key').value='site_logo'; return confirm('Remove custom logo and reset to default?');" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-trash3 me-1"></i> Remove Custom Logo
              </button>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- SITE FAVICON / SITE ICON -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm rounded-2 h-100">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-app-indicator text-warning me-2"></i>Site Favicon (Browser Tab Icon)</h6>
            <div class="text-muted fs-11">Displayed in browser tabs, mobile bookmarks & shortcuts.</div>
          </div>
          <?php if (!empty($currentFavicon)): ?>
            <span class="badge bg-success-subtle text-success border border-success-subtle fs-11">Custom Icon Active</span>
          <?php else: ?>
            <span class="badge bg-secondary-subtle text-secondary border fs-11">Default Icon</span>
          <?php endif; ?>
        </div>
        <div class="card-body p-3">
          <!-- Live Preview Box -->
          <label class="form-label text-secondary fs-12 mb-1">Live Browser Tab Mockup</label>
          <div class="p-2 mb-3 rounded-2 text-center d-flex align-items-center justify-content-center" 
               style="background:#F1F5F9; min-height:75px; border:1px dashed #CBD5E1;">
            <!-- Mock browser tab -->
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 bg-white rounded-2 shadow-xs border">
              <div id="preview_site_favicon_default" class="<?= !empty($currentFavicon) ? 'd-none' : 'd-flex' ?> align-items-center justify-content-center" style="width:18px;height:18px;background:#F59E0B;border-radius:4px;font-size:9px;font-weight:900;color:#000;">
                GM
              </div>
              <img src="<?= e($currentFavicon) ?>" alt="Favicon Preview" id="preview_site_favicon" style="width:18px;height:18px;object-fit:contain; <?= empty($currentFavicon) ? 'display:none;' : 'display:block;' ?>">
              <span class="fs-12 fw-medium text-dark">GoldMatrix — ERP</span>
              <i class="bi bi-x ms-2 text-muted fs-12"></i>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fs-12">Choose Favicon File (.ico, .png, .svg, .webp)</label>
            <input type="file" name="site_favicon_file" id="input_site_favicon" class="form-control form-control-sm" accept=".ico,.png,.svg,.webp,.jpg">
            <div class="form-text fs-11 text-muted">Recommended: Square icon 32x32px or 64x64px.</div>
          </div>

          <div class="mb-3">
            <label class="form-label text-secondary fs-12">Or Favicon URL / Path</label>
            <input type="text" name="site_favicon_url" value="<?= e($currentFavicon) ?>" class="form-control form-control-sm font-monospace" placeholder="/uploads/branding/favicon.ico">
          </div>

          <?php if (!empty($currentFavicon)): ?>
            <div class="pt-2 border-top">
              <button type="submit" name="action" value="remove_image" onclick="document.getElementById('remove_key').value='site_favicon'; return confirm('Remove custom favicon and reset to default?');" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-trash3 me-1"></i> Remove Custom Favicon
              </button>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- LOGO DISPLAY CONTROLS -->
    <div class="col-12">
      <div class="card border-0 shadow-sm rounded-2">
        <div class="card-header bg-white border-bottom py-2 px-3">
          <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-sliders2 text-info me-2"></i>Display & Sizing Settings</h6>
        </div>
        <div class="card-body p-3">
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label fs-12">Header Logo Max Height (px)</label>
              <input type="number" name="site_logo_height" value="<?= e($settings['site_logo_height'] ?? '38') ?>" class="form-control form-control-sm" min="20" max="100">
              <div class="form-text fs-11 text-muted">Default: 38px. Controls header navbar logo size.</div>
            </div>
            <div class="col-md-4">
              <label class="form-label fs-12">Brand Name Text beside Logo</label>
              <select name="show_brand_text" class="form-select form-select-sm">
                <option value="1" <?= ($settings['show_brand_text'] ?? '1') == '1' ? 'selected' : '' ?>>Show Text ("GoldMatrix") beside logo</option>
                <option value="0" <?= ($settings['show_brand_text'] ?? '1') == '0' ? 'selected' : '' ?>>Logo Image Only (Hide text)</option>
              </select>
              <div class="form-text fs-11 text-muted">Select "Logo Image Only" if logo has brand text.</div>
            </div>
            <div class="col-md-4">
              <label class="form-label fs-12">Brand / Company Name</label>
              <input type="text" name="company_name" value="<?= e($settings['company_name'] ?? 'GoldMatrix') ?>" class="form-control form-control-sm">
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php endif; ?>

  <!-- ════════════════════════════════════════════════════
       TAB 2: GENERAL SETTINGS
  ════════════════════════════════════════════════════ -->
  <?php if ($activeTab === 'general'): ?>
  <div class="card border-0 shadow-sm rounded-2">
    <div class="card-header bg-white border-bottom py-2 px-3">
      <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-building text-primary me-2"></i>General Business & Website Info</h6>
    </div>
    <div class="card-body p-3">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label fs-12">Site Title (Main Brand Title)</label>
          <input type="text" name="site_title" value="<?= e($settings['site_title'] ?? '') ?>" class="form-control form-control-sm">
          <div class="form-text fs-11 text-muted">Example: GoldMatrix — The Complete Jewellery ERP</div>
        </div>
        <div class="col-md-6">
          <label class="form-label fs-12">Site Tagline / Subheading</label>
          <input type="text" name="site_tagline" value="<?= e($settings['site_tagline'] ?? '') ?>" class="form-control form-control-sm">
          <div class="form-text fs-11 text-muted">Example: Technology for Jewellery Business</div>
        </div>
        <div class="col-md-6">
          <label class="form-label fs-12">Company Legal Name</label>
          <input type="text" name="company_name" value="<?= e($settings['company_name'] ?? '') ?>" class="form-control form-control-sm">
        </div>
    </div>
  </div>

  <!-- Top Announcement / Notification Bar Card -->
  <div class="card border-0 shadow-sm rounded-2 mt-3">
    <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
      <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-megaphone text-warning me-2"></i>Website Top Announcement / Notification Bar</h6>
      <span class="badge bg-light text-secondary border fs-11">Header Banner</span>
    </div>
    <div class="card-body p-3">
      <div class="row g-3">
        <div class="col-md-3">
          <label class="form-label fs-12 fw-semibold">Show Top Announcement Bar?</label>
          <select name="enable_top_notification_bar" class="form-select form-select-sm">
            <option value="1" <?= ($settings['enable_top_notification_bar'] ?? '0') == '1' ? 'selected' : '' ?>>✅ Enabled (Show on Top)</option>
            <option value="0" <?= ($settings['enable_top_notification_bar'] ?? '0') == '0' ? 'selected' : '' ?>>❌ Disabled (Hidden)</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label fs-12 fw-semibold">Badge Tag (e.g. OFFER, NEW)</label>
          <input type="text" name="top_notification_badge" value="<?= e($settings['top_notification_badge'] ?? 'NEW') ?>" class="form-control form-control-sm" placeholder="SPECIAL OFFER">
        </div>
        <div class="col-md-6">
          <label class="form-label fs-12 fw-semibold">Announcement / Notification Message</label>
          <input type="text" name="top_notification_text" value="<?= e($settings['top_notification_text'] ?? 'Special Offer: Book a Free Demo Today & Get 30 Days Free Trial on GoldMatrix ERP!') ?>" class="form-control form-control-sm" placeholder="Your announcement message...">
        </div>
        <div class="col-md-6">
          <label class="form-label fs-12">Action Link / URL (Optional)</label>
          <input type="text" name="top_notification_link" value="<?= e($settings['top_notification_link'] ?? '#bookDemoModal') ?>" class="form-control form-control-sm" placeholder="#bookDemoModal or https://...">
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- ════════════════════════════════════════════════════
       TAB 3: SOCIAL MEDIA LINKS & ONLINE PRESENCE
  ════════════════════════════════════════════════════ -->
  <?php if ($activeTab === 'social'): 
    $customSocialRaw = $settings['custom_social_links'] ?? '[]';
    $customSocialList = json_decode($customSocialRaw, true) ?: [];
  ?>
  <div class="row g-3">
    <!-- LEFT: Social Profiles & Manual Addition Repeater -->
    <div class="col-lg-7">
      
      <!-- Standard Major Platforms -->
      <div class="card border-0 shadow-sm rounded-2 mb-3">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-share text-primary me-2"></i>Official Social Media Profiles</h6>
            <div class="text-muted fs-11">Configure primary social channels displayed in the website footer.</div>
          </div>
          <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-11">
            <i class="bi bi-globe me-1"></i> Public Links
          </span>
        </div>
        <div class="card-body p-3">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">Facebook Page URL</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-primary"><i class="bi bi-facebook"></i></span>
                <input type="url" name="social_facebook" id="inp_social_facebook" class="form-control" value="<?= e($settings['social_facebook'] ?? '') ?>" placeholder="https://facebook.com/..." oninput="updateLiveSocialPreview()">
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">Instagram Profile URL</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-danger"><i class="bi bi-instagram"></i></span>
                <input type="url" name="social_instagram" id="inp_social_instagram" class="form-control" value="<?= e($settings['social_instagram'] ?? '') ?>" placeholder="https://instagram.com/..." oninput="updateLiveSocialPreview()">
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">LinkedIn Company URL</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-info"><i class="bi bi-linkedin"></i></span>
                <input type="url" name="social_linkedin" id="inp_social_linkedin" class="form-control" value="<?= e($settings['social_linkedin'] ?? '') ?>" placeholder="https://linkedin.com/company/..." oninput="updateLiveSocialPreview()">
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">Twitter / X Profile URL</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-dark"><i class="bi bi-twitter-x"></i></span>
                <input type="url" name="social_twitter" id="inp_social_twitter" class="form-control" value="<?= e($settings['social_twitter'] ?? '') ?>" placeholder="https://x.com/..." oninput="updateLiveSocialPreview()">
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">YouTube Channel URL</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-danger"><i class="bi bi-youtube"></i></span>
                <input type="url" name="social_youtube" id="inp_social_youtube" class="form-control" value="<?= e($settings['social_youtube'] ?? '') ?>" placeholder="https://youtube.com/@..." oninput="updateLiveSocialPreview()">
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">WhatsApp Direct / Channel Link</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-success"><i class="bi bi-whatsapp"></i></span>
                <input type="url" name="social_whatsapp" id="inp_social_whatsapp" class="form-control" value="<?= e($settings['social_whatsapp'] ?? '') ?>" placeholder="https://wa.me/971563240319" oninput="updateLiveSocialPreview()">
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">Pinterest URL</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-danger"><i class="bi bi-pinterest"></i></span>
                <input type="url" name="social_pinterest" id="inp_social_pinterest" class="form-control" value="<?= e($settings['social_pinterest'] ?? '') ?>" placeholder="https://pinterest.com/..." oninput="updateLiveSocialPreview()">
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fs-12 fw-semibold">Telegram Channel / Link</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light text-info"><i class="bi bi-telegram"></i></span>
                <input type="url" name="social_telegram" id="inp_social_telegram" class="form-control" value="<?= e($settings['social_telegram'] ?? '') ?>" placeholder="https://t.me/..." oninput="updateLiveSocialPreview()">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Manual / Custom Social Links Repeater -->
      <div class="card border-0 shadow-sm rounded-2">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-plus-circle text-success me-2"></i>Custom Social Links (Manual Additions)</h6>
            <div class="text-muted fs-11">Add any additional channels like Threads, TikTok, Discord, GitHub, Reddit, Snapchat, etc.</div>
          </div>
          <button type="button" class="btn btn-outline-primary btn-xs py-1 px-2 fs-11" onclick="addCustomSocialRow()">
            <i class="bi bi-plus-lg me-1"></i> Add Custom Link
          </button>
        </div>
        <div class="card-body p-3">
          <div id="custom_social_container" class="d-flex flex-column gap-2">
            <div id="no_custom_social_msg" class="<?= empty($customSocialList) ? 'd-block' : 'd-none' ?> text-center py-3 text-muted fs-12 border border-dashed rounded-2 bg-light">
              No custom social links added yet. Click <strong>"+ Add Custom Link"</strong> above to add more profiles.
            </div>

            <?php foreach ($customSocialList as $idx => $cs): ?>
              <div class="custom-social-row p-2 rounded-2 border bg-light-subtle d-flex align-items-center gap-2" data-index="<?= $idx ?>">
                <div style="width: 140px;">
                  <input type="text" name="custom_social[<?= $idx ?>][platform]" class="form-control form-control-sm cs-platform" value="<?= e($cs['platform'] ?? $cs['title'] ?? '') ?>" placeholder="Platform Name" required oninput="updateLiveSocialPreview()">
                </div>
                <div style="width: 130px;">
                  <select name="custom_social[<?= $idx ?>][icon]" class="form-select form-select-sm cs-icon" onchange="updateLiveSocialPreview()">
                    <?php 
                      $icons = [
                        'bi-threads'      => 'Threads',
                        'bi-tiktok'       => 'TikTok',
                        'bi-discord'      => 'Discord',
                        'bi-reddit'       => 'Reddit',
                        'bi-snapchat'     => 'Snapchat',
                        'bi-github'       => 'GitHub',
                        'bi-medium'       => 'Medium',
                        'bi-quora'        => 'Quora',
                        'bi-skype'        => 'Skype',
                        'bi-globe'        => 'Website / Blog',
                        'bi-link-45deg'   => 'Custom Link'
                      ];
                      $selectedIcon = $cs['icon'] ?? 'bi-link-45deg';
                      foreach ($icons as $iclass => $iname):
                    ?>
                      <option value="<?= $iclass ?>" <?= $selectedIcon === $iclass ? 'selected' : '' ?>><?= $iname ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="flex-grow-1">
                  <input type="url" name="custom_social[<?= $idx ?>][url]" class="form-control form-control-sm cs-url" value="<?= e($cs['url'] ?? '') ?>" placeholder="https://..." required oninput="updateLiveSocialPreview()">
                </div>
                <button type="button" class="btn btn-outline-danger btn-sm px-2 py-1" onclick="removeCustomSocialRow(this)" title="Delete Link">
                  <i class="bi bi-trash3"></i>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>

    <!-- RIGHT: Live Website Footer Mockup Preview (Matching Reference) -->
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm rounded-2 position-sticky" style="top: 20px;">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
          <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-eye text-info me-2"></i>Live Footer Social Icons Preview</h6>
          <span class="badge bg-dark text-white fs-11">Website Mockup</span>
        </div>
        <div class="card-body p-4 text-center rounded-bottom" style="background:#001133; color:#FFFFFF; min-height: 280px; display:flex; flex-direction:column; justify-content:center; align-items:center;">
          
          <!-- Logo Card -->
          <div style="background:#FFFFFF; padding:10px 18px; border-radius:12px; display:inline-block; margin-bottom:18px; box-shadow:0 10px 25px rgba(0,0,0,0.3);">
            <?php if (!empty($currentLogo)): ?>
              <img src="<?= e($currentLogo) ?>" alt="GoldMatrix" style="max-height:36px; max-width:180px; object-fit:contain;">
            <?php else: ?>
              <div class="d-flex align-items-center gap-2">
                <div style="width:30px;height:30px;background:#001540;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#DC9423;font-weight:900;font-size:13px;">GM</div>
                <span style="font-weight:800;font-size:16px;color:#001540;">GoldMatrix</span>
              </div>
            <?php endif; ?>
          </div>

          <!-- Tagline -->
          <p style="font-size:13px; line-height:1.6; color:#94A3B8; max-width:320px; margin:0 auto 20px;">
            <?= e($settings['footer_tagline'] ?? 'We build jewellery-specific software delivering accuracy, control, scalability, and business growth') ?>
          </p>

          <!-- Social Icons Row (Matching Reference) -->
          <div id="live_social_icons_preview" style="display:flex; align-items:center; justify-content:center; gap:16px; flex-wrap:wrap;">
            <!-- Rendered by live preview script -->
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- ════════════════════════════════════════════════════
       TAB 4: CONTACT & SUPPORT
  ════════════════════════════════════════════════════ -->
  <?php if ($activeTab === 'contact'): ?>
  <div class="card border-0 shadow-sm rounded-2">
    <div class="card-header bg-white border-bottom py-2 px-3">
      <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-headset text-success me-2"></i>Contact, Phone & WhatsApp</h6>
    </div>
    <div class="card-body p-3">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label fs-12">Contact Email</label>
          <div class="input-group input-group-sm">
            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
            <input type="email" name="contact_email" value="<?= e($settings['contact_email'] ?? '') ?>" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label fs-12">Contact Phone Number</label>
          <div class="input-group input-group-sm">
            <span class="input-group-text bg-light"><i class="bi bi-telephone"></i></span>
            <input type="text" name="contact_phone" value="<?= e($settings['contact_phone'] ?? '') ?>" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label fs-12">WhatsApp Business Number</label>
          <div class="input-group input-group-sm">
            <span class="input-group-text bg-light text-success"><i class="bi bi-whatsapp"></i></span>
            <input type="text" name="whatsapp_number" value="<?= e($settings['whatsapp_number'] ?? '') ?>" class="form-control">
          </div>
          <div class="form-text fs-11 text-muted">Include country code without + or spaces (e.g. 919876543210).</div>
        </div>
        <div class="col-md-6">
          <label class="form-label fs-12">Company Office Address</label>
          <textarea name="address" rows="2" class="form-control form-control-sm"><?= e($settings['address'] ?? '') ?></textarea>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- ════════════════════════════════════════════════════
       TAB 4: SEO & META
  ════════════════════════════════════════════════════ -->
  <?php if ($activeTab === 'seo'): ?>
  <div class="card border-0 shadow-sm rounded-2">
    <div class="card-header bg-white border-bottom py-2 px-3">
      <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-google text-danger me-2"></i>Global SEO & Search Rankings</h6>
    </div>
    <div class="card-body p-3">
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label fs-12">Default SEO Meta Title</label>
          <input type="text" name="default_seo_title" value="<?= e($settings['default_seo_title'] ?? '') ?>" class="form-control form-control-sm">
        </div>
        <div class="col-12">
          <label class="form-label fs-12">Default SEO Meta Description</label>
          <textarea name="default_meta_description" rows="3" class="form-control form-control-sm"><?= e($settings['default_meta_description'] ?? '') ?></textarea>
        </div>
        <div class="col-12">
          <label class="form-label fs-12">Meta Keywords (Comma separated)</label>
          <textarea name="default_keywords" rows="2" class="form-control form-control-sm"><?= e($settings['default_keywords'] ?? '') ?></textarea>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- ════════════════════════════════════════════════════
       TAB 5: MULTI-LANGUAGE & INTERNATIONAL SEO
  ════════════════════════════════════════════════════ -->
  <?php if ($activeTab === 'languages'): 
    $allLangs = get_supported_languages();
    $enabledLangString = $settings['enabled_languages'] ?? 'en,ar,hi,gu,ta,fr,es,de,ru,zh-CN';
    $currentEnabled = array_map('trim', explode(',', $enabledLangString));
  ?>
  <div class="row g-3">
    
    <!-- MAIN LANGUAGE CONTROLS -->
    <div class="col-lg-12">
      <div class="card border-0 shadow-sm rounded-2">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-translate text-primary me-2"></i>International Language & Translation Engine</h6>
            <div class="text-muted fs-11">Allow domestic & international jewellery buyers to browse GoldMatrix in their preferred language.</div>
          </div>
          <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-11">
            <i class="bi bi-globe me-1"></i> Multi-Market Ready
          </span>
        </div>
        <div class="card-body p-3">
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label fs-12 fw-semibold">Language Switcher Status</label>
              <select name="enable_multilang" class="form-select form-select-sm">
                <option value="1" <?= ($settings['enable_multilang'] ?? '1') == '1' ? 'selected' : '' ?>>✅ Enabled (Show on Website)</option>
                <option value="0" <?= ($settings['enable_multilang'] ?? '1') == '0' ? 'selected' : '' ?>>❌ Disabled (English Only)</option>
              </select>
              <div class="form-text fs-11 text-muted">Controls visibility of the language picker.</div>
            </div>

            <div class="col-md-4">
              <label class="form-label fs-12 fw-semibold">Default Website Language</label>
              <select name="default_language" class="form-select form-select-sm">
                <?php foreach ($allLangs as $code => $l): ?>
                  <option value="<?= e($code) ?>" <?= ($settings['default_language'] ?? 'en') === $code ? 'selected' : '' ?>>
                    <?= $l['flag'] ?> <?= e($l['name']) ?> (<?= e($l['native']) ?>)
                  </option>
                <?php endforeach; ?>
              </select>
              <div class="form-text fs-11 text-muted">Primary language for visitors without preference.</div>
            </div>

            <div class="col-md-4">
              <label class="form-label fs-12 fw-semibold">Switcher UI Placement</label>
              <select name="language_switcher_pos" class="form-select form-select-sm">
                <option value="both" <?= ($settings['language_switcher_pos'] ?? 'both') === 'both' ? 'selected' : '' ?>>Navbar Header & Footer (Recommended)</option>
                <option value="header" <?= ($settings['language_switcher_pos'] ?? 'both') === 'header' ? 'selected' : '' ?>>Navbar Header Only</option>
                <option value="footer" <?= ($settings['language_switcher_pos'] ?? 'both') === 'footer' ? 'selected' : '' ?>>Footer Only</option>
              </select>
              <div class="form-text fs-11 text-muted">Choose where visitors see the language selector.</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ENABLED LANGUAGES CHECKLIST -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-2 h-100">
        <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-check2-square text-success me-2"></i>Active Languages for Visitors</h6>
            <div class="text-muted fs-11">Select which international & regional languages should appear in the language selector dropdown.</div>
          </div>
          <div class="d-flex gap-1">
            <button type="button" class="btn btn-outline-secondary btn-xs py-0 px-2 fs-11" onclick="toggleAllLangs(true)">Select All</button>
            <button type="button" class="btn btn-outline-secondary btn-xs py-0 px-2 fs-11" onclick="toggleAllLangs(false)">Deselect All</button>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row g-2">
            <?php foreach ($allLangs as $code => $l): 
              $isChecked = in_array($code, $currentEnabled, true);
            ?>
              <div class="col-md-6">
                <label class="d-flex align-items-center justify-content-between p-2 rounded-2 border bg-light-subtle h-100 cursor-pointer hover-shadow-sm transition-all" style="cursor:pointer;">
                  <div class="d-flex align-items-center gap-2">
                    <input class="form-check-input mt-0 lang-checkbox" type="checkbox" name="enabled_languages[]" value="<?= e($code) ?>" <?= $isChecked ? 'checked' : '' ?>>
                    <img src="<?= e($l['flag_img']) ?>" width="22" height="15" class="rounded-1 shadow-xs" style="object-fit:cover;" alt="">
                    <div>
                      <div class="fw-semibold text-dark fs-12"><?= e($l['name']) ?> <span class="text-secondary fw-normal fs-11">(<?= e($l['native']) ?>)</span></div>
                      <div class="text-muted fs-10"><i class="bi bi-geo-alt me-1"></i><?= e($l['country']) ?></div>
                    </div>
                  </div>
                  <?php if ($l['dir'] === 'rtl'): ?>
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fs-10">RTL Mode</span>
                  <?php else: ?>
                    <span class="badge bg-light text-secondary border fs-10"><?= strtoupper($code) ?></span>
                  <?php endif; ?>
                </label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- INTERNATIONAL SEO & ENGINE SETTINGS -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-2 h-100">
        <div class="card-header bg-white border-bottom py-2 px-3">
          <h6 class="fw-bold mb-0 text-dark fs-13"><i class="bi bi-shield-check text-info me-2"></i>SEO & Translation Engine</h6>
        </div>
        <div class="card-body p-3 d-flex flex-column gap-3">
          
          <div>
            <div class="form-check form-switch mb-1">
              <input class="form-check-input" type="checkbox" role="switch" name="enable_hreflang_seo" value="1" id="sw_hreflang" <?= ($settings['enable_hreflang_seo'] ?? '1') == '1' ? 'checked' : '' ?>>
              <label class="form-check-label fw-semibold fs-12" for="sw_hreflang">Dynamic Hreflang SEO Tags</label>
            </div>
            <p class="text-muted fs-11 mb-0">Emits Google-compliant <code>&lt;link rel="alternate" hreflang="..."&gt;</code> tags in the page head for each enabled language to improve global search ranking.</p>
          </div>

          <div class="pt-2 border-top">
            <div class="form-check form-switch mb-1">
              <input class="form-check-input" type="checkbox" role="switch" name="enable_auto_browser_detect" value="1" id="sw_autodetect" <?= ($settings['enable_auto_browser_detect'] ?? '1') == '1' ? 'checked' : '' ?>>
              <label class="form-check-label fw-semibold fs-12" for="sw_autodetect">Auto Browser Language Suggestion</label>
            </div>
            <p class="text-muted fs-11 mb-0">Detects international visitor browser locale (e.g., Arabic for Dubai visitors) and displays tailored suggestions.</p>
          </div>

          <div class="pt-2 border-top">
            <div class="form-check form-switch mb-1">
              <input class="form-check-input" type="checkbox" role="switch" name="enable_google_translate" value="1" id="sw_engine" <?= ($settings['enable_google_translate'] ?? '1') == '1' ? 'checked' : '' ?>>
              <label class="form-check-label fw-semibold fs-12" for="sw_engine">Client-Side Translation Engine</label>
            </div>
            <p class="text-muted fs-11 mb-0">Real-time instant webpage translation engine powered by Google Cloud Translate CDN with custom luxury dropdown UI.</p>
          </div>

        </div>
      </div>
    </div>

  </div>

  <script>
  function toggleAllLangs(check) {
    document.querySelectorAll('.lang-checkbox').forEach(cb => {
      // Keep english always checked
      if (cb.value === 'en' && !check) return;
      cb.checked = check;
    });
  }
  </script>
  <?php endif; ?>

  <!-- HIDDEN FIELD FOR 1-CLICK REMOVE -->
  <input type="hidden" name="key" id="remove_key" value="">

  <!-- SAVE BUTTON BAR -->
  <div class="mt-3 pt-2 d-flex gap-2 align-items-center">
    <button type="submit" name="action" value="save_settings" class="btn btn-navy px-4 py-2 fs-13">
      <i class="bi bi-check2-circle me-1"></i> Save Changes
    </button>
    <a href="/admin/settings?tab=<?= e($activeTab) ?>" class="btn btn-light border px-3 py-2 text-secondary fs-13">
      Discard
    </a>
  </div>
</form>

<script>
// Clean Live Image Preview on File Selection
document.addEventListener('DOMContentLoaded', function() {
  function bindPreview(inputId, imgId, defaultId) {
    const input = document.getElementById(inputId);
    const img = document.getElementById(imgId);
    const def = defaultId ? document.getElementById(defaultId) : null;
    if (!input || !img) return;

    input.addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(evt) {
          img.src = evt.target.result;
          img.style.display = 'block';
          if (def) {
            def.classList.add('d-none');
            def.classList.remove('d-flex');
            def.style.display = 'none';
          }
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });
  }

  bindPreview('input_site_logo', 'preview_site_logo', 'preview_site_logo_default');
  bindPreview('input_site_favicon', 'preview_site_favicon', 'preview_site_favicon_default');
});

// Custom Social Links Manager & Live Preview
function addCustomSocialRow() {
  const container = document.getElementById('custom_social_container');
  const noMsg = document.getElementById('no_custom_social_msg');
  if (noMsg) {
    noMsg.classList.add('d-none');
    noMsg.classList.remove('d-block');
  }

  const idx = Date.now();
  const row = document.createElement('div');
  row.className = 'custom-social-row p-2 rounded-2 border bg-light-subtle d-flex align-items-center gap-2';
  row.dataset.index = idx;
  row.innerHTML = `
    <div style="width: 140px;">
      <input type="text" name="custom_social[${idx}][platform]" class="form-control form-control-sm cs-platform" placeholder="e.g. Threads" required oninput="updateLiveSocialPreview()">
    </div>
    <div style="width: 130px;">
      <select name="custom_social[${idx}][icon]" class="form-select form-select-sm cs-icon" onchange="updateLiveSocialPreview()">
        <option value="bi-threads">Threads</option>
        <option value="bi-tiktok">TikTok</option>
        <option value="bi-discord">Discord</option>
        <option value="bi-reddit">Reddit</option>
        <option value="bi-snapchat">Snapchat</option>
        <option value="bi-github">GitHub</option>
        <option value="bi-medium">Medium</option>
        <option value="bi-quora">Quora</option>
        <option value="bi-skype">Skype</option>
        <option value="bi-globe">Website / Blog</option>
        <option value="bi-link-45deg">Custom Link</option>
      </select>
    </div>
    <div class="flex-grow-1">
      <input type="url" name="custom_social[${idx}][url]" class="form-control form-control-sm cs-url" placeholder="https://..." required oninput="updateLiveSocialPreview()">
    </div>
    <button type="button" class="btn btn-outline-danger btn-sm px-2 py-1" onclick="removeCustomSocialRow(this)" title="Delete Link">
      <i class="bi bi-trash3"></i>
    </button>
  `;
  container.appendChild(row);
  updateLiveSocialPreview();
}

function removeCustomSocialRow(btn) {
  const row = btn.closest('.custom-social-row');
  if (row) {
    row.remove();
    const rows = document.querySelectorAll('.custom-social-row');
    const noMsg = document.getElementById('no_custom_social_msg');
    if (rows.length === 0 && noMsg) {
      noMsg.classList.remove('d-none');
      noMsg.classList.add('d-block');
    }
    updateLiveSocialPreview();
  }
}

function updateLiveSocialPreview() {
  const previewBox = document.getElementById('live_social_icons_preview');
  if (!previewBox) return;

  const standardPlatforms = [
    { id: 'inp_social_facebook',  icon: 'bi-facebook',  title: 'Facebook' },
    { id: 'inp_social_instagram', icon: 'bi-instagram', title: 'Instagram' },
    { id: 'inp_social_linkedin',  icon: 'bi-linkedin',  title: 'LinkedIn' },
    { id: 'inp_social_twitter',   icon: 'bi-twitter-x', title: 'Twitter / X' },
    { id: 'inp_social_youtube',   icon: 'bi-youtube',   title: 'YouTube' },
    { id: 'inp_social_whatsapp',  icon: 'bi-whatsapp',  title: 'WhatsApp' },
    { id: 'inp_social_pinterest', icon: 'bi-pinterest', title: 'Pinterest' },
    { id: 'inp_social_telegram',  icon: 'bi-telegram',  title: 'Telegram' }
  ];

  let html = '';
  let count = 0;

  standardPlatforms.forEach(p => {
    const el = document.getElementById(p.id);
    if (el && el.value.trim() !== '') {
      count++;
      html += `<span style="color:#FFFFFF; font-size:16px; width:32px; height:32px; background:rgba(255,255,255,0.08); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; border:1px solid rgba(255,255,255,0.18);" title="${p.title}"><i class="bi ${p.icon}"></i></span>`;
    }
  });

  document.querySelectorAll('.custom-social-row').forEach(r => {
    const urlEl = r.querySelector('.cs-url');
    const iconEl = r.querySelector('.cs-icon');
    const platEl = r.querySelector('.cs-platform');
    if (urlEl && urlEl.value.trim() !== '') {
      count++;
      const icon = iconEl ? iconEl.value : 'bi-link-45deg';
      const title = platEl ? platEl.value : 'Custom Link';
      html += `<span style="color:#FFFFFF; font-size:16px; width:32px; height:32px; background:rgba(255,255,255,0.08); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; border:1px solid rgba(255,255,255,0.18);" title="${title}"><i class="bi ${icon}"></i></span>`;
    }
  });

  if (count === 0) {
    previewBox.innerHTML = '<span style="color:#64748B; font-size:12px; font-style:italic;">No active social icons. Fill in URLs to preview here.</span>';
  } else {
    previewBox.innerHTML = html;
  }
}

document.addEventListener('DOMContentLoaded', function() {
  updateLiveSocialPreview();
});
</script>
