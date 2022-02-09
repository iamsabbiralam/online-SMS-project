@extends('layouts/admin')
@section('page_title','Add Country')

@section('container')

<h1>Add Country</h1>
    
<a href="{{ route('admin.c-s-p-list')}}">
    <button type="button" class="btn btn-primary">
        List Country Service Provider
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
                        Input Country Service Provider
                    </div>
                    <div class="card-body">                   
                        <hr>
                        <form action="{{ route('admin.c-s-p-store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="country_id" class="control-label mb-1">Country Name</label>
                                <select class="form-control" name="country_id" >
                                    <option>Select A Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country}}</option>
                                    @endforeach                                        
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="country_service_provider" class="control-label mb-1">Provider</label>
                                <input id="country_service_provider" name="country_service_provider" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            </div> 

                            
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">   
                                    SUBMIT
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
