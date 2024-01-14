<!-- resources/views/pemesanan/select_paket.blade.php -->

@extends('layouts.landingpage')

@section('content')
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <h2 class="fw-bold text-center mb-5">Paket Wisata</h2>
            @foreach ($paketWisata as $p)
            <div class="col-md-3">
                <div class="card border-0 card-paket p-3">
                    <img src="{{ asset('/images/' . $p->gambar) }}"
                        style="width: 100%; height:250px; border-radius:24px; object-fit:cover;" alt="">
                    <div class="px-2">
                        <h5 class="fw-semibold my-3">{{ $p->nama }}</h5>
                        <p>Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('detailPaket', $p->slug) }}" class="btn  btn-primary">Pesan Sekarang</a>
                </div>
            </div>
            @endforeach
        </div>

        
    </div>
@endsection
