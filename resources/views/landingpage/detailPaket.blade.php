@extends('layouts.landingpage')
@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="d-flex gap-5 mb-4">
              <div class="position-relative">
                <img src="{{ asset('/images/' . $paketWisata->gambar) }}"
                    style="width: 100%; height:350px; border-radius:24px;object-fit:cover;" alt="">
                    <div class="bg-danger text-white px-4 py-1 rounded fw-semibold position-absolute rounded-pill" style="transform: rotate(30deg); top: 10px; right: -20px;">
                      {{ $paketWisata->durasi }}
                  </div>
                    <span class="position-absolute bottom-0 end-0 m-2 bg-white px-2 py-1 rounded fw-semibold">
                      {{ $paketWisata->kategori->nama }}
                  </span>
              </div>
            </div>
        </div>
        <div class="col-md-8">
          <div>

            <h2 class="fw-semibold">{{ $paketWisata->nama }}</h2>
            <div class="mb-3 d-flex gap-2">
                @foreach ($paketWisata->kotas as $kota)
                    <span class="badge bg-primary">{{ $kota->nama }}</span>
                @endforeach
            </div>
            <p class="deskripsi-paket m-0">{{ Illuminate\Support\Str::limit($paketWisata->deskripsi, $limit = 400) }}</p>
                <!-- Anchor "Lihat Selengkapnya" -->
                @if (strlen($paketWisata->deskripsi) > 400)
                    <a href="#" class="lihat-selengkapnya" data-full-description="{{ $paketWisata->deskripsi }}">Lihat Selengkapnya</a>
                @endif

                
            <h5 class="fw-bold mt-4 mb-1">Kendaraan : {{ $paketWisata->kendaraan->nama }} /<span class="text-danger">
                    ({{ $paketWisata->kendaraan->kapasitas }} orang) </span>
            </h5>
            
            <p class="deskripsi-paket m-0">{{ Illuminate\Support\Str::limit($paketWisata->kendaraan->deskripsi, $limit = 100) }}</p>
                <!-- Anchor "Lihat Selengkapnya" -->
                @if (strlen($paketWisata->kendaraan->deskripsi) > 100)
                    <a href="#" class="lihat-selengkapnya kendaraan" data-full-description="{{ $paketWisata->kendaraan->deskripsi }}">Lihat Selengkapnya</a>
                @endif
            <div class="d-flex mt-3 justify-content-between">

                <h3 class="fw-semibold text-danger">Rp {{ number_format($paketWisata->harga, 0, ',', '.') }}
                </h3>
                <div class="col-md-3">

                    <a href="{{ route('detailPaketForm', $paketWisata->slug) }}" class="btn btn-paket">Pesan
                        Sekarang</a>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="card p-4" style="background-color: #dfe2f5; border:2px solid #25aae1">
            <div class="mb-4">
                <h5 class="fw-bold text-primary "><i class="bi bi-box-seam-fill "></i> Tentang {{$paketWisata->nama}}</h5>
                <div class="col-md-6">
                    <p class="m-0 ">
                        Berikut informasi tambahan meliputi rundown perjalanan , wisata yang dikunjungi dan  fasilitas yang disediakan
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
@endsection


