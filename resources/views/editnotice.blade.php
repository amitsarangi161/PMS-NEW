@extends('layouts.hr')
@section('content')
<!-- <link rel="stylesheet" type="text/css" href="{{asset('/css/editor.css')}}"> -->
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">EDIT NOTICE</td>
	</tr>
</table>
<form action="/updatenotice/{{$notice->id}}" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}
@if(Session::has('msg'))
<p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center" style="font-weight: bold;text-transform: capitalize;">
{{ Session::get('msg') }}</p>
@endif
<table class="table">

	<tr>
		<td><strong>NOTICE SUBJECT <p style="color: red">*</p></strong></td>
		<td><input type="text" name="subject" class="form-control" placeholder="Enter Notice Subject" value="{{$notice->subject}}" required="" autocomplete="off"></td>
	</tr>
	<tr>
		<td><strong>NOTICE DESCRIPTION <p style="color: red">*</p></strong></td>
		<td>	
<textarea  class="form-control" name="description" rows="12">{!!$notice->description!!}</textarea>
		</td>
	</tr>
	<tr>
		<td><strong>ATTACHMENT</strong></td>
		<td>	
          <input type="file" name="attachment" class="form-control">
          <img style="height:70px;width:95px;" alt="click to view" src="{{ asset('/img/notice/'.$notice->attachment )}}"></a>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: right;">
			<button class="btn btn-success btn-lg" type="submit" onclick="return confirm('Do You want to Save this Notice?')">UPDATE</button>
		</td>
	</tr>
	
</table>
</form>
<!-- <script type="text/javascript" src="{{asset('/js/tinyeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/editor.js')}}"></script> -->

@endsection