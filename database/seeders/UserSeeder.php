<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => 'Ridha Fahmi',
            'email' => 'ridhofahmij225@gmail.com',
            'password' => Hash::make('12345678'),
        ];
        \App\Models\User::create($user)->assignRole('user');

        $admin = [
            'name' => 'Admin',
            'email' => 'admin@gis.com',
            'password' => Hash::make('12345678'),
        ];
        \App\Models\User::create($admin)->assignRole('admin');
    }
}
