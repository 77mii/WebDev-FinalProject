<?php

namespace Database\Factories;

use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class LecturerFactory extends Factory
{
    protected $model = Lecturer::class;

    public function definition(): array
    {
        return [
            'lecturername' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Example hashed password
            'pfp' => $this->faker->imageUrl(100, 100, 'people', true, 'Lecturer'), // Random profile image
            'employeenumber' => $this->faker->unique()->numberBetween(1000, 9999),
        ];
    }
}
