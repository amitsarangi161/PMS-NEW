@extends('layouts.account')
@section('content')

<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped sortfalsedatatable">
	<thead>
		<tr class="bg-navy">
			<th><strong>SL.No</strong></th>
			<th><strong>VENDOR NAME</strong></th>
			<th><strong>DETAILS</strong></th>
			<th><strong>MOBILE</strong></th>
			<th><strong>CREDIT</strong></th>
			<th><strong>DEBIT</strong></th>
			<th><strong>BALANCE</strong></th>
			<th><strong>VIEW</strong></th>
		</tr>
	</thead>
	<tbody>
		@foreach($custarr as $key=>$arr)
		<tr>
			<td>{{++$key}}</td>
			<td>{{$arr['vendor']->vendorname}}</td>
			<td>{{$arr['vendor']->details}}</td>
			<td>{{$arr['vendor']->mobile}}</td>
			<td>{{$arr['credit']}}</td>
			<td>{{$arr['debit']}}</td>
			<td>{{$arr['balance']}}</td>
			<td><a href="/account-report/{{$arr['vendor']->id}}" class="btn btn-success">VIEW</a></td>
		</tr>
		@endforeach
	</tbody>

</table>
</div>

@endsection

