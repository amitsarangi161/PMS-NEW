@extends('layouts.app')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
 	<tr class="bg-navy">
       <td class="text-center">VEHICLE DETAILS</td>		
 	</tr>
</table>

<table class="table">
	<tr>
		    <td><strong>VEHICLE ID</strong></td>
			<td>#{{$vehicle->id}}</td>
			<td><strong>VEHICLE TYPE</strong></td>
			<td>{{$vehicle->vehicletype}}</td>
    </tr>
    <tr>      
    	     <td><strong>VEHICLE NAME</strong></td>
			<td>{{$vehicle->vehiclename}}</td>
			 <td><strong>VEHICLE NO</strong></td>
			<td>{{$vehicle->vehicleno}}</td>

	</tr>
	<tr>	
		    <td><strong>DRIVER NAME</strong></td>
			<td>{{$vehicle->drivername}}</td>
			 <td><strong>DRIVER MOBILE</strong></td>
			<td>{{$vehicle->drivermobile}}</td>
	</tr>
	<tr>
		<td><strong>VEHICLE IMAGE</strong></td>
		 <td><a href="{{ asset('/img/vehicle/'.$vehicle->vehicleimage )}}" target="_blank"><img style="height:70px;width:95px;" alt="no uploadedfile" src="{{ asset('/img/vehicle/'.$vehicle->vehicleimage )}}"></a></td>
		 <td><strong>RC IMAGE</strong></td>
		 <td><a href="{{ asset('/img/vehicle/'.$vehicle->rcimage )}}" target="_blank"><img style="height:70px;width:95px;" alt="no uploadedfile" src="{{ asset('/img/vehicle/'.$vehicle->rcimage )}}"></a></td>
	</tr>	
	
		
	
</table>

@endsection