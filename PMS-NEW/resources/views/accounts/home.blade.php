@extends('layouts.account')
@section('content')
@if(Auth::user()->usertype!='MASTER ADMIN')




    @php
     
     $tdate=date('Y-m-d');
     $uid=Auth::id();
     $complaints=\App\complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                  ->where('complaints.lastdate',$tdate)
                  ->where('complaints.status','!=','RESOLVED')

                 ->where(function($query) use ($uid){
                      $query->where('complaints.touserid',$uid);
                      $query->orWhere('complaints.cc',$uid);
                  })
                
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();






     @endphp
  
 
    @if(count($complaints)>0)




<div class="modal fade" id="myModal9" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background-color: chocolate;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">Today Activity Reminder</h4>
        </div>
        <div class="modal-body">

     @if(count($complaints)>0 )    
     <div class="table-responsive"> 
          <table class="table table-responsive table-condensed table-hover table-bordered table-striped">
            <tr class="bg-blue"><td class="text-center">COMPLAINTS TO RESOLVE TODAY</td></tr>
          </table>
          <table class="table table-responsive table-condensed table-hover table-bordered table-striped">
              <thead>
               <tr class="bg-navy" style="font-size: 10px;">
      <td>ID</td>
      <td>TYPE</td>
      <td>COMPLAINT FORM</td>
      <td>COMPLAINT TO</td>
      <td>CC</td>
      <td>DATE OF POST</td>
      <td>DESCRIPTION</td>
  
      <td>EXP.DATE TO SOLVE</td>
      <td>REMARK</td>
   
      <td>STATUS</td>
      <td>VIEW</td>
      
     
    </tr>
    </thead>
           <tbody>
             @foreach($complaints as $compalint)
    <tr style="font-size: 13px;">
      <td>{{$compalint->id}}</td>
      <td>{{$compalint->type}}</td>
      <td>{{$compalint->from}}</td>
      <td>{{$compalint->to}}</td>
      <td>{{$compalint->ccname}}</td>
      <td>{{$compalint->created_at}}</td>
      <td>{{$compalint->description}}</td>

      <td>{{$compalint->lastdate}}</td>
      <td>{{$compalint->remark}}</td>

      @if($compalint->status=='PENDING')
      <td><span class="label label-danger">{{$compalint->status}}</span></td>
      @else
      <td><span class="label label-success">{{$compalint->status}}</span></td>
      @endif
      <td>
        <a href="/ucacc/complainttoresolve" class="btn btn-primary">VIEW</a>
      </td>
    
    </tr>
    @endforeach
             
           </tbody>
    </table>
  </div>
    @endif

   
        </div>
        <div class="modal-footer" style="background-color: chocolate;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


    <script type="text/javascript">
      $(window).on('load',function(){
        $('#myModal9').modal('show');
    });
      $('#myModal9').modal({
    backdrop: 'static',
    keyboard: false
    });
    </script>


    @endif

    
     
    @endif
    
   

@endsection
