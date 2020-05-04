@extends('layouts.app')
@section('content')
    <h3 class="text-center"><strong>ALL PROJECTS</strong></h3>
<div class="box">
<div class="box-body">
    <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
    <thead>
        <tr class="bg-navy">
         
            <th>FOR CLIENT</th>
            <th>CLIENT NAME</th>
            <th>PROJECT NAME</th>
            <th>PROJECT ID</th>
            <th>DATE OF COMMENCEMENT</th>
            <th>END DATE</th>
            <th>PRIORITY</th>
            <th>STATUS</th>
            <th>DAY REMAIN</th>
            <th>VIEW</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
           @php
               $date = Carbon\Carbon::parse($project->enddate. '00:00:00');
               $now = Carbon\Carbon::now();

               $diff = $date->diffInDays($now);
               if($project->status=='COMPLETED')
               {
               	   $txtcolor='label bg-green';
                $rowcolor='#0cd50c';
               }
               elseif($diff<=5 && $project->status!='COMPLETED')
               {
                $txtcolor='label bg-red';
                $rowcolor='#f9191999';
               }
               else
               {
               	  $txtcolor='label bg-blue';
               	  $rowcolor='#fff';
               }

            @endphp
        <tr style="background-color: {{$rowcolor}}">
         
            <td>{{$project->orgname}}</td>
            <td>{{$project->clientname}}</td>
            <td>{{$project->projectname}}</td>
            <td>{{$project->projectid}}</td>
            <td>{{$project->startdate}}</td>
            <td>{{$project->enddate}}</td>
            <td>{{$project->priority}}</td>
            @if($project->status!='COMPLETED')
            <td><span class="label label-success" ondblclick="changestatus('{{$project->id}}','{{$project->projectname}}');" title="Double click to change the status">{{$project->status}}</span></td>
            @else
            <td><span class="label label-danger" ondblclick="changestatus('{{$project->id}}','{{$project->projectname}}');" title="Double click to change the status">{{$project->status}}</span></td>

            @endif

             @if($project->status!='COMPLETED')
            <td class="text-center"><small class="{{$txtcolor}}">{{$diff}}</small></td>
            @else
             <td class="text-center"><small class="{{$txtcolor}}">{{$diff}}</small></td>
            @endif
           <td>
             <a href="/hod/adminprojectdetails/{{$project->id}}" class="btn btn-primary">VIEW DETAILS</a>
           </td>

        </tr>

        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endsection