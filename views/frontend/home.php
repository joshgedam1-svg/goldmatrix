<?php
/**
 * GoldMatrix — Homepage (Modularized with Dynamic Header & Footer)
 */
require __DIR__ . '/partials/header.php';
?>

<!-- ════════════════════════════════
     HERO SLIDER SECTION (Multi-Slide Premium Carousel)
════════════════════════════════ -->
<?php 
$slides = !empty($hero_slides) ? $hero_slides : [
    [
        'id'          => 1,
        'badge'       => $hero_badge ?? 'ALL-IN-ONE JEWELLERY ERP',
        'title'       => 'The Complete Jewellery ERP Built to Run Your Business.',
        'description' => $hero_desc ?? 'Manage inventory, sales, manufacturing, accounting, POS, CRM, wholesale and multi-branch operations from one powerful platform.',
        'features'    => json_encode(['Cloud Based', 'Multi Branch', 'Real-time Data', 'Secure & Scalable']),
        'btn1_text'   => $hero_btn1_text ?? 'Book a Free Demo',
        'btn1_link'   => $hero_btn1_link ?? '#contact',
        'btn2_text'   => $hero_btn2_text ?? 'Start 7-Day Free Trial',
        'btn2_link'   => $hero_btn2_link ?? '#contact',
        'image'       => $hero_image ?? '',
        'mobile_image'=> '',
        'alt_text'    => 'GoldMatrix Jewellery ERP Dashboard'
    ]
];
?>
<section class="hero" id="hero">
  <div class="hero-slider-container" id="heroSliderContainer">
    
    <?php foreach ($slides as $idx => $s): 
      $feats = !empty($s['features']) ? (is_array($s['features']) ? $s['features'] : json_decode($s['features'], true)) : ['Cloud Based', 'Multi Branch', 'Real-time Data', 'Secure & Scalable'];
      $vectorIcons = [
          'bi-cloud-check',
          'bi-building',
          'bi-clock-history',
          'bi-shield-check'
      ];
      $slideAccent = !empty($s['accent_color']) ? $s['accent_color'] : '#F59E0B';
      
      // Clean title styling with gold accent
      $rawTitle = $s['title'];
      $formattedTitle = e($rawTitle);
      $highlights = ['Jewellery ERP', 'POS Software', 'Manufacturing', 'Stock Management', 'Jewellery Businesses'];
      foreach ($highlights as $h) {
          if (stripos($rawTitle, $h) !== false) {
              $formattedTitle = preg_replace('/(' . preg_quote($h, '/') . ')/i', '<span class="h1-gold">$1</span>', $formattedTitle, 1);
              break;
          }
      }
    ?>
      <div class="hero-slide <?= $idx === 0 ? 'active' : '' ?>" data-index="<?= $idx ?>" data-accent="<?= e($slideAccent) ?>" style="--slide-accent: <?= e($slideAccent) ?>;">
        <div class="hero-slide-inner">
          
          <!-- LEFT SIDE: Content -->
          <div class="hero-left">
            <?php if (!empty($s['badge'])): ?>
              <div class="hero-eyebrow">
                <?= e($s['badge']) ?>
              </div>
            <?php endif; ?>

            <?php if ($idx === 0): ?>
              <h1 class="hero-h1"><?= $formattedTitle ?></h1>
            <?php else: ?>
              <div class="hero-h1"><?= $formattedTitle ?></div>
            <?php endif; ?>

            <p class="hero-desc">
              <?= e($s['description']) ?>
            </p>

            <!-- CTA Buttons -->
            <div class="hero-btns">
              <?php 
                $b1Text = !empty($s['btn1_text']) ? $s['btn1_text'] : 'Schedule Your Meet';
                $b1Link = !empty($s['btn1_link']) && $s['btn1_link'] !== '/features' && $s['btn1_link'] !== '#contact' ? $s['btn1_link'] : '#bookDemoModal';
                $isB1Modal = (strpos($b1Link, 'bookDemoModal') !== false || $b1Link === '#contact');

                $b2Text = !empty($s['btn2_text']) ? $s['btn2_text'] : 'Start 30-Day Free Trial';
                $b2Link = !empty($s['btn2_link']) ? $s['btn2_link'] : '/request-demo';
                $isB2Modal = (strpos($b2Link, 'bookDemoModal') !== false);
              ?>
              <a href="<?= e($b1Link) ?>" class="btn-gold-solid" <?= $isB1Modal ? 'data-bs-toggle="modal" data-bs-target="#bookDemoModal"' : '' ?> role="button">
                <span><?= e($b1Text) ?></span>
                <i class="bi bi-arrow-right"></i>
              </a>

              <?php if (!empty($b2Text)): ?>
                <a href="<?= e($b2Link) ?>" class="hero-trial-pill" <?= $isB2Modal ? 'data-bs-toggle="modal" data-bs-target="#bookDemoModal"' : '' ?> style="text-decoration:none; cursor:pointer; pointer-events:auto;">
                  <span><?= e($b2Text) ?></span>
                </a>
              <?php endif; ?>
            </div>

            <!-- Clean & Sober Trust Features Row -->
            <div class="hero-badges-row">
              <?php foreach ($feats as $fidx => $feat): 
                if (empty($feat)) continue;
              ?>
                <div class="hero-badge">
                  <i class="bi <?= $vectorIcons[$fidx % count($vectorIcons)] ?>"></i>
                  <span><?= e($feat) ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- RIGHT SIDE: Visual Composition -->
          <div class="hero-right">
            <div class="hero-visual-col" style="width: 100%; display: flex; justify-content: flex-end;">
              <?php if (!empty($s['image'])): ?>
                <picture style="width: 100%; text-align: right;">
                  <?php if (!empty($s['mobile_image'])): ?>
                    <source media="(max-width: 768px)" srcset="<?= e($s['mobile_image']) ?>">
                  <?php endif; ?>
                  <img src="<?= e($s['image']) ?>" alt="<?= e(!empty($s['alt_text']) ? $s['alt_text'] : $s['title']) ?>" class="hero-slider-img" loading="<?= $idx === 0 ? 'eager' : 'lazy' ?>" <?= $idx === 0 ? 'fetchpriority="high"' : '' ?> decoding="async" style="max-height: 380px; width: auto; max-width: 100%; filter: drop-shadow(0 15px 35px rgba(0,0,0,0.45));">
                </picture>
              <?php else: ?>
                <!-- Fallback Rich Interactive Dashboard Mockup Card -->
                <div class="hero-dashboard-card" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 16px; padding: 24px; width: 100%; max-width: 520px; backdrop-filter: blur(10px); box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
                  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <span style="font-weight: 700; font-size: 14px; color: #F59E0B; display: flex; align-items: center; gap: 8px;"><i class="bi bi-speedometer2"></i> GoldMatrix Dashboard</span>
                    <span class="badge bg-success" style="font-size: 11px;">Live Sync ●</span>
                  </div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px;">
                    <div style="background: rgba(255,255,255,0.05); padding: 14px; border-radius: 10px;">
                      <div style="font-size: 12px; color: #9CA3AF;">Today Sales</div>
                      <div style="font-size: 22px; font-weight: 800; color: #F59E0B;">₹4.2L</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.05); padding: 14px; border-radius: 10px;">
                      <div style="font-size: 12px; color: #9CA3AF;">Stock Value</div>
                      <div style="font-size: 22px; font-weight: 800; color: #F59E0B;">₹1.8Cr</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.05); padding: 14px; border-radius: 10px;">
                      <div style="font-size: 12px; color: #9CA3AF;">Pending Orders</div>
                      <div style="font-size: 20px; font-weight: 700; color: #E5E7EB;">23</div>
                    </div>
                    <div style="background: rgba(255,255,255,0.05); padding: 14px; border-radius: 10px;">
                      <div style="font-size: 12px; color: #9CA3AF;">Jobwork Orders</div>
                      <div style="font-size: 20px; font-weight: 700; color: #E5E7EB;">47</div>
                    </div>
                  </div>
                  <div style="background: rgba(245,158,11,0.1); border: 1px dashed rgba(245,158,11,0.3); padding: 12px; border-radius: 8px; font-size: 12px; color: #F59E0B; text-align: center;">
                    ✓ Tax Return Filed • Tally Synced • 3 Branches Online
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>
    <?php endforeach; ?>

  </div>

  <?php if (count($slides) > 1): ?>
    <!-- Previous & Next Navigation Arrows -->
    <button class="hero-nav-arrow hero-prev" id="heroPrevBtn" aria-label="Previous Slide">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    <button class="hero-nav-arrow hero-next" id="heroNextBtn" aria-label="Next Slide">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
    </button>

    <!-- Dot Indicators -->
    <div class="hero-dots-wrap" id="heroDotsWrap">
      <?php foreach ($slides as $idx => $s): ?>
        <button class="hero-dot <?= $idx === 0 ? 'active' : '' ?>" data-slide="<?= $idx ?>" aria-label="Go to slide <?= $idx + 1 ?>"></button>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>


<!-- ════════════════════════════════
     TRUSTED BY LEADING JEWELLERY BRANDS (CLIENT LOGOS STRIP)
