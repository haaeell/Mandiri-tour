@extends('layouts.dashboard')
@section('title')
    Pesanan Ditolak
@endsection
@section('breadcumb', 'Pemesanan')

@section('content')
    <div class="row d-flex">
        <div class="col-md-12 card p-4 shadow">
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
                        <th>jumlah paket</th>
                        <th>Alamat</th>
                        <th>Total Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Ditolak</th>
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
                            <td>{{ $item->jumlah_paket }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                            <td> <span class="badge bg-dark">
                                {{$item->status_pembayaran}}
                            </span>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('D MMMM YYYY') }}
                            </td>
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
                                    @if ($item->status_pembayaran == 'Pembayaran Ditolak')
                                        <span class="fw-bold text-success">Pembayaran Sukses</span>
                                    @endif
                                    </div>

                                </div>
                                
                            </td>
                            
                            

                            <td>
                                <div class="d-flex">

                                    <button type="button" class="btn btn-success delete-btn btn-lg"
                                    data-phone="{{ $item->user->phone }}"
                                    data-nama="{{ $item->user->name }}"
                                    data-paket="{{ $item->paket->nama }}"
                                    data-jumlah-peserta="{{ $item->jumlah_paket }}"
                                    data-alamat="{{ $item->alamat }}"
                                    onclick="openWhatsApp(this)">
                                <i class="bi bi-whatsapp"></i>
                            </button>
                            
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
   function openWhatsApp(button) {
    let phoneNumber = button.getAttribute('data-phone');
    let nama = button.getAttribute('data-nama');
    let paket = button.getAttribute('data-paket');
    let jumlahPeserta = button.getAttribute('data-jumlah-peserta');
    let alamat = button.getAttribute('data-alamat');

    // Pemeriksaan validitas nomor telepon
    if (!phoneNumber || isNaN(phoneNumber)) {
        alert('Nomor telepon tidak valid.');
        return;
    }

    let message = encodeURIComponent(`
        Halo ${nama},
        
        Kami berharap Anda dalam keadaan baik.

        Kami ingin mengonfirmasi pemesanan yang telah Anda buat dengan rincian sebagai berikut:
        - Paket Wisata: ${paket}
        - Jumlah Paket: ${jumlahPeserta}
        - Alamat: ${alamat}

        Mohon untuk diketahui bahwa pesanan Anda telah kami terima. Namun, kami ingin mengingatkan bahwa pembayaran belum kami terima.

        Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.

        Terima kasih atas kerjasamanya.
    `);

    let whatsappUrl = 'https://api.whatsapp.com/send?phone=' + phoneNumber + '&text=' + message;
    window.open(whatsappUrl, '_blank');
}


</script>
    <script>
        $(document).ready(function() {
            $('#form-tambah').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);

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
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';

                            for (let key in errors) {
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
