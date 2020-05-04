@extends('layouts.account')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">VENDOR</td>
	 </tr>
</table>

<div class="well" >
<form action="/updatevendor/{{$vendor->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
      <tr>
     <td><strong>ENTER PARTY NAME<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" value="{{$vendor->vendorname}}" name="vendorname" placeholder="Enter Vendor Name" class="form-control"  required></td>
     
      </tr>
		<tr>
	 	 <td><strong>ENTER VENDOR MOBILE NO<span style="color: red"> *</span></strong></td>
	 	 <td><input type="number" autocomplete="off" value="{{$vendor->mobile}}" name="mobile" placeholder="Enter Vendor Mobile No" class="form-control"></td>
	 	 
	    </tr><tr>

     <td><strong>ENTER VENDOR EMAIL<span style="color: red"> *</span></strong></td>
     <td><input type="email" autocomplete="off" value="{{$vendor->email}}" name="email" placeholder="Enter Vendor Email" class="form-control"></td>
     
      </tr>
         
    <tr>
	 	 <td><strong>ADDRESS<span style="color: red"> *</span></strong></td>
	 	 <td>
	 	 <textarea name="details" class="form-control" autocomplete="off">{{$vendor->details}}</textarea>
	 	</td>
	    </tr>
      <tr>
        <td><strong>TIN NUMBER</strong></td>
        <td><input type="text" value="{{$vendor->tinno}}" name="tinno" class="form-control"></td>
      </tr>
      <tr>
        <td><strong>TAN NUMBER</strong></td>
        <td><input type="text" value="{{$vendor->tanno}}" name="tanno" class="form-control"></td>
      </tr>
      <tr>
        <td><strong>SERVICE TAX NUMBER</strong></td>
        <td><input type="text" value="{{$vendor->servicetaxno}}" name="servicetaxno" class="form-control"></td>
      </tr>
      <tr>
        <td><strong>GSTN</strong></td>
        <td><input type="text" value="{{$vendor->gstno}}" name="gstno" class="form-control"></td>
      </tr>
      <tr>
        <td><strong>PAN NUMBER</strong></td>
        <td><input type="text" value="{{$vendor->panno}}" name="panno" class="form-control"></td>
      </tr>

	    <tr>
        <td><strong>BANK NAME</strong></td>
        <td><input type="text" value="{{$vendor->bankname}}" name="bankname" class="form-control"></td>
      </tr>
      <tr>
        <td><strong>BANK ACCOUNT NO</strong></td>
        <td><input type="text" value="{{$vendor->acno}}" name="acno" class="form-control"></td>
      </tr>
      <tr>
        <td><strong>BRANCH NAME</strong></td>
        <td><input type="text" value="{{$vendor->branchname}}" name="branchname" class="form-control"></td>
      </tr>
      <tr>
        <td><strong>IFSC CODE</strong></td>
        <td><input type="text" value="{{$vendor->ifsccode}}" name="ifsccode" class="form-control"></td>
      </tr>

    <!--  <tr>
	 	 <td><strong>VENDOR ID PROOF<span style="color: red"> *</span></strong></td>
	 	 <td>
	 	 	<input name="vendoridproof" type="file" onchange="readURL(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" src="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}" style="height:70px;width:95px;" alt="noimage" id="imgshow">
	 	 </td>
	 	 
	    </tr> -->
	 <!--   <tr>
	   	 <td><strong>VENDOR PHOTO<span style="color: red"> *</span></strong></td>
	 	 <td>
	 	 	<input name="photo" type="file" onchange="readURL1(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" src="{{ asset('/img/vendor/'.$vendor->photo )}}" style="height:70px;width:95px;" alt="noimage" id="imgshow1">
	 	 </td>
	   </tr> -->
	   <tr>
	   	<td colspan="2"><button class="btn btn-success" type="submit">Update</button></td>
	   </tr>

	</table>
</form>
</div>

<script type="text/javascript">

	 function readURL(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }

    function readURL1(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow1')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
</script>

@endsection