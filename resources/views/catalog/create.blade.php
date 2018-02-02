@extends('layout')

@section('content')
  <div class="container">
    <h2>Edit</h2>
    <form method="POST" action="{{ route('catalog.store')}}">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" id="title" name="title" placeholder="Enter title">
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows=3 placeholder="Enter description"></textarea>
      </div>

      <div class="form-group">
        <label for="isbn">ISBN</label>
        <input class="form-control" id="isbn" name="isbn"placeholder="Enter ISBN">
      </div>

      <div class="form-group">
        <label for="quantity">Quantity</label>
        <input class="form-control" id="quantity" name="quantity"placeholder="Enter Quantity">
      </div>

      <div class="form-group">
        <label for="price">Price</label>
        <input class="form-control" id="price" name="price"placeholder="Enter Price">
      </div>

      @if(count($allAuthors) > 0)
      <div class="form-group">
      <label for="author">Author</label>
      <select class="form-control" id="author" name="author">
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
        @foreach($allGenres as $g)
          <option value="{{$g->id}}">{{$g->title}}</option>
        @endforeach
        </select>
        </div>
      @endif

      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>
@endsection
