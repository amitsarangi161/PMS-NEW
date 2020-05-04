@extends('layouts.account')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">DEDUCTION DEFINATION</td>
	 </tr>
</table>


<div class="well" >
<form action="/savediductiondefination" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>DEDUCTION NAME<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" autocomplete="off" name="deductionname" placeholder="Enter Deduction Name" class="form-control" required></td>
	 
	 	
	 </tr>
<!-- 	 <tr>
	 	<td><strong>DEDUCTION PERCENTAGE(%)<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" autocomplete="off" class="form-control" placeholder="Enter Deduction Percentage" name="deductionpercentage" required>
	 	</td>
	 	
	 </tr> -->
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">Save</button></td>
	 </tr>
</table>
</form>
</div>

<div class="table-responsive">
	<table class="table  table-hover table-bordered table-striped datatable">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>ID</th>
       	   	<th>DEDUCTION NAME</th>
       	   <!-- 	<th>DEDUCTION IN PERCENTAGE(%)</th> -->
       	   	<th>EDIT</th>
       	   <!-- 	<th>DELETE</th> -->
       	   </tr>
       </thead>
       <tbody>
       	@foreach($deductiondefinations as $deductiondefination)

       	<tr>
       		<td>{{$deductiondefination->id}}</td>
       		<td>{{$deductiondefination->deductionname}}</td>
       		<!-- <td>{{$deductiondefination->deductionpercentage}}</td> -->
       		<td>
       			<button type="button" class="btn btn-primary" onclick="editdeduction('{{$deductiondefination->id}}','{{$deductiondefination->deductionname}}','{{$deductiondefination->deductionpercentage}}')">EDIT</button>
       		</td>
       		<!-- <td>
       			<form action="/deletedeductiondefination/{{$deductiondefination->id}}" method="post">
       				{{csrf_field()}}
       				{{method_field('DELETE')}}

       				<button type="submit" onclick="return confirm('Do You Want to delete this Deduction Details?')" class="btn btn-danger">DELETE</button>
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
        <h4 class="modal-title">EDIT DEDUCTION DEFINATION</h4>
      </div>
      <div class="modal-body">
      	<form action="/updatedeductiondefination" method="post">
      		{{csrf_field()}}


      			<table class="table table-responsive table-hover table-bordered table-striped">
              <input type="hidden" name="did" id="did">
   <tr>
     <td><strong>DEDUCTION NAME<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="deductionname" id="deductionname" placeholder="Enter Deduction Name" class="form-control" required></td>
   
    
   </tr>
<!--    <tr>
    <td><strong>DEDUCTION PERCENTAGE(%)<span style="color: red"> *</span></strong></td>
    <td>
      <input type="text" autocomplete="off" class="form-control" id="deductionpercentage" placeholder="Enter Deduction Percentage" name="deductionpercentage" required>
    </td>
    
   </tr> -->
   <tr>
    <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">Update</button></td>
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
		 function editdeduction(id,deductionname,deductionpercentage) {
              $("#did").val(id);
              $("#deductionname").val(deductionname);
              $("#deductionpercentage").val(deductionpercentage);
		 	  $("#myModal").modal('show');


		 }
	</script>
@endsection