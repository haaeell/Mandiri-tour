<!-- resources/views/keluhan/index.blade.php -->

@extends('layouts.landingpage')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow"  style="border-top-left-radius: 24px; border-top-right-radius: 24px;">
                    <div class="p-3 fw-semibold fs-5 text-center"  style="border-top-left-radius: 24px; border-top-right-radius: 24px;">Ajukan Keluhan</div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('keluhan.store') }}" id="form-tambah">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" style="height: 100px" required></textarea>
                            </div>

                            <div>
                                
                            </div>
                            <button type="submit" id="keluhan-btn" class="btn w-100 btn-primary mt-3 d-block ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card"  style="border-top-left-radius: 24px; border-top-right-radius: 24px;">
                    <div class="bg-primary p-3 text-light fw-semibold fs-5 text-center"  style="border-top-left-radius: 24px; border-top-right-radius: 24px;">Riwayat Keluhan</div>

                    <div class="card-body">
                        @if($riwayatKeluhan->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <th>Tanggal</th>
                                        <th>Isi Keluhan</th>
                                        <th>Status</th>
                                        <th>Tanggapan Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayatKeluhan as $riwayat)
                                        <tr>
                                            <td>{{ $riwayat->user->name }}</td>
                                            <td>{{ $riwayat->created_at_indo}}</td>
                                            <td>{{ $riwayat->description }}</td>
                                            <td>  <span class="badge {{ $riwayat->status === 'resolved' ? 'text-bg-success' : ($riwayat->status === 'pending' ? 'text-bg-warning' : 'text-bg-default') }}">
                                                {{ $riwayat->status }}
                                            </span></td>
                                            <td > {{ $riwayat->admin_response ?? 'Belum ada tanggapan' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        @else
                            <p class="text-center">~ Belum ada riwayat keluhan. ~</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#form-tambah').on('submit', function(event) {
            event.preventDefault(); 
            
            $('#keluhan-btn').prop('disabled', true);  
            $('#keluhan-btn').text('Bentar yaaa...');  
    
            this.submit(); 
        });
    });
    </script>

@endsection
