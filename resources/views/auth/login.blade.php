@extends('layouts.landingpage')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0" style="border-radius: 18px; box-shadow:  20px 20px 60px #bebebe,
                         -20px -20px 60px #ffffff;">
                <div class="py-3">
                    <h3 class="fw-semibold text-center">Login</h3>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-7">
                                <input style="border: 1px solid #3478e6" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-7">
                                <input id="password" style="border: 1px solid #3478e6" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p class="text-end small">
                                    <a href="{{ route('password.request') }}" class="nav-link mt-3">Forgot password?</a>
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3 d-flex justify-content-center">
                            <div class="col-md-10 mb-2 ">
                                <button type="submit" id="login-btn" class="btn btn-primary d-block w-100 px-5">
                                    Login
                                </button>
                            </div>
                            <div class="col-md-10 ">
                                <a href="{{ url('/login/google') }}" class="btn btn-dark d-block w-100">
                                    <img src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-09-512.png" width="30" alt="Google Icon" class="google-icon">
                                    Login with Google
                                </a>
                            </div>
                            <p class="text-center small">
                                <a href="{{ route('register') }}" class="nav-link text-primary fw-semibold mt-4 mb-5">Don't have an account? Create account</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#login-form').on('submit', function(event) {
        event.preventDefault(); 
        $('#login-btn').prop('disabled', true);  
        $('#login-btn').text('Bentar yaaa...');  

        this.submit(); 
    });
});
</script>
@endsection
