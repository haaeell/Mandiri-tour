@extends('layouts.dashboard')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card shadow-lg">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon red mb-2">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Keluhan</h6>
                            <h6 class="font-extrabold mb-0">{{ $totalKeluhan }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card shadow-lg">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon green mb-2">
                                <i class="iconly-boldAdd-User"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Paket Wisata</h6>
                            <h6 class="font-extrabold mb-0">{{ $totalPaketWisata }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card shadow-lg">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon yellow mb-2">
                                <i class="iconly-boldUser"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Customer</h6>
                            <h6 class="font-extrabold mb-0">{{ $totalCustomer }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card  shadow-lg">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon blue mb-2">
                                <i class="iconly-boldCredit-Card"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Pemesanan</h6>
                            <h6 class="font-extrabold mb-0">{{ $totalPemesanan }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="col-md-6">
            <div class="p-4  card shadow">
                <h6 class="font-extrabold mb-0 text-center">Total Customer : {{ $totalCustomer }}</h6>
               
                <div style="margin-top: 60px; margin-bottom:60px;">
                    {!! $monthlyUsersChart->container() !!}
                </div>
                <button class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#sudahPesanModal">Tampilkan User yang Sudah Memesan</button>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#belumPesanModal">Tampilkan User yang Belum Memesan</button>
<!-- Modal untuk pengguna yang sudah pesan -->
<div class="modal fade" id="sudahPesanModal" tabindex="-1" aria-labelledby="sudahPesanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sudahPesanModalLabel">Pengguna yang Sudah Memesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>No Telepon</th>
                        </tr>
                    </thead>
                    <tbody id="sudahPesanTableBody">
                        <!-- Data pengguna yang sudah pesan akan dimuat di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk pengguna yang belum pesan -->
<div class="modal fade" id="belumPesanModal" tabindex="-1" aria-labelledby="belumPesanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="belumPesanModalLabel">Pengguna yang Belum Memesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>No Telepon</th>
                        </tr>
                    </thead>
                    <tbody id="belumPesanTableBody">
                        <!-- Data pengguna yang belum pesan akan dimuat di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="p-4  card shadow">
                
                {!! $monthlyOrdersChart->container() !!}
            </div>
        </div>
        <div class="col-md-8">
            <div class="container">
                <h2 class="fw-semibold text-center mb-4">Daftar Pelanggan dengan order terbanyak</h2>
            <div class="card p-4 shadow ">

                <table class="table-bordered table ">
                    <thead class="">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Total Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topUsers as $user)
                        @if ($user->total_orders >= 1)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->total_orders }}</td>
                        </tr>
                            
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="container">
                <h4 class="fw-bold text-center mb-4">Paket Wisata Terpopuler</h4>
                <div class="card p-4 shadow ">
                    <table class="table-bordered table ">
                        <thead class="">
                            <tr>
                                <th>Nama Paket Wisata</th>
                                <th>Jumlah Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topPaketWisata as $paketWisata)
                                @if($paketWisata->total_orders >= 1)
                                    <tr>
                                        <td>{{ $paketWisata->nama }}</td>
                                        <td>{{ $paketWisata->total_orders }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script src="{{ $monthlyOrdersChart->cdn() }}"></script>
<script src="{{ $monthlyUsersChart->cdn() }}"></script>

{{ $monthlyUsersChart->script() }}
{{ $monthlyOrdersChart->script() }}


@endsection

@section('script')
<script>
     $(document).ready(function() {
        // Fungsi untuk memuat data pengguna menggunakan AJAX
        function loadUsers(status, container) {
            $.get(`/home/${status}`, function(data) {
               
                $(container).html('');
                data.forEach(function(user, index) {
                    $(container).append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${user.name}</td>
                            <td>${user.phone}</td>
                        </tr>
                        
                    
                        `);
                });
            });
        }

        // Memuat data pengguna yang sudah pesan saat modal ditampilkan
        $('#sudahPesanModal').on('shown.bs.modal', function () {
            loadUsers('sudah-pesan', '#sudahPesanTableBody');
        });

        // Memuat data pengguna yang belum pesan saat modal ditampilkan
        $('#belumPesanModal').on('shown.bs.modal', function () {
            loadUsers('belum-pesan', '#belumPesanTableBody');
        });
    });
</script>
@endsection
