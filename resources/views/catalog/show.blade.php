@extends('layout')

@section('content')
  <a class="btn btn-light" href="./">Go back</a>
  <h1>{{$item->title}}</h1>
  <small>Added on {{$item->created_at}}</small>
  <div>
    <img class="card-img-top" src="https://images-na.ssl-images-amazon.com/images/I/51BOG9iJ4LL._SX404_BO1,204,203,200_.jpg" alt="temp image">
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
