<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventFireController;
use App\Http\Controllers\GenericController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\SensorValueController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [GenericController::class, 'apiIndex'])->name('api.index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::get('/', [GenericController::class, 'apiStatusV1']);
    Route::post('devices/auth', [DeviceController::class, 'authenticateDevice']);
    Route::apiResources([
        'devices' => DeviceController::class,
        'sensors' => SensorController::class,
        'sensors.values' => SensorValueController::class,
        'events' => EventController::class,
    ]);
    // Route::post('sensors/{sensor}/values', [SensorValueController::class, 'store']);
    Route::post('events/{event}/fire', [EventFireController::class, 'store']);
});