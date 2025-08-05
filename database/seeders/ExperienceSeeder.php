<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'title_ar' => 'مطور تطبيقات الجوال',
                'title_en' => 'Mobile Application Developer',
                'company_name_ar' => 'BEC Arabia',
                'company_name_en' => 'BEC Arabia',
                'description_ar' => 'تطوير وصيانة تطبيق BEC Arabia Portal للهاتف المحمول باستخدام إطار عمل Flutter. تنفيذ منطق الأعمال وواجهة المستخدم لحلول السوق العربي. العمل مع APIs RESTful لتكامل البيانات على مستوى المؤسسة. التعاون مع فريق الخلفية لضمان سلاسة وظائف التطبيق. ضمان تحسين أداء التطبيق وتعزيز تجربة المستخدم.',
                'description_en' => 'Developing and maintaining BEC Arabia Portal mobile application using Flutter framework. Implementing business logic and user interface for Arabian market solutions. Working with RESTful APIs for enterprise-level data integration. Collaborating with backend team for seamless app functionality. Ensuring app performance optimization and user experience enhancement.',
                'location' => 'الإسكندرية، مصر',
                'start_date' => '2025-01-01',
                'end_date' => null,
            ],
            [
                'title_ar' => 'مطور تطبيقات الجوال',
                'title_en' => 'Mobile Application Developer',
                'company_name_ar' => 'Marketopia',
                'company_name_en' => 'Marketopia',
                'description_ar' => 'تطوير تطبيق 4P ومشاريع العملاء الأخرى كجزء من عمليات بيت البرمجيات. بناء تطبيقات الهاتف المحمول متعددة المنصات للصفقات والخصومات وتكامل الخدمات. تنفيذ إدارة الحالة المعقدة باستخدام نمط BLoC و Provider. دمج APIs الطرف الثالث لبوابات الدفع والخرائط وخدمات الإشعارات. إجراء مراجعات الكود والحفاظ على مبادئ البنية النظيفة.',
                'description_en' => 'Developing 4P App and other client projects as part of software house operations. Building cross-platform mobile applications for deals, discounts, and service integrations. Implementing complex state management using BLoC pattern and Provider. Integrating third-party APIs for payment gateways, maps, and notification services. Conducting code reviews and maintaining clean architecture principles.',
                'location' => 'الإسكندرية، مصر',
                'start_date' => '2024-11-01',
                'end_date' => null,
            ],
            [
                'title_ar' => 'مطور تطبيقات الجوال',
                'title_en' => 'Mobile Application Developer',
                'company_name_ar' => 'Galaxs',
                'company_name_en' => 'Galaxs',
                'description_ar' => 'عملت كمطور Flutter في بيئة بيت البرمجيات لخدمة العملاء الدوليين. طورت عدة تطبيقات الهاتف المحمول مع التركيز على قابلية التوسع والأداء. نفذت ميزات الوقت الفعلي باستخدام Firebase و Socket.io. تعاونت مع فرق عن بُعد عبر مناطق زمنية مختلفة. قمت بتسليم المشاريع في مواعيد نهائية ضيقة مع الحفاظ على معايير جودة الكود.',
                'description_en' => 'Worked as Flutter developer in software house environment serving international clients. Developed multiple mobile applications with focus on scalability and performance. Implemented real-time features using Firebase and Socket.io. Collaborated with remote teams across different time zones. Delivered projects on tight deadlines while maintaining code quality standards.',
                'location' => 'إسطنبول، تركيا (عن بُعد)',
                'start_date' => '2022-08-01',
                'end_date' => '2024-11-01',
            ],
            [
                'title_ar' => 'مطور تطبيقات الجوال',
                'title_en' => 'Mobile Application Developer',
                'company_name_ar' => 'Codak',
                'company_name_en' => 'Codak',
                'description_ar' => 'طورت مشاريع عملاء متنوعة في بيئة بيت البرمجيات باستخدام إطار عمل Flutter. بنيت تطبيقات تعليمية وصحية وتجارية لمتطلبات عملاء متنوعة. نفذت أنظمة مصادقة مستخدم آمنة وخدمات إشعارات الدفع. تعاونت مع المصممين والمطورين الآخرين لضمان التسليم في الوقت المناسب للمنتجات عالية الجودة. استخدمت مكتبات وأدوات مختلفة لتحسين أداء التطبيق وتجربة المستخدم. أجريت مراجعات الكود وقدمت ملاحظات بناءة لأعضاء الفريق. وجهت المطورين المبتدئين ووضعت أفضل ممارسات البرمجة.',
                'description_en' => 'Developed various client projects in software house environment using Flutter framework. Built educational, healthcare, and business applications for diverse client requirements. Implemented secure user authentication systems and push notification services. Collaborated with designers and other developers to ensure timely delivery of high-quality products. Utilized various libraries and tools to optimize app performance and user experience. Conducted code reviews and provided constructive feedback to team members. Mentored junior developers and established best coding practices.',
                'location' => 'الإسكندرية، مصر',
                'start_date' => '2021-01-01',
                'end_date' => '2023-01-01',
            ],
            [
                'title_ar' => 'مدرب تطوير الجوال',
                'title_en' => 'Mobile Developer Instructor',
                'company_name_ar' => 'PentaCoders',
                'company_name_en' => 'PentaCoders',
                'description_ar' => 'درست ووجهت الطلاب في تطوير الهاتف المحمول باستخدام Flutter و Android SDK. طورت مواد الدورة وأجريت مراجعات الكود. ساعدت الطلاب في تطوير تطبيقاتهم المحمولة الخاصة.',
                'description_en' => 'Taught and mentored students on mobile development using Flutter and Android SDK. Developed course materials and conducted code reviews. Assisted students in developing their own mobile applications.',
                'location' => 'الإسكندرية، مصر',
                'start_date' => '2021-01-01',
                'end_date' => '2021-06-01',
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
}
