<!DOCTYPE html>
<html>
  <head>
    <title>Status Gear</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
   
    <link rel="stylesheet" href="{{ asset('mobilesite/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
   
<nav class="navbar navbar-inverse mob-navbar">
    <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-target="#Navabar" data-toggle="collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <nav class="navbar-brand">
            <a href="/mobile"><strong>Status Gear</strong></a> 
        </nav>
    </div>
    <div class="navbar-collapse collapse" id="Navabar">
        <ul class="nav navbar-nav navbar-right" style="margin-top:35px;font-size:30px;">
            <li><a href="/mobile">Home</a></li>
        </ul>
    </div>
    </div>
</nav>
     <div id="page" class="container">
        <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 mob-user">
           <h2> <i class="fa fa-user"></i>&nbsp;&nbsp; <strong style="color:blue;">{{Auth::user()->name}}</strong>
           

             <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span style="color:red;"  class="pull-right"><i class="fa fa-sign-out" style="color:red;"></i> Logout</span></a></h2>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
          </form>
        </div> 
        </div>
        </div>
<div class="container-fluid">
    @yield('content')
   
</div> 



<!--<div class="footer" id="footer" style="margin-top:1000px;">-->
<!--    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">-->
<!--        <p class="text-center ftext"> 2018 &copy; All rights reserved | Design by STEPL</p>-->
<!--        <p class="text-center ftext"><a href="/http://www.subudhitechno.com">Subudhi Tecnoengeneers Pvt.ltd</a></p>-->
<!--    </div>-->
<!--</div>-->


<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
  </body>
</html>
