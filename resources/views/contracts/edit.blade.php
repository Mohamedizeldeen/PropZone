@extends('layouts.app')

@section('title', 'Edit Contract')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Contract</h1>
                <p class="text-gray-600 mt-2">Update contract information</p>
            </div>
            <a href="{{ route('contracts.show', $contract) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                Back to Contract
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('contracts.update', $contract) }}" class="bg-white rounded-lg shadow-md">
            @csrf
            @method('PUT')
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Property and Tenant Selection -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Property & Tenant Information</h3>
                    </div>
                    
                    <div>
                        <label for="property_id" class="block text-sm font-medium text-gray-700 mb-2">Property *</label>
                        <select name="property_id" id="property_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent" required>
                            <option value="">Select Property</option>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}" {{ old('property_id', $contract->property_id) == $property->id ? 'selected' : '' }}>
                                    {{ $property->title }} - {{ $property->address }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tenant_id" class="block text-sm font-medium text-gray-700 mb-2">Tenant *</label>
                        <select name="tenant_id" id="tenant_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent" required>
                            <option value="">Select Tenant</option>
                            @foreach($tenants as $tenant)
                                <option value="{{ $tenant->id }}" {{ old('tenant_id', $contract->tenant_id) == $tenant->id ? 'selected' : '' }}>
                                    {{ $tenant->first_name }} {{ $tenant->last_name }} ({{ $tenant->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Contract Duration -->
                    <div class="md:col-span-2 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Contract Duration</h3>
                    </div>

                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                        <input type="date" name="start_date" id="start_date" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                               value="{{ old('start_date', $contract->lease_start_date?->format('Y-m-d')) }}" required>
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date *</label>
                        <input type="date" name="end_date" id="end_date" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                               value="{{ old('end_date', $contract->lease_end_date?->format('Y-m-d')) }}" required>
                    </div>

                    <!-- Financial Terms -->
                    <div class="md:col-span-2 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Financial Terms</h3>
                    </div>

                    <div>
                        <label for="monthly_rent" class="block text-sm font-medium text-gray-700 mb-2">Monthly Rent *</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                            <input type="number" name="monthly_rent" id="monthly_rent" step="0.01" min="0"
                                   class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                   value="{{ old('monthly_rent', $contract->monthly_rent) }}" required>
                        </div>
                    </div>

                    <div>
                        <label for="security_deposit" class="block text-sm font-medium text-gray-700 mb-2">Security Deposit</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                            <input type="number" name="security_deposit" id="security_deposit" step="0.01" min="0"
                                   class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                   value="{{ old('security_deposit', $contract->security_deposit) }}">
                        </div>
                    </div>

                    <!-- Contract Status -->
                    <div class="md:col-span-2 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Contract Status</h3>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent" required>
                            <option value="">Select Status</option>
                            <option value="draft" {{ old('status', $contract->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ old('status', $contract->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="terminated" {{ old('status', $contract->status) === 'terminated' ? 'selected' : '' }}>Terminated</option>
                            <option value="expired" {{ old('status', $contract->status) === 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>

                    <!-- Contract Terms -->
                    <div class="md:col-span-2 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Contract Terms & Conditions</h3>
                    </div>

                    <div class="md:col-span-2">
                        <label for="terms" class="block text-sm font-medium text-gray-700 mb-2">Terms & Conditions</label>
                        <textarea name="terms" id="terms" rows="6" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                  placeholder="Enter the general terms and conditions of the rental agreement...">{{ old('terms', $contract->terms_conditions) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="special_conditions" class="block text-sm font-medium text-gray-700 mb-2">Special Conditions</label>
                        <textarea name="special_conditions" id="special_conditions" rows="4" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                  placeholder="Any special conditions or additional clauses...">{{ old('special_conditions', '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-4">
                <a href="{{ route('contracts.show', $contract) }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-[#00685f] hover:bg-[#01bbab] text-white rounded-lg font-medium transition-colors duration-200">
                    Update Contract
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
