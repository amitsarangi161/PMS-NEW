@extends('layouts.account')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">ADD LEDGER</td>
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
	<form action="/saveaddledger" name="ledgerform" method="post" enctype="multipart/form-data"> 
		{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
	  <tr>
	  	<td><strong>LEDGER ENTRY FOR DATE</strong></td>
	  	<td><input type="text" class="form-control" value="{{date('Y-m-d')}}" readonly=""></td>
	  </tr>
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
	  	<td><strong>Credited Amount</strong></td>
	  	<td><input type="text" name="cr" class="form-control" placeholder="Enter Credited Amount" value="0" required="" autocomplete="off" id="cr1"></td>
	  </tr>
	  <tr>
	  	<td><strong>Debited Amount</strong></td>
	  	<td><input type="text" name="dr" value="0" class="form-control" placeholder="Enter Debited Amount" required="" autocomplete="off" id="dr1"></td>
	  </tr>

	  <tr>
	  	<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit" id="submitbutton" onclick="return confirm('Do You want to save ?')">SUBMIT</button></td>
	  </tr>

</table>
</form>
</div>

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy">
			<td>SL_NO</td>
			<td>ACCOUNT HOLDER NAME</td>
			<td>Bank Name</td>
			<td>Ac No.</td>
			<td>CR</td>
			<td>DR</td>
			<td>DATE</td>
			<td>Created At</td>
		</tr>
		
	</thead>
	<tbody>
		
			@foreach($ledgers as $key=>$ledger)
			<tr>
			<td>{{$ledger->id}}</td>
			<td>{{$ledger->accountholdername}}</td>
			<td>{{$ledger->bankname}}</td>
			<td>{{$ledger->acno}}</td>
			<td>{{$ledger->cr}}</td>
			<td>{{$ledger->dr}}</td>
			<td>{{$ledger->date}}</td>
			<td>{{$ledger->created_at}}</td>
			</tr>
			@endforeach	
	</tbody>
</table>

@endsection