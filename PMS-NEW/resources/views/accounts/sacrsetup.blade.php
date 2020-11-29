@extends('layouts.account')
@section('content')
<table class="table">
	<tr class="bg-blue">
		<td class="text-center"><strong>SUBUDHI ASSOCIATE CR VOUCHER SETUP</strong></td>	
	</tr>
	
</table>
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif
<div class="well">
<form action="/savesacrsetup" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
<table class="table table-responsive table-bordered">
	<tr>
		<td><strong>COMPANY NAME :</strong></td>
		<td><input type="text" value="{{$crsetup->companyname}}" class="form-control" placeholder="Enter Name Of Company" name="companyname" ></td>
		
	</tr>
	<tr>
		<td><strong>CONTACT NO :</strong></td>
		<td><input type="text" name="contactno" class="form-control" placeholder="Enter Company Contact No" value="{{$crsetup->contactno}}" ></td>
	</tr>
	<tr>
		<td><strong>EMAIL</strong></td>
		<td><input type="email" value="{{$crsetup->email}}" name="email" class="form-control" placeholder="Enter Company Email"></td>
	</tr>
	<tr>
		<td><strong>GSTIN NUMBER</strong></td>
		<td><input type="text" name="gstno" value="{{$crsetup->gstno}}" class="form-control" placeholder="Enter Company GST No"></td>
	</tr>

	<tr>
		<td><strong>PAN NO</strong></td>
		<td><input type="text" name="panno" value="{{$crsetup->panno}}" class="form-control" placeholder="Enter Company PAN No"></td>
	</tr>

	<tr>
		<td><strong>ADDRESS</strong></td>
		<td>
			<textarea name="address" class="form-control" placeholder="Enter Company Full Address Here" >{{$crsetup->address}}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>ACCOUNT NO</strong></td>
		<td><input type="text" class="form-control" placeholder="Enter Your Account no" name="acno" value="{{$crsetup->acno}}" ></td>
	</tr>
	<tr>
		<td><strong>BANK NAME</strong></td>
		<td><input type="text" name="bankname" placeholder="Enter Your Bank Name" class="form-control" value="{{$crsetup->bankname}}" ></td>
	</tr>
	<tr>
		<td><strong>BRANCH NAME</strong></td>
		<td><input type="text" name="branchname" placeholder="Enter Your Branch Name" class="form-control" value="{{$crsetup->branchname}}" ></td>
	</tr>

    <tr>
		<td><strong>IFSC CODE</strong></td>
		<td><input type="text" name="ifsccode" placeholder="Enter Your IFSC Code" class="form-control" value="{{$crsetup->ifsccode}}" ></td>
	</tr>
	   <tr>
		<td><strong>DRAFT IN FAVOUR OF</strong></td>
		<td><input type="text" name="draftdetails" placeholder="Draft In Favour Of" class="form-control" value="{{$crsetup->draftdetails}}" ></td>
	</tr>
	   <tr>
		<td><strong>RTGS DETAILS</strong></td>
		<td><input type="text" name="rtgsdetails" placeholder="Enter Your RTGS Details" class="form-control" value="{{$crsetup->rtgsdetails}}" ></td>
	</tr>
	<tr>
		<td><strong>COMPANY LOGO</strong></td>
		<td><input type="file" id="companylogo" name="companylogo" onchange="readURL(this);">
			<img style="height:100px;width:150px;" src="{{ asset('/img/crsetup/'.$crsetup->companylogo )}}" id="imgshow">

		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: right;">
			<button type="submit" class="btn btn-success btn-lg">SAVE</button>
		</td>
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
</script>
@endsection