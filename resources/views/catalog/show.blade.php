@extends('layout')

@section('content')
  <div class="container">
    <a class="btn btn-light" href="../">Go back</a>
    <h2>{{$item->title}}</h2>
    <small>Added on {{$item->created_at}}</small>
    <div>
      <img class="card-img-top" src="https://images-na.ssl-images-amazon.com/images/I/51BOG9iJ4LL._SX404_BO1,204,203,200_.jpg" alt="temp image">
      {{$item->description}}
      {{$item->isbn}}
      {{$item->price}}
      {{$item->quantity}}
      <!--borrow book button-->
    </div>
  </div>
@endsection
