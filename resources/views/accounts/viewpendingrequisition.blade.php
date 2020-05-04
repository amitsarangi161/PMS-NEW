@extends('layouts.account')
@section('content')




<style type="text/css">
  @import url("https://fonts.googleapis.com/css?family=Crushed");
.bs-example {
   margin-top: 10%;
}

.bs-example2 {
   margin-top: 1.5em;
   font-weight: bold;
   font-size: 1.25em;
   color: #FFF;
   text-shadow: 1.25px 1px #25282a;
}
/* NONE OF THE FOLLOWING CSS IS NEEDED */

.nate {
  margin: .5em auto;
  text-align: center;
  color: #FFF;
}
a:link {
    color: BlueViolet;
    text-decoration: none;
}
a:visited {
    color: green;
}
a:hover {
    color:DarkOrchid;
    text-decoration: underline;
}
a:active {
    color: yellow;
}
.twitter {
  margin: 2em auto 0px auto;
  font-family: Arial;
  font-size: small;
  font-weight: bold;
  color: #f5911d;
  text-align: center;
  padding: 0;
  left: 0px;
  top: 0px;
  overflow: visible;
}
/* SIGNATURE CODE */
a {
  color: #f77d06;
  -o-transition: color .5s ease-out, background 7s ease-in;
  -ms-transition: color .5s ease-out, background 7s ease-in;
  -moz-transition: color .5s ease-out, background 7s ease-in;
  -webkit-transition: color .5s ease-out, background 7s ease-in;
  transition: color .5s ease-out, background 7s ease-in;
  text-decoration: none;
}
a:hover {
  color: #FFF;
  background: none;
  text-decoration: none;
}

.credits {
  text-align: center;
  font-family: 'Crushed';
  font-size: 1.5vw;
  color: #FFF;
}
.stars {
  color: #f43a2f;
  padding: 0 .5vw 0 .5vw;
  font-size: 1.6vw;
}
</style>

@php
    $sumstatus=0;
    foreach($requisitions as $requisition)
    {
    	  if($requisition->approvestatus=='PENDING')
    	  {
             $sumstatus=$sumstatus+1;
    	  }
    	  else
    	  {
               $sumstatus=$sumstatus+0;
    	  }
    }


  $pid=$requisitionheader->projectid;
if($pid>0){
$requisitionheader1=\App\requisitionheader::where('projectid',$pid)
                      
                        ->where(function($query){
                         $query->where('status','!=','PENDING');
                         $query->orWhere('status','!=','CANCELLED');
                         
                       })
                        ->get();
$payment=$requisitionheader1->sum('approvalamount');
$projectc=\App\project::where('id',$pid)->first();
$cost=$projectc->cost;
$balancep=$cost-$payment;  
}

@endphp


<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">REQUISITION DETAILS</td>
	 </tr>
</table>

<div class="well" style="font-size: 20px;background-color: violet;">
  <div class="table-responsive">
    <table class="table">
      <tr>

      <td><strong>TOTAL PAID AMOUNT TILL DATE :</strong>  {{$totalamt}}</td>
      <td><strong>TOTAL EXPENSE TILL DATE :</strong> {{$totalamtentry}}</td>
      <td><strong>BALANCE AMOUNT :</strong> {{$bal}}</td>
      
      <td><img src="{{asset('wallet.png')}}" style="height: 40px;width: 40px;">Rs. {{$walletbalance}}</td>
      <td><button type="button" class="btn btn-primary" onclick="opennewwindiow();">VIEW EXPENSES</button></td>
      </tr>
      
    </table>
    
  </div>
  
</div>

<div class="table-responsive" >
	<table class="table">
		<tr>
      <td style="text-align: left;" onclick="openapprovalmodal();" class="btn btn btn-danger">CANCEL REQUISITION</td>
			@if($sumstatus==0)
			<td style="text-align: right;">
        <form action="/changependingstatus/{{$requisitionheader->id}}" method="post">
          {{csrf_field()}}
          <input type="hidden"  value="{{$requisitions->sum('approvedamount')}}" id="approvalamount" name="approvalamount">
          <input type="hidden" name="status" value="APPROVED">
        <button type="submit"  class="btn btn-warning btn-lg">APPROVE THIS</button>
        </form>
      </td>
			@else
            <td style="text-align: right;"><button type="button" disabled="" class="btn btn-warning btn-lg">APPROVE THIS</button>
            	<strong class="text-red">THERE ARE {{$sumstatus}} UNSETTELED REQUISITION</strong>
            </td>
           

			@endif
			
		</tr>
		
	</table>
