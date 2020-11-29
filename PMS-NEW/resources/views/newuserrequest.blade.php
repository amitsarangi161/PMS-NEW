@extends('layouts.app')

@section('content')
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
            <th>ACTION</th>
            <th>DELETE</th>
         
        </tr>
    </thead>
    <tbody>
    	@foreach($userrequests as $userrequest)
          <tr>
          	<td>{{$userrequest->id}}</td>
          	<td>{{$userrequest->name}}</td>
          	<td>{{$userrequest->username}}</td>
          	<td>{{$userrequest->email}}</td>
          	<td>{{$userrequest->mobile}}</td>
          	<td>{{$userrequest->pass}}</td>
          	<td>{{$userrequest->usertype}}</td>
          	<td><button type="button" class="btn btn-success" onclick="openapprove('{{$userrequest->id}}','{{$userrequest->name}}','{{$userrequest->username}}','{{$userrequest->email}}','{{$userrequest->mobile}}','{{$userrequest->pass}}','{{$userrequest->usertype}}');">APPROVE</button></td>
            <td><a href="/deleterequest/{{$userrequest->id}}" class="btn btn-danger" onclick="return confirm('Do You Want to Delete this request?');">Cancel</a></td>
          </tr>

    	@endforeach
    	
    </tbody>

</table>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>APPROVE USER</b></h4>
      </div>
      <div class="modal-body">
          <form action="/adminapproverequest" method="post">
    {{csrf_field()}}
    <table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">APPROVE USER</td>
        </tr>
        <input type="hidden" name="uid" id="uid">
        <tr>
            <td>FULL NAME<span style="color: red"> *</span></td>
            <td colspan="2"><input type="text" class="form-control" autocomplete="off" id="name" name="name" placeholder="ENTER NAME" required></td>
        </tr>
         <tr>
            <td>USER NAME<span style="color: red"> *</span></td>
            <td colspan="2"><input type="text" class="form-control" autocomplete="off" id="username" name="username" placeholder="Enter User Name" required></td>
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
            <td>DESIGNATION<span style="color: red"> *</span></td>
            <td colspan="2">
              <input type="text" name="designation" id="designation" class="form-control">
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
	  function generatepassword1()
      {
          var randPassword = Array(6).fill("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ").map(function(x) { return x[Math.floor(Math.random() * x.length)] }).join('');
          $("#pass1").val(randPassword);
      }
	function openapprove(id,name,username,email,mobile,pass)
	{
        $("#uid").val(id);
        $("#name").val(name);
        $("#email").val(email);
        $("#mobile").val(mobile);
        $("#pass1").val(pass);
        $("#username").val(username);
        $('#usertype option[value="'+usertype+'"]').attr("selected", "selected");

        $("#myModal").modal('show');
	}
</script>


@endsection