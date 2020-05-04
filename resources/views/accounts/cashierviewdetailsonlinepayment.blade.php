@extends('layouts.account')
@section('content')
<style type="text/css">
	.modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">REQUISITION DETAILS</td>
		 
	</tr>
</table>
<div class="well">
	

<table class="table">
	<tr>
		<td><strong>REQUISITION ID</strong></td>
		<td><button type="button" class="btn btn-primary" onclick="openviewmodal();" title="click to view the details">#{{ $requisitionpayments->rid}}</button></td>
		<td><strong>NAME</strong></td>
		<td>MR/MRS:-{{ $requisitionpayments->name}}</td>
	</tr>

	@php

      $requistitionheader=\App\requisitionheader::select('requisitionheaders.*','projects.projectname')
                          ->where('requisitionheaders.id',$requisitionpayments->rid)
                          ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                          ->first();

	@endphp
	

	<tr>
		<td><strong>REQUISITION AMOUNT</strong></td>
		<td>{{ $requisitionpayments->amount}}</td>
		<td><strong>PAYMENT METHOD</strong></td>
		<td>{{ $requisitionpayments->paymenttype}}</td>
	</tr>

	<tr>
		<td><strong>REMARKS</strong></td>
		<td>{{ $requisitionpayments->remarks}}</td>
		<td><strong>PAYMENT STATUS</strong></td>
		<td>{{ $requisitionpayments->paymentstatus}}</td>
	</tr>
	<tr>
		<td><strong>CREATED_AT</strong></td>
		<td>{{$requisitionpayments->created_at}}</td>
	</tr>
  <tr>
     <td><strong>PAY TO</strong></td>
    <td><strong>{{$requisitionpayments->type}}</strong></td>
  </tr>
	@if($requisitionpayments->paymentstatus=='PAID')
	<tr>
		<td><strong>TRANSACTION ID</strong></td>
		<td>{{$requisitionpayments->transactionid}}</td>
    <td><strong>DATE OF PAYMENT</strong></td>
    <td><strong>{{$requisitionpayments->dateofpayment}}</strong></td>
	</tr>
  <tr>
    <td><strong>BANK NAME</strong></td>
    <td>{{$requisitionpayments->bankname}}</td>
    <td><strong>IFSC</strong></td>
    <td>{{$requisitionpayments->ifsccode}}</td>
  </tr>
  <tr>
    <td><strong>ACCOUNT NUMBER</strong></td>
    <td>{{$requisitionpayments->acno}}</td>
  </tr>
  <tr>
    <td><strong>EDIT(DATE OF PAYMENT AND TRANSACTIONID)</strong></td>
    <td><button class="btn btn-success" onclick="openedit();">EDIT</button></td>
  </tr>
	@endif
</table>
</div>


<table class="table">
	<tr class="bg-red">
		<td class="text-center">USER BANK ACCOUNT DETAILS</td>
		 
	</tr>
</table>



@if($userbankaccount)
<div class="well">
	

<table class="table">
	<tr>
		<td><strong>NAME</strong></td>
		<td><strong>{{$userbankaccount->name}}</strong></td>
		<td><strong>BANK NAME</strong></td>
		<td><strong>{{ $userbankaccount->bankname}}</strong></td>
	</tr>
	<tr>
		<td><strong>ACCOUNT NO</strong></td>
		<td><strong>{{$userbankaccount->acno}}</strong></td>
		<td><strong>BRANCH NAME</strong></td>
		<td><strong>{{$userbankaccount->branchname}}</strong></td>
	</tr>
	<tr>
		<td><strong>IFSC CODE</strong></td>
		<td><strong>{{$userbankaccount->ifsccode}}</strong></td>

	</tr>

	
</table>
</div>

@else
  <h1>NO BANK ACCOUNT ADDED FIRST ADD THE BANK ACCOUNT</h1>
