<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParkingLotResource;
use App\Models\ParkingLot;

class ParkingLotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ParkingLotResource::collection(ParkingLot::paginate());
    }

    /**
     * Display the specified resource.
     */
    public function show(ParkingLot $parkingLot)
    {
        return new ParkingLotResource($parkingLot);
    }
}
