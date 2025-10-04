<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Academic Management System')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
    <link rel="shortcut icon" href="{{ asset('logo.ico') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cyber-blue': '#00D4FF',
                        'cyber-purple': '#8B5FBF',
                        'cyber-pink': '#FF006E',
                        'cyber-green': '#00F5A0',
                        'dark-bg': '#0A0A0A',
                        'card-bg': '#1A1A1A',
                        'border-cyber': 'rgba(0, 212, 255, 0.3)',
                    },
                    fontFamily: {
                        'cyber': ['Orbitron', 'monospace'],
                        'inter': ['Inter', 'system-ui', 'sans-serif'],
                        'poppins': ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-cyber': 'pulse-cyber 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        glow: {
                            '0%': { boxShadow: '0 0 5px #00D4FF, 0 0 10px #00D4FF, 0 0 15px #00D4FF' },
                            '100%': { boxShadow: '0 0 10px #00D4FF, 0 0 20px #00D4FF, 0 0 30px #00D4FF' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        'pulse-cyber': {
                            '0%, 100%': { opacity: 1, transform: 'scale(1)' },
                            '50%': { opacity: 0.8, transform: 'scale(1.05)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom Styles -->
    <style>
        body {
            background: 
                radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(16, 185, 129, 0.10) 0%, transparent 50%),
                linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #475569 75%, #1e293b 100%);
            background-attachment: fixed;
            font-family: 'Inter', system-ui, sans-serif;
            line-height: 1.6;
            letter-spacing: 0.025em;
            color: #f1f5f9;
            min-height: 100vh;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(600px circle at 0% 0%, rgba(59, 130, 246, 0.05) 0%, transparent 50%),
                radial-gradient(800px circle at 100% 100%, rgba(139, 92, 246, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }
        
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(2px 2px at 20px 30px, rgba(255, 255, 255, 0.05), transparent),
                radial-gradient(2px 2px at 40px 70px, rgba(255, 255, 255, 0.03), transparent),
                radial-gradient(1px 1px at 90px 40px, rgba(59, 130, 246, 0.1), transparent),
                radial-gradient(1px 1px at 130px 80px, rgba(139, 92, 246, 0.08), transparent);
            background-repeat: repeat;
            background-size: 200px 200px;
            pointer-events: none;
            z-index: -1;
            animation: float 20s ease-in-out infinite;
        }
        
        .cyber-border {
            border: 1px solid rgba(0, 212, 255, 0.3);
            box-shadow: 
                inset 0 0 20px rgba(0, 212, 255, 0.05),
                0 0 20px rgba(0, 212, 255, 0.1);
        }
        
        .cyber-glow:hover {
            box-shadow: 
                0 10px 30px rgba(0, 212, 255, 0.4),
                0 0 40px rgba(59, 130, 246, 0.2);
            transform: translateY(-3px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .futuristic-grid {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
            background-size: 100px 100px;
            animation: grid-move 30s linear infinite;
        }
        
        @keyframes grid-move {
            0% { transform: translate(0, 0); }
            100% { transform: translate(100px, 100px); }
        }
        
        .holographic-effect {
            background: 
                linear-gradient(45deg, transparent 30%, rgba(59, 130, 246, 0.05) 50%, transparent 70%),
                linear-gradient(-45deg, transparent 30%, rgba(139, 92, 246, 0.05) 50%, transparent 70%);
            background-size: 20px 20px;
            animation: holographic 4s ease-in-out infinite;
        }
        
        @keyframes holographic {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.7; }
        }
        
        .elegant-card {
            background: 
                linear-gradient(135deg, rgba(51, 65, 85, 0.95) 0%, rgba(30, 41, 59, 0.9) 100%);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(71, 85, 105, 0.6);
            border-radius: 24px;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .elegant-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg, 
                transparent, 
                rgba(59, 130, 246, 0.1), 
                transparent
            );
            transition: left 0.6s ease;
        }
        
        .elegant-card:hover::before {
            left: 100%;
        }
        
        .elegant-card:hover {
            background: 
                linear-gradient(135deg, rgba(51, 65, 85, 1) 0%, rgba(30, 41, 59, 0.95) 100%);
            border-color: rgba(59, 130, 246, 0.7);
            transform: translateY(-6px);
            box-shadow: 
                0 16px 50px rgba(0, 0, 0, 0.5),
                0 0 30px rgba(59, 130, 246, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }
        
        .neon-text {
            text-shadow: 0 0 10px currentColor;
        }
        
        .glass-effect {
            background: 
                linear-gradient(135deg, 
                    rgba(15, 23, 42, 0.8) 0%, 
                    rgba(30, 41, 59, 0.9) 50%, 
                    rgba(51, 65, 85, 0.8) 100%
                );
            backdrop-filter: blur(30px) saturate(180%);
            border: 1px solid rgba(71, 85, 105, 0.4);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 20px rgba(59, 130, 246, 0.05);
            position: relative;
        }
        
        .glass-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(
                90deg, 
                transparent, 
                rgba(59, 130, 246, 0.5), 
                transparent
            );
        }
        
        .btn-cyber {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-weight: 500;
            padding: 12px 24px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-cyber:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.25);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1E40AF 0%, #1D4ED8 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(59, 130, 246, 0.35);
        }
        
        .input-cyber {
            background: rgba(30, 41, 59, 0.9);
            border: 1px solid rgba(71, 85, 105, 0.5);
            color: #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 15px;
            font-weight: 400;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .input-cyber:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
            background: rgba(30, 41, 59, 1);
            outline: none;
        }
        
        .input-cyber::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }
        
        .table-cyber {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(71, 85, 105, 0.5);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.3);
        }
        
        .table-cyber th {
            background: linear-gradient(135deg, rgba(51, 65, 85, 0.9), rgba(71, 85, 105, 0.9));
            border-bottom: 1px solid rgba(71, 85, 105, 0.5);
            padding: 18px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #cbd5e1;
        }
        
        .table-cyber td {
            padding: 18px;
            border-bottom: 1px solid rgba(71, 85, 105, 0.3);
            color: #e2e8f0;
        }
        
        .table-cyber tr:hover {
            background: rgba(59, 130, 246, 0.1);
            transition: all 0.2s ease;
        }
        
        .card-cyber {
            background: rgba(30, 41, 59, 0.95);
            border: 1px solid rgba(71, 85, 105, 0.5);
            backdrop-filter: blur(25px);
            border-radius: 20px;
            box-shadow: 0 8px 35px rgba(0, 0, 0, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-cyber:hover {
            background: rgba(30, 41, 59, 1);
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-6px);
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.5);
        }
        
        .stats-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.95) 0%, rgba(51, 65, 85, 0.9) 100%);
            border: 1px solid rgba(71, 85, 105, 0.5);
            border-radius: 24px;
            padding: 28px;
            backdrop-filter: blur(20px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        
        .stats-card:hover {
            background: linear-gradient(135deg, rgba(30, 41, 59, 1) 0%, rgba(51, 65, 85, 0.95) 100%);
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }
        
        /* Modern Typography */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', system-ui, sans-serif;
            font-weight: 600;
            line-height: 1.3;
        }
        
        .text-elegant {
            font-family: 'Inter', system-ui, sans-serif;
            font-weight: 400;
            line-height: 1.6;
        }
        
        .heading-elegant {
            font-family: 'Poppins', system-ui, sans-serif;
            font-weight: 600;
            letter-spacing: -0.025em;
        }
        
        /* Modern Navigation */
        .nav-link {
            font-weight: 500;
            font-size: 15px;
            padding: 10px 16px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background: rgba(59, 130, 246, 0.25);
            transform: translateY(-1px);
            color: #ffffff !important;
        }
        
        /* Improved Spacing */
        .section-padding {
            padding: 32px 0;
        }
        
        .card-padding {
            padding: 24px;
        }
        
        /* Dark Theme Text Colors */
        .text-primary {
            color: #f8fafc !important;
        }
        
        .text-secondary {
            color: #e2e8f0 !important;
        }
        
        .text-muted {
            color: #cbd5e1 !important;
        }
        
        .text-dark {
            color: #f1f5f9 !important;
        }
        
        /* Premium Shadow Effects */
        .premium-shadow {
            box-shadow: 
                0 10px 40px rgba(0, 0, 0, 0.3), 
                0 2px 8px rgba(0, 0, 0, 0.2),
                0 0 20px rgba(59, 130, 246, 0.05);
        }
        
        .premium-shadow-hover:hover {
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.4), 
                0 4px 16px rgba(0, 0, 0, 0.3),
                0 0 30px rgba(59, 130, 246, 0.1);
        }
        
        /* Futuristic Animations */
        
        /* Particle System */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }
        
        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            animation: float-particle 15s linear infinite;
        }
        
        @keyframes float-particle {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(100px);
                opacity: 0;
            }
        }
        
        /* Cyberpunk Elements */
        .cyber-text {
            text-shadow: 
                0 0 5px rgba(59, 130, 246, 0.5),
                0 0 10px rgba(59, 130, 246, 0.3),
                0 0 15px rgba(59, 130, 246, 0.2);
        }
        
        .neon-border {
            box-shadow: 
                inset 0 0 20px rgba(59, 130, 246, 0.1),
                0 0 20px rgba(59, 130, 246, 0.1),
                0 0 40px rgba(59, 130, 246, 0.05);
        }
        
        /* Enhanced Pagination Styles */
        .cyber-pagination-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 8px 12px;
            margin: 0 2px;
            background: rgba(30, 41, 59, 0.8);
            color: #e2e8f0 !important;
            border: 1px solid rgba(71, 85, 105, 0.6);
            border-radius: 10px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            font-family: 'Inter', system-ui, sans-serif;
        }
        
        .cyber-pagination-link:hover {
            background: rgba(59, 130, 246, 0.2);
            color: #ffffff !important;
            border-color: rgba(59, 130, 246, 0.8);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.25);
        }
        
        .cyber-pagination-active {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 8px 12px;
            margin: 0 2px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.9), rgba(99, 102, 241, 0.9));
            color: #ffffff !important;
            border: 1px solid rgba(59, 130, 246, 1);
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            font-family: 'Inter', system-ui, sans-serif;
        }
        
        .cyber-pagination-disabled {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 8px 12px;
            margin: 0 2px;
            background: rgba(15, 23, 42, 0.5);
            color: #64748b !important;
            border: 1px solid rgba(51, 65, 85, 0.5);
            border-radius: 10px;
            font-weight: 500;
            cursor: not-allowed;
            opacity: 0.5;
            font-family: 'Inter', system-ui, sans-serif;
        }
    </style>
