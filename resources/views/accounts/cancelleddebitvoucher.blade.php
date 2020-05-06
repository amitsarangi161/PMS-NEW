@extends('layouts.account')

@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>

<h3 style="text-align: center;">CANCELLED DR VOUCHER</h3>

<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable" style="width: 100%;">
	<thead>
		<tr class="bg-navy">
		<th>Id</th>
		<th>Vendor</th>
		<th>Project Name</th>
		<th>Bill Date</th>
		<th>Bill No</th>
		<th>Total MRP</th>
		<th>Total Discount</th>
		<th>Total Price</th>
		<th>Total SGST</th>
		<th>Total CGST</th>
		<th>Total IGST</th>
		<th>Total Amount</th>
		<th>IT deduction</th>
		<th>Other deduction</th>
		<th>Final Amount</th>
		<th>Inv. Scan</th>
		<th>Status</th>
    <th>Cancelled By</th>
		<th>VIEW</th>
		
		</tr>

	</thead>
	<tbody>
		@foreach($debitvouchers as $debitvoucher)
          <tr>
          	<td><a href="/viewdebitvoucher/{{$debitvoucher->id}}" class="btn btn-primary">{{$debitvoucher->id}}</a></td>
          	<td>{{$debitvoucher->vendorname}}</td>
          	  	<td>
          		@if($debitvoucher->projectname)
          		<p class="b" title="{{$debitvoucher->projectname}}">{{$debitvoucher->projectname}}</p>
          		@else
          		NONE
          		@endif
          	</td>
          	<td>{{$debitvoucher->billdate}}</td>
          	<td>{{$debitvoucher->billno}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->tmrp)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->tdiscount)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->tprice)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->tsgst)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->tcgst)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->tigst)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->totalamt)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->itdeduction)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->otherdeduction)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->finalamount)}}</td>
          	
          
          	<td>
          		 <a href="{{asset('img/debitvoucher/'.$debitvoucher->invoicecopy)}}" target="_blank">
          		<img style="height:50px;width:50px;" src="{{asset('img/debitvoucher/'.$debitvoucher->invoicecopy)}}" alt="click to view" id="imgshow">
          	</a>
          	</td>
          	<td>{{$debitvoucher->status}}</td>
            <td>{{$debitvoucher->name}}</td>
          	<td><a href="/viewdebitvoucher/{{$debitvoucher->id}}" class="btn btn-primary">VIEW</a></td>
          </tr>

		@endforeach
	</tbody>

</table>
</div>

@endsection