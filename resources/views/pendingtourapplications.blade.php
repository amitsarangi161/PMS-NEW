@extends('layouts.app')

@section('content')
<table class="table">
    <tr class="bg-blue">
		 <td class="text-center">PEMDINGTOUR APPROVAL</td>
	</tr>
	
</table>
<table class="table table-responsive table-hover table-bordered table-striped datatable" width="100%">
	<thead>
	<tr class="bg-navy">
		<td>ID</td>
		<td>NAME</td>
		<td>FROM PLACE</td>
		<td>TO PLACE</td>
		<td>FROM DATE</td>
		<td>TO DATE</td>
		<td>DESCRIPTION</td>
		<td>STATUS</td>
		<td>REMARKS</td>
		<td>APPROVE</td>	
		<td>CANCEL</td>
	</tr>
	</thead>
	<tbody>
		@foreach($tours as $tour)
		<tr>
			<td>{{$tour->id}}</td>
			<td>{{$tour->name}}</td>
			<td>{{$tour->fromplace}}</td>
			<td>{{$tour->toplace}}</td>
			<td>{{$tour->fromdate}}</td>
			<td>{{$tour->todate}}</td>
			<td>{{$tour->description}}</td>
			<td><span class="label label-primary">{{$tour->status}}</span></td>
			<td>{{$tour->remarks}}</td>

			
			<td>
				   <button type="button" onclick="openapprovemodal('{{$tour->id}}')" class="btn btn-info">APPROVE</button>   
			</td>
			<td>
				<button type="button" class="btn btn-danger" onclick="cancelmodal('{{$tour->id}}')">CANCEL</button>
			</td>

			
			

			
		</tr>
		@endforeach
	</tbody>
	
</table>
<div class="modal fade" id="approvemodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center"><strong>APPROVE TOUR APPLICATION</strong></h4>
        </div>
        <div class="modal-body">
           <table class="table">
 	<form action="/approvetour" method="post">
 	{{csrf_field()}}
 <thead>
 	  <tr>
 	  	<input type="hidden" name="approvetid" id="approvetid">
 	  	<td><strong>REMARKS :</strong></td>
 	  	<td><textarea name="remarks" class="form-control" ></textarea></td>
 	  </tr>
 	  <tr>
 	  	<td colspan="2">
 	  		<button class="btn btn-success pull-right" type="submit">APPROVE</button>
 	  	</td>
 	  	
 	  </tr>

 </thead>
 	</form>
 </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div class="modal fade" id="cancelmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center"><strong>CANCEL TOUR APPLICATION</strong></h4>
        </div>
        <div class="modal-body">
           <table class="table">
 	<form action="/canceltour" method="post">
 	{{csrf_field()}}
 <thead>
 	  <tr>
 	  	<input type="hidden" name="canceltid" id="canceltid">
 	  	<td><strong>REMARKS :</strong></td>
 	  	<td><textarea name="remarks" class="form-control" ></textarea></td>
 	  </tr>
 	  <tr>
 	  	<td colspan="2">
 	  		<button class="btn btn-success pull-right" type="submit">CANCEL</button>
 	  	</td>
 	  	
 	  </tr>

 </thead>
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

	function openapprovemodal(id)
	{
      $("#approvetid").val(id);
      $("#approvemodal").modal('show');
	}

	function cancelmodal(id)
	{
		$("#canceltid").val(id);
		$("#cancelmodal").modal('show');
	}
	function openeditmodal(id,fromplace,toplace,fromdate,todate,description)
	{
		  $("#myModal").modal('show');
		  $("#tid").val(id);
		  $("#fromplace").val(fromplace);
		  $("#toplace").val(toplace);
		  $("#fromdate").val(fromdate);
		  $("#todate").val(todate);
		  $("#description").val(description);

	}
</script>

@endsection