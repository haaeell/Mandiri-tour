<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<style>
     .whatsapp-btn {
        position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #25d366; /* Warna hijau WhatsApp */
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff; /* Warna teks putih */
      text-decoration: none;
      font-size: 24px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-light nav-parent fixed-top border-bottom border-danger border-2" >
        <div class="container">
            <img src="../assets/img/logo2.png" class="pt-3" style="max-width: 100px; height: auto;" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto ">
                    <li class="nav-item">
                        <a class="nav-link nav-menu  {{ request()->is('/') ? 'menu-active' : ''}}" href="{{route('welcome')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-menu {{ request()->is('diskusi') ? 'menu-active' : ''}}" href="">Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-menu {{ request()->is('test') ? 'menu-active' : ''}}" href="">Paket Wisata</a>
                    </li>
                    @if (Auth::check())
                        
                    <li class="nav-item">
                        <a class="nav-link nav-menu {{ request()->is('test') ? 'menu-active' : ''}}" href="">Keluhan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-menu {{ request()->is('test') ? 'menu-active' : ''}}" href="">Pesanan</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link nav-menu {{ request()->is('about') ? 'menu-active' : ''}}" href="">About Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav gap-3">
                    @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->role == "admin")
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="fw-bold nav-link  btn-login px-4" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="fw-bold nav-link btn-login px-4 " href="{{ route('login') }}">Log In</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="fw-bold nav-link btn-register nav-menu " href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
                
                </ul>
            </div>
        </div>
    </nav>
    
    <a href="https://api.whatsapp.com/send?phone=6285321726312&text=Halo,%20saya%20ingin%20mendapatkan%20informasi%20mengenai%20Mandiri%20Tour%20&%20Travel" target="_blank" class="whatsapp-btn"><i class="bi bi-whatsapp"></i></a>
    @yield('content')
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</body>
</html>