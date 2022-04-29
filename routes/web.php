<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('login', [
    AuthenticatedSessionController::class, 'store']);
Route::post('logout', [
    AuthenticatedSessionController::class, 'destroy']);
Route::post('register', [
    RegisteredUserController::class, 'store']);


Route::view('/{any?}', 'dashboard')
    ->name('dashboard')
    ->where('any', '.*');


