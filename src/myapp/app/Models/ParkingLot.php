<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParkingLot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = ['is_occupied' => 'boolean'];

    public function spots(): HasMany
    {
        return $this->hasMany(ParkingSpot::class);
    }
}
