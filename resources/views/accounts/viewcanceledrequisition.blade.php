@extends('layouts.account')
@section('content')

<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">REQUISITION DETAILS</td>
	 </tr>
</table>
@php
    $sumstatus=0;
    foreach($requisitions as $requisition)
    {
    	  if($requisition->approvestatus=='PENDING')
    	  {
             $sumstatus=$sumstatus+1;
    	  }
    	  else
    	  {
               $sumstatus=$sumstatus+0;
    	  }
    }


  $pid=$requisitionheader->projectid;
if($pid>0){
$requisitionheader1=\App\requisitionheader::where('projectid',$pid)
                      
                        ->where(function($query){
                         $query->where('status','!=','PENDING');
                         $query->orWhere('status','!=','CANCELLED');
                         
                       })
                        ->get();
$payment=$requisitionheader1->sum('approvalamount');
$projectc=\App\project::where('id',$pid)->first();
$cost=$projectc->cost;
$balancep=$cost-$payment;  
}

@endphp
<div class="well" style="font-size: 20px;background-color: violet;">
  <div class="table-responsive">
    <table class="table">
      <tr>

      <td>
        @if(Auth::user()->usertype=='MASTER ADMIN')
        <a href="/reports/transactionreport?fromdate=& todate=& user={{$requisitionheader->userid}} &projectname=& status=" style="color: #2e1a93;text-decoration:underline;"><strong>TOTAL PAID AMOUNT TILL DATE :</strong>  {{$totalamt}}</a>
        @else<strong>TOTAL PAID AMOUNT TILL DATE :</strong>  {{$totalamt}}
        @endif
      </td>
      <td><strong>TOTAL EXPENSE TILL DATE :</strong> {{$totalamtentry}}</td>
      <td><strong>BALANCE AMOUNT :</strong> {{$bal}}</td>
      
      <td><img src="{{asset('wallet.png')}}" style="height: 40px;width: 40px;">Rs. {{$walletbalance}}</td>
      <td><button type="button" class="btn btn-primary" onclick="opennewwindiow();">VIEW EXPENSES</button></td>
      </tr>
      
    </table>
    
  </div>
  
</div>
<div class="well">
	<div class="table-responsive" >
	<table class="table" style="background-color: silver;">
		<tr>
			<td><strong>REQUISITION ID</strong></td>
			<td>#{{$requisitionheader->id}}</td>
			<td><strong>PROJECT NAME</strong></td>
			@if($requisitionheader->projectname!='')
			<td>{{$requisitionheader->projectname}}</td>
			@else
            <td>OTHERS</td>
			@endif
		</tr>
         <tr>
			<td><strong>NAME</strong></td>
			<td>{{$requisitionheader->employee}}</td>
			<td><strong>AUTHOR</strong></td>
			<td>{{$requisitionheader->author}}</td>
		 </tr>
		  <tr>
			<td><strong>TOTAL AMOUNT</strong></td>
			<td>{{$requisitionheader->totalamount}}</td>
			<td><strong>APPROVAL AMOUNT</strong></td>
			<td>{{$requisitionheader->approvalamount}}</td>
		  </tr>
		  <tr>
			<td><strong>APPROVED BY</strong></td>
			@if($requisitionheader->approvedby=='')
			   <td>NOT APPROVED</td>
			@else
              <td>{{$requisitionheader->approvedby}}</td>
			@endif
			
			<td><strong>STATUS</strong></td>
			<td>{{$requisitionheader->status}}</td>
			<td></td>
			<td></td>
		  </tr>
		   @if($requisitionheader->status=='CANCELLED')
           <td><strong>CANCELLED BY</strong></td>
			<td>{{$requisitionheader->cancelledbyname}}</td>
			<td><strong>CANCEL REASON</strong></td>
			<td>{{$requisitionheader->cancelreason}}</td>

		  @endif

		  <tr>
			
			<td><strong>CREATED_AT</strong></td>
			<td>{{$requisitionheader->created_at}}</td>
			<td><strong>DESCRIPTION</strong></td>
			<td>{{$requisitionheader->description}}</td>
		  </tr>
		<tr>
         <td><strong>Author Name</strong></td>
         <td>{{$requisitionheader->reqaddby}}</td>
         <td>Support Document</td>
         <td>
              <a href="{{asset('/image/requistion/supportdocument/'.$requisitionheader->supportdocument)}}" class="btn btn-primary btn-sm" download style="color: #fff;">
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a>
         </td>
      </tr>
	</table>
	</div>
</div>


<div class="well">
<div class="table-responsive" >
	<table class="table table-responsive table-hover table-bordered table-striped" style="background-color: turquoise;">

		<thead class="bg-navy">
			<tr>
				<th>SL_NO</th>
				<th>EXPENSE HEAD</th>
				<th>PARTICULAR</th>
				<th>DESCRIPTION</th>
				<th>PAY TO</th>
				<th>AMOUNT</th>
			</tr>
		</thead>
		<tbody>
			@foreach($requisitions as $key=>$requisition)
			<tr>
				<td>{{$key+1}}</td>
				<td>{{$requisition->expenseheadname}}</td>
				<td>{{$requisition->particularname}}</td>
				<td>{{$requisition->description}}</td>
				<td>{{$requisition->payto}}</td>
				<td>{{$requisition->amount}}</td>

			</tr>

			@endforeach
		</tbody>
		<tfoot>
			<tr class="bg-gray">
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><strong>TOTAL AMOUNT</strong></td>
				<td><strong>Rs.{{$requisitions->sum('amount')}}</strong></td>
			</tr>
		</tfoot>
		
	</table>
	</div>
</div>
<div class="well">
	<table class="table">
		<tr>
			<td ><button type="button" onclick="changestatus();" class="btn btn-danger btn-lg center-block mybtn">CHANGE STATUS</button></td>
		</tr>
		
	</table>
	
</div>

<div class="modal fade" id="changestatus" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CHANGE REQUISITION STATUS</h4>
        </div>
        <div class="modal-body">
          <form action="/changerequisitionstatusfromcancelled/{{$requisitionheader->id}}" method="post">
            {{csrf_field()}}
          <table class="table">
            <tr>
              <td><strong>SELECT A STATUS *</strong></td>
              <td>
                <select class="form-control" name="status" required="">
                   <option value="">select a status</option>
                   <option value="PENDING">PENDING</option>
                   <option value="PENDING MGR">PENDING MGR</option>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="2"><button type="submit" class="btn btn-success btn-lg">CHANGE</button></td>
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
  function changestatus()
  {
      $("#changestatus").modal('show');
  }
</script>


@endsection