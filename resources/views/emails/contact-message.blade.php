<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Message from Portfolio Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            direction: ltr;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #4F46E5;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .field {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .field label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .field .value {
            color: #333;
        }

        .message-content {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #4F46E5;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📧 New Message from Portfolio Website</h1>
        </div>

        <div class="content">
            <div class="field">
                <label>Name:</label>
                <div class="value">{{ $contactMessage->name }}</div>
            </div>

            <div class="field">
                <label>Email:</label>
                <div class="value">{{ $contactMessage->email }}</div>
            </div>

            @if($contactMessage->phone)
                <div class="field">
                    <label>Phone Number:</label>
                    <div class="value">{{ $contactMessage->phone }}</div>
                </div>
            @endif

            <div class="field">
                <label>Subject:</label>
                <div class="value">{{ $contactMessage->subject }}</div>
            </div>

            <div class="field">
                <label>Message:</label>
                <div class="message-content">
                    {!! nl2br(e($contactMessage->message)) !!}
                </div>
            </div>

            <div class="field">
                <label>Date Sent:</label>
                <div class="value">{{ $contactMessage->created_at->format('Y-m-d H:i:s') }}</div>
            </div>

            <div class="field">
                <label>IP Address:</label>
                <div class="value">{{ $contactMessage->ip_address }}</div>
            </div>
        </div>

        <div class="footer">
            <p>This message was sent from the contact form on your Portfolio website</p>
            <p>To reply to this message, you can reply directly to this email</p>
        </div>
    </div>
</body>

</html>