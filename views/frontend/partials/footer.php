<?php
/**
 * Modular Frontend Footer Partial - Pixel Perfect Match to Screenshot
 * Location: views/frontend/partials/footer.php
 */
$siteLogo = setting('site_logo', '') ?: asset('images/logo.svg');
$companyName = setting('company_name', 'GoldMatrix');
?>
<style>
/* ════════════════════════════════
   PIXEL-PERFECT FOOTER STYLING
════════════════════════════════ */
.site-footer {
  background-color: #001540; /* Deep Brand Navy */
  color: #FFFFFF;
  padding: 65px 0 32px;
  position: relative;
  font-family: 'Inter', sans-serif;
}
.footer-container {
  max-width: 1320px;
  margin: 0 auto;
  padding: 0 24px;
}
.footer-main-grid {
  display: grid;
  grid-template-columns: 1.3fr 1.1fr 0.9fr 1.7fr;
  gap: 40px;
  align-items: start;
}
.footer-logo-card {
  background: #FFFFFF;
  border-radius: 10px;
  padding: 10px 20px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
  margin-bottom: 22px;
  max-width: 250px;
}
.footer-logo-img {
  max-height: 52px;
  width: auto;
  object-fit: contain;
  display: block;
}
.footer-tagline-text {
  color: #CBD5E1;
  font-size: 13.5px;
  line-height: 1.6;
  margin-bottom: 22px;
  max-width: 290px;
}
.footer-social-row {
  display: flex;
  align-items: center;
  gap: 16px;
}
.footer-social-icon {
  color: #FFFFFF;
  font-size: 16px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: color 0.2s ease, transform 0.2s ease;
  opacity: 0.9;
}
.footer-social-icon:hover {
  color: var(--gm-luxury-gold, #DC9423);
  transform: translateY(-2px);
  opacity: 1;
}

/* Headings */
.footer-heading {
  font-size: 16px;
  font-weight: 750;
  color: #FFFFFF;
  margin-bottom: 22px;
  letter-spacing: -0.2px;
}

/* Nav Links */
.footer-links-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.footer-nav-link {
  color: #CBD5E1;
  font-size: 14px;
  text-decoration: none;
  transition: color 0.2s ease, transform 0.2s ease;
  display: inline-block;
  line-height: 1.4;
}
.footer-nav-link:hover {
  color: #FFFFFF;
  transform: translateX(3px);
}

/* Contact Us Column */
.footer-contact-wrap {
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.footer-location-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  font-size: 13.5px;
  color: #CBD5E1;
  line-height: 1.45;
}
.footer-location-item i {
  font-size: 18px;
  color: #FFFFFF;
  margin-top: 1px;
  flex-shrink: 0;
}
.footer-location-item strong {
  color: #FFFFFF;
  font-size: 14px;
  display: block;
  margin-bottom: 2px;
}
.footer-contact-item {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 13.5px;
}
.footer-contact-item i {
  font-size: 16px;
  color: #FFFFFF;
  flex-shrink: 0;
}
.footer-contact-item a {
  color: #CBD5E1;
  text-decoration: none;
  transition: color 0.2s ease;
}
.footer-contact-item a:hover {
  color: #FFFFFF;
}

/* Divider & Bottom */
.footer-divider-line {
  border: 0;
  height: 1px;
  background: rgba(255, 255, 255, 0.15);
  margin: 48px 0 24px;
}
.footer-copyright-text {
  font-size: 13px;
  color: #CBD5E1;
  margin: 0;
}

/* Responsive Rules */
@media (max-width: 991.98px) {
  .footer-main-grid {
    grid-template-columns: 1fr 1fr;
    gap: 36px 28px;
  }
}
@media (max-width: 575.98px) {
  .site-footer { padding: 50px 0 28px; }
  .footer-main-grid {
    grid-template-columns: 1fr;
    gap: 32px;
  }
  .footer-tagline-text { max-width: 100%; }
}
</style>

<!-- ════════════════════════════════
     FOOTER SECTION
════════════════════════════════ -->
<footer class="site-footer">
  <div class="footer-container">
    <div class="footer-main-grid">
      
      <!-- COLUMN 1: Brand Logo, Tagline & Socials -->
      <div>
        <div class="footer-logo-card">
          <?php if (!empty($siteLogo)): ?>
            <img src="<?= e($siteLogo) ?>" alt="<?= e($companyName) ?>" class="footer-logo-img" loading="lazy" decoding="async">
          <?php else: ?>
            <div class="d-flex align-items-center gap-2">
              <div style="width:34px;height:34px;background:#001540;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#DC9423;font-weight:900;font-size:14px;">GM</div>
              <span style="font-weight:800;font-size:17px;color:#001540;"><?= e($companyName) ?></span>
            </div>
          <?php endif; ?>
        </div>

        <p class="footer-tagline-text">
          <?= e($footer_tagline ?? setting('footer_tagline', 'We build jewellery-specific software delivering accuracy, control, scalability, and business growth')) ?>
        </p>

        <div class="footer-social-row">
          <?php 
            $fb  = setting('social_facebook', '');
            $ig  = setting('social_instagram', '');
            $li  = setting('social_linkedin', '');
            $tw  = setting('social_twitter', '');
            $yt  = setting('social_youtube', '');
            $wa  = setting('social_whatsapp', '');
            $pin = setting('social_pinterest', '');
            $tg  = setting('social_telegram', '');
            $customSocialRaw = setting('custom_social_links', '[]');
            $customSocialList = json_decode($customSocialRaw, true) ?: [];
          ?>
          <?php if (!empty($fb) && $fb !== '#'): ?>
            <a href="<?= e($fb) ?>" class="footer-social-icon" target="_blank" rel="noopener" aria-label="Facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
          <?php endif; ?>
          <?php if (!empty($ig) && $ig !== '#'): ?>
            <a href="<?= e($ig) ?>" class="footer-social-icon" target="_blank" rel="noopener" aria-label="Instagram" title="Instagram"><i class="bi bi-instagram"></i></a>
          <?php endif; ?>
          <?php if (!empty($li) && $li !== '#'): ?>
            <a href="<?= e($li) ?>" class="footer-social-icon" target="_blank" rel="noopener" aria-label="LinkedIn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
          <?php endif; ?>
          <?php if (!empty($tw) && $tw !== '#'): ?>
            <a href="<?= e($tw) ?>" class="footer-social-icon" target="_blank" rel="noopener" aria-label="Twitter / X" title="Twitter / X"><i class="bi bi-twitter-x"></i></a>
          <?php endif; ?>
          <?php if (!empty($yt) && $yt !== '#'): ?>
            <a href="<?= e($yt) ?>" class="footer-social-icon" target="_blank" rel="noopener" aria-label="YouTube" title="YouTube"><i class="bi bi-youtube"></i></a>
          <?php endif; ?>
          <?php if (!empty($wa) && $wa !== '#'): ?>
            <a href="<?= e($wa) ?>" class="footer-social-icon" target="_blank" rel="noopener" aria-label="WhatsApp" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          <?php endif; ?>
          <?php if (!empty($pin) && $pin !== '#'): ?>
            <a href="<?= e($pin) ?>" class="footer-social-icon" target="_blank" rel="noopener" aria-label="Pinterest" title="Pinterest"><i class="bi bi-pinterest"></i></a>
          <?php endif; ?>
          <?php if (!empty($tg) && $tg !== '#'): ?>
            <a href="<?= e($tg) ?>" class="footer-social-icon" target="_blank" rel="noopener" aria-label="Telegram" title="Telegram"><i class="bi bi-telegram"></i></a>
          <?php endif; ?>

          <?php foreach ($customSocialList as $cs): 
            $cUrl = $cs['url'] ?? '';
            $cTitle = $cs['title'] ?? $cs['platform'] ?? 'Social Link';
            $cIcon = !empty($cs['icon']) ? $cs['icon'] : 'bi-link-45deg';
            if (empty($cUrl) || $cUrl === '#') continue;
          ?>
            <a href="<?= e($cUrl) ?>" class="footer-social-icon" target="_blank" rel="noopener" aria-label="<?= e($cTitle) ?>" title="<?= e($cTitle) ?>">
              <i class="bi <?= e($cIcon) ?>"></i>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- COLUMN 2: Our Solutions -->
      <div>
        <h4 class="footer-heading">Our Solutions</h4>
        <ul class="footer-links-list">
          <?php 
          $col1 = !empty($footer_col1_menu) ? $footer_col1_menu : [
            ['title' => 'Jewelry Retail Software',          'url' => '/services/jewelry-retail-pos-software',    'target' => '_self'],
            ['title' => 'Jewelry Manufacturing ERP',        'url' => '/services/jewelry-manufacturing-software', 'target' => '_self'],
            ['title' => 'Wholesale & Bullion Management',   'url' => '/services/wholesale-bullion-management',   'target' => '_self'],
            ['title' => 'RFID Jewelry Automation',          'url' => '/services/rfid-jewelry-automation',        'target' => '_self'],
            ['title' => 'Jewelry GST & Accounting',         'url' => '/services/jewelry-accounting-gst-software','target' => '_self'],
          ];
          foreach ($col1 as $item): ?>
            <li>
              <a href="<?= e($item['url']) ?>" class="footer-nav-link" target="<?= e($item['target'] ?: '_self') ?>">
                <?= e($item['title']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- COLUMN 3: Quick Links -->
      <div>
        <h4 class="footer-heading">Quick Links</h4>
        <ul class="footer-links-list">
          <?php 
          $col2 = !empty($footer_col2_menu) ? $footer_col2_menu : [
            ['title' => 'About Us',       'url' => '/about',    'target' => '_self'],
            ['title' => 'Features',       'url' => '/features', 'target' => '_self'],
            ['title' => 'All Solutions',  'url' => '/services', 'target' => '_self'],
            ['title' => 'Contact Us',     'url' => '/contact',  'target' => '_self'],
          ];
          foreach ($col2 as $item): ?>
            <li>
              <a href="<?= e($item['url']) ?>" class="footer-nav-link" target="<?= e($item['target'] ?: '_self') ?>">
                <?= e($item['title']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- COLUMN 4: Contact Us (Multi-Location & Contacts) -->
      <div>
        <h4 class="footer-heading">Contact Us</h4>
        <div class="footer-contact-wrap">
          
          <?php 
          // 1. Check for dynamic offices list
          $dynamicOffices = [];
          $rawOffices = !empty($footer_offices) ? $footer_offices : setting('footer_offices', '');
          if (!empty($rawOffices)) {
              $decodedOffices = is_array($rawOffices) ? $rawOffices : json_decode($rawOffices, true);
              if (is_array($decodedOffices) && !empty($decodedOffices)) {
                  foreach ($decodedOffices as $o) {
                      if (isset($o['is_active']) && (int)$o['is_active'] === 0) continue;
                      if (!empty($o['title']) || !empty($o['address']) || !empty($o['phone'])) {
                          $dynamicOffices[] = $o;
                      }
                  }
              }
          }

          // 2. Fallback if no dynamic offices array configured yet
          if (empty($dynamicOffices)) {
              $uaeTitle = $footer_uae_title ?? setting('footer_uae_title', 'Headquarter - UAE');
              $uaeAddr  = $footer_uae_address ?? setting('footer_uae_address', "Conqueror tower Ajman UAE");
              $uaePhone = $footer_uae_phone ?? setting('footer_uae_phone', '+971 52 704 2689');
              
              $indTitle = $footer_india_title ?? setting('footer_india_title', 'India Operations Office');
              $indAddr  = $footer_india_address ?? setting('footer_india_address', "India, 01/A, Hingna Rd,\nM.I.D.C, Maharashtra - 440022");
              $indPhone = $footer_india_phone ?? setting('footer_india_phone', '+971 50 274 3168');

              if (!empty($uaeAddr) || !empty($uaeTitle)) {
                  $dynamicOffices[] = ['title' => $uaeTitle, 'address' => $uaeAddr, 'phone' => $uaePhone];
              }
              if (!empty($indAddr) || !empty($indTitle)) {
                  $dynamicOffices[] = ['title' => $indTitle, 'address' => $indAddr, 'phone' => $indPhone];
              }
          }

          $email1 = $footer_email ?? setting('footer_email', 'info@goldmatrixsoftware.com');
          $email2 = $footer_email_2 ?? setting('footer_email_2', 'goldmatrixsoftware@gmail.com');
          ?>

          <!-- Dynamic Office Locations Loop -->
          <?php foreach ($dynamicOffices as $off): 
            $oTitle = $off['title'] ?? '';
            $oAddr  = $off['address'] ?? '';
            $oPhone = $off['phone'] ?? '';
            $oEmail = $off['email'] ?? '';
          ?>
            <?php if (!empty($oAddr) || !empty($oTitle)): ?>
              <div class="footer-location-item">
                <i class="bi bi-geo-alt-fill"></i>
                <div>
                  <?php if (!empty($oTitle)): ?>
                    <strong><?= e($oTitle) ?></strong>
                  <?php endif; ?>
                  <?php if (!empty($oAddr)): ?>
                    <?= nl2br(e($oAddr)) ?>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($oPhone)): ?>
              <div class="footer-contact-item">
                <i class="bi bi-telephone-fill"></i>
                <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $oPhone)) ?>"><?= e($oPhone) ?></a>
              </div>
            <?php endif; ?>

            <?php if (!empty($oEmail) && $oEmail !== $email1 && $oEmail !== $email2): ?>
              <div class="footer-contact-item">
                <i class="bi bi-envelope-fill"></i>
                <a href="mailto:<?= e($oEmail) ?>"><?= e($oEmail) ?></a>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>

          <!-- Official Inboxes -->
          <?php if (!empty($email1)): ?>
            <div class="footer-contact-item">
              <i class="bi bi-envelope-fill"></i>
              <a href="mailto:<?= e($email1) ?>"><?= e($email1) ?></a>
            </div>
          <?php endif; ?>

          <?php if (!empty($email2)): ?>
            <div class="footer-contact-item">
              <i class="bi bi-envelope-fill"></i>
              <a href="mailto:<?= e($email2) ?>"><?= e($email2) ?></a>
            </div>
          <?php endif; ?>

        </div>
      </div>

    </div>

    <!-- Divider Line -->
    <hr class="footer-divider-line">

    <!-- Bottom Copyright & Language Switcher -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
      <?php 
      $rawCopy = $footer_copyright ?? setting('footer_copyright', '© {year} GoldMatrix Software. All Rights Reserved.');
      $cleanCopy = str_replace(['{year}', '{YEAR}', '{date}'], date('Y'), $rawCopy);
      ?>
      <p class="footer-copyright-text">
        <?= e($cleanCopy) ?>
      </p>

      <?php 
      $isMultilang = (setting('enable_multilang', '1') == '1');
      $langPos = setting('language_switcher_pos', 'both');
      if ($isMultilang && ($langPos === 'footer' || $langPos === 'both')): 
        $actLang = get_active_language();
        $allLangList = get_enabled_languages();
        $currLangInfo = $allLangList[$actLang] ?? get_supported_languages()[$actLang] ?? ['flag' => '🇬🇧', 'flag_img' => 'https://flagcdn.com/w40/gb.png', 'name' => 'English'];
      ?>
        <div class="dropdown footer-lang-dropdown">
          <button class="btn btn-sm btn-outline-light dropdown-toggle px-2.5 py-1 fs-12 rounded-pill d-inline-flex align-items-center gap-2" 
                  type="button" id="footerLangDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-color:rgba(255,255,255,0.25); background:rgba(255,255,255,0.06);">
            <img src="<?= e($currLangInfo['flag_img']) ?>" width="18" height="12" style="object-fit:cover; border-radius:2px;" alt="<?= e($currLangInfo['name']) ?>">
            <span class="fs-12"><?= e($currLangInfo['name']) ?></span>
            <i class="bi bi-chevron-up fs-10 opacity-75"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 py-2" aria-labelledby="footerLangDropdown" style="background:#001540; border:1px solid rgba(255,255,255,0.15) !important; min-width:200px; max-height:350px; overflow-y:auto;">
            <li class="dropdown-header text-uppercase fs-10 fw-bold text-light opacity-75 px-3 py-1">Choose Language</li>
            <?php foreach ($allLangList as $fCode => $fLang): ?>
              <li>
                <a class="dropdown-item d-flex align-items-center justify-content-between px-3 py-1.5 text-white <?= $actLang === $fCode ? 'fw-bold' : '' ?>" 
                   href="javascript:void(0);" 
                   onclick="switchSiteLanguage('<?= e($fCode) ?>', '<?= e($fLang['name']) ?>')"
                   style="<?= $actLang === $fCode ? 'background:rgba(245,158,11,0.2); color:#FBBF24 !important;' : '' ?>">
                  <span class="d-flex align-items-center gap-2">
                    <img src="<?= e($fLang['flag_img']) ?>" width="18" height="12" style="object-fit:cover; border-radius:2px;" alt="<?= e($fLang['name']) ?>">
                    <span class="fs-12"><?= e($fLang['name']) ?></span>
                  </span>
                  <?php if ($actLang === $fCode): ?>
                    <i class="bi bi-check2 text-warning fw-bold"></i>
                  <?php endif; ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>

  </div>
