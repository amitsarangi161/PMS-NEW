@extends('layouts.account')

@section('content')

<table class="table">
	<tr class="bg-blue">
       <td class="text-center">VIEW PENDING DEBIT VOUCHER DETAILS</td>
		
	</tr>
	
</table>
<div class="well" style="background-color: beige;">
	<div class="table-responsive">
		<table class="table">
			<tr>
				<td width="15%"><strong>DEBIT VOUCHER ID :</strong></td>
				<td width="35%">{{$debitvoucherpayment->did}}</td>
				<td width="15%"><strong>VENDOR NAME :</strong></td>
				<td width="35%">{{$debitvoucherpayment->vendorname}}</td>
			</tr>
			<tr>
				
			</tr>
			<tr>
				<td width="15%"><strong>PAYMENT TYPE:</strong></td>
				<td width="35%">{{$debitvoucherpayment->paymenttype}} <button class="label label-primary" onclick="updatevoucherpayment('{{$debitvoucherpayment->paymenttype}}','{{$debitvoucherpayment->bankid}}');"> <i class="fa fa-pencil"></i> Edit</button></td>
				<td width="15%"><strong>AMOUNT :</strong></td>
				<td width="35%" style="color: red;">{{$debitvoucherpayment->amount}}</td>
			</tr>

			<tr>
				<td width="15%"><strong>FROM BANK:</strong></td>
				<td width="35%">{{$debitvoucherpayment->bankname.'/'.$debitvoucherpayment->acno.'/'.$debitvoucherpayment->branchname}}</td>
				<td width="15%"><strong>PAYMENT STATUS :</strong></td>
				<td width="35%"><span class="label label-success">{{$debitvoucherpayment->paymentstatus}}</span></td>
			</tr>
			<tr>
				<td width="15%"><strong>REMARKS:</strong></td>
				<td width="35%">{{$debitvoucherpayment->remarks}}</td>
				<td width="15%"><strong>CREATED AT:</strong></td>
				<td width="35%">{{$debitvoucherpayment->created_at}}</td>
				
			</tr>

			<tr>
				
				<td width="15%"><strong>INVOICE COPY :</strong></td>
				<td width="35%">
					  <a href="{{asset('img/debitvoucher/'.$debitvoucherpayment->invoicecopy)}}" target="_blank">
          		<strong>click to view</strong>
          	</a>
          	  <a href="{{asset('img/debitvoucher/'.$debitvoucherpayment->invoicecopy)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a>
				</td>

				<td width="15%"><strong>PAID</strong></td>
				<td width="35%">
						@if($debitvoucherpayment->paymentstatus=='PENDING')
	    	<button type="button" class="btn btn-primary btn-flat" style="width: 200px;" onclick="drpay('{{$debitvoucherpayment->id}}');">PAID</button>
	    	@endif
				</td>
			</tr>
			
		</table>
		
	</div>
	
</div>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VENDOR DETAILS</td>
	</tr>
	
</table>

