@extends('layouts.account')
@section('content')

<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<h3 style="text-align: center;color: blue;font-weight: bold;">CANCELLED REQUISITIONS</h3>
<div class="table-responsive">
	

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<th>RID</th>
			<th>NAME</th>
			<th>PROJECT NAME</th>
			<th>AUTHOR</th>
			<th>TOTAL AMOUNT</th>
			<th>CANCELATION REASON</th>
			<th>CANCELLED BY</th>
			<th>STATUS</th>
			<th>CREATED AT</th>
			<th>FROM-TO</th>
			<th>VIEW</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach($requisitions as $requisition)
		<tr style="font-size: 13px;">
			  <td><a href="/viewcanceledrequisition/{{$requisition->id}}" class="btn btn-success">{{$requisition->id}}</a></td>
			  <td>{{$requisition->employee}}</td>
			  @if($requisition->projectname!='')
			   <td><p class="b" title="{{$requisition->projectname}}">{{$requisition->projectname}}</p></td>
			  @else
              <td>OTHERS</td>
			  @endif
			  <td>{{$requisition->author}}</td>
			  <td>{{$requisition->totalamount}}</td>
			  <td>{{$requisition->cancelreason}}</td>
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
              <td><a href="/viewcanceledrequisition/{{$requisition->id}}"  class="btn btn-info">VIEW</a></td>
			 

		</tr>
		@endforeach
	</tbody>
</table>

</div>
@endsection



