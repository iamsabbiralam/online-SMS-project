@extends('layouts/front')
@section('title', 'Account activation via SMS for any services')

@section('content')
<div class="container">
    <div class="row py-2">
        <div class="col-lg-12 col-md-12 pb-4">
        <div id="messege"></div>
        <h6 class="panel-title">
            <a href="{{ route('rent_number') }}"><span class="subnav2">
                Rent a number
            </span></a>
            <span class="subnav"> My number</span>&nbsp;
        </h6>
            <div class="wrapper">
                <div class="container-fluid py-3">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th class="col-2">Status</th>
                            <th class="col-3">Phone Number</th>
                            <th class="col-2">Service</th>
                            <th class="col-3">Expiry Date</th>
                            <th class="col-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($numbers as $number)
                        <tr id="{{ $number->number_id }}">    
                            <td id="{{ $number->id }}">
                                <b style="color:red">Inactive</b>
                            </td>
                            <td>{{ $number->phone_number }}</td>
                            <td>{{ $number->service }}</td>
                            <td id="{{ $number->expire_at }}">{{ date('d M Y H:i A', $number->expire_at) }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" id="{{ $number->phone_number }}" onclick="activebtn({{ $number->number_id }})">Active</button>
                                <button type="button" class="btn btn-primary btn-sm" onclick="getsmsbtn({{ $number->number_id }})">SMS</button>
                                @if($number->is_active == 1)
                                <button type="button" class="btn btn-primary btn-sm" disabled>Prolong</button>
                                @else
                                <button type="button" class="btn btn-primary btn-sm" onclick="prolongbtn({{ $number->number_id }})">Prolong</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="myDIV"></div>
                <div id="table"></div>
                    <div class="modal" id="prolong" data-backdrop="static" data-keyboard="false" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Select rental period (Prolong)</h4>
                                </div>
                                <div class="modal-body">
                                <div class="col-lg-12">
                                Prolong number <span id="pronum"></span> (<span id="proser"></span>). Max until <span id="prodate"></span>
                                    <br><span id="proerr" style="color:red"></span>
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
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="pro">Prolong</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection