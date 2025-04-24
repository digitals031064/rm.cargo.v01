<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Waybill;
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
        
    // Loop through each user and generate 10 waybills for each
        // Loop through each user and generate 10 waybills for each
        User::all()->each(function ($user) {
            Waybill::factory(10)->create([
                'user_id' => $user->id,  // Use the current user's ID instead of hardcoding 1
                'office' => $user->office,
            ]);
        });

    }
}
