@extends('layouts.account')
@section('content')

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">REQUISITION PAYMENT CASH</td>
	</tr>
	 
</table>

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
     <thead>
     	<tr class="bg-navy">
     		<th>ID</th>
     		<th>REQUISITION ID</th>
        <th>NAME</th>
     		<th>AMOUNT</th>
     		<th>PAYMENT TYPE</th>
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
              <td>{{$requisitionpayment->rid}}</td>
           	  <td>{{$requisitionpayment->name}}</td>
           	  <td>{{$requisitionpayment->amount}}</td>
           	  <td>{{$requisitionpayment->paymenttype}}</td>
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
         
       </tr>
     </tfoot>
</table>





@endsection