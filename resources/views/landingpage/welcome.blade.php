@extends('layouts.landingpage')


@section('content')

<style>
    .item{
        height: 400px;
    }
</style>
    <Section class="banner">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 text-center text-light">
                        <span>Lorem ipsum dolor sit amet.</span>
                        <h1 style="font-size: 64px" class="text-center fw-bold ">LANDINGPAGE</h1>
                    </div>
                </div>
            </div>

        </div>
    </Section>
    {{-- PROFIL --}}
    <section>
        <div class="container py-5">
            <div class="col-md-12 text-center">
                <h1 class="fw-bold">PROFIL PERUSAHAAN</h1>
            </div>
            <div class="row d-flex justify-content-center  align-items-center mt-5 ">

                <div class="col-md-6 p-4">
                    <h2 class="fw-semibold">Lorem, ipsum dolor.</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus modi dolorum voluptate voluptates
                        rerum fugit nostrum a labore, doloremque voluptatibus ipsam voluptatum esse velit quod assumenda
                        eius rem dolore sint doloribus nesciunt sequi nihil repellendus</p>
                </div>
                <div class="col-md-6  p-4">
                    <img src="../assets/img/logo2.png" class="pt-3" style="max-width: 400px; height: auto;"
                        alt="">
                </div>

            </div>
        </div>
    </section>
    {{-- LAYANAN --}}
    <section class="py-5 " style="background-color: rgb(224, 241, 248)">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 text-center">
                <h1 class="fw-bold">LAYANAN</h1>
                <div class="container mt-5">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>Studi Tour</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>Studi Wisata</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>Wisata Religi</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>Studi Tiru</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>Wisata Keluarga</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- PAKET WISATA --}}
    <section>
        <div class="container py-5">
            <div class="col-md-12 text-center">
                <h1 class="fw-bold">PAKET WISATA</h1>
            </div>
            <div class="swiper SwiperPaket mt-5">
                <div class="swiper-wrapper">
                    @foreach ($paketwisata as $p)
                        <div class="swiper-slide">
                            <div class="card  card-paket border-0 p-3 my-3">
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
                                    <div class="mb-3 d-flex flex-wrap gap-2">
                                        @foreach ($p->kotas as $kota)
                                            <span class="badge text-bg-primary">{{ $kota->nama }}</span>
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

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>
    {{-- GALLERY --}}
    <section>
        <div class=" py-5">
            <div class="col-md-12 text-center mb-5">
                <h1 class="fw-bold">GALLERY</h1>
            </div>
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <img src="https://1.bp.blogspot.com/-JmEjqT5m8sI/WuKP24mzJHI/AAAAAAAAGuU/ZFBL1Q4qJJYN79Af_DtyY1f_6yglPuwuQCLcBGAs/s1600/DSCF5243.JPG" alt="">
                </div>
                <div class="item">
                    <img src="https://i.pinimg.com/736x/28/28/0e/28280e037de5292ba789cdd75ec9074d.jpg" alt="">
                </div>
                <div class="item">
                    <img src="https://1.bp.blogspot.com/-UEXKl_OtP8U/YAZlBHjR-XI/AAAAAAAALFs/HN-ohrjflogxvR2Cb9S-6v59tsHt5xShgCLcBGAsYHQ/s1200/jasa-dokumentasi-honeymoon.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    {{-- TESTIMONI --}}
    
    <section>
        <div class="container py-5">
            <div class="col-md-12 text-center mb-5">
                <h1 class="fw-bold">TESTIMONI</h1>
            </div>
            <div class="swiper swiperTestimoni mt-5">
                <div class="swiper-wrapper">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="swiper-slide">
                            <div class="card p-3 shadow" style="border-radius: 24px;border:2px solid #25aae1">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{asset('assets/img/profile.png')}}" style="width: 60px" alt="">
                                    <span>Haikal alexande</span>
                                </div>
                                <div class="d-flex my-3 text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div class="">
                                    
                                    <p><i class="bi bi-quote fs-4"></i> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem ipsam tempore sequi quidem perferendis, sunt modi animi in quia nemo.</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            
        </div>
    </section>

    {{-- FOOTER --}}
    <footer style="border-top: 2px solid #25aae1" class="shadow">
        <div class="container text-center py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-4">
                    <img src="{{asset('assets/img/logo2.png')}}" style="width: 70%" alt="">
                    <p>GG.Merpati Dsn.Betok RT 05/02 Desa Mulyasari Kecamatan Binong Kabupaten Subang Jawa Barat 41253 </p>
                </div>
                <div class="col-md-4 ">
                    <h4 class="fw-semibold mt-3 mb-5">LAYANAN</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">Studi Tour</li>
                        <li class="mb-2">Studi Banding</li>
                        <li class="mb-2">Wisata Keluarga</li>
                        <li class="mb-2">Wisata Religi</li>
                        <li class="mb-2">DLL</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4 class="fw-semibold mt-3 mb-5">KONTAK KAMI</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-whatsapp"></i> Whatsapp : +62867645642</li>
                        <li class="mb-2"><i class="bi bi-envelope"></i> Email : +62867645642</li>
                        <li class="mb-2"><i class="bi bi-instagram"></i> Instagram : mandiritour_subang</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('script')

    </script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true, // Menampilkan 1 kartu pada tampilan awal
            breakpoints: {
                768: {
                    slidesPerView: 4 // Menampilkan 3 kartu ketika lebar layar >= 768px
                }
            },
            autoplay: {
                delay: 1000, // Menentukan durasi antara perpindahan slide dalam milidetik (misalnya, 3000ms = 3 detik)
            },
            pagination: {
                el: ".swiper-pagination",
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <script>
        var swiper = new Swiper(".SwiperPaket", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true, // Menampilkan 1 kartu pada tampilan awal
            breakpoints: {
                768: {
                    slidesPerView: 3 
                }
            },
            autoplay: {
                delay: 2000, // Menentukan durasi antara perpindahan slide dalam milidetik (misalnya, 3000ms = 3 detik)
            },
            pagination: {
                el: ".swiper-pagination",
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <script>
        var swiper = new Swiper('.swiperTestimoni', {
          slidesPerView: 1,
          spaceBetween: 30,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          loop:true,
          breakpoints: {
            // Layar sedang dan kecil
            768: {
              slidesPerView: 4
            },
            // Layar kecil
            576: {
              slidesPerView: 1
            }
          },
          autoplay: {
                delay: 1000, // Menentukan durasi antara perpindahan slide dalam milidetik (misalnya, 3000ms = 3 detik)
            },
        });
      </script>
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.owl-carousel').owlCarousel({
    loop:true,
    center: true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:2
        }
    }
})
    </script>
      
@endsection
