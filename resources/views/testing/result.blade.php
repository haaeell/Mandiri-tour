@extends('layouts.dashboard')
@section('content')
    <h2>SEO Check Results</h2>

    @if(isset($seoResults))
        <ul>
            <li><strong>Title:</strong> {{ $seoResults['title'] }}</li>
            <li><strong>Meta Description:</strong> {{ $seoResults['meta_description'] }}</li>
            <!-- Tambahkan informasi SEO lainnya sesuai kebutuhan -->
        </ul>
    @else
        <p>No SEO results available.</p>
    @endif
@endsection