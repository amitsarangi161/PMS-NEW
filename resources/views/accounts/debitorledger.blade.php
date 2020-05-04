@extends('layouts.account')
@section('content')
<table  class="table" id="resultsTable">
  <tr class="bg-blue">
    <td class="text-center">DEBITOR LEDGER</td>
  </tr>
</table>
<table  class="table table-responsive table-hover table-bordered table-striped">
	<form action="/ledger/debitorledger" method="get">
	<tr>
		<td width="10%"><strong>Select a Users</strong></td>
		<td width="30%">

			<select class="form-control select2" name="vendor" required="">
				<option value="">Select a Vendor</option>
				<option value="ALL" {{ ( Request::get('vendor') == "ALL") ? 'selected' : '' }}>ALL</option>
				@foreach($vendors as $vendor)
				<option value="{{$vendor->id}}" {{ ( $vendor->id == Request::get('vendor')) ? 'selected' : '' }}>{{$vendor->vendorname}}</option>
				@endforeach
				
			</select>
		</td>
		
	
		<td width="10%"><button type="submit" class="btn btn-info">FETCH LEDGER</button></td>
	</tr>
	</form>
	
</table>

@if($alldebitvoucherarr)
<div class="table-responsive">
<table  class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead class="bg-navy">
		<tr>
			<td style="font-weight: bold;">ID</td>
			<td style="font-weight: bold;">VENDOR NAME</td>
			<td style="font-weight: bold;">CREDIT</td>
			<td style="font-weight: bold;">DEBIT</td>
			<td style="font-weight: bold;">BALANCE</td>
		</tr>
	</thead>
	<tbody>
		@php
           $tcr=array();
           $tdr=array();
           $tbal=array();

		@endphp
		@foreach($alldebitvoucherarr as $key=>$value)
		<tr>
			<td style="font-weight: bold;">{{++$key}}</td>
			<td style="font-weight: bold;">{{$value['vendorname']}}</td>
			<td style="font-weight: bold;">{{$tcr[]=$value['cr']}}</td>
			<td style="font-weight: bold;">{{$tdr[]=$value['dr']}}</td>
			<td style="font-weight: bold;">{{$tbal[]=$value['bal']}}</td>
		</tr>

		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" style="font-weight: bold;">Total</td>
			<td style="font-weight: bold;">{{array_sum($tcr)}}</td>
			<td style="font-weight: bold;">{{array_sum($tdr)}}</td>
			<td style="font-weight: bold;">{{array_sum($tbal)}}</td>
			
		</tr>
	</tfoot>
</table>
</div>

@endif
@if($debitvouchers)
<button type="button" class="btn btn-success" id="print">Print</button>
<div id="printTable">
<p style="text-align:center;">DEBITOR LEDGER</p>

<table width="100%">
<tbody><tr style="border-bottom:1px solid;text-align: center;background: #383b3e;color: #fff;line-height: 2em;">
<td style="width: 100%;">LEDGER</td>



</tr>


</tbody>
</table>


<table  width="100%">

<tbody>

<tr style="background: #c0c0c0;height: 2.5em;font-size: 1em;border-bottom: 1px black solid; font-weight: bold;">

<td style="width: 10%; text-align:left;font-weight: bold;">
ID</td>
<td style="width: 10%; text-align:left;font-weight: bold;">
BILL NO</td>
<td style="width: 10%; text-align:left;font-weight: bold;">
DATE</td>
<td style="width: 10%; text-align:left;font-weight: bold;">
STATUS</td>
<td style="width: 10%; text-align:left;font-weight: bold;">
CREATED_AT</td>
<td style="width: 10%; text-align:right;font-weight: bold;">
CREDIT</td>
<td style="width: 10%; text-align:right;font-weight: bold;">
DEBIT</td>
<td style="width: 10%; text-align:right;font-weight: bold;">
BALANCE</td>

</tr>

@php
  $start=0;
  $totalpaid=0;
  $totalexp=0;

@endphp
@foreach($debitvouchers as $arr)
@php
  
  $start+=$arr['header']['approvalamount'];
  $totalpaid+=$arr['header']['approvalamount'];
@endphp
<tr style="line-height: 2em;font-weight: bold;font-weight: bold;" class="noexcel">
<tr>
	
	<td style="width: 10%; text-align:left;font-weight: bold;">
	<a href="/viewdebitvoucher/{{$arr['header']['id']}}" class="btn btn-primary" target="_blank">
	{{$arr['header']['id']}}
    </a>
   </td>
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$arr['header']['billno']}}</td>
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$arr['header']['billdate']}}</td>
    <td style="width: 10%; text-align:left;font-weight: bold;">{{$arr['header']['status']}}</td>
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$arr['header']['created_at']}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$arr['header']['approvalamount']}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">0</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$start}}</td>
	
</tr>
<tr style="font-weight: bold;border-top: 1px dashed;background: #e8e8e8;line-height: 3em;" class="noexcels">
 @foreach($arr['payments'] as $exp)
@php
  $abc=$start;
  $getexp=$abc-$exp->amount;
  $totalexp+=$exp->amount;
@endphp
<tr style="background-color: #ffb3b3;">
	
	<td style="width: 10%; text-align:left;font-weight: bold;">*</td>
	<td style="width: 10%; text-align:left;font-weight: bold;"></td>
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$exp->dateofpayment}}</td>
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$exp->paymentstatus}}</td>
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$exp->created_at}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">0</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$exp->amount}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$getexp}}</td>
	
</tr>
@php
   $abc=$getexp;
   $start=$abc;
@endphp
@endforeach

@endforeach







</tbody>
<tr style="font-weight: bold;border-top: 1px dashed;background: #e8e8e8;line-height: 3em;">
<tfoot>

<tr style="background-color: red;">
	<td style="width: 10%; text-align:left;"></td>
    <td style="width: 10%; text-align:left;"></td>
	<td style="width: 10%; text-align:left;"></td>
	<td style="width: 10%; text-align:left;font-weight: bold;">TOTAL</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$totalpaid}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$totalexp}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$start}}</td>
</tr>



</tfoot>

</table>
</div>

@endif
<script type="text/javascript">
	function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('#print').on('click',function(){
printData();
})
</script>

@endsection