════════════════════════════════ -->
<?php if (!empty($brand_logos)): ?>
<section class="section-brands" id="client-brands">
  <div class="brands-wrap">
    <div class="brands-label"><?= nl2br(e($brands_title ?? "Trusted By Leading\nJewellery Brands")) ?></div>
    <div class="brands-list">
      <?php foreach($brand_logos as $b): ?>
        <?php if (!empty($b['image'])): ?>
          <a href="<?= (!empty($b['link']) && $b['link'] !== '#') ? e($b['link']) : 'javascript:void(0)' ?>" class="brand-logo" <?= (!empty($b['link']) && $b['link'] !== '#') ? 'target="_blank" rel="noopener"' : '' ?> title="<?= e($b['title']) ?>">
            <img src="<?= e($b['image']) ?>" alt="<?= e($b['title']) ?>" loading="lazy" decoding="async">
          </a>
        <?php else: ?>
          <div class="brand-logo" title="<?= e($b['title']) ?>">
            <div class="brand-logo-text"><?= e($b['title']) ?></div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ════════════════════════════════
     SOLUTIONS — 3 BUSINESS TYPES (EDITABLE CMS SECTION)
════════════════════════════════ -->
<?php if (($solutions_enabled ?? '1') == '1' && !empty($solutions_items)): 
  $firstCard = $solutions_items[0] ?? null;
  if ($firstCard && (
      stripos($firstCard['title'] ?? '', 'Jewellery Retail & Showroom') !== false || 
      stripos($firstCard['title'] ?? '', 'Retail Software') !== false ||
      stripos($firstCard['title'] ?? '', 'Interactive') !== false
  )) {
    $firstCard['badge'] = '';
    $firstCard['title'] = 'Digital Jewellery Catalogue';
    $firstCard['description'] = "Create instant digital catalogues with live gold rates and net weight. Share items and quotations directly to WhatsApp in 1 click.";
    $firstCard['features'] = [
      'Category-Wise Jewellery Showcase',
      'Real-Time Gold Rate & Weight Sync',
      '1-Click WhatsApp Share with Photos',
      'Instant Customer Quotations'
    ];
    $firstCard['image'] = '/assets/images/digital-jewellery-catalogue.png';
    $firstCard['btn1_text'] = 'Explore Digital Catalogue';
    $firstCard['btn1_link'] = '/features';
  }
  $subCards  = array_slice($solutions_items, 1);
  $firstCardFeatures = !empty($firstCard['features']) ? (is_array($firstCard['features']) ? $firstCard['features'] : json_decode($firstCard['features'], true)) : [];
?>
<section class="section-solutions" id="solutions">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1400px;">

    <!-- Section Header (SEO-Friendly Clean Title & Badges) -->
    <div class="text-center mb-4 mb-md-5">
      <?php if (!empty($solutions_badge)): ?>
        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(217,119,6,0.1); color:#D97706; font-size:11px; font-weight:800; letter-spacing:1.8px; text-transform:uppercase; padding:6px 16px; border-radius:20px; border:1px solid rgba(217,119,6,0.25); margin-bottom:14px;">
          <?= e($solutions_badge) ?>
        </div>
      <?php endif; ?>
      <h2 style="font-family:var(--gm-font-display); font-size:clamp(1.75rem,3.2vw,2.5rem); font-weight:850; color:#0F172A; letter-spacing:-0.02em; margin-bottom:12px;">
        <?= e($solutions_title ?? 'Built for Every Jewellery Business Model') ?>
      </h2>
      <p style="font-size:15px; color:#64748B; max-width:680px; margin:0 auto; line-height:1.6;">
        <?= e($solutions_desc ?? 'Engineered for high-growth jewellery retail, wholesale, and export brands across UAE, Dubai, India, and worldwide markets.') ?>
      </p>
    </div>

    <!-- 1. TOP FEATURED SHOWCASE CARD (Digital Jewellery Catalogue) -->
    <?php if ($firstCard): ?>
      <div class="gm-sol-featured-hero mb-4">
        <div class="row align-items-center g-4 g-lg-5">
          
          <!-- Left Content Column -->
          <div class="col-lg-6 col-12">
            <div class="gm-sol-featured-content">
              
              <h3 class="gm-sol-featured-title"><?= e($firstCard['title'] ?: 'Digital Jewellery Catalogue') ?></h3>
              <p class="gm-sol-featured-desc"><?= e($firstCard['description'] ?: 'Create instant digital catalogues with live gold rates and net weight. Share items and quotations directly to WhatsApp in 1 click.') ?></p>
              
              <?php if (!empty($firstCardFeatures) && is_array($firstCardFeatures)): ?>
                <ul class="gm-sol-featured-list">
                  <?php foreach ($firstCardFeatures as $f): 
                    if (empty(trim((string)$f))) continue;
                  ?>
                    <li>
                      <i class="bi bi-check-circle-fill text-warning"></i>
                      <span><?= e($f) ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>

              <div class="d-flex align-items-center flex-wrap gap-3 pt-1 gm-sol-action-row">
                <a href="<?= e($firstCard['btn1_link'] ?: '/features') ?>" class="btn-gold-solid">
                  <span><?= e($firstCard['btn1_text'] ?: 'Explore Digital Catalogue') ?></span>
                  <i class="bi bi-arrow-right"></i>
                </a>
                <span class="text-secondary fs-12 d-inline-flex align-items-center gap-1">
                  <i class="bi bi-whatsapp text-success"></i> Direct WhatsApp Ready
                </span>
              </div>
            </div>
          </div>

          <!-- Right Visual Column (Interactive Catalogue Screenshot) -->
          <div class="col-lg-6 col-12">
            <div class="gm-sol-featured-visual-wrap">
              <div class="gm-sol-featured-mockup-frame">
                <img src="<?= e($firstCard['image'] ?: '/assets/images/digital-jewellery-catalogue.png') ?>" alt="<?= e($firstCard['alt_text'] ?: $firstCard['title']) ?>" class="gm-sol-featured-img" loading="lazy">
                <div class="gm-sol-floating-pill">
                  <i class="bi bi-whatsapp text-success"></i>
                  <span>WhatsApp Catalogue Share</span>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    <?php endif; ?>

    <!-- 2. COMPACT COMPANION CARDS (UAE, Dubai & Global High-Conversion Highlights) -->
    <?php if (!empty($subCards)): ?>
      <div class="gm-sol-subgrid">
        <?php foreach ($subCards as $card): 
          $feats = !empty($card['features']) ? (is_array($card['features']) ? $card['features'] : json_decode($card['features'], true)) : [];
          $cardColor = !empty($card['accent_color']) ? $card['accent_color'] : '#2563EB';
          $cardIcon = !empty($card['icon']) ? $card['icon'] : 'bi-stars';
          $cardExtra = !empty($card['extra']) ? $card['extra'] : 'bi-gem';
          $btnLink = !empty($card['btn1_link']) ? $card['btn1_link'] : (!empty($card['link']) ? $card['link'] : '#contact');
          $btnText = !empty($card['btn1_text']) ? $card['btn1_text'] : 'Explore Feature';
        ?>
          <a href="<?= e($btnLink) ?>" class="gm-sol-compact-card">
            
            <div class="gm-sol-compact-top">
              <div class="gm-sol-compact-icon" style="background: <?= e($cardColor) ?>18; color: <?= e($cardColor) ?>;">
                <i class="bi <?= e($cardIcon) ?>"></i>
              </div>
              <div style="color: <?= e($cardColor) ?>30; font-size: 26px;">
                <i class="bi <?= e($cardExtra) ?>"></i>
              </div>
            </div>

            <?php if (!empty($card['badge'])): ?>
              <div class="gm-sol-compact-badge" style="color: <?= e($cardColor) ?>;">
                <?= e($card['badge']) ?>
              </div>
            <?php endif; ?>

            <h4 class="gm-sol-compact-title">
              <?= e($card['title']) ?>
            </h4>

            <p class="gm-sol-compact-desc">
              <?= e($card['description']) ?>
            </p>

            <?php if (!empty($feats) && is_array($feats)): ?>
              <ul class="gm-sol-compact-list">
                <?php foreach ($feats as $f): 
                  if (empty(trim((string)$f))) continue;
                ?>
                  <li>
                    <i class="bi bi-check-circle-fill" style="color: <?= e($cardColor) ?>;"></i>
                    <span><?= e($f) ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <div class="gm-sol-compact-bottom">
              <span class="gm-sol-compact-action" style="color: <?= e($cardColor) ?>;">
                <?= e($btnText) ?>
              </span>
              <span class="gm-sol-compact-arrow" style="background: <?= e($cardColor) ?>15; color: <?= e($cardColor) ?>;">
                <i class="bi bi-arrow-right"></i>
              </span>
            </div>

          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>

<style>
.section-solutions {
  background: #F8FAFC;
  padding: 85px 0;
  position: relative;
}

