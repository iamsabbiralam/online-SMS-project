@extends('layouts/front')
@section('title', 'Activation history')

@section('content')

@include('message')

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 pb-4">
            <div class="wrapper">
                <div class="container-fluid">
                    <p>
                    <div class="row">
                    <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <input class="form-control searchBar" id="history" type="search" placeholder="Search" aria-label="Search">
                        </div>
                    </div>
                    </p>
                    <p>
                        <table class="table" id="historyTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="col-2">Server Time</th>
                                    <th class="col-1">Service</th>
                                    <th class="col-2">Phone Number</th>
                                    <th class="col-1">Cost</th>
                                    <th class="col-6">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($his as $hi)
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
                            {!! $his->links() !!}
                        </div>  
			      	</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection