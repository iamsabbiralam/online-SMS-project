@extends('layouts/admin')
@section('page_title','All Country')

@section('container')

<a href="{{ route('admin.country-add') }}">
    <button type="button" class="btn btn-primary">
        Add Country
    </button>
</a>
<h1>ALL Country</h1>
    
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Flug</th>
                <th>Country</th>
                <th>Code</th>
                <th>Status</th>
                <th>Action</th>                                  
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>    
                    <td>{{$country['id']}}</td>
                    <td><img src="{{asset('/storage/images/country/'.$country['flag'])}}" width="60" /></td>
                    <td>{{$country['country']}}</td>
                    <td>{{$country['code']}}</td>
                    <td>
                     @if($country->status=="active")
                     <a href="{{ route('admin.country-status',['status'=>'deactive', 'id' => $country->id ]) }}">
                        <button type="button" class="btn btn-primary">Active</button>
                    </a>

                    @elseif($country->status=="deactive")
                    <a href="{{ route('admin.country-status',['status'=>'active', 'id' => $country->id ]) }}">
                        <button type="button" class="btn btn-warning">Deactive</button>
                    </a>

                    @endif
                    </td>
                    
                     <td>

                         <a href="{{ url('admin/country/edit-country/'.$country->id)}}">
                            <button type="button" class="btn btn-success">Edit</button>
                        </a>

                        <a href="{{url('admin/country/country-del/')}}/{{ $country->id}}"> 
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </a>
                    </td>                               
                </tr>
            @endforeach 
        </tbody>
    </table>
</div>

@endsection




