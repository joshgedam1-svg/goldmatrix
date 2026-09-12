<?php
/**
 * Blog Listing Page
 * views/frontend/blog-index.php
 */
$meta_title    = $meta_title    ?? 'Blog | Jewellery ERP Tips, GST Guides & Business Insights';
$meta_desc     = $meta_desc     ?? 'Expert articles on jewellery ERP software, GST compliance, inventory management, production tracking and business growth for jewellers.';
$meta_keywords = $meta_keywords ?? 'jewellery erp blog, gst for jewellers, jewellery business tips, jewellery manufacturing software';
include __DIR__ . '/partials/header.php';
?>

<!-- Hero Banner -->
<section style="background-color:#0F172A;padding:130px 0 60px;border-bottom:1px solid rgba(255,255,255,0.08);">
  <div class="container">
    <div class="text-center text-white">
      <div class="badge mb-3 px-3 py-2 fs-12 fw-semibold" style="background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.3);color:#FBBF24;letter-spacing:2px">KNOWLEDGE HUB</div>
      <h1 class="fw-black mb-3" style="font-size:clamp(2rem,5vw,3rem)">
        Jewellery Business <span style="color:#F59E0B">Blog & Insights</span>
      </h1>
      <p class="text-white-50 mb-4" style="max-width:560px;margin:auto;font-size:1.1rem">
        Expert guides on GST, ERP software, inventory, manufacturing management, and growing your jewellery business.
      </p>

      <!-- Category Filter Pills -->
      <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
        <a href="<?= site_url('blog') ?>" class="badge px-3 py-2 fs-12 fw-semibold text-decoration-none <?= empty($activeCategorySlug) ? 'bg-warning text-dark' : 'bg-white bg-opacity-10 text-white' ?>"
           style="border:1px solid rgba(255,255,255,.2);border-radius:50px">All Posts</a>
        <?php foreach ($categories as $cat): ?>
          <a href="<?= site_url('blog/category/' . $cat['slug']) ?>"
             class="badge px-3 py-2 fs-12 fw-semibold text-decoration-none <?= ($activeCategorySlug ?? '') === $cat['slug'] ? 'bg-warning text-dark' : 'bg-white bg-opacity-10 text-white' ?>"
             style="border:1px solid rgba(255,255,255,.2);border-radius:50px">
            <?= e($cat['name']) ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- Blog Grid -->
