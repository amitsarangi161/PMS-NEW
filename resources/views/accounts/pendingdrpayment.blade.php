@extends('layouts.account')

@section('content')

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">PENDING DEBIT VOUCHER PAYMENTS</td>
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
     		<td>BANK NAME</td>
     		<td>PAYMENT STATUS</td>
     		<td>CREATED AT</td>
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
     		<td>{{$debitvoucherpayment->bankname}}/{{$debitvoucherpayment->acno}}/{{$debitvoucherpayment->branchname}}</td>
     		<td>{{$debitvoucherpayment->paymentstatus}}</td>
     		<td>{{$debitvoucherpayment->created_at}}</td>
     		<td><a href="/dvpay/pendingdrpayment/view/{{$debitvoucherpayment->id}}" class="btn btn-primary">VIEW</a></td>
     	</tr>

     	@endforeach
     </tbody>

	
</table>
</div>



@endsection