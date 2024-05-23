@extends('layouts.landingpage')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-3 border-0" style="border-radius: 18px;">
                <div class="card-header bg-primary text-white" style="border-radius: 18px 18px 0 0;">
                    <h4 class="mb-0 text-center fw-semibold">{{ __('Verifikasi Alamat Email Anda') }}</h4>
                </div>

                <div class="card-body text-center">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </div>
                    @endif

                    <p class="mt-4 fw-semibold">{{ __('Sebelum melanjutkan, harap periksa email Anda untuk tautan verifikasi.') }}</p>
                    <p class="mb-0 mt-5 fw-semibold">{{ __('Jika Anda tidak menerima email tersebut') }},</p>
                    
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn bg-primary p-3 text-white btn-sm fw-semibold mt-2 align-baseline">{{ __('klik di sini untuk meminta lagi') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
