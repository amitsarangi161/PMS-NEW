@extends('layouts.hr')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">ADD DOCUMENTS</td>
	</tr>
</table>
@if(Session::has('msg'))
<p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center" style="font-weight: bold;text-transform: capitalize;">
{{ Session::get('msg') }}</p>
@endif
@if(Session::has('error'))
<p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center" style="font-weight: bold;text-transform: capitalize;">
{{ Session::get('error') }}</p>
@endif
<table class="table table-responsive table-hover table-bordered table-striped">
	<form action="/savedocument" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
	<tr>
		<td><strong>Document Name</strong></td>
		<td><input type="text" name="docname" class="form-control" autocomplete="off" required="" placeholder="Document Name"></td>
		<td><strong>Upload File</strong></td>
		<td><input type="file" name="attachment" required=""></td>
		<td>
			<button class="btn btn-primary" type="submit">ADD</button>
		</td>
	</tr>
	</form>
</table>
@if(count($documents)>0)
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">UPLOADED DOCUMENT</td>
	</tr>
</table>
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr>
		  <th>ID</th>
		  <th>DOCUMENT NAME</th>
		  <th>ATTACHMENT</th>
		  <td>DELETE</td>
		</tr>
	</thead>
	<tbody>
		@foreach($documents as $document)
		<tr>
			<td>{{$document->id}}</td>
			<td>{{$document->docname}}</td>
			<td> 
              		<a href="{{ asset('/img/doc/'.$document->attachment )}}" target="_blank">
                    <img style="height:70px;width:95px;" alt="{{($document->attachment!='')?$document->attachment:'No attachment'}}" src="{{ asset('/img/doc/'.$document->attachment )}}"></a>
            </td>
            <td>
            	<form action="/deletedocument/{{$document->id}}" method="POST">
            		{{csrf_field()}}
            		{{method_field('delete')}}
            		<button type="submit" onclick="return confirm('Do You Want to Delete this Document?')" class="btn btn-danger">DELETE</button>
            	</form>
            </td>
		</tr>

		@endforeach
	</tbody>
	
</table>
@endif

@endsection