@extends('layouts.landingpage')
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex gap-5 mb-4">

                <img src="{{ asset('/images/' . $paketWisata->gambar) }}"
                            style="width: 50%; height:350px; border-radius:24px" alt="">
                            <div>

                                <h2 class="fw-semibold">Nama Paket A</h2>
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
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
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
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                          Fasilitas
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                          Rundown
                        </button>
                      </h2>
                      <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                      </div>
                    </div>
                  </div>
            </div>


        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae quidem ex, voluptas praesentium, inventore temporibus porro quibusdam vel commodi ea accusantium neque culpa eum! Nostrum, officiis? Quam suscipit reprehenderit necessitatibus! Sapiente reiciendis placeat maiores voluptatum distinctio voluptatibus consectetur hic illum deserunt praesentium eos aut ut quod modi repellat quaerat, velit ad beatae fugit perspiciatis veniam accusamus saepe. Hic, quisquam maiores possimus fugiat architecto, ab distinctio quo doloribus ullam nemo deserunt itaque consequuntur cum praesentium omnis cumque corrupti dicta aliquam qui, eum error aliquid eveniet esse? Vel distinctio cupiditate ex! Quo quae omnis libero dicta vel voluptas fugit accusamus suscipit iusto?</p>
            </div>
        </div>
    </div>
</div>
@endsection