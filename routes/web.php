<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hotels', [HotelController::class, 'index'])->name('all_hotels');
Route::post('/hotels', [HotelController::class, 'store'])->name('add_hotel');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('show_hotel');
Route::patch('/hotels/{hotel}', [HotelController::class, 'update'])->name('update_hotel');
Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy'])->name('delete_hotel');



Route::get('/users', [UserController::class, 'index'])->name('all_users');
Route::post('/users', [UserController::class, 'store'])->name('add_users');
