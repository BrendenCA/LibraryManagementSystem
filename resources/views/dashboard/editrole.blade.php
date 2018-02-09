@extends('layout')

@section('content')
<form action="/role/update" method="POST">
  {{ csrf_field() }}
  <fieldset class="form-group">
    <label for="emailInput">Email address</label>
    <input type="email" class="form-control" name="email" id="emailInput" placeholder="Enter email" required>
  </fieldset>
  <div class="radio">
    <label>
      <input type="radio" name="accountType" id="optionsRadios1" value="customer" checked>
      Change to customer account
    </label>
  </div>
  <div class="radio">
    <label>
      <input type="radio" name="accountType" id="optionsRadios2" value="admin">
      Change to admin account
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
