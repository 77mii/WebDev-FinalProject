<?php

namespace Database\Factories;

use App\Models\StudentProject;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentProjectFactory extends Factory
{
    protected $model = StudentProject::class;

    public function definition(): array
    {
        return [
            'sptitle' => $this->faker->word(),
            'sp_description' => $this->faker->paragraph(), // Random description
            'file_type' => $this->faker->fileExtension(),
            'project_id' => Project::factory(),
            'visibility' => $this->faker->boolean(80), // 80% chance to be visible (true), 20% not visible (false)
        ];
    }
}
