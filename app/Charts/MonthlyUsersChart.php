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

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        // Ambil data pengguna berdasarkan status pemesanan
        $totalSudahPesan = User::whereHas('pemesanan')->where('role', 'customer')->count();
        $totalBelumPesan = User::whereDoesntHave('pemesanan')->where('role', 'customer')->count();
       

        // Membangun chart dengan data dinamis
        return $this->chart->pieChart()
            ->addData([$totalSudahPesan, $totalBelumPesan])
            ->setLabels([
                'Sudah Pernah Memesan: ',
                'Belum Pernah Memesan: ',
            ])
            ->setColors(['#4CAF50', '#FFC107']); // warna yang Anda inginkan untuk masing-masing bagian
    }
}
