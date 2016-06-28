@extends('layouts.app')

@section('extra-head')
  <link href="{{url('/')}}/public/css/simple-sidebar.css" rel="stylesheet">
  @yield('extra-styles')
@endsection

@section('content')
  <!--div class="container"-->
    <div class="row col-md-3">
      <div class="nav-side-menu">
        <div class="brand">Brand</div>
        <div class="menu-list">
            <ul id="menu-content" class="menu-content">
              <li><a href="{{ url('/') }}">
                <i class="fa fa-dashboard fa-lg"></i> Dashboard
              </a></li>
              <li><a href="{{ url('/employee') }}">
                <i class="fa fa-user fa-lg"></i> Employee
              </a></li>
              <li><a href="{{ url('/position') }}">
                <i class="fa fa-graduation-cap fa-lg"></i> Position
              </a></li>
              <li><a href="{{ url('/department') }}">
                <i class="fa fa-university fa-lg"></i> Department
              </a></li>
            </ul>
         </div>
      </div>
    </div>
    <div class="col-md-9 row">
      <br><br><br>
      @yield('main-content')
    </div>
  <!--/div-->
@endsection