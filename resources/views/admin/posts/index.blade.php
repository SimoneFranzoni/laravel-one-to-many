@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Elenco posts</h1>
        @if (session('deleted'))
          <div class="alert alert-primary ml-4" role="alert">
            {{ session('deleted')}}
          </div>
        @endif  
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col" colspan="3">Azioni</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td><a href="{{ route('admin.posts.show', $post) }}" class="btn btn-info">Show</a></td>
                    <td><a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-success">Edit</a></td>
                    <td>
                      <form onsubmit="return confirm('Confermi Eliminazione Post: {{$post->title}} ')" action="{{ route('admin.posts.destroy', $post)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          {{--crea una nav per scorrere tra i post (deriva dal paginate)--}}
          {{ $posts->links() }}
    </div>
</div>
@endsection

@section('title')
    | Elenco Post
@endsection