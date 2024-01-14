@extends('layouts.landingpage')


@section('content')
<div class="container py-4">
    <div class="row d-flex">
        <h2 class="fw-semibold text-center my-3">Riwayat Pesanan</h2>
        <div class="col-md-12 card p-4">
            
            <table class="table table-hovered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Jumlah Peserta</th>
                        <th>Total Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Bukti Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        function getStatusBadgeClass($status) {
                            switch ($status) {
                                case 'Menunggu Konfirmasi Admin':
                                    return 'bg-warning text-dark';
                                case 'Pembayaran Diterima':
                                    return 'bg-success';
                                case 'Pembayaran Ditolak':
                                    return 'bg-danger';
                                case 'Pemesanan Dibatalkan':
                                    return 'bg-secondary';
                                default:
                                    return '';
                            }
                        }
                    @endphp

                    @foreach ($riwayatPesanan as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->paket->nama }}</td>
                            <td>{{ $item->jumlah_peserta }}</td>
                            <td>Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status_pembayaran == 'Pemesanan Dibatalkan')
                                    <span class="badge bg-secondary">
                                        {{$item->status_pembayaran}}
                                    </span>
                                @elseif($item->status_pembayaran == 'Menunggu Konfirmasi Admin' && !$item->bukti_pembayaran)
                                    <span class="badge bg-danger">
                                        Menunggu Pembayaran
                                    </span>
                                @else
                                    <span class="badge {{ getStatusBadgeClass($item->status_pembayaran) }}">
                                        {{ $item->status_pembayaran }}
                                    </span>
                                @endif
                        </td>
                            
                            <td>{{ $item->tanggal_pemesanan }}</td>
                            <td>
                                {!! $item->bukti_pembayaran ? '<img src="' . asset('storage/' . $item->bukti_pembayaran) . '" width="50" onClick="showImage(this)">' : '<span class="fw-bold text-danger">Belum Dibayar</span>' !!}
                            </td>
                            <td>
                                @if ($item->status_pembayaran != 'Pemesanan Dibatalkan')
                                <form action="{{ route('pemesanan.cancel', $item->id) }}" method="post">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-danger">Batalkan Pemesanan</button>
                                </form>
                                @endif
                            </td>
                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection
@section('script')


@endsection
