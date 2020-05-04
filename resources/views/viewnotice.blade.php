@extends('layouts.hr')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/css/editor.css')}}">
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">VIEW NOTICE</td>
	</tr>
</table>

<table class="table">

	<tr>
		<td><strong>NOTICE SUBJECT <p style="color: red">*</p></strong></td>
		<td><input type="text" name="subject" class="form-control" placeholder="Enter Notice Subject" value="{{$notice->subject}}"  readonly="" autocomplete="off"></td>
	</tr>
	<tr>
		<td><strong>NOTICE DESCRIPTION <p style="color: red">*</p></strong></td>
		<td>	
          {{$notice->description}}
		</td>
	</tr>
	<tr>
		<td><strong>ATTACHMENT</strong></td>
		<td>	
         <a href="{{ asset('/img/notice/'.$notice->attachment )}}" target="_blank">
          <img style="height:70px;width:95px;" alt="{{($notice->attachment!='')?$notice->attachment:'No attachment'}}" src="{{ asset('/img/notice/'.$notice->attachment )}}" title="click to view"></a>
		</td>
	</tr>

	
</table>
</form>
<script type="text/javascript" src="{{asset('/js/tinyeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/editor.js')}}"></script>

@endsection