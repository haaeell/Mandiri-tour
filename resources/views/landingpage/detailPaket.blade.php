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
                      {{ $paketWisata->kategori }}
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
            <p>{{ $paketWisata->deskripsi }}</p>
            <p class="fw-bold">Kendaraan : {{ $paketWisata->kendaraan->nama }} /<span class="text-danger">
                    ({{ $paketWisata->kendaraan->kapasitas }} orang) </span>
            </p>
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
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-semibold" id="rundown-tab" data-bs-toggle="tab" data-bs-target="#rundown"
                        type="button" role="tab" aria-controls="rundown" aria-selected="false">Rundown
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold " id="wisata-tab" data-bs-toggle="tab" data-bs-target="#wisata"
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
                    <ul>
                        <div class="accordion" id="accordionExample">
                            @if (!$rundownsGrouped->isEmpty())
                                <div class="text-start mb-3">
                                    <a href="{{ route('rundown.generatePdf', $paketWisata->id) }}" class="btn btn-primary btn-sm">Cetak Rundown</a>
                                </div>
                            @endif
                        
                            @if ($rundownsGrouped->isEmpty())
                                <p>- Rundown belum tersedia. -</p>
                            @else
                                @foreach ($rundownsGrouped as $hari => $rundowns)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $loop->index }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $loop->index }}">
                                                Hari ke-{{ $hari }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $loop->index }}"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="heading{{ $loop->index }}"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ul>
                                                    @foreach ($rundowns as $rundown)
                                                        <li>
                                                            {{ \Carbon\Carbon::parse($rundown->mulai)->format('H.i') }}
                                                            -
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
                        
                        
                    </ul>
                </div>
                <div class="tab-pane fade mt-3" id="wisata" role="tabpanel" aria-labelledby="wisata-tab">
                    <ol>
                        @foreach ($paketWisata->wisatas as $wisata)
                            <li>{{ $wisata->nama }} -  {{ $wisata->kota->nama }}</li>
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
@endsection


