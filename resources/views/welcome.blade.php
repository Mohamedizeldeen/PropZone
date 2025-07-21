<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PropZone - Manage Properties Smarter</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
        
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
                .glass-effect { backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.1); }
                .hover-scale { transition: transform 0.3s ease; }
                .hover-scale:hover { transform: scale(1.05); }
                .fade-in { animation: fadeIn 0.8s ease-in; }
                @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
                .slide-in-right { animation: slideInRight 0.5s ease-out; }
                @keyframes slideInRight { from { transform: translateX(100%); } to { transform: translateX(0); } }
                .nav-overlay { backdrop-filter: blur(10px); background: rgba(0, 0, 0, 0.5); }
            </style>
        @endif
    </head>
    <body class="bg-gradient-to-br from-gray-50 via-white to-blue-50 font-sans overflow-x-hidden"
        <!-- Mobile Navigation Overlay -->
        <div id="nav-overlay" class="fixed inset-0 nav-overlay z-40 hidden"></div>
        
        <!-- Side Navigation -->
        <nav id="side-nav" class="fixed top-0 right-0 h-full w-80 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
            <div class="p-6 h-full flex flex-col">
                <!-- Close Button -->
                <button id="close-nav" class="self-end mb-8 p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <!-- Navigation Menu -->
                <div class="space-y-6 flex-1">
                    <div class="border-b pb-6">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Navigation</h3>
                        <div class="space-y-3">
                            <a href="#home" class="nav-link block text-lg font-medium text-gray-800 hover:text-[#00685f] transition-colors py-2">Home</a>
                            <a href="#about" class="nav-link block text-lg font-medium text-gray-800 hover:text-[#00685f] transition-colors py-2">About Us</a>
                            <a href="#features" class="nav-link block text-lg font-medium text-gray-800 hover:text-[#00685f] transition-colors py-2">Features</a>
                            <a href="#services" class="nav-link block text-lg font-medium text-gray-800 hover:text-[#00685f] transition-colors py-2">Services</a>
                            <a href="#pricing" class="nav-link block text-lg font-medium text-gray-800 hover:text-[#00685f] transition-colors py-2">Pricing</a>
                            <a href="#testimonials" class="nav-link block text-lg font-medium text-gray-800 hover:text-[#00685f] transition-colors py-2">Testimonials</a>
                            <a href="#contact" class="nav-link block text-lg font-medium text-gray-800 hover:text-[#00685f] transition-colors py-2">Contact</a>
                            <a href={{route('login')}} class="nav-link block text-lg font-medium text-gray-800 hover:text-[#00685f] transition-colors py-2">Login</a>
                             <a href={{route('register')}} class="nav-link block text-lg font-medium text-gray-800 hover:text-[#00685f] transition-colors py-2">Sign up</a>
                        </div>
                    </div>
                    
                    
                    
                   
                </div>
                
              
            </div>
        </nav>

        <!-- Modern Header -->
        <header class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-md shadow-sm py-4 z-30 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('build/assets/img/PropZoneRealEstateLogo.png') }}" alt="PropZone Logo" class="w-40 h-auto object-contain">
                    
                </div>
                
                <!-- Quick Actions -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href={{route('login')}} class="text-gray-600 hover:text-[#00685f] transition-colors font-medium">Login</a>
                    <a href={{route('register')}} class="bg-gradient-to-r from-[#00685f] via-[#01bbab] to-[#01bbab] text-white px-6 py-2 rounded-lg hover:shadow-lg transition-all duration-300 font-medium">Start Free Trial</a>
                </div>
                
                <!-- Menu Button -->
                <button id="menu-btn" class="p-3 hover:bg-gray-100 rounded-xl transition-colors group">
                    <div class="space-y-2">
                        <div class="w-6 h-0.5 bg-gray-600 group-hover:bg-[#00685f] transition-colors"></div>
                        <div class="w-6 h-0.5 bg-gray-600 group-hover:bg-[#00685f] transition-colors"></div>
                        <div class="w-6 h-0.5 bg-gray-600 group-hover:bg-[#00685f] transition-colors"></div>
                    </div>
                </button>
            </div>
        </header>

        <!-- Hero Section -->
        <section id="home" class="pt-24 pb-20 min-h-screen flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="fade-in">
                        <div class="inline-flex items-center px-4 py-2 bg-[#00685f]/10 rounded-full text-[#00685f] text-sm font-medium mb-6">
                            🚀 New: AI-Powered Property Insights
                        </div>
                        <h1 class="text-5xl lg:text-7xl font-black text-gray-900 mb-6 leading-tight">
                            Manage Properties 
                            <span class="bg-gradient-to-r from-[#00685f] via-[#01bbab] to-[#01bbab] bg-clip-text text-transparent">Smarter</span>
                        </h1>
                        <p class="text-xl lg:text-2xl text-gray-600 mb-8 leading-relaxed">
                            The all-in-one platform that transforms how real estate professionals manage properties, tenants, and grow their business with intelligent automation.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 mb-8">
                            <a href="#" class="group bg-gradient-to-r from-[#00685f] via-[#01bbab] to-[#01bbab] text-white px-8 py-4 rounded-xl text-lg font-semibold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                                Start Free Trial
                                <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            <a href="#" class="group border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-xl text-lg font-semibold hover:border-[#00685f] hover:text-[#00685f] transition-all duration-300 flex items-center justify-center">
                                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Watch Demo
                            </a>
                        </div>
                        <div class="flex items-center space-x-8 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                No Credit Card Required
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                14-Day Free Trial
                            </div>
                        </div>
                    </div>
                    <div class="lg:justify-self-end">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-[#00685f] via-[#01bbab] to-[#01bbab] rounded-3xl transform rotate-6 opacity-20"></div>
                            <div class="relative bg-white rounded-3xl shadow-2xl p-6 hover-scale">
                                <!-- Dashboard Header -->
                                <div class="bg-gradient-to-r from-[#00685f] to-[#01bbab] rounded-2xl p-4 mb-4">
                                    <div class="flex items-center justify-between text-white">
                                        <div>
                                            <h3 class="text-lg font-bold">Property Dashboard</h3>
                                            <p class="text-sm opacity-90">Real-time Analytics</p>
                                        </div>
                                        <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                    </div>
                                </div>
                                
                                <!-- Key Metrics -->
                                <div class="grid grid-cols-2 gap-3 mb-4">
                                    <div class="bg-gray-50 rounded-xl p-3">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs text-gray-500">Total Revenue</p>
                                                <p class="text-lg font-bold text-gray-900">$156K</p>
                                                <p class="text-xs text-green-600">↗ +12.5%</p>
                                            </div>
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 rounded-xl p-3">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs text-gray-500">Occupancy</p>
                                                <p class="text-lg font-bold text-gray-900">94.2%</p>
                                                <p class="text-xs text-[#01bbab]">↗ +2.1%</p>
                                            </div>
                                            <div class="w-8 h-8 bg-[#01bbab]/10 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-[#01bbab]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Mini Chart -->
                                <div class="bg-gray-50 rounded-xl p-3 mb-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-xs font-medium text-gray-700">Monthly Performance</p>
                                        <p class="text-xs text-gray-500">Last 6 months</p>
                                    </div>
                                    <div class="flex items-end space-x-1 h-16">
                                        <div class="bg-[#00685f] rounded-t w-3 h-8"></div>
                                        <div class="bg-[#01bbab] rounded-t w-3 h-12"></div>
                                        <div class="bg-[#00685f] rounded-t w-3 h-10"></div>
                                        <div class="bg-[#01bbab] rounded-t w-3 h-14"></div>
                                        <div class="bg-[#00685f] rounded-t w-3 h-11"></div>
                                        <div class="bg-[#01bbab] rounded-t w-3 h-16"></div>
                                    </div>
                                </div>
                                
                                <!-- Property List -->
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between bg-white border rounded-lg p-2">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-[#00685f] rounded flex items-center justify-center">
                                                <span class="text-white text-xs font-bold">A</span>
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium">Apartment Complex A</p>
                                                <p class="text-xs text-gray-500">85% occupied</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs font-bold text-gray-900">$24K</p>
                                            <p class="text-xs text-green-600">+8%</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between bg-white border rounded-lg p-2">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-[#01bbab] rounded flex items-center justify-center">
                                                <span class="text-white text-xs font-bold">B</span>
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium">Office Building B</p>
                                                <p class="text-xs text-gray-500">92% occupied</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs font-bold text-gray-900">$18K</p>
                                            <p class="text-xs text-green-600">+12%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Section -->
                <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">10K+</div>
                        <div class="text-gray-600">Properties Managed</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">5K+</div>
                        <div class="text-gray-600">Happy Customers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">99.9%</div>
                        <div class="text-gray-600">Uptime</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">24/7</div>
                        <div class="text-gray-600">Support</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center px-4 py-2 bg-[#00685f]/10 rounded-full text-[#00685f] text-sm font-medium mb-6">
                        🛠️ Our Services
                    </div>
                    <h2 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6">Complete Property Solutions</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">From property acquisition to tenant management, we provide end-to-end solutions for your real estate business.</p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="group bg-gradient-to-br from-[#00685f]/10 to-[#01bbab]/20 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover-scale">
                        <div class="w-14 h-14 bg-[#00685f] rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Property Management</h3>
                        <p class="text-gray-600 mb-6">Complete property portfolio management with detailed analytics, maintenance tracking, and performance insights.</p>
                        <a href="#" class="text-[#00685f] font-semibold hover:text-[#01bbab] transition-colors">Learn More →</a>
                    </div>
                    
                    <div class="group bg-gradient-to-br from-[#01bbab]/10 to-[#01bbab]/20 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover-scale">
                        <div class="w-14 h-14 bg-[#01bbab] rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tenant Relations</h3>
                        <p class="text-gray-600 mb-6">Streamlined tenant onboarding, communication, and relationship management with automated workflows.</p>
                        <a href="#" class="text-[#01bbab] font-semibold hover:text-[#00685f] transition-colors">Learn More →</a>
                    </div>
                    
                    <div class="group bg-gradient-to-br from-[#00685f]/10 to-[#01bbab]/15 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover-scale">
                        <div class="w-14 h-14 bg-[#00685f] rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Financial Analytics</h3>
                        <p class="text-gray-600 mb-6">Advanced financial reporting, ROI analysis, and predictive insights to maximize your investment returns.</p>
                        <a href="#" class="text-[#00685f] font-semibold hover:text-[#01bbab] transition-colors">Learn More →</a>
                    </div>
                    
                    <div class="group bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover-scale">
                        <div class="w-14 h-14 bg-yellow-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Payment Processing</h3>
                        <p class="text-gray-600 mb-6">Automated rent collection, payment tracking, and financial management with multiple payment options.</p>
                        <a href="#" class="text-yellow-600 font-semibold hover:text-yellow-700 transition-colors">Learn More →</a>
                    </div>
                    
                    <div class="group bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover-scale">
                        <div class="w-14 h-14 bg-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Legal Compliance</h3>
                        <p class="text-gray-600 mb-6">Stay compliant with local regulations, automated legal document generation, and compliance monitoring.</p>
                        <a href="#" class="text-red-600 font-semibold hover:text-red-700 transition-colors">Learn More →</a>
                    </div>
                    
                    <div class="group bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 hover-scale">
                        <div class="w-14 h-14 bg-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">AI Insights</h3>
                        <p class="text-gray-600 mb-6">Machine learning powered market insights, pricing optimization, and predictive maintenance alerts.</p>
                        <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-700 transition-colors">Learn More →</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us -->
        <section id="about" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="inline-flex items-center px-4 py-2 bg-green-50 rounded-full text-green-600 text-sm font-medium mb-6">
                            📈 About PropZone
                        </div>
                        <h2 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6">Transform Your Real Estate Business</h2>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            PropZone is designed specifically for real estate agencies, property managers, and landlords who want to streamline their operations and scale their business. We solve the chaos of spreadsheets, missed payments, and scattered information.
                        </p>
                        <div class="space-y-6 mb-8">
                            <div class="flex items-start space-x-4">
                                <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Streamlined Operations</h3>
                                    <p class="text-gray-600">Automate routine tasks and focus on growing your business</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Data-Driven Insights</h3>
                                    <p class="text-gray-600">Make informed decisions with real-time analytics and reporting</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Scalable Platform</h3>
                                    <p class="text-gray-600">Grows with your business from 10 to 10,000 properties</p>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="inline-flex items-center bg-gradient-to-r from-[#00685f] via-[#01bbab] to-[#01bbab] text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
                            Learn More About Us
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#00685f] via-[#01bbab] to-[#01bbab] rounded-3xl transform -rotate-6 opacity-20"></div>
                        <div class="relative bg-white rounded-3xl shadow-2xl p-8">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Fast & Efficient</h3>
                                    <p class="text-sm text-gray-600">Save 20+ hours per week</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Secure & Reliable</h3>
                                    <p class="text-sm text-gray-600">Bank-level security</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Scalable Growth</h3>
                                    <p class="text-sm text-gray-600">Enterprise ready</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Customer Love</h3>
                                    <p class="text-sm text-gray-600">4.9/5 rating</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="features" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mb-6">Powerful Features for Property Management</h2>
                    <p class="text-xl text-gray-600">Everything you need to manage your real estate business efficiently</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-4">Property Management</h3>
                        <p class="text-gray-600">Organize all your properties with detailed profiles, photos, and key information in one centralized dashboard.</p>
                    </div>
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-4">Tenant Tracking</h3>
                        <p class="text-gray-600">Keep detailed tenant records, lease agreements, and communication history for better relationship management.</p>
                    </div>
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-4">Automated Rent Reminders</h3>
                        <p class="text-gray-600">Never miss a payment with automated rent reminders and payment tracking for consistent cash flow.</p>
                    </div>
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-4">Digital Contracts</h3>
                        <p class="text-gray-600">Create, manage, and store digital lease agreements with e-signature capabilities for faster processing.</p>
                    </div>
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-4">Smart Dashboards</h3>
                        <p class="text-gray-600">Get real-time insights with customizable dashboards showing key metrics and performance indicators.</p>
                    </div>
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-4">Multi-User Access</h3>
                        <p class="text-gray-600">Collaborate with your team using role-based permissions and multi-user access controls.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mb-6">How It Works</h2>
                    <p class="text-xl text-gray-600">Get started with PropZone in just 3 simple steps</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-2xl font-bold text-white">1</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-slate-800 mb-4">Sign Up & Setup</h3>
                        <p class="text-lg text-gray-600">Create your account and set up your property portfolio in minutes with our guided onboarding process.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-2xl font-bold text-white">2</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-slate-800 mb-4">Add Properties & Tenants</h3>
                        <p class="text-lg text-gray-600">Import your existing data or add properties and tenants manually using our intuitive interface.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-2xl font-bold text-white">3</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-slate-800 mb-4">Manage & Grow</h3>
                        <p class="text-lg text-gray-600">Start managing your properties efficiently and use our insights to grow your business.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section id="testimonials" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center px-4 py-2 bg-yellow-50 rounded-full text-yellow-600 text-sm font-medium mb-6">
                        ⭐ Customer Success Stories
                    </div>
                    <h2 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6">What Our Clients Say</h2>
                    <p class="text-xl text-gray-600">Trusted by thousands of real estate professionals worldwide</p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="group bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 hover-scale">
                        <div class="flex items-center mb-6">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full mr-4 flex items-center justify-center">
                                <span class="text-white font-bold text-lg">SJ</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Sarah Johnson</h4>
                                <p class="text-gray-600 text-sm">Property Manager</p>
                                <p class="text-gray-500 text-xs">Downtown Realty</p>
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                        <p class="text-gray-700 italic leading-relaxed">"PropZone has completely transformed how we manage our 200+ properties. The automated rent reminders alone save us 10 hours per week. The dashboard insights help us make better decisions. Highly recommended!"</p>
                        <div class="mt-6 text-sm text-gray-500">
                            <span class="font-medium">Manages:</span> 200+ Properties
                        </div>
                    </div>
                    
                    <div class="group bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 hover-scale">
                        <div class="flex items-center mb-6">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-full mr-4 flex items-center justify-center">
                                <span class="text-white font-bold text-lg">MC</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Michael Chen</h4>
                                <p class="text-gray-600 text-sm">Real Estate Agent</p>
                                <p class="text-gray-500 text-xs">Pacific Properties</p>
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                        <p class="text-gray-700 italic leading-relaxed">"The AI-powered insights give me real-time data about market trends and property performance. I can spot issues early and make data-driven decisions. It's been a complete game-changer for my business!"</p>
                        <div class="mt-6 text-sm text-gray-500">
                            <span class="font-medium">Increased Revenue:</span> 35%
                        </div>
                    </div>
                    
                    <div class="group bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 hover-scale">
                        <div class="flex items-center mb-6">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full mr-4 flex items-center justify-center">
                                <span class="text-white font-bold text-lg">ER</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Emily Rodriguez</h4>
                                <p class="text-gray-600 text-sm">Landlord & Investor</p>
                                <p class="text-gray-500 text-xs">Independent</p>
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                        <p class="text-gray-700 italic leading-relaxed">"As a small landlord with 15 units, PropZone helps me stay organized and professional. The digital contracts and automated payment reminders have improved my tenant relationships significantly."</p>
                        <div class="mt-6 text-sm text-gray-500">
                            <span class="font-medium">Time Saved:</span> 15 hours/week
                        </div>
                    </div>
                </div>
                
                <!-- Trust Indicators -->
                <div class="mt-16 text-center">
                    <p class="text-gray-600 mb-8">Trusted by leading real estate companies worldwide</p>
                    <div class="flex flex-wrap justify-center items-center gap-8 opacity-60">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gray-400 rounded"></div>
                            <span class="text-gray-500 font-medium">RealtyTech</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gray-400 rounded"></div>
                            <span class="text-gray-500 font-medium">PropertyMax</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gray-400 rounded"></div>
                            <span class="text-gray-500 font-medium">Elite Estates</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gray-400 rounded"></div>
                            <span class="text-gray-500 font-medium">UrbanHomes</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing -->
        <section id="pricing" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-bold text-slate-800 mb-6">Simple, Transparent Pricing</h2>
                    <p class="text-xl text-gray-600">Choose the plan that fits your business size</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Free Trial -->
                    <div class="bg-white rounded-xl p-8 border-2 border-gray-200 hover:border-blue-300 transition-colors">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Free Trial</h3>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-slate-800">$0</span>
                            <span class="text-gray-600">/14 days</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-gray-600">
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Up to 5 properties</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Basic dashboard</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Email support</li>
                        </ul>
                        <a href="#" class="block w-full bg-gray-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-gray-700 transition-colors">Start Free Trial</a>
                    </div>

                    <!-- Starter -->
                    <div class="bg-white rounded-xl p-8 border-2 border-gray-200 hover:border-blue-300 transition-colors">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Starter</h3>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-slate-800">$29</span>
                            <span class="text-gray-600">/month</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-gray-600">
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Up to 25 properties</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Rent reminders</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Basic reporting</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Priority support</li>
                        </ul>
                        <a href="#" class="block w-full bg-[#00685f] text-white text-center py-3 rounded-lg font-semibold hover:bg-[#01bbab] transition-colors">Get Started</a>
                    </div>

                    <!-- Pro -->
                    <div class="bg-white rounded-xl p-8 border-2 border-[#00685f] hover:border-[#01bbab] transition-colors relative transform scale-105">
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                            <span class="bg-[#00685f] text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Pro</h3>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-slate-800">$79</span>
                            <span class="text-gray-600">/month</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-gray-600">
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Up to 100 properties</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Digital contracts</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Advanced analytics</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Multi-user access</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Phone support</li>
                        </ul>
                        <a href="#" class="block w-full bg-[#00685f] text-white text-center py-3 rounded-lg font-semibold hover:bg-[#01bbab] transition-colors">Get Started</a>
                    </div>

                    <!-- Enterprise -->
                    <div class="bg-white rounded-xl p-8 border-2 border-gray-200 hover:border-[#01bbab] transition-colors">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Enterprise</h3>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-slate-800">$199</span>
                            <span class="text-gray-600">/month</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-gray-600">
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Unlimited properties</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Custom integrations</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>White-label options</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Dedicated support</li>
                            <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>API access</li>
                        </ul>
                        <a href="#" class="block w-full bg-green-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">Contact Sales</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modern Footer -->
        <footer id="contact" class="bg-gradient-to-br from-[#01bbab] via-[#004741] to-[#005049] text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Main Footer Content -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                    <!-- Company Info -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            <img src="{{ asset('build/assets/img/PropZoneRealEstateLogo.png') }}" alt="PropZone Logo" class="w-35 h-auto object-contain">
                            
                        </div>
                        <p class="text-gray-300 mb-8 text-lg leading-relaxed max-w-md">
                            Transform your real estate business with our comprehensive property management platform. Join thousands of satisfied customers and revolutionize how you manage properties.
                        </p>
                        <!-- Social Links -->
                        <div class="flex space-x-4">
                            <a href="#" class="w-12 h-12 bg-[#0c362f] rounded-xl flex items-center justify-center hover:bg-[#00685f] transition-colors group">
                                <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-[#0c362f] rounded-xl flex items-center justify-center hover:bg-[#01bbab] transition-colors group">
                                <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-[#0c362f] rounded-xl flex items-center justify-center hover:bg-[#00685f] transition-colors group">
                                <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.758-1.378l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-[#0c362f] rounded-xl flex items-center justify-center hover:bg-red-600 transition-colors group">
                                <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-bold mb-6 text-white">Product</h3>
                        <ul class="space-y-4">
                            <li><a href="#features" class="text-gray-300 hover:text-white transition-colors flex items-center group">
                                Features
                                <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a></li>
                            <li><a href="#pricing" class="text-gray-300 hover:text-white transition-colors flex items-center group">
                                Pricing
                                <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center group">
                                API
                                <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center group">
                                Integrations
                                <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a></li>
                        </ul>
                    </div>
                    
                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-lg font-bold mb-6 text-white">Contact</h3>
                        <ul class="space-y-4">
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                info@propzone.com
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                (968) 9808-4952
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                </svg>
                                www.propzone.com
                            </li>
                            <li class="flex items-start text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-red-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    Oman<br>
                                    Muscat - Al Khoud<br>
                                    Street 8858
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Newsletter Signup -->
                <div class="border-t border-gray-700 pt-12 mb-12">
                    <div class="max-w-xl mx-auto text-center">
                        <h3 class="text-2xl font-bold mb-4">Stay Updated</h3>
                        <p class="text-gray-300 mb-6">Get the latest updates, tips, and insights delivered to your inbox.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-xl bg-[#0c362f] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:border-[#01bbab] focus:ring-2 focus:ring-[#01bbab]/20">
                            <button class="bg-gradient-to-r from-[#00685f] via-[#01bbab] to-[#01bbab] text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Copyright -->
                <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-center md:text-left mb-4 md:mb-0">
                        &copy; 2024 PropZone. All rights reserved. Built with ❤️ for real estate professionals.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- JavaScript for Navigation -->
        <script>
            // Mobile Navigation Toggle
            const menuBtn = document.getElementById('menu-btn');
            const sideNav = document.getElementById('side-nav');
            const navOverlay = document.getElementById('nav-overlay');
            const closeNav = document.getElementById('close-nav');
            const navLinks = document.querySelectorAll('.nav-link');

            function openNav() {
                sideNav.classList.remove('translate-x-full');
                navOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeNavigation() {
                sideNav.classList.add('translate-x-full');
                navOverlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            menuBtn.addEventListener('click', openNav);
            closeNav.addEventListener('click', closeNavigation);
            navOverlay.addEventListener('click', closeNavigation);

            // Close nav when clicking on nav links
            navLinks.forEach(link => {
                link.addEventListener('click', closeNavigation);
            });

            // Smooth scrolling for anchor links
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

            // Header background change on scroll
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                if (window.scrollY > 100) {
                    header.classList.add('bg-white/95');
                    header.classList.remove('bg-white/80');
                } else {
                    header.classList.add('bg-white/80');
                    header.classList.remove('bg-white/95');
                }
            });
        </script>
    </body>
</html>