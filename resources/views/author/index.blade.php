@extends('layout')

@section('content')
  <div class="container">
    <h2>Authors</h2>
    @if(count($authors)>0)
      @foreach($authors as $author)
        <div class="card" style="width: 18rem;">
          <!--TODO: Images-->
          <img class="card-img-top" src="https://syracusepress.files.wordpress.com/2013/02/thomas-holliday-author-photo.jpg" alt="Author image">
          <div class="card-body">
            <h3 class="card-title">{{$author->name}}</h3>
            <a class="btn btn-info" href="/author/{{$author->id}}">View</a>
          </div>
        </div>
      @endforeach
      {{$authors->links("pagination::bootstrap-4")}} <!-- pagination magic currently set to 1/page-->
    @else
      <p>No authors found</p>
    @endif
  </div>
@endsection
