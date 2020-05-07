@extends('layouts.hr')
@section('content')
<style type="text/css">
  .box{border-radius: 0px!important;}
}
</style>
  @if(Session::has('message'))
  <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {!! session('message') !!}
  </div>
  @endif
  @if(Session::has('error'))
<p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif
@if(count($errors) > 0)
    <div class="alert alert-danger">
     Fillup all fields<br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
@endif
  <div class="box box-info box-solid">
     <div class="box-header bg-navy with-border text-center">
              <h3 class="box-title">Employee Registration</h3>
      </div>
  <div class="row">
	<div class="col-md-6">
          <!-- Horizontal Form -->
          <form action="/saveemployeedetails" method="post" enctype="multipart/form-data" class="form-horizontal">
          {{csrf_field()}}
          <div class="box box-info  box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-horizontal">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Emp. Name</label>
                  <div class="col-sm-9">
                    <input type="text" name="employeename"class="form-control" id="inputEmail3" placeholder="Employee Name" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Employee Code</label>

                  <div class="col-sm-9">
                    <input type="text" name="empcodeno"class="form-control" placeholder="Enter Employee Code" required="">
                  </div>
               </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Qualification</label>
                  <div class="col-sm-9">
                    <input type="text" name="qualification"class="form-control" id="inputEmail3" placeholder="Qualification Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Experence In Company</label>
                  <div class="col-sm-9">
                    <input type="text" name="experencecomp"class="form-control" id="inputEmail3" placeholder="Experence In Which Company">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">DOB</label>

                  <div class="col-sm-9">
                    <input type="text" name="dob" class="form-control datepicker" placeholder="Date of Birth">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Email</label>
                  <div class="col-sm-9">
                    <input type="email" name="email"class="form-control" id="inputEmail3" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Gender</label>

                  <div class="col-sm-9">
                    <label class="radio-inline">
                      <input type="radio" name="gender" value="male" checked>Male
                    </label>
                    <label class="radio-inline">
                       <input type="radio" value="female" name="gender">Female
                    </label>
                    <label class="radio-inline">
                       <input type="radio" value="other" name="gender">Other
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Personal Mobile No.</label>

                  <div class="col-sm-9">
                    <input type="text" name="phone"class="form-control" id="inputEmail3" placeholder="Phone Number">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Alternative No.</label>

                  <div class="col-sm-9">
                    <input type="text" name="alternativephonenumber"class="form-control" id="inputEmail3" placeholder="Alternative Phone Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Adhar No.</label>

                  <div class="col-sm-9">
                    <input type="text" name="adharno"class="form-control" id="inputEmail3" placeholder="Adhar Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Blood Group</label>

                  <div class="col-sm-9">
                    <input type="text" name="bloodgroup"class="form-control" id="inputEmail3" placeholder="Blood Group">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">
                  Father's Name</label>

                  <div class="col-sm-9">
                    <input type="text" name="fathername"class="form-control" id="inputEmail3" placeholder="Father's Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">
                  Marital Status</label>

                  <div class="col-sm-9">
                    <input type="text" name="maritalstatus"class="form-control" id="inputEmail3" placeholder="Marital Status">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Present Address</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="presentaddress" name="presentaddress" autocomplete="off" type="text" placeholder="Present Address" rows="5"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Permanent Address</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="permanentaddress" name="permanentaddress" autocomplete="off" type="text" placeholder="Permanent Address" rows="6"></textarea>
                  </div>
                </div>
                </div>
              </div>
          </div>
      </div>

      	<div class="col-md-6" class="form-horizontal">
          <!-- Horizontal Form -->
          <div class="box box-info  box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Company Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-horizontal">
                <div class="form-group">
                  <label class=" col-sm-3">Department</label>

                  <div class="col-sm-9">
                    <input type="text" name="department"class="form-control" placeholder="Enter Department Name">
                  </div>
                  </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Designation</label>

                  <div class="col-sm-9">
                    <input type="text" name="designation"class="form-control" placeholder="Enter Designation Name">
                  </div>
                </div>
               <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Date of joining</label>

                  <div class="col-sm-9">
                    <input type="text" name="dateofjoining"class="form-control datepicker" placeholder="Date of Joining">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Date of Confirmation</label>

                  <div class="col-sm-9">
                    <input type="text" name="dateofconfirmation"class="form-control datepicker" placeholder="Date of Confirmation">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Joining Salary</label>

                  <div class="col-sm-9">
                    <input type="text" name="joinsalary"class="form-control" placeholder="Joining Salary">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Total Year Experience</label>

                  <div class="col-sm-9">
                    <input type="text" name="totalyrexprnc"class="form-control" placeholder="Total Year of experience">
                  </div>
               </div>
               <div class="form-group">
                  <label  class=" col-sm-3">Official Email</label>

                  <div class="col-sm-9">
                    <input type="text" name="ofcemail"class="form-control" placeholder="Official Email Id">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">CUG Mobile No</label>

                  <div class="col-sm-9">
                    <input type="text" name="cugmob"class="form-control" placeholder="CUG Mobile Number">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">Skill Sets</label>

                  <div class="col-sm-9">
                    <input type="text" name="skillsets"class="form-control" placeholder="Skill Sets">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">Location</label>

                  <div class="col-sm-9">
                    <input type="text" name="location"class="form-control" placeholder="Location">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">Reporting To</label>

                  <div class="col-sm-9">
                    <input type="text" name="reportingto"class="form-control" placeholder="Reporting To">
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info  box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Bank Account Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Ac. Name</label>

                  <div class="col-sm-9">
                    <input type="text" name="accountholdername"class="form-control" id="inputEmail3" placeholder="Account Holder Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Salary Ac. No.</label>

                  <div class="col-sm-9">
                    <input type="text" name="accountnumber"class="form-control" id="inputEmail3" placeholder="Salary Account Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Bank Name</label>

                  <div class="col-sm-9">
                    <input type="text" name="bankname"class="form-control" id="inputEmail3" placeholder="Enter Bank Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Ifsc</label>

                  <div class="col-sm-9">
                    <input type="text" name="ifsc"class="form-control" id="inputEmail3" placeholder="Enter Ifsc Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Pan No.</label>

                  <div class="col-sm-9">
                    <input type="text" name="pan"class="form-control" id="inputEmail3" placeholder="Enter Pan Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Branch</label>

                  <div class="col-sm-9">
                    <input type="text" name="branch"class="form-control" id="inputEmail3" placeholder="Enter Branch Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">PF Account</label>

                  <div class="col-sm-9">
                    <input type="text" name="pfaccount"class="form-control" id="inputEmail3" placeholder="PF Account Number">
                  </div>
                </div>
             
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info  box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Documents</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">

                <div class="col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Resume</label>

                  <div class="col-sm-6">
                    <input name="resume" onchange="readURL1(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow1" src="#" alt="No Image Selected" style="height: 70px;width: 70px;">
                  </div>
                </div>
              </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Offer Letter</label>
                  <div class="col-sm-6">
                    <input name="offerletter" onchange="readURL2(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow2" src="#" alt="No Image Selected" style="height: 70px;width: 70px;">
                  </div>
                </div>
              </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Joining Letter</label>
                  <div class="col-sm-6">
                    <input name="joiningletter" onchange="readURL3(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow3" src="#" alt="No Image Selected" style="height: 70px;width: 70px;">
                  </div>
                </div>
              </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Agreement Paper</label>
                  <div class="col-sm-6">
                    <input name="agreementpaper" onchange="readURL4(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow4" src="#" alt="No Image Selected" style="height: 70px;width: 70px;">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Voter ID</label>
                  <div class="col-sm-6">
                    <input name="idproof" onchange="readURL5(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow5" src="#" alt="No Image Selected" style="height: 70px;width: 70px;">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Aadhaar Card</label>
                  <div class="col-sm-6">
                    <input name="aadhaarcard" onchange="readURL6(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow6" src="#" alt="No Image Selected" style="height: 70px;width: 70px;">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Pan Card</label>
                  <div class="col-sm-6">
                    <input name="pancard" onchange="readURL7(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow7" src="#" alt="No Image Selected" style="height: 70px;width: 70px;">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Photo</label>
                  <div class="col-sm-6">
                    <input name="photo" onchange="readURL8(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow8" src="#" alt="No Image Selected" style="height: 70px;width: 70px;">
                  </div>
                </div>
              </div>

              

              </div>
              
            </div>
          </div>
      </div>
</div>
            <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-flat btn-info pull-right">Submit Employee Details</button>
              </div>
              <!-- /.box-footer -->
        </form>
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
  function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow3').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow4').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL5(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow5').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  } function readURL6(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow6').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  } 
  function readURL7(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow7').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
   function readURL8(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow8').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
</script>

@endsection