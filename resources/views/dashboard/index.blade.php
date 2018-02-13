@extends('layout')

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Actions</div>
        <div class="card-body">
          <div class="btn-group-vertical" role="group">
            <a class="btn btn-link text-left" href="/role/edit">Change account type</a>
            <a class="btn btn-link text-left" href="/credits">Manage Credits</a>
            <a class="btn btn-link text-left" href="/library">Current borrows</a>
            <a class="btn btn-link text-left" href="/catalog/create">Add catalog item</a>
            <a class="btn btn-link text-left" href="/author/create">Add author</a>
            <a class="btn btn-link text-left" href="/genre/create">Add genre</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
