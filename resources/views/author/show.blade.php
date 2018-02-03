@extends('layout')

@section('content')
  <a class="btn btn-light" href="./">Go back</a>
  <h1>{{$author->name}}</h1>
  <small>Added on {{$author->created_at}}</small>
  <div>
    <img class="card-img-top" src="https://syracusepress.files.wordpress.com/2013/02/thomas-holliday-author-photo.jpg" alt="Author image">
    <a class="btn btn-light" href="{{ route('author.edit', ['id' => $author->id])}}">Edit</a>
    <form method="POST" action="{{ route('author.destroy', ['id' => $author->id])}}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <!--TODO:popup that says deleteing author will delete all related catalog items aswell-->
      <button type="submit" class="btn btn-primary">Delete</button>
    </form>
    @if(count($author->catalog)>0)
      @foreach($author->catalog as $item)
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
    @else
      <p>No items found</p>
    @endif
  </div>
@endsection
