<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login||PMS-MONITOR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
     <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    
    <div class="limiter">
          <!-- images/bg-04.jpg-->
        <div class="container-login100" style="background-image: url('/front-bg1.jpg');">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
                @if(Session::has('message'))
                   <p class="alert alert-success text-center successmsg">
                    {{ Session::get('message') }}
                    </p>
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                   <!--  <span class="login100-form-title p-b-53">
                        PMS Monitors
                    </span>   -->
                     <span class="login100-form-title p-b-53">
                       PEWPL Login
                    </span>  

                    <div class="form-group{{ $errors->has('email') || $errors->has('username') ? ' has-error' : '' }}">            
                    <div class="p-b-9">
                        <span class="txt1">
                            Username
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Username is required">
                        <input class="input100" type="text"  name="username" value="{{ old('username') }}" required placeholder="Username">
                        <span class="focus-input100"></span>
                    </div>
                     @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color: #69ff00;">{{ $errors->first('email') }}</strong>
                                    </span>
                     @endif

                     @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong style="color: #69ff00;">{{ $errors->first('username') }}</strong>
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
                                        <strong style="color: #69ff00;">{{ $errors->first('password') }}</strong>
                                    </span>
                      @endif
                </div>

                    <div class="container-login100-form-btn m-t-30">
                        <button type="submit" class="login100-form-btn">
                            Sign In
                        </button>
                    </div>
                    <div class="row">
                    <div class="checkbox">
                                    <label style="color: floralwhite;">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                    </div>
                    <div class="checkbox">
                                    <label class="pull-right" >
                                       <a href="/register" style="font-size: 20px;text-decoration: none;color: #fff;">Create New Account </a>
                                    </label>
                    </div>
                </div>
                </form>
            </div>
            
        </div>
    </div>
    



     <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
      <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script>
    $('.successmsg').delay(3200).fadeOut(1000);
</script>
</body>
</html>