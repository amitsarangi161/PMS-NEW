@extends('layouts.account')
@section('content')

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">REQUISITION PAID AMOUNT FROM BANK</td>
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
        <th>TRANSACTION ID</th>
     		<th>REMARKS</th>
     		<th>PAYMENT STATUS</th>
        <th>DATE OF PAYMENT</th>
     		
     		<th>VIEW</th>


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
              <td>{{$requisitionpayment->transactionid}}</td>
           	  <td>{{$requisitionpayment->remarks}}</td>
           	  <td>{{$requisitionpayment->paymentstatus}}</td>
           	  <td>{{$requisitionpayment->dateofpayment}}</td>
           	  <!-- <td><button type="button" class="btn btn-primary" onclick="payonline('{{$requisitionpayment->id}}');">PAID</button></td> -->
              <td><a href="/cashierviewdetailsonlinepayment/{{$requisitionpayment->id}}" class="btn btn-primary">VIEW</a></td>
           </tr>

     	@endforeach
     </tbody>
     <tbody>
       <tr style="background-color: greenyellow;">
         <td></td>
         <td></td>
         <td><strong>TOTAL</strong></td>
         <td><strong>{{$requisitionpayments->sum('amount')}}</strong></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>

       </tr>
     </tbody>
</table>



@endsection