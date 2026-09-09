<?php
/**
 * Modular Frontend Header Partial
 * Location: views/frontend/partials/header.php
 */
$activeLang = get_active_language();
$allSupportedLangs = get_supported_languages();
$enabledLangs = get_enabled_languages();
$activeLangInfo = $allSupportedLangs[$activeLang] ?? $allSupportedLangs['en'];
$htmlDir = ($activeLangInfo['dir'] ?? 'ltr') === 'rtl' ? 'rtl' : 'ltr';
$isMultilangEnabled = (setting('enable_multilang', '1') == '1');
$langSwitcherPos = setting('language_switcher_pos', 'both');
$showHreflang = (setting('enable_hreflang_seo', '1') == '1');
?><!DOCTYPE html>
<html lang="<?= e($activeLang) ?>" dir="<?= e($htmlDir) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
$siteTitleSuffix = setting('site_name_suffix', 'GoldMatrix ERP');
$titleSep = setting('site_title_separator', '|');
$finalMetaTitle = !empty($meta_title) ? $meta_title : setting('default_seo_title', 'GoldMatrix — The Complete Jewellery ERP Software in India');
$finalMetaDesc  = !empty($meta_desc) ? $meta_desc : setting('default_meta_description', 'Complete Jewellery ERP Software with Inventory, POS, GST, Manufacturing, and Multi-Branch Management.');
$finalMetaKeys  = !empty($meta_keywords) ? $meta_keywords : setting('default_keywords', 'jewellery erp, jewelry software india, jewellery pos billing');
$finalRobots    = !empty($meta_robots) ? $meta_robots : setting('default_robots', 'index, follow');

$ogImg = !empty($og_image) ? $og_image : setting('default_og_image', '/assets/images/why-goldmatrix-mockup.png');
$ogImgUrl = strpos($ogImg, 'http') === 0 ? $ogImg : site_url($ogImg);

$canonicalDomain = setting('canonical_domain', '');
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$finalCanonical = !empty($canonical_url) ? $canonical_url : (!empty($canonicalDomain) ? rtrim($canonicalDomain, '/') . $currentPath : site_url($currentPath));

// ── Google Search Console (GSC) Tag Extraction ──
$rawGsc = trim((string)setting('google_site_verification', ''));
$gscCode = '';
if (!empty($rawGsc)) {
    if (preg_match('/content=[\'"]([^\'"]+)[\'"]/i', $rawGsc, $m)) {
        $gscCode = $m[1];
    } elseif (strpos($rawGsc, 'google-site-verification=') === 0) {
        $gscCode = substr($rawGsc, strlen('google-site-verification='));
    } else {
        $gscCode = strip_tags($rawGsc);
    }
}

// ── Bing Webmaster Tag Extraction ──
$rawBing = trim((string)setting('bing_site_verification', ''));
$bingCode = '';
if (!empty($rawBing)) {
    if (preg_match('/content=[\'"]([^\'"]+)[\'"]/i', $rawBing, $m)) {
        $bingCode = $m[1];
    } else {
        $bingCode = strip_tags($rawBing);
    }
}

$yandexCode = trim(strip_tags((string)setting('yandex_site_verification', '')));
$ga4Id      = trim(strip_tags((string)setting('google_analytics_id', '')));
$gtmId      = trim(strip_tags((string)setting('google_tag_manager_id', '')));
$fbPixel    = trim(strip_tags((string)setting('facebook_pixel_id', '')));
$customHead = setting('custom_header_scripts', '');

// ── Local / Geo SEO Tags ──
$geoRegion = trim((string)setting('geo_region', 'IN-MH'));
$geoPlace  = trim((string)setting('geo_placename', 'Mumbai, Maharashtra, India'));
$geoPos    = trim((string)setting('geo_position', '19.0760;72.8777'));
$icbmPos   = str_replace(';', ', ', $geoPos);

$author    = setting('meta_author', 'GoldMatrix Software Technologies Pvt Ltd');
$publisher = setting('meta_publisher', 'GoldMatrix Software Technologies');
$twitterHandle = setting('twitter_handle', '@goldmatrixerp');
$twitterCard   = setting('twitter_card_type', 'summary_large_image');
?>
<title><?= e($finalMetaTitle) ?></title>
<meta name="description" content="<?= e($finalMetaDesc) ?>">
<meta name="keywords" content="<?= e($finalMetaKeys) ?>">
<meta name="robots" content="<?= e($finalRobots) ?>">
<meta name="author" content="<?= e($author) ?>">
<meta name="publisher" content="<?= e($publisher) ?>">

<!-- ══════════════════════════════════════════
     GEO / LOCAL SEO TAGS (Search & Map Bots)
     ══════════════════════════════════════════ -->
<?php if (!empty($geoRegion)): ?><meta name="geo.region" content="<?= e($geoRegion) ?>"><?php endif; ?>
<?php if (!empty($geoPlace)): ?><meta name="geo.placename" content="<?= e($geoPlace) ?>"><?php endif; ?>
<?php if (!empty($geoPos)): ?><meta name="geo.position" content="<?= e($geoPos) ?>"><?php endif; ?>
<?php if (!empty($icbmPos)): ?><meta name="ICBM" content="<?= e($icbmPos) ?>"><?php endif; ?>

<!-- ══════════════════════════════════════════
     GOOGLE SEARCH CONSOLE (GSC) & WEBMASTERS
     ══════════════════════════════════════════ -->
<?php if (!empty($gscCode)): ?>
<meta name="google-site-verification" content="<?= e($gscCode) ?>">
<?php endif; ?>
<?php if (!empty($bingCode)): ?>
<meta name="msvalidate.01" content="<?= e($bingCode) ?>">
<?php endif; ?>
<?php if (!empty($yandexCode)): ?>
<meta name="yandex-verification" content="<?= e($yandexCode) ?>">
<?php endif; ?>

<!-- Canonical Link -->
<link rel="canonical" href="<?= e($finalCanonical) ?>">

<!-- ══════════════════════════════════════════
     INTERNATIONAL MULTI-LANGUAGE SEO (hreflang)
     ══════════════════════════════════════════ -->
<?php if ($showHreflang && !empty($enabledLangs)): ?>
<?php 
  $cleanBaseUrl = preg_replace('/\?.*/', '', $finalCanonical);
?>
<link rel="alternate" hreflang="x-default" href="<?= e($cleanBaseUrl) ?>">
<?php foreach ($enabledLangs as $lCode => $lData): 
  $hreflangUrl = $cleanBaseUrl . ($lCode === 'en' ? '' : '?lang=' . urlencode($lCode));
?>
<link rel="alternate" hreflang="<?= e($lCode) ?>" href="<?= e($hreflangUrl) ?>">
<?php endforeach; ?>
<?php endif; ?>

<!-- Open Graph / Social Sharing -->
<meta property="og:type" content="<?= e($og_type ?? setting('og_type', 'website')) ?>">
<meta property="og:site_name" content="<?= e(setting('og_sitename', 'GoldMatrix Jewelry ERP')) ?>">
<meta property="og:title" content="<?= e($og_title ?? $finalMetaTitle) ?>">
<meta property="og:description" content="<?= e($og_desc ?? $finalMetaDesc) ?>">
<meta property="og:url" content="<?= e($og_url ?? $finalCanonical) ?>">
<meta property="og:image" content="<?= e($ogImgUrl) ?>">

<!-- Twitter Card -->
<meta name="twitter:card" content="<?= e($twitterCard) ?>">
<?php if (!empty($twitterHandle)): ?><meta name="twitter:site" content="<?= e($twitterHandle) ?>"><?php endif; ?>
<meta name="twitter:title" content="<?= e($og_title ?? $finalMetaTitle) ?>">
<meta name="twitter:description" content="<?= e($og_desc ?? $finalMetaDesc) ?>">
<meta name="twitter:image" content="<?= e($ogImgUrl) ?>">

<!-- ══════════════════════════════════════════
     GOOGLE ANALYTICS (GA4 / GTA) & GTM
     ══════════════════════════════════════════ -->
<?php if (!empty($ga4Id)): ?>
<!-- Google Tag (gtag.js) GA4 / GTA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($ga4Id) ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?= e($ga4Id) ?>');
</script>
<?php endif; ?>

<?php if (!empty($gtmId)): ?>
<!-- Google Tag Manager (GTM) Container -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?= e($gtmId) ?>');</script>
<?php endif; ?>

<?php if (!empty($fbPixel)): ?>
<!-- Meta / Facebook Pixel -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '<?= e($fbPixel) ?>');
  fbq('track', 'PageView');
</script>
<?php endif; ?>

<!-- ══════════════════════════════════════════
     CUSTOM HEADER CODE SECTION (Injected)
     ══════════════════════════════════════════ -->
<?php if (!empty($customHead)): ?>
<?= $customHead . "\n" ?>
<?php endif; ?>

<!-- Structured Data / Schema JSON-LD -->
<?php if (!empty($schema_json)): ?>
  <script type="application/ld+json">
    <?= json_encode($schema_json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
  </script>
<?php elseif (setting('schema_enabled', '1') === '1'): ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "<?= e(setting('schema_org_type', 'SoftwareApplication')) ?>",
    "name": "<?= e(setting('schema_org_name', 'GoldMatrix Jewellery ERP')) ?>",
    "url": "<?= site_url() ?>",
    "applicationCategory": "<?= e(setting('schema_software_category', 'BusinessApplication, ERP, POS')) ?>",
    "operatingSystem": "<?= e(setting('schema_software_os', 'Cloud Web, Windows 10/11, Android, iOS')) ?>",
    "offers": {
      "@type": "Offer",
      "priceCurrency": "<?= e(setting('schema_org_currency', 'INR')) ?>"
    },
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "<?= e(setting('schema_software_rating', '4.9')) ?>",
      "reviewCount": "<?= e(setting('schema_software_review_count', '385')) ?>"
    }
  }
  </script>
