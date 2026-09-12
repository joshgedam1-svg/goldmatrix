<?php
/**
 * GoldMatrix — Solutions Index Page
 */
require __DIR__ . '/../partials/header.php';
?>

<section style="background-color:#0F172A; padding: 120px 5% 75px; position:relative; text-align:center; border-bottom:1px solid #1E293B;">
  <div style="max-width:760px; margin:0 auto; position:relative; z-index:1;">
    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(251,191,36,0.1);color:#FBBF24;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:5px 14px;border-radius:50rem;border:1px solid rgba(251,191,36,0.25);margin-bottom:20px;">BUSINESS SOLUTIONS</div>
    <h1 style="font-family:var(--gm-font-display);font-size:clamp(2rem,4vw,3rem);font-weight:800;color:#FFFFFF;line-height:1.2;margin-bottom:16px;"><?= e($page_title ?? 'Solutions') ?></h1>
    <p style="font-size:16px;color:#94A3B8;line-height:1.7;"><?= e($page_subtitle ?? '') ?></p>
  </div>
</section>

<section style="padding:80px 5%;background-color:#F8FAFC;">
  <div style="max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">

    <a href="/solutions/jewellery-retail" style="text-decoration:none;display:block;">
      <div style="background:#FFFFFF;border-radius:10px;border:1px solid #E2E8F0;padding:32px 24px;height:100%;transition:all 0.15s ease-in-out;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="width:48px;height:48px;background:#FEF3C7;border:1px solid #FDE68A;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:18px;">
          <i class="bi bi-shop" style="font-size:20px;color:#92400E;"></i>
        </div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1.4px;color:#D97706;margin-bottom:8px;">RETAIL</div>
        <h2 style="font-family:var(--gm-font-display);font-size:1.25rem;font-weight:700;color:#0F172A;margin-bottom:10px;">Jewellery Retail &amp; Showroom</h2>
        <p style="font-size:13.5px;color:#64748B;line-height:1.6;margin-bottom:18px;">POS, inventory, old gold exchange, CRM, gold rates &amp; Tax in one screen.</p>
        <span style="color:#D97706;font-size:13px;font-weight:700;">Explore → </span>
      </div>
    </a>

    <a href="/solutions/jewellery-wholesale" style="text-decoration:none;display:block;">
      <div style="background:#0F172A;border-radius:10px;border:1px solid #1E293B;padding:32px 24px;height:100%;transition:all 0.15s ease-in-out;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="width:48px;height:48px;background:rgba(251,191,36,0.15);border:1px solid rgba(251,191,36,0.3);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:18px;">
          <i class="bi bi-boxes" style="font-size:20px;color:#FBBF24;"></i>
        </div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1.4px;color:#FBBF24;margin-bottom:8px;">WHOLESALE</div>
        <h2 style="font-family:var(--gm-font-display);font-size:1.25rem;font-weight:700;color:#FFFFFF;margin-bottom:10px;">Jewellery Wholesale &amp; Trading</h2>
        <p style="font-size:13.5px;color:#94A3B8;line-height:1.6;margin-bottom:18px;">Bulk orders, branch transfers, vendor accounts &amp; multi-location stock.</p>
        <span style="color:#FBBF24;font-size:13px;font-weight:700;">Explore → </span>
      </div>
    </a>

    <a href="/solutions/jewellery-manufacturing" style="text-decoration:none;display:block;">
      <div style="background:#FFFFFF;border-radius:10px;border:1px solid #E2E8F0;padding:32px 24px;height:100%;transition:all 0.15s ease-in-out;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="width:48px;height:48px;background:#FEF3C7;border:1px solid #FDE68A;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:18px;">
          <i class="bi bi-hammer" style="font-size:20px;color:#92400E;"></i>
        </div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1.4px;color:#D97706;margin-bottom:8px;">MANUFACTURING</div>
        <h2 style="font-family:var(--gm-font-display);font-size:1.25rem;font-weight:700;color:#0F172A;margin-bottom:10px;">Jewellery Manufacturing &amp; Jobwork</h2>
        <p style="font-size:13.5px;color:#64748B;line-height:1.6;margin-bottom:18px;">Production, jobwork, work orders, metal loss &amp; WIP tracking from one platform.</p>
        <span style="color:#D97706;font-size:13px;font-weight:700;">Explore → </span>
      </div>
    </a>

  </div>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
