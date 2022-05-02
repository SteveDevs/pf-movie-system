<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\MoviePlayController;

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
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings');
    Route::post('bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('bookings/cancel', [BookingController::class, 'cancelBooking'])->name('bookings.cancel');
});

Route::get('movie-plays', [CinemaController::class, 'index'])->name('movie-plays');
Route::get('movies/{movie_id}/plays', [MoviePlayController::class, 'getPlayTimesForMovie'])->name('movies.plays');


