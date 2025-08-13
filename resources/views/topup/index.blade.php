<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topup Game - Random Community</title>
    
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

        .game-card {
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

        .game-card::before {
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

        .game-card:hover {
            transform: none;
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.3);
        }

        .game-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.5rem;
            color: var(--retro-cyan);
            text-shadow: 0 0 10px var(--retro-cyan);
            margin-bottom: 1.5rem;
        }

        .package-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .package-card {
            background: rgba(0, 255, 65, 0.1);
            border: 2px solid var(--retro-green);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .package-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 65, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .package-card:hover::before {
            left: 100%;
        }

        .package-card:hover {
            transform: none;
            box-shadow: 0 5px 20px rgba(0, 255, 65, 0.4);
            border-color: var(--retro-cyan);
        }

        .package-card.selected {
            border-color: var(--retro-yellow);
            background: rgba(255, 255, 0, 0.1);
            box-shadow: 0 0 20px rgba(255, 255, 0, 0.3);
        }

        .package-name {
            font-family: 'Orbitron', monospace;
            font-size: 1.2rem;
            color: var(--retro-yellow);
            margin-bottom: 1rem;
        }

        .package-amount {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.5rem;
            color: var(--retro-green);
            margin-bottom: 1rem;
        }

        .package-price {
            font-family: 'Orbitron', monospace;
            font-size: 1.3rem;
            color: var(--retro-cyan);
            font-weight: bold;
        }

        .form-section {
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.9) 0%, rgba(42, 42, 42, 0.9) 100%);
            border: 2px solid var(--retro-purple);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .form-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.3rem;
            color: var(--retro-purple);
            text-shadow: 0 0 10px var(--retro-purple);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-control, .form-select {
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid var(--retro-green);
            border-radius: 8px;
            color: var(--text-primary);
            padding: 0.75rem 1rem;
            font-family: 'Rajdhani', sans-serif;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(0, 0, 0, 0.7);
            border-color: var(--retro-cyan);
            color: var(--text-primary);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
            outline: none;
        }

        .form-label {
            color: var(--retro-green);
            font-family: 'Orbitron', monospace;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .btn-topup {
            background: linear-gradient(135deg, var(--retro-purple) 0%, var(--retro-red) 100%);
            border: 3px solid var(--retro-purple);
            color: white;
            font-family: 'Press Start 2P', monospace;
            font-size: 1rem;
            text-transform: uppercase;
            padding: 1rem 2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-topup::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-topup:hover::before {
            left: 100%;
        }

        .btn-topup:hover {
            transform: none;
            box-shadow: 0 10px 25px rgba(255, 0, 255, 0.4);
        }

        .btn-topup:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .total-section {
            background: rgba(255, 255, 0, 0.1);
            border: 2px solid var(--retro-yellow);
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: center;
        }

        .total-label {
            font-family: 'Orbitron', monospace;
            color: var(--retro-yellow);
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .total-amount {
            font-family: 'Press Start 2P', monospace;
            font-size: 2rem;
            color: var(--retro-yellow);
            text-shadow: 0 0 10px var(--retro-yellow);
        }

        .game-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .game-logo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 15px;
            border: 2px solid var(--retro-green);
            box-shadow: 0 0 15px rgba(0, 255, 65, 0.3);
            transition: all 0.3s ease;
        }

        .game-logo:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.5);
        }

        .valorant-icon { color: #ff4655; }
        .genshin-icon { color: #f4c2c2; }
        .roblox-icon { color: #ff6b6b; }
        .zenless-icon { color: #4ecdc4; }
        .ml-icon { color: #45b7d1; }
        .pubg-icon { color: #96ceb4; }
        .honkai-icon { color: #feca57; }
        .freefire-icon { color: #ff9ff3; }
        .cod-icon { color: #54a0ff; }
        .magicchess-icon { color: #5f27cd; }

        /* Search Bar Styles */
        .search-section {
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.9) 0%, rgba(42, 42, 42, 0.9) 100%);
            border: 2px solid var(--retro-cyan);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .search-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.3rem;
            color: var(--retro-cyan);
            text-shadow: 0 0 10px var(--retro-cyan);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .search-input {
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid var(--retro-cyan);
            border-radius: 8px;
            color: var(--text-primary);
            padding: 0.75rem 1rem;
            font-family: 'Rajdhani', sans-serif;
            font-size: 1rem;
            width: 100%;
        }

        .search-input:focus {
            background: rgba(0, 0, 0, 0.7);
            border-color: var(--retro-green);
            color: var(--text-primary);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
            outline: none;
        }

        .game-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .game-option {
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.9) 0%, rgba(42, 42, 42, 0.9) 100%);
            border: 2px solid var(--retro-green);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .game-option::before {
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

        .game-option:hover {
            transform: none;
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.3);
        }

        .game-option.selected {
            border-color: var(--retro-yellow);
            background: rgba(255, 255, 0, 0.1);
            box-shadow: 0 0 20px rgba(255, 255, 0, 0.3);
        }

        .game-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .valorant-icon { color: #ff4655; }
        .genshin-icon { color: #f4c2c2; }
        .roblox-icon { color: #ff6b6b; }
        .zenless-icon { color: #4ecdc4; }
        .ml-icon { color: #45b7d1; }
        .pubg-icon { color: #96ceb4; }
        .honkai-icon { color: #feca57; }
        .freefire-icon { color: #ff9ff3; }
        .cod-icon { color: #54a0ff; }
        .magicchess-icon { color: #5f27cd; }

        @media (max-width: 768px) {
            .glitch-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .game-card {
                padding: 1.5rem;
            }
            .package-grid {
                grid-template-columns: 1fr;
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
                        <a class="nav-link" href="/gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/support">Support</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="glitch-title">TOPUP GAME</h1>
            <p class="hero-subtitle">Top up your favorite games with ease!</p>
            
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

            <form action="{{ route('topup.store') }}" method="POST" id="topupForm">
                @csrf
                
                <!-- Search Bar -->
                <div class="search-section">
                    <h3 class="search-title">
                        <i class="bi bi-search me-2"></i>
                        Search Games
                    </h3>
                    <input type="text" class="search-input" id="gameSearch" 
                           placeholder="Type to search for games..." autocomplete="off">
                </div>
                
                <!-- Game Selection -->
                <div class="game-card">
                    <h3 class="game-title text-center">
                        <i class="bi bi-controller me-2"></i>
                        Select Your Game
                    </h3>
                    
                    <div class="game-grid" id="gameGrid">
                        @foreach($games as $game)
                        <div class="game-option" data-game-id="{{ $game->id }}" data-game-name="{{ strtolower($game->name) }}">
                            <div class="game-icon">
                                @if($game->name == 'Valorant')
                                    <img src="/image/games/valorant.jpg" alt="Valorant" class="game-logo">
                                @elseif($game->name == 'Genshin Impact')
                                    <img src="/image/games/genshin.jpg" alt="Genshin Impact" class="game-logo">
                                @elseif($game->name == 'Roblox')
                                    <img src="/image/games/roblox.jpg" alt="Roblox" class="game-logo">
                                @elseif($game->name == 'Zenless Zone Zero')
                                    <img src="/image/games/zzz.jpg" alt="Zenless Zone Zero" class="game-logo">
                                @elseif($game->name == 'Mobile Legends Bang Bang')
                                    <img src="/image/games/ml.jpg" alt="Mobile Legends" class="game-logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                    <i class="bi bi-phone" style="display: none; font-size: 3rem; color: #45b7d1;"></i>
                                @elseif($game->name == 'PUBG Mobile')
                                    <img src="/image/games/pubg.jpg" alt="PUBG Mobile" class="game-logo">
                                @elseif($game->name == 'Honkai Star Rail')
                                    <img src="/image/games/hsr.jpg" alt="Honkai Star Rail" class="game-logo">
                                @elseif($game->name == 'Free Fire')
                                    <img src="/image/games/ff.jpg" alt="Free Fire" class="game-logo">
                                @elseif($game->name == 'Call of Duty Mobile')
                                    <img src="/image/games/cod.jpg" alt="Call of Duty Mobile" class="game-logo">
                                @elseif($game->name == 'Magic Chess Go Go')
                                    <img src="/image/games/mgcc.jpg" alt="Magic Chess Go Go" class="game-logo">
                                @else
                                    <i class="bi bi-controller"></i>
                                @endif
                            </div>
                            <h4 class="text-{{ $game->name == 'Valorant' ? 'danger' : ($game->name == 'Genshin Impact' ? 'warning' : ($game->name == 'Roblox' ? 'danger' : ($game->name == 'Zenless Zone Zero' ? 'info' : ($game->name == 'Mobile Legends Bang Bang' ? 'primary' : ($game->name == 'PUBG Mobile' ? 'success' : ($game->name == 'Honkai Star Rail' ? 'warning' : ($game->name == 'Free Fire' ? 'danger' : ($game->name == 'Call of Duty Mobile' ? 'primary' : 'secondary')))))))) }}">{{ $game->name }}</h4>
                            <p class="text-muted">{{ $game->publisher }}</p>
                            <div class="form-check d-flex justify-content-center">
                                <input class="form-check-input" type="radio" name="game_id" 
                                       id="game_{{ $game->id }}" value="{{ $game->id }}" required>
                                <label class="form-check-label ms-2" for="game_{{ $game->id }}">
                                    Select this game
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Package Selection -->
                <div class="game-card" id="packageSection" style="display: none;">
                    <h3 class="game-title text-center">
                        <i class="bi bi-box me-2"></i>
                        Choose Your Package
                    </h3>
                    
                    <div class="package-grid" id="packageGrid">
                        <!-- Packages will be loaded here -->
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="game-card" id="paymentSection" style="display: none;">
                    <h3 class="game-title text-center">
                        <i class="bi bi-credit-card me-2"></i>
                        Payment Method
                    </h3>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Payment Method</label>
                                <select class="form-select" name="payment_method_id" required>
                                    <option value="">Select payment method</option>
                                    @foreach($paymentMethods as $method)
                                        <option value="{{ $method->id }}">{{ $method->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Player Information -->
                <div class="form-section" id="playerSection" style="display: none;">
                    <h3 class="form-title">
                        <i class="bi bi-person me-2"></i>
                        Player Information
                    </h3>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Player ID</label>
                            <input type="text" class="form-control" name="player_id" 
                                   placeholder="Enter your player ID" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Server (Optional)</label>
                            <input type="text" class="form-control" name="player_server" 
                                   placeholder="Enter server if applicable">
                        </div>
                    </div>

                    @guest
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-control" name="buyer_name" 
                                   placeholder="Enter your full name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Your Email</label>
                            <input type="email" class="form-control" name="buyer_email" 
                                   placeholder="Enter your email address" required>
                        </div>
                    </div>
                    @endguest

                    <!-- Total Amount -->
                    <div class="total-section" id="totalSection" style="display: none;">
                        <div class="total-label">Total Amount:</div>
                        <div class="total-amount" id="totalAmount">Rp 0</div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn-topup" id="submitBtn" disabled>
                            <i class="bi bi-credit-card me-2"></i>
                            Proceed to Payment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gameRadios = document.querySelectorAll('input[name="game_id"]');
            const packageSection = document.getElementById('packageSection');
            const paymentSection = document.getElementById('paymentSection');
            const playerSection = document.getElementById('playerSection');
            const packageGrid = document.getElementById('packageGrid');
            const totalSection = document.getElementById('totalSection');
            const totalAmount = document.getElementById('totalAmount');
            const submitBtn = document.getElementById('submitBtn');
            const gameSearch = document.getElementById('gameSearch');
            const gameGrid = document.getElementById('gameGrid');

            // Search functionality
            gameSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const gameOptions = gameGrid.querySelectorAll('.game-option');
                
                gameOptions.forEach(option => {
                    const gameName = option.dataset.gameName;
                    if (gameName.includes(searchTerm)) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });

            // Game selection
            gameRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        // Remove previous selection styling
                        document.querySelectorAll('.game-option').forEach(opt => opt.classList.remove('selected'));
                        // Add selection styling to parent
                        this.closest('.game-option').classList.add('selected');
                        
                        loadPackages(this.value);
                        packageSection.style.display = 'block';
                        paymentSection.style.display = 'none';
                        playerSection.style.display = 'none';
                        totalSection.style.display = 'none';
                        submitBtn.disabled = true;
                    }
                });
            });

            // Load packages for selected game
            function loadPackages(gameId) {
                const games = @json($games);
                const selectedGame = games.find(g => g.id == gameId);
                
                if (selectedGame && selectedGame.topup_packages) {
                    let packagesHTML = '';
                    selectedGame.topup_packages.forEach(package => {
                        packagesHTML += `
                            <div class="package-card" data-package-id="${package.id}" data-price="${package.price}">
                                <div class="package-name">${package.name}</div>
                                <div class="package-amount">${package.amount}</div>
                                <div class="package-price">Rp ${package.price.toLocaleString('id-ID')}</div>
                            </div>
                        `;
                    });
                    
                    packageGrid.innerHTML = packagesHTML;
                    
                    // Add click events to packages
                    const packageCards = packageGrid.querySelectorAll('.package-card');
                    packageCards.forEach(card => {
                        card.addEventListener('click', function() {
                            // Remove previous selection
                            packageCards.forEach(c => c.classList.remove('selected'));
                            // Select current package
                            this.classList.add('selected');
                            
                            // Update form
                            const packageId = this.dataset.packageId;
                            const price = this.dataset.price;
                            
                            // Add hidden input for package
                            let packageInput = document.querySelector('input[name="package_id"]');
                            if (!packageInput) {
                                packageInput = document.createElement('input');
                                packageInput.type = 'hidden';
                                packageInput.name = 'package_id';
                                document.getElementById('topupForm').appendChild(packageInput);
                            }
                            packageInput.value = packageId;
                            
                            // Show payment section
                            paymentSection.style.display = 'block';
                            playerSection.style.display = 'none';
                            totalSection.style.display = 'none';
                            submitBtn.disabled = true;
                        });
                    });
                } else {
                    packageGrid.innerHTML = '<div class="text-center text-muted">No packages available for this game.</div>';
                }
            }

            // Payment method selection
            const paymentSelect = document.querySelector('select[name="payment_method_id"]');
            paymentSelect.addEventListener('change', function() {
                if (this.value) {
                    playerSection.style.display = 'block';
                    totalSection.style.display = 'block';
                    updateTotal();
                    submitBtn.disabled = false;
                } else {
                    playerSection.style.display = 'none';
                    totalSection.style.display = 'none';
                    submitBtn.disabled = true;
                }
            });

            // Update total amount
            function updateTotal() {
                const selectedPackage = document.querySelector('.package-card.selected');
                if (selectedPackage) {
                    const price = parseFloat(selectedPackage.dataset.price);
                    totalAmount.textContent = `Rp ${price.toLocaleString('id-ID')}`;
                }
            }

            // Form validation
            document.getElementById('topupForm').addEventListener('submit', function(e) {
                const gameId = document.querySelector('input[name="game_id"]:checked');
                const packageId = document.querySelector('input[name="package_id"]');
                const paymentMethod = document.querySelector('select[name="payment_method_id"]').value;
                const playerId = document.querySelector('input[name="player_id"]').value;
                
                if (!gameId || !packageId || !paymentMethod || !playerId) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                    return false;
                }
            });
        });
    </script>
</body>
</html> 