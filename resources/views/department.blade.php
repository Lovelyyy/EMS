@extends('sidebar')

@section('extra-styles')
  <link href="{{url('/')}}/public/css/table.css" rel="stylesheet">
@endsection

@section('main-content')
	<legend>Department</legend>
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
			<form method="GET" action="{{ url('/department/create') }}">
				<button class="btn btn-primary" type="submit"><i class="fa fa-plus fa-btn"></i>Add Department</button>
			</form>
		</div>
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-body filter-box">
					<form role="form" method="GET" action="{{ url('/department') }}">
                    	<div class="col-md-3">
                    		<label for="department" class="control-label">Department Name</label>
                    		<input id="department" type="text" class="form-control" name="department" placeholder="ex. SysDev" value="{{ $data }}">
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
					<th>Department</th>
					<th>Description</th>
					<th class="action">Action</th>
				</tr>
				@foreach($departments as $dept)
					<tr>
						<td>{{$dept->dept_name}}</td>
						<td>{{$dept->dept_desc}}</td>
						<td class="action">
							<a href="{{ URL::route('view-department', ['id' => $dept->dept_id]) }}" class="btn btn-info">
								<i class="fa fa-search"></i></a>
							<a href="{{ URL::route('edit-department', ['id' => $dept->dept_id]) }}" class="btn btn-primary">
								<i class="fa fa-edit"></i></a>
							<department id="delete-btn" class="btn btn-danger" data-target='{{ $dept->dept_id }}'><i class="fa fa-times"></i></department>
						</td>
					</tr>
				@endforeach
			</table>
			{!! $departments->appends($data)->render() !!}
		</div>
	</div>
@endsection