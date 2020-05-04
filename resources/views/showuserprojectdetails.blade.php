@extends('layouts.app')
@section('content')
<table class="table table-responsive table-hover table-bordered table-striped">
  <thead>
  <tr class="bg-primary">
    <td class="text-center">POJECT DETAILS</td>
  </tr>
  </thead>
</table>
<table class="table table-responsive" >
  <tbody style="background-color: #c0c0c0;">
  <tr>
    <td style="color: #1790b0;">PROJECT FOR</td>
    <td>{{$project->orgname}}</td>
    <td style="color: #1790b0;">PRJECT NAME</td>
   <td>{{$project->projectname}}</td>
    
  </tr>
   <tr>
    <td style="color: #1790b0;">CLIENT NAME</td>
    <td>{{$project->clientname}}</td>
    <td style="color: #1790b0;">PRJECT ID</td>
   <td>{{$project->projectid}}</td>
    
  </tr>

   <tr>
    <td style="color: #1790b0;">PROJECT START DATE</td>
    <td>{{$project->startdate}}</td>
    <td style="color: #1790b0;">PRJECT END DATE</td>
   <td>{{$project->enddate}}</td>
    
  </tr>
    <tr>
    <td style="color: #1790b0;">NO OF DAYS</td>
     @php
               $start = Carbon\Carbon::parse($project->startdate. '00:00:00');
               $end = Carbon\Carbon::parse($project->enddate. '11:59:59');

               $diff=$end->diffInDays($start);

      @endphp
   @if($diff>=0)
    <td>{{$diff}}</td>
    @else
      <td>0</td>
    @endif
    <td style="color: #1790b0;">DAYS REMAINING</td>

    @php
     $date1 = Carbon\Carbon::parse($project->enddate. '11:59:59');
               $now = Carbon\Carbon::now();

               $diff1 = $date1->diffInDays($now);

    @endphp
      @if($diff1 >=0)
    <td>{{$diff1}}</td>
    @else
      <td>0</td>
    @endif
   
    
  </tr>
     <tr>
    <td style="color: #1790b0;">PRIORITY</td>
    <td>{{$project->priority}}</td>
    <td style="color: #1790b0;">STATUS</td>
   <td>{{$project->status}}</td>
    
  </tr>
  @if($project->orderform)
  <tr>
    <td>ORDER FORM</td>
    <td> <a href="/img/orderform/{{$project->orderform}}" download>
        Click Here to download
         </a></td>
   <td></td>
   <td></td>
  </tr>
  @endif
  </tbody>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
  <thead>
  <tr class="bg-primary">
    <td class="text-center">PRJECT ACTIVITIES DETAILS</td>
  </tr>
  </thead>
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
  <thead>
    <tr class="bg-navy">
      <td>SL_NO</td>
      <td>ACTIVITY ORDER</td>
      <td>ACTIVITY NAME</td>
      <td>REPORT</td>
      
    </tr>
  </thead>
  <tbody>
    @foreach($activities as $key=>$activity)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$activity->position}}</td>
      <td><strong>{{$activity->activityname}}</strong></td>
      <td><button class="btn btn-success" onclick="writeprojectreport('{{$project->id}}','{{$activity->actid}}','{{$project->clientid}}')">WRITE A REPORT</button></td>
    
    </tr>
    @endforeach
  </tbody>

</table>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">WRITE PROJECT REPORT</h4>
        </div>
        <div class="modal-body">

          <form action="/saveuserreport" method="post">
             {{csrf_field()}}
          <table class="table table-responsive table-hover table-bordered table-striped">

  <thead>
    <tr>
      <td>Report For Date</td>
      <td>
        <input type="text" name="reportfordate" class="form-control datepicker1" placeholder="select a date" required="">
      </td>
    </tr>
    <tr>
      <td>SELECT CLIENT</td>
      <td>
        
        <select class="form-control" name="clientid" id="clientid" disabled>
          <option value="">Select a Client</option>
          @foreach($clients as $client)
        <option value="{{$client->id}}">{{$client->orgname}}</option>


          @endforeach
          
        </select>
      </td>
    </tr>

    <tr>
      <td>SELECT PROJECT NAME</td>
      <td>
        
        <select class="form-control" name="projectid" id="projectid" disabled>
          <option value="">Select a project</option>
           @foreach($projects as $project)
             <option value="{{$project->id}}">{{$project->projectname}}</option>

           @endforeach
         
          
        </select>
      </td>
    </tr>

        <tr>
      <td>SELECT ACTIVITY NAME</td>
      <td>
        
        <select class="form-control" name="activityid" id="activityid" disabled>
          <option value="">Select a Activity</option>
            @foreach($projectactivity as $pa)

             <option value="{{$pa->actid}}">{{$pa->activityname}}</option>
            @endforeach
          
        </select>
      </td>
    </tr>

      <tr>
      <td>REPORT SUBJECT</td>
      <td>
       <input type="text" class="form-control" name="subject" placeholder="Enter Report Subject" required>
      </td>
      </tr>
      <tr>
        <td>DESCRIPTION</td>
        <td>
                <div class="box">
            <div class="box-body pad">
             
                <textarea class="textarea" type="text" name="description" required placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
             
            </div>
          </div>
          </td>
      </tr>
      <tr>
         <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">SUBMIT</button></td>
      </tr>
     

  </thead>

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
   function writeprojectreport(pid,actid,cid)
   {
        
         $('#clientid option[value="'+cid+'"]').attr("selected", "selected");
         $('#projectid option[value="'+pid+'"]').attr("selected", "selected");
         $('#activityid option[value="'+actid+'"]').attr("selected", "selected");
         $("#myModal").modal('show');
   }

</script>

@endsection