@extends('layouts.account')
@section('content')


        
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped sortfalsedatatable">
	<thead>
		<tr class="bg-black">
			<td>ID</td>
			<td>AC HOLDER</td>
			<td>BANK</td>
			<td>AC NO</td>
			<td>DATE</td>
			<td>OB</td>
			<td>CREDIT</td>
			<td>DEBIT</td>
			<td>CB</td>
		</tr>
	</thead>
	<tbody>
		  @php 
		     $ob=$ob;
		  @endphp 
		@foreach($bankledgers as $bankledger)
		 
		 <tr>
		 <td>{{$bankledger->id}}</td>
		 <td>{{$details->accountholdername}}</td>
		 <td>{{$details->bankname}}</td>
		 <td>{{$details->acno}}</td>
		 <td>{{$bankledger->date}}</td>
		 <td>{{$ob}}</td>
		 <td>{{$tcr=$bankledger->sumcr}}</td>
		 <td>{{$tdr=$bankledger->sumdr}}</td>
		 <td>{{$ob=($ob+$tcr)-$tdr}}</td>
		 </tr>
		@endforeach
	</tbody>

</table>
</div>

@endsection