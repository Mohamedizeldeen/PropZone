@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Contracts</h1>
                    <p class="mt-2 text-gray-600">Manage your property contracts and lease agreements</p>
                </div>
                <a href="{{ route('contracts.create') }}" 
                   class="bg-[#00685f] hover:bg-[#01bbab] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    New Contract
                </a>
            </div>
        </div>

        <!-- Contracts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($contracts as $contract)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <!-- Status Badge -->
                    <div class="p-4 pb-0">
                        <div class="flex justify-between items-start mb-3">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                {{ $contract->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $contract->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $contract->status === 'terminated' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $contract->status === 'expired' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ ucfirst($contract->status) }}
                            </span>
                            <div class="flex space-x-2">
                                <a href="{{ route('contracts.show', $contract) }}" 
                                   class="text-[#00685f] hover:text-[#01bbab] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('contracts.edit', $contract) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Contract Info -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            {{ $contract->property->title }}
                        </h3>
                        
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ $contract->tenant->first_name }} {{ $contract->tenant->last_name }}</span>
                            </div>
                            
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="font-medium">${{ number_format($contract->monthly_rent, 0) }}/month</span>
                            </div>
                            
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $contract->lease_start_date->format('M j, Y') }} - {{ $contract->lease_end_date->format('M j, Y') }}</span>
                            </div>
                        </div>

                        <!-- Contract Duration -->
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Duration</span>
                                <span class="font-medium text-gray-900">
                                    {{ $contract->lease_start_date->diffInMonths($contract->lease_end_date) }} months
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No contracts</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new contract.</p>
                        <div class="mt-6">
                            <a href="{{ route('contracts.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#00685f] hover:bg-[#01bbab]">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                New Contract
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($contracts->hasPages())
            <div class="mt-8">
                {{ $contracts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
