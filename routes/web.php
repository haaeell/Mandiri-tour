<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\WisataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingpageController::class, 'index'])->name('welcome');

Auth::routes();
Route::group(['middleware' => 'admin'], function () {
    Route::resource('users', UserController::class);
    Route::post('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    Route::post('/users/batchDelete', [UserController::class, 'batchDelete'])->name('users.batchDelete');
    Route::get('/export-pdf', [UserController::class, 'exportToPDF']);

    Route::resource('kota', KotaController::class);
    Route::resource('wisata', WisataController::class);
    Route::resource('hotel', HotelController::class);




    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
