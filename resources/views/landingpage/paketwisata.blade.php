<!-- resources/views/pemesanan/select_paket.blade.php -->

@extends('layouts.landingpage')

@section('content')
    <div class="container py-5">
        <div class="row d-flex justify-content-center ">
            
            
            <h2 class="fw-bold text-center mb-4">Paket Wisata</h2>
            <div class="text-center mb-4 col-md-10">
                <!-- Tombol Filter -->
                <button type="button" class="btn btn-primary rounded-pill py-3 px-4" data-bs-toggle="modal" data-bs-target="#filterModal">
                    Filter Paket Wisata
                </button>
            </div>
            <div class="modal fade rounded-pill" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class=" text-center fw-semibold" id="filterModalLabel">Filter Paket Wisata</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulir Pencarian -->
                            <form action="" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" name="keyword" id="search" class="form-control border-2 rounded-pill py-3 px-4" placeholder="Cari Nama...">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" name="min_price" id="min_price" class="form-control border-2 rounded-pill py-3 px-4" placeholder="Harga Minimum">
                                    <input type="number" name="max_price" id="max_price" class="form-control border-2 rounded-pill py-3 px-4" placeholder="Harga Maksimum">
                                </div>
                                <div class="input-group mb-3">
                                    <select name="city" id="city" class="form-select border-2 rounded-pill py-3 px-4">
                                        <option value="">Pilih Kota</option>
                                        @foreach($kotas as $kota)
                                        <option value="{{ $kota->id }}">{{ $kota->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" name="capacity" id="capacity" class="form-control border-2 rounded-pill py-3 px-4" placeholder="Kapasitas">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100 py-3 px-4">Cari</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            
            @if ($paketWisata->count() > 0)
        @foreach ($paketWisata as $p)
        <div class="col-md-4">
            <div class="card  card-paket border-0 p-3 shadow-lg">
                <div class="bg-primary border m-2 position-relative" style="border-radius: 16px;">
                    <img src="{{ asset('/images/' . $p->gambar) }}" style="width: 100%; height: 300px; border-radius: 16px;" alt="">
                    <div class="bg-danger text-white px-4 py-1 rounded fw-semibold position-absolute rounded-pill" style="transform: rotate(30deg); top: 10px; right: -20px;">
                        {{ $p->durasi }}
                    </div>
                    
                    <span class="position-absolute bottom-0 end-0 m-2 bg-white px-2 py-1 rounded fw-semibold">
                        {{ $p->kategori }}
                    </span>
                </div>
                
                
                
                <div class="px-2">
                    <h3 class="fw-semibold my-3 text-center">{{ $p->nama }}.</h3>
                    <div class="mb-3 d-flex gap-2 flex-wrap">
                        @foreach ($p->kotas as $kota)
                            <span class="badge text-bg-success">{{ $kota->nama }}</span>
                        @endforeach
                    </div>
                    <p>
                        <span class="read-more">{{ Illuminate\Support\Str::limit($p->deskripsi, $limit = 130, $end = '...') }}</span>
                        <a href="{{ route('detailPaket', $p->slug) }}" class="show-more">Read more</a>
                    </p>
                    
                    
                    <p class="fw-bold m-0">Fasilitas : {{$p->fasilitas}}
                    </p>
                    <p class="fw-bold">Kendaraan : {{$p->kendaraan->nama}}  /<span class="text-danger"> ({{ $p->kendaraan->kapasitas }} orang) </span> 
                    </p>
                    <p class="fs-2 text-danger fw-bold text-center">Rp {{ number_format($p->harga, 0, ',', '.') }} <span class="fs-5 text-dark fw-normal"> / Paket</span> </p>
                </div>

                <a href="{{ route('detailPaket', $p->slug) }}" class="btn btn-paket  mb-1 btn-lg">Detail Info</a>
            </div>
        </div>
        @endforeach
        @else
        <div class="text-center col-md-12">
            <p>~ Tidak ada paket wisata yang sesuai dengan pencarian ~</p>
        </div>
        @endif
        </div>

        
    </div>
@endsection
@section('script')
    <script>

        function cekLogin(){
            Swal.fire({
                title: "Silakan login terlebih dahulu!",
                text: "Untuk dapat melakukan pemesanan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Login",
                cancelButtonText: "Kembali",
                confirmButtonColor: "#4481eb", 
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke halaman login
                    window.location.href = "/login";
                } 
            });
        }
    </script>
    <script>
        function toggleLoading() {
    var loading = document.getElementById('loading');
    loading.style.display = (loading.style.display == 'none') ? 'block' : 'none';
}
    </script>
@endsection
