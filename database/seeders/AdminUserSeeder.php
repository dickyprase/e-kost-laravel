<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'username' => 'admin',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'nik' => '1234567890',
                'name' => 'Admin Kos',
                'address' => 'Jakarta',
                'birth_date' => '2000-01-01',
                'gender' => 'male',
                'phone' => '08123456789',
            ]
        );
    }
}
