<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title ?? 'Admin Login') ?> — GoldMatrix ERP</title>
  <link rel="icon" type="image/svg+xml" href="<?= asset('images/favicon.svg') ?>">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #0B1F3A;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .auth-card {
      background: #FFFFFF;
      border-radius: 16px;
      padding: 40px;
      width: 100%;
      max-width: 440px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }
  </style>
</head>
<body>

  <div class="auth-card">
    <?php if ($msg = get_flash('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= e($msg) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php if ($msg = get_flash('danger')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= e($msg) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php if (isset($contentFile) && file_exists($contentFile)) require $contentFile; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
