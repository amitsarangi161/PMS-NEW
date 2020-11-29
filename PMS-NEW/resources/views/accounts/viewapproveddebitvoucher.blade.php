@extends('layouts.account')

@section('content')
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VIEW PENDING DEBIT VOUCHER(APPROVAL BY ADMIN)</td>
		
	</tr>
	
</table>

<div class="well">
	<div class="table-responsive">
	<table class="table">
		<tr>
			<td width="10%"><strong>ID :</strong></td>
			<td width="40%">#{{$debitvoucherheader->id}}</td>
			<td width="10%"><strong>VENDOR :</strong></td>
			<td width="40%"><button type="button" class="btn btn-success" onclick="openvendordetails('{{$vendor->vendorid}}','{{$vendor->vendorname}}','{{$vendor->mobile}}','{{$vendor->bankname}}','{{$vendor->acno}}','{{$vendor->branchname}}','{{$vendor->ifsccode}}','{{trim(preg_replace('/\s+/', ' ',$vendor->details))}}','{{$vendor->photo}}','{{$vendor->vendoridproof}}')">{{$debitvoucherheader->vendorname}}</button></td>
		</tr>
		<tr>
			<td width="10%"><strong>BILL DATE :</strong></td>
			<td width="40%">{{$debitvoucherheader->billdate}}</td>
			<td width="10%"><strong>BILL NO :</strong></td>
			<td width="40%">{{$debitvoucherheader->billno}}</td>
		</tr>
       <tr>
      <td width="10%"><strong>FOR PROJECT :</strong></td>
      <td width="40%">{{$debitvoucherheader->projectname}}</td>
      <td width="10%"><strong>EXPENSE HEAD:</strong></td>
      <td width="40%">{{$debitvoucherheader->expenseheadname}}</td>
    </tr>
		<tr style="background-color: chartreuse;">
			<td width="20%"><strong>TOTAL AMOUNT:</strong></td>
			<td width="30%">{{$debitvoucherheader->finalamount}}</td>
			<td width="20%"><strong>PAID AMOUNT:</strong></td>
			<td width="30%">{{number_format((float)$paid, 2, '.', '')}}</td>
		</tr>

		<tr style="background-color: chartreuse;">
			<td width="20%"><strong>BALANCE AMOUNT:</strong></td>
			<td width="30%">{{number_format((float)$debitvoucherheader->finalamount-$paid, 2, '.', '')}}</td>
			<td width="20%"><strong>BANK PAID:</strong></td>
			<td width="30%">{{number_format((float)$bankpaid, 2, '.', '')}}</td>
		</tr>

		<tr>
			<td width="10%"><strong>CREATED AT  :</strong></td>
			<td width="40%">{{$debitvoucherheader->created_at}}</td>
			<td width="10%"><strong>STATUS :</strong></td>
			<td width="40%"><span class="label label-warning">{{$debitvoucherheader->status}}</span></td>
		</tr>

		
	</table>
	</div>
	
</div>
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">ITEM LIST</td>
	</tr>
	
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
			<tr class="bg-navy">
			<td>Sl_No</td>
    	    <td>Item Name</td>
			<td>Units</td>
			<td>Qty</td>
			<td>MRP</td>
			<td>Discount</td>
			<td>Price</td>
			<td>CGST Rate</td>
			<td>CGST Cost</td>
			<td>SGST Rate</td>
			<td>SGST Cost</td>
			<td>IGST Rate</td>
			<td>IGST Cost</td>
			<td>AMOUNT</td>
    		
           </tr>

	</thead>
	<tbody>
		@foreach($debitvouchers as $key=>$debitvoucher)
		<tr>
			<td>{{$key+1}}</td>
			<td>{{$debitvoucher->itemname}}</td>
			<td>{{$debitvoucher->unitname}}</td>
			<td>{{$debitvoucher->qty}}</td>
			<td>{{$debitvoucher->mrp}}</td>
			<td>{{$debitvoucher->discount}}</td>
			<td>{{$debitvoucher->price}}</td>
			<td>{{$debitvoucher->sgstrate}}</td>
			<td>{{$debitvoucher->sgstcost}}</td>
			<td>{{$debitvoucher->cgstrate}}</td>
			<td>{{$debitvoucher->cgstcost}}</td>
			<td>{{$debitvoucher->igstrate}}</td>
			<td>{{$debitvoucher->igstcost}}</td>
			<td>{{$debitvoucher->grossamt}}</td>
		</tr>
		@endforeach
		
	</tbody>
