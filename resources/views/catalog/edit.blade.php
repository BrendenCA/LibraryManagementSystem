@extends('layout')

@section('content')
  <h1>Edit</h1>
  <form method="POST" action="{{ route('catalog.update', ['id' => $item->id])}}">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="title">Title</label>
      <input class="form-control" id="title" name="title" value="{{$item->title}}">
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" id="description" name="description" rows=3>{{$item->description}}</textarea>
    </div>
    
    <div class="form-group">
      <label for="isbn">ISBN</label>
      <input class="form-control" id="isbn" name="isbn"value="{{$item->isbn}}">
    </div>

    <div class="form-group">
      <label for="quantity">Quantity</label>
      <input class="form-control" id="quantity" name="quantity"value="{{$item->quantity}}">
    </div>

    <div class="form-group">
      <label for="price">Price</label>
      <input class="form-control" id="price" name="price"value="{{$item->price}}">
    </div>

    @if(count($allAuthors) > 0)
      <div class="form-group">
        <label for="author">Author</label>
        <select class="form-control" id="author" name="author">
          <option selected value="{{$author->id}}">{{$author->name}}</option>
          @foreach($allAuthors as $a)
            <option value="{{$a->id}}">{{$a->name}}</option>
          @endforeach
        </select>
      </div>
    @endif

    @if(count($allGenres) > 0)
      <div class="form-group">
        <label for="genre">Genre</label>
        <select class="form-control" id="genre" name="genre">
          <option selected value="{{$genre->id}}">{{$genre->title}}</option>
          @foreach($allGenres as $g)
            <option value="{{$g->id}}">{{$g->title}}</option>
          @endforeach
        </select>
      </div>
    @endif

    {{ method_field('PUT') }}

    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
@endsection
