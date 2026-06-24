<?php

namespace Database\Factories;

use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

class MataKuliahFactory extends Factory
{
    protected $model = MataKuliah::class;

    // Use static properties to load the file into memory only once
    protected static $csvData = null;
    protected static $currentIndex = 0;

    public function definition(): array
    {
        // 1. Load the CSV if it hasn't been loaded yet
        if (self::$csvData === null) {
            $path = database_path('majors.csv');
            self::$csvData = array_map('str_getcsv', file($path));

            // Remove the header row (FOD1P,Major,Major_Category)
            array_shift(self::$csvData);
        }

        // 2. Fetch the current row and increment the index.
        // The modulo operator (%) ensures it loops back to the start if you seed more rows than exist in the CSV.
        $row = self::$csvData[self::$currentIndex % count(self::$csvData)];
        self::$currentIndex++;

        // 3. Map the CSV array indexes to your database columns
        // $row[0] = FOD1P, $row[1] = Major, $row[2] = Major_Category
        return [
            // Title-casing the Major name so "GENERAL AGRICULTURE" becomes "General Agriculture"
            'namamk' => ucwords(strtolower($row[1])),

            'namaprodi' => $row[2],

            // Appending the Faker paragraph so your layout still has enough text to test UI wrapping
            'description' => 'FOD1P Code: ' . $row[0] . '. ' . $this->faker->paragraph(),

            // Keeping the dynamic placeholder images
            'smallimage' => 'https://picsum.photos/seed/' . uniqid('mks_') . '/200/200',
            'longimage' => 'https://picsum.photos/seed/' . uniqid('mkl_') . '/400/200',
        ];
    }
}
