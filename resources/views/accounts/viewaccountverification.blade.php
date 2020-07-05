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
    <th>CANCELLED BY</th>
    <th>Created_at</th>
		<th>View</th>
    @if (Request::is('drvouchers/viewalldrvouchers'))
    <th>EDIT</th>
    @endif
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
            <td>{{$createdebitvoucher->name}}</td>
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
               @if (Request::is('drvouchers/viewalldrvouchers'))
              <td>
              <a href="/editdrvoucher/{{$createdebitvoucher->id}}" class="btn btn-warning">EDIT</a>
                
              </td>
              @endif
          </tr>
   
   
		@endforeach
	</tbody>
  <tfoot>
      <tr bgcolor="#97FFD7">
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td><strong>TOTAL</strong></td>
          <td><strong>{{$createdebitvouchers->sum('tprice')}}</strong></td>
          <td><strong>{{$createdebitvouchers->sum('discount')}}</strong></td>
          <td><strong>{{$createdebitvouchers->sum('tsgst')}}</strong></td>
          <td><strong>{{$createdebitvouchers->sum('tcgst')}}</strong></td>
          <td><strong>{{$createdebitvouchers->sum('tigst')}}</strong></td>
          <td><strong>{{$createdebitvouchers->sum('totalamt')}}</strong></td>
          <td><strong>{{$createdebitvouchers->sum('itdeduction')}}</strong></td>
          <td><strong>{{$createdebitvouchers->sum('otherdeduction')}}</strong></td>
          <td><strong>{{$createdebitvouchers->sum('finalamount')}}</strong></td>
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