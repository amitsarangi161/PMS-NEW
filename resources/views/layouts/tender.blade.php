<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

 @if(Auth::user()->usertype=='USER')
<script type="text/javascript">
    location.replace('/400');
</script>
@endif
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')}}">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css')}}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css')}}">
      <!-- Morris chart -->
      <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css')}}">
      <!-- jvectormap -->
      <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
      <!-- Date Picker -->
     <!--  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css')}}"> -->
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
      <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

  
  
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
   <!--  <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script> -->
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <style type="text/css">
      .amit-btn a{border-radius: 0px!important;}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Status Gear</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <!-- Sidebar toggle button-->
      <ul class="navbar-nav nav " style="padding-left: 64px;">
        <li class="dropdown message-menu">
          <a  onclick="window.history.back(0);">
            <p style="font-size: 20px;"><i class="fa fa-arrow-circle-left"></i> Back</p>
          </a>
        </li>
      </ul>

      
      @php
         $wallet=\App\wallet::where('employeeid',Auth::id())
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

      @endphp
      <div class="navbar-custom-menu">

        <ul class="navbar-nav nav" style="padding-right: 20px;padding-top: 10px;">

        <li class="dropdown message-menu" style="padding-right: 20px; padding-left: 20px;">
          <img src="{{asset('wallet.png')}}" style="height: 40px;width: 40px;">
        </li>
        <li class="dropdown message-menu">
          <strong style="color: #fff;">Wallet</strong><p style="color: #fff;" id="walletbalance">Rs. {{$walletbalance}}</p>
        </li>
        </ul>
        <ul class="nav navbar-nav">

         
           
          <li class="dropdown user user-menu">
      
            @if (Auth::guest())
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
         
           @else

      
             <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger btn-flat">Sign out</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
          </form>
            
           @endif
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
<div id="myloaderDiv" style="display:none; width: 100%; height: 100%; background-color: #ffffffb3; position: absolute; top:0; bottom: 0; left: 0; right: 0; margin: auto; z-index: 9999;">
        <img style="position: absolute; top:0; bottom: 0; left: 0; right: 0; margin: auto;" id="loading-image" src="{{ asset('images/loader/loader-dtpl.gif') }}" style=""/>
    </div>
  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        @if (Auth::user())

        <div class="pull-left info">
          <p> {{ Auth::user()->name }}</p>
          <p> {{ Auth::user()->usertype}}</p>
          
          
           
        </div>
      
        @endif
       
      </div>
     



  
      <ul class="sidebar-menu">
        <li class="header"><strong class="text-center">TENDER NAVIGATION</strong></li>
      
    

           <li class="{{ Request::is('/admintender') ? 'active' : '' }} treeview">
          <a href="/admintender">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>
          </li>
     

         
  
       @if(Auth::user()->usertype=='TENDER' || Auth::user()->usertype=='MASTER ADMIN')
       <li class="{{ Request::is('tm*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>TENDER MAIN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @php
          $ctlcount=DB::table('tenders')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id')
          ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))->count();
          $alltenders=DB::table('tenders')->count();
           $adminapprovedtenders=DB::table('tenders')
                ->where('status','ADMIN APPROVED')
                ->count();


            @endphp

            <li class="{{ Request::is('tm/createtender') ? 'active' : '' }}"><a href="/tm/createtender"><i class="fa fa-circle-o text-aqua"></i>CREATE TENDER</a></li>

            <!-- <li class="{{ Request::is('tm/temptenders') ? 'active' : '' }}"><a href="/tm/temptenders"><i class="fa fa-circle-o text-aqua"></i>TEMP TENDERS</a></li> -->

             <li class="{{ Request::is('tm/tenderlist') ? 'active' : '' }}"><a href="/tm/tenderlist"><i class="fa fa-circle-o text-aqua"></i>CURRENT TENDER LIST
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$ctlcount}}</span>
              </span>
              </a>
              </li>


             <li class="{{ Request::is('tm/viewalltenders') ? 'active' : '' }}"><a href="/tm/viewalltenders"><i class="fa fa-circle-o text-aqua"></i>VIEW ALL TENDERS
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$alltenders}}</span>
              </span>
             </a></li>

        <!--      <li class="{{ Request::is('tm/assignedtendersoffice') ? 'active' : '' }}"><a href="/tm/assignedtendersoffice"><i class="fa fa-circle-o text-aqua"></i>ASSIGNED TENDERS TO APPLY</a></li>

             <li class="{{ Request::is('tm/adminapprovedtenders') ? 'active' : '' }}"><a href="/tm/adminapprovedtenders"><i class="fa fa-circle-o text-aqua"></i>ADMIN APPROVED TENDERS
               <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$adminapprovedtenders}}</span>
              </span>

             </a></li> -->




     <!-- <li class="{{ Request::is('tm/associatepartner') ? 'active' : '' }}"><a href="/tm/associatepartner"><i class="fa fa-circle-o text-aqua"></i>ASSOCIATE PARTNER</a></li> -->
     
               <!--       <li class="{{ Request::is('tm/approvedbutnotappliedtenders') ? 'active' : '' }}"><a href="/tm/approvedbutnotappliedtenders"><i class="fa fa-circle-o text-aqua"></i>APPROVED NOT APPLIED TENDERS</a></li> -->
          </ul>
        </li>
        @endif

        @php
        $temptenders=\App\temptender::where('isactive',1)->count();
        $nottemptenders=\App\temptender::where('isactive',0)->count();
        @endphp
     <!--  <li class="{{ Request::is('temptender*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>TEMP TENDER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-info pull-right">{{$temptenders}}</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('temptender/temptenders') ? 'active' : '' }}"><a href="/temptender/temptenders"><i class="fa fa-circle-o text-aqua"></i>TEMP TENDERS
             <span class="pull-right-container">
              <span class="label label-success pull-right">{{$temptenders}}</span>
                  
              </span>

            </a></li>
            <li class="{{ Request::is('temptender/notellgible') ? 'active' : '' }}"><a href="/temptender/notellgible"><i class="fa fa-circle-o text-aqua"></i>NOT ELLIGIBLE
             <span class="pull-right-container">
              <span class="label label-success pull-right">{{$nottemptenders}}</span>
                  
              </span>

            </a></li>
            
          </ul>
        </li> -->

    <!--   @if(Auth::user()->usertype=='TENDER COMMITTEE')

    <li class="{{ Request::is('tm*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>VIEW ALL TENDERS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @php
          $ctlcount=DB::table('tenders')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id')
          ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))->count();
          $alltenders=DB::table('tenders')->count();
           $adminapprovedtenders=DB::table('tenders')
                ->where('status','ADMIN APPROVED')
                ->count();


            @endphp

          

             <li class="{{ Request::is('tm/tenderlist') ? 'active' : '' }}"><a href="/tm/tenderlist"><i class="fa fa-circle-o text-aqua"></i>CURRENT TENDER LIST
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$ctlcount}}</span>
              </span>
              </a>
              </li>


             <li class="{{ Request::is('tm/viewalltenders') ? 'active' : '' }}"><a href="/tm/viewalltenders"><i class="fa fa-circle-o text-aqua"></i>VIEW ALL TENDERS
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$alltenders}}</span>
              </span>
             </a></li>

          
     
  
          </ul>
        </li>

      @endif -->
      @if(Auth::user()->usertype=='TENDER COMMITTEE'|| Auth::user()->usertype=='MASTER ADMIN')




      @php
        $pendingcomitee=DB::table('tenders')
          ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
          ->where(function ($query) {
                  $query->where('status','ELLIGIBLE')
                ->orWhere('status','ELLIGIBLE,INTERESTED');
           })   
          ->count();
        $pendingcomitteeapproval=DB::table('tenders')->where('status','PENDING COMMITEE APPROVAL')
                  ->select('tenders.*','users.name')
                  ->leftJoin('users','tenders.author','=','users.id')
                  ->count();
        $comitteeapproved=DB::table('tenders')->where('status','COMMITEE APPROVED')
                  ->select('tenders.*','users.name')
                  ->leftJoin('users','tenders.author','=','users.id')
                   ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
                  ->count();
       
      @endphp
          <!--   <li class="{{ Request::is('tendercom*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>TENDER COMMITTEE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-warning pull-right">{{$pendingcomitee+$pendingcomitteeapproval}}</span>
              </span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('tendercom/tenderlistforcommitee') ? 'active' : '' }}"><a href="/tendercom/tenderlistforcommitee"><i class="fa fa-circle-o text-aqua"></i>PENDING FOR COMMITTEE
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$pendingcomitee}}</span>
              </span>

            </a></li>

            <li class="{{ Request::is('tendercom/pendingtenderapproval') ? 'active' : '' }}"><a href="/tendercom/pendingtenderapproval"><i class="fa fa-circle-o text-aqua"></i>PENDING COMMITTEE APPROVAL
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$pendingcomitteeapproval}}</span>
              </span>
            </a></li>
            <li class="{{ Request::is('tendercom/approvedcommiteetender') ? 'active' : '' }}"><a href="/tendercom/approvedcommiteetender"><i class="fa fa-circle-o text-aqua"></i>APPROVED TENDERS COMMITTEE
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$comitteeapproved}}</span>
              </span>

            </a></li>

          </ul>
        </li> -->
  
        @endif
      @if(Auth::user()->usertype=='MASTER ADMIN')
       @php
         $pendingadminapproval=DB::table('tenders')
                 ->where('status','ELLIGIBLE')
                 ->count();
           $adminapproved=DB::table('tenders')
                ->where('status','ADMIN APPROVED')
                ->count();
          
       @endphp
      <li class="{{ Request::is('ata*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>ADMIN APPROVAL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-info pull-right">{{$pendingadminapproval}}</span>
              </span>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="{{ Request::is('ata/admintenderapproval') ? 'active' : '' }}"><a href="/ata/admintenderapproval"><i class="fa fa-circle-o text-aqua"></i>PENDING ADMIN APPROVAL
            <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$pendingadminapproval}}</span>
              </span>

            </a></li>
             <li class="{{ Request::is('ata/adminapprovedtenders') ? 'active' : '' }}"><a href="/ata/adminapprovedtenders"><i class="fa fa-circle-o text-aqua"></i>ADMIN APPROVED TENDERS
               <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$adminapproved}}</span>
              </span>
             </a></li>

          </ul>
        </li>

       @endif
         @php
        $appliedtenders=DB::table('tenders')
          ->where('status','APPLIED')
          ->count();
        $notapplied=DB::table('tenders')
              ->where('status','NOT APPLIED')
              ->count();
         $committeerejected=DB::table('tenders')
              ->where('status','COMMITTEE REJECTED')
              ->count();
             $userassigned=DB::table('tenders')
               ->where('status','ASSIGNED TO USER')
               ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
               ->count();
         @endphp
        <li class="{{ Request::is('applied*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>APPLIED TENDER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-primary pull-right">{{$appliedtenders}}</span>
              </span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('applied/appliedtenders') ? 'active' : '' }}"><a href="/applied/appliedtenders"><i class="fa fa-circle-o text-aqua"></i>APPLIED TENDERS
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$appliedtenders}}</span>
              </span>

            </a></li>
          </ul>
        </li>
            <!-- <li class="{{ Request::is('userassigned*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>USER ASSIGNED</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-warning pull-right">{{$userassigned}}</span>
              </span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('userassigned/pendinguserassigned') ? 'active' : '' }}"><a href="/userassigned/pendinguserassigned"><i class="fa fa-circle-o text-aqua"></i>PENDING USER ASSIGNED
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$userassigned}}</span>
              </span>

            </a></li>

     

          </ul>
        </li> -->
     <!--  <li class="{{ Request::is('comrejected*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>COMMITTEE REJECTED</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-danger pull-right">{{$committeerejected}}
              </span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('comrejected/comitteerejectedtenders') ? 'active' : '' }}"><a href="/comrejected/comitteerejectedtenders"><i class="fa fa-circle-o text-aqua"></i>REJECTED TENDERS
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$committeerejected}}
                  </span>
              </span>

            </a></li>
          </ul>
        </li> -->

