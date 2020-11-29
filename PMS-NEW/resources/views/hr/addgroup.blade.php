@extends('layouts.hr')

@section('content')
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">ADD GROUPS</td>
	 </tr>
</table>


<div class="well" >
<form action="/saveaddgroup" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>GROUP NAME<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" autocomplete="off" name="groupname" placeholder="Enter Group Name" class="form-control" required></td>
	 
	 	
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
       	   	<th>DEDUCTION NAME</th>
       	   	<th>EDIT</th>
       	   </tr>
       </thead>
       <tbody>
       	@foreach($addgroups as $addgroup)

       	<tr>
       		<td>{{$addgroup->id}}</td>
       		<td>{{$addgroup->groupname}}</td>
       		<!-- <td>{{$addgroup->deductionpercentage}}</td> -->
       		<td>
       			<button type="button" class="btn btn-primary" onclick="editgroup('{{$addgroup->id}}','{{$addgroup->groupname}}')">EDIT</button>
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
        <h4 class="modal-title">EDIT DEDUCTION DEFINATION</h4>
      </div>
      <div class="modal-body">
      	<form action="/updategroup" method="post">
      		{{csrf_field()}}


      			<table class="table table-responsive table-hover table-bordered table-striped">
              <input type="hidden" name="did" id="did">
   <tr>
     <td><strong>GROOUP NAME<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="groupname" id="groupname" placeholder="Enter Group Name" class="form-control" required></td>
   
    
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
		 function editgroup(id,groupname) {
              $("#did").val(id);
              $("#groupname").val(groupname);
		 	  $("#myModal").modal('show');


		 }
	</script>


@endsection