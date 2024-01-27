@extends('layouts.dashboard')

@section('content')
    <section class="row">
        <div class="col-12 col-lg-10">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row mb-2">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Users</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalUsers }}</h6>
                                </div>
                            </div>

                            <div class="d-flex">
                                <h6 class="text-muted font-semibold">Users This Month :<h6
                                        class="font-extrabold fw-bold mx-2"> {{ $usersRegisteredThisMonth }}</h6>
                                </h6>

                            </div>


                            <!-- Users With Orders -->
                            @if ($usersWithOrders > 0)
                                <div class="d-flex">
                                    <h6 class="text-muted font-semibold">Users With Order :<h6
                                            class="font-extrabold fw-bold mx-2"> {{ $usersWithOrders }}</h6>
                                    </h6>

                                </div>
                            @endif

                            <!-- Users Without Orders -->
                            @if ($usersWithoutOrders > 0)
                                <div class="d-flex">
                                    <h6 class="text-muted font-semibold">Users Without Orders :<h6
                                            class="font-extrabold fw-bold mx-2"> {{ $usersWithoutOrders }}</h6>
                                    </h6>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Pesanan Berhasil</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalPesananPembayaranDiterima }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
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
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Keluhan</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalKeluhan->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    >
    </div>
@endsection
