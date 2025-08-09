-- SQL Script لتحديث slugs للمشاريع الموجودة
-- نسخ واستخدم هذا في phpMyAdmin بعد تشغيل Migration

-- تحديث المشروع الأول: 4P App
UPDATE projects SET slug = '4p-app' WHERE id = 1;

-- تحديث المشروع الثاني: Portfolio Website  
UPDATE projects SET slug = 'portfolio-website' WHERE id = 2;

-- تحديث المشروع الثالث: E-commerce Platform
UPDATE projects SET slug = 'e-commerce-platform' WHERE id = 3;

-- تحديث المشروع الرابع: Mobile Banking App
UPDATE projects SET slug = 'mobile-banking-app' WHERE id = 4;

-- تحديث المشروع الخامس: Real Estate Platform
UPDATE projects SET slug = 'real-estate-platform' WHERE id = 5;

-- تحديث المشروع السادس: Learning Management System
UPDATE projects SET slug = 'learning-management-system' WHERE id = 6;

-- إضافة أمثلة SEO Meta Data (اختياري)
UPDATE projects SET 
    meta_description_en = 'Comprehensive mobile application providing deals, discounts, and services across multiple categories.',
    meta_description_ar = 'تطبيق جوال شامل يوفر عروض وخصومات وخدمات عبر فئات متعددة.',
    meta_keywords_en = 'mobile app, deals, discounts, services, shopping',
    meta_keywords_ar = 'تطبيق جوال, عروض, خصومات, خدمات, تسوق'
WHERE id = 1;

UPDATE projects SET 
    meta_description_en = 'Professional portfolio website showcasing projects, skills, and experience.',
    meta_description_ar = 'موقع بورتفوليو احترافي يعرض المشاريع والمهارات والخبرة.',
    meta_keywords_en = 'portfolio, web development, projects, skills',
    meta_keywords_ar = 'بورتفوليو, تطوير ويب, مشاريع, مهارات'
WHERE id = 2;

-- تحقق من النتائج
SELECT id, title_en, slug, meta_description_en FROM projects;
