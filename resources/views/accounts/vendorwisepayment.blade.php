@extends('layouts.account')
@section('content')

<table class="table">
  <form action="/vendor/vendorwisepayment" method="get">
  <tr>

    <td><strong>Vendor Type</strong></td>
    <td>
      <select name="vendortype" required="" class="form-control">
        <option value="ALL">ALL</option>
        @foreach($vendortypes as $vendortype)
        
        <option value="{{$vendortype->id}}" {{(Request::get('vendortype')==$vendortype->id)?'selected':''}}>{{$vendortype->vendortype}}</option>
        @endforeach
      </select>
    </td>
    <td><button type="submit" class="btn btn-success">Filter</button></td>
    @if(Request::has('vendortype'))
        <td><a href="/vendor/vendorwisepayment" class="btn btn-danger">Clear</a></td>
    @endif

  </tr>
  </form>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped sortfalsedatatable">
	<thead>
		<tr class="bg-navy">
			<th><strong>SL.No</strong></th>
			<th><strong>VENDOR TYPE</strong></th>
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
			<td>{{$arr['vendor']->vendortype}}</td>
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

