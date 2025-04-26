<?php

namespace Database\Factories;

use App\Models\ProjectImage;
use App\Models\StudentProject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectImageFactory extends Factory
{
    protected $model = ProjectImage::class;

    public function definition(): array
    {
        return [
            'sp_id' => StudentProject::factory(),
            // 'imageid' => $this->faker->uuid(),
            'imageurl' => $this->faker->imageUrl(640, 480, 'project', true, 'Image'),
            'description' => $this->faker->sentence(),
        ];
    }
}
