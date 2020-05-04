@extends('layouts.app')
@section('content')
@php
$paid=$paidamounts->sum('amount');

$bal=($requisitionheader->approvalamount)-$paid;
@endphp

<style type="text/css">
	

	.b {
    white-space: nowrap; 
    width: 150px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">REQUISITION DETAILS</td>
	 </tr>
</table>


<div class="well">
	<div class="table-responsive">
	<table class="table" style="background-color: silver;">
		<tr>
			<td><strong>REQUISITION ID</strong></td>
			<td>#{{$requisitionheader->id}}</td>
			<td><strong>PROJECT NAME</strong></td>
			@if($requisitionheader->projectname!='')
			<td width="40%">{{$requisitionheader->projectname}}</td>
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
			<td><strong>TOTAL AMOUNT PAID</strong></td>
			<td><span class="label label-primary">{{$paid}}</span></td>
			<td><strong>BALANCE AMOUNT</strong></td>
			<td><span class="label label-danger">{{$bal}}</span></td>
		  </tr>
		  <tr>
			<td><strong>APPROVED BY</strong></td>
			@if($requisitionheader->approvedby=='')
			   <td>NOT APPROVED</td>
			@else
              <td>{{$requisitionheader->approvedby}}</td>
			@endif
			
			<td><strong>STATUS</strong></td>
			<td><strong class="bg-blue">{{$requisitionheader->status}}</strong></td>
			
		  </tr>
		  @if($requisitionheader->status=='CANCELLED')
           <td><strong>CANCELLED BY</strong></td>
			<td>{{$requisitionheader->cancelledbyname}}</td>
			<td><strong>CANCEL REASON</strong></td>
			<td>{{$requisitionheader->cancelreason}}</td>

		  @endif
		  <tr>
		  	<td><strong>DATE FROM</strong></td>
		  	<td><strong class="bg-navy">{{$requisitionheader->datefrom}}</strong></td>
		  	<td><strong>DATE TO</strong></td>
		  	<td><strong class="bg-navy">{{$requisitionheader->dateto}}</strong></td>
		  </tr>

		  <tr>
			
			<td><strong>CREATED_AT</strong></td>
			<td>{{$requisitionheader->created_at}}</td>
			<td><strong>DESCRIPTION</strong></td>
			<td>{{$requisitionheader->description}}</td>
		  </tr>
          @if($requisitionheader->status=='CANCELLED')
		  <tr>
		  	 <td><strong>CANCELLED REASON</strong></td>
		  	 <td>{{$requisitionheader->cancelreason}}</td>
		  	 <td></td>
		  	 <td></td>
		  </tr>
		  @endif
		
	</table>
	
</div>
</div>

<div class="table-responsive">

	<table class="table table-responsive table-hover table-bordered table-striped">

		<thead class="bg-navy">
			<tr>
				<th>SL_NO</th>
				<th>EXPENSE HEAD</th>
				<th>PARTICULAR</th>
				<th>DESCRIPTION</th>
				<th>PAY TO</th>
				<th>AMOUNT</th>
				<th>APPROVED AMOUNT</th>
				<th>REMARKS</th>
				<th>STATUS</th>
				
				
			</tr>
		</thead>
		<tbody>
			@foreach($requisitions as $key=>$requisition)
			<tr>
				<td>{{$key+1}}</td>
				<td>{{$requisition->expenseheadname}}</td>
				<td>{{$requisition->particularname}}</td>
				<td>{{$requisition->description}}</td>
				  @if($requisition->payto=='TO VENDOR')
            <td><button type="button" class="btn btn-warning" onclick="openvendordetails('{{$requisition->vendorid}}','{{$requisition->vendorname}}','{{$requisition->mobile}}','{{$requisition->bankname}}','{{$requisition->acno}}','{{$requisition->branchname}}','{{$requisition->ifsccode}}','{{trim(preg_replace('/\s+/', ' ',$requisition->details))}}','{{$requisition->photo}}','{{$requisition->vendoridproof}}')">
                   {{$requisition->payto}}</td>
                  @else
                   <td><strong>{{$requisition->payto}}</strong></td>
                  @endif
				<td>{{$requisition->amount}}</td>
				<td>{{$requisition->approvedamount}}</td>
				<td><p class="b" title="{{$requisition->remarks}}"> 
				<td>{{$requisition->approvestatus}}</td>
				
				

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
				<td><strong>Rs.{{$requisitions->sum('approvedamount')}}</strong></td>
				<td></td>
				<td></td>
				
			</tr>
		</tfoot>
		
	</table>
	
</div>

<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">VIEW PAYMENTS</td>
	 </tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped">

		<thead class="bg-navy">
			<tr>
				<th>SL_NO</th>
				<th>AMOUNT</th>
				<th>PAYMENT METHOD</th>
				<th>REMARKS</th>
				<th>PAYMENT STATUS</th>
				<th>DATE OF PAYMENT</th>
				<th>CREATED_AT</th>
				
				
				
			</tr>
		</thead>
		<tbody>
			@foreach($paidamounts as $key=>$paidamount)
			<tr>
				<td>{{$key+1}}</td>
				<td>{{$paidamount->amount}}</td>
				<td>{{$paidamount->paymenttype}}</td>
				<td>{{$paidamount->remarks}}</td>
				<td>{{$paidamount->paymentstatus}}</td>
				<td>{{$paidamount->dateofpayment}}</td>
				<td>{{$paidamount->created_at}}</td>
				

			</tr>

			@endforeach
		</tbody>
		<tfoot>
			<tr class="bg-gray">
				<td>TOTAL</td>
				<td><strong>Rs.{{$paidamounts->sum('amount')}}</strong></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tfoot>
		
	</table>


</div>


<div id="vendormodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><strong>VENDOR DETAILS</strong></h4>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td><strong>VENDOR ID#</strong></td>
            <td><strong id="vendorid1"></strong></td>
            <td><strong>VENDOR NAME</strong></td>
            <td><strong id="vendorname1"></strong></td>
          </tr>
          <tr>
            <td><strong>VENDOR MOBILE</strong></td>
            <td><strong id="vendormobile1"></strong></td>
            <td><strong>BANK NAME</strong></td>
            <td><strong id="bankname1"></strong></td>
          </tr>
          <tr>
            <td><strong>AC NO</strong></td>
            <td><strong id="acno1"></strong></td>
            <td><strong>BRANCH NAME</strong></td>
            <td><strong id="branchname1"></strong></td>
          </tr>
          <tr>
            <td><strong>IFSC CODE</strong></td>
            <td><strong id="ifsccode1"></strong></td>
            <td><strong>DETAILS</strong></td>
            <td><strong id="details1"></strong></td>
            
          </tr>
          <tr>
            <td><strong>PHOTO</strong></td>
            <td id="photo1"></td>
            <td><strong>ID PROOF</strong></td>
            <td id="idproof1"></td>
          </tr>
          
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	function openvendordetails(vendorid,vendorname,mobile,bankname,acno,branchname,ifsccode,details,photo,vendoridproof,totalpay,paid,balance,expenseheadid,particularid)
   {
            $("#expenseheadid1").val(expenseheadid);
            $("#particularid1").val(particularid);
             
             $("#totvpaidamt").val(paid);
             $("#vbalance").val(balance);
             $("#totvpayamt").val(totalpay);
             $("#vendorid1").html(vendorid);
             $("#vendorid2").val(vendorid);
             $("#vendorname1").html(vendorname);
             $("#vendormobile1").html(mobile);
             $("#bankname1").html(bankname);
             $("#acno1").html(acno);

             $("#branchname1").html(branchname);
             $("#ifsccode1").html(ifsccode);
             $("#details1").html(details);
             $("#photo1").html('<a href="/img/vendor/'+photo+'" target="_blank"><img src="/img/vendor/'+photo+'" style="height:70px;width:95px;" alt="click to view"></a>');

             $("#idproof1").html('<a href="/img/vendor/'+vendoridproof+'" target="_blank"><img src="/img/vendor/'+vendoridproof+'" style="height:70px;width:95px;" alt="click to view"></a>');

             $("#vendormodal").modal('show');
   }
</script>

@endsection