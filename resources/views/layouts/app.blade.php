<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PropZone - Property Management')</title>
    @vite('resources/css/app.css')
    <style>
        .hover-scale {
            transition: all 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
        .gradient-text {
            background: linear-gradient(135deg, #00685f, #01bbab);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('build/assets/img/PropZoneRealEstateLogo.png') }}" alt="PropZone" class="h-8 w-auto">
                        <span class="ml-3 text-xl font-bold gradient-text">PropZone</span>
                    </a>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-[#01bbab] px-3 py-2 text-sm font-medium transition">Dashboard</a>
                        <a href="{{ route('properties.index') }}" class="text-gray-700 hover:text-[#01bbab] px-3 py-2 text-sm font-medium transition">Properties</a>
                        <a href="{{ route('properties.create') }}" class="bg-gradient-to-r from-[#00685f] to-[#01bbab] text-white px-4 py-2 text-sm font-medium rounded-lg hover:from-[#01bbab] hover:to-[#00685f] transition">Add Property</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Welcome, {{ Auth::user()->first_name ?? Auth::user()->name }}!</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-600 px-3 py-2 text-sm font-medium transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-600">&copy; {{ date('Y') }} PropZone. All rights reserved.</p>
                <p class="text-sm text-gray-500 mt-2">Property management made simple.</p>
            </div>
        </div>
    </footer>
</body>
</html>
