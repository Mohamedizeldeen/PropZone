<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|string|max:255",
            "email"=> "required|email|unique:companies,email",
            "phone"=> "nullable|string|max:255",
            "subscription_plan"=> "required|string|in:free,premium",
            "subscription_end"=> "required|date",
        ]);
        
        // Create the company
        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subscription_plan' => $request->subscription_plan,
            'subscription_end' => $request->subscription_end,
        ]);

        // Create admin user for the company
        User::create([
            'name' => $request->name ,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Use the provided password
            'role' => 'admin',
            'company_id' => $company->id,
        ]);

        return redirect()->route('sign in')->with('success','Company created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
