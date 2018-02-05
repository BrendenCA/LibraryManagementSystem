@extends('layout')

@section('content')
  <h1>Catalog</h1>
  <div class="container">
    @if(count($catalogitems)>0)
      @foreach($catalogitems as $item)
        <div class="card my-3">
          <div class="row">
            <div class="col-md-2">
              <img class="card-img-top" src="{{Storage::disk('s3')->temporaryUrl( $item->image, now()->addMinutes(5) )}}" alt="Book image">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <p class="card-title font-weight-bold">{{$item->title}}</p>
                <p class="card-text">{{$item->description}}</p>
              </div>
            </div>
            <div class="col-md-2 px-5 btn-group btn-group-vertical">
              <a class="btn btn-outline-primary m-1" href="/catalog/{{$item->id}}">View</a>
              <a class="btn btn-outline-info m-1" href="/catalog/{{$item->id}}/edit">Edit</a>
              <a href="javascript:{}" class="btn btn-outline-danger m-1" onclick="document.getElementById('delete_form').submit();">Delete</a>
              <form id="delete_form" method="POST" action="/catalog/{{$item->id}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              </form>
              <a class="btn btn-outline-success m-1" href="#">Borrow</a>
            </div>
          </div>
        </div>
      @endforeach
      {{$catalogitems->links("pagination::bootstrap-4")}}
    @else
      <p>No items found</p>
    @endif
  </div>
@endsection
