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
	<tr class="bg-navy">
		<td class="text-center">VIEW ALL BILLS</td>
		
	</tr>
	
</table>
<table class="table">
	<tr class="bg-yellow">
		<td colspan="8" class="text-center">FILTER</td>
	</tr>
	<tr>
		<td><strong>Select a Company</strong></td>
		<td>
			<select class="form-control" id="company">
				<option value="">Select a Company</option>
				<option value="SA" {{ (Request::get('company')=="SA") ? 'selected' : '' }}>SA</option>
				<option value="STEPL" {{ (Request::get('company')=="STEPL") ? 'selected' : '' }}>STEPL</option>
				<option value="STECS" {{ (Request::get('company')=="STECS") ? 'selected' : '' }}>STECS</option>
			</select>
		</td>
		<td><strong>Select a Status</strong></td>
		<td>
			<select id="status" class="form-control">
				<option value="">Select a Status</option>
				<option value="PENDING" {{ (Request::get('status')=="PENDING") ? 'selected' : '' }}>PENDING</option>
				<option value="APPROVED" {{ (Request::get('status')=="APPROVED") ? 'selected' : '' }}>APPROVED</option>
				<option value="REJECTED" {{ (Request::get('status')=="REJECTED") ? 'selected' : '' }}>REJECTED</option>
				
			</select>
		</td>
		<td><strong>Select a Financial Year</strong></td>
    <td>
      <select class="form-control" name="year" id="year">
        <option value="" >Select a Year</option>
        <option value="2018-19" {{ (Request::get('year')=="2018-19") ? 'selected' : '' }}>2018-19</option>
        <option value="2019-20" {{ (Request::get('year')=="2019-20") ? 'selected' : '' }}>2019-20</option>
        <option value="2020-20" {{ (Request::get('year')=="2020-21") ? 'selected' : '' }}>2020-21</option>
        
      </select>
    </td>

		<td><button type="button" class="btn btn-primary" onclick="filter();">FILTER</button></td>
	
	</tr>
	<tr>
		<td ><a href="/accbills/viewallbills" class="btn btn-danger">Clear Search</a></td>
	</tr>
</table>

<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatablescrollexport">
	<thead>
		<tr class="bg-blue">
		<td>ID</td>
		<td>INVOICE NO</td>
		<td>CLIENT NAME</td>
		<td>COMPANY</td>
	    <td>WORK NAME</td>
	    <td>TOTAL AMOUNT</td>
	    <td>CLAIMED AMOUNT</td>
	    <td>CGST</td>
        <td>SGST</td>
        <td>IGST</td>
	    <td>TOTAL PAYABLE</td>
	    <td>ADVANCE RECIVED</td>
	    <td>NET PAYABLE</td>
	    <td>CREATED_AT</td>
	    <td>STATUS</td>
        <td>EDIT</td>
	    <td>PRINT/VIEW</td>
	</tr>
	</thead>
	<tbody>
		@foreach($bills as $bill)
		<tr>
		<td><a href="/printbill/{{$bill->id}}" target="_blank" class="btn btn-success">{{$bill->id}}</a></td>
		<td>{{$bill->fullinvno}}</td>
		<td>{{$bill->clientname}}</td>
		<td>{{$bill->company}}</td>

		<td><p class="b" title="{{$bill->nameofthework}}">{{$bill->nameofthework}}</p></td>
	    <td>{{ $provider::moneyFormatIndia($bill->total)}}</td>
	    <td>{{ $provider::moneyFormatIndia($bill->claimedvalue)}}</td>
	       <td>{{ $provider::moneyFormatIndia($bill->cgstvalue)}}</td>
        <td>{{ $provider::moneyFormatIndia($bill->sgstvalue)}}</td>
        <td>{{ $provider::moneyFormatIndia($bill->igstvalue)}}</td>
		<td>{{ $provider::moneyFormatIndia($bill->totalpayable)}}</td>
		<td>{{ $provider::moneyFormatIndia($bill->advancepayment)}}</td>
		<td>{{ $provider::moneyFormatIndia($bill->netpayable)}}</td>
		<td>{{$bill->created_at}}</td>
		<td style="background:greenyellow;">{{$bill->status}}</td>
		<td><a href="/editbills/{{$bill->id}}" class="btn btn-warning">EDIT</a></td>
		@if($bill->status=='APPROVED' || Auth::user()->usertype=='MASTER ADMIN')
		<td class="text-center" style="font-size: 20px;"><a href="/printbill/{{$bill->id}}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a></td>
         @else

         <td class="text-center" style="font-size: 20px;"><a diSTECSbled title="you can't print a pending bill"><i style="color: red;" class="fa fa-print" aria-hidden="true"></i></a></td>

         @endif
	   </tr>
		@endforeach
	</tbody>
	<tfoot>
      <tr class="bg-gray">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-weight: bold;">TOTAL</td>
        <td style="font-weight: bold;">{{$provider::moneyFormatIndia($bills->sum('total'))}}</td>
        <td style="font-weight: bold;">CLAIMED:-{{$provider::moneyFormatIndia( $bills->sum('claimedvalue'))}}</td>

         <td style="font-weight: bold;">CGST:-{{$provider::moneyFormatIndia( $bills->sum('cgstvalue'))}}</td>
        <td style="font-weight: bold;">SGST:-{{$provider::moneyFormatIndia( $bills->sum('sgstvalue'))}}</td>
        <td style="font-weight: bold;">IGST:-{{$provider::moneyFormatIndia( $bills->sum('igstvalue'))}}</td>

        <td style="font-weight: bold;">{{$provider::moneyFormatIndia($bills->sum('totalpayable'))}}</td>
        <td style="font-weight: bold;">{{$provider::moneyFormatIndia($bills->sum('advancepayment'))}}</td>
        <td style="font-weight: bold;">{{$provider::moneyFormatIndia($bills->sum('netpayable'))}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      
    </tfoot>
	
</table>
</div>
<script type="text/javascript">
	function filter()
  {
    var company=$("#company").val();
    var status=$("#status").val();
    var year=$("#year").val();
    if (company!='' || status!=''|| year!='') {
         location.href='?company='+company+'& status='+status+'& year='+year;

    }
    else
    {
      alert("Please Select a Status or Company");
    }

    
  }
</script>

@endsection