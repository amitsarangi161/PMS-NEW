@extends('layouts.app')
@section('content')

@php
if($smssettings){
$username=$smssettings->username;
$id=$smssettings->id;
$password=$smssettings->password;
$vouchermessage=$smssettings->vouchermessage;
$requisitionmessage=$smssettings->requisitionmessage;
$debitvoucher=$smssettings->debitvoucher;
$status=$smssettings->status;
$mobile=$smssettings->mobile;
$value="Update";
}
else{
$username='';
$id='';
$password='';
$vouchermessage='';
$requisitionmessage='';
$debitvoucher='';
$status='';
$mobile='';
$value="Save";
}

@endphp

<table class="table">
	<tr class="bg-navy">
		<td class="text-center">SMS SETTING</td>
		
		
	</tr>
</table>

@if(Session::has('msg'))
<div class="alert alert-success alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <p style="text-align: center;"><strong>{{ Session::get('msg') }}</strong></p>

</div>
@endif


<form action="/savesmssetting" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}

<table class="table table-responsive table-hover table-bordered table-striped">
<tr>

	<td><strong>User Name *</strong></td>
	<td>
		<input type="text" name="username" value="{{$username}}" class="form-control" placeholder="Enter Name" >
	</td>
	<td><strong>Password *</strong></td>
	<td>
		<input type="text" name="password" value="{{$password}}" class="form-control" placeholder="Enter Password" >
	</td>
</tr>
<tr>
		<td><strong>Message</strong></td>
		<td>
			<textarea class="form-control" id="vouchermessage" placeholder="Voucher Message" name="vouchermessage">{{$vouchermessage}}</textarea>
		</td>
		<td><strong>Message</strong></td>
		<td>
			<textarea class="form-control" placeholder="Requisition Message" id="requisitionmessage" name="requisitionmessage">{{$requisitionmessage}}</textarea>
		</td>
</tr>

<tr>
	<td><strong>Message</strong></td>
		<td>
			<textarea class="form-control" placeholder="Debit Voucher Message" id="debitvoucher" name="debitvoucher">{{$debitvoucher}}</textarea>
		</td>
	<td><strong>ON/OFF</strong></td>
	<td>
		<input type="radio" value="1" name="status" {{($status=='1')? 'checked':''}}><strong>ON</strong>
		<input type="radio" value="0" name="status" {{($status=='0')? 'checked':''}}><strong>OFF</strong>
	
	</td>
	
</tr>
<tr>

	<td><strong>Mobile Number *</strong></td>
	<td>
		<input type="text" name="mobile" value="{{$mobile}}" class="form-control" placeholder="Example :918776543500,918958865852 " >
	</td>
	
</tr>

	
</table>

<table class="table">
			<input type="hidden"  name="id"  value="{{$id}}">
			<tr>
				<td class="text-right"><button type="submit" class="btn btn-success btn-lg" style="width: 100px;" onclick="return confirm('Do You Want to Save this ?')">{{$value}}</button>

				</td>
			</tr>
			
	</table>
</form>



@endsection