<?php

namespace Database\Factories;

use App\Models\unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkin = $this->faker->dateTimeBetween('-1 month','now');
        $checkout = (clone $checkin)->modify('+'.rand(1,14).' days');

        return [
            'id_user' => null,
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'checkin' => $checkin->format('Y-m-d H:i:s'),
            'checkout' => $checkout->format('Y-m-d H:i:s'),
            'id_unit' => null,
            'total_harga' => $this->faker->numberBetween(500000, 5000000),
            'adult' => $this->faker->numberBetween(1, 4),
            'children' => $this->faker->numberBetween(0, 3),
            'kode_booking' => strtoupper($this->faker->bothify('????-########')),
            'status' => $this->faker->randomElement(['ongoing','completed','pending']),
        ];
        
    }

    public function completed(): static
    {
        return $this->state(fn () => [ 
            'status' => 'completed',
        ]);
    }
}
