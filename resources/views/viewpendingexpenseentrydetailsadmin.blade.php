@extends('layouts.app')
@section('content')

  	@php
            $expenseentriespaginations=\App\expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                       ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.status','HOD PENDING')
                       ->where('expenseentries.employeeid',$expenseentry->employeeid)
                      ->groupBy('expenseentries.id')
                      ->get();

	   	@endphp

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">VIEW EXPENSE ENTRY DETAILS</td>
	</tr>
	
</table>


<table class="table">
	 <tr>

	 
	   	<td colspan="4" style="text-align: center;">
	   		 <ul class="pagination">
	   		 	@foreach($expenseentriespaginations as $expenseentriespagination)
	   		 	    @if($expenseentry->id == $expenseentriespagination->id)
                      <li class="active"><a href="/viewpendingexpenseentrydetailsadmin/{{$expenseentriespagination->id}}">{{$expenseentriespagination->id}}</a></li>
	   		 	    @else
                      <li><a href="/viewpendingexpenseentrydetailsadmin/{{$expenseentriespagination->id}}">{{$expenseentriespagination->id}}</a></li>
	   		 	    @endif
                   
                @endforeach
             </ul> 
	   	</td>
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
		 		<option value="HOD PENDING" {{ ( $expenseentry->status == "HOD PENDING") ? 'selected' : '' }}>HOD PENDING</option>

		 		<option value="PENDING" {{ ( $expenseentry->status == "PENDING") ? 'selected' : '' }}>HOD APPROVED</option>
		 		<option value="CANCELLED" {{ ( $expenseentry->status == "CANCELLED") ? 'selected' : '' }}>CANCELLED</option>
		 	</select>
		 </td>
		 @endif
	</tr>
	   <tr>
        <tr>
	   	<td><strong>REMARKS:-</strong></td>
	   	<td><strong>{{$expenseentry->remarks}}</strong></td>
	   </tr>
	 
	   	<td colspan="4" style="text-align: center;">
	   		 <ul class="pagination">
	   		 	@foreach($expenseentriespaginations as $expenseentriespagination)
	   		 	    @if($expenseentry->id == $expenseentriespagination->id)
                      <li class="active"><a href="/viewpendingexpenseentrydetailsadmin/{{$expenseentriespagination->id}}">{{$expenseentriespagination->id}}</a></li>
	   		 	    @else
                      <li><a href="/viewpendingexpenseentrydetailsadmin/{{$expenseentriespagination->id}}">{{$expenseentriespagination->id}}</a></li>
	   		 	    @endif
                   
                @endforeach
             </ul> 
	   	</td>
	   </tr>
	
</table>

</div>
</div>

@if($expenseentry->version=='OLD')

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
@if($vehicledetail)
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">VEHICLE DETAILS</td>
		
	</tr>

</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr>
		<td><strong>VEHICLE TYPE</strong></td>
		<td>{{$vehicledetail->vehicletype}}</td>
		<td><strong>VEHICLE NAME</strong></td>
		<td>{{$vehicledetail->vehiclename}}</td>
	</tr>

	<tr>
		<td><strong>VEHICLE NO</strong></td>
		<td>{{$vehicledetail->vehicleno}}</td>
		<td><strong>DRIVER NAME</strong></td>
		<td>{{$vehicledetail->drivername}}</td>
	</tr>
		<tr>
		<td><strong>DRIVER MOBILE</strong></td>
		<td>{{$vehicledetail->drivermobile}}</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td><strong>VEHICLE IMAGE</strong></td>
		<td>
			  <a href="{{asset('img/vehicle/'.$vehicledetail->vehicleimage)}}" target="_blank">
          	<img style="height:70px;width:95px;" src="{{asset('img/vehicle/'.$vehicledetail->vehicleimage)}}">
         </a>
		</td>
		<td><strong>RC IMAGE</strong></td>
		<td>
			  <a href="{{asset('img/vehicle/'.$vehicledetail->rcimage)}}" target="_blank">
          	<img style="height:70px;width:95px;" src="{{asset('img/vehicle/'.$vehicledetail->rcimage)}}">
         </a>
		</td>
	</tr>

</table>

@endif


@else

@if($expenseentry->type=='VEHICLE PAYMENT' && $expenseentry->version=='NEW')
@if($expenseentrydailyvehicle)
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">VEHICLE DETAILS</td>
	</tr>
	
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped">
<thead>
	<tr class="bg-navy">
		<td>Sl.No</td>
		<td>VEHICLE NAME</td>
		<td>VEHICLE NO</td>
		<td>DATE</td>
		<td>START TIME</td>
		<td>END TIME</td>
		<td>START METER REDING</td>
		<td>END METER REDING</td>
		<td>PURPOSE</td>
		<td>IMAGE</td>
		<td>VEHICLE DETAILS</td>
	</tr>

</thead>
<tbody>
	@foreach($expenseentrydailyvehicle as $key=>$ev)
      <tr>
      	<td>{{++$key}}</td>
      	<td>{{$ev->vehiclename}}</td>
      	<td>{{$ev->vehicleno}}</td>
      	<td>{{$ev->date}}</td>
      	<td>{{$ev->starttime}}</td>
      	<td>{{$ev->endtime}}</td>
      	<td>{{$ev->startmeterreading}}</td>
      	<td>{{$ev->endmeterreading}}</td>
      	<td>{{$ev->description}}</td>
      	<td>
      		<a href="{{ asset('/img/dailyvehicle/'.$ev->image )}}" target="_blank">
			<img title="click Here to view Full image" style="height:70px;width:95px;" src="{{ asset('/img/dailyvehicle/'.$ev->image )}}"></a>
		</td>
		<td>
			<a href="/vehicledetailsshowacc/{{$ev->vehicleid}}" class="btn btn-primary" target="_blank">DETAILS</a>
		</td>

      </tr>
	@endforeach
</tbody>
	
</table>
</div>
@endif
@endif

@if($expenseentry->type=='LABOUR PAYMENT' && $expenseentry->version=='NEW')
@if($engagedlaboursarr)
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped">
<thead>
	<tr class="bg-navy">
		<td>Sl.No</td>
		<td>DATE</td>
		<td>DESCRIPTION</td>
		<td>NO OF LABOUR</td>
		<td>IMAGE</td>
		<td>VIEW DETAILS</td>

	</tr>

</thead>
<tbody>
	@foreach($engagedlaboursarr as $key=>$el)
      <tr>
      	<td>{{++$key}}</td>
      	<td>{{$el['date']}}</td>
      	<td>{{$el['description']}}</td>
      	<td>{{$el['nooflabour']}}</td>
      	<td>
      		<a href="{{ asset('/img/engagedlabourimg/'.$el['labourimage'] )}}" target="_blank">
			<img title="click Here to view Full image" style="height:70px;width:95px;" src="{{ asset('/img/engagedlabourimg/'.$el['labourimage'] )}}"></a>
		</td>
		<td>
			<a href="/dailylabourdetailsshowacc/{{$el['id']}}" class="btn btn-primary" target="_blank">DETAILS</a>
		</td>

      </tr>
	@endforeach
</tbody>
	
</table>
</div>
@endif
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
              
               url:'{{url("/ajaxapproveadmin")}}',
              
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