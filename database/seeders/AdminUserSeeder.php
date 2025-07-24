<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, let's find the North Line company or create it if it doesn't exist
        $company = Company::firstOrCreate(
            ['name' => 'North Line'],
            [
                'email' => 'info@northline.com',
                'phone' => '+1234567890',
                'address' => '123 Business Street',
                'city' => 'Business City',
                'state' => 'Business State',
                'zip_code' => '12345',
                'country' => 'USA'
            ]
        );

        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@northline.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'company_id' => $company->id,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create a test employee user
        User::firstOrCreate(
            ['email' => 'employee@northline.com'],
            [
                'name' => 'Test Employee',
                'password' => Hash::make('password123'),
                'role' => 'employee',
                'company_id' => $company->id,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        echo "Admin user created successfully!\n";
        echo "Login credentials:\n";
        echo "Email: admin@northline.com\n";
        echo "Password: password123\n\n";
        echo "Test employee created:\n";
        echo "Email: employee@northline.com\n";
        echo "Password: password123\n";
    }
}
