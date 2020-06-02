@extends('layouts.account')
@section('content')
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy">
			<th><strong>SL.No</strong></th>
			<th><strong>AC.HOLDER NAME</strong></th>
			<th><strong>BANK NAME</strong></th>
			<th><strong>AC No</strong></th>
			<th><strong>IFSC</strong></th>
			<th><strong>BALANCE</strong></th>
			<th><strong>VIEW</strong></th>

		</tr>
	</thead>
	<tbody>
		@foreach($custarr as $key=>$arr)
		<tr>
			<td>{{++$key}}</td>
			<td>{{$arr['acholdername']}}</td>
			<td>{{$arr['bank']}}</td>
			<td>{{$arr['acno']}}</td>
			<td>{{$arr['ifsc']}}</td>
			<td>{{$arr['balance']}}</td>
			<td><a href="/viewdetailledgerbank/{{$arr['id']}}" class="btn btn-success">VIEW</a></td>
		</tr>
		@endforeach
	</tbody>

</table>
</div>

@endsection

