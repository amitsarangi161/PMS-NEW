@extends('layouts.account')
@section('content')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 250px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table  class="table" id="resultsTable">
  <tr class="bg-blue">
    <td class="text-center">LEDGER</td>
  </tr>
</table>
<table  class="table table-responsive table-hover table-bordered table-striped">
	<form action="/ledger/ledger" method="get">
	<tr>
		<td width="10%"><strong>Select a Users</strong></td>
		<td width="30%">

			<select class="form-control select2" name="user">
				<option value="">Select a User</option>
				@foreach($users as $user)
				<option value="{{$user->id}}" {{ ( $user->id == Request::get('user')) ? 'selected' : '' }}>{{$user->name}}</option>
				@endforeach
				
			</select>
		</td>
		<td width="10%">
			<strong>Select a Project</strong>
		</td>
		<td width="40%">
			<select class="form-control select2" name="project">
				<option value="">select a project</option>
                  <option value="OTHERS" title="OTHERS" {{ (Request::get('project')=="OTHERS") ? 'selected' : '' }}>OTHERS</option>
      	 	@foreach($projects as $project)

              
             <option value="{{$project->id}}" {{ ( $project->id == Request::get('project')) ? 'selected' : '' }}>{{$project->projectname}}</option>
         

            
           
		   @endforeach
			</select>
		</td>
	
		<td width="10%"><button type="submit" class="btn btn-info">FETCH LEDGER</button></td>
	</tr>
	</form>
	
</table>
<button type="button" class="btn btn-success" id="print">Print</button>

@if($requisitionpayments)
<div id="printTable">
<p style="text-align:center;">LEDGER</p>

<table width="100%">
<tbody><tr style="border-bottom:1px solid;text-align: center;background: #383b3e;color: #fff;line-height: 2em;">
<td style="width: 100%;">PAYMENT</td>



</tr>


</tbody>
</table>

<div class="table-responsive">
<table  width="100%">

<tbody>

<tr style="background: #c0c0c0;height: 2.5em;font-size: 1em;border-bottom: 1px black solid; font-weight: bold;">
<td style="width: 10%; text-align:left;font-weight: bold;">
DATE</td>
<td style="width: 40%; text-align:left;font-weight: bold;">
PROJECT</td>
<td style="width: 10%; text-align:left;font-weight: bold;">
PAYMENT TYPE</td>
<td style="width: 10%; text-align:left;font-weight: bold;">
EXP HEAD</td>
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
@foreach($customarr as $arr)
@php
  
  $start+=$arr['payment']['amount'];
  $totalpaid+=$arr['payment']['amount'];
@endphp
<tr style="line-height: 2em;font-weight: bold;" class="noexcel">
<tr>
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$arr['payment']['dateofpayment']}}</td>

	@if($arr['payment']['projectname']!='')
	<td style="width: 40%; text-align:left;font-weight: bold;"><p class="b" title="{{$arr['payment']['projectname']}}">{{$arr['payment']['projectname']}}</p></td>
	@else
    <td style="width: 40%; text-align:left;font-weight: bold;">OTHERS</td>
	@endif
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$arr['payment']['paymenttype']}}</td>
	<td style="width: 10%; text-align:left;font-weight: bold;"></td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$arr['payment']['amount']}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">0</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$start}}</td>
</tr>
<tr style="font-weight: bold;border-top: 1px dashed;background: #e8e8e8;line-height: 3em;" class="noexcels">
 @foreach($arr['expenses'] as $exp)
@php
  $abc=$start;
  $getexp=$abc-$exp->approvalamount;
  $totalexp+=$exp->approvalamount;
@endphp
<tr style="background-color: #ffb3b3;">
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$exp->created_at}}</td>
	@if($exp->projectname!='')
	<td style="width: 40%; text-align:left;font-weight: bold;"><p class="b" title="{{$exp->projectname}}">{{$exp->projectname}}</p></td>
	@else
     <td style="width: 40%; text-align:left;font-weight: bold;">OTHERS</td>
	@endif
	<td style="width: 10%; text-align:left;font-weight: bold;">NULL</td>
	<td style="width: 10%; text-align:left;font-weight: bold;">{{$exp->expenseheadname}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">0</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$exp->approvalamount}}</td>
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
	<td style="width: 10%; text-align:left;font-weight: bold;"></td>
    <td style="width: 40%; text-align:left;font-weight: bold;"></td>
	<td style="width: 10%; text-align:left;font-weight: bold;"></td>
	<td style="width: 10%; text-align:left;font-weight: bold;">TOTAL</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$totalpaid}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$totalexp}}</td>
	<td style="width: 10%; text-align:right;font-weight: bold;">{{$start}}</td>
</tr>



</tfoot>

</table>
</div>

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