@extends('layouts.account')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">USER BANK ACCOUNTS</td>
	</tr>
</table>
  @if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
   @endif
<div class="well">
	<form action="/saveuesrbankaccount" method="post" enctype="multipart/form-data"> 
		{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">

	   	  <tr>
	   	  	<td><strong>SELECT A USER</strong></td>
	   	  	<td>
	   	  		<select class="form-control select2" name="user" required="">

	  			<option value="">Select a User</option>
	  			@foreach($users as $user)
                   <option value="{{$user->id}}">{{$user->name}}</option>

	  			@endforeach
	  			
	  		    </select>
	   	  	</td>
	   	  </tr>
	  <tr>
	  	<td>
	  		<strong>SELECT A BANK</strong>
	  	</td>
	  	<td>
	  		<select class="form-control select2" name="bankid" required="">

	  			<option value="">Select a Bank</option>
	  			@foreach($banks as $bank)
                   <option value="{{$bank->id}}">{{$bank->bankname}}</option>

	  			@endforeach
	  			
	  		</select>
	  	</td>
	  </tr>
	  <tr>
	  	<td><strong>ACCOUNT NO</strong></td>
	  	<td><input type="number" name="acno" class="form-control" placeholder="Enter Acount No"></td>
	  </tr>
	  <tr>
	  	<td><strong>BRANCH NAME</strong></td>
	  	<td><input type="text" name="branchname" class="form-control" placeholder="Enter Branch Name"></td>
	  </tr>
	  <tr>
	  	<td><strong>IFSC CODE</strong></td>
	  	<td>
	  		<input type="text" name="ifsccode" class="form-control" placeholder="Enter ifsccode" required="">
	  	</td>
	  </tr>
	   	<tr>
	  		<td><strong>Scan Copy Of Account</strong></td>
	  		<td>
	  			 	<input name="scancopy" type="file" onchange="readURL1(this);">
                     <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow1">
	  		</td>
	  	</tr>
	  <tr>
	  	<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">SUBMIT</button></td>
	  </tr>

</table>
</form>
</div>


<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy">
			<td>SL_NO</td>
			<td>NAME</td>
			<td>BANK NAME</td>
			<td>BRANCH NAME</td>
			<td>ACCOUNT NO</td>
			<td>IFSC</td>
			<td>ACCOUNT SCAN COPY</td>
			<td>EDIT</td>
			
			
		</tr>
		
	</thead>
	<tbody>
		
			@foreach($useraccounts as $key=>$useraccount)
			<tr>
			<td>{{$key+1}}</td>
			<td>{{$useraccount->name}}</td>
			<td>{{$useraccount->bankname}}</td>
			<td>{{$useraccount->branchname}}</td>
			<td>{{$useraccount->acno}}</td>
			<td>{{$useraccount->ifsccode}}</td>
			<td><a href="{{asset('/img/bankacscancopy/'.$useraccount->scancopy)}}" target="_blank"><img src="{{asset('/img/bankacscancopy/'.$useraccount->scancopy)}}" style="height:70px;width:95px;"></a></td>

			<td>
				<button class="btn btn-info" onclick="edituseraccount('{{$useraccount->id}}','{{$useraccount->user}}','{{$useraccount->bankid}}','{{$useraccount->branchname}}','{{$useraccount->acno}}','{{$useraccount->ifsccode}}','{{$useraccount->name}}','{{$useraccount->scancopy}}');" type="button">EDIT</button>
			</td>
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
        <h4 class="modal-title"><b>EDIT USER</b></h4>
      </div>
      <div class="modal-body">

    <form action="/updateuserbankaccount" method="post" enctype="multipart/form-data"> 
		{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
<input type="hidden" id="uid" name="uid">
<input type="hidden" id="usid" name="user">
	   	  <tr>
	   	  	<td><strong>SELECT A USER</strong></td>
	   	  	<td>
	   	  		<input type="text"  id="user1" class="form-control" readonly="">
	   	  	</td>
	   	  </tr>
	  <tr>
	  	<td>
	  		<strong>SELECT A BANK</strong>
	  	</td>
	  	<td>
	  		<select class="form-control" name="bankid" id="bankid" required="">

	  			<option value="">Select a Bank</option>
	  			@foreach($banks as $bank)
                   <option value="{{$bank->id}}">{{$bank->bankname}}</option>

	  			@endforeach
	  			
	  		</select>
	  	</td>
	  </tr>
	  <tr>
	  	<td><strong>ACCOUNT NO</strong></td>
	  	<td><input type="number" name="acno" id="acno" class="form-control" placeholder="Enter Acount No"></td>
	  </tr>
	  <tr>
	  	<td><strong>BRANCH NAME</strong></td>
	  	<td><input type="text" name="branchname" id="branchname" class="form-control" placeholder="Enter Branch Name"></td>
	  </tr>
	  <tr>
	  	<td><strong>IFSC CODE</strong></td>
	  	<td>
	  		<input type="text" name="ifsccode" id="ifsccode" class="form-control" placeholder="Enter ifsccode" required="">
	  	</td>
	  </tr>
	  	<tr>
	  		<td><strong>Scan Copy Of Account</strong></td>
	  		<td>
	  			 	<input name="scancopy" type="file"  onchange="readURL(this);">
                     <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow">
	  		</td>
	  	</tr>
	  <tr>
	  	<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">UPDATE</button></td>
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
	function edituseraccount(id,user,bankid,branchname,acno,ifsccode,name,scancopy) {
		 
		$('#user1').val(name);
		$('#usid').val(user);
		$('#bankid option[value="'+bankid+'"]').attr("selected", "selected");
		$("#branchname").val(branchname);
		$("#acno").val(acno);
		$("#ifsccode").val(ifsccode);
		$("#uid").val(id);
		$("#imgshow").attr('src', '/img/bankacscancopy/'+scancopy)
                    .width(95)
                    .height(70);

		$("#myModal").modal('show');
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
</script>
@endsection