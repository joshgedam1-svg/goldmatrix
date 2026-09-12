<?php
/**
 * GoldMatrix ERP - About Us Page CMS Section Manager
 * Location: views/admin/about/settings.php
 */
$sec = $expandedSection ?? 'hero';
?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
  <div>
    <h4 class="fw-bold text-dark mb-1" style="font-size: 1.25rem;">
      <i class="bi bi-file-earmark-richtext text-warning me-2"></i>About Us Page CMS Editor
    </h4>
    <p class="text-muted fs-13 mb-0">
      Manage all 13 sections of the live About Us page (<a href="<?= site_url('about') ?>" target="_blank" class="text-primary text-decoration-none fw-semibold"><i class="bi bi-box-arrow-up-right me-1"></i>/about</a>) including titles, supporting texts, and images.
    </p>
  </div>
  <div class="d-flex align-items-center gap-2">
    <a href="<?= site_url('about') ?>" target="_blank" class="btn btn-outline-navy btn-sm px-3 py-1 fs-13">
      <i class="bi bi-eye me-1"></i> View Live About Page
    </a>
  </div>
</div>

<div class="row g-4">
  <!-- Left Side: Section Navigation Menu -->
  <div class="col-lg-3 col-md-4">
    <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 80px; z-index: 10;">
      <div class="card-header bg-navy text-white py-2 px-3">
        <h6 class="fw-bold mb-0 fs-13 text-white"><i class="bi bi-list-nested me-2"></i>About Us Sections</h6>
      </div>
      <div class="list-group list-group-flush fs-13 rounded-bottom">
        <?php
        $navSections = [
          'hero'         => ['icon' => 'bi-star',               'label' => '1. Hero Section'],
          'whoweare'     => ['icon' => 'bi-people',             'label' => '2. Who We Are'],
          'purpose'      => ['icon' => 'bi-bullseye',           'label' => '3. Our Purpose'],
          'journey'      => ['icon' => 'bi-signpost-2',         'label' => '4. Our Journey'],
          'whatwedo'     => ['icon' => 'bi-window-stack',       'label' => '5. What We Do'],
          'solutions'    => ['icon' => 'bi-grid-3x3-gap',       'label' => '6. Our Solutions'],
          'howwework'    => ['icon' => 'bi-diagram-3',          'label' => '7. How We Work'],
          'builtfor'     => ['icon' => 'bi-gem',                'label' => '8. Built for Jewellery'],
          'why'          => ['icon' => 'bi-patch-check',        'label' => '9. Why GoldMatrix'],
          'whoweserve'   => ['icon' => 'bi-shop',               'label' => '10. Who We Serve'],
          'global'       => ['icon' => 'bi-globe2',             'label' => '11. Global Presence'],
          'commitment'   => ['icon' => 'bi-shield-check',       'label' => '12. Our Commitment'],
          'cta'          => ['icon' => 'bi-megaphone',          'label' => '13. Final CTA Banner'],
          'seo'          => ['icon' => 'bi-search',             'label' => '14. SEO & Social Meta'],
        ];
        ?>
        <?php foreach ($navSections as $k => $v): ?>
          <a href="<?= admin_url('about-settings?section=' . $k) ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3 <?= $sec === $k ? 'active bg-navy text-white fw-bold' : 'text-dark' ?>">
            <span><i class="bi <?= $v['icon'] ?> me-2 <?= $sec === $k ? 'text-warning' : 'text-secondary' ?>"></i><?= $v['label'] ?></span>
            <i class="bi bi-chevron-right fs-11 <?= $sec === $k ? 'text-white' : 'text-muted' ?>"></i>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Right Side: Active Section Form -->
  <div class="col-lg-9 col-md-8">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
        <h5 class="fw-bold text-dark mb-0 fs-15">
          <i class="bi <?= $navSections[$sec]['icon'] ?? 'bi-gear' ?> text-warning me-2"></i>
          Editing: <?= $navSections[$sec]['label'] ?? 'Section' ?>
        </h5>
        <span class="badge bg-light text-secondary border fs-12">Changes apply immediately on /about</span>
      </div>

      <div class="card-body p-4">
        <form action="<?= admin_url('about-settings') ?>" method="POST" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="hidden" name="section_name" value="<?= e($sec) ?>">

          <!-- ══════════════════════════════════════════
               1. HERO SECTION
          ══════════════════════════════════════════ -->
          <?php if ($sec === 'hero'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Hero Main Heading (H1)</label>
                <input type="text" name="about_hero_title" class="form-control fs-14" value="<?= e($settings['about_hero_title'] ?? 'About GoldMatrix') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Hero Supporting Text (1–2 Lines)</label>
                <textarea name="about_hero_lead" class="form-control fs-14" rows="3"><?= e($settings['about_hero_lead'] ?? 'GoldMatrix is a jewellery business software company helping jewellery businesses simplify operations, improve control and grow with confidence.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Right Side Image (Jewellery Business / Team Visual)</label>
                <div class="input-group mb-2">
                  <input type="text" name="about_hero_image" class="form-control fs-13" value="<?= e($settings['about_hero_image'] ?? '') ?>" placeholder="Image URL (e.g. https://... or /uploads/...)">
                </div>
                <div class="d-flex align-items-center gap-3">
                  <input type="file" name="about_hero_image_file" class="form-control form-control-sm fs-12 w-auto" accept="image/*">
                  <span class="text-muted fs-12">Upload from computer (JPG, PNG, WEBP)</span>
                </div>
                <?php if (!empty($settings['about_hero_image'])): ?>
                  <div class="mt-2 p-2 border rounded bg-light" style="max-width: 250px;">
                    <img src="<?= e($settings['about_hero_image']) ?>" alt="Hero Preview" class="img-fluid rounded" style="max-height: 120px; object-fit: cover;">
                  </div>
                <?php endif; ?>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold fs-13 text-dark">Primary CTA Button Text</label>
                <input type="text" name="about_hero_btn1_text" class="form-control fs-13" value="<?= e($settings['about_hero_btn1_text'] ?? 'Book a Free Demo') ?>">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold fs-13 text-dark">Secondary Button Text</label>
                <input type="text" name="about_hero_btn2_text" class="form-control fs-13" value="<?= e($settings['about_hero_btn2_text'] ?? 'Explore Solutions') ?>">
              </div>
              <div class="col-md-12">
                <label class="form-label fw-bold fs-13 text-dark">Secondary Button Target Link</label>
                <input type="text" name="about_hero_btn2_link" class="form-control fs-13" value="<?= e($settings['about_hero_btn2_link'] ?? '/solutions') ?>">
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               2. WHO WE ARE
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'whoweare'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_whoweare_title" class="form-control fs-14" value="<?= e($settings['about_whoweare_title'] ?? 'Who We Are') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text (1–2 Lines)</label>
                <textarea name="about_whoweare_text" class="form-control fs-14" rows="3"><?= e($settings['about_whoweare_text'] ?? 'We build practical business solutions for jewellery retailers, wholesalers, manufacturers and growing jewellery enterprises.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Left Side Image (GoldMatrix Team / Office Visual)</label>
                <div class="input-group mb-2">
                  <input type="text" name="about_whoweare_image" class="form-control fs-13" value="<?= e($settings['about_whoweare_image'] ?? '') ?>" placeholder="Image URL">
                </div>
                <div class="d-flex align-items-center gap-3">
                  <input type="file" name="about_whoweare_image_file" class="form-control form-control-sm fs-12 w-auto" accept="image/*">
                  <span class="text-muted fs-12">Upload from computer</span>
                </div>
                <?php if (!empty($settings['about_whoweare_image'])): ?>
                  <div class="mt-2 p-2 border rounded bg-light" style="max-width: 250px;">
                    <img src="<?= e($settings['about_whoweare_image']) ?>" alt="Who We Are Preview" class="img-fluid rounded" style="max-height: 120px; object-fit: cover;">
                  </div>
                <?php endif; ?>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               3. OUR PURPOSE
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'purpose'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_purpose_title" class="form-control fs-14" value="<?= e($settings['about_purpose_title'] ?? 'Our Purpose') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text (1–2 Lines)</label>
                <textarea name="about_purpose_text" class="form-control fs-14" rows="3"><?= e($settings['about_purpose_text'] ?? 'To make complex jewellery business operations simpler, more accurate and easier to manage.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Right Side Image (Jewellery Operations Visual)</label>
                <div class="input-group mb-2">
                  <input type="text" name="about_purpose_image" class="form-control fs-13" value="<?= e($settings['about_purpose_image'] ?? '') ?>" placeholder="Image URL">
                </div>
                <div class="d-flex align-items-center gap-3">
                  <input type="file" name="about_purpose_image_file" class="form-control form-control-sm fs-12 w-auto" accept="image/*">
                  <span class="text-muted fs-12">Upload from computer</span>
                </div>
                <?php if (!empty($settings['about_purpose_image'])): ?>
                  <div class="mt-2 p-2 border rounded bg-light" style="max-width: 250px;">
                    <img src="<?= e($settings['about_purpose_image']) ?>" alt="Purpose Preview" class="img-fluid rounded" style="max-height: 120px; object-fit: cover;">
                  </div>
                <?php endif; ?>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               4. OUR JOURNEY
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'journey'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_journey_title" class="form-control fs-14" value="<?= e($settings['about_journey_title'] ?? 'Our Journey') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text (1–2 Lines)</label>
                <textarea name="about_journey_text" class="form-control fs-14" rows="3"><?= e($settings['about_journey_text'] ?? 'Our journey is shaped by continuous experience, customer relationships and a deep understanding of jewellery business operations.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Timeline Roadmap Items (JSON Structure)</label>
                <textarea name="about_journey_items" class="form-control font-monospace fs-12" rows="7"><?= e($settings['about_journey_items'] ?? '') ?></textarea>
                <small class="text-muted">Edit phase names, titles, and descriptions formatted as JSON.</small>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               5. WHAT WE DO
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'whatwedo'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_whatwedo_title" class="form-control fs-14" value="<?= e($settings['about_whatwedo_title'] ?? 'What We Do') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text (1–2 Lines)</label>
                <textarea name="about_whatwedo_text" class="form-control fs-14" rows="3"><?= e($settings['about_whatwedo_text'] ?? 'We provide connected business solutions covering the key operations of modern jewellery businesses.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Software Showcase Image / Screenshot Collage</label>
                <div class="input-group mb-2">
                  <input type="text" name="about_whatwedo_image" class="form-control fs-13" value="<?= e($settings['about_whatwedo_image'] ?? '') ?>" placeholder="Image URL (e.g. /uploads/homepage/hp_6a9207ee140eb.png)">
                </div>
                <div class="d-flex align-items-center gap-3">
                  <input type="file" name="about_whatwedo_image_file" class="form-control form-control-sm fs-12 w-auto" accept="image/*">
                  <span class="text-muted fs-12">Upload software screenshot from computer</span>
                </div>
                <?php if (!empty($settings['about_whatwedo_image'])): ?>
                  <div class="mt-2 p-2 border rounded bg-light" style="max-width: 320px;">
                    <img src="<?= e($settings['about_whatwedo_image']) ?>" alt="Software Preview" class="img-fluid rounded" style="max-height: 140px; object-fit: contain;">
                  </div>
                <?php endif; ?>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               6. OUR SOLUTIONS
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'solutions'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_solutions_title" class="form-control fs-14" value="<?= e($settings['about_solutions_title'] ?? 'Our Solutions') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text</label>
                <textarea name="about_solutions_text" class="form-control fs-14" rows="2"><?= e($settings['about_solutions_text'] ?? 'Explore our dedicated solution modules built exclusively for jewellery commerce.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">6 Solution Cards (JSON Structure)</label>
                <textarea name="about_solutions_items" class="form-control font-monospace fs-12" rows="8"><?= e($settings['about_solutions_items'] ?? '') ?></textarea>
                <small class="text-muted">6 Cards: Jewellery Retail, Wholesale, Manufacturing, Inventory, Accounting, CRM.</small>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               7. HOW WE WORK
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'howwework'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_howwework_title" class="form-control fs-14" value="<?= e($settings['about_howwework_title'] ?? 'How We Work') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text (1–2 Lines)</label>
                <textarea name="about_howwework_text" class="form-control fs-14" rows="2"><?= e($settings['about_howwework_text'] ?? 'A structured, customer-first approach to deploying software that fits your operations.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Right Side Consultation Image</label>
                <div class="input-group mb-2">
                  <input type="text" name="about_howwework_image" class="form-control fs-13" value="<?= e($settings['about_howwework_image'] ?? '') ?>" placeholder="Image URL">
                </div>
                <div class="d-flex align-items-center gap-3">
                  <input type="file" name="about_howwework_image_file" class="form-control form-control-sm fs-12 w-auto" accept="image/*">
                  <span class="text-muted fs-12">Upload from computer</span>
                </div>
                <?php if (!empty($settings['about_howwework_image'])): ?>
                  <div class="mt-2 p-2 border rounded bg-light" style="max-width: 250px;">
                    <img src="<?= e($settings['about_howwework_image']) ?>" alt="How We Work Preview" class="img-fluid rounded" style="max-height: 120px; object-fit: cover;">
                  </div>
                <?php endif; ?>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">3 Step Process (Understand ➔ Implement ➔ Support)</label>
                <textarea name="about_howwework_steps" class="form-control font-monospace fs-12" rows="6"><?= e($settings['about_howwework_steps'] ?? '') ?></textarea>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               8. BUILT FOR JEWELLERY BUSINESSES
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'builtfor'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_builtfor_title" class="form-control fs-14" value="<?= e($settings['about_builtfor_title'] ?? 'Built for Jewellery Businesses') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text (1–2 Lines)</label>
                <textarea name="about_builtfor_text" class="form-control fs-14" rows="3"><?= e($settings['about_builtfor_text'] ?? 'Our solutions are designed around the unique requirements of jewellery retail, wholesale, manufacturing and business operations.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">4-Image Business Grid Data (JSON)</label>
                <textarea name="about_builtfor_items" class="form-control font-monospace fs-12" rows="8"><?= e($settings['about_builtfor_items'] ?? '') ?></textarea>
                <small class="text-muted">4 Grid items: Retail Showroom, Wholesale Operation, Jewellery Manufacturing, Business Management.</small>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               9. WHY GOLDMATRIX
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'why'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_why_title" class="form-control fs-14" value="<?= e($settings['about_why_title'] ?? 'Why GoldMatrix') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text</label>
                <textarea name="about_why_text" class="form-control fs-14" rows="2"><?= e($settings['about_why_text'] ?? 'Engineered specifically for the demands and operational integrity of the jewellery industry.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">6 Benefit Cards (JSON Structure)</label>
                <textarea name="about_why_items" class="form-control font-monospace fs-12" rows="8"><?= e($settings['about_why_items'] ?? '') ?></textarea>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               10. WHO WE SERVE
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'whoweserve'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_whoweserve_title" class="form-control fs-14" value="<?= e($settings['about_whoweserve_title'] ?? 'Who We Serve') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text (1–2 Lines)</label>
                <textarea name="about_whoweserve_text" class="form-control fs-14" rows="3"><?= e($settings['about_whoweserve_text'] ?? 'From individual jewellery businesses to growing enterprises, GoldMatrix supports different stages of the jewellery business.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">5 Category Cards (JSON Structure)</label>
                <textarea name="about_whoweserve_items" class="form-control font-monospace fs-12" rows="8"><?= e($settings['about_whoweserve_items'] ?? '') ?></textarea>
                <small class="text-muted">5 Cards: Retailers, Wholesalers, Manufacturers, Girvi / Mortgage, Enterprises.</small>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               11. GLOBAL PRESENCE
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'global'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_global_title" class="form-control fs-14" value="<?= e($settings['about_global_title'] ?? 'Global Presence') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text (1–2 Lines)</label>
                <textarea name="about_global_text" class="form-control fs-14" rows="3"><?= e($settings['about_global_text'] ?? 'GoldMatrix is built with an international outlook to support jewellery businesses across different markets and business environments.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Highlighted Global Markets Line</label>
                <input type="text" name="about_global_markets" class="form-control fs-13" value="<?= e($settings['about_global_markets'] ?? 'UAE • India • Hong Kong • Singapore • United Kingdom • GCC') ?>">
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               12. OUR COMMITMENT
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'commitment'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_commitment_title" class="form-control fs-14" value="<?= e($settings['about_commitment_title'] ?? 'Our Commitment') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Text (1–2 Lines)</label>
                <textarea name="about_commitment_text" class="form-control fs-14" rows="3"><?= e($settings['about_commitment_text'] ?? 'We focus on reliable solutions, continuous improvement and long-term relationships with the businesses we serve.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Left Side Team &amp; Customer Partnership Image</label>
                <div class="input-group mb-2">
                  <input type="text" name="about_commitment_image" class="form-control fs-13" value="<?= e($settings['about_commitment_image'] ?? '') ?>" placeholder="Image URL">
                </div>
                <div class="d-flex align-items-center gap-3">
                  <input type="file" name="about_commitment_image_file" class="form-control form-control-sm fs-12 w-auto" accept="image/*">
                  <span class="text-muted fs-12">Upload from computer</span>
                </div>
                <?php if (!empty($settings['about_commitment_image'])): ?>
                  <div class="mt-2 p-2 border rounded bg-light" style="max-width: 250px;">
                    <img src="<?= e($settings['about_commitment_image']) ?>" alt="Commitment Preview" class="img-fluid rounded" style="max-height: 120px; object-fit: cover;">
                  </div>
                <?php endif; ?>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               13. FINAL CTA BANNER
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'cta'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">CTA Main Heading (H2)</label>
                <input type="text" name="about_cta_title" class="form-control fs-14" value="<?= e($settings['about_cta_title'] ?? 'Let\'s Grow Together') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Subtitle Text</label>
                <textarea name="about_cta_desc" class="form-control fs-14" rows="3"><?= e($settings['about_cta_desc'] ?? 'Discover how GoldMatrix can help simplify your jewellery business and bring greater control to your daily operations.') ?></textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold fs-13 text-dark">Button Text</label>
                <input type="text" name="about_cta_btn1_text" class="form-control fs-13" value="<?= e($settings['about_cta_btn1_text'] ?? 'Book a Free Demo') ?>">
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold fs-13 text-dark">WhatsApp Direct Number</label>
                <input type="text" name="about_cta_whatsapp" class="form-control fs-13" value="<?= e($settings['about_cta_whatsapp'] ?? '+91 92703 69937') ?>">
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">CTA Background Image URL</label>
                <div class="input-group mb-2">
                  <input type="text" name="about_cta_bg_image" class="form-control fs-13" value="<?= e($settings['about_cta_bg_image'] ?? '') ?>" placeholder="Image URL">
                </div>
                <div class="d-flex align-items-center gap-3">
                  <input type="file" name="about_cta_bg_image_file" class="form-control form-control-sm fs-12 w-auto" accept="image/*">
                  <span class="text-muted fs-12">Upload from computer</span>
                </div>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               14. SEO & SOCIAL META
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'seo'): ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">SEO Page Title Tag</label>
                <input type="text" name="about_seo_meta_title" class="form-control fs-14" value="<?= e($settings['about_seo_meta_title'] ?? 'About GoldMatrix | Jewellery ERP & Business Software') ?>">
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">SEO Meta Description</label>
                <textarea name="about_seo_meta_desc" class="form-control fs-14" rows="3"><?= e($settings['about_seo_meta_desc'] ?? 'GoldMatrix is a jewellery business software company helping jewellery businesses simplify operations, improve control and grow with confidence.') ?></textarea>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">SEO Target Keywords</label>
                <input type="text" name="about_seo_keywords" class="form-control fs-13" value="<?= e($settings['about_seo_keywords'] ?? 'about goldmatrix, jewellery erp software, jewellery pos, jewellery inventory management, jewelry manufacturing software') ?>">
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Social Share Image (OpenGraph URL)</label>
                <div class="input-group mb-2">
                  <input type="text" name="about_seo_og_image" class="form-control fs-13" value="<?= e($settings['about_seo_og_image'] ?? '') ?>">
                </div>
                <div class="d-flex align-items-center gap-3">
                  <input type="file" name="about_seo_og_image_file" class="form-control form-control-sm fs-12 w-auto" accept="image/*">
                  <span class="text-muted fs-12">Upload OpenGraph image</span>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between">
            <button type="submit" class="btn btn-navy px-4 py-2 fw-bold fs-14">
              <i class="bi bi-check-circle-fill me-1 text-warning"></i> Save Section Changes
            </button>
            <span class="text-muted fs-12"><i class="bi bi-clock-history me-1"></i>Synchronized instantly with database</span>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
