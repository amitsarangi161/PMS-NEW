@extends('layouts.app')
@section('content')

<table class="table">
	<tr class="bg-primary">
		<td class="text-center">VIEW  WALLET</td>
	</tr>
	
</table>
<table class="table table-responsive table-hover table-bordered table-striped datatable1">

	<thead>
		<tr class="bg-navy">
			<td>SL_NO</td>
			<td>CREDIT</td>
			<td>DEBIT</td>
			<td>TYPE</td>
			<td>CREATED_AT</td>
		</tr>
	</thead>
	<tbody>
		@foreach($wallets as $key=>$wallet)
		<tr>
			<td>{{$key+1}}</td>
			<td>{{$wallet->credit}}</td>
			<td>{{$wallet->debit}}</td>
			<td>
				@if($wallet->debit=='0')
				CR
				@else
				DR
				@endif
			</td>
			<td>{{$wallet->created_at}}</td>

		</tr>
		@endforeach

		
	</tbody>
	<tfoot>
		<tr class="bg-gray">
		   <td></td>
		   <td><strong>TOTAL CR: Rs.{{$wallets->sum('credit')}}</strong></td>
		   <td><strong>TOTAL DR: Rs.{{$wallets->sum('debit')}}</strong></td>
		   <td><strong>BALANCE :</strong></td>
		   <td><strong>Rs.{{$wallets->sum('credit')-$wallets->sum('debit')}}</strong></td>

		</tr>
	</tfoot>
	
</table>

@endsection