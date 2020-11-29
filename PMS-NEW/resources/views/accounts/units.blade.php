@extends('layouts.account')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">ADD UNITS</td>
	</tr>

</table>
<form action="/saveunits" method="post">
	{{csrf_field()}}
<table class="table">
	<tr>
		<td><strong>Unit Name</strong></td>
		<td><input type="text" name="unitname" autocomplete="off" class="form-control" placeholder="Enter Unit Name" required=""></td>
		<td><button type="submit" class="btn btn-success">ADD</button></td>
	</tr>
	
</table>
</form>
<div class="table-responsive">
<table class="table  table-hover table-bordered table-striped">
	<thead class="bg-navy">
		<th>ID</th>
		<th>UNIT NAME</th>
		<th>CREATED_AT</th>
		<th>EDIT</th>
		<!-- <th>DELETE</th> -->
		
	</thead>
	<tbody>
		@foreach($units as $unit)
          <tr>
          	<td>{{$unit->id}}</td>
          	<td>{{$unit->unitname}}</td>
          	<td>{{$provider::changedatetimeformat($unit->created_at)}}</td>
          	<td><button type="button" class="btn btn-primary" onclick="openeditmodal('{{$unit->id}}','{{$unit->unitname}}')">EDIT</button></td>
          	<!-- <td>
          		<form action="/deleteunit/{{$unit->id}}" method="post">
          			{{csrf_field()}}
          			{{method_field('DELETe')}}
          			<button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to Delete This Unit?');">DELETE</button>
          		</form>
          	</td> -->
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
        <h4 class="modal-title">EDIT UNIT</h4>
      </div>
      <div class="modal-body">
        <form action="/updateunits" method="post">
	{{csrf_field()}}
<table class="table">
	<tr>
		<input type="hidden" name="uid" id="uid">
		<td><strong>Unit Name</strong></td>
		<td><input type="text" name="unitname" autocomplete="off" class="form-control" placeholder="Enter Unit Name" id="unitname" required=""></td>
		<td><button type="submit" class="btn btn-success">UPDATE</button></td>
	</tr>
	
</table>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	function  openeditmodal(id,unitname) {
          $("#uid").val(id);
          $("#unitname").val(unitname);
		$("#myModal").modal('show');

	}
</script>
@endsection