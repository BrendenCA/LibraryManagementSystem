@extends('layout')

@section('content')
  <h1>Edit</h1>
  <form method="POST" action="{{ route('genre.update', ['id' => $genre->id])}}">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="title">Title</label>
      <input class="form-control" id="title" name="title" value="{{$genre->title}}">
    </div>

    {{ method_field('PUT') }}

    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
@endsection
