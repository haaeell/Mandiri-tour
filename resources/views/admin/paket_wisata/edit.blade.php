@extends('layouts.dashboard')

@section('content')
<div class="container card p-4">
    <form action="{{ route('paket-wisata.update', $paketWisata->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Tambahkan method PUT untuk keperluan update -->

        <!-- Nama Paket Wisata -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="nama">Nama Paket Wisata<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <input type="text" name="nama" class="form-control" value="{{ $paketWisata->nama }}" required>
                </div>
            </div>
        </div>

        <!-- Kota -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="kotas">Kota<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <select name="kotas[]" class="form-control select2" multiple required>
                        @foreach ($kotas as $kota)
                            <option value="{{ $kota->id }}" {{ in_array($kota->id, $paketWisata->kotas->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $kota->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Gambar -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="gambar">Gambar<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <div class="position-relative">
                        <input type="file" class="image-preview-filepond" name="gambar" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="deskripsi">Deskripsi<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <textarea name="deskripsi" class="form-control" required>{{ $paketWisata->deskripsi }}</textarea>
                </div>
            </div>
        </div>

        <!-- Fasilitas -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="fasilitas">Fasilitas<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <textarea name="fasilitas" class="form-control" required>{{ $paketWisata->fasilitas }}</textarea>
                </div>
            </div>
        </div>

        <!-- Harga -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="harga">Harga<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <input type="text" name="harga" class="form-control rupiah" value="{{ number_format($paketWisata->harga, 0, ',', '.') }}" required>
                </div>
            </div>
        </div>

        <!-- Kategori -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="kategori">Kategori<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <input type="text" name="kategori" class="form-control" value="{{ $paketWisata->kategori }}" required>
                </div>
            </div>
        </div>

        <!-- Durasi -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="durasi">Durasi (hari)<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <input type="text" name="durasi" class="form-control" value="{{ $paketWisata->durasi }}" required>
                </div>
            </div>
        </div>

        <!-- Wisata -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="wisatas">Wisata<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <select name="wisatas[]" class="select2 form-control" multiple required>
                        @foreach ($wisatas as $wisata)
                            <option value="{{ $wisata->id }}" {{ in_array($wisata->id, $paketWisata->wisatas->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $wisata->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <!-- Spasi kosong untuk menyamakan lebar kolom -->
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

