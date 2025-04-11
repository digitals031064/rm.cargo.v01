<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Location::create([
            'name' => 'Manila',
            'last_waybill_number' => 2102, // Example of setting a starting number
        ]);

        Location::create([
            'name' => 'Cebu',
            'last_waybill_number' => 308,
        ]);

        Location::create([
            'name' => 'Zamboanga',
            'last_waybill_number' => 13,
        ]);
    }
}
