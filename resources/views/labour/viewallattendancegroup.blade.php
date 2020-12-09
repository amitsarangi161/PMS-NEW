@extends('layouts.labour')

@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')

<style type="text/css">
  .status{
    cursor: pointer;
  }
</style>
<div class="box">
@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif
@if(Session::has('error'))
<p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif

<div class="row">
 <div class="col-md-12">
  <div class="box">
    <div class="box-header bg-gray">
  <form method="get" action="/attendance/viewallattendance">
    <div class="form-group">
      <label  class="col-sm-2 control-label">Select A Group</label>
      <div class="col-sm-4">
        <select class="form-control" required="" name="group">
            <option value="">Select A Group</option>
            @foreach($addgroups as $addgroup)
            <option value="{{$addgroup->id}}" {{ Request::get('group')==$addgroup->id ? 'selected' : '' }}>{{$addgroup->groupname}}</option>
            @endforeach
        </select>
      </div>
      <div class="col-sm-1">
        <button type="submit" class="btn  btn-primary">Filter</button>
      </div>
      @if(Request::has('group'))
      <div class="col-sm-1">
        <a href="/attendance/viewallattendance"  class="btn  btn-danger">Clear Filter</a>
      </div>
      @endif
    </div>
  </form>
  </div>
</div>
</div>
</div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped datatablescrollexport">
        <thead>
          <tr class="bg-navy">
            <td>Id</td>
            <td>GROUP NAME</td>
            <td>ENTRY TIME</td>
            <td>DEPARTURE TIME</td>
            <td>WORK ASSIGNMENT</td>
            <td>NUMBER OF WORKERS</td>
            <td>WAGES</td>
            <td>OT</td>
            <td>TOTAL AMOUNT</td>
            <td>REMARKS</td>
            <td>ITEM DESCRIPTION</td>
            <td>UNIT</td>
            <td>QUANTITY</td>
            <td>AMOUNT</td>
            <td>CREATED AT</td>
            <!-- <td>GROUP PHOTO</td> -->
            <td>EDIT</td>
            <td>VIEW</td>
          </tr>
        </thead>
        <tbody>
          @foreach($allattendancegroups as $key=>$allattendancegroup)
          <tr>
            <td><a href="/attendance/labourviewattendancegroup/{{$allattendancegroup->id}}"><button class="btn btn-info btn-sm btn-flat">{{$allattendancegroup->id}}</button></a></td>
            <td>{{$allattendancegroup->groupname}}</td>
            <td>{{$allattendancegroup->entrytime}}</td>
            <td>{{$allattendancegroup->departuretime}}</td>
            <td>{{$allattendancegroup->workassignment}}</td>
            <td>{{$allattendancegroup->noofworkerspresent}}</td>
            <td>{{$allattendancegroup->twages}}</td>
            <td>{{$allattendancegroup->tot}}</td>
            <td>{{$allattendancegroup->tamt}}</td>
            <td>{{$allattendancegroup->remarks}}</td>
            <td>{{$allattendancegroup->itemdescription}}</td>
            <td>{{$allattendancegroup->unit}}</td>
            <td>{{$allattendancegroup->quantity}}</td>
            <td>{{$allattendancegroup->amount}}</td>
            <td>{{$provider::changedatetimeformat($allattendancegroup->created_at)}}</td>
            <!-- <td><a href="/attendance/editdailyattendancegroup/{{$allattendancegroup->id}}" onclick="return confirm('are you sure to edit dailyattendance ??')" ><button class="btn btn-primary btn-flat">Edit</button></a></td> -->
            <td><button class="btn btn-primary btn-flat" onclick="edit('{{$allattendancegroup->id}}','{{$allattendancegroup->itemdescription}}','{{$allattendancegroup->unit}}','{{$allattendancegroup->quantity}}','{{$allattendancegroup->amount}}','{{$allattendancegroup->workassignment}}','{{$allattendancegroup->remarks}}');">Edit</button></td>
            <td><a href="/attendance/labourviewattendancegroup/{{$allattendancegroup->id}}"><button class="btn btn-info btn-flat">View</button></a></td>
          </tr>
          @endforeach
        </tbody>
      
      </table>
  </div>

</div>

<div class="modal fade in" id="importemployee">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="/importemployee">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Employee Excel</h4>
      </div>
      <div class="modal-body">
        
        
          {{ csrf_field() }}
          <div class="form-group">
        <label>Select File for Upload Employee</label>
              <input type="file" name="select_file" />
          <span class="text-muted">.xls, .xslx</span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-flat">Upload</button>
      </div>
        </form>
    </div>
  </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>EDIT ATTENDANCE</b></h4>
      </div>
      <div class="modal-body">

    <form action="/updateattendance" method="post" enctype="multipart/form-data"> 
    {{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
<input type="hidden" id="uid" name="uid">

    <tr>
      <td><strong>ITEM DESCRIPTION</strong></td>
      <td><textarea class="form-control" id="itemdescription" name="itemdescription"></textarea></td>
    </tr>
    <tr>
      <td><strong>UNIT(KG/NO.)</strong></td>
      <td><input type="text" name="unit" id="unit" class="form-control" placeholder="Enter Unit"></td>
    </tr>
    <tr>
      <td><strong>QUANTITY</strong></td>
      <td><input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter QUANTITY"></td>
    </tr>
    <tr>
      <td><strong>AMOUNT</strong></td>
      <td><input type="text" name="amount" id="amount" class="form-control" placeholder="Enter AMOUNT"></td>
    </tr>
    <tr>
      <td><strong>WORK ASSIGNMENT</strong></td>
      <td><textarea class="form-control" id="workassignment" name="workassignment"></textarea></td>
    </tr>
    <tr>
      <td><strong>REMARKS</strong></td>
      <td><textarea class="form-control" id="remarks" name="remarks"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">UPDATE</button></td>
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
<script>
  function edit(id,itemdescription,unit,quantity,amount,workassignment,remarks){
        $("#uid").val(id);
        $("#itemdescription").val(itemdescription);
        $("#unit").val(unit);
        $("#quantity").val(quantity);
        $("#amount").val(amount);
        $("#workassignment").val(workassignment);
        $("#remarks").val(remarks);
        $("#myModal").modal('show');
  }
</script>

@endsection