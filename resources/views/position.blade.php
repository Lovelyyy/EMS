@extends('sidebar')

@section('extra-styles')
  <link href="{{url('/')}}/public/css/table.css" rel="stylesheet">
@endsection

@section('main-content')
	<legend>Position</legend>
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
			<form method="GET" action="{{ url('/position/create') }}">
				<button class="btn btn-primary" type="submit"><i class="fa fa-plus fa-btn"></i>Add Position</button>
			</form>
		</div>
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-body filter-box">
					<form role="form" method="GET" action="{{ url('/position') }}">
                    	<div class="col-md-3">
                    		<label for="position" class="control-label">Position Name</label>
                    		<input id="position" type="text" class="form-control" name="position" placeholder="ex. Project Manager" value="{{ $data['position'] }}">
                    	</div>
                    	<div class="col-md-3">
                    		<label for="department" class="control-label">Department</label>
                    		<input id="department" type="text" class="form-control" name="department" placeholder="ex. SysDev" value="{{ $data['department'] }}">
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
					<th>Position Name</th>
					<th>Department</th>
					<th>Description</th>
					<th class="action">Action</th>
				</tr>
				@foreach($positions as $position)
					<tr>
						<td>{{$position->position_name}}</td>
						<td>{{$position->dept_name}}</td>
						<td>{{$position->position_desc}}</td>
						<td class="action">
							<a href="{{ URL::route('view-position', ['id' => $position->position_id]) }}" class="btn btn-info"><i class="fa fa-search"></i></a>
							<a href="{{ URL::route('edit-position', ['id' => $position->position_id]) }}" class="btn btn-primary">
								<i class="fa fa-edit"></i>
							</a>
							<position id="delete-btn" class="btn btn-danger" data-target='{{ $position->position_id }}'><i class="fa fa-times"></i></position>
						</td>
					</tr>
				@endforeach
			</table>
			{!! $positions->appends($data)->render() !!}
		</div>
	</div>
@endsection