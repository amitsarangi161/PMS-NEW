@extends('layouts.hr')

@section('content')
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">Daily Attendance Report</td>
	</tr>

</table>


<form action="/updateattendancereportgrp/{{$editdailyattendancegroup->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>SELECT A GROUP NAME *</label>
          <select class="form-control select2" id="groupid"  name="groupid" required="" style="width: 100%;">
            <option value="">SELECT A GROUP</option>
               @foreach($groups as $key => $group)
               <option value="{{$group->id}}" {{ ( $editdailyattendancegroup->groupid == $group->id) ? 'selected' : '' }}>{{$group->groupname}}</option>
               @endforeach
          </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>ENTRY TIME*</label>
          <input type="time" class="form-control" value="{{$editdailyattendancegroup->entrytime}}" name="entrytime" >
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>WORK ASSIGNMENT*</label>
          <textarea class="form-control" name="workassignment">{{$editdailyattendancegroup->workassignment}}</textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>DEPARTURE TIME</label>
          <input type="time" value="{{$editdailyattendancegroup->departuretime}}" class="form-control" name="departuretime">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>NUMBER OF WORKERS*</label>
          <input type="text" class="form-control" value="{{$editdailyattendancegroup->noofworkerspresent}}" name="noofworkerspresent">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>WAGES*</label>
          <input type="text" class="form-control" value="{{$editdailyattendancegroup->wages}}" name="wages">
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>OT*</label>
          <input type="text" class="form-control" value="{{$editdailyattendancegroup->ot}}" name="ot">
      </div>
    </div>
   <div class="col-md-6">
      <div class="form-group">
        <label>REMARKS*</label>
          <textarea class="form-control" name="remarks">{{$editdailyattendancegroup->remarks}}</textarea>
      </div>
    </div>
  </div>

    <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>ITEM DESCRIPTION*</label>
          <input type="text" class="form-control" value="{{$editdailyattendancegroup->itemdescription}}" name="itemdescription">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>UNIT(Kg/No.)*</label>
          <input type="text" class="form-control" value="{{$editdailyattendancegroup->unit}}" name="unit">
      </div>
    </div>
  </div>

    <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>QUANTITY*</label>
          <input type="text" class="form-control" value="{{$editdailyattendancegroup->quantity}}" name="quantity">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>AMOUNT*</label>
          <input type="text" class="form-control"value="{{$editdailyattendancegroup->amount}}" name="amount">
      </div>
    </div>
  </div>
</div>
<table class="table table-responsive">
	<tr>
		<td ><button type="submit" class="btn btn-success pull-right" onclick="return confirm('Do You Want to Update?')">UPDATE</button></td>
	</tr>
</table>

</form>

<h4>View All Daily Attendance Images</h4>
  <table class="table table-striped table-condensed table-bordered">

    <thead>
      <tr class="bg-navy">
        <th>SL_NO</th>
        <th>IMAGE</th>
        <th>EDIT</th>
      </tr>
    </thead>
    <tbody>
      @foreach($dailyattendanceimages as $key=>$dailyattendanceimage)
      <tr style="background-color: #d8c993;">
          <td>{{$key+1}}</td>
          <td><img style="height:70px;width:95px;" src="{{ asset('/image/dailyattendancegroup/'.$dailyattendanceimage->photo )}}"></td>
          <td><button type="button" class="btn btn-primary" onclick="openmodal('{{$dailyattendanceimage->id}}','{{$dailyattendanceimage->photo}}');">Edit</button></td>
      </tr>
      @endforeach
    </tbody>
  </table>


  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>EDIT PHOTO</b></h4>
      </div>
      <div class="modal-body">

    <form action="/updateattendancephoto" method="post" enctype="multipart/form-data"> 
		{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
<input type="hidden" id="uid" name="uid">
	  	<tr>
	  		<td><strong>Attendance Photo</strong></td>
	  		<td>
	  			 	<input name="photo" type="file"  onchange="readURL(this);">
                     <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow">
	  		</td>
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
function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
   function openmodal(id,photo)
  {
       $("#uid").val(id);
       $("#imgshow").attr('src', '/image/dailyattendancegroup/'+photo)
                    .width(95)
                    .height(70);
       $("#myModal").modal("show");

  }
</script>

@endsection