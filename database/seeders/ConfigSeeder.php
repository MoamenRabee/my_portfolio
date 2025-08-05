<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    public function run(): void
    {
        Config::create([
            'name_ar' => 'مؤمن ربيع محمد',
            'name_en' => 'Moamen Rabee Mohamed',
            'job_title_ar' => 'مطور تطبيقات الجوال Flutter',
            'job_title_en' => 'Flutter Developer',
            'summary_ar' => 'مطور Flutter محترف مع خبرة أكثر من 3 سنوات في بناء تطبيقات الجوال متعددة المنصات لنظامي Android و iOS. متخصص في تطوير تطبيقات سهلة الاستخدام مع البنية النظيفة، إدارة الحالة، وتكامل APIs. لديه سجل حافل بالعمل في شركات البرمجيات وشركات المنتجات، مع تقديم حلول عالية الجودة لصناعات متنوعة تشمل الرعاية الصحية والتعليم والتجارة الإلكترونية وغيرها.',
            'summary_en' => 'Experienced Flutter Developer with 3+ years of expertise in building cross-platform mobile applications for Android and iOS. Skilled in developing user-friendly apps with clean architecture, state management, and API integrations. Proven track record of working in both software houses and product companies, delivering high-quality solutions for diverse industries including healthcare, education, e-commerce and etc...',
            'about_me_ar' => 'مرحباً، أنا مؤمن ربيع محمد، مطور Flutter محترف من الإسكندرية، مصر. أعمل في مجال تطوير تطبيقات الجوال منذ أكثر من 3 سنوات. أتخصص في تطوير التطبيقات متعددة المنصات باستخدام Flutter وDart. عملت مع فرق دولية في تركيا عن بُعد، وأقوم حالياً بتطوير تطبيقات متنوعة تشمل التعليم والرعاية الصحية والنقل والتجارة الإلكترونية.',
            'about_me_en' => 'Hello, I am Moamen Rabee Mohamed, a professional Flutter Developer from Alexandria, Egypt. I have been working in mobile app development for over 3 years. I specialize in developing cross-platform applications using Flutter and Dart. I have worked with international teams in Turkey remotely, and currently developing diverse applications including education, healthcare, transportation, and e-commerce.',
            'phone' => '+201273308123',
            'email' => 'moamen.rabee.dev@gmail.com',
            'address' => 'الإسكندرية، مصر',
            'site_name' => 'Moamen Rabee Portfolio',
            'site_description' => 'Portfolio احترافي لمطور Flutter متخصص في تطبيقات الجوال متعددة المنصات',
            'site_keywords' => 'flutter developer, mobile app developer, dart, android, ios, cross-platform, portfolio, moamen rabee',
            'copyright' => '© ' . date('Y') . ' Moamen Rabee Mohamed. All rights reserved.',
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
            'linkedin' => 'https://www.linkedin.com/in/moamen-rabee/',
            'github' => 'https://github.com/moamen-rabee',
            'whatsapp' => 'https://wa.me/201273308123',
        ]);
    }
}
