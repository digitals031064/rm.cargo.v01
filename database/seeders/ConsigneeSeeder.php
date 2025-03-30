<?php

namespace Database\Seeders;

use App\Models\Consignee;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ConsigneeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Generate additional fake data
        for ($i = 0; $i < 20; $i++) {
            Consignee::create([
                'name' => $faker->unique()->company,
                'phone_number' => $faker->numerify('09#########'), // Generates 11-digit random phone numbers
                'billing_address' => $faker->address,
            ]);
        }
    }
}
