@extends('layouts/admin')
@section('page_title','Admin Operation')

@section('container')

<a href="{{route('admin.operation-add')}}">
    <button type="button" class="btn btn-primary">
        Add Admin Operation
    </button>
</a>
<h1>Operation List</h1>
    
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Operation Name</th>
                <th>Value</th>
                <th>Action</th>                                  
            </tr>
        </thead>
        <tbody>
            @foreach($operations as $operation)
                <tr>  
                    <td>{{$operation['id']}}</td>  
                    <td>{{$operation['operation_name']}}</td>
                  
                    <td>{{$operation['operation_value']}}</td>
                    
          
                    <td>
                        <a href="{{url('admin/operation/operation-del/')}}/{{ $operation->id}}"> 
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </a>      
                    </td>                                
                </tr>
            @endforeach 
        </tbody>
    </table>
</div>

@endsection
