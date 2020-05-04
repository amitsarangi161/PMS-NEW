@extends('layouts.app')
@section('content')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 150px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>

<div class="table-responsive">
	

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<th>ID</th>
			<th>NAME</th>
			<th>PROJECT NAME</th>
			<th>AUTHOR</th>
			<th>TOTAL AMOUNT</th>
			<th>APPROVAL AMOUNT</th>
			<th>AMOUNT PAID</th>
			<th>APPROVED BY</th>
			<th>STATUS</th>
			<th>FROM-TO</th>
			<th>VIEW</th>
			<!-- <th>EDIT</th> -->
			 <th>DELETE</th>
		</tr>
	</thead>
	<tbody>
		@foreach($requisitions as $requisition)
		<tr style="font-size: 12px;">
			  <td><a href="/viewuserapplicationdetails/{{$requisition->id}}" class="btn btn-primary">{{$requisition->id}}</a></td>
			  <td>{{$requisition->employee}}</td>
			  @if($requisition->projectname!='')
			   <td><p class="b" title="{{$requisition->projectname}}">{{$requisition->projectname}}</p></td>
			  @else
              <td>OTHERS</td>
			  @endif
			  <td>{{$requisition->author}}</td>
			  <td>{{$requisition->totalamount}}</td>
			  <td>{{$requisition->approvalamount}}</td>

			  @php
                   $paidamounts=\App\requisitionpayment::where('rid',$requisition->id)
                                ->get();
                   $bankpaid=\App\requisitionpayment::where('rid',$requisition->id)
                             ->where('paymentstatus','PAID')
                              ->get();
                   $sum=$paidamounts->sum('amount')+0;
                   $banksum= $bankpaid->sum('amount')+0;
			   @endphp
			   <td>{{$banksum}}</td>
			  <td>{{$requisition->approver}}</td>
			  @if($requisition->status=='PENDING')
			  <td><span class="label label-danger">{{$requisition->status}}</span></td>
			  @else
                <td><span class="label label-primary">{{$requisition->status}}</span></td>
			  @endif
			  @if($requisition->datefrom!='')
			  <td>({{$requisition->datefrom}})||({{$requisition->dateto}})</td>
			  @else
			    <td></td>
			  @endif
             <td><a href="/viewuserapplicationdetails/{{$requisition->id}}" class="btn btn-info">VIEW</a></td>
			  @if($requisition->status=='PENDING MGR')
			  <!--  <td><a href="/edituserrequisition/{{$requisition->id}}" class="btn btn-primary">EDIT</a></td> -->
			  <td>
			  	<form action="/deleterequisition/{{$requisition->id}}" method="POST">
			  		{{csrf_field()}}
			  		{{method_field('DELETE')}}
			  		<button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want This Requisition');">DELETE</button>

			  		
			  	</form>
			  </td>
			  @else
              <!--  <td><button class="btn btn-primary" type="button" disabled="">EDIT</button></td> -->
               <td><button class="btn btn-danger" type="button" disabled="">DELETE</button></td>
               

			  @endif

		</tr>
		@endforeach
	</tbody>
	<!-- <tfoot>
		<tr class="bg-gray">
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><strong>Rs.{{$requisitions->sum('totalamount')}}</strong></td>
		<td><strong>Rs.{{$requisitions->sum('approvalamount')}}</strong></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	   </tr>
	</tfoot> -->
</table>

</div>
@endsection