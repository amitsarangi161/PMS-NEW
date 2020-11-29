@extends('layouts.mobile')

@section('content')

<table class="table  table-hover table-bordered table-striped" width="400%">
     <tr class="bg-navy">
         <td style="font-size:40px;" class="text-center">ADD VENDOR</td>
     </tr>
</table>
<form action="/savevendor" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
<table class="table  table-bordered" width="400%">
       <tr>
         <td><strong style="font-size:25px;">ENTER VENDOR MOBILE NO<span style="color: red"> *</span></strong></td>
       </tr>
       <tr>
           <input type="hidden" value="+91" id="country_code" readonly />
           <td><input type="number" style="padding:35px;" autocomplete="off" name="mobile" id="phone_number" placeholder="Enter Vendor Mobile No" class="form-control" required></td>
       </tr>
       <tr id="hidebutton">
         <td>
          <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication">
            <button style="width:40%;height:60px;font-size:2.3em;"  class="btn btn-info btn-lg" onclick="smsLogin();">Send OTP</button>
          </div>
         </td>
       </tr>

    <tbody id="otptr" style="display: none;">
        <tr>
            <td><strong style="font-size:25px;">OTP</strong></td>
            
           
        </tr>
        <tr>
            <td><input style="padding:35px;" type="number" placeholder="Enter Your Otp Here" class="form-control" name="otp" id="otp"></td>
        </tr>
        <tr>
            
            
           <td> <button style="width:40%;height:60px;font-size:2.3em;"  class="btn btn-info btn-lg" onclick="verifyOtp();">VERIFY OTP</button></td>
        </tr>
        <tr>
       
        <td>
            <div id="timer">
                <b style="color: blue;">
             This Otp is valid for the next <strong id="minutes" style="color: red;">-</strong> minutes and <strong id="seconds" style="color: red;">-</strong> seconds.</b>
            </div>
        </td>
        </tr>
        </tbody>

<tbody id="tbody" style="display: none;">
        <tr>
         <td><strong style="font-size:25px;">ENTER VENDOR NAME<span style="color: red"> *</span></strong></td>
        
         
        </tr>
        <tr>
             <td><input type="text" style="padding:35px;" autocomplete="off" name="vendorname" placeholder="Enter Vendor Name" class="form-control"  required></td>
        </tr>
         
           <tr>
         <td><strong style="font-size:25px;">DETAILS<span style="color: red"> *</span></strong></td>
         
         
        </tr>
        <tr>
            <td>
         <textarea name="details" style="padding:50px;" class="form-control" autocomplete="off"></textarea>
        </td>
        </tr>
      <tr>
        <td><strong style="font-size:25px;">BANK NAME</strong></td>
       
      </tr>
      <tr>
          <td><input type="text" style="padding:35px;" placeholder="Enter Bank Name" name="bankname" class="form-control"></td> 
      </tr>
      <tr>
        <td><strong style="font-size:25px;">BRANCH NAME</strong></td>
       
      </tr>
      <tr>
         <td><input type="text" style="padding:35px;" placeholder="Enter Branch Name" name="branchname" class="form-control"></td>  
      </tr>
      <tr>
        <td><strong style="font-size:25px;">IFSC CODE</strong</td>
       
      </tr>
      <tr>
           <td><input type="text" style="padding:35px;" placeholder="Enter IFSC Code" name="ifsccode" class="form-control"></td>
      </tr>

         <tr>
         <td><strong style="font-size:25px;">VENDOR ID PROOF<span style="color: red"> *</span></strong></td>
         
         
        </tr>
        <tr>
            <td>
            <input name="vendoridproof" style="padding:35px;" type="file" onchange="readURL(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow">
         </td>
        </tr>
       <tr>
         <td><strong style="font-size:25px;">VENDOR PHOTO<span style="color: red"> *</span></strong></td>
         
       </tr>
       <tr>
           <td>
            <input name="photo" style="padding:35px;" type="file" onchange="readURL1(this);">
            <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow1">
         </td>
       </tr>
       <tr>
        <td><button class="btn btn-success btn-lg" style="width:40%;height:60px;font-size:2.3em;" type="submit">Save</button></td>
       </tr>
      </tbody>


</table>
</form>
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


<script>
  // initialize Account Kit with CSRF protection
  AccountKit_OnInteractive = function(){
    AccountKit.init(
      {
        appId: 347046322758957, 
        state:"state", 
        version: "v1.0",
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
      $('#tbody').fadeIn(400);

      $.post("https://schedule.tranxit.co/account/kit",{ code : code }, function(data){
        $('#phone_number').val(data.phone.national_number);
        $('#country_code').val('+'+data.phone.country_prefix);
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