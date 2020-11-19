@extends('layouts.account')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<style type="text/css">
	.mybtn{width: 250px;}

	.b {
    white-space: nowrap; 
    width: 150px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>

@php
$paid=$paidamounts->sum('amount');

$bal=$requisitionheader->approvalamount-$paid;
@endphp
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">REQUISITION DETAIlS</td>
	 </tr>
</table>

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
      <td><strong>BALANCE AMOUNT :</strong> {{$bal1}}</td>
      <td><img src="{{asset('wallet.png')}}" style="height: 40px;width: 40px;">Rs. {{$walletbalance}}</td>
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
			<td width="40%">{{$requisitionheader->projectname}}</td>
			@else
            <td>OTHERS</td>
			@endif
		</tr>
    <tr>
      <td><strong>SCHEME NAME</strong></td>
      <td>{{$requisitionheader->schemename}}</td>
      <td><strong>DIVISION NAME</strong></td>
      <td>{{$requisitionheader->divisionname}}</td>
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
			<td>{{$requisitionheader->status}}</td>
			
		  </tr>
      
       <tr>
        <td><strong>DATE FROM</strong></td>
        <td><strong class="bg-navy">{{$provider::changedateformat($requisitionheader->datefrom)}}</strong></td>
        <td><strong>DATE TO</strong></td>
        <td><strong class="bg-navy">{{$provider::changedateformat($requisitionheader->dateto)}}</strong></td>
      </tr>

		  <tr>
			
			<td><strong>CREATED_AT</strong></td>
			<td>{{$provider::changedatetimeformat($requisitionheader->created_at)}}</td>
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
     <div  class="container-tb tableContainer">
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
         @php
            $totpayvendor=$requisition->approvedamount;
            $vendoramt=\App\requisitionpayment::where('rid',$requisitionheader->id)
                                              ->where('vendorid',$requisition->vendorid)
                                              ->get();
            $totvendorpaid=$vendoramt->sum('amount');
            $vbal=$totpayvendor-$totvendorpaid;
         @endphp
			<tr>
				<td>{{$key+1}}</td>
				<td>{{$requisition->expenseheadname}}</td>
				<td>{{$requisition->particularname}}</td>
        <td>{{$requisition->description}}</td>
        @if($requisition->payto=='TO VENDOR')
             @if($vbal>1)
            <td><button type="button" class="btn btn-warning" onclick="openvendordetails('{{$requisition->vendorid}}','{{$requisition->vendorname}}','{{$requisition->mobile}}','{{$requisition->bankname}}','{{$requisition->acno}}','{{$requisition->branchname}}','{{$requisition->ifsccode}}','{{trim(preg_replace('/\s+/', ' ',$requisition->details))}}','{{$requisition->photo}}','{{$requisition->vendoridproof}}','{{$totpayvendor}}','{{$totvendorpaid}}','{{$vbal}}','{{$requisition->expenseheadid}}','{{$requisition->particularid}}')">
                {{$requisition->payto}}(CLICK TO PAY)</td>
              @else
             <td><button type="button" class="btn btn-danger">{{$requisition->payto}}</button></td>

              @endif
        @else
         <td>{{$requisition->payto}}</td>

        @endif
				
				<td>{{$requisition->amount}}</td>
				<td>{{$requisition->approvedamount}}</td>
			   <td><p class="b" title="{{$requisition->remarks}}">   {{$requisition->remarks}}</p></td>
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
	</div>
</div>

<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">VIEW PAYMENTS</td>
	 </tr>
</table>
<div class="table-responsive" >
<table class="table table-responsive table-hover table-bordered table-striped">

		<thead class="bg-navy">
			<tr>
				<th>SL_NO</th>
        <th>BANK</th>
				<th>AMOUNT</th>
				<th>PAYMENT METHOD</th>
        <th>PAYMENT STATUS</th>
        <th>DATE OF PAYMENT</th>
				<th>TRANSACTION ID</th>
				<th>REMARKS</th>
				<th>CREATED_AT</th>
				
				
				
			</tr>
		</thead>
		<tbody>
			@if($paidamounts)
			@foreach($paidamounts as $key=>$paidamount)
			<tr>
				<td>{{$key+1}}</td>
        <td title="AC NO:-{{$paidamount->acno}}">{{$paidamount->bankname}}({{$paidamount->forcompany}})</td>
				<td>{{$paidamount->amount}}</td>
				<td>{{$paidamount->paymenttype}}</td>
        <td>{{$paidamount->paymentstatus}}</td>
        <td>{{$paidamount->dateofpayment}}</td>
				<td>{{$paidamount->transactionid}}</td>
				<td>{{$paidamount->remarks}}</td>
				<td>{{$paidamount->created_at}}</td>
				

			</tr>
             
			@endforeach
			@else
             <tr>
             	<td class="text-center">NO PAYMENTS DETAILS</td>
             </tr>
			@endif
		</tbody>
		<tfoot>
			<tr class="bg-gray">
        <td></td>
				<td>TOTAL APPROVAL AMOUNT</td>
				<td><strong>Rs.{{$requisitions->sum('approvedamount')}}</strong></td>
				<td>TOTAL PAID AMOUNT</td>
				<td><strong>Rs.{{$paidamounts->sum('amount')}}</strong></td>
				<td>BALANCE</td>
				<td>Rs.{{$realbal=$requisitions->sum('approvedamount')-$paidamounts->sum('amount')}}</td>
        <td></td>
        <td></td>
			</tr>
		</tfoot>
		
	</table>
</div>
<div class="well">
	<div class="table-responsive" >
	<table class="table">
		<tr>
            <td ><button type="button" onclick="changestatus();" class="btn btn-danger btn-lg center-block mybtn">CHANGE STATUS</button></td>
			@if($realbal<=1)

			
               
               <td>
               	<form action="/markascompleterequisition/{{$requisitionheader->id}}" method="post">
               		{{csrf_field()}}
               		<button class="btn btn-success btn-lg center-block mybtn" type="submit">MARK AS COMPLETED</button>
               	</form>
               </td>

             	 <td ><button type="button" disabled="" class="btn btn-danger btn-lg center-block mybtn">CANCEL THIS REQUISITION</button></td>
             	 <td><button type="button" disabled="" class="btn btn-info btn-lg center-block mybtn">PAY</button></td>
      
			@else
		  
              <td>	<button disabled="" class="btn btn-success btn-lg center-block mybtn" type="button" title="first clear all the amount.">MARK AS COMPLETED</button></td> 

                 @if($paid>0)
                     <td ><button type="button" disabled="" class="btn btn-danger btn-lg center-block mybtn">CANCEL THIS REQUISITION</button></td>
                 @else
                  <td ><button type="button" onclick="openapprovalmodal();" class="btn btn-danger btn-lg center-block mybtn">CANCEL THIS REQUISITION</button></td>

                 @endif
               	
			<td><button type="button" onclick="openpaymodal();" class="btn btn-info btn-lg center-block mybtn">PAY</button></td>

			

			@endif

   


    
     
</tr>
           
			
		
		
	</table>
</div>
	</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CANCEL THIS REQUISITION</h4>
        </div>
        <div class="modal-body">
        	<form action="/changependingstatustocancel/{{$requisitionheader->id}}" method="post">
        		{{csrf_field()}}
          <table class="table">
          	<tr>
          		<td><strong>TOTAL AMOUNT</strong></td>
          		<td>
          			<input type="text" class="form-control"  value="{{$requisitionheader->totalamount}}" readonly>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>SELECT A ACTION</strong></td>
          		<td>
          			<select class="form-control" onchange="removerequired();" id="status" name="status" required="">
          				
          			
          				<option value="CANCELLED">CANCELLED</option>
          				
          			</select>
          		</td>
          	</tr>
    
          	<tr>
          		<td><strong>REMARKS</strong></td>
          		<td>
          			<textarea name="remarks" class="form-control"></textarea>
          		</td>
          	</tr>
          	<tr>
          		<td colspan="2"><button type="submit" class="btn btn-success">CANCEL</button></td>
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
          <h4 class="modal-title">CHANGE REQUISITION STATUS</h4>
        </div>
        <div class="modal-body">
          <form action="/changerequisitionstatus/{{$requisitionheader->id}}" method="post">
            {{csrf_field()}}
          <table class="table">
            <tr>
              <td><strong>SELECT A STATUS *</strong></td>
              <td>
                <select class="form-control" name="status" required="">
                   <option value="">select a status</option>
                   <option value="PENDING">PENDING</option>
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


  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">PAY FOR REQUISITION</h4>
        </div>
        <div class="modal-body">
        	<form action="/payrequisition/{{$requisitionheader->id}}" method="post">
        		{{csrf_field()}}
          <table class="table">
              <tr style="background-color: chartreuse;">
              <td><strong>WALLET BALANCE</strong></td>
              <td><input type="text" name="walletbalance" id="walletbalance" value="{{$walletbalance}}" class="form-control" readonly=""></td>
              
            </tr>
          	<tr>
          		<td><strong>APPROVED AMOUNT</strong></td>
          		<td>
          			<input type="text" class="form-control"  value="{{$requisitionheader->approvalamount}}" readonly>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>PAID AMOUNT</strong></td>
          		<td>
          			<input type="text" class="form-control"  value="{{$paid}}" readonly>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>PAYMENT TYPE</strong></td>
          		<td>
          			<select class="form-control clc" name="paymenttype" id="paymenttype" onchange="getbank(this.value);" required="">
          				<option value="">SELECT A PAYMENT TYPE</option>
          				<option value="ONLINE PAYMENT">ONLINE PAYMENT</option>
                  <option value="CASH">CASH</option>
                  <option value="CHEQUE">CHEQUE</option>
          				<option value="WALLET">WALLET</option>
          			</select>
          		</td>
          	</tr>
          	<!-- <tr style="display: none;" id="showbank">
          		<td><strong>SELECT BANK</strong></td>
          		<td>
          			<select class="form-control" name="bankid" id="reqbank">
          				<option value="">Select a Bank</option>
          				@foreach($banks as $bank)
                          <option value="{{$bank->id}}">{{$bank->bankname}}({{$bank->branchname}})</option>
          				@endforeach
          				
          			</select>
          		</td>
          	</tr> -->
          	<tr>
          		<td><strong>AMOUNT</strong></td>
          		<td>
          			<input type="number" name="amount"  class="form-control" id="amt1" autocomplete="off" required="">
          		</td>
          	</tr>
          	<tr>
          		<td><strong>BALANCE AMOUNT</strong></td>
          		<td>
          			<input type="text" class="form-control"  value="{{($requisitionheader->approvalamount-$paid)}}" id="balanceamt" readonly>
          		</td>
          	</tr>
    
          	<tr>
          		<td><strong>REMARKS /CHEQUE DETAILS</strong></td>
          		<td>
          			<textarea name="remarks" class="form-control"></textarea>
          		</td>
          	</tr>
          	 <tr>
        <td colspan="2" style="text-align: center;font-size:15px;"> <p id="errormsg" style="color: red;"></p></td>
      </tr>
          	<tr>
          		<td colspan="2"><button type="submit" id="subbutton" onclick="return confirm('Do You Want to Proceed?')" class="btn btn-success">SUBMIT</button></td>
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
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><strong>VENDOR DETAILS</strong></h4>
      </div>
      <div class="modal-body">
      <form action="/requisitionpaytovendor/{{$requisitionheader->id}}" method="post">
        {{csrf_field()}}
      
        <table class="table">
          <tr>
            <td><strong>VENDOR ID#</strong></td>
            <td><strong id="vendorid1"></strong><input type="hidden" name="vendorid" id="vendorid2"></td>
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
          <tr>
            <td><strong>TOTAL AMOUNT TO PAY</strong></td>
            <td><input type="text" class="form-control" readonly="" id="totvpayamt"></td>
            <td><strong>PAID AMOUNT</strong></td>
            <td><input type="text" class="form-control" readonly="" id="totvpaidamt"></td>
          </tr>
          <tr>
          <td><strong>BALANCE</strong></td>
          <td><input type="text" readonly="" class="form-control" id="vbalance"></td>
          <td><strong>AMOUNT</strong></td>
          <td><input type="number"  autocomplete="off" name="amount" class="form-control" id="vpayamt"></td>
        
        </tr>
         <tr>
              <td><strong>PAYMENT TYPE</strong></td>
              <td>
                <select class="form-control" name="paymenttype" id="paymenttype" onchange="getbank1(this.value);" required="">
                  <option value="">SELECT A PAYMENT TYPE</option>
                  <option value="ONLINE PAYMENT">ONLINE PAYMENT</option>
                  <option value="CASH">CASH</option>
                </select>
              </td>
              <td>REMARKS</td>
              <td><textarea class="form-control" name="remarks"></textarea>
              <input type="hidden" name="expenseheadid" id="expenseheadid1">
              <input type="hidden" name="particularid" id="particularid1">
              </td>
            </tr>
                <tr style="display: none;" id="showbank1">
              <td><strong>SELECT BANK</strong></td>
              <td>
                <select class="form-control" name="bankid" id="reqbank1">
                  <option value="">Select a Bank</option>
                  @foreach($banks as $bank)
                          <option value="{{$bank->id}}">{{$bank->bankname}}({{$bank->forcompany}})</option>
                  @endforeach
                  
                </select>
              </td>
            </tr>
                 <tr>
        <td colspan="2" style="text-align: center;font-size:15px;"> <p id="errormsg1" style="color: red;"></p></td>
      </tr>
            <tr>
              <td colspan="2"><button type="submit" id="subbutton1" onclick="return confirm('Do You Want to Proceed?')" class="btn btn-success">SUBMIT</button></td>
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
  function changestatus()
  {
      $("#changestatus").modal('show');
  }
	function openapprovalmodal() {
		 $("#myModal").modal('show');
	}
function openpaymodal() {
		 $("#myModal1").modal('show');
	}

	function removerequired()
	{
		var status=$("#status").val();
		

		if(status=='CANCELLED')
		{

			$('#approvalamount').prop('required',false);
		}
		else
		{
			$("#approvalamount").prop('required',true);
		}
	}
  function getbank(type)
  {
  	if(type=='CASH')
  	{
  		$("#showbank").hide();
  		$('#reqbank').prop('required',false);
  	}
    else if(type=='WALLET')
    {
          $("#showbank").hide();
      $('#reqbank').prop('required',false);
    } 
    else if(type=='CHEQUE')
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

   function getbank1(type)
  {
    if(type=='CASH')
    {
      $("#showbank1").hide();
      $('#reqbank1').prop('required',false);
    }
    else if(type=='')
    {
       $("#showbank1").hide();
      $('#reqbank1').prop('required',false);
    }
  
    else
    {
      $("#showbank1").show();
      $('#reqbank1').prop('required',true);
    }

  }
  function checkwallet(s2)
  {
       var ptype=$("#paymenttype").val();
       var walletbalance= parseFloat($("#walletbalance").val());
       var s3=parseFloat(s2);
       if(ptype=='WALLET')
       {
           if(s3>walletbalance)
           {
            //alert("insufficient balance"+s3 +"---"+walletbalance);
            $("#subbutton").attr("disabled", true);
             $("#subbutton").attr("type", "button");
            $("#errormsg").html("Insufficient walletbalance");
           }
           else
           {
               $("#subbutton").removeAttr("disabled");
               $("#subbutton").attr("type","submit");
               $("#errormsg").html("");
           }
       }
  }
	$("#amt1").bind("keyup change", function(e) {

    validateamount();

  
});

  $(".clc").bind("change", function(e) {

    validateamount();

  
});

    $("#vpayamt").bind("keyup change", function(e) {

    validateamount1();

  
});
function validateamount1()
{
    
    var s1=$('#totvpayamt').val()-$("#totvpaidamt").val();
    var s2=$("#vpayamt").val();
    $("#vbalance").val(s1-s2);
    
    var bal=$("#vbalance").val();

     if(bal<0)
      {
         $("#subbutton1").attr("disabled", true);
         $("#subbutton1").attr("type", "button");
         $("#errormsg1").html("Your Amount Must be less than balance amount");
      }
      else
      {
         $("#subbutton1").removeAttr("disabled");
         $("#subbutton1").attr("type","submit");
         $("#errormsg1").html("");

      }
}

function validateamount()
{
    var s1={{($requisitionheader->approvalamount-$paid)}};
    var s2=$("#amt1").val();
    $("#balanceamt").val(s1-s2);

    var bal=$("#balanceamt").val();

     if(bal<0)
      {
         $("#subbutton").attr("disabled", true);
         $("#subbutton").attr("type", "button");
         $("#errormsg").html("Your Amount Must be less than balance amount");
      }
      else
      {
         $("#subbutton").removeAttr("disabled");
         $("#subbutton").attr("type","submit");
         $("#errormsg").html("");
         checkwallet(s2);
      }
}

</script>

@endsection