@extends('layouts.app')

@section('title', 'Create Maintenance Request')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Create Maintenance Request</h1>
                <p class="text-gray-600 mt-2">Submit a new maintenance request for your property</p>
            </div>
            <a href="{{ route('maintenance-requests.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                Back to Requests
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

        <form method="POST" action="{{ route('maintenance-requests.store') }}" class="bg-white rounded-lg shadow-md">
            @csrf
            
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
                                <option value="{{ $property->id }}" {{ old('property_id', request('property_id')) == $property->id ? 'selected' : '' }}>
                                    {{ $property->title }} - {{ $property->address }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tenant_id" class="block text-sm font-medium text-gray-700 mb-2">Tenant (Optional)</label>
                        <select name="tenant_id" id="tenant_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                            <option value="">Select Tenant (if applicable)</option>
                            @foreach($tenants as $tenant)
                                <option value="{{ $tenant->id }}" {{ old('tenant_id', request('tenant_id')) == $tenant->id ? 'selected' : '' }}>
                                    {{ $tenant->first_name }} {{ $tenant->last_name }} ({{ $tenant->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Request Details -->
                    <div class="md:col-span-2 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Request Details</h3>
                    </div>

                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="title" id="title" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                               value="{{ old('title') }}" 
                               placeholder="Brief description of the issue" required>
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category" id="category" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent" required>
                            <option value="">Select Category</option>
                            <option value="plumbing" {{ old('category') === 'plumbing' ? 'selected' : '' }}>Plumbing</option>
                            <option value="electrical" {{ old('category') === 'electrical' ? 'selected' : '' }}>Electrical</option>
                            <option value="hvac" {{ old('category') === 'hvac' ? 'selected' : '' }}>HVAC</option>
                            <option value="structural" {{ old('category') === 'structural' ? 'selected' : '' }}>Structural</option>
                            <option value="appliance" {{ old('category') === 'appliance' ? 'selected' : '' }}>Appliance</option>
                            <option value="other" {{ old('category') === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority *</label>
                        <select name="priority" id="priority" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent" required>
                            <option value="">Select Priority</option>
                            <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ old('priority') === 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent" required>
                            <option value="">Select Status</option>
                            <option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label for="requested_completion_date" class="block text-sm font-medium text-gray-700 mb-2">Requested Completion Date</label>
                        <input type="date" name="requested_completion_date" id="requested_completion_date" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                               value="{{ old('requested_completion_date') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea name="description" id="description" rows="5" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                  placeholder="Detailed description of the maintenance issue..." required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Cost Estimation -->
                    <div class="md:col-span-2 mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Cost Information</h3>
                    </div>

                    <div>
                        <label for="estimated_cost" class="block text-sm font-medium text-gray-700 mb-2">Estimated Cost</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                            <input type="number" name="estimated_cost" id="estimated_cost" step="0.01" min="0"
                                   class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                   value="{{ old('estimated_cost') }}"
                                   placeholder="0.00">
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Leave blank if cost is unknown</p>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-4">
                <a href="{{ route('maintenance-requests.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-[#00685f] hover:bg-[#01bbab] text-white rounded-lg font-medium transition-colors duration-200">
                    Create Request
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Set minimum date for requested completion to tomorrow
    document.addEventListener('DOMContentLoaded', function() {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const minDate = tomorrow.toISOString().split('T')[0];
        document.getElementById('requested_completion_date').setAttribute('min', minDate);
    });
</script>
@endsection
