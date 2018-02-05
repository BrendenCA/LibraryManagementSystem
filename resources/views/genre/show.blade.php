@extends('layout')

@section('content')
  <a class="btn btn-light" href="./">Go back</a>
  <h1>{{$genre->title}}</h1>
  <div class="container">
    <small>Added on {{$genre->created_at}}</small>
    <div class="row">
      <div class="col-md-3">
        <a class="btn btn-secondary" href="/author/{{$genre->id}}/edit">Edit</a>
        <a href="javascript:{}" class="btn btn-danger m-1" data-toggle="modal" data-target="#confirmDelete">Delete</a>
        <form id="delete_form" method="POST" action="/author/{{$genre->id}}">
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
                <p>Deleting genre will delete all associated books also</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('delete_form').submit();" data-dismiss="modal">DELETE</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-9">
        @if(count($genre->catalog)>0)
          @foreach($genre->catalog as $item)
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
                <div class="col-md-2 px-4 btn-group btn-group-vertical">
                  <a class="btn btn-outline-primary" href="/catalog/{{$item->id}}">View</a>
                  <a class="btn btn-outline-info" href="/catalog/{{$item->id}}/edit">Edit</a>
                  <a href="javascript:{}" class="btn btn-outline-danger" onclick="document.getElementById('delete_form').submit();">Delete</a>
                  <form id="delete_form" method="POST" action="/catalog/{{$item->id}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                  </form>
                  <a class="btn btn-outline-success" href="#">Borrow</a>
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
