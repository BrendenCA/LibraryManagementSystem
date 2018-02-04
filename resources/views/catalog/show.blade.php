@extends('layout')

@section('content')
  <a class="btn btn-light" href="./">Go back</a>
  <h1>{{$item->title}}</h1>
  <small>Added on {{$item->created_at}}</small>
  <div>
    <img class="card-img-top" src="{{Storage::disk('s3')->temporaryUrl( $item->image, now()->addMinutes(5) )}}" alt="Book image">
    {{$item->description}}
    {{$item->isbn}}
    {{$item->price}}
    {{$item->quantity}}
    {{$author->name}}
    {{$genre->title}}
    <a class="btn btn-light" href="{{ route('catalog.edit', ['id' => $item->id])}}">Edit</a>
    <form method="POST" action="{{ route('catalog.destroy', ['id' => $item->id])}}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button type="submit" class="btn btn-primary">Delete</button>
    </form>
    <a class="btn btn-light" href="#">Borrow</a>
  </div>
@endsection
