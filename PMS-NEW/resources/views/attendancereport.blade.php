@extends('layouts.app')

@section('content')

<table  class="table">
  <tr class="bg-blue">
    <td class="text-center">ATTENDANCE REPORT</td>
  </tr>
</table>

<table class="table">
	<form action="/attendance/attendancereport" method="get">
	<tr>
		<td><strong>FROM DATE</strong></td>
		<td><input type="text" class="attfromdate form-control readonly" placeholder="Enter From Date" name="fromdate" value="{{ Request::get('fromdate') }}" required="" autocomplete="off"></td>
		<td><strong>TO DATE</strong></td>
		<td><input type="text" class="atttodate form-control readonly" placeholder="Enter To Date" name="todate" value="{{ Request::get('todate') }}" required="" autocomplete="off"></td>
		<td><strong>Select a User</strong></td>
		<td>
			<select class="form-control select2" name="user" required="">
				<option value="">Select a User</option>
				@foreach($users as $user)
               <option value="{{$user->id}}" {{ ( $user->id == Request::get('user')) ? 'selected' : '' }}>{{$user->name}}</option>
				@endforeach
				
			</select>
		</td>
	
		<td><button type="submit" class="btn btn-info">FILTER</button></td>
	</tr>
	</form>
	
</table>

@if(Request::get('user') && Request::get('fromdate') && Request::get('todate'))
<div class="alert alert-warning">
  <p style="font-size: 15px;font-weight: bold;text-align: center;">Result Showing from Date <strong style="font-size: 18px;color: black">{{Request::get('fromdate')}} </strong>to <strong style="font-size: 18px;color: black">{{Request::get('todate')}}</strong> ({{$name}})</p>   
</div>
 
      
 

@endif
@if(Request::get('user') && Request::get('fromdate') && Request::get('todate'))
<table class="table table-responsive table-hover table-bordered table-striped datatable2">
	<thead>
		<tr>
			<th>NO</th>
			<th>USER ID</th>
			<th>DATE</th>
			<th>STATUS</th>
			<th>NO OF LOCATIONS</th>
			<th>MAP</th>
			<td>ADDRESS</td>
		</tr>
	</thead>
	<tbody>
		@foreach($all as $key=>$value)
         <tr>
         	<td>{{++$key}}</td>
         	<td>{{$value['userid']}}</td>
         	<td>{{$value['date']}}</td>
         	<td>{{$value['status']}}</td>
         	<td>{{$value['total']}}</td>
         	<th><a href="/showuserlocation/{{$value['userid']}}/{{$value['date']}}" target="_black" class="btn btn-success">MAP</a></th>
         	<th><a href="/showdetaillocations/{{$value['userid']}}/{{$value['date']}}" target="_black" class="btn btn-primary">DETAILS</a></th>
         </tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr style="background-color: gray;">
			<td></td>
			<td><strong>NO OF DAYS</strong></td>
			<td><strong>{{$totalDuration+1}}</strong></td>
			<td><strong>NO OF PRESENTS</strong></td>
			<td><strong>{{$count}}</strong></td>
			<td></td>
			<td></td>

		</tr>
	</tfoot>
	
</table>
@endif
@endsection