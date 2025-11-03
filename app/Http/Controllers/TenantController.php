<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use App\Models\Property;
use App\Models\Contract;

class TenantController extends Controller
{
   

    /**
     * Display a listing of tenants
     */
    public function index()
    {
        try {
            $user = Auth::user();
            
            // Get tenants for the authenticated user's company
            $tenants = Tenant::with(['contracts.property'])
                ->where('company_id', $user->company_id)
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return view('tenants.index', compact('tenants'));
        } catch (\Exception $e) {
            // If there's an error, return empty collection
            $tenants = collect()->paginate(12);
            return view('tenants.index', compact('tenants'));
        }
    }

    /**
     * Show the form for creating a new tenant
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created tenant
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'employment_status' => 'nullable|string|max:255',
            'employer_name' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|numeric|min:0',
            'previous_address' => 'nullable|string|max:500',
            'id_number' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:1000'
        ]);

        $tenant = Tenant::create(array_merge($request->all(), [
            'user_id' => Auth::id(),
            'company_id' => Auth::user()->company_id
        ]));

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant created successfully!');
    }

    /**
     * Display the specified tenant
     */
    public function show(Tenant $tenant)
    {
        // Check authorization - tenant must be related to user's properties
        $userProperties = Property::where('user_id', Auth::id())->pluck('id');
        $tenantProperties = $tenant->contracts()->whereIn('property_id', $userProperties)->exists();
        
        if (!$tenantProperties) {
            abort(403, 'Unauthorized access to this tenant.');
        }

        $tenant->load([
            'contracts.property', 
            'payments' => function($query) {
                $query->orderBy('paid_date', 'desc');
            },
            'maintenanceRequests' => function($query) {
                $query->orderBy('created_at', 'desc');
            }
        ]);

        return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the tenant
     */
    public function edit(Tenant $tenant)
    {
        // Check authorization - tenant must be related to user's properties
        $userProperties = Property::where('user_id', Auth::id())->pluck('id');
        $tenantProperties = $tenant->contracts()->whereIn('property_id', $userProperties)->exists();
        
        if (!$tenantProperties) {
            abort(403, 'Unauthorized access to this tenant.');
        }

        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified tenant
     */
    public function update(Request $request, Tenant $tenant)
    {
        // Check authorization - tenant must be related to user's properties
        $userProperties = Property::where('user_id', Auth::id())->pluck('id');
        $tenantProperties = $tenant->contracts()->whereIn('property_id', $userProperties)->exists();
        
        if (!$tenantProperties) {
            abort(403, 'Unauthorized access to this tenant.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email,' . $tenant->id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'employment_status' => 'nullable|string|max:255',
            'employer_name' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|numeric|min:0',
            'previous_address' => 'nullable|string|max:500',
            'id_number' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:1000'
        ]);

        $tenant->update($request->all());

        return redirect()->route('tenants.show', $tenant)
            ->with('success', 'Tenant updated successfully!');
    }

    /**
     * Remove the specified tenant
     */
    public function destroy(Tenant $tenant)
    {
        // Check authorization - tenant must be related to user's properties
        $userProperties = Property::where('user_id', Auth::id())->pluck('id');
        $tenantProperties = $tenant->contracts()->whereIn('property_id', $userProperties)->exists();
        
        if (!$tenantProperties) {
            abort(403, 'Unauthorized access to this tenant.');
        }

        // Check if tenant has active contracts
        if ($tenant->contracts()->where('status', 'active')->exists()) {
            return redirect()->route('tenants.index')
                ->with('error', 'Cannot delete tenant with active contracts.');
        }

        // Check if tenant has payments
        if ($tenant->payments()->exists()) {
            return redirect()->route('tenants.index')
                ->with('error', 'Cannot delete tenant with payment history.');
        }

        $tenant->delete();

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant deleted successfully!');
    }
}
