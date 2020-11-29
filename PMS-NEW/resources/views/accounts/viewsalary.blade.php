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
<h3 class="text-center"><strong>ALL SALARIES</strong></h3>

<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<th>ID</th>
			<th>EMP NAME</th>
      <th>SALARY TYPE</th>
      <th>FOR YEAR</th>
      <th>FOR MONTH</th>
      <th>DESCRIPTION</th>
      <th>AMOUNT</th>
      <th>FROM BANK</th>
      <th>PAYMENT DATE</th>
      <th>TRN ID</th>
      
			<th>CREATED AT</th>
      <th>EDIT</th>
		</tr>
	</thead>
	<tbody>
    @foreach($salaries as $salary)
		<tr style="font-size: 12px;">
        <td>{{$salary->id}}</td>
        <td>{{$salary->name}}</td>
        <td>{{$salary->salarytype}}</td>
        <td>{{$salary->year}}</td>
        <td>{{$salary->month}}</td>
        <td>{{$salary->purpose}}</td>
        <td>{{$salary->amount}}</td>
        <td>{{$salary->bankname}}/{{$salary->acno}}/{{$salary->branchname}}</td>
        <td>{{$salary->dateofpayment}}</td>
        <td>{{$salary->trnid}}</td>
        <td>{{$salary->created_at}}</td>
       
        <td><a href="/edittempsalary/{{$salary->id}}" class="btn btn-primary">EDIT</a></td>

        

		</tr>
    @endforeach
	</tbody>
<tfoot>
  <tr style="background-color: #cecdcd;">
     
   </tr>
  </tfoot>
	
</table>
</div>
@endsection