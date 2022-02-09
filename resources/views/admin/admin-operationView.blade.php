@extends('layouts/admin')
@section('page_title','Admin Settings')

@section('container')

<h1>Admin Settings</h1>

<div>
    @if(count($errors) > 0)
        <ul>
            @foreach($errors->all() as $error)
                <li class="alert alert-danger"> {{ $error }} </li>
            @endforeach
        </ul>
    @endif
</div>
<div class="row m-t-30 ">
    <div class="col-md-12">          
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Select API
                    </div>
                    <div class="card-body">
                        @if($selectedApi != null)
                        <div>
                            <label for="status" class="control-label mb-1">Selected API : </label>
                            <span>{{ $selectedApi->api_name}}</span>
                        </div>
                        @endif
                        <hr>
                        <form action="{{ route('admin.operationApiStore') }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="status" class="control-label mb-1">Change API</label>
                                <select class="form-control" name="operation_name" >
                                    @foreach($apiQry as $apivalue)
                                    {
                                        <option value="{{$apivalue->operation_name}}">{{ $apivalue->operation_name }}</option> 
                                    }
                                    @endforeach                                     
                                </select>
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">   
                                    CHANGE!  
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-header">
                        Select Price
                    </div>
                    <div class="card-body">
                    @if($selectedPrice != null)
                        <div>
                            <label for="status" class="control-label mb-1">Selected Price : </label>
                            <span>{{ $selectedPrice->price_name}}</span>
                        </div>
                    @endif
                        <hr>
                        <form action="{{ route('admin.operationPriceStore') }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="status" class="control-label mb-1">Change Price</label>
                                <select class="form-control" name="operation_name" >
                                    @foreach($priceQry as $pricevalue)
                                    {
                                        <option value="{{$pricevalue->operation_name}}">{{ $pricevalue->operation_name }}</option> 
                                    }
                                    @endforeach                                     
                                </select>
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">   
                                CHANGE!    
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>               
        </div>
    </div>
</div>
            
@endsection
