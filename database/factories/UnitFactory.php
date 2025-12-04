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

    public function unit1() 
    { 
        return $this->state([ 
            'nama_unit' => 'Unit 1',
            'gambar' => 'unit/unit 1.jpeg',
            'deskripsi' => 'Unit homestay yang rapi, nyaman, dan tertata dengan baik, dilengkapi fasilitas yang mendukung kenyamanan tamu selama menginap.',
            'harga' => 350000
        ]); 
    } 

    public function unit2() 
    { 
        return $this->state([ 
            'nama_unit' => 'Unit 2',
            'gambar' => 'unit/unit 2.jpeg',
            'deskripsi' => 'Unit homestay yang rapi, nyaman, dan tertata dengan baik, dilengkapi fasilitas yang mendukung kenyamanan tamu selama menginap.',
            'harga' => 350000
        ]); 
    } 

    public function unit3() 
    { 
        return $this->state([ 
            'nama_unit' => 'Unit 3',
            'gambar' => 'unit/unit 3.jpeg',
            'deskripsi' => 'Unit homestay yang rapi, nyaman, dan tertata dengan baik, dilengkapi fasilitas yang mendukung kenyamanan tamu selama menginap.',
            'harga' => 450000
        ]); 
    } 

    public function unit4() 
    { 
        return $this->state([ 
            'nama_unit' => 'Unit Villa Kelarisan Blitar',
            'gambar' => 'unit/unit4.jpg',
            'deskripsi' => 'Unit homestay yang rapi, nyaman, dan tertata dengan baik, dilengkapi fasilitas yang mendukung kenyamanan tamu selama menginap.',
            'harga' => 350000
        ]); 
    } 
}
