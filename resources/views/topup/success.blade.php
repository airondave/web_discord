<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmed - Topup Game</title>
    
    <!-- Favicon -->
    <link rel="icon" type="/public/image/x-icon" href="/public/image/favicon.ico">
    <link rel="icon" type="/public/image/png" sizes="32x32" href="/public/image/favicon-32x32.png">
    <link rel="icon" type="/public/image/png" sizes="16x16" href="/public/image/favicon-16x16.png">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --retro-green: #00ff41;
            --retro-purple: #ff00ff;
            --retro-cyan: #00ffff;
            --retro-yellow: #ffff00;
            --retro-red: #ff0040;
            --retro-pink: #ff1493;
            --dark-bg: #0a0a0a;
            --card-bg: #1a1a1a;
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --pixel-border: #333333;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a0a2e 50%, #0f0f23 100%);
            min-height: 100vh;
            font-family: 'Rajdhani', sans-serif;
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Retro Grid Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 65, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 65, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
            pointer-events: none;
            z-index: -2;
        }

        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .navbar {
            background: rgba(26, 26, 26, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--retro-green);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.2rem;
            color: var(--retro-green);
            text-shadow: 0 0 10px var(--retro-green);
        }

        .nav-link {
            color: var(--text-primary);
            font-family: 'Orbitron', monospace;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .hero-section {
            padding: 8rem 0 4rem;
            text-align: center;
        }

        .glitch-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 3rem;
            color: var(--retro-green);
            text-shadow: 0 0 10px var(--retro-green);
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--retro-cyan);
            font-family: 'Orbitron', monospace;
            margin-bottom: 3rem;
        }

        .success-card {
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.9) 0%, rgba(42, 42, 42, 0.9) 100%);
            border: 2px solid var(--retro-green);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .success-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--retro-green), var(--retro-cyan), var(--retro-purple), var(--retro-yellow));
            z-index: -1;
            border-radius: 15px;
            animation: borderGlow 3s linear infinite;
        }

        @keyframes borderGlow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .success-icon {
            font-size: 5rem;
            color: var(--retro-green);
            text-shadow: 0 0 20px var(--retro-green);
            margin-bottom: 1rem;
            animation: successPulse 2s ease-in-out infinite;
        }

        @keyframes successPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .success-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.8rem;
            color: var(--retro-green);
            text-shadow: 0 0 10px var(--retro-green);
            margin-bottom: 1rem;
        }

        .success-message {
            font-size: 1.2rem;
            color: var(--retro-cyan);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .transaction-details {
            background: rgba(0, 255, 65, 0.1);
            border: 2px solid var(--retro-green);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(0, 255, 65, 0.3);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-family: 'Orbitron', monospace;
            color: var(--retro-green);
            font-weight: 600;
        }

        .detail-value {
            font-family: 'Rajdhani', sans-serif;
            color: var(--text-primary);
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-family: 'Orbitron', monospace;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .status-paid {
            background: rgba(40, 167, 69, 0.2);
            color: var(--retro-green);
            border: 2px solid var(--retro-green);
        }

        .next-steps {
            background: rgba(255, 255, 0, 0.1);
            border: 2px solid var(--retro-yellow);
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .steps-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.2rem;
            color: var(--retro-yellow);
            text-align: center;
            margin-bottom: 1rem;
        }

        .step-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }

        .step-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
            width: 40px;
            text-align: center;
        }

        .step-icon.pending {
            color: var(--retro-yellow);
        }

        .step-icon.completed {
            color: var(--retro-green);
        }

        .step-text {
            color: var(--text-primary);
            font-size: 1rem;
        }

        .action-buttons {
            text-align: center;
            margin: 2rem 0;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--retro-purple) 0%, var(--retro-cyan) 100%);
            border: 3px solid var(--retro-purple);
            color: white;
            font-family: 'Press Start 2P', monospace;
            font-size: 1rem;
            text-transform: uppercase;
            padding: 1rem 2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 0, 255, 0.4);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--retro-yellow) 0%, var(--retro-orange) 100%);
            border: 3px solid var(--retro-yellow);
            color: var(--dark-bg);
            font-family: 'Press Start 2P', monospace;
            font-size: 1rem;
            text-transform: uppercase;
            padding: 1rem 2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 0.5rem;
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 255, 0, 0.4);
            color: var(--dark-bg);
        }

        .amount-highlight {
            background: linear-gradient(135deg, var(--retro-yellow), var(--retro-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Press Start 2P', monospace;
            font-size: 1.8rem;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .glitch-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .success-card {
                padding: 1.5rem;
            }
            .success-icon {
                font-size: 4rem;
            }
            .success-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-controller me-2"></i>
                RANCONNITY
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/topup">Topup</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/gallery">Gallery</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="glitch-title">PAYMENT CONFIRMED!</h1>
            <p class="hero-subtitle">Your topup transaction has been submitted successfully</p>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Success Card -->
            <div class="success-card">
                <div class="success-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                
                <h2 class="success-title">Payment Confirmed!</h2>
                <p class="success-message">
                    Thank you for your payment! Your transaction has been submitted and is now waiting for admin verification.
                    You will receive an email confirmation once the verification is complete.
                </p>
            </div>

            <!-- Transaction Details -->
            <div class="success-card">
                <h3 class="success-title">
                    <i class="bi bi-receipt me-2"></i>
                    Transaction Summary
                </h3>
                
                <div class="transaction-details">
                    <div class="detail-row">
                        <span class="detail-label">Transaction ID:</span>
                        <span class="detail-value">#{{ $transaction->id }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Game:</span>
                        <span class="detail-value">{{ $transaction->game->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Package:</span>
                        <span class="detail-value">{{ $transaction->topupPackage->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Amount:</span>
                        <span class="detail-value">{{ number_format($transaction->topupPackage->amount) }} {{ $transaction->game->currency_unit }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Player ID:</span>
                        <span class="detail-value">{{ $transaction->player_id }}</span>
                    </div>
                    @if($transaction->player_server)
                    <div class="detail-row">
                        <span class="detail-label">Server:</span>
                        <span class="detail-value">{{ $transaction->player_server }}</span>
                    </div>
                    @endif
                    <div class="detail-row">
                        <span class="detail-label">Payment Method:</span>
                        <span class="detail-value">{{ $transaction->paymentMethod->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="status-badge status-paid">Paid</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Total Amount:</span>
                        <span class="detail-value amount-highlight">Rp {{ number_format($transaction->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Payment Reference:</span>
                        <span class="detail-value">{{ $transaction->payment_reference }}</span>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h4 class="steps-title">
                    <i class="bi bi-list-check me-2"></i>
                    What Happens Next?
                </h4>
                
                <div class="step-item">
                    <div class="step-icon completed">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="step-text">
                        <strong>Payment Confirmed:</strong> You have confirmed your payment
                    </div>
                </div>
                
                <div class="step-item">
                    <div class="step-icon pending">
                        <i class="bi bi-clock"></i>
                    </div>
                    <div class="step-text">
                        <strong>Admin Verification:</strong> We will manually verify your payment (usually within 1-2 hours)
                    </div>
                </div>
                
                <div class="step-item">
                    <div class="step-icon pending">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div class="step-text">
                        <strong>Email Confirmation:</strong> You will receive a verification email once confirmed
                    </div>
                </div>
                
                <div class="step-item">
                    <div class="step-icon pending">
                        <i class="bi bi-gamepad"></i>
                    </div>
                    <div class="step-text">
                        <strong>Topup Delivery:</strong> Items will be added to your account within 24 hours
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="/topup" class="btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Make Another Topup
                </a>
                
                <a href="/" class="btn-secondary">
                    <i class="bi bi-house me-2"></i>
                    Back to Home
                </a>
            </div>

            <!-- Important Notes -->
            <div class="success-card">
                <h4 class="success-title">
                    <i class="bi bi-info-circle me-2"></i>
                    Important Information
                </h4>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="text-center">
                            <i class="bi bi-clock text-warning" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">Verification Time</h5>
                            <p class="text-muted">Payment verification usually takes 1-2 hours during business hours</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="text-center">
                            <i class="bi bi-envelope text-info" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">Email Notifications</h5>
                            <p class="text-muted">Check your email for status updates and confirmations</p>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info mt-3">
                    <i class="bi bi-lightbulb me-2"></i>
                    <strong>Tip:</strong> Keep this transaction ID (#{{ $transaction->id }}) handy for any support inquiries.
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 