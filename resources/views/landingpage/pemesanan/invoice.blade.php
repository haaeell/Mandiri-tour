<!-- resources/views/landingpage/pemesanan/invoice.blade.php -->

@extends('layouts.landingpage')

@section('content')
    <div class="container mt-5">
        @if ($pemesanan->bukti_pembayaran > 0 && $pemesanan->status_pembayaran != 'Pembayaran Diterima')
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading fw-semibold mb-3">
                <i class="bi bi-clock-fill text-warning me-2"></i> <!-- Tambahkan ikon jam disini -->
                Pembayaran Sedang Diperiksa!
            </h4>
            <p>Pembayaran Anda sedang dalam proses pengecekan oleh admin. <br>
                Terima kasih atas kesabaran Anda.</p>
            
            <a href="https://wa.me/6285321726312" target="_blank" class="btn-sm btn btn-warning text-white " >
                <i class="bi bi-whatsapp"></i> Hubungi Admin
            </a>   
        </div>
        
        @elseif ($pemesanan->bukti_pembayaran > 0 && $pemesanan->status_pembayaran === 'Pembayaran Diterima')
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading fw-semibold mb-3">
                <i class="bi bi-check-circle-fill text-success me-2"></i> <!-- Tambahkan ikon centang disini -->
                Pembayaran Berhasil!
            </h4>
            <p>Berikut adalah detail pesanan Anda beserta jadwal perjalanan yang telah berhasil dipesan <br> Untuk informasi lebih lanjut, jangan ragu untuk menghubungi Admin kami . Terimakasih </p> <!-- Tambahkan kalimat agar lebih lengkap -->
            <hr>
            <a href="https://wa.me/6285321726312" target="_blank" class="btn-sm btn text-white " style="background-color: #047857">
                <i class="bi bi-whatsapp"></i> Hubungi Admin
            </a>       
            <a href="{{ route('cetak.invoice', ['id' => $pemesanan->id]) }}" class="btn-sm btn text-white ms-2" style="background-color: #e01e05">
                <i class="bi bi-printer"></i> Cetak Invoice
            </a>
        </div>
        
        @endif
        
        @if ($pemesanan->status_pembayaran != 'Pembayaran Diterima')
            
        
        <div class="card shadow mb-5 " style="border-radius: 24px">
            <div class="bg-warning p-2" style="border-top-left-radius: 24px; border-top-right-radius: 24px;">
                <h2 class="fw-semibold text-center text-light">Detail Pembayaran</h2>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <dl class="row d-flex justify-content-between align-itmes-center">
                            <div class="col-md-8">
                                <div class="d-flex">

                                    <dt class="col-sm-4">ID Pemesanan</dt>
                                    <dt class="col-sm-8">:  {{ $pemesanan->id }}</dt>
                                </div>
                                <div class="d-flex">

                                    <dt class="col-sm-4">Nama Pemesan</dt>
                                    <dt class="col-sm-8">:  {{ $pemesanan->user->name }}</dt>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="d-flex ">

                                    <dt class="col-sm-4">No. Telepon </dt>
                                    <dt class="col-sm-8">:  {{ $pemesanan->user->phone }}</dt>
                                </div>
                                <div class="d-flex">

                                    <dt class="col-sm-4">Tanggal </dt>
                                    <dt class="col-sm-8">:  {{ $pemesanan->tanggal_keberangkatan_indo }}</dt>
                                </div>
                            </div>
                            
                        </dl>
                        <hr/>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead class="table-warning">
                                <tr>
                                    <th>Nama Paket</th>
                                    <th>Jumlah Paket</th>
                                    <th>Harga per Paket</th>
                                    <th>Terbilang</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>{{ $pemesanan->paket->nama }}</td>
                                    <td>{{ $pemesanan->jumlah_paket }}</td>
                                    <td>{{ 'Rp '.number_format($pemesanan->paket->harga, 0, ',', '.') }}</td>
                                    <td class="  "> <i> {{ ucwords(\App\Helpers\TerbilangHelper::terbilang($pemesanan->total_pembayaran)) }} Rupiah</i></td>
                                <td class="fw-bold text-danger">{{ 'Rp '.number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <h3 class="mb-0 fw-semibold">Informasi Pembayaran</h3>
                        <p>Silakan transfer total pembayaran ke rekening  berikut: <span class="fw-bold text-success"> Nomor Rekening     BCA 1234-5678-9012 . A/N SUJEWO TEJO</span> </p>
                    </div>
                </div>

            </div>
        </div>
        @if (!$pemesanan->bukti_pembayaran > 0)
            
        <div class="row mt-3 jjustify-content-between my-5">         
            <div class="col-md-8">
                @if($pemesanan->status_pembayaran != 'Pemesanan Dibatalkan')
                        <form action="{{ route('pemesanan.cancel', $pemesanan->id) }}" method="post">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-danger btn-sm">Batalkan Pemesanan</button>
                        </form>
                    @endif
            </div>
            
            <div class="col-md-4">
                <h3 class="fw-semibold text-center mb-3">Upload Bukti Pembayaran</h3>
                <div class="card border-dashed-blue shadow-lg" style="cursor: pointer;">
                    <div class="card-body text-center" id="upload_area" onclick="openFileSelection();" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);">
                        <form id="upload_form" action="{{ route('pemesanan.upload', $pemesanan->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="upload_image" name="bukti_pembayaran" accept="image/jpeg, image/png" style="display: none;" onchange="displayImage(event)" required>
                            <i id="upload_icon" class="bi bi-cloud-upload fs-1"></i>
                            <h4 id="file_upload_title" class="mb-3 fw-semibold">Pilih atau Seret File</h4>
                            <p id="file_upload_instruction">Klik disini atau seret file gambar ke sini</p>
                            <img id="output_image" class="img-fluid mt-3 mb-3" style="display: none; margin: 0 auto;">
                            
                            <p id="file_upload_info" class="mt-3">File harus berformat PNG, JPG, atau JPEG. Ukuran maksimum 2 MB.</p>
                        </form>
                    </div>
                </div>
                <button type="button" class="btn btn-primary w-100" id="submit_button" style="display: none;" onclick="submitForm()">Kirim</button>
            </div>

        </div>
        @endif
        @else

        <h2 class="text-center fw-semibold my-4">
            Detail Pesanan
         </h2>
         <div class="card p-3 my-5">
                     
             <div class="col-md-12">
                 <table class="table" >
                     <thead class="table-light">
                         <tr>
                             <th>Nama Paket</th>
                             <th>Jumlah Paket</th>
                             <th>Alamat</th>
                             <th>Tanggal Keberangkatan</th>
                             <th>Status</th>
                         </tr>
                     </thead>
                     
                     <tbody class="table-group-divider">
                         <tr>
                             <td>{{ $pemesanan->paket->nama }}</td>
                             <td>{{ $pemesanan->jumlah_paket }}</td>
                             <td>{{ $pemesanan->alamat }}</td>
                             <td>{{ $pemesanan->tanggal_keberangkatan_indo}}</td>
                             <td><span class="badge bg-success">{{ $pemesanan->status_pembayaran }}</span></td>
     
                         </tr>
                     </tbody>
                 </table>
 
                 <h2 class="fw-semibold text-center my-5">Detail Paket Wisata</h2>
                 
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="d-flex gap-5 mb-4">
              <div class="position-relative">
                <img src="{{ asset('/images/' . $pemesanan->paket->gambar) }}"
                    style="width: 100%; height:350px; border-radius:24px;object-fit:cover;" alt="">
                    <div class="bg-danger text-white px-4 py-1 rounded fw-semibold position-absolute rounded-pill" style="transform: rotate(30deg); top: 10px; right: -20px;">
                      {{ $pemesanan->paket->durasi }}
                  </div>
                    <span class="position-absolute bottom-0 end-0 m-2 bg-white px-2 py-1 rounded fw-semibold">
                      {{ $pemesanan->paket->kategori->nama }}
                  </span>
              </div>
            </div>
        </div>
        <div class="col-md-8">
          <div>

            <h2 class="fw-semibold">{{ $pemesanan->paket->nama }}</h2>
            <div class="mb-3 d-flex gap-2">
                @foreach ($pemesanan->paket->kotas as $kota)
                    <span class="badge bg-primary">{{ $kota->nama }}</span>
                @endforeach
            </div>
            <p class="deskripsi-paket m-0">{{ Illuminate\Support\Str::limit($pemesanan->paket->deskripsi, $limit = 400) }}</p>
                <!-- Anchor "Lihat Selengkapnya" -->
                @if (strlen($pemesanan->paket->deskripsi) > 400)
                    <a href="#" class="lihat-selengkapnya" data-full-description="{{ $pemesanan->paket->deskripsi }}">Lihat Selengkapnya</a>
                @endif

                
            <p class="fw-bold mt-2">Kendaraan : {{ $pemesanan->paket->kendaraan->nama }} /<span class="text-danger">
                    ({{ $pemesanan->paket->kendaraan->kapasitas }} orang) </span>
            </p>
            <div class="d-flex mt-3 justify-content-between">

                <h3 class="fw-semibold text-danger">Rp {{ number_format($pemesanan->paket->harga, 0, ',', '.') }}
                </h3>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="card p-4" style="background-color: #dfe2f5; border:2px solid #25aae1">
            <div class="mb-4">
                <h5 class="fw-bold text-primary "><i class="bi bi-box-seam-fill "></i> Tentang {{$pemesanan->paket->nama}}</h5>
                <div class="col-md-6">
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
                                    <a href="{{ route('rundown.generatePdf', $pemesanan->paket->id) }}" class="btn btn-primary btn-sm">Cetak Rundown</a>
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
                                @foreach ($pemesanan->paket->wisatas as $wisata)
                                    <li>{{ $wisata->nama }} - {{ $wisata->kota->nama }}</li>
                                @endforeach
                            </ol>
                        </div>
        
                        <div class="tab-pane fade mt-3" id="fasilitas" role="tabpanel" aria-labelledby="fasilitas-tab">
                            {{ $pemesanan->paket->fasilitas }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
                 
             </div>
 
         </div> 
        @endif
       
        
    </div>
@endsection

@section('script')

<script>
    function openFileSelection() {
        document.getElementById('upload_image').click();
    }
    
    function displayImage(event) {
        var file = event.target.files[0];
        displayImageFromFile(file);
    }
    
    function displayImageFromFile(file) {
        var image = document.getElementById('output_image');
        var uploadIcon = document.getElementById('upload_icon');
        image.src = URL.createObjectURL(file);
        image.style.display = 'block'; // Tampilkan gambar yang dipilih
        image.style.margin = '0 auto'; // Letakkan gambar di tengah
        uploadIcon.style.display = 'none'; // Sembunyikan icon Bootstrap
        document.getElementById('submit_button').style.display = 'block'; // Tampilkan tombol kirim
        document.getElementById('file_upload_title').style.display = 'none'; // Sembunyikan judul "Pilih atau Seret File"
        document.getElementById('file_upload_instruction').style.display = 'none'; // Sembunyikan instruksi "Klik disini atau seret file gambar ke sini"
        document.getElementById('file_upload_info').style.display = 'none'; // Sembunyikan informasi tentang file
    }
    
    function dragOverHandler(event) {
        event.preventDefault();
        document.getElementById('upload_area').classList.add('dragover');
    }
    
    function dragLeaveHandler(event) {
        event.preventDefault();
        document.getElementById('upload_area').classList.remove('dragover');
    }
    
    function dropHandler(event) {
        event.preventDefault();
        document.getElementById('upload_area').classList.remove('dragover');
        var file = event.dataTransfer.files[0];
        displayImageFromFile(file);
        // Menyalin file yang di-drop ke elemen input file
        document.getElementById('upload_image').files = event.dataTransfer.files;
    }
    
    function submitForm() {
        // Memastikan bahwa gambar telah dipilih sebelum mengirim form
        var image = document.getElementById('output_image');
        if (image.style.display !== 'none') {
            document.getElementById('upload_form').submit();
        } else {
            alert('Silakan pilih gambar terlebih dahulu.');
        }
    }
    </script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lihatSelengkapnyaLinks = document.querySelectorAll('.lihat-selengkapnya');

        lihatSelengkapnyaLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const fullDescription = this.getAttribute('data-full-description');
                const deskripsiElement = this.previousElementSibling;
                deskripsiElement.textContent = fullDescription;
                deskripsiElement.style.display = 'block';
                this.style.display = 'none';
            });
        });
    });
</script>

@endsection