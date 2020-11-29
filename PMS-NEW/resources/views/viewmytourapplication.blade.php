@extends('layouts.app')

@section('content')
<table class="table">
    <tr class="bg-blue">
		 <td class="text-center">MY TOUR APPROVAL</td>
	</tr>
	
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable" width="100%">
	<thead>
	<tr class="bg-navy">
		<td>ID</td>
		<td>FROM PLACE</td>
		<td>TO PLACE</td>
		<td>FROM DATE</td>
		<td>TO DATE</td>
		<td>DESCRIPTION</td>
		<td>STATUS</td>
		<td>REMARKS</td>
		<td>EDIT</td>	
		<td>CANCEL</td>
	</tr>
	</thead>
	<tbody>
		@foreach($tours as $tour)
		<tr>
			<td>{{$tour->id}}</td>
			<td>{{$tour->fromplace}}</td>
			<td>{{$tour->toplace}}</td>
			<td>{{$tour->fromdate}}</td>
			<td>{{$tour->todate}}</td>
			<td>{{$tour->description}}</td>
			<td><span class="label label-primary">{{$tour->status}}</span></td>
			<td>{{$tour->remarks}}</td>

			@if($tour->status=='PENDING')
			<td><button type="button" class="btn btn-info" onclick="openeditmodal('{{$tour->id}}','{{$tour->fromplace}}','{{$tour->toplace}}','{{$tour->fromdate}}','{{$tour->todate}}','{{$tour->description}}');">EDIT</button></td>
			<td>
				<button type="button" class="btn btn-danger" onclick="cancelmodal('{{$tour->id}}')">CANCEL</button>
			</td>

			@else

             <td><button type="button" class="btn btn-info" disabled="">EDIT</button></td>
             <td><button type="button" class="btn btn-danger" disabled="">CANCEL</button></td>
			@endif
			

			
		</tr>
		@endforeach
	</tbody>
	
</table>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">EDIT TOUR APPLICATION</h4>
        </div>
        <div class="modal-body">
           <table class="table">
 	<form action="/updatetourapplication" method="post">
 	{{csrf_field()}}
 <thead>
 	  <tr>
 	  	<input type="hidden" name="tid" id="tid">
 	  	<td><strong>FROM PLACE :</strong></td>
 	  	<td><input type="text" name="fromplace" id="fromplace" placeholder="From place" class="form-control" required=""></td>
 	  </tr>
 	  <tr>
 	  	<td><strong>TO PLACE :</strong></td>
 	  	<td><input type="text" name="toplace" id="toplace" placeholder="To place" class="form-control" required=""></td>
 	  </tr>
 	  <tr>
 	  	<td><strong>FROM DATE</strong></td>
 	  	<td><input type="text" name="fromdate" id="fromdate" placeholder="From Date" class="form-control datepicker readonly" required="" autocomplete="off"></td>
 	  </tr>
 	  <tr>
 	  	<td><strong>TO DATE</strong></td>
 	  	<td><input type="text" name="todate" id="todate" placeholder="To Date" class="form-control datepicker readonly" required="" autocomplete="off"></td>
 	  </tr>
 	  <tr>
 	  	<td><strong>DESCRIPTION</strong></td>
 	  	<td><textarea class="form-control" name="description" id="description" placeholder="Enter Your Description" required=""></textarea></td>
 	  </tr>
 	  <tr>
 	  	<td colspan="2" style="text-align: right;">
 	  		<button class="btn btn-primary btn-lg" onclick="return confirm('Do You want to submit this form ?')" type="submit">SAVE</button>
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