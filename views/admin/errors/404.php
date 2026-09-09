<?php $title = $title ?? '404 - Page Not Found'; ?>
<?php ob_start(); ?>
<div style="display:flex;align-items:center;justify-content:center;min-height:60vh;text-align:center;">
  <div>
    <div style="font-size:80px;margin-bottom:16px;">🔍</div>
    <h1 style="font-size:3rem;font-weight:900;color:#0B1F3A;margin-bottom:12px;">404</h1>
    <p style="font-size:18px;color:#6B7280;margin-bottom:24px;">Page not found. This route doesn't exist yet.</p>
    <a href="/admin/dashboard" style="background:#0B1F3A;color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:700;">← Back to Dashboard</a>
  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/app.php'; ?>
