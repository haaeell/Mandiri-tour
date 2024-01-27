<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\PaketWisata;
use App\Models\Pemesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Total keseluruhan pengguna
        $totalUsers = User::count();
        $totalPesananPembayaranDiterima = Pemesanan::where('status_pembayaran', 'Pembayaran Diterima')->count();
        $totalPaketWisata = PaketWisata::count();
        $totalKeluhan = Keluhan::all();

        // Total pengguna yang mendaftar bulan ini
        $usersRegisteredThisMonth = User::whereYear('created_at', '=', Carbon::now()->year)
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->count();

        // Total pengguna yang pernah memesan
        $usersWithOrders = User::has('pemesanan')->count();

        // Total pengguna yang belum pernah memesan
        $usersWithoutOrders = User::doesntHave('pemesanan')->count();

        return view('admin.home', compact('totalUsers', 'usersRegisteredThisMonth', 'usersWithOrders', 'usersWithoutOrders','totalPesananPembayaranDiterima','totalPaketWisata', 'totalKeluhan'));
    }
    public function profile()
    {
        return view('admin.users.profile');
    }
}
