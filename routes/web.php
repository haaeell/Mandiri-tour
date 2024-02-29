<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\EmailController;
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
use App\Http\Controllers\TestingController;
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

Route::get('/paket', [LandingpageController::class, 'paketWisata'])->name('paketWisata');


Route::get('/login/google',[LoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback',[LoginController::class, 'handleGoogleCallback']);
Route::get('/paket/{slug}', [LandingpageController::class, 'detailPaket'])->name('detailPaket');


Route::get('/testing', [TestingController::class,'index']);
Route::post('/kabisat', [TestingController::class, 'checkTahunKabisat'])->name('kabisat');





Route::middleware(['auth'])->group(function () {
    Route::post('/pesan-paket', [PemesananController::class, 'pesanPaket'])->name('pesanPaket');
    Route::get('/pemesanan/invoice/{id}', [PemesananController::class, 'invoice'])->name('pemesanan.invoice');
    Route::post('/pemesanan/upload/{id}', [PemesananController::class, 'uploadBukti'])->name('pemesanan.upload');
    Route::post('/pemesanan/{id}/cancel', [PemesananController::class, 'cancel'])->name('pemesanan.cancel');

    Route::get('/keluhan', [LandingpageController::class, 'keluhan'])->name('keluhan');
    Route::get('/riwayat-pesanan', [LandingpageController::class, 'riwayatPesanan'])->name('riwayatPesanan');
    Route::post('/keluhan', [KeluhanController::class, 'store'])->name('keluhan.store');

    Route::get('/Detailpaket/form/{slug}', [LandingpageController::class, 'detailPaketForm'])->name('detailPaketForm');
    
});


Auth::routes();
Route::group(['middleware' => 'admin'], function () {
    Route::resource('users', UserController::class);
    Route::post('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    Route::post('/users/batchDelete', [UserController::class, 'batchDelete'])->name('users.batchDelete');
    Route::get('/export-pdf', [UserController::class, 'exportToPDF']);
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/home/{status}', [HomeController::class, 'getUsersByStatus']);
    Route::resource('kota', KotaController::class);
    Route::resource('wisata', WisataController::class);
    Route::resource('hotel', HotelController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('paket-wisata', PaketWisataController::class);
    Route::resource('pemesanan', PemesananController::class);
    Route::resource('emails', EmailController::class);

    Route::get('/admin/keluhan', [KeluhanController::class, 'index'])->name('keluhan.index-admin');
    

    Route::get('/keluhan/{id}/tanggapi', [KeluhanController::class, 'tanggapi'])->name('keluhan.tanggapi');
    Route::post('/keluhan/{id}/tanggapi', [KeluhanController::class, 'prosesTanggapi'])->name('keluhan.proses-tanggapi');

    Route::post('/admin/pemesanan/{id}/konfirmasi', [PemesananController::class, 'konfirmasiPembayaran'])->name('admin.pemesanan.konfirmasi');
    Route::get('/email', [EmailController::class, 'index'])->name('email.index');
    Route::get('/email/send/{id}', [EmailController::class, 'sendEmail'])->name('email.send');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    
    Route::get('/pemesanan-baru', [PemesananController::class, 'pemesananBaru'])->name('pemesanan.pemesanan-baru');
    Route::get('/menunggu-konfirmasi', [PemesananController::class, 'menungguKonfirmasi'])->name('pemesanan.menunggu-konfirmasi');
    Route::get('/pesanan-dibatalkan', [PemesananController::class, 'pesananDibatalkan'])->name('pemesanan.pesanan-dibatalkan');
    Route::get('/pesanan-diterima', [PemesananController::class, 'pesananDiterima'])->name('pemesanan.pesanan-diterima');

    
});
