

@extends('layouts.app')

@section('content')
   
<link href="{{ URL::asset('css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
<section class="content">

@if(Auth::user()->usertype=='MASTER ADMIN')
      <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$noofclients}}</h3>

              <p>No Of Clients</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/dm/viewallclient" class="small-box-footer">view all clients<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
            <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$noofprojects}}</h3>

              <p>No Of Projects</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/projects/viewallproject" class="small-box-footer">view all projects<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$completedprojects}}<sup style="font-size: 20px"></sup></h3>

              <p>Completed Project</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/projects/viewallproject" class="small-box-footer">view all projects<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$noofusers}}</h3>

              <p>No Of Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/dm/adduser" class="small-box-footer">view all users <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
   
        
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/usermsg/mymessages">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Messages</span>
              <span class="info-box-number" id="countmsg111"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/uc/viewallcomplaints" title="Differ Date Request">
          <div class="info-box">
            
             <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text" title="Differ Date Request">Differ Date Request</span>

              <span class="info-box-number" id="differcount">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/viewrequisitions/pendingrequisitions" title="Pending Requisition">

          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Pending Requisition">Pending Requisition</span>
              <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/expense/pendingexpenseentry" title="Pending Expense Entry">
                    <div class="info-box">
           
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pending Expense Entry</span>
              <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/vouchers/pendingdebitvoucheradmin" title="PENDING DEBIT VOUCHER ADMIN">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENDING DR VOUCHER</span>
              <span class="info-box-number">0</span>

             
                  <span class="progress-description">
                   
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/tour/pendingtourapplications" target="_blank" title="PENDING TOUR APPROVAL">
          <div class="info-box">
            <span class="info-box-icon"><i class="fa fa-plane"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENDING TOUR APPROVAL</span>
              <span class="info-box-number">0</span>
            </div>
       
          </div>
          </a>
        </div>
       
      </div>

      @endif

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
              <a  href="/userviewallmytodo" class="btn btn-default pull-right"><i class="fa fa-bars"></i>Todo List</a>
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

