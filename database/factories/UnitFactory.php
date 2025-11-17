<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\fasilitas;

class UnitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_unit' => 'Unit ' . $this->faker->unique()->numberBetween(1, 20),
            'deskripsi' => $this->faker->sentence(10),
            'harga' => $this->faker->numberBetween(100000, 500000),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($unit) {
            // Ambil 2–5 fasilitas random untuk tiap unit
            $facilityIds = fasilitas::inRandomOrder()->limit(rand(2, 5))->pluck('id_fasilitas');

            $unit->fasilitas()->sync($facilityIds);
        });
    }
}