<!--          <li class="{{ Request::is('notapplied*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>APPROVED BUT 
            <br>
            NOT APPLIED TENDER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
               <span class="label label-danger pull-right">{{$notapplied}}</span>
              </span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('notapplied/approvedbutnotappliedtenders') ? 'active' : '' }}"><a href="/notapplied/approvedbutnotappliedtenders"><i class="fa fa-circle-o text-aqua"></i>NOT APPLIED TENDERS
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$notapplied}}</span>
              </span>

            </a></li>
          </ul>
        </li> -->
           <li class="{{ Request::is('alltenderpdu*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>TENDER RESULT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('alltenderpdu/alltendersdocupload') ? 'active' : '' }}"><a href="/alltenderpdu/alltendersdocupload"><i class="fa fa-circle-o text-aqua"></i>TENDER DOC UPLOAD
             <span class="pull-right-container">
                  
              </span>

            </a></li>
          </ul>
        </li>


        

       
    </section>
    <!-- /.sidebar -->
  </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       @if(Auth::user()->usertype=='MASTER ADMIN')
          <div class="btn-group btn-group-justified amit-btn">
            <a href="/" class="btn bg-maroon btn-lg">MAIN</a>
            <a href="/mdhome" class="btn bg-olive btn-lg">MD</a>
            <a href="/adminhr" class="btn bg-purple btn-lg">HR</a>
            <a href="/adminaccounts" class="btn bg-red btn-lg">ACCOUNTS</a>
            <a href="/admininventory" class="btn btn-success btn-lg">INVENTORY</a>
            <a href="/admintender" class="btn btn-info btn-lg">TENDER</a>
          </div> 
        @endif
              
        <section class="content-header">      
            <h1 style="text-align: center;">
               PMS-MONITORS 1.0V TENDER
            </h1>
            <ol class="breadcrumb">

                @foreach(Request::segments() as $segment)
                <li>
                   <a href="#"><span style="text-transform:uppercase;">{{$segment}}</span></a>
                </li>
                @endforeach 
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          @yield('content')
           
        </section> 


    </div>

    <div class="modal fade " id="myModal" role="dialog">
        <div class="modal-dialog ">
        
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"> Reset Password</h4>
                  <form class="form-horizontal" role="form" method="POST" action="">
                    {{ csrf_field() }}

                  <table class="table table-responsive table-hover table-bordered">
                    <tr>
                    <td>NEW PASSWORD</td>
                    <td><input id="password" type="password" name="password" placeholder="Enter New Password"></td>
                    </tr>
                    <tr>
                    <td>CONFIRM PASSWORD</td>
                    <td><input id="confirm_password" type="password" name="pass2" placeholder="Confirm Password"><span id='message'></span></td>
                    </tr>
                    <tr><td colspan="2">  <span id='result'><button class="btn btn-success" type="submit" disabled>RESET NOW
                    </button></span></td></tr>
                  </table>

                  </form>
                </div>
       
            </div>
        </div>
    </div>


