@extends('layouts.account')
@section('content')

<style type="text/css">
  .mybox{
    padding-bottom: 0px;
    padding-top: 0px;
     background-color: #29678c;
    color: #fff;
  }

.b {
    display: inline-block;
    width: 100px;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}
.acc{
color: #089d89;
font-size: 14px;
text-decoration: underline;
}

label {font-size: 12px;}
</style>

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">VIEW EXPENSE ENTRY DETAILS</td>
	</tr>
	
</table>
<div class="well" style="font-size: 20px;background-color: violet;">
  <div class="table-responsive">
    <table class="table">
     <tr>

     <td>
      	@if(Auth::user()->usertype=='MASTER ADMIN')
      	<a href="/reports/transactionreport?fromdate=& todate=& user={{$empid}} &projectname=& status=" style="color: #2e1a93;text-decoration:underline;"><strong>TOTAL PAID AMOUNT TILL DATE :</strong>  {{$totalamt}}</a>
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
<!-- 
<table class="table">
	 <tr>

	 
	   	
	   </tr>
	
</table> -->

<div class="row">
  @foreach($expenseentry as $expenseentry1)
  <div class="col-lg-6">
    <div class="box box-primary">
            <div class="box-header  bg-info mybox">
              <h5>PROJECT NAME : {{$expenseentry1->projectname}}</h5>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <label>EXPENSE ENTRY ID :</label>
                  <span  class="label btn-success">#{{$expenseentry1->id}}</span>
                </div>
                <div class="col-md-6">
                  <label>FOR EMPLOYEE : <span class="text-muted"> {{$expenseentry1->for}}</span></label>
                </div>
              </div>
               <div class="row">
                <div class="col-md-6">
                 <label> FOR CLIENT : <span class="text-muted"> {{$expenseentry1->clientname}}</span></label>
                </div>
                <div class="col-md-6">
                  <label>FOR EMPLOYEE : <span class="text-muted"> {{$expenseentry1->for}}</span></label>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                 <label> EXPENSE HEAD NAME : <span class="text-muted"> {{$expenseentry1->expenseheadname}}</span></label>
                </div>
                <div class="col-md-6">
                  <label>PARTICULAR NAME : <span class="text-muted"> {{$expenseentry1->particularname}}</span></label>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                 <label> VENDOR NAME : <span class="text-muted"> {{$expenseentry1->vendorname}}</span></label>
                </div>
                <div class="col-md-6">
                  <label>AMOUNT : <span class="text-muted acc"> Rs. {{$expenseentry1->amount}}</span></label>
                </div>
              </div>
          
              <div class="row">
                <div class="col-md-6">
                 <label> APPROVAL AMOUNT : <span class="text-muted acc"> Rs. {{$expenseentry1->approvalamount}}</span></label>
                </div>
                <div class="col-md-6">
                  <label>APPROVED BY : <span class="text-muted"> {{$expenseentry1->approvedbyname}}</span></label>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                 <label> DATE FROM : <span class="text-muted"> {{$expenseentry1->fromdate}}</span></label>
                </div>
                <div class="col-md-6">
                  <label>DATE TO : <span class="text-muted"> {{$expenseentry1->todate}}</span></label>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                 <label> STATUS : <span class="text-muted label label-info">  
                  {{$expenseentry1->status}}</span>
                </label>
                </div>
                <div class="col-md-6">
                  <label>TYPE OF EXPENSES : 
                     @if($expenseentry1->type)
                    <span class="text-muted  label label-warning"> {{$expenseentry1->type}}</span>
                     @endif
                  </label>
                </div>
              </div>

               <div class="row">
                <div class="col-md-6">
                 <label> DATE FROM : <span class="text-muted"> {{$expenseentry1->fromdate}}</span></label>
                </div>
                <div class="col-md-6">
                  <label>DATE TO : <span class="text-muted"> {{$expenseentry1->todate}}</span></label>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                 <label> DESCRIPTION :  
               @if($expenseentry1->towallet=='YES')
                <span class="b text-muted"  title="{{$expenseentry1->description}}">{{$expenseentry->description}} ||Requested to Transfer the balance to wallet.
                </span>
                      @else
                        <span class="b text-muted" title="{{$expenseentry1->description}}">{{$expenseentry1->description}}</span>
                      @endif
                </label>
                </div>
                <div class="col-md-6">
                  <label>TRANSFER TO WALLET REQUEST : <span class="text-muted"> {{$expenseentry1->towallet}}</span></label>
                </div>
              </div>


               <div class="row">
                <div class="col-md-6">
                <!-- <label>HOD REMARKS: <span class="text-muted"> {{$expenseentry1->hodremarks}}</span></label> -->
                </div>
                <div class="col-md-6">
                  <label>created_at : <span class="text-muted"> {{$expenseentry1->created_at}}</span></label>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label>UPLOADED FILE: </label> 

                  @if($expenseentry1->uploadedfile)
                         <a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry1->uploadedfile )}}" target="_blank">
                        <img title="click to view the image" style="height:50px;width:50px;" alt="no uploadedfile" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry1->uploadedfile )}}"></a>
                       
                         <a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry1->uploadedfile )}}" download>
                          <button class="btn"><i class="fa fa-download"></i> Download</button>
                         </a>
                  @else
                  N/A
                  @endif
                </div>
                <div class="col-md-6">
                  <label>Approve :  
    @if($expenseentry1->status != "PENDING" && $expenseentry1->towallet=='YES')

        <strong class="text-muted">Can't Revert the Wallet Added Amount</strong>
     @else
    
     <select id="approvepending" class="form-control" onchange="approve(this.value,'{{$expenseentry1->id}}','{{$expenseentry1->amount}}')">
		 		<option value="">select a type</option>
		 		<option value="HOD PENDING" {{ ( $expenseentry1->status == "HOD PENDING") ? 'selected' : '' }}>HOD PENDING</option>

		 		<option value="PENDING" {{ ( $expenseentry1->status == "PENDING") ? 'selected' : '' }}>HOD APPROVED</option>
		 		<option value="CANCELLED" {{ ( $expenseentry1->status == "CANCELLED") ? 'selected' : '' }}>CANCELLED</option>
		 	</select>
    
     @endif</label>
                </div>
              </div>

            </div>
          </div>
  </div>
