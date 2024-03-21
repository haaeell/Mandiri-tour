@extends('layouts.dashboard')

@section('title', 'Laporan Penjualan Paket Wisata')
@section('breadcumb', 'Laporan')
@section('content')
    <div class="card p-3">
        <form action="{{ route('laporan.cetak') }}" method="post" class="mb-3">
            @csrf
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <select name="bulan" id="bulan" class="form-select select2">
                        @foreach($bulan_penjualan as $bulan)
                            @php
                                $carbonDate = \Carbon\Carbon::createFromFormat('Y-m', $bulan)->locale('id');
                                $bulanLabel = $carbonDate->isoFormat('MMMM Y');
                            @endphp
                            <option value="{{ $bulan }}">{{ $bulanLabel }}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                </div>
            </div>
        </form>
        
        <div id="loading" class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Memuat data...</p>
        </div>

        <div class="p-3" id="dataPemesanan"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $(document).ready(() => {
            const bulan = $('#bulan').val();
            if (bulan) {
                loadData(bulan);
            } else {
                console.log('Mohon pilih bulan terlebih dahulu.');
            }

            $('#bulan').change(() => {
                const bulanSelected = $('#bulan').val();
                if (bulanSelected) {
                    loadData(bulanSelected);
                }
            });
        });

        function loadData(bulan) {
            $('#loading').removeClass('d-none');

            $.getJSON(`{{ route("laporan.data") }}?bulan=${bulan}`)
                .done((data) => {
                    $('#loading').addClass('d-none');
                    renderData(data, bulan);
                })
                .fail((error) => {
                    $('#loading').addClass('d-none');
                    console.error('Error:', error);
                    $('#dataPemesanan').html('<div class="alert alert-danger" role="alert">Terjadi kesalahan saat memuat data. Silakan coba lagi nanti.</div>');
                });
        }

        function formatNumber(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

        function renderData(data, bulan) {
            const bulanLabel = new Date(bulan + '-01').toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });
            let table = `<h3 class="my-4 text-center">Data Penjualan Paket Wisata Bulan ${bulanLabel}</h3>`;
            table += '<div class="table-responsive">';
            table += '<table class="table table-hovered">';
            table += `<thead class="table-primary">
                <tr>
                    <th scope="col">No.</th><th scope="col">Nama Pemesan</th>
                    <th scope="col">Nama Paket Wisata</th><th scope="col">Jumlah Paket</th>
                    <th scope="col">Total Pembayaran</th>
                    <th scope="col">Tanggal Penjualan</th></tr></thead>`;
            table += '<tbody>';
            
            let totalPendapatan = 0;

            $.each(data, (index, item) => {
                table += '<tr>';
                table += `<td>${index + 1}</td>`;
                table += `<td>${item.nama_user}</td>`;
                table += `<td>${item.nama_paket}</td>`;
                table += `<td>${item.jumlah_paket}</td>`;
                table += `<td>Rp ${item.total_pembayaran.toLocaleString()}</td>`;
                table += `<td>${item.tanggal_penjualan}</td>`;
                table += '</tr>';

                totalPendapatan += item.total_pembayaran; // Tambahkan total pembayaran setiap pesanan
            });

            table += `<tr><td colspan="6" class="text-center table-primary fs-5 fw-bold">Total Pendapatan Bulan ${bulanLabel} : Rp ${formatNumber(totalPendapatan)}</td></tr>`;

            const totalData = data.length;
            table += `<tr><td colspan="6" class="text-end fw-bold">Total data: ${totalData}</td></tr>`;
            table += '</tbody>';
            table += '</table>';
            table += '</div>';
            $('#dataPemesanan').html(table);
        }
    </script>
@endsection
