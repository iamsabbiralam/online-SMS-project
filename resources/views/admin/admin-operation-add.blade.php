@extends('layouts/admin')
@section('page_title','Admin Operation')

@section('container')

<h1>Add Admin Operation</h1>
    
<a href="{{ route('admin.operation-list')}}">
    <button type="button" class="btn btn-primary">
        List Admin Operation
    </button>
</a>
<div>
    @if(count($errors) > 0)
        <ul>
            @foreach($errors->all() as $error)
                <li class="alert alert-danger"> {{ $error }} </li>
            @endforeach
        </ul>
    @endif
</div>
<div class="row m-t-30">
    <div class="col-md-12">          
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Input Admin Operation
                    </div>
                    <div class="card-body">  
                        <p style="color:red">***N:B: Please add keyword api_ for adding api operation</p>
                        <p style="color:red">***N:B: Please add keyword price_ for adding price operation</p>                 
                        <hr>
                        <form action="{{ route('admin.operation-store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="operation_name" class="control-label mb-1">Operation Name</label>
                                <input id="operation_name" name="operation_name" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="for Api api_user-name  / for Price price_price-title" required>
                            </div> 

                            <div class="form-group">
                                <label for="operation_value" class="control-label mb-1">Value</label>
                                <input id="operation_value" name="operation_value" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Api key/For price only add number" required>
                            </div> 

                            
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">   
                                    SUBMIT!    
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
