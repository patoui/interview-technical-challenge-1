<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Enums\ParkingSpotType;

final class ParkingSpotData
{
    public function __construct(
        public ParkingSpotType $type,
        public int $count = 1,
    ) {
    }
}