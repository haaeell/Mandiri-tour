@extends('layouts.dashboard')
@section('title')
    
<h2>Tambah Rundown</h2>
@endsection
@section('content')
<div class="container card p-3">
    <form action="{{ route('rundown.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tour_package_id">Nama Paket Wisata</label>
            <input type="text" readonly class="form-control" value="{{ $paketWisata->nama }}" id="">
            <input type="hidden" name="paket_wisata_id" value="{{ $paketWisata->id }}" id="">
        </div>
        
        <div id="activities">
            <div class="activity">
                <div class="row d-flex align-items-center">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="hari_ke[]">Hari</label>
                            <input type="number" name="hari_ke[]" class="form-control day-input" value="1" required readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="mulai[]">Jam Mulai</label>
                            <input type="time" name="mulai[]" class="form-control" value="{{ old('mulai.0') }}" required>
                        </div>
                    </div>
                    <div class="col-md-2"> 
                        <div class="form-group">
                            <label for="selesai[]">Jam Selesai</label>
                            <input type="time" name="selesai[]" class="form-control" value="{{ old('selesai.0') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="deskripsi[]">Deskripsi Aktivitas</label>
                            <textarea name="deskripsi[]" class="form-control" required>{{ old('deskripsi.0') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success addActivity btn-sm">Tambah </button>
                        <button type="button"  class="btn btn-danger removeActivity btn-sm">Hapus </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tombol tambah hari -->
        <div class="d-flex gap-2 mb-2">
            <button type="button" class="btn btn-info" id="addDay">Tambah Hari</button>
        </div>
        <button type="submit" class="btn btn-primary float-end">Simpan</button>
    </form>
</div>
@endsection

@section('script')
<script>
 $(document).ready(function() {
    // Sembunyikan tombol hapus di elemen pertama saat halaman dimuat
    $('#activities .activity:first-child .removeActivity').hide();

    // Tambah aktivitas
    $(document).on('click', '.addActivity', function() {
        var newActivityField = $(this).closest('.activity').clone();
        newActivityField.find('input[type="time"], textarea').val(''); // Mengosongkan nilai input
        newActivityField.hide().insertAfter($(this).closest('.activity')).slideDown();

        // Tampilkan tombol hapus di semua elemen kecuali elemen pertama
        $('#activities .activity .removeActivity').show();
    });

    // Tambah hari
    $(document).on('click', '#addDay', function() {
        var newDayField = $('#activities .activity').first().clone();
        var currentDay = parseInt($('#activities .activity:last-child input[name^="hari_ke"]').val());
        newDayField.find('input[name^="hari_ke"]').val(currentDay + 1);
        newDayField.find('input[type="time"], textarea').val(''); // Mengosongkan nilai input

        // Tampilkan tombol hapus di semua elemen kecuali elemen pertama
        $('#activities .activity .removeActivity').show();

        // Sisipkan hari baru
        newDayField.hide().insertAfter($('#activities .activity:last-child')).slideDown();
    });

    // Hapus aktivitas
    $(document).on('click', '.removeActivity', function() {
        $(this).closest('.activity').slideUp(function() {
            $(this).remove();

            // Periksa apakah jumlah elemen hanya satu, jika iya, sembunyikan tombol hapus di elemen tersebut
            if ($('#activities .activity').length === 1) {
                $('#activities .activity .removeActivity').hide();
            }
        });
    });
});


</script>
@endsection
