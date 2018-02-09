@extends('layout')

@section('content')
  <section class="jumbotron text-center">
      <h1 class="display-4">Library Management System</h1>
      <p class="lead text-muted">A book is a gift you can open again and again.</p>
      <p>
        <a href="/catalog" class="btn btn-primary my-2">Browse our collection!</a>
        @auth
          <a href="/dashboard" class="btn btn-secondary my-2">Dashboard</a>
        @else
          <a href="/register" class="btn btn-secondary my-2">Sign Up</a>
        @endauth
      </p>
  </section>
@endsection
