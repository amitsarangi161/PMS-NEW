@extends('layouts.app')
@section('content')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
    <h3 class="text-center"><strong>NOT VERIFIED REPORTS</strong></h3>
<div class="box">
<div class="box-body">
    <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
    <thead>
        <tr class="bg-navy">
            <th>REPORT DATE</th>
            <th>CLIENT</th>
            <th>PROJECT NAME</th>
            <th>ACTIVITY NAME</th>
            <th>SUBJECT</th>
            <th>DESCRIPTION</th>
            <th>WRITTENT BY</th>
            <th>AUTHOR</th>
            <th>VERIFIED BY</th>
            <th>STATUS</th>
            <th>VIEW</th>
            

           
        </tr>
    </thead>
    <tbody>
         @foreach($projectreports as $projectreport)
         <tr>
           <td>{{$projectreport->reportfordate}}</td>
           <td>{{$projectreport->orgname}}</td>
           <td><p class="b" title="{{$projectreport->projectname}}">{{$projectreport->projectname}}</p></td>
           <td>{{$projectreport->activityname}}</td>
           <td>{{$projectreport->subject}}</td>
           <td><div class="b pop" data-toggle="popover" data-html="true" data-content="{!! $projectreport->description !!}">{!! $projectreport->description !!}</div></td>
           <td>{{$projectreport->name}}</td>
           <td>{{$projectreport->author}}</td>
           <td>{{$projectreport->acceptedby}}</td>
              @if($projectreport->status=="VERIFIED")
           <td><span class="label label-success">{{$projectreport->status}}</span></td>
            @else
            <td><span class="label label-danger">{{$projectreport->status}}</span></td>
            @endif
            <td><a href="/viewnotverifiedreport/{{$projectreport->id}}" class="btn btn-primary">VIEW</a></td>
         </tr>

        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        placement : 'right',
        trigger : 'hover'
    });
});
</script>

@endsection
