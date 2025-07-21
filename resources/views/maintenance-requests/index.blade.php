@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Maintenance Requests</h1>
                    <p class="mt-2 text-gray-600">Track and manage property maintenance requests</p>
                </div>
                <a href="{{ route('maintenance-requests.create') }}" 
                   class="bg-[#00685f] hover:bg-[#01bbab] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    New Request
                </a>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <a href="{{ route('maintenance-requests.index') }}" 
                       class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm
                              {{ request()->get('status') == null ? 'border-[#00685f] text-[#00685f]' : '' }}">
                        All Requests
                    </a>
                    <a href="{{ route('maintenance-requests.index', ['status' => 'pending']) }}" 
                       class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm
                              {{ request()->get('status') == 'pending' ? 'border-[#00685f] text-[#00685f]' : '' }}">
                        Pending
                    </a>
                    <a href="{{ route('maintenance-requests.index', ['status' => 'in_progress']) }}" 
                       class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm
                              {{ request()->get('status') == 'in_progress' ? 'border-[#00685f] text-[#00685f]' : '' }}">
                        In Progress
                    </a>
                    <a href="{{ route('maintenance-requests.index', ['status' => 'completed']) }}" 
                       class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm
                              {{ request()->get('status') == 'completed' ? 'border-[#00685f] text-[#00685f]' : '' }}">
                        Completed
                    </a>
                </nav>
            </div>
        </div>

        <!-- Maintenance Requests Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($maintenanceRequests as $request)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <!-- Priority & Status -->
                    <div class="p-4 pb-0">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex space-x-2">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $request->priority === 'high' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $request->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $request->priority === 'low' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ ucfirst($request->priority) }} Priority
                                </span>
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $request->status === 'pending' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $request->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $request->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $request->status === 'cancelled' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ str_replace('_', ' ', ucfirst($request->status)) }}
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('maintenance-requests.show', $request) }}" 
                                   class="text-[#00685f] hover:text-[#01bbab] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('maintenance-requests.edit', $request) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Request Info -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            {{ $request->title }}
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ $request->description }}
                        </p>
                        
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>{{ $request->property->title }}</span>
                            </div>
                            
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ $request->tenant->first_name }} {{ $request->tenant->last_name }}</span>
                            </div>
                            
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($request->created_at)->format('M j, Y') }}</span>
                            </div>

                            @if($request->estimated_cost)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="font-medium">${{ number_format($request->estimated_cost, 0) }} estimated</span>
                            </div>
                            @endif
                        </div>

                        <!-- Category -->
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Category</span>
                                <span class="font-medium text-gray-900 capitalize">
                                    {{ str_replace('_', ' ', $request->category) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No maintenance requests</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new maintenance request.</p>
                        <div class="mt-6">
                            <a href="{{ route('maintenance-requests.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#00685f] hover:bg-[#01bbab]">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                New Request
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($maintenanceRequests->hasPages())
            <div class="mt-8">
                {{ $maintenanceRequests->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
