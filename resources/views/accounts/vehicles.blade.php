@extends('layouts.account')

@section('content')
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">MANAGE VEHICLES</td>
	</tr>
	
</table>

<table class="table">
	 @if(Session::has('msg'))
   <p class="alert alert-info text-center">{{ Session::get('msg') }}</p>
   @endif
	<form action="/savevehicledetails" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
	<tr>
		<td><strong>VEHICLE TYPE *</strong></td>
		<td>
			<select class="form-control" name="vehicletype">
				<option value="">Select a Type</option>
                <option value="TWO WHEELER">TWO WHEELER</option>				
                <option value="THREE WHEELER">THREE WHEELER</option>
                <option value="FOUR WHEELER">FOUR WHEELER</option>				
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>VEHICLE NAME *</strong></td>
		<td>
			<input type="text" placeholder="Eg: Auto,Bus,Swift etc." class="form-control" name="vehiclename" autocomplete="off" required="">
		</td>

	</tr>

	<tr>
		<td><strong>VEHICLE NO *</strong></td>
		<td>
			<input type="text" autocomplete="off" placeholder="Eg:OR02BR1669" class="form-control" name="vehicleno">
		</td>

	</tr>

	<tr>
		<td><strong>DRIVER NAME</strong></td>
		<td>
			<input type="text" autocomplete="off" placeholder="Enter Driver name" class="form-control" name="drivername">
		</td>

	</tr>
	<tr>
		<td><strong>DRIVER MOBILE NO</strong></td>
		<td>
			<input type="number" autocomplete="off" placeholder="Enter Driver Mobile" class="form-control" name="drivermobile">
		</td>

	</tr>
	<tr>
		<td><strong>VEHICLE IMAGE *</strong></td>
		<td>
			 <input type="file" name="vehicleimage" onchange="readURL(this);" required="">
		</td>

	</tr>
	<tr>
		<td><strong>RCBOOK IMAGE</strong></td>
		<td>
			 <input type="file" name="rcimage" onchange="readURL(this);">
		</td>

	</tr>
	<tr>
		<td colspan="2" style="text-align: right;">
			<button type="submit" class="btn btn-success">SUBMIT</button>
		</td>
	</tr>
</form>
	 
</table>

<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
			<td>VEHICLE TYPE</td>
			<td>VEHICLE NAME</td>
			<td>VEHICLE NO</td>
			<td>DRIVER NAME</td>
			<td>DRIVER MOBILE</td>
			<td>VEHICLE IMAGE</td>
			<td>RCBOOK IMAGE</td>
			<td>ADDED BY</td>
			<td>EDIT</td>
		</tr>
	</thead>
	<tbody>
		@foreach($vehicles as $vehicle)
		<tr>
			<td>{{$vehicle->id}}</td>
			<td>{{$vehicle->vehicletype}}</td>
			<td>{{$vehicle->vehiclename}}</td>
			<td>{{$vehicle->vehicleno}}</td>
			<td>{{$vehicle->drivername}}</td>
			<td>{{$vehicle->drivermobile}}</td>
		 <td>
		 	<a href="{{ asset('/img/vehicle/'.$vehicle->vehicleimage )}}" target="_blank">
		 	<img style="height:70px;width:95px;" alt="click to view" src="{{ asset('/img/vehicle/'.$vehicle->vehicleimage )}}"></a>
		 </td>

		 <td>
            <a href="{{ asset('/img/vehicle/'.$vehicle->rcimage )}}" target="_blank">
		 	<img style="height:70px;width:95px;" alt="click to view" src="{{ asset('/img/vehicle/'.$vehicle->rcimage )}}">
            </a>
		 </td>
		 <td>{{$vehicle->addedby}}</td>
			
			<td><button type="button" class="btn btn-primary" onclick="openedit('{{$vehicle->id}}','{{$vehicle->vehicletype}}','{{$vehicle->vehiclename}}','{{$vehicle->vehicleno}}','{{$vehicle->drivername}}','{{$vehicle->drivermobile}}');">EDIT</button></td>
		</tr>
		@endforeach
	</tbody>
	
</table>

</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><strong>EDIT VEHICLE</strong></h4>
      </div>
      <div class="modal-body">
        <table class="table">
	<form action="/upadtevehicledetails" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
	<tr>
		<input type="hidden" name="vid" id="vid">
		<td><strong>VEHICLE TYPE *</strong></td>
		<td>
			<select class="form-control" name="vehicletype" id="vehicletype">
				<option value="">Select a Type</option>
                <option value="TWO WHEELER">TWO WHEELER</option>				
                <option value="THREE WHEELER">THREE WHEELER</option>
                <option value="FOUR WHEELER">FOUR WHEELER</option>				
			</select>
		</td>
	</tr>
	<tr>
		<td><strong>VEHICLE NAME *</strong></td>
		<td>
			<input type="text" placeholder="Eg: Auto,Bus,Swift etc." class="form-control" name="vehiclename" id="vehiclename" autocomplete="off" required="">
		</td>

	</tr>

	<tr>
		<td><strong>VEHICLE NO *</strong></td>
		<td>
			<input type="text" autocomplete="off" placeholder="Eg:OR02BR1669" class="form-control" name="vehicleno" id="vehicleno" >
		</td>

	</tr>

	<tr>
		<td><strong>DRIVER NAME</strong></td>
		<td>
			<input type="text" autocomplete="off" placeholder="Enter Driver name" class="form-control" name="drivername" id="drivername">
		</td>

	</tr>
	<tr>
		<td><strong>DRIVER MOBILE NO</strong></td>
		<td>
			<input type="number" autocomplete="off" placeholder="Enter Driver Mobile" class="form-control" name="drivermobile" id="drivermobile">
		</td>

	</tr>

	<tr>
		<td><strong>VEHICLE IMAGE</strong></td>
		<td>
			 <input type="file" name="vehicleimage" onchange="readURL(this);">
		</td>

	</tr>
		<tr>
		<td><strong>RCBOOK IMAGE </strong></td>
		<td>
			 <input type="file" name="rcimage" onchange="readURL(this);" >
		</td>

	</tr>
	<tr>
		<td colspan="2" style="text-align: right;">
			<button type="submit" class="btn btn-success">SUBMIT</button>
		</td>
	</tr>
</form>
	 
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	

        function openedit(id,vehicletype,vehiclename,vehicleno,drivername,drivermobile)
        {   
        	 $("#vid").val(id);
        	 $("#vehicletype").val(vehicletype);
        	 $("#vehiclename").val(vehiclename);
        	 $("#vehicleno").val(vehicleno);
        	 $("#drivername").val(drivername);
        	 $("#drivermobile").val(drivermobile);
             

             $("#myModal").modal('show');  
        }
</script>

@endsection