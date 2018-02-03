@extends('layout')

@section('content')
  <h1>Create</h1>
  <form method="POST" action="{{ route('genre.store')}}">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="title">Title</label>
      <input class="form-control" id="title" name="title" placeholder="Enter title">
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection
