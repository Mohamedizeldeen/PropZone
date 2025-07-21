<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MaintenanceRequest;
use App\Models\Property;
use App\Models\Tenant;

class MaintenanceRequestController extends Controller
{
    /**
     * Display a listing of maintenance requests
     */
    public function index()
    {
        $user = Auth::user();
        
        $maintenanceRequests = MaintenanceRequest::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['property', 'tenant'])
          ->orderBy('created_at', 'desc')
          ->paginate(12);

        return view('maintenance-requests.index', compact('maintenanceRequests'));
    }

    /**
     * Show the form for creating a new maintenance request
     */
    public function create()
    {
        $user = Auth::user();
        $properties = Property::where('user_id', $user->id)->get();
        $tenants = Tenant::whereHas('contracts', function($query) use ($user) {
            $query->whereHas('property', function($subQuery) use ($user) {
                $subQuery->where('user_id', $user->id);
            });
        })->get();
        
        return view('maintenance-requests.create', compact('properties', 'tenants'));
    }

    /**
     * Store a newly created maintenance request
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'tenant_id' => 'nullable|exists:tenants,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => 'required|in:low,medium,high,urgent',
            'category' => 'required|in:plumbing,electrical,hvac,structural,appliance,other',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'requested_completion_date' => 'nullable|date|after:today',
            'estimated_cost' => 'nullable|numeric|min:0'
        ]);

        // Check if property belongs to authenticated user
        $property = Property::findOrFail($request->property_id);
        if ($property->user_id !== Auth::id()) {
            abort(403, 'You cannot create maintenance requests for properties you do not own.');
        }

        $maintenanceRequest = MaintenanceRequest::create($request->all());

        return redirect()->route('maintenance-requests.index')
            ->with('success', 'Maintenance request created successfully!');
    }

    /**
     * Display the specified maintenance request
     */
    public function show(MaintenanceRequest $maintenanceRequest)
    {
        // Check authorization
        if ($maintenanceRequest->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this maintenance request.');
        }

        $maintenanceRequest->load(['property', 'tenant']);
        
        return view('maintenance-requests.show', compact('maintenanceRequest'));
    }

    /**
     * Show the form for editing the maintenance request
     */
    public function edit(MaintenanceRequest $maintenanceRequest)
    {
        // Check authorization
        if ($maintenanceRequest->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this maintenance request.');
        }

        $user = Auth::user();
        $properties = Property::where('user_id', $user->id)->get();
        $tenants = Tenant::whereHas('contracts', function($query) use ($user) {
            $query->whereHas('property', function($subQuery) use ($user) {
                $subQuery->where('user_id', $user->id);
            });
        })->get();
        
        return view('maintenance-requests.edit', compact('maintenanceRequest', 'properties', 'tenants'));
    }

    /**
     * Update the specified maintenance request
     */
    public function update(Request $request, MaintenanceRequest $maintenanceRequest)
    {
        // Check authorization
        if ($maintenanceRequest->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this maintenance request.');
        }

        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'tenant_id' => 'nullable|exists:tenants,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => 'required|in:low,medium,high,urgent',
            'category' => 'required|in:plumbing,electrical,hvac,structural,appliance,other',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'requested_completion_date' => 'nullable|date|after:today',
            'estimated_cost' => 'nullable|numeric|min:0',
            'actual_cost' => 'nullable|numeric|min:0',
            'completed_date' => 'nullable|date',
            'notes' => 'nullable|string|max:1000'
        ]);

        // Check if property belongs to authenticated user
        $property = Property::findOrFail($request->property_id);
        if ($property->user_id !== Auth::id()) {
            abort(403, 'You cannot assign maintenance requests to properties you do not own.');
        }

        $maintenanceRequest->update($request->all());

        return redirect()->route('maintenance-requests.show', $maintenanceRequest)
            ->with('success', 'Maintenance request updated successfully!');
    }

    /**
     * Remove the specified maintenance request
     */
    public function destroy(MaintenanceRequest $maintenanceRequest)
    {
        // Check authorization
        if ($maintenanceRequest->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this maintenance request.');
        }

        $maintenanceRequest->delete();

        return redirect()->route('maintenance-requests.index')
            ->with('success', 'Maintenance request deleted successfully!');
    }
}
