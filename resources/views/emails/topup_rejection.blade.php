<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topup Rejected - {{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #ffffff;
            line-height: 1.6;
            padding: 20px;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: linear-gradient(145deg, #1e1e2e 0%, #2d2d44 100%);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }
        
        .rejection-icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }
        
        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .header p {
            font-size: 18px;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 20px;
            margin-bottom: 30px;
            color: #e0e0e0;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #f44336;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title::before {
            content: '';
            width: 4px;
            height: 24px;
            background: linear-gradient(135deg, #f44336, #d32f2f);
            border-radius: 2px;
        }
        
        .transaction-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .transaction-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .transaction-item.full-width {
            grid-column: 1 / -1;
        }
        
        .item-label {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        
        .item-value {
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
        }
        
        .highlight {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }
        
        .rejection-reason {
            background: linear-gradient(135deg, rgba(244, 67, 54, 0.1), rgba(211, 47, 47, 0.1));
            border: 1px solid rgba(244, 67, 54, 0.3);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
        }
        
        .rejection-reason h3 {
            color: #f44336;
            margin-bottom: 15px;
            font-size: 20px;
        }
        
        .rejection-reason p {
            color: #e0e0e0;
            font-size: 16px;
            background: rgba(244, 67, 54, 0.1);
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #f44336;
        }
        
        .next-steps {
            background: linear-gradient(135deg, rgba(255, 152, 0, 0.1), rgba(255, 111, 0, 0.1));
            border: 1px solid rgba(255, 152, 0, 0.3);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
        }
        
        .next-steps h3 {
            color: #ff9800;
            margin-bottom: 15px;
            font-size: 20px;
        }
        
        .next-steps ul {
            list-style: none;
            padding: 0;
        }
        
        .next-steps li {
            color: #e0e0e0;
            font-size: 16px;
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
        }
        
        .next-steps li::before {
            content: '•';
            color: #ff9800;
            font-weight: bold;
            position: absolute;
            left: 0;
        }
        
        .support-section {
            background: linear-gradient(135deg, rgba(33, 150, 243, 0.1), rgba(30, 136, 229, 0.1));
            border: 1px solid rgba(33, 150, 243, 0.3);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin: 25px 0;
        }
        
        .support-section h3 {
            color: #2196F3;
            margin-bottom: 15px;
            font-size: 20px;
        }
        
        .support-section p {
            color: #e0e0e0;
            font-size: 16px;
        }
        
        .apology {
            background: linear-gradient(135deg, rgba(156, 39, 176, 0.1), rgba(123, 31, 162, 0.1));
            border: 1px solid rgba(156, 39, 176, 0.3);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin: 25px 0;
        }
        
        .apology p {
            color: #e0e0e0;
            font-size: 16px;
            font-style: italic;
        }
        
        .footer {
            background: linear-gradient(135deg, #2d2d44 0%, #1e1e2e 100%);
            padding: 30px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .signature {
            font-size: 18px;
            font-weight: 600;
            color: #f44336;
            margin-bottom: 10px;
        }
        
        .company-name {
            font-size: 16px;
            color: #888;
            margin-bottom: 20px;
        }
        
        .disclaimer {
            font-size: 12px;
            color: #666;
            font-style: italic;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
        }
        
        @media (max-width: 600px) {
            .transaction-grid {
                grid-template-columns: 1fr;
            }
            
            .content, .header {
                padding: 25px 20px;
            }
            
            .header h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <span class="rejection-icon">❌</span>
            <h1>Topup Rejected</h1>
            <p>Your transaction could not be processed</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                Dear <strong>{{ $transaction->buyer_name }}</strong>,
            </div>
            
            <div class="section">
                <h2 class="section-title">Transaction Details</h2>
                <div class="transaction-grid">
                    <div class="transaction-item">
                        <div class="item-label">Game</div>
                        <div class="item-value">{{ $transaction->game->name }}</div>
                    </div>
                    <div class="transaction-item">
                        <div class="item-label">Package</div>
                        <div class="item-value">{{ $transaction->topupPackage->name }}</div>
                    </div>
                    <div class="transaction-item">
                        <div class="item-label">Amount</div>
                        <div class="item-value highlight">{{ number_format($transaction->topupPackage->amount) }} {{ $transaction->game->currency_unit }}</div>
                    </div>
                    <div class="transaction-item">
                        <div class="item-label">Player ID</div>
                        <div class="item-value">{{ $transaction->player_id }}</div>
                    </div>
                    @if($transaction->player_server)
                    <div class="transaction-item">
                        <div class="item-label">Server</div>
                        <div class="item-value">{{ $transaction->player_server }}</div>
                    </div>
                    @endif
                    <div class="transaction-item">
                        <div class="item-label">Price</div>
                        <div class="item-value highlight">Rp {{ number_format($transaction->price, 2, ',', '.') }}</div>
                    </div>
                    <div class="transaction-item full-width">
                        <div class="item-label">Transaction ID</div>
                        <div class="item-value">{{ $transaction->id }}</div>
                    </div>
                </div>
            </div>
            
            <div class="rejection-reason">
                <h3>Reason for Rejection</h3>
                <p>{{ $rejectionReason }}</p>
            </div>
            
            <div class="next-steps">
                <h3>What happens next?</h3>
                <ul>
                    <li>Your payment will be refunded according to our refund policy</li>
                    <li>You may try to make a new transaction if the issue can be resolved</li>
                    <li>If you believe this is an error, please contact our support team</li>
                </ul>
            </div>
            
            <div class="support-section">
                <h3>Need help?</h3>
                <p>If you have any questions about this rejection or need assistance, please contact our support team on Discord.</p>
            </div>
            
            <div class="apology">
                <p>We apologize for any inconvenience this may have caused.</p>
            </div>
        </div>
        
        <div class="footer">
            <div class="signature">Best regards, Ranconnity</div>
            <div class="company-name">{{ config('app.name') }}</div>
            <div class="disclaimer">
                This is an automated message. Please do not reply to this email.
            </div>
        </div>
    </div>
</body>
</html> 