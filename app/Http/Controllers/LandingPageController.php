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
        // dd($paketwisata);
        
        return view('landingpage.welcome', compact('paketwisata'));

    }
    public function keluhan()
{
    // Dapatkan keluhan yang belum dibaca oleh pengguna
    $unreadNotifications = Auth::user()->unreadNotifications;

    foreach ($unreadNotifications as $notification) {
        // Cek apakah notifikasi terkait dengan keluhan yang sudah ditanggapi
        if ($notification->type === 'App\Notifications\KeluhanDitanggapiNotification') {
            $notificationData = $notification->data;

            $notification->markAsRead();
        }
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
        $unreadNotifications = Auth::user()->unreadNotifications;

        foreach ($unreadNotifications as $notification) {
            // Cek apakah notifikasi terkait dengan keluhan yang sudah ditanggapi
            if ($notification->type === 'App\Notifications\KonfirmasiPembayaran') {
                $notificationData = $notification->data;
    
                $notification->markAsRead();
            }
        }
        
        $riwayatPesanan = Pemesanan::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        
        return view('landingpage.pemesanan.riwayatPesanan', compact('riwayatPesanan'));

    }
    
}
