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
      <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-warning text-dark fw-bold px-4 py-3 open-demo-modal">
        <i class="bi bi-people-fill me-1"></i> Connect with Our Team
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
    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(340px, 1fr));gap:24px;">
      <?php foreach($features as $feat): ?>
      <div style="background:#FFFFFF;border-radius:12px;border:1px solid #E2E8F0;padding:26px 22px;transition:all 0.2s ease-in-out;box-shadow:0 2px 6px rgba(15,23,42,0.04);display:flex;flex-direction:column;">
        <div style="width:46px;height:46px;background:#FEF3C7;border:1px solid #FDE68A;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;flex-shrink:0;">
          <i class="bi <?= e($feat['icon'] ?? 'bi-stars') ?>" style="font-size:20px;color:#92400E;"></i>
        </div>
        <h3 style="font-family:var(--gm-font-display);font-size:1.1rem;font-weight:700;color:#0F172A;margin-bottom:8px;"><?= e($feat['title']) ?></h3>
        <p style="font-size:13.5px;color:#64748B;line-height:1.6;margin-bottom:14px;"><?= e($feat['desc']) ?></p>
        
        <?php if (!empty($feat['workflow_text'])): ?>
          <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:10px 12px;margin-bottom:14px;font-size:11.5px;">
            <div style="font-size:10px;font-weight:700;text-transform:uppercase;color:#D97706;letter-spacing:0.8px;margin-bottom:4px;display:flex;align-items:center;gap:4px;">
              <i class="bi bi-diagram-3-fill"></i> Production Workflow
            </div>
            <div style="color:#334155;font-weight:600;line-height:1.45;">
              <?= e($feat['workflow_text']) ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (!empty($feat['points'])): ?>
          <ul style="list-style:none;padding:0;margin:auto 0 0;border-top:1px solid #F1F5F9;padding-top:14px;display:flex;flex-direction:column;gap:7px;">
            <?php foreach($feat['points'] as $pt): ?>
              <li style="font-size:12.5px;color:#334155;display:flex;align-items:baseline;gap:8px;line-height:1.45;">
                <i class="bi bi-check2-circle" style="color:#059669;font-size:13px;flex-shrink:0;"></i>
                <span><?= e($pt) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- HOW IT WORKS -->
<?php if (!empty($workflow)): ?>
<section style="padding:72px 5%; background-color:#F8FAFC; border-top:1px solid #E2E8F0; border-bottom:1px solid #E2E8F0;">
  <div style="max-width:1200px;margin:0 auto;">
    <div style="text-align:center;margin-bottom:48px;">
      <div style="display:inline-flex;align-items:center;gap:8px;background:#FEF3C7;color:#92400E;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:5px 14px;border-radius:50rem;border:1px solid #FDE68A;margin-bottom:12px;">HOW IT WORKS</div>
      <h2 style="font-family:var(--gm-font-display);font-size:clamp(1.6rem,2.8vw,2.3rem);font-weight:800;color:#0F172A;"><?= count($workflow) ?>-Step End-to-End Workflow</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:20px;position:relative;">
      <?php foreach($workflow as $step): ?>
      <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:10px;padding:24px 18px;text-align:center;position:relative;box-shadow:0 1px 3px rgba(0,0,0,0.03);">
        <div style="width:48px;height:48px;background:#0F172A;border:2px solid #FBBF24;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--gm-font-display);font-size:15px;font-weight:800;color:#FFFFFF;">
          <?= e($step['step']) ?>
        </div>
        <h4 style="font-family:var(--gm-font-display);font-size:14.5px;font-weight:700;color:#0F172A;margin-bottom:8px;"><?= e($step['title']) ?></h4>
        <p style="font-size:12.5px;color:#64748B;line-height:1.55;margin:0;"><?= e($step['desc']) ?></p>
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
  <p style="color:#94A3B8;font-size:15.5px;margin-bottom:28px;">Connect with our specialists for a tailored walkthrough of GoldMatrix for your jewellery business.</p>
  <div class="d-flex justify-content-center">
    <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-warning text-dark fw-bold px-4 py-3 open-demo-modal">
      <i class="bi bi-people-fill me-1"></i> Connect with Our Team
    </a>
  </div>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
