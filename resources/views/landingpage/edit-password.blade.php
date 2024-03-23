@extends('layouts.landingpage')

@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-8">
            <h2 class="fw-semibold mb-3">
                Edit Password
            </h2>
            <div class="card shadow p-2" style="border-radius: 16px">
                <div class="card-body">
                    <form method="POST" action="{{ route('customer.update-password', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <div class="input-group">
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autofocus>
                                <button class="btn btn-secondary" type="button" id="toggleCurrentPassword">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <button class="btn btn-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                <button class="btn btn-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            
                        </div>
                        
                <p class="text-end">  <a href="{{ route('password.request') }}" class="nav-link mt-3">Forgot password?</a></p>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   
    function togglePasswordVisibility(inputId, buttonId) {
        var passwordInput = $('#' + inputId);
        var toggleButton = $('#' + buttonId);

        if (passwordInput.attr('type') === "password") {
            passwordInput.attr('type', 'text');
            toggleButton.html('<i class="bi bi-eye"></i>');
        } else {
            passwordInput.attr('type', 'password');
            toggleButton.html('<i class="bi bi-eye-slash"></i>');
        }
    }

    $('#toggleCurrentPassword').click(function() {
        togglePasswordVisibility('current_password', 'toggleCurrentPassword');
    });

    $('#togglePassword').click(function() {
        togglePasswordVisibility('password', 'togglePassword');
    });

    $('#toggleConfirmPassword').click(function() {
        togglePasswordVisibility('password_confirmation', 'toggleConfirmPassword');
    });
</script>


@endsection
