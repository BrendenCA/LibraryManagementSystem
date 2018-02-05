@extends('layout')

@section('content')
  <h1>Authors</h1>
  <div class="container">
    @if(count($authors)>0)
      <div class="row">
        @foreach($authors as $author)
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
        {{$authors->links("pagination::bootstrap-4")}}
      </div>
    @else
      <p>No authors found</p>
    @endif
  </div>
@endsection
