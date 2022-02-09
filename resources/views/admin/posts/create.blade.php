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
      <form action=" {{ route('admin.posts.store') }} " method="POST">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" value=" {{ old('title') }} "  name="title" id="title">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea type="text" class="form-control @error('content') is-invalid @enderror" value=" {{ old('content') }} " name="content" id="content"> </textarea>
        </div>
        <div>

          <select name="category_id" id="category_id" class="form-control" aria-label="Default select example">
            <option>Scegli una categoria</option>

            @foreach ($categories as $category)      
              <option @if($category->id == old('category_id') ) selected @endif
               value=" {{ $category->id }} "> {{ $category->name }} </option>
            @endforeach
        
          </select>

        </div>

        <button type="submit" class="btn btn-primary m-2">Salva</button>
        <button type="reset" class="btn btn-warning m-2">Reset</button>
      </form>
    </div>
  </div>
   


</div>
@endsection