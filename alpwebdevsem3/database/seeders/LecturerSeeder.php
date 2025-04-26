<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use App\Models\LecturerMK;
use App\Models\MataKuliah;
use App\Models\Project;
use App\Models\StudentProject;
use App\Models\StudentGroup;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 lecturers
        Lecturer::factory(10)->create()->each(function ($lecturer) {
            // Create 8 LecturerMKs (4 Ongoing, 4 Finished) for each lecturer
            for ($i = 0; $i < 8; $i++) {
                $status = $i < 4 ? 'Ongoing' : 'Finished'; // First 4 are Ongoing, last 4 are Finished

                $lecturerMK = LecturerMK::factory()
                    ->state([
                        'lmk_status' => $status,
                        'lecturer_id' => $lecturer->id, // Link to the lecturer
                    ])
                    ->for(MataKuliah::factory(), 'mataKuliah') // Create and link a MataKuliah
                    ->create();

                // Create 4 Projects for each LecturerMK
                Project::factory(4)->create(['lmk_id' => $lecturerMK->id])->each(function ($project) {
                    // Create 3 StudentProjects for each Project
                    StudentProject::factory(3)->create(['project_id' => $project->id])->each(function ($studentProject) {
                        // Create a StudentGroup for each StudentProject
                        $studentGroup = StudentGroup::factory()->create(['sp_id' => $studentProject->id]);

                        // Attach 1-4 students to the group
                        $students = \App\Models\Student::inRandomOrder()->take(rand(1, 4))->pluck('id');
                        $studentGroup->students()->sync($students);

                        // Add 3 images to the StudentProject
                        ProjectImage::factory(3)->create(['sp_id' => $studentProject->id]);
                    });
                });
            }
        });
    }
}


// namespace Database\Seeders;

// use App\Models\Lecturer;
// use App\Models\LecturerMK;
// use App\Models\MataKuliah;
// use App\Models\Project;
// use App\Models\StudentProject;
// use App\Models\StudentGroup;
// use App\Models\ProjectImage;
// use Illuminate\Database\Seeder;

// class LecturerSeeder extends Seeder
// {
//     public function run(): void
//     {
//         Lecturer::factory(10) // Create 10 lecturers
//             ->has(
//                 LecturerMK::factory(4) // Each lecturer has 4 LecturerMKs
//                     ->state(function (array $attributes, Lecturer $lecturer) {
//                         static $counter = 0;
//                         $status = ($counter++ % 4 < 2) ? 'Ongoing' : 'Finished'; // 2 Ongoing, 2 Finished
//                         return ['lmk_status' => $status];
//                     })
//                     ->for(MataKuliah::factory(), 'mataKuliah') // Associate MataKuliah
//                     ->has(
//                         Project::factory(4) // Each LecturerMK has 4 Projects
//                             ->has(
//                                 StudentProject::factory(3) // Each Project has 3 StudentProjects
//                                     ->afterCreating(function (StudentProject $studentProject) {
//                                         // Create a StudentGroup and link to StudentProject
//                                         StudentGroup::factory()
//                                             ->create(['sp_id' => $studentProject->id]);

//                                         // Add images to StudentProject
//                                         ProjectImage::factory(3)->create(['sp_id' => $studentProject->id]);
//                                     })
//                             )
//                     )
//             )
//             ->create();
//     }
// }



// namespace Database\Seeders;

// use App\Models\Lecturer;
// use App\Models\LecturerMK;
// use App\Models\MataKuliah;
// use App\Models\Project;
// use Illuminate\Database\Seeder;

// class LecturerSeeder extends Seeder
// {
//     public function run(): void
//     {
//         Lecturer::factory(10) // 10 lecturers
//             ->has(
//                 LecturerMK::factory(3) // Each lecturer has 3 LecturerMKs
//                     ->for(MataKuliah::factory()->state(function () {
//                         return ['namamk' => fake()->unique()->word()];
//                     }), 'mataKuliah') // Associate MataKuliah
//                     ->has(
//                         Project::factory(4) // Each LecturerMK has 4 Projects
//                     )
//             )
//             ->create();
//     }
// }
