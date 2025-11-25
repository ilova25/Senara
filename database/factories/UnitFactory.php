<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\fasilitas;

class UnitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_unit' => 'Unit ' . $this->faker->numberBetween(1, 10),
            'gambar' => 'fasilitas/default.jpg',
            'deskripsi' => $this->faker->sentence(10),
            'harga' => $this->faker->numberBetween(100000, 500000),
        ];
    }
}
