@extends('layouts.app')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">USERWISE PAYMENT REPORT</td>
		
	</tr>
	
</table>

<div class="table-responsive">
	<table class="table table-responsive table-hover table-bordered table-striped datatable1">
		<thead>
		<tr class="bg-navy">
			<td>USER ID</td>
			<td>NAME</td>
			<td>TOTAL AMOUNT TILL DATE</td>
			<td>EXPENSE MADE</td>
			<td>BALANCE</td>
			<td>WALLET BALANCE</td>
			<td>VIEW DETAILS</td>

			
		</tr>
	</thead>
	<tbody>
     @php
       $sumtotalamt=array();
       $sumtotalexpense=array();
       $sumbalance=array();
       $sumwalletbalance=array();
     @endphp
		@foreach($userwisepayments as $userwisepayment)
           <tr>
           	<td>{{$userwisepayment['id']}}</td>
           	<td>{{$userwisepayment['name']}}</td>
           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumtotalamt[]=$userwisepayment['totalamt'])}}</td>
           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumtotalexpense[]=$userwisepayment['totalexpense'])}}</td>
           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumbalance[]=$userwisepayment['balance'])}}</td>
           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumwalletbalance[]=$userwisepayment['walletbalance'])}}</td>
           	<td><a href="/viewpaymentdetailsuser/{{$userwisepayment['id']}}" class="btn btn-primary">VIEW DETAILS</a></td>
           </tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr class="bg-gray">
			
			<td colspan="2">TOTAL AMOUNTS</td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumtotalamt))}}</strong></td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumtotalexpense))}}</strong></td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumbalance))}}</strong></td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumwalletbalance))}}</strong></td>
			<td></td>
			

			
		</tr>
	</tfoot>

		
	</table>
	
</div>

@endsection