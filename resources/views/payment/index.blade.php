@extends('layouts/front')
@section('title', 'Payment Methods')
@section('content')

<div class="container">
    <div class="row">
        <div class="wrapper">
            <div class="container-fluid">
            	<div class="row py-2">
                    <div class="col-lg-1.5">
                        <img src="{{ asset('img/bitcoin.png') }}" alt="bitcoin" width="100px">
                    </div>
                    <div class="col-lg-10">
                        Bitcoin - THE BEST WAY FOR REFILL BALANCE. COMMISSION - 0%. CREDITING BASED ON THE COURSE OF BINANCE.COM
                    </div>
                    <div style="float:right">
                        <a href="{{ route('add.payment') }}" class="btn btn-primary">Pay</a>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-lg-1.5">
                        <img src="{{ asset('img/coinbase.png') }}" alt="coinbase" width="100px">
                    </div>
                    <div class="col-lg-10">
                        Crypto - THE BEST WAY FOR REFILL BALANCE. COMMISSION - 0%. CREDITING BASED ON THE COURSE OF BINANCE.COM
                    </div>
                    <div style="float:right">
                        <a href="{{ route('add.cryptopayment') }}" class="btn btn-primary">Pay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>
@endsection