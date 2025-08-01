<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp API - Connect, Send, Scale</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #25D366, #128C7E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: #25D366;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: linear-gradient(135deg, #25D366, #128C7E);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.7rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-outline {
            background: transparent;
            color: #25D366;
            border: 2px solid #25D366;
        }

        .btn-outline:hover {
            background: #25D366;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
            border: 2px solid transparent;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>') no-repeat center center;
            background-size: cover;
            opacity: 0.5;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-text {
            color: white;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            font-weight: 400;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .btn-hero {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #25D366;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .hero-visual {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .api-demo {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform 0.3s ease;
        }

        .api-demo:hover {
            transform: perspective(1000px) rotateY(0deg);
        }

        .demo-header {
            background: rgba(0,0,0,0.3);
            color: white;
            padding: 1rem;
            border-radius: 10px 10px 0 0;
            font-family: 'Monaco', monospace;
            font-size: 0.9rem;
        }

        .demo-body {
            background: rgba(0,0,0,0.5);
            color: #00ff88;
            padding: 1.5rem;
            border-radius: 0 0 10px 10px;
            font-family: 'Monaco', monospace;
            font-size: 0.8rem;
            line-height: 1.6;
        }

        /* Features Section */
        .features {
            padding: 5rem 0;
            background: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #333;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 4rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            border-color: #25D366;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #25D366, #128C7E);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: white;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        .feature-description {
            color: #666;
            line-height: 1.6;
        }

        /* Pricing Section */
        .pricing {
            padding: 5rem 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }

        .pricing-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .pricing-card.featured {
            border-color: #25D366;
            background: rgba(37, 211, 102, 0.1);
        }

        .featured-badge {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            background: #25D366;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pricing-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .pricing-price {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .pricing-price span {
            font-size: 1rem;
            opacity: 0.8;
        }

        .pricing-features {
            list-style: none;
            margin-bottom: 2rem;
        }

        .pricing-features li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pricing-features li::before {
            content: '✓';
            color: #25D366;
            font-weight: bold;
        }

        /* CTA Section */
        .cta {
            padding: 5rem 0;
            background: #fff;
            text-align: center;
        }

        .cta-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #333;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: #25D366;
        }

        .footer-bottom {
            border-top: 1px solid #555;
            padding-top: 1rem;
            text-align: center;
            color: #ccc;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #333;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-cta {
                flex-direction: column;
                align-items: center;
            }

            .hero-stats {
                justify-content: center;
            }

            .api-demo {
                transform: none;
                margin-top: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .feature-card {
                padding: 2rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        /* Scroll animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <div class="logo">📱 WhatsApp API</div>
            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="doc">Documentation</a></li>
                <li><a href="#support">Support</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="/login" class="btn btn-outline">Login</a>
                <a href="/signup" class="btn btn-primary">Sign Up</a>
            </div>
            <button class="mobile-menu-btn">☰</button>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title fade-in-up">Connect Your Business to WhatsApp</h1>
                <p class="hero-subtitle fade-in-up">Send messages, share files, and automate conversations with our powerful WhatsApp API. Scale your communication effortlessly.</p>
                <div class="hero-cta fade-in-up">
                    <a href="signup" class="btn btn-primary btn-hero">Get Started Free</a>
                    <a href="doc" class="btn btn-outline btn-hero">View Documentation</a>
                </div>
                <div class="hero-stats fade-in-up">
                    <div class="stat">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">10M+</div>
                        <div class="stat-label">Messages Sent</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Developers</div>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="api-demo floating">
                    <div class="demo-header">
                        POST /api/whatsapp/send-message
                    </div>
                    <div class="demo-body">
{<br>
&nbsp;&nbsp;"instanceKey": "your-key-123",<br>
&nbsp;&nbsp;"number": "1234567890",<br>
&nbsp;&nbsp;"message": "Hello World! 🚀"<br>
}<br><br>
<span style="color: #25D366;">✓ Message sent successfully</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Powerful Features</h2>
            <p class="section-subtitle animate-on-scroll">Everything you need to integrate WhatsApp into your applications</p>
            
            <div class="features-grid">
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">🚀</div>
                    <h3 class="feature-title">Easy Integration</h3>
                    <p class="feature-description">Simple REST API with comprehensive documentation. Get up and running in minutes, not hours.</p>
                </div>
                
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">💬</div>
                    <h3 class="feature-title">Send Messages</h3>
                    <p class="feature-description">Send text messages, images, documents, and files to any WhatsApp number worldwide.</p>
                </div>
                
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">📱</div>
                    <h3 class="feature-title">QR Code Authentication</h3>
                    <p class="feature-description">Secure WhatsApp Web integration with QR code scanning for session management.</p>
                </div>
                
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">High Performance</h3>
                    <p class="feature-description">Built for scale with 99.9% uptime and lightning-fast message delivery.</p>
                </div>
                
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">🔒</div>
                    <h3 class="feature-title">Secure & Reliable</h3>
                    <p class="feature-description">Enterprise-grade security with encrypted connections and reliable message delivery.</p>
                </div>
                
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">📊</div>
                    <h3 class="feature-title">Analytics Dashboard</h3>
                    <p class="feature-description">Track message delivery, monitor usage, and analyze performance with detailed insights.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing" id="pricing">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Simple, Transparent Pricing</h2>
            <p class="section-subtitle animate-on-scroll">Choose the plan that fits your needs. No hidden fees, cancel anytime.</p>
            
            <div class="pricing-grid">
                <div class="pricing-card animate-on-scroll">
                    <h3 class="pricing-title">Starter</h3>
                    <div class="pricing-price">$9<span>/month</span></div>
                    <ul class="pricing-features">
                        <li>1,000 messages/month</li>
                        <li>1 WhatsApp instance</li>
                        <li>Basic API access</li>
                        <li>Email support</li>
                        <li>Standard rate limiting</li>
                    </ul>
                    <a href="#signup" class="btn btn-outline" style="width: 100%;">Get Started</a>
                </div>
                
                <div class="pricing-card featured animate-on-scroll">
                    <div class="featured-badge">Most Popular</div>
                    <h3 class="pricing-title">Professional</h3>
                    <div class="pricing-price">$29<span>/month</span></div>
                    <ul class="pricing-features">
                        <li>10,000 messages/month</li>
                        <li>5 WhatsApp instances</li>
                        <li>Full API access</li>
                        <li>Priority support</li>
                        <li>Advanced analytics</li>
                        <li>Webhook support</li>
                    </ul>
                    <a href="#signup" class="btn btn-primary" style="width: 100%;">Get Started</a>
                </div>
                
                <div class="pricing-card animate-on-scroll">
                    <h3 class="pricing-title">Enterprise</h3>
                    <div class="pricing-price">$99<span>/month</span></div>
                    <ul class="pricing-features">
                        <li>Unlimited messages</li>
                        <li>Unlimited instances</li>
                        <li>Custom integrations</li>
                        <li>24/7 phone support</li>
                        <li>SLA guarantee</li>
                        <li>Dedicated account manager</li>
                    </ul>
                    <a href="#contact" class="btn btn-outline" style="width: 100%;">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="cta-content animate-on-scroll">
                <h2 class="cta-title">Ready to Get Started?</h2>
                <p class="cta-subtitle">Join thousands of developers who trust our WhatsApp API for their business communication needs.</p>
                <div class="hero-cta">
                    <a href="signup" class="btn btn-primary btn-hero">Start Free Trial</a>
                    <a href="doc" class="btn btn-outline btn-hero">Read Documentation</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Product</h3>
                    <ul>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="/doc" id="docs">Documentation</a></li>
                        <li><a href="/doc">API Reference</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li><a href="#careers">Careers</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#help" id="support">Help Center</a></li>
                        <li><a href="#status">Status Page</a></li>
                        <li><a href="#community">Community</a></li>
                        <li><a href="#contact">Contact Support</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="#privacy">Privacy Policy</a></li>
                        <li><a href="#terms">Terms of Service</a></li>
                        <li><a href="#security">Security</a></li>
                        <li><a href="#compliance">Compliance</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 WhatsApp API. All rights reserved. Made with ❤️ for developers.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(255, 255, 255, 0.98)';
                header.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.boxShadow = 'none';
            }
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Add some interactive elements
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Typing effect for hero title
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';
            
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            
            type();
        }

        // Initialize typing effect after page load
        window.addEventListener('load', () => {
            const heroTitle = document.querySelector('.hero-title');
            const originalText = heroTitle.textContent;
            typeWriter(heroTitle, originalText, 50);
        });
    </script>
</body>
</html>