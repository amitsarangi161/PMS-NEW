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
<h3 class="text-center"><strong>VIEW ALL PAID VOUCHERS</strong></h3>

<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<th>ID</th>
			<th>PAYEE NAME</th>
      <th>BANK NAME</th>
      <th>AC NO</th>
      <th>IFSC</th>
      <th>CHEQUE DETAILS</th>
			<th>PROJECT</th>
			<th>EXPENSE HEAD</th>
      <th>PARTICULAR</th>
      <th>AMOUNT</th>
      <th>TDS %</th>
      <th>TDS AMT</th>
      <th>AMOUNT TO PAY</th>
      <th>DESCRIPTION</th>
		  <th>STATUS</th>
      <th>ADDED BY</th>
			<th>CREATED AT</th>
      <th>VIEW</th>
    
		

		</tr>
	</thead>
	<tbody>
    @foreach($vouchers as $voucher)
		<tr style="font-size: 12px;">
        <td><a href="/viewvoucher/{{$voucher->id}}" class="btn btn-primary">{{$voucher->id}}</a></td>
        <td>{{$voucher->payeename}}</td>
        <td>{{$voucher->bankname}}</td>
        <td>{{$voucher->acno}}</td>
        <td>{{$voucher->ifsccode}}</td>
         <td>{{$voucher->chequedetails}}</td>
        <td><p class="b" title="{{$voucher->projectname}}">{{$voucher->projectname}}</p></td>
        <td>{{$voucher->expenseheadname}}</td>
        <td>{{$voucher->particularname}}</td>
        <td>{{$voucher->amount}}</td>
          <td>{{$voucher->tds}}</td>
        <td>{{$voucher->tdsamt}}</td>
        <td>{{$voucher->amounttopay}}</td>
        <td>{{$voucher->description}}</td>
        <td>
        @if($voucher->status=='PENDING')
       <span class="label label-warning">{{$voucher->status}}</span>
        @elseif($voucher->status=='APPROVED')
          <span class="label label-primary">{{$voucher->status}}</span>
         @elseif($voucher->status=='PAID')
          <span class="label label-success">{{$voucher->status}}</span>
          @else
          <span class="label label-danger">{{$voucher->status}}</span>
         @endif
       </td>
        <td>{{$voucher->author}}</td>
        <td>{{$voucher->created_at}}</td>
        <td><a href="/viewvoucher/{{$voucher->id}}" class="btn btn-primary">VIEW</a></td>
      

        

		</tr>
    @endforeach
	</tbody>
<tfoot>
  <tr style="background-color: #cecdcd;">
 
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>TOTAL</td>
      <td>{{$vouchers->sum('amount')}}</td>
      <td></td>
      <td>{{$vouchers->sum('tdsamt')}}</td>
      <td>{{$vouchers->sum('amounttopay')}}</td>
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