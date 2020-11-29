@extends('layouts.app')

@section('content')

@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
 @if(Session::has('err'))
   <p class="alert alert-danger text-center">{{ Session::get('err') }}</p>
 @endif

<div class="row">
	<div class="well col-md-8 col-md-offset-2">
	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center" colspan="3">ADD SCHEME</td>
	 </tr>
</table>
<form action="/savescheme" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>CLIENT NAME<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2">
	 	 	<select name="client" required="" class="form-control select2" style="width:100%;">
	 	 		<option value="">--SELECT A CLIENT--</option>
	 	 		@foreach($clients as $client)
	 	 		<option value="{{$client->id}}">{{$client->clientname}}</option>
	 	 		@endforeach
	 	 	</select>
	 	 </td>	
	 </tr>
	 <tr>
	 	 <td><strong>SCHEME NAME<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" autocomplete="off" name="schemename" placeholder="Enter Scheme Name" class="form-control" required>
	 	 </td>
	 </tr>
	 <tr>
	 	<td colspan="3" style="text-align: right;"><button type="submit" class="btn btn-success btn-flat" onclick="return confirm('Do you want to submit ??')">Save Scheme</button></td>
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
	            <th>SCHEME NAME</th>
	            <th>FOR CLIENT</th>
	            <th>EDIT</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($schemes as $key=>$scheme)
	        <tr>
	        	<td>{{++$key}}</td>
	        	<td>{{$scheme->schemename}}</td>
	        	<td>{{$scheme->clientname}}</td>
	        	<td><button type="button" onclick="editscheme('{{$scheme->id}}','{{$scheme->schemename}}');" class="btn btn-primary">EDIT</button></td>
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
        <h4 class="modal-title">EDIT SCHEME</h4>
      </div>
      <div class="modal-body">
      	<form action="/updatescheme" method="post">
      		{{csrf_field()}}
        <table class="table table-responsive table-hover table-bordered table-striped">
        	<input type="hidden" name="schemeid" id="schemeid">
	 <tr>
	 	 <td><strong>scheme Name<span style="color: red"> *</span></strong></td>
	 	 <td>
	 	 	<input type="text" name="schemename" id="schemename" required="">
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
$(".alert-success").delay(8000).fadeOut(800); 
    $(".alert-danger").delay(8000).fadeOut(800);
function addscheme(){
	
		$("#scheme").append('<input class="form-control input-medium designation" name="schemename[]" style="margin-top:10px;" type="text" value="">');
}
function editscheme(id,schemename){
			$("#schemeid").val(id);
			$("#schemename").val(schemename);
			$("#myModal").modal('show');
}
</script>
@endsection