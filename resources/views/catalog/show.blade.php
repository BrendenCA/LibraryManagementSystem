@extends('layout')

@section('content')
  <a class="btn" href="./">Go back</a>
  <h1>{{$item->title}}</h1>
  <div class="container">
    <small>Added on {{$item->created_at}}</small>
    <div class="row">
      <div class="col-md-4">
        <img class="card-img-top" src="{{Storage::disk('s3')->temporaryUrl( $item->image, now()->addMinutes(5) )}}" alt="Book image">
      </div>
      <div class="col-md">
        <dl class="container">
          <dt>Author</dt>
          <dd>{{$item->author->name}}</dd>

          <dt>Genre</dt>
          <dd>{{$item->genre->title}}</dd>

          <dt>ISBN</dt>
          <dd>{{$item->isbn}}</dd>

          <dt>Rent per day</dt>
          <dd>₹ {{$item->price}}</dd>

          <dt>Available Copies</dt>
          <dd>{{$quantity}}</dd>

          <dt>Description</dt>
          <dd>{{$item->description}}</dd>
        </dl>
      </div>
      @auth
        <div class="col-md-2 btn-group-md btn-group-vertical justify-content-start">
          @if(Auth::User()->hasRole('admin'))
            <a class="btn btn-outline-info m-1" href="/catalog/{{$item->id}}/edit">Edit</a>
            <a href="javascript:{}" class="btn btn-outline-danger m-1" onclick="document.getElementById('delete_form').submit();">Delete</a>
            <form id="delete_form" method="POST" action="/catalog/{{$item->id}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
            </form>
          @endif
          @if($quantity>0 && Auth::User()->credit > $item->price)
            <a class="btn btn-outline-success m-1" href="/library/{{$item->id}}/borrow">Borrow</a>
          @else
            <a class="btn btn-outline-success m-1 disabled" href="#">Unavailable</a>
          @endif
        </div>
      @endauth
    </div>
  </div>
@endsection
