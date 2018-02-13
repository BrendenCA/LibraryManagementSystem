@extends('layout')

@section('content')
  <h1>Create</h1>
  <form method="POST" action="{{ route('author.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" id="name" name="name" placeholder="Enter name" required>
    </div>
    <div class="form-group">
      <label for="dob">Date of birth</label>
      <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter dob">
    </div>
    <div class="form-group">
      <label for="bio">Bio</label>
      <input class="form-control" id="bio" name="bio" placeholder="Enter Bio">
    </div>
    <div class="form-group">
      <label for="image">Picture</label>
      <input class="form-control" type="file" id="image" name="image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection
