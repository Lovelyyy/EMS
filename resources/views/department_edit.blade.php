@extends('sidebar')

@section('extra-styles')
	<link href="{{url('/')}}/public/css/required-fields.css" rel="stylesheet">
@endsection

@section('main-content')
	<legend>Department</legend>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-plus fa-fw"></i>Add Department</h4>
			<p>Note: Do not fill-in fields that you do not want to edit.</p>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="POST" action="{{ URL::route('edit-department', ['id' => $details->dept_id]) }}">
				<div class="form-group{{ $errors->has('Department') ? ' has-error' : '' }}">
					<label for="dept_name" class="col-md-2 control-label">Department</label>
					<div class="col-md-10">
			    		<input id="dept_name" type="text" class="form-control" name="Department" value="{{ old('Department') }}" placeholder="{{ $details->dept_name }}">
			    		@if ($errors->has('Department'))
			                <span class="help-block pull-right">
			                    <strong>{{ $errors->first('Department') }}</strong>
			                </span>
			            @endif
		    		</div>
				</div>
				<div class="form-group{{ $errors->has('Description') ? ' has-error' : '' }}">
					<label for="description" class="col-md-2 control-label">Description</label>
					<div class="col-md-10">
			    		<textarea id="description" class="form-control" name="Description" rows="5">{{ $details->dept_desc }}</textarea>
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
					<a class="btn btn-default" href="{{ url('/department') }}">
						<i class="fa fa-times fa-btn"></i> Cancel
					</a>
				</center>    
			</form>
		</div>
	</div>
@endsection