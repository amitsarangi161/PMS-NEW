@extends('layouts.app')

@section('content')



<table class="table" width="100%">
	<tr class="bg-navy">
		 <td class="text-center">TOUR APPROVAL FORM</td>
	</tr>
</table>

  @if(Session::has('message'))
   <p class="alert alert-info text-center">{{ Session::get('message') }}</p>
   @endif
<div class="table-responsive">
 <table class="table">
 	<form action="/savetourapplication" method="post">
 	{{csrf_field()}}
 <thead>
 	  <tr>
 	  	<td><strong>FROM PLACE :</strong></td>
 	  	<td><input type="text" name="fromplace" placeholder="From place" class="form-control" required=""></td>
 	  </tr>
 	  <tr>
 	  	<td><strong>TO PLACE :</strong></td>
 	  	<td><input type="text" name="toplace" placeholder="To place" class="form-control" required=""></td>
 	  </tr>
 	  <tr>
 	  	<td><strong>FROM DATE</strong></td>
 	  	<td><input type="text" name="fromdate" placeholder="From Date" class="form-control datepicker readonly" required="" autocomplete="off"></td>
 	  </tr>
 	  <tr>
 	  	<td><strong>TO DATE</strong></td>
 	  	<td><input type="text" name="todate" placeholder="To Date" class="form-control datepicker readonly" required="" autocomplete="off"></td>
 	  </tr>
 	  <tr>
 	  	<td><strong>DESCRIPTION</strong></td>
 	  	<td><textarea class="form-control" name="description" placeholder="Enter Your Description" required=""></textarea></td>
 	  </tr>
 	  <tr>
 	  	<td colspan="2" style="text-align: right;">
 	  		<button class="btn btn-primary btn-lg" onclick="return confirm('Do You want to submit this form ?')" type="submit">SAVE</button>
 	  	</td>
 	  </tr>
 </thead>
 	</form>
 </table>
 </div>
@endsection