</table>
</div>
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">PAYMENT DETAILS</td>
	</tr>
	
</table>
<div class="table-responsive">
<table class="table">
	    	<tr>
	    		<td width="25%"><strong>Total MRP</strong></td>
	    		<td width="25%"><input type="text" id="tmrp" value="{{$debitvoucherheader->tmrp}}" name="tmrp" class="form-control" readonly="" required=""></td>
	    	
	    		<td width="25%"><strong>Total Discount</strong></td>
	    		<td width="25%"><input type="text" value="{{$debitvoucherheader->tdiscount}}" class="form-control" id="tdiscount" name="tdiscount" readonly=""></td>
	    	</tr>
	    	<tr>
	    		<td width="25%"><strong>Total Price</strong></td>
	    		<td width="25%"><input type="text" value="{{$debitvoucherheader->tprice}}" class="form-control" id="tprice" name="tprice" readonly="" required=""></td>
	    	
	    		<td width="25%"><strong>Total Quantity</strong></td>
	    		<td width="25%"><input type="text" value="{{$debitvoucherheader->tqty}}" class="form-control" id="tqty" name="tqty" readonly="" required=""></td>
	    	</tr>

	    	<tr>
	    		<td width="25%"><strong>Total SGST</strong></td>
	    		<td width="25%"><input type="text" value="{{$debitvoucherheader->tsgst}}" class="form-control" id="tsgst" name="tsgst" readonly=""></td>
	    	
	    		<td width="25%"><strong>Total CGST</strong></td>
	    		<td width="25%"><input type="text" value="{{$debitvoucherheader->tcgst}}" class="form-control" id="tcgst" name="tcgst" readonly=""></td>
	    	</tr>


	    		<tr>
	    		<td width="25%"><strong>Total IGST</strong></td>
	    		<td width="25%"><input type="text" value="{{$debitvoucherheader->tigst}}" class="form-control" id="tigst" name="tigst" readonly=""></td>
	    	
	    		<td width="25%"><strong>Total Amount</strong></td>
	    		<td width="25%"><input type="text" value="{{$debitvoucherheader->totalamt}}" class="form-control" id="totalamt" name="totalamt" readonly="" required=""></td>
	    	 </tr>


	    	  <tr>
	    		<td width="25%"><strong>Other Deduction(in %)</strong></td>
	    		<td width="25%"><input type="text" class="form-control " id="otherdeduction" value="{{$debitvoucherheader->otherdeduction}}" autocomplete="off" readonly="" name="otherdeduction" value="0"></td>
	    		<td width="25%"><strong>IT Deduction(in %)</strong></td>
	    		<td width="25%"><input type="text" class="form-control" id="itdeduction" name="itdeduction" value="{{$debitvoucherheader->itdeduction}}" autocomplete="off" readonly=""  value="0"></td>
	    	 
	    		
	    		
	    	 </tr>

	    	
	    	 <tr>
	    	 	<td width="25%"><strong>Final Price</strong></td>
	    		<td width="25%"><input type="text" class="form-control" value="{{$debitvoucherheader->finalamount}}"  id="finalamount" name="finalamount" readonly="" required=""></td> 
	   
	    	
	    		<td width="25%"><strong>Approval Amount</strong></td>
          <td width="25%"><input type="text" class="form-control" value="{{$debitvoucherheader->approvalamount}}"  id="approvalamount" name="approvalamount" readonly="" required=""></td> 


	    	 </tr>
         <tr>
                <td width="25%"><strong>Attach a invoice copy</strong></td>
          <td>
           <a href="{{asset('img/debitvoucher/'.$debitvoucherheader->invoicecopy)}}" target="_blank">
              <strong>click to view</strong>
            </a>
              <a href="{{asset('img/debitvoucher/'.$debitvoucherheader->invoicecopy)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a>
               </td>
         </tr>
	    	 
	</table>
