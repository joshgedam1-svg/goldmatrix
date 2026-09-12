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
      Manage all 13 sections of the live About Us page (<a href="<?= site_url('about') ?>" target="_blank" class="text-primary text-decoration-none fw-semibold"><i class="bi bi-box-arrow-up-right me-1"></i>/about</a>) with user-friendly cards, descriptions, and images.
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
        <form action="<?= admin_url('about-settings') ?>" method="POST" enctype="multipart/form-data" id="aboutSectionForm">
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
                <label class="form-label fw-bold fs-13 text-dark">Hero Supporting Description</label>
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
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
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
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
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
               4. OUR JOURNEY (EASY CARD REPEATER)
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'journey'): ?>
            <?php
            $journeyItems = json_decode($settings['about_journey_items'] ?? '', true);
            if (!is_array($journeyItems)) {
                $journeyItems = [
                    ['phase' => 'PHASE 01', 'title' => 'Experience', 'desc' => 'Direct engagement with jewellery merchants, retailers and bullion counters.'],
                    ['phase' => 'PHASE 02', 'title' => 'Industry Understanding', 'desc' => 'Deep mastering of Karigar jobwork, metal purities, stone calculations and retail workflows.'],
                    ['phase' => 'PHASE 03', 'title' => 'Software Evolution', 'desc' => 'Purpose-built cloud software bringing inventory, sales, RFID and accounting together.'],
                    ['phase' => 'PHASE 04', 'title' => 'Global Growth', 'desc' => 'Expanding across international jewellery capitals with continuous product refinement.']
                ];
            }
            ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_journey_title" class="form-control fs-14" value="<?= e($settings['about_journey_title'] ?? 'Our Journey') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
                <textarea name="about_journey_text" class="form-control fs-14" rows="3"><?= e($settings['about_journey_text'] ?? 'Our journey is shaped by continuous experience, customer relationships and a deep understanding of jewellery business operations.') ?></textarea>
              </div>

              <div class="col-12 pt-2">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                  <div>
                    <h6 class="fw-bold fs-14 text-dark mb-0"><i class="bi bi-signpost-2 text-warning me-2"></i>Timeline Roadmap Milestones</h6>
                    <small class="text-muted fs-12">Edit, reorder, delete or add new milestones easily without code.</small>
                  </div>
                  <button type="button" class="btn btn-outline-primary btn-sm px-3 py-1 fw-bold fs-12" onclick="addJourneyItem()">
                    <i class="bi bi-plus-circle-fill me-1"></i> Add New Milestone
                  </button>
                </div>

                <div id="journey-items-container" class="d-flex flex-column gap-3">
                  <?php foreach ($journeyItems as $idx => $item): ?>
                    <div class="card border rounded-3 shadow-sm bg-light journey-item-card" data-index="<?= $idx ?>">
                      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
                        <span class="fw-bold fs-13 text-dark"><i class="bi bi-flag-fill text-warning me-1"></i> Milestone #<span class="item-number"><?= $idx + 1 ?></span></span>
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
                          <i class="bi bi-trash me-1"></i> Delete
                        </button>
                      </div>
                      <div class="card-body p-3">
                        <div class="row g-2">
                          <div class="col-md-4">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Phase Tag / Badge</label>
                            <input type="text" name="about_journey_items[<?= $idx ?>][phase]" class="form-control form-control-sm fs-13" value="<?= e($item['phase'] ?? '') ?>" placeholder="e.g. PHASE 01">
                          </div>
                          <div class="col-md-8">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Milestone Title</label>
                            <input type="text" name="about_journey_items[<?= $idx ?>][title]" class="form-control form-control-sm fs-13 fw-semibold" value="<?= e($item['title'] ?? '') ?>" placeholder="e.g. Experience">
                          </div>
                          <div class="col-12">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Milestone Description</label>
                            <textarea name="about_journey_items[<?= $idx ?>][desc]" class="form-control form-control-sm fs-13" rows="2" placeholder="Describe this milestone..."><?= e($item['desc'] ?? '') ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
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
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
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
               6. OUR SOLUTIONS (EASY CARD REPEATER)
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'solutions'): ?>
            <?php
            $solutionsItems = json_decode($settings['about_solutions_items'] ?? '', true);
            if (!is_array($solutionsItems)) {
                $solutionsItems = [
                    ['icon' => 'bi-shop', 'title' => 'Jewellery Retail', 'desc' => 'Sales, quick billing, customer profiles and daily store management.'],
                    ['icon' => 'bi-boxes', 'title' => 'Wholesale Management', 'desc' => 'B2B orders, approval memos, dealer accounts and bulk trade control.'],
                    ['icon' => 'bi-gear-wide-connected', 'title' => 'Manufacturing & Jobwork', 'desc' => 'Department allocations, Karigar jobbags, loss tracking and worklogs.'],
                    ['icon' => 'bi-layers', 'title' => 'Inventory Management', 'desc' => 'Precious metal purity, diamond weights, barcode and RFID audits.'],
                    ['icon' => 'bi-calculator', 'title' => 'Accounting & Finance', 'desc' => 'Automated ledgers, tax compliance, metal balance and financial statements.'],
                    ['icon' => 'bi-people', 'title' => 'CRM & Customer Management', 'desc' => 'Customer history, gold saving schemes and relationship workflows.']
                ];
            }
            ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_solutions_title" class="form-control fs-14" value="<?= e($settings['about_solutions_title'] ?? 'Our Solutions') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
                <textarea name="about_solutions_text" class="form-control fs-14" rows="2"><?= e($settings['about_solutions_text'] ?? 'Explore our dedicated solution modules built exclusively for jewellery commerce.') ?></textarea>
              </div>

              <div class="col-12 pt-2">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                  <div>
                    <h6 class="fw-bold fs-14 text-dark mb-0"><i class="bi bi-grid-3x3-gap text-warning me-2"></i>Solution Cards</h6>
                    <small class="text-muted fs-12">Manage individual module cards displayed in the solution grid.</small>
                  </div>
                  <button type="button" class="btn btn-outline-primary btn-sm px-3 py-1 fw-bold fs-12" onclick="addSolutionItem()">
                    <i class="bi bi-plus-circle-fill me-1"></i> Add Solution Card
                  </button>
                </div>

                <div id="solutions-items-container" class="d-flex flex-column gap-3">
                  <?php foreach ($solutionsItems as $idx => $item): ?>
                    <div class="card border rounded-3 shadow-sm bg-light solution-item-card" data-index="<?= $idx ?>">
                      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
                        <span class="fw-bold fs-13 text-dark"><i class="bi <?= e($item['icon'] ?? 'bi-box') ?> text-warning me-1"></i> Solution #<span class="item-number"><?= $idx + 1 ?></span> — <span class="card-title-preview"><?= e($item['title'] ?? 'Card') ?></span></span>
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
                          <i class="bi bi-trash me-1"></i> Delete
                        </button>
                      </div>
                      <div class="card-body p-3">
                        <div class="row g-2">
                          <div class="col-md-4">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Bootstrap Icon Class</label>
                            <input type="text" name="about_solutions_items[<?= $idx ?>][icon]" class="form-control form-control-sm fs-13 font-monospace" value="<?= e($item['icon'] ?? 'bi-shop') ?>" placeholder="e.g. bi-shop, bi-boxes">
                          </div>
                          <div class="col-md-8">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Card Title</label>
                            <input type="text" name="about_solutions_items[<?= $idx ?>][title]" class="form-control form-control-sm fs-13 fw-semibold" value="<?= e($item['title'] ?? '') ?>" placeholder="e.g. Jewellery Retail">
                          </div>
                          <div class="col-12">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Card Description</label>
                            <textarea name="about_solutions_items[<?= $idx ?>][desc]" class="form-control form-control-sm fs-13" rows="2" placeholder="Brief description of this solution..."><?= e($item['desc'] ?? '') ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               7. HOW WE WORK (EASY STEP REPEATER)
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'howwework'): ?>
            <?php
            $howWeWorkSteps = json_decode($settings['about_howwework_steps'] ?? '', true);
            if (!is_array($howWeWorkSteps)) {
                $howWeWorkSteps = [
                    ['num' => '1', 'title' => 'Understand', 'desc' => 'We understand your business processes and operational requirements.'],
                    ['num' => '2', 'title' => 'Implement', 'desc' => 'We configure solutions around your jewellery business workflows.'],
                    ['num' => '3', 'title' => 'Support', 'desc' => 'We continue to support your business as your operations grow.']
                ];
            }
            ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_howwework_title" class="form-control fs-14" value="<?= e($settings['about_howwework_title'] ?? 'How We Work') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
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

              <div class="col-12 pt-2">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                  <div>
                    <h6 class="fw-bold fs-14 text-dark mb-0"><i class="bi bi-diagram-3 text-warning me-2"></i>Workflow Process Steps</h6>
                    <small class="text-muted fs-12">Define the step-by-step engagement workflow.</small>
                  </div>
                  <button type="button" class="btn btn-outline-primary btn-sm px-3 py-1 fw-bold fs-12" onclick="addHowWeWorkItem()">
                    <i class="bi bi-plus-circle-fill me-1"></i> Add New Step
                  </button>
                </div>

                <div id="howwework-items-container" class="d-flex flex-column gap-3">
                  <?php foreach ($howWeWorkSteps as $idx => $item): ?>
                    <div class="card border rounded-3 shadow-sm bg-light howwework-item-card" data-index="<?= $idx ?>">
                      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
                        <span class="fw-bold fs-13 text-dark"><i class="bi bi-check2-circle text-warning me-1"></i> Step #<span class="item-number"><?= $idx + 1 ?></span> — <span class="card-title-preview"><?= e($item['title'] ?? 'Step') ?></span></span>
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
                          <i class="bi bi-trash me-1"></i> Delete
                        </button>
                      </div>
                      <div class="card-body p-3">
                        <div class="row g-2">
                          <div class="col-md-3">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Step Number / Badge</label>
                            <input type="text" name="about_howwework_steps[<?= $idx ?>][num]" class="form-control form-control-sm fs-13" value="<?= e($item['num'] ?? ($idx + 1)) ?>" placeholder="e.g. 1">
                          </div>
                          <div class="col-md-9">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Step Title</label>
                            <input type="text" name="about_howwework_steps[<?= $idx ?>][title]" class="form-control form-control-sm fs-13 fw-semibold" value="<?= e($item['title'] ?? '') ?>" placeholder="e.g. Understand">
                          </div>
                          <div class="col-12">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Step Description</label>
                            <textarea name="about_howwework_steps[<?= $idx ?>][desc]" class="form-control form-control-sm fs-13" rows="2" placeholder="Describe what happens in this step..."><?= e($item['desc'] ?? '') ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               8. BUILT FOR JEWELLERY (EASY CARD REPEATER)
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'builtfor'): ?>
            <?php
            $builtForItems = json_decode($settings['about_builtfor_items'] ?? '', true);
            if (!is_array($builtForItems)) {
                $builtForItems = [
                    ['title' => 'Retail Showroom', 'desc' => 'POS, barcode and counter sales', 'img' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=600&auto=format&fit=crop&q=80'],
                    ['title' => 'Wholesale Operation', 'desc' => 'B2B orders and stock transfer', 'img' => 'https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?w=600&auto=format&fit=crop&q=80'],
                    ['title' => 'Jewellery Manufacturing', 'desc' => 'Jobwork and production queues', 'img' => 'https://images.unsplash.com/photo-1535632787350-4e68ef0ac584?w=600&auto=format&fit=crop&q=80'],
                    ['title' => 'Business Management', 'desc' => 'CRM, schemes and analytics', 'img' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=600&auto=format&fit=crop&q=80']
                ];
            }
            ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_builtfor_title" class="form-control fs-14" value="<?= e($settings['about_builtfor_title'] ?? 'Built for Jewellery Businesses') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
                <textarea name="about_builtfor_text" class="form-control fs-14" rows="3"><?= e($settings['about_builtfor_text'] ?? 'Our solutions are designed around the unique requirements of jewellery retail, wholesale, manufacturing and business operations.') ?></textarea>
              </div>

              <div class="col-12 pt-2">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                  <div>
                    <h6 class="fw-bold fs-14 text-dark mb-0"><i class="bi bi-gem text-warning me-2"></i>Business Grid Visual Cards</h6>
                    <small class="text-muted fs-12">Edit titles, subtitles, and photo URLs for each business operational card.</small>
                  </div>
                  <button type="button" class="btn btn-outline-primary btn-sm px-3 py-1 fw-bold fs-12" onclick="addBuiltForItem()">
                    <i class="bi bi-plus-circle-fill me-1"></i> Add Business Card
                  </button>
                </div>

                <div id="builtfor-items-container" class="d-flex flex-column gap-3">
                  <?php foreach ($builtForItems as $idx => $item): ?>
                    <div class="card border rounded-3 shadow-sm bg-light builtfor-item-card" data-index="<?= $idx ?>">
                      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
                        <span class="fw-bold fs-13 text-dark"><i class="bi bi-image text-warning me-1"></i> Business Card #<span class="item-number"><?= $idx + 1 ?></span> — <span class="card-title-preview"><?= e($item['title'] ?? 'Card') ?></span></span>
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
                          <i class="bi bi-trash me-1"></i> Delete
                        </button>
                      </div>
                      <div class="card-body p-3">
                        <div class="row g-2">
                          <div class="col-md-5">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Card Title</label>
                            <input type="text" name="about_builtfor_items[<?= $idx ?>][title]" class="form-control form-control-sm fs-13 fw-semibold" value="<?= e($item['title'] ?? '') ?>" placeholder="e.g. Retail Showroom">
                          </div>
                          <div class="col-md-7">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Subtitle / Short Description</label>
                            <input type="text" name="about_builtfor_items[<?= $idx ?>][desc]" class="form-control form-control-sm fs-13" value="<?= e($item['desc'] ?? '') ?>" placeholder="e.g. POS, barcode and counter sales">
                          </div>
                          <div class="col-12">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Card Background Image URL</label>
                            <input type="text" name="about_builtfor_items[<?= $idx ?>][img]" class="form-control form-control-sm fs-13" value="<?= e($item['img'] ?? '') ?>" placeholder="Image URL (e.g. https://... or /uploads/...)">
                            <?php if (!empty($item['img'])): ?>
                              <div class="mt-2 p-1 border rounded bg-white" style="max-width: 140px;">
                                <img src="<?= e($item['img']) ?>" alt="Preview" class="img-fluid rounded" style="max-height: 70px; object-fit: cover;">
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               9. WHY GOLDMATRIX (EASY CARD REPEATER)
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'why'): ?>
            <?php
            $whyItems = json_decode($settings['about_why_items'] ?? '', true);
            if (!is_array($whyItems)) {
                $whyItems = [
                    ['icon' => 'bi-gem', 'title' => 'Jewellery Expertise', 'desc' => 'Purpose-built around jewellery business operations.'],
                    ['icon' => 'bi-link-45deg', 'title' => 'Connected Operations', 'desc' => 'Manage essential business processes in one ecosystem.'],
                    ['icon' => 'bi-check2-circle', 'title' => 'Practical Solutions', 'desc' => 'Designed for real-world jewellery workflows.'],
                    ['icon' => 'bi-graph-up-arrow', 'title' => 'Scalable Business', 'desc' => 'Suitable for growing businesses and multi-location operations.'],
                    ['icon' => 'bi-headset', 'title' => 'Customer Support', 'desc' => 'Focused on long-term customer relationships.'],
                    ['icon' => 'bi-globe2', 'title' => 'Global Approach', 'desc' => 'Built to support modern jewellery businesses across markets.']
                ];
            }
            ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_why_title" class="form-control fs-14" value="<?= e($settings['about_why_title'] ?? 'Why GoldMatrix') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
                <textarea name="about_why_text" class="form-control fs-14" rows="2"><?= e($settings['about_why_text'] ?? 'Engineered specifically for the demands and operational integrity of the jewellery industry.') ?></textarea>
              </div>

              <div class="col-12 pt-2">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                  <div>
                    <h6 class="fw-bold fs-14 text-dark mb-0"><i class="bi bi-patch-check text-warning me-2"></i>Why GoldMatrix Benefit Cards</h6>
                    <small class="text-muted fs-12">Edit value propositions and strengths.</small>
                  </div>
                  <button type="button" class="btn btn-outline-primary btn-sm px-3 py-1 fw-bold fs-12" onclick="addWhyItem()">
                    <i class="bi bi-plus-circle-fill me-1"></i> Add Benefit Card
                  </button>
                </div>

                <div id="why-items-container" class="d-flex flex-column gap-3">
                  <?php foreach ($whyItems as $idx => $item): ?>
                    <div class="card border rounded-3 shadow-sm bg-light why-item-card" data-index="<?= $idx ?>">
                      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
                        <span class="fw-bold fs-13 text-dark"><i class="bi <?= e($item['icon'] ?? 'bi-star') ?> text-warning me-1"></i> Benefit #<span class="item-number"><?= $idx + 1 ?></span> — <span class="card-title-preview"><?= e($item['title'] ?? 'Benefit') ?></span></span>
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
                          <i class="bi bi-trash me-1"></i> Delete
                        </button>
                      </div>
                      <div class="card-body p-3">
                        <div class="row g-2">
                          <div class="col-md-4">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Bootstrap Icon Class</label>
                            <input type="text" name="about_why_items[<?= $idx ?>][icon]" class="form-control form-control-sm fs-13 font-monospace" value="<?= e($item['icon'] ?? 'bi-gem') ?>" placeholder="e.g. bi-gem, bi-shield-check">
                          </div>
                          <div class="col-md-8">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Benefit Title</label>
                            <input type="text" name="about_why_items[<?= $idx ?>][title]" class="form-control form-control-sm fs-13 fw-semibold" value="<?= e($item['title'] ?? '') ?>" placeholder="e.g. Jewellery Expertise">
                          </div>
                          <div class="col-12">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Benefit Description</label>
                            <textarea name="about_why_items[<?= $idx ?>][desc]" class="form-control form-control-sm fs-13" rows="2" placeholder="Describe this advantage..."><?= e($item['desc'] ?? '') ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

          <!-- ══════════════════════════════════════════
               10. WHO WE SERVE (EASY CARD REPEATER)
          ══════════════════════════════════════════ -->
          <?php elseif ($sec === 'whoweserve'): ?>
            <?php
            $whoWeServeItems = json_decode($settings['about_whoweserve_items'] ?? '', true);
            if (!is_array($whoWeServeItems)) {
                $whoWeServeItems = [
                    ['icon' => 'bi-shop', 'title' => 'Retailers', 'desc' => 'Single & multi-store showrooms'],
                    ['icon' => 'bi-boxes', 'title' => 'Wholesalers', 'desc' => 'Bullion & trade distributors'],
                    ['icon' => 'bi-hammer', 'title' => 'Manufacturers', 'desc' => 'Production units & Karigars'],
                    ['icon' => 'bi-safe', 'title' => 'Girvi / Mortgage', 'desc' => 'Gold loan & pawn operators'],
                    ['icon' => 'bi-building', 'title' => 'Enterprises', 'desc' => 'Large multi-branch jewellery chains']
                ];
            }
            ?>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Section Heading (H2)</label>
                <input type="text" name="about_whoweserve_title" class="form-control fs-14" value="<?= e($settings['about_whoweserve_title'] ?? 'Who We Serve') ?>" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
                <textarea name="about_whoweserve_text" class="form-control fs-14" rows="3"><?= e($settings['about_whoweserve_text'] ?? 'From individual jewellery businesses to growing enterprises, GoldMatrix supports different stages of the jewellery business.') ?></textarea>
              </div>

              <div class="col-12 pt-2">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                  <div>
                    <h6 class="fw-bold fs-14 text-dark mb-0"><i class="bi bi-shop text-warning me-2"></i>Who We Serve Category Cards</h6>
                    <small class="text-muted fs-12">Manage business categories and target segments.</small>
                  </div>
                  <button type="button" class="btn btn-outline-primary btn-sm px-3 py-1 fw-bold fs-12" onclick="addWhoWeServeItem()">
                    <i class="bi bi-plus-circle-fill me-1"></i> Add Segment Card
                  </button>
                </div>

                <div id="whoweserve-items-container" class="d-flex flex-column gap-3">
                  <?php foreach ($whoWeServeItems as $idx => $item): ?>
                    <div class="card border rounded-3 shadow-sm bg-light whoweserve-item-card" data-index="<?= $idx ?>">
                      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
                        <span class="fw-bold fs-13 text-dark"><i class="bi <?= e($item['icon'] ?? 'bi-people') ?> text-warning me-1"></i> Segment #<span class="item-number"><?= $idx + 1 ?></span> — <span class="card-title-preview"><?= e($item['title'] ?? 'Segment') ?></span></span>
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
                          <i class="bi bi-trash me-1"></i> Delete
                        </button>
                      </div>
                      <div class="card-body p-3">
                        <div class="row g-2">
                          <div class="col-md-4">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Bootstrap Icon Class</label>
                            <input type="text" name="about_whoweserve_items[<?= $idx ?>][icon]" class="form-control form-control-sm fs-13 font-monospace" value="<?= e($item['icon'] ?? 'bi-shop') ?>" placeholder="e.g. bi-shop, bi-safe">
                          </div>
                          <div class="col-md-8">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Segment Title</label>
                            <input type="text" name="about_whoweserve_items[<?= $idx ?>][title]" class="form-control form-control-sm fs-13 fw-semibold" value="<?= e($item['title'] ?? '') ?>" placeholder="e.g. Retailers">
                          </div>
                          <div class="col-12">
                            <label class="form-label fw-semibold fs-12 text-muted mb-1">Subtitle / Short Description</label>
                            <input type="text" name="about_whoweserve_items[<?= $idx ?>][desc]" class="form-control form-control-sm fs-13" value="<?= e($item['desc'] ?? '') ?>" placeholder="e.g. Single & multi-store showrooms">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
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
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
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
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description</label>
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
                <label class="form-label fw-bold fs-13 text-dark">Supporting Description / Subtitle</label>
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

<script>
// Generic helper to remove repeater card and update item numbers
function removeRepeaterCard(btn) {
  const card = btn.closest('.card');
  const container = card.parentElement;
  if (container.querySelectorAll('.card').length <= 1) {
    if (!confirm('This is the only item. Remove it anyway?')) return;
  }
  card.remove();
  updateItemNumbers(container);
}

function updateItemNumbers(container) {
  if (!container) return;
  const cards = container.querySelectorAll('.card');
  cards.forEach((card, index) => {
    const numEl = card.querySelector('.item-number');
    if (numEl) numEl.textContent = index + 1;
  });
}

// 4. Add Journey Item
function addJourneyItem() {
  const container = document.getElementById('journey-items-container');
  const index = container.querySelectorAll('.journey-item-card').length;
  const html = `
    <div class="card border rounded-3 shadow-sm bg-light journey-item-card" data-index="${index}">
      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
        <span class="fw-bold fs-13 text-dark"><i class="bi bi-flag-fill text-warning me-1"></i> Milestone #<span class="item-number">${index + 1}</span></span>
        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
          <i class="bi bi-trash me-1"></i> Delete
        </button>
      </div>
      <div class="card-body p-3">
        <div class="row g-2">
          <div class="col-md-4">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Phase Tag / Badge</label>
            <input type="text" name="about_journey_items[${index}][phase]" class="form-control form-control-sm fs-13" value="PHASE 0${index + 1}" placeholder="e.g. PHASE 0${index + 1}">
          </div>
          <div class="col-md-8">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Milestone Title</label>
            <input type="text" name="about_journey_items[${index}][title]" class="form-control form-control-sm fs-13 fw-semibold" value="" placeholder="e.g. New Milestone Title">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Milestone Description</label>
            <textarea name="about_journey_items[${index}][desc]" class="form-control form-control-sm fs-13" rows="2" placeholder="Describe this milestone..."></textarea>
          </div>
        </div>
      </div>
    </div>
  `;
  container.insertAdjacentHTML('beforeend', html);
}

// 6. Add Solution Item
function addSolutionItem() {
  const container = document.getElementById('solutions-items-container');
  const index = container.querySelectorAll('.solution-item-card').length;
  const html = `
    <div class="card border rounded-3 shadow-sm bg-light solution-item-card" data-index="${index}">
      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
        <span class="fw-bold fs-13 text-dark"><i class="bi bi-box text-warning me-1"></i> Solution #<span class="item-number">${index + 1}</span> — New Solution</span>
        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
          <i class="bi bi-trash me-1"></i> Delete
        </button>
      </div>
      <div class="card-body p-3">
        <div class="row g-2">
          <div class="col-md-4">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Bootstrap Icon Class</label>
            <input type="text" name="about_solutions_items[${index}][icon]" class="form-control form-control-sm fs-13 font-monospace" value="bi-box-seam" placeholder="e.g. bi-shop, bi-boxes">
          </div>
          <div class="col-md-8">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Card Title</label>
            <input type="text" name="about_solutions_items[${index}][title]" class="form-control form-control-sm fs-13 fw-semibold" value="" placeholder="e.g. Custom Jewellery Solution">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Card Description</label>
            <textarea name="about_solutions_items[${index}][desc]" class="form-control form-control-sm fs-13" rows="2" placeholder="Brief description of this solution..."></textarea>
          </div>
        </div>
      </div>
    </div>
  `;
  container.insertAdjacentHTML('beforeend', html);
}

// 7. Add How We Work Step
function addHowWeWorkItem() {
  const container = document.getElementById('howwework-items-container');
  const index = container.querySelectorAll('.howwework-item-card').length;
  const html = `
    <div class="card border rounded-3 shadow-sm bg-light howwework-item-card" data-index="${index}">
      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
        <span class="fw-bold fs-13 text-dark"><i class="bi bi-check2-circle text-warning me-1"></i> Step #<span class="item-number">${index + 1}</span></span>
        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
          <i class="bi bi-trash me-1"></i> Delete
        </button>
      </div>
      <div class="card-body p-3">
        <div class="row g-2">
          <div class="col-md-3">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Step Number / Badge</label>
            <input type="text" name="about_howwework_steps[${index}][num]" class="form-control form-control-sm fs-13" value="${index + 1}" placeholder="e.g. ${index + 1}">
          </div>
          <div class="col-md-9">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Step Title</label>
            <input type="text" name="about_howwework_steps[${index}][title]" class="form-control form-control-sm fs-13 fw-semibold" value="" placeholder="e.g. Execute & Deliver">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Step Description</label>
            <textarea name="about_howwework_steps[${index}][desc]" class="form-control form-control-sm fs-13" rows="2" placeholder="Describe what happens in this step..."></textarea>
          </div>
        </div>
      </div>
    </div>
  `;
  container.insertAdjacentHTML('beforeend', html);
}

// 8. Add Built For Item
function addBuiltForItem() {
  const container = document.getElementById('builtfor-items-container');
  const index = container.querySelectorAll('.builtfor-item-card').length;
  const html = `
    <div class="card border rounded-3 shadow-sm bg-light builtfor-item-card" data-index="${index}">
      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
        <span class="fw-bold fs-13 text-dark"><i class="bi bi-image text-warning me-1"></i> Business Card #<span class="item-number">${index + 1}</span></span>
        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
          <i class="bi bi-trash me-1"></i> Delete
        </button>
      </div>
      <div class="card-body p-3">
        <div class="row g-2">
          <div class="col-md-5">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Card Title</label>
            <input type="text" name="about_builtfor_items[${index}][title]" class="form-control form-control-sm fs-13 fw-semibold" value="" placeholder="e.g. Retail Showroom">
          </div>
          <div class="col-md-7">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Subtitle / Short Description</label>
            <input type="text" name="about_builtfor_items[${index}][desc]" class="form-control form-control-sm fs-13" value="" placeholder="e.g. POS, barcode and counter sales">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Card Background Image URL</label>
            <input type="text" name="about_builtfor_items[${index}][img]" class="form-control form-control-sm fs-13" value="" placeholder="Image URL (e.g. https://... or /uploads/...)">
          </div>
        </div>
      </div>
    </div>
  `;
  container.insertAdjacentHTML('beforeend', html);
}

// 9. Add Why Item
function addWhyItem() {
  const container = document.getElementById('why-items-container');
  const index = container.querySelectorAll('.why-item-card').length;
  const html = `
    <div class="card border rounded-3 shadow-sm bg-light why-item-card" data-index="${index}">
      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
        <span class="fw-bold fs-13 text-dark"><i class="bi bi-star text-warning me-1"></i> Benefit #<span class="item-number">${index + 1}</span></span>
        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
          <i class="bi bi-trash me-1"></i> Delete
        </button>
      </div>
      <div class="card-body p-3">
        <div class="row g-2">
          <div class="col-md-4">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Bootstrap Icon Class</label>
            <input type="text" name="about_why_items[${index}][icon]" class="form-control form-control-sm fs-13 font-monospace" value="bi-patch-check" placeholder="e.g. bi-gem, bi-shield">
          </div>
          <div class="col-md-8">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Benefit Title</label>
            <input type="text" name="about_why_items[${index}][title]" class="form-control form-control-sm fs-13 fw-semibold" value="" placeholder="e.g. 24/7 Dedicated Support">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Benefit Description</label>
            <textarea name="about_why_items[${index}][desc]" class="form-control form-control-sm fs-13" rows="2" placeholder="Describe this advantage..."></textarea>
          </div>
        </div>
      </div>
    </div>
  `;
  container.insertAdjacentHTML('beforeend', html);
}

// 10. Add Who We Serve Item
function addWhoWeServeItem() {
  const container = document.getElementById('whoweserve-items-container');
  const index = container.querySelectorAll('.whoweserve-item-card').length;
  const html = `
    <div class="card border rounded-3 shadow-sm bg-light whoweserve-item-card" data-index="${index}">
      <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between border-bottom">
        <span class="fw-bold fs-13 text-dark"><i class="bi bi-people text-warning me-1"></i> Segment #<span class="item-number">${index + 1}</span></span>
        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 fs-12" onclick="removeRepeaterCard(this)">
          <i class="bi bi-trash me-1"></i> Delete
        </button>
      </div>
      <div class="card-body p-3">
        <div class="row g-2">
          <div class="col-md-4">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Bootstrap Icon Class</label>
            <input type="text" name="about_whoweserve_items[${index}][icon]" class="form-control form-control-sm fs-13 font-monospace" value="bi-shop" placeholder="e.g. bi-shop, bi-safe">
          </div>
          <div class="col-md-8">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Segment Title</label>
            <input type="text" name="about_whoweserve_items[${index}][title]" class="form-control form-control-sm fs-13 fw-semibold" value="" placeholder="e.g. Bullion Merchants">
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold fs-12 text-muted mb-1">Subtitle / Short Description</label>
            <input type="text" name="about_whoweserve_items[${index}][desc]" class="form-control form-control-sm fs-13" value="" placeholder="e.g. Real-time rate board & trading desks">
          </div>
        </div>
      </div>
    </div>
  `;
  container.insertAdjacentHTML('beforeend', html);
}
</script>
