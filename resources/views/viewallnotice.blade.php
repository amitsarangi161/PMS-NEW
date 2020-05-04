@extends('layouts.hr')
@section('content')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">NOTICE</td>
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	
	<thead>
		<tr>
			<th>ID</th>
			<th>SUBJECT</th>
			<th>DESCRIPTION</th>
      <th>ATTACHMENT</th>
			<th>STATUS</th>
			<th>EDIT</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		@foreach($notices as $notice)
              <tr>
              	<td><a href="/viewnotice/{{$notice->id}}" class="btn btn-info" target="_blank">{{$notice->id}}</a></td>
              	<td>{{$notice->subject}}</td>
              	<td><p class="b" title="{{$notice->description}}">{!!$notice->description!!}</p></td>
              	<td> 
              		<a href="{{ asset('/img/notice/'.$notice->attachment )}}" target="_blank">
                    <img style="height:70px;width:95px;" alt="{{($notice->attachment!='')?$notice->attachment:'No attachment'}}" src="{{ asset('/img/notice/'.$notice->attachment )}}"></a>
                  </td>
                  <td>
                  	@if($notice->status=='ACTIVE')
                  	<span class="label label-success">{{$notice->status}}</span>
                  	@else
                    <span class="label label-danger">{{$notice->status}}</span>
                  	@endif
                  </td>
                 <td>
                   <a href="/editnotice/{{$notice->id}}" class="btn btn-warning">EDIT</a>
                 </td>
                 <td>
                 	@if($notice->status=='ACTIVE')
                     <a href="/deactivenotice/{{$notice->id}}" class="btn btn-danger" onclick="return confirm('Do You Want to Deactive this Notice?');">DEACTIVE</a>
                 	@else
                 	<a href="/activenotice/{{$notice->id}}" class="btn btn-success"onclick="return confirm('Do You Want to Active this Notice?');">ACTIVE</a>
                 	@endif

                 </td>
              </tr>
		@endforeach
	</tbody>
</table>


@endsection