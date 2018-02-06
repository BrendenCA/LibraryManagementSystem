@extends('layout')

@section('content')
  <h1>Current Borrows</h1>
  <div class="container">
    @if(count($borrow) > 0)
      @foreach($borrow as $item)
        <div class="card my-3">
          <div class="row">
            <div class="col-md-2">
              <img class="card-img-top" src="{{Storage::disk('s3')->temporaryUrl( $item->catalog->image, now()->addMinutes(5) )}}" alt="Book image">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <p class="card-title font-weight-bold">{{$item->catalog->title}}</p>
                <p class="card-text">{{$item->catalog->description}}</p>
              </div>
            </div>
            <div class="col-md-2 px-5 btn-group btn-group-vertical">
              <a class="btn btn-outline-success m-1" href="/library/{{$item->id}}/return">Return</a>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <p>No items</p>
    @endif
  </div>
@endsection
