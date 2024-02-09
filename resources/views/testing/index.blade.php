@extends('layouts.dashboard')

{{-- @section('content')
    <div class="container">
        <div class="container px-4 mx-auto">

            <div class="p-6 m-20 bg-white rounded shadow">
                {!! $chart->container() !!}
            </div>
        
        </div>
        
        <script src="{{ $chart->cdn() }}"></script>
        
        {{ $chart->script() }}
    </div>
@endsection --}}

@section('content')
    <form method="post" action="{{ route('kabisat') }}">
        @csrf
        <label for="website_url">Masukan Tahun: </label>
        <input type="number" name="tahun" required>
        <button type="submit">Cek tahun kabisat</button>
    </form>
@endsection

