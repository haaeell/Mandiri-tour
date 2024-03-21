<!-- resources/views/pemesanan/select_paket.blade.php -->

@extends('layouts.landingpage')

@section('content')
    <div class="container py-5">
        <div class="row d-flex justify-content-center " >
            
            
            <h2 class="fw-bold text-center mb-4">Paket Wisata</h2>
            
            
            <div class=" d-flex align-items-center gap-2 justify-content-center text-center mb-4 col-10 d-flex ">
                <div class="col-10 col-md-10">

                    <form action="" method="get" class="w-100 position-relative">
                        <input type="search" style="border-radius: 32px; border:2px solid #3f86ed"  name="keyword" id="search" placeholder="Cari Tempat wisata, kota atau kendaraan" class="form-control px-3 py-2 my-4 shadow">
                        <div class="position-absolute top-50 end-0 translate-middle-y">
                            <span class="input-group-text" style="background-color: transparent; border: none;"><i class="bi bi-search"></i></span>
                        </div>
                    </form>
                    
                    
                </div>
                <div>

                    <button type="button" class="btn btn-outline-primary shadow " style="border-radius: 32px;" data-bs-toggle="modal" data-bs-target="#filterModal">
                        Filter  <i class="bi bi-funnel-fill"></i>
                    </button>
                </div>
            
            </div>
            <div class="text-start col-md-9 mb-4">
     @if (!empty($search) || !empty($min_price) || !empty($max_price) || !empty($city_id) || !empty($kendaraan_id))
                <div class="search-info">
                    <p>Menampilkan hasil pencarian:  @if (!empty($search))
                        <strong>{{ $search }}</strong>
                    @endif</p>
                    <ul>
                        @if (!empty($min_price))
                            <li>Harga minimum: <strong>{{ $min_price }}</strong></li>
                        @endif

                        @if (!empty($max_price))
                            <li>Harga maksimum: <strong>{{ $max_price }}</strong></li>
                        @endif

                        @if (!empty($city_id))
                            <li>Kota: <strong>{{ $nama_kota }}</strong></li>
                        @endif

                        @if (!empty($kendaraan_id))
                            <li>Kendaraan: <strong>{{ $nama_kendaraan }}</strong></li>
                        @endif
                    </ul>
                </div>
    @endif
    
            </div>
            <div class="modal fade rounded-pill" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class=" text-center fw-semibold" id="filterModalLabel">Filter Paket Wisata</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="get">
                               
                                <div class="input-group mb-3">
                                    <input type="number" name="min_price" id="min_price" class="form-control border-2 rounded-pill py-3 px-4" placeholder="Harga Minimum">
                                    <input type="number" name="max_price" id="max_price" class="form-control border-2 rounded-pill py-3 px-4" placeholder="Harga Maksimum">
                                </div>
                                <div class="input-group mb-3">
                                    <select name="city" id="city" class="form-select  border-2 rounded-pill py-3 px-4">
                                        <option value="">Pilih Kota</option>
                                        @foreach($kotas as $kota)
                                        <option value="{{ $kota->id }}">{{ $kota->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <select name="kendaraan" class="form-select border-2 rounded-pill py-3 px-4" >
                                        <option value="">Pilih Kendaraan</option>
                                        @foreach ($kendaraan as $kendaraan)
                                            <option value="{{ $kendaraan->id }}">{{ $kendaraan->nama }}</option>
                                        @endforeach
                                    </select>
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
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($paketWisata as $p)
                <div class="swiper-slide">
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
                            <div class="mb-3 d-flex gap-2 flex-wrap ">
                                @foreach ($p->kotas as $kota)
                                    <span class="badge bg-primary">{{ $kota->nama }}</span>
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
                        <a href="{{ route('detailPaketForm', $p->slug) }}" class="btn btn-paket2 mt-2  mb-1 btn-lg">Pesan Sekarang</a>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
        
    @else
        
        <div class="text-center col-md-12">
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/data-search-not-found-7464562-6109670.png"  alt="">
            <p class="fw-semibold fs-5">~ Tidak ada paket wisata yang sesuai dengan pencarian ~</p>
        </div>
    @endif
        </div>

        
    </div>
@endsection
@section('script')
<script>
    var swiper = new Swiper('.swiper-container', {
        // Konfigurasi Swiper.js dengan breakpoint
        slidesPerView: 'auto',
        breakpoints: {
            // Breakpoint untuk layar besar (>= 992px)
            992: {
                slidesPerView: 3,
            },
            // Breakpoint untuk layar sedang (768px - 991px)
            768: {
                slidesPerView: 2,
            },
            // Breakpoint untuk layar kecil (< 768px)
            0: {
                slidesPerView: 1,
            }
        },
        spaceBetween: 30,
    });
</script>
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
    {{-- <script>
        function toggleLoading() {
    var loading = document.getElementById('loading');
    loading.style.display = (loading.style.display == 'none') ? 'block' : 'none';
}
    </script> --}}
@endsection
