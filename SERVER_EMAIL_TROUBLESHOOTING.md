# 📧 دليل حل مشاكل البريد الإلكتروني على السيرفر

## 🔧 الخطوات المطلوبة على السيرفر:

### 1️⃣ تحديث ملف .env
```bash
APP_NAME="Moamen Portfolio"
APP_URL=https://moamen.softeks.org
DB_DATABASE=moamen_protfolio
DB_USERNAME=root
DB_PASSWORD=M0@men2003

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=moamen.rabee.dev@gmail.com
MAIL_PASSWORD="imbd macp pmqm mebv"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="moamen.rabee.dev@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
MAIL_ADMIN_EMAIL=moamen.rabee.dev@gmail.com
```

### 2️⃣ تشخيص المشاكل على السيرفر
```bash
# 1. مسح cache التكوين
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# 2. اختبار إعدادات البريد
php artisan test:email

# 3. فحص السجلات
tail -f storage/logs/laravel.log
```

### 3️⃣ المشاكل الشائعة وحلولها:

#### ❌ مشكلة: Connection timeout
**السبب:** السيرفر يحجب الاتصال بـ Gmail
**الحل:**
- تأكد من أن البورت 587 مفتوح
- جرب البورت 465 مع SSL:
```env
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
```

#### ❌ مشكلة: Authentication failed
**السبب:** مشكلة في App Password
**الحل:**
1. تأكد من تفعيل 2FA في Gmail
2. أنشئ App Password جديد من: https://myaccount.google.com/apppasswords
3. استخدم App Password الجديد في MAIL_PASSWORD

#### ❌ مشكلة: SSL Certificate verify failed
**السبب:** مشكلة في شهادات SSL
**الحل:** أضف هذا إلى config/mail.php:
```php
'stream' => [
    'ssl' => [
        'allow_self_signed' => true,
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
],
```

#### ❌ مشكلة: PHP OpenSSL extension not found
**السبب:** OpenSSL غير مثبت
**الحل:**
```bash
# على Ubuntu/Debian
sudo apt-get install php-openssl php-curl

# على CentOS/RHEL
sudo yum install php-openssl php-curl

# إعادة تشغيل Apache/Nginx
sudo systemctl restart apache2
# أو
sudo systemctl restart nginx
```

### 4️⃣ إعدادات بديلة للسيرفر
إذا لم يعمل Gmail، جرب هذه الإعدادات:

#### استخدام Mailgun:
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.com
MAILGUN_SECRET=your-secret-key
```

#### استخدام SendGrid:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
```

### 5️⃣ اختبار البريد بعد النشر
```bash
# على السيرفر، نفذ هذا الأمر:
php artisan tinker

# ثم أدخل هذا الكود:
use Illuminate\Support\Facades\Mail;
Mail::raw('Test from server', function($message) {
    $message->to('moamen.rabee.dev@gmail.com')->subject('Server Test');
});
```

### 6️⃣ فحص حالة البريد في السجلات
```bash
# فحص آخر 50 سطر من السجلات
tail -50 storage/logs/laravel.log | grep -i mail

# فحص أخطاء البريد فقط
grep -i "mail\|smtp\|email" storage/logs/laravel.log
```

### 7️⃣ إعدادات إضافية للسيرفر
أضف هذه الأسطر إلى `.htaccess` إذا كنت تستخدم Apache:
```apache
# Enable PHP mail function
php_flag mail.add_x_header On
php_value sendmail_path "/usr/sbin/sendmail -t -i"
```

## ✅ التحقق من نجاح الإعداد
1. يجب أن ترى "All tests passed!" عند تشغيل `php artisan test:email`
2. يجب أن تصل رسالة اختبار إلى moamen.rabee.dev@gmail.com
3. نموذج الاتصال في الموقع يجب أن يعرض popup النجاح
4. لا يجب أن تجد أي أخطاء mail في storage/logs/laravel.log

## 🆘 إذا لم تعمل كل الحلول
1. اتصل بمزود الاستضافة لتأكيد أن SMTP مسموح
2. جرب استخدام خدمة بريد بديلة مثل Mailgun أو SendGrid
3. استخدم وضع "log" مؤقتاً للتأكد من أن الكود يعمل:
```env
MAIL_MAILER=log
```
