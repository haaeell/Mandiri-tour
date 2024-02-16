<!-- resources/views/landingpage/pemesanan/invoice.blade.php -->

@extends('layouts.landingpage')

@section('content')
    <div class="container mt-5">
        @if ($pemesanan->bukti_pembayaran > 0 && $pemesanan->status_pembayaran != 'Pembayaran Diterima')
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading fw-semibold">Pembayaran Sedang Diperiksa!</h4>
            <p>Pembayaran Anda sedang dalam proses pengecekan oleh admin.</p>
            <hr>
            <p class="mb-0">Terima kasih atas kesabaran Anda.</p>
        </div>
        @elseif ($pemesanan->bukti_pembayaran > 0 && $pemesanan->status_pembayaran === 'Pembayaran Diterima')
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading fw-semibold">Pembayaran Berhasill!</h4>
            <p>Berikut detail pesanan dan jadwal perjalanan</p>
            <hr>
            <p class="mb-0">Informasi lebih lanjut hubungi Admin di <a href="https://wa.me/6285321726312">+6285321726312</a> 
                <a href="https://wa.me/6285321726312" target="_blank" class="btn btn-success delete-btn btn-lg">
                    <i class="bi bi-whatsapp"></i>
                </a>
            </p>
            
        </div>
        @endif
        
        @if ($pemesanan->status_pembayaran != 'Pembayaran Diterima')
            
        <button class="btn btn-success btn-lg mb-3">Cetak Invoice </button>
        <div class="card p-3 shadow mb-5">
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
                                    <th>Terbilang</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>{{ $pemesanan->paket->nama }}</td>
                                    <td>{{ $pemesanan->jumlah_peserta }}</td>
                                    <td>{{ 'Rp '.number_format($pemesanan->paket->harga, 0, ',', '.') }}</td>
                                <td class="fw-bold text-danger">{{ 'Rp '.number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</td>
                                <td class="fw-bold ">{{ ucwords(\App\Helpers\TerbilangHelper::terbilang($pemesanan->total_pembayaran)) }} Rupiah</td>
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
        @if (!$pemesanan->bukti_pembayaran > 0)
            
        <div class="row mt-3 jjustify-content-between my-5">         
            <div class="col-md-8">
                @if($pemesanan->status_pembayaran != 'Pemesanan Dibatalkan')
                        <form action="{{ route('pemesanan.cancel', $pemesanan->id) }}" method="post">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-danger btn-lg">Batalkan Pemesanan</button>
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
        @endif
        @else

        <h2 class="text-center fw-semibold my-4">
            Detail Pesanan
         </h2>
         <div class="card p-3 my-5">
                     
             <div class="col-md-12">
                 <table class="table">
                     <thead class="table-light">
                         <tr>
                             <th>Nama Paket</th>
                             <th>Jumlah Peserta</th>
                             <th>Alamat</th>
                             <th>Tanggal Keberangkatan</th>
                             <th>Status</th>
                         </tr>
                     </thead>
                     
                     <tbody class="table-group-divider">
                         <tr>
                             <td>{{ $pemesanan->paket->nama }}</td>
                             <td>{{ $pemesanan->jumlah_peserta }}</td>
                             <td>{{ $pemesanan->alamat }}</td>
                             <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d F Y ') }}</td>
                             <td><span class="badge bg-success">{{ $pemesanan->status_pembayaran }}</span></td>
     
                         </tr>
                     </tbody>
                 </table>
 
                 <h2 class="fw-semibold text-center my-5">Detail Paket Wisata</h2>
                 <div class="row">
 
                     <div class="col-md-6">
                         <div class="d-flex gap-5 mb-4">
                             <img src="{{ asset('/images/' . $pemesanan->paket->gambar) }}"
                                  style="width: 200px; height:100px; border-radius:24px; object-fit: cover;" alt="">
                             <div>
                                 <h3 class="fw-semibold">{{ $pemesanan->paket->nama }}</h3>
                                 <div class="mb-3 d-flex gap-2">
                                     @foreach ($pemesanan->paket->kotas as $kota)
                                         <span class="badge text-bg-success">{{ $kota->nama }}</span>
                                     @endforeach
                                 </div>
                                 <p>{{ $pemesanan->paket->deskripsi }}</p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div>
                             <div class="accordion accordion-flush" id="accordionFlushExample">
                                 <div class="accordion-item">
                                     <h2 class="accordion-header">
                                         <button class="accordion-button collapsed fw-bold " style="border:1px solid #25aae1; border-radius:8px" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                             Wisata
                                         </button>
                                     </h2>
                                     <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                         <div class="accordion-body">
                                             <ol>
                                                 @foreach ($pemesanan->paket->wisatas as $wisata)
                                                     <li>{{ $wisata->nama }}</li>
                                                 @endforeach
                                             </ol>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="accordion-item my-2">
                                     <h2 class="accordion-header">
                                         <button class="accordion-button collapsed fw-bold" type="button" style="border:1px solid #25aae1; border-radius:8px" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                             Fasilitas
                                         </button>
                                     </h2>
                                     <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                         <div class="accordion-body">
                                             {{ $pemesanan->paket->fasilitas }}
                                         </div>
                                     </div>
                                 </div>
                                 <div class="accordion-item">
                                     <h2 class="accordion-header">
                                         <button class="accordion-button collapsed fw-bold" style="border:1px solid #25aae1; border-radius:8px" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                             Rundown
                                         </button>
                                     </h2>
                                     <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                         <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative lorem500 of how this would look in a real-world application.</div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 
             </div>
 
         </div> 
        @endif
       
        
    </div>
@endsection
