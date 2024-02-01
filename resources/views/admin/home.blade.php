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
                {{-- <h6 class="font-extrabold mb-0 text-center">Users With Orders : {{ $usersWithOrders->count() }}</h6>
                <h6 class="font-extrabold mb-0 text-center">Users Without Orders : {{ $usersWithoutOrders->count() }}</h6>
                <h6 class="font-extrabold mb-0 text-center">Users Cancel Orders : {{ $usersWithCancelledOrders->count() }}</h6> --}}
                {!! $monthlyUsersChart->container() !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4  card shadow">
                
                {!! $monthlyOrdersChart->container() !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="container">
                <h2 class="fw-semibold text-center mb-4">Top Users with Most Orders</h2>
        <div class="card p-4 shadow rounded">

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
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->total_orders }}</td>
                        </tr>
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
