<?php

use App\Http\Controllers\ParkingLotController;
use App\Http\Controllers\ParkingSpotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/parking-lots', [ParkingLotController::class, 'index']);
Route::get('/parking-lots/{parking_lot}', [ParkingLotController::class, 'show']);

Route::get('/parking-lots/{parking_lot}/parking-spots', [ParkingSpotController::class, 'index']);
Route::post('/parking-lots/{parking_lot}/parking-spots', [ParkingSpotController::class, 'store']);
Route::patch('/parking-lots/{parking_lot}/parking-spots', [ParkingSpotController::class, 'update']);
