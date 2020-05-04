@extends('layouts.app')
@section('content')

<h3 class="text-center"><strong>ALL ASSIGNED USER PROJECTS</strong></h3>
<div class="box">
<div class="box-body">
    <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped">
    <thead>
        <tr class="bg-navy">
            <th>ID</th>
            <th>FOR CLIENT</th>
            <th>DISTRICT</th>
            <th>DIVISION</th>
            <th>PROJECT NAME</th>
            <th>DATE OF COMMENCEMENT</th>
            <th>END DATE</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
         
        <tr>
            <td>{{$project->id}}</td>
            <td>{{$project->clientname}}</td>
            <td>{{$project->districtname}}</td>
            <td>{{$project->divisionname}}</td>
            <td>{{$project->projectname}}</p></td>
            <td>{{$project->startdate}}</td>
            <td>{{$project->enddate}}</td>
            
        </tr>
        {{$projects->links()}}

        @endforeach
    </tbody>
</table>
</div>
</div>
</div>

@endsection
