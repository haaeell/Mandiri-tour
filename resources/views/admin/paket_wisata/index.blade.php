@extends('layouts.dashboard')
@section('title')
    Daftar Paket Wisata
@endsection
@section('breadcumb', 'Paket Wisata')

@section('content')
    <div class="row d-flex">
        <div class="col-md-12 card p-4">
            <div class="col-md-2">
                <a href="{{ route('paket-wisata.create') }}" class="btn btn-primary mb-3 ">
                    Tambah
                </a>
            </div>
            <table class="table table-hovered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kota</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Fasilitas</th>
                        <th>Harga</th>
                        <th>Wisata</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paket as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <ul>
                                    @foreach ($item->kotas as $kota)
                                        <li>{{ $kota->nama }}</li>
                                    @endforeach
                                </ul>


                            </td>
                            <td>
                                <img src="{{ $item->gambar ? asset('/images/' . $item->gambar) : asset('assets/img/profile.png') }}"
                                    alt="{{ $item->gambar ? 'item Image' : 'Default Image' }}" width="50"
                                    onClick="showImage(this)">
                            </td>
                            <td>{{substr($item->deskripsi,0,30) }}...</td>
                            <td>{{substr($item->fasilitas,0,30) }}...</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>
                                @foreach ($item->wisatas as $wisata)
                                    <span class="badge bg-info mb-1">
                                        {{ $wisata->nama }}
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                <div class="d-flex gap-1 ">
                                    <a href="{{ route('paket-wisata.show', $item->id) }}"
                                        class="btn btn-secondary btn-sm text-center">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('paket-wisata.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm  text-center">
                                        <i class="bi bi-pencil-fill"></i></a>

                                    <form id="deleteForm{{ $item->id }}" method="POST"
                                        action="{{ route('paket-wisata.destroy', $item->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger delete-btn btn-sm"
                                            data-name="{{ $item->nama }}" data-id="{{ $item->id }}"
                                            onclick="confirmDelete({{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="mt-2">
                                    @if ($item->rundowns->isNotEmpty())
                                        <!-- Jika ada rundown terkait -->
                                        <a href="{{ route('rundown.edit', $item->rundowns->first()->paket_wisata_id) }}"
                                            class="btn btn-info text-white fw-bold">
                                            Edit Rundown
                                        </a>
                                    @else
                                        <!-- Jika tidak ada rundown terkait -->
                                        <a href="{{ route('rundown.add', $item->id) }}"
                                            class="btn btn-info text-white fw-bold">
                                            Tambah Rundown
                                        </a>
                                    @endif
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
