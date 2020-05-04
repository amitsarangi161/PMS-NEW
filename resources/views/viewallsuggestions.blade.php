@extends('layouts.app')
@section('content')
<!-- <style type="text/css">
	  .b {
    white-space: nowrap; 
    width: 601px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style> -->
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">VIEW ALL SUGGESTION</td>
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped datatable">
	
<thead>
	<tr>
		<td width="10%">ID</td>
		<td width="60%">SUGGESTION</td>
		<td width="20%">CREATED_AT</td>
		<td width="10%">ACTION</td>
	</tr>
</thead>
<tbody>
	@foreach($suggestions as $suggestion)
	   <tr>
	   	<td>{{$suggestion->id}}</td>
	   	<td><p class="b" title="{{$suggestion->description}}">{{$suggestion->description}}</p></td>
	   	<td>{{$suggestion->created_at}}</td>
	   	<td class="text-center" id="starid{{$suggestion->id}}">
	   		@if($suggestion->status=='0')
	   		<i class="fa fa-star-o" style="font-size: 30px;cursor: pointer;" onclick="myajax('{{$suggestion->id}}',1);"></i>

	   		@else
             <i class="fa fa-star" style="font-size: 30px;cursor: pointer;color: red;" onclick="myajax('{{$suggestion->id}}',0);"></i>
	   		@endif



	   	</td>
	   </tr>
    @endforeach
</tbody>
</table>

<script type="text/javascript">
	function myajax(sid,status)
	{
      $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangesuggestionstatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     sid:sid,
                     status:status,
                     
                     },

               success:function(data) { 
                     if(data.status=='1')
                     {
                     	var starid='#starid'+data.id;
                        var x='<i class="fa fa-star" style="font-size: 30px;cursor: pointer;color: red;" onclick="myajax('+data.id+',0);"></i>';
                        $(starid).html(x);
                     }
                     else
                     {
                     	  var starid='#starid'+data.id;
                          var y='<i class="fa fa-star-o" style="font-size: 30px;cursor: pointer;" onclick="myajax('+data.id+',1);"></i>';
                           $(starid).html(y);

                     }
                     
               }
             });
	}
</script>

@endsection