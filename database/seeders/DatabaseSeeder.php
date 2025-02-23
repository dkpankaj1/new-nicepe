<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Feature;
use App\Models\Plan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // default feature
        Feature::create([
            'code' => "FTR001",
            'name' => "Mobile Recharge",
            'fee' => 100,
            'description' => fake()->paragraph(),
            'enable' => true,
        ]);
        Feature::create([
            'code' => "FTR002",
            'name' => "Nsdl PAN Application",
            'fee' => 120,
            'description' => fake()->paragraph(),
            'enable' => true,
        ]);

        Feature::create([
            'code' => "FTR003",
            'name' => "Adhar Email/Mobile Update",
            'fee' => 120,
            'description' => fake()->paragraph(),
            'enable' => true,
        ]);


        $this->call(DefaultSettingSeeder::class);
        $this->call(RolePermissionSeeder::class);

        //  default user
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '123-456-7890',
                'address' => '123 Admin St, Admin City, Admin State',
                'city' => 'Admin City',
                'state' => 'Admin State',
                'country' => 'Admin Country',
                'postal_code' => '12345',
                'wallet' => 1000.00,
                'api_key' => 'admin-api-key',
                'api_secret' => 'admin-api-secret',
                'type' => UserType::ADMIN, // Assuming this corresponds to a role
                'active' => true,
            ],
            [
                'name' => 'api client',
                'email' => 'apiclient@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '234-567-8901',
                'address' => '456 API St, Api City, Api State',
                'city' => 'Api City',
                'state' => 'Api State',
                'country' => 'Api Country',
                'postal_code' => '23456',
                'wallet' => 500.00,
                'api_key' => 'apiclient-api-key',
                'api_secret' => 'apiclient-api-secret',
                'type' => UserType::APICLIENT,
                'active' => true,
            ],
            [
                'name' => 'super distributor',
                'email' => 'superdistributor@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '345-678-9012',
                'address' => '789 Distributor St, Super City, Super State',
                'city' => 'Super City',
                'state' => 'Super State',
                'country' => 'Super Country',
                'postal_code' => '34567',
                'wallet' => 1500.00,
                'api_key' => 'superdistributor-api-key',
                'api_secret' => 'superdistributor-api-secret',
                'type' => UserType::SUPERDISTRIBUTOR,
                'active' => true,
            ],
            [
                'name' => 'distributor',
                'email' => 'distributor@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '456-789-0123',
                'address' => '101 Distributor St, Distributor City, Distributor State',
                'city' => 'Distributor City',
                'state' => 'Distributor State',
                'country' => 'Distributor Country',
                'postal_code' => '45678',
                'wallet' => 750.00,
                'api_key' => 'distributor-api-key',
                'api_secret' => 'distributor-api-secret',
                'type' => UserType::DISTRIBUTOR,
                'active' => true,
            ],
            [
                'name' => 'retailer',
                'email' => 'retailer@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '567-890-1234',
                'address' => '202 Retailer St, Retail City, Retail State',
                'city' => 'Retail City',
                'state' => 'Retail State',
                'country' => 'Retail Country',
                'postal_code' => '56789',
                'wallet' => 100.00,
                'api_key' => 'retailer-api-key',
                'api_secret' => 'retailer-api-secret',
                'type' => UserType::RETAILER,
                'active' => true,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }

        // define super admin
        User::first()->assignRole('superAdmin');

        // create default plan
        $plan = Plan::create([
            'user_id' => 1,
            'name' => "Default Plan",
            'description' => "default plan",
        ]);

        $allFeature = Feature::all();
        $allFeature->each(function ($feature) use ($plan) {
            $plan->planDetails()->create([
                "feature_id" => $feature->id,
                "fee" => $feature->fee,
            ]);
        });

    }
}
