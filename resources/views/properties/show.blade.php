@extends('layouts.app')

@section('title', $property->name . ' - PropZone')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('properties.index') }}" class="text-[#01bbab] hover:text-[#00685f] font-medium mb-2 inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Properties
                </a>
                <h1 class="text-3xl font-bold text-gray-900">{{ $property->name }}</h1>
                <div class="flex items-center mt-2 space-x-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $property->status_display['class'] }}">
                        {{ $property->status_display['text'] }}
                    </span>
                    <span class="text-gray-600">{{ $property->type_display }}</span>
                </div>
            </div>
            
            @if(Auth::id() === $property->user_id)
                <div class="flex space-x-3">
                    <a href="{{ route('properties.edit', $property) }}" class="bg-[#01bbab] text-white px-4 py-2 rounded-lg font-medium hover:bg-[#00685f] transition">
                        Edit Property
                    </a>
                    <form method="POST" action="{{ route('properties.destroy', $property) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this property?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Property Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Property Image -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                @if($property->image)
                    <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->name }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Description -->
            @if($property->description)
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Description</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $property->description }}</p>
                </div>
            @endif

            <!-- Property Features -->
            @if($property->bedrooms || $property->bathrooms || $property->area)
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Features</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if($property->bedrooms)
                            <div class="text-center">
                                <div class="w-12 h-12 bg-[#01bbab]/10 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-[#01bbab]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21v-4a2 2 0 012-2h4a2 2 0 012 2v4"></path>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">{{ $property->bedrooms }}</p>
                                <p class="text-sm text-gray-600">Bedrooms</p>
                            </div>
                        @endif

                        @if($property->bathrooms)
                            <div class="text-center">
                                <div class="w-12 h-12 bg-[#01bbab]/10 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-[#01bbab]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11M20 10v11"></path>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">{{ $property->bathrooms }}</p>
                                <p class="text-sm text-gray-600">Bathrooms</p>
                            </div>
                        @endif

                        @if($property->area)
                            <div class="text-center">
                                <div class="w-12 h-12 bg-[#01bbab]/10 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-[#01bbab]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">{{ number_format($property->area) }}</p>
                                <p class="text-sm text-gray-600">Square Feet</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Price & Details -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                @if($property->price)
                    <div class="text-center mb-6">
                        <p class="text-3xl font-bold text-[#00685f]">{{ $property->formatted_price }}</p>
                        <p class="text-gray-600">Property Value</p>
                    </div>
                @endif

                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Type:</span>
                        <span class="font-medium">{{ $property->type_display }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $property->status_display['class'] }}">
                            {{ $property->status_display['text'] }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Location:</span>
                        <span class="font-medium text-right">{{ $property->location }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Owner:</span>
                        <span class="font-medium">{{ $property->user->first_name ?? $property->user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Added:</span>
                        <span class="font-medium">{{ $property->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Contact Card -->
            <div class="bg-gradient-to-br from-[#00685f] to-[#01bbab] rounded-xl shadow-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-4">Interested in this property?</h3>
                <p class="text-sm opacity-90 mb-4">Contact the property owner for more information or to schedule a viewing.</p>
                <button class="w-full bg-white text-[#00685f] py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                    Contact Owner
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
