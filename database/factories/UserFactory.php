<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // database/factories/adminFactory.php

            'username' => $this->faker->unique()->userName,
            'nama' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => Hash::make('123'),
            'role' => 'tamu',
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->phoneNumber(),
        ];
    }

    public function dataadmin1() 
    { 
        return $this->state([ 
            'username' => 'owner', 
            'nama' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('owner'), 
            'role' => 'owner', 
            'alamat' => 'Jl. Surabaya', 
            'no_hp' => '1234567890', 
        ]); 
    } 

    public function dataadmin2() 
    { 
        return $this->state([ 
            'username' => 'resepsionis', 
            'nama' => 'Resepsionis',
            'email' => 'resepsionis@gmail.com',
            'password' => Hash::make('resepsionis'), 
            'role' => 'resepsionis',
            'alamat' => 'Jl. Jakarta', 
            'no_hp' => '1234567890',  
        ]); 
    }

    public function dataadmin3() 
    { 
        return $this->state([ 
            'username' => 'tamu', 
            'nama' => 'Tamu',
            'email' => 'tamu@gmail.com',
            'password' => Hash::make('tamu'), 
            'role' => 'tamu',
            'alamat' => 'Jl. Bandung', 
            'no_hp' => '1234567890',  
        ]); 
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
