<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'studentname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            //'password' => Str::random(8), // Generate a random string of 8 characters
            'password' => bcrypt('password'),
            'pfp' => $this->faker->imageUrl(100, 100, 'people', true, 'Student'),
            'nim' => $this->faker->unique()->numberBetween(100000, 999999),
        ];
    }
}