<link href="{{ URL::asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ URL::asset('css/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ URL::asset('css/datatables/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

      <script src="{{ URL::asset('/js/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
     
      <script src="{{ URL::asset('/js/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/dataTables.buttons.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/buttons.flash.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/jszip.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/pdfmake.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/vfs_fonts.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/buttons.html5.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/buttons.print.min.js')}}" type="text/javascript"></script>




 <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">

<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>

<link rel="stylesheet" href="{{ URL::asset('plugins/select2/select2.min.css') }}">

<link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>


<script type="text/javascript">

window.onpageshow = function(event) {
if (event.persisted) {
    window.location.reload() 
}
};


  $('.readonly').on('input', function(e){
    var key = e.which || this.value.substr(-1).charCodeAt(0);
    $(".readonly").val("");
    alert('Manually Input Blocked Choose a date from Picker');
  });

$(document).ready(function(){
          
   countunreadmessage();


     setInterval(function(){
     countunreadmessage();
     checkwalletbalance();
 }, 100000);

       });


       function countunreadmessage()
       {
           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxcountunreadmessage")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     
                     },

               success:function(data) { 
                     $("#countmsg").html(data);
                     $("#countmsg111").html(data);
               }
               
             });
       }

         function checkwalletbalance()
       {
           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxcheckwalletbalance")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     
                     },

               success:function(data) { 
                     $("#walletbalance").html('Rs. '+data);
                     $("#walletbal").html(data);
                     
               }
             });
       }

      $('.datatable1').DataTable({
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 10,
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer:true,
                pageSize: 'A4',
                title: 'REPORT',            },
            {
                extend: 'excelHtml5',
                footer:true,
                title: 'REPORT'
            },
            {
                extend: 'print',
                footer:true,
                title: 'REPORT'
            }

       ],
            });
      $('.datatable2').DataTable({
        dom: 'Bfrtip',
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 25,
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer:true,
                pageSize: 'A4',
                title: 'REPORT',            },
            {
                extend: 'excelHtml5',
                footer:true,
                title: 'REPORT'
            },
            {
                extend: 'print',
                footer:true,
                title: 'REPORT'
            }

       ],
            });
