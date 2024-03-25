@extends('layouts.dashboard')
@section('title')
    <h2>Edit Rundown</h2>
@endsection

@section('content')
<div class="container card p-3">
    <form action="{{ route('rundown.updateRundown', $paketWisata->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tour_package_id">Nama Paket Wisata</label>
            <input type="text" readonly class="form-control" value="{{ $paketWisata->nama }}" id="">
            <input type="hidden" name="paket_wisata_id" value="{{ $paketWisata->id }}" id="">
        </div>
        
        <div id="activities">
            @foreach($rundowns as $rundown)
<div class="activity">
    <div class="row d-flex align-items-center">
        <input type="hidden" name="activity_id[]" value="{{ $rundown->id }}">
        <div class="col-md-1">
            <div class="form-group">
                <label for="hari_ke[]">Hari</label>
                <input type="number" name="hari_ke[]" readonly class="form-control day-input" value="{{ $rundown->hari_ke }}" required >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="mulai[]">Jam Mulai</label>
                <input type="time" name="mulai[]" class="form-control" value="{{ $rundown->mulai }}" required>
            </div>
        </div>
        <div class="col-md-2"> 
            <div class="form-group">
                <label for="selesai[]">Jam Selesai</label>
                <input type="time" name="selesai[]" class="form-control" value="{{ $rundown->selesai }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="deskripsi[]">Deskripsi Aktivitas</label>
                <textarea name="deskripsi[]" class="form-control" required>{{ $rundown->deskripsi }}</textarea>
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-success addActivity btn-sm">Tambah </button>
            <button type="button" class="btn btn-danger deleteActivity btn-sm">Hapus</button>
            
        </div>
    </div>
</div>
@endforeach

        </div>
        
        <!-- Tombol tambah hari -->
        <div class="d-flex gap-2 mb-2">
            <button type="button" class="btn btn-info" id="addDay">Tambah Hari</button>
        </div>
        <button type="submit" class="btn btn-primary float-end">Simpan</button>
    </form>
    <div class="mt-2">
        <form action="{{ route('rundown.deleteAll', $paketWisata->id) }}" method="POST" id="form-delete-all">
            @csrf
            @method('DELETE')
            <!-- Tambahkan tombol atau elemen lainnya -->
            <button type="submit" class="btn btn-danger float-end" onclick="confirmDeleteAll()">Hapus Semua Rundown</button>
        </form>
        
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
    var dayCount = {{ $rundowns->max('hari_ke') }}; // Mengatur jumlah hari sesuai dengan hari terakhir

    // Tambah aktivitas
    $(document).on('click', '.addActivity', function() {
        // Periksa ID aktivitas yang sudah ada
        var existingIds = [];
        $('.activity').each(function() {
            var activityId = $(this).find('input[name="activity_id[]"]').val();
            existingIds.push(activityId);
        });
        
        // Buat ID baru yang unik
        var newActivityId = generateUniqueId(existingIds);
        
        // Clone elemen aktivitas dan atur ID baru
        var newActivityField = $(this).closest('.activity').clone();
        newActivityField.find('input[type="time"], textarea').val(''); // Mengosongkan nilai input
        newActivityField.find('input[name="activity_id[]"]').val(newActivityId); // Setel ID baru
        newActivityField.hide().insertAfter($(this).closest('.activity')).slideDown();
    });

    function generateUniqueId(existingIds) {
        var newId = Math.max(...existingIds) + 1;
        return newId.toString();
    }

    $('#addDay').click(function() {
  dayCount++;
  var newDayField = $('#activities .activity').last().clone(true); // Clone with descendants
  var currentDay = parseInt(newDayField.find('input[name^="hari_ke"]').val());
  newDayField.find('input[name^="hari_ke"]').val(currentDay + 1);
  newDayField.find('input[type="time"], textarea').val('');  // Clear input values

  // Update activity IDs within the new day
  newDayField.find('.activity').each(function() {
    var existingIds = [];
    $('.activity').each(function() {
      var activityId = $(this).find('input[name="activity_id[]"]').val();
      existingIds.push(parseInt(activityId));
    });
    var newActivityId = Math.max(...existingIds) + 1;
    $(this).find('input[name="activity_id[]"]').val(newActivityId);
  });

  // Insert and show the new day
  newDayField.hide().insertAfter($('#activities .activity').last()).slideDown();
});


    // Hapus aktivitas
    $(document).on('click', '.deleteActivity', function() {
        $(this).closest('.activity').remove();
    });

    // Hapus aktivitas menggunakan AJAX
    $(document).on('click', '.deleteActivity', function() {
        var activityId = $(this).closest('.activity').find('input[name="activity_id[]"]').val();
        
        $.ajax({
            url: '{{ route("rundown.deleteActivity") }}',
            type: 'DELETE',
            data: {
                activity_id: activityId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Aktivitas berhasil dihapus
                    $(this).closest('.activity').remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'Aktivitas berhasil dihapus',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ada kesalahan saat menghapus aktivitas'
                });
            }
        });
    });

    // Konfirmasi hapus semua
    function confirmDeleteAll() {
        event.preventDefault(); // Menghentikan aksi bawaan form
        const form = document.getElementById('form-delete-all');
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus semua rundown?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Mengirimkan formulir jika konfirmasi diizinkan
            }
        });
    }
});

</script>

@endsection
