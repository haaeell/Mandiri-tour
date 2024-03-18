@extends('layouts.dashboard')
@section('title')
    
<h2>Tambah Paket Wisata</h2>
@endsection
@section('content')
<div class="container card p-4">
    <form action="{{ route('paket-wisata.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Paket Wisata -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="nama">Nama Paket Wisata<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group ">
                    <input type="text" name="nama" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="kotas">Kota<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group ">
                    <select name="kotas[]" class="form-control select2" multiple required>
                        @foreach ($kotas as $kota)
                            <option value="{{ $kota->id }}">{{ $kota->nama }}</option>
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
                <div class="form-group ">
                    <div class="position-relative">
                        <input type="file" class="image-preview-filepond" name="gambar" accept="image/*" required>
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
                <div class="form-group ">
                    <textarea name="deskripsi" class="form-control" required></textarea>
                </div>
            </div>
        </div>

        <!-- Fasilitas -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="fasilitas">Fasilitas<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group ">
                    <textarea name="fasilitas" class="form-control" required></textarea>
                </div>
            </div>
        </div>

        <!-- Harga -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="harga">Harga<span class="text-danger" >*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group ">
                    <input type="text" name="harga" class="form-control rupiah" required>
                </div>
            </div>
        </div>

        <!-- Kategori -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="kategori">Kategori<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group ">
                    <input type="text" name="kategori" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Durasi -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="durasi">Durasi (hari)<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group ">
                    <input type="text" name="durasi" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Wisata -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="wisatas">Wisata<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group ">
                    <select name="wisatas[]" class="select2 form-control" multiple required>
                        @foreach ($wisatas as $wisata)
                            <option value="{{ $wisata->id }}">{{ $wisata->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- Kendaraan -->
        <div class="mb-2 d-flex">
            <div class="col-md-2">
                <label for="kendaraan_id">Kendaraan<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <select name="kendaraan_id" class="form-control" required>
                        <option value="">Pilih Kendaraan</option>
                        @foreach ($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}">{{ $kendaraan->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary float-end">Simpan</button>
    </form>
</div>
@endsection

@section('script')

@endsection

