<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Ranconnity Discord Verification</title>
    
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
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-glow: #00d4ff;
            --secondary-glow: #7c3aed;
            --accent-glow: #06ffa5;
            --danger-glow: #ff3366;
            --dark-bg: #0a0a0a;
            --card-bg: #1a1a1a;
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --border-glow: rgba(0, 212, 255, 0.3);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
            min-height: 100vh;
            font-family: 'Rajdhani', sans-serif;
            color: var(--text-primary);
            overflow-x: hidden;
            position: relative;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(0, 212, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(124, 58, 237, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(6, 255, 165, 0.05) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(2deg); }
            66% { transform: translateY(-10px) rotate(-1deg); }
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .login-card {
            background: rgba(26, 26, 26, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-glow);
            border-radius: 20px;
            box-shadow: 
                0 0 50px rgba(0, 212, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            max-width: 450px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary-glow), transparent);
            animation: scan 3s linear infinite;
        }

        @keyframes scan {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .login-header {
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
            border: none;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 1px solid var(--border-glow);
        }

        .header-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.8rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary-glow) 0%, var(--secondary-glow) 50%, var(--accent-glow) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .header-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            font-weight: 300;
            margin-bottom: 0;
        }

        .card-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            color: var(--primary-glow);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 212, 255, 0.2);
            border-radius: 12px;
            color: var(--text-primary);
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-glow);
            box-shadow: 
                0 0 0 0.2rem rgba(0, 212, 255, 0.25),
                0 0 20px rgba(0, 212, 255, 0.3);
            color: var(--text-primary);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .form-text {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-glow) 0%, var(--secondary-glow) 100%);
            border: none;
            border-radius: 15px;
            color: #000;
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 18px 40px;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 10px 30px rgba(0, 212, 255, 0.4),
                0 0 50px rgba(0, 212, 255, 0.2);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .alert-success {
            background: rgba(6, 255, 165, 0.1);
            border: 1px solid rgba(6, 255, 165, 0.3);
            border-radius: 12px;
            color: var(--accent-glow);
            margin-bottom: 25px;
        }

        .alert-danger {
            background: rgba(255, 51, 102, 0.1);
            border: 1px solid rgba(255, 51, 102, 0.3);
            border-radius: 12px;
            color: var(--danger-glow);
            margin-bottom: 25px;
        }

        .floating-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-icon {
            position: absolute;
            color: rgba(0, 212, 255, 0.1);
            animation: floatIcon 15s linear infinite;
        }

        .floating-icon:nth-child(1) { left: 10%; animation-delay: 0s; }
        .floating-icon:nth-child(2) { left: 20%; animation-delay: 2s; }
        .floating-icon:nth-child(3) { left: 80%; animation-delay: 4s; }
        .floating-icon:nth-child(4) { left: 70%; animation-delay: 6s; }

        @keyframes floatIcon {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        .glow-text {
            text-shadow: 0 0 10px currentColor;
        }



        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .header-title {
                font-size: 1.4rem;
            }
            .card-body {
                padding: 30px 25px;
            }
            .main-container {
                padding: 15px;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-glow), var(--secondary-glow));
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="floating-icons">
    <i class="bi bi-shield-lock floating-icon" style="font-size: 3rem; top: 10%;"></i>
    <i class="bi bi-gear-fill floating-icon" style="font-size: 2.5rem; top: 20%;"></i>
    <i class="bi bi-key-fill floating-icon" style="font-size: 2rem; top: 30%;"></i>
    <i class="bi bi-person-badge floating-icon" style="font-size: 2.8rem; top: 40%;"></i>
</div>