<?php endif; ?>

<!-- Dynamic Favicon / Site Icon -->
<?php 
$siteFavicon = setting('site_favicon', '');
$siteLogo = setting('site_logo', '');
$siteLogoHeight = setting('site_logo_height', '38');
$showBrandText = setting('show_brand_text', '1');
$companyName = setting('company_name', 'GoldMatrix');
$siteTagline = setting('site_tagline', 'Technology for Jewellery Business');
?>
<?php if (!empty($siteFavicon)): ?>
  <link rel="icon" href="<?= e($siteFavicon) ?>">
  <link rel="apple-touch-icon" href="<?= e($siteFavicon) ?>">
<?php else: ?>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23F59E0B'/><text x='50%' y='55%' dominant-baseline='central' text-anchor='middle' font-size='50' font-weight='900' fill='%2308080A'>GM</text></svg>">
<?php endif; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
<link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
:root {
  /* Brand Core Colors */
  --gm-navy: #001540;          /* Primary brand color */
  --gm-deep-navy: #000B2A;     /* Dark premium tone */
  --gm-tech-navy: #072554;     /* Secondary blue */

  /* Gold Accents - Pure 24K Vibrant Gold */
  --gm-luxury-gold: #F59E0B;   /* Pure vibrant 24K gold */
  --gm-bright-gold: #FBBF24;   /* Bright pure gold highlight */
  --gm-champagne-gold: #FDE68A;/* Light pure gold */
  --gm-soft-gold: #D97706;     /* Deep pure gold tone */

  /* Neutral Backgrounds */
  --gm-pure-white: #FFFFFF;
  --gm-off-white: #FBF9F4;     /* Warm off-white */
  --gm-light-grey: #F1EFE9;    /* Clean divider */
  --gm-border-color: #E8E4D9;  /* Crisp border */

  /* Text Colors */
  --gm-text-main: #0F172A;
  --gm-text-muted: #5A6A80;
  --gm-text-light: #94A3B8;

  /* Typography Stack */
  --gm-font-display: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  --gm-font-body: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  --gm-font: var(--gm-font-body);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; font-size: 16px; width: 100%; max-width: 100vw; overflow-x: hidden; }
body {
  font-family: var(--gm-font-body);
  background-color: var(--gm-pure-white);
  color: var(--gm-text-main);
  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  width: 100%;
  max-width: 100vw;
  overflow-x: hidden;
}

h1, h2, h3, h4, h5, h6,
.hero-h1, .conn-title, .modules-title, .pfeat-title, .spotlight-h2,
.mod-name, .feat-title, .country-card-title, .nav-brand-text, .section-title,
.integ-title {
  font-family: var(--gm-font-display);
  letter-spacing: -0.025em;
}

/* ══════════════════════════════
   GLOBAL BUTTON STYLES
══════════════════════════════ */
.btn-gold-solid {
  background-color: #FBBF24;
  color: #0F172A;
  font-size: 14px;
  font-weight: 700;
  padding: 10px 22px;
  border-radius: 6px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  border: 1px solid #FBBF24;
  transition: all 0.15s ease-in-out;
  cursor: pointer;
}
.btn-gold-solid:hover {
  background-color: #F59E0B;
  border-color: #F59E0B;
  color: #0F172A;
}

.btn-ghost {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.08);
  color: #FFFFFF;
  font-size: 14px;
  font-weight: 600;
  padding: 10px 22px;
  border-radius: 8px;
  text-decoration: none;
  border: 1px solid rgba(255, 255, 255, 0.25);
  transition: all 0.2s ease;
}
.btn-ghost:hover {
  background: rgba(255, 255, 255, 0.16);
  color: #FFFFFF;
  transform: translateY(-1px);
}

/* ══════════════════════════════
   NAVBAR & HEADER STYLES
══════════════════════════════ */
.navbar {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1000;
  height: 72px;
  background-color: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  padding: 0 3.5%;
  border-bottom: 1px solid #E2E8F0;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
  transition: all 0.3s ease;
}

.nav-brand {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
}
.nav-logo {
  width: 40px; height: 40px;
  background: var(--gm-luxury-gold);
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 1px 3px rgba(0,0,0,0.08);
  flex-shrink: 0;
}
.nav-logo-gm {
  font-weight: 900;
  font-size: 16px;
  color: var(--gm-deep-navy);
  letter-spacing: -0.5px;
}
.nav-brand-info {
  display: flex;
  flex-direction: column;
}
.nav-brand-name {
  font-weight: 800;
  font-size: 18px;
  letter-spacing: -0.3px;
  color: #001540;
  line-height: 1.15;
}
.nav-brand-sub {
  font-size: 9.5px;
  font-weight: 600;
  color: var(--gm-luxury-gold);
  letter-spacing: 0.8px;
  text-transform: uppercase;
}

.nav-menu {
  display: flex;
  align-items: center;
  gap: 4px;
}
.nav-menu .nav-link {
  color: #1E293B;
  font-size: 14.5px;
  font-weight: 550;
  text-decoration: none;
  padding: 8px 14px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: all 0.2s ease;
}
.nav-menu .nav-link svg {
  width: 10px; height: 6px;
  opacity: 0.6;
  transition: transform 0.2s;
}
.nav-menu .nav-link:hover {
  color: var(--gm-luxury-gold);
  background-color: #F8FAFC;
}
.nav-menu .nav-link:hover svg {
  transform: rotate(180deg);
}
.nav-menu .nav-link.active {
  color: var(--gm-luxury-gold);
  font-weight: 600;
}

/* Nav Dropdowns */
.nav-dropdown-wrap {
  position: relative;
}
.nav-dropdown-wrap:hover .nav-dropdown-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}
.nav-dropdown-menu {
  position: absolute;
  top: calc(100% + 6px);
  left: -12px;
  min-width: 240px;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  box-shadow: 0 16px 40px rgba(0, 21, 64, 0.14), 0 4px 12px rgba(0,0,0,0.06);
  padding: 10px 0;
  opacity: 0;
  visibility: hidden;
  transform: translateY(10px);
  transition: all 0.22s cubic-bezier(0.23, 1, 0.32, 1);
  z-index: 1050;
}
.nav-dropdown-menu::before {
  content: '';
  position: absolute;
  top: -6px;
  left: 24px;
  width: 12px;
  height: 12px;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-bottom: none;
  border-right: none;
  transform: rotate(45deg);
  border-radius: 2px 0 0 0;
}
.nav-dropdown-item {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 9px 18px;
  color: #001540;
  font-size: 13.5px;
  font-weight: 550;
  text-decoration: none;
  transition: background 0.15s ease;
  border-radius: 0;
  line-height: 1.3;
}
.nav-dropdown-item .nav-di-icon {
  width: 30px; height: 30px;
  background: #F8FAFC;
  border-radius: 7px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  font-size: 14px;
  color: #DC9423;
  transition: background 0.15s;
}
.nav-dropdown-item .nav-di-text { flex: 1; }
.nav-dropdown-item .nav-di-title { font-weight: 650; font-size: 13px; color: #0F172A; }
.nav-dropdown-item .nav-di-sub { font-size: 11.5px; color: #64748B; font-weight: 400; margin-top: 1px; }
.nav-dropdown-item:hover {
  background: #FFF9EC;
  color: #DC9423;
}
.nav-dropdown-item:hover .nav-di-icon { background: rgba(220,148,35,0.12); }
.nav-dropdown-item:hover .nav-di-title { color: #DC9423; }
.nav-dropdown-sep {
  height: 1px;
  background: #F1F5F9;
  margin: 6px 0;
}
.nav-dropdown-section-label {
  padding: 4px 18px 2px;
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  color: #94A3B8;
}

/* Nav Right Actions */
.nav-actions {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-left: 8px;
}
.nav-contact-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  color: #334155;
  font-size: 13.5px;
  font-weight: 550;
  text-decoration: none;
  padding: 7px 12px;
  border-radius: 7px;
  transition: all 0.18s;
}
.nav-contact-link:hover { color: #DC9423; background: #FFF9EC; }
.nav-demo-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background-color: #FBBF24;
  color: #0F172A;
  font-size: 13.5px;
  font-weight: 700;
  padding: 8px 18px;
  border-radius: 6px;
  text-decoration: none;
  border: 1px solid #FBBF24;
  transition: all 0.15s ease-in-out;
  cursor: pointer;
  white-space: nowrap;
}
.nav-demo-btn:hover {
  background-color: #F59E0B;
  border-color: #F59E0B;
  color: #0F172A;
}

/* Mobile Toggle Hamburger Button */
.nav-toggle-btn {
  display: none;
  align-items: center;
  justify-content: center;
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  color: #001540;
  width: 42px; height: 42px;
  border-radius: 8px;
  font-size: 22px;
  cursor: pointer;
  transition: all 0.2s ease;
}
.nav-toggle-btn:hover, .nav-toggle-btn:focus {
  background: #F0F4F8;
  color: var(--gm-luxury-gold);
}

/* Mobile Offcanvas Drawer */
.mobile-offcanvas {
  background: #FFFFFF;
  width: 320px !important;
  border-left: 1px solid #EAE6DB;
  z-index: 1060;
}
.mobile-nav-links {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.mobile-nav-link {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-radius: 8px;
  color: var(--gm-navy);
  text-decoration: none;
  font-weight: 600;
  font-size: 14.5px;
  transition: all 0.2s ease;
}
.mobile-nav-link:hover, .mobile-nav-link.active {
  background: var(--gm-off-white);
  color: var(--gm-luxury-gold);
}
.mobile-nav-link i {
  font-size: 18px;
  color: var(--gm-soft-gold);
  width: 22px;
  text-align: center;
}
.mobile-nav-link:hover i {
  color: var(--gm-luxury-gold);
}

/* ══════════════════════════════
   HERO SECTION
══════════════════════════════ */
.hero {
  position: relative;
  min-height: 560px;
  padding-top: 72px;
  background: var(--gm-navy, #001540);
  overflow: hidden;
  display: flex;
  flex-direction: column;
}
.hero-slider-container {
  position: relative;
  width: 100%;
  flex: 1;
  min-height: 480px;
}
.hero-slide {
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.75s ease-in-out, visibility 0.75s ease-in-out;
  display: flex;
  align-items: center;
}
.hero-slide.active {
  opacity: 1;
  visibility: visible;
  position: relative;
}
.hero-slide-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 24px 5% 48px;
  gap: 40px;
  max-width: 1380px;
  margin: 0 auto;
}
.hero-left {
  flex: 1 1 52%;
  max-width: 650px;
  z-index: 2;
}
.hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 1.8px;
  text-transform: uppercase;
  color: var(--slide-accent, var(--gm-luxury-gold));
  background: rgba(255, 255, 255, 0.06);
  padding: 6px 14px;
  border-radius: 20px;
  margin-bottom: 16px;
  border: 1px solid rgba(255, 255, 255, 0.1);
}
.hero-h1 {
  font-size: clamp(2rem, 3.8vw, 3.1rem);
  font-weight: 800;
  line-height: 1.18;
  color: #FFFFFF;
  letter-spacing: -0.8px;
  margin-bottom: 16px;
}
.hero-h1 .h1-gold {
  color: var(--slide-accent, var(--gm-luxury-gold));
}
.hero-desc {
  font-size: 15.5px;
  line-height: 1.7;
  color: #94A3B8;
  margin-bottom: 28px;
  max-width: 540px;
}
.hero-btns {
  display: flex;
  align-items: center;
  gap: 14px;
  flex-wrap: wrap;
  margin-bottom: 32px;
}
.hero-trial-pill {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.07);
  color: #FFFFFF;
  font-size: 14px;
  font-weight: 600;
  padding: 10px 22px;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.22);
  cursor: default;
  user-select: none;
  pointer-events: none;
  letter-spacing: 0.1px;
}
.hero-badges-row {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 20px 24px;
  padding-top: 22px;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}
