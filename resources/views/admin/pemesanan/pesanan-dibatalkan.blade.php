@extends('layouts.dashboard')
@section('title')
    Pesanan Dibatalkan
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
                        <th>Tanggal Dibatalkan</th>
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
                                {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM YYYY') }}
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
        
        Informasi Pemesanan:
        Paket: ${paket}
        jumlah paket: ${jumlahPeserta}
        Alamat: ${alamat}

        Kami mengingatkan bahwa pembayaran Anda belum diterima. Jika ada pertanyaan, silakan tanyakan.
    `);

    let whatsappUrl = 'https://api.whatsapp.com/send?phone=' + phoneNumber + '&text=' + message;
    window.open(whatsappUrl, '_blank');
}

</script>
   


@endsection
