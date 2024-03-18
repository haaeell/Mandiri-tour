<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rundown PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 150px;
            margin-bottom: 10px;
        }
        .alamat {
            font-style: italic;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .hari-title {
            background-color: #007bff;
            color: #fff;
            padding: 8px;
            margin-bottom: 10px;
        }
        .hari-content {
            margin-bottom: 20px;
        }
        .time {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/logo2.png'))) }}" class="logo">
        <h2>{{$nama_paket_wisata}}</h2>
    </div>
    
    @foreach ($rundownsGrouped as $hari => $rundowns)
        <div class="hari-content">
            <div class="hari-title">Hari ke-{{ $hari }}</div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 50%;">Waktu</th>
                        <th style="width: 50%;">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rundowns as $rundown)
                        <tr>
                            <td class="time">{{ \Carbon\Carbon::parse($rundown->mulai)->format('H.i') }} - {{ \Carbon\Carbon::parse($rundown->selesai)->format('H.i') }}</td>
                            <td>{{ $rundown->deskripsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</body>
</html>
