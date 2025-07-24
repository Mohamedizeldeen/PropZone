@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Employee</h1>
                <p class="text-gray-600 mt-2">Update {{ $employee->full_name }}'s information</p>
            </div>
            <a href="{{ route('employees.show', $employee) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                Back to Employee
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                        <input type="text" name="first_name" id="first_name" required
                               value="{{ old('first_name', $employee->first_name) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                        @error('first_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                        <input type="text" name="last_name" id="last_name" required
                               value="{{ old('last_name', $employee->last_name) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                        @error('last_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" name="email" id="email" required
                           value="{{ old('email', $employee->email) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mt-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="text" name="phone" id="phone"
                           value="{{ old('phone', $employee->phone) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                           placeholder="+1 (555) 123-4567">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mt-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $employee->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-[#00685f] focus:ring-[#00685f] border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Employee is active</span>
                    </label>
                    <p class="text-sm text-gray-500 mt-1">Unchecking this will deactivate the employee account</p>
                </div>

                <!-- Password Fields -->
                <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <h4 class="text-sm font-medium text-yellow-900 mb-3">Change Password (Optional)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" name="password" id="password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                   minlength="8">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00685f] focus:border-transparent"
                                   minlength="8">
                        </div>
                    </div>
                    <p class="text-sm text-yellow-700 mt-2">Leave empty to keep current password unchanged</p>
                </div>

                <!-- Role Information -->
                <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-blue-900">Employee Role</h4>
                            <p class="text-sm text-blue-700">This user has employee permissions and cannot create or delete other users.</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('employees.show', $employee) }}" 
                       class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-[#00685f] hover:bg-[#01bbab] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
