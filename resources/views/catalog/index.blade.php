@extends('layout')

@section('content')
  <div class="container">
    <h2>Catalog</h2>
    @if(count($catalogitems)>0)
      @foreach($catalogitems as $item)
        <div class="card" style="width: 18rem;">
          <!--TODO: Images-->
          <img class="card-img-top" src="https://images-na.ssl-images-amazon.com/images/I/51BOG9iJ4LL._SX404_BO1,204,203,200_.jpg" alt="Card image cap">
          <div class="card-body">
            <h3 class="card-title">{{$item->title}}</h3>
            <p class="card-text">{{$item->description}}</p>
            <a class="btn btn-info" href="/catalog/{{$item->id}}">View</a>
          </div>
        </div>
      @endforeach
      {{$catalogitems->links("pagination::bootstrap-4")}}
    @else
      <p>No items found</p>
    @endif
  </div>
@endsection
