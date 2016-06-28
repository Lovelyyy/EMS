@extends('sidebar')

@section('extra-styles')
	<link href="{{ URL('/') }}/public/css/dashboard.css" rel="stylesheet">
@endsection

@section('main-content')
	<legend>Dashboard</legend>
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading"> TOTAL DEPARTMENTS </div>
				<div class="panel-body"> 
					<h2><div class="col-md-6"><i class="fa fa-users fa-lg"></i></div>
					<div class="col-md-6"><div class="pull-right">{{ $dept }}</div></div></h2>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading"> TOTAL POSITIONS </div>
				<div class="panel-body">
					<h2><div class="col-md-6"><i class="fa fa-graduation-cap fa-lg"></i></div>
					<div class="col-md-6"><div class="pull-right">{{ $position }}</div></div></h2>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading"> TOTAL EMPLOYEES </div>
				<div class="panel-body">
					<h2><div class="col-md-6"><i class="fa fa-user fa-lg"></i></div>
					<div class="col-md-6"><div class="pull-right">{{ $user }}</div></div></h2>
				</div>
			</div>
		</div>
	</div>
@endsection