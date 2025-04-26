<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\StudentProject;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::factory(20) // 20 projects
            ->has(
                StudentProject::factory(3) // Each project has 3 StudentProjects
                    ->has(ProjectImage::factory(3)) // Each StudentProject has 2 images
            )
            ->create();
    }
}
