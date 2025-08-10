<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Critics & Advice - Ranconnity Gaming Community</title>
    
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 2rem 0;
            margin-top: 80px;
        }

        .content-container {
            max-width: 800px;
            width: 100%;
            position: relative;
        }

        .page-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            color: var(--retro-green);
            text-shadow: 
                0 0 5px var(--retro-green),
                0 0 10px var(--retro-green),
                0 0 20px var(--retro-green);
            animation: glitch 2s infinite;
        }

        @keyframes glitch {
            0%, 98% { 
                color: var(--retro-green);
                text-shadow: 
                    0 0 5px var(--retro-green),
                    0 0 10px var(--retro-green),
                    0 0 20px var(--retro-green);
            }
            99% { 
                color: var(--retro-purple);
                text-shadow: 
                    2px 0 var(--retro-cyan),
                    -2px 0 var(--retro-yellow),
                    0 0 20px var(--retro-purple);
            }
        }

        .page-subtitle {
            text-align: center;
            font-size: 1.3rem;
            color: var(--retro-cyan);
            font-family: 'Orbitron', monospace;
            margin-bottom: 3rem;
            text-shadow: 0 0 10px var(--retro-cyan);
        }

        /* Retro Cards */
        .retro-card {
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.9) 0%, rgba(42, 42, 42, 0.9) 100%);
            border: 2px solid var(--retro-green);
            border-radius: 0;
            position: relative;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 
                0 0 20px rgba(0, 255, 65, 0.3),
                inset 0 0 20px rgba(0, 255, 65, 0.1);
            transition: all 0.3s ease;
        }

        .retro-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--retro-green), var(--retro-cyan), var(--retro-purple), var(--retro-yellow));
            z-index: -1;
            border-radius: 0;
            animation: borderGlow 3s linear infinite;
        }

        @keyframes borderGlow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .retro-card:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 10px 40px rgba(0, 255, 65, 0.4),
                inset 0 0 30px rgba(0, 255, 65, 0.2);
        }

        .card-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.2rem;
            color: var(--retro-cyan);
            text-shadow: 0 0 10px var(--retro-cyan);
            margin-bottom: 1rem;
        }

        .card-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-primary);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: var(--retro-cyan);
            font-family: 'Orbitron', monospace;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 5px var(--retro-cyan);
        }

        .form-control {
            background: rgba(26, 26, 26, 0.8);
            border: 2px solid var(--retro-green);
            border-radius: 0;
            color: var(--text-primary);
            font-family: 'Rajdhani', sans-serif;
            font-size: 1rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(26, 26, 26, 0.9);
            border-color: var(--retro-cyan);
            box-shadow: 
                0 0 15px rgba(0, 255, 255, 0.5),
                inset 0 0 10px rgba(0, 255, 255, 0.1);
            color: var(--text-primary);
            outline: none;
        }

        .form-control::placeholder {
            color: var(--text-secondary);
            opacity: 0.7;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Submit Button */
        .submit-btn {
            background: linear-gradient(135deg, var(--retro-purple) 0%, var(--retro-red) 100%);
            border: 3px solid var(--retro-purple);
            color: white;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.9rem;
            text-transform: uppercase;
            padding: 1rem 2.5rem;
            border-radius: 0;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            margin: 1rem 0;
            width: 100%;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 10px 20px rgba(255, 0, 255, 0.4),
                0 0 30px rgba(255, 0, 255, 0.3);
            color: white;
            text-decoration: none;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        /* Back Button */
        .back-btn {
            background: linear-gradient(135deg, var(--retro-yellow) 0%, var(--retro-red) 100%);
            border: 3px solid var(--retro-yellow);
            color: white;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.8rem;
            text-transform: uppercase;
            padding: 0.8rem 2rem;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            margin: 1rem 0;
            text-align: center;
        }

        .back-btn:hover {
            background: linear-gradient(135deg, var(--retro-yellow) 0%, var(--retro-purple) 100%);
            border-color: var(--retro-yellow);
            box-shadow: 
                0 10px 20px rgba(255, 255, 0, 0.4),
                0 0 30px rgba(255, 255, 0, 0.3);
            color: white;
            text-decoration: none;
            transform: translateY(-3px);
        }

        /* Alert Styles */
        .alert {
            border: 2px solid;
            border-radius: 0;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
        }

        .alert-success {
            background: rgba(0, 255, 65, 0.1);
            border-color: var(--retro-green);
            color: var(--retro-green);
        }

        .alert-danger {
            background: rgba(255, 0, 64, 0.1);
            border-color: var(--retro-red);
            color: var(--retro-red);
        }

        /* Floating Retro Icons */
        .floating-retro-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-retro-icon {
            position: absolute;
            font-size: 2rem;
            color: var(--retro-green);
            opacity: 0.3;
            animation: floatRetro 15s linear infinite;
        }

        .floating-retro-icon:nth-child(1) { left: 10%; animation-delay: 0s; color: var(--retro-green); }
        .floating-retro-icon:nth-child(2) { left: 30%; animation-delay: 3s; color: var(--retro-cyan); }
        .floating-retro-icon:nth-child(3) { left: 50%; animation-delay: 6s; color: var(--retro-purple); }
        .floating-retro-icon:nth-child(4) { left: 70%; animation-delay: 9s; color: var(--retro-yellow); }
        .floating-retro-icon:nth-child(5) { left: 90%; animation-delay: 12s; color: var(--retro-red); }

        @keyframes floatRetro {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }
            .page-subtitle {
                font-size: 1.1rem;
            }
            .retro-card {
                padding: 1.5rem;
            }
            .submit-btn {
                font-size: 0.8rem;
                padding: 0.8rem 2rem;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.5rem;
            }
            .page-subtitle {
                font-size: 1rem;
            }
            .submit-btn {
                font-size: 0.7rem;
                padding: 0.7rem 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Floating Retro Icons -->
<div class="floating-retro-icons">
    <i class="bi bi-controller floating-retro-icon"></i>
    <i class="bi bi-joystick floating-retro-icon"></i>
    <i class="bi bi-cpu floating-retro-icon"></i>
    <i class="bi bi-headphones floating-retro-icon"></i>
    <i class="bi bi-discord floating-retro-icon"></i>
</div>

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
                    <a class="nav-link" href="/support">
                        <i class="bi bi-cup-hot me-1"></i>Support
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<section class="main-content">
    <div class="container content-container">
        <h1 class="page-title">CRITICS & ADVICE</h1>
        <p class="page-subtitle">Share Your Thoughts With Us</p>
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Form Card -->
        <div class="retro-card">
            <h3 class="card-title text-center">
                <i class="bi bi-chat-heart me-2"></i>
                Feedback Form
            </h3>
            <p class="card-text text-center mb-4">
                We value your opinion! Share your thoughts, suggestions, or any feedback you have about our community. 
                Your input helps us improve and create a better experience for everyone.
            </p>

            <form action="{{ route('critics.advice.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="sender_name" class="form-label">
                        <i class="bi bi-person me-2"></i>Your Name
                    </label>
                    <input type="text" 
                           class="form-control @error('sender_name') is-invalid @enderror" 
                           id="sender_name" 
                           name="sender_name" 
                           value="{{ old('sender_name') }}"
                           placeholder="Enter your name"
                           required>
                </div>

                <div class="form-group">
                    <label for="sender_email" class="form-label">
                        <i class="bi bi-envelope me-2"></i>Your Email
                    </label>
                    <input type="email" 
                           class="form-control @error('sender_email') is-invalid @enderror" 
                           id="sender_email" 
                           name="sender_email" 
                           value="{{ old('sender_email') }}"
                           placeholder="Enter your email address"
                           required>
                    <small class="text-muted">We'll use this to send you a response</small>
                </div>

                <div class="form-group">
                    <label for="messages" class="form-label">
                        <i class="bi bi-chat-text me-2"></i>Your Message
                    </label>
                    <textarea class="form-control @error('messages') is-invalid @enderror" 
                              id="messages" 
                              name="messages" 
                              placeholder="Share your thoughts, suggestions, or feedback here..."
                              required>{{ old('messages') }}</textarea>
                    <small class="text-muted">Maximum 1000 characters</small>
                </div>

                <div class="text-center">
                    <button type="submit" class="submit-btn">
                        <i class="bi bi-send me-2"></i>
                        Send Feedback
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="/" class="back-btn">
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Home
                </a>
            </div>
        </div>

        <!-- Info Card -->
        <div class="retro-card">
            <h3 class="card-title text-center">
                <i class="bi bi-info-circle me-2"></i>
                What Happens Next?
            </h3>
            <div class="row">
                <div class="col-md-4 text-center mb-3">
                    <i class="bi bi-eye" style="font-size: 2.5rem; color: var(--retro-cyan); margin-bottom: 1rem;"></i>
                    <h5 style="color: var(--retro-cyan);">We Review</h5>
                    <p class="card-text">Our team carefully reads every piece of feedback</p>
                </div>
                <div class="col-md-4 text-center mb-3">
                    <i class="bi bi-chat-dots" style="font-size: 2.5rem; color: var(--retro-purple); margin-bottom: 1rem;"></i>
                    <h5 style="color: var(--retro-purple);">We Respond</h5>
                    <p class="card-text">You'll receive a personalized response via email</p>
                </div>
                <div class="col-md-4 text-center mb-3">
                    <i class="bi bi-lightbulb" style="font-size: 2.5rem; color: var(--retro-yellow); margin-bottom: 1rem;"></i>
                    <h5 style="color: var(--retro-yellow);">We Improve</h5>
                    <p class="card-text">Your feedback helps shape our community</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add retro typing effect
        const title = document.querySelector('.page-title');
        setInterval(() => {
            if (Math.random() > 0.95) {
                title.style.transform = `translateX(${Math.random() * 4 - 2}px)`;
                setTimeout(() => {
                    title.style.transform = 'translateX(0)';
                }, 100);
            }
        }, 100);

        // Retro card hover sound effect (visual)
        const cards = document.querySelectorAll('.retro-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.boxShadow = `
                    0 10px 40px rgba(0, 255, 65, 0.6),
                    inset 0 0 30px rgba(0, 255, 65, 0.3)
                `;
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.boxShadow = `
                    0 0 20px rgba(0, 255, 65, 0.3),
                    inset 0 0 20px rgba(0, 255, 65, 0.1)
                `;
            });
        });

        // Form validation enhancement
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('.submit-btn');
        
        form.addEventListener('submit', function() {
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Sending...';
            submitBtn.disabled = true;
        });
    });
</script>

</body>
</html> 