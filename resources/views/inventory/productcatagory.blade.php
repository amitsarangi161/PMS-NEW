@extends('layouts.inventory')

@section('content')
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">PRODUCT CATAGORY</td>
	 </tr>
</table>


<div class="well" >
<form action="/savecatagory" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	<td><strong>Catagory Name<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" class="form-control" placeholder="Enter Catagory Name" name="catagoryname" required>
	 	</td>
	 	
	 </tr>
	<!--  <tr>
	 	<td><strong>Catagory Image<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="file" class="form-control" placeholder="catagory image" name="catagoryimage" required onchange="readURL2(this);">

	 	</td>
	 	<td>
	 		<img id="imgshow2" src="#" alt="No Image Selected" style="height: 70px;width: 70px;">
	 	</td>
	 	
	 </tr> -->
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">ADD CATAGORY</button></td>
	 </tr>
</table>
</form>
</div>

<div class="table-responsive">
	<table class="table table-hover table-bordered table-striped datatable">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>ID</th>
       	   	<th>CATAGORY NAME</th>
       	   	<th>EDIT</th>
       	   <!-- 	<th>DELETE</th> -->
       	   </tr>
       </thead>
       <tbody>
       	
       	@foreach($catagories as $catagorie)
       	<tr>
       		<td>{{$catagorie->id}}</td>
       		<td>{{$catagorie->catagoryname}}</td>
       		<td>
       			<button type="button" class="btn btn-primary" onclick="editcatagory('{{$catagorie->id}}','{{$catagorie->catagoryname}}','{{$catagorie->catagoryimage}}')">EDIT</button>
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
        <h4 class="modal-title">EDIT PRODUCT CATAGORIES</h4>
      </div>
      <div class="modal-body">
      	<form action="/updatecatagory" method="post" enctype="multipart/form-data">
      		{{csrf_field()}}
        <table class="table table-responsive table-hover table-bordered table-striped">
        	<input type="hidden" name="pid" id="pid">
	 <tr>
	 	<td><strong>Catagory Name<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" class="form-control" id="catagoryname" placeholder="Enter Particular Name" name="catagoryname" required>
	 	</td>
	 	
	 </tr>
	 <!-- <tr>
			<td><strong>Catagory Image</strong></td>
			<td>
				<input type="file" class="form-control" name="catagoryimage" onchange="readURL1(this)">
                 <img id="imgshow1" src="#" alt="Selected Image" style="height: 100px;width: 100px;">
			</td>

	</tr> -->
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">UPDATE CATAGORY</button></td>
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
		function editcatagory(id,catagoryname,catagoryimage) {

			$("#pid").val(id);
			$("#catagoryname").val(catagoryname);
			var path='/img/catagoryimage/'+catagoryimage;
        	$('#imgshow1').attr('src',path);
			$("#myModal").modal('show');

			
		}
		function readURL1(input) {
    	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function readURL2(input) {
    	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	</script>
    
    
@endsection