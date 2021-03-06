<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@if(Auth::user()->usertype=='USER')
<script type="text/javascript">
    location.replace('/400');
</script>
@elseif(Auth::user()->usertype=='ADMIN')
<script type="text/javascript">
    location.replace('/400');
</script>


@endif
<style type="text/css">
  h1{font-size: 16px !important;}
  .content{
    padding:5px !important;
  }
</style>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>PMS-MONITORS</title>

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
      <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css')}}">
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
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
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
      <span class="logo-lg"><b>PMS-MONITORS</b></span>
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
          <a  onclick="window.history.back();">
            <p style="font-size: 20px;"><i class="fa fa-arrow-circle-left"></i> Back</p>
          </a>
        </li>
      </ul>
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

         <li class="dropdown user user-menu" style="margin-top: 5px;">
            <a href="#"  data-toggle="modal" data-target="#resetpassword" class="btn bg-navy btn-flat">
              Reset Password
            </a>
        </li>
           
          <li class="dropdown user user-menu" style="margin-top: 5px;padding-left: 10px;padding-right: 10px;">
      
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
        <li class="header"><strong class="text-center">HR NAVIGATION</strong></li>
      
    
 @if(Auth::user()->usertype=='MASTER ADMIN' ||Auth::user()->usertype=='HR')
           <li class="{{ Request::is('adminhr') ? 'active' : '' }} treeview">
          <a href="/adminhr">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>
          </li>
          <li class="{{ Request::is('dm*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>DEFINE MAIN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('dm/addleavetype') ? 'active' : '' }}"><a href="/dm/addleavetype"><i class="fa fa-circle-o text-aqua"></i>ADD Leave Type</a></li>
             
          </ul>
          <ul class="treeview-menu">
            <li class="{{ Request::is('dm/addsalarydecuction') ? 'active' : '' }}"><a href="/dm/addsalarydecuction"><i class="fa fa-circle-o text-aqua"></i>ADD Salary Deduction</a></li>
             
          </ul>
        </li>
        <li class="{{ Request::is('leave*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>LEAVE MANAGEMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('leave/applyleave') ? 'active' : '' }}"><a href="/leave/applyleave"><i class="fa fa-circle-o text-aqua"></i>APPLY LEAVE</a></li>
          </ul>
          <ul class="treeview-menu">
             <li class="{{ Request::is('leave/viewpendingleves') ? 'active' : '' }}"><a href="/leave/viewpendingleves"><i class="fa fa-circle-o text-aqua"></i>VIEW PENDING APPROVAL</a></li>
          </ul>
          <ul class="treeview-menu">
             <li class="{{ Request::is('leave/viewalleave') ? 'active' : '' }}"><a href="/leave/viewalleave"><i class="fa fa-circle-o text-aqua"></i>VIEW ALL LEAVES</a></li>
          </ul>
        </li>
        <li class="{{ Request::is('attendance*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>DAILY ATTENDANCE GROUPS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
            
            <li class="{{ Request::is('attendance/addgroup') ? 'active' : '' }}"><a href="/attendance/addgroup"><i class="fa fa-circle-o text-aqua"></i>ADD GROUPS</a></li>
             
          </ul>
          <ul class="treeview-menu">
             <li class="{{ Request::is('attendance/adddailyattendance') ? 'active' : '' }}"><a href="/attendance/adddailyattendance"><i class="fa fa-circle-o text-aqua"></i>DAILY ATTENANCE GROUPS</a></li>
          </ul>
           <ul class="treeview-menu">
             <li class="{{ Request::is('attendance/viewallattendance') ? 'active' : '' }}"><a href="/attendance/viewallattendance"><i class="fa fa-circle-o text-aqua"></i>VIEW ATTENANCE GROUPS</a></li>
          </ul>
        </li>
      @if(Auth::user()->usertype=='MASTER ADMIN' ||Auth::user()->usertype=='HR')
        <li class="{{ Request::is('empattendance*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>DAILY ATTENDANCE EMPLOYEE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
            
            <li class="{{ Request::is('empattendance/addempgroup') ? 'active' : '' }}"><a href="/empattendance/addempgroup"><i class="fa fa-circle-o text-aqua"></i>ADD EMPLOYEE GROUPS</a></li>
             
          </ul>
          <ul class="treeview-menu">
             <li class="{{ Request::is('empattendance/adddailyempattendance') ? 'active' : '' }}"><a href="/empattendance/adddailyempattendance"><i class="fa fa-circle-o text-aqua"></i>DAILY ATTENANCE EMPLOYEES</a></li>
          </ul>
          <ul class="treeview-menu">
             <li class="{{ Request::is('empattendance/viewattendanceemployee') ? 'active' : '' }}"><a href="/empattendance/viewattendanceemployee"><i class="fa fa-circle-o text-aqua"></i>VIEW ATTENANCE EMPLOYEES</a></li>
          </ul>
           <ul class="treeview-menu">
             <li class="{{ Request::is('empattendance/viewallempattendance') ? 'active' : '' }}"><a href="/empattendance/viewallempattendance"><i class="fa fa-circle-o text-aqua"></i>VIEW MONTHLY ATTENANCE</a></li>
          </ul>
          <ul class="treeview-menu">
             <li class="{{ Request::is('empattendance/viewemployeepayslip') ? 'active' : '' }}"><a href="/empattendance/viewemployeepayslip"><i class="fa fa-circle-o text-aqua"></i>VIEW EMPLOYEE PAYSLIP</a></li>
          </ul>
        </li>
        @endif
       <li class="{{ Request::is('hrmain*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>EMPLOYEE MANAGEMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('hrmain/employeelist') ? 'active' : '' }}"><a href="/hrmain/employeelist"><i class="fa fa-circle-o text-aqua"></i>Employee Database</a></li>
          </ul>
        </li>
        <li class="{{ Request::is('attendance*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>ATTENDANCE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('attendance/viewattendance') ? 'active' : '' }}"><a href="/attendance/viewattendance"><i class="fa fa-circle-o text-red"></i>VIEW ATTENDANCE</a></li>

             <li class="{{ Request::is('attendance/attendancereport') ? 'active' : '' }}"><a href="/attendance/attendancereport"><i class="fa fa-circle-o text-red"></i>ATTENDANCE REPORT</a></li>

             <li class="{{ Request::is('attendance/mapview') ? 'active' : '' }}"><a href="/attendance/mapview"><i class="fa fa-circle-o text-red"></i>MAP VIEW</a></li>
          </ul>
     </li>
        
        <li class="{{ Request::is('notices*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-bell"></i> <span>NOTICES</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('notices/createnotice') ? 'active' : '' }}"><a href="/notices/createnotice"><i class="fa fa-circle-o text-red"></i>CREATE A NOTICE</a></li>
             <li class="{{ Request::is('notices/viewallnotice') ? 'active' : '' }}"><a href="/notices/viewallnotice"><i class="fa fa-circle-o text-red"></i>VIEW ALL NOTICE</a></li>
             
            
          </ul>
      </li>
      <li class="{{ Request::is('documents*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>DOCUMENTS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('documents/adddocuments') ? 'active' : '' }}"><a href="/documents/adddocuments"><i class="fa fa-circle-o text-red"></i>ADD DOCUMENTS</a></li>
            
             
            
          </ul>
      </li>
       <li class="{{ Request::is('usermsg*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>MESSAGE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
         
              <span class="label label-danger pull-right" id="countmsg"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li class="{{ Request::is('usermsg/writemsg') ? 'active' : '' }}"><a href="/usermsg/writemsg"><i class="fa fa-circle-o text-red"></i>SEND A MESSAGE</a></li> -->

            <li class="{{ Request::is('usermsg/mymessages') ? 'active' : '' }}"><a href="/usermsg/mymessages"><i class="fa fa-circle-o text-red"></i>MESSAGES</a></li>
            
           

          </ul>