</div>

	



<div class="well">
  <div class="table-responsive" >
	<table class="table" style="background-color: silver;">
		<tr>
			<td><strong>REQUISITION ID</strong></td>
			<td>#{{$requisitionheader->id}}</td>
			<td><strong>PROJECT NAME</strong></td>

      @if($requisitionheader->projectname!='')
			<td>{{$requisitionheader->projectname}}
          @if($pid>0)
        <button type="button" class="btn btn-info" data-toggle="popover" title="Project Details" data-content="PROJECT COST={{$cost}} & EXPENSE AMOUNT= {{$payment}} & REST AMOUNT={{$balancep}} & START DATE={{$projectc->startdate}} & END DATE={{$projectc->enddate}}">(?)</button></td>
        @endif
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
		
	</table>
	</div>
</div>




<div class="well">
<div class="table-responsive" >
	<table class="table table-responsive table-hover table-bordered table-striped">

		<thead class="bg-navy">
			<tr>
				<th>SL_NO</th>
				<th>EXPENSE HEAD</th>
				<th>PARTICULAR</th>
        <th>DESCRIPTION</th>
				<th>PAY TO</th>
				<th>REQUEST AMOUNT</th>
				<th>APPROVED AMOUNT</th>
				<th>STATUS</th>
				<th>ACTION</th>
				
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

       <td>{{$requisition->payto}}</td>
       @endif
				
				<td>{{$requisition->amount}}</td>
				<td>{{$requisition->approvedamount}}</td>
				<td>{{$requisition->approvestatus}}
                   
				   </td>
				<td>
					<select class="form-control" onchange="changeamountofapproval('{{$requisition->id}}','{{$requisition->amount}}',this.value);">
          				<option value="">Select</option>
                  <option value="PENDING">PENDING</option>
          				<option value="FULLY APPROVED">FULLY APPROVED</option>
          				<option value="PARTIALLY APPROVED">PARTIALLY APPROVED</option>
          				<option value="CANCELLED">CANCELLED</option>
          				
          			</select>
				</td>
				

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
<div class="table-responsive" >
<table class="table">
    <tr>
      <td style="text-align: left;" onclick="openapprovalmodal();" class="btn btn btn-danger">CANCEL REQUISITION</td>
      @if($sumstatus==0)
      <td style="text-align: right;">
        <form action="/changependingstatus/{{$requisitionheader->id}}" method="post">
          {{csrf_field()}}
          <input type="hidden"  value="{{$requisitions->sum('approvedamount')}}" id="approvalamount" name="approvalamount">
          <input type="hidden" name="status" value="APPROVED">
        <button type="submit"  class="btn btn-warning btn-lg">APPROVE THIS</button>
        </form>
      </td>
      @else
            <td style="text-align: right;"><button type="button" disabled="" class="btn btn-warning btn-lg">APPROVE THIS</button>
              <strong class="text-red">THERE ARE {{$sumstatus}} UNSETTELED REQUISITION</strong>
            </td>
           

      @endif
      
    </tr>
    
  </table>

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
        	<form action="/changependingstatustocanceled/{{$requisitionheader->id}}" method="post">
        		{{csrf_field()}}
          <table class="table">
       
    
          	<tr>
          		<td><strong>CANCELATION REASON</strong></td>
          		<td>
          			<textarea name="cancelreason" class="form-control"></textarea>
          		</td>
          	</tr>
          	<tr>
          		<td colspan="2"><button type="submit" class="btn btn-success">SUBMIT</button></td>
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
          <h4 class="modal-title">CHANGE APPROVAL AMOUNT</h4>
        </div>
        <div class="modal-body">
        	<form action="/changeapprovalamt" method="post">
        		{{csrf_field()}}
          <table class="table"> 
          	<input type="hidden" id="rid" name="rid">
          	<tr>
          		<td><strong>AMOUNT</strong></td>
          		<td>
          			<input type="text" class="form-control" id="amt" readonly>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>SELECT A ACTION</strong></td>
          		<td>
          			<select class="form-control" onchange="setamount();" id="appstatus" name="status" required="">
          				<option value="">Select</option>
          				<option value="FULLY APPROVED">FULLY APPROVED</option>
          				<option value="PARTIALLY APPROVED">PARTIALLY APPROVED</option>
          				<option value="CANCELLED">CANCELLED</option>
          				
          			</select>
          		</td>
          	</tr>
          	<tr>
          		<td><strong>APPROVAL AMOUNT</strong></td>
          		<td>
          			<input type="number" class="form-control" placeholder="Enter Approval Amount Here" id="appamt" name="approvalamount">
          		</td>
          		
          	</tr>
          	<tr id="remarks1">
          		<td><strong>REMARKS</strong></td>
          		<td>
          			<textarea name="remarks"  class="form-control"></textarea>
          		</td>
          	</tr>
          		<tr id="cancelreason" style="display: none;">
          		<td><strong>CANCELATION REASON</strong></td>
          		<td>
          			<textarea name="cancelreason"  class="form-control"></textarea>
          		</td>
          	</tr>
          	<tr>
          		<td colspan="2"><button type="submit" class="btn btn-success">SUBMIT</button></td>
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


