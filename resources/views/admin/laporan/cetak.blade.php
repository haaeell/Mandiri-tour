<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemesanan Paket Wisata Bulan {{ \Carbon\Carbon::parse($pemesanans->first()->created_at)->isoFormat('MMMM YYYY') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 200px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/logo2.png'))) }}" alt="Logo" class="logo">
        </div>
        <h2>Laporan Pemesanan Paket Wisata Bulan {{ \Carbon\Carbon::parse($pemesanans->first()->created_at)->isoFormat('MMMM YYYY') }}</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pemesan</th>
                    <th>Nama Paket Wisata</th>
                    <th>Jumlah Paket</th>
                    <th>Total Pembayaran</th>
                    <th>Tanggal Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPendapatan = 0;
                @endphp
                @foreach ($pemesanans as $index => $pemesanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pemesanan->user->name }}</td>
                        <td>{{ $pemesanan->paket->nama }}</td>
                        <td>{{ $pemesanan->jumlah_paket }}</td>
                        <td>Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($pemesanan->updated_at)->isoFormat('D MMMM YYYY') }}</td>
                    </tr>
                    @php
                        $totalPendapatan += $pemesanan->total_pembayaran;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="total">Total Pendapatan:</td>
                    <td class="total">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
