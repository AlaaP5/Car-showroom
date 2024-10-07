<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TripController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// 'throttle:60,1' =>  rate-limit requests from a particular IP,prevents DDOS attacks
Route::middleware('auth:api','throttle:60,1')->group(function () {

    Route::post('verification', [AuthController::class, 'verification']);

    Route::get('trip/index', [TripController::class, 'indexOfTrip']);
    Route::get('destination/index', [DestinationController::class, 'indexOfDestination']);


    Route::middleware('check_Admin')->group(function () {

        Route::prefix('destination')->group(function () {
            Route::post('create', [DestinationController::class, 'createDestination']);
            Route::get('show/{id}', [DestinationController::class, 'showDestination']);
            Route::post('update', [DestinationController::class, 'updateDestination']);
            Route::delete('destroy/{id}', [DestinationController::class, 'destroyDestination']);
            Route::get('trips/{id}',[DestinationController::class, 'tripsOfDestination']);
        });

        Route::prefix('trip')->group(function () {
            Route::post('create', [TripController::class, 'createTrip']);
            Route::get('show/{id}', [TripController::class, 'showTrip']);
            Route::post('update', [TripController::class, 'updateTrip']);
            Route::delete('destroy/{id}', [TripController::class, 'destroyTrip']);
        });
    });

    Route::middleware('check_User')->group(function () {

        Route::prefix('booking')->group(function () {
            Route::post('create', [BookingController::class, 'createBooking']);
            Route::delete('destroy/{id}', [BookingController::class, 'destroyBooking']);
        });

    });

    Route::get('logout', [AuthController::class, 'logout']);
});
