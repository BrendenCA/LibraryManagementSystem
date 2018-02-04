@extends('layout')

@section('content')
  <a class="btn btn-light" href="./">Go back</a>
  <h1>{{$genre->title}}</h1>
  <small>Added on {{$genre->created_at}}</small>
  <div>
    <a class="btn btn-light" href="{{ route('genre.edit', ['id' => $genre->id])}}">Edit</a>
    <form method="POST" action="{{ route('genre.destroy', ['id' => $genre->id])}}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <!--TODO:popup that says deleteing genre will delete all related catalog items aswell-->
      <button type="submit" class="btn btn-primary">Delete</button>
    </form>
    @if(count($genre->catalog)>0)
      @foreach($genre->catalog as $item)
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="{{Storage::disk('s3')->temporaryUrl( $item->image, now()->addMinutes(5) )}}" alt="Book image">
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
