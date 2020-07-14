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
				<td width="35%">{{$debitvoucherpayment->voucher_id}}</td>
				<td width="15%"><strong>VENDOR NAME :</strong></td>
				<td width="35%">{{$debitvoucherpayment->vendorname}}</td>
			</tr>
			<tr>
				
			</tr>
			<tr>
				<td width="15%"><strong>PAYMENT TYPE:</strong></td>
				<td width="35%">{{$debitvoucherpayment->paymenttype}}</td>
				<td width="15%"><strong>AMOUNT :</strong></td>
				<td width="35%" style="color: red;">{{$debitvoucherpayment->amount}}</td>
			</tr>

			<tr>
				<td width="15%"><strong>FROM BANK:</strong></td>
				<td width="35%">{{$debitvoucherpayment->bankname}}/{{$debitvoucherpayment->acno}}/{{$debitvoucherpayment->branchname}}</td>
				<td width="15%"><strong>PAYMENT STATUS :</strong></td>
				<td width="35%"><span class="label label-success">{{$debitvoucherpayment->paymentstatus}}</span></td>
			</tr>

			<tr>
				<td width="15%"><strong>TRANCATION ID:</strong></td>
				<td width="35%">{{$debitvoucherpayment->transactionid}}</td>
				<td width="15%"><strong>DATE OF PAYMENT :</strong></td>
				<td width="35%">{{$debitvoucherpayment->dateofpayment}}</td>
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
				<td width="15%"><strong>Check Number</strong></td>
				<td width="35%">{{$debitvoucherpayment->checknumber}}</td>

				
			</tr>
			<tr>
				<td width="15%"><strong>PAID BY</strong></td>
				<td width="35%">{{$debitvoucherpayment->paidbyname}}</td>
				<td width="15%"><strong>EDIT TRANSCATION ID AND DATE OF PAYMENT</strong></td>
				<td width="35%">
			@if($debitvoucherpayment->paymentstatus=='PENDING')
	    	<button type="button" class="btn btn-info" style="width: 200px;" onclick="drpay('{{$debitvoucherpayment->id}}');">PAID</button>
	    	@else
	    	
	    	<button type="button" class="btn btn-warning" style="width: 200px;" onclick="openeditmodal('{{$debitvoucherpayment->paymenttype}}','{{$debitvoucherpayment->bankid}}');">EDIT</button>
	    	

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
      	<form action="/editdrcashierpayvoucher/{{$debitvoucherpayment->id}}" method="post">
      		{{csrf_field()}}
      	<table class="table">
      		<input type="hidden" name="pid" id="pid">
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
                          <option value="{{$bank->id}}">{{$bank->bankname}}/{{$bank->acno}}/{{$bank->branchname}}</option>
          				@endforeach
          				
          			</select>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>AMOUNT</strong></td>
          		<td>
          			<input type="text" name="amount"  class="form-control" id="amt1" value="{{$debitvoucherpayment->amount}}" readonly>
          		</td>
          	</tr>
      		<tr>
      			<td><strong>TRANACTION ID</strong></td>
      			<td><input type="text" placeholder="Enter Trancaction Id" class="form-control" autocomplete="off" value="{{$debitvoucherpayment->transactionid}}" name="transactionid" required=""></td>
      		</tr>
      		<tr>
      			<td><strong>CHECK NUMBER</strong></td>
      			<td><input type="text" placeholder="Enter Trancaction Id" class="form-control" autocomplete="off" value="{{$debitvoucherpayment->checknumber}}" name="checknumber" required=""></td>
      		</tr>
            <tr>
            <td><strong>DATE OF PAYMENT</strong></td>
            <td><input type="text" placeholder="Date of Payment" class="form-control datepicker1" name="dateofpayment" value="{{$debitvoucherpayment->dateofpayment}}" autocomplete="off" readonly="" required=""></td>
          </tr>
      		<tr>
      			<td colspan="2" style="text-align: right;"><button type="UPDATE" class="btn btn-success" onclick="return confirm('Are You confirm to proceed?')">PAID</button></td>
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
       function openeditmodal(paymenttype,bankid)
         {
         $('#paymenttype option[value="'+paymenttype+'"]').attr("selected", "selected");
		$('#reqbank option[value="'+bankid+'"]').attr("selected", "selected");
		getbank(paymenttype);
         	   $("#myModal").modal('show');
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