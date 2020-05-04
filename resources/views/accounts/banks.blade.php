@extends('layouts.account')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">BANKS</td>
	 </tr>
</table>


<div class="well" >
<form action="/savebanks" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>Bank Name<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" name="bankname" placeholder="Enter Your Bankname" class="form-control" required></td>
	 
	 	
	 </tr>

	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">Save</button></td>
	 </tr>
</table>
</form>
</div>

	<table class="table table-responsive table-hover table-bordered table-striped datatable">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>ID</th>
       	   	<th>BANK NAME</th>
       	  
       	   	<th>EDIT</th>
       	   <!-- 	<th>DELETE</th> -->
       	   </tr>
       </thead>
       <tbody>
       	@foreach($banks as $bank)

       	<tr>
       		<td>{{$bank->id}}</td>
       		<td>{{$bank->bankname}}</td>

       		<td>
       			<button type="button" class="btn btn-primary" onclick="editbanks('{{$bank->id}}','{{$bank->bankname}}')">EDIT</button>
       		</td>
    <!--    		<td>
       			<form action="/deletebanks/{{$bank->id}}" method="post">
       				{{csrf_field()}}
       				{{method_field('DELETE')}}

       				<button type="submit" onclick="return confirm('Do You Want to delete this Bank Details?')" class="btn btn-danger">DELETE</button>
       			</form>
       		</td> -->

       	</tr>
       	@endforeach
       </tbody>
	</table>


	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT BANK</h4>
      </div>
      <div class="modal-body">
      	<form action="/updatebanks" method="post">
      		{{csrf_field()}}


      			<table class="table table-responsive table-hover table-bordered table-striped">
       <input type="hidden" name="bid" id="bid">
	 <tr>
	 	 <td><strong>Bank Name<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" name="bankname" id="bankname" placeholder="Enter Your Bankname" class="form-control" required></td>
	 
	 	
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
		 function editbanks(id,bankname) {
              $("#bid").val(id);
              $("#bankname").val(bankname);
         
		 	  $("#myModal").modal('show');


		 }
	</script>
@endsection