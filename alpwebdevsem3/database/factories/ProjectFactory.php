<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\LecturerMK;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'projectname' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['Ongoing', 'Finished']),
            'type' => $this->faker->randomElement(['AFL1', 'AFL2', 'AFL3', 'ALP']),
            'projectimage' => $this->faker->imageUrl(400, 300, 'project', true, 'Project'),
            'lmk_id' => LecturerMK::factory(),
            'visibility' => true, // Set visibility to true by default
        ];
    }
}
