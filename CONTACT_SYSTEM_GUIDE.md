# Contact Us System - Complete Usage Guide

## 🎯 Summary
A complete Contact Us system has been created that sends messages to:
1. **Admin Dashboard** - for managing messages
2. **Email (Gmail)** - for instant notifications

## 📋 Components Created

### 1. Database
- **Table**: `contact_messages`
- **Fields**: Name, Email, Phone, Subject, Message, IP, Read Status, Timestamps
- **Indexes**: Optimized for search and performance

### 2. Models and Controllers
- **Model**: `App\Models\ContactMessage`
- **Controller**: `App\Http\Controllers\ContactController`
- **Mail Class**: `App\Mail\ContactMessageMail`

### 3. Filament Admin Interface
- **Resource**: Complete message management
- **Widget**: Statistics in dashboard
- **Navigation Badge**: Unread messages counter

### 4. User Interface
- **HTML Form**: Responsive English design
- **JavaScript**: AJAX submission with error handling
- **CSS**: Professional design with animations

## 🔧 الإعدادات المطلوبة

### إعدادات Gmail في `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="Portfolio"
MAIL_ADMIN_EMAIL=your-email@gmail.com
```

### خطوات إعداد Gmail:
1. تفعيل التحقق بخطوتين في Gmail
2. إنشاء App Password من إعدادات الأمان
3. استخدام App Password في `MAIL_PASSWORD`

## 🚀 الوصول للنظام

### الداشبورد الإداري:
- **الرابط**: http://127.0.0.1:8080/admin
- **المعلومات**: admin@admin.com / password
- **الرسائل**: قسم "رسائل الاتصال" في القائمة
- **الإحصائيات**: Widget في الصفحة الرئيسية

### نموذج الاختبار:
- **الرابط**: http://127.0.0.1:8080/contact-form
- **الغرض**: اختبار إرسال الرسائل

## 📊 المميزات

### الداشبورد:
- ✅ عرض جميع الرسائل مع الترقيم
- ✅ تصنيف (مقروءة/غير مقروءة)
- ✅ البحث والفلترة
- ✅ تعيين كمقروءة/غير مقروءة
- ✅ إحصائيات تفصيلية
- ✅ عداد الرسائل غير المقروءة في القائمة

### النموذج:
- ✅ تصميم عربي متجاوب
- ✅ تحقق من البيانات
- ✅ رسائل الأخطاء بالعربية
- ✅ إرسال AJAX بدون إعادة تحميل
- ✅ رسائل نجاح/فشل
- ✅ حفظ IP address المرسل

### البريد الإلكتروني:
- ✅ إيميل HTML مُنسق
- ✅ جميع تفاصيل الرسالة
- ✅ إمكانية الرد المباشر
- ✅ معلومات IP والوقت

## 🔄 استخدام النظام

### إدراج النموذج في موقعك:
```html
<!-- في head -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/css/contact-form.css">

<!-- النموذج -->
<form id="contact-form">
    <div class="form-group">
        <label for="name">الاسم *</label>
        <input type="text" id="name" name="name" required>
    </div>
    
    <div class="form-group">
        <label for="email">البريد الإلكتروني *</label>
        <input type="email" id="email" name="email" required>
    </div>
    
    <div class="form-group">
        <label for="phone">رقم الهاتف</label>
        <input type="tel" id="phone" name="phone">
    </div>
    
    <div class="form-group">
        <label for="subject">الموضوع *</label>
        <input type="text" id="subject" name="subject" required>
    </div>
    
    <div class="form-group">
        <label for="message">الرسالة *</label>
        <textarea id="message" name="message" required></textarea>
    </div>
    
    <button type="submit" id="contact-submit-btn" class="submit-btn">
        إرسال الرسالة
    </button>
</form>

<div id="contact-response"></div>

<!-- في نهاية body -->
<script src="/js/contact-form.js"></script>
```

### إدارة الرسائل:
1. دخول الداشبورد: http://127.0.0.1:8080/admin
2. اختر "رسائل الاتصال" من القائمة
3. عرض/تعديل/حذف الرسائل
4. تعيين كمقروءة/غير مقروءة

## 📈 الإحصائيات المتاحة

### في Widget الداشبورد:
- إجمالي الرسائل
- الرسائل غير المقروءة
- رسائل اليوم
- رسائل هذا الأسبوع

### في Model:
```php
ContactMessage::todayCount()      // رسائل اليوم
ContactMessage::unreadCount()     // غير المقروءة
ContactMessage::thisWeekCount()   // هذا الأسبوع
ContactMessage::thisMonthCount()  // هذا الشهر
```

## 🛠️ التخصيص

### تغيير التصميم:
- عدّل `public/css/contact-form.css`

### تخصيص الإيميل:
- عدّل `resources/views/emails/contact-message.blade.php`

### إضافة حقول جديدة:
1. أضف Migration جديد
2. عدّل Model fillable
3. عدّل النموذج والـ Resource

## 🔍 اختبار النظام

### اختبر الإرسال:
1. اذهب إلى: http://127.0.0.1:8080/contact-form
2. املأ النموذج وأرسله
3. تحقق من الداشبورد: http://127.0.0.1:8080/admin
4. تحقق من الإيميل الوارد

### فحص الأخطاء:
- تحقق من `storage/logs/laravel.log`
- تحقق من Browser Console
- تحقق من Response في Network tab

## 🎉 الخلاصة
النظام جاهز ويعمل بكفاءة عالية! يمكنك الآن:
- استقبال الرسائل في الداشبورد
- الحصول على تنبيهات فورية في Gmail  
- إدارة الرسائل بسهولة
- متابعة الإحصائيات

**رابط الداشبورد**: http://127.0.0.1:8080/admin
**رابط اختبار النموذج**: http://127.0.0.1:8080/contact-form
