@extends('layouts.app')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<style type="text/css">
	    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">VIEW CREDIT VOUCHER</td>
		
	</tr>
	
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-blue">
		<td>ID</td>
		<td>INVOICE NO</td>
		<td>CLIENT NAME</td>
		

	    <td>WORK NAME</td>
	    <td>TOTAL AMOUNT</td>
	    <td>TOTAL PAYABLE</td>
	    <td>ADVANCE RECIVED</td>
	    <td>NET PAYABLE</td>
	    <td>CREATED_AT</td>
	    <td>STATUS</td>
	    <td>REMARKS</td>
        <td>EDIT</td>
	    <td>PRINT/VIEW</td>
	</tr>
	</thead>
	<tbody>
		@foreach($bills as $bill)
		<tr>
		<td><a href="/printbill/{{$bill->id}}" target="_blank" class="btn btn-success">{{$bill->id}}</a></td>
		<td>{{$bill->fullinvno}}</td>
		<td>{{$bill->clientname}}</td>
		<td><p class="b" title="{{$bill->nameofthework}}">{{$bill->nameofthework}}</p></td>
	   <td>{{ $provider::moneyFormatIndia($bill->total)}}</td>
		<td>{{ $provider::moneyFormatIndia($bill->totalpayable)}}</td>
		<td>{{ $provider::moneyFormatIndia($bill->advancepayment)}}</td>
		<td>{{ $provider::moneyFormatIndia($bill->netpayable)}}</td>
		<td>{{$bill->created_at}}</td>
		<td style="background:red;">{{$bill->status}}</td>
		<td>{{$bill->remarks}}</td>
		<td><a href="/editbills/{{$bill->id}}" class="btn btn-warning">EDIT</a></td>
	
		<td class="text-center" style="font-size: 20px;"><a href="/printbill/{{$bill->id}}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a></td>
        
	   </tr>
		@endforeach
	</tbody>
	
</table>
</div>

@endsection