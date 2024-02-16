<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyOrdersChart;
use App\Charts\MonthlyUsersChart;
use App\Models\Keluhan;
use App\Models\PaketWisata;
use App\Models\Pemesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        public function index(MonthlyUsersChart $monthlyUsersChart, MonthlyOrdersChart $monthlyOrdersChart)
        {
            $topUsers = User::select('users.*', DB::raw('COUNT(pemesanan.id) as total_orders'))
            ->leftJoin('pemesanan', 'users.id', '=', 'pemesanan.user_id')
            ->groupBy('users.id')
            ->orderByDesc('total_orders')
            ->get();
        $totalPaketWisata = PaketWisata::count();
        $totalKeluhan = Keluhan::count();
        $totalCustomer = User::where('role', 'customer')->count();
        $totalPemesanan = Pemesanan::count();
        $usersWithOrders = User::has('pemesanan')->get();
        $usersWithoutOrders = User::doesntHave('pemesanan')->get();
        $usersWithCancelledOrders = User::whereHas('pemesanan', function ($query) {
        $query->where('status_pembayaran', 'pemesanan dibatalkan');
    })->get();
        
        return view('admin.home', [
            'monthlyUsersChart' => $monthlyUsersChart->build(),
            'monthlyOrdersChart' => $monthlyOrdersChart->build(),
            'totalPaketWisata' => $totalPaketWisata,
            'totalKeluhan' => $totalKeluhan,
            'totalCustomer' => $totalCustomer,
            'totalPemesanan' => $totalPemesanan,
            'usersWithOrders' => $usersWithOrders,
            'usersWithoutOrders' => $usersWithoutOrders,
            'usersWithCancelledOrders' => $usersWithCancelledOrders,
            'topUsers' => $topUsers,



        ]);
        } 

        public function getUsersByStatus($status)
    {
        if ($status === 'sudah-pesan') {
            $users = User::has('pemesanan')->where('role', 'customer')->get();
        } else {
            $users = User::doesntHave('pemesanan')->where('role', 'customer')->get();
        }

        return $users;
    }
    public function profile()
    {
        return view('admin.users.profile');
    }

    
}
