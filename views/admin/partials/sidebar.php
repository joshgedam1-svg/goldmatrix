<?php
$currentRoute = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
$user = \App\Services\AuthService::user();
?>
<aside class="sidebar">
  <div class="sidebar-header" style="background: #FFFFFF; padding: 8px 16px; border-bottom: 1px solid #E2E8F0; border-right: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: center; height: 64px; box-sizing: border-box;">
    <a href="<?= admin_url('dashboard') ?>" class="d-flex align-items-center justify-content-center w-100 text-decoration-none">
      <?php 
      $sidebarLogo = setting('site_logo', '') ?: setting('site_logo_dark', '');
      $companyName = setting('company_name', 'GoldMatrix ERP');
      ?>
      <?php if (!empty($sidebarLogo)): ?>
        <img src="<?= e($sidebarLogo) ?>" alt="<?= e($companyName) ?>" style="max-height: 46px; max-width: 100%; object-fit: contain;" class="sidebar-logo">
      <?php else: ?>
        <img src="<?= asset('images/logo.svg') ?>" alt="GoldMatrix ERP" style="max-height: 42px; max-width: 100%; object-fit: contain;" class="sidebar-logo">
      <?php endif; ?>
    </a>
  </div>

  <div class="sidebar-search-box">
    <div class="position-relative">
      <input type="text" id="sidebarSearchInput" placeholder="Search in menu..." class="sidebar-search-input" onkeyup="filterSidebarMenu(this.value)">
    </div>
  </div>

  <div class="sidebar-menu">
    <div class="menu-category">Main</div>
    <a href="<?= admin_url('dashboard') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/dashboard') !== false ? 'active' : '' ?>">
      <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
    </a>

    <div class="menu-category">WEBSITE</div>
    <a href="<?= admin_url('pages') ?>" class="nav-item-link <?= (strpos($currentRoute, '/admin/pages') !== false || strpos($currentRoute, '/admin/homepage') !== false || strpos($currentRoute, '/admin/about') !== false || strpos($currentRoute, '/admin/contact') !== false || strpos($currentRoute, '/admin/legal') !== false) ? 'active' : '' ?>">
      <i class="bi bi-file-earmark-text"></i> <span>Pages</span>
    </a>
    <a href="<?= admin_url('navigation') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/navigation') !== false ? 'active' : '' ?>">
      <i class="bi bi-menu-button-wide"></i> <span>Navigation</span>
    </a>
    <a href="<?= admin_url('settings') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/settings') !== false ? 'active' : '' ?>">
      <i class="bi bi-sliders"></i> <span>Global Settings</span>
    </a>

    <div class="menu-category">ERP CONTENT</div>
    <a href="<?= admin_url('features-settings') ?>" class="nav-item-link <?= (strpos($currentRoute, '/admin/features-settings') !== false || strpos($currentRoute, '/admin/features/settings') !== false) ? 'active' : '' ?>">
      <i class="bi bi-stars"></i> <span>Features Page</span>
    </a>
    <a href="<?= admin_url('features') ?>" class="nav-item-link <?= (strpos($currentRoute, '/admin/features') !== false && strpos($currentRoute, '/admin/features-settings') === false && strpos($currentRoute, '/admin/features/settings') === false) ? 'active' : '' ?>">
      <i class="bi bi-grid-3x3-gap"></i> <span>10 ERP Modules</span>
    </a>

    <div class="menu-category">BLOG & ARTICLES</div>
    <a href="<?= admin_url('blog') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/blog') !== false ? 'active' : '' ?>">
      <i class="bi bi-newspaper"></i> <span>Blog Posts</span>
    </a>
    <a href="<?= admin_url('categories') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/categories') !== false ? 'active' : '' ?>">
      <i class="bi bi-tags"></i> <span>Categories</span>
    </a>

    <div class="menu-category">MEDIA & SEO</div>
    <a href="<?= admin_url('media') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/media') !== false ? 'active' : '' ?>">
      <i class="bi bi-images"></i> Media Library
    </a>
    <a href="<?= admin_url('seo') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/seo') !== false ? 'active' : '' ?>">
      <i class="bi bi-search"></i> SEO Manager
    </a>

    <div class="menu-category">LEADS</div>
    <a href="<?= admin_url('leads') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/leads') !== false ? 'active' : '' ?>">
      <i class="bi bi-envelope-paper"></i> Contact Enquiries
    </a>
    <a href="<?= admin_url('demo-requests') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/demo-requests') !== false ? 'active' : '' ?>">
      <i class="bi bi-calendar-event"></i> Demo Requests
    </a>

    <div class="menu-category">SYSTEM</div>
    <a href="<?= admin_url('users') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/users') !== false ? 'active' : '' ?>">
      <i class="bi bi-person-gear"></i> Admin Users
    </a>
    <a href="<?= admin_url('roles') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/roles') !== false ? 'active' : '' ?>">
      <i class="bi bi-shield-lock"></i> Roles & Permissions
    </a>
    <a href="<?= admin_url('activity-logs') ?>" class="nav-item-link <?= strpos($currentRoute, '/admin/activity-logs') !== false ? 'active' : '' ?>">
      <i class="bi bi-clock-history"></i> Activity Logs
    </a>
  </div>
</aside>

<script>
function filterSidebarMenu(query) {
  const q = (query || '').toLowerCase().trim();
  const links = document.querySelectorAll('.sidebar-menu .nav-item-link');
  const categories = document.querySelectorAll('.sidebar-menu .menu-category');

  links.forEach(link => {
    const text = link.textContent.toLowerCase();
    if (text.includes(q) || q === '') {
      link.style.display = 'flex';
    } else {
      link.style.display = 'none';
    }
  });

  categories.forEach(cat => {
    if (q === '') {
      cat.style.display = 'block';
    } else {
      cat.style.display = 'none';
    }
  });
}
</script>
