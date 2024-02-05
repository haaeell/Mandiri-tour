@extends('layouts.dashboard')
@section('title')
    Email Marketing
@endsection
@section('breadcumb','Email Marketing')
@section('content')
    <div class="container">
        <div class="card p-3 shadow">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->has('status') && request('status') == 'draft' ? 'active' : '' }}" href="{{ route('emails.index', ['status' => 'draft']) }}">Draft</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->has('status') && request('status') == 'sent' ? 'active' : '' }}" href="{{ route('emails.index', ['status' => 'sent']) }}">Sent</a>
                </li>
            </ul>
            <div class="row">

                <div class="col-ms-12">

                    @if ($status !== 'sent')
                        
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEmailModal">
                        Create Email Marketing
                    </button>
                    @endif

                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                @if ($status !== 'sent')
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($emails as $email)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $email->subject }}</td>
                                    <td>{{ $email->status }}</td>
                                    <td>{{ $email->content}}</td>
                                    <td>{{ $email->created_at}}</td>
                                    <td>
                                        @if ($email->status != 'sent')
                                            
                                        <div class="d-flex">

                                            <!-- Tombol untuk menampilkan modal edit -->
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editEmailModal{{ $email->id }}">
                                                Edit
                                            </button>


                                            <div class="modal fade" id="editEmailModal{{ $email->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editEmailModalLabel{{ $email->id }}">Edit Email
                                                                Marketing</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('emails.update', $email->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="subject" class="form-label">Subject</label>
                                                                    <input type="text" class="form-control"
                                                                        id="subject" name="subject"
                                                                        value="{{ $email->subject }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="content" class="form-label">Content</label>
                                                                    <textarea class="form-control" id="content" name="content" rows="4" required>{{ $email->content }}</textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Email</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tombol untuk mengirim email -->
                                            <a href="{{ route('email.send', $email->id) }}"
                                                class="btn btn-success btn-sm">Send</a>


                                            
                                            <form id="deleteForm{{ $email->id }}" method="POST"
                                                action="{{ route('emails.destroy', $email->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger delete-btn btn-sm"
                                                    data-name="{{ $email->subject }}" data-id="{{ $email->id }}"
                                                    onclick="confirmDelete({{ $email->id }})">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal edit untuk setiap email -->
                                <div class="modal fade" id="editEmailModal{{ $email->id }}" tabindex="-1"
                                    aria-labelledby="editEmailModalLabel{{ $email->id }}" aria-hidden="true">
                                    <!-- Isi modal edit di sini -->
                                </div>

                                <!-- Modal delete untuk setiap email -->
                                <div class="modal fade" id="deleteEmailModal{{ $email->id }}" tabindex="-1"
                                    aria-labelledby="deleteEmailModalLabel{{ $email->id }}" aria-hidden="true">
                                    <!-- Isi modal delete di sini -->
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5">No email marketing found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create untuk membuat email marketing baru -->
    <div class="modal fade" id="createEmailModal" tabindex="-1" aria-labelledby="createEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEmailModalLabel">Create Email Marketing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('emails.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Email</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tambahkan skrip JavaScript untuk me-reset modal setelah ditutup -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Reset modal setelah ditutup
            var modals = document.querySelectorAll('.modal');
            modals.forEach(function(modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    var forms = modal.querySelectorAll('form');
                    forms.forEach(function(form) {
                        form.reset();
                    });
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
