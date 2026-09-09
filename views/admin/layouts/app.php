<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title ?? 'Admin Panel') ?> — <?= e(setting('company_name', 'GoldMatrix ERP')) ?></title>
  <?php $adminFavicon = setting('site_favicon', ''); ?>
  <?php if (!empty($adminFavicon)): ?>
    <link rel="icon" href="<?= e($adminFavicon) ?>">
  <?php else: ?>
    <link rel="icon" type="image/svg+xml" href="<?= asset('images/favicon.svg') ?>">
  <?php endif; ?>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  
  <!-- Flaticon & FontAwesome -->
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- CKEditor 5 -->
  <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Admin Custom CSS -->
  <link href="<?= asset('css/admin.css') ?>" rel="stylesheet">
</head>
<body>

<div class="admin-wrapper">
  
  <!-- SIDEBAR -->
  <?php require __DIR__ . '/../partials/sidebar.php'; ?>

  <!-- MAIN WRAPPER -->
  <div class="main-content">
    
    <!-- TOPBAR -->
    <?php require __DIR__ . '/../partials/topbar.php'; ?>

    <!-- CONTENT BODY -->
    <main class="content-body">
      <!-- FLASH MESSAGES -->
      <?php if ($msg = get_flash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i> <?= e($msg) ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <?php if ($msg = get_flash('danger')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= e($msg) ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <?php if ($msg = get_flash('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
          <i class="bi bi-exclamation-circle-fill me-2"></i> <?= e($msg) ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <!-- INJECTED VIEW CONTENT -->
      <?php if (isset($contentFile) && file_exists($contentFile)) require $contentFile; ?>
    </main>

    <!-- FOOTER -->
    <footer class="admin-footer text-muted py-3 px-4 text-center fs-13 border-top bg-white mt-auto">
      <?= setting('copyright_text', '© 2026 GoldMatrix Software Technologies. All Rights Reserved.') ?>
    </footer>
  </div>
</div>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Admin Custom JS -->
<script src="<?= asset('js/admin.js') ?>"></script>

</body>
</html>
