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
            'namaprodi' => implode(' ', $this->faker->words($this->faker->numberBetween(1, 2))),
            'description' => $this->faker->paragraph(),
            'smallimage' => 'https://picsum.photos/seed/' . uniqid('mks_') . '/200/200',
            'longimage' => 'https://picsum.photos/seed/' . uniqid('mkl_') . '/400/200',
        ];
    }
}
