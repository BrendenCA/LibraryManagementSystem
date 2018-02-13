@extends('layout')

@section('content')
  <h1>Search</h1>
  <div class="container">
    <form action="/search" method="POST">
      {{ csrf_field() }}
      <div class="row">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="query" placeholder="Enter search query" value="{{ old('query') }}">
          <div class="input-group-append">
            <div class="dropdown text-right">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Search
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button name="type" value="catalog" class="dropdown-item">in catalog</button>
                <button name="type" value="author" class="dropdown-item">in authors</button>
                <button name="type" value="genre" class="dropdown-item">in genre</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    @if($type=='catalog')
      @if(count($result)>0)
        @foreach($result as $item)
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
        {{$result->links("pagination::bootstrap-4")}}
      @else
        <p>No items found</p>
      @endif
    @endif
    @if($type=='author')
      @if(count($result)>0)
        <div class="row">
          @foreach($result as $author)
            <div class="col-md-2 py-2">
              <div class="card">
                <img class="card-img-top" src="{{Storage::disk('s3')->temporaryUrl( $author->image, now()->addMinutes(5) )}}" alt="Author image">
                <div class="card-block text-center py-2">
                  <p class="card-title font-weight-bold">{{$author->name}}</p>
                  <a href="/author/{{$author->id}}" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>
          @endforeach
          {{$result->links("pagination::bootstrap-4")}}
        </div>
      @else
        <p>No authors found</p>
      @endif
    @endif
    @if($type=='genre')
      @if(count($result)>0)
        <div class="row">
          @foreach($result as $genre)
            <div class="col-md-2 py-2">
              <div class="card">
                <div class="card-block text-center py-2">
                  <p class="card-title font-weight-bold">{{$genre->title}}</p>
                  <a href="/genre/{{$genre->id}}" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>
          @endforeach
          {{$result->links("pagination::bootstrap-4")}}
        </div>
      @else
        <p>No genres found</p>
      @endif
    @endif

  </div>
@endsection
