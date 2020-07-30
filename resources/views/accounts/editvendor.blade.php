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
        <td colspan="2"><strong>Vendor Type</strong></td>
        <td colspan="2">
        <select class="form-control" name="vtypeid" required="">

          <option value="">Select a Vendor Type</option>
          @foreach($vendortypes as $vendortype)
                   <option value="{{$vendortype->id}}" {{ ( $vendor->vtypeid == $vendortype->id) ? 'selected' : '' }}>{{$vendortype->vendortype}}</option>
          @endforeach
          
        </select>
      </td>
      </tr>
      <tr>
     <td colspan="2"><strong>ENTER PARTY NAME<span style="color: red"> *</span></strong></td>
     <td colspan="2"><input type="text" autocomplete="off" value="{{$vendor->vendorname}}" name="vendorname" placeholder="Enter Vendor Name" class="form-control"  required></td>
     
      </tr>
		<tr>
	 	 <td colspan="2"><strong>ENTER VENDOR MOBILE NO<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2"><input type="number" autocomplete="off" value="{{$vendor->mobile}}" name="mobile" placeholder="Enter Vendor Mobile No" class="form-control"></td>
	 	 
	    </tr><tr>

     <td colspan="2"><strong>ENTER VENDOR EMAIL<span style="color: red"> *</span></strong></td>
     <td colspan="2"><input type="email" autocomplete="off" value="{{$vendor->email}}" name="email" placeholder="Enter Vendor Email" class="form-control"></td>
     
      </tr>
         
    <tr>
	 	 <td colspan="2"><strong>ADDRESS<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2">
	 	 <textarea name="details" class="form-control" autocomplete="off">{{$vendor->details}}</textarea>
	 	</td>
	    </tr>
      <tr>
        <td colspan="2"><strong>TIN NUMBER</strong></td>
        <td colspan="2"><input type="text" value="{{$vendor->tinno}}" name="tinno" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2"><strong>TAN NUMBER</strong></td>
        <td colspan="2"><input type="text" value="{{$vendor->tanno}}" name="tanno" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2"><strong>SERVICE TAX NUMBER</strong></td>
        <td colspan="2"><input type="text" value="{{$vendor->servicetaxno}}" name="servicetaxno" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2"><strong>GSTN</strong></td>
        <td colspan="2"><input type="text" value="{{$vendor->gstno}}" name="gstno" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2"><strong>PAN NUMBER</strong></td>
        <td colspan="2"><input type="text" value="{{$vendor->panno}}" name="panno" class="form-control"></td>
      </tr>

	    <tr>
        <td colspan="2"><strong>BANK NAME</strong></td>
        <td colspan="2">
        <select class="form-control" name="bankname" required="">

          <option value="">Select a Bank</option>
          @foreach($banks as $bank)
                   <option value="{{strtoupper($bank->bankname)}}" {{ ( $vendor->bankname == strtoupper($bank->bankname)) ? 'selected' : '' }}>{{strtoupper($bank->bankname)}}</option>
          @endforeach
          
        </select>
      </td>
      </tr>
      <tr>
        <td colspan="2"><strong>ACCOUNT TYPE*</strong></td>
          <td colspan="2">
            <select class="form-control" name="acctype"  required="">
            <option value=''>--Select a type--</option>
            <option value="CA" {{ ( $vendor->acctype == "CA") ? 'selected' : '' }}>CA</option>
            <option value="SA" {{ ( $vendor->acctype == "SA") ? 'selected' : '' }}>SA</option>
            </select>
           </td>
      </tr>
      <tr>
        <td colspan="2"><strong>BANK ACCOUNT NO</strong></td>
        <td colspan="2"><input type="text" value="{{$vendor->acno}}" name="acno" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2"><strong>BRANCH NAME</strong></td>
        <td colspan="2"><input type="text" value="{{$vendor->branchname}}" name="branchname" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2"><strong>IFSC CODE</strong></td>
        <td colspan="2"><input type="text" value="{{$vendor->ifsccode}}" name="ifsccode" class="form-control"></td>
      </tr>
        <tr>
     <td colspan="2"><strong>Upload AAdhaar Card<span style="color: red"> *</span></strong></td>
     <td>
      <input name="aadhaarcard" type="file" onchange="readURL(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>
      </td>
      <td>
             <img style="height:70px;width:95px;" src="/img/vendordocument/aadhaarcard/{{$vendor->aadhaarcard}}" style="height:70px;width:95px;" alt="noimage" id="imgshow">
     </td>
     
      </tr>
     <tr>
       <td colspan="2"><strong>Upload Pancard<span style="color: red"> *</span></strong></td>
     <td>
      <input name="pancard" type="file" onchange="readURL1(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>
</td><td>
             <img style="height:70px;width:95px;" src="/img/vendordocument/pancard/{{$vendor->pancard}}" style="height:70px;width:95px;" alt="noimage" id="imgshow1">
     </td>
     </tr>
     <tr>
       <td colspan="2"><strong>Upload Gstin<span style="color: red"> *</span></strong></td>
     <td>
      <input name="gstin" type="file" onchange="readURL2(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>
          </td><td>
            <img src="/img/vendordocument/gstin/{{$vendor->gstin}}" style="height:70px;width:95px;" alt="noimage" id="imgshow2">
     </td>
     </tr>
     <tr>
       <td colspan="2"><strong>Upload Bank Passbook<span style="color: red"> *</span></strong></td>
     <td>
      <input name="bankpassbook" type="file" onchange="readURL3(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>
</td><td>
            <img src="/img/vendordocument/bankpassbook/{{$vendor->bankpassbook}}" style="height:70px;width:95px;" alt="noimage" id="imgshow3">
     </td>
     </tr>
     <tr>
       <td colspan="2"><strong>Upload Cancel Cheque<span style="color: red"> *</span></strong></td>
     <td>
      <input name="cancelcheque" type="file" onchange="readURL4(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>
</td><td>
            <img  src="/img/vendordocument/cancelcheque/{{$vendor->cancelcheque}}" style="height:70px;width:95px;" alt="noimage" id="imgshow4">
     </td>
     </tr>
	   <tr>
	   	<td colspan="2"><button class="btn btn-success" type="submit" onclick="return confirm('Do You want to Update this Vendor?')">Update</button></td>
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
    function readURL2(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow2')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }function readURL3(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow3')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL4(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow4')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
</script>

@endsection