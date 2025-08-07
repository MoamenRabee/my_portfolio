<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactMessage;
use Carbon\Carbon;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'phone' => '+20123456789',
                'subject' => 'استفسار حول خدمات التطوير',
                'message' => 'أريد معرفة المزيد حول خدماتك في تطوير المواقع الإلكترونية. هل يمكنك مراسلتي لمناقشة مشروع جديد؟',
                'ip_address' => '192.168.1.1',
                'is_read' => false,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'فاطمة السيد',
                'email' => 'fatma@example.com',
                'phone' => '+20987654321',
                'subject' => 'طلب عرض سعر',
                'message' => 'مرحباً، أحتاج لتطوير تطبيق موبايل لمشروعي التجاري. يرجى إرسال عرض سعر تفصيلي.',
                'ip_address' => '192.168.1.2',
                'is_read' => true,
                'read_at' => Carbon::now()->subHours(2),
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'name' => 'محمد علي',
                'email' => 'mohamed@example.com',
                'subject' => 'تعاون في مشروع',
                'message' => 'هل أنت مهتم بالتعاون في مشروع تطوير منصة إلكترونية؟ لدي فكرة مميزة ومتاح ميزانية جيدة.',
                'ip_address' => '192.168.1.3',
                'is_read' => false,
                'created_at' => Carbon::now()->subHours(3),
            ],
            [
                'name' => 'سارة أحمد',
                'email' => 'sara@example.com',
                'phone' => '+20555666777',
                'subject' => 'استشارة تقنية',
                'message' => 'أحتاج لاستشارة تقنية حول اختيار أفضل التقنيات لمشروع التجارة الإلكترونية الخاص بي.',
                'ip_address' => '192.168.1.4',
                'is_read' => true,
                'read_at' => Carbon::now()->subMinutes(30),
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'name' => 'خالد حسن',
                'email' => 'khaled@example.com',
                'subject' => 'طلب صيانة موقع',
                'message' => 'لدي موقع إلكتروني يحتاج لصيانة وتحديثات. هل تقوم بهذا النوع من الأعمال؟',
                'ip_address' => '192.168.1.5',
                'is_read' => false,
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'name' => 'نور الدين',
                'email' => 'nour@example.com',
                'subject' => 'تطوير API',
                'message' => 'أحتاج لتطوير API متقدم للتطبيق الخاص بنا. هل لديك خبرة في Laravel APIs؟',
                'ip_address' => '192.168.1.6',
                'is_read' => false,
                'created_at' => Carbon::today(),
            ]
        ];

        foreach ($messages as $message) {
            ContactMessage::create($message);
        }
    }
}
