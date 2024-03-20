<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mandiri Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('./css/landingpage.css')}}">
   <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.css" integrity="sha512-riTSV+/RKaiReucjeDW+Id3WlRLVZlTKAJJOHejihLiYHdGaHV7lxWaCfAvUR0ErLYvxTePZpuKZbrTbwpyG9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   
</head>
<body>
    <nav class="navbar navbar-expand-lg  bg-body-tertiary shadow-md" style="background: rgb(25,185,227);
    background: linear-gradient(90deg, rgba(25,185,227,1) 24%, #3f86ed 100%);!important;">
        <div class="container">
            <div class="d-flex gap-3 ">
                <span class="text-white fw-bold">Find your favorite travel destination!</span>
            </div>
          <div class="navbar-nav ">
              
            <a class="nav-link active  text-white fw-bold" aria-current="page" href="#"><i class="bi bi-telephone-forward-fill"></i> Contact Us</a>
          
        </div>
      </nav>
    
      <div class=" {{ request()->is('/') ? 'sticky-top' : ''}}">

          <nav class="navbar navbar-expand-lg navbar-light nav-parent  border-bottom border-2" style="background-color: white" >
            <div class="container">
                <img src="../assets/img/logo2.png" class="pt-3" style="max-width: 100px; height: auto;" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto gap-4 fw-semibold  ">
                        <li class="nav-item">
                            <a class="nav-link nav-menu {{ request()->is('/') ? 'menu-active' : ''}}" href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-menu {{ request()->is('diskusi') ? 'menu-active' : ''}}" href="">Wisata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-menu {{ request()->is('paket') ? 'menu-active' : ''}}" href="{{route('paketWisata')}}">Paket Wisata</a>
                        </li>
                        @if (Auth::check())
                            
                        <li class="nav-item">
                            <a class="nav-link nav-menu {{ request()->is('keluhan') ? 'menu-active' : ''}}" href="{{ route('keluhan') }}">
                                Keluhan
                                @php
                                    $unreadKeluhanCount = Auth::user()->unreadNotifications
                                        ->where('type', 'App\Notifications\KeluhanDitanggapiNotification')
                                        ->count();
                                @endphp
                        
                                @if($unreadKeluhanCount > 0)
                                    <span class="position-absolute top-20 start-70 translate-middle badge rounded-pill bg-danger">
                                        {{ $unreadKeluhanCount }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link nav-menu {{ request()->is('riwayat-pesanan') ? 'menu-active' : ''}}" href="{{route('riwayatPesanan')}}">Pesanan
                                @php
                                $unreadKeluhanCount = Auth::user()->unreadNotifications
                                    ->where('type', 'App\Notifications\KonfirmasiPembayaran')
                                    ->count();
                            @endphp
                    
                            @if($unreadKeluhanCount > 0)
                                <span class="position-absolute top-20 start-70 translate-middle badge rounded-pill bg-danger">
                                    {{ $unreadKeluhanCount }}
                                </span>
                            @endif
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link nav-menu {{ request()->is('about') ? 'menu-active' : ''}}" href="">About Us</a>
                        </li>
                    </ul>
                    
                    
                    
                    <ul class="navbar-nav">
                        @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->role == "admin")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
                                </li>
                            @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ Auth::user()->image ? asset('/images/' . Auth::user()->image) : asset('assets/img/profile.png') }}"
                                    alt="{{ Auth::user()->image ? 'User Image' : 'Default Image' }}" width="50" style="margin-right: 10px;">
                                    {{Auth::user()->name}}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Edit Profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                           Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="fw-bold nav-link " href="{{ route('login') }}"><button class="btn-login bn26">Login</button></a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="fw-bold nav-link nav-menu" href="{{ route('register') }}"><button class="btn">Register</button>
                                    </a>
                                </li>
                            @endif
                        @endauth
                    @endif
                    
                    </ul>
                </div>
            </div>
        </nav>
    
        
      </div>

      
</body>
    
    <a href="https://api.whatsapp.com/send?phone=6285321726312&text=Halo,%20saya%20ingin%20mendapatkan%20informasi%20mengenai%20Mandiri%20Tour%20&%20Travel" target="_blank" class="whatsapp-btn"><i class="bi bi-whatsapp"></i></a>
    <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top"><i class="bi bi-arrow-up"></i></button>

    @yield('content')


    <script>
window.onload = function() {
  window.addEventListener('scroll', toggleScrollToTopBtn);
}

function toggleScrollToTopBtn() {
  var btn = document.getElementById('scrollToTopBtn');
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    btn.style.display = 'block';
  } else {
    btn.style.display = 'none';
  }
}

function scrollToTop() {
  document.body.scrollTop = 0; // Untuk browser Safari
  document.documentElement.scrollTop = 0; // Untuk browser lainnya
}

    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @yield('script')

    
    <script>
        function showImage(imageElement) {
            const imageUrl = imageElement.src;
    
            Swal.fire({
                imageUrl: imageUrl,
                imageAlt: 'Custom image',
                
            });
        }
    </script>
     @if ($errors->any())
     <script>
         let errorMessages = '';
         @foreach ($errors->all() as $error)
             errorMessages += "{{ $error }}\n";
         @endforeach

         Swal.fire({
             icon: 'error',
             title: 'Oops...',
             text: errorMessages,
         });
     </script>
 @endif
    @if (session('success') || session('error'))
    <script>
        $(document).ready(function() {
            var successMessage = "{{ session('success') }}";
            var errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: successMessage,
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        });
    </script>
@endif
    
</body>
</html>