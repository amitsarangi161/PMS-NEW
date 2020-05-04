@extends('layouts.inventory')

@section('content')

@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">PRODUCTS</td>
	 </tr>
</table>

<div class="well" >
<form action="/saveproduct" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	<td><strong>Choose Product Catagory<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<select name="productcatagory_id" class="form-control">
	 	 		<option>Select a catagory</option>
	 	 		@foreach($productcatagories as $productcatagory)
	 	 		<option value="{{$productcatagory->id}}">{{$productcatagory->catagoryname}}</option>
	 	 		@endforeach
	 	 	</select>
	 	</td>
	 </tr>
	 <tr>
	 	<td><strong>Product Name<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" class="form-control" placeholder="Enter Product Name" name="productname">
	 	</td>
	 	
	 </tr>
	 <tr>
            <td> <strong>Product Description</strong> <span style="color: red"> *</span></td>
            <td><textarea name="productdescription" class="form-control" autocomplete="off" placeholder="Enter Product Description"></textarea></td>
            
     </tr>
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">ADD PRODUCTS</button></td>
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
       	   	<th>PRODUCT NAME</th>
       	   	<th>PRODUCT DESCRIPTION</th>
       	   	<th>EDIT</th>
       	   <!-- 	<th>DELETE</th> -->
       	   </tr>
       </thead>
       <tbody>
       	
       @foreach($products as $product)
       	<tr>
       		<td>{{$product->id}}</td>
       		<td>{{$product->catagoryname}}</td>
       		<td>{{$product->productname}}</td>
       		<td>{{$product->productdescription}}</td>
       		<td>
       		<button type="button" class="btn btn-primary" onclick="editcatagory('{{$product->id}}','{{$product->productname}}','{{$product->productdescription}}','{{$product->productcatagory_id}}')">EDIT</button>
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
        <h4 class="modal-title">EDIT PRODUCTS</h4>
      </div>
      <div class="modal-body">
      	<form action="/updateproduct" method="post" enctype="multipart/form-data">
      		{{csrf_field()}}
        <table class="table table-responsive table-hover table-bordered table-striped">
        <input type="hidden" name="pid" id="pid">
      <tr>
	 	 <td><strong>Choose Product Catagory<span style="color: red"> *</span></strong></td>
	 	 <td>
	 	 	<select name="productcatagory_id" class="form-control" id="productcatagory_id">
	 	 		<option>Select a Catagory</option>
	 	 		@foreach($productcatagories as $productcatagory)
	 	 		<option value="{{$productcatagory->id}}">{{$productcatagory->catagoryname}}</option>

	 	 		@endforeach
	 	 	</select>
	 	 </td>
	 
	 	
	 </tr>
	 <tr>
	 	<td><strong>PRODUCT NAME<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" class="form-control" id="productname" placeholder="Enter Product Name" name="productname" required>
	 	</td>
	 	
	 </tr>
	 <tr>
	 	<td><strong>PRODUCT DESCRIPTION<span style="color: red"> *</span></strong></td>
 		<td>
 			<textarea  name="productdescription" id="productdescription" class="form-control" autocomplete="off" placeholder="Enter Product Description"></textarea>
 		</td>
	 	
	 </tr>
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">UPDATE PRODUCTS</button></td>
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
		function editcatagory(id,productname,productdescription,productcatagory_id) {

			$("#pid").val(id);
			$("#productname").val(productname);
			$("#productdescription").val(productdescription);
			$("#productcatagory_id").val(productcatagory_id);
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
	</script>




@endsection