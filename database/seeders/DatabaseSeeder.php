<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail',
            'password' => Hash::make('12345678'), // Set a secure password
            'level' => 'admin', // Set the role as admin
        ]);

        // Optionally, create a regular user for testing
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'), // Set a secure password
            'level' => 'user', // Set the role as user
        ]);
    }
}
