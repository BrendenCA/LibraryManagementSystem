@extends('layout')

@section('content')
  <a class="btn btn-light" href="./">Go back</a>
  <h1>{{$author->name}}</h1>
  <div class="container">
    <small>Added on {{$author->created_at}}</small>
    <div class="row">
      <div class="col-md-3 text-center">
        <img class="card-img-top my-2" src="{{Storage::disk('s3')->temporaryUrl( $author->image, now()->addMinutes(5) )}}" alt="Author image">
        @auth
          @if(Auth::User()->hasRole('admin'))
            <a class="btn btn-secondary" href="/author/{{$author->id}}/edit">Edit</a>
            <a href="javascript:{}" class="btn btn-danger m-1" data-toggle="modal" data-target="#confirmDelete">Delete</a>
            <form id="delete_form" method="POST" action="/author/{{$author->id}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
            </form>

            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirm delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Deleting author will delete all associated books also</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('delete_form').submit();" data-dismiss="modal">DELETE</button>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endauth
        @if($author->dob)
          <p>Date of birth: {{$author->dob}}</p>
        @endif
        @if($author->bio)
          <p>{{$author->bio}}</p>
        @endif
      </div>

      <div class="col-md-9">
        @if(count($author->catalog)>0)
          @foreach($author->catalog as $item)
            <div class="card mb-3">
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
                <div class="col-md-2 px-4 my-auto text-center">
                  <a class="btn btn-outline-primary btn-block" href="/catalog/{{$item->id}}">View</a>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <p>No items found</p>
        @endif
      </div>

    </div>
  </div>
@endsection
