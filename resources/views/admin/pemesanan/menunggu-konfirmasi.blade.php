@extends('layouts.dashboard')
@section('title')
    Pesanan Menunggu Konfirmasi
@endsection
@section('breadcumb', 'Pemesanan')

@section('content')
    <div class="row d-flex">
        <div class="col-md-12 card p-4 shadow">
            
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
                            <td>{{ $item->jumlah_paket }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                            <td> @if($item->status_pembayaran == 'Belum Dibayar')
                                <span class="badge bg-danger">
                                    {{$item->status_pembayaran}}
                                </span>
                            @elseif($item->status_pembayaran == 'Menunggu Konfirmasi Admin')
                                <span class="badge bg-warning">
                                    {{$item->status_pembayaran}}
                                </span>
                            @elseif($item->status_pembayaran == 'Pembayaran Diterima')
                                <span class="badge bg-success">
                                    {{$item->status_pembayaran}}
                                </span>
                            @elseif($item->status_pembayaran == 'Pembayaran Ditolak')
                                <span class="badge bg-danger">
                                    {{$item->status_pembayaran}}
                                </span>
                            @elseif($item->status_pembayaran == 'Pemesanan Dibatalkan')
                                <span class="badge bg-secondary">
                                    {{$item->status_pembayaran}}
                                </span>
                            @endif
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div>
                                        {!! $item->bukti_pembayaran ? '<img src="' . asset('storage/' . $item->bukti_pembayaran) . '" width="50" style="cursor: pointer;" onClick="showImage(this)">' : '<span class="fw-bold text-danger">Belum Dibayar</span>' !!}
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @if ($item->status_pembayaran == 'Menunggu Konfirmasi Admin' && $item->bukti_pembayaran)
                                        <form id="confirmForm" action="{{ route('admin.pemesanan.konfirmasi', $item->id) }}" method="post">
                                            @csrf
                                            <button type="button" class="btn btn-info btn-sm" onclick="confirmPayment()">Konfirmasi </button>
                                        </form>
                                        <form id="tolakForm" action="{{ route('admin.pemesanan.tolak', $item->id) }}" method="post">
                                            @csrf
                                            <button type="button" class="btn btn-danger btn-sm" onclick="rejectPayment()">Tolak </button>
                                        </form>
                                    @endif
                                    @if ($item->status_pembayaran == 'Pembayaran Diterima')
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
    function confirmPayment() {
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Anda yakin ingin mengkonfirmasi pembayaran?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengirim formulir secara langsung
                document.getElementById("confirmForm").submit();
            }
        });
    }
    function rejectPayment() {
        Swal.fire({
            title: 'Tolak',
            text: "Apakah Anda yakin ingin menolak pembayaran?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengirim formulir secara langsung
                document.getElementById("tolakForm").submit();
            }
        });
    }
</script>

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

        Kami ingin memberitahukan bahwa pesanan Anda sedang dalam tahap proses pengecekan. Saat ini, kami sedang melakukan pengecekan terhadap pesanan Anda. Mohon bersabar sejenak.

        Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.

        Terima kasih atas kerjasamanya.
    `);

    let whatsappUrl = 'https://api.whatsapp.com/send?phone=' + phoneNumber + '&text=' + message;
    window.open(whatsappUrl, '_blank');
}


</script>
    

@endsection
