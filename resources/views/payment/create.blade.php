@extends('layouts/front')
@section('title', 'Add Fund')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 pb-4">
            <div class="wrapper">
                <div class="container-fluid">
                    <p>
                    	<div class="lcol namettorial">
	                		<div class="nametutorial" style="font-size:18px;">Add Fund</div>
				      	</div>
				      	<hr>
	                	 <form method="post" action="{{ route('payments.crypto.pay') }}">
						  @csrf

						  <label for="amountUSD">USD($): </label>
						  <input type="number" class="form-control" name="amountUSD" placeholder="Amount" min="2">
						  <input type="hidden" name="userID" value="{{ Auth::user()->id }}">
						  <input type="hidden" name="orderID" value="1">
						  <input type="hidden" name="redirect" value="{{ url()->full() }}">
						  <br>
						  <button type="submit" class="btn btn-primary">
						  	Add
						  </button>
						</form>      
			      	</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection