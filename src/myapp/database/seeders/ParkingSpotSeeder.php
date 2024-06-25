<?php

namespace Database\Seeders;

use App\Enums\ParkingSpotType;
use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parkingLot = ParkingLot::first();

        ParkingSpot::factory()->count(20)->create([
            'parking_lot_id' => $parkingLot->id,
            'type' => ParkingSpotType::SMALL,
        ]);

        ParkingSpot::factory()->count(80)->create([
            'parking_lot_id' => $parkingLot->id,
            'type' => ParkingSpotType::REGULAR,
        ]);
    }
}
