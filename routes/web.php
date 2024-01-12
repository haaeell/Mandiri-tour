<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\GaleriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\PemesananController;
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
Route::get('/keluhan', [LandingpageController::class, 'keluhan'])->name('keluhan');
Route::post('/keluhan', [KeluhanController::class, 'store'])->name('keluhan.store');
Route::get('/paket', [LandingpageController::class, 'paketWisata'])->name('paketWisata');
Route::get('/paket/{slug}', [LandingpageController::class, 'detailPaket'])->name('detailPaket');



Auth::routes();
Route::group(['middleware' => 'admin'], function () {
    Route::resource('users', UserController::class);
    Route::post('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    Route::post('/users/batchDelete', [UserController::class, 'batchDelete'])->name('users.batchDelete');
    Route::get('/export-pdf', [UserController::class, 'exportToPDF']);
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

    Route::resource('kota', KotaController::class);
    Route::resource('wisata', WisataController::class);
    Route::resource('hotel', HotelController::class);
    Route::resource('bus', BusController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('paket-wisata', PaketWisataController::class);
    Route::resource('pemesanan', PemesananController::class);

    Route::get('/admin/keluhan', [KeluhanController::class, 'index'])->name('keluhan.index-admin');
    

Route::get('/keluhan/{id}/tanggapi', [KeluhanController::class, 'tanggapi'])->name('keluhan.tanggapi');
Route::post('/keluhan/{id}/tanggapi', [KeluhanController::class, 'prosesTanggapi'])->name('keluhan.proses-tanggapi');


    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
