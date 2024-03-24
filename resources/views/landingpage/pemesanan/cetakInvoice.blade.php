<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .row {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; /* Membuat elemen berdampingan */
        }
        .col-md-4, .col-md-8 {
            padding: 0 10px;
        }
        dt {
            font-weight: bold;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: left;
        }
        .table td {
            text-align: left;
        }
        .table-warning th {
            background-color: #ffc107;
        }
        .text-success {
            color: #28a745;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 200px;
        }

        .watermark {
            position: fixed;
            opacity: 0.2;
            z-index: -1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .d-flex{
            display: flex;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/logo2.png'))) }}" alt="Logo">
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td style="width: 30%;">ID Pemesanan</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ $pemesanan->id }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pemesan</td>
                        <td>:</td>
                        <td>{{ $pemesanan->user->name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">No. Telepon</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ $pemesanan->user->phone }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Keberangkatan</td>
                        <td>:</td>
                        <td>{{ $pemesanan->tanggal_keberangkatan_indo }}</td>
                    </tr>
                </table>
            </div>
        </div>
        

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="table-warning">
                        <tr>
                            <th>Nama Paket</th>
                            <th>Jumlah Paket</th>
                            <th>Harga per Paket</th>
                            <th>Terbilang</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pemesanan->paket->nama }}</td>
                            <td>{{ $pemesanan->jumlah_paket }}</td>
                            <td>Rp {{ number_format($pemesanan->paket->harga, 0, ',', '.') }}</td>
                            <td>{{ ucwords(\App\Helpers\TerbilangHelper::terbilang($pemesanan->
                                total_pembayaran)) }} Rupiah</td>
                                <td class="fw-bold text-danger">Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 watermark">
                                        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/lunas.png'))) }}" alt="Lunas" style="width: 200px;">
                                    </div>
                                </div>
                            </div>
                        </body>
                        </html>                            
