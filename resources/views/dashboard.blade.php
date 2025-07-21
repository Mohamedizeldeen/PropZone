<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PropZone</title>
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
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="{{ asset('build/assets/img/PropZoneRealEstateLogo.png') }}" alt="PropZone" class="h-8 w-auto">
                    
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('dashboard') }}" class="text-[#01bbab] px-3 py-2 text-sm font-medium">Dashboard</a>
                        
                        <!-- Properties Dropdown -->
                        <div class="relative group">
                            <button class="text-gray-700 hover:text-[#01bbab] px-3 py-2 text-sm font-medium transition flex items-center">
                                Properties
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <a href="{{ route('properties.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">All Properties</a>
                                <a href="{{ route('properties.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">Add Property</a>
                            </div>
                        </div>

                        <!-- Tenants & Contracts -->
                        <div class="relative group">
                            <button class="text-gray-700 hover:text-[#01bbab] px-3 py-2 text-sm font-medium transition flex items-center">
                                Tenants
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <a href="{{ route('tenants.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">All Tenants</a>
                                <a href="{{ route('tenants.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">Add Tenant</a>
                                <div class="border-t border-gray-100"></div>
                                <a href="{{ route('contracts.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">Contracts</a>
                                <a href="{{ route('contracts.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">Create Contract</a>
                            </div>
                        </div>

                        <!-- Financial Management -->
                        <div class="relative group">
                            <button class="text-gray-700 hover:text-[#01bbab] px-3 py-2 text-sm font-medium transition flex items-center">
                                Finance
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <a href="{{ route('payments.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">Payments</a>
                                <a href="{{ route('payments.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">Payment Reports</a>
                                <div class="border-t border-gray-100"></div>
                                <a href="{{ route('payments.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">Invoices</a>
                                <a href="{{ route('payments.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#01bbab]">Subscription</a>
                            </div>
                        </div>

                        <!-- Maintenance -->
                        <a href="{{ route('maintenance-requests.index') }}" class="text-gray-700 hover:text-[#01bbab] px-3 py-2 text-sm font-medium transition">Maintenance</a>
                        
                        <a href="{{ route('properties.create') }}" class="bg-gradient-to-r from-[#00685f] to-[#01bbab] text-white px-4 py-2 text-sm font-medium rounded-lg hover:from-[#01bbab] hover:to-[#00685f] transition">Quick Add</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Welcome, {{ $user->first_name ?? $user->name }}!</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-gradient-to-r from-[#00685f] to-[#01bbab] text-white px-4 py-2 rounded-lg hover:from-[#01bbab] hover:to-[#00685f] transition duration-150">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Welcome Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Properties -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-scale">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-r from-[#00685f] to-[#01bbab] text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $stats['total_properties'] }}</h3>
                        <p class="text-sm text-gray-600">Total Properties</p>
                    </div>
                </div>
            </div>

            <!-- Active Tenants -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-scale">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-r from-[#00685f] to-[#01bbab] text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $stats['active_tenants'] }}</h3>
                        <p class="text-sm text-gray-600">Active Tenants</p>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-scale">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-r from-[#00685f] to-[#01bbab] text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">${{ number_format($stats['monthly_revenue'], 2) }}</h3>
                        <p class="text-sm text-gray-600">Monthly Revenue</p>
                    </div>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-scale">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">${{ number_format($stats['pending_payments'], 2) }}</h3>
                        <p class="text-sm text-gray-600">Pending Payments</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Active Contracts -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-scale">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $stats['active_contracts'] }}</h3>
                        <p class="text-sm text-gray-600">Active Contracts</p>
                    </div>
                </div>
            </div>

            <!-- Maintenance Requests -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-scale">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-r from-orange-500 to-red-500 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $stats['pending_maintenance'] }}</h3>
                        <p class="text-sm text-gray-600">Pending Maintenance</p>
                    </div>
                </div>
            </div>

            <!-- Occupancy Rate -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-scale">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $stats['occupancy_rate'] }}%</h3>
                        <p class="text-sm text-gray-600">Occupancy Rate</p>
                    </div>
                </div>
            </div>

            <!-- Account Status -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover-scale">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $stats['subscription_plan'] }}</h3>
                        <p class="text-sm text-gray-600">Current Plan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Recent Properties -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Recent Properties</h2>
                    <a href="{{ route('properties.index') }}" class="text-[#01bbab] hover:text-[#00685f] text-sm font-medium">View All</a>
                </div>
                <div class="space-y-4">
                    @foreach($recent_properties as $property)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">{{ $property['name'] }}</h3>
                            <p class="text-xs text-gray-600">{{ $property['location'] ?? 'N/A' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">${{ number_format($property['price'] ?? 0) }}</p>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $property['status_class'] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $property['status'] ?? 'Unknown' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Maintenance Requests -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Recent Maintenance</h2>
                    <span class="text-[#01bbab] text-sm font-medium">{{ $stats['pending_maintenance'] }} Pending</span>
                </div>
                <div class="space-y-4">
                    @if(isset($recent_maintenance) && count($recent_maintenance) > 0)
                        @foreach($recent_maintenance as $maintenance)
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">{{ $maintenance['title'] }}</h3>
                                <p class="text-xs text-gray-600">{{ $maintenance['property_name'] ?? 'Property' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $maintenance['priority_class'] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $maintenance['priority'] ?? 'Medium' }}
                                </span>
                                <p class="text-xs text-gray-600 mt-1">{{ $maintenance['days_open'] ?? '0' }} days</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p>No maintenance requests</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Payment Overview & Quick Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Payments -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Recent Payments</h2>
                    <span class="text-yellow-600 text-sm font-medium">${{ number_format($stats['pending_payments'], 2) }} Pending</span>
                </div>
                <div class="space-y-4">
                    @if(isset($recent_payments) && count($recent_payments) > 0)
                        @foreach($recent_payments as $payment)
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">{{ $payment['tenant_name'] ?? 'Tenant' }}</h3>
                                <p class="text-xs text-gray-600">{{ $payment['type'] ?? 'Rent' }} - {{ $payment['due_date'] ?? 'N/A' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-900">${{ number_format($payment['amount'] ?? 0, 2) }}</p>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $payment['status_class'] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $payment['status'] ?? 'Pending' }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            <p>No recent payments</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Active Tenants -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Active Tenants</h2>
                    <span class="text-[#01bbab] text-sm font-medium">{{ $stats['active_tenants'] }} Total</span>
                </div>
                <div class="space-y-4">
                    @if(isset($recent_tenants) && count($recent_tenants) > 0)
                        @foreach($recent_tenants as $tenant)
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">{{ $tenant['name'] ?? 'Tenant' }}</h3>
                                <p class="text-xs text-gray-600">{{ $tenant['property_name'] ?? 'Property' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-900">${{ number_format($tenant['monthly_rent'] ?? 0) }}/mo</p>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $tenant['status_class'] ?? 'bg-green-100 text-green-800' }}">
                                    {{ $tenant['status'] ?? 'Active' }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p>No active tenants</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
