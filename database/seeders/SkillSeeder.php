<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // Programming Language
            ['name_ar' => 'Dart', 'name_en' => 'Dart'],

            // Framework
            ['name_ar' => 'Flutter', 'name_en' => 'Flutter'],

            // State Management
            ['name_ar' => 'Provider', 'name_en' => 'Provider'],
            ['name_ar' => 'BLoC', 'name_en' => 'BLoC'],
            ['name_ar' => 'GetX', 'name_en' => 'GetX'],

            // Backend & Database
            ['name_ar' => 'Firebase', 'name_en' => 'Firebase'],
            ['name_ar' => 'MySQL', 'name_en' => 'MySQL'],
            ['name_ar' => 'MongoDB', 'name_en' => 'MongoDB'],

            // Development Tools
            ['name_ar' => 'Android Studio', 'name_en' => 'Android Studio'],
            ['name_ar' => 'Xcode', 'name_en' => 'Xcode'],
            ['name_ar' => 'Visual Studio Code', 'name_en' => 'Visual Studio Code'],
            ['name_ar' => 'Adobe XD', 'name_en' => 'Adobe XD'],
            ['name_ar' => 'Figma', 'name_en' => 'Figma'],

            // Operating Systems
            ['name_ar' => 'macOS', 'name_en' => 'macOS'],
            ['name_ar' => 'Windows', 'name_en' => 'Windows'],
            ['name_ar' => 'Linux', 'name_en' => 'Linux'],

            // APIs & Web Services
            ['name_ar' => 'REST APIs', 'name_en' => 'REST APIs'],
            ['name_ar' => 'Postman API', 'name_en' => 'Postman API'],
            ['name_ar' => 'Socket.io', 'name_en' => 'Socket.io'],

            // Concepts & Version Control
            ['name_ar' => 'البرمجة الكائنية (OOP)', 'name_en' => 'Object-Oriented Programming (OOP)'],
            ['name_ar' => 'Git', 'name_en' => 'Git'],
            ['name_ar' => 'GitHub', 'name_en' => 'GitHub'],

            // Mobile Platforms
            ['name_ar' => 'Android', 'name_en' => 'Android'],
            ['name_ar' => 'iOS', 'name_en' => 'iOS'],
            ['name_ar' => 'تطوير متعدد المنصات', 'name_en' => 'Cross-Platform Development'],

            // Additional Skills
            ['name_ar' => 'البنية النظيفة', 'name_en' => 'Clean Architecture'],
            ['name_ar' => 'نمط MVVM', 'name_en' => 'MVVM Pattern'],
            ['name_ar' => 'إشعارات الدفع', 'name_en' => 'Push Notifications'],
            ['name_ar' => 'تكامل الخرائط', 'name_en' => 'Maps Integration'],
            ['name_ar' => 'بوابات الدفع', 'name_en' => 'Payment Gateways'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
