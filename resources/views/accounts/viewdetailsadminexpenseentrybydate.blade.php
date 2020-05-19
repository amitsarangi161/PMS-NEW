@extends('layouts.account')
@section('content')

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
@foreach($expenseentry as $expenseentry)
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
		<td ><strong id="datenew">{{$expenseentry->date}}</strong>&nbsp;&nbsp;
			@if(Auth::user()->usertype=='MASTER ADMIN')
			<button type="button" class="btn btn-primary" onclick="openeditmodal('{{$expenseentry->id}}','{{$expenseentry->date}}');"><i class="fa fa-pencil"></i></button>
			@endif

		</td>
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
		 	<img title="click to view the image" style="height:50px;width:50px;" alt="no uploadedfile" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}"></a>
		 
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
		 		<option value="PENDING" {{ ( $expenseentry->status == "PENDING") ? 'selected' : '' }}>PENDING</option>
		 		<option value="APPROVED" {{ ( $expenseentry->status == "APPROVED") ? 'selected' : '' }}>APPROVED</option>

		 		<option value="PARTIALLY APPROVED" {{ ( $expenseentry->status == "PARTIALLY APPROVED") ? 'selected' : '' }}>PARTIALLY APPROVED</option>
		 		<option value="CANCELLED" {{ ( $expenseentry->status == "CANCELLED") ? 'selected' : '' }}>CANCELLED</option>
		 	</select>
		 </td>
		 @endif
	</tr>

        <tr>
	   	<td><strong>HOD REMARKS:-</strong></td>
	   	<td><strong>{{$expenseentry->hodremarks}}</strong></td>
	   	<td><strong>created_at</strong></td>
	   	<td><strong>{{$expenseentry->created_at}}</strong></td>
	   </tr>
	   
	
</table>

</div>
</div>
@endforeach








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


  <div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Date</h4>
      </div>
      <div class="modal-body">
        <table class="table">
        	<tr>
        		<input type="hidden" id="chid">
        		<td><strong>DATE</strong></td>
        		<td><input type="text" id="changedate" class="datepicker form-control readonly"></td>
        		<td>
        			<button type="button" class="btn btn-success" onclick="ajaxchangedate();">CHANGE</button>
        		</td>
        	</tr>
        	
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>

<script type="text/javascript">
	

	function ajaxchangedate(){

		var chid=$("#chid").val();
		var changedate=$("#changedate").val();

         	 $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
            });
             

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxexpchangedate")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      id:chid,
                      date:changedate
                     },

               success:function(data) { 
                      location.reload();

               }
           });
	}

	function openeditmodal(id,date)
	{
		 //alert(id+date);
         $("#changedate").val(date);
		 $("#chid").val(id);
		 $("#editModal").modal('show');
		 
	}

	 function cancelexpense()
	 {   
           var remarks=$("#cancelreason").val();
	       var type='CANCELLED';
	 	   var cid=$("#cid").val();
          
	 	   ajaxapprove(type,cid,0,remarks);

	 }
	function approve(type,id,amt) {
		 if(type=='APPROVED')
		 {
		      ajaxapprove(type,id,amt,'remarks');
		 }
		 else if(type=='PENDING')
		 {
		 	   ajaxapprove(type,id,0,'remarks');
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
         	 $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
            });
             

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxapprove")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      type : type,
                      id:id,
                      remarks:remarks,
                      amt:amt
                     },

               success:function(data) { 
               
                       var count = $('.countwell').length;
                       alert(count);
                   if(count==1){
                   	 window.location = "/adminpendingexpenseentryview/"+data.employeeid;
                   }
                  else{
                  	window.location = "/viewdetailsadminexpenseentrybydate/"+data.employeeid+"/"+data.date;
                  }

               }
           });
	}
</script>
@endsection