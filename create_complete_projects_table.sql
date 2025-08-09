-- SQL لإنشاء جدول projects كامل مع slug و SEO
-- استخدم هذا في phpMyAdmin على السيرفر

-- حذف الجدول القديم إذا كان موجود (احرص على backup أولاً!)
-- DROP TABLE IF EXISTS projects;

-- إنشاء جدول projects جديد مع جميع الحقول
CREATE TABLE projects (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    slug VARCHAR(255) NOT NULL UNIQUE,
    title_ar VARCHAR(255) NOT NULL,
    title_en VARCHAR(255) NOT NULL,
    description_ar TEXT NULL,
    description_en TEXT NULL,
    meta_description_ar TEXT NULL,
    meta_description_en TEXT NULL,
    meta_keywords_ar TEXT NULL,
    meta_keywords_en TEXT NULL,
    website_link VARCHAR(255) NULL,
    google_play_link VARCHAR(255) NULL,
    app_store_link VARCHAR(255) NULL,
    github_link VARCHAR(255) NULL,
    experience_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    INDEX idx_projects_slug (slug),
    INDEX idx_projects_experience_id (experience_id),
    CONSTRAINT fk_projects_experience_id 
        FOREIGN KEY (experience_id) 
        REFERENCES experiences(id) 
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- إدراج بيانات المشاريع مع slugs
INSERT INTO projects (
    id, slug, title_ar, title_en, 
    description_ar, description_en,
    meta_description_ar, meta_description_en,
    meta_keywords_ar, meta_keywords_en,
    website_link, google_play_link, app_store_link, github_link,
    experience_id, created_at, updated_at
) VALUES 
(1, '4p-app', 'تطبيق 4P', '4P App', 
 'تطبيق جوال شامل يوفر عروض وخصومات وخدمات عبر فئات متعددة', 
 'Comprehensive mobile application providing deals, discounts, and services across multiple categories',
 'تطبيق جوال شامل يوفر عروض وخصومات وخدمات عبر فئات متعددة',
 'Comprehensive mobile application providing deals, discounts, and services across multiple categories',
 'تطبيق جوال, عروض, خصومات, خدمات, تسوق',
 'mobile app, deals, discounts, services, shopping',
 NULL, 'https://play.google.com/store/apps/details?id=com.4p.app', NULL, NULL,
 1, NOW(), NOW()),

(2, 'portfolio-website', 'موقع البورتفوليو', 'Portfolio Website',
 'موقع بورتفوليو احترافي يعرض المشاريع والمهارات والخبرة',
 'Professional portfolio website showcasing projects, skills, and experience',
 'موقع بورتفوليو احترافي يعرض المشاريع والمهارات والخبرة',
 'Professional portfolio website showcasing projects, skills, and experience',
 'بورتفوليو, تطوير ويب, مشاريع, مهارات',
 'portfolio, web development, projects, skills',
 'https://example.com', NULL, NULL, 'https://github.com/username/portfolio',
 2, NOW(), NOW()),

(3, 'e-commerce-platform', 'منصة التجارة الإلكترونية', 'E-commerce Platform',
 'منصة تجارة إلكترونية شاملة للبيع والشراء عبر الإنترنت',
 'Comprehensive e-commerce platform for online buying and selling',
 'منصة تجارة إلكترونية شاملة للبيع والشراء عبر الإنترنت',
 'Comprehensive e-commerce platform for online buying and selling',
 'تجارة إلكترونية, متجر إلكتروني, بيع, شراء',
 'e-commerce, online store, selling, buying',
 'https://ecommerce-example.com', NULL, NULL, NULL,
 3, NOW(), NOW());

-- تحقق من النتائج
SELECT id, slug, title_en, meta_description_en FROM projects;
