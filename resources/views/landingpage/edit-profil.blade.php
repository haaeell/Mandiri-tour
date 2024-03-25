@extends('layouts.landingpage')

@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-10">
            <h2 class="fw-semibold text-start mb-3">Edit Profil</h2>
            <div class="card shadow p-2" style="border-radius: 16px;">
                <div class="card-body">
                    <form method="POST" action="{{ route('customer.update-profil', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Nama') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                            </div>
                           <div class="col-md-6">
                                <div class="mb-3">
                                   <label for="email" class="form-label">{{ __('Alamat Email') }}</label>
                                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                                   @error('email')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                               </div>
                           </div>
                           <div class="col-md-12">
    
                               <div class="mb-3">
                                   <label for="phone" class="form-label">{{ __('Nomor Telepon') }}</label>
                                   <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" autocomplete="phone">
                                   @error('phone')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                               </div>
                           </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="image" class="form-label">{{ __('Gambar Profil') }}</label>
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3" id="imagePreview" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border:2px solid rgba(50, 76, 223, 0.933)">
                                    @if ($user->image)
                                        <img src="{{ Auth::user()->image ? asset('/images/' . Auth::user()->image) : asset('assets/img/profile.png') }}" style="max-width: 100%; max-height: 100%;">
                                    @else
                                        <img src="{{asset('assets/img/profile.png')}}" alt="Preview Gambar Profil" style="max-width: 100%; max-height: 100%;">
                                    @endif
                                </div>
                                <input type="hidden" name="hapus_gambar" id="hapus_gambar" value="0">

                            </div>
                        </div>
                      
                        <div class="mb-3">
                            <button type="button" class="btn btn-danger" id="hapusGambar">Hapus Gambar</button>
                            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
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
    $('#hapusGambar').click(function() {
        var preview = $('#imagePreview img');
        var defaultImage = "{{ asset('assets/img/profile.png') }}";
        preview.attr('src', defaultImage);
        $('#image').val(''); // Atur nilai input gambar menjadi kosong saat tombol "Hapus Gambar" diklik
        $('#hapus_gambar').val('1'); // Atur nilai input tersembunyi untuk menandai penghapusan gambar
        preview.css('display', 'none');
    });

    $('#image').change(function(event) {
        var preview = $('#imagePreview img');
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.attr('src', reader.result);
            preview.css('display', 'block');
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.attr('src', '');
            preview.css('display', 'none');
        }
    });
});

</script>


@endsection
