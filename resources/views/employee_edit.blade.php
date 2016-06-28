@extends('sidebar')

@section('extra-styles')
	<link href="{{url('/')}}/public/css/required-fields.css" rel="stylesheet">
@endsection

@section('main-content')
	<legend>Employee</legend>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-edit fa-fw"></i>Edit Employee</h4>
			<p>Note: Do not fill-in fields that you do not want to edit.</p>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="POST" action="{{ URL::route('edit-employee', ['id' => $details->id]) }}">
				<div class="form-group">
					<label for="position" class="col-md-2 control-label">Position</label>
					<div class="col-md-10">
			    		<select id="position" name="position" class="form-control">
			    			@foreach($positions as $position)
			    				<option 
			    					value="{{ $position->position_id }}"
			    					<?php if($position->position_id == $details->position_id) echo "selected"; ?>> 
			    					{{ $position->position_name }}
			    				</option>
			    			@endforeach
			    		</select>	
			    		@if ($errors->has('position'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('position') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>
				<div class="form-group{{ $errors->has('Employee_Number') ? ' has-error' : '' }}">
					<label for="employee_no" class="col-md-2 control-label">Employee Number</label>
					<div class="col-md-10">
			    		<input id="employee_no" type="text" class="form-control" name="Employee_Number" value="{{ old('Employee_Number') }}" placeholder="{{ $details->employee_no }}">
			    		@if ($errors->has('Employee_Number'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('Employee_Number') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>
				<div class="form-group{{ $errors->has('First_Name') ? ' has-error' : '' }}">
					<label for="firstname" class="col-md-2 control-label">First Name</label>
					<div class="col-md-10">
			    		<input id="firstname" type="text" class="form-control" name="First_Name" value="{{ old('First_Name') }}" placeholder="{{ $details->firstname }}">
			    		@if ($errors->has('First_Name'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('First_Name') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>
				<div class="form-group{{ $errors->has('Last_Name') ? ' has-error' : '' }}">
					<label for="lastname" class="col-md-2 control-label">Last Name</label>
					<div class="col-md-10">
			    		<input id="lastname" type="text" class="form-control" name="Last_Name" value="{{ old('Last_Name') }}" placeholder="{{ $details->lastname }}">
			    		@if ($errors->has('Last_Name'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('Last_Name') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>
				<div class="form-group{{ $errors->has('Email_Address') ? ' has-error' : '' }}">
					<label for="email" class="col-md-2 control-label">Email Address</label>
					<div class="col-md-10">
			    		<input id="email" type="email" class="form-control" name="Email_Address" value="{{ old('Email_Address') }}"placeholder="{{ $details->email }}">
			    		@if ($errors->has('Email_Address'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('Email_Address') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>
				<div class="form-group{{ $errors->has('Password') ? ' has-error' : '' }}">
					<label for="password" class="col-md-2 control-label">Password</label>
					<div class="col-md-10">
			    		<input id="password" type="password" class="form-control" name="Password">
			    		@if ($errors->has('Password'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('Password') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>
				<div class="form-group{{ $errors->has('Confirm_Password') ? ' has-error' : '' }}">
					<label for="confirm-password" class="col-md-2 control-label">Confirm Password</label>
					<div class="col-md-10">
			    		<input id="comfirm-password" type="password" class="form-control" name="Confirm_Password">
			    		@if ($errors->has('Confirm_Password'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('Confirm_Password') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>		
		    	<center>
		    		<button type="submit" class="btn btn-primary">
		                <i class="fa fa-btn fa-sign-in"></i> Edit
		            </button>
					<a class="btn btn-default" href="{{ url('/employee') }}">
						<i class="fa fa-times fa-btn"></i> Cancel
					</a>
				</center>    
			</form>
		</div>
	</div>
@endsection