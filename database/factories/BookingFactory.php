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
        return [
            'id_user' => User::factory(),
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'checkin' => $this->faker->dateTimeBetween('+1 days', '+1 month')->format('Y-m-d'),
            'checkout' => $this->faker->dateTimeBetween('+2 days', '+2 months')->format('Y-m-d'),
            'id_unit' => unit::factory(),
            'total_harga' => $this->faker->numberBetween(500000, 5000000),
            'adult' => $this->faker->numberBetween(1, 4),
            'children' => $this->faker->numberBetween(0, 3),
            'kode_booking' => strtoupper($this->faker->bothify('????-########')),
            'status_menginap' => $this->faker->randomElement(['booked','ongoing','completed','canceled']),
        ];
    }
}