/* Featured Hero Showcase Card */
.gm-sol-featured-hero {
  background: #0B1528;
  border: 1px solid #1E293B;
  border-radius: 24px;
  padding: 40px 38px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 16px 40px rgba(0, 21, 64, 0.08);
}
.gm-sol-featured-hero::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  width: 450px;
  height: 450px;
  background: radial-gradient(circle at 100% 0%, rgba(245, 158, 11, 0.16) 0%, rgba(37, 99, 235, 0.08) 50%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}
.gm-sol-featured-content {
  position: relative;
  z-index: 1;
}
.gm-sol-featured-title {
  font-family: var(--gm-font-display, inherit);
  font-size: clamp(1.55rem, 2.5vw, 2.15rem);
  font-weight: 850;
  color: #FFFFFF;
  line-height: 1.25;
  letter-spacing: -0.02em;
  margin-bottom: 12px;
}
.gm-sol-featured-desc {
  font-size: 15px;
  color: #94A3B8;
  line-height: 1.6;
  margin-bottom: 20px;
}
.gm-sol-featured-list {
  list-style: none;
  padding: 0;
  margin: 0 0 24px;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px 18px;
}
.gm-sol-featured-list li {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 13.5px;
  font-weight: 600;
  color: #E2E8F0;
}
.gm-sol-featured-list li i {
  font-size: 15px;
  flex-shrink: 0;
}
.gm-sol-featured-visual-wrap {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.gm-sol-featured-mockup-frame {
  position: relative;
  border-radius: 18px;
  border: 1px solid rgba(255, 255, 255, 0.15);
  overflow: hidden;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45);
  background: #020B1F;
  transition: transform 0.3s ease, border-color 0.3s ease;
  width: 100%;
}
.gm-sol-featured-mockup-frame:hover {
  transform: translateY(-4px);
  border-color: rgba(245, 158, 11, 0.4);
}
.gm-sol-featured-img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
}
.gm-sol-floating-pill {
  position: absolute;
  bottom: 14px;
  right: 14px;
  background: rgba(11, 21, 40, 0.88);
  backdrop-filter: blur(8px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
  font-size: 11.5px;
  font-weight: 700;
  padding: 6px 14px;
  border-radius: 30px;
  display: flex;
  align-items: center;
  gap: 7px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

/* 3 Compact Companion Cards Subgrid */
.gm-sol-subgrid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  align-items: stretch;
}
.gm-sol-compact-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 20px;
  padding: 28px 24px 22px;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  height: 100%;
  box-shadow: 0 4px 16px rgba(0, 21, 64, 0.03);
  transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
  text-decoration: none;
}
.gm-sol-compact-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 16px 36px rgba(0, 21, 64, 0.08);
  border-color: rgba(245, 158, 11, 0.4);
}
.gm-sol-compact-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 16px;
}
.gm-sol-compact-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}
.gm-sol-compact-badge {
  font-size: 10.5px;
  font-weight: 800;
  letter-spacing: 1.4px;
  text-transform: uppercase;
  margin-bottom: 8px;
}
.gm-sol-compact-title {
  font-family: var(--gm-font-display, inherit);
  font-size: 1.2rem;
  font-weight: 800;
  line-height: 1.3;
  color: #0F172A;
  margin-bottom: 10px;
}
.gm-sol-compact-desc {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.55;
  margin-bottom: 16px;
}
.gm-sol-compact-list {
  list-style: none;
  padding: 0;
  margin: 0 0 18px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.gm-sol-compact-list li {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 600;
  color: #334155;
  line-height: 1.35;
}
.gm-sol-compact-list li i {
  font-size: 14px;
  flex-shrink: 0;
}
.gm-sol-compact-bottom {
  margin-top: auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 14px;
  border-top: 1px solid #F1F5F9;
}
.gm-sol-compact-action {
  font-size: 13px;
  font-weight: 800;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.gm-sol-compact-arrow {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  transition: transform 0.2s ease;
}
.gm-sol-compact-card:hover .gm-sol-compact-arrow {
  transform: translateX(3px);
}

@media (max-width: 991px) {
  .section-solutions {
    padding: 60px 0;
  }
  .gm-sol-featured-hero {
    padding: 30px 22px;
    border-radius: 20px;
  }
  .gm-sol-featured-list {
    grid-template-columns: 1fr;
    gap: 10px;
    margin-bottom: 22px;
  }
  .gm-sol-subgrid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
}

@media (max-width: 576px) {
  .section-solutions {
    padding: 45px 0;
  }
  .gm-sol-featured-hero {
    padding: 24px 16px;
    border-radius: 16px;
  }
  .gm-sol-featured-title {
    font-size: 1.45rem;
    margin-bottom: 10px;
  }
  .gm-sol-featured-desc {
    font-size: 13.5px;
    line-height: 1.55;
    margin-bottom: 18px;
  }
  .gm-sol-featured-list li {
    font-size: 12.5px;
    gap: 8px;
  }
  .gm-sol-action-row {
    flex-direction: column;
    align-items: stretch !important;
    gap: 10px !important;
  }
  .gm-sol-action-row .btn-gold-solid {
    width: 100%;
    justify-content: center;
    text-align: center;
  }
  .gm-sol-action-row span {
    justify-content: center;
  }
  .gm-sol-floating-pill {
    bottom: 10px;
    right: 10px;
    padding: 4px 10px;
    font-size: 10.5px;
    gap: 5px;
  }
  .gm-sol-compact-card {
    padding: 22px 18px 20px;
    border-radius: 16px;
  }
  .gm-sol-compact-title {
    font-size: 1.15rem;
  }
  .gm-sol-compact-desc {
    font-size: 13px;
  }
}
</style>
<?php endif; ?>

<!-- ════════════════════════════════
     FEATURE SPOTLIGHT (ZIG-ZAG DEEP DIVE SECTION)
════════════════════════════════ -->
<?php if (($spotlight_enabled ?? '1') == '1' && !empty($spotlight_items)): ?>
<section class="section-spotlight" id="spotlight">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1400px;">
    
    <?php if (!empty($spotlight_title) || !empty($spotlight_badge)): ?>
      <div class="spotlight-header-wrap">
        <?php if (!empty($spotlight_badge)): ?>
          <div class="spotlight-badge">
            <span><?= e($spotlight_badge) ?></span>
          </div>
        <?php endif; ?>
        
        <?php if (!empty($spotlight_title)): ?>
          <h2 class="spotlight-main-heading">
            <?= e($spotlight_title) ?>
          </h2>
          <span class="spotlight-gold-curve"></span>
        <?php endif; ?>

        <?php if (!empty($spotlight_desc)): ?>
          <p class="mt-3 mb-0 fs-6 mx-auto" style="max-width: 720px; color: #94A3B8;"><?= e($spotlight_desc) ?></p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- Alternating Zig-Zag Rows -->
    <div class="spotlight-rows-wrap">
      <?php foreach ($spotlight_items as $idx => $card): 
        $points = !empty($card['features']) ? json_decode($card['features'], true) : [];
        $isReversed = ($idx % 2 === 1);
      ?>
        <div class="row align-items-center g-4 g-lg-5 spotlight-row <?= $isReversed ? 'flex-lg-row-reverse' : '' ?>">
          
          <!-- Text Column -->
          <div class="col-lg-6 col-12">
            <div class="spotlight-text-col <?= $isReversed ? 'ps-lg-4' : 'pe-lg-4' ?>">
              
              <h3 class="spotlight-title"><?= e($card['title']) ?></h3>
              <p class="spotlight-desc"><?= e($card['description']) ?></p>

              <?php if (!empty($points) && is_array($points)): ?>
                <ul class="spotlight-checklist">
                  <?php foreach ($points as $p): 
                    if (empty(trim((string)$p))) continue;
                  ?>
                    <li class="spotlight-check-item">
                      <i class="bi bi-check-circle-fill"></i>
                      <span><?= e($p) ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>

            </div>
          </div>

          <!-- Screenshot / Visual Column -->
          <div class="col-lg-6 col-12">
            <div class="spotlight-img-wrap">
              <?php if (!empty($card['image'])): ?>
                <img src="<?= e($card['image']) ?>" alt="<?= e(!empty($card['alt_text']) ? $card['alt_text'] : $card['title']) ?>" class="spotlight-img" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="spotlight-img-placeholder" style="display:none; width: 100%;">
                  <div class="spotlight-card-box">
                    <span><?= e($card['title']) ?></span>
                  </div>
                </div>
              <?php else: ?>
                <div class="spotlight-img-placeholder" style="width: 100%;">
                  <div class="spotlight-card-box">
                    <span><?= e($card['title']) ?></span>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>

        </div>
      <?php endforeach; ?>
    </div>

  </div>

  <style>
  .spotlight-img-wrap {
    background: transparent !important;
    box-shadow: none !important;
  }
  .spotlight-img-wrap:hover {
    box-shadow: none !important;
  }
  .spotlight-card-box {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
    min-height: 52px;
    background: transparent !important;
    border: 1px solid rgba(255, 255, 255, 0.14);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 14px 28px;
    color: #FFFFFF;
    font-weight: 700;
    font-size: 15.5px;
    letter-spacing: 0.3px;
    box-shadow: none !important;
    transition: all 0.3s ease;
  }
  .spotlight-img-wrap:hover .spotlight-card-box {
    border-color: rgba(245, 158, 11, 0.4);
    background: transparent !important;
    box-shadow: none !important;
  }
  </style>
</section>
<?php endif; ?>

<!-- ════════════════════════════════
     CONNECTED / FEATURES SECTION
════════════════════════════════ -->
<section class="section-conn" id="features">
  <div class="conn-wrap">
    <div class="conn-top">
      <div class="conn-left">
        <div class="conn-badge">ONE PLATFORM</div>
        <h2 class="conn-title">
          <?= e($conn_title ?? 'Every Part of Your Jewellery Business,') ?><br>
          <span style="color:var(--gm-luxury-gold);"><?= e($conn_title2 ?? 'Connected.') ?></span>
        </h2>
      </div>
      <div class="conn-right">
        <p class="conn-desc">
          <?= e($conn_desc ?? 'From retail to manufacturing, from inventory to accounting — GoldMatrix brings everything together in one powerful ERP platform.') ?>
        </p>
      </div>
    </div>

    <!-- Feature Cards (6 Pillars) -->
    <div class="feat-grid">
      <?php
      $defaultFeats = [
        ['bi bi-images', 'Digital Catalogue', 'Category-wise digital catalogue (Gold, Silver, Diamond & Stones) with product images, item codes, live price, weight details, and 1-click WhatsApp sharing to customers.'],
        ['bi bi-whatsapp', 'WhatsApp Integration', 'Direct WhatsApp connectivity to chat with customers, send digital invoices, gold rate updates, order status alerts, and instant catalogue items.'],
        ['bi bi-upc-scan', 'RFID Scanner (Instant Inventory)', 'Advanced RFID (Radio Frequency Identification) scanner to calculate stock rapidly, scan multiple tags in seconds, and maintain 100% accurate inventory.'],
        ['bi bi-receipt-cutoff', 'Tax Invoicing & Bill Printing', 'Generate and print professional Tax-compliant invoices, barcode labels, and maintain complete digital billing records after bill generation.']
      ];

      $renderFeats = !empty($features_items) && count($features_items) >= 4 ?
        array_map(fn($f)=>[$f['icon'] ?: 'bi bi-stars', $f['title'], $f['description']], $features_items) : $defaultFeats;

      foreach($renderFeats as $f): 
      ?>
      <div class="feat-card">
        <div class="feat-icon">
          <i class="<?= e(trim($f[0])) ?>"></i>
        </div>
        <h3 class="feat-title"><?= $f[1] ?></h3>
        <p class="feat-desc"><?= $f[2] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════
     14 ERP MODULES
════════════════════════════════ -->
<section class="section-modules" id="modules">
  <div class="modules-wrap">
    <div class="modules-header">
      <div class="modules-badge">ENTERPRISE ERP</div>
      <h2 class="modules-title"><?= e($modules_title ?? 'Modules That Work Seamlessly') ?></h2>
      <p class="modules-desc"><?= e($modules_desc ?? 'GoldMatrix ERP is designed to scale with your jewellery business and adapt to the way you work.') ?></p>
    </div>

    <div class="modules-grid">
      <?php
      $default14Modules = [
        ['bi-grid-fill', 'Masters', 'Item master, purity touch rates, metal categories, customer & vendor directories, labor rate masters, and chart of accounts.'],
        ['bi-box-seam', 'Opening', 'Opening stock entry for gold, silver, diamond & stones, fine weight balance, cash/bank opening ledger, and customer balance setup.'],
        ['bi-file-earmark-text', 'Operations', 'Daily retail POS billing, purchase invoice entry, old gold exchange, metal issue/receipt vouchers, and counter cash settlement.'],
        ['bi-boxes', 'Stock Management', 'Real-time counter stock, tray-wise audits, barcode & RFID scanning, stock transfer between branches, and physical inventory matching.'],
        ['bi-cart-check', 'Order Management', 'Custom customer jewellery orders, quotation estimates, design approvals, advance payments, and scheduled delivery tracking.'],
        ['bi-hammer', 'Production', 'Work order allocation, metal loss & allowable wastage math, stage-wise WIP production, and labor payroll automation.'],
        ['bi-pie-chart', 'Financial Statement', 'Automated Balance Sheet, Profit & Loss (P&L), Trial Balance, Party Ledgers, Cash Book, Day Book, and journal entries.'],
        ['bi-file-earmark-bar-graph', 'Report Analysis', '180+ business intelligence reports — top selling designs, sales vs targets, production efficiency, and metal profitability analysis.'],
        ['bi-percent', 'Tax Reports', 'Automated tax summaries, e-Way bill generation, IRN e-Invoicing, and 100% tax audit compliance.'],
        ['bi-people-fill', 'Employee Management', 'Staff attendance, commission calculation on sales, daily target tracking, and role-based permissions & security.'],
        ['bi-gear-fill', 'Settings', 'System configuration, multi-branch control, automated cloud backups, audit trails, and custom invoice header designer.']
      ];

      $renderModules = !empty($modules_items) ?
        array_map(fn($m)=>[$m['icon'] ?: 'bi-stars', $m['title'], $m['description']], $modules_items) :
        $default14Modules;

      foreach ($renderModules as $mod):
      ?>
      <div class="mod-card">
        <div class="mod-icon-wrap">
          <i class="bi <?= e($mod[0]) ?>"></i>
        </div>
        <h3 class="mod-name"><?= e($mod[1]) ?></h3>
        <p class="mod-text"><?= e($mod[2]) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════
     GLOBAL REACH / SLIDING COUNTRIES (MAP)
════════════════════════════════ -->
<?php if (($countries_slider_enabled ?? '1') == '1'): ?>
<?php
$embeddedFlags = [
    'ae' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABQBAMAAABsc2MHAAAAElBMVEUAhD0AAAD////IEC5UVFRVrX4kPtyFAAAARElEQVRYw+3MwQAAIBAEwBRSSCGFFPJXSeB+++tmAGbswkgIhUKhUChsFt5AGa6AUCgUCoXCbuEJlOEMCIVCoVAo/Dh8BH+Zg5lNX1IAAAAASUVORK5CYII=',
    'us' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABUCAMAAAAyEswQAAAAQlBMVEX///8KMWGzGULsxtDZjKFCYIURN2YdQW0sTnd2jKezobRbdZWntce+yNWFmbHl6e/K0t3W3eX29/lNaYyaqr7rxc9T6EpSAAAB7klEQVRo3u2ZzXKDMAyEpSa2oQb/Qd7/VXvAwkxLTQuDQjLakyd78I4tf2gUwIP6OFnwGgHtvF/TzMvyY83nCKhsVNO+Ro2jMlMSFa2aklR9loARumlXbFNqp5XpIFLAms9yxaFzdIMh0B26LtBl1nyOgNpgg4gGERtcLI1G1Lru4/1kLV5xp2mlu/IS7IqPxUc4W7SR6lPI5dWG1KtcaN7n8lv1OQNiCz0te8hR0ACYms8Z0Nn54jpLj2Jwbvjh6+JzBbSIqBH1BOJptfjxd58n4CFQswT00BOIgcrL9OApYM3nAXWkom+8JxC3sYC64rOAWuGQ6auMUXk5oCJQV3zOduvvoF74fAH3gprvBHeCmi/gKoi3Qc3TLAionwhqlm/xEVBzBDwEar52a2dHfTtXDwH1GaD+V0fNN/rYCWoZfbx9R82BmfcDtX7K6MOlMV+kHZObyk+7EJyZffvd550sQMhHZAIQ51RKquazBmzLl6JdBfWK/wKjD5ZmoYnlHMvZxHleXvM5ONgmYrLpgMbRygONo6s+C6h7vwZiX2qu4rOMPgakl5BBjIg44JBfbdWXf5ouH/DzoE7HjEgk2tDjdmk94OPikoASUAJuBbw8ZkQi0YbuF5eAWgJKwJcPKBKJpFmQZkECSkAJWNMXoKFkunVTetAAAAAASUVORK5CYII=',
    'id' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABrAgMAAACNjmHJAAAACVBMVEX/AAD/////f3/sDLJDAAAAKUlEQVRYw+3KMREAAAgEoC9pSVNawcFzgpkEAOBTL6WWRFEURVEUL+IA4IDalyCr0mAAAAAASUVORK5CYII=',
    'my' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABQCAMAAACpg44GAAAANlBMVEUAAGYzAE0YE1wtJFTYPz/yv7//zADMAAD////lf3+CZzKcfSdkUD61kB3vvwbhtAtGOErPpRLmimgSAAACS0lEQVRo3u2YzXLkIAyEe6VE2Ugg4P1fNgc8P7uGTFJlGw70ZaaKg7+SUCMJOFgfBwsLcAHODcg58+8A3w7Wd3CWREREUrT8Y8C/B6uPF2WTRzVTngxQNzoLGxnxVIClxk5pf/SC9BJAqnxxl3YAyPn+dxhg5dN93gFAw/1vS58Hq/WNWh62PwgKwOxOOcgHg4iIlFbqhYEYARYaB0guIuL/EWQCgFKAlOovQHkIYDWY3bdjAKCiEIGKAghxSARrAFOjcgqDRYJIEGHkUsakOHQqGJTE6Pb4kUlpX8P3g9Up4dbHKYnfAF0SDfJBb5QwVRh2ucu5HtDVgNR8Q7J5KtHiAzBaLMkbXc7ZgNw16Se6jTGMSHHu1QhA+oynnTt4dpFwF5DVnwG9Q3i2zfRSvM9wJ8en+2DrISaN0VSDPeAsqFos+zCeDpg6D8n9fm7Ko5qFGiVu85XaKUopXcLTAXPPZ9g9wCWJJHEEdx7UsKb2W8duhCzOIuySQdYmPL/lD80QUmQAJgEiCGIAONKYmaSGMDTmJaRYm9WY0JucLgCst9CpdQ2ptvzkQ6c63Xq+fYAEoAog69Cxs1pN2kUpAED4fuy8ZnlkTz3fc6U8BveBU12NVW0MYuOqEU2xH6R4e3MzAcQcfriBu26ByfZPczXjhpWCJRGPGn6xZZ1+R33ZhnUBLsCrAP8crMPHzo/JtQAX4HDAz8l1uG8d7oMLcAGOBnybXMuoF+BwwOmLZPngAlyALwCnb1iXUS/ABfgC8H1yLaNegAvwhb4ANKYYr+PS7sQAAAAASUVORK5CYII=',
    'mx' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABbCAMAAADDRH7FAAAA2FBMVEX///8AaEfOESaqzMHvrrX8/PtSMh/39/VqOR1xSi3FyKju7uiOXTVkQy2seEaUmV+Kj1Lr5duhpHHQ07m8vpcxh4lBKBq6iFGjazne28eDUjLAmGb3577i4NX78+CHRiKsr4OBa1zQolwdfYCgjYLguka0tolkoKGZWivVzcfjz5CTfGmCh0e1n5I+v9mK0OHoyHDpmU3x3aF3W0jNrHzNupoZdHdck5Hf5+h6rqamtLHD1NK62uWXZkX2qFXmbG3awqrskIxTUUb0pKP6wsRPfXLjto3oeo0FJmBhAAADyElEQVRo3u3YV2/jOBAAYO45FNV7782ybEu23FucOG3z//8RjvaAez7kRXrgQLYAwYA+DDlDmujXT2KCfhBP//wkEAVSIAVSIAVSIAVSIAVSIAVSIAVSIAVS4FiAWDi0D228QBzcg1yu76UwSqAWEzlhkzqp67qd41EBMUb4cAgej7nrJ6zN1rIsjAkYmSE67AM5z5cH101shmEkPxoPEJu8MHccX3RkPwMgY4sgFKPxZLAyhEWXB77suH7dZ1BkGZa5C6MBmmm3zfMucHJn50MGGY4FIVuOBigYi+m0Q3sYYlYCoGjbAJREbURtxlP2UQ5A308YjoMB9mGcy1EASd/xokrX2n2wFBmbZUXGTVxRdNlkPgJgPO0i5JmmgGXZFTkbKoSTRdFnai65l2PIYLg1BT0lSHCD2hFtxk5qF5CsyNX+chRzkPB8eoC748gONEBGDhLwwTzk2N0ogJ4pVAHxtIPvMhIjuvcMlYeM87MdMzgQWjFGEa/xTj6dxjvIGefINoNIWy7LLJP6ISYDAk0FoS1GBm94+8O0C3aSK8qMbbco0tolAK9Q4zoeDMiruoa0TYTMCndZkO8djoMyllgpExC5Zrv3OdJ4NR0MmDYVRh8fn8gw91OIPJAZSYI2zXASdMDrMvNQpCrKYEBDNWKE3r4nWpU2WbeHRuj3qzDT13CL5i3srImq8IMBQ5NfIHQ7FrMzil9iFLVtO5dgNyhJjMTtIr5EeGt6w81BeDu8/FYU1vUcvX3++7DkdtmuF0rvIYxzvNiGA7YZ3oMmMiuKy+n0ejufrldI697ptDIry/nbol+j+SH7oKcrKtwms9nxaFknCz7vfbV0HhJuH69PSNCb1BgQiCtV+bvnmxTHAnjwdXpvZpfm/Tazvj8JMlVVwUOuJJ7eeDGKQ4Gcz2erKIqj9XU6WsXsYhUWlLChqvywa7GWLqAGtvxaeF6Ty2wGF2QRUnm04Edb778BHgoYd1VfBni9Wq+e9/nv37Pi64Hw7WpECEdoscVD72ZinDY8eV6vIIKXzebrl5Ov12vIK9F1hcRk8O2WoKuNgQkm67/AzcuLvlo/g6svEGMM+0ENJGEYh5NVsOmFm2C1eiZhrCuKjkfxp8ngKz7EMcaPcrlc3pcp4VONLEzew2M5+ugWeqoovAZzcSIQpKuqboZbPJ6jD+yZitKoimle3nSjahpFNxAZ1fkgNgyzitLL5PWNN3QljcZ4gEnQZf59evpAWBjrETDRyPlGT/kpkAIpkAIpkAIpkAIpkAIpkAIpkAIpkAL/Z/wBeFSgpx4+6xIAAAAASUVORK5CYII=',
    'it' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABrBAMAAAACzpRpAAAAElBMVEXOKzcAkkb////vt7sBkkaq28Ex4XacAAAARElEQVRo3u3MMQEAIAwDsFngwMAUYGH+TaGg385EQGpOcjt6lQmFQqFQKBQKhUKhUCgUCoVCoVAoFAqFQqFQKBQKl8IPEMdbQC6ImPwAAAAASUVORK5CYII=',
    'es' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABrCAMAAADHPnloAAAA4VBMVEX6vQCtFRnBPxOyACWgASCXMg+eEBuysrL3ugCenJuUdQSfewSXWQrytgHrsAGUJgzSnAGLSASSagGhHhSijGePHiXFXp+LUQGKWQOqkJqzhgbnqgB9ZASpCyLAkQN3KgyQPgcqU4GqkDemanFMWj6znFfapgndsztkZSGZTQa0pn+uqZquqqwNP5PgjwN2UgFXbl2wepfDo0OxIxxsQwXEVQ1CYnuXe3KmMhGkQEaDflDntiWISTHKoBugPhF2EkWlKDVnenrMZwunVFg3K3DyvRrXcQvXewexSQmicTaOYFv6L2/XAAAEJUlEQVR42u3aWXPiOBAAYBH5xpdsB9s4PjCnwz3cEAghmWRm/v8PmpYDqamdt93akh/UVDkG8fCV2nK3HFCt4oE4kAM5kAM5kAM5kAM5kAM5sMLAu4oH4sGDx/8QUaJUG9irVxw46xyri/ve7/e7MzgclCrieodjYtt1rWnbSb/XP3yvEk/pN5NmnsBZPe/B23qeJMdDhYD9uomMrh29r4Luj8vEqPeRkjSrM4dGnhiTi04wxkHXxVjSVx+RAsrKZDjRwRZncLAcAWPhBGd32qFClyC1Sb4VW5lVxJJIQBk7FboITceyBF8i53vLEncWHGKraFbpZmOCSxAt0RdF0XczSToXRVVqm3mdwywjxA9oTDOS+deSZ7LuDX6I21VJMXRHGwzyQqw3BwMtaF7Xt2ayTfTK8ok7KU8TJ5iSVBS3J6A6RvnZxbKkk8F0/TqnkwN/bKhvznS5TNNUzILAgXpnQ0kxnEJvMp1Buw4RIVv4io16i72JEjrM9DLs3YBwH0xTOGBPpuEN5ZF3BbJNsaZpdUSBUpou03sAhm113mh48xCAEfjYplh5HKndTyBcgdMS2AjDRiNs0Bk0hiP1G2OgfAWmFJjSFAMPgKFcAuXqAB8gphQ4p8JRZYCQYsMAoECB5Qy2qXA0l73IMFmnWPnY1dx4uxABOHhwOp8plkewSkJ54y5cXKstJgx9C7e2dWMXCwB0IFIsxOdRCL65LG8EOqbXXHaPoSJc27XDrjk5CXjpPAw0Ijy/PUubxnzeGMmb7ftk2N4ttjWF3QzGbVl9/aCLBBLccqS38Xj8/ArpbcDN2lRWqqwuMMMHee8CAM+SUVYSWuhag/Hg7SzLakiBH0IIwDhiuV16lDdnbCbpfRnCuAOveFPGL/OCX2EVM+23DO8V4xVqPki6KOqSMIYpHEuZnumn4j4yazj+xfQ2M7mDzdFP5QvovsEEPkPnbxEfgCgCfnxh1y0YC1xr00pyA+rlKiZS4GaZD0BjGO7oDDNbxXerz1J3A2qCK1iZT/wM9k4lUFbzxTvDjn/xT2Bwn8UimRIRkyvwW8yylEz+BhbE8TtThxQ34ITlKlH+BhLXhRxb0i3FrLuZIQUmfwIzIhLXh2sQ2i0YZgs0aMuvIHv6Bdy5vov9eBtYTwrqwTDblr8OAi1BaHkDklDyY2zhuHBBRkc1m6Hv2OkMBp2Oiez0Eyh5XjsmoigG8RNCeTk8Y1jr8lZr3Wq1jrD/XFJgsHncPbYlt3AlSDDal8NrhvvOfN16eWnNerQ3/Pn0tFFfZrPZi9p+0unzauStWxv4Bkvg3lzPjBIIC+aY7z1v7+V58vkB2ue99d6cVeo5oRmZf06Ygir+jycePP5TVP5XH/yHPRzIgRzIgRzIgRzIgRzIgRzIgRz4r+M3X0Oa0uTPoXQAAAAASUVORK5CYII=',
    'in' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABrCAMAAADHPnloAAAAOVBMVEUEajj/aCD///9Dj2r/jlgJBY66ueDb2++Tks5dW7V+fMSpqNghHZk3NKPMy+hyb75LSKz39/zo6PV6qrsSAAACDUlEQVR42u2YSY4UQRAEGwePLff8/2M50DNiYLhQjSqFwl5gCsX++HI4jxRMwRRMwRRMwRRMwRRMwRRMwRRMwRRMwRRMwRRMwRT8W8Fvh/PA4bxQcBVvlazNyzpQUJ0/4XqY4B4kOWcTaXOS5NgnCfZKtro3sDewtTay9nMEC1llAQKoAgKsUslyiqCQdaIDKugdokDHrKScIahkU2AVICCCAMoCtJF6hGAjZStgCl+lLIcaoLuQ7QTBQsZGFyxHiJkEfEE6drwiDS8LrkrfAIrBrAwzL2YwAbCddd0uWEiBCGBjValjUOpyA0QgLwjhZUFn64COjpjWGFGbzYAMBXqj3y24SFsAYN59zhEx5hx9GgAsI+8WVHKrWFFo8zFijBjDm0KLier1TnNVUEgD0KPNMI9K1nCL2aIDsOvN+nG5RupzK+gxRyPJNmY85/Cul6vkqqCx7V5seKucUUmyxmRtPqz03Wj3R3D9OYLr/gg+W90zBwdJjqNysJP6XsUxhvsIO6mKf++DMad3f++D62bBD5MkZo1oM2agnzJJfpnFPG8Wf9xm3OLHNlOO2WaO3weBRpZPNmo9ZaOGkm1/cpPUU24SCMmTrzrASMZ+u4uXADvIy2P4xZ+FWvX5WVCt9azPwttvxr2JND/wN3P+dws4/j/4r3h8PZxHkiRJkiRJkiRJkiRJkiRJ8r/yHRkqXHglmdR7AAAAAElFTkSuQmCC',
    'th' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABrBAMAAAACzpRpAAAAD1BMVEUtKkqlGTH09fiyP1Oysr6roJc9AAAAT0lEQVRo3u3ZOQEAIAwEwVjAAhawgH9NFCDhUjErYOo8NcIVEAgEAi+4wtUMBwQCgcAH7nAlSZIkfV58xrb4AIFAYBMYv2N7LgCBQGAPeAA8mWhf8DptTwAAAABJRU5ErkJggg==',
    'hk' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAABrBAMAAAACzpRpAAAAJ1BMVEX////uHCX7v8H/8fL+4uP80tTyTlX5qKvvJy/2fIH0ZWvwOED3k5dF3q2fAAADa0lEQVRo3u3Yz2sUZxjA8S8zs1lcPfSJ6WZ2Noc3v2ilHsaISYs9jGKtSg+TLIjSy06lRamHiaH26mBLCXhICgVLPSRgIWAPGfVS6WHTCmLpH9XDTDa9ZN7NzHspzFx25/Lhfed93ud53hcx/FCDNViDNViDNfi/B+/cO/u5SfALsBKD4JfAeYNTngLYMwe6IcC2OfBdACJzYAzApjHQA4BlY+B3GThmDNwAB2gaAxW0PvXBVGB3gUVv1GUeAeyA88wDUkPgJHDixxCqfsPkIKydFR+cquBq/jsBTYCWiMirn2+XBd3FA3AhD+y7PeBmUg70GskQjLO9/DSL8GZaCpzig+zPOITAZXlO/iyWAsfh9JvwYiRTEMJV8fx9sChPHA5O5PMTDxRWIhtDj2MVQKZdH8UNaWevPYqT7eHgSfaHGKOI5BbOzMrM7PVvKawvaNI0EPVRlkjozAH23kmARnJ0cBIgAPYmUS3x7DkA63GneFkOB9cBbq3BsutfGpPxZjbelgPAhaODbcBOB3Bc+taY7MaNHoCtSd8FezmAa8kGtMRrXJWfPk7kbh6J1s6rmyXAAfBkDpoiW+/JN5GIvMzAVZFHJcCHgAqBVNoXo/siIt1QE9aFYAdgCbgisv44db9ORH4A7KhsxlaAE4MTiYg37zunUvl99rOd0iXge4CPFDT+/up2+sfZEGu7Uk1xFcCpNTg3E/0iW0sBVloFzDYLCzPzvcvyRjrMF6fCEarer/sJInF7iYRWqG/qNLUxE61IOr1t2WANjlesy3fu+QtvU5EXalX6NKFhpsd2lVqWPo1A2yaOCD5FXZAtiAvyzKjg+uy5f17jhGdkAEqz8UYAvSBbZ85IAEr7EbVgXus+YdkDLmmbMB2Y99f2gOlJcGxt864D82J6wmfzIVivFaxWAvtggx1DtAuWBDBdCRzA2BIr4MgDuC9Kd7zQgQGcn1rw4Zi8AzyPK4JdcHY6AB/KBFkbVmnKHaD1ZwBsZiWBiovyArAALBEJGeHMVwy2hy3h+9mKUymw3SfhvmeJiLQDqLT13JfDDjM7zT8aHgZKTrkb5971/w9VEpf3b8AuDYcc6AtKrrA/m3WPv3s4HVLe8g94s3SLlfMgg+c1CzYv2H4Mu2t6du5xDRY33DWYA3WYA3WYA0ePP8Cx7x9y0qGJEMAAAAASUVORK5CYII=',
];

$countryCodeMap = [
    'uae'                  => 'ae',
    'united arab emirates' => 'ae',
    'united states'        => 'us',
    'usa'                  => 'us',
    'indonesia'            => 'id',
    'malaysia'             => 'my',
    'mexico'               => 'mx',
    'italy'                => 'it',
    'spain'                => 'es',
    'india'                => 'in',
    'thailand'             => 'th',
    'hong kong'            => 'hk',
    'singapore'            => 'sg',
    'saudi arabia'         => 'sa',
    'qatar'                => 'qa',
    'kuwait'               => 'kw',
    'oman'                 => 'om',
    'bahrain'              => 'bh',
    'canada'               => 'ca',
    'australia'            => 'au',
    'germany'              => 'de',
    'france'               => 'fr',
    'uk'                   => 'gb',
    'united kingdom'       => 'gb',
];

$defaultSlidingCountries = [
    ['title' => 'UAE',           'code' => 'ae'],
    ['title' => 'United States', 'code' => 'us'],
    ['title' => 'Indonesia',     'code' => 'id'],
    ['title' => 'Malaysia',      'code' => 'my'],
    ['title' => 'Mexico',        'code' => 'mx'],
    ['title' => 'Italy',         'code' => 'it'],
    ['title' => 'Spain',         'code' => 'es'],
    ['title' => 'India',         'code' => 'in'],
    ['title' => 'Thailand',      'code' => 'th'],
    ['title' => 'Hong Kong',     'code' => 'hk'],
];

$renderCountriesList = [];
$rawList = !empty($sliding_countries) ? $sliding_countries : $defaultSlidingCountries;

foreach ($rawList as $c) {
    $cTitle = trim($c['title'] ?? '');
    $codeKey = strtolower($cTitle);
    $cCode = $countryCodeMap[$codeKey] ?? ($c['code'] ?? 'in');
    
    // Always use embedded crystal-clear base64 flag
    $cImg = $embeddedFlags[$cCode] ?? "https://flagcdn.com/w80/{$cCode}.png";
    
    $c['image'] = $cImg;
    $c['code'] = $cCode;
    $renderCountriesList[] = $c;
}

$allSlidingCards = array_merge($renderCountriesList, $renderCountriesList);
?>
<section class="section-countries-slider" id="global-reach">
  <div class="countries-header-wrap">
    <div class="countries-badge"><?= e($countries_badge ?? 'GLOBAL PRESENCE') ?></div>
    <h2 class="countries-main-heading"><?= e($countries_title ?? 'Trusted by Jewellers Across the Globe') ?></h2>
    <span class="countries-gold-curve"></span>
  </div>

  <div class="countries-slide-viewport">
    <div class="countries-slide-track" id="countriesSlideTrack">
      <?php foreach ($allSlidingCards as $c): ?>
        <div class="country-map-card">
          <div class="country-map-img-box">
            <img src="<?= $c['image'] ?>" alt="<?= e($c['title']) ?>" class="country-map-img" style="width:72px; height:48px; object-fit:cover; border-radius:6px; box-shadow:0 4px 12px rgba(0,0,0,0.4);">
          </div>
          <div class="country-map-content">
            <h4 class="country-card-title"><?= e($c['title']) ?></h4>
            <p class="country-card-desc"><?= e($c['description'] ?? 'Jewellery retail and wholesale automation.') ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>


<!-- ════════════════════════════════
     TOOLS INTEGRATION SECTION
════════════════════════════════ -->
<?php if (($integrations_enabled ?? '1') == '1' && !empty($integrations_items)): ?>
<section class="section-integrations" id="integrations">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1440px;">
    
    <!-- Section Header -->
    <div class="integ-header-wrap">
      <?php if (!empty($integrations_badge)): ?>
        <div class="integ-badge">
          <span><?= e($integrations_badge) ?></span>
        </div>
      <?php endif; ?>

      <?php if (!empty($integrations_title)): ?>
        <h2 class="integ-main-heading">
          <?= e($integrations_title) ?>
        </h2>
        <span class="integ-gold-curve"></span>
      <?php endif; ?>

      <?php if (!empty($integrations_desc)): ?>
        <p class="integ-desc">
          <?= e($integrations_desc) ?>
        </p>
      <?php endif; ?>
    </div>

    <!-- 6-Column Responsive Bootstrap Cards Grid -->
    <div class="integ-grid">
      <?php foreach ($integrations_items as $tool): ?>
        <a href="<?= e($tool['link'] ?: '#contact') ?>" class="integ-card">
          
          <div class="integ-logo-wrap">
            <?php if (!empty($tool['image'])): ?>
              <img src="<?= e($tool['image']) ?>" alt="<?= e(!empty($tool['alt_text']) ? $tool['alt_text'] : $tool['title']) ?>" class="integ-logo-img" loading="lazy" onerror="this.onerror=null;this.parentElement.innerHTML='<i class=\'bi <?= e($tool['icon'] ?: 'bi-puzzle-fill') ?> fs-2 text-warning\'></i>';">
            <?php else: ?>
              <i class="bi <?= e($tool['icon'] ?: 'bi-puzzle-fill') ?> fs-2 text-warning"></i>
            <?php endif; ?>
          </div>

          <p class="integ-card-desc">
            <?= e($tool['description']) ?>
          </p>

        </a>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ════════════════════════════════
     WHY SECTION
════════════════════════════════ -->
<section class="section-why" id="why">
  <div class="why-wrap">

    <!-- Left: Content Text -->
    <div class="why-left">
      <div class="why-badge"><?= e($why_badge ?? 'MADE FOR JEWELLERY BUSINESS') ?></div>
      <h2 class="why-title">
        <?= e($why_title ?? 'Built Around How Jewellery') ?><br>
        <span class="gold-it"><?= e($why_title2 ?? 'Businesses Actually Work.') ?></span>
      </h2>

      <div class="why-checklist">
        <?php
        $defaultWhy = [
          'Weight-Based Inventory','Weighing Scale Integration',
          'Gold &amp; Silver Management','Multi-Branch Management',
          'Diamond &amp; Gemstone Tracking','Role-Based Access',
          'Barcode &amp; QR Code','Real-time Reporting',
          'RFID Integration','Secure Cloud Infrastructure',
        ];
        $renderWhy = !empty($why_features) ?
          array_map(fn($w)=>$w['title'],$why_features) : $defaultWhy;
        foreach($renderWhy as $w): ?>
        <div class="why-item">
          <div class="why-check">✓</div>
          <span><?= $w ?></span>
        </div>
        <?php endforeach; ?>
      </div>

      <a href="<?= e($why_explore_link ?? '#modules') ?>" class="btn-explore">
        <?= e($why_explore_text ?? 'Explore Features') ?> →
      </a>
    </div>

    <!-- Right: Mockup Image -->
    <div class="why-media">
      <div class="why-img-holder">
        <img src="/assets/images/why-goldmatrix-mockup.png" alt="GoldMatrix Jewellery ERP Laptop & Mobile" class="why-mockup-img" loading="lazy" decoding="async">
      </div>
    </div>

  </div>
</section>

<!-- ════════════════════════════════
     TESTIMONIALS
════════════════════════════════ -->
<section class="section-testi" id="testimonials">
  <div class="testi-wrap">
    <div class="testi-hdr">
      <h2 class="testi-title"><?= e($testi_tag ?? 'What Our Customers Say') ?></h2>
      <a href="#" class="testi-view-all"><?= e($testi_view_all ?? 'View All Testimonials →') ?></a>
    </div>
    <div class="testi-grid">
      <?php
      $defaultTestis = [
        ['R','Rajesh Mehta','Mehta Jewellers, Mumbai','GoldMatrix has completely transformed the way we manage our business.'],
        ['A','Anita Shah','Shah Gold Palace, Surat','Excellent support and best software for jewellery business management.'],
        ['V','Vikram Malhotra','Malhotra Jewellers, Delhi','We can now manage multiple branches and inventory in real-time.'],
      ];
      $renderTestis = !empty($testimonials) ?
        array_map(fn($t)=>[$t['image'] ?: $t['title'][0], $t['title'], $t['subtitle'], $t['description'], $t['image'], (int)($t['extra'] ?: 5)], $testimonials) :
        $defaultTestis;
      foreach($renderTestis as $t): ?>
      <div class="testi-card">
        <div class="testi-stars"><?= str_repeat('★', isset($t[5]) ? $t[5] : 5) ?></div>
        <p class="testi-q">"<?= e($t[3]) ?>"</p>
        <div class="testi-auth">
          <?php if (!empty($t[4])): ?>
            <img class="testi-photo" src="<?= e($t[4]) ?>" alt="<?= e($t[1]) ?>" loading="lazy" decoding="async">
          <?php else: ?>
            <div class="testi-av"><?= mb_substr(e($t[1]), 0, 1) ?></div>
          <?php endif; ?>
          <div>
            <div class="testi-name"><?= e($t[1]) ?></div>
            <div class="testi-company"><?= e($t[2]) ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════
     MOBILE APP SHOWCASE CONTAINER
════════════════════════════════ -->
<?php if (($mobile_app_enabled ?? '1') == '1'): ?>
<section class="section-mobile-app" id="mobile-app">
  <div class="container" style="max-width: 1280px;">
    
    <!-- Section Header -->
    <div class="app-header-wrap">
      <?php if (!empty($mobile_app_badge)): ?>
        <div class="app-badge">
          <span><?= e($mobile_app_badge) ?></span>
        </div>
      <?php endif; ?>

      <?php if (!empty($mobile_app_title)): ?>
        <h2 class="app-main-heading">
          <?= e($mobile_app_title) ?>
        </h2>
        <span class="app-gold-curve"></span>
      <?php endif; ?>

      <?php if (!empty($mobile_app_desc)): ?>
        <p class="app-desc">
          <?= e($mobile_app_desc) ?>
        </p>
      <?php endif; ?>
    </div>

    <!-- Featured App Showcase Poster Banner -->
    <?php if (!empty($mobile_app_banner_image)): ?>
      <div class="app-banner-card">
        <img src="<?= e($mobile_app_banner_image) ?>" alt="<?= e($mobile_app_title ?? 'GoldMatrix Jewellers App') ?>" class="app-banner-img" loading="lazy">
      </div>
    <?php endif; ?>

  </div>
</section>
<?php endif; ?>

<!-- ════════════════════════════════
     AWARDS & RECOGNITION SECTION
════════════════════════════════ -->
<?php if (!empty($awards_enabled) && $awards_enabled != '0'): ?>
<section class="section-awards" id="awards">
  <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">

    <!-- Section Header (GoldMatrix Brand System) -->
    <div class="awards-header-wrap">
      
      <!-- Main Heading -->
      <h2 class="awards-main-heading">
        <?= e(!empty($awards_title) ? $awards_title : 'Recognized & Awarded by Industry Leaders') ?>
      </h2>
      
      <!-- Gold Curve Accent -->
      <span class="awards-gold-curve"></span>

      <!-- Subtitle -->
      <?php if (!empty($awards_subtitle)): ?>
        <p class="awards-desc">
          <?= e($awards_subtitle) ?>
        </p>
      <?php else: ?>
        <p class="awards-desc">
          Recognized by industry leaders for outstanding performance, usability, and customer trust.
        </p>
      <?php endif; ?>
    </div>

    <!-- Awards Grid Cards -->
    <div class="awards-grid">
      <?php if (!empty($awards_items) && count($awards_items) > 0): ?>
        <?php foreach ($awards_items as $award): ?>
          <div class="award-card" data-aos="fade-up">
            <div class="award-img-box">
              <img src="<?= e($award['image'] ?? '') ?>" alt="<?= e($award['title'] ?? 'GoldMatrix Award Badge') ?>" loading="lazy">
            </div>
            <?php if (!empty($award['title']) || !empty($award['subtitle'])): ?>
              <div class="award-meta-info">
                <span class="award-meta-title"><?= e($award['title'] ?? '') ?></span>
                <?php if (!empty($award['subtitle'])): ?>
                  <span class="award-meta-year"><?= e($award['subtitle']) ?></span>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="award-card" data-aos="fade-up">
          <div class="award-img-box"><img src="/assets/images/awards/award-high-performer.svg" alt="High Performer" loading="lazy"></div>
          <div class="award-meta-info"><span class="award-meta-title">High Performer</span><span class="award-meta-year">Winter 2023</span></div>
        </div>
        <div class="award-card" data-aos="fade-up">
          <div class="award-img-box"><img src="/assets/images/awards/award-customers-choice.svg" alt="Customers Choice" loading="lazy"></div>
          <div class="award-meta-info"><span class="award-meta-title">Customers Choice</span><span class="award-meta-year">Summer 2022</span></div>
        </div>
        <div class="award-card" data-aos="fade-up">
          <div class="award-img-box"><img src="/assets/images/awards/award-best-usability.svg" alt="Best Usability" loading="lazy"></div>
          <div class="award-meta-info"><span class="award-meta-title">Best Usability</span><span class="award-meta-year">2021</span></div>
        </div>
        <div class="award-card" data-aos="fade-up">
          <div class="award-img-box"><img src="/assets/images/awards/award-best-support.svg" alt="Best Support" loading="lazy"></div>
          <div class="award-meta-info"><span class="award-meta-title">Best Support</span><span class="award-meta-year">2021</span></div>
        </div>
        <div class="award-card" data-aos="fade-up">
          <div class="award-img-box"><img src="/assets/images/awards/award-most-popular.svg" alt="Most Popular" loading="lazy"></div>
          <div class="award-meta-info"><span class="award-meta-title">Most Popular</span><span class="award-meta-year">Fall 2020</span></div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Indicator Dots (Theme Gold) -->
    <div class="awards-dots">
      <span class="dot active"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>

  </div>
</section>

<style>
/* ──────────────────────────────────────────────
   AWARDS SECTION (GoldMatrix Premium Design System)
────────────────────────────────────────────── */
.section-awards {
  position: relative;
  background: radial-gradient(ellipse at 50% 0%, rgba(245, 158, 11, 0.05) 0%, rgba(255, 255, 255, 0) 65%), #FFFFFF;
  padding: 85px 0 90px;
  overflow: hidden;
  border-top: 1px solid #E2E8F0;
  border-bottom: 1px solid #E2E8F0;
}

/* Header Section */
.awards-header-wrap {
  text-align: center;
  margin-bottom: 48px;
}

/* Main Heading */
.awards-main-heading {
  font-family: var(--gm-font-display, 'Plus Jakarta Sans', sans-serif);
  font-size: clamp(2rem, 3.2vw, 2.7rem);
  font-weight: 800;
  color: var(--gm-navy, #001540);
  letter-spacing: -0.5px;
  line-height: 1.25;
  margin: 0;
}

/* Gold Curve Accent */
.awards-gold-curve {
  display: block;
  width: 170px;
  height: 6px;
  margin: 12px auto 0;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 6' fill='none'%3E%3Cpath d='M2 4.5C40 1.5 110 1.5 148 4.5' stroke='%23F59E0B' stroke-width='2.5' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat center;
  background-size: contain;
}

/* Subtitle Description */
.awards-desc {
  color: #64748B;
  font-size: 15.5px;
  line-height: 1.65;
  max-width: 760px;
  margin: 16px auto 0;
}

/* Awards Cards Grid */
.awards-grid {
  display: flex;
  justify-content: center;
  align-items: stretch;
  gap: 24px;
  flex-wrap: wrap;
  margin-bottom: 38px;
}

/* Clean White Award Card */
.award-card {
  background: #FFFFFF;
  border-radius: 20px;
  padding: 26px 20px 20px;
  box-shadow: 0 6px 24px rgba(0, 21, 64, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
  border: 1px solid #E2E8F0;
  flex: 0 1 210px;
  min-width: 185px;
  max-width: 235px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  transition: transform 0.35s cubic-bezier(0.2, 1, 0.3, 1), box-shadow 0.35s ease, border-color 0.35s ease;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}

.award-card::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, #F59E0B, #FBBF24);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.award-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 18px 38px rgba(0, 21, 64, 0.08), 0 4px 12px rgba(245, 158, 11, 0.12);
  border-color: rgba(245, 158, 11, 0.4);
}

.award-card:hover::after {
  opacity: 1;
}

.award-img-box {
  width: 100%;
  height: 155px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 4px;
}

.award-img-box img {
  max-width: 100%;
  max-height: 150px;
  width: auto;
  height: auto;
  object-fit: contain;
  transition: transform 0.3s ease;
  filter: drop-shadow(0 2px 6px rgba(0, 21, 64, 0.04));
}

.award-card:hover .award-img-box img {
  transform: scale(1.04);
}

/* Card Meta Info */
.award-meta-info {
  margin-top: 14px;
  text-align: center;
  width: 100%;
  padding-top: 12px;
  border-top: 1px dashed #F1F5F9;
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.award-meta-title {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--gm-navy, #001540);
  line-height: 1.25;
}
.award-meta-year {
  font-size: 11.5px;
  font-weight: 600;
  color: #D97706;
}

/* Dots Indicator */
.awards-dots {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  margin-top: 6px;
}

.awards-dots .dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #CBD5E1;
  transition: all 0.3s ease;
}

.awards-dots .dot.active {
  width: 24px;
  border-radius: 12px;
  background: var(--gm-luxury-gold, #F59E0B);
}

/* Responsive */
@media (max-width: 768px) {
  .section-awards {
    padding: 60px 0 65px;
  }
  .awards-grid {
    gap: 14px;
  }
  .award-card {
    flex: 0 1 155px;
    min-width: 145px;
    padding: 18px 12px 14px;
    border-radius: 16px;
  }
  .award-img-box {
    height: 120px;
  }
  .award-img-box img {
    max-height: 115px;
  }
  .awards-pill-tag {
    font-size: 10.5px;
    padding: 5px 14px;
  }
}
</style>
<?php endif; ?>

<!-- ════════════════════════════════
     FINAL CTA SECTION
════════════════════════════════ -->
<section style="background-color: #0F172A; padding: 75px 5%; position:relative; border-top: 1px solid #1E293B;">
  <div style="max-width:900px; margin:0 auto; text-align:center; position:relative; z-index:1;">
    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(251,191,36,0.1);color:#FBBF24;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:5px 16px;border-radius:50rem;border:1px solid rgba(251,191,36,0.25);margin-bottom:20px;">START YOUR FREE DEMO</div>

    <h2 style="font-family:var(--gm-font-display);font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;color:#FFFFFF;line-height:1.2;margin-bottom:16px;">
      Ready to Transform Your <span style="color:#FBBF24;">Jewellery Business?</span>
    </h2>
    <p style="font-size:15.5px;color:#94A3B8;max-width:580px;margin:0 auto 36px;line-height:1.7;">Join 1,500+ jewellery businesses across 12+ countries who trust GoldMatrix ERP. Get your personalized free demo today — no commitment required.</p>

    <!-- Stats Row -->
    <div style="display:flex;justify-content:center;gap:40px;flex-wrap:wrap;margin-bottom:36px;">
      <?php foreach([['1,500+','Businesses Powered'],['12+','Countries'],['25+','Years Experience'],['24/7','Dedicated Support']] as $stat): ?>
      <div style="text-align:center;">
        <div style="font-family:var(--gm-font-display);font-size:1.7rem;font-weight:800;color:#FBBF24;line-height:1;"><?= $stat[0] ?></div>
        <div style="font-size:12px;color:#64748B;font-weight:500;margin-top:4px;"><?= $stat[1] ?></div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- CTAs -->
    <div style="display:flex;align-items:center;justify-content:center;gap:14px;flex-wrap:wrap;">
      <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-warning text-dark fw-bold px-4 py-3">
        <i class="bi bi-calendar-check-fill me-1"></i> Book Free Demo
      </a>
      <a href="https://wa.me/971563240319?text=Hi+GoldMatrix,+I+want+to+know+more+about+your+Jewellery+ERP+software." target="_blank" rel="noopener"
         class="btn btn-outline-light fw-semibold px-4 py-3">
        <i class="bi bi-whatsapp text-success me-1"></i> Chat on WhatsApp
      </a>
    </div>

    <p style="margin-top:24px;font-size:12.5px;color:#64748B;">
      <i class="bi bi-shield-check text-warning"></i> No credit card required &nbsp;·&nbsp;
      <i class="bi bi-clock text-warning"></i> Setup in 24 hours &nbsp;·&nbsp;
      <i class="bi bi-headset text-warning"></i> Dedicated onboarding support
    </p>
  </div>
</section>

<?php
require __DIR__ . '/partials/footer.php';
?>
