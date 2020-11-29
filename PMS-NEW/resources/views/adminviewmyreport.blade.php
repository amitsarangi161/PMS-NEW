@extends('layouts.app')
@section('content')
    <h3 class="text-center"><strong>MY REPORTS</strong></h3>
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
            <th>REPORT OF</th>
            <th>AUTHOR</th>
            <th>VERIFIED BY</th>
             <th>STATUS</th>
            <th>EDIT</th>
            <th>DELETE</th>

           
        </tr>
    </thead>
    <tbody>
         @foreach($projectreports as $projectreport)
         <tr>
           <td>{{$projectreport->reportfordate}}</td>
           <td>{{$projectreport->orgname}}</td>
           <td>{{$projectreport->projectname}}</td>
           <td>{{$projectreport->activityname}}</td>
           <td>{{$projectreport->subject}}</td>
           <td>{!! $projectreport->description !!}</td>
           <td>{{$projectreport->name}}</td>
           <td>{{$projectreport->author}}</td>
           <td>{{$projectreport->acceptedby}}</td>
              @if($projectreport->status=="VERIFIED")
           <td><span class="label label-success">{{$projectreport->status}}</span></td>
            @else
            <td><span class="label label-danger">{{$projectreport->status}}</span></td>
            @endif
            
            <td><a href="/editadminprojectreport/{{$projectreport->id}}" class="btn btn-primary">EDIT</a></td>
            
           
           <td>
             <form action="/deleteadminreport/{{$projectreport->id}}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to Delete this Report?');">DELETE</button>
             </form>
           </td>
          
         </tr>

        @endforeach
    </tbody>
</table>
</div>
</div>
</div>


<script type="text/javascript">
  function changestatus(id,pname)
  {
    $("#pname").val(pname);
    $("#pid").val(id);
        $("#myModal").modal('show');
  }
</script>
@endsection
