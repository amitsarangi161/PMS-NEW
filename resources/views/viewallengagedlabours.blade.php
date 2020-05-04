@extends('layouts.app')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
		<tr class="bg-blue">
			<td class="text-center">VIEW ALL ENGAGED LABOURS</td>
		</tr>
	</thead>

</table>
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
			<td>PROJECT</td>
			<td>DATE</td>
			<td>DESCRIPTION</td>
			<td>NO OF.LABOUR ENGAGED</td>
			<td>IMAGE</td>
			<td>VIEW</td>
		</tr>
	</thead>
	<tbody>
		@foreach($engagedlaboursarr as $el)
		   <tr>
		   <td>{{$el['id']}}</td>
		   <td>{{$el['projectname']}}</td>
		   <td>{{$el['date']}}</td>
		   <td>{{$el['description']}}</td>
		   <td>{{$el['nooflabour']}}</td>
		   <td>
		   <a href="{{ asset('/img/engagedlabourimg/'.$el['labourimage'] )}}" target="_blank">
              <img style="height:75px;width:95px;" alt="click to view the file"  src="{{ asset('/img/engagedlabourimg/'.$el['labourimage'] )}}"></td>
		   
		   <td><a href="/viewengagedlabourdetails/{{$el['id']}}" class="btn btn-primary">VIEW</a></td>
		   </tr>
		@endforeach
	</tbody>

</table>

@endsection