@endforeach

</div>

<!-- @foreach($expenseentry as $expenseentry)
<div class="well countwell">
	<div class="table-responsive">
<table class="table">
	<tr>
		<td><strong>EXPENSE ENTRY ID :</strong></td>
		<td><strong>#{{$expenseentry->id}}</strong></td>
		<td><strong>FOR EMPLOYEE :</strong></td>
		<td><strong>{{$expenseentry->for}}</strong></td>
		
	</tr>

	<tr>
		<td><strong>PROJECT NAME</strong></td>
		@if($expenseentry->projectname!='')
		<td width="40%"><strong>{{$expenseentry->projectname}}</strong></td>
		@else
        <td width="40%"><strong>OTHERS</strong></td>
		@endif
		<td><strong>FOR CLIENT</strong></td>
		<td><strong>{{$expenseentry->clientname}}</strong></td>
		
	</tr>
	<tr>
		<td><strong>EXPENSE HEAD NAME</strong></td>
		<td><strong>{{$expenseentry->expenseheadname}}</strong></td>
		<td><strong>PARTICULAR NAME</strong></td>
		<td><strong>{{$expenseentry->particularname}}</strong></td>
		
	</tr>
	<tr>
		<td><strong>VENDOR NAME</strong></td>
		<td><strong>{{$expenseentry->vendorname}}</strong></td>
		<td><strong>AMOUNT</strong></td>
		<td style="background-color: chartreuse;"><strong>{{$expenseentry->amount}}</strong></td>
		
	</tr>

	<tr>
		<td><strong>APPROVAL AMOUNT</strong></td>
		<td><strong>{{$expenseentry->approvalamount}}</strong></td>
		<td><strong>APPROVED BY</strong></td>
		<td><strong>{{$expenseentry->approvedbyname}}</strong></td>
		
	</tr>
	@if($expenseentry->version=='NEW')
     @if($expenseentry->type!="OTHERS")
     <tr class="bg-info">
		<td><strong>DATE FROM</strong></td>
		<td ><strong>{{$expenseentry->fromdate}}</strong></td>
		<td><strong>DATE TO</strong></td>
		<td ><strong>{{$expenseentry->todate}}</strong></td>
		
	</tr>
	@else
	<tr class="bg-info">
		<td><strong>FOR DATE</strong></td>
		<td ><strong>{{$expenseentry->date}}</strong></td>
		<td></td>
		<td ></td>
		
	</tr>

	@endif
	@else
	<tr class="bg-info">
		<td><strong>DATE FROM</strong></td>
		<td ><strong>{{$expenseentry->fromdate}}</strong></td>
		<td><strong>DATE TO</strong></td>
		<td ><strong>{{$expenseentry->todate}}</strong></td>
		
	</tr>
    @endif

	<tr>
		<td><strong>STATUS</strong></td>
		<td><strong><span class="label label-warning">{{$expenseentry->status}}</span></strong></td>
		
		 <td><strong>TYPE OF EXPENSES</strong></td>
		<td><strong><span class="label label-warning">{{$expenseentry->type}}</span></strong></td>
	</tr>
	<tr>
	    <td><strong>DESCRIPTION</strong></td>
	    @if($expenseentry->towallet=='YES')
	    <td style="background-color: skyblue;"><strong>{{$expenseentry->description}} ||Requested to Transfer the balance to wallet.</strong></td>
	    @else
         <td style="background-color: skyblue;"><strong>{{$expenseentry->description}}</strong></td>
	    @endif
	    <td><strong>TRANSFER TO WALLET REQUEST</strong></td>
	    <td class="bg-gray"><strong>{{$expenseentry->towallet}}</strong></td>
	</tr>
	<tr>
		<td><strong>UPLOADED FILE</strong></td>
		 <td>
		 	<a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}" target="_blank">
		 	<img title="click to view the image" style="height:60px;width:60px;" alt="no uploadedfile" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}"></a>
		 
		 	 <a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}" download>
		 	 	<button class="btn"><i class="fa fa-download"></i> Download</button>
		 	 </a>
		 </td>
		 <td><strong>APPROVE</strong></td>
		 @if($expenseentry->status != "PENDING" && $expenseentry->towallet=='YES')

        <td> <strong>Can't Revert the Wallet Added Amount</strong></td> 
		 @else
		 <td>
		 	<select id="approvepending" class="form-control" onchange="approve(this.value,'{{$expenseentry->id}}','{{$expenseentry->amount}}')">
		 		<option value="">select a type</option>
		 		<option value="HOD PENDING" {{ ( $expenseentry->status == "HOD PENDING") ? 'selected' : '' }}>HOD PENDING</option>

		 		<option value="PENDING" {{ ( $expenseentry->status == "PENDING") ? 'selected' : '' }}>HOD APPROVED</option>
		 		<option value="CANCELLED" {{ ( $expenseentry->status == "CANCELLED") ? 'selected' : '' }}>CANCELLED</option>
		 	</select>
		 </td>
		 @endif
		 
	</tr>
        <tr>
	   	<td><strong>HOD NAME:-</strong></td>
	   	<td><strong>{{$expenseentry->hodname}}</strong></td>
	   	<td><strong>created_at</strong></td>
	   	<td><strong>{{$expenseentry->created_at}}</strong></td>
	   </tr>
	   <tr>
	   	<td style="width: 25%;"><strong>HOD REMARKS:-</strong></td>
	   	<td style="width: 25%;"><strong>{{$expenseentry->hodremarks}}</strong></td>
	   	
	   </tr>
	 <tr>
	   	<td colspan="4" style="text-align: center;">
	   		 
	   	</td>
	   </tr>
	
