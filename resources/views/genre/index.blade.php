@extends('layout')

@section('content')
  <div class="container">
    <h2>Genres</h2>
    @if(count($genres)>0)
      @foreach($genres as $genre)
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h3 class="card-title">{{$genre->title}}</h3>
            <a class="btn btn-info" href="/genre/{{$genre->id}}">View</a>
          </div>
        </div>
      @endforeach
      {{$genres->links("pagination::bootstrap-4")}}
    @else
      <p>No genres found</p>
    @endif
  </div>
@endsection
