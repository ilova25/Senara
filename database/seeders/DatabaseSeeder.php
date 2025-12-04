<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\booking;
use App\Models\fasilitas;
use App\Models\informasi;
use App\Models\masukan;
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
        User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        User::factory()->dataadmin1()->create();
        User::factory()->dataadmin2()->create();
        User::factory()->dataadmin3()->create();

        informasi::factory()->informasi1()->create();

        $fasilitasList = fasilitas::factory()->count(10)->create();
        
        $units = collect([
            unit::factory()->unit1()->create(),
            unit::factory()->unit2()->create(),
            unit::factory()->unit3()->create(),
            unit::factory()->unit4()->create(),
        ]);

        $allFacilityIds = fasilitas::pluck('id_fasilitas');

        $units->each(function ($unit) use ($allFacilityIds) {
            $randomIds = $allFacilityIds->random(rand(2, 5))->toArray();
            $unit->fasilitas()->sync($randomIds);
        });

        $allUsers = User::all();
        $allUnits = unit::all();
        booking::factory()->count(10)->make()->each(function ($booking) use ($allUsers, $allUnits) {
            $booking->id_user = $allUsers->random()->id;        // sesuaikan nama kolom
            $booking->id_unit = $allUnits->random()->id_unit;   // sesuaikan PK unit
            $booking->save();
        });

        $completedBookings = booking::factory()
        ->count(5)
        ->completed()
        ->make()
        ->each(function ($booking) use ($allUsers, $allUnits) {
            $booking->id_user = $allUsers->random()->id;
            $booking->id_unit = $allUnits->random()->id_unit;
            $booking->save();
        });

        foreach ($completedBookings as $booking) {
            masukan::factory()->create([
                'booking_id' => $booking->id,
                'user_id' => $booking->id_user,
            ]);
        }
    }
}
