<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\MovieController;
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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('bookings', [BookingController::class, 'index']);
    Route::post('bookings/store', [BookingController::class, 'store']);
    Route::post('bookings/cancel', [BookingController::class, 'cancelBooking']);
});

Route::get('movies/bookings/{id}/create', [MovieController::class, 'getMovieForBooking']);
Route::get('movie-plays', [CinemaController::class, 'index']);
Route::get('movies/{movie_id}/plays', [MoviePlayController::class, 'getPlayTimesForMovie']);

