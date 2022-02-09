@extends('layouts/admin')
@section('page_title','User History')

@section('container')

<h1>User history</h1>
    
<div class="table-responsive m-b-40">
    <table class="table" id="historyTable">
        <thead class="thead-dark">
            <tr>
                <th class="col-2">Server Time</th>
                <th class="col-1">Service</th>
                <th class="col-2">Phone Number</th>
                <th class="col-1">Cost</th>
                <th class="col-6">Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $hi)
            <tr id="historyTR">    
                <td>{{ $hi->created_at->format('d.m.y H:i:s') }}</td>
                <td>{{ $hi->service }}</td>
                <td>{{ $hi->phone_number }}</td>
                <td style="color:red">{{ $hi->cost }}</td>
                <td>{{ $hi->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $user->links() !!}
    </div>  
</div>

@endsection




