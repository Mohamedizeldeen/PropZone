<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->canManageEmployees()) {
                abort(403, 'Only administrators can manage employees.');
            }
            return $next($request);
        });
    }

    /**
     * Display employees for the authenticated admin's company
     */
    public function index()
    {
        $user = Auth::user();
        
        $employees = User::where('company_id', $user->company_id)
                        ->where('role', 'employee')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created employee
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $employee = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'company' => $user->company,
            'company_id' => $user->company_id,
            'role' => 'employee',
            'password' => Hash::make($request->input('password')),
            'is_active' => true,
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully!');
    }

    /**
     * Display the specified employee
     */
    public function show(User $employee)
    {
        $this->authorizeEmployee($employee);
        
        $employee->load(['properties', 'contracts', 'tenants']);
        
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee
     */
    public function edit(User $employee)
    {
        $this->authorizeEmployee($employee);
        
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee
     */
    public function update(Request $request, User $employee)
    {
        $this->authorizeEmployee($employee);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($employee->id)],
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $updateData = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'is_active' => $request->has('is_active'),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->input('password'));
        }

        $employee->update($updateData);

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified employee
     */
    public function destroy(User $employee)
    {
        $this->authorizeEmployee($employee);

        // Check if employee has any related data
        $hasData = $employee->properties()->exists() || 
                   $employee->contracts()->exists() || 
                   $employee->tenants()->exists();

        if ($hasData) {
            return redirect()->route('employees.index')
                ->with('error', 'Cannot delete employee with existing properties, contracts, or tenants. Deactivate instead.');
        }

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }

    /**
     * Toggle employee status (activate/deactivate)
     */
    public function toggleStatus(User $employee)
    {
        $this->authorizeEmployee($employee);

        $employee->update([
            'is_active' => !$employee->is_active
        ]);

        $status = $employee->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()
            ->with('success', "Employee {$status} successfully!");
    }

    /**
     * Authorize that the employee belongs to the same company as admin
     */
    private function authorizeEmployee(User $employee)
    {
        $user = Auth::user();
        
        if ($employee->company_id !== $user->company_id || $employee->role !== 'employee') {
            abort(403, 'Unauthorized access to this employee.');
        }
    }
}
