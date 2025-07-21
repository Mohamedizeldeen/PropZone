@extends('layouts.app')

@section('title', 'Properties - PropZone')

@section('content')
<div class="px-4 sm:px-0">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Properties</h1>
            <p class="mt-2 text-gray-600">Manage all your property listings</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('properties.create') }}" class="bg-gradient-to-r from-[#00685f] to-[#01bbab] text-white px-6 py-3 rounded-lg font-medium hover:from-[#01bbab] hover:to-[#00685f] transition hover-scale inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Property
            </a>
        </div>
    </div>

    @if($properties->count() > 0)
        <!-- Properties Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($properties as $property)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale">
                    <!-- Property Image -->
                    <div class="h-48 bg-gray-200 relative">
                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $property->status_display['class'] }}">
                                {{ $property->status_display['text'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $property->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $property->location }}
                                </p>
                                <p class="text-sm text-gray-500 mb-3">{{ $property->type_display }}</p>
                                
                                @if($property->price)
                                    <p class="text-xl font-bold text-[#00685f]">{{ $property->formatted_price }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Property Features -->
                        @if($property->bedrooms || $property->bathrooms || $property->area)
                            <div class="flex items-center space-x-4 mt-4 text-sm text-gray-600">
                                @if($property->bedrooms)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21v-4a2 2 0 012-2h4a2 2 0 012 2v4"></path>
                                        </svg>
                                        {{ $property->bedrooms }} bed
                                    </span>
                                @endif
                                @if($property->bathrooms)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11M20 10v11"></path>
                                        </svg>
                                        {{ $property->bathrooms }} bath
                                    </span>
                                @endif
                                @if($property->area)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                        </svg>
                                        {{ number_format($property->area) }} sqft
                                    </span>
                                @endif
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex space-x-2 mt-6">
                            <a href="{{ route('properties.show', $property) }}" class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-center font-medium hover:bg-gray-200 transition">
                                View
                            </a>
                            @if(Auth::id() === $property->user_id)
                                <a href="{{ route('properties.edit', $property) }}" class="flex-1 bg-[#01bbab] text-white px-4 py-2 rounded-lg text-center font-medium hover:bg-[#00685f] transition">
                                    Edit
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $properties->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Properties Found</h3>
            <p class="text-gray-600 mb-6">You haven't added any properties yet. Get started by adding your first property.</p>
            <a href="{{ route('properties.create') }}" class="bg-gradient-to-r from-[#00685f] to-[#01bbab] text-white px-6 py-3 rounded-lg font-medium hover:from-[#01bbab] hover:to-[#00685f] transition hover-scale inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Your First Property
            </a>
        </div>
    @endif
</div>
@endsection
