@extends('layouts.start')
@section('content')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 436px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table class="table">
	<tr>
		<td class="text-center" style="font-size: 18px;font-weight: bold;margin: 0;display: block;padding: 20px;box-sizing: border-box;background: #06CC83;letter-spacing: 1px;"><strong>VIEW ALL NOTICE</strong></td>
		
	</tr>
</table>
<div class="well">
	

<table class="table table-responsive table-hover table-bordered">
	<thead>
		<tr style="background-color: teal;">
			<td width="10%" style="font-weight: bold;font-size: 15px;"><strong>SL_NO</strong></td>
			<td width="25%" style="font-weight: bold;font-size: 15px;"><strong>SUBJECT</strong></td>
			<td width="35%" style="font-weight: bold;font-size: 15px;"><strong>DESCRIPTION</strong></td>
			<td width="10%" style="font-weight: bold;font-size: 15px;">
				<strong>ATTACHMENT</strong>
			</td>
			<td width="10%" style="font-weight: bold;font-size: 15px;">
				<strong>CREATED_AT</strong>
			</td>
			<td width="10%" style="font-weight: bold;font-size: 15px;">
				<strong>VIEW</strong>
			</td>
			
		</tr>
	</thead>
	<tbody>
		@foreach($notices as $key=>$notice)
         <tr>
         	<td><a class="btn btn-success">{{++$key}}</a></td>
         	<td>{{$notice->subject}}</td>
         	<td><p class="b" title="{{$notice->description}}">{{$notice->description}}</p></td>
         	<td>
         		<a href="{{asset('/img/doc/'.$notice->attachment)}}" target="_blank">
         			{{$notice->attachment}}</i>

         		</a>
         </td>
         <td>{{$notice->created_at}}</td>
         <td class="text-center">
         	<a href="/viewnoticehome/{{$notice->id}}"><i class="fa fa-eye" style="font-size: 22px;"></i></a>

         </td>
         </tr>
		@endforeach
	</tbody>

</table>
{{$notices->links()}}
</div>
@endsection