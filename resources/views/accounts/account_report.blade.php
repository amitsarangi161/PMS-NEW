@extends('layouts.account')

@section('content')
@if(Session::has('msg'))
<p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VENDOR DETAILS</td>

	</tr>

</table>

<div class="well">
	<table class="table">
		<tr>
			<td width="20%"><strong>VENDOR ID :</strong></td>
            <td width="30%">#{{$vendor->id}}</td>
        </tr>
        <tr>
			<td width="20%"><strong>VENDOR NAME:</strong></td>
			<td width="30%">{{$vendor->vendorname}}</td>
		</tr>
    </table>
</div>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VENDOR ACCOUNT DETAILS</td>

	</tr>

</table>

<div class="well">
	<table class="table table-responsive table-bordered table-hover table-striped">
        <thead style="background: #0073b7;
    color: #fff;">
            <th>ID</th>
            <th>Transaction Date</th>
            <th>Credit</th>
            <th>Debit</th>
        </thead>
        @foreach($trns as $key=>$trn)
		<tr>
            <td width="20%"><a href="/viewdrvoucher/{{$trn->id}}" target="_blank" class="btn btn-info">{{$trn->id}}</a></td>
			<td width="20%">{{$trn->created_at}}</td>
            <td style="text-align: right" width="30%">{{$trn->credit}}</td>
            <td style="text-align: right" width="30%">{{$trn->debit}}</td>
        </tr>
        @endforeach

        <tfoot style="background: #c0c0c0;">
			<tr><td colspan='2'>Total</td>
            <td style="text-align: right" width="30%">{{$trns->sum('credit')}}</td>
            <td style="text-align: right" width="30%">{{$trns->sum('debit')}}</td>
			</tr>
            <tr style="
    background: #9e9c9c;
">
			<td colspan='3'>Balance</td>
            <td style="border-bottom:double ;text-align: right" width="30%">{{$trns->sum('credit')-$trns->sum('debit')}}</td>
</tr>
        </tfoot>
       
    </table>
</div>


@endsection