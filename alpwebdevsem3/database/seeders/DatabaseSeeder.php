<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run individual seeders
        $this->call([
            AdminSeeder::class,
            StudentSeeder::class,        // Create students first
            LecturerSeeder::class,       // Create lecturers, LecturerMKs, Projects, and associated data
            StudentGroupSeeder::class,   // Attach students to StudentGroups
         //   ProjectSeeder::class,
      //      StudentGroupSeeder::class,
        ]);
    }
}
