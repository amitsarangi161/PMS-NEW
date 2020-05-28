@extends('layouts.account')
@section('content')

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">REQUISITION PAYMENT FROM BANK</td>
	</tr>
	 
</table>
<div class="table-responsive">
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
         <th>Schedule Date</th>
        <th>PAY TO</th>
     		<th>VIEW</th>


     	</tr>
	
     </thead>
     <tbody>
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
              <td>{{$requisitionpayment->rid}}</td>
           	  <td>{{$requisitionpayment->name}}</td>
           	  <td>{{$requisitionpayment->amount}}</td>
           	  <td>{{$requisitionpayment->paymenttype}}</td>
           	  <td>{{$requisitionpayment->remarks}}</td>
           	  <td>{{$requisitionpayment->paymentstatus}}</td>
           	  <td>{{$requisitionpayment->created_at}}</td>
               @if($requisitionpayment->scheduledate!='')
              <td>{{$requisitionpayment->scheduledate}}</td>
              @else
              <td><label class="label label-warning">Not Scheduled</label></td>
              @endif
              <td>{{$requisitionpayment->type}}</td>
           	  <!-- <td><button type="button" class="btn btn-primary" onclick="payonline('{{$requisitionpayment->id}}');">PAID</button></td> -->
              <td><a href="/cashierviewdetailsonlinepayment/{{$requisitionpayment->id}}" class="btn btn-primary">VIEW</a></td>
           </tr>

     	@endforeach
     </tbody>
</table>
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
  function openscheduledate(paymentid,amount){
    $("#paymentid").val(paymentid);
    $("#amount").val(amount);
    $('#scheduledate').modal('show');
  }
  
</script>
@endsection