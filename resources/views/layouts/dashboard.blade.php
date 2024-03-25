<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard </title>



    <link rel="shortcut icon" href="{{ asset('../assets') }}/img/logo2.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../assets') }}/img/logo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('../assets') }}/compiled/css/app.css">
    <link rel="stylesheet" href="{{ asset('../assets') }}/compiled/css/app-dark.css">
    <link rel="stylesheet" href="{{ asset('../assets') }}/compiled/css/iconly.css">
    <link rel="stylesheet" href="{{ asset('../assets') }}/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="{{ asset('../assets') }}/compiled/css/table-datatable.css">

    <link rel="stylesheet" href="{{ asset('../assets') }}/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="{{ asset('../assets') }}/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="{{ asset('../assets') }}/extensions/toastify-js/src/toastify.css">

    <link rel="stylesheet" href="{{ asset('../assets') }}/compiled/css/app.css">
    <link rel="stylesheet" href="{{ asset('../assets') }}/compiled/css/app-dark.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<style>
    .select2-container {
        z-index: 9999999 !important;
        /* Atur nilai z-index yang sangat tinggi */
    }

    .modal-open .select2-container {
        z-index: 1050;
        /* Sesuaikan dengan z-index modal */
    }

    .modal-content{
        border-radius: 24px!important;
        padding: 12px;
    }

    .bg-primary {
        background-color: #f43f5e !important;
    }
    .bg-danger {
        background-color: #dc2626 !important;
    }

    .badge{
       
        border-radius: 24px
    }

    .bg-success{
        background-color: #15803d !important;
    }

    .bg-secondary{
        background-color: #1c1917!important;
    }

    .btn-primary{
        background-color: #2563eb !important;
    }

    .btn-primary:hover{
        background-color: #1e40af !important;
    }
    .btn-warning{
        background-color:  #facc15 !important;
        border: none
    }

    .btn-warning:hover{
        background-color: #fde047  !important;
        border: none;
    }
    .btn-danger{
        background-color: #dc2626 !important;
    }

    .btn-danger:hover{
        background-color: #991b1b !important;
    }
    .btn-info{
        background-color: #06b6d4 !important;
    }

    .btn-info:hover{
        background-color: #0891b2 !important;
    }
    .btn-success{
        background-color: #34d399 !important;
        border: none;
    }
    .btn-success:hover{
        background-color: #10b981 !important;
    }
    .btn-secondary{
        background-color: #64748b !important;
        border: none;
    }
    .btn-secondary:hover{
        background-color: #334155 !important;
    }

    .bg-info{
        background-color: #6d28d9 !important;
    }





    .btn{
        padding: 10px 16px;
        border-radius: 8px
    }
</style>

