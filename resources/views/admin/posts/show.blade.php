@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content}}</p>
    </div>
    <div class="row my-5">
        <a href="{{ route('admin.posts.edit', $post)}}" class="btn btn-success ml-3 mr-3">Edit</a>
        <form onsubmit="return confirm('Confermi Eliminazione Post: {{$post->title}} ')" action="{{ route('admin.posts.destroy', $post)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
    </div>
</div>
@endsection

@section('title')
    | {{ $post->title }}
@endsection