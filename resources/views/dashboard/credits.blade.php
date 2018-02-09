@extends('layout')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="card">
        <div class="card-header">Account Details</div>
        <div class="card-body">
          <p>Credit: {{$credit}} <br>
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
    </div>
  </div>
@endsection