</table>

</div>
</div>
@endforeach -->

</div>







<div id="partiallyapproved" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PARTIALLY APPROVED</h4>
      </div>
      <div class="modal-body">
         <form action="/changepartiallyapprovedexpense" method="post">
          {{csrf_field()}}
         	<table class="table">
            <input type="hidden" name="pid" id="pid">
            <tr>
              <td><strong>AMOUNT</strong></td>
              <td>
                <input type="text" id="amt2" class="form-control" readonly>
              </td>
            </tr>
         		<tr>
         			<td><strong>ENTER PARTIAL AMOUNT</strong></td>
         			<td>
         				<input type="number" name="amount" class="form-control">
         			</td>
         			
         		</tr>
            <tr>
              <td><strong>REMARKS</strong></td>
              <td>
                <textarea class="form-control" name="remarks"></textarea>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: left;"><button class="btn btn-success" type="submit">SUBMIT</button></td>
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

<div class="modal fade" id="cancelmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CANCEL THIS REQUISITION</h4>
        </div>
        <div class="modal-body">
        	<form action="" method="post">
        		{{csrf_field()}}
          <table class="table">
             <input type="hidden" id="cid">
    
          	<tr>
          		<td><strong>CANCELATION REASON</strong></td>
          		<td>
          			<textarea name="cancelreason" id="cancelreason" class="form-control"></textarea>
          		</td>
          	</tr>
          	<tr>
          		<td colspan="2"><button type="button" onclick="cancelexpense();" class="btn btn-success">SUBMIT</button></td>
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
  <div class="modal fade" id="hodaprvmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Approve With Remarks</h4>
        </div>
        <div class="modal-body">
        	<form action="" method="post">
        		{{csrf_field()}}
          <table class="table">
             <input type="hidden" id="hodaprvid">
    
          	<tr>
          		<td><strong>REMARKS</strong></td>
          		<td>
          			<textarea name="aprvremark" id="aprvremark" class="form-control"></textarea>
          		</td>
          	</tr>
          	<tr>
          		<td colspan="2"><button type="button" onclick="approveexpense();" class="btn btn-success">SUBMIT</button></td>
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

	 function cancelexpense()
	 {   
           var remarks=$("#cancelreason").val();
	       var type='CANCELLED';
	 	   var cid=$("#cid").val();
          
	 	   ajaxapprove(type,cid,0,remarks);

	 }
	 function approveexpense()
	 {   
           var remarks=$("#aprvremark").val();
	       var type='PENDING';
	 	   var hodaprvid=$("#hodaprvid").val();

	 	   ajaxapprove(type,hodaprvid,0,remarks);

	 }
	function approve(type,id,amt) {
		 if(type=='APPROVED')
		 {
		      ajaxapprove(type,id,amt,'remarks');
		 }
		 else if(type=='PENDING')
		 {
		 	//alert('hod approved');
		 	$('#hodaprvid').val(id);
		 	$("#hodaprvmodal").modal('show');
		 	   //ajaxapprove(type,id,0,'remarks');
		 }
		 else if(type=='PARTIALLY APPROVED')
		 {
		 	    $("#pid").val(id);
		 	    $("#amt2").val(amt);
		 	    $("#partiallyapproved").modal("show");
		 }
		 else if(type=='CANCELLED')
		 {
		 	   $('#cid').val(id);
		 	   $("#cancelmodal").modal('show');
		 	  //ajaxapprove(type,id,0);
		 }
		
	}


	function ajaxapprove(type,id,amt,remarks)
	{
		//alert(remarks);
	    $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
            });
             

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxapprovehod")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      type : type,
                      id:id,
                      remarks:remarks,
                      amt:amt
                     },

               success:function(data) { 
               var count = $('.countwell').length;
                   if(count==1){
                   	 window.location = "/pendingexpenseentrydetailview/"+data.employeeid;
                   }
                  else{
                  	window.location = "/viewdetailshodexpenseentrybydate/"+data.employeeid+"/"+data.date;
                  }

               }
           });
	}
</script>
@endsection