@extends('layouts.landingpage')


@section('content')
<div class="container py-4">
    <div class="row d-flex">

       
        <div class="col-md-12 card"  style="border-top-left-radius: 24px; border-top-right-radius: 24px;">
            <h2 class="fw-semibold text-center my-3 bg-primary p-3 text-light"  style="border-top-left-radius: 24px; border-top-right-radius: 24px;">Riwayat Pesanan</h2>
            @if(count($riwayatPesanan) > 0)
            <div class="table-responsive">
                <table class="table table-hovered" >
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Paket</th>
                            <th>Jumlah Paket</th>
                            <th>Total Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Keberangkatan</th>
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
                                <td>{{ $item->jumlah_paket }}</td>
                                <td>Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                                <td class="text-center align-middle">
                                    @if($item->status_pembayaran == 'Belum Dibayar')
                                        <span class="badge bg-danger">
                                            {{$item->status_pembayaran}}
                                        </span>
                                    @elseif($item->status_pembayaran == 'Menunggu Konfirmasi Admin')
                                        <span class="badge bg-warning">
                                            {{$item->status_pembayaran}}
                                        </span>
                                    @elseif($item->status_pembayaran == 'Pembayaran Diterima')
                                        <span class="badge bg-success">
                                            {{$item->status_pembayaran}}
                                        </span>
                                    @elseif($item->status_pembayaran == 'Pembayaran Ditolak')
                                        <span class="badge bg-danger">
                                            {{$item->status_pembayaran}}
                                        </span>
                                    @elseif($item->status_pembayaran == 'Pemesanan Dibatalkan')
                                        <span class="badge bg-secondary">
                                            {{$item->status_pembayaran}}
                                        </span>
                                    @endif
                                </td>
                                
                                
                            <td>
                                {{ $item->tanggal_keberangkatan_indo }}
                            </td>
                            <td>
                                {{ $item->created_at_indo}}
                            </td>
                                <td style="cursor: pointer">
                                    {!! $item->bukti_pembayaran ? '<img src="' . asset('storage/' . $item->bukti_pembayaran) . '" width="50" onClick="showImage(this)">' : '<span class="fw-bold text-danger">Belum Dibayar</span>' !!}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if (!$item->bukti_pembayaran > 0 && $item->status_pembayaran != 'Pemesanan Dibatalkan' && $item->status_pembayaran != 'Pembayaran Diterima')
                                            <form action="{{ route('pemesanan.cancel', $item->id) }}" method="post">
                                                @csrf
                                                @method('post')
                                                <button type="submit" class="btn btn-danger btn-sm">Batalkan Pemesanan</button>
                                            </form>
                                        @endif
                                        @if ($item->status_pembayaran != 'Pemesanan Dibatalkan')
                                            @if ($item->status_pembayaran != 'Pembayaran Diterima')
                                                <a href="{{ route('pemesanan.invoice', $item->id) }}" class="btn btn-primary btn-sm">Lihat Invoice</a>
                                            @else
                                                <a href="{{ route('pemesanan.invoice', $item->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                                            @endif
                                        @endif
    
                                    </div>
                                    
                                    
                                </td>
                                
                            </tr>
                        @endforeach
    
                    </tbody>
                </table>
                @else
                    <p class="text-center fw-semibold">- Belum ada riwayat pesanan -</p>
                @endif
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('script')


@endsection
