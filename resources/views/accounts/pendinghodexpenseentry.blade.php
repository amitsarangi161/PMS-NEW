@extends('layouts.account')
@section('content')

<style type="text/css">

       .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   

}
</style>
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
  <thead>
    <tr class="bg-navy" style="font-size: 10px;">
      <th>Sl. No.</th>
      <th>EMPLOYEE</th>
      <th>VIEW</th>


    </tr>
  </thead>
  <tbody>
    @foreach($expenseentries as $key=>$expenseentry)
    <tr style="font-size: 12px;">
        <td><a href="/pendingexpenseentrydetailview/{{$expenseentry->employeeid}}" target="_blank" class="btn btn-info">{{++$key}}</a></td>
        <td>{{$expenseentry->for}}</td>
        <td><a href="/pendingexpenseentrydetailview/{{$expenseentry->employeeid}}" target="_blank" class="btn btn-info">VIEW</a></td>

    </tr>
    @endforeach
  </tbody>
  
</table>
</div>
@endsection