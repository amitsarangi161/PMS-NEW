@extends('layouts.account')
@section('content')

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">VIEW EXPENSE ENTRY DETAILS</td>
	</tr>
	
</table>



<div class="well">
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
		<td width="40%"><strong>{{$expenseentry->projectname}}</strong></td>
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
		<td><strong>REMARKS</strong></td>
		<td><strong>{{$expenseentry->remarks}}</strong></td>
		<td><strong>APPROVED BY</strong></td>
		<td><strong>{{$expenseentry->approvedbyname}}</strong></td>
		
	</tr>
	<tr class="bg-info">
		<td><strong>DATE FROM</strong></td>
		<td><strong>{{$expenseentry->fromdate}}</strong></td>
		<td><strong>DATE TO</strong></td>
		<td><strong>{{$expenseentry->todate}}</strong></td>
		
	</tr>

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
		 	<img title="click to view the image" style="height:100px;width:150px;" alt="no uploadedfile" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}"></a>
		 
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
</table>

</div>
</div>

@if($expenseentry->type=='LABOUR PAYMENT')
@php
  $labours=\App\expenseentrylabour::select('labours.*')
          ->leftJoin('labours','expenseentrylabours.labourid','=','labours.id')
          ->where('expenseentrylabours.expid',$expenseentry->id)
          ->get();

  $labourimages=\App\expenseentrylabourimage::where('expid',$expenseentry->id)->get();
  @endphp
   @if(count($labours)>0)


 
    	<table class="table">
    		<tr class="bg-blue">
    			<td class="text-center">LABOUR DETAILS</td>
    		</tr>
    		
    	</table>
    	   <div class="table-responsive">
    	<table class="table table-responsive table-hover table-bordered table-striped">
    		<thead>
    			<tr class="bg-navy">
    				<td>ID</td>
    				<td>LABOUR NAME</td>
    				<td>ADDRESS</td>
    				<td>MOBILE NO</td>
    			</tr>
    		</thead>
    		<tbody>
    			@foreach($labours as $labour)
    			   <tr>
    			   	<td>{{$labour->id}}</td>
    			   	<td>{{$labour->labourname}}</td>
    			   	<td>{{$labour->address}}</td>
    			   	<td>{{$labour->mobile}}</td>
    			   </tr>
    			@endforeach
    		</tbody>

    		
    	</table>
    	
        </div>
   
   	
  
   @endif
@if(count($labourimages)>0)
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">WORKING LABOUR IMAGE</td>
		
	</tr>
	
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
			<td>IMAGES</td>
			<td>DOWNLOAD</td>
		</tr>
	</thead>
	<tbody>

   @foreach($labourimages as $labourimage)
   <tr>
   	<td>{{$labourimage->id}}</td>
   	<td>
   		 <a href="{{asset('img/labourimages/'.$labourimage->image)}}" target="_blank">
          	<img style="height:70px;width:95px;" src="{{asset('img/labourimages/'.$labourimage->image)}}">
         </a>
   	</td>
   	<td>
   		<a href="{{asset('img/labourimages/'.$labourimage->image)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a>
   	</td>
   </tr>
   

   @endforeach
   </tbody>

   </table>
@endif
@endif

@if($vendor)
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">VENDOR DETAILS</td>
	</tr>
	
</table>

<div class="well">
<table class="table">
	<tr>
		<td><strong>VENDOR ID</strong></td>
		<td><strong>#{{$vendor->id}}</strong></td>
		<td><strong>VENDOR NAME</strong></td>
		<td><strong>{{$vendor->name}}</strong></td>
	</tr>

	<tr>
		<td><strong>VENDOR MOBILE</strong></td>
		<td><strong>{{$vendor->mobile}}</strong></td>
		<td><strong>VENDOR DETAILS</strong></td>
		<td><strong>{{$vendor->details}}</strong></td>
	</tr>
	<tr>
		<td><strong>VENDOR ID PROOF</strong></td>
		   <td> <a href="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}" target="_blank">
			<img title="click Here to view Full image" style="height:70px;width:95px;" src="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}"></a>
			
				<a href="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}" download>
		 	 	<button class="btn"><i class="fa fa-download"></i> Download</button>
		 	     </a>
			</td>
		
		<td><strong>VENDOR PHOTO</strong></td>
		<td><a href="{{ asset('/img/vendor/'.$vendor->photo )}}" target="_blank">
		<img title="click Here to view Full image" style="height:70px;width:95px;" src="{{ asset('/img/vendor/'.$vendor->photo )}}"> </a>
		
			<a href="{{ asset('/img/vendor/'.$vendor->photo )}}" download>
		 	 	<button class="btn"><i class="fa fa-download"></i> Download</button>
		 	 </a>
		</td>
	   
	</tr>
	<tr>
		<td><strong>VENDOR ADDED BY</strong></td>
		<td><strong>{{$vendor->name}}</strong></td>
		<td><strong>CREATED AT</strong></td>
		<td><strong>{{$vendor->created_at}}</strong></td>
	</tr>
</table>
@endif
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

<script type="text/javascript">

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
               
                      location.reload();

               }
           });
	}
</script>
@endsection