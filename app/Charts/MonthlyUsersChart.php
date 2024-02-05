<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Ambil data pengguna berdasarkan status pemesanan per bulan
        $data = User::select(DB::raw('YEAR(created_at) as tahun'), DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
            ->groupBy('tahun', 'bulan')
            ->get();

        // Inisialisasi array bulan dan total pengguna untuk setiap bulan
        // Inisialisasi array bulan, total pemesanan, total penjualan, dan total pemesanan dibatalkan
        $bulanLabels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'October', 'November', 'Desember'
        ];

        $totalSudahPesan = array_fill(0, 12, 0);
        $totalBelumPesan = array_fill(0, 12, 0);
        $totalPesanDibatalkan = array_fill(0, 12, 0);

        // Mengisi array total pengguna berdasarkan status pemesanan per bulan
        foreach ($data as $item) {
            $bulanIndex = $item->bulan - 1;

            $totalSudahPesan[$bulanIndex] = User::has('pemesanan')->whereYear('created_at', $item->tahun)->whereMonth('created_at', $item->bulan)->count();
            $totalBelumPesan[$bulanIndex] = User::doesntHave('pemesanan')->whereYear('created_at', $item->tahun)->whereMonth('created_at', $item->bulan)->count();
        }

        // Membangun chart dengan data dinamis
        return $this->chart->barChart()
            ->setTitle('Status Customer Berdasarkan Pemesanan per Bulan')
            ->addData('Sudah Pernah Memesan', $totalSudahPesan)
            ->addData('Belum Pernah Memesan', $totalBelumPesan)
            ->setXAxis($bulanLabels)
            ->setGrid('#3F51B5', 0.1);
    }
}
