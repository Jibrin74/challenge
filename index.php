<?php
/**
 * Nexora Payment Platform - Modern Landing Page
 */

require_once __DIR__ . '/config/config.php';

// Redirect to dashboard if logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    redirect('pages/dashboard.php');
}

$csrfToken = generate_csrf_token();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo APP_NAME; ?> - Send money internationally with the best exchange rates. Secure, fast, and affordable cross-border payments.">
    <meta name="csrf-token" content="<?php echo $csrfToken; ?>">
    <title><?php echo APP_NAME; ?> | Global Money Transfers Made Simple</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/design-system.css'); ?>">
    <style>
        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(ellipse at 20% 20%, rgba(99, 102, 241, 0.3) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(236, 72, 153, 0.2) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-grid {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        .hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 20%; top: 60%; animation-delay: 1s; }
        .particle:nth-child(3) { left: 30%; top: 30%; animation-delay: 2s; }
        .particle:nth-child(4) { left: 50%; top: 70%; animation-delay: 0.5s; }
        .particle:nth-child(5) { left: 70%; top: 40%; animation-delay: 1.5s; }
        .particle:nth-child(6) { left: 80%; top: 80%; animation-delay: 2.5s; }
        .particle:nth-child(7) { left: 90%; top: 25%; animation-delay: 3s; }
        .particle:nth-child(8) { left: 15%; top: 85%; animation-delay: 3.5s; }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1rem 2rem;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .navbar-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            transition: color 0.2s;
            text-decoration: none;
        }

        .nav-link:hover {
            color: white;
        }

        .nav-cta {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.2s;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }

        .btn-outline {
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .btn-large {
            padding: 1rem 2rem;
            font-size: 1.125rem;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 1400px;
            margin: 0 auto;
            padding: 10rem 2rem 6rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(99, 102, 241, 0.2);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 100px;
            color: #a5b4fc;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.6s ease-out;
        }

        .hero-badge span {
            animation: pulse 2s infinite;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            color: white;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, #6366f1 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            margin-bottom: 2rem;
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .hero-cta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 3rem;
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .stat-item {
            text-align: left;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: white;
        }

        .stat-label {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Hero Card */
        .hero-card {
            position: relative;
            animation: slideInRight 0.8s ease-out 0.3s both;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .card-title {
            color: white;
            font-weight: 600;
        }

        .card-badge {
            padding: 0.25rem 0.75rem;
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 100px;
        }

        .currency-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            margin-bottom: 0.75rem;
            transition: all 0.2s;
        }

        .currency-row:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .currency-flag {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }

        .currency-info {
            flex: 1;
        }

        .currency-code {
            color: white;
            font-weight: 600;
        }

        .currency-name {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
        }

        .currency-rate {
            text-align: right;
        }

        .rate-value {
            color: white;
            font-weight: 600;
        }

        .rate-change {
            font-size: 0.75rem;
        }

        .rate-change.up { color: #34d399; }
        .rate-change.down { color: #f87171; }

        .card-footer {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .live-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.875rem;
        }

        .live-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        /* Features Section */
        .features {
            padding: 8rem 2rem;
            background: white;
        }

        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 4rem;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            color: #6366f1;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 100px;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1rem;
        }

        .section-description {
            font-size: 1.125rem;
            color: #64748b;
            line-height: 1.7;
        }

        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .feature-card {
            padding: 2rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            border-color: #6366f1;
            box-shadow: 0 20px 40px -15px rgba(99, 102, 241, 0.2);
            transform: translateY(-4px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.75rem;
        }

        .feature-description {
            color: #64748b;
            line-height: 1.6;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Footer */
        .footer {
            padding: 4rem 2rem 2rem;
            background: #0f172a;
            color: white;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 4rem;
            margin-bottom: 3rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-link:hover {
            color: white;
        }

        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                padding-top: 8rem;
            }
            .hero-card { display: none; }
            .features-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .nav-links, .nav-cta { display: none; }
            .hero-title { font-size: 2.5rem; }
            .features-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-grid"></div>
        <div class="hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <!-- Navbar -->
        <nav class="navbar" id="navbar">
            <div class="navbar-content">
                <a href="<?php echo base_url(); ?>" class="logo">
                    <div class="logo-icon">💳</div>
                    <span><?php echo APP_NAME; ?></span>
                </a>
                
                <div class="nav-links">
                    <a href="#features" class="nav-link">Features</a>
                    <a href="#how-it-works" class="nav-link">How it Works</a>
                    <a href="#currencies" class="nav-link">Currencies</a>
                </div>

                <div class="nav-cta">
                    <a href="<?php echo base_url('pages/login.php'); ?>" class="btn btn-outline">Sign In</a>
                    <a href="<?php echo base_url('pages/register.php'); ?>" class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <span>🚀</span> Trusted by 500,000+ users worldwide
                </div>
                <h1 class="hero-title">
                    Send Money <span class="highlight">Globally</span> in Seconds
                </h1>
                <p class="hero-description">
                    Experience the future of international payments. Send money to 150+ countries 
                    with real-time exchange rates, zero hidden fees, and bank-grade security.
                </p>
                <div class="hero-cta">
                    <a href="<?php echo base_url('pages/register.php'); ?>" class="btn btn-primary btn-large">
                        Create Free Account →
                    </a>
                    <a href="#how-it-works" class="btn btn-outline btn-large">
                        See How It Works
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-value">$2B+</div>
                        <div class="stat-label">Money Transferred</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">150+</div>
                        <div class="stat-label">Countries</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">4.9★</div>
                        <div class="stat-label">User Rating</div>
                    </div>
                </div>
            </div>

            <div class="hero-card">
                <div class="card-glass">
                    <div class="card-header">
                        <span class="card-title">Live Exchange Rates</span>
                        <span class="card-badge">Updated Now</span>
                    </div>
                    
                    <div class="currency-row">
                        <div class="currency-flag">🇺🇸</div>
                        <div class="currency-info">
                            <div class="currency-code">USD</div>
                            <div class="currency-name">US Dollar</div>
                        </div>
                        <div class="currency-rate">
                            <div class="rate-value">₦1,520.00</div>
                            <div class="rate-change up">+0.5%</div>
                        </div>
                    </div>

                    <div class="currency-row">
                        <div class="currency-flag">🇪🇺</div>
                        <div class="currency-info">
                            <div class="currency-code">EUR</div>
                            <div class="currency-name">Euro</div>
                        </div>
                        <div class="currency-rate">
                            <div class="rate-value">₦1,650.00</div>
                            <div class="rate-change up">+0.3%</div>
                        </div>
                    </div>

                    <div class="currency-row">
                        <div class="currency-flag">🇬🇧</div>
                        <div class="currency-info">
                            <div class="currency-code">GBP</div>
                            <div class="currency-name">British Pound</div>
                        </div>
                        <div class="currency-rate">
                            <div class="rate-value">₦1,920.00</div>
                            <div class="rate-change down">-0.2%</div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="live-indicator">
                            <span class="live-dot"></span>
                            <span>Live Updates</span>
                        </div>
                        <a href="#" style="color: #a5b4fc; font-size: 0.875rem;">View All →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-header reveal">
            <span class="section-label">✨ Why Choose Us</span>
            <h2 class="section-title">Everything You Need to Send Money</h2>
            <p class="section-description">
                Built with cutting-edge technology and designed for the modern world. 
                Experience seamless international transfers like never before.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal">
                <div class="feature-icon">⚡</div>
                <h3 class="feature-title">Lightning Fast</h3>
                <p class="feature-description">
                    Send money in seconds, not days. Our real-time processing ensures 
                    your funds reach their destination instantly.
                </p>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">🔒</div>
                <h3 class="feature-title">Bank-Grade Security</h3>
                <p class="feature-description">
                    256-bit SSL encryption, biometric authentication, and real-time 
                    fraud detection keep your money safe.
                </p>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">💱</div>
                <h3 class="feature-title">Best Exchange Rates</h3>
                <p class="feature-description">
                    Get mid-market rates with zero hidden fees. Save up to 8x compared 
                    to traditional banks.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="logo-icon">💳</div>
                    <span><?php echo APP_NAME; ?></span>
                </div>
                <p class="footer-description">
                    The future of international money transfers. Fast, secure, 
                    and affordable payments to 150+ countries.
                </p>
            </div>

            <div class="footer-column">
                <h4>Product</h4>
                <div class="footer-links">
                    <a href="#" class="footer-link">Send Money</a>
                    <a href="#" class="footer-link">Currency Exchange</a>
                    <a href="#" class="footer-link">Business API</a>
                </div>
            </div>

            <div class="footer-column">
                <h4>Company</h4>
                <div class="footer-links">
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Contact</a>
                </div>
            </div>

            <div class="footer-column">
                <h4>Support</h4>
                <div class="footer-links">
                    <a href="#" class="footer-link">Help Center</a>
                    <a href="#" class="footer-link">Security</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom" style="text-align: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem;">
            <p class="footer-copyright" style="color: rgba(255,255,255,0.5); font-size: 0.875rem;">
                © <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Scroll reveal animation
        const revealElements = document.querySelectorAll('.reveal');
        
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('active');
                    }, index * 100);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    </script>
</body>
</html>
