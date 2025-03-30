<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipper; // Import your Shipper model
use Faker\Factory as Faker; // Correct import for Faker

class ShipperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Sample data for a few fixed entries

        // Generate additional fake data
        for ($i = 0; $i < 20; $i++) {
            Shipper::create([
                'name' => $faker->unique()->company,
                'phone_number' => $faker->numerify('09#########'), // Generates 11-digit phone numbers
                'shipping_address' => $faker->address, // Generates a random address
            ]);
        }
    }
}
