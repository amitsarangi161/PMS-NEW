@extends('layouts.account')
@section('content')
<style type="text/css">
  .modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">REQUISITION PAYMENT CASH</td>
	</tr>
	 
</table>

<table class="table table-responsive table-hover table-bordered table-striped datatable1">
     <thead>
     	<tr class="bg-navy">
     		<th>ID</th>
        <th>REQUISITION ID</th>
     		<th>NAME</th>
     		<th>AMOUNT</th>
     		<th>PAYMENT TYPE</th>
     		<th>REMARKS</th>
        <th>PAYMENT STATUS</th>
    
     		<th>CREATED_AT</th>
     		<th>PAY</th>


     	</tr>
	
     </thead>
     <tbody>
     	@foreach($requisitionpayments as $requisitionpayment)
           <tr>
           	  <td>{{$requisitionpayment->id}}</td>
              <td>{{$requisitionpayment->rid}}</td>
           	  <td>{{$requisitionpayment->name}}</td>
           	  <td>{{$requisitionpayment->amount}}</td>
           	  <td>{{$requisitionpayment->paymenttype}}</td>
           	  <td>{{$requisitionpayment->remarks}}</td>
              <td>{{$requisitionpayment->paymentstatus}}</td>
          
           	  <td>{{$requisitionpayment->created_at}}</td>
          <!--  	  <td>
                 <form action="/cashierpaidrequsitioncash/{{$requisitionpayment->id}}" method="post">
                  {{csrf_field()}}
                <button type="submit" class="btn btn-success" onclick="return confirm('Are You confirm to proceed?')">PAID</button>
                 </form>
              </td> -->
              <td> <button type="submit" class="btn btn-success" onclick="openpaymodal('{{$requisitionpayment->id}}');">PAID</button></td>
           </tr>

     	@endforeach
     </tbody>
</table>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: chartreuse;" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;"><strong>TRANCTION DETAILS</strong></h4>
      </div>
      <div class="modal-body">
        <form action="/cashierpaidrequsitioncash" method="post">
          {{csrf_field()}}
        <table class="table">
          <input type="hidden" name="pid" id="pid">
       
            <tr>
            <td><strong>DATE OF PAYMENT</strong></td>
            <td><input type="text" placeholder="Date of Payment" class="form-control datepicker1" name="dateofpayment" autocomplete="off" readonly="" required=""></td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success" onclick="return confirm('Are You confirm to proceed?')">PAID</button></td>
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
<script type="text/javascript">
  function openpaymodal(pid)
  {

 
    $("#pid").val(pid);
    $("#myModal").modal('show');

  }
  
  
</script>


@endsection