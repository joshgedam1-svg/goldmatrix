<?php
/**
 * GoldMatrix — Reusable Solution Page Template
 * Used by: Retail, Wholesale, Manufacturing
 */
require __DIR__ . '/../partials/header.php';
?>

<!-- PAGE HERO -->
<section style="background-color:#0F172A; padding: 120px 5% 75px; position:relative; border-bottom:1px solid #1E293B;">
  <div style="max-width:1100px; margin:0 auto; position:relative; z-index:1;">

    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(251,191,36,0.1);color:#FBBF24;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:6px 14px;border-radius:50rem;border:1px solid rgba(251,191,36,0.25);margin-bottom:20px;">
      <i class="bi <?= e($page_icon ?? 'bi-shop') ?>"></i>
      <?= e($page_badge ?? 'SOLUTION') ?>
    </div>

    <h1 style="font-family:var(--gm-font-display);font-size:clamp(2rem,4vw,3.1rem);font-weight:800;color:#FFFFFF;line-height:1.2;margin-bottom:18px;">
      <?= e($page_headline ?? $page_title ?? 'GoldMatrix Solution') ?>
    </h1>
    <p style="font-size:16.5px;color:#94A3B8;max-width:680px;line-height:1.75;margin-bottom:32px;">
      <?= e($page_subtitle ?? '') ?>
    </p>

    <div class="d-flex flex-wrap gap-3">
      <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-warning text-dark fw-bold px-4 py-3">
        <i class="bi bi-calendar-check-fill me-1"></i> Book Free Demo
      </a>
      <a href="/contact" class="btn btn-outline-light fw-semibold px-4 py-3">
        <i class="bi bi-telephone-fill me-1"></i> Talk to an Expert
      </a>
    </div>

  </div>
</section>

<!-- FEATURES GRID -->
<?php if (!empty($features)): ?>
<section style="padding:80px 5%; background-color:#FFFFFF;">
  <div style="max-width:1200px;margin:0 auto;">
    <div style="text-align:center;margin-bottom:48px;">
      <div style="display:inline-flex;align-items:center;gap:8px;background:#FEF3C7;color:#92400E;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:5px 14px;border-radius:50rem;border:1px solid #FDE68A;margin-bottom:12px;">WHAT IT DOES</div>
      <h2 style="font-family:var(--gm-font-display);font-size:clamp(1.6rem,2.8vw,2.3rem);font-weight:800;color:#0F172A;">Key Capabilities</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
      <?php foreach($features as $feat): ?>
      <div style="background:#FFFFFF;border-radius:10px;border:1px solid #E2E8F0;padding:26px 22px;transition:all 0.15s ease-in-out;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="width:44px;height:44px;background:#FEF3C7;border:1px solid #FDE68A;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
          <i class="bi <?= e($feat['icon'] ?? 'bi-stars') ?>" style="font-size:18px;color:#92400E;"></i>
        </div>
        <h3 style="font-family:var(--gm-font-display);font-size:1.05rem;font-weight:700;color:#0F172A;margin-bottom:8px;"><?= e($feat['title']) ?></h3>
        <p style="font-size:13.5px;color:#64748B;line-height:1.6;margin:0;"><?= e($feat['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- HOW IT WORKS -->
<?php if (!empty($workflow)): ?>
<section style="padding:72px 5%; background-color:#F8FAFC; border-top:1px solid #E2E8F0; border-bottom:1px solid #E2E8F0;">
  <div style="max-width:1100px;margin:0 auto;">
    <div style="text-align:center;margin-bottom:48px;">
      <div style="display:inline-flex;align-items:center;gap:8px;background:#FEF3C7;color:#92400E;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:5px 14px;border-radius:50rem;border:1px solid #FDE68A;margin-bottom:12px;">HOW IT WORKS</div>
      <h2 style="font-family:var(--gm-font-display);font-size:clamp(1.6rem,2.8vw,2.3rem);font-weight:800;color:#0F172A;">Simple 4-Step Process</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0;position:relative;">
      <div style="position:absolute;top:28px;left:12.5%;right:12.5%;height:2px;background:#E2E8F0;z-index:0;"></div>
      <?php foreach($workflow as $step): ?>
      <div style="text-align:center;padding:0 16px;position:relative;z-index:1;">
        <div style="width:52px;height:52px;background:#0F172A;border:2px solid #FBBF24;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-family:var(--gm-font-display);font-size:16px;font-weight:800;color:#FFFFFF;">
          <?= e($step['step']) ?>
        </div>
        <h4 style="font-family:var(--gm-font-display);font-size:15px;font-weight:700;color:#0F172A;margin-bottom:8px;"><?= e($step['title']) ?></h4>
        <p style="font-size:13px;color:#64748B;line-height:1.6;margin:0;"><?= e($step['desc']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- MINI CTA -->
<section style="background-color:#0F172A;padding:70px 5%;text-align:center;border-top:1px solid #1E293B;">
  <h2 style="font-family:var(--gm-font-display);font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;color:#FFFFFF;margin-bottom:12px;">
    Ready to See It in Action?
  </h2>
  <p style="color:#94A3B8;font-size:15.5px;margin-bottom:28px;">Book a free personalized demo and see GoldMatrix work for your exact business.</p>
  <div class="d-flex justify-content-center">
    <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-warning text-dark fw-bold px-4 py-3">
      <i class="bi bi-calendar-check-fill me-1"></i> Book Free Demo — It's Free
    </a>
  </div>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