.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13.5px;
  color: #E2E8F0;
  font-weight: 500;
  letter-spacing: 0.15px;
}
.hero-badge i {
  color: var(--gm-luxury-gold);
  font-size: 17px;
  display: inline-block;
  line-height: 1;
}
.hero-right {
  flex: 1 1 48%;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  z-index: 2;
}
.hero-slider-img {
  width: auto;
  max-width: 100%;
  max-height: 380px;
  object-fit: contain;
  filter: drop-shadow(0 15px 35px rgba(0, 0, 0, 0.45));
  transition: transform 0.4s ease;
}
.hero-slider-img:hover {
  transform: scale(1.02);
}
.hero-nav-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 44px; height: 44px;
  border-radius: 50%;
  background: rgba(0, 11, 42, 0.65);
  border: 1px solid rgba(255, 255, 255, 0.18);
  color: #FFFFFF;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px;
  cursor: pointer;
  z-index: 10;
  transition: all 0.25s ease;
  backdrop-filter: blur(6px);
}
.hero-nav-arrow:hover {
  background: var(--gm-luxury-gold);
  color: #000B2A;
  border-color: var(--gm-luxury-gold);
  box-shadow: 0 4px 15px rgba(220, 148, 35, 0.4);
}
.hero-prev { left: 16px; }
.hero-next { right: 16px; }
.hero-dots-wrap {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  margin: 12px auto 16px;
  z-index: 10;
}
.hero-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.25);
  border: 1px solid rgba(255, 255, 255, 0.35);
  cursor: pointer;
  padding: 0;
  transition: all 0.25s ease;
}
.hero-dot.active {
  width: 22px;
  border-radius: 4px;
  background: var(--gm-luxury-gold);
  border-color: var(--gm-luxury-gold);
}

/* ══════════════════════════════
   CLIENT BRANDS STRIP
══════════════════════════════ */
.section-brands {
  background: #FFFFFF;
  padding: 24px 5%;
  border-bottom: 1px solid #E2E8F0;
}
.brands-wrap {
  max-width: 1380px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 28px;
  flex-wrap: wrap;
}
.brands-label {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1.6px;
  text-transform: uppercase;
  color: #64748B;
  flex-shrink: 0;
  line-height: 1.5;
}
.brands-list {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 20px 32px;
  flex-wrap: wrap;
  flex: 1;
}
.brand-logo {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  padding: 4px 8px;
  transition: transform 0.2s ease, opacity 0.2s ease;
}
.brand-logo:hover {
  transform: translateY(-2px);
}
.brand-logo img {
  height: 32px;
  width: auto;
  max-width: 135px;
  object-fit: contain;
  filter: grayscale(100%);
  opacity: 0.75;
  transition: filter 0.25s ease, opacity 0.25s ease, transform 0.25s ease;
}
.brand-logo:hover img {
  filter: grayscale(0%);
  opacity: 1;
  transform: scale(1.06);
}
.brand-logo-text {
  font-size: 13px;
  font-weight: 700;
  color: #475569;
  letter-spacing: 0.5px;
}

/* ══════════════════════════════
   5 POWERFUL FEATURES
══════════════════════════════ */
.section-pfeatures {
  background: var(--gm-navy, #001540);
  padding: 85px 0 95px;
  position: relative;
  overflow: hidden;
}
.pfeat-header-wrap {
  text-align: center;
  margin-bottom: 50px;
}
.pfeat-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--gm-bright-gold, #DC9423);
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.pfeat-badge::before,
.pfeat-badge::after {
  content: "";
  display: inline-block;
  width: 24px;
  height: 1.5px;
  background: var(--gm-bright-gold, #DC9423);
}
.pfeat-main-heading {
  font-size: clamp(2.1rem, 3.4vw, 2.8rem);
  font-weight: 800;
  color: #FFFFFF;
  letter-spacing: -0.5px;
  line-height: 1.25;
  margin-bottom: 0;
}
.pfeat-gold-curve {
  display: block;
  width: 160px;
  height: 6px;
  margin: 12px auto 0;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 6' fill='none'%3E%3Cpath d='M2 4.5C40 1.5 110 1.5 148 4.5' stroke='%23DC9423' stroke-width='2.5' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat center;
  background-size: contain;
}
.pfeat-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 20px;
}
.pfeat-card {
  background: #FFFFFF;
  border-radius: 16px;
  padding: 32px 20px 28px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 11, 42, 0.2);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  position: relative;
  text-decoration: none;
}
.pfeat-card:hover {
  transform: translateY(-7px);
  box-shadow: 0 18px 40px rgba(0, 0, 0, 0.35);
}
.pfeat-icon-badge {
  width: 58px;
  height: 58px;
  border-radius: 12px;
  background: #001540;
  color: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  margin-bottom: 18px;
  transition: transform 0.25s ease, background-color 0.25s ease;
}
.pfeat-card:hover .pfeat-icon-badge {
  background: #DC9423;
  color: #001540;
  transform: scale(1.08);
}
.pfeat-title {
  font-size: 16px;
  font-weight: 750;
  color: #001540;
  margin-bottom: 8px;
  line-height: 1.35;
}
.pfeat-desc {
  font-size: 12.5px;
  color: #64748B;
  line-height: 1.55;
  margin: 0;
}

