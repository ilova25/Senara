<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Informasi>
 */
class InformasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function informasi1() 
    { 
        return $this->state([ 
            'alamat' => 'Jl. Brigjen Katamso no. 6, Gedog, Kota Blitar',
            'no_hp' => '082131459670',
            'email' => 'Manembahblitarfamilyhomestay@gmail.com'
        ]); 
    } 
}
