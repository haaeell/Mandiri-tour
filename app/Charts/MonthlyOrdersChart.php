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
        $data = DB::table('pemesanan')
            ->select(
                DB::raw('YEAR(updated_at) as tahun'),
                DB::raw('MONTH(updated_at) as bulan'), 
                DB::raw('COUNT(*) as total_pemesanan'),
                DB::raw('SUM(CASE WHEN status_pembayaran = "Belum Dibayar" THEN 1 ELSE 0 END) as belum_dibayar'),
                DB::raw('SUM(CASE WHEN status_pembayaran = "Menunggu Konfirmasi Admin" THEN 1 ELSE 0 END) as menunggu_konfirmasi'),
                DB::raw('SUM(CASE WHEN status_pembayaran = "Pembayaran Diterima" THEN 1 ELSE 0 END) as pembayaran_diterima'),
                DB::raw('SUM(CASE WHEN status_pembayaran = "Pembayaran Ditolak" THEN 1 ELSE 0 END) as pembayaran_ditolak'),
                DB::raw('SUM(CASE WHEN status_pembayaran = "Pemesanan Dibatalkan" THEN 1 ELSE 0 END) as pemesanan_dibatalkan')
            )
            ->groupBy('tahun', 'bulan')
            ->get();

        $bulanLabels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $judulChart = 'Grafik Data Pemesanan';
        
        $totalPemesanan = array_fill(0, 12, 0); 
        $totalPenjualan = array_fill(0, 12, 0); 
        $totalPembayaranDitolak = array_fill(0, 12, 0); 
        $totalPemesananDibatalkan = array_fill(0, 12, 0); 
        $totalMenungguKonfirmasi = array_fill(0, 12, 0); 
        $belumDibayar = array_fill(0, 12, 0); 

        foreach ($data as $item) {
            $totalPemesanan[$item->bulan - 1] = $item->total_pemesanan;
            $totalPenjualan[$item->bulan - 1] = $item->pembayaran_diterima; // Total penjualan diambil dari jumlah pembayaran yang diterima
            $totalPembayaranDitolak[$item->bulan - 1] = $item->pembayaran_ditolak;
            $totalPemesananDibatalkan[$item->bulan - 1] = $item->pemesanan_dibatalkan;
            $totalMenungguKonfirmasi[$item->bulan - 1] = $item->menunggu_konfirmasi;
            $belumDibayar[$item->bulan - 1] = $item->belum_dibayar;

        }

        // Membangun chart dengan data dinamis
        return $this->chart->lineChart()
            ->setTitle($judulChart)
            ->addData('Jumlah Pemesanan', $totalPemesanan)
            ->addData('Jumlah Penjualan', $totalPenjualan)
            ->addData('Jumlah Pembayaran Ditolak', $totalPembayaranDitolak)
            ->addData('Jumlah Pemesanan Dibatalkan', $totalPemesananDibatalkan)
            ->addData('Jumlah Menunggu Konfirmasi Admin', $totalMenungguKonfirmasi)
            ->addData('Belum Dibayar', $belumDibayar)
            ->setXAxis($bulanLabels)
            ->setGrid('#3F51B5', 0.1);
    }
}
