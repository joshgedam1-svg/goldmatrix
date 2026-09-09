-- ============================================================
-- GoldMatrix Jewelry ERP CMS - Complete Database Schema (MySQL 8+)
-- Database: jewelry_erp_cms
-- ============================================================

CREATE DATABASE IF NOT EXISTS `jewelry_erp_cms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `jewelry_erp_cms`;

SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------
-- 1. USERS & ROLES
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `role_permissions`;
DROP TABLE IF EXISTS `permissions`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `slug` VARCHAR(50) NOT NULL UNIQUE,
  `description` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissions` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `module` VARCHAR(50) NOT NULL,
  `action` VARCHAR(50) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `role_permissions` (
  `role_id` INT UNSIGNED NOT NULL,
  `permission_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `permission_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role_id` INT UNSIGNED NOT NULL,
  `status` ENUM('active', 'inactive', 'suspended') NOT NULL DEFAULT 'active',
  `remember_token` VARCHAR(100) NULL,
  `last_login` DATETIME NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT,
  INDEX `idx_users_email` (`email`),
  INDEX `idx_users_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 2. MEDIA LIBRARY
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `filename` VARCHAR(255) NOT NULL,
  `original_name` VARCHAR(255) NOT NULL,
  `mime_type` VARCHAR(100) NOT NULL,
  `file_size` INT UNSIGNED NOT NULL,
  `path` VARCHAR(500) NOT NULL,
  `width` INT UNSIGNED NULL,
  `height` INT UNSIGNED NULL,
  `alt_text` VARCHAR(255) NULL,
  `title` VARCHAR(255) NULL,
  `caption` TEXT NULL,
  `uploaded_by` INT UNSIGNED NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  INDEX `idx_media_mime` (`mime_type`),
  INDEX `idx_media_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 3. PAGES & SECTIONS
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `page_revisions`;
DROP TABLE IF EXISTS `page_sections`;
DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `template` VARCHAR(100) NOT NULL DEFAULT 'default',
  `status` ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'draft',
  `featured_image_id` INT UNSIGNED NULL,
  `excerpt` TEXT NULL,
  `created_by` INT UNSIGNED NULL,
  `updated_by` INT UNSIGNED NULL,
  `published_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  FOREIGN KEY (`featured_image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  INDEX `idx_pages_slug` (`slug`),
  INDEX `idx_pages_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `page_sections` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `page_id` INT UNSIGNED NOT NULL,
  `section_type` VARCHAR(100) NOT NULL,
  `position` INT NOT NULL DEFAULT 0,
  `content` JSON NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  INDEX `idx_page_sections_page` (`page_id`, `position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `page_revisions` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `page_id` INT UNSIGNED NOT NULL,
  `content` LONGTEXT NOT NULL,
  `created_by` INT UNSIGNED NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 4. ERP MODULES & FEATURES
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `features`;
DROP TABLE IF EXISTS `erp_modules`;

CREATE TABLE `erp_modules` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `short_description` TEXT NULL,
  `full_description` LONGTEXT NULL,
  `icon` VARCHAR(100) NULL,
  `featured_image_id` INT UNSIGNED NULL,
  `benefits` JSON NULL,
  `status` ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'published',
  `display_order` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`featured_image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  INDEX `idx_erp_modules_slug` (`slug`),
  INDEX `idx_erp_modules_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `features` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `short_description` TEXT NULL,
  `full_description` LONGTEXT NULL,
  `icon` VARCHAR(100) NULL,
  `image_id` INT UNSIGNED NULL,
  `module_id` INT UNSIGNED NULL,
  `benefits` JSON NULL,
  `status` ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'published',
  `display_order` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`module_id`) REFERENCES `erp_modules` (`id`) ON DELETE SET NULL,
  INDEX `idx_features_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 5. SERVICES & INDUSTRIES
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `services`;
DROP TABLE IF EXISTS `industries`;

CREATE TABLE `services` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `short_description` TEXT NULL,
  `full_description` LONGTEXT NULL,
  `featured_image_id` INT UNSIGNED NULL,
  `icon` VARCHAR(100) NULL,
  `benefits` JSON NULL,
  `process` JSON NULL,
  `cta_text` VARCHAR(100) NULL,
  `cta_url` VARCHAR(255) NULL,
  `status` ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'published',
  `display_order` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`featured_image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  INDEX `idx_services_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `industries` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `short_description` TEXT NULL,
  `full_description` LONGTEXT NULL,
  `image_id` INT UNSIGNED NULL,
  `benefits` JSON NULL,
  `status` ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'published',
  `display_order` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  INDEX `idx_industries_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 6. CASE STUDIES & TESTIMONIALS & FAQS & TEAM
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `case_study_images`;
DROP TABLE IF EXISTS `case_studies`;
DROP TABLE IF EXISTS `testimonials`;
DROP TABLE IF EXISTS `faqs`;
DROP TABLE IF EXISTS `team_members`;

CREATE TABLE `case_studies` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `client_name` VARCHAR(150) NOT NULL,
  `industry_id` INT UNSIGNED NULL,
  `location` VARCHAR(150) NULL,
  `short_description` TEXT NULL,
  `challenge` LONGTEXT NULL,
  `solution` LONGTEXT NULL,
  `implementation` LONGTEXT NULL,
  `results` LONGTEXT NULL,
  `featured_image_id` INT UNSIGNED NULL,
  `testimonial_quote` TEXT NULL,
  `status` ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'published',
  `published_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`industry_id`) REFERENCES `industries` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`featured_image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  INDEX `idx_case_studies_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `case_study_images` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `case_study_id` INT UNSIGNED NOT NULL,
  `media_id` INT UNSIGNED NOT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  FOREIGN KEY (`case_study_id`) REFERENCES `case_studies` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `testimonials` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `customer_name` VARCHAR(150) NOT NULL,
  `designation` VARCHAR(100) NULL,
  `company` VARCHAR(150) NULL,
  `photo_id` INT UNSIGNED NULL,
  `testimonial` TEXT NOT NULL,
  `rating` TINYINT UNSIGNED NOT NULL DEFAULT 5,
  `industry` VARCHAR(100) NULL,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `display_order` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`photo_id`) REFERENCES `media` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `faqs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `question` VARCHAR(255) NOT NULL,
  `answer` TEXT NOT NULL,
  `category` VARCHAR(100) NOT NULL DEFAULT 'General',
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `display_order` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `team_members` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `designation` VARCHAR(150) NOT NULL,
  `photo_id` INT UNSIGNED NULL,
  `short_bio` TEXT NULL,
  `linkedin_url` VARCHAR(255) NULL,
  `email` VARCHAR(150) NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`photo_id`) REFERENCES `media` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 7. BLOG MODULE
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `blog_post_tags`;
DROP TABLE IF EXISTS `blog_tags`;
DROP TABLE IF EXISTS `blog_posts`;
DROP TABLE IF EXISTS `blog_categories`;

CREATE TABLE `blog_categories` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `parent_id` INT UNSIGNED NULL,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`parent_id`) REFERENCES `blog_categories` (`id`) ON DELETE SET NULL,
  INDEX `idx_blog_cat_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_posts` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `excerpt` TEXT NULL,
  `content` LONGTEXT NOT NULL,
  `featured_image_id` INT UNSIGNED NULL,
  `category_id` INT UNSIGNED NULL,
  `author_id` INT UNSIGNED NULL,
  `status` ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'draft',
  `published_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  FOREIGN KEY (`featured_image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  INDEX `idx_blog_posts_slug` (`slug`),
  INDEX `idx_blog_posts_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_tags` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `slug` VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_post_tags` (
  `post_id` INT UNSIGNED NOT NULL,
  `tag_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`post_id`, `tag_id`),
  FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tag_id`) REFERENCES `blog_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 8. SEO & REDIRECTS
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `seo_metadata`;
DROP TABLE IF EXISTS `redirects`;

CREATE TABLE `seo_metadata` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `entity_type` VARCHAR(50) NOT NULL,
  `entity_id` INT UNSIGNED NOT NULL,
  `seo_title` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `canonical_url` VARCHAR(255) NULL,
  `robots_index` ENUM('index', 'noindex') NOT NULL DEFAULT 'index',
  `robots_follow` ENUM('follow', 'nofollow') NOT NULL DEFAULT 'follow',
  `og_title` VARCHAR(255) NULL,
  `og_description` TEXT NULL,
  `og_image_id` INT UNSIGNED NULL,
  `twitter_title` VARCHAR(255) NULL,
  `twitter_description` TEXT NULL,
  `twitter_image_id` INT UNSIGNED NULL,
  `schema_type` VARCHAR(100) NOT NULL DEFAULT 'WebPage',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`og_image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`twitter_image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  UNIQUE KEY `idx_entity_seo` (`entity_type`, `entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `redirects` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `old_url` VARCHAR(255) NOT NULL UNIQUE,
  `new_url` VARCHAR(255) NOT NULL,
  `redirect_type` SMALLINT NOT NULL DEFAULT 301,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_redirects_old` (`old_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 9. LEADS & DEMO REQUESTS
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `leads`;
DROP TABLE IF EXISTS `demo_requests`;

CREATE TABLE `leads` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `company` VARCHAR(150) NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(50) NULL,
  `country` VARCHAR(100) NULL,
  `message` TEXT NULL,
  `source` VARCHAR(100) NOT NULL DEFAULT 'Contact Form',
  `page_url` VARCHAR(255) NULL,
  `utm_source` VARCHAR(100) NULL,
  `utm_medium` VARCHAR(100) NULL,
  `utm_campaign` VARCHAR(100) NULL,
  `status` ENUM('new', 'contacted', 'qualified', 'demo_scheduled', 'converted', 'lost') NOT NULL DEFAULT 'new',
  `notes` TEXT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_leads_email` (`email`),
  INDEX `idx_leads_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `demo_requests` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `company` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `country` VARCHAR(100) NULL,
  `business_type` VARCHAR(100) NULL,
  `number_of_branches` VARCHAR(50) NULL,
  `current_software` VARCHAR(150) NULL,
  `requirements` TEXT NULL,
  `preferred_date` DATE NULL,
  `preferred_time` VARCHAR(50) NULL,
  `source` VARCHAR(100) NOT NULL DEFAULT 'Demo Form',
  `status` ENUM('new', 'contacted', 'scheduled', 'completed', 'converted', 'cancelled') NOT NULL DEFAULT 'new',
  `notes` TEXT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_demo_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 10. MENUS & SETTINGS & SYSTEM LOGS
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `menu_items`;
DROP TABLE IF EXISTS `menus`;
DROP TABLE IF EXISTS `settings`;
DROP TABLE IF EXISTS `activity_logs`;

CREATE TABLE `menus` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `location` VARCHAR(100) NOT NULL UNIQUE,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `menu_items` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `menu_id` INT UNSIGNED NOT NULL,
  `label` VARCHAR(100) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `parent_id` INT UNSIGNED NULL,
  `position` INT NOT NULL DEFAULT 0,
  `target` VARCHAR(20) NOT NULL DEFAULT '_self',
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `settings` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `group_name` VARCHAR(50) NOT NULL DEFAULT 'general',
  `setting_key` VARCHAR(100) NOT NULL UNIQUE,
  `setting_value` TEXT NULL,
  `label` VARCHAR(150) NOT NULL,
  `type` VARCHAR(30) NOT NULL DEFAULT 'text',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_settings_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `activity_logs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NULL,
  `action` VARCHAR(100) NOT NULL,
  `module` VARCHAR(100) NOT NULL,
  `record_id` INT UNSIGNED NULL,
  `description` TEXT NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  INDEX `idx_logs_module` (`module`),
  INDEX `idx_logs_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- SEED DATA
-- ------------------------------------------------------------

-- Insert Roles
INSERT INTO `roles` (`id`, `name`, `slug`, `description`) VALUES
(1, 'Super Admin', 'super-admin', 'Full access to all system features'),
(2, 'Admin', 'admin', 'Manage content, leads, and website configuration'),
(3, 'Editor', 'editor', 'Manage pages, ERP content, and blog posts'),
(4, 'SEO Manager', 'seo-manager', 'Manage SEO metadata, sitemap, and redirects'),
(5, 'Author', 'author', 'Create and manage own blog posts');

-- Insert Initial Permissions
INSERT INTO `permissions` (`module`, `action`, `slug`, `description`) VALUES
('pages', 'view', 'pages.view', 'View pages list'),
('pages', 'create', 'pages.create', 'Create new page'),
('pages', 'edit', 'pages.edit', 'Edit existing page'),
('pages', 'delete', 'pages.delete', 'Delete page'),
('pages', 'publish', 'pages.publish', 'Publish or unpublish page'),

('erp_modules', 'view', 'erp_modules.view', 'View ERP modules'),
('erp_modules', 'manage', 'erp_modules.manage', 'Create/Edit/Delete ERP modules'),

('blog', 'view', 'blog.view', 'View blog posts'),
('blog', 'create', 'blog.create', 'Create blog posts'),
('blog', 'edit', 'blog.edit', 'Edit blog posts'),
('blog', 'delete', 'blog.delete', 'Delete blog posts'),
('blog', 'publish', 'blog.publish', 'Publish blog posts'),

('seo', 'view', 'seo.view', 'View SEO settings'),
('seo', 'edit', 'seo.edit', 'Edit SEO settings'),

('leads', 'view', 'leads.view', 'View leads and demo requests'),
('leads', 'manage', 'leads.manage', 'Edit status and export leads'),

('users', 'view', 'users.view', 'View admin users'),
('users', 'manage', 'users.manage', 'Create, edit, delete users and roles'),

('settings', 'manage', 'settings.manage', 'Manage global site settings');

-- Assign permissions to Super Admin (Role ID = 1)
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 1, `id` FROM `permissions`;

-- Default Super Admin User (Password: Admin@123)
-- Hash generated using password_hash('Admin@123', PASSWORD_BCRYPT)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `status`) VALUES
(1, 'Super Administrator', 'admin@example.com', '$2y$10$VG6L2GFrnx.lyBwPvwML6OZmgbWD/KnOWiR/DFc13Bmus3jlXgqFi', 1, 'active');

-- Default Settings
INSERT INTO `settings` (`group_name`, `setting_key`, `setting_value`, `label`, `type`) VALUES
('general', 'site_title', 'GoldMatrix Jewelry ERP Software', 'Site Title', 'text'),
('general', 'site_tagline', 'Next-Gen Enterprise Jewelry ERP Solution', 'Site Tagline', 'text'),
('general', 'company_name', 'GoldMatrix Software Technologies', 'Company Name', 'text'),
('general', 'contact_email', 'info@goldmatrixerp.com', 'Contact Email', 'email'),
('general', 'contact_phone', '+91 98765 43210', 'Contact Phone', 'text'),
('general', 'whatsapp_number', '+91 98765 43210', 'WhatsApp Number', 'text'),
('general', 'address', '402 Gold Business Park, Diamond Harbour Road, Surat, Gujarat - 395006', 'Company Address', 'textarea'),
('general', 'copyright_text', '© 2026 GoldMatrix Software Technologies. All Rights Reserved.', 'Footer Copyright Text', 'text'),
('seo', 'default_seo_title', 'Jewelry ERP Software | GoldMatrix ERP', 'Default SEO Title', 'text'),
('seo', 'default_meta_description', 'Complete enterprise Jewelry ERP software for inventory, jobwork manufacturing, sales, bullion trading, accounting, and multi-branch management.', 'Default Meta Description', 'textarea'),
('seo', 'default_robots', 'index, follow', 'Default Robots Directive', 'text');

SET FOREIGN_KEY_CHECKS = 1;
