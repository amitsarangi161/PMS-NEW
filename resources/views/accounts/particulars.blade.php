@extends('layouts.account')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">PARTICULARS</td>
	 </tr>
</table>


<div class="well" >
<form action="/saveparticulars" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>Select Expense Head Name<span style="color: red"> *</span></strong></td>
	 	 <td>
	 	 	<select name="expenseheadid" class="form-control">
	 	 		<option>Select a Expense head</option>
	 	 		@foreach($expenseheads as $expensehead)
	 	 		<option value="{{$expensehead->id}}">{{$expensehead->expenseheadname}}</option>

	 	 		@endforeach
	 	 	</select>
	 	 </td>
	 
	 	
	 </tr>
	 <tr>
	 	<td><strong>Particular Name<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" class="form-control" placeholder="Enter Particular Name" name="particularname" required>
	 	</td>
	 	
	 </tr>
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">ADD PARTICULAR</button></td>
	 </tr>
</table>
</form>
</div>

<div class="table-responsive">
	<table class="table table-hover table-bordered table-striped datatable">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>ID</th>
       	   	<th>EXPENSE HEAD NAME</th>
       	   	<th>PARTICULAR NAME</th>
       	   	<th>EDIT</th>
       	   <!-- 	<th>DELETE</th> -->
       	   </tr>
       </thead>
       <tbody>
       	@foreach($particulars as $particular)

       	<tr>
       		<td>{{$particular->id}}</td>
       		<td>{{$particular->expenseheadname}}</td>
       		<td>{{$particular->particularname}}</td>
       		<td>
       			<button type="button" class="btn btn-primary" onclick="editparticular('{{$particular->id}}','{{$particular->particularname}}','{{$particular->expenseheadid}}')">EDIT</button>
       		</td>
       		<!-- <td>
       			<form action="/deleteparticulars/{{$particular->id}}" method="post">
       				{{csrf_field()}}
       				{{method_field('DELETE')}}

       				<button type="submit" onclick="return confirm('Do You Want to delete this particular?')" class="btn btn-danger">DELETE</button>
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
        <h4 class="modal-title">EDIT PARTICULARS</h4>
      </div>
      <div class="modal-body">
      	<form action="/updateparticulars" method="post">
      		{{csrf_field()}}
        <table class="table table-responsive table-hover table-bordered table-striped">
        	<input type="hidden" name="pid" id="pid">
	 <tr>
	 	 <td><strong>Select Expense Head Name<span style="color: red"> *</span></strong></td>
	 	 <td>
	 	 	<select name="expenseheadid" class="form-control" id="expenseheadid">
	 	 		<option>Select a Expense head</option>
	 	 		@foreach($expenseheads as $expensehead)
	 	 		<option value="{{$expensehead->id}}">{{$expensehead->expenseheadname}}</option>

	 	 		@endforeach
	 	 	</select>
	 	 </td>
	 
	 	
	 </tr>
	 <tr>
	 	<td><strong>Particular Name<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" class="form-control" id="particularname" placeholder="Enter Particular Name" name="particularname" required>
	 	</td>
	 	
	 </tr>
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">UPDATE PARTICULAR</button></td>
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
		function editparticular(id,particularname,expenseheadid) {

			$("#pid").val(id);
			$("#particularname").val(particularname);
			$("#expenseheadid").val(expenseheadid);
			$("#myModal").modal('show');

			
		}
	</script>
@endsection