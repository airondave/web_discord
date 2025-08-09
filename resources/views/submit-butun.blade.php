<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUTUN Special Verification - Ranconnity Discord</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    
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

        .verification-card {
            background: rgba(26, 26, 26, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-glow);
            border-radius: 20px;
            box-shadow: 
                0 0 50px rgba(0, 212, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            max-width: 500px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .verification-card::before {
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

        .card-header {
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
            border: none;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid var(--border-glow);
        }

        .header-title {
            font-family: 'Orbitron', monospace;
            font-size: 2rem;
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
            font-size: 1.1rem;
            font-weight: 300;
            margin-bottom: 0;
        }

        .card-body {
            padding: 40px;
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

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 212, 255, 0.2);
            border-radius: 12px;
            color: var(--text-primary);
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-control:focus, .form-select:focus {
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

        .submit-btn {
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

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 10px 30px rgba(0, 212, 255, 0.4),
                0 0 50px rgba(0, 212, 255, 0.2);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .alert {
            background: rgba(6, 255, 165, 0.1);
            border: 1px solid rgba(6, 255, 165, 0.3);
            border-radius: 12px;
            color: var(--accent-glow);
            margin-bottom: 25px;
        }

        .alert-success {
            background: rgba(6, 255, 165, 0.1);
            border-color: rgba(6, 255, 165, 0.3);
            color: var(--accent-glow);
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

        /* Discord OAuth Styles */
        .btn-discord-login {
            background: linear-gradient(135deg, #5865f2 0%, #4752c4 100%);
            border: none;
            border-radius: 15px;
            color: white;
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 30px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-discord-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-discord-login:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 10px 30px rgba(88, 101, 242, 0.4),
                0 0 50px rgba(88, 101, 242, 0.2);
            color: white;
            text-decoration: none;
        }

        .btn-discord-login:hover::before {
            left: 100%;
        }

        .divider-text {
            position: relative;
            text-align: center;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .divider-text::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0, 212, 255, 0.3), transparent);
        }

        .divider-text span {
            background: var(--card-bg);
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .discord-user-card {
            background: rgba(88, 101, 242, 0.1);
            border: 1px solid rgba(88, 101, 242, 0.3);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(10px);
        }

        .discord-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid var(--primary-glow);
        }

        .discord-avatar-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #000;
        }

        .btn-disconnect {
            background: rgba(255, 51, 102, 0.2);
            border: 1px solid rgba(255, 51, 102, 0.4);
            border-radius: 8px;
            color: var(--danger-glow);
            padding: 8px 12px;
            transition: all 0.3s ease;
        }

        .btn-disconnect:hover {
            background: rgba(255, 51, 102, 0.3);
            transform: scale(1.1);
        }

        /* Readonly input styling */
        .form-control[readonly] {
            background: rgba(6, 255, 165, 0.05);
            border-color: rgba(6, 255, 165, 0.3);
            color: var(--accent-glow);
        }

        /* Custom Select Dropdown Styling */
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2300d4ff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* Force dark styling for all select options */
        .form-select option {
            background-color: #0d1117 !important;
            background: #0d1117 !important;
            color: #ffffff !important;
            padding: 12px 16px !important;
            border: none !important;
            font-family: 'Rajdhani', sans-serif !important;
            font-size: 1rem !important;
        }

        .form-select option:hover,
        .form-select option:focus,
        .form-select option:checked,
        .form-select option:active {
            background-color: rgba(0, 212, 255, 0.2) !important;
            background: rgba(0, 212, 255, 0.2) !important;
            color: #00d4ff !important;
        }

        .form-select option[value=""] {
            color: #8b949e !important;
            font-style: italic;
            background-color: #0d1117 !important;
        }

        /* Additional browser-specific fixes */
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            -webkit-text-fill-color: white !important;
            -webkit-box-shadow: 0 0 0px 1000px #0d1117 inset !important;
        }

        /* Firefox specific */
        @-moz-document url-prefix() {
            .form-select option {
                background-color: #0d1117 !important;
                color: white !important;
            }
        }

        /* Custom role selection with enhanced styling */
        #role_id {
            position: relative;
            cursor: pointer;
        }

        #role_id:focus {
            box-shadow: 
                0 0 20px rgba(0, 212, 255, 0.3),
                0 0 40px rgba(0, 212, 255, 0.1);
        }

        /* Enhanced role options */
        .role-option {
            background: var(--card-bg);
            color: white;
            padding: 12px 16px;
            border-bottom: 1px solid rgba(0, 212, 255, 0.1);
            transition: all 0.3s ease;
        }

        .role-option:hover {
            background: rgba(0, 212, 255, 0.1);
            color: var(--primary-glow);
            transform: translateX(5px);
        }

        /* BUTUN Footer Styling */
        .butun-footer {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .butun-footer:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 193, 7, 0.2);
        }

        .butun-link {
            color: #ffc107;
            text-decoration: none;
            font-weight: 700;
            font-family: 'Orbitron', monospace;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
        }

        .butun-link::before {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #ffc107, #ff8f00);
            transition: width 0.3s ease;
        }

        .butun-link:hover {
            color: #ff8f00;
            text-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
            text-decoration: none;
        }

        .butun-link:hover::before {
            width: 100%;
        }

        /* Custom File Upload Styling for BUTUN page */
        .form-control[type="file"] {
            background: rgba(255, 193, 7, 0.1);
            border: 2px solid rgba(255, 193, 7, 0.3);
            border-radius: 12px;
            color: #ffffff;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
            cursor: pointer;
        }

        .form-control[type="file"]:hover {
            background: rgba(255, 193, 7, 0.2);
            border-color: rgba(255, 193, 7, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.2);
        }

        .form-control[type="file"]:focus {
            background: rgba(255, 193, 7, 0.15);
            border-color: #ffc107;
            box-shadow: 
                0 0 0 0.2rem rgba(255, 193, 7, 0.25),
                0 0 20px rgba(255, 193, 7, 0.3);
            outline: none;
        }

        /* Custom file input button styling */
        .form-control[type="file"]::file-selector-button {
            background: linear-gradient(135deg, #ffc107 0%, #ff8f00 100%);
            border: none;
            border-radius: 8px;
            color: #000;
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 16px;
            margin-right: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-control[type="file"]::file-selector-button:hover {
            background: linear-gradient(135deg, #ff8f00 0%, #ffc107 100%);
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
        }

        /* Webkit browsers (Chrome, Safari, Edge) */
        .form-control[type="file"]::-webkit-file-upload-button {
            background: linear-gradient(135deg, #ffc107 0%, #ff8f00 100%);
            border: none;
            border-radius: 8px;
            color: #000;
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 16px;
            margin-right: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-control[type="file"]::-webkit-file-upload-button:hover {
            background: linear-gradient(135deg, #ff8f00 0%, #ffc107 100%);
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
        }

        /* Number input styling */
        .form-control[type="number"] {
            -moz-appearance: textfield; /* Firefox */
        }

        .form-control[type="number"]::-webkit-outer-spin-button,
        .form-control[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .header-title {
                font-size: 1.5rem;
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
    <i class="bi bi-discord floating-icon" style="font-size: 3rem; top: 10%;"></i>
    <i class="bi bi-shield-check floating-icon" style="font-size: 2.5rem; top: 20%;"></i>
    <i class="bi bi-stars floating-icon" style="font-size: 2rem; top: 30%;"></i>
    <i class="bi bi-lightning-charge floating-icon" style="font-size: 2.8rem; top: 40%;"></i>
</div>

<div class="main-container">
    <div class="verification-card">
        <div class="card-header">
            <h1 class="header-title glow-text">
                <i class="bi bi-mortarboard-fill me-2" style="color: #ffc107;"></i>
                BUTUN SPECIAL ROLES
            </h1>
            <p class="header-subtitle">
                <i class="bi bi-award me-2" style="color: #ffc107;"></i>
                Butun Vocational Highschoolers Verification
            </p>
            <p class="text-secondary mb-0">
                Exclusive access and role for BUTUN highschoolers.
            </p>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('discord_success'))
                <div class="alert alert-success">
                    <i class="bi bi-discord me-2"></i>
                    {{ session('discord_success') }}
                </div>
            @endif
            
            @if(session('discord_error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('discord_error') }}
                </div>
            @endif
            
            <!-- Discord OAuth Section -->
            @if(!session('discord_user'))
                <div class="discord-oauth-section mb-4">
                    <div class="text-center">
                        <h5 class="text-white mb-3">
                            <i class="bi bi-lightning-charge me-2"></i>
                            Quick Connect with Discord
                        </h5>
                        <p class="text-secondary mb-3">
                            Automatically fill your Discord username and ID
                        </p>
                        <a href="{{ route('discord.login', ['return_url' => '/submit/butun']) }}" class="btn-discord-login">
                            <i class="bi bi-discord me-2"></i>
                            Connect Discord Account
                        </a>
                        <div class="divider-text mt-4 mb-4">
                            <span>OR FILL MANUALLY</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="discord-connected-section mb-4">
                    <div class="discord-user-card">
                        <div class="d-flex align-items-center">
                            @if(session('discord_user')['avatar'])
                                <img src="https://cdn.discordapp.com/avatars/{{ session('discord_user')['id'] }}/{{ session('discord_user')['avatar'] }}.png" 
                                     class="discord-avatar me-3" alt="Discord Avatar">
                            @else
                                <div class="discord-avatar-placeholder me-3">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-white">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Discord Connected
                                </h6>
                                <p class="mb-0 text-secondary">
                                    {{ session('discord_user')['username'] }}
                                    @if(session('discord_user')['discriminator'])
                                        #{{ session('discord_user')['discriminator'] }}
                                    @endif
                                </p>
                            </div>
                                                    <form action="{{ route('discord.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="return_url" value="/submit/butun">
                                <button type="submit" class="btn-disconnect">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            
            <form action="/submit/butun" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="discord_username" class="form-label">
                        <i class="bi bi-person-badge"></i>
                        Discord Username
                    </label>
                    <input type="text" 
                           id="discord_username" 
                           name="discord_username" 
                           class="form-control" 
                           placeholder="username"
                           value="{{ session('discord_user') ? session('discord_user')['username'] . (session('discord_user')['discriminator'] ? '#' . session('discord_user')['discriminator'] : '') : '' }}"
                           {{ session('discord_user') ? 'readonly' : '' }}
                           required>
                    <div class="form-text">
                        <i class="bi bi-info-circle"></i>
                        This is where you gonna type your discord username.
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="discord_id" class="form-label">
                        <i class="bi bi-hash"></i>
                        Discord ID
                    </label>
                    <input type="number" 
                           id="discord_id" 
                           name="discord_id" 
                           class="form-control" 
                           placeholder="123456789012345678"
                           value="{{ session('discord_user')['id'] ?? '' }}"
                           {{ session('discord_user') ? 'readonly' : '' }}
                           min="0"
                           step="1"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           required>
                    <div class="form-text">
                        <i class="bi bi-lightbulb"></i>
                        Right-click your profile → Copy User ID
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="role_id" class="form-label">
                        <i class="bi bi-award"></i>
                        Your Role Now
                    </label>
                    <select id="role_id" name="role_id" class="form-select" required>
                        <option value="">Choose your current role...</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <div class="form-text">
                        <i class="bi bi-star"></i>
                        Select the role that Elden Lord has condemned you to be
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="proof_image" class="form-label">
                        <i class="bi bi-image"></i>
                        Proof of BUTUN Membership
                    </label>
                    <input type="file" 
                           id="proof_image" 
                           name="proof_image" 
                           class="form-control" 
                           accept="image/*" 
                           required>
                    <div class="form-text">
                        <i class="bi bi-camera"></i>
                        Upload evidence of your BUTUN membership (Foto lagi dikelas atau lagi disekolah BUTUN)
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="bi bi-rocket-takeoff me-2"></i>
                    Initialize Verification
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Back to Regular Form -->
<div class="container mt-5">
    <div class="text-center">
        <div class="butun-footer">
            <p class="text-secondary mb-0">
                <i class="bi bi-arrow-left me-2"></i>
                Not a BUTUN member? 
                <a href="/submit" class="butun-link">Go back to regular verification</a>
            </p>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Add interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        
        // Typing effect for placeholders
        const inputs = document.querySelectorAll('input[type="text"]');
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
        const formElements = document.querySelectorAll('.form-control, .form-select');
        formElements.forEach(element => {
            element.addEventListener('focus', function() {
                this.closest('.form-group').style.transform = 'translateY(-2px)';
                this.closest('.form-group').style.transition = 'all 0.3s ease';
            });
            
            element.addEventListener('blur', function() {
                this.closest('.form-group').style.transform = 'translateY(0)';
            });
        });
        
        // Submit button animation
        const submitBtn = document.querySelector('.submit-btn');
        const form = document.querySelector('form');
        
        form.addEventListener('submit', function(e) {
            if (this.checkValidity()) {
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Processing...';
                submitBtn.disabled = true;
                
                // Add loading animation
                const loadingDots = setInterval(() => {
                    if (submitBtn.innerHTML.includes('...')) {
                        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Processing';
                    } else {
                        submitBtn.innerHTML += '.';
                    }
                }, 500);
                
                // Clear the interval when page changes (form submits)
                window.addEventListener('beforeunload', () => {
                    clearInterval(loadingDots);
                });
            }
        });
        
        // Add particle effect on hover
        const card = document.querySelector('.verification-card');
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
            this.style.boxShadow = '0 0 80px rgba(0, 212, 255, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 0 50px rgba(0, 212, 255, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1)';
        });
        
        // Role selection effect with enhanced dropdown styling
        const roleSelect = document.querySelector('#role_id');
        
        // Force dark theme for dropdown options with multiple approaches
        function styleSelectOptions() {
            Array.from(roleSelect.options).forEach((option, index) => {
                // Multiple styling approaches for cross-browser compatibility
                option.style.setProperty('background-color', '#0d1117', 'important');
                option.style.setProperty('background', '#0d1117', 'important');
                option.style.setProperty('color', '#ffffff', 'important');
                option.style.setProperty('padding', '12px 16px', 'important');
                
                // Add data attributes for additional styling
                if (option.value) {
                    option.setAttribute('data-role', 'option');
                    option.className = 'role-option';
                }
            });
        }
        
        // Apply styling immediately and on focus
        styleSelectOptions();
        
        roleSelect.addEventListener('focus', function() {
            setTimeout(styleSelectOptions, 10); // Re-apply after dropdown opens
        });
        
        roleSelect.addEventListener('change', function() {
            if (this.value) {
                const selectedOption = this.options[this.selectedIndex];
                
                // Add temporary glow effect
                this.style.borderColor = '#06ffa5';
                this.style.boxShadow = '0 0 0 0.2rem rgba(6, 255, 165, 0.25), 0 0 20px rgba(6, 255, 165, 0.3)';
                
                // Show selection feedback
                const formText = this.closest('.form-group').querySelector('.form-text');
                const originalText = formText.innerHTML;
                formText.innerHTML = '<i class="bi bi-check-circle-fill"></i> Role selected: ' + selectedOption.text;
                formText.style.color = '#06ffa5';
                
                setTimeout(() => {
                    formText.innerHTML = originalText;
                    formText.style.color = '#a0a0a0';
                    this.style.borderColor = 'rgba(0, 212, 255, 0.2)';
                    this.style.boxShadow = '';
                }, 2000);
            }
        });
        
        // File upload feedback
        const fileInput = document.querySelector('#proof_image');
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                const formText = this.closest('.form-group').querySelector('.form-text');
                const originalText = formText.innerHTML;
                
                formText.innerHTML = '<i class="bi bi-check-circle-fill"></i> File ready: ' + fileName;
                formText.style.color = '#06ffa5';
                
                // Add success glow
                this.style.borderColor = '#06ffa5';
                this.style.boxShadow = '0 0 0 0.2rem rgba(6, 255, 165, 0.25)';
                
                setTimeout(() => {
                    formText.innerHTML = originalText;
                    formText.style.color = '#a0a0a0';
                    this.style.borderColor = 'rgba(0, 212, 255, 0.2)';
                    this.style.boxShadow = '';
                }, 3000);
            }
        });
        
        // Add random floating particles
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
        setInterval(createParticle, 1000);

        // Discord ID validation - numbers only
        const discordIdInput = document.getElementById('discord_id');
        if (discordIdInput && !discordIdInput.readOnly) {
            discordIdInput.addEventListener('keypress', function(e) {
                // Allow only numbers, backspace, delete, and arrow keys
                if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(e.key)) {
                    e.preventDefault();
                    
                    // Add visual feedback with golden theme
                    this.style.borderColor = '#ff3366';
                    this.style.boxShadow = '0 0 0 0.2rem rgba(255, 51, 102, 0.25)';
                    
                    setTimeout(() => {
                        this.style.borderColor = 'rgba(255, 193, 7, 0.3)';
                        this.style.boxShadow = '';
                    }, 1000);
                }
            });

            discordIdInput.addEventListener('paste', function(e) {
                setTimeout(() => {
                    const originalValue = this.value;
                    const cleanValue = this.value.replace(/[^0-9]/g, '');
                    if (originalValue !== cleanValue) {
                        this.value = cleanValue;
                        
                        // Add visual feedback for paste cleanup with golden theme
                        this.style.borderColor = '#ffc107';
                        this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.4)';
                        
                        setTimeout(() => {
                            this.style.borderColor = 'rgba(255, 193, 7, 0.3)';
                            this.style.boxShadow = '';
                        }, 1500);
                    }
                }, 10);
            });
        }
    });
</script>
</body>
</html>
