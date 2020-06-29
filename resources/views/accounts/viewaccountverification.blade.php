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
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">ACCOUNT VERIFICATION</td>
	</tr>
	
</table>
<div class="row">
<div class="col-md-6">
  <div class="row">
 
</div></div>
<div class="col-md-6"></div>
</div>
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatablescrollexport">
	<thead>
		<tr class="bg-navy">
		<th>Id</th>
		<th>Vendor</th>
		<th>For Project</th>
    <th>EXPENSE HEAD</th>
    <th>BILL TYPE</th>
    <th>Bill Date</th>
		<th>Bill No</th>
		<th>Total MRP</th>
		<th>Total Discount</th>
		<th>Total SGST</th>
		<th>Total CGST</th>
		<th>Total IGST</th>
		<th>Total Amount</th>
		<th>IT deduction</th>
		<th>Other deduction</th>
		<th>Final Amount</th>
		<th>ATTACHMENT</th>
    <th>Narration</th>
		<th>Status</th>
    <th>Created_at</th>
		<th>View</th>
		</tr>
	</thead>

	<tbody>
		@foreach($createdebitvouchers as $createdebitvoucher)
          <tr>
          	<td>
              @if (Request::is('drvouchers/viewalldrvouchers'))
              <a href="/viewdrvoucher/{{$createdebitvoucher->id}}"  class="btn btn-primary">{{$createdebitvoucher->id}}</a>
              @elseif(Request::is('drvouchers/cancelleddrvouchers'))
               <a href="/viewdrvoucher/{{$createdebitvoucher->id}}"  class="btn btn-primary">{{$createdebitvoucher->id}}</a>
              @else
              <a href="/viewpendingaccountdr/{{$createdebitvoucher->id}}"  class="btn btn-primary">{{$createdebitvoucher->id}}</a>
              @endif
            </td>
          	<td>{{$createdebitvoucher->vendorname}}</td>
          	<td>
          		@if($createdebitvoucher->projectname)
          		<p class="b" title="{{$createdebitvoucher->projectname}}">{{$createdebitvoucher->projectname}}</p>
          		@else
          		NONE
          		@endif
          	</td>
            <td>{{$createdebitvoucher->expenseheadname}}</td>
            <td>{{$createdebitvoucher->voucher_type}}</td>
            <td>{{$createdebitvoucher->billdate}}</td>
          	<td>{{$createdebitvoucher->billno}}</td>
          	<td>{{$provider::moneyFormatIndia($createdebitvoucher->tprice)}}</td>
          	<td>{{$provider::moneyFormatIndia($createdebitvoucher->discount)}}</td>
          	<td>{{$provider::moneyFormatIndia($createdebitvoucher->tsgst)}}</td>
          	<td>{{$provider::moneyFormatIndia($createdebitvoucher->tcgst)}}</td>
          	<td>{{$provider::moneyFormatIndia($createdebitvoucher->tigst)}}</td>
          	<td>{{$provider::moneyFormatIndia($createdebitvoucher->totalamt)}}</td>
          	<td>{{$provider::moneyFormatIndia($createdebitvoucher->itdeduction)}}</td>
          	<td>{{$provider::moneyFormatIndia($createdebitvoucher->otherdeduction)}}</td>
          	<td>{{$provider::moneyFormatIndia($createdebitvoucher->finalamount)}}</td>
          	<td>
          		 <a target="_blank" href="{{asset('img/createdebitvoucher/'.$createdebitvoucher->invoicecopy)}}" >
          		<img style="height:50px;width:50px;" src="{{asset('img/createdebitvoucher/'.$createdebitvoucher->invoicecopy)}}" alt="click here" id="imgshow">
          	</a>
          	</td>
            <td>{{$createdebitvoucher->narration}}</td>
          	<td>{{$createdebitvoucher->status}}</td>
            <td>{{$createdebitvoucher->created_at}}</td>
          	<td>

             @if (Request::is('drvouchers/viewalldrvouchers'))
              <a href="/viewdrvoucher/{{$createdebitvoucher->id}}" class="btn btn-primary">View</a>
               @elseif(Request::is('drvouchers/cancelleddrvouchers'))
               <a href="/viewdrvoucher/{{$createdebitvoucher->id}}"  class="btn btn-primary">{{$createdebitvoucher->id}}</a>
              @else
              <a href="/viewpendingaccountdr/{{$createdebitvoucher->id}}" class="btn btn-primary">View</a>
             @endif
              </td>
          </tr>
   
   
		@endforeach
	</tbody>

</table>
</div>

@endsection