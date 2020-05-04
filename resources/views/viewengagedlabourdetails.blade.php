@extends('layouts.app')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
		<tr class="bg-blue">
			<td class="text-center">VIEW ENGAGED LABOURS DETAILS</td>
		</tr>
	</thead>
</table>
<div class="well" style="background-color: cadetblue;">
	<table class="table">
		<tr>
			<td><strong>ID</strong></td>
			<td>#{{$engagedlaboursarr['id']}}</td>
			<td><strong>NAME</strong></td>
			<td>{{$engagedlaboursarr['name']}}</td>
		</tr>
		<tr>
			<td><strong>PROJECT NAME</strong></td>
			<td>{{$engagedlaboursarr['projectname']}}</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><strong>DESCRIPTION</strong></td>
			<td>{{$engagedlaboursarr['description']}}</td>
			<td><strong>DATE</strong></td>
			<td>{{$engagedlaboursarr['date']}}</td>
		</tr>
			<tr>
			<td><strong>NO OF LABOUR</strong></td>
			<td>{{$engagedlaboursarr['nooflabour']}}</td>
			<td><strong>IMAGE</strong></td>
			<td>
			        	
              <a href="{{ asset('/img/engagedlabourimg/'.$engagedlaboursarr['labourimage'] )}}" target="_blank">
              <img style="height:95px;width:95px;" alt="click to view the file"  src="{{ asset('/img/engagedlabourimg/'.$engagedlaboursarr['labourimage'] )}}">
            </a>
        
		    </td>
		</tr>
		
	</table>

</div>
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
		<tr class="bg-blue">
			<td class="text-center">LABOURS DETAILS</td>
		</tr>
	</thead>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
		<tr class="bg-navy">
		<td>ID</td>
		<td>LABOUR NAME</td>
		<td>ADDRESS</td>
		<td>MOBILE NO</td>
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