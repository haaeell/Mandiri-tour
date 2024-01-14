<!-- resources/views/landingpage/pemesanan/invoice.blade.php -->

@extends('layouts.landingpage')

@section('content')
    <div class="container mt-5">
        <button class="btn btn-success mb-3">Cetak Invoice </button>
        <div class="card p-3">
            <div class="card-header">
                <h2 class="fw-semibold text-center">Invoice Pembayaran</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <dl class="row d-flex justify-content-between align-itmes-center">
                            <div class="col-md-9">
                                <div class="d-flex">

                                    <dt class="col-sm-4">ID Pemesanan</dt>
                                    <dt class="col-sm-8">:  {{ $pemesanan->id }}</dt>
                                </div>
                                <div class="d-flex">

                                    <dt class="col-sm-4">Nama Pemesan</dt>
                                    <dt class="col-sm-8">:  {{ $pemesanan->user->name }}</dt>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="d-flex ">

                                    <dt class="col-sm-4">No. Telepon </dt>
                                    <dt class="col-sm-8">:  {{ $pemesanan->user->phone }}</dt>
                                </div>
                                <div class="d-flex">

                                    <dt class="col-sm-4">Tanggal </dt>
                                    <dt class="col-sm-8">:  {{ $pemesanan->tanggal_pemesanan }}</dt>
                                </div>
                            </div>
                            
                        </dl>
                        <hr/>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Paket</th>
                                    <th>Jumlah Peserta</th>
                                    <th>Harga per Paket</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>{{ $pemesanan->paket->nama }}</td>
                                    <td>{{ $pemesanan->jumlah_peserta }}</td>
                                    <td>{{ 'Rp '.number_format($pemesanan->paket->harga, 0, ',', '.') }}</td>
                                <td class="fw-bold text-danger">{{ 'Rp '.number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <h3 class="mb-0 fw-semibold">Informasi Pembayaran</h3>
                        <p>Silakan transfer total pembayaran ke rekening  berikut: <span class="fw-bold text-success"> Nomor Rekening     BCA 1234-5678-9012 . A/N SUJEWO TEJO</span> </p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-3 jjustify-content-between my-5">
            <div class="col-md-8">
                @if($pemesanan->status_pembayaran != 'Pemesanan Dibatalkan')
                        <form action="{{ route('pemesanan.cancel', $pemesanan->id) }}" method="post">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-danger">Batalkan Pemesanan</button>
                        </form>
                    @endif
            </div>

            <div class="col-md-4">
                <h3 class="mb-3 fw-semibold ">Unggah Bukti Pembayaran</h3>
                <form action="{{ route('pemesanan.upload', $pemesanan->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group d-flex">
                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" required>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection
