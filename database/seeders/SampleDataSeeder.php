<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\MaintenanceRequest;
use Carbon\Carbon;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // Get the North Line company user
        $user = User::where('company', 'north line')->first();
        
        if (!$user) {
            $this->command->error('North Line company user not found!');
            return;
        }

        $this->command->info('Creating sample data for North Line company...');

        // Create 10 Properties
        $properties = [];
        $propertyData = [
            [
                'name' => 'Luxury Downtown Apartment',
                'description' => 'Modern 2-bedroom apartment in the heart of downtown with city views.',
                'location' => '123 Main Street, Downtown',
                'type' => 'apartment',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1200,
                'price' => 2500.00,
                'status' => 'occupied'
            ],
            [
                'name' => 'Suburban Family Home',
                'description' => 'Spacious 4-bedroom house with large backyard, perfect for families.',
                'location' => '456 Oak Avenue, Suburbia',
                'type' => 'house',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 2800,
                'price' => 3200.00,
                'status' => 'occupied'
            ],
            [
                'name' => 'Cozy Studio Loft',
                'description' => 'Charming studio loft with exposed brick walls and modern amenities.',
                'location' => '789 Industrial Blvd, Arts District',
                'type' => 'studio',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'area' => 650,
                'price' => 1800.00,
                'status' => 'occupied'
            ],
            [
                'name' => 'Waterfront Condo',
                'description' => 'Beautiful 3-bedroom condo with stunning waterfront views.',
                'location' => '101 Marina Drive, Waterfront',
                'type' => 'condo',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 1850,
                'price' => 4000.00,
                'status' => 'occupied'
            ],
            [
                'name' => 'Historic Brownstone',
                'description' => 'Restored Victorian brownstone with original hardwood floors.',
                'location' => '202 Heritage Lane, Old Town',
                'type' => 'townhouse',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 1600,
                'price' => 2800.00,
                'status' => 'occupied'
            ],
            [
                'name' => 'Modern High-Rise Unit',
                'description' => 'Sleek 1-bedroom unit on the 15th floor with panoramic views.',
                'location' => '303 Sky Tower, Financial District',
                'type' => 'apartment',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'area' => 900,
                'price' => 2200.00,
                'status' => 'occupied'
            ],
            [
                'name' => 'Garden Apartment',
                'description' => 'Ground floor apartment with private garden access.',
                'location' => '404 Garden View, Green Valley',
                'type' => 'apartment',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'area' => 1100,
                'price' => 1900.00,
                'status' => 'available'
            ],
            [
                'name' => 'Executive Penthouse',
                'description' => 'Luxury penthouse with rooftop terrace and premium finishes.',
                'location' => '505 Elite Plaza, Uptown',
                'type' => 'penthouse',
                'bedrooms' => 4,
                'bathrooms' => 4,
                'area' => 3500,
                'price' => 6500.00,
                'status' => 'occupied'
            ],
            [
                'name' => 'Countryside Cottage',
                'description' => 'Quaint 2-bedroom cottage surrounded by nature.',
                'location' => '606 Country Road, Meadowbrook',
                'type' => 'house',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'area' => 1000,
                'price' => 1500.00,
                'status' => 'occupied'
            ],
            [
                'name' => 'Urban Loft Space',
                'description' => 'Industrial-style loft with high ceilings and exposed beams.',
                'location' => '707 Warehouse District, Industrial Zone',
                'type' => 'loft',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1400,
                'price' => 2600.00,
                'status' => 'available'
            ]
        ];

        foreach ($propertyData as $data) {
            $property = Property::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'description' => $data['description'],
                'location' => $data['location'],
                'type' => $data['type'],
                'bedrooms' => $data['bedrooms'],
                'bathrooms' => $data['bathrooms'],
                'area' => $data['area'],
                'price' => $data['price'],
                'status' => $data['status'],
                'created_at' => Carbon::now()->subDays(rand(30, 180)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30))
            ]);
            $properties[] = $property;
        }

        $this->command->info('Created 10 properties');

        // Create 10 Tenants
        $tenants = [];
        $tenantData = [
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@email.com',
                'phone' => '+1-555-0101',
                'date_of_birth' => '1985-03-15',
                'employment_status' => 'Full-time',
                'employer_name' => 'Tech Solutions Inc',
                'monthly_income' => 7500.00
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@email.com',
                'phone' => '+1-555-0102',
                'date_of_birth' => '1990-07-22',
                'employment_status' => 'Full-time',
                'employer_name' => 'Marketing Agency',
                'monthly_income' => 8200.00
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Davis',
                'email' => 'michael.davis@email.com',
                'phone' => '+1-555-0103',
                'date_of_birth' => '1988-11-08',
                'employment_status' => 'Self-employed',
                'employer_name' => 'Freelance Designer',
                'monthly_income' => 5400.00
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Wilson',
                'email' => 'emily.wilson@email.com',
                'phone' => '+1-555-0104',
                'date_of_birth' => '1992-01-30',
                'employment_status' => 'Full-time',
                'employer_name' => 'Financial Services Corp',
                'monthly_income' => 12000.00
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Brown',
                'email' => 'david.brown@email.com',
                'phone' => '+1-555-0105',
                'date_of_birth' => '1983-09-12',
                'employment_status' => 'Full-time',
                'employer_name' => 'Construction Company',
                'monthly_income' => 6800.00
            ],
            [
                'first_name' => 'Jessica',
                'last_name' => 'Taylor',
                'email' => 'jessica.taylor@email.com',
                'phone' => '+1-555-0106',
                'date_of_birth' => '1987-05-18',
                'employment_status' => 'Part-time',
                'employer_name' => 'University',
                'monthly_income' => 4500.00
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Anderson',
                'email' => 'robert.anderson@email.com',
                'phone' => '+1-555-0107',
                'date_of_birth' => '1991-12-03',
                'employment_status' => 'Full-time',
                'employer_name' => 'Software Development',
                'monthly_income' => 9500.00
            ],
            [
                'first_name' => 'Lisa',
                'last_name' => 'Martinez',
                'email' => 'lisa.martinez@email.com',
                'phone' => '+1-555-0108',
                'date_of_birth' => '1986-04-25',
                'employment_status' => 'Full-time',
                'employer_name' => 'Healthcare System',
                'monthly_income' => 11000.00
            ],
            [
                'first_name' => 'Christopher',
                'last_name' => 'Garcia',
                'email' => 'chris.garcia@email.com',
                'phone' => '+1-555-0109',
                'date_of_birth' => '1989-08-14',
                'employment_status' => 'Full-time',
                'employer_name' => 'Real Estate Agency',
                'monthly_income' => 7200.00
            ],
            [
                'first_name' => 'Amanda',
                'last_name' => 'Rodriguez',
                'email' => 'amanda.rodriguez@email.com',
                'phone' => '+1-555-0110',
                'date_of_birth' => '1993-02-11',
                'employment_status' => 'Full-time',
                'employer_name' => 'Law Firm',
                'monthly_income' => 13500.00
            ]
        ];

        foreach ($tenantData as $data) {
            $tenant = Tenant::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'date_of_birth' => $data['date_of_birth'],
                'address' => rand(100, 999) . ' Previous St, Old City',
                'employment_status' => $data['employment_status'],
                'employer_name' => $data['employer_name'],
                'monthly_income' => $data['monthly_income'],
                'emergency_contact_name' => $data['first_name'] . ' Emergency Contact',
                'emergency_contact_phone' => '+1-555-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT),
                'notes' => 'Reliable tenant with excellent references.',
                'status' => 'active',
                'user_id' => $user->id,
                'created_at' => Carbon::now()->subDays(rand(60, 200)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30))
            ]);
            $tenants[] = $tenant;
        }

        $this->command->info('Created 10 tenants');

        // Create Contracts for 8 occupied properties (leaving 2 available)
        $contracts = [];
        $occupiedProperties = array_filter($properties, function($property) {
            return $property->status === 'occupied';
        });

        $contractIndex = 0;
        foreach ($occupiedProperties as $property) {
            if ($contractIndex < count($tenants)) {
                $tenant = $tenants[$contractIndex];
                $startDate = Carbon::now()->subMonths(rand(3, 18));
                $endDate = $startDate->copy()->addYear();

                $contract = Contract::create([
                    'contract_number' => 'CTR' . str_pad($contractIndex + 1, 4, '0', STR_PAD_LEFT),
                    'property_id' => $property->id,
                    'tenant_id' => $tenant->id,
                    'user_id' => $user->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'monthly_rent' => $property->price,
                    'security_deposit' => $property->price * 2,
                    'late_fee' => 50.00,
                    'rent_due_day' => 1,
                    'terms_and_conditions' => 'Standard lease agreement terms and conditions apply. No smoking allowed. Pets allowed with additional deposit.',
                    'special_clauses' => 'Additional clauses may apply based on property type.',
                    'status' => 'active',
                    'created_at' => $startDate->copy()->subDays(10),
                    'updated_at' => Carbon::now()->subDays(rand(1, 30))
                ]);
                $contracts[] = $contract;
                $contractIndex++;
            }
        }

        $this->command->info('Created ' . count($contracts) . ' contracts');

        // Create Payment Records
        $paymentStatuses = ['paid', 'paid', 'paid', 'pending', 'overdue'];
        $paymentMethods = ['bank_transfer', 'credit_card', 'online', 'cash', 'check'];

        foreach ($contracts as $contract) {
            $paymentDate = Carbon::parse($contract->start_date);
            $monthsToGenerate = min(6, $paymentDate->diffInMonths(Carbon::now()) + 1);

            for ($i = 0; $i < $monthsToGenerate; $i++) {
                $status = $paymentStatuses[array_rand($paymentStatuses)];
                $method = $paymentMethods[array_rand($paymentMethods)];

                Payment::create([
                    'payment_number' => 'PAY' . str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                    'contract_id' => $contract->id,
                    'tenant_id' => $contract->tenant_id,
                    'property_id' => $contract->property_id,
                    'user_id' => $user->id,
                    'payment_type' => 'rent',
                    'amount' => $contract->monthly_rent,
                    'due_date' => $paymentDate->copy(),
                    'paid_date' => $status === 'paid' ? $paymentDate->copy() : null,
                    'status' => $status,
                    'payment_method' => $method,
                    'transaction_reference' => 'TXN' . str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                    'late_fee_amount' => $status === 'overdue' ? 50.00 : 0,
                    'notes' => $status === 'paid' ? 'Payment received on time' : 'Payment ' . $status,
                    'created_at' => $paymentDate->copy(),
                    'updated_at' => $paymentDate->copy()->addDays(rand(0, 5))
                ]);

                $paymentDate->addMonth();
            }
        }

        $this->command->info('Created payment records');

        // Create Maintenance Requests
        $maintenanceTypes = [
            'plumbing' => 'Leaky faucet in kitchen sink needs repair',
            'electrical' => 'Bedroom outlet not working properly',
            'hvac' => 'Air conditioning unit making strange noises',
            'appliance' => 'Refrigerator temperature not consistent',
            'structural' => 'Small crack appeared in living room wall',
            'cosmetic' => 'Touch-up paint needed in hallway',
            'security' => 'Window lock mechanism broken',
            'other' => 'Smoke detector battery needs replacement'
        ];

        $priorities = ['low', 'medium', 'high', 'urgent'];
        $statuses = ['pending', 'in_progress', 'completed', 'cancelled'];

        foreach ($contracts as $contract) {
            $numRequests = rand(1, 4);
            
            for ($i = 0; $i < $numRequests; $i++) {
                $type = array_rand($maintenanceTypes);
                $priority = $priorities[array_rand($priorities)];
                $status = $statuses[array_rand($statuses)];
                $requestDate = Carbon::now()->subDays(rand(1, 90));

                MaintenanceRequest::create([
                    'request_number' => 'MNT' . str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                    'property_id' => $contract->property_id,
                    'tenant_id' => $contract->tenant_id,
                    'user_id' => $user->id,
                    'title' => ucfirst($type) . ' Issue',
                    'description' => $maintenanceTypes[$type],
                    'category' => $type,
                    'priority' => $priority,
                    'status' => $status,
                    'estimated_cost' => rand(50, 500),
                    'actual_cost' => $status === 'completed' ? rand(50, 500) : null,
                    'assigned_to' => $status !== 'pending' ? 'Maintenance Team' : null,
                    'requested_date' => $requestDate,
                    'scheduled_date' => $status !== 'pending' ? $requestDate->copy()->addDays(rand(1, 7)) : null,
                    'completed_date' => $status === 'completed' ? $requestDate->copy()->addDays(rand(2, 14)) : null,
                    'completion_notes' => $status === 'completed' ? 'Work completed successfully' : null,
                    'created_at' => $requestDate,
                    'updated_at' => $requestDate->copy()->addDays(rand(0, 10))
                ]);
            }
        }

        $this->command->info('Created maintenance requests');

        $this->command->info('Sample data creation completed successfully!');
        $this->command->info('Summary:');
        $this->command->info('- 10 Properties created');
        $this->command->info('- 10 Tenants created');
        $this->command->info('- ' . count($contracts) . ' Contracts created');
        $this->command->info('- Multiple Payment records created');
        $this->command->info('- Multiple Maintenance requests created');
    }
}