</footer>

<script>
/* ── HERO SLIDER LOGIC ── */
(function() {
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.hero-dot');
  const prevBtn = document.getElementById('heroPrevBtn');
  const nextBtn = document.getElementById('heroNextBtn');
  const container = document.getElementById('heroSliderContainer');

  if (slides.length <= 1) return;

  let currentIndex = 0;
  let autoplayTimer = null;
  const AUTOPLAY_DELAY = 6000;

  function showSlide(index) {
    if (index < 0) index = slides.length - 1;
    if (index >= slides.length) index = 0;

    slides.forEach((s, idx) => {
      s.classList.toggle('active', idx === index);
    });

    const activeSlide = slides[index];
    const accent = activeSlide ? (activeSlide.getAttribute('data-accent') || '#F59E0B') : '#F59E0B';

    dots.forEach((d, idx) => {
      const isActive = idx === index;
      d.classList.toggle('active', isActive);
      if (isActive) {
        d.style.backgroundColor = accent;
        d.style.boxShadow = '0 0 12px ' + accent;
      } else {
        d.style.backgroundColor = '';
        d.style.boxShadow = '';
      }
    });

    currentIndex = index;
  }

  function nextSlide() {
    showSlide(currentIndex + 1);
  }

  function prevSlide() {
    showSlide(currentIndex - 1);
  }

  function startAutoplay() {
    stopAutoplay();
    autoplayTimer = setInterval(nextSlide, AUTOPLAY_DELAY);
  }

  function stopAutoplay() {
    if (autoplayTimer) clearInterval(autoplayTimer);
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      nextSlide();
      startAutoplay();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      prevSlide();
      startAutoplay();
    });
  }

  dots.forEach(d => {
    d.addEventListener('click', () => {
      const idx = parseInt(d.getAttribute('data-slide'), 10);
      showSlide(idx);
      startAutoplay();
    });
  });

  if (container) {
    container.addEventListener('mouseenter', stopAutoplay);
    container.addEventListener('mouseleave', startAutoplay);
  }

  // Keyboard navigation
  window.addEventListener('keydown', (e) => {
    if (document.activeElement && ['input', 'textarea', 'select'].includes(document.activeElement.tagName.toLowerCase())) return;
    if (e.key === 'ArrowRight') { nextSlide(); startAutoplay(); }
    if (e.key === 'ArrowLeft') { prevSlide(); startAutoplay(); }
  });

  // Touch Swipe for Mobile Devices
  let touchStartX = 0;
  let touchEndX = 0;

  if (container) {
    container.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
      stopAutoplay();
    }, { passive: true });

    container.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
      startAutoplay();
    }, { passive: true });
  }

  function handleSwipe() {
    const diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 45) {
      if (diff > 0) nextSlide();
      else prevSlide();
    }
  }

  startAutoplay();
})();

