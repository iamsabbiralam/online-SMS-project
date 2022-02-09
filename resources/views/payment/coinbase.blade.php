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
	                		<div class="nametutorial" style="font-size:18px;">Coinbase</div>
				      	</div>
				      	<hr>
	                	 <div>
						  <a class="donate-with-crypto"
						     href="https://commerce.coinbase.com/checkout/806b60fb-26e2-42e1-b979-b2fc747b60c5">
						    Add Fund with Crypto
						  </a>
						  <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
						  </script>
						</div>    
			      	</p>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
@endsection