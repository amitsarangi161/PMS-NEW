@extends('layouts.inventory')

@section('content')

@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">STOCK ENTRY</td>
	 </tr>
</table>

<div class="well" >
<form action="/savestock" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	<td><strong>Choose a Category<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<select id="category_id" onchange="fetchcategorywiseproducts(this.value)" class="form-control select2">
	 	 		<option>Select a catagory</option>
	 	 		@foreach($catagories as $catagory)
	 	 		<option value="{{$catagory->id}}">{{$catagory->catagoryname}}</option>
	 	 		@endforeach
	 	 	</select>
	 	</td>
	 </tr>
	 <tr>
	 	<td><strong>Choose a Product<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<select name="product_id" id="product_id" class="form-control select2" required="">
	 	 		
	 	 	</select>
	 	</td>
	 </tr>
	 <tr>
	 	<td><strong>Unit of Measurement<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<select class="form-control select2" name="unit">
	 			<option value="">select a unit</option>
	 			@foreach($units as $unit)
                   <option value="{{$unit->id}}">{{$unit->unitname}}</option>
	 			@endforeach
	 			
	 		</select>
	 	</td>
	 	
	 </tr>
	
	 <tr>
	 	<td><strong>Unit Price<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" class="form-control" placeholder="Unit Price" name="unitrate">
	 	</td>
	 	
	 </tr>
	 <tr>
	 	<td><strong>Quantity<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" class="form-control" placeholder="Enter quantity" name="quantity">
	 	</td>
	 	
	 </tr>
	  <tr>
	 	<td><strong>Date<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" name="date" class="form-control datepicker" placeholder="Date">
	 	</td>
	 	
	 </tr>
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">ADD STOCK</button></td>
	 </tr>
</table>
</form>
</div>

<div class="table-responsive">
	<table class="table table-hover table-bordered table-striped datatable">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>ID</th>
       	   	<th>PRODUCT NAME</th>
       	   	<th>Unit of Measure</th>
       	   	
       	   	<th>UNIT RATE</th>
       	   	<th>QUANTITY</th>
       	   	<th>DATE</th>
       	   	<th>EDIT</th>
       	   <!-- 	<th>DELETE</th> -->
       	   </tr>
       </thead>
       <tbody>
       	
     	@foreach($stocks as $stock)
       	<tr>
       		<td>{{$stock->id}}</td>
       		<td>{{$stock->productname}} |||
                 @if($stock->productdescription!='')
       			{{$stock->productdescription}}
       			@else
                 No descriptions
       			@endif

       		</td>
       		<td>{{$stock->unitname}}</td>
       		<td>{{$stock->unitrate}}</td>
       		<td>{{$stock->quantity}}</td>
       		<td>{{$stock->date}}</td>
       		<td>
       		<a href="/editstock/{{$stock->id}}" class="btn btn-primary">EDIT</a>
       		</td>
       		
        	</tr>
       		@endforeach
       
       	
       
       </tbody>
	</table>
</div>

<script type="text/javascript">

		function fetchcategorywiseproducts(cid){
		
           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/fetchcategorywiseproducts")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     cid:cid,
                     },

               success:function(data) { 
               	    $("#product_id").empty();
               	    $("#product_id").append('<option value="">Select a Product</option>');
                   $.each(data,function(key,value){
                   	    $("#product_id").append('<option value=' + value.id + '>' + value.productname+'|||'+value.productdescription+'</option>');
                   })
               }
               
             });
       }

		function editstock(id,date,unitrate,quantity,product_id) {
			$("#pid").val(id);
			$("#date").val(date);
			$("#unitrate").val(unitrate);
			$("#product_id").val(product_id);
			$("#quantity").val(quantity);
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