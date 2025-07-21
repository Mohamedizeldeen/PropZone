@extends('layouts.app')

@section('title', 'Payment Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Payment Details</h1>
                <p class="text-gray-600 mt-2">{{ $payment->description ?? 'Payment Information' }}</p>
            </div>
            <div class="flex space-x-4">
                @if($payment->status === 'pending')
                    <a href="{{ route('payments.edit', $payment) }}" 
                       class="bg-[#00685f] hover:bg-[#01bbab] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                        Edit Payment
                    </a>
                @endif
                <a href="{{ route('payments.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Back to Payments
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
                <!-- Payment Details -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        Payment Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Amount</label>
                            <p class="text-2xl font-bold text-[#00685f]">${{ number_format($payment->amount, 2) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Payment Method</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium capitalize
                                @if($payment->payment_method === 'paypal') bg-blue-100 text-blue-800
                                @elseif($payment->payment_method === 'cash') bg-green-100 text-green-800
                                @elseif($payment->payment_method === 'bank_transfer') bg-purple-100 text-purple-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ str_replace('_', ' ', $payment->payment_method) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Payment Date</label>
                            <p class="text-gray-900">{{ $payment->paid_date ? \Carbon\Carbon::parse($payment->paid_date)->format('M d, Y') : 'Not paid' }}</p>
                        </div>
                        @if($payment->transaction_reference)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Transaction Reference</label>
                            <p class="text-gray-900 font-mono text-sm">{{ $payment->transaction_reference }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contract Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Related Contract
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Property</label>
                            <p class="text-gray-900 font-medium">{{ $payment->contract->property->title ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">{{ $payment->contract->property->address ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tenant</label>
                            <p class="text-gray-900 font-medium">{{ $payment->contract->tenant->first_name ?? 'N/A' }} {{ $payment->contract->tenant->last_name ?? '' }}</p>
                            <p class="text-sm text-gray-600">{{ $payment->contract->tenant->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Monthly Rent</label>
                            <p class="text-gray-900">${{ number_format($payment->contract->monthly_rent, 2) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Contract Status</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($payment->contract->status === 'active') bg-green-100 text-green-800
                                @elseif($payment->contract->status === 'draft') bg-yellow-100 text-yellow-800
                                @elseif($payment->contract->status === 'terminated') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($payment->contract->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('contracts.show', $payment->contract) }}" 
                           class="inline-flex items-center text-[#00685f] hover:text-[#01bbab] font-medium">
                            View Full Contract
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M16 6l4 4m0 0l-4 4m4-4H8"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Description -->
                @if($payment->description)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        Description
                    </h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $payment->description }}</p>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Status</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Current Status</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($payment->status === 'completed') bg-green-100 text-green-800
                                @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($payment->status === 'failed') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Created</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($payment->created_at)->format('M d, Y g:i A') }}</p>
                        </div>
                        @if($payment->updated_at && $payment->updated_at != $payment->created_at)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Last Updated</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($payment->updated_at)->format('M d, Y g:i A') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                @if($payment->status === 'pending')
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <form method="POST" action="{{ route('payments.update', $payment) }}" class="inline w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" 
                                    class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200"
                                    onclick="return confirm('Mark this payment as completed?')">
                                Mark as Completed
                            </button>
                        </form>
                        
                        <button onclick="window.print()" 
                                class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            Print Receipt
                        </button>
                    </div>
                </div>
                @endif

                <!-- Payment Summary -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Amount</span>
                            <span class="font-medium">${{ number_format($payment->amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Method</span>
                            <span class="font-medium capitalize">{{ str_replace('_', ' ', $payment->payment_method) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status</span>
                            <span class="font-medium">{{ ucfirst($payment->status) }}</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between text-lg font-semibold">
                            <span>Total</span>
                            <span class="text-[#00685f]">${{ number_format($payment->amount, 2) }}</span>
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
