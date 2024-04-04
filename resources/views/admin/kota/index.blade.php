@extends('layouts.dashboard')
@section('title')
    Daftar Kota
@endsection
@section('breadcumb','Kota')
@section('content')
    <div class="row d-flex">
        <div class="col-md-4">
            <div class="card p-4">
                <form method="POST" action="{{ route('kota.store') }}" id="form-tambah">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kota:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <div class="col-md-7 card p-4">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kota as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <div class="d-flex gap-1 ">
                                    <a href="{{ route('kota.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm  text-center" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $item->id }}">
                                        <i class="bi bi-pencil-fill"></i></a>

                                        <form method="POST" action="{{ route('kota.destroy', $item->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger delete-btn btn-sm"
                                                data-name="{{ $item->nama }}"
                                                data-id="{{ $item->id }}"><i class="bi bi-trash-fill"></i></button>
                                        </form>


                                </div>
                                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Update Kota<h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('kota.update', $item->id) }}" method="POST"
                                                id="form-update" data-id="{{ $item->id }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="mb-2 d-flex">
                                                            <div class="col-md-2">
                                                                <label for="first-name-horizontal-icon">Nama <span
                                                                        class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="form-group has-icon-left">
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Name" name="nama"
                                                                            id="first-name-horizontal-icon"
                                                                            value="{{ $item->nama }}" required>
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-person"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('script')

<script>
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
</script>
@if(session('warning'))
<script>
    $(document).ready(function() {
        let errorMessage = "{{ session('warning') }}";

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
@endsection