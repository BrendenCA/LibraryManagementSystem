@extends('layout')

@section('content')
  <h1>Genres</h1>
  <div class="container">
    @if(count($genres)>0)
      <div class="row">
        @foreach($genres as $genre)
          <div class="col-md-2 py-2">
            <div class="card">
              <div class="card-block text-center py-2">
                <p class="card-title font-weight-bold">{{$genre->title}}</p>
                <a href="/genre/{{$genre->id}}" class="btn btn-primary">View</a>
              </div>
            </div>
          </div>
        @endforeach
        {{$genres->links("pagination::bootstrap-4")}}
      </div>
    @else
      <p>No genres found</p>
    @endif
  </div>
@endsection
