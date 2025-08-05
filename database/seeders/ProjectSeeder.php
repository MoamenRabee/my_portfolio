<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title_ar' => 'تطبيق 4P',
                'title_en' => '4P App',
                'description_ar' => 'تطبيق شامل للهاتف المحمول يوفر الصفقات والخصومات والخدمات عبر فئات متعددة. يشمل تكامل مقدمي الخدمات (المستشفيات، الصالات الرياضية، المؤسسات التعليمية). نظام إدارة الصفقات والخصومات مع التحديثات الفورية. نظام الأخبار والتحديثات للمستخدمين.',
                'description_en' => 'Comprehensive mobile application providing deals, discounts, and services across multiple categories. Features include service provider integrations (hospitals, gyms, educational institutions). Deal and discount management system with real-time updates. News and updates system for users.',
                'website_link' => null,
                'github_link' => null,
                'google_play_link' => 'https://play.google.com/store/apps/details?id=com.marketopia.fourP',
                'app_store_link' => 'https://apps.apple.com/eg/app/4p/id6743159334',
                'skills' => [2, 20, 18] // Flutter, REST APIs, Authentication
            ],
            [
                'title_ar' => 'الأكاديمية الأولى أونلاين',
                'title_en' => 'First Online Academy',
                'description_ar' => 'منصة تعليمية تعرض الدروس في شكل مقاطع فيديو واختبارات إلكترونية وعروض ملفات. تشمل الميزات منع تسجيل الشاشة لحماية المحتوى وتصميم واجهة مستخدم جذاب.',
                'description_en' => 'Educational platform displaying lessons in the form of videos, electronic tests, and file presentations. Features include screen recording prevention for content protection and attractive user interface design.',
                'website_link' => null,
                'github_link' => null,
                'google_play_link' => 'https://play.google.com/store/apps/details?id=com.firstonlineacademy',
                'app_store_link' => 'https://apps.apple.com/app/first-online-academy',
                'skills' => [2, 5, 6, 18, 27] // Flutter, GetX, Firebase, REST APIs, Push Notifications
            ],
            [
                'title_ar' => 'تطبيق الرعاية المنزلية',
                'title_en' => 'HomeCare App',
                'description_ar' => 'تطبيق لجميع الخدمات الطبية المنزلية مع تسجيل للأطباء والمستخدمين. يمكن المستخدمين من حجز مواعيد مع الأطباء للفحوصات المنزلية والتواصل الفوري.',
                'description_en' => 'Application for all home medical services with registration for doctors and users. Enables users to book appointments with doctors for home check-ups and real-time communication.',
                'website_link' => null,
                'github_link' => null,
                'google_play_link' => 'https://play.google.com/store/apps/details?id=com.homecare',
                'app_store_link' => 'https://apps.apple.com/app/homecare',
                'skills' => [2, 4, 6, 18, 27] // Flutter, BLoC, Firebase, REST APIs, Push Notifications
            ],
            [
                'title_ar' => 'توصيلة',
                'title_en' => 'Tawsilla',
                'description_ar' => 'تطبيق نقل يوفر خدمة نقل الركاب السريعة والآمنة بأسعار تنافسية. ميزة التوصيل بدون عمولات مفروضة على السائقين، مما يضمن أسعار منخفضة وخدمة ممتازة. واجهة مستخدم بسيطة تتيح حجز الرحلات في دقائق مع التتبع الفوري.',
                'description_en' => 'Transportation app providing fast and safe passenger transportation service with competitive prices. Delivery feature with no commissions charged to drivers, ensuring low prices and excellent service. Simple user interface allowing flight booking in minutes with real-time tracking.',
                'website_link' => null,
                'github_link' => null,
                'google_play_link' => 'https://play.google.com/store/apps/details?id=com.tawsilla.app',
                'app_store_link' => 'https://apps.apple.com/eg/app/tawsilla-توصيلة/id6742457338',
                'skills' => [2, 18, 28] // Flutter, REST APIs, Maps Integration
            ],
            [
                'title_ar' => 'بوابة BEC Arabia',
                'title_en' => 'BEC Arabia Portal',
                'description_ar' => 'تطبيق بوابة احترافي لخدمات وعمليات شركة BEC Arabia. حل أعمال شامل للسوق العربي مع ميزات متقدمة. تجربة مستخدم مبسطة للوصول إلى خدمات ومعلومات الشركة.',
                'description_en' => 'Professional portal application for BEC Arabia company services and operations. Comprehensive business solution for Arabian market with advanced features. Streamlined user experience for accessing company services and information.',
                'website_link' => null,
                'github_link' => null,
                'google_play_link' => null,
                'app_store_link' => 'https://apps.apple.com/eg/app/bec-arabia-portal/id6747918095',
                'skills' => [2, 18] // Flutter, REST APIs
            ],
            [
                'title_ar' => 'عالم',
                'title_en' => 'Scientist',
                'description_ar' => 'منصة تعليمية مع دردشة داخلية للفصل الدراسي وقدرات متقدمة تتجاوز المنصات التعليمية النموذجية. تعرض الدروس في تنسيق فيديو مع اختبارات إلكترونية وعروض ملفات. تشمل الميزات منع تسجيل الشاشة وتصميم واجهة مستخدم جذاب.',
                'description_en' => 'Educational platform with classroom internal chat and advanced capabilities beyond typical educational platforms. Displays lessons in video format with electronic tests and file presentations. Features include screen recording prevention and attractive user interface design.',
                'website_link' => null,
                'github_link' => null,
                'google_play_link' => 'https://play.google.com/store/apps/details?id=com.scientist',
                'app_store_link' => 'https://apps.apple.com/app/scientist',
                'skills' => [2, 4, 6, 18, 27] // Flutter, BLoC, Firebase, REST APIs, Push Notifications
            ],
        ];

        foreach ($projects as $projectData) {
            $skills = $projectData['skills'];
            unset($projectData['skills']);

            $project = Project::create($projectData);
            $project->skills()->attach($skills);
        }
    }
}
