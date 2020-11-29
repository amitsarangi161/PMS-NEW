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
<table  class="table" id="resultsTable">
  <tr class="bg-blue">
    <td class="text-center">DEBITOR LEDGER</td>
  </tr>
</table>

<table  class="table table-responsive table-hover table-bordered table-striped">
	<form action="/ledger/creditorledger" method="get">
	<tr>
		<td width="10%"><strong>Select a Client</strong></td>
		<td width="30%">

			<select class="form-control select2" name="client" required="">
				<option value="">Select a Client</option>
				<option value="ALL" {{ ( Request::get('client') == "ALL") ? 'selected' : '' }}>ALL</option>
				@foreach($clients as $client)
				<option value="{{$client->clientname}}" {{ ($client->clientname  == Request::get('client')) ? 'selected' : '' }}>{{$client->clientname}}</option>
				@endforeach
				
			</select>
		</td>
		
	
		<td width="10%"><button type="submit" class="btn btn-info">FETCH LEDGER</button></td>
	</tr>
	</form>
	
</table>

@if($allarray)
 <table  width="100%" class="table table-responsive table-hover table-bordered table-striped datatablescrollexport">
<thead>
<tr>
<td style="text-align:left;font-weight: bold;">
BILL NO</td>
<td style=" text-align:left;font-weight: bold;">
CLIENT NAME</td>
<td style=" text-align:left;font-weight: bold;">
PROJECT NAME</td>
<td style=" text-align:left;font-weight: bold;">
BILL DATE/REC DATE</td>

<td style=" text-align:right;font-weight: bold;">
BILLED AMT</td>
<td style=" text-align:right;font-weight: bold;">
GST</td>
<td style=" text-align:right;font-weight: bold;">
DEBIT</td>
<td style=" text-align:right;font-weight: bold;">
CREDIT</td>
<td style=" text-align:right;font-weight: bold;">
T.DEDUCT</td>
<td style=" text-align:right;font-weight: bold;">
BALANCE</td>

</tr>
</thead>
<tbody>
	@php
$totalgst=0;
$totalcgst=0;
$totalsgst=0;
$totaligst=0;
$totalcr=0;
$totaldr=0;
$totdeduct=0;

$totalclaimed=0;

@endphp
@foreach($allarray as $all)

@php
$totalcgst=$totalcgst+$all['bill']['cgstvalue'];
$totalsgst=$totalsgst+$all['bill']['sgstvalue'];
$totaligst=$totaligst+$all['bill']['igstvalue'];
$totalclaimed=$totalclaimed+$all['bill']['claimedvalue'];
$totalgst=$totalgst+$all['bill']['cgstvalue']+$all['bill']['sgstvalue']+$all['bill']['igstvalue'];
$totaldr=$totaldr+$all['bill']['netpayable'];
$totalcr=$totalcr+$all['crvoucher']['creditedamt']+0;
$totdeduct=$totdeduct+$all['crvoucher']['totaldeduction']+0;
@endphp

<tr>
 <td style="text-align:left;font-weight: bold;">
 	<a href="/printbill/{{$all['bill']['id']}}" target="_blank" class="btn btn-success">{{$all['bill']['fullinvno']}}</a>
</td>
<td style=" text-align:left;font-weight: bold;">
{{$all['bill']['clientname']}}
</td>
<td style="text-align:left;font-weight: bold;">
<p class="b" title="{{$all['bill']['nameofthework']}}">{{$all['bill']['nameofthework']}}</p></td>
<td style=" text-align:left;font-weight: bold;">
{{$all['bill']['invoicedate']}}</td>
<td style=" text-align:right;font-weight: bold;">
{{$all['bill']['claimedvalue']}}</td>

<td style=" text-align:right;font-weight: bold;">
{{$all['bill']['cgstvalue']+$all['bill']['sgstvalue']+$all['bill']['igstvalue']}}</td>

<td style=" text-align:right;font-weight: bold;">
{{$all['bill']['netpayable']}}</td>
<td style=" text-align:right;font-weight: bold;">
0</td>
<td style=" text-align:right;font-weight: bold;">
0</td>

<td style=" text-align:right;font-weight: bold;">
0</td>
</tr>

@if($all['crvoucher'])
<tr>
 <td style="text-align:left;font-weight: bold;">
 	<a href="/printinvoice/{{$all['crvoucher']['id']}}" target="_blank" class="btn btn-primary">{{$all['crvoucher']['fullinvno']}}</a>
</td>
<td style=" text-align:left;font-weight: bold;">
{{$all['crvoucher']['clientname']}}
</td>
<td style="text-align:left;font-weight: bold;">
<p class="b" title="{{$all['crvoucher']['nameofthework']}}">{{$all['crvoucher']['nameofthework']}}</p></td>
<td style="text-align:left;font-weight: bold;">
{{$all['crvoucher']['crediteddate']}}</td>
<td style="text-align:right;font-weight: bold;">
{{$all['crvoucher']['claimedvalue']}}</td>

<td style="text-align:right;font-weight: bold;">
{{($all['crvoucher']['cgstvalue']+$all['crvoucher']['sgstvalue']+$all['crvoucher']['igstvalue'])+0}}</td>

<td style="text-align:right;font-weight: bold;">
0</td>
<td style="text-align:right;font-weight: bold;">
{{$all['crvoucher']['creditedamt']+0}}</td>
<td style="text-align:right;font-weight: bold;">
{{$all['crvoucher']['totaldeduction']+0}}</td>

<td style="text-align:right;font-weight: bold;">
{{round(($all['bill']['netpayable']-$all['crvoucher']['creditedamt'])-$all['crvoucher']['totaldeduction'])}}</td>

</tr>
@else
<tr style="background-color: red">
<td style="text-align:left;font-weight: bold;">
 	{{$all['bill']['fullinvno']}}
</td>
<td style=" text-align:left;font-weight: bold;">

</td>
<td style="text-align:left;font-weight: bold;">
NO CR VOUCHER
</td>

<td style="text-align:left;font-weight: bold;">
</td>
<td style="text-align:right;font-weight: bold;">
</td>

<td style="text-align:right;font-weight: bold;"></td>

<td style="text-align:right;font-weight: bold;">
</td>
<td style="text-align:right;font-weight: bold;">
</td>
<td style="text-align:right;font-weight: bold;">
</td>

<td style="text-align:right;font-weight: bold;">
</td>
</tr>
@endif








@endforeach



</tbody>
<tfoot>
	<tr style="background-color: gray;">
<td style="text-align:left;font-weight: bold;">
 	
</td>
<td style=" text-align:left;font-weight: bold;">

</td>
<td style="text-align:left;font-weight: bold;">

</td>

<td style="text-align:left;font-weight: bold;">
	TOTAL
</td>
<td style="text-align:right;font-weight: bold;">
	{{$provider::moneyFormatIndia($totalclaimed)}}
</td>

<td style="text-align:right;font-weight: bold;">
	{{$provider::moneyFormatIndia($totalgst)}}
</td>

<td style="text-align:right;font-weight: bold;">
	{{$provider::moneyFormatIndia($totaldr)}}
</td>
<td style="text-align:right;font-weight: bold;">
	{{$provider::moneyFormatIndia($totalcr)}}
</td>
<td style="text-align:right;font-weight: bold;">
   {{$provider::moneyFormatIndia($totdeduct)}}
</td>

<td style="text-align:right;font-weight: bold;">
	{{$provider::moneyFormatIndia($totaldr-$totalcr)}}
</td>
</tr>
	</tr>
	
</tfoot>

</table>
@endif

@endsection