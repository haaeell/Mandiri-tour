@extends('layouts.dashboard')
@section('title')
    Tabel Users
@endsection
@section('breadcumb','Users')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 shadow">
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary mb-3 " data-bs-toggle="modal" data-bs-target="#modalCenter">
                        Tambah
                    </button>
                </div>

                <div class="table-responsive ">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Image</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><input type="checkbox" name="selectedItems[]" value="{{ $user->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <img src="{{ $user->image ? asset('/images/' . $user->image) : asset('assets/img/profile.png') }}"
                                            alt="{{ $user->image ? 'User Image' : 'Default Image' }}" width="50" onClick="showImage(this)">
                                    </td>

                                    <td>
                                        <span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-info' }}">
                                            {{ $user->role === 'admin' ? 'Admin' : 'Customer' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 ">
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-warning btn-sm  text-center" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $user->id }}">
                                                <i class="bi bi-pencil-fill"></i></a>
                                                <form id="deleteForm{{ $user->id }}" method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger delete-btn btn-sm"
                                                        data-name="{{ $user->name }}"
                                                        data-id="{{ $user->id }}" onclick="confirmDelete({{ $user->id }})">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>

                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalReset{{ $user->id }}">Reset Password</button>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal reset password  --}}
                                <div class="modal fade" id="modalReset{{ $user->id }}" tabindex="-999"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Reset Password</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('reset-password', $user->id) }}" method="POST" id="resetPasswordForm">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-password-toggle mb-3">
                                                        <label class="form-label" for="newPassword">Password baru</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password" required>
                                                            <button class="btn btn-outline-secondary" type="button" id="basic-default-password" onclick="togglePassword('newPassword')">
                                                                <i class="bi-eye-slash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="form-password-toggle mb-3">
                                                        <label class="form-label" for="confirmPassword">Konfirmasi Password</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password" required>
                                                            <button class="btn btn-outline-secondary" type="button" id="basic-default-password" onclick="togglePassword('confirmPassword')">
                                                                <i class="bi-eye-slash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                </div>
                <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Tambah User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('users.update', $user->id) }}" method="POST" id="form-update"
                                data-id="{{ $user->id }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-2 d-flex">
                                            <div class="col-md-2">
                                                <label for="first-name-horizontal-icon">Name <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Name"
                                                            name="name" id="first-name-horizontal-icon"
                                                            value="{{ $user->name }}" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex">
                                            <div class="col-md-2">
                                                <label for="first-name-horizontal-icon">Email <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Email"
                                                            id="first-name-horizontal-icon" value="{{ $user->email }}"
                                                            name="email" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-envelope"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex">
                                            <div class="col-md-2">
                                                <label for="first-name-horizontal-icon">No Tlp <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="number" class="form-control"
                                                            value="{{ $user->phone }}" placeholder="085xxx"
                                                            name="phone" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-phone"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex">
                                            <div class="col-md-2">
                                                <label for="first-name-horizontal-icon">Alamat</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->address }}" name="address"
                                                            placeholder="Alamat" id="first-name-horizontal-icon">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-geo-alt-fill"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex">
                                            <div class="col-md-2">
                                                <label for="first-name-horizontal-icon">Gambar</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <input type="file" id="imageInput" name="image"
                                                            class="form-control mb-3 @error('image') is-invalid @enderror">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex">
                                            <div class="col-md-2">
                                                <label for="first-name-horizontal-icon">Role</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group has-icon-left">
                                                    <div class="position-relative">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="role"
                                                                value="admin" id="adminRadio"
                                                                {{ $user->role === 'admin' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="adminRadio">Admin</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="role"
                                                                value="customer" id="customerRadio"
                                                                {{ $user->role === 'customer' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="customerRadio">Customer</label>
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
                @endforeach
                <div class="d-flex gap-2">

                    <button class="btn btn-danger btn-sm delete-button" data-id="{{ $user->id }}">
                        Hapus data yang dipilih
                    </button>
                    <a href="{{ url('/export-pdf') }}" class="btn btn-outline-secondary">Cetak Data Customers</a>
                </div>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal add-->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store', $user->id) }}" id="form-tambah" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-2 d-flex">
                                <div class="col-md-2">
                                    <label for="first-name-horizontal-icon">Name <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Name" name="name"
                                                id="first-name-horizontal-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 d-flex">
                                <div class="col-md-2">
                                    <label for="first-name-horizontal-icon">Email <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Email"
                                                id="first-name-horizontal-icon" name="email" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 d-flex">
                                <div class="col-md-2">
                                    <label for="first-name-horizontal-icon">No Tlp <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="085xxx"
                                                id="phone" name="phone" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="phone-error" class="text-danger"></div>
                                    <div id="phone-max" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="mb-2 d-flex">
                                <div class="col-md-2">
                                    <label for="first-name-horizontal-icon">Alamat</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" name="address"
                                                placeholder="Alamat" id="first-name-horizontal-icon">
                                            <div class="form-control-icon">
                                                <i class="bi bi-geo-alt-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 d-flex">
                                <div class="col-md-2">
                                    <label for="first-name-horizontal-icon">Gambar</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="file" class="image-preview-filepond" name="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 d-flex">
                                <div class="col-md-2">
                                    <label for="first-name-horizontal-icon">Password <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" class="form-control" placeholder="Password"
                                                id="password-horizontal-icon" name="password" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 d-flex">
                                <div class="col-md-2">
                                    <label for="first-name-horizontal-icon">Role</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="role"
                                                        id="adminRadio" value="admin" />
                                                    <label class="form-check-label" for="adminRadio">Admin</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="role"
                                                        id="userRadio" value="customer" checked />
                                                    <label class="form-check-label" for="userRadio">Customer</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.delete-button').on('click', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        var selectedItems = [];
        $('input[name="selectedItems[]"]:checked').each(function() {
            selectedItems.push($(this).val());
        });

        if (selectedItems.length > 0) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data yang dipilih?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#868e96',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('users.batchDelete') }}',
                        method: 'POST',
                        data: {
                            selectedItems: selectedItems
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Data Berhasil Dihapus',
                            });
                            location.reload();
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: 'Data Gagal Dihapus',
                            });
                        }
                    });
                }
            });
        } else {
            // Tidak ada data yang dipilih, jadi tidak perlu menampilkan SweetAlert konfirmasi
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tidak ada data yang dipilih untuk dihapus.',
            });
        }
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

    <script>
        function previewImage(event) {
            var ofReader = new FileReader();
            ofReader.readAsDataURL(document.getElementById("gambar").files[0]);

            ofReader.onload = function(oFREvent) {
                document.getElementById("preview").src = oFREvent.target.result;
            };
        }
    </script>

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
@endsection
