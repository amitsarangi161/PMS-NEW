@extends('layouts.account')
@section('content')
@php
$paid=$paidamounts->sum('amount');

$bal=($requisitionheader->approvalamount)-$paid;
@endphp
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">REQUISITION DETAILS</td>
	 </tr>
</table>

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
      <td><strong>BALANCE AMOUNT :</strong> {{$bal}}</td>
      
      <td><img src="{{asset('wallet.png')}}" style="height: 40px;width: 40px;">Rs. {{$walletbalance}}</td>
      <td><button type="button" class="btn btn-primary" onclick="opennewwindiow();">VIEW EXPENSES</button></td>
      </tr>
      
    </table>
    
  </div>
  
</div>
<div class="well">
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


<div class="well">

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
				<th>STATUS</th>
				
				
			</tr>
		</thead>
		<tbody>
			@foreach($requisitions as $key=>$requisition)
			<tr>
				<td>{{$key+1}}</td>
				<td>{{$requisition->expenseheadname}}</td>
				<td>{{$requisition->particularname}}</td>
				<td>{{$requisition->description}}</td>
				<td>{{$requisition->payto}}</td>
				<td>{{$requisition->amount}}</td>
				<td>{{$requisition->approvedamount}}</td>
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
				
			</tr>
		</tfoot>
		
	</table>
	
</div>

<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-blue">
	 	<td class="text-center">VIEW PAYMENTS</td>
	 </tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped">

		<thead class="bg-navy">
			<tr>
				<th>SL_NO</th>
				<th>AMOUNT</th>
				<th>PAYMENT METHOD</th>
				<th>REMARKS</th>
				<th>PAYMENT STATUS</th>
				<th>CREATED_AT</th>
				
				
				
			</tr>
		</thead>
		<tbody>
			@foreach($paidamounts as $key=>$paidamount)
			<tr>
				<td>{{$key+1}}</td>
				<td>{{$paidamount->amount}}</td>
				<td>{{$paidamount->paymenttype}}</td>
				<td>{{$paidamount->remarks}}</td>
				<td>{{$paidamount->paymentstatus}}</td>
				<td>{{$paidamount->created_at}}</td>
				

			</tr>

			@endforeach
		</tbody>
		<tfoot>
			<tr class="bg-gray">
				<td>TOTAL</td>
				<td><strong>Rs.{{$paidamounts->sum('amount')}}</strong></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tfoot>
		
	</table>




@endsection