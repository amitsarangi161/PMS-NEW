@extends('layouts.app')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
 	<tr class="bg-navy">
       <td class="text-center">VIEW ALL ENGAGED VEHICLE</td>		
 	</tr>
</table>

<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
			<td>PROJECT</td>
			<td>DATE</td>
			<td>START TIME</td>
			<td>START METER READING</td>
			<td>END TIME</td>
			<td>END METER READING</td>
			<td>IMAGE</td>
			<td>VEHICLE NAME</td>
			<td>VEHICLE NO</td>
			<td>CREATED_AT</td>
			<td>VIEW</td>

		</tr>
	</thead>
	<tbody>
		@foreach($dailyvehicles as $dailyvehicle)
		  <tr>
		  	<td><a href="/viewdailyvehicledetails/{{$dailyvehicle->id}}" class="btn btn-primary">{{$dailyvehicle->id}}</a></td>
		  	<td>{{$dailyvehicle->projectname}}</td>
		  	<td>{{$dailyvehicle->date}}</td>
		  	<td>{{$dailyvehicle->starttime}}</td>
		  	<td>{{$dailyvehicle->startmeterreading}}</td>
		  	<td>{{$dailyvehicle->endtime}}</td>
		  	<td>{{$dailyvehicle->endmeterreading}}</td>
		  	<td>
		   <a href="{{ asset('/img/dailyvehicle/'. $dailyvehicle->image)}}" target="_blank">
              <img style="height:75px;width:95px;" alt="click to view the file"  src="{{ asset('/img/dailyvehicle/'.$dailyvehicle->image)}}"></td>
              <td>{{$dailyvehicle->vehiclename}}</td>
              <td>{{$dailyvehicle->vehicleno}}</td>
              <td>{{$dailyvehicle->created_at}}</td>
              <td><a href="/viewdailyvehicledetails/{{$dailyvehicle->id}}" class="btn btn-primary">VIEW</a></td>

		  </tr>
		@endforeach
	</tbody>

</table>
</div>
@endsection