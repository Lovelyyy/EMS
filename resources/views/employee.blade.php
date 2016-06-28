@extends('sidebar')

@section('extra-styles')
  <link href="{{url('/')}}/public/css/table.css" rel="stylesheet">
@endsection

@section('main-content')
	<legend>Employee</legend>
	<div class="flash-message">
	    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
	    	@if(Session::has('alert-' . $msg))
	    	<p class="alert alert-{{ $msg }}">
	    		{{ Session::get('alert-' . $msg) }}
	    		<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    	</p>
	    	@endif
	    @endforeach
	</div> <!-- end .flash-message -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<form method="GET" action="{{ url('/employee/create') }}">
				<button class="btn btn-primary" type="submit"><i class="fa fa-plus fa-btn"></i>Add Employee</button>
			</form>
		</div>
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-body filter-box">
					<form role="form" method="GET" action="{{ url('/employee') }}">
                    	<div class="col-md-3">
                    		<label for="employee_no" class="control-label">Employee Number</label>
                    		<input id="employee_no" type="text" class="form-control" name="employee_no" placeholder="ex. STORM-12345" value="{{ $data['employee_no'] }}">
                    	</div>
                    	<div class="col-md-3">
                    		<label for="firstname" class="control-label">First Name</label>
                    		<input id="firstname" type="text" class="form-control" name="firstname" placeholder="ex. Juan" value="{{ $data['firstname'] }}">
                    	</div>
                    	<div class="col-md-3">
                    		<label for="lastname" class="control-label">Last Name</label>
                    		<input id="lastname" type="text" class="form-control" name="lastname" placeholder="ex. dela Cruz" value="{{ $data['lastname'] }}">
                    	</div>
                    	<div class="col-md-1 col-md-offset-1">
                    		<button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> Filter
                            </button>
                        </div>           
                	</form>
				</div>
			</div>
			<table>
				<tr>
					<th>Employee Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th class="action">Action</th>
				</tr>
				@foreach($employees as $employee)
					<tr>
						<td>{{$employee->employee_no}}</td>
						<td>{{$employee->firstname}}</td>
						<td>{{$employee->lastname}}</td>
						<td class="action">
							<a href="{{ URL::route('view-employee', ['id' => $employee->id]) }}" class="btn btn-info">
								<i class="fa fa-search"></i></a>
							<a href="{{ URL::route('edit-employee', ['id' => $employee->id]) }}" class="btn btn-primary">
								<i class="fa fa-edit"></i></a>
							<employee id="delete-btn" class="btn btn-danger" data-target='{{ $employee->id }}'><i class="fa fa-times"></i></employee>
						</td>
					</tr>
				@endforeach
			</table>
			{!! $employees->appends($data)->render() !!}
		</div>
	</div>
@endsection