<section style="padding:64px 0;background:#F8FAFC">
  <div class="container">

    <?php if (empty($posts)): ?>
      <div class="text-center py-5">
        <i class="bi bi-file-earmark-x fs-1 text-muted d-block mb-3 opacity-25"></i>
        <h5 class="text-muted fw-normal">No articles published yet.</h5>
        <p class="text-muted fs-14">Check back soon for expert jewellery business insights.</p>
      </div>
    <?php else: ?>

      <!-- Featured / Top Post -->
      <?php $featured = $posts[0]; $remaining = array_slice($posts, 1); ?>
      <div class="row g-4 mb-5">
        <div class="col-12">
          <a href="<?= site_url('blog/' . $featured['slug']) ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px;transition:transform .2s" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
              <div class="row g-0 align-items-stretch">
                <div class="col-lg-6">
                  <?php if (!empty($featured['featured_image'])): ?>
                    <img src="<?= e($featured['featured_image']) ?>" class="img-fluid h-100 w-100" style="object-fit:cover;min-height:320px" alt="<?= e($featured['title']) ?>" loading="eager" fetchpriority="high" decoding="async">
                  <?php else: ?>
                    <div class="h-100 d-flex align-items-center justify-content-center" style="background-color:#0F172A;min-height:320px">
                      <i class="bi bi-file-text-fill text-warning" style="font-size:5rem;opacity:.3"></i>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                  <div class="p-4 p-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                      <span class="badge rounded-pill fw-semibold fs-12 px-3 py-1" style="background:<?= e($featured['category_color'] ?? '#F59E0B') ?>20;color:<?= e($featured['category_color'] ?? '#F59E0B') ?>;border:1px solid <?= e($featured['category_color'] ?? '#F59E0B') ?>40">
                        <?= e($featured['category_name'] ?? 'General') ?>
                      </span>
                      <span class="badge bg-warning text-dark fw-semibold fs-11 px-2 py-1">Featured</span>
                    </div>
                    <h2 class="fw-bold text-dark mb-3 lh-sm" style="font-size:1.5rem"><?= e($featured['title']) ?></h2>
                    <p class="text-muted mb-4" style="font-size:.95rem"><?= e($featured['excerpt']) ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="d-flex align-items-center gap-2 text-muted fs-13">
                        <i class="bi bi-person-circle"></i>
                        <span><?= e($featured['author_name']) ?></span>
                        <span>·</span>
                        <i class="bi bi-calendar3"></i>
                        <span><?= date('d M Y', strtotime($featured['published_at'])) ?></span>
                      </div>
                      <span class="btn btn-warning btn-sm fw-semibold px-3">Read More <i class="bi bi-arrow-right ms-1"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <!-- Remaining Posts Grid -->
      <?php if (!empty($remaining)): ?>
      <div class="row g-4">
        <?php foreach ($remaining as $post): ?>
        <div class="col-md-6 col-lg-4">
          <a href="<?= site_url('blog/' . $post['slug']) ?>" class="text-decoration-none h-100">
            <div class="card h-100 border-0 shadow-sm" style="border-radius:12px;transition:transform .2s,box-shadow .2s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 40px rgba(0,0,0,.12)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
              <!-- Image -->
              <div style="height:200px;overflow:hidden;border-radius:12px 12px 0 0">
                <?php if (!empty($post['featured_image'])): ?>
                  <img src="<?= e($post['featured_image']) ?>" class="w-100 h-100" style="object-fit:cover;transition:transform .3s" onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'" alt="<?= e($post['title']) ?>" loading="lazy" decoding="async">
                <?php else: ?>
                  <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background-color:#0F172A">
                    <i class="bi bi-file-text-fill text-warning" style="font-size:3rem;opacity:.3"></i>
                  </div>
                <?php endif; ?>
              </div>
              <!-- Body -->
              <div class="card-body p-4 d-flex flex-column">
                <div class="mb-2">
                  <span class="badge rounded-pill fs-11 fw-semibold px-2 py-1" style="background:<?= e($post['category_color'] ?? '#F59E0B') ?>15;color:<?= e($post['category_color'] ?? '#F59E0B') ?>;border:1px solid <?= e($post['category_color'] ?? '#F59E0B') ?>30">
                    <?= e($post['category_name'] ?? 'General') ?>
                  </span>
                </div>
                <h3 class="fw-bold text-dark mb-2 lh-sm" style="font-size:1.05rem"><?= e($post['title']) ?></h3>
                <p class="text-muted fs-13 flex-grow-1 mb-3"><?= e(mb_substr($post['excerpt'], 0, 110)) ?><?= mb_strlen($post['excerpt']) > 110 ? '…' : '' ?></p>
                <div class="d-flex align-items-center justify-content-between border-top pt-3 mt-auto">
                  <div class="text-muted fs-12 d-flex align-items-center gap-2">
                    <span><i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($post['published_at'])) ?></span>
                    <span>·</span>
                    <span><i class="bi bi-clock me-1"></i><?= (int)($post['reading_time'] ?: max(1, ceil(str_word_count(strip_tags($post['content'] ?? '')) / 200))) ?> min read</span>
                  </div>
                  <div class="text-muted fs-12 d-flex align-items-center gap-1">
                    <i class="bi bi-eye"></i>
                    <span><?= number_format((int)$post['views']) ?></span>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

    <?php endif; ?>

  </div>
</section>

<!-- CTA Section -->
<section style="background-color:#0F172A;padding:64px 0">
  <div class="container text-center text-white">
    <h2 class="fw-bold mb-3">Ready to Modernise Your Jewellery Business?</h2>
    <p class="text-white-50 mb-4">Get a free personalised demo of GoldMatrix ERP — designed exclusively for jewellers.</p>
    <button type="button" class="btn btn-warning fw-bold px-5 py-3 open-demo-modal" data-bs-toggle="modal" data-bs-target="#bookDemoModal">Book Free Demo</button>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
