@extends('layouts.app')

@section('title', 'Contract Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Contract Details</h1>
                <p class="text-gray-600 mt-2">{{ $contract->property->title ?? 'N/A' }} - {{ $contract->tenant->first_name ?? 'N/A' }} {{ $contract->tenant->last_name ?? '' }}</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('contracts.edit', $contract) }}" 
                   class="bg-[#00685f] hover:bg-[#01bbab] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Edit Contract
                </a>
                <a href="{{ route('contracts.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Back to Contracts
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Contract Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Contract Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Property</label>
                            <p class="text-gray-900 font-medium">{{ $contract->property->title ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">{{ $contract->property->address ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tenant</label>
                            <p class="text-gray-900 font-medium">{{ $contract->tenant->first_name ?? 'N/A' }} {{ $contract->tenant->last_name ?? '' }}</p>
                            <p class="text-sm text-gray-600">{{ $contract->tenant->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Start Date</label>
                            <p class="text-gray-900">{{ $contract->lease_start_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">End Date</label>
                            <p class="text-gray-900">{{ $contract->lease_end_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Duration</label>
                            <p class="text-gray-900">
                                {{ $contract->lease_start_date->diffInMonths($contract->lease_end_date) }} months
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Created</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($contract->created_at)->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Financial Terms -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        Financial Terms
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Monthly Rent</label>
                            <p class="text-2xl font-bold text-[#00685f]">${{ number_format($contract->monthly_rent, 2) }}</p>
                        </div>
                        @if($contract->security_deposit)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Security Deposit</label>
                            <p class="text-xl font-semibold text-gray-900">${{ number_format($contract->security_deposit, 2) }}</p>
                        </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Total Contract Value</label>
                            <p class="text-xl font-semibold text-gray-900">
                                ${{ number_format($contract->monthly_rent * $contract->lease_start_date->diffInMonths($contract->lease_end_date), 2) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                @if($contract->terms_conditions)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Terms & Conditions
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $contract->terms_conditions }}</p>
                    </div>
                </div>
                @endif

                <!-- Special Conditions -->
                @if($contract->special_conditions)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Special Conditions
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $contract->special_conditions }}</p>
                    </div>
                </div>
                @endif

                <!-- Payment History -->
                @if($contract->payments && $contract->payments->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Payment History
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Method</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($contract->payments->take(5) as $payment)
                                <tr>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ $payment->paid_date ? \Carbon\Carbon::parse($payment->paid_date)->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                        ${{ number_format($payment->amount, 2) }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($payment->status === 'paid') bg-green-100 text-green-800
                                            @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ ucfirst($payment->payment_method ?? 'N/A') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Contract Status</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Current Status</label>
                            <span class="px-3 py-1 text-sm font-medium rounded-full
                                @if($contract->status === 'active') bg-green-100 text-green-800
                                @elseif($contract->status === 'draft') bg-gray-100 text-gray-800
                                @elseif($contract->status === 'expired') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($contract->status) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Time Remaining</label>
                            @php
                                $endDate = $contract->lease_end_date;
                                $now = \Carbon\Carbon::now();
                                $isExpired = $endDate->isPast();
                                $timeRemaining = $isExpired ? 'Expired' : $now->diffForHumans($endDate, true) . ' remaining';
                            @endphp
                            <p class="text-gray-900 {{ $isExpired ? 'text-red-600' : '' }}">{{ $timeRemaining }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('payments.create') }}?contract_id={{ $contract->id }}" 
                           class="w-full bg-[#00685f] hover:bg-[#01bbab] text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center block">
                            Record Payment
                        </a>
                        <a href="{{ route('maintenance-requests.create') }}?property_id={{ $contract->property->id }}&tenant_id={{ $contract->tenant->id }}" 
                           class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center block">
                            Maintenance Request
                        </a>
                        <button onclick="window.print()" 
                                class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            Print Contract
                        </button>
                    </div>
                </div>

                <!-- Contract Summary -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Monthly Rent:</span>
                            <span class="text-sm font-medium text-gray-900">${{ number_format($contract->monthly_rent, 2) }}</span>
                        </div>
                        @if($contract->security_deposit)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Security Deposit:</span>
                            <span class="text-sm font-medium text-gray-900">${{ number_format($contract->security_deposit, 2) }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between border-t pt-3">
                            <span class="text-sm font-medium text-gray-600">Total Payments:</span>
                            <span class="text-sm font-medium text-gray-900">
                                ${{ number_format($contract->payments->where('status', 'paid')->sum('amount'), 2) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print { display: none !important; }
}
</style>
@endsection
