@extends('layouts.landingpage')


@section('content')

<style>
    .item{
        height: 400px;
    }
</style>
    <section class="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center text-light" style="margin-top: 150px">
                    <div class="col-md-10 mx-auto">
                        <p id="welcomeText" class="m-0 fs-4 fw-semibold p-3" style="border: 3px solid #fff; border-radius: 10px 18px 10px 18px; text-align: center;"><span id="welcome"></span></p>
                    </div>
                    
                    <h1 class="fw-bold m-0 mt-3">Mandiri Tour & Travel</h1>
                    <div class="col-md-8 mx-auto ">

                        <p class="mb-3 fw-semibold fs-5 ">Temukan Keindahan Indonesia Bersama Kami!</p>
                    </div>
                    <a href="/paket" class="btn btn-primary fw-bold mt-3 btn-login bn26">Get Started</a> 
                </div>
            </div>
            
        </div>
    </section>


    {{-- LAYANAN --}}
    <section class="py-5 " style="background-color: rgb(224, 241, 248)">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 text-center">
                <h2 class="fw-bold ">LAYANAN</h2>
                <div class="container mt-5">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($kategori as $item)
                                
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>{{$item->nama}}</p>
                                </div>
                            </div>
                            @endforeach
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
                <h2 class="fw-bold">PAKET WISATA POPULER</h2>
            </div>
            <div class="swiper SwiperPaket mt-5">
                <div class="swiper-wrapper">
                    @foreach ($topPaketWisata as $p)
                    <div class="swiper-slide">
                        <a href="{{ route('detailPaket', $p->slug) }}" class="card-link text-decoration-none text-dark">
                            <div class="card card-paket border-0 p-3 my-3">
                                <div class="bg-primary border m-2 position-relative" style="border-radius: 16px;">
                                    <img src="{{ asset('/images/' . $p->gambar) }}" style="width: 100%; height: 300px; border-radius: 16px;" alt="">
                                    <div class="bg-danger text-white px-4 py-1 rounded fw-semibold position-absolute rounded-pill" style="transform: rotate(30deg); top: 10px; right: -20px;">
                                        {{ $p->durasi }}
                                    </div>
                                    <span class="position-absolute bottom-0 end-0 m-2 bg-white px-2 py-1 rounded fw-semibold">
                                        {{ $p->kategori->nama }}
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
                        </a>
                    </div>
                @endforeach
                

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="text-center my-4">
                <a
                    name=""
                    id=""
                    class="btn btn-login bn26"
                    href="/paket"
                    role="button"
                    >Lihat Semua</a
                >
            </div>
            <hr>
            
        </div>
    </section>

    {{-- MENGAPA MEMILIH KAMI--}}
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Mengapa Memilih Kami?</h2>
        
        <div class="row py-4 justify-content-center align-items-center shadow" style="border: 2px solid #aeaeae; border-radius: 24px;">
            <div class="col-md-9 order-md-1 order-2 text-center-sm">
                <h3 class="fw-semibold">Paket All-in-One</h3>
                <p class="text-md-left text-center-sm">Kami menyediakan paket wisata yang mencakup segala sesuatu mulai dari tiket, akomodasi, transportasi lokal, hingga tur dan kegiatan, sehingga Anda tidak perlu repot mengatur semuanya sendiri.</p>
            </div>
            <div class="col-md-2 order-md-2 order-1 text-md-right text-center-sm mb-3 mb-md-0">
                <img class="USPItemImage" src="https://ik.imagekit.io/tvlk/image/imageResource/2017/09/13/1505323179630-8705894a194d158b966e77f8004a8c71.png?tr=q-75" alt="Paket All-in-One">
            </div>
        </div>
        
        <div class="row py-4 justify-content-center my-4 align-items-center shadow" style="border: 2px solid #aeaeae; border-radius: 24px;">
            <div class="col-md-2 order-md-1 mb-3 mb-md-0 text-md-left text-center-sm">
                <img class="USPItemImage" src="https://ik.imagekit.io/tvlk/image/imageResource/2017/09/13/1505323164752-40c57d1e4907fba0ddd47bdb99fbeb56.png?tr=q-75"/>
            </div>
            <div class="col-md-9 order-md-2 text-md-right text-center-sm">
                <h3 class="fw-semibold">Layanan Personal</h3>
                <p class="text-md-right text-center-sm">Kami memahami bahwa setiap pelanggan memiliki kebutuhan dan preferensi yang berbeda. Tim kami siap memberikan layanan yang personal dan membantu Anda merencanakan liburan yang sesuai dengan keinginan Anda.</p>
            </div>
        </div>
        
        <div class="row py-4 justify-content-center align-items-center shadow" style="border: 2px solid #aeaeae; border-radius: 24px;">
            <div class="col-md-9 order-md-1 order-2 text-md-left text-center-sm">
                <h3 class="fw-semibold">Jaminan Keamanan dan Kepuasan Pelanggan</h3>
                <p class="text-md-left text-center-sm">Kepuasan dan keselamatan pelanggan adalah prioritas utama kami. Kami bekerja keras untuk memastikan bahwa setiap perjalanan Anda berjalan lancar dan menyenangkan.</p>
            </div>
            <div class="col-md-2 order-md-2 order-1 text-md-right text-center-sm mb-3 mb-md-0">
                <img class="USPItemImage" src="https://ik.imagekit.io/tvlk/image/imageResource/2017/09/13/1505323174671-6761c1f627f2e2cf37f6a66829380405.png?tr=q-75" alt="Jaminan Keamanan dan Kepuasan Pelanggan">
            </div>
        </div>
    </div>
    
    
    
    {{-- GALLERY --}}
    <section>
        <div class=" py-5">
            <div class="col-md-12 text-center mb-5">
                <h2 class="fw-bold">GALLERY</h2>
            </div>
            <div class="owl-carousel owl-theme">
                @foreach ($galeri as $item)
                <div class="item">
                    <img src="{{ asset('/images/' . $item->gambar) }}" alt="{{$item->gambar}}">
                </div> 
                @endforeach
                
            </div>
        </div>
    </section>
    {{-- TESTIMONI --}}
    
    {{-- <section>
        <div class="container py-5">
            <div class="col-md-12 text-center mb-5">
                <h2 class="fw-bold">TESTIMONI</h2>
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
    </section> --}}

    
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
                        @foreach ($kategori as $item)
                        <li><a class="nav-link" href="{{ route('paketWisata', ['min_price' => '', 'max_price' => '', 'city' => '', 'kendaraan' => '', 'kategori' => $item->id]) }}">{{ $item->nama }}</a></li>
                    @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4 class="fw-semibold mt-3 mb-5">KONTAK KAMI</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-whatsapp"></i> <a class="text-decoration-none text-dark" href="https://wa.me/+62867645642" target="_blank">Whatsapp : +62867645642</a></li>
                        <li class="mb-2"><i class="bi bi-envelope"></i> <a class="text-decoration-none text-dark" href="mailto:your_email@example.com">Email : your_email@example.com</a></li>
                        <li class="mb-2"><i class="bi bi-instagram"></i> <a class="text-decoration-none text-dark" href="https://instagram.com/mandiritour_subang" target="_blank">Instagram : mandiritour_subang</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </footer>

   
@endsection

@section('script')

    <script>

@auth
        var username = "{{ Auth::user()->name }} ,";
    @else
        var username = ''; // Atur username menjadi string kosong jika pengguna belum login
    @endauth
        var typed = new Typed('#welcome', {
            strings: [`${username} Selamat Datang di Mandiri Tour Subang`, 'Ayo menikmati liburanmu bersama kami!'],
      typeSpeed: 50,
        loop: true
        });
    </script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true, // Menampilkan 1 kartu pada tampilan awal
            breakpoints: {
                768: {
                    slidesPerView: 4 // Menampilkan 3 kartu ketika lebar layar >= 768px
                },
                200: {
                    slidesPerView: 2// Menampilkan 3 kartu ketika lebar layar >= 768px
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
