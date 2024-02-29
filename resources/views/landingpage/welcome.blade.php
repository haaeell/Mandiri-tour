@extends('layouts.landingpage')
@section('content')
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
                                    <p>Lorem ipsum dolor sit,</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>Lorem ipsum dolor sit,</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>Lorem ipsum dolor sit,</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>Lorem ipsum dolor sit,</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class=" p-3 card-layanan">
                                    <p>Lorem ipsum dolor sit,</p>
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
        <div class="container py-5">
            <div class="col-md-12 text-center">
                <h1 class="fw-bold">GALLERY</h1>
            </div>
            <div class="row mt-5">
                <div class="col-md-7">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex architecto quis quos similique? Sint ipsam
                    porro nostrum magni alias corrupti odit repellat suscipit eius modi harum ut error, officiis eaque
                    rerum, quis velit est, tenetur blanditiis accusamus excepturi voluptas eos quas unde? Eligendi possimus
                    quisquam libero quia? Placeat, harum alias. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Libero ab voluptatum modi, ut ipsam laudantium iure fuga veniam soluta at necessitatibus accusamus rerum
                    ipsum alias a expedita nostrum vero consequatur odit! Dignissimos, blanditiis earum illo temporibus
                    ipsum deserunt eos autem! Beatae modi vel facere sed expedita, obcaecati praesentium! Atque, dolorum.
                </div>
                <div class="col-md-5">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus dolore eos nam, sed sunt ad
                    doloremque cupiditate repellendus, optio minima culpa vel, ipsam maxime rerum quia nihil cumque?
                    Accusantium eum voluptatum ipsa praesentium illum pariatur et nihil atque quibusdam repellat voluptate,
                    quod iste voluptatibus adipisci at quis quaerat similique dolore. Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Nisi facere modi, eius itaque ipsum iure dolore esse quo ducimus labore
                </div>

            </div>
            <div class="row  mt-3">
                <div class="col-md-5">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex architecto quis quos similique? Sint ipsam
                    porro nostrum magni alias corrupti odit repellat suscipit eius modi harum ut error, officiis eaque
                    rerum, quis velit est, tenetur blanditiis accusamus excepturi voluptas eos quas unde? Eligendi possimus
                    quisquam libero quia? Placeat, harum alias. Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Officia consectetur quibusdam sed, atque dolore necessitatibus odio reiciendis minus animi error?
                </div>
                <div class="col-md-7">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus dolore eos nam, sed sunt ad
                    doloremque cupiditate repellendus, optio minima culpa vel, ipsam maxime rerum quia nihil cumque?
                    Accusantium eum voluptatum ipsa praesentium illum pariatur et nihil atque quibusdam repellat voluptate,
                    quod iste voluptatibus adipisci at quis quaerat similique dolore. Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Consequatur quo rerum architecto recusandae dolor hic deserunt numquam pariatur libero
                    culpa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita similique, vel consequuntur
                    animi nemo ea hic asperiores fugiat voluptatem praesentium!
                </div>

            </div>
        </div>
    </section>
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
                    slidesPerView: 3 // Menampilkan 3 kartu ketika lebar layar >= 768px
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
@endsection
