@extends('layouts.app')

@section('content')
   @if(Session::has('msg'))
   <p class="alert alert-success text-center successmsg">{{ Session::get('msg') }}</p>
   @endif

   @if ($errors->any())
          <div class="alert alert-danger errormessage">
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
            <td>MOBILE</td>
            <td colspan="2"><input type="number" class="form-control" autocomplete="off" name="mobile" placeholder="ENTER MOBILE" ></td>
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
                  <option value="" selected>Select</option>
                  <option value="USER">USER</option>
                  <option value="MASTER ADMIN">MASTER ADMIN</option>
                  <option value="ADMIN">ADMIN</option>
                  <option value="HR">HR</option>
                  <option value="MD">MD</option>
                  <option value="USER">USER</option>
                  <option value="ACCOUNTS">ACCOUNTS</option>
                  <option value="ACCOUNTS ENTRY">ACCOUNTS ENTRY</option>
                  <option value="CASHIER">CASHIER</option>
                  <option value="INVENTORY">INVENTORY</option>
                  <option value="MANAGER">MANAGER</option>
                  <option value="TENDER">TENDER</option>
                  <option value="LABOUR">LABOUR</option>
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
  <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable1" width="100%">
    <thead>
        <tr class="bg-navy" style="font-size: 10px;">
            <th>ID</th>
            <th>NAME</th>
            <th>USER NAME</th>
            <th>EMAIL</th>
            <th>MOBILE</th>
            <th>PASSWORD</th>
            <th>USER TYPE</th>
            <th>ACTIVE</th>
            <th>EDIT</th>
            <!-- <th>DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
         <tr style="font-size: 12px;">
             <td>{{$user->id}}</td>
             <td>{{$user->name}}</td>
             <td>{{$user->username}}</td>
             <td>{{$user->email}}</td>
             <td>{{$user->mobile}}</td>
             <td>{{$user->pass}}</td>
             <td>{{$user->usertype}}</td>
             @if($user->active=='1')
              <td><span class="label label-success" ondblclick="callmodals('{{$user->id}}')">ACTIVE</span></td>
             @else
               <td><span class="label label-danger" ondblclick="callmodals('{{$user->id}}')">INACTIVE</span></td>
             @endif
             <td><button onclick="edituser('{{$user->id}}','{{$user->name}}','{{$user->email}}','{{$user->mobile}}','{{$user->pass}}','{{$user->usertype}}','{{$user->username}}')" class="btn btn-info">EDIT</button></td>
         </tr>

        @endforeach
    </tbody>
</table>
</div>
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
          <form action="/updateuser" method="post">
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
            <td>EMAIL</td>
            <td colspan="2"><input type="email" class="form-control" autocomplete="off" id="email" name="email" placeholder="ENTER EMAIL ID"></td>

          </tr>
          <tr>
            <td>MOBILE</td>
            <td colspan="2"><input type="number" class="form-control" autocomplete="off" id="mobile" name="mobile" placeholder="ENTER MOBILE" ></td>
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
                  <option value="">--Select--</option>
                  <option value="MASTER ADMIN">MASTER ADMIN</option>
                  <option value="ADMIN">ADMIN</option>
                  <option value="HR">HR</option>
                  <option value="MD">MD</option>
                  <option value="USER">USER</option>
                  <option value="ACCOUNTS">ACCOUNTS</option>
                  <option value="ACCOUNTS ENTRY">ACCOUNTS ENTRY</option>
                  <option value="CASHIER">CASHIER</option>
                  <option value="INVENTORY">INVENTORY</option>
                  <option value="MANAGER">MANAGER</option>
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


<div class="modal fade" id="activemodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Status</h4>
        </div>
        <div class="modal-body">
            <table class="table">
              <form action="/changeuserstatus" method="post">
                {{csrf_field()}}
                <input type="hidden" name="chid" id="chid">
                 <tr>
                   <td>Select a Status</td>
                   <td>
                     <select name="status" class="form-control" required="">
                       <option value="">Select a Status</option>
                       <option value="1">ACTIVE</option>
                       <option value="0">INACTIVE</option>
                       
                     </select>
                   </td>
                   <td>
                     <button class="btn btn-primary" type="submit">CHANGE</button>
                   </td>
                 </tr>
                
              </form>
              
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
 $('.successmsg').delay(5000).fadeOut(1000);
 $('.errormessage').delay(10000).fadeOut(1000);
   function callmodals(id)
   {
       $("#chid").val(id);
       $("#activemodal").modal('show');

   }

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

    function edituser(id,name,email,mobile,pass,usertype,username)
    {
        
        $("#uid").val(id);
        $("#name").val(name);
        $("#email").val(email);
        $("#mobile").val(mobile);
        $("#pass1").val(pass);
        $("#username").val(username);
        $('#usertype option[value="'+usertype+'"]').attr("selected", "selected");
        //$('#activityassigned option[value="'+activityassigned+'"]').attr("selected", "selected");
        $("#myModal").modal('show');

    }
    
</script>

@endsection