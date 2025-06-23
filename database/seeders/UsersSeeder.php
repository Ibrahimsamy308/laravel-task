<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
               
        for ($i = 0; $i < 30; $i++) {
            User::create([
                'fullname' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => '01' . rand(100000000, 999999999), 
                'password' => Hash::make('123456789'), 
            ]);
        }
    }
}