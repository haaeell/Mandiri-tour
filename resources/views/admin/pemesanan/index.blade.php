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
                    @php
                    function getStatusBadgeClass($status) {
                        switch ($status) {
                            case 'Menunggu Konfirmasi Admin':
                                return 'bg-warning text-dark';
                            case 'Pembayaran Diterima':
                                return 'bg-success';
                            case 'Pembayaran Ditolak':
                                return 'bg-danger';
                            case 'Pemesanan Dibatalkan':
                                return 'bg-secondary';
                            default:
                                return '';
                        }
                    }
                @endphp
                    @foreach ($pemesanan as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->paket->nama }}</td>
                            <td>{{ $item->jumlah_peserta }}</td>
                            <td>Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                            <td>
                                
                                @if($item->status_pembayaran == 'Pemesanan Dibatalkan')
                                    <span class="badge bg-secondary">
                                        {{$item->status_pembayaran}}
                                    </span>
                                @elseif($item->status_pembayaran == 'Menunggu Konfirmasi Admin' && !$item->bukti_pembayaran)
                                    <span class="badge bg-danger">
                                        Menunggu Pembayaran
                                    </span>
                                @else
                                <span class="badge {{ getStatusBadgeClass($item->status_pembayaran) }}">
                                    {{ $item->status_pembayaran }}
                                </span>
                                @endif
                            </td>
                            <td>{{ $item->tanggal_pemesanan }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div>
                                        {!! $item->bukti_pembayaran ? '<img src="' . asset('storage/' . $item->bukti_pembayaran) . '" width="50" style="cursor: pointer;" onClick="showImage(this)">' : '<span class="fw-bold text-danger">Belum Dibayar</span>' !!}
                                    </div>
                                    <div>
                                        @if ($item->status_pembayaran == 'Menunggu Konfirmasi Admin' && $item->bukti_pembayaran)
                                        <form action="{{ route('admin.pemesanan.konfirmasi', $item->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm">Konfirmasi Pembayaran</button>
                                        </form>
                                    @endif
                                    @if ($item->status_pembayaran == 'Pembayaran Diterima')
                                        <span class="fw-bold text-success">Pembayaran Sukses</span>
                                    @endif
                                    </div>

                                </div>
                                
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
