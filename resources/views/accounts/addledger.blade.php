@extends('layouts.account')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">ADD LEDGER</td>
	</tr>
</table>
  @if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
   @endif
   @if(Session::has('err'))
   <p class="alert alert-danger text-center">{{ Session::get('err') }}</p>
   @endif
<div class="well">
	<form action="/saveaddledger" method="post" enctype="multipart/form-data"> 
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
        <td><strong>TYPE *</strong></td>
        <td>
          <select class="form-control" name="type" required="">
          	<option value="">--Select Type--</option>
            <option value="CR">CR</option>
            <option value="DR">DR</option>
          </select>
        </td>
      </tr>
      <tr>
	  	<td><strong>DATE</strong></td>
	  	<td><input type="text" name="date" class="datepicker form-control" placeholder=""></td>
	  </tr>
	  <tr>
	  	<td><strong>AMOUNT</strong></td>
	  	<td><input type="text" name="amount" class="form-control" placeholder="Enter Amount"></td>
	  </tr>
	  <tr>
	  	<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit" onclick="return confirm('Do You want to save ?')">SUBMIT</button></td>
	  </tr>

</table>
</form>
</div>

@endsection