
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard </title>
    <link rel="shortcut icon" href="../assets/img/logo2.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/png">
    
  
    <link rel="stylesheet" href="./assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="./assets/compiled/css/table-datatable.css">

    <link rel="stylesheet" href="assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">

    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<style>
    .select2-container {
    z-index: 9999999 !important; /* Atur nilai z-index yang sangat tinggi */
}

.modal-open .select2-container {
    z-index: 1050; /* Sesuaikan dengan z-index modal */
}
</style>
<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5 fixed-top">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="{{route('home')}}"><img src="../assets/img/logo2.png" class="pt-3"
                                style="max-width: 100px; height: auto;" alt=""></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2" >
                                        <img src="./assets/compiled/jpg/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">{{Auth::user()->name}}</h6>
                                        <p class="user-dropdown-status text-sm text-muted">Admin</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                  <li><a href="{{route('profile')}}" class="dropdown-item" href="#">Settings</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="bi bi-power"></i>
                                        <span>Logout</span>
                                    </button>
                                </form></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li
                                class="menu-item {{ request()->is('home') ? 'active' : '' }} ">
                                <a href="{{ route('home') }}" class='menu-link'>
                                    <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                                </a>
                            </li>
                            
                            <li
                                class="menu-item  has-sub {{ 
                                    (request()->is('kota') || request()->is('wisata') || request()->is('hotel')) || request()->is('bus') ? 'active' : '' 
                                }}">
                                <a href="#" class='menu-link'>
                                    <span><i class="bi bi-stack"></i> Data Wisata</span>
                                </a>
                                <div
                                    class="submenu ">
                                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                    <div class="submenu-group-wrapper">
                                        
                                        
                                        <ul class="submenu-group">
                                            
                                            <li
                                                class="submenu-item  {{ request()->is('wisata') ? 'active' : '' }} ">
                                                <a href={{ route('wisata.index') }}
                                                    class='submenu-link'>Wisata</a>
                                            </li>
                                            <li
                                                class="submenu-item  {{ request()->is('kota') ? 'active' : '' }} ">
                                                <a href={{ route('kota.index') }}
                                                    class='submenu-link'>Kota</a>
                                            </li>
                                            <li
                                                class="submenu-item  {{ request()->is('hotel') ? 'active' : '' }} ">
                                                <a href={{ route('hotel.index') }}
                                                    class='submenu-link'>Hotel</a>
                                            </li>
                                            <li
                                                class="submenu-item  {{ request()->is('bus') ? 'active' : '' }} ">
                                                <a href={{ route('bus.index') }}
                                                    class='submenu-link'>Bus</a>
                                            </li>
                                            <li
                                                class="submenu-item  {{ request()->is('bus') ? 'active' : '' }} ">
                                                <a href={{ route('bus.index') }}
                                                    class='submenu-link'>Paket Wisata</a>
                                            </li>
                                        </ul>
                                        
                                        
                                    
                                        
                                        
                                    </div>
                                </div>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-basket3-fill"></i> Pemesanan</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-chat-square-text-fill"></i> Keluhan</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-chat-heart-fill"></i> Testimoni</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  {{ request()->is('galeri') ? 'active' : '' }} ">
                                <a href={{ route('galeri.index') }} class='menu-link'>
                                    <span><i class="bi bi-image-fill"></i> Galeri</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  {{ request()->is('users') ? 'active' : '' }} ">
                                <a href={{ route('users.index') }} class='menu-link'>
                                    <span><i class="bi bi-people-fill"></i> Data Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </header>
<div style="margin-top: 200px"></div>
            <div class="content-wrapper container">
                
<div class="page-heading">
    <h3 class="mb-3 fw-bold">@yield('title')</h3>
</div>
<div >
    
    @yield('content')
</div>

            </div>
        </div>
    </div>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/static/js/pages/horizontal-layout.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    
    <script src="assets/compiled/js/app.js"></script>
    
    
<script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
    $('.select2').select2();
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
    
    <script src="./assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>

    <script src="assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script src="assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/static/js/pages/simple-datatables.js"></script>
    <script src="assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script src="assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
    <script src="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="assets/extensions/filepond/filepond.js"></script>
    <script src="assets/static/js/pages/filepond.js"></script>

</body>

</html>