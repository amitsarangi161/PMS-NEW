@extends('layouts.app')

@section('content')

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
    <thead>
    	<td>ID</td>
    	<td>DESCRIPTION</td>
    	<td>DATE</td>
    	<td>TIME</td>
    	<td>CREATED AT</td>
    	<td>STATUS</td>
    	<td>CHECK</td>
    	<td>EDIT</td>
    	<td>DELETE</td>
    </thead>
    <tbody>
    	@foreach($todos as $todo)
    	 @php
                     if($todo->status=='1')
                     {
                         $status1="Pending";
                         $color1="aqua";
                     }
                     else
                     {
                          $status1="Complted";
                          $color1="#f6afd6";
                     }
        @endphp
    	<tr style="background-color: {{$color1}}">
    		<td>{{$todo->id}}</td>
    		<td>{{$todo->description}}</td>
    		<td>{{$todo->date}}</td>
    		<td>{{$todo->time}}</td>
    		<td>{{$todo->created_at}}</td>
    		<td>{{$status1}}</td>
    		<td class="text-center">
    			<input type="checkbox" name="check" id="check{{$todo->id}}"  value="{{$todo->id}}" onclick='handleClick(this.value);' {{ $todo->status=='0' ? 'checked' : '' }}>
    		</td>
    		<td class="text-center"><button type="button" style="background-color: transparent;border: none;" onclick="openeditmodal('{{$todo->id}}','{{$todo->description}}','{{$todo->date}}','{{date("g:i A", strtotime($todo->time))}}');" ><i class="fa fa-pencil" style="font-size: 2em;"></i></button></td>
    		<td class="text-center"><a href="/deletemytodo/{{$todo->id}}" onclick="return confirm('Do You want to delete this todo?');"><i class="fa fa-trash-o" style="font-size: 2em;"></i></a></td>
    	</tr>
    	@endforeach
    </tbody>
</table>
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT TODO</h4>
      </div>
      <div class="modal-body">
        <form action="/updatetodo" method="post">
          {{csrf_field()}}
        <table class="table">
          <input type="hidden" id="tdid" name="tdid">
          <tr>
            <td>Notes</td>
            <td><textarea class="form-control" name="description" id="description"></textarea></td>
          </tr>
          <tr>
            <td>Date</td>
            <td><input type="text" name="date" id="date" class="form-control datepicker1" readonly="">
              <p style="color: red;">*click for change the date</p>
            </td>
          </tr>
          <tr>
            <td>Time</td>
            <td><input type="text" name="time" id="time" class="form-control timepicker" readonly="">
              <p style="color: red;">*click for change the time</p>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <button class="btn btn-success" type="submit">UPDATE</button>
              
            </td>
          </tr>
          
        </table>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	     function openeditmodal(id,description,date,time)
     {
             $("#tdid").val(id);
             $("#description").val(description);
             $("#date").val(date);
             $("#time").val(time);

             $("#myModal3").modal('show');
     }
    $('.timepicker').timepicker({minuteStep: 1});
     function handleClick(value)
    {
        var chk=$('#check' + value).is(":checked")
         if(chk)
         {
            sta=0;
         }
         else
         {
          sta=1;
         }
         $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangetodostatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      status: sta,
                      tid:value
                      

                     },

               success:function(data) { 
                
                location.reload();
               }
               });

    }

</script>
@endsection