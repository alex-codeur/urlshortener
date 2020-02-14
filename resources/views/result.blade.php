@extends('layouts.base')

@section('content')
    <h1>Find your shortener url below</h1>

    <a href="{{ config('app.url') }}/{{ $shortened }}">
        {{ config('app.url') }}/{{ $shortened }}
    </a>
@endsection