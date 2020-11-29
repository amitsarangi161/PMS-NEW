@extends('layouts.account')
@section('content')
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">EXPENSE ENTRY OF ({{$user->name}})</td>
	</tr>
</table>

<table class="table">
	<tr>
		<td><strong>NAME :</strong></td>
		<td>{{$user->name}}</td>
		<td><strong>PROJECT NAME:</strong></td>
		@if($requisitionheader->projectid=='OTHERS')
		 <td>OTHERS</td>
		@else
		
			<td width="40%">{{$project->projectname}}</td>
	    @endif
	
	</tr>
	<tr>
		 <td><strong>TOTAL PAID AMOUNT TILL DATE :</strong></td>
		 <td>{{$totalamt}}</td>
		 <td><strong>TOTAL EXPENSE TILL DATE :</strong></td>
		 <td>{{$totalamtentry}}</td>

	</tr>
	<tr>
		<td><strong>BALANCE AMOUNT :</strong></td>
		<td>{{$bal}}</td>
	</tr>
	
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
			<td>EXPENSE HEAD</td>
			<th>PARTICULAR</th>
            <th>VENDOR</th>
			<th>STATUS</th>
            <th>AMOUNT</th>
            <th>APPROVAL AMOUNT</th>
			<th>APPROVED BY</th>
			<th>ADDED BY</th>
			<th>CREATED AT</th>
            <th>UPLOADED FILE</th>
            <th>VIEW</th>
			
		</tr>
	</thead>
	<tbody>
		 @foreach($expenseentries as $expenseentry)
		<tr style="font-size: 12px;">
        <td><a href="/viewexpenseentrydetails/{{$expenseentry->id}}" class="btn btn-success">{{$expenseentry->id}}</a></td>
        <td>{{$expenseentry->expenseheadname}}</td>
        <td>{{$expenseentry->particularname}}</td>
        <td>{{$expenseentry->vendorname}}</td>
        @if($expenseentry->status=='PENDING')
        <td><span class="label label-danger">{{$expenseentry->status}}</span></td>
        @else
         <td><span class="label label-success">{{$expenseentry->status}}</span></td>
        @endif
        <td>{{$expenseentry->amount}}</td>
        <td>{{$expenseentry->approvalamount}}</td>
        <td>{{$expenseentry->approvedbyname}}</td>
        <td>{{$expenseentry->by}}</td>
		<td>{{$expenseentry->created_at}}</td>
         <td>
         	<a href="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}" target="_blank">
         	<img style="height:70px;width:95px;" alt="click to view" src="{{ asset('/img/expenseuploadedfile/'.$expenseentry->uploadedfile )}}">
         </a>
         </td>
         <td><a href="/viewexpenseentrydetails/{{$expenseentry->id}}" class="btn btn-warning">VIEW</a></td>
 
        

		</tr>
    @endforeach
	</tbody>
	
</table>
</div>

@endsection