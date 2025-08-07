<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Sent Successfully!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-container {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .success-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(40, 167, 69, 0.1) 0%, transparent 70%);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            50% {
                transform: scale(1);
                opacity: 0.8;
            }
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            animation: bounceIn 0.8s ease-out;
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

        .success-icon svg {
            width: 50px;
            height: 50px;
            fill: white;
            animation: checkmark 0.6s ease-in-out 0.3s both;
        }

        @keyframes checkmark {
            0% {
                stroke-dasharray: 0 100;
            }

            100% {
                stroke-dasharray: 100 0;
            }
        }

        .success-title {
            color: #28a745;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
            animation: slideInUp 0.6s ease-out 0.2s both;
        }

        .success-message {
            color: #555;
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
            animation: slideInUp 0.6s ease-out 0.4s both;
        }

        @keyframes slideInUp {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .success-details {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 5px solid #28a745;
            position: relative;
            z-index: 2;
            animation: fadeIn 0.6s ease-out 0.6s both;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .success-details h3 {
            color: #28a745;
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .success-details p {
            color: #666;
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .success-details .highlight {
            color: #28a745;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
            animation: slideInUp 0.6s ease-out 0.8s both;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

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
            width: 10px;
            height: 10px;
            background: #28a745;
            animation: confetti-fall 3s linear infinite;
        }

        .confetti-piece:nth-child(2n) {
            background: #20c997;
        }

        .confetti-piece:nth-child(3n) {
            background: #ffc107;
        }

        .confetti-piece:nth-child(4n) {
            background: #dc3545;
        }

        .confetti-piece:nth-child(5n) {
            background: #6610f2;
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
            .success-container {
                padding: 40px 30px;
            }

            .success-title {
                font-size: 2rem;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>

<body>
    <div class="success-container">
        <!-- Confetti Animation -->
        <div class="confetti">
            <div class="confetti-piece" style="left: 10%; animation-delay: 0s;"></div>
            <div class="confetti-piece" style="left: 20%; animation-delay: 0.2s;"></div>
            <div class="confetti-piece" style="left: 30%; animation-delay: 0.4s;"></div>
            <div class="confetti-piece" style="left: 40%; animation-delay: 0.6s;"></div>
            <div class="confetti-piece" style="left: 50%; animation-delay: 0.8s;"></div>
            <div class="confetti-piece" style="left: 60%; animation-delay: 1s;"></div>
            <div class="confetti-piece" style="left: 70%; animation-delay: 1.2s;"></div>
            <div class="confetti-piece" style="left: 80%; animation-delay: 1.4s;"></div>
            <div class="confetti-piece" style="left: 90%; animation-delay: 1.6s;"></div>
        </div>

        <!-- Success Icon -->
        <div class="success-icon">
            <svg viewBox="0 0 24 24">
                <path d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z" />
            </svg>
        </div>

        <!-- Success Message -->
        <h1 class="success-title">Message Sent!</h1>

        <p class="success-message">
            Thank you for reaching out! Your message has been successfully delivered to our team.
        </p>

        <!-- Success Details -->
        <div class="success-details">
            <h3>What happens next?</h3>
            <p>📧 Your message has been <span class="highlight">sent to our inbox</span></p>
            <p>⚡ We typically respond within <span class="highlight">24 hours</span></p>
            <p>📱 You'll receive our reply at <span class="highlight">{{ $email ?? 'your email address' }}</span></p>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="/" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z" />
                </svg>
                Back to Home
            </a>
            <a href="/contact-test" class="btn btn-secondary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4M20,8L12,13L4,8V6L12,11L20,6V8Z" />
                </svg>
                Send Another Message
            </a>
        </div>
    </div>

    <script>
        // Auto redirect after 5 seconds
        setTimeout(function () {
            if (confirm('Would you like to return to the homepage?')) {
                window.location.href = '/';
            }
        }, 8000);

        // Add more confetti pieces dynamically
        function createConfetti() {
            const confetti = document.querySelector('.confetti');
            for (let i = 0; i < 20; i++) {
                const piece = document.createElement('div');
                piece.className = 'confetti-piece';
                piece.style.left = Math.random() * 100 + '%';
                piece.style.animationDelay = Math.random() * 3 + 's';
                piece.style.animationDuration = (Math.random() * 3 + 2) + 's';
                confetti.appendChild(piece);
            }
        }

        // Start confetti animation
        createConfetti();
    </script>
</body>

</html>