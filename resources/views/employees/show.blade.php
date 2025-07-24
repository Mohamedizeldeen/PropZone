@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Employee Details</h1>
                <p class="text-gray-600 mt-2">{{ $employee->full_name }}</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('employees.edit', $employee) }}" 
                   class="bg-[#00685f] hover:bg-[#01bbab] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Edit Employee
                </a>
                <a href="{{ route('employees.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    Back to Employees
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Employee Information -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Employee Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Full Name</label>
                            <p class="text-gray-900 font-medium">{{ $employee->full_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900">{{ $employee->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p class="text-gray-900">{{ $employee->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Role</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $employee->role_badge }}">
                                {{ ucfirst($employee->role) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $employee->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $employee->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Company</label>
                            <p class="text-gray-900">{{ $employee->company }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Join Date</label>
                            <p class="text-gray-900">{{ $employee->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('employees.edit', $employee) }}" 
                           class="w-full bg-[#00685f] hover:bg-[#01bbab] text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center block">
                            Edit Employee
                        </a>
                        <form action="{{ route('employees.toggle-status', $employee) }}" 
                              method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                {{ $employee->is_active ? 'Deactivate' : 'Activate' }} Employee
                            </button>
                        </form>
                        <form action="{{ route('employees.destroy', $employee) }}" 
                              method="POST" class="w-full"
                              onsubmit="return confirm('Are you sure you want to delete this employee? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                Delete Employee
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Employee Stats -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Employee Stats</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Account Age:</span>
                            <span class="text-sm font-medium text-gray-900">
                                {{ $employee->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Last Updated:</span>
                            <span class="text-sm font-medium text-gray-900">
                                {{ $employee->updated_at->format('M d, Y') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Status:</span>
                            <span class="text-sm font-medium {{ $employee->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $employee->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
