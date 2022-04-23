<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MoviePlayController;
use App\Http\Controllers\Api\BookingController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   / return $request->user();
//});

Route::get('movie-plays', [MoviePlayController::class, 'index']);
Route::get('bookings/create', [BookingController::class, 'create']);
Route::get('bookings', [BookingController::class, 'index']);
Route::post('bookings/store', [BookingController::class, 'store']);
