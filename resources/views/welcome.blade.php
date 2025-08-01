<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp API - Connect, Send, Scale</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .fade-in-up { animation: fadeInUp 0.8s ease forwards; }
        .floating { animation: float 6s ease-in-out infinite; }
        .animate-on-scroll { opacity: 0; transform: translateY(30px); transition: all 0.8s ease; }
        .animate-on-scroll.animated { opacity: 1; transform: translateY(0); }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="text-gray-800">
    <!-- Header -->
    <header class="fixed top-0 w-full bg-white/95 backdrop-blur-lg border-b border-white/20 z-50 transition-all duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold bg-gradient-to-r from-green-500 to-green-700 bg-clip-text text-transparent z-50">
                📱 WhatsApp API
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <ul class="flex space-x-8">
                    <li><a href="#features" class="text-gray-600 hover:text-green-500 font-medium transition-colors duration-300 relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bottom-[-5px] after:left-0 after:bg-gradient-to-r after:from-green-500 after:to-green-700 after:transition-all after:duration-300 hover:after:w-full">Features</a></li>
                    <li><a href="#pricing" class="text-gray-600 hover:text-green-500 font-medium transition-colors duration-300 relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bottom-[-5px] after:left-0 after:bg-gradient-to-r after:from-green-500 after:to-green-700 after:transition-all after:duration-300 hover:after:w-full">Pricing</a></li>
                    <li><a href="{{ route('doc') }}" target="_blank" class="text-gray-600 hover:text-green-500 font-medium transition-colors duration-300 relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bottom-[-5px] after:left-0 after:bg-gradient-to-r after:from-green-500 after:to-green-700 after:transition-all after:duration-300 hover:after:w-full">Documentation</a></li>
                    <li><a href="#support" class="text-gray-600 hover:text-green-500 font-medium transition-colors duration-300 relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bottom-[-5px] after:left-0 after:bg-gradient-to-r after:from-green-500 after:to-green-700 after:transition-all after:duration-300 hover:after:w-full">Support</a></li>
                </ul>
                <div class="flex space-x-4 ml-8">
                    <a href="{{ route('login') }}" class="px-6 py-2 rounded-full border-2 border-green-500 text-green-500 font-semibold hover:bg-green-500 hover:text-white transition-all duration-300 hover:translate-y-[-2px] hover:shadow-lg hover:shadow-green-500/30">Login</a>
                    <a href="{{ route('signup') }}" class="px-6 py-2 rounded-full bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold hover:translate-y-[-2px] transition-all duration-300 hover:shadow-lg hover:shadow-green-500/40">Sign Up</a>
                </div>
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn" class="md:hidden text-2xl z-50 focus:outline-none">
                ☰
            </button>
            
            <!-- Mobile Navigation -->
            <div id="mobileMenu" class="fixed inset-0 bg-white/95 backdrop-blur-lg z-40 flex flex-col items-center justify-center translate-x-full transition-transform duration-300">
                <ul class="flex flex-col items-center space-y-8">
                    <li><a href="#features" class="text-2xl text-gray-600 hover:text-green-500 font-medium transition-colors duration-300">Features</a></li>
                    <li><a href="#pricing" class="text-2xl text-gray-600 hover:text-green-500 font-medium transition-colors duration-300">Pricing</a></li>
                    <li><a href="{{ route('doc') }}" target="_blank" class="text-2xl text-gray-600 hover:text-green-500 font-medium transition-colors duration-300">Documentation</a></li>
                    <li><a href="#support" class="text-2xl text-gray-600 hover:text-green-500 font-medium transition-colors duration-300">Support</a></li>
                </ul>
                <div class="flex flex-col space-y-4 mt-8 w-3/4 max-w-xs">
                    <a href="{{ route('login') }}" class="px-6 py-3 rounded-full border-2 border-green-500 text-green-500 font-semibold hover:bg-green-500 hover:text-white transition-all duration-300 text-center">Login</a>
                    <a href="{{ route('signup') }}" class="px-6 py-3 rounded-full bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold hover:translate-y-[-2px] transition-all duration-300 text-center">Sign Up</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center relative overflow-hidden pt-20">
        <div class="absolute inset-0 opacity-50" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1000 1000\"><defs><radialGradient id=\"a\"><stop offset=\"0%\" stop-color=\"%23ffffff\" stop-opacity=\"0.1\"/><stop offset=\"100%\" stop-color=\"%23ffffff\" stop-opacity=\"0\"/></radialGradient></defs><circle cx=\"200\" cy=\"200\" r=\"100\" fill=\"url(%23a)\"/><circle cx=\"800\" cy=\"300\" r=\"150\" fill=\"url(%23a)\"/><circle cx=\"400\" cy=\"700\" r=\"120\" fill=\"url(%23a)\"/></svg>'); background-size: cover;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid md:grid-cols-2 gap-16 items-center relative z-10">
            <div class="text-white text-center md:text-left">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-6 leading-tight fade-in-up">Connect Your Business to WhatsApp</h1>
                <p class="text-xl sm:text-2xl mb-8 opacity-90 font-normal fade-in-up">Send messages, share files, and automate conversations with our powerful WhatsApp API. Scale your communication effortlessly.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start mb-12 fade-in-up">
                    <a href="signup" class="px-8 py-4 rounded-full bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold text-lg hover:translate-y-[-2px] transition-all duration-300 hover:shadow-lg hover:shadow-green-500/40">Get Started Free</a>
                    <a href="doc" class="px-8 py-4 rounded-full border-2 border-white text-white font-semibold text-lg hover:bg-white hover:text-green-600 transition-all duration-300">View Documentation</a>
                </div>
                <div class="flex flex-wrap justify-center md:justify-start gap-8 fade-in-up">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-400">99.9%</div>
                        <div class="text-sm opacity-80">Uptime</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-400">10M+</div>
                        <div class="text-sm opacity-80">Messages Sent</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-400">5000+</div>
                        <div class="text-sm opacity-80">Developers</div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20 shadow-2xl floating max-w-md w-full">
                    <div class="bg-black/30 text-white p-4 rounded-t-lg font-mono text-sm">
                        POST /api/whatsapp/send-message
                    </div>
                    <div class="bg-black/50 text-green-400 p-6 rounded-b-lg font-mono text-sm">
                        {<br>
                        &nbsp;&nbsp;"instanceKey": "your-key-123",<br>
                        &nbsp;&nbsp;"number": "1234567890",<br>
                        &nbsp;&nbsp;"message": "Hello World! 🚀"<br>
                        }<br><br>
                        <span class="text-green-500">✓ Message sent successfully</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50" id="features">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-4 animate-on-scroll">Powerful Features</h2>
            <p class="text-xl text-gray-600 text-center max-w-2xl mx-auto mb-16 animate-on-scroll">Everything you need to integrate WhatsApp into your applications</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-2xl shadow-xl transition-all duration-300 hover:translate-y-[-10px] hover:shadow-2xl border border-transparent hover:border-green-500 animate-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-700 rounded-xl flex items-center justify-center text-2xl text-white mb-6">🚀</div>
                    <h3 class="text-xl font-semibold mb-4">Easy Integration</h3>
                    <p class="text-gray-600">Simple REST API with comprehensive documentation. Get up and running in minutes, not hours.</p>
                </div>
                
                <div class="bg-white p-10 rounded-2xl shadow-xl transition-all duration-300 hover:translate-y-[-10px] hover:shadow-2xl border border-transparent hover:border-green-500 animate-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-700 rounded-xl flex items-center justify-center text-2xl text-white mb-6">💬</div>
                    <h3 class="text-xl font-semibold mb-4">Send Messages</h3>
                    <p class="text-gray-600">Send text messages, images, documents, and files to any WhatsApp number worldwide.</p>
                </div>
                
                <div class="bg-white p-10 rounded-2xl shadow-xl transition-all duration-300 hover:translate-y-[-10px] hover:shadow-2xl border border-transparent hover:border-green-500 animate-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-700 rounded-xl flex items-center justify-center text-2xl text-white mb-6">📱</div>
                    <h3 class="text-xl font-semibold mb-4">QR Code Authentication</h3>
                    <p class="text-gray-600">Secure WhatsApp Web integration with QR code scanning for session management.</p>
                </div>
                
                <div class="bg-white p-10 rounded-2xl shadow-xl transition-all duration-300 hover:translate-y-[-10px] hover:shadow-2xl border border-transparent hover:border-green-500 animate-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-700 rounded-xl flex items-center justify-center text-2xl text-white mb-6">⚡</div>
                    <h3 class="text-xl font-semibold mb-4">High Performance</h3>
                    <p class="text-gray-600">Built for scale with 99.9% uptime and lightning-fast message delivery.</p>
                </div>
                
                <div class="bg-white p-10 rounded-2xl shadow-xl transition-all duration-300 hover:translate-y-[-10px] hover:shadow-2xl border border-transparent hover:border-green-500 animate-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-700 rounded-xl flex items-center justify-center text-2xl text-white mb-6">🔒</div>
                    <h3 class="text-xl font-semibold mb-4">Secure & Reliable</h3>
                    <p class="text-gray-600">Enterprise-grade security with encrypted connections and reliable message delivery.</p>
                </div>
                
                <div class="bg-white p-10 rounded-2xl shadow-xl transition-all duration-300 hover:translate-y-[-10px] hover:shadow-2xl border border-transparent hover:border-green-500 animate-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-700 rounded-xl flex items-center justify-center text-2xl text-white mb-6">📊</div>
                    <h3 class="text-xl font-semibold mb-4">Analytics Dashboard</h3>
                    <p class="text-gray-600">Track message delivery, monitor usage, and analyze performance with detailed insights.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-20 bg-gradient-to-br from-indigo-500 to-purple-600 text-white" id="pricing">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-4 animate-on-scroll">Simple, Transparent Pricing</h2>
            <p class="text-xl text-white/80 text-center max-w-2xl mx-auto mb-16 animate-on-scroll">Choose the plan that fits your needs. No hidden fees, cancel anytime.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20 transition-all duration-300 hover:translate-y-[-10px] hover:shadow-2xl animate-on-scroll">
                    <h3 class="text-2xl font-semibold mb-2">Starter</h3>
                    <div class="text-5xl font-bold mb-4">$9<span class="text-xl opacity-70">/month</span></div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>1,000 messages/month</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>1 WhatsApp instance</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Basic API access</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Email support</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Standard rate limiting</li>
                    </ul>
                    <a href="#signup" class="block w-full px-6 py-3 rounded-full border-2 border-white text-white font-semibold hover:bg-white hover:text-green-600 transition-all duration-300 text-center">Get Started</a>
                </div>
                
                <div class="bg-white/20 backdrop-blur-lg rounded-2xl p-8 border border-green-500 transition-all duration-300 hover:translate-y-[-10px] hover:shadow-2xl relative animate-on-scroll">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</div>
                    <h3 class="text-2xl font-semibold mb-2">Professional</h3>
                    <div class="text-5xl font-bold mb-4">$29<span class="text-xl opacity-70">/month</span></div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>10,000 messages/month</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>5 WhatsApp instances</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Full API access</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Priority support</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Advanced analytics</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Webhook support</li>
                    </ul>
                    <a href="#signup" class="block w-full px-6 py-3 rounded-full bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold hover:translate-y-[-2px] transition-all duration-300 text-center">Get Started</a>
                </div>
                
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20 transition-all duration-300 hover:translate-y-[-10px] hover:shadow-2xl animate-on-scroll">
                    <h3 class="text-2xl font-semibold mb-2">Enterprise</h3>
                    <div class="text-5xl font-bold mb-4">$99<span class="text-xl opacity-70">/month</span></div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Unlimited messages</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Unlimited instances</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Custom integrations</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>24/7 phone support</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>SLA guarantee</li>
                        <li class="flex items-center"><span class="text-green-500 mr-2">✓</span>Dedicated account manager</li>
                    </ul>
                    <a href="#contact" class="block w-full px-6 py-3 rounded-full border-2 border-white text-white font-semibold hover:bg-white hover:text-green-600 transition-all duration-300 text-center">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-2xl mx-auto animate-on-scroll">
                <h2 class="text-4xl font-bold mb-6">Ready to Get Started?</h2>
                <p class="text-xl text-gray-600 mb-10">Join thousands of developers who trust our WhatsApp API for their business communication needs.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="signup" class="px-8 py-4 rounded-full bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold text-lg hover:translate-y-[-2px] transition-all duration-300 hover:shadow-lg hover:shadow-green-500/40">Start Free Trial</a>
                    <a href="doc" class="px-8 py-4 rounded-full border-2 border-gray-300 text-gray-700 font-semibold text-lg hover:bg-gray-100 transition-all duration-300">Read Documentation</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Product</h3>
                    <ul class="space-y-2">
                        <li><a href="#features" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Features</a></li>
                        <li><a href="#pricing" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Pricing</a></li>
                        <li><a href="{{ route('doc') }}" target="_blank" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Documentation</a></li>
                        <li><a href="{{ route('doc') }}" target="_blank" class="text-gray-400 hover:text-green-500 transition-colors duration-300">API Reference</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#about" class="text-gray-400 hover:text-green-500 transition-colors duration-300">About Us</a></li>
                        <li><a href="#blog" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Blog</a></li>
                        <li><a href="#careers" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Careers</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#help" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Help Center</a></li>
                        <li><a href="#status" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Status Page</a></li>
                        <li><a href="#community" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Community</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Contact Support</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#privacy" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Privacy Policy</a></li>
                        <li><a href="#terms" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Terms of Service</a></li>
                        <li><a href="#security" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Security</a></li>
                        <li><a href="#compliance" class="text-gray-400 hover:text-green-500 transition-colors duration-300">Compliance</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500">
                <p>&copy; 2025 WhatsApp API. All rights reserved. Made with ❤️ for developers.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('translate-x-full');
            mobileMenuBtn.innerHTML = mobileMenu.classList.contains('translate-x-full') ? '☰' : '✕';
            document.body.style.overflow = mobileMenu.classList.contains('translate-x-full') ? '' : 'hidden';
        });

        // Close menu when clicking a link
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('translate-x-full');
                mobileMenuBtn.innerHTML = '☰';
                document.body.style.overflow = '';
            });
        });

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
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.classList.add('shadow-lg');
                header.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                header.classList.remove('shadow-lg');
                header.style.background = 'rgba(255, 255, 255, 0.95)';
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