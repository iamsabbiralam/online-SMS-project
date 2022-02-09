@extends('layouts/admin')
@section('page_title','Edit Service')

@section('container')

<h1>Edit Service</h1>
    
<a href="{{ route('admin.service-list')}}">
    <button type="button" class="btn btn-primary">
        List Service
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
                        Edit Service Details
                    </div>
                    <div class="card-body">                   
                        <hr>
                        <form action="{{ route('admin.service-up', ['id' => $services->id ]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            
                            <div class="form-group">
                                <label for="service" class="control-label mb-1">Service</label>
                                <input id="service" name="service" type="text" class="form-control" aria-required="true" value="{{ $services->service}}" aria-invalid="false" required>
                            </div> 
                            <div class="form-group">
                                <label for="code" class="control-label mb-1">Code</label>
                                <input id="code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $services->code}}" required>
                            </div> 
                            
                            <div class="form-group">
                                <label for="logo" class="control-label mb-1">Logo</label>
                                <input id="logo" name="logo" type="file" class="form-control"  aria-required="true" aria-invalid="false"  >
                                <input id="logo" name="old_logo" type="hidden" class="form-control"  aria-required="true" aria-invalid="false" value="{{ $services->logo}}"  required>
                                <img src="{{ asset('/storage/images/services/'.$services->logo) }}" width="60" />
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
