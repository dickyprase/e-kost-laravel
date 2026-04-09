<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-Kos') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { font-family: 'Inter', sans-serif; }

            .auth-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                position: relative;
                overflow: hidden;
            }

            .auth-bg::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
                animation: float 15s ease-in-out infinite;
            }

            .auth-bg::after {
                content: '';
                position: absolute;
                bottom: -30%;
                right: -30%;
                width: 150%;
                height: 150%;
                background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 50%);
                animation: float 20s ease-in-out infinite reverse;
            }

            @keyframes float {
                0%, 100% { transform: translate(0, 0) rotate(0deg); }
                33% { transform: translate(30px, -30px) rotate(5deg); }
                66% { transform: translate(-20px, 20px) rotate(-3deg); }
            }

            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.6s ease-out forwards;
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }

            .form-input-modern {
                transition: all 0.3s ease;
                border: 2px solid #e5e7eb;
            }

            .form-input-modern:focus {
                border-color: #6366f1;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
                outline: none;
            }

            .btn-gradient {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                transition: all 0.3s ease;
            }

            .btn-gradient:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex">
            <!-- Left Panel - Decorative -->
            <div class="hidden lg:flex lg:w-1/2 auth-bg items-center justify-center p-12 relative">
                <div class="text-center relative z-10 animate-fade-in-up">
                    <div class="mb-8">
                        <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h1 class="text-4xl font-bold text-white mb-4">{{ config('app.name', 'E-Kos') }}</h1>
                        <p class="text-white/80 text-lg max-w-md mx-auto leading-relaxed">Temukan hunian nyaman dan aman sesuai kebutuhanmu dengan mudah.</p>
                    </div>
                    <div class="flex items-center justify-center gap-6 mt-12">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">100+</div>
                            <div class="text-white/60 text-sm">Kamar</div>
                        </div>
                        <div class="w-px h-12 bg-white/20"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">24/7</div>
                            <div class="text-white/60 text-sm">Keamanan</div>
                        </div>
                        <div class="w-px h-12 bg-white/20"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">4.9★</div>
                            <div class="text-white/60 text-sm">Rating</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-gray-50">
                <div class="w-full max-w-md animate-fade-in-up" style="animation-delay: 0.2s;">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden text-center mb-8">
                        <a href="/" class="text-3xl font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                            {{ config('app.name', 'E-Kos') }}
                        </a>
                    </div>

                    <div class="glass-card rounded-2xl shadow-xl p-8 sm:p-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
