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
		@php
		$crsum=array();
		$drsum=array();
		$balsum=array();
		@endphp

		@foreach($custarr as $key=>$arr)
		<tr>
			<td>{{++$key}}</td>
			<td>{{$arr['vendor']->vendorname}}</td>
			<td>{{$arr['vendor']->details}}</td>
			<td>{{$arr['vendor']->mobile}}</td>
			<td>{{$crsum[]=$arr['credit']}}</td>
			<td>{{$drsum[]=$arr['debit']}}</td>
			<td>{{$balsum[]=$arr['balance']}}</td>
			<td><a href="/account-report/{{$arr['vendor']->id}}" class="btn btn-success">VIEW</a></td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr bgcolor="#97FFD7">
			<td></td>
			<td></td>
			<td></td>
			<td><strong>TOTAL</strong></td>
			<td><strong>{{array_sum($crsum)}}</strong></td>
			<td><strong>{{array_sum($drsum)}}</strong></td>
			<td><strong>{{array_sum($balsum)}}</strong></td>
			<td></td>
		</tr>
	</tfoot>

</table>
</div>

@endsection

