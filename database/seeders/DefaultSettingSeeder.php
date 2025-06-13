<?php

namespace Database\Seeders;

use App\Models\BrandSetting;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert countries
        $countries = [
            ['name' => 'India', 'code' => 'IND'],
        ];

        DB::table('countries')->insert($countries);

        $states = [
            // States for India
            ['name' => 'Andhra Pradesh', 'country_id' => 1],
            ['name' => 'Arunachal Pradesh', 'country_id' => 1],
            ['name' => 'Assam', 'country_id' => 1],
            ['name' => 'Bihar', 'country_id' => 1],
            ['name' => 'Chhattisgarh', 'country_id' => 1],
            ['name' => 'Goa', 'country_id' => 1],
            ['name' => 'Gujarat', 'country_id' => 1],
            ['name' => 'Haryana', 'country_id' => 1],
            ['name' => 'Himachal Pradesh', 'country_id' => 1],
            ['name' => 'Jharkhand', 'country_id' => 1],
            ['name' => 'Karnataka', 'country_id' => 1],
            ['name' => 'Kerala', 'country_id' => 1],
            ['name' => 'Madhya Pradesh', 'country_id' => 1],
            ['name' => 'Maharashtra', 'country_id' => 1],
            ['name' => 'Manipur', 'country_id' => 1],
            ['name' => 'Meghalaya', 'country_id' => 1],
            ['name' => 'Mizoram', 'country_id' => 1],
            ['name' => 'Nagaland', 'country_id' => 1],
            ['name' => 'Odisha', 'country_id' => 1],
            ['name' => 'Punjab', 'country_id' => 1],
            ['name' => 'Rajasthan', 'country_id' => 1],
            ['name' => 'Sikkim', 'country_id' => 1],
            ['name' => 'Tamil Nadu', 'country_id' => 1],
            ['name' => 'Telangana', 'country_id' => 1],
            ['name' => 'Uttar Pradesh', 'country_id' => 1],
            ['name' => 'Uttarakhand', 'country_id' => 1],
            ['name' => 'West Bengal', 'country_id' => 1],
        ];

        DB::table('states')->insert($states);


        $currencies = [
            ['code' => 'INR', 'name' => 'Indian Rupee', 'symbol' => '₹', 'exchange_rate' => 0.011, 'is_active' => true],
        ];

        DB::table('currencies')->insert($currencies);

        // Brand Setting
        BrandSetting::create([
            "name" => "My Brand",
            "title" => "My Brand Title",
            "description" => "This is a description for My Brand.",
            "contact_email" => "support@mybrand.com",
            "contact_phone" => "+1234567890",
        ]);

        // Email Setting
        EmailConfiguration::create([
            "smtp_host" => "smtp.mailtrap.io",
            "smtp_port" => "2525",
            "smtp_username" => "user@mailtrap.io",
            "smtp_password" => "secret",
            "smtp_encryption" => "tls",
            "from_address" => "noreply@mybrand.com",
            "from_name" => "My Brand",
            "reply_to_address" => "support@mybrand.com",
            "reply_to_name" => "Support Team",
            "enable" => true,
        ]);

        // General Setting
        GeneralSetting::create([
            "date_format" => "Y-m-d",
            "default_currency" => 1,
            "timezone" => "Asia/Kolkata",
            "language" => "en",
            "session_timeout" => 30, // in minutes
            "copyright" => "© 2025 My Brand. All rights reserved.",
            "developed_by" => "My Brand Development Team",
        ]);

    }
}
