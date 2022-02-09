@extends('layouts/front')
@section('title', 'Support')

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
            <h6 class="panel-title">Send Mail for Support</h6>
            <div class="wrapper">
                <div class="container-fluid">
                    <p><form action="{{ route('support.email') }}" method="POST">
                    @csrf
                      <div class="form-group col-lg-7">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                      </div>
                      <div class="form-group col-lg-7">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Enter Your Subject">
                      </div>
                      <div class="form-group col-lg-7">
                        <label for="body">Body</label>
                        <textarea class="form-control" name="body" style="height:100px"></textarea>
                      </div>
                      <div class="form-group col-lg-7">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection