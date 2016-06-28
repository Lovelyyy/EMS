@extends('sidebar')

@section('extra-styles')
	<link href="{{url('/')}}/public/css/required-fields.css" rel="stylesheet">
@endsection

@section('main-content')
	<legend>Position</legend>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-plus fa-fw"></i>Edit Position</h4>
			<p>Note: Do not fill-in fields that you do not want to edit.</p>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="POST" action="{{ URL::route('edit-position', ['id' => $details->position_id]) }}">
				<div class="form-group">
					<label for="department" class="col-md-2 control-label">Department</label>
					<div class="col-md-10">
			    		<select id="department" name="department" class="form-control">
			    			@foreach($departments as $dept)
			    				<option 
			    					value="{{ $dept->dept_id }}"
			    					<?php if($details->dept_id == $dept->dept_id) echo "selected"; ?>> 
			    					{{ $dept->dept_name }}
			    				</option>
			    			@endforeach
			    		</select>	
			    		@if ($errors->has('department'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('department') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>
				<div class="form-group{{ $errors->has('Position') ? ' has-error' : '' }}">
					<label for="position_name" class="col-md-2 control-label">Position</label>
					<div class="col-md-10">
			    		<input id="position_name" type="text" class="form-control" name="Position" value="{{ old('Position') }}" placeholder="{{ $details->position_name }}">
			    		@if ($errors->has('Position'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('Position') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>
				<div class="form-group{{ $errors->has('Description') ? ' has-error' : '' }}">
					<label for="description" class="col-md-2 control-label">Description</label>
					<div class="col-md-10">
			    		<textarea id="description" class="form-control" name="Description" rows="5">{{ $details->position_desc }}</textarea>
			    		@if ($errors->has('Description'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('Description') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>				
		    	<center>
		    		<button type="submit" class="btn btn-primary">
		                <i class="fa fa-btn fa-sign-in"></i> Submit
		            </button>
					<a class="btn btn-default" href="{{ url('/position') }}">
						<i class="fa fa-times fa-btn"></i> Cancel
					</a>
				</center>    
			</form>
		</div>
	</div>
@endsection