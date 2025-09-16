<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_unit' => $this->faker->word(),
            'gambar' => $this->faker->imageUrl(),
            'deskripsi' => $this->faker->paragraph(),
            'harga' => $this->faker->numberBetween(100000, 1000000),
            'available' => $this->faker->randomElement(['yes', 'no']),
        ];
    }
}
