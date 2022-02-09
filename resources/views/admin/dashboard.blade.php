@extends('layouts/admin')

@section('container')

<div class="row">
    <h1>Dashboard</h1>
</div>

  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.user-list')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>User Data</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.country-list')}}" class="nav-link active">
        <i class="far fa-circle nav-icon"></i>
        <p>Country List</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.service-list')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Servivce List</p>
      </a>
    </li>
  </ul>

@endsection