<body>
    <script src="{{ asset('../assets') }}/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('../assets') }}/img/logo2.png" class="pt-3"
                                    style="max-width: 100px; height: auto;" alt=""></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item  {{ request()->is('home') ? 'active' : '' }} ">
                            <a href="{{ route('home') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Menu</li>
                        <li
                            class="sidebar-item has-sub {{ request()->is('kota') || request()->is('wisata') || request()->is('hotel') || request()->is('bus') || request()->is('paket-wisata') ? 'active' : '' }}">

                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Data Wisata</span>
                            </a>

                            <ul class="submenu ">

                                <li class="submenu-item {{ request()->is('wisata') ? 'active' : '' }} ">
                                    <a href={{ route('wisata.index') }} class="submenu-link">Wisata</a>

                                </li>

                                <li class="submenu-item {{ request()->is('kota') ? 'active' : '' }} ">
                                    <a href={{ route('kota.index') }} class="submenu-link">Kota</a>

                                </li>
                                <li class="submenu-item {{ request()->is('kategori') ? 'active' : '' }} ">
                                    <a href={{ route('kategori.index') }} class="submenu-link">Kategori</a>

                                </li>
            
                                <li class="submenu-item {{ request()->is('kendaraan') ? 'active' : '' }} ">
                                    <a href={{ route('kendaraan.index') }} class="submenu-link">Kendaraan</a>

                                </li>

                                <li class="submenu-item {{ request()->is('paket-wisata') ? 'active' : '' }} ">
                                    <a href={{ route('paket-wisata.index') }} class="submenu-link">Paket Wisata</a>

                                </li>


                            </ul>


                        </li>
                        <li class="sidebar-item has-sub {{ request()->is('pemesanan') || request()->is('pemesanan-baru') || request()->is('pesanan-diterima') || request()->is('pesanan-dibatalkan') || request()->is('menunggu-konfirmasi') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-basket3-fill"></i>
                                <span>Pemesanan
                                    @php
                                        $unreadKeluhanCount = Auth::user()->unreadNotifications
                                            ->where('type', 'App\Notifications\PemesananBaru')
                                            ->count();
                                    @endphp
                            
                                    @if($unreadKeluhanCount > 0)
                                        <span class="position-absolute top-20 start-70 translate-middle badge rounded-pill bg-danger">
                                            {{ $unreadKeluhanCount }}
                                        </span>
                                    @endif

                                    
                                </span>
                            </a>
                            <ul class="submenu">
                               
                                <li class="submenu-item {{ request()->is('pemesanan-baru') ? 'active' : '' }} ">
                                    <a href="{{ route('pemesanan.pemesanan-baru') }}" class="submenu-link">Pesanan Baru
                                        @php
                                        $unread = Auth::user()->unreadNotifications
                                            ->where('type', 'App\Notifications\PemesananBaru')
                                            ->count();
                                    @endphp
                            
                                    @if($unread > 0)
                                        <span class="position-absolute top-20 start-70 translate-middle badge rounded-pill bg-danger">
                                            {{ $unread }}
                                        </span>
                                    @endif
                                    </a>
                                </li>
                                <li class="submenu-item {{ request()->is('menunggu-konfirmasi') ? 'active' : '' }}">
                                
                                    <a href="{{ route('pemesanan.menunggu-konfirmasi') }}" class="submenu-link">Menunggu Konfirmasi
                                        @php
                                    $unread = Auth::user()->unreadNotifications
                                    ->where('type', 'App\Notifications\KonfirmasiPembayaranNotification')
                                    ->count();
                            @endphp
                    
                            @if($unread > 0)
                                <span class="position-absolute top-40 start-50 translate-middle badge rounded-pill bg-danger">
                                    {{ $unread }}
                                </span>
                            @endif
                                    </a>
                                </li>
                                <li class="submenu-item {{ request()->is('pesanan-dibatalkan') ? 'active' : '' }} ">
                                    <a href="{{ route('pemesanan.pesanan-dibatalkan') }}" class="submenu-link">Pesanan Dibatalkan
                                        {{-- <span class="position-absolute top-40 start-80 translate-middle badge rounded-pill bg-danger">
                                            {{
                                                \App\Models\Pemesanan::where('status_pembayaran', 'Pemesanan Dibatalkan')->count()
                                            }}
                                        </span> --}}
                                    </a>
                                </li>
                                <li class="submenu-item {{ request()->is('pesanan-diterima') ? 'active' : '' }}">
                                    <a href="{{ route('pemesanan.pesanan-diterima') }}" class="submenu-link">Pesanan Diterima
                                        {{-- <span class="position-absolute top-40 start-80 translate-middle badge rounded-pill bg-success">
                                            {{
                                                \App\Models\Pemesanan::where('status_pembayaran', 'Pembayaran Diterima')->count()
                                            }}
                                        </span> --}}
                                    </a>
                                </li>
                                <li class="submenu-item {{ request()->is('pemesanan') ? 'active' : '' }} ">
                                    <a href="{{ route('pemesanan.index') }}" class="submenu-link">Seluruh data pesanan  </a>
                                </li>
                            </ul>
                        </li>
                        </li>
                        <li class="sidebar-item {{ request()->is('laporan') ? 'active' : '' }}  ">
                            <a href="{{ route('laporan.index') }}" class='sidebar-link'>
                                <i class="bi bi-clipboard-data-fill"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('admin/keluhan') ? 'active' : '' }}">
                            <a href="{{ route('keluhan.index-admin') }}" class='sidebar-link'>
                                <i class="bi bi-chat-square-text-fill"></i>
                                <span>Keluhan</span>

                                @php
                                $unreadKeluhanCount = Auth::user()->unreadNotifications
                                    ->where('type', 'App\Notifications\KeluhanBaruNotification')
                                    ->count();
                            @endphp
                    
                            @if($unreadKeluhanCount > 0)
                                <span class="position-absolute top-40 start-50 translate-middle badge rounded-pill bg-danger">
                                    {{ $unreadKeluhanCount }}
                                </span>
                            @endif
                            </a>
                        </li>
                        


                        {{-- <li class="sidebar-item  ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-chat-heart-fill"></i>
                                <span>Testimoni</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-item {{ request()->is('galeri') ? 'active' : '' }} ">
                            <a href={{ route('galeri.index') }} class='sidebar-link'>
                                <i class="bi bi-image-fill"></i>
                                <span>Gallery</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('emails?status=draft') || request()->is('emails?status=draft') ? 'active' : '' }}">
                            <a href="{{ route('email.index', ['status' => 'draft']) }}" class='sidebar-link'>
                                <i class="bi bi-envelope-check-fill"></i>
                                <span>Email Marketing</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item  {{ request()->is('users') ? 'active' : '' }} ">
                            <a href={{ route('users.index') }} class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Data Users</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3 d-flex justify-content-between align-items-center ">
                <div>
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </div>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="profileDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="mx-3 fw-bold">Welcome, {{ Auth::user()->name }}</span>
                        <img src="{{ asset('../assets') }}/img/profile.png" alt="Profile"
                            style="width: 40px; height: 40px; border-radius: 50%;">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="bi bi-power"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </header>
            <div class="page-title">
                <div class="row mt-3">
                    <div class="col-12 col-md-6 order-md-1 order-last">

                        <h3 class="mb-3 fw-bold">@yield('title')</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('breadcumb')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="page-content">

                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('../assets') }}/static/js/components/dark.js"></script>
    <script src="{{ asset('../assets') }}/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.rupiah').mask("#.##0", {
                reverse: true
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <script>
        $('button.delete-btn').click(function(event) {
            event.preventDefault();

            const form = $(this).closest('form');
            const name = $(this).data('name');

            Swal.fire({
                text: `Apakah Anda yakin ingin menghapus ${name}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else {
                    form.close();
                }
            });
        });
    </script>
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

    <script>
        $(document).ready(function() {
            const phoneInput = $("#phone");
            const phoneError = $("#phone-error");
            const phoneMax = $("#phone-max")

            phoneInput.on("input", function() {
                const inputValue = phoneInput.val();

                // Hapus semua karakter selain angka dari nilai input
                const numericValue = inputValue.replace(/\D/g, '');

                if (numericValue.length > 15) {
                    phoneMax.text("Maksimal panjang 15 karakter.");
                } else {
                    phoneMax.text(""); // Hapus pesan kesalahan panjang jika valid
                }

                if (inputValue !== numericValue) {
                    phoneError.text("Input hanya boleh berisi angka.");
                } else {
                    phoneError.text(""); // Hapus pesan kesalahan karakter jika valid
                }

                // Mengatur nilai input dengan hanya angka, maksimal 15 karakter
                phoneInput.val(numericValue.substring(0, 15));
            });
        });
    </script>

    <script src="{{ asset('../assets') }}/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js">
    </script>
    <script src="{{ asset('../assets') }}/compiled/js/app.js"></script>

    <script
        src="{{ asset('../assets') }}/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
    </script>
    <script
        src="{{ asset('../assets') }}/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="{{ asset('../assets') }}/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('../assets') }}/static/js/pages/simple-datatables.js"></script>
    <script src="{{ asset('../assets') }}/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js">
    </script>
    <script
        src="{{ asset('../assets') }}/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="{{ asset('../assets') }}/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js">
    </script>
    <script src="{{ asset('../assets') }}/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js">
    </script>
    <script src="{{ asset('../assets') }}/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js">
    </script>
    <script src="{{ asset('../assets') }}/extensions/filepond/filepond.js"></script>
    <script src="{{ asset('../assets') }}/extensions/toastify-js/src/toastify.js"></script>
    <script src="{{ asset('../assets') }}/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('../assets') }}/static/js/pages/dashboard.js"></script>
    <script src="{{ asset('../assets') }}/static/js/pages/filepond.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


</body>

</html>
