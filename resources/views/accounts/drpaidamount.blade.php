@extends('layouts.account')

@section('content')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">PAID DEBIT VOUCHER PAYMENTS</td>
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
     <thead>
     	<tr class="bg-navy">
     		<td>ID</td>
     		<td>VENDOR NAME</td>
            <td>PROJECT</td>
     		<td>AMOUNT</td>
     		<td>PAYMENT TYPE</td>
     		<td>REMARKS</td>
            <td>TRANSACTION ID</td>
     		<td>BANK NAME</td>
     		<td>PAYMENT STATUS</td>
     		<td>DATE OF PAYMENT</td>
            <td>PAID BY</td>
     		<td>VIEW</td>
            <!-- <th>CANCEL</th> -->
     	</tr>
     </thead>

     <tbody>
     	@foreach($debitvoucherpayments as $debitvoucherpayment)
     	<tr>
     		<td><a href="/drpay/drpaidpayment/view/{{$debitvoucherpayment->id}}" class="btn btn-info">{{$debitvoucherpayment->id}}</a></td>
     		<td>{{$debitvoucherpayment->vendorname}}</td>
               <td><strong><p class="b" title="{{$debitvoucherpayment->projectname}}">{{$debitvoucherpayment->projectname}}</p></strong></td>
     		<td>{{$debitvoucherpayment->amount}}</td>
     		<td>{{$debitvoucherpayment->paymenttype}}</td>
               <td>{{$debitvoucherpayment->remarks}}</td>
     		<td>{{$debitvoucherpayment->transactionid}}</td>
     		<td>{{$debitvoucherpayment->bankname}}/{{$debitvoucherpayment->acno}}/{{$debitvoucherpayment->branchname}}</td>
     		<td>{{$debitvoucherpayment->paymentstatus}}</td>
     		<td>{{$debitvoucherpayment->dateofpayment}}</td>
               <td>{{$debitvoucherpayment->paidbyname}}</td>
     		<td><a href="/drpay/drpaidpayment/view/{{$debitvoucherpayment->id}}" class="btn btn-primary">VIEW</a></td>
            <!-- <td>
          <form action="/canceldebitvoucherpayment/{{$debitvoucherpayment->id}}"  method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('Do You want to Cancel this Voucher Payment?')">CANCEL</button>
            
          </form>
           
        </td> -->
     	</tr>

     	@endforeach
     </tbody>
     <tfoot>
           <tr bgcolor="#97FFD7">
               <td></td>
               <td></td>
               <td><strong>TOTAL AMOUNT</strong></td>
               <td><strong>{{$debitvoucherpayments->sum('amount')}}</strong></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
           </tr>
     </tfoot>

	
</table>

</div>


@endsection