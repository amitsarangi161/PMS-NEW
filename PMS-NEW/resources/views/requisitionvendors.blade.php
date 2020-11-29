@extends('layouts.app')
@section('content')

<div class="table-responsive">
	<table class="table table-responsive table-hover table-bordered table-striped datatable1">
		<thead>
			<tr class="bg-navy">
				<td>ID</td>
				<td>REQUISITION ID</td>
				<td>PROJECT</td>
				<td>EXPENSE HEAD</td>
				<td>PARTICULAR</td>
                <td>DESCRIPTION</td>
                <td>PAY TO</td>
                <td>AMOUNT</td>
                <td>CREATED AT</td>
                <td>ADD DETAILS</td>
   			</tr>
		</thead>
		<tbody>
			@foreach($requisitionvendors as $requisitionvendor)
			<tr>
				<td>{{$requisitionvendor->id}}</td>
				<td>{{$requisitionvendor->requisitionheaderid}}</td>
				<td width="10%">{{$requisitionvendor->projectname}}</td>
				<td>{{$requisitionvendor->expenseheadname}}</td>
				<td>{{$requisitionvendor->particularname}}</td>
				<td>{{$requisitionvendor->description}}</td>
				<td>{{$requisitionvendor->payto}}</td>
				<td>{{$requisitionvendor->amount}}</td>
				<td>{{$requisitionvendor->created_at}}</td>
				<td><a href="/addvendordetails/{{$requisitionvendor->id}}" class="btn btn-primary">ADD</a></td>

			</tr>
			@endforeach
		</tbody>
		
	</table>
	
</div>

@endsection