<div class="main-container">
    <div class="login-card">
        <div class="login-header">
            <h1 class="header-title glow-text">
                <i class="bi bi-shield-lock-fill me-2"></i>
                Admin Portal
            </h1>
            <p class="header-subtitle">
                Secure access. Elite control. Command center.
            </p>
        </div>
        
        <div class="card-body">
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

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="/admin/login" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="bi bi-person-badge"></i>
                        Admin Username
                    </label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           class="form-control" 
                           placeholder="Enter admin username"
                           value="{{ old('username') }}"
                           required 
                           autofocus>
                    <div class="form-text">
                        <i class="bi bi-info-circle"></i>
                        Authorized administrators only
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-key"></i>
                        Security Key
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="Enter security key"
                           required>
                    <div class="form-text">
                        <i class="bi bi-shield-check"></i>
                        High-security access required
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="bi bi-unlock-fill me-2"></i>
                    Access System
                </button>
            </form>
        </div>
    </div>
    

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Add interactive effects matching the submit page
    document.addEventListener('DOMContentLoaded', function() {
        
        // Typing effect for placeholders
        const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
        inputs.forEach(input => {
            const originalPlaceholder = input.placeholder;
            
            input.addEventListener('focus', function() {
                if (this.value === '') {
                    let i = 0;
                    this.placeholder = '';
                    const typeInterval = setInterval(() => {
                        this.placeholder += originalPlaceholder[i];
                        i++;
                        if (i >= originalPlaceholder.length) {
                            clearInterval(typeInterval);
                        }
                    }, 50);
                }
            });
            
            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.placeholder = originalPlaceholder;
                }
            });
        });
        
        // Add glow effect on form focus
        const formElements = document.querySelectorAll('.form-control');
        formElements.forEach(element => {
            element.addEventListener('focus', function() {
                this.closest('.form-group').style.transform = 'translateY(-2px)';
                this.closest('.form-group').style.transition = 'all 0.3s ease';
            });
            
            element.addEventListener('blur', function() {
                this.closest('.form-group').style.transform = 'translateY(0)';
            });
        });
        
        // Submit button animation (fixed to not interfere with form submission)
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('.btn-login');
        
        form.addEventListener('submit', function(e) {
            // Only show loading if form is valid
            if (form.checkValidity()) {
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Authenticating...';
                submitBtn.disabled = true;
                
                // Add loading animation
                let dotCount = 0;
                const loadingDots = setInterval(() => {
                    dotCount = (dotCount + 1) % 4;
                    const dots = '.'.repeat(dotCount);
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Authenticating' + dots;
                }, 500);
                
                // Clean up after 8 seconds (fallback)
                setTimeout(() => {
                    clearInterval(loadingDots);
                    submitBtn.innerHTML = '<i class="bi bi-unlock-fill me-2"></i>Access System';
                    submitBtn.disabled = false;
                }, 8000);
            }
        });
        
        // Add particle effect on hover
        const card = document.querySelector('.login-card');
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
            this.style.boxShadow = '0 0 80px rgba(0, 212, 255, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 0 50px rgba(0, 212, 255, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1)';
        });
        
        // Username input special effect
        const usernameInput = document.querySelector('#username');
        usernameInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                this.style.borderColor = '#06ffa5';
                this.style.boxShadow = '0 0 0 0.2rem rgba(6, 255, 165, 0.25), 0 0 20px rgba(6, 255, 165, 0.3)';
                
                setTimeout(() => {
                    this.style.borderColor = 'rgba(0, 212, 255, 0.2)';
                    this.style.boxShadow = '';
                }, 1500);
            }
        });
        
        // Password input security effect
        const passwordInput = document.querySelector('#password');
        passwordInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                this.style.borderColor = '#ff3366';
                this.style.boxShadow = '0 0 0 0.2rem rgba(255, 51, 102, 0.25), 0 0 20px rgba(255, 51, 102, 0.3)';
                
                setTimeout(() => {
                    this.style.borderColor = 'rgba(0, 212, 255, 0.2)';
                    this.style.boxShadow = '';
                }, 1500);
            }
        });
        
        // Add random floating particles (same as submit page)
        function createParticle() {
            const particle = document.createElement('div');
            particle.style.position = 'fixed';
            particle.style.width = '2px';
            particle.style.height = '2px';
            particle.style.background = '#00d4ff';
            particle.style.borderRadius = '50%';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '-1';
            particle.style.left = Math.random() * window.innerWidth + 'px';
            particle.style.top = window.innerHeight + 'px';
            particle.style.boxShadow = '0 0 6px #00d4ff';
            
            document.body.appendChild(particle);
            
            const animation = particle.animate([
                { transform: 'translateY(0px)', opacity: 0 },
                { transform: 'translateY(-20px)', opacity: 1 },
                { transform: 'translateY(-' + (window.innerHeight + 100) + 'px)', opacity: 0 }
            ], {
                duration: Math.random() * 3000 + 2000,
                easing: 'ease-out'
            });
            
            animation.onfinish = () => particle.remove();
        }
        
        // Create particles periodically
        setInterval(createParticle, 1200);
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
</body>
</html>