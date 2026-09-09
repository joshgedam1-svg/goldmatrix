<?php
/**
 * High-End Services Directory Page
 * Location: views/frontend/services-index.php
 */
require __DIR__ . '/partials/header.php';
?>

<style>
.srv-dir-hero {
  background: linear-gradient(135deg, #000B2A 0%, #001540 55%, #001E5A 100%);
  padding: 130px 5% 75px;
  color: #FFFFFF;
  text-align: center;
  position: relative;
  overflow: hidden;
  border-bottom: 1px solid rgba(220,148,35,0.18);
}
.srv-dir-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--gm-luxury-gold);
  background: rgba(220, 148, 35, 0.12);
  border: 1px solid rgba(220, 148, 35, 0.3);
  padding: 6px 14px;
  border-radius: 20px;
  margin-bottom: 16px;
}
.srv-dir-h1 {
  font-size: clamp(2.3rem, 4vw, 3.4rem);
  font-weight: 800;
  line-height: 1.18;
  letter-spacing: -0.5px;
  color: #FFFFFF;
  margin-bottom: 18px;
}
.srv-dir-sub {
  font-size: 16px;
  color: #94A3B8;
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.65;
}

/* Services Grid */
.srv-dir-grid-sec {
  background: #F8FAFC;
  padding: 90px 5%;
}
.srv-dir-card-item {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 21, 64, 0.04);
  display: flex;
  flex-direction: column;
  height: 100%;
  transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
  text-decoration: none;
  color: inherit;
}
.srv-dir-card-item:hover {
  transform: translateY(-6px);
  border-color: var(--gm-luxury-gold);
  box-shadow: 0 18px 45px rgba(0, 21, 64, 0.12);
}
.srv-dir-img-box {
  height: 220px;
  width: 100%;
  background: #001540;
  position: relative;
  overflow: hidden;
}
.srv-dir-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.srv-dir-card-item:hover .srv-dir-img {
  transform: scale(1.05);
}
.srv-dir-badge-pill {
  position: absolute;
  top: 14px;
  left: 14px;
  background: rgba(0, 15, 50, 0.88);
  border: 1px solid rgba(220,148,35,0.4);
  color: var(--gm-luxury-gold);
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.5px;
  backdrop-filter: blur(8px);
}
.srv-dir-card-body {
  padding: 28px 24px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.srv-dir-card-title {
  font-size: 19px;
  font-weight: 750;
  color: #001540;
  margin-bottom: 10px;
  line-height: 1.3;
}
.srv-dir-card-desc {
  font-size: 14px;
  color: #64748B;
  line-height: 1.6;
  margin-bottom: 22px;
}
.srv-dir-card-footer {
  margin-top: auto;
  padding-top: 16px;
  border-top: 1px solid #F1F5F9;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.srv-dir-card-action {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--gm-luxury-gold);
  display: flex;
  align-items: center;
  gap: 5px;
}
</style>

<!-- ══════════════════════════════════════════════════
     HERO BANNER
══════════════════════════════════════════════════ -->
<section class="srv-dir-hero">
  <div class="container" style="max-width: 1100px;">
    
    <div class="srv-dir-eyebrow">
      <i class="bi bi-grid-fill"></i> ENTERPRISE JEWELLERY ERP SUITE
    </div>

    <h1 class="srv-dir-h1">
      Specialized Solutions Built for Every Sector of Jewellery
    </h1>

    <p class="srv-dir-sub">
      From single-showroom retail POS to multi-factory manufacturing operations and international bullion trading, GoldMatrix powers your entire business on a unified, real-time cloud platform.
    </p>

  </div>
</section>

<!-- ══════════════════════════════════════════════════
     SERVICES GRID (6 CORE PILLARS)
══════════════════════════════════════════════════ -->
<section class="srv-dir-grid-sec">
  <div class="container-fluid px-3 px-xl-5" style="max-width: 1440px;">
    
    <div class="row g-4">
      <?php foreach ($services as $srv): ?>
        <div class="col-lg-4 col-md-6">
          <a href="/services/<?= e($srv['slug']) ?>" class="srv-dir-card-item">
            
            <div class="srv-dir-img-box">
              <img src="<?= e($srv['hero_image']) ?>" alt="<?= e($srv['title']) ?>" class="srv-dir-img" loading="lazy">
              <div class="srv-dir-badge-pill"><?= e($srv['badge']) ?></div>
            </div>

            <div class="srv-dir-card-body">
              <div class="text-uppercase fw-bold fs-11 text-muted mb-1" style="letter-spacing:1px;"><?= e($srv['category']) ?></div>
              <h3 class="srv-dir-card-title"><?= e($srv['title']) ?></h3>
              <p class="srv-dir-card-desc"><?= e($srv['hero_subtitle']) ?></p>

              <div class="srv-dir-card-footer">
                <span class="badge bg-light text-dark border fs-11 px-2 py-1">Enterprise Ready</span>
                <span class="srv-dir-card-action">
                  <span>Explore Solution</span>
                  <i class="bi bi-arrow-right"></i>
                </span>
              </div>
            </div>

          </a>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<?php
require __DIR__ . '/partials/footer.php';
?>
