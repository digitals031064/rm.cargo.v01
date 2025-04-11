<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Waybill;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WaybillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $locations = Location::all(); // Get all locations

        foreach ($locations as $location) {
            $prefix = strtoupper(substr($location->name, 0, 3)); // e.g., CEB, MLA

            // Fetch the last waybill number for the location, default to 0 if not set
            $lastWaybillNumber = $location->last_waybill_number ?? 0;

            // Create 10 waybills starting from the last used number
            for ($i = 1; $i <= 10; $i++) {
                // Increment the last waybill number
                $nextWaybillNumber = $lastWaybillNumber + $i;

                // Format: CEB-000001, MLA-000010, etc.
                $waybillNo = $prefix . '-' . str_pad($nextWaybillNumber, 6, '0', STR_PAD_LEFT);

                // Assign a random user
                $user = User::inRandomOrder()->first();

                // Create the waybill
                Waybill::factory()->create([
                    'waybill_no' => $waybillNo,
                    'location_id' => $location->id,
                    'user_id' => $user->id,
                ]);
            }

            // Update the location's last waybill number after creating the waybills
            $location->last_waybill_number = $lastWaybillNumber + 10; // Set the new last number
            $location->save();
        }


    }
}
