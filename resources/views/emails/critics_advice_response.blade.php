<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response to Your Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #00ff41;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #00ff41;
            margin: 0;
            font-size: 24px;
        }
        .content {
            margin-bottom: 30px;
        }
        .feedback-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #00ff41;
        }
        .response-section {
            background-color: #e8f5e8;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #00ff41;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .btn:hover {
            background-color: #00cc33;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎮 RANCONNITY</h1>
            <p>Response to Your Feedback</p>
        </div>

        <div class="content">
            <p>Hello <strong>{{ $criticsAdvice->sender_name }}</strong>,</p>
            
            <p>Thank you for taking the time to share your feedback with us. We appreciate your input and have reviewed your message.</p>

            <div class="feedback-section">
                <h3>📝 Your Original Message:</h3>
                <p><em>"{{ $criticsAdvice->messages }}"</em></p>
                <small>Sent on: {{ $criticsAdvice->created_at->format('F j, Y \a\t g:i A') }}</small>
            </div>

            <div class="response-section">
                <h3>💬 Our Response:</h3>
                <p>{{ $criticsAdvice->response }}</p>
            </div>

            <p>We value your feedback and are committed to continuously improving our community. If you have any additional questions or suggestions, please don't hesitate to reach out to us again.</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="https://discord.gg/CdpPfKUK4p" class="btn">Join Our Discord Server</a>
            </div>
        </div>

        <div class="footer">
            <p><strong>Ranconnity Community</strong></p>
            <p>The Ultimate Gaming Community</p>
            <p>Thank you for being part of our community! 🎯</p>
        </div>
    </div>
</body>
</html> 