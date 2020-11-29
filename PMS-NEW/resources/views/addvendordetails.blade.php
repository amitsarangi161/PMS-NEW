@extends('layouts.app')
@section('content')

<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">PLEASE ADD VENDOR DETAILS</td>
	 </tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">IF VENDOR ALREADY EXIST</td>
	 </tr>
</table>

<div class="well">
	<table class="table">
		<form action="/addexsitingvendor/{{$id}}" method="post">
			{{csrf_field()}}
		<tr>
			<td><strong>SELECT A VENDOR</strong></td>
			<td>
				<select class="form-control" name="existingvendorid" required="">
					<option value="">Select a Vendor</option>
					@foreach($vendors as $vendor)
                    <option value="{{$vendor->id}}">{{$vendor->vendorname}}</option>
					@endforeach
				
		    	</select>
		</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: right;">
				<button class="btn btn-primary" type="submit" onclick="return confirm('Do You Want to Proceed ?');">ADD VENDOR</button>
			</td>
			
		</tr>
		</form>
	</table>
	
</div>
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">NEW VENDOR ADD</td>
	 </tr>
</table>

<div class="well">
<form action="/saverequisitionvendor/{{$id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
 
	<table class="table table-responsive table-hover table-bordered table-striped">

		<tr>
	 	 <td><strong>ENTER VENDOR MOBILE NO<span style="color: red"> *</span></strong></td>
    <!--  <td><input type="hidden" value="+91" id="country_code" readonly /></td> -->
    <td></td>
	 	 <td><input type="number" autocomplete="off" name="mobile" id="phone_number" placeholder="Enter Vendor Mobile No" class="form-control" required></td>
	 	 <!-- <td id="hidebutton">
           <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication">
	 	 	<button class="btn btn-primary" onclick="smsLogin();">SEND OTP</button>
           </div>
	 	 </td> -->

	 	 
	   </tr>

	 <tbody id="otptr" style="display: none;">
	    <tr>
	    	<td colspan="2"><strong>OTP</strong></td>
	    	<td><input type="text" placeholder="Enter Your Otp Here" class="form-control" name="otp" id="otp"></td>
	    	<td><button type="button" class="btn btn-info" onclick="verifyOtp();">VERIFY OTP</button></td>
	    </tr>
	    <tr>
	    <td></td>
	    <td>
	    	<div id="timer">
	    		<b style="color: blue;">
             This Otp is valid for the next <strong id="minutes" style="color: red;">-</strong> minutes and <strong id="seconds" style="color: red;">-</strong> seconds.</b>
            </div>
	    </td>
	    </tr>
        </tbody>
        
	    <!-- <tbody id="tbody" style="display: none;"> -->
        <tbody id="tbody">
	    <tr>
	 	 <td colspan="2"><strong>ENTER VENDOR NAME<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2"><input type="text" autocomplete="off" name="vendorname" placeholder="Enter Vendor Name" class="form-control"  required></td>
	 	 
	    </tr>
         
           <tr>
	 	 <td colspan="2"><strong>DETAILS<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2">
	 	 <textarea name="details" class="form-control" autocomplete="off"></textarea>
	 	</td>
	 	 
	    </tr>
      <tr>
        <td colspan="2">BANK NAME</td>
        <td colspan="2"><input type="text" placeholder="Enter Bank Name" name="bankname" class="form-control"></td>
      </tr>
        <tr>
        <td colspan="2">BANK ACCOUNT NO</td>
        <td colspan="2"><input type="text" placeholder="Enter Bank Ac No" name="acno" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2">BRANCH NAME</td>
        <td colspan="2"><input type="text" placeholder="Enter Branch Name" name="branchname" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2">IFSC CODE</td>
        <td colspan="2"><input type="text" placeholder="Enter IFSC Code" name="ifsccode" class="form-control"></td>
      </tr>

         <tr>
	 	 <td colspan="2"><strong>VENDOR ID PROOF/Ac Image<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2">
	 	 	<input name="vendoridproof" type="file" onchange="readURL(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow">
	 	 </td>
	 	 
	    </tr>
	   <tr>
	   	 <td colspan="2"><strong>VENDOR PHOTO<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2">
	 	 	<input name="photo" type="file" onchange="readURL1(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow1">
	 	 </td>
	   </tr>
	   <tr>
	   	<td colspan="4" style="text-align: right;"><button class="btn btn-success btn-lg" type="submit" onclick="return confirm('Do You want to Proceed?')">Save</button></td>
	   </tr>
      </tbody>
	</table>
</form>
</div>

@endsection