@extends('layout')

@section('content')
  <h1>Create</h1>
  <form method="POST" action="{{ route('author.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" id="name" name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
      <input type="file" name="image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection
