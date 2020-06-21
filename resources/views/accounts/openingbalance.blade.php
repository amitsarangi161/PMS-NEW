@extends('layouts.account')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">OPENING BALANCE</td>
	</tr>
</table>
 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <p class="alert alert-danger text-center">{{ $error }}</p>
     @endforeach
 @endif
  @if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
   @endif
   @if(Session::has('err'))
   <p class="alert alert-danger text-center">{{ Session::get('err') }}</p>
   @endif
<div class="well">
	<form action="/saveopeningbalance" method="post" enctype="multipart/form-data"> 
		{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
	  <tr>
	  	<td>
	  		<strong>SELECT A BANK</strong>
	  	</td>
	  	<td>
	  		<select class="form-control select2" name="bankid" required="">

	  			<option value="">Select a Bank</option>
	  			@foreach($banks as $bank)
                   <option value="{{$bank->id}}">{{$bank->bankname}}/{{$bank->accountholdername}}/{{$bank->acno}}/{{$bank-> ifsccode}}</option>

	  			@endforeach
	  			
	  		</select>
	  	</td>
	  </tr>
	  <tr>
	  	<td><strong>DATE</strong></td>
	  	<td><input type="text" name="date" class="datepicker form-control" placeholder="" autocomplete="off" required=""></td>
	  </tr>
	  <tr>
	  	<td><strong>AMOUNT</strong></td>
	  	<td><input type="text" name="amount" class="form-control" placeholder="Enter Amount" required=""></td>
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
			<td>BANK NAME</td>
			<td>DATE</td>
			<td>AMOUNT</td>
		</tr>
		
	</thead>
	<tbody>
		
			@foreach($openingbalances as $key=>$openingbalance)
			<tr>
			<td>{{$key+1}}</td>
			<td>{{$openingbalance->bankname}}/{{$openingbalance->acno}}/{{$openingbalance->accountholdername}}/{{$openingbalance->ifsccode}}</td>
			<td>{{$openingbalance->date}}</td>
			<td>{{$openingbalance->amount}}</td>
			</tr>
			@endforeach	
	</tbody>
</table>

@endsection