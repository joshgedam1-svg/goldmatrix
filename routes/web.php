<?php
use App\Controllers\FrontendController;

/** @var App\Services\Router $router */

// Public Website Homepage
$router->get('/', [FrontendController::class, 'home']);

// ── SOLUTIONS ──
$router->get('/solutions',                         [FrontendController::class, 'solutionsIndex']);
$router->get('/solutions/jewellery-retail',        [FrontendController::class, 'solutionRetail']);
$router->get('/solutions/jewellery-wholesale',     [FrontendController::class, 'solutionWholesale']);
$router->get('/solutions/jewellery-manufacturing', [FrontendController::class, 'solutionManufacturing']);

// ── FEATURES ──
$router->get('/features',                          [FrontendController::class, 'features']);
$router->get('/feature',                           [FrontendController::class, 'features']);
$router->get('/features/{slug}',                   [FrontendController::class, 'featureModule']);
$router->get('/features/pos-inventory',            [FrontendController::class, 'featurePosInventory']);
$router->get('/features/manufacturing-jobwork',    [FrontendController::class, 'featureManufacturingJobwork']);
$router->get('/features/accounting-gst',           [FrontendController::class, 'featureAccountingGst']);
$router->get('/features/gold-diamond-management',  [FrontendController::class, 'featureGoldDiamond']);
$router->get('/features/crm-rfid-barcode',         [FrontendController::class, 'featureCrmRfid']);

// ── INDUSTRIES ──
$router->get('/industries',                        [FrontendController::class, 'industries']);
$router->get('/industries/jewellery-business',     [FrontendController::class, 'industries']);

// ── INTEGRATIONS ──
$router->get('/integrations',                      [FrontendController::class, 'integrations']);

// ── REQUEST DEMO ──
$router->get('/request-demo',                      [FrontendController::class, 'requestDemo']);

// ── Legacy Service Pages (keep for backwards compat) ──
$router->get('/services',          [FrontendController::class, 'servicesIndex']);
$router->get('/services/{slug}',   [FrontendController::class, 'serviceDetail']);

// ── Key Website Pages ──
$router->get('/why-us',                [FrontendController::class, 'whyUs']);
$router->get('/why-choose-us',         [FrontendController::class, 'whyUs']);
$router->get('/why-choose-goldmatrix', [FrontendController::class, 'whyUs']);

$router->get('/testimonials',          [FrontendController::class, 'testimonials']);
$router->get('/reviews',               [FrontendController::class, 'testimonials']);
$router->get('/customer-reviews',      [FrontendController::class, 'testimonials']);

$router->get('/about',    [FrontendController::class, 'about']);
$router->get('/about-us', [FrontendController::class, 'about']);

$router->get('/contact',    [FrontendController::class, 'contact']);
$router->get('/contact-us', [FrontendController::class, 'contact']);

$router->get('/terms',                 [FrontendController::class, 'terms']);
$router->get('/terms-and-conditions',  [FrontendController::class, 'terms']);
$router->get('/terms-of-service',      [FrontendController::class, 'terms']);

$router->get('/privacy',               [FrontendController::class, 'privacy']);
$router->get('/privacy-policy',        [FrontendController::class, 'privacy']);

// ── Blog Routes ──
$router->get('/blog',                    [FrontendController::class, 'blogIndex']);
$router->get('/blog/category/{slug}',    [FrontendController::class, 'blogCategory']);
$router->get('/blog/{slug}',             [FrontendController::class, 'blogPost']);

// ── API Endpoints ──
$router->post('/api/contact-lead',  [FrontendController::class, 'submitLead']);
$router->post('/api/demo-request',  [FrontendController::class, 'submitDemo']);

// ── SEO & Robots ──
$router->get('/sitemap.xml',        [FrontendController::class, 'sitemapXml']);
$router->get('/robots.txt',         [FrontendController::class, 'robotsTxt']);

