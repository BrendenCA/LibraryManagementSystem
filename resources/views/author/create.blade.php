@extends('layout')

@section('content')
  <div class="container">
    <h2>Create</h2>
    <form method="POST" action="{{ route('author.store')}}">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" id="name" name="name" placeholder="Enter name">
      </div>

      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>
@endsection
