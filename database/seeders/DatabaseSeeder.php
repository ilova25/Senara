<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\fasilitas;
use App\Models\unit;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        User::factory()->dataadmin1()->create();
        User::factory()->dataadmin2()->create();
        User::factory()->dataadmin3()->create();
        fasilitas::factory()->count(10)->create();
        unit::factory()->count(5)->create();


    }
}
