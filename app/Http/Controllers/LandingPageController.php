<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Keluhan;
use App\Models\Kendaraan;
use App\Models\Pemesanan;
use App\Models\PaketWisata;
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


public function paketWisata(Request $request)
{
    $search = $request->keyword;
    $min_price = $request->min_price;
    $max_price = $request->max_price;
    $city_id = $request->city;
    $kendaraan_id = $request->kendaraan;

    $query = PaketWisata::query();

    if (!empty($search)) {
        $query->where('nama', 'LIKE', '%' . $search . '%');
    }

    if (!empty($min_price)) {
        $query->where('harga', '>=', $min_price);
    }

    if (!empty($max_price)) {
        $query->where('harga', '<=', $max_price);
    }

    if (!empty($city_id)) {
        $query->whereHas('kotas', function ($q) use ($city_id) {
            $q->where('kota_id', $city_id);
        });
    }

    if (!empty($kendaraan_id)) {
        $query->whereHas('kendaraan', function ($q) use ($kendaraan_id) {
            $q->where('kendaraan_id', $kendaraan_id);
        });
    }

    $paketWisata = $query->get();
    
    $kotas = Kota::all(); 
    $kendaraan = Kendaraan::all(); 
    $nama_kota = Kota::find($city_id)->nama ?? '';
    $nama_kendaraan = Kendaraan::find($kendaraan_id)->nama ?? '';
  
    $paketTerpopuler = PaketWisata::select('paket_wisata.*')
                        ->join('pemesanan', 'paket_wisata.id', '=', 'pemesanan.paket_id')
                        ->groupBy('paket_wisata.id')
                        ->orderByRaw('COUNT(pemesanan.id) DESC')
                        ->take(3)
                        ->get();

    return view('landingpage.paketwisata', compact('paketWisata', 'kotas', 'search', 'min_price', 'max_price', 'city_id', 'kendaraan_id','nama_kota','nama_kendaraan','paketTerpopuler','kendaraan'));
}

    public function detailPaket($slug)
    {
        $paketWisata = PaketWisata::where('slug', $slug)->firstOrFail();
        $rundownsGrouped = $paketWisata->rundowns->groupBy('hari_ke')->map(function ($rundowns) {
            return $rundowns->sortBy('mulai');
        });
        return view('landingpage.detailPaket', compact('paketWisata','rundownsGrouped'));
    }
    public function detailPaketForm($slug){
        $paketWisata = PaketWisata::where('slug', $slug)->firstOrFail();
        $rundownsGrouped = $paketWisata->rundowns->groupBy('hari_ke')->map(function ($rundowns) {
            return $rundowns->sortBy('mulai');
        });
        return view('landingpage.pemesanan.detailPaketForm', compact('paketWisata','rundownsGrouped')); 
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
