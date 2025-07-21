@extends('layouts.app')

@section('title', 'Add Property - PropZone')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Add New Property</h1>
        <p class="mt-2 text-gray-600">Fill in the details below to add a new property to your portfolio</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Property Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Property Name</label>
                <input type="text" name="name" id="name" required 
                    class="block w-full px-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out" 
                    placeholder="e.g., Sunset Apartment Complex"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Property Type and Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Property Type</label>
                    <select name="type" id="type" required 
                        class="block w-full px-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white focus:outline-none focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out">
                        <option value="">Select Type</option>
                        <option value="apartment" {{ old('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="house" {{ old('type') == 'house' ? 'selected' : '' }}>House</option>
                        <option value="office" {{ old('type') == 'office' ? 'selected' : '' }}>Office</option>
                        <option value="retail" {{ old('type') == 'retail' ? 'selected' : '' }}>Retail Space</option>
                        <option value="warehouse" {{ old('type') == 'warehouse' ? 'selected' : '' }}>Warehouse</option>
                        <option value="land" {{ old('type') == 'land' ? 'selected' : '' }}>Land</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" required 
                        class="block w-full px-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white focus:outline-none focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out">
                        <option value="">Select Status</option>
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="rented" {{ old('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <input type="text" name="location" id="location" required 
                    class="block w-full px-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out" 
                    placeholder="e.g., Downtown, New York, NY"
                    value="{{ old('location') }}">
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price and Area -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                    <input type="number" name="price" id="price" step="0.01" min="0"
                        class="block w-full px-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out" 
                        placeholder="0.00"
                        value="{{ old('price') }}">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700 mb-2">Area (sqft)</label>
                    <input type="number" name="area" id="area" step="0.01" min="0"
                        class="block w-full px-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out" 
                        placeholder="0"
                        value="{{ old('area') }}">
                    @error('area')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Bedrooms and Bathrooms -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-2">Bedrooms</label>
                    <input type="number" name="bedrooms" id="bedrooms" min="0" max="20"
                        class="block w-full px-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out" 
                        placeholder="0"
                        value="{{ old('bedrooms') }}">
                    @error('bedrooms')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-2">Bathrooms</label>
                    <input type="number" name="bathrooms" id="bathrooms" min="0" max="20"
                        class="block w-full px-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out" 
                        placeholder="0"
                        value="{{ old('bathrooms') }}">
                    @error('bathrooms')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="block w-full px-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#01bbab] focus:border-[#01bbab] transition duration-150 ease-in-out" 
                    placeholder="Describe the property features, amenities, and other details...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Property Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Property Image</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-[#01bbab] transition">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-[#01bbab] hover:text-[#00685f] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#01bbab]">
                                <span>Upload a file</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('properties.index') }}" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#00685f] to-[#01bbab] text-white rounded-xl font-medium hover:from-[#01bbab] hover:to-[#00685f] transition hover-scale">
                    Add Property
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