</head>
<body class="min-h-screen text-gray-800 font-inter">
    <!-- Futuristic Background Elements -->
    <div class="particles" id="particles"></div>
    <div class="futuristic-grid fixed inset-0 opacity-20 pointer-events-none"></div>
    
    <!-- Navigation -->
    <nav class="glass-effect border-b border-cyber-blue/30 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-lg flex items-center justify-center animate-pulse-cyber">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-poppins font-bold text-white">
                        Academic System
                    </h1>
                </div>
                
                <div class="flex space-x-2">
                    <a href="{{ route('dashboard') }}" class="nav-link flex items-center space-x-2 {{ request()->routeIs('dashboard') ? 'text-blue-400 bg-blue-500/20' : 'text-slate-200' }}">
                        <i class="fas fa-tachometer-alt text-sm"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('dosen.index') }}" class="nav-link flex items-center space-x-2 {{ request()->routeIs('dosen.*') ? 'text-emerald-400 bg-emerald-500/20' : 'text-slate-200' }}">
                        <i class="fas fa-users text-sm"></i>
                        <span class="font-medium">Kelola Dosen</span>
                    </a>
                    <a href="{{ route('mata_kuliah.index') }}" class="nav-link flex items-center space-x-2 {{ request()->routeIs('mata_kuliah.*') ? 'text-rose-400 bg-rose-500/20' : 'text-slate-200' }}">
                        <i class="fas fa-book-open text-sm"></i>
                        <span class="font-medium">Kelola Mata Kuliah</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        @if(session('success'))
            <div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-emerald-500/20 to-emerald-600/20 border border-emerald-400/30 backdrop-blur-lg animate-float premium-shadow">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center mr-4">
                        <i class="fas fa-check text-white text-sm"></i>
                    </div>
                    <span class="text-emerald-200 font-semibold text-elegant">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-red-500/20 to-red-600/20 border border-red-400/30 backdrop-blur-lg animate-float premium-shadow">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-red-500 flex items-center justify-center mr-4">
                        <i class="fas fa-exclamation-triangle text-white text-sm"></i>
                    </div>
                    <span class="text-red-200 font-semibold text-elegant">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-16 border-t border-slate-600/30 glass-effect">
        <div class="container mx-auto px-6 py-8">
            <div class="text-center">
                <p class="text-slate-300">
                    &copy; {{ date('Y') }} Academic Management System by <a href="https://github.com/bnrpmbd" target="_blank">Banar Pambudi.</a>
                    <span class="text-blue-400 font-medium">Powered by Laravel & Modern Technology</span>
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Add smooth scrolling and interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Create particle system
            function createParticles() {
                const particlesContainer = document.getElementById('particles');
                const numberOfParticles = 50;

                for (let i = 0; i < numberOfParticles; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    
                    // Random positioning and delay
                    particle.style.left = Math.random() * 100 + 'vw';
                    particle.style.animationDelay = Math.random() * 15 + 's';
                    particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                    
                    // Random opacity and size
                    particle.style.opacity = Math.random() * 0.5 + 0.2;
                    const size = Math.random() * 3 + 1;
                    particle.style.width = size + 'px';
                    particle.style.height = size + 'px';
                    
                    particlesContainer.appendChild(particle);
                }
            }

            // Initialize particles
            createParticles();

            // Smooth fade-in animation for cards
            const cards = document.querySelectorAll('.card-cyber, .elegant-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });

            // Enhanced cyber glow effect for buttons
            const buttons = document.querySelectorAll('.btn-cyber, .btn-primary');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 0 30px rgba(59, 130, 246, 0.8), 0 0 60px rgba(59, 130, 246, 0.4)';
                    this.style.transform = 'translateY(-3px) scale(1.05)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.boxShadow = '0 8px 30px rgba(59, 130, 246, 0.35)';
                    this.style.transform = 'translateY(-2px) scale(1)';
                });
            });

            // Add holographic effect to navigation
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.background = 'linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1))';
                    this.style.boxShadow = '0 0 15px rgba(59, 130, 246, 0.3)';
                });
                link.addEventListener('mouseleave', function() {
                    this.style.background = 'rgba(59, 130, 246, 0.15)';
                    this.style.boxShadow = 'none';
                });
            });

            // Parallax effect for background elements
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.futuristic-grid');
                if (parallax) {
                    parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
                }
            });

            // Enhanced scroll effects
            window.addEventListener('scroll', function() {
                const scrollPercent = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);
                const particles = document.getElementById('particles');
                if (particles) {
                    particles.style.opacity = 0.3 + (scrollPercent * 0.3);
                }
            });
        });

        // Matrix rain effect (optional enhancement)
        function createMatrixRain() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            canvas.style.position = 'fixed';
            canvas.style.top = '0';
            canvas.style.left = '0';
            canvas.style.width = '100%';
            canvas.style.height = '100%';
            canvas.style.zIndex = '-1';
            canvas.style.pointerEvents = 'none';
            canvas.style.opacity = '0.05';
            document.body.appendChild(canvas);

            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*()';
            const charSize = 14;
            const columns = canvas.width / charSize;
            const drops = [];

            for (let i = 0; i < columns; i++) {
                drops[i] = 1;
            }

            function draw() {
                ctx.fillStyle = 'rgba(15, 23, 42, 0.05)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.fillStyle = 'rgba(59, 130, 246, 0.8)';
                ctx.font = charSize + 'px monospace';

                for (let i = 0; i < drops.length; i++) {
                    const text = chars[Math.floor(Math.random() * chars.length)];
                    ctx.fillText(text, i * charSize, drops[i] * charSize);

                    if (drops[i] * charSize > canvas.height && Math.random() > 0.975) {
                        drops[i] = 0;
                    }
                    drops[i]++;
                }
            }

            // Uncomment to enable matrix rain effect
            // setInterval(draw, 50);
        }

        // Initialize matrix rain (commented out by default)
        // createMatrixRain();
    </script>
</body>
</html>