@endif
<table class="table">
	<tr>
		    <td colspan="2" style="text-align: right;">
	    	@if($requisitionpayments->paymentstatus=='PENDING')
	    	<button type="button" class="btn btn-info" style="width: 200px;" onclick="payonline('{{$requisitionpayments->id}}');">PAID</button>
	    	@else
	    	<button type="button" class="btn btn-info" style="width: 200px;" disabled="">PAID</button>

	    	@endif
	    </td>
	 </tr>
</table>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: chartreuse;" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;"><strong>TRANCTION DETAILS</strong></h4>
      </div>
      <div class="modal-body">
      	<form action="/cashierpaidrequsitiononline/{{$requisitionpayments->id}}" method="post">
      		{{csrf_field()}}
      	<table class="table">
      		<input type="hidden" name="pid" id="pid">
      		<tr>
      			<td><strong>BANK NAME</strong></td>
      			<td>
            <select class="form-control select2" name="bank" required="" style="width: 100%;">
              <option value="">Choose a bank</option>
              @foreach($banks as $bank)
              <option value="{{$bank->id}}">{{$bank->bankname}}|| {{$bank->branchname}}({{$bank->acno}})</option>
              @endforeach
            </select>   
            </td>
      		</tr>
          <tr>
            <td><strong>TRANACTION ID</strong></td>
            <td><input type="text" placeholder="Enter Trancaction Id" class="form-control" name="transactionid" required=""></td>
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

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: chartreuse;" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;"><strong>TRANCTION DETAILS</strong></h4>
      </div>
      <div class="modal-body">
        <form action="/cashierpaidrequsitiononlineupdate/{{$requisitionpayments->id}}" method="post">
          {{csrf_field()}}
        <table class="table">
        
          <tr>
            <td><strong>TRANACTION ID</strong></td>
            <td><input type="text" placeholder="Enter Trancaction Id" class="form-control" name="transactionid" autocomplete="off" value="{{$requisitionpayments->transactionid}}" required=""></td>
          </tr>
            <tr>
            <td><strong>DATE OF PAYMENT</strong></td>
            <td><input type="text" placeholder="Date of Payment" class="form-control datepicker" name="dateofpayment" value="{{$requisitionpayments->dateofpayment}}" autocomplete="off" readonly="" required=""></td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success" onclick="return confirm('Are You confirm to proceed?')">UPDATE</button></td>
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


<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: chartreuse;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;"><strong>REQUISITION DETAILS</strong></h4>
      </div>
      <div class="modal-body">
         <div class="well">
         	<table class="table">
         		<tr>
         			<td><strong>NAME: </strong></td>
         			<td>{{$requisitionpayments->name}}</td>
         			<td><strong>PROJECT NAME:</strong></td>
              @if($requistitionheader->projectname!='')
         			<td>{{ $requistitionheader->projectname}}</td>
              @else
              <td>OTHERS</td>
              @endif

         		</tr>
         		<tr>
         			<td><strong>DESCRIPTION :</strong></td>
         			<td>{{$requistitionheader->description}}</td>
         			<td><strong>STATUS :</strong></td>
         			<td>{{$requistitionheader->status}}</td>
         		</tr>
         		<tr>
         			<td><strong>REQUISITION AMOUNT:</strong></td>
         			<td>{{$requistitionheader->totalamount}}</td>
         			<td><strong>APPROVAL AMOUNT:</strong></td>
         			<td>{{$requistitionheader->approvalamount}}</td>
         		</tr>
              <tr>
                <td><strong>DATE FROM</strong></td>
                <td><strong class="bg-navy">{{$requistitionheader->datefrom}}</strong></td>
                <td><strong>DATE TO</strong></td>
                <td><strong class="bg-navy">{{$requistitionheader->dateto}}</strong></td>
              </tr>

         	</table>
         	
         </div>


      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<script type="text/javascript">
	function payonline(id)
	{
		$("#pid").val(id);
        $("#myModal").modal('show');
	}
	function openviewmodal()
	{
		$("#myModal1").modal('show');
	}

  function openedit()
  {
    $("#myModal2").modal('show');
  }
</script>
@endsection