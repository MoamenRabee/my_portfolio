<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us - Test Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .contact-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
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

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .error-list {
            margin-top: 10px;
            padding-left: 20px;
        }

        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
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

        .required {
            color: #e74c3c;
        }
    </style>
</head>

<body>
    <div class="contact-container">
        <div class="contact-header">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>

        <div id="alertContainer"></div>

        <form id="contactForm" action="/contact" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label for="name">Full Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone">
            </div>

            <div class="form-group">
                <label for="subject">Subject <span class="required">*</span></label>
                <input type="text" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="message">Message <span class="required">*</span></label>
                <textarea id="message" name="message" placeholder="Please write your message here..."
                    required></textarea>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">
                Send Message
            </button>
        </form>

        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>Sending your message...</p>
        </div>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const loading = document.getElementById('loading');
            const alertContainer = document.getElementById('alertContainer');

            // Clear previous alerts
            alertContainer.innerHTML = '';

            // Show loading
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            loading.style.display = 'block';

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
                        // Show success message
                        alertContainer.innerHTML = `
                        <div class="alert alert-success">
                            ${data.message}
                        </div>
                    `;
                        form.reset();
                    } else {
                        // Show error message
                        let errorHtml = `<div class="alert alert-danger">${data.message}`;

                        if (data.errors) {
                            errorHtml += '<ul class="error-list">';
                            Object.values(data.errors).forEach(errorArray => {
                                errorArray.forEach(error => {
                                    errorHtml += `<li>${error}</li>`;
                                });
                            });
                            errorHtml += '</ul>';
                        }

                        errorHtml += '</div>';
                        alertContainer.innerHTML = errorHtml;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alertContainer.innerHTML = `
                    <div class="alert alert-danger">
                        An error occurred while sending your message. Please try again.
                    </div>
                `;
                })
                .finally(() => {
                    // Hide loading
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Send Message';
                    loading.style.display = 'none';

                    // Scroll to top to show alert
                    document.querySelector('.contact-container').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
        });
    </script>
</body>

</html>