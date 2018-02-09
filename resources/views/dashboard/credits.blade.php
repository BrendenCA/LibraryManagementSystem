@extends('layout')

@section('content')
  <div class="row">
    <div class="col-md-12 col-md-offset-2">
      <div class="card">
        <div class="card-header">Account Details</div>
        <div class="card-body">
          <p>Credit: ₹{{$credit}} <br>
            <small class="text-muted">Use these credits to borrow books</small>
          </p>
          <form method="POST" action="/payment/paypal">
            {{ csrf_field() }}
            <fieldset class="form-group">
              <label for="buyAmount">Add credit</label>
              <input name="amount" class="form-control" id="buyAmount" placeholder="Enter amount in ₹">
            </fieldset>
            <button type="submit" class="btn btn-primary">Pay with PayPal</button>
          </form>
        </div>
      </div>
      @if(count($txns)>0)
      <div class="card mt-2">
        <div class="card-header">Credit history</div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th style="width: 10%">Date</th>
                <th style="width: 50%">Description</th>
                <th style="width: 20%">Period</th>
                <th style="width: 10%">Credits</th>
              </tr>
            </thead>
            <tbody>
          @foreach ($txns as $txn)
            <tr>
              <td>{{$txn->created_at->toDateString()}}</td>
              @if($txn->borrowId != NULL)
                <td>{{$txn->borrow->catalog->title}}</td>
                <td>{{$txn->borrow->borrowed_on->toDateString()}} to {{$txn->borrow->returned_on->toDateString()}}</td>
              @else
                <td>Credit Added</td>
                <td>N/A</td>
              @endif
              <td>₹{{$txn->credit_change}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
        </div>
      </div>
    @endif
    </div>
  </div>
@endsection
