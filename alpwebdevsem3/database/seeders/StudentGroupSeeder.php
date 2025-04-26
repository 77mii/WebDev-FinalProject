<?php

namespace Database\Seeders;

use App\Models\StudentGroup;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentGroupSeeder extends Seeder
{
    public function run(): void
    {
        StudentGroup::all()->each(function ($group) {
            // Attach 1 to 4 students to each group
            $students = Student::inRandomOrder()->take(rand(1, 4))->pluck('id');
            $group->students()->sync($students); // Link via pivot table
        });
    }
}


// namespace Database\Seeders;

// use App\Models\StudentGroup;
// use App\Models\Student;
// use App\Models\StudentProject;
// use Illuminate\Database\Seeder;

// class StudentGroupSeeder extends Seeder
// {
//     public function run(): void
//     {
//         $studentProjects = StudentProject::all();

//         foreach ($studentProjects as $project) {
//             // Create 1 to 5 groups for each student project
//             $groups = StudentGroup::factory(rand(1, 5))->create([
//                 'sp_id' => $project->id, // Associate with the current StudentProject
//             ]);

//             $groups->each(function ($group) {
//                 // Attach 1 to 4 random students to each group
//                 $students = Student::inRandomOrder()->take(rand(1, 4))->pluck('id');
//                 $group->students()->sync($students); // Attach students via the pivot table
//             });
//         }
//     }
// }
