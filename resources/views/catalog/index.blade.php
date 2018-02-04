@extends('layout')

@section('content')
  <h1>Catalog</h1>
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
          <div class="col-md-1 m-auto btn-group-sm btn-group-vertical">
            <a class="btn btn-outline-primary " href="/catalog/{{$item->id}}">View</a>
            <a class="btn btn-outline-info" href="{{ route('catalog.edit', ['id' => $item->id])}}">Edit</a>
            <form method="POST" action="{{ route('catalog.destroy', ['id' => $item->id])}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
            <a class="btn btn-outline-success" href="#">Borrow</a>
          </div>
        </div>
      </div>
    </div>
  @endforeach
  {{$catalogitems->links("pagination::bootstrap-4")}}
@else
  <p>No items found</p>
@endif
@endsection
