@extends('layouts.landingpage')
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex gap-5 mb-4">

                <img src="{{ asset('/images/' . $paketWisata->gambar) }}"
                            style="width: 50%; height:350px; border-radius:24px;object-fit:cover;" alt="">
                            <div>

                                <h2 class="fw-semibold">{{$paketWisata->nama}}</h2>
                                <div class="mb-3 d-flex gap-2">
                                    @foreach ($paketWisata->kotas as $kota)
                                        <span class="badge text-bg-success">{{ $kota->nama }}</span>
                                    @endforeach
                                </div>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias dignissimos consequuntur, quam quaerat placeat, ad inventore ullam exercitationem dolorem quae natus a unde nesciunt commodi explicabo odio similique nemo assumenda!</p>
                                <h3 class="fw-semibold text-danger mt-5">Rp {{ number_format($paketWisata->harga, 0, ',', '.') }}</h3>
                            </div>
            </div>
            <div>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header ">
                        <button class="accordion-button collapsed fw-bold " style="border:1px solid #25aae1; border-radius:8px" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          Wisata
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
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
                        <button class="accordion-button collapsed fw-bold" type="button" style="border:1px solid #25aae1; border-radius:8px"data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                          Fasilitas
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            {{$paketWisata->fasilitas}}
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" style="border:1px solid #25aae1; border-radius:8px" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                          Rundown
                        </button>
                      </h2>
                      <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body ">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative lorem500 of how this would look in a real-world application.</div>
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
                    <input type="text" class="form-control" id="nama"  value="{{ Auth::user()->name }}" readonly>
                </div>
                
                  <input type="hidden" class="form-control" id="user_id" name="user_id"  value="{{ Auth::user()->id }}" readonly>
              
                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="paket_id" class="form-label">Nama Paket </label>
                    <input type="text" class="form-control" id="paket_id" name="paket_id" value="{{ $paketWisata->id }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="jumlah_peserta" class="form-label">Jumlah Peserta:</label>
                    <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan:</label>
                    <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" value="{{ old('tanggal_pemesanan') }}" required>
                </div>
                <button type="submit" class="btn btn-login bn26">Submit</button>
            </form>
            
            </div>
        </div>
    </div>
</div>
@endsection