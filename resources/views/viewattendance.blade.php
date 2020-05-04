@extends('layouts.app')

@section('content')
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>


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

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
  <thead>
  <tr class="bg-navy">
    <th><strong>USER ID</strong></th>
    <th><strong>NAME</strong></th>
    <th><strong>STATUS</strong></th>
    <th><strong>VIEW</strong></th>
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



@endsection