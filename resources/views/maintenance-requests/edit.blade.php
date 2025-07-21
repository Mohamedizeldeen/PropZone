@extends('layouts.app')

@section('title', 'Edit Maintenance Request')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Maintenance Request</h1>
                <p class="text-gray-600 mt-2">Update maintenance request details</p>
            </div>
            <a href="{{ route('maintenance-requests.show', $maintenanceRequest) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                Back to Request
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('maintenance-requests.update', $maintenanceRequest) }}" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Basic Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="property_id" class="block text-sm font-medium text-gray-700 mb-2">Property *</label>
                        <select name="property_id" id="property_id" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                            <option value="">Select Property</option>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}" {{ old('property_id', $maintenanceRequest->property_id) == $property->id ? 'selected' : '' }}>
                                    {{ $property->title }} - {{ $property->address }}
                                </option>
                            @endforeach
                        </select>
                        @error('property_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tenant_id" class="block text-sm font-medium text-gray-700 mb-2">Tenant</label>
                        <select name="tenant_id" id="tenant_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                            <option value="">Select Tenant (Optional)</option>
                            @foreach($tenants as $tenant)
                                <option value="{{ $tenant->id }}" {{ old('tenant_id', $maintenanceRequest->tenant_id) == $tenant->id ? 'selected' : '' }}>
                                    {{ $tenant->first_name }} {{ $tenant->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tenant_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category" id="category" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                            <option value="">Select Category</option>
                            <option value="plumbing" {{ old('category', $maintenanceRequest->category) === 'plumbing' ? 'selected' : '' }}>Plumbing</option>
                            <option value="electrical" {{ old('category', $maintenanceRequest->category) === 'electrical' ? 'selected' : '' }}>Electrical</option>
                            <option value="hvac" {{ old('category', $maintenanceRequest->category) === 'hvac' ? 'selected' : '' }}>HVAC</option>
                            <option value="structural" {{ old('category', $maintenanceRequest->category) === 'structural' ? 'selected' : '' }}>Structural</option>
                            <option value="appliance" {{ old('category', $maintenanceRequest->category) === 'appliance' ? 'selected' : '' }}>Appliance</option>
                            <option value="other" {{ old('category', $maintenanceRequest->category) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority *</label>
                        <select name="priority" id="priority" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                            <option value="">Select Priority</option>
                            <option value="low" {{ old('priority', $maintenanceRequest->priority) === 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority', $maintenanceRequest->priority) === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority', $maintenanceRequest->priority) === 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ old('priority', $maintenanceRequest->priority) === 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        @error('priority')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                            <option value="pending" {{ old('status', $maintenanceRequest->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status', $maintenanceRequest->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status', $maintenanceRequest->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $maintenanceRequest->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="title" id="title" required
                               value="{{ old('title', $maintenanceRequest->title) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                               placeholder="Brief description of the issue">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea name="description" id="description" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                              placeholder="Detailed description of the maintenance issue">{{ old('description', $maintenanceRequest->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Date Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Date Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="requested_completion_date" class="block text-sm font-medium text-gray-700 mb-2">Requested Completion Date</label>
                        <input type="date" name="requested_completion_date" id="requested_completion_date"
                               value="{{ old('requested_completion_date', $maintenanceRequest->requested_completion_date ? \Carbon\Carbon::parse($maintenanceRequest->requested_completion_date)->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                        @error('requested_completion_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="completed_date" class="block text-sm font-medium text-gray-700 mb-2">Completed Date</label>
                        <input type="date" name="completed_date" id="completed_date"
                               value="{{ old('completed_date', $maintenanceRequest->completed_date ? \Carbon\Carbon::parse($maintenanceRequest->completed_date)->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                        @error('completed_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Cost Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Cost Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="estimated_cost" class="block text-sm font-medium text-gray-700 mb-2">Estimated Cost</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500">$</span>
                            <input type="number" name="estimated_cost" id="estimated_cost" step="0.01" min="0"
                                   value="{{ old('estimated_cost', $maintenanceRequest->estimated_cost) }}"
                                   class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                   placeholder="0.00">
                        </div>
                        @error('estimated_cost')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="actual_cost" class="block text-sm font-medium text-gray-700 mb-2">Actual Cost</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500">$</span>
                            <input type="number" name="actual_cost" id="actual_cost" step="0.01" min="0"
                                   value="{{ old('actual_cost', $maintenanceRequest->actual_cost) }}"
                                   class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                   placeholder="0.00">
                        </div>
                        @error('actual_cost')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#00685f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Additional Notes
                </h3>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" id="notes" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                              placeholder="Additional notes about the maintenance request...">{{ old('notes', $maintenanceRequest->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('maintenance-requests.show', $maintenanceRequest) }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-[#00685f] hover:bg-[#01bbab] text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200">
                    Update Request
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-complete completion date when status is set to completed
    document.getElementById('status').addEventListener('change', function() {
        const completedDateField = document.getElementById('completed_date');
        if (this.value === 'completed' && !completedDateField.value) {
            completedDateField.value = new Date().toISOString().split('T')[0];
        }
    });
</script>
@endsection