/* ══════════════════════════════
   FEATURE SHOWCASE (3 CARDS)
══════════════════════════════ */
.section-showcase {
  background: #FFFFFF;
  padding: 85px 0 95px;
  position: relative;
  border-top: 1px solid #E2E8F0;
  border-bottom: 1px solid #E2E8F0;
}
.showcase-header-wrap {
  text-align: center;
  margin-bottom: 50px;
}
.showcase-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--gm-luxury-gold, #F59E0B);
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.showcase-badge::before,
.showcase-badge::after {
  content: "";
  display: inline-block;
  width: 24px;
  height: 1.5px;
  background: var(--gm-luxury-gold, #F59E0B);
}
.showcase-main-heading {
  font-size: clamp(2.2rem, 3.5vw, 2.9rem);
  font-weight: 800;
  color: #001540;
  letter-spacing: -0.5px;
  line-height: 1.25;
  margin-bottom: 0;
}
.showcase-gold-curve {
  display: block;
  width: 170px;
  height: 6px;
  margin: 12px auto 0;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 6' fill='none'%3E%3Cpath d='M2 4.5C40 1.5 110 1.5 148 4.5' stroke='%23F59E0B' stroke-width='2.5' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat center;
  background-size: contain;
}
.showcase-saas-card {
  background: #001540;
  border-radius: 18px;
  padding: 30px 24px 22px;
  box-shadow: 0 12px 35px rgba(0, 21, 64, 0.14);
  border: 1px solid rgba(255, 255, 255, 0.1);
  display: flex;
  flex-direction: column;
  height: 100%;
  transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.28s ease, border-color 0.28s ease;
}
.showcase-saas-card:hover {
  transform: translateY(-6px);
  border-color: rgba(245, 158, 11, 0.5);
  box-shadow: 0 20px 48px rgba(0, 11, 42, 0.25);
}
.showcase-card-title {
  font-size: 20px;
  font-weight: 800;
  color: #FFFFFF;
  margin-bottom: 10px;
  line-height: 1.3;
}
.showcase-card-desc {
  font-size: 13.5px;
  color: #CBD5E1;
  line-height: 1.65;
  margin-bottom: 20px;
}
.showcase-img-holder {
  background: #FFFFFF;
  border-radius: 12px;
  padding: 10px;
  margin-top: auto;
  border: 1px solid rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 180px;
  overflow: hidden;
}
.showcase-screen-img {
  max-width: 100%;
  max-height: 220px;
  object-fit: contain;
  transition: transform 0.3s ease;
}
.showcase-saas-card:hover .showcase-screen-img {
  transform: scale(1.03);
}

/* ══════════════════════════════
   FEATURE SPOTLIGHT (ZIG-ZAG)
══════════════════════════════ */
.section-spotlight {
  background: #001540;
  padding: 95px 0 100px;
  position: relative;
  color: #FFFFFF;
}
.spotlight-header-wrap {
  text-align: center;
  margin-bottom: 70px;
}
.spotlight-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--gm-bright-gold, #DC9423);
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.spotlight-badge::before,
.spotlight-badge::after {
  content: "";
  display: inline-block;
  width: 24px;
  height: 1.5px;
  background: var(--gm-bright-gold, #DC9423);
}
.spotlight-main-heading {
  font-size: clamp(2.2rem, 3.5vw, 2.9rem);
  font-weight: 800;
  color: #FFFFFF;
  letter-spacing: -0.5px;
  line-height: 1.25;
  margin-bottom: 0;
}
.spotlight-gold-curve {
  display: block;
  width: 170px;
  height: 6px;
  margin: 12px auto 0;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 6' fill='none'%3E%3Cpath d='M2 4.5C40 1.5 110 1.5 148 4.5' stroke='%23DC9423' stroke-width='2.5' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat center;
  background-size: contain;
}
.spotlight-row {
  margin-bottom: 75px;
}
.spotlight-row:last-child {
  margin-bottom: 0;
}
.spotlight-title {
  font-size: clamp(1.6rem, 2.4vw, 2.1rem);
  font-weight: 800;
  color: #FFFFFF;
  line-height: 1.25;
  margin-bottom: 14px;
}
.spotlight-desc {
  font-size: 14.5px;
  color: #94A3B8;
  line-height: 1.7;
  margin-bottom: 24px;
}
.spotlight-checklist {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-bottom: 28px;
  list-style: none;
  padding: 0;
}
.spotlight-check-item {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14px;
  color: #E2E8F0;
}
.spotlight-check-item i {
  color: #DC9423;
  font-size: 16px;
  flex-shrink: 0;
}
.spotlight-img-wrap {
  background: rgba(0, 11, 42, 0.5);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 18px;
  padding: 16px;
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: transform 0.3s ease, border-color 0.3s ease;
}
.spotlight-img-wrap:hover {
  transform: translateY(-4px);
  border-color: rgba(220, 148, 35, 0.4);
}
.spotlight-img {
  max-width: 100%;
  max-height: 420px;
  object-fit: contain;
  border-radius: 10px;
}
.spotlight-img-placeholder {
  padding: 40px 20px;
  text-align: center;
}

/* ══════════════════════════════
   CONNECTED & 14 ERP MODULES
══════════════════════════════ */
.section-conn {
  background-color: var(--gm-pure-white);
  padding: 85px 5%;
}
.conn-top {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  align-items: flex-end;
  margin-bottom: 48px;
}
.conn-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(245, 158, 11, 0.09);
  border: 1px solid rgba(245, 158, 11, 0.28);
  padding: 6px 16px;
  border-radius: 999px;
  font-size: 11.5px;
  font-weight: 800;
  letter-spacing: 1.4px;
  text-transform: uppercase;
  color: #D97706;
  margin-bottom: 14px;
}
.conn-title {
  font-size: clamp(2rem, 3.2vw, 2.75rem);
  font-weight: 800;
  color: var(--gm-navy);
  line-height: 1.18;
  letter-spacing: -0.03em;
}
.conn-desc {
  font-size: 15.5px;
  color: var(--gm-text-muted);
  line-height: 1.75;
}
.feat-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}
@media (max-width: 1100px) {
  .feat-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 768px) {
  .feat-grid {
    grid-template-columns: 1fr;
    gap: 14px;
  }
}
@media (max-width: 600px) {
  .feat-grid {
    grid-template-columns: 1fr;
  }
}
.feat-card {
  background: var(--gm-pure-white);
  border: 1px solid rgba(0, 21, 64, 0.08);
  border-radius: 12px;
  padding: 32px 24px 28px;
  transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
  text-decoration: none;
  color: inherit;
  display: flex;
  flex-direction: column;
  position: relative;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0, 21, 64, 0.04);
}
@media (max-width: 768px) {
  .feat-card {
    flex-direction: row;
    align-items: flex-start;
    gap: 16px;
    padding: 20px 18px;
  }
  .feat-icon {
    flex-shrink: 0;
    margin-bottom: 0 !important;
  }
  .feat-title {
    font-size: 15px;
    margin-bottom: 6px;
  }
  .feat-desc {
    font-size: 13px;
  }
  .section-conn {
    padding: 48px 5%;
  }
  .conn-top {
    grid-template-columns: 1fr;
    gap: 16px;
    margin-bottom: 28px;
  }
  .conn-title {
    font-size: clamp(1.6rem, 6vw, 2.2rem);
  }
}
.feat-card:hover {
  transform: translateY(-3px);
  border-color: #94A3B8;
  box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);
}
.feat-icon {
  width: 48px; height: 48px;
  border-radius: 8px;
  background-color: #FEF3C7;
  border: 1px solid #FDE68A;
  display: flex; align-items: center; justify-content: center;
  font-size: 22px;
  color: #92400E;
  margin-bottom: 18px;
  transition: all 0.15s ease;
}
.feat-card:hover .feat-icon {
  background-color: #FBBF24;
  color: #0F172A;
  border-color: #FBBF24;
}
.feat-title {
  font-size: 17.5px;
  font-weight: 750;
  color: var(--gm-navy);
  margin-bottom: 10px;
  line-height: 1.35;
}
.feat-desc {
  font-size: 13.8px;
  color: var(--gm-text-muted);
  line-height: 1.65;
}

/* 14 ERP Modules */
.section-modules {
  background-color: var(--gm-off-white);
  padding: 90px 5%;
  border-top: 1px solid var(--gm-border-color);
}
.modules-header {
  text-align: center;
  max-width: 680px;
  margin: 0 auto 54px;
}
.modules-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(245, 158, 11, 0.09);
  border: 1px solid rgba(245, 158, 11, 0.28);
  padding: 6px 16px;
  border-radius: 999px;
  font-size: 11.5px;
  font-weight: 800;
  letter-spacing: 1.4px;
  text-transform: uppercase;
  color: #D97706;
  margin-bottom: 14px;
}
.modules-title {
  font-size: clamp(2rem, 3.2vw, 2.75rem);
  font-weight: 800;
  color: var(--gm-navy);
  line-height: 1.18;
  letter-spacing: -0.03em;
  margin-bottom: 14px;
}
.modules-desc {
  font-size: 15.5px;
  color: var(--gm-text-muted);
  line-height: 1.75;
}
.modules-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 22px;
}
@media (max-width: 1200px) {
  .modules-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}
@media (max-width: 900px) {
  .modules-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 580px) {
  .modules-grid {
    grid-template-columns: 1fr;
  }
}
.mod-card {
  background: var(--gm-pure-white);
  border: 1px solid rgba(0, 21, 64, 0.08);
  border-radius: 12px;
  padding: 28px 22px 24px;
  transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
  text-decoration: none;
  color: inherit;
  display: flex;
  flex-direction: column;
  position: relative;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0, 21, 64, 0.04);
}
.mod-card:hover {
  transform: translateY(-3px);
  border-color: #94A3B8;
  box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);
}
.mod-icon-wrap {
  width: 48px; height: 48px;
  border-radius: 8px;
  background-color: #FEF3C7;
  border: 1px solid #FDE68A;
  display: flex; align-items: center; justify-content: center;
  font-size: 22px;
  color: #92400E;
  margin-bottom: 18px;
  transition: all 0.15s ease;
}
.mod-card:hover .mod-icon-wrap {
  background-color: #FBBF24;
  color: #0F172A;
  border-color: #FBBF24;
}
.mod-name {
  font-size: 17px;
  font-weight: 750;
  color: var(--gm-navy);
  margin-bottom: 8px;
  line-height: 1.35;
}
.mod-text {
  font-size: 13.5px;
  color: var(--gm-text-muted);
  line-height: 1.62;
}

