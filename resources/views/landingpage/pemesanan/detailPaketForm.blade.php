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
                        <div class="bg-danger text-white px-4 py-1 rounded fw-semibold position-absolute rounded-pill" style="transform: rotate(30deg); top: 10px; right: -20px;">
                          {{ $paketWisata->durasi }}
                      </div>
                        <span class="position-absolute bottom-0 end-0 m-2 bg-white px-2 py-1 rounded fw-semibold">
                          {{ $paketWisata->kategori }}
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
                            <p >{{ Illuminate\Support\Str::limit($paketWisata->deskripsi, $limit = 250, $end = '...') }}</p>
                            
                            <p class="fw-bold">Kendaraan : {{ $paketWisata->kendaraan->nama }} /<span class="text-danger">
                                ({{ $paketWisata->kendaraan->kapasitas }} orang) </span>
                        </p>
                            <div class="d-flex mt-5}">
        
                                <h3 class="fw-semibold text-danger">Rp {{ number_format($paketWisata->harga, 0, ',', '.') }}
                                </h3>
        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div> 
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header ">
                                        <button class="accordion-button collapsed fw-bold "
                                            style="border:1px solid #25aae1; border-radius:8px" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                            Wisata
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ol>
                                                @foreach ($paketWisata->wisatas as $wisata)
                                                    <li>
                                                        {{ $wisata->nama }}
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item my-2">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold" type="button"
                                            style="border:1px solid #25aae1; border-radius:8px"data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                            aria-controls="flush-collapseTwo">
                                            Fasilitas
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            {{ $paketWisata->fasilitas }}
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold"
                                            style="border:1px solid #25aae1; border-radius:8px" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false"
                                            aria-controls="flush-collapseThree">
                                            Rundown
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body ">Placeholder content for this accordion, which is intended to
                                            demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                                            body. Nothing more exciting happening here in terms of content, but just filling up the
                                            space to make it look, at least at first glance, a bit more representative lorem500 of
                                            how this would look in a real-world application.</div>
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
                                <p id="tanggal_keberangkatan_message" class="text-danger fs-7 text-small">Tanggal keberangkatan minimal adalah H-3 dari hari ini.</p>
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
        function cekLogin(loginUrl) {
            Swal.fire({
                title: "Silakan login terlebih dahulu!",
                text: "Untuk dapat melakukan pemesanan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Login",
                cancelButtonText: "Kembali",
                confirmButtonColor: "#4481eb",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simpan URL halaman saat ini
                    var currentUrl = window.location.href;
                    // Redirect ke halaman login dengan menyertakan URL saat ini sebagai parameter
                    window.location.href = loginUrl + "?redirect=" + encodeURIComponent(currentUrl);
                }
            });
        }
    </script>

<script>
    // Ambil elemen input tanggal dan pesan
    var inputTanggal = document.getElementById('tanggal_keberangkatan');
    var pesanTanggal = document.getElementById('tanggal_keberangkatan_message');

    // Hitung tanggal minimal (H-3)
    var today = new Date(); // Tanggal hari ini
    var tanggalMinimal = new Date(today); // Salin tanggal hari ini
    tanggalMinimal.setDate(tanggalMinimal.getDate() + 3); // Tambahkan 3 hari

    // Konversi tanggal minimal ke format ISO (YYYY-MM-DD) untuk diatur sebagai nilai atribut min
    var tanggalMinimalISO = tanggalMinimal.toISOString().split('T')[0];
    inputTanggal.setAttribute('min', tanggalMinimalISO);

    // Tampilkan pesan untuk pengguna
    pesanTanggal.innerHTML = 'Tanggal keberangkatan minimal H-3 atau ' + tanggalMinimal.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) + '.';
</script>

<script>
    // Ambil elemen input jumlah paket dan pesan error
    var inputJumlahPaket = document.getElementById('jumlah_paket');
    var errorMessage = document.getElementById('error_message');

    // Tambahkan event listener untuk event input
    inputJumlahPaket.addEventListener('input', function(event) {
        // Ambil nilai dari input
        var nilaiInput = inputJumlahPaket.value;

        // Cek jika nilai input bukan angka atau kurang dari 1
        if (!(/^\d+$/.test(nilaiInput)) || parseInt(nilaiInput) < 1) {
            // Tampilkan pesan error
            errorMessage.textContent = 'Minimal jumlah paket adalah 1.';
            // Bersihkan nilai input
            inputJumlahPaket.value = '';
        } else {
            // Kosongkan pesan error jika input valid
            errorMessage.textContent = '';
        }
    });
</script>
@endsection
