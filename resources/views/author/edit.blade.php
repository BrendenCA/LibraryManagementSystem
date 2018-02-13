@extends('layout')

@section('content')
  <h1>Edit</h1>
  <form method="POST" action="{{ route('author.update', ['id' => $author->id])}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" id="name" name="name" value="{{$author->name}}">
    </div>
    <div class="form-group">
      <label for="dob">Date of birth</label>
      <input type="date" class="form-control" id="dob" name="dob" value="{{$author->dob}}">
    </div>
    <div class="form-group">
      <label for="bio">Bio</label>
      <input class="form-control" id="bio" name="bio" value="{{$author->bio}}">
    </div>
    <div class="form-group">
      <label for="image" class="btn btn-link">Change Image</label>
      <input id="image" type="file" style="visibility:hidden;" name="image" accept="image/*">
    </div>

    {{ method_field('PUT') }}

    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
@endsection
