@extends('layouts.app')

@section('content')
<div class="container">
    <div class="column">
        <h1>Errore 404</h1>
        <h3>Page not found</h3>
        <p>{{$exception -> getMessage()}}</p>
    </div>
</div>
@endsection

@section('title')
    | 404
@endsection