<div id="partiallyapproved" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PARTIALLY APPROVED</h4>
      </div>
      <div class="modal-body">
         <form action="/changepartiallyapproved" method="post">
          {{csrf_field()}}
         	<table class="table">
            <input type="hidden" name="pid" id="pid">
            <tr>
              <td><strong>REQUISITION AMOUNT</strong></td>
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


<div id="cancemodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CANCEL REQUISITION</h4>
      </div>
      <div class="modal-body">
        <form action="/cancelrequisation" method="post">
          {{csrf_field()}}
          <table class="table">
            <input type="hidden" name="cid" id="cid">
            <tr>
              <td><strong>CANCELATION REASON</strong></td>
              <td>
                <textarea class="form-control" name="cancelreason"></textarea>
              </td>
            </tr>
            <tr>
              <td colspan="2"><button class="btn btn-danger" type="submit">CANCEL REQUISITION</button></td>
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

  $(document).ready(function() {
   $('[data-toggle="popover"]').popover({
      placement: 'top',
      trigger: 'hover'
   });
});

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
	function openapprovalmodal() {
		 $("#myModal").modal('show');
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

function openchangeamt(id,amount)
{
	$("#myModal1").modal('show');
	$("#rid").val(id);
	$("#amt").val(amount);
}

function setamount()
{ 

	var appstatus=$("#appstatus").val();
	var amt1=$("#amt").val();

	if(appstatus=='FULLY APPROVED')
	{
		$("#appamt").val(amt1);
	}
	else
	{
		$("#appamt").val(0);
	}

	if(appstatus=='CANCELLED')
	{
       $("#remarks1").hide();
       $("#cancelreason").show();
	}
	else
	{ 

		 $("#remarks1").show();
       $("#cancelreason").hide();

	}

}

function ajaxamountstatus(id,amount,action)
{

       $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxrequitionfullyapproved")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      id:id,
                      amount:amount,
                      action:action

                     },

               success:function(data) { 
                        
                         if(data=='1')
                         {
                          location.reload();
                         }
                }
              });
}


function changeamountofapproval(id,amount,action){

if(action=='FULLY APPROVED')
{
   ajaxamountstatus(id,amount,action);
}

else if(action=='PENDING')
{
    ajaxamountstatus(id,0,action);
}

else if(action=='PARTIALLY APPROVED')
{

     $("#pid").val(id);
    $("#amt2").val(amount);
	   $("#partiallyapproved").modal('show');
}
else if(action=='CANCELLED')
{
  $("#cid").val(id);
   $("#cancemodal").modal('show');
}

}

var url="/viewexpenseentryuser/{{$requisitionheader->id}}";
var windowName="Expense";
function opennewwindiow() {
  window.open(url, windowName, "height=720,width=1024");
}
</script>

@endsection