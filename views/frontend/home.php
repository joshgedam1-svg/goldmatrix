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
                $b1Text = !empty($s['btn1_text']) ? $s['btn1_text'] : 'Explore Features';
                if (stripos($b1Text, 'demo') !== false) {
                    $b1Text = 'Explore Features';
                }
                $b1Link = !empty($s['btn1_link']) && !in_array($s['btn1_link'], ['#contact', '#bookDemoModal']) ? $s['btn1_link'] : '/features';
                if (in_array($b1Link, ['#features', '#modules', '#solutions', '#pricing'])) {
                    $b1Link = '/features';
                }
              ?>
              <a href="<?= e($b1Link) ?>" class="btn-gold-solid" role="button">
                <span><?= e($b1Text) ?></span>
                <i class="bi bi-arrow-right"></i>
              </a>

              <?php if (!empty($s['btn2_text']) && stripos($s['btn2_text'], 'demo') === false): ?>
                <span class="hero-trial-pill">
                  <?= e($s['btn2_text']) ?>
                </span>
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
            <img src="<?= e($b['image']) ?>" alt="<?= e($b['title']) ?>">
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
<?php if (($solutions_enabled ?? '1') == '1' && !empty($solutions_items)): ?>
<section class="section-solutions" id="solutions" style="background: #F8FAFC; padding: 90px 0;">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1400px;">

    <!-- Section Header -->
    <div class="text-center mb-5">
      <?php if (!empty($solutions_badge)): ?>
        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(217,119,6,0.1); color:#D97706; font-size:11px; font-weight:800; letter-spacing:1.8px; text-transform:uppercase; padding:6px 16px; border-radius:20px; border:1px solid rgba(217,119,6,0.25); margin-bottom:16px;">
          <?= e($solutions_badge) ?>
        </div>
      <?php endif; ?>
      <h2 style="font-family:var(--gm-font-display); font-size:clamp(1.8rem,3.2vw,2.6rem); font-weight:850; color:#0F172A; letter-spacing:-0.02em; margin-bottom:14px;">
        <?= e($solutions_title ?? 'Built for Every Jewellery Business Model') ?>
      </h2>
      <p style="font-size:16px; color:#64748B; max-width:640px; margin:0 auto; line-height:1.65;">
        <?= e($solutions_desc ?? 'Whether you run a retail showroom, wholesale operation, or manufacturing unit — GoldMatrix is built to fit your exact workflow.') ?>
      </p>
    </div>

    <!-- 3 Solution Cards Grid -->
    <div class="gm-sol-grid">
      <?php foreach ($solutions_items as $idx => $card): 
        $features = !empty($card['features']) ? (is_array($card['features']) ? $card['features'] : json_decode($card['features'], true)) : [];
        $isDark = ($idx === 1 || stripos($card['title'] ?? '', 'Wholesale') !== false || ($card['accent_color'] ?? '') === '#2563EB' || ($card['extra'] ?? '') === 'dark');
        $isMint = ($idx === 2 || stripos($card['title'] ?? '', 'Manufacturing') !== false || ($card['accent_color'] ?? '') === '#059669');
        
        // Color tokens & ambient gradient curve
        if ($isDark) {
            $cardBg = '#0B1528';
            $cardBorder = '#1E293B';
            $cornerGradient = 'radial-gradient(circle at 100% 0%, rgba(37, 99, 235, 0.22) 0%, rgba(30, 58, 138, 0.08) 50%, transparent 75%)';
            $iconBg = '#2563EB';
            $iconColor = '#FFFFFF';
            $cardIcon = !empty($card['icon']) ? $card['icon'] : 'handshake';
            $watermark = !empty($card['extra']) && $card['extra'] !== 'dark' ? $card['extra'] : 'bar-chart';
            $watermarkColor = 'rgba(255, 255, 255, 0.16)';
            $badgeColor = '#60A5FA';
            $titleColor = '#FFFFFF';
            $descColor = '#94A3B8';
            $checkColor = '#3B82F6';
            $checkText = '#E2E8F0';
            $ctaColor = '#93C5FD';
            $btnBg = '#2563EB';
            $btnColor = '#FFFFFF';
            $defaultImg = '/assets/images/solution-wholesale-bullion.jpg';
        } elseif ($isMint) {
            $cardBg = '#FFFFFF';
            $cardBorder = '#E2E8F0';
            $cornerGradient = 'radial-gradient(circle at 100% 0%, rgba(209, 250, 229, 0.85) 0%, rgba(240, 253, 244, 0.3) 50%, transparent 75%)';
            $iconBg = '#D1FAE5';
            $iconColor = '#059669';
            $cardIcon = !empty($card['icon']) ? $card['icon'] : 'bi-gear-wide-connected';
            $watermark = !empty($card['extra']) ? $card['extra'] : 'bi-hammer';
            $watermarkColor = 'rgba(16, 185, 129, 0.32)';
            $badgeColor = '#059669';
            $titleColor = '#0F172A';
            $descColor = '#64748B';
            $checkColor = '#059669';
            $checkText = '#334155';
            $ctaColor = '#059669';
            $btnBg = '#D1FAE5';
            $btnColor = '#059669';
            $defaultImg = '/assets/images/solution-manufacturing-craft.jpg';
        } else { // Retail / Amber
            $cardBg = '#FFFFFF';
            $cardBorder = '#E2E8F0';
            $cornerGradient = 'radial-gradient(circle at 100% 0%, rgba(254, 243, 199, 0.85) 0%, rgba(255, 251, 235, 0.3) 50%, transparent 75%)';
            $iconBg = '#FEF3C7';
            $iconColor = '#B45309';
            $cardIcon = !empty($card['icon']) ? $card['icon'] : 'bi-shop';
            $watermark = !empty($card['extra']) ? $card['extra'] : 'bi-gem';
            $watermarkColor = 'rgba(217, 119, 6, 0.3)';
            $badgeColor = '#D97706';
            $titleColor = '#0F172A';
            $descColor = '#64748B';
            $checkColor = '#D97706';
            $checkText = '#334155';
            $ctaColor = '#D97706';
            $btnBg = '#FEF3C7';
            $btnColor = '#B45309';
            $defaultImg = '/assets/images/solution-retail-rings.jpg';
        }

        $cardImage = !empty($card['image']) ? $card['image'] : $defaultImg;
        $btnLink = !empty($card['btn1_link']) ? $card['btn1_link'] : (!empty($card['link']) ? $card['link'] : '#');
        $btnText = !empty($card['btn1_text']) ? $card['btn1_text'] : 'Explore Software';
      ?>
      <div class="gm-sol-card-col">
        <a href="<?= e($btnLink) ?>" class="gm-sol-card-wrap">
          <div class="gm-sol-card" style="background-color: <?= $cardBg ?>; border: 1px solid <?= $cardBorder ?>;">
            
            <!-- Ambient Top-Right Corner Soft Gradient -->
            <div class="gm-sol-corner-curve" style="background: <?= $cornerGradient ?>;"></div>

            <!-- Top Header: Left Icon & Right Subtle Watermark -->
            <div class="gm-sol-top-row">
              <div class="gm-sol-icon-box" style="background: <?= $iconBg ?>;">
                <?php if (stripos($cardIcon, 'handshake') !== false): ?>
                  <!-- Handshake Vector Icon matching reference image with dual cuffs & clasp -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 36 36" fill="none" stroke="<?= $iconColor ?>" stroke-width="2.35" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block;">
                    <!-- Left Sleeve / Cuff -->
                    <rect x="3.5" y="12" width="5.5" height="12" rx="2" transform="rotate(-15 6.25 18)" />
                    <!-- Right Sleeve / Cuff -->
                    <rect x="27" y="12" width="5.5" height="12" rx="2" transform="rotate(15 29.75 18)" />
                    <!-- Top Hand & Thumb Arch -->
                    <path d="M9.5 15.5L14.8 12.2C16.8 11 19.4 11.2 21.2 12.8L25.5 17L20.5 22L17.5 19L14.5 22L9.5 17.5" />
                    <!-- Bottom Interlocked Clasped Fingers -->
                    <path d="M14.5 22L17.2 24.7C18.6 26.1 20.8 26.1 22.2 24.7L26.5 20.4" />
                    <path d="M17.5 25.2L19.8 27.5C21.2 28.9 23.4 28.9 24.8 27.5L27.5 24.8" />
                  </svg>
                <?php else: ?>
                  <i class="bi <?= e($cardIcon) ?>" style="color: <?= $iconColor ?>;"></i>
                <?php endif; ?>
              </div>
              <?php if (!empty($watermark)): ?>
                <div class="gm-sol-watermark" style="color: <?= $watermarkColor ?>;">
                  <?php if (stripos($watermark, 'chart') !== false): ?>
                    <!-- Clean SVG Bar Chart Watermark -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                      <rect x="3" y="14" width="4" height="7" rx="1"/>
                      <rect x="10" y="8" width="4" height="13" rx="1"/>
                      <rect x="17" y="3" width="4" height="18" rx="1"/>
                    </svg>
                  <?php else: ?>
                    <i class="bi <?= e($watermark) ?>"></i>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>

            <!-- Badge / Eyebrow -->
            <?php if (!empty($card['badge'])): ?>
              <div class="gm-sol-badge" style="color: <?= $badgeColor ?>;">
                <?= e($card['badge']) ?>
              </div>
            <?php endif; ?>

            <!-- Title & Description -->
            <h3 class="gm-sol-title" style="color: <?= $titleColor ?>;">
              <?= e($card['title']) ?>
            </h3>
            <p class="gm-sol-desc" style="color: <?= $descColor ?>;">
              <?= e($card['description']) ?>
            </p>

            <!-- Feature Bullet Checkpoints -->
            <?php if (!empty($features) && is_array($features)): ?>
              <ul class="gm-sol-list">
                <?php foreach ($features as $f): 
                  if (empty(trim((string)$f))) continue;
                ?>
                  <li style="color: <?= $checkText ?>;">
                    <i class="bi bi-check-circle-fill" style="color: <?= $checkColor ?>;"></i>
                    <span><?= e($f) ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <!-- Bottom Row: CTA Button & Cutout Product Asset -->
            <div class="gm-sol-bottom-row">
              <div class="gm-sol-action" style="color: <?= $ctaColor ?>;">
                <span><?= e($btnText) ?></span>
                <span class="gm-sol-arrow-circle" style="background: <?= $btnBg ?>; color: <?= $btnColor ?>;">
                  <i class="bi bi-arrow-right"></i>
                </span>
              </div>

              <?php if (!empty($cardImage)): ?>
                <div class="gm-sol-img-box">
                  <img src="<?= e($cardImage) ?>" alt="<?= e($card['alt_text'] ?? $card['title']) ?>" class="gm-sol-asset-img" loading="lazy">
                </div>
              <?php endif; ?>
            </div>

          </div>
        </a>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<style>
