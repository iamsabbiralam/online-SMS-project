@extends('layouts/admin')
@section('page_title','Edit Country')

@section('container')

<h1>Edit Country</h1>
    
<a href="{{ route('admin.country-list')}}">
    <button type="button" class="btn btn-primary">
        List Country
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
                        Edit Country Details
                    </div>
                    <div class="card-body">                   
                        <hr>
                        <form action="{{ route('admin.country-up', ['id' => $countries->id ]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            
                            <div class="form-group">
                                <label for="country" class="control-label mb-1">Country</label>
                                <input id="country" name="country" type="text" class="form-control" aria-required="true" value="{{ $countries->country}}" aria-invalid="false" required>
                            </div> 
                            <div class="form-group">
                                <label for="code" class="control-label mb-1">Code</label>
                                <input id="code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $countries->code}}" required>
                            </div> 
                            
                            <div class="form-group">
                                <label for="flag" class="control-label mb-1">Flag</label>
                                <input id="flag" name="flag" type="file" class="form-control"  aria-required="true" aria-invalid="false"  >
                                <input id="flag" name="old_flag" type="hidden" class="form-control"  aria-required="true" aria-invalid="false" value="{{ $countries->flag}}"  required>
                                <img src="{{ asset('/storage/images/country/'.$countries->flag) }}" width="60" />
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
