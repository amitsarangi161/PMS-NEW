@extends('layouts.start')
@section('content')

<table class="table">
	<tr>
		<td class="text-center" style="font-size: 18px;font-weight: bold;margin: 0;display: block;padding: 20px;box-sizing: border-box;background: #06CC83;letter-spacing: 1px;"><strong>VIEW ALL DOCUMENTS</strong></td>
		
	</tr>
</table>
<div class="well">
	

<table class="table table-responsive table-hover table-bordered">
	<thead>
		<tr style="background-color: teal;">
			<td width="20%" style="font-weight: bold;font-size: 15px;"><strong>SL_NO</strong></td>
			<td width="40%" style="font-weight: bold;font-size: 15px;"><strong>NAME</strong></td>
			<td width="30%" style="font-weight: bold;font-size: 15px;"><strong>ATTACHMENT</strong></td>
			<td width="10%" style="font-weight: bold;font-size: 15px;">
				<strong>UPLOADED_AT</strong>
			</td>
			
		</tr>
	</thead>
	<tbody>
		@foreach($documents as $key=>$document)
         <tr>
         	<td><a class="btn btn-success">{{++$key}}</a></td>
         	<td>{{$document->docname}}</td>
         	<td>
         	<!-- 	<a href="{{asset('/img/doc/'.$document->attachment)}}" target="_blank">
         			{{$document->attachment}}</i>

         		</a> -->
         	<a href="/view-all-documents/{{$document->id}}" class="btn btn-primary" target="_blank">VIEW</a>
         </td>
         <td>{{$document->created_at}}</td>
         </tr>
		@endforeach
	</tbody>

</table>
{{$documents->links()}}
</div>

@endsection