@extends('layouts.app')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 100px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">PROJECT WISE PAYMENT REPORT</td>
		
	</tr>
	
</table>

<div class="table-responsive">
	<table class="table table-responsive table-hover table-bordered table-striped datatablescroll">
		<thead>
		<tr class="bg-navy">
			<td>PROJECT ID</td>
			<td>PROJECT NAME</td>
			<td>CLIENT NAME</td>
            <td>WORK ORDER VALUE</td>
			<td>TOTAL REQUISITION AMOUNT</td>
			<td>APPROVAL AMOUNT</td>
			<td>PAID AMOUNT</td>
			<td>BALANCE</td>
			<td>EXPENSE AMOUNT</td>
			
		</tr>
	</thead>
	<tbody>
     @php
       $sumamount=array();
     @endphp
		@foreach($projectwisepaymentreports as $projectwisepaymentreport)
           <tr>
           	<td>{{$projectwisepaymentreport['projectid']}}</td>
           	<td><p class="b" title="{{$projectwisepaymentreport['projectname']}}">{{$projectwisepaymentreport['projectname']}}</p></td>
           	<td>{{$projectwisepaymentreport['clientname']}}</td>

           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumamount[]=$projectwisepaymentreport['workordervalue'])}}</td>
           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumamount1[]=$projectwisepaymentreport['amount'])}}</td>
           	
           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumamount2[]=$projectwisepaymentreport['approvalamount'])}}</td>
           	<td style="text-align: right;background-color: aqua;">{{$provider::moneyFormatIndia($sumamount3[]=$projectwisepaymentreport['paidamount'])}}</td>
           	<td style="text-align: right;">{{$provider::moneyFormatIndia($sumamount4[]=$projectwisepaymentreport['workordervalue']-$projectwisepaymentreport['amount'])}}</td>
           	<td style="text-align: right;background-color: #cfc;">{{$provider::moneyFormatIndia($sumamount5[]=$projectwisepaymentreport['expamt'])}}</td>
           
           	
           </tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr class="bg-gray">
			
			<td colspan="3">TOTAL EXPENSE AMOUNTS</td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumamount))}}</strong></td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumamount1))}}</strong></td>
			
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumamount2))}}</strong></td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumamount3))}}</strong></td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumamount4))}}</strong></td>
			<td style="text-align: right;"><strong>Rs. {{$provider::moneyFormatIndia(array_sum($sumamount5))}}</strong></td>
			
			
			
			

			
		</tr>
	</tfoot>

		
	</table>
	
</div>

@endsection