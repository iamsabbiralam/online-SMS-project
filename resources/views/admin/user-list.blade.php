@extends('layouts/admin')
@section('page_title','All Users')

@section('container')

<h1>ALL Users</h1>
    
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Status</th>
                <th>Action</th>                                  
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>    
                    <td>{{$user['id']}}</td>
                    <td>{{$user['user_name']}}</td>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['email']}}</td>
                    <td>
                        <select name="user_status"
                            onchange="window.location='{{ asset('admin/user-list/status/'.$user->id)}}/'+this.value">
                            <option value="active" @if($user->user_status == "active") selected
                                @endif>Active</option>
                            <option value="pending" @if($user->user_status == "pending")
                                selected @endif>Pending</option>
                        </select>
                    </td>
                    
                    <td>
                        <a href="{{ route('delete.user-list', [ 'id' => $user->id ]) }}"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></a> | <a href="{{ route('admin.user-history', [ 'id' => $user->id ]) }}"><i class="fa fa-history" aria-hidden="true"></i></a>
                    </td>                                
                </tr>
            @endforeach 
        </tbody>
    </table>
</div>

@endsection




