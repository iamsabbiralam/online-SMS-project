@extends('layouts/front')
@section('title', 'Edit Profile')

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
	                		<div class="nametutorial" style="font-size:18px;">Edit Profile</div>
				      	</div>
				      	<hr>
				      	@php
				      	$user = Auth::user();
				      	@endphp
				      	<form action="{{ route('update.profile', [ 'id' => $user->id ]) }}" method="post">
				      		@csrf
					      	<span class="grey">Full name:</span>
					      	<input type="text" class="form-control" name="name" value="{{ $user->name }}">
					      	<br>
					      	<span class="grey">Email:</span>
					      	<input type="email" class="form-control" name="email" value="{{ $user->email }}">
					      	<br>
					      	<span class="grey">Old Password:</span>
					      	<input type="password" class="form-control" name="old_password" placeholder="Enter your Old Password">
					      	<br>
					      	<span class="grey">New Password:</span>
					      	<input type="password" class="form-control" name="password" placeholder="Enter your New Password">
					      	<br>
					      	<span class="grey">Confirm Password:</span>
					      	<input type="password" class="form-control" name="password_confirmation" placeholder="Enter your New Password to Confirm">
					      	<br>
					      	<button class="btn btn-primary">
					      		Update
					      	</button>
				      	</form>
			      	</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection