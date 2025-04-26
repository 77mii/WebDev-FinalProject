<?php

namespace Database\Factories;

use App\Models\StudentGroup;
use App\Models\Student;
use App\Models\StudentProject;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentGroupFactory extends Factory
{
    protected $model = StudentGroup::class;

    public function definition(): array
    {
        return [
            'groupname' => $this->faker->word(),
            // 'student_id' => Student::factory(),
            'sp_id' => StudentProject::factory(),
        ];
    }
}
