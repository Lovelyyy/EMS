@extends('sidebar')

@section('extra-styles')
	<link href="{{url('/')}}/public/css/required-fields.css" rel="stylesheet">
@endsection

@section('main-content')
	<legend>Employee</legend>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-edit fa-fw"></i>Employee: {{ $details->firstname }} {{ $details->lastname }}</h4>
		</div>
		<div class="panel-body">
			<form class="form-horizontal">
				<div class="form-group">
					<label for="department" class="col-md-2 control-label">Department</label>
					<div class="col-md-10">
			    		<input id="department" type="text" class="form-control" name="Department" value="{{ $details->dept_name }}" readonly>
		    		</div>
				</div>
				<div class="form-group">
					<label for="position" class="col-md-2 control-label">Position</label>
					<div class="col-md-10">
			    		<input id="position" type="text" class="form-control" name="Position" value="{{ $details->position_name }}" readonly>
		    		</div>
				</div>
				<div class="form-group">
					<label for="employee_no" class="col-md-2 control-label">Employee Number</label>
					<div class="col-md-10">
			    		<input id="employee_no" type="text" class="form-control" name="Employee_Number" value="{{ $details->employee_no }}"readonly>
		    		</div>
				</div>
				<div class="form-group">
					<label for="firstname" class="col-md-2 control-label">First Name</label>
					<div class="col-md-10">
			    		<input id="firstname" type="text" class="form-control" name="First_Name" value="{{ $details->firstname }}" readonly>
		    		</div>
				</div>
				<div class="form-group">
					<label for="lastname" class="col-md-2 control-label">Last Name</label>
					<div class="col-md-10">
			    		<input id="lastname" type="text" class="form-control" name="Last_Name" value="{{ $details->lastname }}" readonly>
		    		</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-md-2 control-label">Email Address</label>
					<div class="col-md-10">
			    		<input id="email" type="email" class="form-control" name="Email_Address" value="{{ $details->email }}" readonly>
		    		</div>
				</div>
		    	<center>
					<a class="btn btn-primary" href="{{ url('/employee') }}">
						<i class="fa fa-arrow-left fa-btn"></i> Back
					</a>
				</center>    
			</form>
		</div>
	</div>
@endsection