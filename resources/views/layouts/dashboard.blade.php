<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard </title>



    <link rel="shortcut icon" href="../assets/img/logo2.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="./assets/compiled/css/table-datatable.css">

    <link rel="stylesheet" href="assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="assets/extensions/toastify-js/src/toastify.css">

    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html"><img src="../assets/img/logo2.png" class="pt-3"
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
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Data Wisata</span>
                            </a>

                            <ul class="submenu ">

                                <li class="submenu-item  ">
                                    <a href="component-accordion.html" class="submenu-link">Wisata</a>

                                </li>

                                <li class="submenu-item  ">
                                    <a href="component-alert.html" class="submenu-link">Kota</a>

                                </li>

                                <li class="submenu-item  ">
                                    <a href="component-badge.html" class="submenu-link">Paket Wisata</a>

                                </li>


                            </ul>


                        </li>
                        <li class="sidebar-item  ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-basket3-fill"></i>
                                <span>Pemesanan</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-chat-square-text-fill"></i>
                                <span>Keluhan</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-chat-heart-fill"></i>
                                <span>Testimoni</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-image-fill"></i>
                                <span>Gallery</span>
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
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading  d-flex justify-content-between align-items-center">
                <h3>@yield('title')</h3>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary rounded-2" type="submit">
                        <i class="bi bi-power"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
            <div class="page-content">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('script')
    <script>
        $(document).on('click', '.delete-btn', function() {
    const id = $(this).data('id');

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#868e96',
            confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: '/users/' + id,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    Swal.fire('Sukses!', data.message, 'success');
                    location.reload();
                },
                error: function (data) {
                    Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                }
            });
        }
    });
});

    </script>
    <script>
       $(document).ready(function () {
    const phoneInput = $("#phone");
    const phoneError = $("#phone-error");
    const phoneMax = $("#phone-max")

    phoneInput.on("input", function () {
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $('.delete-button').on('click', function (e) {
            e.preventDefault();
    
            var id = $(this).data('id');
            
            var selectedItems = [];
            $('input[name="selectedItems[]"]:checked').each(function () {
                selectedItems.push($(this).val());
            });
    
            if (selectedItems.length > 0) {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menghapus data yang dipilih?',
                    icon: 'warning',
                    showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#868e96',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route("users.batchDelete") }}',
                            method: 'POST',
                            data: {
                                selectedItems: selectedItems
                            },
                            success: function (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Data Berhasil Dihapus',
                                });
                                location.reload();
                            },
                            error: function (error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    html: 'Data Gagal Dihapus',
                                });
                            }
                        });
                    }
                });
            } else {
                // Tidak ada data yang dipilih, jadi tidak perlu menampilkan SweetAlert konfirmasi
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Tidak ada data yang dipilih untuk dihapus.',
                });
            }
        });
    </script>
    <script src="./assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>

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
    <script src="assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="assets/static/js/pages/filepond.js"></script>


</body>

</html>
