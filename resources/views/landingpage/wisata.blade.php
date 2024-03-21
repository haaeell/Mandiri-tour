@extends('layouts.landingpage')
@section('content')
  <div class="container py-5">
    <div class="card p-3">
        <ul>

            @foreach ($wisatas as $item)
               <li>
                {{$item->nama}}
                {{$item->deskripsi}}
                {{$item->gambar}}

               </li>
            @endforeach
        </ul>
    </div>
  </div>
@endsection