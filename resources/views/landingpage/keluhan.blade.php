<!-- resources/views/keluhan/index.blade.php -->

@extends('layouts.landingpage')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Ajukan Keluhan</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('keluhan.store') }}" id="form-tambah">
                            @csrf

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 d-block">Ajukan Keluhan</button>
                        </form>
                    </div>
                </div>

                <hr>

                
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Riwayat Keluhan</div>

                    <div class="card-body">
                        @if($riwayatKeluhan->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <th>Tanggal</th>
                                        <th>Isi Keluhan</th>
                                        <th>Status</th>
                                        <th>Tanggapan Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayatKeluhan as $riwayat)
                                        <tr>
                                            <td>{{ $riwayat->user->name }}</td>
                                            <td>{{ $riwayat->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td>{{ $riwayat->description }}</td>
                                            <td>  <span class="badge {{ $riwayat->status === 'resolved' ? 'text-bg-success' : ($riwayat->status === 'pending' ? 'text-bg-warning' : 'text-bg-default') }}">
                                                {{ $riwayat->status }}
                                            </span></td>
                                            <td>{{ $riwayat->admin_response ?? 'Belum ada tanggapan' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!-- Tampilkan data keluhan di sini -->

                                
                            </table>
                            
                        @else
                            <p>Belum ada riwayat keluhan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
{{-- <script>
    $(document).ready(function() {
        $('#form-tambah').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    });

                    $('#form-tambah')[0].reset();
                    window.location.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        for (var key in errors) {
                            errorMessage += errors[key][0] + '<br>';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: errorMessage,
                        });
                    } else {
                        // Handle other errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while processing your request.',
                        });
                    }
                }
            });
        });
    });
</script> --}}

@endsection
