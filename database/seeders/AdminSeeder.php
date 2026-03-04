<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::firstOrCreate(
            ['email' => 'admin@taskmanager.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin@123'),
                'role' => 'admin',
            ]
        );

        // Create demo user accounts
        User::firstOrCreate(
            ['email' => 'geeth@gmail.com'],
            [
                'name' => 'Geeth',
                'password' => Hash::make('geeth@123'),
                'role' => 'user',
            ]
        );

        User::firstOrCreate(
            ['email' => 'chamodi@gmail.com'],
            [
                'name' => 'Chamodi',
                'password' => Hash::make('chamodi@123'),
                'role' => 'user',
            ]
        );

        User::firstOrCreate(
            ['email' => 'milan@gmail.com'],
            [
                'name' => 'Milan',
                'password' => Hash::make('milan@123'),
                'role' => 'user',
            ]
        );
    }
}
