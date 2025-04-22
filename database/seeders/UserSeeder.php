<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@ad',
            'usertype' => 'admin',
            'password' => Hash::make('rootroot'), // Encrypting the password
        ]);

        

                // Create sample users with Faker
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'office' => $faker->randomElement([
                    'CEB',
                    'ZAM',
                    'MNL'
                ]),
                'password' => Hash::make('password123'),
            ]);
        }
    }
}
