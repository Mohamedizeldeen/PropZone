<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\MaintenanceRequest;
use App\Models\SubscriptionInvoice;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Middleware will be applied in routes
    }

    /**
     * Show the dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Calculate comprehensive statistics
        $totalProperties = Property::where('user_id', $user->id)->count();
        $activeTenants = Tenant::whereHas('contracts', function($query) use ($user) {
            $query->where('status', 'active')
                  ->whereHas('property', function($subQuery) use ($user) {
                      $subQuery->where('user_id', $user->id);
                  });
        })->count();
        
        $activeContracts = Contract::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'active')->count();
        
        $monthlyRevenue = Payment::whereHas('contract.property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'paid')
          ->whereMonth('paid_date', now()->month)
          ->whereYear('paid_date', now()->year)
          ->sum('amount');
        
        $pendingPayments = Payment::whereHas('contract.property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'pending')->sum('amount');
        
        $pendingMaintenance = MaintenanceRequest::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereIn('status', ['pending', 'in_progress'])->count();
        
        // Calculate occupancy rate
        $occupiedProperties = Property::where('user_id', $user->id)
            ->where('status', 'rented')->count();
        $occupancyRate = $totalProperties > 0 ? 
            round(($occupiedProperties / $totalProperties) * 100, 1) : 0;
        
        // Get user's subscription plan
        $latestInvoice = SubscriptionInvoice::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')->first();
        $subscriptionPlan = $latestInvoice ? 
            ucfirst($latestInvoice->plan_type) : 'Free';
        
        $stats = [
            'total_properties' => $totalProperties,
            'active_tenants' => $activeTenants,
            'active_contracts' => $activeContracts,
            'monthly_revenue' => $monthlyRevenue,
            'pending_payments' => $pendingPayments,
            'pending_maintenance' => $pendingMaintenance,
            'occupancy_rate' => $occupancyRate,
            'subscription_plan' => $subscriptionPlan,
        ];

        // Get recent properties
        $recent_properties = Property::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($property) {
                $statusDisplay = $property->getStatusDisplayAttribute();
                return [
                    'name' => $property->name,
                    'location' => $property->location,
                    'price' => $property->price,
                    'status' => $statusDisplay['text'],
                    'status_class' => $statusDisplay['class'],
                ];
            })->toArray();

        // Get recent maintenance requests
        $recent_maintenance = MaintenanceRequest::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['property'])
          ->orderBy('created_at', 'desc')
          ->take(5)
          ->get()
          ->map(function($maintenance) {
              return [
                  'title' => $maintenance->title,
                  'property_name' => $maintenance->property->name ?? 'Unknown Property',
                  'priority' => ucfirst($maintenance->priority ?? 'medium'),
                  'priority_class' => $maintenance->getPriorityBadgeAttribute(),
                  'days_open' => $maintenance->getDaysOpenAttribute(),
              ];
          })->toArray();

        // Get recent payments
        $recent_payments = Payment::whereHas('contract.property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['tenant'])
          ->orderBy('created_at', 'desc')
          ->take(5)
          ->get()
          ->map(function($payment) {
              return [
                  'tenant_name' => $payment->tenant->full_name ?? 'Unknown Tenant',
                  'amount' => $payment->amount,
                  'type' => ucfirst(str_replace('_', ' ', $payment->payment_type ?? 'rent')),
                  'due_date' => $payment->due_date ? $payment->due_date->format('M d, Y') : 'N/A',
                  'status' => ucfirst($payment->status ?? 'pending'),
                  'status_class' => $payment->getStatusBadgeAttribute(),
              ];
          })->toArray();

        // Get recent active tenants
        $recent_tenants = Tenant::whereHas('contracts', function($query) use ($user) {
            $query->where('status', 'active')
                  ->whereHas('property', function($subQuery) use ($user) {
                      $subQuery->where('user_id', $user->id);
                  });
        })->with(['currentContract.property'])
          ->orderBy('created_at', 'desc')
          ->take(5)
          ->get()
          ->map(function($tenant) {
              $contract = $tenant->currentContract;
              return [
                  'name' => $tenant->full_name,
                  'property_name' => $contract && $contract->property ? 
                      $contract->property->name : 'Unknown Property',
                  'monthly_rent' => $contract ? $contract->monthly_rent : 0,
                  'status' => ucfirst($tenant->status ?? 'active'),
                  'status_class' => $tenant->getStatusBadgeAttribute(),
              ];
          })->toArray();

        return view('dashboard', compact(
            'user', 
            'stats', 
            'recent_properties', 
            'recent_maintenance', 
            'recent_payments', 
            'recent_tenants'
        ));
    }
}
