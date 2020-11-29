@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')
@inject('tend1', 'App\Http\Controllers\AccountController')
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
		<td class="text-center">USER PENDING TENDERS</td>
		
	</tr>
</table>
<h4>PENDING USERS</h4>
<ol>
	@foreach($pendingtenderusers as $pendingtenderuser)
     <li style="font-weight: bold;background-color:#ffafaf;"><strong>Name:-</strong>{{$pendingtenderuser->name}} <strong>PENDING </strong> {{$pendingtenderuser->total}}</li>
	@endforeach
</ol>

<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
	<thead>
<tr class="bg-blue">
			<td>ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
			<td>LOCATION</td>
			<td>SOURCE</td>
			<td>WORK VALUE</td>
			<td>LAST DATE OF SUB.</td>
			<td>EMD AMT</td>
			<td>ASSIGNED USER</td>
			<td>CREATED AT</td>
			<td>VIEW</td>
</tr>
</thead>
<tbody>
	 @foreach($tenderarr as $tend)
	    <tr>
	    	<td><a href="/viewtenderpendinguser/{{$tend['tender']->id}}" target="_blank" class="btn btn-info">{{$tend['tender']->id}}</a></td>
	    	<td><p class="b" title="{{$tend['tender']->nameofthework}}">{{$tend['tender']->nameofthework}}</p></td>
		   	<td>{{$tend['tender']->clientname}}</td>
		   	<td>{{$tend['tender']->location}}</td>
		   	<td>{{$tend['tender']->source}}</td>
		   	<td>{{$tend['tender']->workvalue}}</td>
		   	<td data-sort="{{strtotime($tend['tender']->lastdateofsubmisssion)}}"><span class="label label-danger btn btn-lg" style="font-size: 12px;">{{$provider::changedateformat($tend['tender']->lastdateofsubmisssion)}}</span></td>
		   	<td>{{$tend1::moneyFormatIndia($tend['tender']->emdamount)}}</td>
		   	<td>
		   		<ol>
		   		@foreach($tend['tenderusers'] as $user)
                   <li>{{$user['name']}}
                     @if($user->status=='PENDING')
                   	<span class="label label-danger"><strong>({{$user->status}})</strong></li></span>
                   	@else
                       <span class="label label-success"><strong>({{$user->status}})</strong></li></span>
                   	@endif
		   		@endforeach
		   		</ol>
		   	</td>
		   	<td data-sort="{{strtotime($tend['tender']->created_at)}}">{{$provider::changedatetimeformat($tend['tender']->created_at)}}</td>
		   	<td><a href="/viewtenderpendinguser/{{$tend['tender']->id}}" class="btn btn-info" target="_blank">VIEW</a></td>
	    </tr>

	 @endforeach
</tbody>
</table>
@endsection