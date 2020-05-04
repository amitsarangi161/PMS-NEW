@extends('layouts.app')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
 	<tr class="bg-navy">
       <td class="text-center">ENGAGE DAILY VEHICLE</td>		
 	</tr>
</table>
@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
@endif
<form action="/savedailyengagedvehicle" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}
<table class="table">
	<thead>
		<tr>
			<td><strong>SELECT A PROJECT *</strong></td>
			<td>
				<select class="form-control select2" name="projectid" required="">
					<option value="">Select a Project</option>
					@foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->projectname}}</option>
					@endforeach
					
				</select>
			</td>
		</tr>
		<tr>
			<td><strong>SELECT A VEHICLE *</strong></td>
			<td>
				<select class="form-control select2" name="vehicle" required="">
					<option value="">Select a Vehicle</option>
					@foreach($vehicles as $vehicle)
					<option value="{{$vehicle->id}}">{{$vehicle->vehiclename}}({{$vehicle->vehicleno}})</option>
					@endforeach
					
				</select>
			</td>
		</tr>
		<tr>
			<td><strong>DATE *</strong></td>
			<td>
				<input type="text" autocomplete="off" name="date" class="form-control datepicker5 readonly" required="">
			</td>
		</tr>
			<tr>
			<td><strong>DESCRIPTION *</strong></td>
			<td>
				<textarea class="form-control" name="description" placeholder="Enter purpose of Journey" required=""></textarea>
			</td>
		</tr>
		<tr>
			<td><strong>START TIME *</strong></td>
			<td>
				<input type="text" autocomplete="off" placeholder="Start Time of Journey" name="starttime" class="form-control timepicker readonly" required="">
			</td>
		</tr>
		<tr>
			<td><strong>START METER READING</strong></td>
			<td>
				<input type="text" autocomplete="off" placeholder="Start Meter Reading" name="startmeterreading" class="form-control">
				<p style="color: red;">Don't use any Symbol(,) comma</p>
			</td>
		</tr>
	
		<tr>
			<td><strong>END TIME *</strong></td>
			<td>
				<input type="text" name="endtime" autocomplete="off" placeholder="Journey End Time" class="form-control timepicker readonly" required="">

			</td>
		</tr>
		<tr>
			<td><strong>END METER READING</strong></td>
			<td>
				<input type="text" name="endmeterreading" autocomplete="off" placeholder="End Meter Reading" class="form-control">
				<p style="color: red;">Don't use any Symbol(,) comma</p>
			</td>
		</tr>
			<tr>
			<td><strong>ATTACHMENT</strong></td>
			<td>
			 <input type="file" name="image" required="">
			</td>
		</tr>
       <tr>
       	<td><button type="submit" class="btn btn-success">SUBMIT</button></td>
       </tr>
	</thead>
</table>
</form>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script type="text/javascript">
	


$('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 1,
    maxTime: '23:59pm',
    defaultTime: '11',
    startTime: '00:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});


</script>
@endsection