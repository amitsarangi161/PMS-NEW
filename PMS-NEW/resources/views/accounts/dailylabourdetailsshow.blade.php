@extends('layouts.account')
@section('content')
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">LABOUR DETAILS</td>
	</tr>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
			<td>LABOUR NAME</td>
			<td>ADDRESS</td>
			<td>MOBILE</td>
		</tr>
	</thead>
	<tbody>
		@foreach($labours as $labour)
          <tr>
          	<td>{{$labour->id}}</td>
          	<td>{{$labour->labourname}}</td>
          	<td>{{$labour->address}}</td>
          	<td>{{$labour->mobile}}</td>
          </tr>
		@endforeach
	</tbody>
</table>
@endsection