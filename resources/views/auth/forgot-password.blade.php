<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - PropZone</title>
    @vite('resources/css/app.css')
    <style>
        .hover-scale {
            transition: all 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .gradient-text {
            background: linear-gradient(135deg, #00685f, #01bbab);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-[#00685f]/10 to-[#01bbab]/10 rounded-full blur-3xl floating-animation"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-[#01bbab]/10 to-[#00685f]/10 rounded-full blur-3xl floating-animation" style="animation-delay: -3s;"></div>
    </div>

    <div class="relative min-h-screen flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <img src="{{ asset('build/assets/img/PropZoneRealEstateLogo.png') }}" alt="PropZone" class="h-12 w-auto mx-auto mb-4">
                <h1 class="text-2xl font-bold gradient-text">PropZone</h1>
            </div>

            <!-- Forgot Password Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 hover-scale">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Forgot Password?</h2>
                    <p class="text-gray-600">No worries! Enter your email and we'll send you reset instructions.</p>
                </div>

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out" 
                                placeholder="Enter your email address"
                                value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-[#00685f] to-[#01bbab] hover:from-[#01bbab] hover:to-[#00685f] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#01bbab] transition duration-150 ease-in-out hover-scale">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                            Send Reset Link
                        </button>
                    </div>
                </form>

                <!-- Back to Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Remember your password? 
                        <a href="{{ route('login') }}" class="font-medium text-[#01bbab] hover:text-[#00685f] transition duration-150 ease-in-out">
                            Back to login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
