<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default admin
        Admin::create([
            'username' => 'adminuser',
            'email' => 'admin@example.com',
            'password' => Hash::make('securepassword'), // Replace with a strong password
        ]);

        // Optionally, create additional admins using the factory
        // Admin::factory()->count(5)->create();
    }
}
