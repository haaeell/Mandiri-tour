@extends('layouts.dashboard')
@section('title')
    Email Marketing
@endsection
@section('breadcumb','Email Marketing')
@section('content')
    <div class="container">
        <div class="card p-3">
            <div class="row">

                <div class="col-ms-12">

                    <!-- Tombol untuk menampilkan modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEmailModal">
                        Create Email Marketing
                    </button>

                    <!-- Tabel untuk menampilkan data email marketing -->
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($emails as $email)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $email->subject }}</td>
                                    <td>{{ $email->status }}</td>
                                    <td>{{ $email->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
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


                                            <form method="POST" action="{{ route('emails.destroy', $email->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger delete-btn btn-sm"
                                                    data-name="{{ $email->nama }}"
                                                    data-id="{{ $email->id }}">Hapus</button>
                                            </form>
                                        </div>
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
@endsection
