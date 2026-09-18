<?php
/**
 * Single Blog Post Page
 * views/frontend/blog-post.php
 */
$meta_title    = $meta_title    ?? ($post['meta_title']       ?? $post['title'] . ' | GoldMatrix Blog');
$meta_desc     = $meta_desc     ?? ($post['meta_description'] ?? $post['excerpt'] ?? '');
$meta_keywords = $meta_keywords ?? 'jewellery erp, jewellery software, gst jewellers';
include __DIR__ . '/partials/header.php';

// Reading time estimate
$wordCount   = str_word_count(strip_tags($post['content'] ?? ''));
$readingTime = max(1, ceil($wordCount / 200));
?>

<!-- Breadcrumb + Meta Header -->
<section style="background:linear-gradient(135deg,#001540 0%,#072554 100%);padding:125px 0 50px;border-bottom:1px solid rgba(255,255,255,0.08);">
  <div class="container">
    <!-- Breadcrumb with Pill Container -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb mb-0 align-items-center" style="--bs-breadcrumb-divider:'›'; background:rgba(255,255,255,0.08); padding:8px 18px; border-radius:50px; display:inline-flex; border:1px solid rgba(255,255,255,0.15);">
        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>" class="text-white-50 text-decoration-none fs-13"><i class="bi bi-house-door me-1"></i>Home</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('blog') ?>" class="text-white-50 text-decoration-none fs-13">Blog</a></li>
        <?php if (!empty($post['category_name'])): ?>
          <li class="breadcrumb-item"><a href="<?= site_url('blog/category/' . ($post['category_slug'] ?? '')) ?>" class="text-white-50 text-decoration-none fs-13"><?= e($post['category_name']) ?></a></li>
        <?php endif; ?>
        <li class="breadcrumb-item active text-warning fs-13 fw-semibold" aria-current="page" style="max-width:320px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= e($post['title']) ?></li>
      </ol>
    </nav>

    <!-- Category Badge -->
    <?php if (!empty($post['category_name'])): ?>
      <div class="mb-3">
        <a href="<?= site_url('blog/category/' . ($post['category_slug'] ?? '')) ?>" class="badge px-3 py-2 text-decoration-none fw-semibold fs-12 shadow-sm" style="background:<?= e($post['category_color'] ?? '#F59E0B') ?>25;color:<?= e($post['category_color'] ?? '#F59E0B') ?>;border:1px solid <?= e($post['category_color'] ?? '#F59E0B') ?>50;border-radius:50px">
          <i class="bi bi-tag-fill me-1"></i><?= e($post['category_name']) ?>
        </a>
      </div>
    <?php endif; ?>

    <!-- Title -->
    <h1 class="fw-black text-white lh-sm mb-4" style="font-size:clamp(1.8rem,4vw,2.8rem);max-width:880px;letter-spacing:-0.02em;">
      <?= e($post['title']) ?>
    </h1>

    <!-- Meta Info -->
    <div class="d-flex flex-wrap align-items-center gap-3 text-white-50 fs-13 pt-1">
      <div class="d-flex align-items-center gap-2">
        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center shadow-sm" style="width:32px;height:32px">
          <i class="bi bi-person-fill text-dark" style="font-size:.85rem"></i>
        </div>
        <span class="text-white fw-semibold"><?= e($post['author_name']) ?></span>
      </div>
      <span>·</span>
      <div class="d-flex align-items-center gap-1">
        <i class="bi bi-calendar3 text-warning"></i>
        <span><?= date('d M Y', strtotime($post['published_at'])) ?></span>
      </div>
      <span>·</span>
      <div class="d-flex align-items-center gap-1">
        <i class="bi bi-clock text-warning"></i>
        <span><?= $readingTime ?> min read</span>
      </div>
      <span>·</span>
      <div class="d-flex align-items-center gap-1">
        <i class="bi bi-eye text-warning"></i>
        <span><?= number_format((int)$post['views']) ?> views</span>
      </div>
    </div>
  </div>