<div class="well">
	<div class="table-responsive">
		<table class="table">
			<tr>
				<td width="15%"><strong>VENDOR ID</strong></td>
				<td width="35%">#{{$vendor->id}}</td>
				<td width="15%"><strong>VENDOR NAME</strong></td>
				<td width="35%">{{$vendor->vendorname}}</td>
			</tr>
			<tr>
				<td width="15%"><strong>VENDOR MOBILE</strong></td>
				<td width="35%">{{$vendor->mobile}}</td>
				<td width="15%"><strong>VENDOR DETAILS</strong></td>
				<td width="35%">{{$vendor->details}}</td>
			</tr>
			<tr>
				<td width="15%"><strong>BANK NAME</strong></td>
				<td width="35%">{{$vendor->bankname}}</td>
				<td width="15%"><strong>BRANCH NAME</strong></td>
				<td width="35%">{{$vendor->branchname}}</td>
			</tr>
			<tr>
				<td width="15%"><strong>IFSC CODE</strong></td>
				<td width="35%">{{$vendor->ifsccode}}</td>
				<td width="15%"><strong>VENDOR ID PROOF</strong></td>
				<td width="35%">
					@if($vendor->vendoridproof!='')
					<a href="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}" target="_blank">
          		<strong>click to view</strong>
          	</a>
          	  <a href="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a>
               @endif
				</td>
			</tr>
			@if($vendor->photo!='')
			<tr>
				<td width="15%"><strong>VENDOR PHOTO</strong></td>
				<td width="35%">
					<a href="{{ asset('/img/vendor/'.$vendor->photo )}}" target="_blank">
          		<strong>click to view</strong>
          	</a>
          	  <a href="{{ asset('/img/vendor/'.$vendor->photo )}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a>


				</td>
			</tr>
			@endif
			
		</table>
		
	</div>
	
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: chartreuse;" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;"><strong>TRANCTION DETAILS</strong></h4>
      </div>
      <div class="modal-body">
      	<form action="/drcashierpayvoucher/{{$debitvoucherpayment->id}}" method="post">
      		{{csrf_field()}}
      	<table class="table">
      		
      		<tr>
      			<td><strong>TRANACTION ID</strong></td>
      			<td><input type="text" placeholder="Enter Trancaction Id" class="form-control" autocomplete="off" name="transactionid" required=""></td>
      		</tr>
            <tr>
            <td><strong>DATE OF PAYMENT</strong></td>
            <td><input type="text" placeholder="Date of Payment" class="form-control datepicker1" name="dateofpayment" autocomplete="off" readonly="" required=""></td>
          </tr>
      		<tr>
      			<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success" onclick="return confirm('Are You confirm to proceed?')">PAID</button></td>
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

<!-- update transiction -->
<div class="modal fade" id="updatevoucherpayment" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-navy">
          <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
          <h4 class="modal-title text-center">UPDATE VOUCHER PAYMENT ENTRY</h4>
        </div>
        <div class="modal-body">
        	<form action="/updatevoucherpayment/{{$debitvoucherpayment->id}}" method="post">
        		{{csrf_field()}}
          <table class="table">       		
          
          	<tr>
          		<td><strong>PAYMENT TYPE</strong></td>
          		<td>
          			<select class="form-control" name="paymenttype" id="paymenttype" onchange="getbank(this.value);" required="" >
          				<option value="">SELECT A PAYMENT TYPE</option>
          				<option value="ONLINE PAYMENT">ONLINE PAYMENT</option>
          				<option value="CASH">CASH</option>
          				<option value="CHEQUE">CHEQUE</option>
          				<option value="DD">DD</option>
          				<option value="PDC">PDC</option>
          				<option value="TDR">TDR</option>
          				<option value="NSC">NSC</option>
          				
          			</select>
				</td>
          	</tr>
          	<tr style="display: none;" id="showbank">
          		<td><strong>SELECT BANK</strong></td>
          		<td>
          			<select class="form-control" name="bankid" id="reqbank">
          				<option value="">Select a Bank account</option>
          				@foreach($banks as $bank)
                          <option value="{{$bank->bankid}}">{{$bank->bankname}}/{{$bank->acno}}/{{$bank->branchname}}</option>
          				@endforeach
          				
          			</select>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>DAT OF PAYMENT</strong></td>
          		<td>
          			<input type="text" name="dop"  class="form-control datepicker" id="amt1" value="{{$debitvoucherpayment->dateofpayment}}" readonly>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>AMOUNT</strong></td>
          		<td>
          			<input type="text" name="amount"  class="form-control" id="amt1" value="{{$debitvoucherpayment->amount}}" readonly>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>TRANSACTION ID</strong></td>
          		<td>
          			<input type="text" name="trnid"  class="form-control" id="amt1" value="{{$debitvoucherpayment->transactionid}}" >
          		</td>
          	</tr>
          
    
          	<tr>
          		<td><strong>REMARKS</strong></td>
          		<td>
          			<textarea name="remarks" class="form-control">{{$debitvoucherpayment->remarks}}</textarea>
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
<script type="text/javascript">
         function drpay()
         {
               $("#myModal").modal('show');
         }
function updatevoucherpayment(paymenttype,bankid){
		$('#paymenttype option[value="'+paymenttype+'"]').attr("selected", "selected");
		$('#reqbank option[value="'+bankid+'"]').attr("selected", "selected");
		getbank(paymenttype);
		$("#updatevoucherpayment").modal('show');
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
</script>
@endsection