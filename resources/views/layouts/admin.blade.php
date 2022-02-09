<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset ('2.png')}}" type="image/x-icon">
  <title>@yield('page_title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset ('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset ('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('admin_assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset ('2.png')}}" alt="PavTextlogo" height="80" width="100">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.dashboard')}}" class="nav-link">Home</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="{{ asset ('1.png')}}" alt="PavText Logo" class="brand-image elevation-3" style="opacity: .8">
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      
        <div class="info">
          <a href="{{route('admin.dashboard')}}" class="d-block">PavText ADMIN</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
  <!--     <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
              <a href="{{route('admin.dashboard')}}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : ''}} ">
                <!--  -->
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="{{ route('admin.user-list')}}" class="nav-link {{ request()->is('admin/user-list') ? 'active' : ''}}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  User
                  
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.country-list')}}" class="nav-link {{ request()->is('admin/country-list') ? 'active' : ''}} ">
                <i class="nav-icon fas fa-globe"></i>
                <p>
                  Countries
                  
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.service-list')}}" class="nav-link {{ request()->is('admin/serivce-list') ? 'active' : ''}} ">
                <i class="nav-icon fas fa-concierge-bell"></i>
                <p>
                  Services
                  
                </p>
              </a>
              <li class="nav-item">
                <a href="{{ route('admin.operation-list')}}" class="nav-link {{ request()->is('admin/operation-list') ? 'active' : ''}} ">
                  <i class="nav-icon fas fa-user-cog"></i>                  
                  <p>Admin Operation</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.operationView')}}" class="nav-link {{ request()->is('admin/operation/operationView') ? 'active' : ''}} ">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Operation Settings

                  </p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('admin.c-s-p-list')}}" class="nav-link {{ request()->is('admin/country-service-provider/list') ? 'active' : ''}} ">
                  <i class="nav-icon fas fa-flag"></i>
                  <p>
                    Country Service Provider

                  </p>
                </a>
              </li> 
                        

          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link ">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout

                </p>
              </a>

            </form>

          </li>
          
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">PavText Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">PavText Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
          @section('container')
          @show
        
        </div>
        <!-- /.row -->

       
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://adminlte.io">PavText</a>.</strong>
    All rights reserved By PavText.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 8.56.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset ('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset ('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset ('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('admin_assets/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset ('admin_assets/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ asset ('admin_assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset ('admin_assets/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{ asset ('admin_assets/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset ('admin_assets/plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('admin_assets/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset ('admin_assets/dist/js/pages/dashboard2.js')}}"></script>
</body>
</html>
