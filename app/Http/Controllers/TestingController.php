<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyUsersChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestingController extends Controller
{
    // app/Http/Controllers/PenjualanController.php
    // public function index()
    // {
    //     $penjualanPerBulan = DB::table('pemesanan')
    //     ->select(DB::raw('MONTH(tanggal_pemesanan) as bulan'), DB::raw('COUNT(*) as total_pemesanan'    ))
    //     ->where('status_pembayaran', '=', 'pembayaran Diterima')
    //     ->groupBy('bulan')
    //     ->get();

    //     return view('testing.index', compact('penjualanPerBulan'));
    // }
    public function index(MonthlyUsersChart $chart)
{
    return view('admin.home', ['chart' => $chart->build()]);
} 

}