.gm-sol-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 26px;
  align-items: stretch;
}
.gm-sol-card-wrap {
  text-decoration: none;
  display: block;
  height: 100%;
}
.gm-sol-card {
  border-radius: 20px;
  padding: 34px 28px 24px;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  height: 100%;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
  transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
}
.gm-sol-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);
}
.gm-sol-corner-curve {
  position: absolute;
  top: 0;
  right: 0;
  width: 280px;
  height: 280px;
  pointer-events: none;
  border-top-right-radius: 20px;
  z-index: 0;
}
.gm-sol-top-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 22px;
  position: relative;
  z-index: 1;
}
.gm-sol-icon-box {
  width: 48px;
  height: 48px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}
.gm-sol-watermark {
  font-size: 32px;
  line-height: 1;
  display: flex;
  align-items: center;
}
.gm-sol-badge {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1.6px;
  text-transform: uppercase;
  margin-bottom: 8px;
  position: relative;
  z-index: 1;
}
.gm-sol-title {
  font-family: var(--gm-font-display, inherit);
  font-size: 1.35rem;
  font-weight: 800;
  line-height: 1.25;
  letter-spacing: -0.02em;
  margin-bottom: 12px;
  position: relative;
  z-index: 1;
}
.gm-sol-desc {
  font-size: 14px;
  line-height: 1.6;
  margin-bottom: 22px;
  position: relative;
  z-index: 1;
}
.gm-sol-list {
  list-style: none;
  padding: 0;
  margin: 0 0 24px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  position: relative;
  z-index: 1;
}
.gm-sol-list li {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 13.5px;
  font-weight: 550;
  line-height: 1.35;
}
.gm-sol-list li i {
  font-size: 15px;
  flex-shrink: 0;
}
.gm-sol-bottom-row {
  margin-top: auto;
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  position: relative;
  z-index: 1;
  min-height: 80px;
  padding-top: 10px;
}
.gm-sol-action {
  font-size: 13.5px;
  font-weight: 800;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding-bottom: 8px;
}
.gm-sol-arrow-circle {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  transition: transform 0.2s ease;
}
.gm-sol-card:hover .gm-sol-arrow-circle {
  transform: translateX(4px);
}
.gm-sol-img-box {
  width: 140px;
  height: 95px;
  display: flex;
  align-items: flex-end;
  justify-content: flex-end;
  margin-right: -10px;
  margin-bottom: -6px;
  pointer-events: none;
}
.gm-sol-asset-img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
  transition: transform 0.3s ease;
}
.gm-sol-card:hover .gm-sol-asset-img {
  transform: scale(1.06);
}
@media (max-width: 991px) {
  .gm-sol-grid {
    grid-template-columns: 1fr;
    gap: 22px;
  }
  .gm-sol-img-box {
    width: 120px;
    height: 85px;
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
$defaultSlidingCountries = [
    ['title' => 'UAE',           'image' => 'https://flagcdn.com/w80/ae.png'],
    ['title' => 'United States', 'image' => 'https://flagcdn.com/w80/us.png'],
    ['title' => 'Indonesia',     'image' => 'https://flagcdn.com/w80/id.png'],
    ['title' => 'Malaysia',      'image' => 'https://flagcdn.com/w80/my.png'],
    ['title' => 'Mexico',        'image' => 'https://flagcdn.com/w80/mx.png'],
    ['title' => 'Italy',         'image' => 'https://flagcdn.com/w80/it.png'],
    ['title' => 'Spain',         'image' => 'https://flagcdn.com/w80/es.png'],
    ['title' => 'India',         'image' => 'https://flagcdn.com/w80/in.png'],
    ['title' => 'Thailand',      'image' => 'https://flagcdn.com/w80/th.png'],
    ['title' => 'Hong Kong',     'image' => 'https://flagcdn.com/w80/hk.png'],
];

$renderCountriesList = !empty($sliding_countries) ? $sliding_countries : $defaultSlidingCountries;
?>
<section class="section-countries-slider" id="global-reach">
  <div class="countries-header-wrap">
    <div class="countries-badge"><?= e($countries_badge ?? 'GLOBAL PRESENCE') ?></div>
    <h2 class="countries-main-heading"><?= e($countries_title ?? 'Trusted by Jewellers Across the Globe') ?></h2>
    <span class="countries-gold-curve"></span>
  </div>

  <div class="countries-slide-viewport">
    <div class="countries-slide-track" id="countriesSlideTrack">
      <?php foreach ($renderCountriesList as $c): ?>
        <div class="country-map-card">
          <div class="country-map-img-box">
            <?php if (!empty($c['image'])): ?>
              <img src="<?= e($c['image']) ?>" alt="<?= e($c['title']) ?>" class="country-map-img" loading="lazy">
            <?php else: ?>
              <i class="bi bi-globe fs-1 text-warning"></i>
            <?php endif; ?>
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
        <img src="/assets/images/why-goldmatrix-mockup.png" alt="GoldMatrix Jewellery ERP Laptop & Mobile" class="why-mockup-img">
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
            <img class="testi-photo" src="<?= e($t[4]) ?>" alt="<?= e($t[1]) ?>">
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