</section>

<!-- Main Content -->
<section style="background:#F8FAFC;padding:0 0 64px">
  <div class="container">
    <div class="row g-5 pt-4">

      <!-- Article Content (LEFT) -->
      <div class="col-lg-8">

        <!-- Featured Image -->
        <?php if (!empty($post['featured_image'])): ?>
          <div class="mb-4" style="border-radius:16px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.1)">
            <img src="<?= e($post['featured_image']) ?>" class="img-fluid w-100" style="max-height:480px;object-fit:cover" alt="<?= e($post['title']) ?>" loading="eager" fetchpriority="high" decoding="async">
          </div>
        <?php endif; ?>

        <!-- Article Card -->
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4 p-lg-5">
            <div class="blog-content" style="font-size:1.05rem;line-height:1.85;color:#374151">
              <?= $post['content'] /* HTML content — rendered as-is */ ?>
            </div>

            <!-- Tags / Share -->
            <hr class="my-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="text-muted fs-13 fw-semibold">Category:</span>
                <?php if (!empty($post['category_name'])): ?>
                  <a href="<?= site_url('blog/category/' . ($post['category_slug'] ?? '')) ?>" class="badge rounded-pill px-3 py-1 text-decoration-none fs-12 fw-semibold" style="background:<?= e($post['category_color'] ?? '#F59E0B') ?>20;color:<?= e($post['category_color'] ?? '#F59E0B') ?>;border:1px solid <?= e($post['category_color'] ?? '#F59E0B') ?>40">
                    <?= e($post['category_name']) ?>
                  </a>
                <?php endif; ?>
              </div>
              <div class="d-flex align-items-center gap-2">
                <span class="text-muted fs-13">Share:</span>
                <?php $shareUrl = urlencode(site_url('blog/' . $post['slug'])); $shareTitle = urlencode($post['title']); ?>
                <a href="https://api.whatsapp.com/send?text=<?= $shareTitle ?>%20<?= $shareUrl ?>" target="_blank" class="btn btn-sm btn-outline-success px-2" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                <a href="https://twitter.com/intent/tweet?text=<?= $shareTitle ?>&url=<?= $shareUrl ?>" target="_blank" class="btn btn-sm btn-outline-secondary px-2" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $shareUrl ?>&title=<?= $shareTitle ?>" target="_blank" class="btn btn-sm btn-outline-primary px-2" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

        <!-- Related Posts -->
        <?php if (!empty($relatedPosts)): ?>
        <div class="mt-5">
          <h4 class="fw-bold text-dark mb-4">Related Articles</h4>
          <div class="row g-3">
            <?php foreach ($relatedPosts as $rp): ?>
            <div class="col-md-6">
              <a href="<?= site_url('blog/' . $rp['slug']) ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="border-radius:10px;transition:transform .2s" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'">
                  <?php if (!empty($rp['featured_image'])): ?>
                    <img src="<?= e($rp['featured_image']) ?>" class="card-img-top" style="height:140px;object-fit:cover;border-radius:10px 10px 0 0" alt="<?= e($rp['title']) ?>" loading="lazy" decoding="async">
                  <?php endif; ?>
                  <div class="card-body p-3">
                    <h6 class="fw-bold text-dark mb-1 fs-14 lh-sm"><?= e($rp['title']) ?></h6>
                    <div class="text-muted fs-12"><?= date('d M Y', strtotime($rp['published_at'])) ?></div>
                  </div>
                </div>
              </a>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

      </div>

      <!-- SIDEBAR (RIGHT) -->
      <div class="col-lg-4">

        <!-- CTA Box -->
        <div class="card border-0 mb-4" style="border-radius:16px;background:linear-gradient(135deg,#001540,#072554)">
          <div class="card-body p-4 text-white text-center">
            <div class="mb-3">
              <div class="d-inline-flex align-items-center justify-content-center bg-warning rounded-circle mb-2" style="width:56px;height:56px">
                <i class="bi bi-gem text-dark fs-4"></i>
              </div>
            </div>
            <h5 class="fw-bold mb-2">Free Demo for Jewellers</h5>
            <p class="text-white-50 fs-13 mb-3">See GoldMatrix ERP live — tailored for your showroom size and type.</p>
            <button type="button" class="btn btn-warning fw-bold w-100 py-2 open-demo-modal" data-bs-toggle="modal" data-bs-target="#bookDemoModal">Book Free Demo</button>
          </div>
        </div>

        <!-- Categories -->
        <?php if (!empty($categories)): ?>
        <div class="card border-0 shadow-sm mb-4" style="border-radius:12px">
          <div class="card-header bg-white py-3 border-bottom">
            <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-tags-fill text-warning me-2"></i>Categories</h6>
          </div>
          <div class="card-body p-3">
            <?php foreach ($categories as $cat): ?>
              <a href="<?= site_url('blog/category/' . $cat['slug']) ?>" class="d-flex align-items-center justify-content-between text-decoration-none py-2 border-bottom text-dark fs-13 <?= ($post['category_slug'] ?? '') === $cat['slug'] ? 'fw-bold' : '' ?>">
                <div class="d-flex align-items-center gap-2">
                  <div class="rounded-circle" style="width:8px;height:8px;background:<?= e($cat['color']) ?>"></div>
                  <?= e($cat['name']) ?>
                </div>
                <span class="badge bg-light border text-dark"><?= (int)$cat['post_count'] ?></span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Recent Posts -->
        <?php if (!empty($recentPosts)): ?>
        <div class="card border-0 shadow-sm" style="border-radius:12px">
          <div class="card-header bg-white py-3 border-bottom">
            <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-clock-history text-primary me-2"></i>Recent Posts</h6>
          </div>
          <div class="card-body p-3">
            <?php foreach ($recentPosts as $rp): ?>
              <a href="<?= site_url('blog/' . $rp['slug']) ?>" class="d-flex gap-3 text-decoration-none py-2 border-bottom align-items-start">
                <?php if (!empty($rp['featured_image'])): ?>
                  <img src="<?= e($rp['featured_image']) ?>" class="rounded" style="width:56px;height:44px;object-fit:cover;flex-shrink:0" alt="" loading="lazy" decoding="async">
                <?php else: ?>
                  <div class="rounded d-flex align-items-center justify-content-center bg-light" style="width:56px;height:44px;flex-shrink:0">
                    <i class="bi bi-file-text text-muted"></i>
                  </div>
                <?php endif; ?>
                <div>
                  <div class="text-dark fw-semibold fs-13 lh-sm"><?= e($rp['title']) ?></div>
                  <div class="text-muted fs-12 mt-1"><?= date('d M Y', strtotime($rp['published_at'])) ?></div>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>

<style>
/* Blog content styles */
.blog-content h2 { font-size: 1.5rem; font-weight: 700; color: #001540; margin: 2rem 0 1rem; }
.blog-content h3 { font-size: 1.2rem; font-weight: 700; color: #001540; margin: 1.5rem 0 .75rem; }
.blog-content p  { margin-bottom: 1.25rem; }
.blog-content ul, .blog-content ol { margin-bottom: 1.25rem; padding-left: 1.5rem; }
.blog-content li { margin-bottom: .5rem; }
.blog-content blockquote { border-left: 4px solid #F59E0B; padding-left: 1.25rem; color: #6B7280; font-style: italic; margin: 1.5rem 0; }
.blog-content a  { color: #F59E0B; text-decoration: underline; }
.blog-content strong { color: #001540; }
.blog-content img { max-width: 100%; border-radius: 8px; margin: 1rem 0; }
</style>

<?php include __DIR__ . '/partials/footer.php'; ?>
