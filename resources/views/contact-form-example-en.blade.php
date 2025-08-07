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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            <h1><i class="fas fa-envelope"></i> Contact Us</h1>
            <p>We're here to listen to you and help you achieve your project</p>
        </div>

        <div class="contact-form">
            <h2>Send Message</h2>

            <div id="contact-response"></div>

            <form id="contact-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user"></i>
                            Full Name *
                        </label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            Email Address *
                        </label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">
                            <i class="fas fa-phone"></i>
                            Phone Number
                        </label>
                        <input type="tel" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="subject">
                            <i class="fas fa-tag"></i>
                            Subject *
                        </label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message">
                        <i class="fas fa-comment"></i>
                        Message *
                    </label>
                    <textarea id="message" name="message" required
                        placeholder="Write your message here... (at least 10 characters)"></textarea>
                </div>

                <button type="submit" id="contact-submit-btn" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    Send Message
                </button>
            </form>
        </div>
    </div>

    <!-- Contact Form JavaScript -->
    <script src="/js/contact-form.js"></script>
</body>

</html>