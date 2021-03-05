
@extends('layouts.app')
@section('content')
    <h3 class="text-center"><strong>MY REPORTS</strong></h3>
<div class="box">
<div class="box-body">
    <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
    <thead>
        <tr class="bg-navy">
            <th>SL NO.</th>
            <th>REPORT DATE</th>
            <th>ASSIGN ACTIVITIES</th>
            <th>ACTIVITIES DONE</th>
            <th>REPORT OF</th>
            <th>AUTHOR</th>
        </tr>
    </thead>
    <tbody>
         @foreach($customarray as $cust)
         <tr>
           
           <td>{{$cust['projectreport']->id}}</td>
           <td>{{$cust['projectreport']->reportfordate}}</td>
           <td>{{$cust['assignactivitie']}}</td>
           <td>{{$cust['userdoneactivitie']}}</td>
           <td>{{$cust['projectreport']->name}}</td>
           <td>{{$cust['projectreport']->author}}</td>
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
