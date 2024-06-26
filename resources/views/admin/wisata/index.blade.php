@extends('layouts.dashboard')
@section('title')
    Daftar wisata
@endsection
@section('breadcumb','Wisata')
    
@section('content')
    <div class="row d-flex">
        <div class="col-md-12 card p-4">
            <div class="col-md-2">
                <button type="button" class="btn btn-primary mb-3 " data-bs-toggle="modal" data-bs-target="#modalCenter">
                    Tambah
                </button>
            </div>
            <table class="table table-hovered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kota</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wisata as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kota->nama }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                <img src="{{ $item->gambar ? asset('/images/' . $item->gambar) : asset('assets/img/profile.png') }}"
                                    alt="{{ $item->gambar ? 'item Image' : 'Default Image' }}" width="50" onClick="showImage(this)">
                                 </td>
                            <td>
                                <div class="d-flex gap-1 ">
                                    <a href="{{ route('wisata.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm  text-center" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $item->id }}">
                                        <i class="bi bi-pencil-fill"></i></a>

                                    <form id="deleteForm{{ $item->id }}" method="POST"
                                        action="{{ route('wisata.destroy', $item->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger delete-btn btn-sm"
                                            data-name="{{ $item->nama }}" data-id="{{ $item->id }}"
                                            onclick="confirmDelete({{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>


                                </div>
                                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Update wisata<h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('wisata.update', $item->id) }}" method="POST"
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
                                                                            placeholder="Nama Wisata" name="nama"
                                                                            id="first-name-horizontal-icon"
                                                                            value="{{ $item->nama }}">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-person"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 d-flex">
                                                            <div class="col-md-2">
                                                                <label for="first-name-horizontal-icon">Kota <span
                                                                        class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="form-group has-icon-left">
                                                                    <div class="position-relative">
                                                                        <select name="kota_id" id="kota_id"
                                                                            class="form-select" required>
                                                                            @foreach ($kota as $singleKota)
                                                                            <option value="{{ $singleKota->id }}" {{ $singleKota->id == $item->kota_id ? 'selected' : '' }}>
                                                                                {{ $singleKota->nama }}
                                                                            </option>
                                                                        @endforeach
                                                                        
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 d-flex">
                                                            <div class="col-md-2">
                                                                <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="form-group has-icon-left">
                                                                    <div class="position-relative">
                                                                        <textarea class="form-control" placeholder="Deskripsi" name="deskripsi" id="deskripsi" rows="4" required>{{ $item->deskripsi }}</textarea>
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-info-circle"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 d-flex">
                                                            <div class="col-md-2">
                                                                <label for="first-name-horizontal-icon">Gambar<span
                                                                        class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="form-group ">
                                                                    <input type="file" class="form-control mb-3 imageInput"
                                                                    value="{{ $item->gambar }}" name="gambar">
                                                                    <img class="previewImage" src="{{ asset('/images/' . $item->gambar)}}" alt="Preview Image"  data-old-src="{{ asset('/images/' . $item->gambar)}}">
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
        <!-- Modal add-->
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Tambah Wisata</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('wisata.store') }}" id="form-tambah" method="POST"
                        enctype="multipart/form-data">
                        @csrf
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
                                                <input type="text" class="form-control" placeholder="Nama Wisata"
                                                    name="nama" id="first-name-horizontal-icon" required>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 d-flex">
                                    <div class="col-md-2">
                                        <label for="first-name-horizontal-icon">Kota <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <select name="kota_id" id="kota_id" class="form-select" required>
                                                    <option value="">Pilih Kota</option>
                                                    @foreach ($kota as $kota)
                                                        <option value="{{ $kota->id }}">{{ $kota->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 d-flex">
                                    <div class="col-md-2">
                                        <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <textarea class="form-control" placeholder="Deskripsi" name="deskripsi" id="deskripsi" rows="4" required></textarea>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-info-circle"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 d-flex">
                                    <div class="col-md-2">
                                        <label for="first-name-horizontal-icon">Gambar<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="file" class="image-preview-filepond" name="gambar">
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
    <script>
        function confirmDelete(userId) {
            const userName = document.querySelector(`.delete-btn[data-id="${userId}"]`).getAttribute('data-name');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus ${userName}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteForm${userId}`).submit();
                }
            });
        }
    </script>
    

@endsection
