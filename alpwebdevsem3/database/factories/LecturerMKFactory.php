<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\MataKuliah;
use App\Models\LecturerMK;
use Illuminate\Database\Eloquent\Factories\Factory;

class LecturerMKFactory extends Factory
{
    protected $model = LecturerMK::class;

    public function definition(): array
    {
        return [
            'lecturer_id' => Lecturer::factory(),
            'mk_id' => MataKuliah::factory(),
            'tahun' => $this->faker->year(),
            'semester' => (string) $this->faker->numberBetween(1, 8), // Random semester between 1 and 8 as a string
            'lmk_status' => $this->faker->randomElement(['Ongoing', 'Finished']), // Random status
            'lmk_image' => $this->faker->imageUrl(),  // Generate a random image URL
            'additional_lecturers' => $this->faker->name(),
            'visibility' => true, // Set visibility to true by default
        ];
    }
}
