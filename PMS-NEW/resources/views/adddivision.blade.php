@extends('layouts.app')

@section('content')

@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
 @if(Session::has('update'))
   <p class="alert alert-success text-center">{{ Session::get('update') }}</p>
 @endif

<div class="row">
	<div class="well col-md-8 col-md-offset-2">
	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center" colspan="3">ADD DIVISION</td>
	 </tr>
</table>
<form action="/savedivision" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>CLIENT NAME<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2">
	 	 	<select name="client" required="" class="form-control">
	 	 		<option value="">--SELECT A CLIENT--</option>
	 	 		@foreach($clients as $client)
	 	 		<option value="{{$client->id}}">{{$client->clientname}}</option>
	 	 		@endforeach
	 	 	</select>
	 	 </td>	
	 </tr>
	 <tr>
	 	 <td><strong>SELECT A District<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2">
	 	 	<select name="district" required="" class="form-control">
	 	 		<option value="">--SELECT A DISTRICT--</option>
	 	 		@foreach($districts as $district)
	 	 		<option value="{{$district->id}}">{{$district->districtname}}</option>
	 	 		@endforeach
	 	 	</select>
	 	 </td>	
	 </tr>
	 <tr>
	 	 <td><strong>DIVISION NAME<span style="color: red"> *</span></strong></td>
	 	 <td id="division"><input type="text" autocomplete="off" name="divisionname[]" placeholder="Enter Division Name" class="form-control" required>
	 	 </td>
	 	 	<td><button type="button" class="btn btn-info" onclick="adddivision();"><i class="fa fa-pencile"></i> Add</button></td>

	 </tr>
	 <tr>
	 	<td colspan="3" style="text-align: right;"><button type="submit" class="btn btn-success btn-flat" onclick="return confirm('Do you want to submit ??')">Save Division</button></td>
	 </tr>
</table>
</form>
</div>
</div>


<div class="container-fluid">
	<div class="col-md-12">
	<div class="box-body">
	    <div class="table-responsive">
	<table class="table table-hover table-bordered table-striped datatable" width="100%">
	    <thead>
	        <tr class="bg-navy" style="font-size: 10px;">
	            <th>ID</th>
	            <th>CLIENT NAME</th>
	            <th>DISTRICT NAME</th>
	            <th>DIVISION NAME</th>
	            <th>EDIT</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($divisions as $division)
	        <tr style="font-size: 12px;">
	            <td>{{$division->id}}</td>
	            <td>{{$division->clientname}}</td>
	            <td>{{$division->districtname}}</td>
	            <td>{{$division->divisionname}}</td>
	            <td><button type="button" onclick="editdivision('{{$division->id}}','{{$division->divisionname}}');" class="btn btn-primary">EDIT</button></td>
	        </tr>

	        @endforeach
	    </tbody>
	</table>
	</div>
	</div>
	</div>
</div>

	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT DIVISION</h4>
      </div>
      <div class="modal-body">
      	<form action="/updatedivision" method="post">
      		{{csrf_field()}}
        <table class="table table-responsive table-hover table-bordered table-striped">
        	<input type="hidden" name="divid" id="divid">
	 <tr>
	 	 <td><strong>Division Name<span style="color: red"> *</span></strong></td>
	 	 <td>
	 	 	<input type="text" name="divisionname" id="divisionname" required="">
	 	 </td>
	 
	 	
	 </tr>
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">UPDATE</button></td>
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
function adddivision(){
	
		$("#division").append('<input class="form-control input-medium designation" name="divisionname[]" style="margin-top:10px;" type="text" value="">');
}
function editdivision(id,divisionname){
			$("#divid").val(id);
			$("#divisionname").val(divisionname);
			$("#myModal").modal('show');
}
</script>
@endsection