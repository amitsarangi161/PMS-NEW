@extends('layouts.hr')

@section('content')
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">ADD LEAVE TYPES</td>
	 </tr>
</table>


<div class="well" >
<form action="/saveaddleavetype" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>LEAVE TYPE<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" autocomplete="off" name="leavetypename" placeholder="Enter Leave Name" class="form-control" required></td>
	 
	 	
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
       	   	<th>LEAVE TYPE NAME</th>
       	   	<th>EDIT</th>
       	   </tr>
       </thead>
       <tbody>
       	@foreach($addleavetypes as $addleavetype)

       	<tr>
       		<td>{{$addleavetype->id}}</td>
       		<td>{{$addleavetype->leavetypename}}</td>
       		<!-- <td>{{$addleavetype->deductionpercentage}}</td> -->
       		<td>
       			<button type="button" class="btn btn-primary" onclick="editgroup('{{$addleavetype->id}}','{{$addleavetype->leavetypename}}')">EDIT</button>
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
        <h4 class="modal-title">EDIT LEAVE TYPE NAME</h4>
      </div>
      <div class="modal-body">
      	<form action="/updatleavetype" method="post">
      		{{csrf_field()}}


      			<table class="table table-responsive table-hover table-bordered table-striped">
              <input type="hidden" name="did" id="did">
   <tr>
     <td><strong>LEAVE TYPE NAME<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="leavetypename" id="leavetypename" placeholder="Enter Group Name" class="form-control" required></td>
   
    
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
		 function editgroup(id,leavetypename) {
              $("#did").val(id);
              $("#leavetypename").val(leavetypename);
		 	  $("#myModal").modal('show');


		 }
	</script>


@endsection