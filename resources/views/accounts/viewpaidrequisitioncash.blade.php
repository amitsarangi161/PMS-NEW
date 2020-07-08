@extends('layouts.account')
@section('content')

<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 150px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">REQUISITION PAYMENT CASH</td>
	</tr>
	 
</table>
<div class="table-responsive">
<table class="table  table-hover table-bordered table-striped datatable1">
     <thead>
     	<tr class="bg-navy">
     		<th>ID</th>
        <th>PROJECT NAME</th>
     		<th>REQUISITION ID</th>
        <th>NAME</th>
     		<th>AMOUNT</th>
     		<th>PAYMENT TYPE</th>
        <th>CHEQUE NO</th>
     		<th>REMARKS</th>
        <th>PAYMENT STATUS</th>
     		<th>DATE OF PAYMENT</th>
     		<th>CREATED_AT</th>
     		

     	</tr>
	
     </thead>
     <tbody>
     	@foreach($requisitionpayments as $requisitionpayment)
           <tr>
           	  <td>{{$requisitionpayment->id}}</td>
              <td><p class="b" title="{{$requisitionpayment->projectname}}">{{$requisitionpayment->projectname}}</p></td>
              <td>{{$requisitionpayment->rid}}</td>
           	  <td>{{$requisitionpayment->name}}</td>
           	  <td>{{$requisitionpayment->amount}}</td>
           	  <td>{{$requisitionpayment->paymenttype}}</td>
              <td>{{$requisitionpayment->transactionid}}</td>
           	  <td>{{$requisitionpayment->remarks}}</td>
              <td>{{$requisitionpayment->paymentstatus}}</td>
           	  <td>{{$requisitionpayment->dateofpayment}}</td>
           	  <td>{{$requisitionpayment->created_at}}</td>
           	  
           </tr>

     	@endforeach
     </tbody>
     <tfoot>
       <tr style="background-color: greenyellow;">
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Rs .{{$requisitionpayments->sum('amount')}}</strong></td>
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