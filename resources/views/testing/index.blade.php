@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="container px-4 mx-auto">

            <div class="p-6 m-20 bg-white rounded shadow">
                {!! $chart->container() !!}
            </div>
        
        </div>
        
        <script src="{{ $chart->cdn() }}"></script>
        
        {{ $chart->script() }}
    </div>
@endsection

