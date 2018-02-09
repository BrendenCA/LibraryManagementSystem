@extends('layout')

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          You are logged in!
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Actions</div>
        <div class="card-body">
          <div class="btn-group-vertical" role="group">
            <a class="btn btn-link text-left" href="/role/edit">Change account type</a>
            <a class="btn btn-link text-left" href="/credits">Manage Credits</a>
            <a class="btn btn-link text-left" href="/library">Current borrows</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
