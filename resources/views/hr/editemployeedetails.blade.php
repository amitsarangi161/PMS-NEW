@extends('layouts.hr')
@section('content')
@php
if($editemployeedocument){
  $offerletter=$editemployeedocument->offerletter;
  $joiningletter=$editemployeedocument->joiningletter;
  $agreementpaper=$editemployeedocument->agreementpaper;
  $idproof=$editemployeedocument->idproof;
  $resume=$editemployeedocument->resume;
  $resignation=$editemployeedocument->resignation;
  $aadhaarcard=$editemployeedocument->aadhaarcard;
  $pancard=$editemployeedocument->pancard;
  $photo=$editemployeedocument->photo;
  
}
else{
  $offerletter='';
  $joiningletter='';
  $agreementpaper='';
  $idproof='';
  $resume='';
  $resignation='';
  $aadhaarcard='';
  $pancard='';
  $photo='';
}
@endphp

<div class="row">
  @if(Session::has('message'))
  <div class="alert alert-success text-center"><span class="glyphicon glyphicon-ok"></span> {!! session('message') !!}</div>
  @endif
  <div class="col-md-6">
          <!-- Horizontal Form -->
          <form action="/updateemployeedetails/{{$editemployeedetail->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
          {{csrf_field()}}
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Details</h3>
            </div>
              <div class="box-body">
                <div class="form-horizontal">
                <div class="form-group">
                  <label  class=" col-sm-3">Emp. Name</label>
                  <div class="col-sm-9">
                    <input type="text" name="employeename"class="form-control" id="inputEmail3" placeholder="Employee Name" value="{{$editemployeedetail->employeename}}">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">Employee Code</label>
                  <div class="col-sm-9">
                    <input type="text" name="empcodeno"class="form-control" id="inputEmail3" placeholder="Employee Code" value="{{$editemployeedetail->empcodeno}}">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">Qualification</label>
                  <div class="col-sm-9">
                    <input type="text" name="qualification"class="form-control" id="inputEmail3" value="{{$editemployeedetail->qualification}}" placeholder="Qualification Name">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">Experence In Company</label>
                  <div class="col-sm-9">
                    <input type="text" name="experencecomp"class="form-control" id="inputEmail3" value="{{$editemployeedetail->experencecomp}}" placeholder="Experence In Which Company">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">DOB</label>

                  <div class="col-sm-9">
                    <input type="text" name="dob" class="form-control datepicker" value="{{$editemployeedetail->dob}}" placeholder="Date of Birth">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">Email</label>
                  <div class="col-sm-9">
                    <input type="email" name="email"class="form-control" id="inputEmail3" value="{{$editemployeedetail->email}}" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">Gender</label>

                  <div class="col-sm-9">
                   <label class="radio-inline">
                      <input type="radio" name="gender" value="male" {{ $editemployeedetail->gender == 'male' ? 'checked' : '' }}>Male
                    </label>
                    <label class="radio-inline">
                       <input type="radio" value="female" name="gender" {{ $editemployeedetail->gender == 'female' ? 'checked' : '' }}>Female
                    </label>
                    <label class="radio-inline">
                       <input type="radio" value="other" name="gender" {{ $editemployeedetail->gender == 'other' ? 'checked' : '' }}>Other
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label  class=" col-sm-3">Personal Mobile No.</label>

                  <div class="col-sm-9">
                    <input type="text" name="phone"class="form-control" id="inputEmail3" value="{{$editemployeedetail->phone}}" placeholder="Phone Number">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">Alternative No.</label>

                  <div class="col-sm-9">
                    <input type="text" name="alternativephonenumber"class="form-control" id="inputEmail3" value="{{$editemployeedetail->alternativephonenumber}}" placeholder="Alternative Phone Number">
                  </div>
                </div>

                <div class="form-group">
                  <label  class=" col-sm-3">Adhar No.</label>

                  <div class="col-sm-9">
                    <input type="text" name="adharno"class="form-control" id="inputEmail3" value="{{$editemployeedetail->adharno}}" placeholder="Adhar Number">
                  </div>
                </div>

                <div class="form-group">
                  <label  class=" col-sm-3">Blood Group</label>

                  <div class="col-sm-9">
                    <input type="text" name="bloodgroup"class="form-control" id="inputEmail3" value="{{$editemployeedetail->bloodgroup}}" placeholder="Blood Group">
                  </div>
                </div>

                <div class="form-group">
                  <label  class=" col-sm-3">
                  Father's Name</label>

                  <div class="col-sm-9">
                    <input type="text" name="fathername"class="form-control" id="inputEmail3" value="{{$editemployeedetail->fathername}}" placeholder="Father's Name">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">
                  Marital Status</label>

                  <div class="col-sm-9">
                    <input type="text" name="maritalstatus"class="form-control" id="inputEmail3" value="{{$editemployeedetail->maritalstatus}}" placeholder="Marital Status">
                  </div>
                </div>

                <div class="form-group">
                  <label  class=" col-sm-3">Present Address</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="presentaddress" name="presentaddress" autocomplete="off" type="text" placeholder="Present Address" rows="5">{{$editemployeedetail->presentaddress}}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label  class=" col-sm-3">Permanent Address</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="permanentaddress" name="permanentaddress" autocomplete="off" type="text"  placeholder="Permanent Address" rows="5">{{$editemployeedetail->permanentaddress}}</textarea>
                  </div>
                </div>
                </div>
              </div>
          </div>
      </div>

        <div class="col-md-6" class="form-horizontal">
          <!-- Horizontal Form -->
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Company Details</h3>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <div class="form-horizontal">
                <div class="form-group">
                  <label class=" col-sm-3">Department</label>

                  <div class="col-sm-9">
                    <input type="text" name="department"class="form-control" value="{{$editcompanydetail->department}}" placeholder="Date of Confirmation">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">Designation</label>

                  <div class="col-sm-9">
                    <input type="text" name="designation"class="form-control" value="{{$editcompanydetail->designation}}" placeholder="Date of Confirmation">
                  </div>
                </div>
               <div class="form-group">
                  <label  class=" col-sm-3">Date of joining</label>

                  <div class="col-sm-9">
                    <input type="text" name="dateofjoining"class="form-control datepicker" value="{{$editcompanydetail->dateofjoining}}" placeholder="Date of Joining">
                  </div>
               </div>
               <div class="form-group">
                  <label  class=" col-sm-3">Date of Confirmation</label>

                  <div class="col-sm-9">
                    <input type="text" name="dateofconfirmation"class="form-control datepicker" value="{{$editcompanydetail->dateofconfirmation}}" placeholder="Date of Confirmation">
                  </div>
               </div>
               <div class="form-group">
                  <label  class=" col-sm-3">Joining Salary</label>

                  <div class="col-sm-9">
                    <input type="text" name="joinsalary"class="form-control" value="{{$editcompanydetail->joinsalary}}" placeholder="Joining Salary">
                  </div>
               </div>
               <div class="form-group">
                  <label  class=" col-sm-3">Total Year Experience</label>

                  <div class="col-sm-9">
                    <input type="text" name="totalyrexprnc"class="form-control" value="{{$editcompanydetail->totalyrexprnc}}" placeholder="Joining Salary">
                  </div>
               </div>
               <div class="form-group">
                  <label  class=" col-sm-3">Official Email</label>

                  <div class="col-sm-9">
                    <input type="text" name="ofcemail"class="form-control" value="{{$editcompanydetail->ofcemail}}" placeholder="Official Email Id">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">CUG Mobile No</label>

                  <div class="col-sm-9">
                    <input type="text" name="cugmob"class="form-control" value="{{$editcompanydetail->cugmob}}" placeholder="CUG Mobile Number">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">Skill Sets</label>

                  <div class="col-sm-9">
                    <input type="text" name="skillsets"class="form-control" value="{{$editcompanydetail->skillsets}}" placeholder="Skill Sets">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">Location</label>

                  <div class="col-sm-9">
                    <input type="text" name="location"class="form-control" value="{{$editcompanydetail->location}}" placeholder="Location">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">Reporting To</label>

                  <div class="col-sm-9">
                    <input type="text" name="reportingto"class="form-control" value="{{$editcompanydetail->reportingto}}" placeholder="Reporting To">
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Employee  Banka Account Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
                            <div class="box-body">

                <div class="form-group">
                  <label  class="col-sm-3">Ac. Name</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->accountholdername}}" name="accountholdername"class="form-control" id="inputEmail3" placeholder="Account Holder Name">
                  </div>
                </div>

                <div class="form-group">
                  <label  class="col-sm-3">Salary Ac. No.</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->accountnumber}}" name="accountnumber"class="form-control" id="inputEmail3" placeholder="Account Number">
                  </div>
                </div>

                <div class="form-group">
                  <label  class="col-sm-3">Bank Name</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->bankname}}" name="bankname"class="form-control" id="inputEmail3" placeholder="Bank Name">
                  </div>
                </div>

                <div class="form-group">
                  <label  class="col-sm-3">Ifsc</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->ifsc}}" name="ifsc"class="form-control" id="inputEmail3" placeholder="Ifsc Number">
                  </div>
                </div>

                <div class="form-group">
                  <label  class="col-sm-3">Pan No.</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->pan}}" name="pan"class="form-control" id="inputEmail3" placeholder="Pan Number">
                  </div>
                </div>

                <div class="form-group">
                  <label  class="col-sm-3">Branch</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->branch}}" name="branch"class="form-control" id="inputEmail3" placeholder="Branch">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">PF Account</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->pfaccount}}" name="pfaccount"class="form-control" id="inputEmail3" placeholder="PF Number">
                  </div>
                </div>
             
              </div>
            </div>
          </div>
            </div>

      <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Documents</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">

                <div class="form-group col-sm-6 col-sm-6">
                  <label  class="col-sm-2">Resume</label>

                  <div class="col-sm-6">
                    <input name="resume" onchange="readURL1(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow1" src="/image/resume/{{$resume}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group col-sm-6">
                  <label  class="col-sm-2">Offer Letter</label>
                  <div class="col-sm-6">
                    <input name="offerletter" onchange="readURL2(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow2" src="/image/offerletter/{{$offerletter}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group col-sm-6">
                  <label  class="col-sm-2">Joining Letter</label>
                  <div class="col-sm-6">
                    <input name="joiningletter" onchange="readURL3(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow3" src="/image/joiningletter/{{$joiningletter}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group col-sm-6">
                  <label  class="col-sm-2">Agreement Paper</label>
                  <div class="col-sm-6">
                    <input name="agreementpaper" onchange="readURL4(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img  id="imgshow4" src="/image/agreementpaper/{{$agreementpaper}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group col-sm-6">
                  <label  class="col-sm-2">ID Proof</label>
                  <div class="col-sm-6">
                    <input name="idproof" onchange="readURL5(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow5" src="/image/idproof/{{$idproof}}" style="height: 70px;width: 70px;">
                  </div>
                </div>
               
                <div class="form-group col-sm-6">
                  <label  class="col-sm-2">Aadhar Card</label>
                  <div class="col-sm-6">
                    <input name="aadhaar" onchange="readURL6(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow6" src="/image/aadhaarcard/{{$aadhaarcard}}" style="height: 70px;width: 70px;">
                  </div>
                </div>
                <div class="form-group col-sm-6">
                  <label  class="col-sm-2">Pan Card</label>
                  <div class="col-sm-6">
                    <input name="pancard" onchange="readURL7(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow7" src="/image/pancard/{{$pancard}}" style="height: 70px;width: 70px;">
                  </div>
                </div>
                <div class="form-group col-sm-6">
                  <label  class="col-sm-2">Photo</label>
                  <div class="col-sm-6">
                    <input name="photo" onchange="readURL8(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow8" src="/image/photo/{{$photo}}" style="height: 70px;width: 70px;">
                  </div>
                </div>
                   <div class="form-group col-sm-6">
                  <label  class="col-sm-2">Resignation Letter</label>
                  <div class="col-sm-6">
                    <input name="resignation" onchange="readURL9(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow9" src="/image/resignation/{{$resignation}}" alt="No Image Selected" style="height: 70px;width: 70px;">
                  </div>
                </div>
                
              </div>
              
            </div>
          </div>
  </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-info pull-right">Update</button>
    </div>
</form>
<div class="col-md-12">
  <form action="/saveempotherdoc/{{$editemployeedetail->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
          {{csrf_field()}}
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Other Documents</h3>
            </div>
              <div class="form-horizontal">
              <div class="box-body">
                <table class="table table-bordered">
                  <thead>
                    <tr class="bg-navy">
                      <th>Sl.No</th>
                      <th>Document Name</th>
                      <th>Document</th>
                      @if(Auth::user()->usertype=='MASTER ADMIN')
                      <th>Delete</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($employeeotherdocuments as $key=>$employeeotherdocument)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$employeeotherdocument->documentname}}</td>
                      <td><img class="center-block" src="/image/otherdocument/{{$employeeotherdocument->document}}" style="height: 70px;width: 70px;"></td>
                      @if(Auth::user()->usertype=='MASTER ADMIN')
                      <td><form action="/deleteempotherdoc/{{$employeeotherdocument->id}}"  method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('Do You want to Delete this Document?')">DELETE</button>
            
          </form></td>
          @endif
                    </tr>
                   @endforeach
                    
                  </tbody>
                </table>
                
              </div>
            </div>
            <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group col-sm-12">
                  <label  class="col-sm-2">Document Name</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="documentname" placeholder="Enter Document Name">
                  </div>
                  <div class="col-sm-3">
                    <input name="document"  type="file" onchange="readURL10(this)">
                  </div>
                  <div class="col-sm-2">
                  <img id="imgshow10" src="#" style="height: 70px;width: 70px;">
                  </div>
                  <div class="col-sm-2">
                  <button type="submit"class="btn btn-success btn-flat"> Save Document</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
</div>
<script>

  function readURL1(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow1')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL2(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow2')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL3(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow3')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL4(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow4')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL5(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow5')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL6(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow6')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
     function readURL7(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow7')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
     function readURL8(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow8')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
     function readURL9(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow9')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
 function readURL10(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow10')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }

</script>


@endsection