@extends('layouts.master')

@section('content')
<div class="grids">
	<div class="panel panel-widget forms-panel">
		<div class="forms">
			<div class="form-grids widget-shadow" data-example-id="basic-forms"> 
				<div class="col-md-12">
					<a href="{{route('branches.index')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left green-btn"></i>Back</a>
					@include('common.flash-message')
					<hr>
				</div>
				<div class="form-body">
					<form action="{{route('branches.store')}}" method="post">
					{{ csrf_field() }}

						<div class="form-group"> 
							<label for="">Branch Name</label> 
							<input type="text" name="name" class="form-control" id="" placeholder="Branch Name" required> 
						</div>						

						<div class="form-group">
							<label for="selector1">Area</label>
							<select name="area_id" id="selector1" class="form-control" required>
								<option value="">Select</option>
								@foreach($areas as $area)
								<option value="{{$area->id}}">{{$area->name}}</option>
								@endforeach
							</select>
						</div>	

						<button type="submit" class="btn btn-default">Save</button>
					</form> 
				</div>
			</div>
		</div>
	</div>
</div>
@endsection