/* ══════════════════════════════
   GLOBAL REACH / SLIDING COUNTRIES (MAP)
══════════════════════════════ */
.section-countries-slider {
  background: #001540;
  padding: 85px 0 95px;
  overflow: hidden;
  position: relative;
}
.countries-header-wrap {
  text-align: center;
  margin-bottom: 48px;
}
.countries-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  color: #DC9423;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.countries-badge::before,
.countries-badge::after {
  content: "";
  display: inline-block;
  width: 24px;
  height: 1.5px;
  background: #DC9423;
}
.countries-main-heading {
  font-size: clamp(2rem, 3.2vw, 2.7rem);
  font-weight: 800;
  color: #FFFFFF;
  letter-spacing: -0.5px;
  line-height: 1.25;
  margin-bottom: 0;
}
.countries-gold-curve {
  display: block;
  width: 170px;
  height: 6px;
  margin: 12px auto 0;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 6' fill='none'%3E%3Cpath d='M2 4.5C40 1.5 110 1.5 148 4.5' stroke='%23DC9423' stroke-width='2.5' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat center;
  background-size: contain;
}
.countries-slide-viewport {
  width: 100%;
  overflow: hidden;
  position: relative;
  padding: 15px 0;
}
.countries-slide-track {
  display: flex;
  gap: 20px;
  width: max-content;
  animation: slideCountriesMarquee 38s linear infinite;
}
.countries-slide-track:hover {
  animation-play-state: paused;
}
@keyframes slideCountriesMarquee {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}
.country-map-card {
  width: 270px;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 16px;
  overflow: hidden;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
  backdrop-filter: blur(8px);
}
.country-map-card:hover {
  transform: translateY(-6px);
  border-color: #DC9423;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
}
.country-map-img-box {
  width: 100%;
  height: 155px;
  background: rgba(0, 11, 42, 0.6);
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
  overflow: hidden;
}
.country-map-img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
  filter: drop-shadow(0 4px 10px rgba(0,0,0,0.5));
  transition: transform 0.25s ease;
}
.country-map-card:hover .country-map-img {
  transform: scale(1.08);
}
.country-map-content {
  padding: 16px 18px 18px;
  background: rgba(255, 255, 255, 0.02);
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.country-card-title {
  color: #FFFFFF;
  font-size: 16px;
  font-weight: 750;
  margin-bottom: 6px;
}
.country-card-desc {
  color: #94A3B8;
  font-size: 12.5px;
  line-height: 1.5;
  margin-bottom: 0;
}

/* ══════════════════════════════
   TOOLS & INTEGRATIONS
══════════════════════════════ */
.section-integrations {
  background: var(--gm-pure-white, #FFFFFF);
  padding: 85px 0 90px;
  position: relative;
  border-top: 1px solid #F1F5F9;
  border-bottom: 1px solid #F1F5F9;
}
.integ-header-wrap {
  text-align: center;
  margin-bottom: 48px;
}
.integ-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  color: var(--gm-bright-gold, #DC9423);
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.integ-badge::before,
.integ-badge::after {
  content: "";
  display: inline-block;
  width: 24px;
  height: 1.5px;
  background: var(--gm-bright-gold, #DC9423);
}
.integ-main-heading {
  font-size: clamp(2rem, 3.2vw, 2.7rem);
  font-weight: 800;
  color: var(--gm-navy, #001540);
  letter-spacing: -0.5px;
  line-height: 1.25;
  margin-bottom: 0;
}
.integ-gold-curve {
  display: block;
  width: 170px;
  height: 6px;
  margin: 12px auto 0;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 6' fill='none'%3E%3Cpath d='M2 4.5C40 1.5 110 1.5 148 4.5' stroke='%23DC9423' stroke-width='2.5' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat center;
  background-size: contain;
}
.integ-desc {
  color: #64748B;
  font-size: 15.5px;
  line-height: 1.65;
  max-width: 780px;
  margin: 16px auto 0;
}
.integ-grid {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 20px;
}
.integ-card {
  background: #FFFFFF;
  border: 1.5px solid #E2E8F0;
  border-radius: 14px;
  padding: 24px 16px 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease;
  text-decoration: none;
  min-height: 175px;
}
.integ-card:hover {
  transform: translateY(-4px);
  border-color: var(--gm-bright-gold, #DC9423);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
}
.integ-logo-wrap {
  height: 56px;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 16px;
}
.integ-logo-img {
  max-height: 46px;
  max-width: 90%;
  object-fit: contain;
  filter: none;
  transition: transform 0.25s ease;
}
.integ-card:hover .integ-logo-img {
  transform: scale(1.06);
}
.integ-card-desc {
  font-size: 12.5px;
  color: #64748B;
  line-height: 1.5;
  margin: 0;
}

/* ══════════════════════════════
   MOBILE APP SHOWCASE
══════════════════════════════ */
.section-mobile-app {
  background: #F8FAFC;
  padding: 85px 0 95px;
  position: relative;
  border-top: 1px solid #E2E8F0;
}
.app-header-wrap {
  text-align: center;
  margin-bottom: 45px;
}
.app-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  color: var(--gm-bright-gold, #DC9423);
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
.app-badge::before,
.app-badge::after {
  content: "";
  display: inline-block;
  width: 24px;
  height: 1.5px;
  background: var(--gm-bright-gold, #DC9423);
}
.app-main-heading {
  font-size: clamp(2rem, 3.2vw, 2.7rem);
  font-weight: 800;
  color: var(--gm-navy, #001540);
  letter-spacing: -0.5px;
  line-height: 1.25;
  margin-bottom: 0;
}
.app-gold-curve {
  display: block;
  width: 170px;
  height: 6px;
  margin: 12px auto 0;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 6' fill='none'%3E%3Cpath d='M2 4.5C40 1.5 110 1.5 148 4.5' stroke='%23DC9423' stroke-width='2.5' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat center;
  background-size: contain;
}
.app-desc {
  color: #64748B;
  font-size: 15.5px;
  line-height: 1.65;
  max-width: 780px;
  margin: 16px auto 0;
}
.app-banner-card {
  background: #FFFFFF;
  border-radius: 20px;
  box-shadow: 0 12px 35px rgba(0, 21, 64, 0.08);
  border: 1px solid #E2E8F0;
  overflow: hidden;
  margin-bottom: 20px;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.app-banner-card:hover {
  box-shadow: 0 16px 45px rgba(0, 21, 64, 0.12);
}
.app-banner-img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
}

/* ══════════════════════════════
   WHY SECTION
══════════════════════════════ */
.section-why {
  background-color: var(--gm-pure-white);
  padding: 85px 5%;
}
.why-wrap {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
}
.why-badge {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: var(--gm-luxury-gold);
  margin-bottom: 8px;
}
.why-title {
  font-size: clamp(1.8rem, 3vw, 2.5rem);
  font-weight: 800;
  color: var(--gm-navy);
  line-height: 1.2;
  margin-bottom: 24px;
}
.why-title .gold-it {
  color: var(--gm-luxury-gold);
}
.why-checklist {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px 24px;
  margin-bottom: 32px;
}
.why-item {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14px;
  font-weight: 500;
  color: var(--gm-text-main);
}
.why-check {
  width: 20px; height: 20px;
  border-radius: 50%;
  background: var(--gm-off-white);
  border: 1px solid var(--gm-border-color);
  color: var(--gm-luxury-gold);
  display: flex; align-items: center; justify-content: center;
  font-size: 11px;
  flex-shrink: 0;
}
.btn-explore {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--gm-navy);
  color: #FFFFFF;
  font-size: 14.5px;
  font-weight: 600;
  padding: 12px 24px;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
.btn-explore:hover {
  background: var(--gm-tech-navy);
  transform: translateY(-2px);
  color: #FFFFFF;
}
.why-img-holder {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 20px;
  padding: 16px;
  box-shadow: 0 16px 40px rgba(0, 21, 64, 0.08);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.why-img-holder:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 50px rgba(0, 21, 64, 0.12);
}
.why-mockup-img {
  max-width: 100%;
  height: auto;
  object-fit: contain;
  border-radius: 12px;
}

/* ══════════════════════════════
   TESTIMONIALS
══════════════════════════════ */
.section-testi {
  background-color: var(--gm-off-white);
  padding: 85px 5%;
  border-top: 1px solid var(--gm-border-color);
}
.testi-hdr {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  margin-bottom: 40px;
}
.testi-tag {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: var(--gm-luxury-gold);
  margin-bottom: 6px;
}
.testi-title {
  font-size: clamp(1.6rem, 2.5vw, 2.2rem);
  font-weight: 800;
  color: var(--gm-navy);
}
.testi-view-all {
  color: var(--gm-luxury-gold);
  font-weight: 600;
  font-size: 14px;
  text-decoration: none;
}
.testi-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
.testi-card {
  background: var(--gm-pure-white);
  border: 1px solid var(--gm-border-color);
  border-radius: 16px;
  padding: 28px;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
.testi-card:hover {
  transform: translateY(-4px);
  border-color: var(--gm-luxury-gold);
  box-shadow: 0 12px 30px rgba(0,21,64,0.08);
}
.testi-stars {
  color: var(--gm-bright-gold);
  font-size: 15px;
  margin-bottom: 14px;
}
.testi-q {
  font-size: 14px;
  color: var(--gm-text-main);
  line-height: 1.65;
  margin-bottom: 20px;
  font-style: italic;
}
.testi-auth {
  display: flex;
  align-items: center;
  gap: 12px;
}
.testi-av {
  width: 40px; height: 40px;
  border-radius: 50%;
  background: var(--gm-light-grey);
  display: flex; align-items: center; justify-content: center;
  font-weight: 700;
  font-size: 15px;
  color: var(--gm-navy);
  flex-shrink: 0;
}
.testi-photo {
  width: 40px; height: 40px;
  border-radius: 50%;
  object-fit: cover;
  flex-shrink: 0;
}
.testi-name {
  font-weight: 700;
  font-size: 14px;
  color: var(--gm-navy);
}
.testi-company {
  font-size: 12px;
  color: var(--gm-text-muted);
}

/* ══════════════════════════════
   FOOTER STYLES
══════════════════════════════ */
footer {
  background-color: var(--gm-deep-navy);
  border-top: 1px solid rgba(255,255,255,0.06);
  padding: 64px 5% 32px;
}
.footer-inner {
  max-width: 1300px;
  margin: 0 auto;
}
.footer-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 48px;
  margin-bottom: 48px;
}
.footer-brand-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 14px;
}
.footer-brand-icon {
  width: 32px; height: 32px;
  border-radius: 6px;
  background: var(--gm-luxury-gold);
  display: flex; align-items: center; justify-content: center;
  font-weight: 900;
  font-size: 13px;
  color: var(--gm-deep-navy);
}
.footer-brand-name {
  font-weight: 800;
  font-size: 18px;
  color: #FFFFFF;
}
.footer-tagline {
  font-size: 13.5px;
  color: rgba(255,255,255,0.6);
  line-height: 1.6;
  margin-bottom: 16px;
  max-width: 280px;
}
.footer-contact {
  display: flex;
  flex-direction: column;
  gap: 6px;
  font-size: 13px;
  color: rgba(255,255,255,0.65);
}
.footer-col h6 {
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #FFFFFF;
  margin-bottom: 16px;
}
.footer-col a {
  display: block;
  color: rgba(255,255,255,0.6);
  font-size: 13.5px;
  text-decoration: none;
  margin-bottom: 10px;
  transition: color 0.2s ease;
}
.footer-col a:hover {
  color: var(--gm-luxury-gold);
}
.footer-bottom {
  padding-top: 24px;
  border-top: 1px solid rgba(255,255,255,0.06);
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 12.5px;
  color: rgba(255,255,255,0.4);
}
.footer-bottom a {
  color: rgba(255,255,255,0.4);
  text-decoration: none;
}
.footer-bottom a:hover {
  color: var(--gm-luxury-gold);
}

/* ══════════════════════════════
   COMPREHENSIVE RESPONSIVE SYSTEM
══════════════════════════════ */
@media (max-width: 1199.98px) {
  .navbar { padding: 0 4%; }
  .feat-grid { grid-template-columns: repeat(2, 1fr); }
  .modules-grid { grid-template-columns: repeat(3, 1fr); }
  .footer-grid { grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 32px; }
}

@media (max-width: 991.98px) {
  .navbar { padding: 0 4%; height: 64px; }
  .nav-menu { display: none !important; }
  .nav-actions { display: none !important; }
  .nav-toggle-btn { display: inline-flex !important; }
  .nav-brand-name { font-size: 16px; }
  .nav-brand-sub { font-size: 8.5px; }

  .hero { min-height: auto; padding-top: 72px; padding-bottom: 40px; }
  .hero-slide-inner { flex-direction: column; padding: 16px 4% 32px; gap: 20px; text-align: center; }
  .hero-right { order: 1; width: 100%; max-width: 480px; margin: 0 auto; justify-content: center; }
  .hero-slider-img { max-height: 250px; }
  .hero-left { order: 2; flex: 1 1 100%; max-width: 100%; align-items: center; text-align: center; }
  .hero-h1 { font-size: clamp(1.65rem, 5.2vw, 2.3rem); }
  .hero-btns { flex-direction: column; width: 100%; max-width: 360px; margin: 0 auto 22px; }
  .hero-badges-row { grid-template-columns: repeat(2, 1fr); max-width: 380px; margin: 0 auto; }
  .hero-nav-arrow { display: none !important; }

  .trust { flex-direction: column; padding: 20px 4%; gap: 16px; }
  .trust-div { display: none; }
  .trust-list { justify-content: center; gap: 16px 22px; }

  .section-conn, .section-modules, .section-why, .section-testi { padding: 56px 4%; }
  .conn-top, .why-wrap { grid-template-columns: 1fr; gap: 32px; }
  .modules-grid { grid-template-columns: repeat(3, 1fr); }
  .testi-grid { grid-template-columns: 1fr; }
  .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px 24px; }

  /* ── feat-grid: 1 column on mobile, same card layout as desktop ── */
  .feat-grid { grid-template-columns: 1fr !important; gap: 14px; }
  .feat-card {
    flex-direction: column !important;
    align-items: flex-start;
    padding: 24px 20px;
  }
  .feat-icon { margin-bottom: 16px !important; }
  .feat-title { font-size: 16px; }
  .feat-desc { font-size: 13.5px; }

  /* Solutions section grid on tablet */
  .gm-sol-card-grid { grid-template-columns: 1fr 1fr !important; }
}

@media (max-width: 575.98px) {
  .navbar { padding: 0 16px; height: 60px; }
  .nav-brand-name { font-size: 14.5px; }
  .nav-brand-sub { font-size: 8px; }
  .nav-toggle-btn { width: 38px; height: 38px; font-size: 20px; }

  .hero { padding-top: 66px; padding-bottom: 28px; }
  .hero-slider-img { max-height: 195px; }
  .hero-h1 { font-size: 1.55rem; }
  .hero-desc { font-size: 13px; }

  .trust-list { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px 6px; }

  /* ── Brands strip — stack vertically, centre-aligned on mobile ── */
  .section-brands { padding: 28px 16px; }
  .brands-wrap {
    flex-direction: column;
    align-items: center;
    gap: 18px;
  }
  .brands-label {
    text-align: center;
    font-size: 10px;
  }
  .brands-list {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px 16px;
    justify-items: center;
    width: 100%;
  }
  .brand-logo {
    width: 100%;
    justify-content: center;
  }
  .brand-logo img { height: 28px; max-width: 100px; }

  /* ── feat-grid: force 1-col on small mobile, column layout same as desktop ── */
  .feat-grid { grid-template-columns: 1fr !important; gap: 12px; }
  .feat-card { flex-direction: column !important; align-items: flex-start; padding: 20px 16px; }
  .feat-icon { width: 44px; height: 44px; font-size: 20px; margin-bottom: 14px !important; }
  .feat-title { font-size: 15px; }
  .feat-desc { font-size: 13px; }

  /* ── pfeat-grid (navy section cards) ── */
  .pfeat-grid { grid-template-columns: 1fr; gap: 14px; }
  .pfeat-card { padding: 22px 20px; flex-direction: row; align-items: flex-start; text-align: left; gap: 16px; }
  .pfeat-icon-badge { flex-shrink: 0; width: 48px; height: 48px; font-size: 22px; margin-bottom: 0; }
  .pfeat-title { font-size: 15px; }
  .pfeat-desc { font-size: 12px; }

  .integ-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
  .integ-card { padding: 16px 10px 14px; min-height: 150px; }
  .integ-logo-wrap { height: 42px; margin-bottom: 10px; }
  .integ-logo-img { max-height: 32px; }
  .integ-card-desc { font-size: 11px; }

  .section-mobile-app { padding: 50px 0 55px; }
  .app-main-heading { font-size: 1.55rem; }
  .app-desc { font-size: 13px; }

  .why-checklist { grid-template-columns: 1fr; }
  .modules-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
  .footer-grid { grid-template-columns: 1fr; gap: 24px; }
  .footer-bottom { flex-direction: column; text-align: center; gap: 8px; }

  /* Solutions & Features new pages */
  .gm-sol-card-grid { grid-template-columns: 1fr !important; }
}

@media (max-width: 375px) {
  .hero-h1 { font-size: 1.4rem; }
  .feat-grid, .modules-grid, .integ-grid { grid-template-columns: 1fr; }
  .pfeat-grid { grid-template-columns: 1fr; }
  .brands-list { grid-template-columns: repeat(2, 1fr); }
  .trust-list { grid-template-columns: repeat(2, 1fr); }
  .app-main-heading { font-size: 1.35rem; }
}

/* ══════════════════════════════
   COMPACT LUXURY FLAG SELECTOR
══════════════════════════════ */
.nav-lang-dropdown {
  position: relative;
  display: inline-flex;
  align-items: center;
}
.btn-lang-compact {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
  background: #001540;
  color: #FFFFFF;
  border: 1px solid rgba(0, 21, 64, 0.2);
  padding: 4px 7px;
  height: 32px;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}
.btn-lang-compact:hover, 
.btn-lang-compact:focus,
.btn-lang-compact[aria-expanded="true"] {
  background: #000B2A;
  border-color: #F59E0B;
  box-shadow: 0 2px 8px rgba(245, 158, 11, 0.25);
}
.btn-lang-compact::after {
  display: none !important;
}
.btn-lang-compact .nav-flag-img {
  width: 20px;
  height: 14px;
  object-fit: cover;
  border-radius: 2px;
  display: block;
  box-shadow: 0 1px 2px rgba(0,0,0,0.25);
}
.btn-lang-compact .nav-flag-caret {
  font-size: 8px;
  opacity: 0.85;
  color: #FFFFFF;
  transition: transform 0.2s ease;
  line-height: 1;
}
.btn-lang-compact[aria-expanded="true"] .nav-flag-caret {
  transform: rotate(180deg);
}

/* Compact Luxury Dropdown Menu */
.nav-lang-menu-compact {
  min-width: 185px;
  max-height: 360px;
  overflow-y: auto;
  border-radius: 10px;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  padding: 5px;
  margin-top: 6px !important;
  z-index: 1065;
  box-shadow: 0 12px 30px rgba(0, 21, 64, 0.16), 0 2px 6px rgba(0, 0, 0, 0.04);
}
.nav-lang-item-compact {
  border-radius: 6px;
  padding: 6px 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  color: #1E293B;
  font-size: 13px;
  font-weight: 550;
  text-decoration: none;
  transition: all 0.15s ease;
  cursor: pointer;
}
.nav-lang-item-compact:hover {
  background: #FFF9EC;
  color: #DC9423;
}
.nav-lang-item-compact.active-lang {
  background: #FFF4DC;
  color: #001540;
  font-weight: 700;
}
.nav-lang-item-compact .lang-flag-thumb {
  width: 19px;
  height: 13px;
  object-fit: cover;
  border-radius: 2px;
  flex-shrink: 0;
  box-shadow: 0 1px 2px rgba(0,0,0,0.15);
}

/* Mobile Language Bar */
.mobile-lang-bar {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 8px 12px;
  margin-bottom: 16px;
}

/* Hide Google Translate top bar / widget banners */
.goog-te-banner-frame.skiptranslate,
.goog-te-banner-frame,
#goog-gt-tt,
.goog-te-balloon-frame {
  display: none !important;
}
body {
  top: 0px !important;
  position: static !important;
}
.goog-tooltip {
  display: none !important;
}
.goog-tooltip:hover {
  display: none !important;
}
.goog-text-highlight {
  background-color: transparent !important;
  border: none !important;
  box-shadow: none !important;
}
#google_translate_element {
  position: absolute;
  top: -9999px;
  left: -9999px;
  width: 1px;
  height: 1px;
  overflow: hidden;
}

/* RTL Layout adjustments for Arabic text without altering navbar layout */
[dir="rtl"] {
  direction: rtl;
  text-align: right;
}
[dir="rtl"] .navbar {
  direction: ltr !important;
}
[dir="rtl"] .navbar .nav-menu {
  direction: ltr !important;
}
[dir="rtl"] .mobile-offcanvas {
  right: auto;
  left: 0;
  border-left: none;
  border-right: 1px solid #EAE6DB;
  direction: ltr !important;
}
[dir="rtl"] .nav-dropdown-menu {
  left: auto;
  right: -12px;
}
[dir="rtl"] .nav-dropdown-menu::before {
  left: auto;
  right: 24px;
}
</style>
</head>
<body>

<!-- Hidden Google Translate Element -->
<div id="google_translate_element"></div>

<?php 
$showTopNotice = (setting('enable_top_notification_bar', '0') == '1');
$topNoticeText = setting('top_notification_text', '');
$topNoticeLink = setting('top_notification_link', '#bookDemoModal');
$topNoticeBadge = setting('top_notification_badge', 'NEW');
?>
<?php if ($showTopNotice && !empty($topNoticeText)): ?>
<!-- ════════════════════════════════
     WEBSITE TOP ANNOUNCEMENT / NOTIFICATION BAR
════════════════════════════════ -->
<div class="top-announcement-bar" id="topAnnouncementBar" style="background:#000B2A; color:#FFFFFF; font-size:12px; padding:6px 16px; border-bottom:1px solid rgba(245,158,11,0.25); text-align:center; z-index:1005; position:relative;">
  <div class="container-fluid d-flex align-items-center justify-content-center gap-2 flex-wrap px-2">
    <?php if (!empty($topNoticeBadge)): ?>
      <span class="badge bg-warning text-dark fw-bold fs-10 px-2 py-0.5 rounded-pill"><?= e($topNoticeBadge) ?></span>
    <?php endif; ?>
    <span class="text-light text-truncate" style="max-width:85vw;"><?= e($topNoticeText) ?></span>
    <?php if (!empty($topNoticeLink)): ?>
      <a href="<?= e($topNoticeLink) ?>" <?= strpos($topNoticeLink, '#') === 0 ? 'data-bs-toggle="modal" data-bs-target="' . e($topNoticeLink) . '" class="open-demo-modal"' : '' ?> class="text-warning fw-semibold text-decoration-none ms-1 text-nowrap">
        Explore Now <i class="bi bi-arrow-right fs-11"></i>
      </a>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>

<!-- ════════════════════════════════
     NAVBAR (DYNAMIC HEADER MENU)
════════════════════════════════ -->
<nav class="navbar" id="navbar">
  <a href="/" class="nav-brand">
    <?php if (!empty($siteLogo)): ?>
      <img src="<?= e($siteLogo) ?>" alt="<?= e($companyName) ?>" class="nav-custom-logo" style="max-height:<?= (int)$siteLogoHeight ?>px; width:auto; object-fit:contain;">
      <?php if ($showBrandText == '1'): ?>
        <div class="nav-brand-info ms-2">
          <span class="nav-brand-name"><?= e($companyName) ?></span>
          <span class="nav-brand-sub"><?= e($siteTagline) ?></span>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <div class="nav-logo">
        <span class="nav-logo-gm">GM</span>
      </div>
      <div class="nav-brand-info">
        <span class="nav-brand-name"><?= e($companyName) ?></span>
        <span class="nav-brand-sub"><?= e($siteTagline) ?></span>
      </div>
    <?php endif; ?>
  </a>

  <!-- Dynamic Desktop Menu -->
  <div class="nav-menu">
    <?php 
    $renderHeaderMenu = !empty($header_menu) ? $header_menu : [
      ['title' => 'Home', 'url' => '/', 'target' => '_self', 'children' => []],
      ['title' => 'Features', 'url' => '/features', 'target' => '_self', 'children' => []],
      ['title' => 'Blog', 'url' => '/blog', 'target' => '_self', 'children' => []],
      ['title' => 'About', 'url' => '/about', 'target' => '_self', 'children' => []],
      ['title' => 'Contact', 'url' => '/contact', 'target' => '_self', 'children' => []],
    ];
    foreach ($renderHeaderMenu as $item): ?>
      <?php if (!empty($item['children'])): ?>
        <div class="nav-dropdown-wrap">
          <a href="<?= e($item['url']) ?>" class="nav-link" target="<?= e($item['target'] ?: '_self') ?>">
            <?= e($item['title']) ?>
            <svg viewBox="0 0 10 6" fill="none"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </a>
          <div class="nav-dropdown-menu">
            <?php foreach ($item['children'] as $child): ?>
              <a href="<?= e($child['url']) ?>" class="nav-dropdown-item" target="<?= e($child['target'] ?: '_self') ?>">
                <?php if (!empty($child['icon'])): ?>
                  <div class="nav-di-icon"><i class="bi <?= e($child['icon']) ?>"></i></div>
                  <div class="nav-di-text">
                    <div class="nav-di-title"><?= e($child['title']) ?></div>
                    <?php if (!empty($child['sub'])): ?>
                      <div class="nav-di-sub"><?= e($child['sub']) ?></div>
                    <?php endif; ?>
                  </div>
                <?php else: ?>
                  <?= e($child['title']) ?>
                <?php endif; ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php else: ?>
        <a href="<?= e($item['url']) ?>" class="nav-link" target="<?= e($item['target'] ?: '_self') ?>">
          <?= e($item['title']) ?>
          <?php if (!empty($item['badge'])): ?>
            <span class="badge bg-warning text-dark fs-10 ms-1"><?= e($item['badge']) ?></span>
          <?php endif; ?>
        </a>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>

  <!-- Right Actions: Compact Flag Switcher + Demo CTA -->
  <div class="nav-actions d-none d-lg-flex align-items-center gap-2">
    <?php if ($isMultilangEnabled && ($langSwitcherPos === 'header' || $langSwitcherPos === 'both') && !empty($enabledLangs)): ?>
      <div class="dropdown nav-lang-dropdown">
        <button class="btn-lang-compact dropdown-toggle" type="button" id="headerLangDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Change Language (<?= e($activeLangInfo['name']) ?>)">
          <img src="<?= e($activeLangInfo['flag_img']) ?>" alt="<?= e($activeLangInfo['name']) ?>" class="nav-flag-img">
          <i class="bi bi-caret-down-fill nav-flag-caret"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end nav-lang-menu-compact shadow-lg border-0" aria-labelledby="headerLangDropdown">
          <li class="dropdown-header text-uppercase fs-10 fw-bold text-muted px-2 py-1">Select Language</li>
          <?php foreach ($enabledLangs as $code => $lang): ?>
            <li>
              <a class="dropdown-item nav-lang-item-compact <?= $activeLang === $code ? 'active-lang' : '' ?>" 
                 href="javascript:void(0);" 
                 onclick="switchSiteLanguage('<?= e($code) ?>', '<?= e($lang['name']) ?>')">
                <span class="d-flex align-items-center gap-2">
                  <img src="<?= e($lang['flag_img']) ?>" class="lang-flag-thumb" alt="<?= e($lang['name']) ?>">
                  <span><?= e($lang['name']) ?></span>
                </span>
                <?php if ($activeLang === $code): ?>
                  <i class="bi bi-check2 text-warning fw-bold fs-13"></i>
                <?php endif; ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
  </div>

  <!-- Mobile Right Area: Compact Flag Button + Hamburger -->
  <div class="d-flex align-items-center gap-2 d-lg-none">
    <?php if ($isMultilangEnabled && ($langSwitcherPos === 'header' || $langSwitcherPos === 'both') && !empty($enabledLangs)): ?>
      <div class="dropdown nav-lang-dropdown">
        <button class="btn-lang-compact dropdown-toggle" type="button" id="mobileHeaderLangDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Language">
          <img src="<?= e($activeLangInfo['flag_img']) ?>" alt="<?= e($activeLangInfo['name']) ?>" class="nav-flag-img">
          <i class="bi bi-caret-down-fill nav-flag-caret"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end nav-lang-menu-compact shadow-lg border-0" aria-labelledby="mobileHeaderLangDropdown">
          <?php foreach ($enabledLangs as $code => $lang): ?>
            <li>
              <a class="dropdown-item nav-lang-item-compact <?= $activeLang === $code ? 'active-lang' : '' ?>" 
                 href="javascript:void(0);" 
                 onclick="switchSiteLanguage('<?= e($code) ?>', '<?= e($lang['name']) ?>')">
                <span class="d-flex align-items-center gap-2">
                  <img src="<?= e($lang['flag_img']) ?>" class="lang-flag-thumb" alt="<?= e($lang['name']) ?>">
                  <span><?= e($lang['name']) ?></span>
                </span>
                <?php if ($activeLang === $code): ?>
                  <i class="bi bi-check2 text-warning fw-bold fs-13"></i>
                <?php endif; ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <!-- Mobile Toggle Hamburger Button -->
    <button class="nav-toggle-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNavOffcanvas" aria-controls="mobileNavOffcanvas" aria-label="Toggle navigation">
      <i class="bi bi-list"></i>
    </button>
  </div>
</nav>

<!-- ════════════════════════════════
     MOBILE OFFCANVAS SIDEBAR (DYNAMIC)
════════════════════════════════ -->
<div class="offcanvas offcanvas-end mobile-offcanvas" tabindex="-1" id="mobileNavOffcanvas" aria-labelledby="mobileNavOffcanvasLabel">
  <div class="offcanvas-header">
    <div class="offcanvas-title" id="mobileNavOffcanvasLabel">
      <?php if (!empty($siteLogo)): ?>
        <img src="<?= e($siteLogo) ?>" alt="<?= e($companyName) ?>" style="max-height:34px; width:auto; object-fit:contain;">
      <?php else: ?>
        <div class="nav-logo" style="width:32px;height:32px;">
          <span class="nav-logo-gm" style="font-size:11px;">GM</span>
        </div>
        <span class="fw-bold" style="color:var(--gm-navy);font-size:16px;"><?= e($companyName) ?></span>
      <?php endif; ?>
    </div>
    <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column justify-content-between p-4">
    <div>
      <?php if ($isMultilangEnabled && ($langSwitcherPos === 'header' || $langSwitcherPos === 'both') && !empty($enabledLangs)): ?>
        <div class="mobile-lang-bar d-flex align-items-center justify-content-between mb-3">
          <div class="d-flex align-items-center gap-2">
            <img src="<?= e($activeLangInfo['flag_img']) ?>" width="20" height="14" class="rounded-1 shadow-xs" style="object-fit:cover;">
            <span class="fs-12 fw-bold text-dark"><?= e($activeLangInfo['name']) ?></span>
          </div>
          <div class="dropdown">
            <button class="btn btn-xs btn-outline-dark dropdown-toggle py-1 px-2 fs-11" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Change
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border py-1" style="min-width:170px; max-height:260px; overflow-y:auto;">
              <?php foreach ($enabledLangs as $code => $lang): ?>
                <li>
                  <a class="dropdown-item d-flex align-items-center gap-2 py-1.5 fs-12 <?= $activeLang === $code ? 'active fw-bold' : '' ?>"
                     href="javascript:void(0);"
                     onclick="switchSiteLanguage('<?= e($code) ?>', '<?= e($lang['name']) ?>')">
                    <img src="<?= e($lang['flag_img']) ?>" width="16" height="11" class="rounded-1" style="object-fit:cover;">
                    <span><?= e($lang['name']) ?></span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>

      <div class="mobile-nav-links">
        <?php foreach ($renderHeaderMenu as $item): ?>
          <a href="<?= e($item['url']) ?>" class="mobile-nav-link" target="<?= e($item['target'] ?: '_self') ?>">
            <span><?= e($item['title']) ?></span>
            <?php if (!empty($item['badge'])): ?>
              <span class="badge bg-warning text-dark fs-10 ms-auto"><?= e($item['badge']) ?></span>
            <?php endif; ?>
          </a>
          <?php if (!empty($item['children'])): ?>
            <div class="ms-3 ps-2 border-start">
              <?php foreach ($item['children'] as $child): ?>
                <a href="<?= e($child['url']) ?>" class="mobile-nav-link py-1 fs-13" target="<?= e($child['target'] ?: '_self') ?>">
                  <span><?= e($child['title']) ?></span>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="mobile-offcanvas-contact mt-4">
      <div class="p-3 rounded-3 mb-3" style="background:var(--gm-off-white); border:1px solid #EAE6DB;">
        <div class="fs-12 fw-bold text-uppercase mb-2" style="color:var(--gm-soft-gold); letter-spacing:0.8px;">Direct Support</div>
        <div class="fs-13 fw-semibold text-truncate mb-1" style="color:var(--gm-navy);">
          <i class="bi bi-telephone-fill text-warning me-2"></i><?= e(setting('contact_phone', '+971 56 324 0319')) ?>
        </div>
        <div class="fs-13 fw-semibold text-truncate" style="color:var(--gm-navy);">
          <i class="bi bi-envelope-fill text-warning me-2"></i><?= e(setting('contact_email', 'info@goldmatrixerp.com')) ?>
        </div>
      </div>
      <a href="#bookDemoModal" data-bs-toggle="modal" data-bs-target="#bookDemoModal" class="btn btn-gold-solid w-100 justify-content-center py-2 open-demo-modal" data-bs-dismiss="offcanvas">
        <span>Book Free Demo</span>
        <i class="bi bi-arrow-right ms-2"></i>
      </a>
    </div>
  </div>
</div>

<!-- ════════════════════════════════
     TRANSLATION LOGIC & SCRIPTS
════════════════════════════════ -->
<script>
function googleTranslateElementInit() {
  if (typeof google !== 'undefined' && google.translate) {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: '<?= implode(',', array_keys($enabledLangs)) ?>',
      autoDisplay: false
    }, 'google_translate_element');
  }
}

function setCookie(name, value, days) {
  let expires = "";
  if (days) {
    let date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
  let host = window.location.hostname;
  if (host && host.indexOf('.') !== -1 && !host.startsWith('127.') && host !== 'localhost') {
    document.cookie = name + "=" + (value || "") + expires + "; domain=." + host + "; path=/";
  }
}

function eraseCookie(name) {   
  document.cookie = name + '=; Max-Age=-99999999; path=/;';  
  let host = window.location.hostname;
  if (host && host.indexOf('.') !== -1 && !host.startsWith('127.') && host !== 'localhost') {
    document.cookie = name + '=; Max-Age=-99999999; domain=.' + host + '; path=/;';
  }
}

function switchSiteLanguage(langCode, langName) {
  setCookie('site_lang', langCode, 365);
  
  if (langCode === 'en') {
    eraseCookie('googtrans');
    setCookie('googtrans', '/en/en', 365);
  } else {
    setCookie('googtrans', '/en/' + langCode, 365);
  }

  let url = new URL(window.location.href);
  if (langCode === 'en') {
    url.searchParams.delete('lang');
  } else {
    url.searchParams.set('lang', langCode);
  }
  window.location.href = url.toString();
}

<?php if (setting('enable_auto_browser_detect', '1') == '1'): ?>
document.addEventListener('DOMContentLoaded', function() {
  const hasLangCookie = document.cookie.split(';').some(item => item.trim().startsWith('site_lang='));
  const urlHasLang = new URLSearchParams(window.location.search).has('lang');
  
  if (!hasLangCookie && !urlHasLang) {
    const userNavLang = (navigator.language || navigator.userLanguage || '').toLowerCase();
    const supported = <?= json_encode(array_keys($enabledLangs)) ?>;
    
    let matched = null;
    if (userNavLang.startsWith('ar') && supported.includes('ar')) matched = 'ar';
    else if (userNavLang.startsWith('hi') && supported.includes('hi')) matched = 'hi';
    else if (userNavLang.startsWith('gu') && supported.includes('gu')) matched = 'gu';
    else if (userNavLang.startsWith('ta') && supported.includes('ta')) matched = 'ta';
    else if (userNavLang.startsWith('fr') && supported.includes('fr')) matched = 'fr';
    else if (userNavLang.startsWith('es') && supported.includes('es')) matched = 'es';
    else if (userNavLang.startsWith('de') && supported.includes('de')) matched = 'de';
    else if (userNavLang.startsWith('ru') && supported.includes('ru')) matched = 'ru';
    else if (userNavLang.startsWith('zh') && supported.includes('zh-CN')) matched = 'zh-CN';
    
    if (matched && matched !== 'en') {
      switchSiteLanguage(matched, matched);
    }
  }
});
<?php endif; ?>
</script>
<?php if (setting('enable_google_translate', '1') == '1'): ?>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" async defer></script>
<?php endif; ?>
