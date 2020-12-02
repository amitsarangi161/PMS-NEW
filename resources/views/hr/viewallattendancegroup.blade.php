@extends('layouts.hr')

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
            <td>REMARKS</td>
            <td>ITEM DESCRIPTION</td>
            <td>UNIT</td>
            <td>QUANTITY</td>
            <td>AMOUNT</td>
            <td>CREATED AT</td>
            <!-- <td>GROUP PHOTO</td> -->
            <td>EDIT</td>
          </tr>
        </thead>
        <tbody>
          @foreach($allattendancegroups as $key=>$allattendancegroup)
          <tr>
            <td><a href="/attendance/viewattendancegroup/{{$allattendancegroup->id}}"><button class="btn btn-info btn-sm btn-flat">{{$allattendancegroup->id}}</button></a></td>
            <td>{{$allattendancegroup->groupname}}</td>
            <td>{{$allattendancegroup->entrytime}}</td>
            <td>{{$allattendancegroup->departuretime}}</td>
            <td>{{$allattendancegroup->workassignment}}</td>
            <td>{{$allattendancegroup->noofworkerspresent}}</td>
            <td>{{$allattendancegroup->wages}}</td>
            <td>{{$allattendancegroup->ot}}</td>
            <td>{{$allattendancegroup->remarks}}</td>
            <td>{{$allattendancegroup->itemdescription}}</td>
            <td>{{$allattendancegroup->unit}}</td>
            <td>{{$allattendancegroup->quantity}}</td>
            <td>{{$allattendancegroup->amount}}</td>
            <td>{{$provider::changedatetimeformat($allattendancegroup->created_at)}}</td>
            <td><a href="/attendance/editdailyattendancegroup/{{$allattendancegroup->id}}" onclick="return confirm('are you sure to edit dailyattendance ??')" ><button class="btn btn-primary btn-flat">Edit</button></a></td>
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

@endsection