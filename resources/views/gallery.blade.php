<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Ranconnity Gaming Community</title>
    
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

        .nav-link:hover, .nav-link.active {
            color: var(--retro-cyan);
            text-shadow: 0 0 5px var(--retro-cyan);
        }

        /* Hero Section */
        .hero-section {
            min-height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 2rem 0;
        }

        .glitch-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 3rem;
            text-align: center;
            margin-bottom: 1rem;
            position: relative;
            color: var(--retro-purple);
            text-shadow: 
                0 0 5px var(--retro-purple),
                0 0 10px var(--retro-purple),
                0 0 20px var(--retro-purple);
            animation: glitch 2s infinite;
        }

        @keyframes glitch {
            0%, 98% { 
                color: var(--retro-purple);
                text-shadow: 
                    0 0 5px var(--retro-purple),
                    0 0 10px var(--retro-purple),
                    0 0 20px var(--retro-purple);
            }
            99% { 
                color: var(--retro-cyan);
                text-shadow: 
                    2px 0 var(--retro-yellow),
                    -2px 0 var(--retro-green),
                    0 0 20px var(--retro-cyan);
            }
        }

        .hero-subtitle {
            text-align: center;
            font-size: 1.3rem;
            color: var(--retro-cyan);
            font-family: 'Orbitron', monospace;
            margin-bottom: 2rem;
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

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .gallery-item {
            position: relative;
            background: rgba(26, 26, 26, 0.9);
            border: 2px solid var(--retro-cyan);
            overflow: hidden;
            transition: all 0.3s ease;
            aspect-ratio: 16/9;
        }

        .gallery-item::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--retro-cyan), var(--retro-purple), var(--retro-yellow), var(--retro-green));
            z-index: -1;
            animation: borderGlow 4s linear infinite;
        }

        .gallery-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 255, 255, 0.4);
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.1);
            filter: brightness(1.2) saturate(1.2);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
            color: white;
            padding: 1.5rem;
            transform: translateY(100%);
            transition: all 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }

        .gallery-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.1rem;
            color: var(--retro-cyan);
            margin-bottom: 0.5rem;
        }

        .gallery-desc {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, var(--retro-green), var(--retro-cyan), var(--retro-purple));
            transform: translateX(-50%);
            box-shadow: 0 0 10px var(--retro-cyan);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row;
        }

        .timeline-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            width: 45%;
            background: rgba(26, 26, 26, 0.9);
            border: 2px solid var(--retro-purple);
            padding: 1.5rem;
            position: relative;
        }

        .timeline-content::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--retro-purple), var(--retro-cyan), var(--retro-green));
            z-index: -1;
            animation: borderGlow 2s linear infinite;
        }

        .timeline-date {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.8rem;
            color: var(--retro-yellow);
            margin-bottom: 1rem;
        }

        .timeline-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.2rem;
            color: var(--retro-cyan);
            margin-bottom: 0.5rem;
        }

        .timeline-desc {
            color: var(--text-primary);
            line-height: 1.6;
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            width: 20px;
            height: 20px;
            background: var(--retro-cyan);
            border: 4px solid var(--dark-bg);
            border-radius: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 20px var(--retro-cyan);
            z-index: 2;
        }

        /* Floating Icons */
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
            .glitch-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .gallery-grid {
                grid-template-columns: 1fr;
            }
            .timeline::before {
                left: 20px;
            }
            .timeline-item {
                flex-direction: column !important;
                align-items: flex-start;
                padding-left: 3rem;
            }
            .timeline-content {
                width: 100%;
            }
            .timeline-dot {
                left: 20px;
            }
        }

        @media (max-width: 576px) {
            .glitch-title {
                font-size: 1.5rem;
            }
            .retro-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Floating Retro Icons -->
<div class="floating-retro-icons">
    <i class="bi bi-camera floating-retro-icon"></i>
    <i class="bi bi-images floating-retro-icon"></i>
    <i class="bi bi-collection floating-retro-icon"></i>
    <i class="bi bi-calendar-event floating-retro-icon"></i>
    <i class="bi bi-trophy floating-retro-icon"></i>
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
                    <a class="nav-link active" href="/gallery">Gallery</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="glitch-title">GALLERY</h1>
        <p class="hero-subtitle">Our Journey & Memories</p>
    </div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <!-- Server Gallery Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="retro-card">
                    <h2 class="card-title text-center">
                        <i class="bi bi-images me-2"></i>
                        Server Gallery
                    </h2>
                    <p class="text-center mb-4" style="color: var(--text-secondary);">
                        Moments captured from our amazing Discord community
                    </p>
                    
                    <div class="gallery-grid">
                        <!-- Gallery Item 1 -->
                        <div class="gallery-item">
                            <img src="/public/image/gallery/mc1.jpg" alt="Minecraft Session 1" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4 class="gallery-title">Minecraft Survival</h4>
                                <p class="gallery-desc">Epic building and exploration session with the community!</p>
                            </div>
                        </div>

                        <!-- Gallery Item 2 -->
                        <div class="gallery-item">
                            <img src="/public/image/gallery/mc2.jpg" alt="Minecraft Session 2" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4 class="gallery-title">Minecraft Survival</h4>
                                <p class="gallery-desc">Amazing collaborative building project by our creative members</p>
                            </div>
                        </div>

                        <!-- Gallery Item 3 -->
                        <div class="gallery-item">
                            <img src="/public/image/gallery/ml.jpg" alt="Mobile Legends" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4 class="gallery-title">Mobile Legends Ranked Party</h4>
                                <p class="gallery-desc">Intense MOBA battles with epic teamwork and strategy</p>
                            </div>
                        </div>

                        <!-- Gallery Item 4 -->
                        <div class="gallery-item">
                            <img src="/public/image/gallery/rb1.jpg" alt="Roblox Session 1" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4 class="gallery-title">Roblox Fun Time</h4>
                                <p class="gallery-desc">Exploring different worlds and having fun together in Roblox</p>
                            </div>
                        </div>

                        <!-- Gallery Item 5 -->
                        <div class="gallery-item">
                            <img src="/public/image/gallery/val.jpg" alt="Valorant Match" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4 class="gallery-title">Valorant Competitive</h4>
                                <p class="gallery-desc">Tactical FPS action with amazing teamwork and clutch plays</p>
                            </div>
                        </div>

                        <!-- Gallery Item 6 -->
                        <div class="gallery-item">
                            <img src="/public/image/gallery/rb2.jpg" alt="Roblox Session 2" class="gallery-img">
                            <div class="gallery-overlay">
                                <h4 class="gallery-title">Roblox Community Event</h4>
                                <p class="gallery-desc">Special community event with games, challenges, and prizes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Journey Timeline Section -->
        <div class="row">
            <div class="col-12">
                <div class="retro-card">
                    <h2 class="card-title text-center">
                        <i class="bi bi-clock-history me-2"></i>
                        Our Journey
                    </h2>
                    <p class="text-center mb-5" style="color: var(--text-secondary);">
                        The story of how Ranconnity grew from a simple idea to an amazing community
                    </p>

                    <div class="timeline">
                        <!-- Timeline Item 1 -->
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <div class="timeline-date">2022 - Beginning</div>
                                <h4 class="timeline-title">Server Creation</h4>
                                <p class="timeline-desc">
                                    Kio membuat server ini hanya iseng-iseng saja, tidak menyangka akan berkembang menjadi komunitas yang luar biasa.
                                </p>
                            </div>
                            <div class="timeline-dot"></div>
                        </div>

                        <!-- Timeline Item 2 -->
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <div class="timeline-date">2022 - Month 9</div>
                                <h4 class="timeline-title">Vision Change</h4>
                                <p class="timeline-desc">
                                    Setelah 9 bulan, visi berubah untuk menjadikan server sebagai tempat berinteraksi, sharing ilmu, dan bereksperimen bersama.
                                </p>
                            </div>
                            <div class="timeline-dot"></div>
                        </div>

                        <!-- Timeline Item 3 -->
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <div class="timeline-date">2023 - Month 6</div>
                                <h4 class="timeline-title">First 50 Members</h4>
                                <p class="timeline-desc">
                                    Mencapai 50 member pertama! Komunitas mulai aktif dengan diskusi dan gaming sessions reguler.
                                </p>
                            </div>
                            <div class="timeline-dot"></div>
                        </div>

                        <!-- Timeline Item 4 -->
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <div class="timeline-date">2024 - Month 6</div>
                                <h4 class="timeline-title">1st Minecraft Server Launch</h4>
                                <p class="timeline-desc">
                                    Peluncuran Minecraft server khusus untuk komunitas. Event pertama yang menarik perhatian dan menyenangkan!
                                </p>
                            </div>
                            <div class="timeline-dot"></div>
                        </div>

                        <!-- Timeline Item 5 -->
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <div class="timeline-date">2024 - Month 11</div>
                                <h4 class="timeline-title">100+ Active Members</h4>
                                <p class="timeline-desc">
                                    Mencapai lebih dari 100 member aktif! Server menjadi tempat favorit untuk nongkrong dan berbagi pengalaman.
                                </p>
                            </div>
                            <div class="timeline-dot"></div>
                        </div>

                        <!-- Timeline Item 6 -->
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <div class="timeline-date">2024 - Present</div>
                                <h4 class="timeline-title">180+ Members & 2nd Minecraft Server Launch</h4>
                                <p class="timeline-desc">
                                    Sekarang dengan 180+ member dan terus berkembang! Menjadi komunitas positif untuk anak muda yang suka berinteraksi di dunia maya. Ditambah dengan suksesnya server minecraft kedua.
                                </p>
                            </div>
                            <div class="timeline-dot"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Random glitch effect for title
        const title = document.querySelector('.glitch-title');
        setInterval(() => {
            if (Math.random() > 0.95) {
                title.style.transform = `translateX(${Math.random() * 4 - 2}px)`;
                setTimeout(() => {
                    title.style.transform = 'translateX(0)';
                }, 100);
            }
        }, 100);

        // Gallery item hover effects
        const galleryItems = document.querySelectorAll('.gallery-item');
        galleryItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.borderColor = `var(--retro-${['cyan', 'purple', 'yellow', 'green'][Math.floor(Math.random() * 4)]})`;
            });
        });

        // Timeline animation on scroll
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.timeline-item').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(50px)';
            item.style.transition = `all 0.6s ease ${index * 0.2}s`;
            observer.observe(item);
        });

        // Handle gallery image loading errors
        document.querySelectorAll('.gallery-img').forEach(img => {
            img.addEventListener('error', function() {
                this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjIyNSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjMWExYTFhIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzAwZmZmZiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkdhbGxlcnkgSW1hZ2U8L3RleHQ+PC9zdmc+';
                this.alt = 'Gallery Image Placeholder';
            });
        });
    });
</script>

</body>
</html>