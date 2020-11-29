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
		<td class="text-center">VIEW CREDIT VOUCHER</td>
		
	</tr>
	
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-blue">
		<td>ID</td>
		<td>CLIENT NAME</td>
	    <td>WORK NAME</td>
	    <td>TOTAL AMOUNT</td>
	    <td>TOTAL PAYABLE</td>
	    <td>ADVANCE RECIVED</td>
	    <td>NET PAYABLE</td>
	    <td>CREATED_AT</td>
	    <td>STATUS</td>
        <td>EDIT</td>
	    <td>PRINT/VIEW</td>
	    <td>APPROVE</td>
	    <td>REJECT</td>
	</tr>
	</thead>
	<tbody>
		@foreach($bills as $bill)
		<tr>
		<td><a href="/printbill/{{$bill->id}}" target="_blank" class="btn btn-success">{{$bill->id}}</a></td>
		<td>{{$bill->clientname}}</td>
		<td><p class="b" title="{{$bill->nameofthework}}">{{$bill->nameofthework}}</p></td>
	    <td>{{ $provider::moneyFormatIndia($bill->total)}}</td>
		<td>{{ $provider::moneyFormatIndia($bill->totalpayable)}}</td>
		<td>{{ $provider::moneyFormatIndia($bill->advancepayment)}}</td>
		<td>{{ $provider::moneyFormatIndia($bill->netpayable)}}</td>
		<td>{{$bill->created_at}}</td>
		<td style="background:greenyellow;">{{$bill->status}}</td>
		<td><a href="/editbills/{{$bill->id}}" class="btn btn-warning">EDIT</a></td>
		<td class="text-center" style="font-size: 20px;"><a href="/printbill/{{$bill->id}}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a></td>
		<td><button type="button" class="btn btn-success" onclick="openapprovemodal('{{$bill->id}}');">APPROVE</button></td>
		<td><button type="button" class="btn btn-danger" onclick="openrejectmodal('{{$bill->id}}');">REJECT</button></td>
     
	   </tr>
		@endforeach
	</tbody>
	
</table>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><b>CANCELATION REASON</b></h4>
      </div>
      <div class="modal-body">
       <form action="/rejectbill" method="POST">
       	{{csrf_field()}}
       	<table class="table">
       		<tr>
       			<input type="hidden" name="billid" id="billid">
       			<td><strong>REMARKS</strong></td>
       			<td><textarea name="remarks" class="form-control" placeholder="Enter Cancelation Reason" required=""></textarea></td>
       		</tr>
       		<tr>
       			<td colspan="2" style="text-align:right;">
       				<button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to Reject This Bill?');">REJECT</button>
       			</td>
       		</tr>
       		
       	</table>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	function openapprovemodal(billid){
	 var r = confirm("Do You Want to approve this bill?");
if (r == true) {
      location.href="/approvebill/"+billid;
} else {
  
} 
	}

function openrejectmodal(billid)
{
     $("#billid").val(billid);
     $("#myModal").modal('show');

 }
</script>

@endsection