/* ── NAVBAR scroll effect ── */
window.addEventListener('scroll', () => {
  const nb = document.getElementById('navbar');
  if (nb) nb.style.borderBottomColor = window.scrollY > 10 ? 'rgba(255,255,255,0.1)' : 'rgba(255,255,255,0.06)';
});

/* ── Smooth scroll ── */
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const targetId = a.getAttribute('href');
    if (targetId && targetId !== '#') {
      const t = document.querySelector(targetId);
      if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth' }); }
    }
  });
});

/* ── Scroll Reveal ── */
const observer = new IntersectionObserver(entries => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      setTimeout(() => entry.target.classList.add('visible'), i * 60);
    }
  });
}, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });

/* ── Auto-close Offcanvas on Link Click ── */
document.querySelectorAll('#mobileNavOffcanvas a[href^="#"]').forEach(link => {
  link.addEventListener('click', () => {
    const offcanvasEl = document.getElementById('mobileNavOffcanvas');
    if (offcanvasEl && typeof bootstrap !== 'undefined') {
      const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl) || new bootstrap.Offcanvas(offcanvasEl);
      if (bsOffcanvas) bsOffcanvas.hide();
    }
  });
});

/* ── Sliding Countries Marquee Loop ── */
const countriesTrack = document.getElementById("countriesSlideTrack");
if (countriesTrack) {
  countriesTrack.innerHTML += countriesTrack.innerHTML;
}
</script>

<!-- Global Book Demo Modal Partial -->
<?php require __DIR__ . '/demo-modal.php'; ?>

<!-- Google Tag Manager (GTM) NoScript Fallback -->
<?php 
$gtmIdFooter = setting('google_tag_manager_id', '');
if (!empty($gtmIdFooter)): 
?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($gtmIdFooter) ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

<!-- Custom Footer Injected Scripts -->
<?php 
$customFooter = setting('custom_footer_scripts', '');
if (!empty($customFooter)): 
  echo $customFooter;
endif; 
?>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

