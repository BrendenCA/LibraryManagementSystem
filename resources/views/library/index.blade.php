@extends('layout')

@section('content')
  <h1>Current Borrows</h1>
  <div class="container">
    @if(count($borrow) > 0)
      @foreach($borrow as $item)
        <div class="card my-3">
          <div class="row">
            <div class="col-md-2">
              <img class="card-img-top" src="{{Storage::disk('s3')->temporaryUrl( $item->catalog->image, now()->addMinutes(5) )}}" alt="Book image">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <p class="card-title font-weight-bold">{{$item->catalog->title}}</p>
                <p class="card-text">{{$item->catalog->description}}</p>
                <dl class="row">
                  <dt class="col-sm-3">Borrowed on</dt>
                  <dd class="col-sm-8">{{$item->borrowed_on->toDateString()}}</dd>

                  <dt class="col-sm-3">Due by</dt>
                  <dd class="col-sm-8">{{$item->borrowed_on->addDays(5)->toDateString()}}</dd>

                  <dt class="col-sm-3">Current charges</dt>
                  <dd class="col-sm-8">{{$item->calcCharges(now())}}</dd>

                  @if($item->calcFine()>0)
                    <dt class="col-sm-3">Fine</dt>
                    <dd class="col-sm-8 text-danger">{{$item->calcFine()}}</dd>

                    <dt class="col-sm-3">Total charges</dt>
                    <dd class="col-sm-8">{{$item->calcCharges(now()) + $item->calcFine()}}</dd>
                  @endif
                </dl>

              </div>
            </div>
            <div class="col-md-2 px-5 btn-group btn-group-vertical">
              <a class="btn btn-outline-secondary m-1" href="/catalog/{{$item->catalog->id}}/">View</a>
              <a class="btn btn-outline-success m-1" href="/library/{{$item->id}}/return">Return</a>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <p>No items</p>
    @endif
  </div>
@endsection
