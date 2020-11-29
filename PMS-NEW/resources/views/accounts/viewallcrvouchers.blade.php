@extends('layouts.account')
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
<table class="table table-responsive table-hover table-bordered table-striped datatablescroll">
	<thead>
		<tr class="bg-blue">
		<td>ID</td>
		<td>CLIENT NAME</td>
	    <td>WORK NAME</td>
	    <td>INVOICE DATE</td>
	    <td>INVOICE NO</td>
	    <td>TOTAL AMOUNT</td>
	    <td>TOTAL PAYABLE</td>
	    <td>ADVANCE RECIVED</td>
	    <td>NET PAYABLE</td>
	    <td>CREATED_AT</td>
        <td>EDIT</td>
	    <td>PRINT/VIEW</td>
	</tr>
	</thead>
	<tbody>
		@foreach($crvouchers as $crvoucher)
		<tr>
		<td><a href="/printinvoice/{{$crvoucher->id}}" target="_blank" class="btn btn-success">{{$crvoucher->id}}</a></td>
		<td>{{$crvoucher->clientname}}</td>
		<td><p class="b" title="{{$crvoucher->nameofthework}}">{{$crvoucher->nameofthework}}</p></td>
		<td>{{$crvoucher->invoicedate}}</td>
		<td>{{$crvoucher->fullinvno}}</td>
		<td>{{ $provider::moneyFormatIndia($crvoucher->total)}}</td>
		<td>{{ $provider::moneyFormatIndia($crvoucher->totalpayable)}}</td>
		<td>{{ $provider::moneyFormatIndia($crvoucher->advancepayment)}}</td>
		<td>{{ $provider::moneyFormatIndia($crvoucher->netpayable)}}</td>
		<td>{{$crvoucher->created_at}}</td>
		<td><a href="/editcrvouchers/{{$crvoucher->id}}" class="btn btn-warning">EDIT</a></td>
		<td class="text-center" style="font-size: 20px;"><a href="/printinvoice/{{$crvoucher->id}}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a></td>

	   </tr>
		@endforeach
	</tbody>
	
</table>
</div>

@endsection