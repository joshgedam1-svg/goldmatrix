<?php
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\HomepageController;
use App\Controllers\Admin\LeadsController;
use App\Controllers\Admin\NavigationController;
use App\Controllers\Admin\SettingsController;
use App\Controllers\Admin\BlogController;
use App\Middleware\AuthMiddleware;
use App\Middleware\CsrfMiddleware;

/** @var App\Services\Router $router */

// ── Authentication Routes ──
$router->get('/admin/login',  [AuthController::class, 'showLogin']);
$router->post('/admin/login', [AuthController::class, 'login']);
$router->get('/admin/logout', [AuthController::class, 'logout']);

// ── Dashboard ──
$router->get('/admin',           [DashboardController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/dashboard', [DashboardController::class, 'index'], [AuthMiddleware::class]);

// ── Pages & CMS ──
$router->get('/admin/pages',             [\App\Controllers\Admin\PagesController::class, 'index'],      [AuthMiddleware::class]);
$router->get('/admin/pages/create',      [\App\Controllers\Admin\PagesController::class, 'create'],     [AuthMiddleware::class]);
$router->post('/admin/pages/create',     [\App\Controllers\Admin\PagesController::class, 'store'],      [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/pages/edit',        [\App\Controllers\Admin\PagesController::class, 'edit'],       [AuthMiddleware::class]);
$router->post('/admin/pages/edit',       [\App\Controllers\Admin\PagesController::class, 'update'],     [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/pages/save-item',   [\App\Controllers\Admin\PagesController::class, 'saveItem'],   [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/pages/delete-item', [\App\Controllers\Admin\PagesController::class, 'deleteItem'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/pages/delete',     [\App\Controllers\Admin\PagesController::class, 'delete'],     [AuthMiddleware::class, CsrfMiddleware::class]);

$router->get('/admin/homepage',       [HomepageController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/homepage',      [HomepageController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/contact',        [\App\Controllers\Admin\ContactPageController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/contact',       [\App\Controllers\Admin\ContactPageController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/about-settings', [\App\Controllers\Admin\AboutPageController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/about-settings',[\App\Controllers\Admin\AboutPageController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/about/settings', [\App\Controllers\Admin\AboutPageController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/about/settings',[\App\Controllers\Admin\AboutPageController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/legal-settings', [\App\Controllers\Admin\LegalPageController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/legal-settings',[\App\Controllers\Admin\LegalPageController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/legal/settings', [\App\Controllers\Admin\LegalPageController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/legal/settings',[\App\Controllers\Admin\LegalPageController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/navigation',     [NavigationController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/navigation',    [NavigationController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);

// ── Feature Pages Management ──
$router->get('/admin/features-settings',  [\App\Controllers\Admin\FeaturesPageController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/features-settings', [\App\Controllers\Admin\FeaturesPageController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/features/settings',  [\App\Controllers\Admin\FeaturesPageController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/features/settings', [\App\Controllers\Admin\FeaturesPageController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/features',           [\App\Controllers\Admin\ErpModulesController::class, 'index'],  [AuthMiddleware::class]);
$router->get('/admin/features/create',    [\App\Controllers\Admin\ErpModulesController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/features/store',    [\App\Controllers\Admin\ErpModulesController::class, 'store'],  [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/features/edit',      [\App\Controllers\Admin\ErpModulesController::class, 'edit'],   [AuthMiddleware::class]);
$router->post('/admin/features/update',   [\App\Controllers\Admin\ErpModulesController::class, 'update'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/features/delete',   [\App\Controllers\Admin\ErpModulesController::class, 'delete'], [AuthMiddleware::class, CsrfMiddleware::class]);

// Backwards compatibility aliases for erp-modules
$router->get('/admin/erp-modules',        [\App\Controllers\Admin\ErpModulesController::class, 'index'],  [AuthMiddleware::class]);
$router->get('/admin/erp-modules/create', [\App\Controllers\Admin\ErpModulesController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/erp-modules/store', [\App\Controllers\Admin\ErpModulesController::class, 'store'],  [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/erp-modules/edit',   [\App\Controllers\Admin\ErpModulesController::class, 'edit'],   [AuthMiddleware::class]);
$router->post('/admin/erp-modules/update',[\App\Controllers\Admin\ErpModulesController::class, 'update'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/erp-modules/delete',[\App\Controllers\Admin\ErpModulesController::class, 'delete'], [AuthMiddleware::class, CsrfMiddleware::class]);

// ── Blog Management ──
$router->get('/admin/blog',                 [BlogController::class, 'index'],      [AuthMiddleware::class]);
$router->get('/admin/blog/create',          [BlogController::class, 'create'],     [AuthMiddleware::class]);
$router->post('/admin/blog/store',          [BlogController::class, 'store'],      [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/blog/edit',            [BlogController::class, 'edit'],       [AuthMiddleware::class]);
$router->post('/admin/blog/update',         [BlogController::class, 'update'],     [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/blog/delete',         [BlogController::class, 'delete'],     [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/blog/upload-image',   [BlogController::class, 'uploadEditorImage'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/categories',           [BlogController::class, 'categories'], [AuthMiddleware::class]);
$router->post('/admin/categories',          [BlogController::class, 'categories'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/blog/categories',      [BlogController::class, 'categories'], [AuthMiddleware::class]);
$router->post('/admin/blog/categories',     [BlogController::class, 'categories'], [AuthMiddleware::class, CsrfMiddleware::class]);

// ── Content Management (Testimonials, FAQs, Team) ──
$router->get('/admin/testimonials',         [HomepageController::class, 'testimonials'], [AuthMiddleware::class]);
$router->post('/admin/testimonials',        [HomepageController::class, 'testimonials'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/faqs',                 [HomepageController::class, 'faqs'],         [AuthMiddleware::class]);
$router->post('/admin/faqs',                [HomepageController::class, 'faqs'],         [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/team',                 [HomepageController::class, 'team'],         [AuthMiddleware::class]);
$router->post('/admin/team',                [HomepageController::class, 'team'],         [AuthMiddleware::class, CsrfMiddleware::class]);

// ── Leads & Demo Requests ──
$router->get('/admin/leads',          [LeadsController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/leads',         [LeadsController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/demo-requests',  [LeadsController::class, 'demos'], [AuthMiddleware::class]);
$router->post('/admin/demo-requests', [LeadsController::class, 'demos'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/leads/api-mark-all-read',   [LeadsController::class, 'apiMarkAllRead'],   [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/leads/api-mark-single-read', [LeadsController::class, 'apiMarkSingleRead'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/leads/api-update-status',    [LeadsController::class, 'apiUpdateStatus'],   [AuthMiddleware::class, CsrfMiddleware::class]);

// ── Global Settings & SEO ──
$router->get('/admin/settings',  [SettingsController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/settings', [SettingsController::class, 'index'], [AuthMiddleware::class, CsrfMiddleware::class]);

// ── Universal SEO & Webmaster Manager ──
$router->get('/admin/seo',        [\App\Controllers\Admin\SeoController::class, 'index'],     [AuthMiddleware::class]);
$router->post('/admin/seo',       [\App\Controllers\Admin\SeoController::class, 'index'],     [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/sitemap',    [\App\Controllers\Admin\SeoController::class, 'sitemap'],   [AuthMiddleware::class]);
$router->get('/admin/redirects',  [\App\Controllers\Admin\SeoController::class, 'redirects'], [AuthMiddleware::class]);

// ── System Administration (Users, Roles, Audit Logs) ──
$router->get('/admin/users',               [\App\Controllers\Admin\UsersController::class, 'index'],        [AuthMiddleware::class]);
$router->get('/admin/users/create',        [\App\Controllers\Admin\UsersController::class, 'create'],       [AuthMiddleware::class]);
$router->post('/admin/users/store',        [\App\Controllers\Admin\UsersController::class, 'store'],        [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/users/edit',          [\App\Controllers\Admin\UsersController::class, 'edit'],         [AuthMiddleware::class]);
$router->post('/admin/users/update',       [\App\Controllers\Admin\UsersController::class, 'update'],       [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/users/delete',       [\App\Controllers\Admin\UsersController::class, 'delete'],       [AuthMiddleware::class, CsrfMiddleware::class]);

$router->get('/admin/roles',               [\App\Controllers\Admin\RolesController::class, 'index'],        [AuthMiddleware::class]);
$router->get('/admin/roles/create',        [\App\Controllers\Admin\RolesController::class, 'create'],       [AuthMiddleware::class]);
$router->post('/admin/roles/store',        [\App\Controllers\Admin\RolesController::class, 'store'],        [AuthMiddleware::class, CsrfMiddleware::class]);
$router->get('/admin/roles/edit',          [\App\Controllers\Admin\RolesController::class, 'edit'],         [AuthMiddleware::class]);
$router->post('/admin/roles/update',       [\App\Controllers\Admin\RolesController::class, 'update'],       [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/admin/roles/delete',       [\App\Controllers\Admin\RolesController::class, 'delete'],       [AuthMiddleware::class, CsrfMiddleware::class]);

$router->get('/admin/activity-logs',       [\App\Controllers\Admin\ActivityLogsController::class, 'index'], [AuthMiddleware::class]);
$router->post('/admin/activity-logs/clear',[\App\Controllers\Admin\ActivityLogsController::class, 'clear'], [AuthMiddleware::class, CsrfMiddleware::class]);
