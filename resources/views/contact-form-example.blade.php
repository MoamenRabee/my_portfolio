<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us - Portfolio</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Contact Form CSS -->
    <link rel="stylesheet" href="/css/contact-form.css">

    <style>
        body {
            font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .page-header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-envelope"></i> تواصل معنا</h1>
            <p>نحن هنا للاستماع إليك ومساعدتك في تحقيق مشروعك</p>
        </div>

        <div class="contact-form">
            <h2>إرسال رسالة</h2>

            <div id="contact-response"></div>

            <form id="contact-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user"></i>
                            الاسم الكامل *
                        </label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            البريد الإلكتروني *
                        </label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">
                            <i class="fas fa-phone"></i>
                            رقم الهاتف
                        </label>
                        <input type="tel" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="subject">
                            <i class="fas fa-tag"></i>
                            موضوع الرسالة *
                        </label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message">
                        <i class="fas fa-comment"></i>
                        الرسالة *
                    </label>
                    <textarea id="message" name="message" required
                        placeholder="اكتب رسالتك هنا... (على الأقل 10 أحرف)"></textarea>
                </div>

                <button type="submit" id="contact-submit-btn" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    إرسال الرسالة
                </button>
            </form>
        </div>
    </div>

    <!-- Contact Form JavaScript -->
    <script src="/js/contact-form.js"></script>
</body>

</html>