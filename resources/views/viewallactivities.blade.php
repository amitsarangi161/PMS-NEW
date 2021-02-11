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

<h3 class="text-center"><strong>VIEW ALL ACTIVITIES</strong></h3>
<div class="box">
<div class="box-body">
    <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
    <thead>
        <tr class="bg-navy" style="font-size: 10px;">
            <th>ID</th>
            <th>FOR EMPLOYEE</th>
            <th>EDIT</th>
            <!-- <th>DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($employeeactivities as $employeeactivitie)
        <tr>
            <td>{{$employeeactivitie->id}}</td>
            <td>{{$employeeactivitie->name}}</td>
            <td><a href="/editemployeeactivities/{{$employeeactivitie->id}}" class="btn btn-primary">EDIT</a></td>

        </tr>

        @endforeach
    </tbody>
</table>
</div>
</div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE STATUS</h4>
      </div>
      <div class="modal-body">
        <form action="/changestatus" method="post">
          {{csrf_field()}}
       <table class="table table-responsive table-hover table-bordered table-striped">
        <input type="hidden" name="pid" id="pid">
        <tr>
          <td>PROJECT NAME</td>
          <td><input type="text" readonly="" id='pname' class="form-control"></td>
        </tr>
        <tr>
          <td>STATUS</td>
          <td>
            <select name="status" class="form-control">
              <option value="STARTED">STARTED</option>
              <option value="ON PROGRESS">ON PROGRESS</option>
              <option value="HALTED">HALTED</option>
              <option value="COMPLETED">COMPLETED</option>
              
            </select>
          </td>
        </tr>
        <tr>
          <td><button type="submit" class="btn btn-primary">CHANGE</button></td>
        </tr>
        
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
	function changestatus(id,pname)
	{
		$("#pname").val(pname);
		$("#pid").val(id);
        $("#myModal").modal('show');
	}
</script>
@endsection