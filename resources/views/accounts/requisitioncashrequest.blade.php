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
.b {
    white-space: nowrap; 
    width: 150px; 
    overflow: hidden;
    text-overflow: ellipsis;
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
        <th>PROJECT NAME</th>
        <th>REQUISITION ID</th>
     		<th>NAME</th>
     		<th>AMOUNT</th>
     		<th>PAYMENT TYPE</th>
     		<th>REMARKS</th>
        <th>PAYMENT STATUS</th>
     		<th>CREATED_AT</th>
        <th>Schedule Date</th>
     		<th>PAY</th>


     	</tr>
	
     </thead>
     <tbody>
      @if($requisitionpayments)
     	@foreach($requisitionpayments as $requisitionpayment)
       @php
        $today=Carbon\Carbon::now();
        $color='';
    if($requisitionpayment->scheduledate!=''){
          $scheduledate=\Carbon\Carbon::parse($requisitionpayment->scheduledate);
          $s=$scheduledate->toDateString();
          $t=$today->toDateString();
           if($s==$t){
             $color='#00a65aa6';
            }
           
    }
       else{
        $color='';
      }
      @endphp
           <tr style="background-color: {{$color}};">
            @if(Auth::user()->usertype=='MASTER ADMIN')
           	  <td><button class="btn bg-maroon btn-sm" title="Schedule a date" onclick="openscheduledate('{{$requisitionpayment->id}}','{{$requisitionpayment->amount}}')"><i class="fa fa-bolt" aria-hidden="true"></i> {{$requisitionpayment->id}}</button></td>
              @else
              <td>{{$requisitionpayment->id}}</td>
              @endif
              <td><p class="b" title="{{$requisitionpayment->projectname}}">{{$requisitionpayment->projectname}}</p></td>
              <td>{{$requisitionpayment->rid}}</td>
           	  <td>{{$requisitionpayment->name}}</td>
           	  <td>{{$requisitionpayment->amount}}</td>
           	  <td style="cursor: pointer;" onclick="updatepaymentmethod('{{$requisitionpayment->paymenttype}}','{{$requisitionpayment->bankid}}');">{{$requisitionpayment->paymenttype}}
                  <i class="fa fa-pencil" style="color: #0983b3; padding: 5px;"></i> 
              </td>
           	  <td>{{$requisitionpayment->remarks}}</td>
              <td>{{$requisitionpayment->paymentstatus}}</td>
          
           	  <td>{{$requisitionpayment->created_at}}</td>
              @if($requisitionpayment->scheduledate!='')
              <td>{{$requisitionpayment->scheduledate}}</td>
              @else
              <td><label class="label label-warning">Not Scheduled</label></td>
              @endif
    
              <td> <button type="submit" class="btn btn-success" onclick="openpaymodal('{{$requisitionpayment->id}}');">PAID</button></td>
           </tr>

     	@endforeach
      @endif
     </tbody>
</table>

<div class="modal fade" id="updatepaymentmethod" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-navy">
          <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
          <h4 class="modal-title text-center">UPDATE REQUISTION PAYMENT</h4>
        </div>
        <div class="modal-body">
          <form action="/updatepaymentmethod/{{$requisitionpayment->id}}" method="post">
            {{csrf_field()}}
          <table class="table">           
          
            <tr>
              <td><strong>PAYMENT TYPE</strong></td>
              <td>
                <select class="form-control" name="paymenttype" id="paymenttype" onchange="getbank(this.value);" required="" >
                  <option value="">SELECT A PAYMENT TYPE</option>
                  <option value="ONLINE PAYMENT">ONLINE PAYMENT</option>
                  <option value="CASH">CASH</option>
                  <option value="CHEQUE">CHEQUE</option>                  
                </select>
        </td>
            </tr>
          
             <tr>
        <td colspan="2" style="text-align: center;font-size:15px;"> <p id="errormsg" style="color: red;"></p></td>
      </tr>
            <tr>
              <td colspan="2"><button type="submit" id="subbutton" class="btn btn-success pull-right" onclick="return confirm('Do You Want to Proceed?')">SUBMIT</button></td>
            </tr>
          
          </table>
          </form>
        </div>
      </div>
      
    </div>
  </div>


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
            <td><strong>CHEQUE NO.</strong></td>
            <td><input type="text" placeholder="Enter Trancaction Id" class="form-control" name="transactionid" value="NA" required=""></td>
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

<div class="modal fade" id="scheduledate">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-navy">
              <h4 class="modal-title text-center"> Schedule A Date</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form method="post" action="/requisitionpaymentschedule">
                {{csrf_field()}}
             <div class="form-group">
                <label>Payment Id</label>
                <input type="text" class="form-control" name="paymentid" id="paymentid" readonly="">
              </div>
              <div class="form-group">
                <label>Payment Amount</label>
                <input type="text" class="form-control" name="amount" readonly="" id="amount">
              </div>
              <div class="form-group">
                <label>Schedule Date</label>
                <input type="text" class="form-control datepicker2" readonly="" name="scheduledate">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-outline-light btn-success" onclick="return confirm('Are You confirm to proceed?')">Schedule Date</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script type="text/javascript">
  function openpaymodal(pid)
  {

 
    $("#pid").val(pid);
    $("#myModal").modal('show');

  }
  function openscheduledate(paymentid,amount){
    $("#paymentid").val(paymentid);
    $("#amount").val(amount);
    $('#scheduledate').modal('show');
  }
    function updatepaymentmethod(paymenttype,bankid){

    $('#paymenttype option[value="'+paymenttype+'"]').attr("selected", "selected");
    $('#reqbank option[value="'+bankid+'"]').attr("selected", "selected");
    $("#updatepaymentmethod").modal('show');
  }
</script>


@endsection