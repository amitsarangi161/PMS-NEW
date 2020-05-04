@extends('layouts.account')

@section('content')

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">PAID DEBIT VOUCHER PAYMENTS</td>
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
     <thead>
     	<tr class="bg-navy">
     		<td>ID</td>
     		<td>VENDOR NAME</td>
     		<td>AMOUNT</td>
     		<td>PAYMENT TYPE</td>
     		<td>REMARKS</td>
               <td>TRANSACTION ID</td>
     		<td>BANK NAME</td>
     		<td>PAYMENT STATUS</td>
     		<td>DATE OF PAYMENT</td>
               <td>PAID BY</td>
     		<td>VIEW</td>
     	</tr>
     </thead>

     <tbody>
     	@foreach($debitvoucherpayments as $debitvoucherpayment)
     	<tr>
     		<td>{{$debitvoucherpayment->id}}</td>
     		<td>{{$debitvoucherpayment->vendorname}}</td>
     		<td>{{$debitvoucherpayment->amount}}</td>
     		<td>{{$debitvoucherpayment->paymenttype}}</td>
               <td>{{$debitvoucherpayment->remarks}}</td>
     		<td>{{$debitvoucherpayment->transactionid}}</td>
     		<td>{{$debitvoucherpayment->bankname}}/{{$debitvoucherpayment->acno}}/{{$debitvoucherpayment->branchname}}</td>
     		<td>{{$debitvoucherpayment->paymentstatus}}</td>
     		<td>{{$debitvoucherpayment->dateofpayment}}</td>
               <td>{{$debitvoucherpayment->paidbyname}}</td>
     		<td><a href="/dvpay/paiddrpayment/view/{{$debitvoucherpayment->id}}" class="btn btn-primary">VIEW</a></td>
     	</tr>

     	@endforeach
     </tbody>

	
</table>

</div>


@endsection