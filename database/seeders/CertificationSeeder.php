<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    public function run(): void
    {
        $certifications = [
            [
                'name_ar' => 'دبلوم الباك إند',
                'name_en' => 'Back-End Diploma',
                'issuing_organization_ar' => 'مركز أورانج الرقمي',
                'issuing_organization_en' => 'Orange Digital Center',
                'issue_date' => null,
                'expiry_date' => null,
                'credential_id' => null,
                'credential_url' => 'https://drive.google.com/file/d/1ADNwWZ-e0ABd4KLLzuVyOP9NX-frl3Op/view?usp=sharing',
                'description_ar' => 'دبلوم متخصص في تطوير الباك إند يغطي أحدث التقنيات والأدوات المستخدمة في تطوير الخوادم وواجهات برمجة التطبيقات.',
                'description_en' => 'Specialized back-end development diploma covering the latest technologies and tools used in server development and API programming.'
            ],
            [
                'name_ar' => 'شهادة معتمدة من ITI: تطوير الويب باستخدام PHP',
                'name_en' => 'ITI Certified: Web Development Using PHP',
                'issuing_organization_ar' => 'معهد تكنولوجيا المعلومات ITI',
                'issuing_organization_en' => 'Information Technology Institute (ITI)',
                'issue_date' => null,
                'expiry_date' => null,
                'credential_id' => null,
                'credential_url' => 'https://drive.google.com/file/d/13sX8sKyLK6jvf2NanpHk2blDqLpRBYaF/view?usp=sharing',
                'description_ar' => 'شهادة معتمدة في تطوير الويب باستخدام PHP تغطي أساسيات ومتقدمات البرمجة باستخدام PHP وإطار عمل Laravel.',
                'description_en' => 'Certified credential in web development using PHP covering PHP programming fundamentals and advanced concepts with Laravel framework.'
            ],
            [
                'name_ar' => 'حل المشكلات البرمجية',
                'name_en' => 'Problem Solving',
                'issuing_organization_ar' => 'أكاديمية الكوتش',
                'issuing_organization_en' => 'Coach Academy',
                'issue_date' => null,
                'expiry_date' => null,
                'credential_id' => null,
                'credential_url' => 'https://drive.google.com/file/d/1AXbR2hLNFspZ69Es-yJ7glT4rXwAx9zf/view?usp=sharing',
                'description_ar' => 'شهادة في حل المشكلات البرمجية والخوارزميات، تركز على تطوير مهارات التفكير المنطقي وحل المسائل المعقدة.',
                'description_en' => 'Certification in problem solving and algorithms, focusing on developing logical thinking skills and solving complex problems.'
            ]
        ];

        foreach ($certifications as $certification) {
            Certification::create($certification);
        }
    }
}
