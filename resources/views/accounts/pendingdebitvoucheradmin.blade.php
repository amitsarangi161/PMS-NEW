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
		<td class="text-center">ALL PENDING DEBIT VOUCHER(APPROVAL BY ADMIN)</td>
		
	</tr>
	
</table>
<div class="row">
<div class="col-md-6">
  <div class="row">
  <div class="col-md-4"><h5><i class="fa fa-stop" style="color:#d81b60b5;"></i> <span style="font-weight: bold;">More Than 10days.</h5></div>
  <div class="col-md-4"><h5><i class="fa fa-stop" style="color:#00b8ff73;"></i> <span style="font-weight: bold;">Less Than 10days.</h5></div>
  <div class="col-md-4"><h5><i class="fa fa-stop" style="color:#00a65aa6;"></i> <span style="font-weight: bold;">Less Than 5days.</h5></div>
</div></div>
<div class="col-md-6"></div>
</div>
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable" style="width: 100%;">
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
		<th>Total Quantity</th>
		<th>Total SGST</th>
		<th>Total CGST</th>
		<th>Total IGST</th>
		<th>Total Amount</th>
		<th>IT deduction</th>
		<th>Other deduction</th>
		<th>Final Amount</th>
		<th>Approval Amount</th>
		<th>Inv. Scan</th>
		<th>Status</th>
		<th>View</th>
		</tr>

	</thead>
	<tbody>
		@foreach($debitvouchers as $debitvoucher)
    @php
    $today=Carbon\Carbon::now();
    $createddate=\Carbon\Carbon::parse($debitvoucher->created_at);
    $diff=$today->diffInDays($createddate);
    @endphp

    @if($diff>=10)
          <tr style="background-color: #d81b60b5;">
          	<td><a href="/viewpendinfdebitvoucheradmin/{{$debitvoucher->id}}"  class="btn btn-primary">{{$debitvoucher->id}}</a></td>
          	<td>{{$debitvoucher->vendorname.$diff}}</td>
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
          	<td>{{$debitvoucher->tqty}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->tsgst)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->tcgst)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->tigst)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->totalamt)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->itdeduction)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->otherdeduction)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->finalamount)}}</td>
          	<td>{{$provider::moneyFormatIndia($debitvoucher->approvalamount)}}</td>
          	<td>
          		 <a href="{{asset('img/debitvoucher/'.$debitvoucher->invoicecopy)}}" target="_blank">
          		<img style="height:50px;width:50px;" src="{{asset('img/debitvoucher/'.$debitvoucher->invoicecopy)}}" alt="click here" id="imgshow">
          	</a>
          	</td>
          	<td>{{$debitvoucher->status}}</td>
          	<td><a href="/viewpendinfdebitvoucheradmin/{{$debitvoucher->id}}"  class="btn btn-primary">View</a></td>
          </tr>
      @elseif($diff>=5)
          <tr style="background-color: #00b8ff73;">
            <td><a href="/viewpendinfdebitvoucheradmin/{{$debitvoucher->id}}"  class="btn btn-primary">{{$debitvoucher->id}}</a></td>
            <td>{{$debitvoucher->vendorname.$diff}}</td>
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
            <td>{{$debitvoucher->tqty}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->tsgst)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->tcgst)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->tigst)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->totalamt)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->itdeduction)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->otherdeduction)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->finalamount)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->approvalamount)}}</td>
            <td>
               <a href="{{asset('img/debitvoucher/'.$debitvoucher->invoicecopy)}}" target="_blank">
              <img style="height:50px;width:50px;" src="{{asset('img/debitvoucher/'.$debitvoucher->invoicecopy)}}" alt="click here" id="imgshow">
            </a>
            </td>
            <td>{{$debitvoucher->status}}</td>
            <td><a href="/viewpendinfdebitvoucheradmin/{{$debitvoucher->id}}"  class="btn btn-primary">View</a></td>
          </tr>
        @else
          <tr style="background-color: #00a65aa6;">
            <td><a href="/viewpendinfdebitvoucheradmin/{{$debitvoucher->id}}"  class="btn btn-primary">{{$debitvoucher->id}}</a></td>
            <td>{{$debitvoucher->vendorname.$diff}}</td>
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
            <td>{{$debitvoucher->tqty}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->tsgst)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->tcgst)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->tigst)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->totalamt)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->itdeduction)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->otherdeduction)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->finalamount)}}</td>
            <td>{{$provider::moneyFormatIndia($debitvoucher->approvalamount)}}</td>
            <td>
               <a href="{{asset('img/debitvoucher/'.$debitvoucher->invoicecopy)}}" target="_blank">
              <img style="height:50px;width:50px;" src="{{asset('img/debitvoucher/'.$debitvoucher->invoicecopy)}}" alt="click here" id="imgshow">
            </a>
            </td>
            <td>{{$debitvoucher->status}}</td>
            <td><a href="/viewpendinfdebitvoucheradmin/{{$debitvoucher->id}}"  class="btn btn-primary">View</a></td>
          </tr>
          @endif

		@endforeach
	</tbody>

</table>
</div>

@endsection