@extends('layouts.hr')

@section('content')
<div class="row">
  <div class="col-md-6">
          <!-- Horizontal Form -->
          <form action="/updateemployeedetails/{{$editdailyattendancegroup->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
          {{csrf_field()}}
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Daily Attedance Group Report</h3>
            </div>
              <div class="box-body">
                <div class="form-horizontal">
                <div class="form-group">
                  <label  class=" col-sm-3">GROUP NAME</label>
                  <div class="col-sm-9">
			          <select class="form-control select2" disabled="" id="groupid"  name="groupid" required="" style="width: 100%;">
			            <option value="">SELECT A GROUP</option>
			               @foreach($groups as $key => $group)
			               <option value="{{$group->id}}" {{ ( $editdailyattendancegroup->groupid == $group->id) ? 'selected' : '' }}>{{$group->groupname}}</option>
			               @endforeach
			          </select>
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">ENTRY TIME</label>
                  <div class="col-sm-9">
                    <input type="text" name="empcodeno"class="form-control datetimepicker1" id="inputEmail3" placeholder="Entry Time" value="{{$editdailyattendancegroup->entrytime}}">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">DEPARTURE TIME</label>
                  <div class="col-sm-9">
                    <input type="text" name="qualification"class="form-control datetimepicker1" id="inputEmail3" value="{{$editdailyattendancegroup->departuretime}}" placeholder="Departure Time">
                  </div>
                </div>
                 <div class="form-group">
                  <label  class=" col-sm-3">WORK ASSIGNMENT*</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="presentaddress" name="presentaddress" autocomplete="off" type="text" placeholder="Work Assignment" rows="5">{{$editdailyattendancegroup->workassignment}}</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">NUMBER OF WORKERS</label>

                  <div class="col-sm-9">
                    <input type="text" name="dob" class="form-control datepicker" value="{{$editdailyattendancegroup->noofworkerspresent}}" placeholder="Number Of Workers">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">TOTAL WAGES</label>
                  <div class="col-sm-9">
                    <input type="email" name="email"class="form-control" id="inputEmail3" value="{{$editdailyattendancegroup->twages}}" placeholder="Wages">
                  </div>
                </div>

                <div class="form-group">
                  <label  class=" col-sm-3">TOTAL OT</label>

                  <div class="col-sm-9">
                    <input type="text" name="phone"class="form-control" id="inputEmail3" value="{{$editdailyattendancegroup->tot}}" placeholder="Ot">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">TOTAL AMOUNT</label>

                  <div class="col-sm-9">
                    <input type="text" name="tamt"class="form-control" id="inputEmail3" value="{{$editdailyattendancegroup->tamt}}" placeholder="tamt">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">REMARKS</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="presentaddress" name="presentaddress" autocomplete="off" type="text" placeholder="Remarks" rows="5">{{$editdailyattendancegroup->remarks}}</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">ITEM DESCRIPTION</label>

                  <div class="col-sm-9">
                    <input type="text" name="alternativephonenumber"class="form-control" id="inputEmail3" value="{{$editdailyattendancegroup->itemdescription}}" placeholder="Item Description">
                  </div>
                </div>

                <div class="form-group">
                  <label  class=" col-sm-3">UNIT(Kg/No.)</label>

                  <div class="col-sm-9">
                    <input type="text" name="adharno"class="form-control" id="inputEmail3" value="{{$editdailyattendancegroup->unit}}" placeholder="Unit">
                  </div>
                </div>

                <div class="form-group">
                  <label  class=" col-sm-3">QUANTITY</label>

                  <div class="col-sm-9">
                    <input type="text" name="bloodgroup"class="form-control" id="inputEmail3" value="{{$editdailyattendancegroup->quantity}}" placeholder="QUANTITY">
                  </div>
                </div> 
                <div class="form-group">
                  <label  class=" col-sm-3">AMOUNT</label>

                  <div class="col-sm-9">
                    <input type="text" name="bloodgroup"class="form-control" id="inputEmail3" value="{{$editdailyattendancegroup->amount}}" placeholder="Amount">
                  </div>
                </div>

                </div>
              </div>
          </div>
      </div>
<div class="col-md-6">
  
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">PHOTOS</h3>
            </div>
              <div class="form-horizontal">
              <div class="box-body">
                <table class="table table-bordered">
                  <thead>
                    <tr class="bg-navy">
                      <th>Sl.No</th>
                      <th>Photo</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($dailyattendanceimages as $key=>$dailyattendanceimage)
                    <tr>
                      <td>{{++$key}}</td>
                    <td><a href="{{asset('/image/dailyattendancegroup/'.$dailyattendanceimage->photo)}}" target="_blank">
              <img style="height: 70px;width: 70px;" src="{{asset('/image/dailyattendancegroup/'.$dailyattendanceimage->photo)}}" alt="click to view" id="imgshow">
            </a>
              <a href="{{asset('/image/dailyattendancegroup/'.$dailyattendanceimage->photo)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a>
               <a href="{{asset('/image/dailyattendancegroup/'.$dailyattendanceimage->photo)}}" target="_blank">
               <span class="btn btn-info">VIEW</span></a></td>
            
          </form></td>
                    </tr>
                   @endforeach
                    
                  </tbody>
                </table>
                
              </div>
            </div>
</div>
</div>

      <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Individual Labour Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr class="bg-navy">
            <td>Id</td>
            <td>EMPLOYEE NAME</td>
            <td>No. Of Day</td>
            <td>WAGES</td>
            <td>OT</td>
            <td>TOTAL AMT.</td>
          </tr>
        </thead>
        <tbody>
          @foreach($dailyattendancegroupdetails as $key=>$dailyattendancegroupdetail)
          <tr>
            <td>{{$dailyattendancegroupdetail->id}}</td>
            <td>{{$dailyattendancegroupdetail->employeename}}</td>
            <td>{{$dailyattendancegroupdetail->totnoofday}}</td>
            <td>{{$dailyattendancegroupdetail->wages}}</td>
            <td>{{$dailyattendancegroupdetail->othours}}</td>
            <td>{{$dailyattendancegroupdetail->totamt}}</td>
          </tr>
          @endforeach
        </tbody>
      
      </table>
  </div>
          </div>
            </div>

@endsection