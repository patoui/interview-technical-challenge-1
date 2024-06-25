<?php

namespace App\Enums;

use App\DataTransferObjects\ParkingSpotData;

enum VehicleType: int
{
    case MOTORCYCLE = 1;
    case CAR = 2;
    case VAN = 3;

    public function requiredSpots(): ParkingSpotData
    {
        return match ($this) {
            VehicleType::MOTORCYCLE => new ParkingSpotData(ParkingSpotType::SMALL),
            VehicleType::CAR => new ParkingSpotData(ParkingSpotType::REGULAR),
            VehicleType::VAN => new ParkingSpotData(ParkingSpotType::REGULAR, 3),
        };
    }
}