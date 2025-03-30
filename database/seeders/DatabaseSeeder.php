<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WaybillSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'jcjr031064',
            'email' => 'jcjr031064@yahoo.com',
            'password' => bcrypt('Cfkak7cv'),
        ]);

        $this->call([
            UserSeeder::class,
        ]);

        $this->call([
            ShipperSeeder::class,
        ]);

        $this->call([
            ConsigneeSeeder::class,
        ]);

        $this->call([
            WaybillSeeder::class,
        ]);
    }
}
