<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;
use App\Models\Property;
use App\Models\Tenant;

class ContractController extends Controller
{
    /**
     * Display a listing of contracts
     */
    public function index()
    {
        $user = Auth::user();
        
        $contracts = Contract::where('company_id', $user->company_id)
          ->with(['property', 'tenant', 'payments'])
          ->orderBy('created_at', 'desc')
          ->paginate(12);

        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new contract
     */
    public function create()
    {
        $user = Auth::user();
        $properties = Property::where('company_id', $user->company_id)->get();
        $tenants = Tenant::where('company_id', $user->company_id)->get();
        
        return view('contracts.create', compact('properties', 'tenants'));
    }

    /**
     * Store a newly created contract
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'tenant_id' => 'required|exists:tenants,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,active,terminated,expired',
            'terms' => 'nullable|string|max:2000',
            'special_conditions' => 'nullable|string|max:1000'
        ]);

        // Check if property belongs to authenticated user
        $property = Property::findOrFail($request->property_id);
        if ($property->user_id !== Auth::id()) {
            abort(403, 'You cannot create contracts for properties you do not own.');
        }

        // Map form fields to model fields
        $contractData = [
            'property_id' => $request->property_id,
            'tenant_id' => $request->tenant_id,
            'lease_start_date' => $request->start_date,
            'lease_end_date' => $request->end_date,
            'monthly_rent' => $request->monthly_rent,
            'security_deposit' => $request->security_deposit,
            'status' => $request->status,
            'terms_conditions' => $request->terms,
        ];

        // Add special_conditions to terms_conditions if provided
        if ($request->special_conditions) {
            $contractData['terms_conditions'] = ($contractData['terms_conditions'] ?? '') . 
                ($contractData['terms_conditions'] ? "\n\nSpecial Conditions:\n" : '') . 
                $request->special_conditions;
        }

        $contract = Contract::create($contractData);

        return redirect()->route('contracts.index')
            ->with('success', 'Contract created successfully!');
    }

    /**
     * Display the specified contract
     */
    public function show(Contract $contract)
    {
        // Check authorization
        if ($contract->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this contract.');
        }

        $contract->load(['property', 'tenant', 'payments']);
        
        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the contract
     */
    public function edit(Contract $contract)
    {
        // Check authorization
        if ($contract->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this contract.');
        }

        $user = Auth::user();
        $properties = Property::where('user_id', $user->id)->get();
        $tenants = Tenant::all();
        
        return view('contracts.edit', compact('contract', 'properties', 'tenants'));
    }

    /**
     * Update the specified contract
     */
    public function update(Request $request, Contract $contract)
    {
        // Check authorization
        if ($contract->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this contract.');
        }

        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'tenant_id' => 'required|exists:tenants,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,active,terminated,expired',
            'terms' => 'nullable|string|max:2000',
            'special_conditions' => 'nullable|string|max:1000'
        ]);

        // Check if property belongs to authenticated user
        $property = Property::findOrFail($request->property_id);
        if ($property->user_id !== Auth::id()) {
            abort(403, 'You cannot assign contracts to properties you do not own.');
        }

        // Map form fields to model fields
        $contractData = [
            'property_id' => $request->property_id,
            'tenant_id' => $request->tenant_id,
            'lease_start_date' => $request->start_date,
            'lease_end_date' => $request->end_date,
            'monthly_rent' => $request->monthly_rent,
            'security_deposit' => $request->security_deposit,
            'status' => $request->status,
            'terms_conditions' => $request->terms,
        ];

        // Add special_conditions to terms_conditions if provided
        if ($request->special_conditions) {
            $contractData['terms_conditions'] = ($contractData['terms_conditions'] ?? '') . 
                ($contractData['terms_conditions'] ? "\n\nSpecial Conditions:\n" : '') . 
                $request->special_conditions;
        }

        $contract->update($contractData);

        return redirect()->route('contracts.show', $contract)
            ->with('success', 'Contract updated successfully!');
    }

    /**
     * Remove the specified contract
     */
    public function destroy(Contract $contract)
    {
        // Check authorization
        if ($contract->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this contract.');
        }

        // Check if contract has payments
        if ($contract->payments()->exists()) {
            return redirect()->route('contracts.index')
                ->with('error', 'Cannot delete contract with associated payments.');
        }

        $contract->delete();

        return redirect()->route('contracts.index')
            ->with('success', 'Contract deleted successfully!');
    }
}
