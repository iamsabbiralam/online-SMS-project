@extends('layouts/admin')
@section('page_title','All Service')

@section('container')

<a href="{{route('admin.service-add')}}">
    <button type="button" class="btn btn-primary">
        Add Service
    </button>
</a>
<h1>ALL Service</h1>
    
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Service</th>
                <th>Code</th>
                <th>Status</th>
                <th>Action</th>                                  
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>    
                    <td>{{$service['id']}}</td>
                    <td><img src="{{asset('/storage/images/services/'.$service['logo'])}}" width="60" /></td>
                    <td>{{$service['service']}}</td>
                    <td>{{$service['code']}}</td>
                    <td>
                        @if($service->status == "active")
                            <a href="{{ route('admin.service-status',['status'=>'deactive', 'id' => $service->id ]) }}">
                                <button type="button" class="btn btn-primary">Active</button>
                            </a>
                        @elseif($service->status == "deactive")
                            <a href="{{ route('admin.service-status',['status'=>'active', 'id' => $service->id ]) }}">
                                <button type="button" class="btn btn-warning">Deactive</button>
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('admin/service/edit-service/'.$service->id)}}">
                            <button type="button" class="btn btn-success">Edit</button>
                        </a>
                        <a href="{{url('admin/service/service-del/')}}/{{ $service->id}}"> 
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </a>      
                    </td>                                
                </tr>
            @endforeach 
        </tbody>
    </table>
</div>

@endsection




