@extends('layouts.hr')

@section('content')
   @if(Session::has('msg'))
   <p class="alert alert-info text-center">{{ Session::get('msg') }}</p>
   @endif

   @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div><br />
      @endif
  <form action="/saveuser" method="post">
    {{csrf_field()}}
    <table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">ADD A NEW USER</td>
        </tr>
        <tr>
            <td>FULL NAME<span style="color: red"> *</span></td>
            <td colspan="2"><input type="text" class="form-control" autocomplete="off" name="name" placeholder="ENTER NAME" required></td>
        </tr>

        <tr>
            <td>USER NAME<span style="color: red"> *</span></td>
            <td colspan="2"><input type="text" class="form-control" autocomplete="off" name="username" placeholder="ENTER USER NAME" required></td>
        </tr>
          <tr>
            <td>EMAIL</td>
            <td colspan="2"><input type="email" class="form-control" autocomplete="off" name="email" placeholder="ENTER EMAIL ID" ></td>

          </tr>
          <tr>
            <td>MOBILE<span style="color: red"> *</span></td>
            <td colspan="2"><input type="number" class="form-control" autocomplete="off" name="mobile" placeholder="ENTER MOBILE" ></td>
          </tr>
          <tr>
            <td>DESIGNATION<span style="color: red"> *</span></td>
            <td colspan="2">
              <input type="text" name="designation" placeholder="Enter User Designation" class="form-control">
            </td>
          </tr>
          <tr>
            <td>PASSWORD<span style="color: red"> *</span></td>
            <td><input type="text" class="form-control" autocomplete="off" id="pass" name="userpassword" placeholder="ENTER PASSWORD" required></td>
            <td><button type="button" onclick="generatepassword();" class="btn btn-info">Generate a Password</button></td>
          </tr>
          <tr>
              <td>USER TYPE<span style="color: red"> *</span></td>
            <td colspan="2">
              <select name="usertype" class="form-control" required>
                 
                  <option value="USER" selected>USER</option>
                 
              </select>
            </td>
          </tr>

          

              <tr style="display: none;">
              <td>ASSIGN A ACTIVITY<span style="color: red"> *</span></td>
            <td colspan="2">
              <select name="activityassigned" class="form-control" >
                  <option value="">Select</option>
                   @foreach($activities as $activity)
                    <option value="{{$activity->id}}" title="{{$activity->description}}">{{$activity->activityname}}</option>
                   @endforeach
              </select>
            </td>
          </tr>

        
        <tr>
            <td></td>
<td colspan="3"><input type="submit" value="Submit" class="btn btn-success" style="float: right ;"></td>
</tr>
</table>
</form>
@if($users)
<div class="box">
<div class="box-body">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
    <thead>
        <tr class="bg-navy">
            <th>ID</th>
            <th>NAME</th>
            <th>USER NAME</th>
            <th>EMAIL</th>
            <th>MOBILE</th>
            <th>PASSWORD</th>
            <th>USER TYPE</th>
           <!--  <th>ASSIGNED ACTIVITY</th> -->
            <th>DESIGNATION</th>
            <th>EDIT</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
         <tr>
             <td>{{$user->id}}</td>
             <td>{{$user->name}}</td>
             <td>{{$user->username}}</td>
             <td>{{$user->email}}</td>
             <td>{{$user->mobile}}</td>
             <td>{{$user->pass}}</td>
             <td>{{$user->usertype}}</td>
             <!-- <td>{{$user->activityname}}</td> -->
             <td>{{$user->designation}}</td>
              @if($user->usertype!='MASTER ADMIN')
             <td><button onclick="edituser('{{$user->id}}','{{$user->name}}','{{$user->email}}','{{$user->mobile}}','{{$user->pass}}','{{$user->usertype}}','{{$user->activityassigned}}','{{$user->designation}}','{{$user->username}}')" class="btn btn-info">EDIT</button></td>
           
              @else

              <td><button type="button" disabled class="btn btn-info">EDIT</button></td>
              @endif
               
           

         </tr>

        @endforeach
    </tbody>
</table>
</div>
</div>
@endif

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>EDIT USER</b></h4>
      </div>
      <div class="modal-body">
          <form action="/hrupdateuser" method="post">
    {{csrf_field()}}
    <table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">EDIT USER</td>
        </tr>
        <input type="hidden" name="uid" id="uid">
        <tr>
            <td>FULL NAME<span style="color: red"> *</span></td>
            <td colspan="2"><input type="text" class="form-control" autocomplete="off" id="name" name="name" placeholder="ENTER NAME" required></td>
        </tr>
         <tr>
            <td>USER NAME<span style="color: red"> *</span></td>
            <td colspan="2"><input type="text" class="form-control" autocomplete="off" id="username" name="username" placeholder="ENTER NAME" required></td>
        </tr>
          <tr>
            <td>EMAIL<span style="color: red"> *</span></td>
            <td colspan="2"><input type="email" class="form-control" autocomplete="off" id="email" name="email" placeholder="ENTER EMAIL ID" required></td>

          </tr>
          <tr>
            <td>MOBILE<span style="color: red"> *</span></td>
            <td colspan="2"><input type="number" class="form-control" autocomplete="off" id="mobile" name="mobile" placeholder="ENTER MOBILE" ></td>
          </tr>
            <tr>
            <td>DESIGNATION<span style="color: red"> *</span></td>
            <td>
              <input type="text" name="designation" id="designation" class="form-control">
            </td>
          </tr>
          <tr>
            <td>PASSWORD<span style="color: red"> *</span></td>
            <td><input type="text" class="form-control" autocomplete="off" id="pass1" name="userpassword" placeholder="ENTER PASSWORD" required></td>
            <td><button type="button" onclick="generatepassword1();" class="btn btn-info">Generate a Password</button></td>
          </tr>
        
          <tr>
              <td>USER TYPE<span style="color: red"> *</span></td>
            <td colspan="2">
              <select name="usertype" id="usertype" class="form-control"  required>
              
                  <option value="USER">USER</option>
                  
              </select>
            </td>
          </tr>

   

        
        <tr>
            <td></td>
<td colspan="3"><input type="submit" value="Submit" class="btn btn-success" style="float: right ;"></td>
</tr>
</table>
</form>

  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">

    function generatepassword()
    {
          var randPassword = Array(6).fill("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ").map(function(x) { return x[Math.floor(Math.random() * x.length)] }).join('');
          $("#pass").val(randPassword);
    }

        function generatepassword1()
    {
          var randPassword = Array(6).fill("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ").map(function(x) { return x[Math.floor(Math.random() * x.length)] }).join('');
          $("#pass1").val(randPassword);
    }

    function edituser(id,name,email,mobile,pass,usertype,activityassigned,designation,username)
    {
        
        $("#uid").val(id);
        $("#name").val(name);
        $("#email").val(email);
        $("#mobile").val(mobile);
        $("#pass1").val(pass);
        $("#designation").val(designation);
        $("#username").val(username);
        $('#usertype option[value="'+usertype+'"]').attr("selected", "selected");
        //$('#activityassigned option[value="'+activityassigned+'"]').attr("selected", "selected");
        $("#myModal").modal('show');

    }
    
</script>

@endsection