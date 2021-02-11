@extends('layouts.hr')

@section('content')
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">ADD SALARY DEDUCTIONS</td>
	 </tr>
</table>


<div class="well" >
<form action="/saveaddsalarydeduction" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>SALARY DEDUCTION<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" autocomplete="off" name="deductionname" placeholder="Enter Salary Deduction Name" class="form-control" required></td>
	 	
	 </tr>
   <tr>
    <td><strong>DEDUCTION PERCENT<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="deductionpercent" placeholder="Enter Salary Deduction Percent" class="form-control" required></td>
   </tr>
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
       	   	<th>Deduction NAME</th>
            <th>Deduction PERCENT</th>
       	   	<th>EDIT</th>
       	   </tr>
       </thead>
       <tbody>
       	@foreach($addsalarydeductions as $addsalarydeduction)

       	<tr>
       		<td>{{$addsalarydeduction->id}}</td>
       		<td>{{$addsalarydeduction->deductionname}}</td>
          <td>{{$addsalarydeduction->deductionpercent}}</td>
       		<!-- <td>{{$addsalarydeduction->deductionpercentage}}</td> -->
       		<td>
       			<button type="button" class="btn btn-primary" onclick="editgroup('{{$addsalarydeduction->id}}','{{$addsalarydeduction->deductionname}}','{{$addsalarydeduction->deductionpercent}}')">EDIT</button>
       		</td>

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
        <h4 class="modal-title">EDIT SALARY DEDUCTION</h4>
      </div>
      <div class="modal-body">
      	<form action="/updatedeductiontype" method="post">
      		{{csrf_field()}}


      			<table class="table table-responsive table-hover table-bordered table-striped">
              <input type="hidden" name="did" id="did">
   <tr>
     <td><strong>DEDUCTION TYPE NAME<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="deductionname" id="deductionname" placeholder="Enter Group Name" class="form-control" required></td>
   
    
   </tr>
   <tr>
     <td><strong>DEDUCTION PERCENT<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="deductionpercent" id="deductionpercent" placeholder="Enter Group Name" class="form-control" required></td>
   
    
   </tr>
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
		 function editgroup(id,deductionname,deductionpercent) {
              $("#did").val(id);
              $("#deductionname").val(deductionname);
              $("#deductionpercent").val(deductionpercent);
		 	  $("#myModal").modal('show');

		 }
	</script>


@endsection