</li>

@endif

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
               PMS-MONITORS 1.0V HR
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

<div class="modal fade " id="resetpassword" role="dialog">
        <div class="modal-dialog ">
        
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-maroon">

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center"> Reset Password</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form" method="POST" action="/resetpassword">
                    {{ csrf_field() }}

                  <table class="table table-responsive table-hover table-bordered">
                    <tr>
                    <td>CURRENT PASSWORD</td>
                    <td><input class="form-control" id="currentpassword" type="password" name="currentpassword" placeholder="Enter Current Password" required autocomplete="off"></td>
                    </tr>
                    <tr>
                    <td>NEW PASSWORD</td>
                    <td><input class="form-control" id="password" type="password" name="password" placeholder="Enter New Password" required autocomplete="off"></td>
                    </tr>
                    <tr>
                    <td>CONFIRM PASSWORD</td>
                    <td><input class="form-control" id="confirm_password" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="off"><span id='message'></span></td>
                    </tr>
                    <tr><td colspan="2">  <span id='result'><button class="btn bg-green pull-right" type="submit" disabled>RESET NOW
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

  window.onpageshow = function(event) {
if (event.persisted) {
    window.location.reload() 
}
};
  $(".readonly").keydown(function(e){
        e.preventDefault();
    });

  $('.date-picker10').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        format: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
$(".attfromdate").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       maxDate: 0,
       maxDate: new Date()
      
       });
$(".atttodate").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       maxDate: 0,
       });
$(".datepicker").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       yearRange: "-100:+0",
       setDate: 0
       });

      $('.datatable1').DataTable({
        dom: 'Bfrtip',
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
       "scrollY": 450,
        
            });

$('.datatablescrollexport').DataTable({
        dom: 'Bfrtip',
        //"order": [[ 0, "desc" ]],
        "iDisplayLength": 5,
        "scrollY": 450,
        "scrollX": true,
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

      $('.select2').select2({dropdownCssClass : 'bigdrop'});
      $( ".addnewrow" ).sortable();





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

var jqf = $.noConflict();

  jqf('#password, #confirm_password,#currentpassword').on('keyup', function () {
  if ((jqf('#password').val() == jqf('#confirm_password').val())&& jqf('#currentpassword').val()!='')  {
    jqf('#result').html('<button class="btn bg-green pull-right" type="submit">RESET NOW</button>');
  } else 
    jqf('#result').html('<button class="btn bg-green pull-right" hidden type="submit" disabled >RESET NOW</button>');
});

  $('.datatable').DataTable({
      "iDisplayLength": 10,
     "order": [[ 0, "desc" ]],
  });  
  
  $('.datatable3').DataTable({
      "iDisplayLength": 5,
     "order": [[ 0, "desc" ]],
  });
  
  $('.datatablescroll').DataTable({

     "order": [[ 0, "desc" ]],
     "scrollY": 500,
     "scrollX": true,
     "iDisplayLength": 25,
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
