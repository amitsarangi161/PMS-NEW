@extends('layouts.account')
@section('content')
@php
$paid=$paidamounts->sum('amount');

$bal=($requisitionheader->approvalamount)-$paid;
@endphp
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">REQUISITION DETAILS</td>
	 </tr>
</table>


<div class="well">
	<table class="table" style="background-color: silver;">
		<tr>
			<td><strong>REQUISITION ID</strong></td>
			<td>#{{$requisitionheader->id}}</td>
			<td><strong>PROJECT NAME</strong></td>
			@if($requisitionheader->projectname!='')
			<td width="40%">{{$requisitionheader->projectname}}</td>
            @else
            <td>OTHERS</td>
            @endif
		</tr>
         <tr>
			<td><strong>NAME</strong></td>
			<td>{{$requisitionheader->employee}}</td>
			<td><strong>AUTHOR</strong></td>
			<td>{{$requisitionheader->author}}</td>
		 </tr>
		  <tr>
			<td><strong>TOTAL AMOUNT</strong></td>
			<td>{{$requisitionheader->totalamount}}</td>
			<td><strong>APPROVAL AMOUNT</strong></td>
			<td>{{$requisitionheader->approvalamount}}</td>
		  </tr>
		  <tr>
			<td><strong>TOTAL AMOUNT PAID</strong></td>
			<td><span class="label label-primary">{{$paid}}</span></td>
			<td><strong>BALANCE AMOUNT</strong></td>
			<td><span class="label label-danger">{{$bal}}</span></td>
		  </tr>
		  <tr>
			<td><strong>APPROVED BY</strong></td>
			@if($requisitionheader->approvedby=='')
			   <td>NOT APPROVED</td>
			@else
              <td>{{$requisitionheader->approvedby}}</td>
			@endif
			
			<td><strong>STATUS</strong></td>
			<td>{{$requisitionheader->status}}</td>
			
		  </tr>
		  <tr>
		  	<td><strong>DATE FROM</strong></td>
		  	<td><strong class="bg-navy">{{$requisitionheader->datefrom}}</strong></td>
		  	<td><strong>DATE TO</strong></td>
		  	<td><strong class="bg-navy">{{$requisitionheader->dateto}}</strong></td>
		  </tr>

		  <tr>
			
			<td><strong>CREATED_AT</strong></td>
			<td>{{$requisitionheader->created_at}}</td>
			<td><strong>DESCRIPTION</strong></td>
			<td>{{$requisitionheader->description}}</td>
		  </tr>
		
	</table>
	
</div>


<div class="well">

	<table class="table table-responsive table-hover table-bordered table-striped">

		<thead class="bg-navy">
			<tr>
				<th>SL_NO</th>
				<th>EXPENSE HEAD</th>
				<th>PARTICULAR</th>
				<th>DESCRIPTION</th>
				<th>PAY TO</th>
				<th>AMOUNT</th>
				<th>APPROVED AMOUNT</th>
				<th>STATUS</th>
				
				
			</tr>
		</thead>
		<tbody>
			@foreach($requisitions as $key=>$requisition)
			<tr>
				<td>{{$key+1}}</td>
				<td>{{$requisition->expenseheadname}}</td>
				<td>{{$requisition->particularname}}</td>
				<td>{{$requisition->description}}</td>
				<td>{{$requisition->payto}}</td>
				<td>{{$requisition->amount}}</td>
				<td>{{$requisition->approvedamount}}</td>
				<td>{{$requisition->approvestatus}}</td>
				
				

			</tr>

			@endforeach
		</tbody>
		<tfoot>
			<tr class="bg-gray">
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><strong>TOTAL AMOUNT</strong></td>
				<td><strong>Rs.{{$requisitions->sum('amount')}}</strong></td>
				<td><strong>Rs.{{$requisitions->sum('approvedamount')}}</strong></td>
				<td></td>
				
			</tr>
		</tfoot>
		
	</table>
	
</div>

<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">VIEW PAYMENTS</td>
	 </tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">

		<thead class="bg-navy">
			<tr>
				<th>SL_NO</th>
				<th>AMOUNT</th>
				<th>PAYMENT METHOD</th>
				<th>REMARKS</th>
				<th>PAYMENT STATUS</th>
				<th>CREATED_AT</th>
				
				
				
			</tr>
		</thead>
		<tbody>
			@foreach($paidamounts as $key=>$paidamount)
			<tr>
				<td>{{$key+1}}</td>
				<td>{{$paidamount->amount}}</td>
				<td>{{$paidamount->paymenttype}}</td>
				<td>{{$paidamount->remarks}}</td>
				<td>{{$paidamount->paymentstatus}}</td>
				<td>{{$paidamount->created_at}}</td>
				

			</tr>

			@endforeach
		</tbody>
		<tfoot>
			<tr class="bg-gray">
				<td>TOTAL</td>
				<td><strong>Rs.{{$paidamounts->sum('amount')}}</strong></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tfoot>
		
	</table>




@endsection