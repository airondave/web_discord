<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Us - Buy Me a Coffee | Ranconnity</title>
    
    <!-- Favicon -->
    <link rel="icon" type="/public/image/x-icon" href="/public/image/favicon.ico">
    <link rel="icon" type="/public/image/png" sizes="32x32" href="/public/image/favicon-32x32.png">
    <link rel="icon" type="/public/image/png" sizes="16x16" href="/public/image/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/image/apple-touch-icon.png">
    
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
            --retro-orange: #ff6b00;
            --dark-bg: #0a0a0a;
            --card-bg: #1a1a1a;
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --pixel-border: #333333;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a0a2e 50%, #0f0f23 100%);
            min-height: 100vh;
            font-family: 'Rajdhani', sans-serif;
            color: var(--text-primary);
            overflow-x: hidden;
            position: relative;
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

        /* Retro Scanlines */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0, 255, 65, 0.03) 2px,
                rgba(0, 255, 65, 0.03) 4px
            );
            pointer-events: none;
            z-index: -1;
            animation: scanlines 0.1s linear infinite;
        }

        @keyframes scanlines {
            0% { transform: translateY(0); }
            100% { transform: translateY(4px); }
        }

        /* Navigation */
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
            position: relative;
        }

        .nav-link:hover {
            color: var(--retro-cyan);
            text-shadow: 0 0 5px var(--retro-cyan);
        }

        /* Main Content */
        .main-content {
            padding: 8rem 0 4rem;
            min-height: 100vh;
        }

        .support-hero {
            text-align: center;
            margin-bottom: 4rem;
        }

        .support-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 3rem;
            color: var(--retro-orange);
            text-shadow: 
                0 0 10px var(--retro-orange),
                0 0 20px var(--retro-orange),
                0 0 30px var(--retro-orange);
            margin-bottom: 1.5rem;
            animation: coffeeGlow 2s ease-in-out infinite;
        }

        @keyframes coffeeGlow {
            0%, 100% { 
                text-shadow: 
                    0 0 10px var(--retro-orange),
                    0 0 20px var(--retro-orange),
                    0 0 30px var(--retro-orange);
            }
            50% { 
                text-shadow: 
                    0 0 15px var(--retro-orange),
                    0 0 30px var(--retro-orange),
                    0 0 45px var(--retro-orange);
            }
        }

        .support-subtitle {
            font-family: 'Orbitron', monospace;
            font-size: 1.3rem;
            color: var(--retro-cyan);
            margin-bottom: 2rem;
            text-shadow: 0 0 10px var(--retro-cyan);
        }

        /* Coffee Cards */
        .coffee-card {
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.9) 0%, rgba(42, 42, 42, 0.9) 100%);
            border: 2px solid var(--retro-orange);
            border-radius: 15px;
            position: relative;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 
                0 0 20px rgba(255, 107, 0, 0.3),
                inset 0 0 20px rgba(255, 107, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .coffee-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--retro-orange), var(--retro-yellow), var(--retro-red), var(--retro-purple));
            z-index: -1;
            border-radius: 15px;
            animation: cardBorderGlow 3s linear infinite;
        }

        @keyframes cardBorderGlow {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 0.4; }
        }

        .coffee-card:hover {
            transform: translateY(-10px);
            box-shadow: 
                0 20px 40px rgba(255, 107, 0, 0.5),
                inset 0 0 30px rgba(255, 107, 0, 0.2);
        }

        .coffee-icon {
            font-size: 4rem;
            color: var(--retro-orange);
            margin-bottom: 1.5rem;
            animation: coffeeFloat 3s ease-in-out infinite;
        }

        @keyframes coffeeFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .coffee-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.5rem;
            color: var(--retro-yellow);
            text-shadow: 0 0 10px var(--retro-yellow);
            margin-bottom: 1.5rem;
        }

        .coffee-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 2rem;
        }

        /* Trakteer Button */
        .trakteer-btn {
            background: linear-gradient(135deg, var(--retro-orange) 0%, var(--retro-red) 100%);
            border: 3px solid var(--retro-orange);
            color: white;
            font-family: 'Press Start 2P', monospace;
            font-size: 1rem;
            text-transform: uppercase;
            padding: 1.5rem 3rem;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            margin: 0.5rem;
            border-radius: 10px;
            box-shadow: 
                0 0 30px rgba(255, 107, 0, 0.6),
                0 0 60px rgba(255, 107, 0, 0.4),
                inset 0 0 30px rgba(255, 255, 255, 0.1);
            animation: trakteerGlow 2s ease-in-out infinite;
        }

        @keyframes trakteerGlow {
            0%, 100% { 
                box-shadow: 
                    0 0 30px rgba(255, 107, 0, 0.6),
                    0 0 60px rgba(255, 107, 0, 0.4),
                    inset 0 0 30px rgba(255, 255, 255, 0.1);
                transform: scale(1);
            }
            50% { 
                box-shadow: 
                    0 0 40px rgba(255, 107, 0, 0.8),
                    0 0 80px rgba(255, 107, 0, 0.6),
                    inset 0 0 40px rgba(255, 255, 255, 0.2);
                transform: scale(1.02);
            }
        }

        .trakteer-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .trakteer-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 
                0 15px 30px rgba(255, 107, 0, 0.8),
                0 0 80px rgba(255, 107, 0, 0.6),
                inset 0 0 40px rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
            animation: none;
            background: linear-gradient(135deg, var(--retro-red) 0%, var(--retro-purple) 100%);
        }

        .trakteer-btn:hover::before {
            left: 100%;
        }

        .trakteer-btn::after {
            content: '☕';
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: 1.5rem;
            animation: coffeeRotate 3s linear infinite;
        }

        @keyframes coffeeRotate {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.2); }
            100% { transform: rotate(360deg) scale(1); }
        }

        .trakteer-btn:hover::after {
            animation: coffeeRotate 0.5s linear infinite;
            font-size: 2rem;
        }

        /* Support Options */
        .support-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 4rem 0;
        }

        .support-info {
            background: rgba(0, 255, 65, 0.05);
            border: 2px solid rgba(0, 255, 65, 0.3);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
        }

        .support-info h4 {
            font-family: 'Press Start 2P', monospace;
            color: var(--retro-green);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .support-info p {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-secondary);
        }

        /* Thank You Message */
        .thank-you-section {
            text-align: center;
            margin: 4rem 0;
            padding: 3rem;
            background: linear-gradient(135deg, rgba(255, 0, 255, 0.1) 0%, rgba(0, 255, 255, 0.1) 100%);
            border: 2px solid var(--retro-purple);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
        }

        .thank-you-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: thankYouShine 3s linear infinite;
        }

        @keyframes thankYouShine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .thank-you-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.8rem;
            color: var(--retro-purple);
            text-shadow: 0 0 15px var(--retro-purple);
            margin-bottom: 1.5rem;
        }

        .thank-you-text {
            font-size: 1.2rem;
            color: var(--text-primary);
            line-height: 1.8;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .support-title {
                font-size: 2rem;
            }
            .support-subtitle {
                font-size: 1.1rem;
            }
            .coffee-card {
                padding: 2rem;
            }
            .coffee-title {
                font-size: 1.2rem;
            }
            .trakteer-btn {
                font-size: 0.9rem;
                padding: 1.2rem 2.5rem;
            }
            .support-options {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .support-title {
                font-size: 1.5rem;
            }
            .coffee-title {
                font-size: 1rem;
            }
            .trakteer-btn {
                font-size: 0.8rem;
                padding: 1rem 2rem;
            }
            .thank-you-title {
                font-size: 1.3rem;
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
                    <a class="nav-link" href="https://discord.gg/CdpPfKUK4p">Join Server</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/gallery">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/support">Support</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="main-content">
    <div class="container">
        <!-- Hero Section -->
        <div class="support-hero">
            <h1 class="support-title">
                <i class="bi bi-cup-hot me-3"></i>
                BUY ME COFFEE
            </h1>
            <p class="support-subtitle">
                Support the development and maintenance of Ranconnity Website Server!
            </p>
        </div>

        <!-- Coffee Support Card -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="coffee-card text-center">
                    <div class="coffee-icon">
                        <i class="bi bi-cup-hot-fill"></i>
                    </div>
                    <h2 class="coffee-title">Support Our Community</h2>
                    <p class="coffee-description">
                        Hi! I'm <strong>Layron</strong>, the co-founder of Ranconnity. Running this Discord server and maintaining 
                        our web platform takes time, effort, and resources. Your support helps me keep the community 
                        active, host events, maintain servers, and create new features for everyone to enjoy!
                        <br><br>
                        Every coffee you buy goes directly toward improving our community experience. 
                        Whether it's server hosting, bot development, or organizing gaming events - 
                        your support makes it all possible! ☕✨
                    </p>
                    
                    <!-- Trakteer Button -->
                    <a href="https://trakteer.id/venla/tip" class="trakteer-btn" target="_blank">
                        <i class="bi bi-heart-fill me-2"></i>
                        Buy Me Coffee on Trakteer
                    </a>
                    
                    <p style="margin-top: 2rem; color: var(--text-secondary); font-size: 0.9rem;">
                        <i class="bi bi-info-circle me-2"></i>
                        Secure payment powered by Trakteer.id
                    </p>
                </div>
            </div>
        </div>

        <!-- Support Information -->
        <div class="support-options">
            <div class="support-info">
                <h4><i class="bi bi-shield-check me-2"></i>Secure Payment</h4>
                <p>All transactions are processed securely through Trakteer.id, Indonesia's trusted creator support platform.</p>
            </div>
            <div class="support-info">
                <h4><i class="bi bi-heart me-2"></i>Direct Support</h4>
                <p>100% of your contribution goes directly to supporting the community and server maintenance.</p>
            </div>
            <div class="support-info">
                <h4><i class="bi bi-star me-2"></i>Special Thanks</h4>
                <p>Supporters get special recognition in our Discord server and may receive exclusive perks!</p>
            </div>
        </div>

        <!-- Thank You Section -->
        <div class="thank-you-section">
            <h3 class="thank-you-title">
                <i class="bi bi-emoji-heart-eyes me-2"></i>
                THANK YOU!
            </h3>
            <p class="thank-you-text">
                "Every contribution, no matter the size, means the world to me and our community. 
                Your support helps keep Ranconnity alive and thriving."
                <br><br>
                <strong>- Atthariq & The Ranconnity Team</strong> 💙
            </p>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Coffee floating animation enhancement
        const coffeeIcon = document.querySelector('.coffee-icon i');
        setInterval(() => {
            if (Math.random() > 0.9) {
                coffeeIcon.style.transform = 'translateY(-10px) rotate(5deg)';
                setTimeout(() => {
                    coffeeIcon.style.transform = 'translateY(0px) rotate(0deg)';
                }, 200);
            }
        }, 2000);

        // Trakteer button hover effects enhancement
        const trakteerBtn = document.querySelector('.trakteer-btn');
        trakteerBtn.addEventListener('mouseenter', function() {
            // Add extra sparkle effect on hover
            this.style.boxShadow = `
                0 20px 40px rgba(255, 107, 0, 0.8),
                0 0 100px rgba(255, 107, 0, 0.6),
                inset 0 0 50px rgba(255, 255, 255, 0.3)
            `;
        });

        // Add sparkle effects to support cards
        const supportCards = document.querySelectorAll('.support-info');
        supportCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 10px 30px rgba(0, 255, 65, 0.3)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });

        // Random glitch effect for title
        const title = document.querySelector('.support-title');
        setInterval(() => {
            if (Math.random() > 0.95) {
                title.style.transform = `translateX(${Math.random() * 4 - 2}px)`;
                setTimeout(() => {
                    title.style.transform = 'translateX(0)';
                }, 100);
            }
        }, 100);
    });
</script>

</body>
</html>