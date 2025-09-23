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
        // daftar gambar yang sudah kamu taruh di storage/app/public/unit
        $images = [
            'unit 1.jpg',
            'unit 2.jpg',
            'unit 3.jpg',
        ];

        return [
            'nama_unit' => $this->faker->words(2, true),
            'deskripsi' => $this->faker->sentence(10),
            'harga' => $this->faker->numberBetween(100000, 1000000),
            'available' => $this->faker->numberBetween(1, 6),
            'gambar' => $this->faker->randomElement($images), // simpan path di DB
        ];
    }

}
