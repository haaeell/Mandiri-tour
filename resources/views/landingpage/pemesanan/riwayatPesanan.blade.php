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
                                    @elseif($item->status_pembayaran == 'Pembayaran Diterima' && $item->bukti_pembayaran > 0 )
                                    <span class="badge bg-success">
                                        Pembayaran Diterima
                                    </span>

                                @else
                                <span class="badge bg-warning">
                                    Menunggu Konfirmasi Admin
                                </span>
                                @endif
                        </td>
                            
                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->isoFormat('D MMMM YYYY') }}
                        </td>
                            <td>
                                {!! $item->bukti_pembayaran ? '<img src="' . asset('storage/' . $item->bukti_pembayaran) . '" width="50" onClick="showImage(this)">' : '<span class="fw-bold text-danger">Belum Dibayar</span>' !!}
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    @if ($item->status_pembayaran != 'Pemesanan Dibatalkan' && $item->status_pembayaran != 'Pembayaran Diterima')
                                        <form action="{{ route('pemesanan.cancel', $item->id) }}" method="post">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="btn btn-danger btn-sm">Batalkan Pemesanan</button>
                                        </form>
                                    @endif
                                    @if ($item->status_pembayaran != 'Pemesanan Dibatalkan')
                                    <a href="{{ route('pemesanan.invoice', $item->id) }}" class="btn btn-primary btn-sm">Lihat Invoice</a>
                                        
                                    @endif
                                </div>
                                
                                
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
