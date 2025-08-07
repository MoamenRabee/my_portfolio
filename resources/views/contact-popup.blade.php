<!DOCTYPE html>
<html lang="en" dir="ltr" id="html-root">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us - Multilingual Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            transition: all 0.3s ease;
        }

        [dir="rtl"] {
            font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .language-switcher {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 10px;
        }

        [dir="rtl"] .language-switcher {
            right: auto;
            left: 20px;
        }

        .lang-btn {
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .lang-btn:hover,
        .lang-btn.active {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .contact-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            position: relative;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .contact-header h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .contact-header p {
            color: #666;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 1rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        [dir="rtl"] .form-group input,
        [dir="rtl"] .form-group textarea {
            text-align: right;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .required {
            color: var(--danger-color);
        }

        .error {
            color: var(--danger-color);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Popup Styles */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .popup-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .popup-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            transform: scale(0.7);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .popup-overlay.show .popup-container {
            transform: scale(1);
        }

        .popup-close {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            color: #999;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        [dir="rtl"] .popup-close {
            right: auto;
            left: 20px;
        }

        .popup-close:hover {
            color: var(--danger-color);
            transform: rotate(90deg);
        }

        .success-popup {
            background: linear-gradient(135deg, var(--success-color) 0%, #20c997 100%);
            color: white;
        }

        .error-popup {
            background: linear-gradient(135deg, var(--danger-color) 0%, #e73c3c 100%);
            color: white;
        }

        .popup-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            animation: bounceIn 0.8s ease-out;
        }

        .success-popup .popup-icon {
            background: rgba(255, 255, 255, 0.2);
        }

        .error-popup .popup-icon {
            background: rgba(255, 255, 255, 0.2);
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.3);
                opacity: 0;
            }

            50% {
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .popup-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .popup-message {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .popup-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .popup-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .popup-btn-primary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .popup-btn-primary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .popup-btn-secondary {
            background: transparent;
            color: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .popup-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateY(-2px);
        }

        /* Confetti Animation */
        .confetti {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .confetti-piece {
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.8);
            animation: confetti-fall 3s linear infinite;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .contact-container {
                padding: 30px 25px;
            }

            .contact-header h1 {
                font-size: 2rem;
            }

            .popup-container {
                padding: 30px 25px;
            }

            .popup-buttons {
                flex-direction: column;
            }

            .popup-btn {
                width: 100%;
            }
        }

        /* Hide content initially for smooth loading */
        .hidden {
            display: none;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Language Switcher -->
    <div class="language-switcher">
        <a href="#" class="lang-btn active" onclick="switchLanguage('en')" data-lang="en">English</a>
        <a href="#" class="lang-btn" onclick="switchLanguage('ar')" data-lang="ar">العربية</a>
    </div>

    <div class="contact-container">
        <div class="contact-header">
            <h1 data-translate="contact.title">Contact Us</h1>
            <p data-translate="contact.subtitle">We'd love to hear from you. Send us a message and we'll respond as soon
                as possible.</p>
        </div>

        <div class="loading hidden" id="loading">
            <div class="spinner"></div>
            <p data-translate="contact.sending">Sending your message...</p>
        </div>

        <form id="contactForm" action="/contact" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label for="name" data-translate="contact.name">Full Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" required>
                <div class="error hidden" id="name-error"></div>
            </div>

            <div class="form-group">
                <label for="email" data-translate="contact.email">Email Address <span class="required">*</span></label>
                <input type="email" id="email" name="email" required>
                <div class="error hidden" id="email-error"></div>
            </div>

            <div class="form-group">
                <label for="phone" data-translate="contact.phone">Phone Number</label>
                <input type="tel" id="phone" name="phone">
                <div class="error hidden" id="phone-error"></div>
            </div>

            <div class="form-group">
                <label for="subject" data-translate="contact.subject">Subject <span class="required">*</span></label>
                <input type="text" id="subject" name="subject" required>
                <div class="error hidden" id="subject-error"></div>
            </div>

            <div class="form-group">
                <label for="message" data-translate="contact.message">Message <span class="required">*</span></label>
                <textarea id="message" name="message" data-translate-placeholder="contact.message_placeholder"
                    required></textarea>
                <div class="error hidden" id="message-error"></div>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn" data-translate="contact.send">
                Send Message
            </button>
        </form>
    </div>

    <!-- Success Popup -->
    <div class="popup-overlay" id="successPopup">
        <div class="popup-container success-popup">
            <button class="popup-close" onclick="closePopup('successPopup')">&times;</button>
            <div class="confetti" id="confetti"></div>
            <div class="popup-icon">✓</div>
            <h2 class="popup-title" data-translate="popup.success.title">Message Sent!</h2>
            <p class="popup-message" data-translate="popup.success.message">Thank you for reaching out! Your message has
                been successfully delivered to our team.</p>
            <div class="popup-buttons">
                <button class="popup-btn popup-btn-primary" onclick="closePopup('successPopup')"
                    data-translate="popup.success.close">
                    Great!
                </button>
                <button class="popup-btn popup-btn-secondary" onclick="sendAnother()"
                    data-translate="popup.success.another">
                    Send Another
                </button>
            </div>
        </div>
    </div>

    <!-- Error Popup -->
    <div class="popup-overlay" id="errorPopup">
        <div class="popup-container error-popup">
            <button class="popup-close" onclick="closePopup('errorPopup')">&times;</button>
            <div class="popup-icon">✕</div>
            <h2 class="popup-title" data-translate="popup.error.title">Oops! Something went wrong</h2>
            <p class="popup-message" id="errorMessage" data-translate="popup.error.message">An error occurred while
                sending your message. Please try again.</p>
            <div class="popup-buttons">
                <button class="popup-btn popup-btn-primary" onclick="closePopup('errorPopup')"
                    data-translate="popup.error.retry">
                    Try Again
                </button>
                <button class="popup-btn popup-btn-secondary" onclick="closePopup('errorPopup')"
                    data-translate="popup.error.cancel">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script>
        // Translation data
        const translations = {
            en: {
                'contact.title': 'Contact Us',
                'contact.subtitle': 'We\'d love to hear from you. Send us a message and we\'ll respond as soon as possible.',
                'contact.name': 'Full Name <span class="required">*</span>',
                'contact.email': 'Email Address <span class="required">*</span>',
                'contact.phone': 'Phone Number',
                'contact.subject': 'Subject <span class="required">*</span>',
                'contact.message': 'Message <span class="required">*</span>',
                'contact.message_placeholder': 'Please write your message here...',
                'contact.send': 'Send Message',
                'contact.sending': 'Sending your message...',
                'popup.success.title': 'Message Sent!',
                'popup.success.message': 'Thank you for reaching out! Your message has been successfully delivered to our team.',
                'popup.success.close': 'Great!',
                'popup.success.another': 'Send Another',
                'popup.error.title': 'Oops! Something went wrong',
                'popup.error.message': 'An error occurred while sending your message. Please try again.',
                'popup.error.retry': 'Try Again',
                'popup.error.cancel': 'Cancel'
            },
            ar: {
                'contact.title': 'تواصل معنا',
                'contact.subtitle': 'نحب أن نسمع منك. أرسل لنا رسالة وسنرد عليك في أقرب وقت ممكن.',
                'contact.name': 'الاسم الكامل <span class="required">*</span>',
                'contact.email': 'عنوان البريد الإلكتروني <span class="required">*</span>',
                'contact.phone': 'رقم الهاتف',
                'contact.subject': 'الموضوع <span class="required">*</span>',
                'contact.message': 'الرسالة <span class="required">*</span>',
                'contact.message_placeholder': 'يرجى كتابة رسالتك هنا...',
                'contact.send': 'إرسال الرسالة',
                'contact.sending': 'جاري إرسال رسالتك...',
                'popup.success.title': 'تم إرسال الرسالة!',
                'popup.success.message': 'شكراً لتواصلك معنا! تم تسليم رسالتك بنجاح إلى فريقنا.',
                'popup.success.close': 'ممتاز!',
                'popup.success.another': 'إرسال رسالة أخرى',
                'popup.error.title': 'عذراً! حدث خطأ ما',
                'popup.error.message': 'حدث خطأ أثناء إرسال رسالتك. يرجى المحاولة مرة أخرى.',
                'popup.error.retry': 'حاول مرة أخرى',
                'popup.error.cancel': 'إلغاء'
            }
        };

        let currentLanguage = 'en';

        // Language switching function
        function switchLanguage(lang) {
            currentLanguage = lang;

            // Update HTML attributes
            const htmlRoot = document.getElementById('html-root');
            htmlRoot.setAttribute('lang', lang);
            htmlRoot.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');

            // Update active language button
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-lang') === lang);
            });

            // Translate all elements
            document.querySelectorAll('[data-translate]').forEach(element => {
                const key = element.getAttribute('data-translate');
                if (translations[lang] && translations[lang][key]) {
                    element.innerHTML = translations[lang][key];
                }
            });

            // Translate placeholders
            document.querySelectorAll('[data-translate-placeholder]').forEach(element => {
                const key = element.getAttribute('data-translate-placeholder');
                if (translations[lang] && translations[lang][key]) {
                    element.setAttribute('placeholder', translations[lang][key]);
                }
            });
        }

        // Form submission
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const loading = document.getElementById('loading');

            // Clear previous errors
            clearErrors();

            // Show loading
            submitBtn.disabled = true;
            submitBtn.textContent = translations[currentLanguage]['contact.sending'];
            loading.classList.remove('hidden');

            // Prepare form data
            const formData = new FormData(form);

            // Send AJAX request
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessPopup();
                        form.reset();
                    } else {
                        if (data.errors) {
                            showValidationErrors(data.errors);
                        } else {
                            showErrorPopup(data.message);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorPopup();
                })
                .finally(() => {
                    // Hide loading
                    submitBtn.disabled = false;
                    submitBtn.textContent = translations[currentLanguage]['contact.send'];
                    loading.classList.add('hidden');
                });
        });

        // Clear validation errors
        function clearErrors() {
            document.querySelectorAll('.error').forEach(error => {
                error.classList.add('hidden');
                error.textContent = '';
            });
        }

        // Show validation errors
        function showValidationErrors(errors) {
            Object.keys(errors).forEach(field => {
                const errorElement = document.getElementById(field + '-error');
                if (errorElement) {
                    errorElement.textContent = errors[field][0];
                    errorElement.classList.remove('hidden');
                }
            });
        }

        // Show success popup
        function showSuccessPopup() {
            const popup = document.getElementById('successPopup');
            popup.classList.add('show');
            createConfetti();

            // Auto close after 5 seconds
            setTimeout(() => {
                closePopup('successPopup');
            }, 5000);
        }

        // Show error popup
        function showErrorPopup(message) {
            const popup = document.getElementById('errorPopup');
            const errorMessage = document.getElementById('errorMessage');

            if (message) {
                errorMessage.textContent = message;
            } else {
                errorMessage.textContent = translations[currentLanguage]['popup.error.message'];
            }

            popup.classList.add('show');
        }

        // Close popup
        function closePopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.classList.remove('show');
        }

        // Send another message
        function sendAnother() {
            closePopup('successPopup');
            document.getElementById('contactForm').scrollIntoView({ behavior: 'smooth' });
        }

        // Create confetti animation
        function createConfetti() {
            const confettiContainer = document.getElementById('confetti');
            confettiContainer.innerHTML = '';

            for (let i = 0; i < 30; i++) {
                const piece = document.createElement('div');
                piece.className = 'confetti-piece';
                piece.style.left = Math.random() * 100 + '%';
                piece.style.animationDelay = Math.random() * 3 + 's';
                piece.style.animationDuration = (Math.random() * 2 + 2) + 's';
                confettiContainer.appendChild(piece);
            }
        }

        // Close popup when clicking outside
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('popup-overlay')) {
                e.target.classList.remove('show');
            }
        });

        // Initialize language
        switchLanguage('en');
    </script>
</body>

</html>