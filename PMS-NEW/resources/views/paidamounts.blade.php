@extends('layouts.app')
@section('content')
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
		<td class="text-center">PAID AMOUNTS REPORT</strong></td>
	</tr>
	 
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
     <thead>
     	<tr class="bg-navy">
     		<th>ID</th>
        <th>REQUISITION ID</th>
        <th>FOR PROJECT</th>
     		<th>NAME</th>
     		<th>AMOUNT</th>
     		<th>PAYMENT TYPE</th>
     		<th>REMARKS</th>
     		<th>PAYMENT STATUS</th>
        <th>DATE OF PAYMENT</th>
     		<th>ENTRY DATE</th>
   


     	</tr>
	
     </thead>
     <tbody>
     	@foreach($requisitionpayments as $requisitionpayment)
           <tr>
           	  <td>{{$requisitionpayment->id}}</td>
              <td>{{$requisitionpayment->rid}}</td>
           
              @if($requisitionpayment->projectname!='')
      <td><p class="b" title="{{$requisitionpayment->projectname}}">{{$requisitionpayment->projectname}}</p></td>
      @else
             <td>OTHERS</td>
      @endif
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
     <tbody>
       <tr style="background-color: greenyellow;">
         <td></td>
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
</div>


@endsection
