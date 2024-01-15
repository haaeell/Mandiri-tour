<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\PaketWisata;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    public function index()
    {
        $paketwisata = PaketWisata::all();
        
        return view('landingpage.welcome', compact('paketwisata'));

    }
    public function keluhan()
{
    // Dapatkan keluhan yang belum dibaca oleh pengguna
    $unreadNotifications = Auth::user()->unreadNotifications;

    // Tandai notifikasi terkait dengan keluhan sebagai sudah dibaca
    foreach ($unreadNotifications as $notification) {
        $keluhanId = $notification->data['keluhan_id'];
        // Lakukan sesuai kebutuhan, misalnya tandai sebagai sudah dibaca atau hapus notifikasi
        // Sesuaikan dengan logika aplikasi Anda
        // ...

        // Contoh tandai sebagai sudah dibaca
        $notification->markAsRead();
    }

    // Dapatkan riwayat keluhan untuk ditampilkan di halaman
    $riwayatKeluhan = Keluhan::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
    
    return view('landingpage.keluhan', compact('riwayatKeluhan'));
}


    public function paketWisata()
    {
        $paketWisata = PaketWisata::all();
        
        return view('landingpage.paketwisata', compact('paketWisata'));

    }
    public function detailPaket($slug)
    {
        $paketWisata = PaketWisata::where('slug', $slug)->firstOrFail();
        return view('landingpage.detailPaket', compact('paketWisata'));
    }
    public function riwayatPesanan()
    {
        $riwayatPesanan = Pemesanan::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        
        return view('landingpage.pemesanan.riwayatPesanan', compact('riwayatPesanan'));

    }
    
}
