<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Topup Game</title>
    
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

        .payment-card {
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

        .payment-card::before {
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

        .payment-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.5rem;
            color: var(--retro-cyan);
            text-shadow: 0 0 10px var(--retro-cyan);
            margin-bottom: 1.5rem;
            text-align: center;
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

        .qris-section {
            text-align: center;
            margin: 2rem 0;
        }

        .qris-title {
            font-family: 'Orbitron', monospace;
            color: var(--retro-yellow);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .qris-image {
            max-width: 300px;
            border: 3px solid var(--retro-yellow);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255, 255, 0, 0.3);
            margin-bottom: 1rem;
        }

        .payment-instructions {
            background: rgba(255, 255, 0, 0.1);
            border: 2px solid var(--retro-yellow);
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .instructions-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.2rem;
            color: var(--retro-yellow);
            text-align: center;
            margin-bottom: 1rem;
        }

        .instruction-step {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 8px;
        }

        .step-number {
            background: var(--retro-yellow);
            color: var(--dark-bg);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1rem;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.8rem;
        }

        .step-text {
            color: var(--text-primary);
            font-size: 1rem;
        }

        .confirm-section {
            text-align: center;
            margin: 2rem 0;
        }

        .btn-confirm {
            background: linear-gradient(135deg, var(--retro-green) 0%, var(--retro-cyan) 100%);
            border: 3px solid var(--retro-green);
            color: white;
            font-family: 'Press Start 2P', monospace;
            font-size: 1rem;
            text-transform: uppercase;
            padding: 1rem 2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-weight: bold;
        }

        .btn-confirm::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-confirm:hover::before {
            left: 100%;
        }

        .btn-confirm:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 255, 65, 0.4);
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

        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: var(--retro-yellow);
            border: 2px solid var(--retro-yellow);
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
            .payment-card {
                padding: 1.5rem;
            }
            .qris-image {
                max-width: 250px;
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
            <div class="col-md-9 ms-sm-auto col-lg-10 px-0 main-content">
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
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="glitch-title">PAYMENT</h1>
            <p class="hero-subtitle">Complete your topup transaction</p>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Transaction Details -->
            <div class="payment-card">
                <h3 class="payment-title">
                    <i class="bi bi-receipt me-2"></i>
                    Transaction Details
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
                         <span class="detail-label">Email:</span>
                         <span class="detail-value">{{ $transaction->buyer_email }}</span>
                     </div>
                     <div class="detail-row">
                         <span class="detail-label">Status:</span>
                         <span class="status-badge status-pending">Pending</span>
                     </div>
                     <div class="detail-row">
                         <span class="detail-label">Total Amount:</span>
                         <span class="detail-value amount-highlight">Rp {{ number_format($transaction->price, 2, ',', '.') }}</span>
                     </div>
                </div>
            </div>

            <!-- QRIS Payment Section -->
            <div class="payment-card">
                <h3 class="payment-title">
                    <i class="bi bi-qr-code me-2"></i>
                    QRIS Payment
                </h3>
                
                <div class="qris-section">
                    <div class="qris-title">Scan QR Code to Pay</div>
                    <img src="https://ranconnity.site/public/image/gopay.png" alt="QRIS QR Code" class="qris-image">
                    <p class="text-muted">Use any e-wallet app to scan this QR code</p>
                </div>

                <div class="payment-instructions">
                    <h4 class="instructions-title">
                        <i class="bi bi-info-circle me-2"></i>
                        Payment Instructions
                    </h4>
                    
                    <div class="instruction-step">
                        <div class="step-number">1</div>
                        <div class="step-text">Open your e-wallet app (GoPay, OVO, DANA, etc.)</div>
                    </div>
                    
                    <div class="instruction-step">
                        <div class="step-number">2</div>
                        <div class="step-text">Scan the QR code above</div>
                    </div>
                    
                    <div class="instruction-step">
                        <div class="step-number">3</div>
                        <div class="step-text">Enter the amount: <strong>Rp {{ number_format($transaction->price, 2, ',', '.') }}</strong></div>
                    </div>
                    
                    <div class="instruction-step">
                        <div class="step-number">4</div>
                        <div class="step-text">Complete the payment</div>
                    </div>
                    
                    <div class="instruction-step">
                        <div class="step-number">5</div>
                        <div class="step-text">Click the button below to confirm payment</div>
                    </div>
                </div>

                <div class="confirm-section">
                    <form action="{{ route('topup.confirm-payment', $transaction->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-confirm">
                            <i class="bi bi-check-circle me-2"></i>
                            I Have Made the Payment
                        </button>
                    </form>
                    
                    <p class="text-muted mt-3">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Important:</strong> Only click this button after you have completed the payment!
                    </p>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="payment-card">
                <h3 class="payment-title">
                    <i class="bi bi-clock me-2"></i>
                    What Happens Next?
                </h3>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="text-center">
                            <i class="bi bi-1-circle text-primary" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">Payment Confirmation</h5>
                            <p class="text-muted">Click the button above after payment</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="text-center">
                            <i class="bi bi-2-circle text-warning" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">Admin Verification</h5>
                            <p class="text-muted">We'll verify your payment manually</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="text-center">
                            <i class="bi bi-3-circle text-success" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">Topup Delivery</h5>
                            <p class="text-muted">Items will be added within 24 hours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 