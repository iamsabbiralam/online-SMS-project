@extends('layouts/admin')
@section('page_title','Edit Country Service Provider')

@section('container')

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
                        Edit Country Service Provider
                    </div>
                    <div class="card-body">                   
                        <hr>
                        <form action="{{ route('admin.c-s-p-update', [ 'id' => $edit->id ]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="country_id" class="control-label mb-1">Country Name</label>
                                <select class="form-control" name="country_id" >
                                    @php
                                    $country = DB::table('countries')->where('id', $edit->country_id)->first();
                                    @endphp
                                    <option value="{{$country->id}}">{{$country->country}}</option>                                      
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="country_service_provider" class="control-label mb-1">Provider</label>
                                <input name="country_service_provider" type="text" class="form-control" value="{{ $edit->country_service_provider }}">
                            </div> 

                            
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">   
                                    UPDATE
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