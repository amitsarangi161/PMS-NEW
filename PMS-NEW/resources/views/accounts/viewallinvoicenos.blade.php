@extends('layouts.account')
@section('content')

<table class="table table-responsive table-hover table-bordered table-striped datatable3">
	<thead>
		<tr class="bg-navy">
			<td>SL NO</td>
			<td>COMPANY</td>
			<td>YEAR</td>
			<td>INVOICE NO</td>
			<td>CREATED AT</td>
		</tr>
	</thead>
	<tbody>
		@foreach($invoicenos as $key=>$invoiceno)
		  @php  
            $id=$invoiceno->billid;
            if($id!='')
            {
            	$bill=\App\billheader::find($id);
            	$fullinvno=$bill->fullinvno;
            }
            else
            {
            	$crvoucher=\App\crvoucherheader::find($invoiceno->crvoucherid);
            	$fullinvno=$crvoucher->fullinvno;
            }
		  @endphp
          <tr>
          	<td>{{++$key}}</td>
          	<td>{{$invoiceno->company}}</td>
          	<td>{{$invoiceno->invyear}}</td>
          	<td>{{$fullinvno}}</td>
          	<td>{{$invoiceno->created_at}}</td>
          </tr>
		@endforeach
	</tbody>
	
</table>

@endsection