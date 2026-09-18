<?php
/**
 * Blog Category Archive Page
 * views/frontend/blog-category.php
 */
$meta_title    = $meta_title    ?? (e($category['name']) . ' | GoldMatrix Blog');
$meta_desc     = $meta_desc     ?? ($category['description'] ?? 'Browse articles in ' . $category['name'] . ' category on the GoldMatrix jewellery ERP blog.');
$meta_keywords = $meta_keywords ?? 'jewellery erp blog, ' . $category['name'];
include __DIR__ . '/partials/header.php';
?>

<!-- Hero Banner -->
<section style="background-color:#0F172A;padding:130px 0 50px;border-bottom:1px solid rgba(255,255,255,0.08);">
  <div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb mb-0 align-items-center" style="--bs-breadcrumb-divider:'›'; background:rgba(255,255,255,0.08); padding:8px 18px; border-radius:50px; display:inline-flex; border:1px solid rgba(255,255,255,0.15);">
        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>" class="text-white-50 text-decoration-none fs-13"><i class="bi bi-house-door me-1"></i>Home</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('blog') ?>" class="text-white-50 text-decoration-none fs-13">Blog</a></li>
        <li class="breadcrumb-item active text-warning fs-13 fw-semibold"><?= e($category['name']) ?></li>
      </ol>
    </nav>

    <div class="text-center text-white">
      <div class="badge mb-3 px-3 py-2 fs-12 fw-semibold" style="background:<?= e($category['color']) ?>20;border:1px solid <?= e($category['color']) ?>50;color:<?= e($category['color']) ?>;letter-spacing:2px">
        CATEGORY
      </div>
      <h1 class="fw-black mb-3" style="font-size:clamp(1.8rem,4vw,2.8rem)"><?= e($category['name']) ?></h1>
      <?php if (!empty($category['description'])): ?>
        <p class="text-white-50 mb-4" style="max-width:560px;margin:auto"><?= e($category['description']) ?></p>
      <?php endif; ?>
      <div class="text-white-50 fs-13"><?= count($posts) ?> article<?= count($posts) !== 1 ? 's' : '' ?> in this category</div>
    </div>

    <!-- Category Filter Pills -->
    <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
      <a href="<?= site_url('blog') ?>" class="badge px-3 py-2 fs-12 fw-semibold text-decoration-none bg-white bg-opacity-10 text-white" style="border:1px solid rgba(255,255,255,.2);border-radius:50px">All Posts</a>
      <?php foreach ($allCategories as $cat): ?>
        <a href="<?= site_url('blog/category/' . $cat['slug']) ?>"
           class="badge px-3 py-2 fs-12 fw-semibold text-decoration-none <?= $cat['slug'] === $category['slug'] ? 'bg-warning text-dark' : 'bg-white bg-opacity-10 text-white' ?>"
           style="border:1px solid rgba(255,255,255,.2);border-radius:50px">
          <?= e($cat['name']) ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Posts Grid -->
<section style="padding:64px 0;background:#F8FAFC">
  <div class="container">
    <?php if (empty($posts)): ?>
      <div class="text-center py-5">
        <i class="bi bi-file-earmark-x fs-1 text-muted d-block mb-3 opacity-25"></i>
        <h5 class="text-muted fw-normal">No articles in this category yet.</h5>
        <a href="<?= site_url('blog') ?>" class="btn btn-warning mt-3 px-4 fw-bold">View All Posts</a>
      </div>
    <?php else: ?>
      <div class="row g-4">
        <?php foreach ($posts as $post): ?>
        <div class="col-md-6 col-lg-4">
          <a href="<?= site_url('blog/' . $post['slug']) ?>" class="text-decoration-none h-100">
            <div class="card h-100 border-0 shadow-sm" style="border-radius:12px;transition:transform .2s,box-shadow .2s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 40px rgba(0,0,0,.12)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
              <div style="height:200px;overflow:hidden;border-radius:12px 12px 0 0">
                <?php if (!empty($post['featured_image'])): ?>
                  <img src="<?= e($post['featured_image']) ?>" class="w-100 h-100" style="object-fit:cover" alt="<?= e($post['title']) ?>" loading="lazy" decoding="async">
                <?php else: ?>
                  <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background-color:#0F172A">
                    <i class="bi bi-file-text-fill text-warning" style="font-size:3rem;opacity:.3"></i>
                  </div>
                <?php endif; ?>
              </div>
              <div class="card-body p-4 d-flex flex-column">
                <span class="badge rounded-pill fs-11 fw-semibold px-2 py-1 mb-2 align-self-start" style="background:<?= e($category['color']) ?>15;color:<?= e($category['color']) ?>;border:1px solid <?= e($category['color']) ?>30">
                  <?= e($category['name']) ?>
                </span>
                <h3 class="fw-bold text-dark mb-2 lh-sm" style="font-size:1.05rem"><?= e($post['title']) ?></h3>
                <p class="text-muted fs-13 flex-grow-1 mb-3"><?= e(mb_substr($post['excerpt'], 0, 100)) ?><?= mb_strlen($post['excerpt']) > 100 ? '…' : '' ?></p>
                <div class="d-flex align-items-center justify-content-between border-top pt-3 mt-auto">
                  <div class="text-muted fs-12 d-flex align-items-center gap-1">
                    <i class="bi bi-calendar3"></i>
                    <span><?= date('d M Y', strtotime($post['published_at'])) ?></span>
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
  </div>
</section>

<!-- CTA -->
<section style="background-color:#0F172A;padding:64px 0">
  <div class="container text-center text-white">
    <h2 class="fw-bold mb-3">Ready to Modernise Your Jewellery Business?</h2>
    <p class="text-white-50 mb-4">Connect with our team to explore a tailored walkthrough of GoldMatrix ERP.</p>
    <button type="button" class="btn btn-warning fw-bold px-5 py-3 open-demo-modal" data-bs-toggle="modal" data-bs-target="#bookDemoModal"><i class="bi bi-people-fill me-1"></i> Connect with Our Team</button>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
