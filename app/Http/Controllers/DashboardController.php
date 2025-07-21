<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        // Sample data for dashboard - you can replace this with real data later
        $stats = [
            'total_properties' => 12,
            'total_revenue' => 156000,
            'occupancy_rate' => 94.2,
            'monthly_growth' => 12.5,
        ];

        $recent_properties = [
            [
                'name' => 'Apartment Complex A',
                'occupancy' => 85,
                'revenue' => 24000,
                'growth' => 8,
            ],
            [
                'name' => 'Office Building B',
                'occupancy' => 92,
                'revenue' => 18000,
                'growth' => 12,
            ],
            [
                'name' => 'Retail Space C',
                'occupancy' => 78,
                'revenue' => 15000,
                'growth' => 5,
            ],
        ];

        return view('dashboard', compact('user', 'stats', 'recent_properties'));
    }
}
