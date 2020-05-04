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
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatablescroll" style="width: 100%;">
	<thead>
		<tr class="bg-navy">
		<th>Id</th>
		<th>Vendor</th>
    <th>For Project</th>
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
		<th>VIEW</th>
		@if(Auth::user()->usertype=='MASTER ADMIN' || Auth::user()->usertype=='ACCOUNTS')
		<th>EDIT</th>
		@endif
		
		</tr>

	</thead>
	<tbody>
		@foreach($debitvouchers as $debitvoucher)
          <tr>
          	<td><a href="/viewdebitvoucher/{{$debitvoucher->id}}"  class="btn btn-primary">{{$debitvoucher->id}}</a></td>
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

          	<td>
          		<a href="/viewdebitvoucher/{{$debitvoucher->id}}" class="btn btn-primary">VIEW</a>
          	</td>
          	@if(Auth::user()->usertype=='MASTER ADMIN' || Auth::user()->usertype=='ACCOUNTS')
          	<td>
          		<a href="/editdebitvoucher/{{$debitvoucher->id}}" target="_blank" class="btn btn-info">EDIT</a>
          	</td>
          	@endif
          </tr>

		@endforeach
	</tbody>

</table>
</div>

@endsection