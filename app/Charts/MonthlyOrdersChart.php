<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class MonthlyOrdersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // Ambil data pemesanan, penjualan, dan pemesanan dibatalkan dari database
        $data = DB::table('pemesanan')
            ->select(DB::raw('YEAR(created_at) as tahun'),
                      DB::raw('MONTH(created_at) as bulan'), 
                      DB::raw('COUNT(*) as total_pemesanan'),
                      DB::raw('SUM(CASE WHEN status_pembayaran = "Pembayaran Diterima" THEN 1 ELSE 0 END) as total_penjualan'),
                      DB::raw('SUM(CASE WHEN status_pembayaran = "Pemesanan dibatalkan" THEN 1 ELSE 0 END) as total_pemesanan_dibatalkan'))
            ->groupBy('tahun', 'bulan')
            ->get();

        // Inisialisasi array bulan, total pemesanan, total penjualan, dan total pemesanan dibatalkan
        $bulanLabels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'October', 'November', 'Desember'
        ];

        // Memperbarui judul chart dengan tahun sesuai data
        $judulChart = 'Jumlah Pemesanan, Penjualan, Dibatalkan per Bulan';
        

        // Inisialisasi array total pemesanan, total penjualan, dan total pemesanan dibatalkan
        $totalPemesanan = array_fill(0, 12, 0); // Isi array dengan 0 untuk setiap bulan
        $totalPenjualan = array_fill(0, 12, 0); // Isi array dengan 0 untuk setiap bulan
        $totalPemesananDibatalkan = array_fill(0, 12, 0); // Isi array dengan 0 untuk setiap bulan

        // Mengisi array total pemesanan, total penjualan, dan total pemesanan dibatalkan berdasarkan hasil query
        foreach ($data as $item) {
            $totalPemesanan[$item->bulan - 1] = $item->total_pemesanan;
            $totalPenjualan[$item->bulan - 1] = $item->total_penjualan;
            $totalPemesananDibatalkan[$item->bulan - 1] = $item->total_pemesanan_dibatalkan;
        }

        // Membangun chart dengan data dinamis
        return $this->chart->lineChart()
            ->setTitle($judulChart)
            ->addData('Jumlah Pemesanan', $totalPemesanan)
            ->addData('Jumlah Penjualan', $totalPenjualan)
            ->addData('Jumlah Pemesanan Dibatalkan', $totalPemesananDibatalkan)
            ->setXAxis($bulanLabels)
            ->setGrid('#3F51B5', 0.1);
    }
}
