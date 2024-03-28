@extends('layouts.landingpage')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-5">
                        <div class="position-relative">
                            <img src="{{ asset('/images/' . $paketWisata->gambar) }}"
                                style="width: 100%; height:350px; border-radius:24px;object-fit:cover;" alt="">
                            <div class="bg-danger text-white px-4 py-1 rounded fw-semibold position-absolute rounded-pill"
                                style="transform: rotate(30deg); top: 10px; right: -20px;">
                                {{ $paketWisata->durasi }}
                            </div>
                            <span class="position-absolute bottom-0 end-0 m-2 bg-white px-2 py-1 rounded fw-semibold">
                                {{ $paketWisata->kategori->nama }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-7 mb-4">
                        <div>
                            <h2 class="fw-semibold text-center">{{ $paketWisata->nama }}</h2>
                            <div class="mb-3 d-flex flex-wrap gap-2 justify-content-center">
                                @foreach ($paketWisata->kotas as $kota)
                                    <span class="badge bg-primary">{{ $kota->nama }}</span>
                                @endforeach
                            </div>
                            <p>{{ Illuminate\Support\Str::limit($paketWisata->deskripsi, $limit = 250, $end = '...') }}</p>

                            <p class="fw-bold">Kendaraan : {{ $paketWisata->kendaraan->nama }} /<span class="text-danger">
                                    ({{ $paketWisata->kendaraan->kapasitas }} orang) </span>
                            </p>
                            <div class="d-flex mt-5}">

                                <h3 class="fw-semibold text-danger">Rp {{ number_format($paketWisata->harga, 0, ',', '.') }}
                                </h3>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="card p-4" style="background-color: #dfe2f5; border:2px solid #25aae1">
                            <div class="mb-4">
                                <h5 class="fw-bold text-primary "><i class="bi bi-box-seam-fill "></i> Tentang {{$paketWisata->nama}}</h5>
                                <div class="col-md-10">
                                    <p class="m-0 ">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde, dolor! Lorem ipsum, dolor sit amet consectetur adipisicing
                                    </p>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active fw-semibold" id="rundown-tab" data-bs-toggle="tab" data-bs-target="#rundown"
                                                type="button" role="tab" aria-controls="rundown" aria-selected="false">Rundown
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link fw-semibold" id="wisata-tab" data-bs-toggle="tab" data-bs-target="#wisata"
                                                type="button" role="tab" aria-controls="wisata" aria-selected="true">Wisata yang dikunjungi
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link fw-semibold" id="fasilitas-tab" data-bs-toggle="tab" data-bs-target="#fasilitas"
                                                type="button" role="tab" aria-controls="fasilitas" aria-selected="false">Fasilitas
                                            </button>
                                        </li>
                                    </ul>
                        
                                    <div class="tab-content" id="myTabsContent">
                                        <div class="tab-pane fade show active mt-3" id="rundown" role="tabpanel" aria-labelledby="rundown-tab">
                                            <div class="d-flex justify-content-end mb-3">
                                                @if (!$rundownsGrouped->isEmpty())
                                                    <a href="{{ route('rundown.generatePdf', $paketWisata->id) }}" class="btn btn-primary btn-sm">Cetak Rundown</a>
                                                @endif
                                            </div>
                                            <div class="accordion" id="accordionExample">
                                                @if ($rundownsGrouped->isEmpty())
                                                    <p class="text-center">Rundown belum tersedia.</p>
                                                @else
                                                    @foreach ($rundownsGrouped as $hari => $rundowns)
                                                        <div class="accordion-item mb-2 " >
                                                            <h2 class="accordion-header " id="heading{{ $loop->index }}">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false"
                                                                    aria-controls="collapse{{ $loop->index }}">
                                                                    Hari ke-{{ $hari }}
                                                                </button>
                                                            </h2>
                                                            <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse"
                                                                aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
                                                                <div class="accordion-body ">
                                                                    <ul>
                                                                        @foreach ($rundowns as $rundown)
                                                                            <li>
                                                                                {{ \Carbon\Carbon::parse($rundown->mulai)->format('H.i') }} -
                                                                                {{ \Carbon\Carbon::parse($rundown->selesai)->format('H.i') }}:
                                                                                {{ $rundown->deskripsi }}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                        
                                        <div class="tab-pane fade mt-3" id="wisata" role="tabpanel" aria-labelledby="wisata-tab">
                                            <ol>
                                                @foreach ($paketWisata->wisatas as $wisata)
                                                    <li>{{ $wisata->nama }} - {{ $wisata->kota->nama }}</li>
                                                @endforeach
                                            </ol>
                                        </div>
                        
                                        <div class="tab-pane fade mt-3" id="fasilitas" role="tabpanel" aria-labelledby="fasilitas-tab">
                                            {{ $paketWisata->fasilitas }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 shadow-lg" style="border: 2px solid #25aae1">
                    <form action="{{ route('pesanPaket') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama </label>
                            <input type="text" class="form-control" id="nama" value="{{ Auth::user()->name }}"
                                readonly>
                        </div>

                        <input type="hidden" class="form-control" id="user_id" name="user_id"
                            value="{{ Auth::user()->id }}" readonly>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email </label>
                            <input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="paket_id" class="form-label">Nama Paket </label>
                            <input type="hidden" class="form-control" id="paket_id" name="paket_id"
                                value="{{ $paketWisata->id }}" readonly>
                            <input type="text" class="form-control" value="{{ $paketWisata->nama }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_paket" class="form-label">Jumlah Paket:</label>
                            <input type="text" class="form-control" id="jumlah_paket" name="jumlah_paket" required>
                            <p id="error_message" class="text-danger"></p>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan:</label>
                            <input type="date" class="form-control" id="tanggal_keberangkatan"
                                name="tanggal_keberangkatan" value="{{ old('tanggal_keberangkatan') }}" required>
                            <p id="tanggal_keberangkatan_message" class="text-danger fs-7 text-small">Tanggal
                                keberangkatan minimal adalah H-3 dari hari ini.</p>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ old('alamat') }}" required>
                        </div>
                        <button type="submit" class="btn btn-login bn26">Submit</button>
                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
