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
   
<link href="{{ URL::asset('css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
<section class="content">



      <div class="row">
            <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

         <h3 class="box-title" style="font-size;font-size: 20px;color: darkred;font-weight: bolder;">My Todo List For Today</h3>
              <div class="text-center">
                    <button type="button" onclick="openmytodo();" class="btn btn-default text-center"><i class="fa fa-plus"></i> Add item</button>
              </div>
              <div class="box-tools pull-right">
               
                 {{$todos->links()}}
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                @foreach($todos as $todo)

                @php
                    if($todo->status=='1')
                    {
                       $color1="aqua";
                    }
                    else
                    {
                         $color1="#f6afd6";
                    }
                @endphp
             
                  <li style="background-color: {{$color1}}">
                  <!-- drag handle -->
                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- checkbox -->
                  <input type="checkbox" name="check" id="check{{$todo->id}}"  value="{{$todo->id}}" onclick='handleClick(this.value);' {{ $todo->status=='0' ? 'checked' : '' }}>
                  <!-- todo text -->
                  <span class="text">{{$todo->description}}</span>
                  <!-- Emphasis label -->
                
                  <small class="label label-info"><i class="fa fa-clock-o"></i> {{$todo->date}}</small>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i>{{date("g:i a", strtotime($todo->time))}}</small>
                   @php
                     if($todo->status=='1')
                     {
                         $status1="Pending";
                     }
                     else
                     {
                          $status1="Complted";
                     }
                   @endphp
                   @if($todo->status=='1')
                   <small class="label label-success"><i class="fa fa-clock-o"></i>{{$status1}}</small>
                   @else
                    <small class="label label-danger"><i class="fa fa-clock-o"></i>{{$status1}}</small>
                   @endif
                  
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit" onclick="openeditmodal('{{$todo->id}}','{{$todo->description}}','{{$todo->date}}','{{date("g:i A", strtotime($todo->time))}}');"></i>
                    <a href="/deletemytodo/{{$todo->id}}" onclick="return confirm('Do You want to delete this todo?');"><i class="fa fa-trash-o"></i></a>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <a  href="/hrviewallmytodo" class="btn btn-default pull-right"><i class="fa fa-bars"></i>Todo List</a>
            </div>
          </div>
           </div>
         
    </div>
    </section>

 <div id="myModal2" class="modal fade" role="dialog">
      <form action="/savetodo" method="post">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD TODO</h4>
      </div>
      <div class="modal-body">
      
          {{csrf_field()}}
        <table class="table">
          <tr>
            <td>Notes</td>
            <td><textarea class="form-control" name="description"></textarea></td>
          </tr>
          <tr>
            <td>Date</td>
            <td><input type="text" name="date" class="form-control datepicker1" readonly="">
              <p style="color: red;">*click for change the date</p>
            </td>
          </tr>
          <tr>
            <td>Time</td>
            <td><input type="text" name="time" class="form-control timepicker" readonly="">
              <p style="color: red;">*click for change the time</p>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-success btn-lg" type="submit">ADD</button>
      </div>
    </div>
  </div>
   </form>
</div>

<div id="myModal3" class="modal fade" role="dialog">
  <form action="/updatetodo" method="post">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT TODO</h4>
      </div>
      <div class="modal-body">
        
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
         
            
                            
           
          
        </table>
        </form>
        
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-success btn-lg" type="submit">UPDATE</button>

      </div>






    




 

<script type="text/javascript" src="{{ URL::asset('js/bootstrap-timepicker.js') }}"></script>

   <script type="text/javascript">
     function openmytodo()
     {
        $("#myModal2").modal('show');
     }
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

