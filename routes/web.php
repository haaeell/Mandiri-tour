<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\GaleriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\RundownController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\KategoriController;

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
Route::get('/landingpage/wisata', [LandingpageController::class, 'wisata'])->name('landingpage.wisata');
Route::get('/about', [LandingpageController::class, 'about'])->name('about');
Route::get('/fetch-wisata', [LandingpageController::class, 'fetchWisata'])->name('fetch.wisata');
Route::get('/fetch-kota', [LandingpageController::class, 'fetchKota'])->name('fetch.kota');



Route::get('/login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/paket/{slug}', [LandingpageController::class, 'detailPaket'])->name('detailPaket');


Route::get('/testing', [TestingController::class, 'index']);
Route::post('/kabisat', [TestingController::class, 'checkTahunKabisat'])->name('kabisat');
Route::get('/rundown/{id}', [RundownController::class, 'generatePdf'])->name('rundown.generatePdf');





Route::middleware(['auth','verified'])->group(function () {
    Route::post('/pesan-paket', [PemesananController::class, 'pesanPaket'])->name('pesanPaket');
    Route::get('/pemesanan/invoice/{id}', [PemesananController::class, 'invoice'])->name('pemesanan.invoice');
    Route::post('/pemesanan/upload/{id}', [PemesananController::class, 'uploadBukti'])->name('pemesanan.upload');
    Route::post('/pemesanan/{id}/cancel', [PemesananController::class, 'cancel'])->name('pemesanan.cancel');

    Route::get('/keluhan', [LandingpageController::class, 'keluhan'])->name('keluhan');
    Route::get('/riwayat-pesanan', [LandingpageController::class, 'riwayatPesanan'])->name('riwayatPesanan');
    Route::post('/keluhan', [KeluhanController::class, 'store'])->name('keluhan.store');

    Route::get('/Detailpaket/form/{slug}', [LandingpageController::class, 'detailPaketForm'])->name('detailPaketForm');

    Route::get('/cetak-invoice/{id}', [PemesananController::class, 'cetakInvoice'])->name('cetak.invoice');
});

Route::middleware(['auth', 'check.user.profile'])->group(function () {
    Route::get('/profilEdit/{id}', [LandingpageController::class, 'editProfil'])->name('customer.edit-profil');
    Route::get('/editPassword/{id}', [LandingpageController::class, 'editPassword'])->name('customer.edit-password');
    Route::put('/profilUpdate/{id}', [LandingpageController::class, 'updateProfil'])->name('customer.update-profil');
    Route::put('/profilEdit/password/{id}', [LandingpageController::class, 'updatePassword'])->name('customer.update-password');
    Route::put('/hapus-gambar-profil', [LandingpageController::class, 'hapusGambarProfil'])->name('hapus-gambar-profil');
});



Auth::routes(['verify' => true]);
Route::get('/email/verify', function () {

    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $r) {
    $r->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $r) {

    $r->user()->sendEmailVerificationNotification();

    return back()->with('resent', 'Verification link sent ');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

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

    Route::get('/admin/rundown/{id}', [RundownController::class, 'create'])->name('rundown.add');
    Route::post('/tambah-rundown', [RundownController::class, 'store'])->name('rundown.store');
    Route::get('/edit-rundown/{id}', [RundownController::class, 'edit'])->name('rundown.edit');
    Route::put('/update-rundown/{id}', [RundownController::class, 'updateRundown'])->name('rundown.updateRundown');
    Route::delete('/delete-all/{id}',  [RundownController::class, 'deleteAll'])->name('rundown.deleteAll');
    Route::delete('/rundown/delete-activity', [RundownController::class, 'deleteActivity'])->name('rundown.deleteActivity');


    Route::get('/admin/keluhan', [KeluhanController::class, 'index'])->name('keluhan.index-admin');

    Route::get('/keluhan/{id}/tanggapi', [KeluhanController::class, 'tanggapi'])->name('keluhan.tanggapi');
    Route::post('/keluhan/{id}/tanggapi', [KeluhanController::class, 'prosesTanggapi'])->name('keluhan.proses-tanggapi');

    Route::post('/admin/pemesanan/{id}/konfirmasi', [PemesananController::class, 'konfirmasiPembayaran'])->name('admin.pemesanan.konfirmasi');
    Route::post('/admin/pemesanan/{id}/tolak', [PemesananController::class, 'tolakPembayaran'])->name('admin.pemesanan.tolak');
    Route::get('/email', [EmailController::class, 'index'])->name('email.index');
    Route::get('/email/send/{id}', [EmailController::class, 'sendEmail'])->name('email.send');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::get('/laporan/data', [LaporanController::class, 'data'])->name('laporan.data');

    Route::get('/pemesanan-baru', [PemesananController::class, 'pemesananBaru'])->name('pemesanan.pemesanan-baru');
    Route::get('/menunggu-konfirmasi', [PemesananController::class, 'menungguKonfirmasi'])->name('pemesanan.menunggu-konfirmasi');
    Route::get('/pesanan-dibatalkan', [PemesananController::class, 'pesananDibatalkan'])->name('pemesanan.pesanan-dibatalkan');
    Route::get('/pesanan-diterima', [PemesananController::class, 'pesananDiterima'])->name('pemesanan.pesanan-diterima');

    Route::resource('kategori', KategoriController::class);
});
