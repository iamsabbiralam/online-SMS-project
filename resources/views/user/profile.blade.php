@extends('layouts/front')
@section('title', 'Profile')

@section('content')

@include('message')

@if ($errors->any())
    &nbsp; <br><br>
    <center>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </center>
@endif

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 pb-4">
            <div class="wrapper">
                <div class="container-fluid">
                    <p>
	                	<div class="lcol namettorial">
	                		<div class="nametutorial" style="font-size:18px;">{{ Auth::user()->user_name }}</div>
				      	</div><hr>
				      	@php
				      	$user = Auth::user();
				      	@endphp
			            <span class="grey">Full name:</span> <b>{{ $user->name }}</b><br>
			            <span class="grey">Group:</span> <b>{{ $user->user_type }}</b><br>
                        <span class="grey">Status:</span> <b>{{ $user->user_status }}</b><br>
			            <span class="grey">Registration date:</span> <b>{{ $user->created_at->format('d M Y (h:i A)') }}</b><br>
			            <span class="grey">Last visit:</span> <b>{{ date('d M Y (h:i A)') }}</b><br>
			            <a href="{{ route('edit.profile') }}" type="submit" class="btn btn-primary">Edit Profile</a>
			      	</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection