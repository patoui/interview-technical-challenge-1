<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParkingSpotRequest;
use App\Http\Requests\UpdateParkingSpotRequest;
use App\Http\Resources\ParkingSpotResource;
use App\Models\ParkingLot;
use App\Models\ParkingSpot;

class ParkingSpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ParkingSpotResource::collection(ParkingSpot::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParkingSpotRequest $request, ParkingLot $parkingLot)
    {
        // TODO: move business logic to action
        $alreadyParked = $parkingLot->spots()
            ->where('license_plate', $request->license_plate)
            ->exists();

        if ($alreadyParked) {
            // TODO: standardize error responses
            return response()->json([
                'message' => sprintf('Vehicle with license plate "%s" already parked', $request->license_plate),
            ], 422);
        }

        $vehicleType = $request->vehicleType();
        $parkingSpotData = $vehicleType->requiredSpots();

        $spots = $parkingLot->spots()
            ->where('type', $parkingSpotData->type)
            ->where('is_occupied', false)
            ->limit($parkingSpotData->count)
            ->get();

        if ($spots->count() < $parkingSpotData->count) {
            // TODO: standardize error responses
            return response()->json([
                'message' => sprintf('No available parking for vehicle type %s', $vehicleType),
            ], 422);
        }

        $spots->each->update([
            'vehicle_type' => $request->vehicle_type,
            'license_plate' => $request->license_plate,
            'is_occupied' => true,
        ]);

        return ParkingSpotResource::collection($spots);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParkingSpotRequest $request, ParkingLot $parkingLot)
    {
        $occupiedSpots = $parkingLot->spots()
            ->where('license_plate', $request->license_plate)
            ->get();

        if ($occupiedSpots->isEmpty()) {
            // TODO: standardize error responses
            return response()->json([
                'message' => sprintf('Vehicle with license plate "%s" not in parking lot.', $request->license_plate),
            ], 422);
        }

        $occupiedSpots->each
            ->update([
                'license_plate' => null,
                'vehicle_type' => null,
                'is_occupied' => false,
            ]);

        return response()->json([
            'license_plate' => $request->license_plate,
            'message' => "Successfully unparked vehicle: {$request->license_plate}",
        ]);
    }
}
