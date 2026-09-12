<?php
/**
 * GoldMatrix — Integrations Page
 */
require __DIR__ . '/partials/header.php';
?>

<!-- HERO -->
<section style="background-color:#0F172A; padding: 120px 5% 80px; text-align:center; position:relative; overflow:hidden;">
  <div style="max-width:720px;margin:0 auto;position:relative;z-index:1;">
    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(245,158,11,0.12);color:#FBBF24;font-size:11px;font-weight:700;letter-spacing:1.8px;text-transform:uppercase;padding:5px 14px;border-radius:20px;border:1px solid rgba(245,158,11,0.2);margin-bottom:20px;">SEAMLESS CONNECTIVITY</div>
    <h1 style="font-family:var(--gm-font-display);font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#FFFFFF;line-height:1.2;letter-spacing:-0.6px;margin-bottom:16px;">Integrations That Work With Your Jewellery Business</h1>
    <p style="font-size:17px;color:#94A3B8;line-height:1.75;">Connect GoldMatrix with the tools you already use — e-commerce, payments, accounting, WhatsApp and more.</p>
  </div>
</section>

<!-- INTEGRATIONS GRID -->
<section style="padding:80px 5%; background:#FFFFFF;">
  <div style="max-width:1200px;margin:0 auto;">
    <?php
    $integrationGroups = [
      [
        'category' => 'E-Commerce & Online Store',
        'icon'     => 'bi-shop',
        'items'    => [
          ['name'=>'Shopify',      'icon'=>'bi-shop',          'desc'=>'Sync products, orders, customers and stock in real time.'],
          ['name'=>'WooCommerce',  'icon'=>'bi-wordpress',     'desc'=>'Manage your WordPress store inventory from GoldMatrix.'],
        ]
      ],
      [
        'category' => 'Communication',
        'icon'     => 'bi-chat-dots-fill',
        'items'    => [
          ['name'=>'WhatsApp',    'icon'=>'bi-whatsapp',      'desc'=>'Send invoices, rate updates and catalogue via WhatsApp.'],
          ['name'=>'Email & SMS', 'icon'=>'bi-envelope-fill', 'desc'=>'Automated transactional emails and SMS notifications.'],
          ['name'=>'Gmail',       'icon'=>'bi-google',        'desc'=>'Integrate Gmail for centralized communication management.'],
        ]
      ],
      [
        'category' => 'Payment Processing',
        'icon'     => 'bi-credit-card-fill',
        'items'    => [
          ['name'=>'Authorize.Net',    'icon'=>'bi-credit-card-2-front', 'desc'=>'Secure Visa/MC payment gateway for global transactions.'],
          ['name'=>'Planet Payment',   'icon'=>'bi-globe',               'desc'=>'Accept international card payments with fast processing.'],
          ['name'=>'UPI / QR Pay',     'icon'=>'bi-qr-code',             'desc'=>'Indian UPI payment acceptance built directly into POS.'],
        ]
      ],
      [
        'category' => 'Tax & Compliance',
        'icon'     => 'bi-file-earmark-check',
        'items'    => [
          ['name'=>'E-Way Bill',    'icon'=>'bi-truck',                  'desc'=>'Generate e-way bills for tax-registered goods movement.'],
          ['name'=>'E-Invoice',     'icon'=>'bi-file-earmark-check',     'desc'=>'IRN-based e-invoicing for tax-registered businesses.'],
          ['name'=>'AML Compliance','icon'=>'bi-shield-check',           'desc'=>'Anti-money laundering compliance support for jewellers.'],
        ]
      ],
      [
        'category' => 'Accounting',
        'icon'     => 'bi-calculator-fill',
        'items'    => [
          ['name'=>'QuickBooks',  'icon'=>'bi-file-earmark-spreadsheet', 'desc'=>'Automate accounting, invoices and financial reporting.'],
        ]
      ],
      [
        'category' => 'Hardware & RFID',
        'icon'     => 'bi-upc-scan',
        'items'    => [
          ['name'=>'Chainway RFID',  'icon'=>'bi-upc-scan',     'desc'=>'Connect Chainway RFID scanners for lightning-fast stock audits.'],
          ['name'=>'HID Global',     'icon'=>'bi-shield-lock',  'desc'=>'Secure identity access and authentication hardware.'],
          ['name'=>'Weighing Scale', 'icon'=>'bi-speedometer',  'desc'=>'Direct weighing scale integration for auto weight entry.'],
          ['name'=>'Barcode Printer','icon'=>'bi-printer',      'desc'=>'Print barcode and QR labels directly from GoldMatrix.'],
        ]
      ],
    ];
    foreach($integrationGroups as $group):
    ?>
    <div style="margin-bottom:52px;">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:22px;padding-bottom:14px;border-bottom:1px solid #F1F5F9;">
        <div style="width:32px;height:32px;background:#FEF3C7;border-radius:8px;display:flex;align-items:center;justify-content:center;">
          <i class="bi <?= e($group['icon']) ?>" style="color:#B45309;font-size:15px;"></i>
        </div>
        <h2 style="font-family:var(--gm-font-display);font-size:1.15rem;font-weight:800;color:#0F172A;margin:0;"><?= e($group['category']) ?></h2>
      </div>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;">
        <?php foreach($group['items'] as $item): ?>
        <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:12px;padding:20px 18px;transition:all 0.2s;" onmouseover="this.style.background='#FFF9EC';this.style.borderColor='rgba(220,148,35,0.3)';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#F8FAFC';this.style.borderColor='#E2E8F0';this.style.transform=''">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
            <i class="bi <?= e($item['icon']) ?>" style="font-size:20px;color:#DC9423;"></i>
            <span style="font-weight:750;font-size:14.5px;color:#0F172A;"><?= e($item['name']) ?></span>
          </div>
          <p style="font-size:13px;color:#64748B;line-height:1.6;margin:0;"><?= e($item['desc']) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- CTA -->
<section style="background-color:#0F172A;padding:64px 5%;text-align:center;">
  <h2 style="font-family:var(--gm-font-display);font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;color:#FFFFFF;margin-bottom:12px;">Need a Custom Integration?</h2>
  <p style="color:#94A3B8;font-size:15px;margin-bottom:28px;">Contact our team and we'll connect GoldMatrix to your specific tools and workflows.</p>
  <div style="display:flex;gap:14px;flex-wrap:wrap;justify-content:center;">
    <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-warning fw-bold px-4 py-3 text-dark rounded-3 d-inline-flex align-items-center gap-2 open-demo-modal">
      <i class="bi bi-calendar-check-fill"></i> Book Free Demo
    </a>
    <a href="/contact" class="btn btn-outline-light fw-bold px-4 py-3 rounded-3 d-inline-flex align-items-center gap-2">
      <i class="bi bi-envelope-fill"></i> Contact Us
    </a>
  </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