<script>
    $(document).ready(() => {
        // Ambil elemen input tanggal dan pesan
        const inputTanggal = $('#tanggal_keberangkatan');
        const pesanTanggal = $('#tanggal_keberangkatan_message');

        // Hitung tanggal minimal (H-3)
        const today = new Date(); // Tanggal hari ini
        const tanggalMinimal = new Date(today); // Salin tanggal hari ini
        tanggalMinimal.setDate(tanggalMinimal.getDate() + 3); // Tambahkan 3 hari

        // Konversi tanggal minimal ke format ISO (YYYY-MM-DD) untuk diatur sebagai nilai atribut min
        const tanggalMinimalISO = tanggalMinimal.toISOString().split('T')[0];
        inputTanggal.attr('min', tanggalMinimalISO);

        // Tampilkan pesan untuk pengguna
        pesanTanggal.html(`Tanggal keberangkatan minimal H-3 atau ${tanggalMinimal.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}.`);
    });
</script>

<script>
    $(document).ready(() => {
        // Ambil elemen input jumlah paket dan pesan error
        const inputJumlahPaket = $('#jumlah_paket');
        const errorMessage = $('#error_message');

        // Tambahkan event listener untuk event input
        inputJumlahPaket.on('input', (event) => {
            // Ambil nilai dari input
            const nilaiInput = inputJumlahPaket.val();

            // Cek jika nilai input bukan angka atau kurang dari 1
            if (!(/^\d+$/.test(nilaiInput)) || parseInt(nilaiInput) < 1) {
                // Tampilkan pesan error
                errorMessage.text('Minimal jumlah paket adalah 1.');
                // Bersihkan nilai input
                inputJumlahPaket.val('');
            } else {
                // Kosongkan pesan error jika input valid
                errorMessage.text('');
            }
        });
    });
</script>

@endsection
