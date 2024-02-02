<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyUsersChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
    public function index()
{
    return view('testing.index');
} 
public function checkSEO(Request $request)
{
    // Validasi input URL
    $request->validate([
        'website_url' => 'required|url',
    ]);

    // Ambil URL dari input
    $websiteUrl = $request->input('website_url');

    // Lakukan pengukuran SEO menggunakan alat atau API pihak ketiga
    $seoResults = $this->performSEOCheck($websiteUrl);

    // Tampilkan hasil pengukuran SEO
    return view('seo-check.results', ['seoResults' => $seoResults]);
}

// Metode ini dapat diisi dengan logika pengukuran SEO sesuai kebutuhan Anda
private function performSEOCheck($websiteUrl)
{
    // Contoh menggunakan HTTP Client Laravel untuk mendapatkan informasi halaman
    $response = Http::get($websiteUrl);
    $title = $response->title(); // Mendapatkan judul HTML
$content = $response->body(); // Mendapatkan konten HTML

// Tampilkan hasilnya
dd($title, $content);

    // Contoh hasil pengukuran SEO, sesuaikan dengan kebutuhan Anda
    $seoResults = [
        'title' => $response->title(),
        'meta_description' => $response->meta('description'),
        // ... informasi SEO lainnya ...
    ];

    return $seoResults;
}
}
