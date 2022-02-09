@extends('layouts/admin')
@section('page_title','Country Service Provider')

@section('container')

<a href="{{route('admin.c-s-p-add')}}">
    <button type="button" class="btn btn-primary">
        Add Country Service Provider
    </button>
</a>
<h1>Provider List</h1>
    
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Country ID</th>
                <th>Provider</th>

                <th>Action</th>                                  
            </tr>
        </thead>
        <tbody>
            @foreach($countryServiceProviders as $countryServiceProvider)
                <tr>  
                    <td>{{$countryServiceProvider['id']}}</td>  
                    <td>{{$countryServiceProvider['country_id']}}</td>
                  
                    <td>{{$countryServiceProvider['country_service_provider']}}</td>
                    
          
                    <td>
                        <a href="{{ route('admin.c-s-p-edit', [ 'id' => $countryServiceProvider->id ]) }}">
                            <button type="button" class="btn btn-success">Edit</button>
                        </a>
                        <a href="{{ route('admin.c-s-p-destroy', [ 'id' => $countryServiceProvider->id ]) }}"> 
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </a>      
                    </td>                                
                </tr>
            @endforeach 
        </tbody>
    </table>
</div>

@endsection
