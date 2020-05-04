@extends('layouts.app')
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
<form action="/savevendor" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">

		<tr>
	 	 <td><strong>ENTER VENDOR MOBILE NO<span style="color: red"> *</span></strong></td>
    <!--  <td><input type="hidden" value="+91" id="country_code" readonly /></td> -->
    <td></td>
	 	 <td><input type="number" autocomplete="off" name="mobile" id="phone_number" placeholder="Enter Vendor Mobile No" class="form-control" required></td>
	

	 	 
	   </tr>
    
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
        <td colspan="2"><strong>BANK NAME</strong></td>
        <td colspan="2"><input type="text" placeholder="Enter Bank Name" name="bankname" class="form-control"></td>
      </tr>
        <tr>
        <td colspan="2"><strong>BANK ACCOUNT NO</strong></td>
        <td colspan="2"><input type="text" placeholder="Enter Bank Ac No" name="acno" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2"><strong>BRANCH NAME</strong></td>
        <td colspan="2"><input type="text" placeholder="Enter Branch Name" name="branchname" class="form-control"></td>
      </tr>
      <tr>
        <td colspan="2"><strong>IFSC CODE</strong></td>
        <td colspan="2"><input type="text" placeholder="Enter IFSC Code" name="ifsccode" class="form-control"></td>
      </tr>

         <tr>
	 	 <td colspan="2"><strong>VENDOR ID PROOF/Ac Image<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2">
	 	 	<input name="vendoridproof" type="file" onchange="readURL(this);" required="">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow">
	 	 </td>
	 	 
	    </tr>
	   <tr>
	   	 <td colspan="2"><strong>VENDOR PHOTO<span style="color: red"> *</span></strong></td>
	 	 <td colspan="2">
	 	 	<input name="photo" type="file" onchange="readURL1(this);" required="">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow1">
	 	 </td>
	   </tr>
	   <tr>
	   	<td colspan="4" style="text-align: right;"><button class="btn btn-success btn-lg" type="submit" onclick="return confirm('Do You want to Proceed?')">Save</button></td>
	   </tr>
      
	</table>
</form>
</div>



<!-- HTTPS required. HTTP will give a 403 forbidden response -->
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>


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


    function sendOtp() {
		var mob=$('#mobile').val();
		if(mob=='')
		{
			alert("mobile no cant be blank");
		}
		else if(mob.length<10)
		{
            alert("Mobile No should be 10digit");
		}
		else
		{

            $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
            });
             

              $.ajax({
               type:'POST',
              
               url:'{{url("/sendOtp")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      mob: mob
                      
                     },

               success:function(data) { 

                    alert(data);
                    $("#hidebutton").hide();
                    $("#otptr").show();
              
                    $('#mobile').prop('readonly', true);
                    timer();

                }
              });
       }

	}

function verifyOtp(){

    var otp2=$("#otp").val();
    
    var m=$("#mobile").val();
 
   if(otp2=='')
   {
   	alert("Otp can't Be blank");
   }
   else
   {
   	$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
            });
             

              $.ajax({
               type:'POST',
              
               url:'{{url("/verifyOtp")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      mob: m,
                      otp:otp2
                     },

               success:function(data) { 
               	  if(data=='Otp Matched')
               	  {
               	  	$("#otptr").hide();
               	  	$("#tbody").show();
               	  }

               	  else
               	  {
               	  	alert(data);
               	  }
               }
           });
   }

}


function timer()
{
	var time = 10 * 60,
    start = Date.now(),
    mins = document.getElementById('minutes'),
    secs = document.getElementById('seconds'),
    timer;

function countdown() {
  var timeleft = Math.max(0, time - (Date.now() - start) / 1000),
      m = Math.floor(timeleft / 60),
      s = Math.floor(timeleft % 60);
  
  mins.firstChild.nodeValue = m;
  secs.firstChild.nodeValue = s;
  
  if( timeleft == 0) clearInterval(timer);
}

timer = setInterval(countdown, 200);
}

</script>

<!-- Sms Otp Fb -->

<script>
  // initialize Account Kit with CSRF protection
  AccountKit_OnInteractive = function(){
    AccountKit.init(
      {
        appId: 347046322758957, 
        state:"state", 
        version: "v1.1",
        fbAppEventsEnabled:true
      }
    );
  };

  // login callback
  function loginCallback(response) {
    if (response.status === "PARTIALLY_AUTHENTICATED") {
      var code = response.code;
      var csrf = response.state;
      // Send code to server to exchange for access token
      $('#mobile_verfication').html("<p class='helper'> * Phone Number Verified </p>");
      $('#phone_number').attr('readonly',true);
      $('#country_code').attr('readonly',true);
     

      $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
            });
             

              $.ajax({
               type:'POST',
              
               url:'{{url("/account/kit")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      code : code
                     },

               success:function(data) { 
                  $('#phone_number').val(data.phone.national_number);
                   $('#country_code').val('+'+data.phone.country_prefix);
                    $('#tbody').fadeIn(400);
               }
             });

    }
    else if (response.status === "NOT_AUTHENTICATED") {
      // handle authentication failure
      $('#mobile_verfication').html("<p class='helper'> * Authentication Failed </p>");
    }
    else if (response.status === "BAD_PARAMS") {
      // handle bad parameters
    }
  }

  // phone form submission handler
  function smsLogin() {
    var countryCode = document.getElementById("country_code").value;
    var phoneNumber = document.getElementById("phone_number").value;

    $('#mobile_verfication').html("<p class='helper'> Please Wait... </p>");
    $('#phone_number').attr('readonly',true);
    $('#country_code').attr('readonly',true);

    AccountKit.login(
      'PHONE', 
      {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
      loginCallback
    );
  }

</script>
@endsection