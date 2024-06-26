@extends('layouts.landingpage')

@section('content')

<style>
  .skeleton {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    width: 100%;
    height: auto;
    min-height: 300px; /* Sesuaikan tinggi minimum sesuai kebutuhan */
    border-radius: 10px;
    background-color: #f7f7f7;
    overflow: hidden;
    position: relative;
}

.skeleton-image {
    width: 100%;
    height: 200px; /* Sesuaikan tinggi gambar sesuai kebutuhan */
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    background-color: #e0e0e0;
}

.skeleton-details {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}

.skeleton-title {
    width: 80%;
    height: 20px;
    margin-bottom: 10px;
    background-color: #e0e0e0;
}

.skeleton-info {
    width: 50%;
    height: 15px;
    margin-bottom: 10px;
    background-color: #e0e0e0;
}

.skeleton-description {
    width: 100%;
    height: 80px; /* Sesuaikan tinggi deskripsi sesuai kebutuhan */
    background-color: #e0e0e0;
}

</style>

<div class="container py-5">
    <h2 class="fw-bold text-center mb-3" data-aos="fade-down">WISATA</h2>
    <div class="row">
        <div class="col-md-3 mb-3" data-aos="fade-right">
            <label for="select-kota" class="form-label">Filter Wisata Berdasarkan Kota:</label>
            <select id="select-kota" class="form-select select2">
                <option value="">Semua Kota</option>
            </select>
        </div>
    </div>
    <div id="loading" class="text-center row">
        <!-- Skeletons will be displayed here -->
    </div>

    <div class="row d-flex" id="data-wisata">
        <!-- Data will be loaded here -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDeskripsi" tabindex="-1" aria-labelledby="modalDeskripsiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeskripsiLabel">Deskripsi Wisata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="deskripsiWisata"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@section('script')
<script>
    $(document).ready(function () {
        loadData();
        loadKota();
    });

    async function loadData(kotaId = null) {
    try {
        let url = "{{ route('fetch.wisata') }}";
        if (kotaId) {
            url += `?kota_id=${kotaId}`;
        }

        $('#loading').html(generateSkeleton(4)); 

        const response = await fetch(url);

        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }

        const data = await response.json();

        renderWisata(data);
    } catch (error) {
        console.error('Error:', error);
    }
}

async function loadKota() {
    try {
        const response = await fetch("{{ route('fetch.kota') }}");

        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }

        const data = await response.json();

        data.forEach(kota => {
            $('#select-kota').append(`<option value="${kota.id}">${kota.nama}</option>`);
        });

        $('#select-kota').change(function () {
            const kotaId = $(this).val();
            loadData(kotaId);
        });

    } catch (error) {
        console.error('Error:', error);
    }
}


    function generateSkeleton(count) {
        let skeletonHtml = '';
        for (let i = 0; i < count; i++) {
            skeletonHtml += `
            <div class="col-md-3">
              <div class="card mb-3 border-0">
                  <div class="skeleton">
                      <div class="skeleton-image"></div>
                      <div class="skeleton-details">
                          <div class="skeleton-title"></div>
                          <div class="skeleton-info"></div>
                          <div class="skeleton-description"></div>
                      </div>
                  </div>
              </div>
          </div>
            `;
        }
        return skeletonHtml;
    }

    
    function renderWisata(data) {
        $('#loading').empty();

        if (data.length === 0) {
            $('#data-wisata').html(`<div class="text-center col-md-12">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/data-search-not-found-7464562-6109670.png" style="width: 250px;" alt="">
                <p class="fw-semibold fs-5">~ Tidak ada wisata yang ditemukan berdasarkan kota yang dipilih ~</p>
            </div>`);
            return;
        }

        let wisataHtml = '';
        data.forEach(wisata => {
            const deskripsiSingkat = wisata.deskripsi.substring(0, 50) + '...';
            wisataHtml += `
                <div class="col-md-3" data-aos="fade-left"
     data-aos-anchor="#example-anchor"
     data-aos-offset="500"
     data-aos-duration="500">
                    <div style="cursor: pointer;" class="card mb-3 border-0" data-bs-toggle="modal" data-bs-target="#modalDeskripsi" data-deskripsi="${wisata.deskripsi}">
                        <img src="${wisata.gambar}" class="card-img-top img-card" style="height: 200px; object-fit: cover;" alt="${wisata.nama}">
                        <div class="card-body">
                            <h5 class="fw-semibold">${wisata.nama}</h5>
                            <p class="card-text">${wisata.kota}</p>
                            <p class="card-text">${deskripsiSingkat} </p>
                        </div>
                    </div>
                </div>
            `;
        });

        $('#data-wisata').html(wisataHtml);

        $('.card').click(function () {
          const deskripsi = $(this).data('deskripsi');
            $('#deskripsiWisata').text(deskripsi);
        });

        $('.skeleton').remove();
    }
</script>


@endsection