</div>
	

<table class="table table-responsive">
	<tr>
    <td class="text-center"><button type="button" onclick="changestatus();" class="btn btn-danger pull-right btn-lg">CHANGE STATUS</button></td>

    @if($paid>0)
     <td class="text-center"><button type="button" disabled="" class="btn btn-danger pull-right btn-lg">CANCEL</button></td>
        
    @else

     <form action="/canceldrvoucher/{{$debitvoucherheader->id}}" method="post">
      {{csrf_field()}}
     <td class="text-center"><button type="submit" onclick="return confirm('Do You Want to Cancel this Debit Voucher');"  class="btn btn-danger pull-right btn-lg">CANCEL</button></td>
     </form>

    @endif

		@if(($debitvoucherheader->approvalamount-$paid)<1)
           
		    <td class="text-center"><button type="button" disabled="" class="btn btn-success pull-right btn-lg">PAY</button></td>

        <form action="/drvouchermarkcompleted/{{$debitvoucherheader->id}}" method="post">
          {{csrf_field()}}
        <td class="text-center">
          <button type="submit" onclick="return confirm('do you want to mark this debit voucher as completed')" class="btn btn-info pull-right btn-lg">MARK AS COMPLETED</button>
        </td>

        </form>
        
           
		@else
            <td class="text-center"><button type="button" onclick="openpaymodal();" class="btn btn-success pull-right btn-lg">PAY</button></td>
            <td class="text-center"><button type="button" disabled="" class="btn btn-info pull-right btn-lg">MARK AS COMPLETED</button></td>
         
		@endif
	</tr>
</table>

<div class="table-responsive">
<table class="table">
<tr class="bg-primary">
	<td class="text-center">PAYMENTS DETAILS</td>
</tr>
</table>
</div>
<div class="table-responsive">
	<table class="table table-responsive table-hover table-bordered table-striped">
		<thead>
			<tr class="bg-navy">
				<td>ID</td>
				<td>DEBIT VOUCHER ID</td>
				<td>AMOUNT</td>

				<td>PAYMENT TYPE</td>
				
				<td>REMARKS</td>
				<td>BANK</td>
				<td>TRANSACTION ID</td>
				<td>DATE OF PAYMENT</td>
				<td>CREATED AT</td>
				<td>PAYMENT STATUS</td>
			</tr>
			
		</thead>
		<tbody>
			@foreach($bankpayments as $bankpayment)
               
               <tr title="REMARKS -{{$bankpayment->remarks}}">
               	   <td>{{$bankpayment->id}}</td>
               	   <td>{{$bankpayment->did}}</td>
               	   <td>{{$bankpayment->amount}}</td>
               	   <td>{{$bankpayment->paymenttype}}</td>
                   <td>{{$bankpayment->reamrks}}</td>
                   <td>{{$bankpayment->bankname}}/{{$bankpayment->acno}}/{{$bankpayment->ifsccode}}</td>
                   <td>{{$bankpayment->transactionid}}</td>
                   <td>{{$bankpayment->dateofpayment}}</td>
                   <td>{{$bankpayment->created_at}}</td>
                   <td><span class="label label-primary">{{$bankpayment->paymentstatus}}</span></td>
               </tr>

			@endforeach
		</tbody>
		
	</table>
	
</div>



