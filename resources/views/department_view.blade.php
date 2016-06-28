@extends('sidebar')

@section('extra-styles')
	<link href="{{url('/')}}/public/css/required-fields.css" rel="stylesheet">
@endsection

@section('main-content')
	<legend>Department</legend>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-plus fa-fw"></i>Department: {{ $details->dept_name }}</h4>
		</div>
		<div class="panel-body">
			<form class="form-horizontal">
				<div class="form-group">
					<label for="dept_name" class="col-md-2 control-label">Department</label>
					<div class="col-md-10">
			    		<input id="dept_name" type="text" class="form-control" name="Department" value="{{ $details->dept_name }}"  readonly>
		    		</div>
				</div>
				<div class="form-group">
					<label for="description" class="col-md-2 control-label">Description</label>
					<div class="col-md-10">
			    		<textarea id="description" class="form-control" name="Description" rows="5" readonly>{{ $details->dept_desc }}</textarea>
		    		</div>
				</div>				
		    	<center>
					<a class="btn btn-primary" href="{{ url('/department') }}">
						<i class="fa fa-arrow-left fa-btn"></i> Back
					</a>
				</center>    
			</form>
		</div>
	</div>
@endsection