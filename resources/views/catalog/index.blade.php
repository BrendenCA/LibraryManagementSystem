@extends('layout')

@section('content')
  <h1>Catalog</h1>
  <div class="container">
    @if(count($catalogitems)>0)
      <div class="dropdown text-right">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sort by
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="?sort=title&order={{$order}}">Title</a>
          <a class="dropdown-item" href="?sort=created_at&order={{$order}}">Date Added</a>
        </div>
      </div>
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
