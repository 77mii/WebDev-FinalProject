<?php

namespace Database\Factories;

use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

class MataKuliahFactory extends Factory
{
    protected $model = MataKuliah::class;

    public function definition(): array
    {
        return [
            'namamk' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'smallimage' => $this->faker->imageUrl(200, 200, 'abstract', true, 'Small Image'),
            'longimage' => $this->faker->imageUrl(400, 200, 'abstract', true, 'Long Image'),
        ];
    }
}
