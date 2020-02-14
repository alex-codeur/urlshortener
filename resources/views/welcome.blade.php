@extends('layouts.base')

@section('content')
    <h1>Url Shortener</h1>

    <form action="" method="POST">
        @csrf
    <input type="text" name="url" placeholder="Enter your url original here" value="{{ old('url') }}" autocomplete="off">
        {!! $errors->first('url','<p class="error-msg">:message</p>') !!}
    </form>
@endsection