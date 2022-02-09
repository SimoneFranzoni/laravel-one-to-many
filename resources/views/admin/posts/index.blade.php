@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Lista Posts</h1>

   @if (session('deleted'))
      <div class="alert alert-danger" role="alert">
          {{ session('deleted') }}
      </div>
  @endif
     
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Titolo</th>
        <th scope="col">Contenuto</th>
        <th scope="col">Categoria</th>
        <th colspan="3" scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
          
      <tr>
        <th scope="row"> {{ $post->id }} </th>
        <td>{{ $post->title }}</td>
        <td>{{ $post->content }}</td>
        @if ($post->category)   
         <td>{{ $post->category->name }}</td>
         @else
         <td> - </td>
        @endif
        <td> <a href=" {{ route('admin.posts.show', $post) }} "> <button class="btn btn-info"> SHOW</button> </a> </td>
        <td> <a href=" {{ route('admin.posts.edit', $post) }} "> <button class="btn btn-secondary">EDIT</button> </a> </td>
        <td>
            <form onsubmit="return confirm('Confermi eliminazione del post {{ $post->title }} ? ')" 
              action= "{{ route('admin.posts.destroy', $post) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger"> DELETE</button> 
          </form>
        </td>
      
      </tr>
      
      @endforeach
    </tbody>
  </table>

    </div>
</div>

<div class="container">
  <p> {{ $posts->links() }} </p>
</div>


@endsection

