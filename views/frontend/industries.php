<?php
/**
 * GoldMatrix — Industries Page: Jewellery Business
 */
require __DIR__ . '/partials/header.php';
?>

<!-- HERO -->
<section style="background-color:#0F172A; padding: 120px 5% 80px; position:relative; overflow:hidden; text-align:center;">
  <div style="max-width:800px; margin:0 auto; position:relative; z-index:1;">
    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(245,158,11,0.12);color:#FBBF24;font-size:11px;font-weight:700;letter-spacing:1.8px;text-transform:uppercase;padding:5px 14px;border-radius:20px;border:1px solid rgba(245,158,11,0.2);margin-bottom:20px;">JEWELLERY INDUSTRY</div>
    <h1 style="font-family:var(--gm-font-display);font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#FFFFFF;line-height:1.2;letter-spacing:-0.6px;margin-bottom:16px;"><?= e($page_title ?? 'Built for the Jewellery Industry') ?></h1>
    <p style="font-size:17px;color:#94A3B8;line-height:1.75;"><?= e($page_subtitle ?? '') ?></p>
  </div>
</section>

<!-- INDUSTRY SEGMENTS -->
<section style="padding:80px 5%; background:#FFFFFF;">
  <div style="max-width:1200px;margin:0 auto;">
    <div style="text-align:center;margin-bottom:52px;">
      <h2 style="font-family:var(--gm-font-display);font-size:clamp(1.6rem,2.8vw,2.3rem);font-weight:800;color:#0F172A;letter-spacing:-0.4px;">Who Uses GoldMatrix?</h2>
      <p style="color:#64748B;font-size:15px;margin-top:10px;">Every type of jewellery business — all served by one connected platform.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
      <?php
      $segments = [
        ['icon'=>'bi-shop',          'title'=>'Jewellery Retailers',     'color'=>'#DC9423', 'bg'=>'#FFF9EC', 'desc'=>'Showrooms and retail stores that sell jewellery directly to customers — from single counters to large-format flagship stores.', 'link'=>'/solutions/jewellery-retail'],
        ['icon'=>'bi-boxes',         'title'=>'Wholesale Traders',       'color'=>'#3B82F6', 'bg'=>'#EFF6FF', 'desc'=>'Wholesale trading businesses buying and selling jewellery in bulk to retailers, with complex multi-party billing and stock management.', 'link'=>'/solutions/jewellery-wholesale'],
        ['icon'=>'bi-hammer',        'title'=>'Manufacturers',           'color'=>'#10B981', 'bg'=>'#ECFDF5', 'desc'=>'Jewellery manufacturers managing production, jobwork assignments, work orders, metal loss tracking, and work-in-progress inventory.', 'link'=>'/solutions/jewellery-manufacturing'],
        ['icon'=>'bi-currency-exchange','title'=>'Gold & Silver Dealers','color'=>'#F59E0B', 'bg'=>'#FFFBEB', 'desc'=>'Bullion dealers and gold/silver trading businesses needing precise metal tracking, weight-based billing and market rate integration.', 'link'=>'/solutions/jewellery-wholesale'],
        ['icon'=>'bi-diagram-3',     'title'=>'Multi-Branch Businesses', 'color'=>'#8B5CF6', 'bg'=>'#F5F3FF', 'desc'=>'Jewellery groups with multiple showrooms, branches and warehouses needing real-time consolidated inventory and reporting.', 'link'=>'/solutions/jewellery-retail'],
        ['icon'=>'bi-globe',         'title'=>'International Jewellers', 'color'=>'#EF4444', 'bg'=>'#FEF2F2', 'desc'=>'Jewellery businesses operating across UAE, India, Hong Kong, Malaysia, Singapore and beyond — supported in multiple currencies.', 'link'=>'/contact'],
      ];
      foreach($segments as $seg): ?>
      <a href="<?= e($seg['link']) ?>" style="text-decoration:none;">
        <div style="background:<?= $seg['bg'] ?>;border-radius:14px;border:1px solid <?= $seg['bg'] ?>;padding:28px 24px;height:100%;transition:all 0.22s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.09)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
          <div style="width:44px;height:44px;background:<?= $seg['color'] ?>;border-radius:11px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;opacity:0.9;">
            <i class="bi <?= $seg['icon'] ?>" style="font-size:18px;color:#FFFFFF;"></i>
          </div>
          <h3 style="font-family:var(--gm-font-display);font-size:1.05rem;font-weight:750;color:#0F172A;margin-bottom:8px;"><?= $seg['title'] ?></h3>
          <p style="font-size:13.5px;color:#64748B;line-height:1.65;margin:0 0 12px;"><?= $seg['desc'] ?></p>
          <span style="font-size:13px;font-weight:700;color:<?= $seg['color'] ?>;">Learn more →</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- COUNTRIES PRESENCE -->
<section style="padding:72px 5%;background:var(--gm-off-white,#FBF9F4);text-align:center;">
  <div style="max-width:900px;margin:0 auto;">
    <h2 style="font-family:var(--gm-font-display);font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;color:#0F172A;margin-bottom:12px;">Trusted by Jewellers Across the Globe</h2>
    <p style="color:#64748B;font-size:15px;margin-bottom:40px;">1,500+ jewellery businesses across 12+ countries run on GoldMatrix every day.</p>
    <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:16px 24px;">
      <?php foreach(['🇮🇳 India','🇦🇪 UAE','🇭🇰 Hong Kong','🇲🇾 Malaysia','🇸🇬 Singapore','🇮🇩 Indonesia','🇺🇸 USA','🇮🇹 Italy','🇲🇽 Mexico','🇹🇭 Thailand'] as $country): ?>
      <div style="background:#FFFFFF;border:1px solid #E2E8F0;padding:10px 18px;border-radius:25px;font-size:14px;font-weight:600;color:#334155;"><?= $country ?></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section style="background-color:#0F172A;padding:64px 5%;text-align:center;">
  <h2 style="font-family:var(--gm-font-display);font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;color:#FFFFFF;margin-bottom:12px;">Ready for a Free Demo?</h2>
  <p style="color:#94A3B8;font-size:15px;margin-bottom:28px;">See GoldMatrix work for your type of jewellery business — live and personalised.</p>
  <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-warning fw-bold px-4 py-3 text-dark rounded-3 d-inline-flex align-items-center gap-2 open-demo-modal">
    <i class="bi bi-calendar-check-fill"></i> Book Free Demo
  </a>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
