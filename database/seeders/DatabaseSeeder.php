<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Shipper;
use App\Models\Consignee;
use App\Models\Waybill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        User::create([
            'name' => 'admin',
            'email' => 'admin@ad',
            'usertype' => 'admin',
            'password' => Hash::make('rootroot'), // Encrypting the password
        ]);
        User::create([
            'name' => 'JC',
            'email' => 'jcjr031064@yahoo.com',
            'usertype' => 'admin',
            'password' => Hash::make('Cfkak7cv'), // Encrypting the password
        ]);

        $cityMap = [
            'CEB' => 'Cebu City',
            'ZAM' => 'Zamboanga City',
            'MNL' => 'Manila',
        ];

        $offices = array_keys($cityMap);
        $cities = array_values($cityMap);

        $alibabaItems = [
            'Bluetooth Earphones',
            'LED Strip Lights',
            'Portable Power Banks',
            'Smart Watches',
            'Phone Holders',
            'Wireless Chargers',
            'Mini Drones',
            'USB Flash Drives',
            'Laptop Stands',
            'Car Dash Cameras',
            'Solar Garden Lights',
            'Electric Toothbrushes',
            'Resistance Bands',
            'Smart Home Plugs',
            'Pet Grooming Tools',
            'Yoga Mats',
            'Reusable Water Bottles',
            'Electric Hair Trimmers',
            'Portable Fans',
            'USB Hubs',
        ];

        // Create Users
        $users = collect();
        foreach (range(1, 9) as $i) {
            $officeCode = $faker->randomElement($offices);
            $users->push(User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'), // temp password
                'office' => $officeCode,
            ]));
        }

        // Create Consignees from random cities
        $consignees = collect();
        for ($i = 0; $i < 20; $i++) {
            $city = $faker->randomElement($cities);
            $consignees->push(Consignee::create([
                'name' => $faker->unique()->company,
                'phone_number' => $faker->numerify('09#########'),
                'billing_address' => $faker->streetAddress . ', ' . $city,
            ]));
        }

        // For each user, create shipper + waybills (only if consignee is in different city)
        $users->each(function ($user) use ($faker, $consignees, $cityMap, $alibabaItems) {
            $userCity = $cityMap[$user->office] ?? 'Unknown City';

            // Create shipper based on user's office city
            $shipper = Shipper::create([
                'name' => $faker->unique()->company,
                'phone_number' => $faker->numerify('09#########'),
                'shipping_address' => $faker->streetAddress . ', ' . $userCity,
            ]);

            // Filter consignees NOT in same city
            $eligibleConsignees = $consignees->filter(function ($consignee) use ($userCity) {
                return !Str::endsWith($consignee->billing_address, $userCity);
            })->values();

            if ($eligibleConsignees->isEmpty()) {
                return;
            }

            foreach (range(1, 10) as $i) {
                $consignee = $eligibleConsignees->random();

                Waybill::create([
                    'van_no' => $faker->numerify('####-#'),
                    'consignee_id' => $consignee->id,
                    'shipper_id' => $shipper->id,
                    'shipment' => $faker->randomElement($alibabaItems),
                    'price' => $faker->randomFloat(2, 100, 10000),
                    'cbm' => $faker->randomFloat(1, 0.5, 10),
                    'weight' => $faker->randomFloat(2, 1, 50), // new: 1kg to 50kg
                    'declared_value' => $faker->randomFloat(2, 500, 50000), // new: ₱500 to ₱50,000
                    'status' => $faker->randomElement([
                        'Pending',
                        'Arrived in Van Yard',
                        'Arrived at Port of Origin',
                        'Departed from Port of Origin',
                        'Arrived at Port of Destination',
                        'Delivered',
                    ]),
                    'user_id' => $user->id,
                    'office' => $user->office,
                    'waybill_no' =>($user->office === 'CEB' ? 'C' : ($user->office === 'ZAM' ? 'Z' : '')). random_int(500000, 599999),
                ]);
                
            }
        });
    }
}
