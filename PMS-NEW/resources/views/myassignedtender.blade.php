@extends('layouts.app')
@section('content')
<style type="text/css">
	    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">ASSIGNED TENDER</td>
		
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-blue">
			<td>ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
			<td>SOURCE</td>
			<td>WORK VALUE</td>
			<td>NIT PUBLICATION DATE</td>
			<td>LAST DATE OF SUB.</td>
			<td>RFP AVAILABLE DATE</td>
			<td>CREATED AT</td>
			<td>STATUS</td>
			<td>VIEW</td>
			
		</tr>
	</thead>
	<tbody>
		@foreach($tenders as $tender)
		   <tr>
		   	<td>{{$tender->id}}</td>
		   	<td><p class="b" title="{{$tender->nameofthework}}">{{$tender->nameofthework}}</p></td>
		   	<td>{{$tender->clientname}}</td>
		   	<td>{{$tender->source}}</td>
		   	<td>{{$tender->workvalue}}</td>
		   	<td>{{$tender->nitpublicationdate}}</td>
		   	<td>{{$tender->lastdateofsubmisssion}}</td>
		   	<td>{{$tender->rfpavailabledate}}</td>
		   	<td>{{$tender->created_at}}</td>
		   	<td><span class="label label-success">{{$tender->status}}</span></td>
		   	<td><a href="/viewtenderuser/{{$tender->id}}" class="btn btn-info">VIEW</a></td>
		   </tr>

		@endforeach
	</tbody>
</table>
</div>
@endsection