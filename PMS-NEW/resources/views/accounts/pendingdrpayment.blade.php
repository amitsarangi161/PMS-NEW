@extends('layouts.account')

@section('content')

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">PENDING DEBIT VOUCHER PAYMENTS</td>
	</tr>
</table>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
     <thead>
     	<tr class="bg-navy">
     		<td>ID</td>
     		<td>VENDOR NAME</td>
     		<td>AMOUNT</td>
     		<td>PAYMENT TYPE</td>
     		<td>REMARKS</td>
     		<td>BANK NAME</td>
     		<td>PAYMENT STATUS</td>
     		<td>CREATED AT</td>
               <th>SCHEDULE DATE</th>
     		<td>VIEW</td>
     	</tr>
     </thead>

     <tbody>
     	@foreach($debitvoucherpayments as $debitvoucherpayment)
          @php
        $today=Carbon\Carbon::now();
        $color='';
    if($debitvoucherpayment->scheduledate!=''){
          $scheduledate=\Carbon\Carbon::parse($debitvoucherpayment->scheduledate);
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
              <td><button class="btn bg-maroon btn-sm" title="Schedule a date" onclick="openscheduledate('{{$debitvoucherpayment->id}}','{{$debitvoucherpayment->amount}}')"><i class="fa fa-bolt" aria-hidden="true"></i> {{$debitvoucherpayment->id}}</button></td>
              @else
              <td>{{$debitvoucherpayment->id}}</td>
              @endif
     	
     		<td>{{$debitvoucherpayment->vendorname}}</td>
     		<td>{{$debitvoucherpayment->amount}}</td>
     		<td>{{$debitvoucherpayment->paymenttype}}</td>
     		<td>{{$debitvoucherpayment->remarks}}</td>
     		<td>{{$debitvoucherpayment->bankname}}/{{$debitvoucherpayment->acno}}/{{$debitvoucherpayment->branchname}}</td>
     		<td>{{$debitvoucherpayment->paymentstatus}}</td>
     		<td>{{$debitvoucherpayment->created_at}}</td>
                @if($debitvoucherpayment->scheduledate!='')
              <td>{{$debitvoucherpayment->scheduledate}}</td>
              @else
              <td><label class="label label-warning">Not Scheduled</label></td>
              @endif
     		<td><a href="/dvpay/pendingdrpayment/view/{{$debitvoucherpayment->id}}" class="btn btn-primary">VIEW</a></td>
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
              <form method="post" action="/drpaymentschedule">
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