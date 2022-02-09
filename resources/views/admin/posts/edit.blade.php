@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-10 offset-1">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <p> Compilare i campi obbligatori </p>
        </div>
      @endif
      <form action=" {{ route('admin.posts.update', $post) }} " method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" value=" {{ old('title', $post->title) }} " name="title" id="title">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea type="text" class="form-control @error('content') is-invalid @enderror" name="content" id="content">{{ old('content', $post->content) }}  </textarea>
        </div>
          <a class="p-3" href=" {{ route('admin.posts.index') }} "> torna alla lista </a>
        <button type="submit" class="btn btn-primary m-2">Salva</button>
        <button type="reset" class="btn btn-warning m-2">Reset</button>
      </form>
    </div>
  </div>
   


</div>
@endsection