<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bulan_penjualan = Pemesanan::latest()->pluck('updated_at')->map(function ($item) {
            return Carbon::parse($item)->format('Y-m');
        })->unique();
        // dd($bulan_penjualan);
        return view('admin.laporan.index', compact('bulan_penjualan'));
    }
    public function cetak(Request $request)
{
    $bulan = $request->bulan;
    $pemesanans = Pemesanan::where('status_pembayaran', 'Pembayaran Diterima')
        ->whereYear('updated_at', '=', date('Y', strtotime($bulan)))
        ->whereMonth('updated_at', '=', date('m', strtotime($bulan)))
        ->get();

    
    $bulanLabel = Carbon::parse($bulan)->translatedFormat('F Y');
    $fileName = 'laporan_penjualan_' . strtolower(str_replace(' ', '_', $bulanLabel)) . '.pdf';

    $dompdf = new Dompdf();
    
    $html = view('admin.laporan.cetak', compact('pemesanans'))->render();
    $dompdf->loadHtml($html);
    $dompdf->render();
    return $dompdf->stream($fileName);
}


public function data(Request $request)
{
    $bulan = $request->bulan;

    $pemesanans = Pemesanan::with('user', 'paket')
        ->whereYear('updated_at', Carbon::parse($bulan)->year)
        ->whereMonth('updated_at', Carbon::parse($bulan)->month)
        ->orderBy('updated_at', 'desc')
        ->get();

    // Transformasi data sebelum mengirim respons
    $transformedData = $pemesanans->map(function ($pemesanan) {
        return [
            'id' => $pemesanan->id,
            'nama_user' => $pemesanan->user->name, 
            'nama_paket' => $pemesanan->paket->nama, 
            'jumlah_paket' => $pemesanan->jumlah_paket,
            'total_pembayaran' => $pemesanan->total_pembayaran,
            'tanggal_penjualan' => Carbon::parse($pemesanan->updated_at)->translatedFormat('d F Y'),
        ];
    });

    return response()->json($transformedData);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
