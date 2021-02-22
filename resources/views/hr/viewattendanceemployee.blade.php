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
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">View all Attendances</td>
	</tr>
</table>

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	
	<thead>
		<tr>
			<th>ID</th>
			<th>GROUP NAME</th>
			<th>WORKINGDAY/HOLIDAY</th>
			<th>DATE</th>
      <th>TOTAL PRESENT</th>
      <th>TOTAL ABSENT</th>
      <th>TOTAL HOLIDAY</th>
      <th>ADDED BY</th>
			<th>VIEW</th>
		</tr>
	</thead>
	<tbody>
		@foreach($attendances as $atendance)
              <tr>
              	<td><a href="/viewatendances/{{$atendance->id}}" class="btn btn-info" target="_blank">{{$atendance->id}}</a></td>
              	<td>{{$atendance->groupname}}</td>
                <td>{{$atendance->type}}</td>
                <td>{{$atendance->date}}</td>
                  @php
                     $p=\App\Empdailyattendancegroupdetail::where('attendancedate',$atendance->date)
                     ->where('dailyattendanceid',$atendance->id)
                     ->where('present','Y')
                     ->count();
                     $a=\App\Empdailyattendancegroupdetail::where('attendancedate',$atendance->date)
                     ->where('dailyattendanceid',$atendance->id)
                     ->where('present','N')
                     ->count();
                     $h=\App\Empdailyattendancegroupdetail::where('attendancedate',$atendance->date)
                     ->where('dailyattendanceid',$atendance->id)
                     ->where('present','H')
                     ->count();
                  @endphp
                  <td>{{$p}}</td>
                 <td>{{$a}}</td>
                 <td>{{$h}}</td>
                <td>{{$atendance->name}}</td>
                 <td>
                   <a href="/viewatendances/{{$atendance->date}}/{{$atendance->id}}" class="btn btn-info">VIEW</a>
                 </td>
              </tr>
		@endforeach
	</tbody>
</table>


@endsection