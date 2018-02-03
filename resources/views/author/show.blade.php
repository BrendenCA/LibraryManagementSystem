@extends('layout')

@section('content')
  <div class="container">
    <a class="btn btn-light" href="./">Go back</a>
    <h2>{{$author->title}}</h2>
    <small>Added on {{$author->created_at}}</small>
    <div>
      <img class="card-img-top" src="https://syracusepress.files.wordpress.com/2013/02/thomas-holliday-author-photo.jpg" alt="Author image">
      {{$author->name}}
      <a class="btn btn-light" href="{{ route('author.edit', ['id' => $author->id])}}">Edit</a>
      <form method="POST" action="{{ route('author.destroy', ['id' => $author->id])}}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <!--TODO:popup that says deleteing author will delete all related catalog items aswell-->
        <button type="submit" class="btn btn-primary">Delete</button>
      </form>
    </div>
  </div>
@endsection
