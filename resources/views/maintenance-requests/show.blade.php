@extends('layouts.app')

@section('title', 'Maintenance Request Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $maintenanceRequest->title }}</h1>
                <p class="text-gray-600 mt-2">{{ $maintenanceRequest->property->title ?? 'N/A' }} - {{ ucfirst($maintenanceRequest->category) }}</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('maintenance-requests.edit', $maintenanceRequest) }}" 
                   class="bg-[#00685f] hover:bg-[#01bbab] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Edit Request
                </a>
                <a href="{{ route('maintenance-requests.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Back to Requests
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
                <!-- Request Details -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Request Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Property</label>
                            <p class="text-gray-900 font-medium">{{ $maintenanceRequest->property->title ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">{{ $maintenanceRequest->property->address ?? 'N/A' }}</p>
                        </div>
                        @if($maintenanceRequest->tenant)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tenant</label>
                            <p class="text-gray-900 font-medium">{{ $maintenanceRequest->tenant->first_name }} {{ $maintenanceRequest->tenant->last_name }}</p>
                            <p class="text-sm text-gray-600">{{ $maintenanceRequest->tenant->email }}</p>
                        </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Category</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($maintenanceRequest->category === 'plumbing') bg-blue-100 text-blue-800
                                @elseif($maintenanceRequest->category === 'electrical') bg-yellow-100 text-yellow-800
                                @elseif($maintenanceRequest->category === 'hvac') bg-green-100 text-green-800
                                @elseif($maintenanceRequest->category === 'structural') bg-red-100 text-red-800
                                @elseif($maintenanceRequest->category === 'appliance') bg-purple-100 text-purple-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($maintenanceRequest->category) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Priority</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($maintenanceRequest->priority === 'urgent') bg-red-100 text-red-800
                                @elseif($maintenanceRequest->priority === 'high') bg-orange-100 text-orange-800
                                @elseif($maintenanceRequest->priority === 'medium') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800
                                @endif">
                                {{ ucfirst($maintenanceRequest->priority) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Created Date</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($maintenanceRequest->created_at)->format('M d, Y') }}</p>
                        </div>
                        @if($maintenanceRequest->requested_completion_date)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Requested Completion</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($maintenanceRequest->requested_completion_date)->format('M d, Y') }}</p>
                        </div>
                        @endif
                        @if($maintenanceRequest->completed_date)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Completed Date</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($maintenanceRequest->completed_date)->format('M d, Y') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        Description
                    </h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $maintenanceRequest->description }}</p>
                </div>

                <!-- Cost Information -->
                @if($maintenanceRequest->estimated_cost || $maintenanceRequest->actual_cost)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        Cost Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($maintenanceRequest->estimated_cost)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Estimated Cost</label>
                            <p class="text-2xl font-bold text-blue-600">${{ number_format($maintenanceRequest->estimated_cost, 2) }}</p>
                        </div>
                        @endif
                        @if($maintenanceRequest->actual_cost)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Actual Cost</label>
                            <p class="text-2xl font-bold text-[#00685f]">${{ number_format($maintenanceRequest->actual_cost, 2) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Notes -->
                @if($maintenanceRequest->notes)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Notes
                    </h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $maintenanceRequest->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Request Status</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Current Status</label>
                            <span class="px-3 py-1 text-sm font-medium rounded-full
                                @if($maintenanceRequest->status === 'completed') bg-green-100 text-green-800
                                @elseif($maintenanceRequest->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($maintenanceRequest->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $maintenanceRequest->status)) }}
                            </span>
                        </div>
                        @if($maintenanceRequest->requested_completion_date)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Time to Completion</label>
                            @php
                                $requestedDate = \Carbon\Carbon::parse($maintenanceRequest->requested_completion_date);
                                $now = \Carbon\Carbon::now();
                                $isOverdue = $requestedDate->isPast() && $maintenanceRequest->status !== 'completed';
                                $timeInfo = $isOverdue ? 'Overdue' : $now->diffForHumans($requestedDate, true) . ' remaining';
                            @endphp
                            <p class="text-gray-900 {{ $isOverdue ? 'text-red-600 font-medium' : '' }}">{{ $timeInfo }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Progress Timeline -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Progress Timeline</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Request Created</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($maintenanceRequest->created_at)->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>
                        
                        @if($maintenanceRequest->status === 'in_progress' || $maintenanceRequest->status === 'completed')
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Work Started</p>
                                <p class="text-xs text-gray-500">In Progress</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($maintenanceRequest->status === 'completed' && $maintenanceRequest->completed_date)
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Work Completed</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($maintenanceRequest->completed_date)->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        @if($maintenanceRequest->status !== 'completed')
                        <form method="POST" action="{{ route('maintenance-requests.update', $maintenanceRequest) }}" class="inline w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="completed">
                            <input type="hidden" name="completed_date" value="{{ now()->format('Y-m-d') }}">
                            <button type="submit" 
                                    class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200"
                                    onclick="return confirm('Mark this request as completed?')">
                                Mark as Completed
                            </button>
                        </form>
                        @endif
                        
                        <button onclick="window.print()" 
                                class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            Print Request
                        </button>
                        
                        <form method="POST" action="{{ route('maintenance-requests.destroy', $maintenanceRequest) }}" 
                              class="inline w-full" onsubmit="return confirm('Are you sure you want to delete this request?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                Delete Request
                            </button>
                        </form>
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
