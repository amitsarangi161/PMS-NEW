<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login||Status Gear</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">

</head>
<body>

    
    <div class="limiter">
    
        <div class="container-login100" style="background-image: url('/images/bg-04.jpg');">

            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">

                <form class="form-horizontal" method="POST" action="/registerrequest">
                        {{ csrf_field() }}
                    <span class="login100-form-title p-b-53">
                        Status Gear
                    </span> 
                        @if(session()->has('message'))
                         <div class="alert alert-success">
                              <strong style="color: #94eaed;" class="text-center">{{ session()->get('message') }}</strong>
                         </div>
                         @endif 
                           @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li style="color: #fff;">{{$error}}</li>
                  @endforeach
              </ul>
          </div><br />
              @endif
                   

                                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">            
                    <div class="p-b-9">
                        <span class="txt1">
                           Mobile No.
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Email is required">
                        <input  type="hidden" value="+91" id="country_code" readonly />
                        <input class="input100" type="text" name="mobile" id="phone_number" value="{{ old('mobile') }}" required placeholder="Enter Your mobile No">
                        <span class="focus-input100"></span>
                    </div>
                     @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong style="color: #ffd41e;">{{ $errors->first('mobile') }}</strong>
                                    </span>
                     @endif
                         <div class="col-md-12" style="padding-bottom: 10px;color: #fff;" id="mobile_verfication">
                       <button type="button" class="btn btn-primary" style="color:red;float:right;font-size:20px;" onclick="smsLogin();">SEND OTP</button>
                      </div>
                      </div>
<div style="display: none;" id="tbody">
                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">            
                    <div class="p-b-9">
                        <span class="txt1">
                            Name
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Username is required">
                        <input class="input100" type="text" name="name" value="{{ old('name') }}" required placeholder="Enter Your name">
                        <span class="focus-input100"></span>
                    </div>
                     @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong style="color: #ffd41e;">{{ $errors->first('name') }}</strong>
                                    </span>
                     @endif

                      </div>

                      <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">            
                    <div class="p-b-9">
                        <span class="txt1">
                           User Name
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Username is required">
                        <input class="input100" type="text" name="username" value="{{ old('username') }}" required placeholder="Enter a User name">
                        <span class="focus-input100"></span>
                    </div>
                     @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong style="color: #ffd41e;">{{ $errors->first('username') }}</strong>
                                    </span>
                     @endif

                      </div>

                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">            
                    <div class="p-b-9">
                        <span class="txt1">
                           Email
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Email is required">
                        <input class="input100" type="email" name="email" value="{{ old('email') }}" required placeholder="Enter a Email">
                        <span class="focus-input100"></span>
                    </div>
                     @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color: #ffd41e;">{{ $errors->first('email') }}</strong>
                                    </span>
                     @endif

                      </div>

            
                    


                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="p-t-13 p-b-9">
                        <span class="txt1">
                            Password
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="password" required placeholder="Password">
                        <span class="focus-input100"></span>
                    </div>
                      @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color: #ffd41e;">{{ $errors->first('password') }}</strong>
                                    </span>
                      @endif
                </div>

                      <div>
                    <div class="p-t-13 p-b-9">
                        <span class="txt1">
                           Confirm Password
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="password_confirmation" required placeholder="Password" id="password-confirm">
                        <span class="focus-input100"></span>
                    </div>
                     
                </div>

                    <div class="container-login100-form-btn m-t-30">
                        <button type="submit" id="submitform" onclick="return confirm('Do You Want to Proceed?');" class="login100-form-btn">
                            Sign Up
                        </button>
                    </div>
        </div>
                         <div class="row">
                    <div class="checkbox">
                                    <label class="pull-right" >
                                       <a href="/login" style="font-size: 20px;text-decoration: none;color: #fff;">Login</a>
                                    </label>
                    </div>
                </div>
                </form>
            </div>
            
        </div>
    </div>
    


</body>
 <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
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
    console.log(response)
    if (response.status === "PARTIALLY_AUTHENTICATED") {
      var code = response.code;
      var csrf = response.state;
      // Send code to server to exchange for access token
      $('#mobile_verfication').html("<p class='helper' style='color:#fff;'> * Phone Number Verified </p>");
      $('#phone_number').attr('readonly',true);
      $('#country_code').attr('readonly',true);
      $('#tbody').fadeIn(400);

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
               }
             });

     /* $.post("http://localhost:8000/account/kit",{"_token": "{{ csrf_token() }}", code : code }, function(data){
        $('#phone_number').val(data.phone.national_number);
        $('#country_code').val('+'+data.phone.country_prefix);
      });*/

    }
    else if (response.status === "NOT_AUTHENTICATED") {
      // handle authentication failure
      $('#mobile_verfication').html("<p class='helper' style='color:#fff;'> * Authentication Failed </p>");
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
</html>