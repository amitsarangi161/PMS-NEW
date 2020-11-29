@extends('layouts.hr')

@section('content')
<table  class="table">
  <tr class="bg-blue">
    <td class="text-center">VIEW ATTENDANCE</td>
  </tr>
</table>
<table class="table">
  <form action="/attendance/viewattendance" method="get">
  <tr>
    <td><strong>Select a Date</strong></td>
    <td><input type="text" name="date" id="date" class="form-control datepicker" value="{{Request::get('date')}}" autocomplete="off"></td>
    <td><button type="submit" class="btn btn-primary" onclick="showdetails()">SHOW</button></td>
  </tr>
  </form>
  
</table>
<div class="box-body table-responsive">
<table class="table table-bordered table-striped datatable1">
  <thead>
  <tr class="bg-navy">
    <td>USER ID</td>
    <td>NAME</td>
    <td>STATUS</td>
    <td>VIEW</td>
  </tr>
  </thead>
  <tbody>
     @foreach($all as $a)
       <tr>
          <td>{{$a['uid']}}</td>
          <td>{{$a['uname']}}</td>
          @if($a['present']=='PRESENT')
          <td><label class="label label-success">{{$a['present']}}</label></td>
          @else
          <td><label class="label label-danger">{{$a['present']}}</label></td>
          @endif
          <td><a href="/showuserlocation/{{$a['uid']}}/{{$dt}}" class="btn btn-success">VIEW</a></td>
       </tr>
     @endforeach
  </tbody>
</table>
</div>


@endsection