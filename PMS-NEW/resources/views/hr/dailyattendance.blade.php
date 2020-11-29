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


<form action="/saveattendancereportgrp" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>SELECT A GROUP NAME *</label>
          <select class="form-control select2" id="groupid"  name="groupid" required="" style="width: 100%;">
            <option value="">SELECT A GROUP</option>
               @foreach($groups as $key => $group)
               <option value="{{$group->id}}">{{$group->groupname}}</option>
               @endforeach
          </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>ENTRY TIME*</label>
          <input type="time" class="form-control" name="entrytime" id="entrytime">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>WORK ASSIGNMENT*</label>
          <textarea class="form-control" name="workassignment"></textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>DEPARTURE TIME</label>
          <input type="time" class="form-control" name="departuretime">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>NUMBER OF WORKERS*</label>
          <input type="text" class="form-control" name="noofworkerspresent">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>WAGES*</label>
          <input type="text" class="form-control" name="wages">
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>OT*</label>
          <input type="text" class="form-control" name="ot ">
      </div>
    </div>
   <div class="col-md-6">
      <div class="form-group">
        <label>REMARKS*</label>
          <textarea class="form-control" name="remarks"></textarea>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Group Photo*</label>
          <input name="photo" onchange="readURL1(this)" type="file">
          <img id="imgshow1" src="#" alt="No Image Selected" style="height: 60px;width: 50px;">
      </div>
    </div>
  </div>

</div>
<table class="table table-responsive">
	<tr>
		<td ><button type="submit" class="btn btn-success pull-right" onclick="return confirm('Do You Want to Proceed?')">Submit</button></td>
	</tr>
</table>

</form>
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
</script>
@endsection