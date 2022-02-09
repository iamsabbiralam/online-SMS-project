@extends('layouts/front')
@section('title', 'Account activation via SMS for any services')

@section('content')
<div class="container">
    <div class="row py-2">
        <div class="col-lg-12 col-md-12 pb-4">
        <div id="messege"></div>
        <h6 class="panel-title">
            <span class="subnav"> Rent a number</span>&nbsp;
            @auth
                <a href="{{ route('my_number') }}"><span class="subnav2">
                    My number
                </span></a>
            @endauth
            
        </h6>
            <div class="wrapper">
                <div class="container-fluid py-3">
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="staticEmail2">Select A Country</label><br>
                            <select name="country" id="country" class="form-control" style="width:100%" required>
                                @for($i = 0; $i < count($countries); $i++)
                                <option value="{{$countries[$i]['code']}}" @if($countries[$i]['code'] == $con) selected @endif>{{$countries[$i]['name']}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="inputPassword2">Select rental period</label>
                            <div class="row">
                                <div class="col-lg-5">
                                <input type="number" value="1" min="1" required class="form-control" style="width:100%" id="dcount" name="dcount">
                                </div>
                                <div class="col-lg-7">
                                <select name="dtype" id="dtype" class="form-control" style="width:100%" required>
                                    <option value="week" selected>Week(s)</option>
                                    <option value="month">Month(s)</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div id="rentcode">
                            
                        </div>
                        <div class="col-lg-5">
                        <label for="inputPassword2">Total</label>
                            <div class="desc desci">
                                First, select country. Then, select service
                            </div>
                        </div>
                        <div class="col-lg-2">
                        <label for="inputPassword2"> . </label>
                            <button class="btn btn-primary" id="btn-confirm" style="width:100%" @auth onclick="rentnumber()" @else onclick="location.href='{{ route('login') }}'" @endauth>Rent Number</button>
                        </div>
                    </div>
                    <br>
                    <h6 class="panel-title">Select a service</h6>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="col-6">Service Name</th>
                                <th class="col-2">Available</th>
                                <th class="col-2">Price per day</th>
                                <th class="col-2">Select</th>
                            </tr>
                        </thead>
                        <tbody id="rentservice">
                        @for($i = 0; $i < count($services); $i++)
                        @php
                        $per = ($addprice/100)*$services[$i]['price_day'];
                        $per = round($per, 2);
                        $price = $services[$i]['price_day'] + $per;
                        @endphp
                            <tr class="service">    
                                <td style="text-align:left">{{$services[$i]['name']}}</td>
                                <td>{{$services[$i]['count']}}</td>
                                <td>{{$price}}</td>
                                <td><input type="radio" name="check" id="myCheck" onclick="serFunction('{{$services[$i]['name']}}' , '{{$services[$i]['service']}}' , '{{$price}}' )"></td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                    <div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Please wait...</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal" id="mi-modal" data-backdrop="static" data-keyboard="false" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Confirmer</h4>
                                    </div>
                                    <div class="modal-body">
                                        <strong>Do you confirm order [<span class="desci"></span>]?</strong><br> You can get sms only for ordered service. No refund available.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="modal-btn-si">Confirm</button>
                                        <button type="button" class="btn btn-secondary" id="modal-btn-no">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="alert" role="alert" id="result"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection