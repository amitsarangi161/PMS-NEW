@extends('layouts.md')

@section('content')

<div class="box">
  <div class="box-header">
    <div class="row">
    </div>
  </div>
@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif
@if(Session::has('error'))
<p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif
@if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload A Valid Excel File<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
@endif
      <div class="box-body table-responsive">

        <table class="table table-bordered table-striped datatablescrollexport">
        <thead>
          <tr class="bg-navy">
            <td>Sl. No</td>
            <td>EMPLOYEE CODE</td>
            <td>Employee Name</td>
            <td>Blood Group</td>


            <td>DOB</td>
            <td>QUALIFICATION</td>
            <td>FATHER NAME</td>
            <td>MARETAL STATUS</td>
            <td>GENDER</td>
            <td>EXPERIENCE IN COMPANY</td>
            <td>TOTAL EXPERIENCE</td>
            <td>ADHAR NUMBER</td>
            <td>PRESENT ADDRESS</td>
            <td>PERMANENT ADDRESS</td>
            <td>ACCOUNT HOLDER NAME</td>
            <td>ACCOUNT NUMBER</td>
            <td>BANK NAME</td>
            <td>IFSC</td>
            <td>PAN</td>
            <td>BRANCH NAME</td>
            <td>PF ACCOUNT</td>
            <td>LOCATION</td>
            <td>REPORTING TO</td>
            <td>SKILL SETS</td>
            <td>OFFICIAL MAIL</td>
            <td>DEPARTMENT</td>
            <td>CUG MOBILE NUMBER</td>
            <td>DESIGNATION</td>
            <td>DATE OF JOINING</td>
            <td>DATE OF CONFORMATION</td>
            <td>JOIN SALARY</td>


            
            <td>Mobile No</td>
            <td>Alternate Mobile No</td>
            <td>Email</td>
            <td>Address</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($employeedetails as $key=>$employeedetail)
          <tr>
            <td><button class="btn btn-success btn-sm btn-flat">{{++$key}}</button></td>
            <td>{{$employeedetail->empcodeno}}</td>
            <td>{{$employeedetail->employeename}}</td>
            <td>{{$employeedetail->bloodgroup}}</td>

            <td>{{$employeedetail->dob}}</td>
            <td>{{$employeedetail->qualification}}</td>
            <td>{{$employeedetail->fathername}}</td>
            <td>{{$employeedetail->maritalstatus}}</td>
            <td>{{$employeedetail->gender}}</td>
            <td>{{$employeedetail->experencecomp}}</td>
            <td>{{$employeedetail->totalyrexprnc}}</td>
            <td>{{$employeedetail->adharno}}</td>
            <td>{{$employeedetail->presentaddress}}</td>
            <td>{{$employeedetail->permanentaddress}}</td>
            <td>{{$employeedetail->accountholdername}}</td>
            <td>{{$employeedetail->accountnumber}}</td>
            <td>{{$employeedetail->bankname}}</td>
            <td>{{$employeedetail->ifsc}}</td>
            <td>{{$employeedetail->pan}}</td>
            <td>{{$employeedetail->branch}}</td>
            <td>{{$employeedetail->pfaccount}}</td>
            <td>{{$employeedetail->location}}</td>
            <td>{{$employeedetail->reportingto}}</td>
            <td>{{$employeedetail->skillsets}}</td>
            <td>{{$employeedetail->ofcemail}}</td>
            <td>{{$employeedetail->department}}</td>
            <td>{{$employeedetail->cugmob}}</td>
            <td>{{$employeedetail->designation}}</td>
            <td>{{$employeedetail->dateofjoining}}</td>
            <td>{{$employeedetail->dateofconfirmation}}</td>
            <td>{{$employeedetail->joinsalary}}</td>



            <td>{{$employeedetail->phone}}</td>
            <td>{{$employeedetail->alternativephonenumber}}</td>
            <td>{{$employeedetail->email}}</td>
            <td>{{$employeedetail->presentaddress}}</td>
            <td>
              @if($employeedetail->status=="RESIGN")
              <small class="label bg-yellow" onclick="employeestatus('{{$employeedetail->id}}','$employeedetail->status');">{{$employeedetail->status}}</small>
              @elseif($employeedetail->status=="TERMINATED")
              <small class="label bg-red" onclick="employeestatus('{{$employeedetail->id}}','$employeedetail->status');">{{$employeedetail->status}}</small>@elseif($employeedetail->status=="LEFT WITHOUT INFORMATION")
              <small class="label bg-maroon" onclick="employeestatus('{{$employeedetail->id}}','$employeedetail->status');">{{$employeedetail->status}}</small>
              @else
              <small class="label bg-green" onclick="employeestatus('{{$employeedetail->id}}','$employeedetail->status');">{{$employeedetail->status}}</small>
              @endif
            </td>
            <td><a href="/editemployeedetails/{{$employeedetail->id}}" onclick="return confirm('are you sure to edit employee ??')" ><button class="btn btn-primary btn-flat">Edit</button></a></td>
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

<div class="modal fade in" id="employeestatus">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="/employeestatus">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <h4 class="modal-title text-center">Change  Status</h4>
      </div>
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label>Change  Status</label>
            <select class="form-control" name="status">
              <option value="PRESENT">PRESENT</option>
              <option value="RESIGN">RESIGN</option>
              <option value="TERMINATED">TERMINATED </option>
              <option value="LEFT WITHOUT INFORMATION">LEFT WITHOUT INFORMATION</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-flat">Change Status</button>
      </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript">
	function importemployee(){
		alert("Do You Want To Upload Employee Excel"); 
	}
  $(".alert-success").delay(5000).fadeOut(800); 
    $(".alert-danger").delay(15000).fadeOut(800);

  function employeestatus(userid,status){
    $("#employeestatus").modal('show');
    $("#id").val(userid);
  }
</script>



@endsection