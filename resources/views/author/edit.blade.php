@extends('layout')

@section('content')
  <h1>Edit</h1>
  <form method="POST" action="{{ route('author.update', ['id' => $author->id])}}">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" id="name" name="name" value="{{$author->name}}">
    </div>

    {{ method_field('PUT') }}

    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
@endsection