<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">PAY FOR REQUISITION</h4>
        </div>
        <div class="modal-body">
        	<form action="/payapproveddebitvoucher/{{$debitvoucherheader->id}}" method="post">
        		{{csrf_field()}}
          <table class="table">
          	<tr>
          		<td><strong>TOTAL AMOUNT</strong></td>
          		<td>
          			<input type="text" class="form-control"  value="{{$debitvoucherheader->approvalamount}}" readonly>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>PAID AMOUNT</strong></td>
          		<td>
          			<input type="text" class="form-control"  value="{{number_format((float)$paid, 2, '.', '')}}" readonly>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>PAYMENT TYPE</strong></td>
          		<td>
          			<select class="form-control" name="paymenttype" onchange="getbank(this.value);" required="">
          				<option value="">SELECT A PAYMENT TYPE</option>
          				<option value="ONLINE PAYMENT">ONLINE PAYMENT</option>
          				<option value="CASH">CASH</option>
          				<option value="CHEQUE">CHEQUE</option>
          				<option value="DD">DD</option>
          				
          			</select>
          		</td>
          	</tr>
          	<tr style="display: none;" id="showbank">
          		<td><strong>SELECT BANK</strong></td>
          		<td>
          			<select class="form-control" name="bankid" id="reqbank">
          				<option value="">Select a Bank</option>
          				@foreach($banks as $bank)
                          <option value="{{$bank->id}}">{{$bank->bankname}}/{{$bank->acno}}/{{$bank->branchname}}</option>
          				@endforeach
          				
          			</select>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>AMOUNT</strong></td>
          		<td>
          			<input type="text" name="amount"  class="form-control" id="amt1" autocomplete="off"  required="">
          		</td>
          	</tr>
          	<tr>
          		<td><strong>BALANCE AMOUNT</strong></td>
          		<td>
          			<input type="text" class="form-control"  value="{{number_format((float)$debitvoucherheader->approvalamount-$paid, 2, '.', '')}}" id="balanceamt" readonly>
          		</td>
          	</tr>
    
          	<tr>
          		<td><strong>REMARKS</strong></td>
          		<td>
          			<textarea name="remarks" class="form-control"></textarea>
          		</td>
          	</tr>
          	 <tr>
        <td colspan="2" style="text-align: center;font-size:15px;"> <p id="errormsg" style="color: red;"></p></td>
      </tr>
          	<tr>
          		<td colspan="2"><button type="submit" id="subbutton" class="btn btn-success" onclick="return confirm('Do You Want to Proceed?')">SUBMIT</button></td>
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

  <div class="modal fade" id="changestatus" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CHANGE DR VOUCHER STATUS</h4>
        </div>
        <div class="modal-body">
          <form action="/changedrvoucherstatus/{{$debitvoucherheader->id}}" method="post">
            {{csrf_field()}}
          <table class="table">
            <tr>
              <td><strong>SELECT A STATUS *</strong></td>
              <td>
                <select class="form-control" name="status" required="">
                   <option value="">select a status</option>
                   <option value="PENDING">PENDING</option>
                   <option value="MGR APPROVED">MGR APPROVED</option>
                   <option value="ADMIN APPROVED">ADMIN APPROVED</option>
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

  function changestatus()
  {
      $("#changestatus").modal('show');
  }
	function openvendordetails(vendorid,vendorname,mobile,bankname,acno,branchname,ifsccode,details,photo,vendoridproof)
   {

        

             $("#vendorid1").html(vendorid);
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
	
	function openpaymodal()
	{
		  $("#myModal2").modal('show');
	}

	  function getbank(type)
  {
  	if(type=='CASH')
  	{
  		$("#showbank").hide();
  		$('#reqbank').prop('required',false);
  	}
  	else
  	{
  		$("#showbank").show();
  		$('#reqbank').prop('required',true);
  	}

  }

  	$("#amt1").bind("keyup change", function(e) {
    var s1={{($debitvoucherheader->approvalamount-$paid)}};
    var s2=$("#amt1").val();
    $("#balanceamt").val(s1-s2);

    var bal=$("#balanceamt").val();

     if(bal<0)
      {
         $("#subbutton").attr("disabled", true);
         $("#errormsg").html("Your Amount Must be less than balance amount");
      }
      else
      {
         $("#subbutton").removeAttr("disabled");
         
         $("#errormsg").html("");
      }
});
</script>


@endsection