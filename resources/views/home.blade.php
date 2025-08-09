<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranconnity - Gaming Community Hub</title>
    
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

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 2rem 0;
        }

        .hero-container {
            max-width: 1200px;
            width: 100%;
            position: relative;
        }

        .glitch-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 4rem;
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

        .hero-subtitle {
            text-align: center;
            font-size: 1.5rem;
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

        /* Gaming Stats */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .stat-box {
            background: rgba(0, 255, 65, 0.1);
            border: 2px solid var(--retro-green);
            padding: 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stat-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 65, 0.2), transparent);
            animation: statScan 2s linear infinite;
        }

        @keyframes statScan {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .stat-number {
            font-family: 'Press Start 2P', monospace;
            font-size: 2rem;
            color: var(--retro-yellow);
            text-shadow: 0 0 10px var(--retro-yellow);
        }

        .stat-label {
            font-family: 'Orbitron', monospace;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0.5rem;
        }

        /* CTA Buttons */
        .retro-btn {
            background: linear-gradient(135deg, var(--retro-purple) 0%, var(--retro-red) 100%);
            border: 2px solid var(--retro-purple);
            color: white;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.8rem;
            text-transform: uppercase;
            padding: 1rem 2rem;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            margin: 0.5rem;
        }

        .retro-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .retro-btn:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 10px 20px rgba(255, 0, 255, 0.4),
                0 0 30px rgba(255, 0, 255, 0.3);
            color: white;
            text-decoration: none;
        }

        .retro-btn:hover::before {
            left: 100%;
        }

        .retro-btn-secondary {
            background: linear-gradient(135deg, var(--retro-yellow) 0%, var(--retro-red) 100%);
            border: 3px solid var(--retro-yellow);
            font-size: 0.9rem;
            padding: 1.2rem 2.5rem;
            position: relative;
            animation: pulseGlow 2s ease-in-out infinite;
            box-shadow: 
                0 0 20px rgba(255, 255, 0, 0.5),
                0 0 40px rgba(255, 255, 0, 0.3),
                inset 0 0 20px rgba(255, 255, 0, 0.1);
        }

        @keyframes pulseGlow {
            0%, 100% { 
                box-shadow: 
                    0 0 20px rgba(255, 255, 0, 0.5),
                    0 0 40px rgba(255, 255, 0, 0.3),
                    inset 0 0 20px rgba(255, 255, 0, 0.1);
                transform: scale(1);
            }
            50% { 
                box-shadow: 
                    0 0 30px rgba(255, 255, 0, 0.8),
                    0 0 60px rgba(255, 255, 0, 0.5),
                    inset 0 0 30px rgba(255, 255, 0, 0.2);
                transform: scale(1.02);
            }
        }

        .retro-btn-secondary:hover {
            background: linear-gradient(135deg, var(--retro-yellow) 0%, var(--retro-purple) 100%);
            border-color: var(--retro-yellow);
            box-shadow: 
                0 15px 30px rgba(255, 255, 0, 0.6),
                0 0 50px rgba(255, 255, 0, 0.4),
                inset 0 0 30px rgba(255, 255, 0, 0.2);
            transform: translateY(-5px) scale(1.05);
            animation: none;
        }

        .retro-btn-secondary::after {
            content: '🎯';
            position: absolute;
            top: -8px;
            right: -8px;
            font-size: 1.2rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-8px);
            }
            60% {
                transform: translateY(-4px);
            }
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

        /* Testimonials */
        .testimonial-container {
            position: relative;
            overflow: hidden;
            margin: 2rem 0;
        }

        .testimonial-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 800%; /* 8 testimonials × 100% */
        }

        .testimonial-card {
            width: 12.5%; /* 100% / 8 testimonials */
            flex-shrink: 0;
            padding: 0 1rem;
        }

        .testimonial-content {
            display: flex;
            align-items: center;
            gap: 2rem;
            background: rgba(0, 255, 65, 0.05);
            border: 2px solid rgba(0, 255, 65, 0.3);
            border-radius: 15px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .testimonial-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.1), transparent);
            animation: testimonialShine 3s linear infinite;
        }

        @keyframes testimonialShine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .testimonial-avatar {
            flex-shrink: 0;
        }

        .testimonial-avatar i {
            font-size: 4rem;
            color: var(--retro-cyan);
            text-shadow: 0 0 10px var(--retro-cyan);
        }

        .testimonial-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid var(--retro-cyan);
            box-shadow: 0 0 15px var(--retro-cyan);
            object-fit: cover;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.2), rgba(255, 0, 255, 0.2));
        }

        .testimonial-img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 25px var(--retro-cyan);
        }

        /* Fallback for broken images */
        .testimonial-avatar {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .testimonial-img:before {
            content: '';
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.3), rgba(255, 0, 255, 0.3));
            border: 3px solid var(--retro-cyan);
            box-shadow: 0 0 15px var(--retro-cyan);
        }

        /* CEO Avatar Styling */
        .ceo-avatar-container {
            width: 200px;
            height: 200px;
            margin: 0 auto;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ceo-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 4px solid var(--retro-cyan);
            box-shadow: 
                0 0 20px var(--retro-cyan),
                0 0 40px rgba(0, 255, 255, 0.5),
                inset 0 0 20px rgba(0, 255, 255, 0.1);
            object-fit: cover;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.2), rgba(255, 0, 255, 0.2));
        }

        .ceo-img:hover {
            transform: scale(1.05);
            box-shadow: 
                0 0 30px var(--retro-cyan),
                0 0 60px rgba(0, 255, 255, 0.6),
                inset 0 0 30px rgba(0, 255, 255, 0.2);
        }

        /* CEO Avatar Animated Border */
        .ceo-avatar-container::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--retro-green), var(--retro-cyan), var(--retro-purple), var(--retro-yellow));
            z-index: -1;
            animation: ceoGlow 3s linear infinite;
        }

        @keyframes ceoGlow {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 0.4; }
        }

        .testimonial-text p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text-primary);
            margin-bottom: 1rem;
            font-style: italic;
        }

        .testimonial-author strong {
            color: var(--retro-green);
            font-family: 'Orbitron', monospace;
            display: block;
            margin-bottom: 0.25rem;
        }

        .testimonial-author span {
            color: var(--text-secondary);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .testimonial-dots {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .testimonial-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(0, 255, 65, 0.3);
            border: 2px solid var(--retro-green);
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .testimonial-dot.active {
            background: var(--retro-green);
            box-shadow: 0 0 10px var(--retro-green);
            transform: scale(1.2);
        }

        .testimonial-dot:hover {
            background: var(--retro-cyan);
            border-color: var(--retro-cyan);
            box-shadow: 0 0 8px var(--retro-cyan);
        }

        /* Footer Gallery Section */
        .footer-section {
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.95) 0%, rgba(10, 10, 58, 0.95) 50%, rgba(58, 10, 58, 0.95) 100%);
            border-top: 3px solid var(--retro-purple);
            padding: 4rem 0 3rem;
            margin-top: 5rem;
            position: relative;
            overflow: hidden;
        }

        .footer-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 0, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(0, 255, 255, 0.1) 0%, transparent 50%);
            animation: footerGlow 8s ease-in-out infinite;
        }

        @keyframes footerGlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .footer-gallery-container {
            position: relative;
            z-index: 2;
        }

        .footer-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.8rem;
            color: var(--retro-purple);
            text-shadow: 
                0 0 10px var(--retro-purple),
                0 0 20px var(--retro-purple),
                0 0 30px var(--retro-purple);
            margin-bottom: 1.5rem;
            animation: footerTitlePulse 3s ease-in-out infinite;
        }

        @keyframes footerTitlePulse {
            0%, 100% { 
                text-shadow: 
                    0 0 10px var(--retro-purple),
                    0 0 20px var(--retro-purple),
                    0 0 30px var(--retro-purple);
            }
            50% { 
                text-shadow: 
                    0 0 15px var(--retro-purple),
                    0 0 30px var(--retro-purple),
                    0 0 45px var(--retro-purple);
            }
        }

        .footer-subtitle {
            font-family: 'Orbitron', monospace;
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        /* Special Gallery Button */
        .retro-btn-gallery {
            background: linear-gradient(135deg, var(--retro-purple) 0%, var(--retro-cyan) 50%, var(--retro-yellow) 100%);
            border: 3px solid var(--retro-purple);
            font-size: 1rem;
            padding: 1.5rem 3rem;
            position: relative;
            overflow: hidden;
            animation: galleryButtonGlow 2s ease-in-out infinite;
            box-shadow: 
                0 0 30px rgba(255, 0, 255, 0.6),
                0 0 60px rgba(255, 0, 255, 0.4),
                inset 0 0 30px rgba(255, 255, 255, 0.1);
            transform: perspective(1000px) rotateX(0deg);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes galleryButtonGlow {
            0%, 100% { 
                box-shadow: 
                    0 0 30px rgba(255, 0, 255, 0.6),
                    0 0 60px rgba(255, 0, 255, 0.4),
                    inset 0 0 30px rgba(255, 255, 255, 0.1);
                transform: perspective(1000px) rotateX(0deg) scale(1);
            }
            50% { 
                box-shadow: 
                    0 0 40px rgba(0, 255, 255, 0.8),
                    0 0 80px rgba(0, 255, 255, 0.6),
                    inset 0 0 40px rgba(255, 255, 255, 0.2);
                transform: perspective(1000px) rotateX(5deg) scale(1.02);
            }
        }

        .retro-btn-gallery:hover {
            background: linear-gradient(135deg, var(--retro-cyan) 0%, var(--retro-yellow) 50%, var(--retro-red) 100%);
            border-color: var(--retro-cyan);
            transform: perspective(1000px) rotateX(-10deg) translateY(-10px) scale(1.1);
            box-shadow: 
                0 20px 40px rgba(0, 255, 255, 0.8),
                0 0 100px rgba(0, 255, 255, 0.6),
                inset 0 0 50px rgba(255, 255, 255, 0.3);
            animation: none;
            color: white;
        }

        /* Sparkle Effects */
        .btn-sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            animation: sparkle 2s linear infinite;
        }

        .btn-sparkle:nth-child(2) {
            top: 20%;
            left: 20%;
            animation-delay: 0.3s;
        }

        .btn-sparkle:nth-child(3) {
            top: 60%;
            right: 25%;
            animation-delay: 0.8s;
        }

        .btn-sparkle:nth-child(4) {
            bottom: 25%;
            left: 60%;
            animation-delay: 1.2s;
        }

        @keyframes sparkle {
            0%, 100% { 
                opacity: 0; 
                transform: scale(0);
            }
            50% { 
                opacity: 1; 
                transform: scale(1);
                box-shadow: 0 0 10px white;
            }
        }

        /* Special Hover Effects */
        .retro-btn-gallery::after {
            content: '✨';
            position: absolute;
            top: -15px;
            right: -15px;
            font-size: 1.5rem;
            animation: sparkleRotate 3s linear infinite;
            opacity: 0.8;
        }

        @keyframes sparkleRotate {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.2); }
            100% { transform: rotate(360deg) scale(1); }
        }

        .retro-btn-gallery:hover::after {
            animation: sparkleRotate 0.5s linear infinite;
            font-size: 2rem;
            opacity: 1;
        }

        /* Footer Buttons Layout */
        .footer-buttons {
            display: flex;
            gap: 2rem;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        /* Coffee Button Styles */
        .retro-btn-coffee {
            background: linear-gradient(135deg, var(--retro-orange) 0%, var(--retro-red) 50%, var(--retro-purple) 100%);
            border: 3px solid var(--retro-orange);
            font-size: 1rem;
            padding: 1.5rem 3rem;
            position: relative;
            overflow: hidden;
            animation: coffeeButtonGlow 2.5s ease-in-out infinite;
            box-shadow: 
                0 0 30px rgba(255, 107, 0, 0.6),
                0 0 60px rgba(255, 107, 0, 0.4),
                inset 0 0 30px rgba(255, 255, 255, 0.1);
            transform: perspective(1000px) rotateX(0deg);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes coffeeButtonGlow {
            0%, 100% { 
                box-shadow: 
                    0 0 30px rgba(255, 107, 0, 0.6),
                    0 0 60px rgba(255, 107, 0, 0.4),
                    inset 0 0 30px rgba(255, 255, 255, 0.1);
                transform: perspective(1000px) rotateX(0deg) scale(1);
            }
            50% { 
                box-shadow: 
                    0 0 40px rgba(255, 0, 64, 0.8),
                    0 0 80px rgba(255, 0, 64, 0.6),
                    inset 0 0 40px rgba(255, 255, 255, 0.2);
                transform: perspective(1000px) rotateX(3deg) scale(1.01);
            }
        }

        .retro-btn-coffee:hover {
            background: linear-gradient(135deg, var(--retro-red) 0%, var(--retro-purple) 50%, var(--retro-cyan) 100%);
            border-color: var(--retro-red);
            transform: perspective(1000px) rotateX(-8deg) translateY(-8px) scale(1.08);
            box-shadow: 
                0 15px 35px rgba(255, 0, 64, 0.8),
                0 0 90px rgba(255, 0, 64, 0.6),
                inset 0 0 45px rgba(255, 255, 255, 0.3);
            animation: none;
            color: white;
        }

        /* Coffee Steam Effects */
        .coffee-steam {
            position: absolute;
            width: 2px;
            height: 15px;
            background: linear-gradient(to top, transparent, rgba(255, 255, 255, 0.8), transparent);
            border-radius: 50%;
            animation: steam 2s ease-in-out infinite;
            top: -10px;
        }

        .coffee-steam:nth-child(2) {
            left: 25%;
            animation-delay: 0.3s;
            height: 12px;
        }

        .coffee-steam:nth-child(3) {
            left: 50%;
            animation-delay: 0.6s;
            height: 18px;
        }

        .coffee-steam:nth-child(4) {
            right: 25%;
            animation-delay: 0.9s;
            height: 10px;
        }

        @keyframes steam {
            0%, 100% { 
                opacity: 0; 
                transform: translateY(0px) scaleY(1);
            }
            50% { 
                opacity: 1; 
                transform: translateY(-8px) scaleY(1.5);
            }
        }

        /* Coffee Button Special Effects */
        .retro-btn-coffee::after {
            content: '☕';
            position: absolute;
            top: -12px;
            right: -12px;
            font-size: 1.3rem;
            animation: coffeeFloat 3s ease-in-out infinite;
            opacity: 0.9;
            filter: drop-shadow(0 0 5px rgba(255, 107, 0, 0.8));
        }

        @keyframes coffeeFloat {
            0%, 100% { 
                transform: rotate(0deg) scale(1) translateY(0px);
            }
            33% { 
                transform: rotate(5deg) scale(1.1) translateY(-3px);
            }
            66% { 
                transform: rotate(-5deg) scale(1.05) translateY(-1px);
            }
        }

        .retro-btn-coffee:hover::after {
            animation: coffeeFloat 0.8s ease-in-out infinite;
            font-size: 1.8rem;
            opacity: 1;
            filter: drop-shadow(0 0 10px rgba(255, 0, 64, 1));
        }

        .retro-btn-coffee:hover .coffee-steam {
            animation-duration: 1s;
            height: 20px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .glitch-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1.2rem;
            }
            .retro-card {
                padding: 1.5rem;
            }
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
            .testimonial-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding: 1.5rem;
            }
            .testimonial-avatar i {
                font-size: 3rem;
            }
            .testimonial-img {
                width: 60px;
                height: 60px;
            }
            .ceo-img {
                width: 150px;
                height: 150px;
            }
            .footer-title {
                font-size: 1.3rem;
            }
            .footer-subtitle {
                font-size: 1rem;
            }
            .retro-btn-gallery {
                font-size: 0.9rem;
                padding: 1.2rem 2.5rem;
            }
            .retro-btn-coffee {
                font-size: 0.9rem;
                padding: 1.2rem 2.5rem;
            }
            .footer-buttons {
                gap: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .glitch-title {
                font-size: 1.5rem;
            }
            .stats-container {
                grid-template-columns: 1fr;
            }
            .retro-btn {
                font-size: 0.7rem;
                padding: 0.8rem 1.5rem;
            }
            .retro-btn-secondary {
                font-size: 0.8rem;
                padding: 1rem 2rem;
            }
            .retro-btn-secondary::after {
                font-size: 1rem;
                top: -6px;
                right: -6px;
            }
            .retro-btn-coffee {
                font-size: 0.8rem;
                padding: 1rem 2rem;
            }
            .footer-buttons {
                flex-direction: column;
                gap: 1rem;
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

<!-- Hero Section -->
<section class="hero-section">
    <div class="container hero-container">
        <h1 class="glitch-title">RANCONNITY</h1>
        <p class="hero-subtitle">The Ultimate Gaming Community</p>
        
        <!-- About Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-4">
                <div class="retro-card">
                    <h3 class="card-title text-center">
                        <i class="bi bi-people-fill me-2"></i>
                        Our Community
                    </h3>
                    <p class="card-text text-center">
                    Selamat datang di Random Community — server Indonesia yang terbuka untuk semua!
                    Di sini kamu bisa main game bareng, ngobrol santai, ikut event, atau sekadar nongkrong. 
                    Nama "Random" berarti bebas: topik apa pun bisa muncul, dari game sampai meme, dari musik sampai ngobrol serius.
                    Cocok buat kamu yang mau memperluas circle, ketemu teman baru dari berbagai usia dan latar, dan punya suasana ramah. 
                    Server ini banyak orang Indonesia bukan berarti kita tidak terbuka pada orang atau bahasa dari negara lain, kita bisa ngobrol bahasa lainnya.
                    Join Now ! :'>
                    </p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-number">180+</div>
                <div class="stat-label">Joined Members</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Community Active</div>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="retro-card">
                    <h3 class="card-title text-center">
                        <i class="bi bi-rocket-takeoff me-2"></i>
                        Our Mission
                    </h3>
                    <p class="card-text text-center" style="font-size: 1.2rem;">
                        There are no mission, we play, talk, learn, and sleep.
                        
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA Buttons -->
        <div class="text-center mt-5">
            <div class="mb-3">
                <p class="text-center" style="color: var(--retro-yellow); font-family: 'Orbitron', monospace; font-size: 1.1rem; margin-bottom: 0.5rem; text-shadow: 0 0 10px var(--retro-yellow);">
                    <i class="bi bi-star-fill me-2"></i>
                    Ready to Join Our Community full of mid-highschoolers?
                </p>
                <p class="text-center" style="color: var(--text-secondary); font-size: 0.9rem;">
                    Request special roles and get verified access!
                </p>
            </div>
            <a href="https://discord.gg/CdpPfKUK4p" class="retro-btn">
                <i class="bi bi-discord me-2"></i>
                Join Our Server
            </a>
            <a href="/submit" class="retro-btn retro-btn-secondary">
                <i class="bi bi-mortarboard-fill me-2"></i>
                Role Requestor Form
            </a>
        </div>

        <!-- Features Grid -->
        <div class="row mt-5 justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="retro-card text-center">
                    <i class="bi bi-shield-check" style="font-size: 3rem; color: var(--retro-green); margin-bottom: 1rem;"></i>
                    <h4 class="card-title">Verified Members</h4>
                    <p class="card-text">
                        Our verification system ensures a safe and trusted community environment for all members.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="retro-card text-center">
                    <i class="bi bi-gem" style="font-size: 3rem; color: var(--retro-purple); margin-bottom: 1rem;"></i>
                    <h4 class="card-title">Exclusive Roles</h4>
                    <p class="card-text">
                        Earn unique roles and privileges based on your gaming achievements and community contributions.
                    </p>
                </div>
            </div>
        </div>

        <!-- About CEO Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="retro-card">
                    <h3 class="card-title text-center">
                        <i class="bi bi-person-badge me-2"></i>
                        About Our CEO
                    </h3>
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="ceo-avatar-container">
                                <img src="/public/image/avatars/ceo.jpg" alt="CEO Avatar" class="ceo-img">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 style="color: var(--retro-cyan); font-family: 'Orbitron', monospace; margin-bottom: 1rem;">Atthariq - Founder & CEO</h4>
                            <p class="card-text" style="font-size: 1.1rem; line-height: 1.8;">
                            Nama saya Atthariq biasa dipanggil Attar, saya salah satu pendiri dari server ini, awalnya saya membuat server ini hanya iseng iseng saja
                             namun seminggu kemudian saya berubah pikiran untuk dijadikan sebuah server yang bisa berinteraksi satu sama lain dengan sangat jauh, bisa mensharing ilmu, mengobrol dengan teman baru, bermain bersama, bereskperimen bersama. 
                             yang saya harapkan dari server ini untuk seterusnya adalah, bisa menjadi sebuah server yang positif dan ramai dipakai untuk kalangan anak muda yang suka berinteraksi dengan banyak orang di dunia maya.
                            </p>
                            <p class="card-text" style="font-size: 1rem; color: var(--retro-green);">
                                <i class="bi bi-quote me-2"></i>
                                "Gaming isn't just about playing - it's about building communities, creating memories, and 
                                forming friendships that last a lifetime."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="retro-card">
                    <h3 class="card-title text-center mb-4">
                        <i class="bi bi-chat-heart me-2"></i>
                        What Our Members Say
                    </h3>
                    
                    <div class="testimonial-container">
                        <div class="testimonial-track" id="testimonialTrack">
                            <!-- Testimonial 1 -->
                            <div class="testimonial-card">
                                <div class="testimonial-content">
                                    <div class="testimonial-avatar">
                                        <img src="/public/image/avatars/popothegamer.jpg" alt="@popothegamer Avatar" class="testimonial-img">
                                    </div>
                                    <div class="testimonial-text">
                                        <p>"gw join server ini dan mendapatkan kemantapan yang sungguh mantap"</p>
                                        <div class="testimonial-author">
                                            <strong>- @popothegamer</strong>
                                            <span>Active Member</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 2 -->
                            <div class="testimonial-card">
                                <div class="testimonial-content">
                                    <div class="testimonial-avatar">
                                        <img src="/public/image/avatars/ciaooo0.jpg" alt="@ciaooo0 Avatar" class="testimonial-img">
                                    </div>
                                    <div class="testimonial-text">
                                        <p>"gw join server ini karena komunitas nya asik"</p>
                                        <div class="testimonial-author">
                                            <strong>- @ciaooo0</strong>
                                            <span>Active Member</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 3 -->
                            <div class="testimonial-card">
                                <div class="testimonial-content">
                                    <div class="testimonial-avatar">
                                        <img src="/public/image/avatars/mellynhalim.jpg" alt="@mellynhalim Avatar" class="testimonial-img">
                                    </div>
                                    <div class="testimonial-text">
                                        <p>"idk why i joined this server but i had fun with them in minecraft server events, 
                                            and also that minecraft server was great, i had alot of fun that day :)"</p>
                                        <div class="testimonial-author">
                                            <strong>- @mellynhalim</strong>
                                            <span>Active Member</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 4 -->
                            <div class="testimonial-card">
                                <div class="testimonial-content">
                                    <div class="testimonial-avatar">
                                        <img src="/public/image/avatars/professional_stupid..jpg" alt="@professional_stupid. Avatar" class="testimonial-img">
                                    </div>
                                    <div class="testimonial-text">
                                        <p>"gw join ini server karena temen sekolah gw, servernya chill and member2nya asik diajak ngobrol"</p>
                                        <div class="testimonial-author">
                                            <strong>- @professional_stupid.</strong>
                                            <span>Active Member</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 5 -->
                            <div class="testimonial-card">
                                <div class="testimonial-content">
                                    <div class="testimonial-avatar">
                                        <img src="/public/image/avatars/daito_asakuraa.jpg" alt="@daito_asakuraa Avatar" class="testimonial-img">
                                    </div>
                                    <div class="testimonial-text">
                                        <p>"Kepala di parut, kelapa di garuk"</p>
                                        <div class="testimonial-author">
                                            <strong>- @daito_asakuraa</strong>
                                            <span>Long-time Member</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 6 -->
                            <div class="testimonial-card">
                                <div class="testimonial-content">
                                    <div class="testimonial-avatar">
                                        <img src="/public/image/avatars/leonidasxv.jpg" alt="@leonidasxv Avatar" class="testimonial-img">
                                    </div>
                                    <div class="testimonial-text">
                                        <p>"server menkrepnya keren"</p>
                                        <div class="testimonial-author">
                                            <strong>- @leonidasxv</strong>
                                            <span>Long-time Member</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 7 -->
                            <div class="testimonial-card">
                                <div class="testimonial-content">
                                    <div class="testimonial-avatar">
                                        <img src="/public/image/avatars/34kgdval.jpg" alt="@34kgdval Avatar" class="testimonial-img">
                                    </div>
                                    <div class="testimonial-text">
                                        <p>"ネトフレのためにこのサバ来た草"</p>
                                        <div class="testimonial-author">
                                            <strong>- @34kgdval</strong>
                                            <span>Active Member</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 8 -->
                            <div class="testimonial-card">
                                <div class="testimonial-content">
                                    <div class="testimonial-avatar">
                                        <img src="/public/image/avatars/lemonlmao69.jpg" alt="@lemonlmao69 Avatar" class="testimonial-img">
                                    </div>
                                    <div class="testimonial-text">
                                        <p>"maybe this is great server for small talk abt ur pathetic life"</p>
                                        <div class="testimonial-author">
                                            <strong>- @lemonlmao69</strong>
                                            <span>Active Member</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        
                        <!-- Navigation dots -->
                        <div class="testimonial-dots text-center mt-4">
                            <span class="testimonial-dot active" data-slide="0"></span>
                            <span class="testimonial-dot" data-slide="1"></span>
                            <span class="testimonial-dot" data-slide="2"></span>
                            <span class="testimonial-dot" data-slide="3"></span>
                            <span class="testimonial-dot" data-slide="4"></span>
                            <span class="testimonial-dot" data-slide="5"></span>
                            <span class="testimonial-dot" data-slide="6"></span>
                            <span class="testimonial-dot" data-slide="7"></span>
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
    // Add retro typing effect
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

        // Animate stats on scroll
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statNumber = entry.target.querySelector('.stat-number');
                    const finalNumber = statNumber.textContent;
                    let currentNumber = 0;
                    const increment = finalNumber.includes('+') ? 
                        parseInt(finalNumber.replace('+', '')) / 50 : 
                        (finalNumber === '24/7' ? 0 : parseInt(finalNumber) / 50);
                    
                    if (increment > 0) {
                        const counter = setInterval(() => {
                            currentNumber += increment;
                            if (currentNumber >= parseInt(finalNumber.replace('+', ''))) {
                                statNumber.textContent = finalNumber;
                                clearInterval(counter);
                            } else {
                                statNumber.textContent = Math.floor(currentNumber) + (finalNumber.includes('+') ? '+' : '');
                            }
                        }, 50);
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-box').forEach(stat => {
            observer.observe(stat);
        });

        // Testimonial Slider
        let currentTestimonial = 0;
        const testimonialTrack = document.getElementById('testimonialTrack');
        const testimonialDots = document.querySelectorAll('.testimonial-dot');
        const totalTestimonials = 8;

        function showTestimonial(index) {
            currentTestimonial = index;
            testimonialTrack.style.transform = `translateX(-${index * 12.5}%)`;
            
            // Update dots
            testimonialDots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        function nextTestimonial() {
            currentTestimonial = (currentTestimonial + 1) % totalTestimonials;
            showTestimonial(currentTestimonial);
        }

        // Add click handlers to dots
        testimonialDots.forEach((dot, index) => {
            dot.addEventListener('click', () => showTestimonial(index));
        });

        // Auto-advance testimonials every 5 seconds
        setInterval(nextTestimonial, 5000);

        // Touch/swipe support for mobile
        let startX = 0;
        let endX = 0;

        testimonialTrack.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });

        testimonialTrack.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = startX - endX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - next testimonial
                    nextTestimonial();
                } else {
                    // Swipe right - previous testimonial
                    currentTestimonial = (currentTestimonial - 1 + totalTestimonials) % totalTestimonials;
                    showTestimonial(currentTestimonial);
                }
            }
        }

        // Handle image loading errors
        document.querySelectorAll('.testimonial-img').forEach(img => {
            img.addEventListener('error', function() {
                // Replace broken image with Bootstrap icon
                const avatar = this.parentElement;
                avatar.innerHTML = '<i class="bi bi-person-circle" style="font-size: 4rem; color: var(--retro-cyan); text-shadow: 0 0 10px var(--retro-cyan);"></i>';
            });
        });

        // Handle CEO image loading error
        const ceoImg = document.querySelector('.ceo-img');
        if (ceoImg) {
            ceoImg.addEventListener('error', function() {
                const container = this.parentElement;
                container.innerHTML = '<i class="bi bi-person-circle" style="font-size: 8rem; color: var(--retro-cyan); text-shadow: 0 0 10px var(--retro-cyan);"></i>';
            });
        }
    });
</script>

<!-- Footer Gallery Button -->
<footer class="footer-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="footer-gallery-container">
                    <h3 class="footer-title">
                        <i class="bi bi-images me-2"></i>
                        Explore Our Gallery
                    </h3>
                    <p class="footer-subtitle">
                        Check out amazing screenshots, memes, and memories from our community!
                    </p>
                    <div class="footer-buttons">
                        <a href="/gallery" class="retro-btn retro-btn-gallery">
                            <i class="bi bi-collection-play me-2"></i>
                            View Gallery
                            <span class="btn-sparkle"></span>
                            <span class="btn-sparkle"></span>
                            <span class="btn-sparkle"></span>
                        </a>
                        <a href="/support" class="retro-btn retro-btn-coffee">
                            <i class="bi bi-cup-hot-fill me-2"></i>
                            Buy Me Coffee
                            <span class="coffee-steam"></span>
                            <span class="coffee-steam"></span>
                            <span class="coffee-steam"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>