@extends('layouts.account')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<h3 style="text-align: center;color: blue;font-weight: bold;">COMPLETED REQUISITIONS</h3>

<div class="table-responsive">
	

<table class="table table-responsive table-hover table-bordered table-striped datatablescrollexport">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<th>RID</th>
			<th>NAME</th>
			<th>PROJECT NAME</th>
			<th>AUTHOR</th>
			<th>TOTAL AMOUNT</th>
			<th>APPROVAL AMOUNT</th>
			<th>AMOUNT PAID</th>
			<th>BANK PAID</th>
			<th>APPROVED BY</th>
			<th>STATUS</th>
			<th>CREATED AT</th>
			<th>FROM-TO</th>
			<th>VIEW</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach($requisitions as $requisition)
		<tr style="font-size: 13px;">
			  <td><a href="/viewcompletedrequisition/{{$requisition->id}}"  class="btn btn-success">{{$requisition->id}}</a></td>
			  <td>{{$requisition->employee}}</td>
			  @if($requisition->projectname!='')
			   <td><p class="b" title="{{$requisition->projectname}}">{{$requisition->projectname}}</p></td>
			  @else
              <td>OTHERS</td>
			  @endif
			  <td>{{$requisition->author}}
			  @if($requisition->reqaddby!=''){{'/'.$requisition->reqaddby}}@endif</td>
			  <td>{{$provider::moneyFormatIndia($requisition->totalamount)}}</td>
			  <td>{{$provider::moneyFormatIndia($requisition->approvalamount)}}</td>
			   @php
                   $paidamounts=\App\requisitionpayment::where('rid',$requisition->id)
                                ->get();
                    $bankpaid=\App\requisitionpayment::where('rid',$requisition->id)
                             ->where('paymentstatus','PAID')
                              ->get();
                   
                   $sum=$paidamounts->sum('amount')+0;
                   $banksum= $bankpaid->sum('amount')+0;
			   @endphp
			   <td>{{$provider::moneyFormatIndia($sum)}}</td>
			   <td>{{$provider::moneyFormatIndia($banksum)}}</td>
			  <td>{{$requisition->approver}}</td>
			  @if($requisition->status=='PENDING')
			  <td><span class="label label-danger">{{$requisition->status}}</span></td>
			  @else
                <td><span class="label label-primary">{{$requisition->status}}</span></td>
			  @endif
			  <td>{{$requisition->created_at}}</td>
			   @if($requisition->datefrom!='')
			  <td>({{$requisition->datefrom}})||({{$requisition->dateto}})</td>
			  @else
			    <td></td>
			  @endif
              <td><a href="/viewcompletedrequisition/{{$requisition->id}}"  class="btn btn-info">VIEW</a></td>
			 

		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr bgcolor="#97FFD7">
			<td></td>
			<td></td>
			<td></td>
			<td>TOTAL</td>
			<td>{{$requisitions->sum('totalamount')}}</td>
			<td>{{$requisitions->sum('approvalamount')}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tfoot>
</table>

</div>
@endsection