</script>
  <script>
      $('.select2').select2({dropdownCssClass : 'bigdrop'});
      $( ".addnewrow" ).sortable();
    </script>

   <script>



$(".datepicker").datepicker({
       dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       setDate: 0
       });
$(".datepicker1").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       setDate: 0
       }).datepicker("setDate", "0");
$(".datepicker2").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       minDate: 0,
       setDate: 0
       }).datepicker("setDate", "0");

$(".datepicker3").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       minDate: 0
      
       });
$(".datepicker4").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       minDate: -2,
       maxDate: new Date()
      
       }).datepicker("setDate", "0");
$(".datepicker5").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       minDate: -2,
       maxDate: new Date()
      
       }).datepicker("setDate", "0");
</script> 

<script type="text/javascript">
var jqf = $.noConflict();

  jqf('#password, #confirm_password').on('keyup', function () {
  if (jqf('#password').val() == jqf('#confirm_password').val()) {
    jqf('#result').html('<button class="btn btn-success" type="submit">RESET NOW</button>');
  } else 
    jqf('#result').html('<button class="btn btn-success" type="submit" disabled >RESET NOW</button>');
});
  $('.datatable').DataTable({

     "order": [[ 0, "desc" ]],
     "iDisplayLength": 25
  });

 var datatablescroll=$('.datatablescroll').DataTable({

     "order": [[ 0, "desc" ]],
     "scrollY": 450,
     "scrollX": true,
     "iDisplayLength": 25
  });
  $('.datatablescrollexport').DataTable({
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 25,
        "scrollY": 450,
        "scrollX": true,

        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer:true,
                pageSize: 'A4',
                title: 'Report',          
            },
            {
                extend: 'excelHtml5',
                footer:true,
                title: 'Report'
            },
            {
                extend: 'print',
                footer:true,
                title: 'Report'
            },

       ],
            });
</script>





  
  <footer class="main-footer no-print">

    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0V
    </div>
    <strong>Copyright &copy; 2020-2021 <a href="http://www.pabitragroups.com">PABITRA GROUPS Pvt. Ltd.</a> </strong> All rights
    reserved.
  </footer>

    
</body>
</html>
