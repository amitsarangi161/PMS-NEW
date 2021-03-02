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
<div class="row">
 <div class="col-md-12">
  <div class="box">
    <div class="box-header bg-gray">
    	<form action="/empattendance/viewemployeepayslip" method="get">
    <div class="form-group">

      <label  class="col-sm-2 control-label">From Month</label>
       <div class="col-sm-3">
       		<select  class="form-control select2" id="fromyear" name="fromyear">
				<option value="2021" {{(Request::get('fromyear')=='2021')?'selected':''}}>2021</option>
				<option value="2020"{{(Request::get('fromyear')=='2020')?'selected':''}}>2020</option>
				<option value="2019"{{(Request::get('fromyear')=='2019')?'selected':''}}>2019</option>
				<option value="2018"{{(Request::get('fromyear')=='2018')?'selected':''}}>2018</option>
				<option value="2017"{{(Request::get('fromyear')=='2017')?'selected':''}}>2017</option>
				<option value="2016"{{(Request::get('fromyear')=='2016')?'selected':''}}>2016</option>
		    <option value="2015"{{(Request::get('fromyear')=='2015')?'selected':''}}>2015</option>
		    <option value="2014"{{(Request::get('fromyear')=='2014')?'selected':''}}>2014</option>
		    <option value="2013" {{(Request::get('fromyear')=='2013')?'selected':''}}>2013</option>
			    
			</select>
		  <select   class="form-control select2" id="frommonth" name="frommonth" >
			    <option value="01"{{(Request::get('frommonth')=='01')?'selected':''}}>January</option>
			    <option value="02"{{(Request::get('frommonth')=='02')?'selected':''}}>February</option>
			    <option value="03"{{(Request::get('frommonth')=='03')?'selected':''}}>March</option>
			    <option value="04"{{(Request::get('frommonth')=='04')?'selected':''}}>April</option>
			    <option value="05"{{(Request::get('frommonth')=='05')?'selected':''}}>May</option>
			    <option value="06"{{(Request::get('frommonth')=='06')?'selected':''}}>June</option>
			    <option value="07"{{(Request::get('frommonth')=='07')?'selected':''}}>July</option>
			    <option value="08"{{(Request::get('frommonth')=='08')?'selected':''}}>August</option>
			    <option value="09"{{(Request::get('frommonth')=='09')?'selected':''}}>September</option>
			    <option value="10"{{(Request::get('frommonth')=='10')?'selected':''}}>October</option>
			    <option value="11"{{(Request::get('frommonth')=='11')?'selected':''}}>November</option>
			    <option value="12"{{(Request::get('frommonth')=='12')?'selected':''}}>December</option>
			</select>
			
      </div>
      <div  class="col-md-3">
      <div class="form-group">
        <label>Select Employee *</label>
          <select  class="form-control select2" id="employeeid"  name="employeeid" style="width: 100%;">
            <option value="">SELECT A Employee</option>
               @foreach($users as $key => $user)
               <option value="{{$user->employee_id}}" {{(Request::get('employeeid')==$user->employee_id)?:''}} >{{$user->name}}</option>
               @endforeach
          </select>
      </div>
    </div>
      <div class="col-sm-1">
        <button type="submit" class="btn btn-success">Fetch</button>
      </div>
    </div>
	</form>
  </div>
</div>

</div>
</div>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VIEW PAY SLIP</td>
	</tr>
	
</table>
<div class="row">
<div class="col-md-6">
  <div class="row">
 
</div></div>
<div class="col-md-6"></div>
</div>
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatablescrollexport">
	<thead>
		<tr class="bg-navy">
		<th>Id</th>
		<th>Employee Name</th>
		<th>MONTH</th>
		<th>YEAR</th>
		<th>EMPCODE NO</th>
	    <th>DEPARTMENT</th>
	    <th>DESIGNATION</th>
	    <th>TOTAL LEAVE</th>
	    <th>TOTAL LEAVE TAKEN</th>
	    <th>LEAVE PENDING</th>
	    <th>EMPLOYEE TOTAL SALARY</th>
	    <th>BASIC SALARY</th>
	    <th>EPF DEDUCTION</th>
	    <th>ESIC DEDUCTION</th>
		<th>View</th>
		</tr>
	</thead>

	<tbody>
		@foreach($salaryslips as $salaryslip)
          <tr>
          	<td>{{$salaryslip->id}}</td>
            <td>{{$salaryslip->employeename}}</td>
            <td>{{$salaryslip->month}}</td>
            <td>{{$salaryslip->year}}</td>
            <td>{{$salaryslip->empcodeno}}</td>
            <td>{{$salaryslip->department}}</td>
          	<td>{{$salaryslip->designation}}</td>
            <td>{{$salaryslip->totalleave}}</td>
            <td>{{$salaryslip->totleavetaken}}</td>
            <td>{{$salaryslip->totalbalanceleave}}</td>
            <td>{{$salaryslip->emptotalwages}}</td>
            <td>{{$salaryslip->basicsalary}}</td>
            <td>{{$salaryslip->epfdeduction}}</td>
            <td>{{$salaryslip->esicdeduction}}</td>
            <td><a href="/viewslip/{{$salaryslip->id}}" target="_blank" class="btn btn-warning">VIEW</a>
             </td>
          </tr>
		@endforeach
	</tbody>
</table>
</div>

@endsection