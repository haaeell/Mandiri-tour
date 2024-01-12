@extends('layouts.dashboard')
@section('title')
    Daftar Pemesanan
@endsection
@section('breadcumb', 'Pemesanan')

@section('content')
    <div class="row d-flex">
        <div class="col-md-12 card p-4">
            <div class="col-md-2">
                <a href="{{ route('pemesanan.create') }}" class="btn btn-primary mb-3 ">
                    Tambah
                </a>
            </div>
            <table class="table table-hovered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Jumlah Peserta</th>
                        <th>Total Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Bukti Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanan as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->paket->nama }}</td>
                            <td>{{ $item->jumlah_peserta }}</td>
                            <td>Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-danger">
                                    {{ $item->status_pembayaran }}
                                </span>
                            </td>
                            <td>{{ $item->tanggal_pemesanan }}</td>
                            <td>
                                {!! $item->bukti_pembayaran ? '<img src="' . asset('storage/' . $item->bukti_pembayaran) . '" width="50" onClick="showImage(this)">' : '<span class="fw-bold text-danger">Belum Dibayar</span>' !!}
                            </td>
                            
                            

                            <td>
                                <button type="button" class="btn btn-success delete-btn btn-lg" onclick="openWhatsApp('{{ $item->user->phone }}')">
                                    <i class="bi bi-whatsapp"></i>
                                </button>
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
   function openWhatsApp(phoneNumber) {
        var paket = '{{ $item->paket->nama }}';
        var tanggalPemesanan = '{{ $item->tanggal_pemesanan }}';
        var jumlahPeserta = '{{ $item->jumlah_peserta }}';
        var totalPembayaran = '{{ $item->total_pembayaran }}';

        var message = encodeURIComponent(`
            Halo ${'{{ $item->user->name }}'},
            
            Informasi Pemesanan:
            Paket: ${paket}
            Tanggal Pemesanan: ${tanggalPemesanan}
            Jumlah Peserta: ${jumlahPeserta}
            Total Pembayaran: ${totalPembayaran} .

            Kami mengingatkan bahwa pembayaran Anda belum diterima. Jika ada pertanyaan, silakan tanyakan.

        `);

        var whatsappUrl = 'https://api.whatsapp.com/send?phone=' + phoneNumber + '&text=' + message;
        window.open(whatsappUrl, '_blank');
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
