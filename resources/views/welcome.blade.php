@extends('layouts/front')
@section('title', 'Account activation via SMS for any services')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-12 pb-4">
            <h6 class="panel-title">Getting a number</h6>
            <div class="wrapper overflow">
                <div class="container-fluid py-3">
                    <input class="form-control searchBar" id="myInput" placeholder="Search for country" aria-label="Search">         
                    <div class="row py-2" id="myTable">
                      @foreach($countries as $country)
                        <div class="col-6" id="myTR">
                            <div class="country shadow" onclick="myFunction('{{$country->code}}')">
                                <div class="pl-1 pr-md-2 d-flex">
                                    <img src="{{asset('/storage/images/country/'.$country->flag)}}" alt="{{ $country->code }}" style="height: 30px;">
                                </div>
                                <div class="d-flex countryName"><b>{{ $country->country }}</b>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
            </div>
            <h6 class="panel-title pt-4">Select Services: </h6>
            <div class="wrapper overby">
                <div class="container-fluid py-3">
                <input class="form-control searchBar" id="serv" placeholder="Search for service" aria-label="Search">
                </div>
                <div class="container-fluid">
                    <div class="row py-2" id="myService">
                        <div class="col-sm-12">
                            <div class="providerheader"> 
                                <div class="pl-1 pr-md-2 d-flex align-items-center">
                                </div>
                                <div class="d-flex "><b>Service Name</b>
                                </div>
                                <div class="price my-auto" style="font-weight:bold">
                                <span class="my-auto">
                                    <span style="color:#37E85B">online</span>
                                </span>
                                </div>
                            </div>
                        </div>
                      @foreach($services as $service)
                        <div class="col-sm-12 pb-2" id="mySer">
                            <div class="provider border border-primary" onclick="confirmFunction('{{ $service->code }}')">
                                @auth
                                @php
                                $user = Auth::user();
                                $fav = DB::table('favourites')->where('user_id', $user->id)->where('service_name', $service->service)->first();
                                @endphp
                                @if($fav)
                                    <i class="fas fa-star"></i>
                                @else
                                <a href="{{ route('fav', [ 'service' => $service->service ]) }}">
                                    <i class="far fa-star"></i>
                                </a>
                                @endif
                                @endauth
                                <div class="pl-1 pr-md-2 d-flex align-items-center">
                                    <img src="{{asset('/storage/images/services/'.$service->logo)}}" style="height: 30px; width: 30px; border-radius: 50%;" alt="{{ $service->service }}" >
                                </div>
                                <div class="d-flex countryName"><b>{{ $service->service }}</b>
                                </div>
                                <div class="price my-auto" id="{{ $service->code }}">
                                    <span class="my-auto" style="font-size:15px"><span style="color:#37E85B">0</span> Pcs</span>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-8 col-md-12 pb-5">
            @if(Auth::check('email'))
            <h6 class="panel-title">Current activations</h6>
            <div class="wrapper">
                <div class="container-fluid">
                    <p style="font-size:13px">
                        <div class="row py-2">
                            <div class="col-lg-3">
                                <label for="inputPassword2">Order Time :</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="desc" id="ot"></div>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-lg-3">
                                <label for="inputPassword2">Service Name :</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="desc" id="ser"></div>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-lg-3">
                                <label for="inputPassword2">Country Code :</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="desc" id="cc"></div>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-lg-3">
                                <label for="inputPassword2">Phone Number :</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="desc" id="pn"></div>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-lg-3">
                                <label for="inputPassword2">Activation Code :</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="desc" id="ac"></div>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-lg-3">
                                <label for="inputPassword2">SMS :</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="desc" id="na"></div>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-lg-3"><br></div>
                            <div class="col-lg-6">
                                <div id="action"><button type="button" disabled class="btn btn-primary btn-sm btn-block">Cancel</button></div>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </p>
                </div>
            </div><br>
            <p style="font-size:13px">Don't refresh webpage when you are working with numbers! Open website in new tab, if you need it.</p>
            <div class="align-items-center">
                
            </div>
            @else
            <h6 class="panel-title">Welcome!</h6>
            <div class="wrapper">
                <div class="container-fluid"><br>
                    <p style="font-size:13px"><b>What is PvaText.com?</b></p>
                    <p style="font-size:13px">
                      PvaText is a service providing a phone number you can send any SMS on and get a text of it.
                    </p>
                </div>
            </div>
            @endif
            
            <div class="modal" id="getnumberDialog" data-backdrop="static" data-keyboard="false" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @auth @if(Auth::user()->balance > "0.50") onclick="numberFunction()" @else onclick="location.href='{{ route('payment') }}'" @endif @else onclick="location.href='{{ route('login') }}'" @endauth>Confirm</button>
                                <button type="button" class="btn btn-secondary" id="modal-btn-no" onclick="cancel()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert" role="alert" id="result"></div>

            </div>
        </div>
    </div>
</div>
@endsection