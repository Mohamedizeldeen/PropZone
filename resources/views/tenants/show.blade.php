@extends('layouts.app')

@section('title', 'Tenant Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $tenant->first_name }} {{ $tenant->last_name }}</h1>
                <p class="text-gray-600 mt-2">Tenant Details & Information</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('tenants.edit', $tenant) }}" 
                   class="bg-[#00685f] hover:bg-[#01bbab] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Edit Tenant
                </a>
                <a href="{{ route('tenants.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Back to Tenants
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Personal Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Personal Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900">{{ $tenant->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p class="text-gray-900">{{ $tenant->phone }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Date of Birth</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($tenant->date_of_birth)->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">National ID</label>
                            <p class="text-gray-900">{{ $tenant->national_id }}</p>
                        </div>
                        @if($tenant->occupation)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Occupation</label>
                            <p class="text-gray-900">{{ $tenant->occupation }}</p>
                        </div>
                        @endif
                        @if($tenant->employer)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Employer</label>
                            <p class="text-gray-900">{{ $tenant->employer }}</p>
                        </div>
                        @endif
                        @if($tenant->monthly_income)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Monthly Income</label>
                            <p class="text-gray-900">${{ number_format($tenant->monthly_income, 2) }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Emergency Contact -->
                @if($tenant->emergency_contact_name || $tenant->emergency_contact_phone)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Emergency Contact
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($tenant->emergency_contact_name)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Contact Name</label>
                            <p class="text-gray-900">{{ $tenant->emergency_contact_name }}</p>
                        </div>
                        @endif
                        @if($tenant->emergency_contact_phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Contact Phone</label>
                            <p class="text-gray-900">{{ $tenant->emergency_contact_phone }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Contracts -->
                @if($tenant->contracts && $tenant->contracts->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Contracts
                    </h3>
                    <div class="space-y-4">
                        @foreach($tenant->contracts as $contract)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $contract->property->title ?? 'N/A' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $contract->property->address ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($contract->start_date)->format('M d, Y') }} - 
                                        {{ \Carbon\Carbon::parse($contract->end_date)->format('M d, Y') }}
                                    </p>
                                    <p class="text-sm font-medium text-gray-900">${{ number_format($contract->monthly_rent, 2) }}/month</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($contract->status === 'active') bg-green-100 text-green-800
                                    @elseif($contract->status === 'draft') bg-gray-100 text-gray-800
                                    @elseif($contract->status === 'expired') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($contract->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Notes -->
                @if($tenant->notes)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Notes
                    </h3>
                    <p class="text-gray-700">{{ $tenant->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Current Status</label>
                            <span class="px-3 py-1 text-sm font-medium rounded-full
                                @if($tenant->status === 'active') bg-green-100 text-green-800
                                @elseif($tenant->status === 'inactive') bg-gray-100 text-gray-800
                                @elseif($tenant->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($tenant->status) }}
                            </span>
                        </div>
                        @if($tenant->move_in_date)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Move-in Date</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($tenant->move_in_date)->format('M d, Y') }}</p>
                        </div>
                        @endif
                        @if($tenant->move_out_date)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Move-out Date</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($tenant->move_out_date)->format('M d, Y') }}</p>
                        </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Joined</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($tenant->created_at)->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('contracts.create') }}?tenant_id={{ $tenant->id }}" 
                           class="w-full bg-[#00685f] hover:bg-[#01bbab] text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center block">
                            Create Contract
                        </a>
                        <a href="{{ route('payments.create') }}?tenant_id={{ $tenant->id }}" 
                           class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center block">
                            Record Payment
                        </a>
                        <a href="{{ route('maintenance-requests.create') }}?tenant_id={{ $tenant->id }}" 
                           class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center block">
                            Maintenance Request
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
