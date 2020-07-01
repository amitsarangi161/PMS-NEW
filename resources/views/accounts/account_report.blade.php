@extends('layouts.account')

@section('content')
@if(Session::has('msg'))
<p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VENDOR DETAILS</td>

	</tr>

</table>

<div class="well">
	<table class="table">
		<tr>
			<td width="20%"><strong>VENDOR ID :</strong></td>
            <td width="30%">#{{$vendor->id}}</td>
       
			<td width="20%"><strong>VENDOR NAME:</strong></td>
			<td width="30%">{{$vendor->vendorname}}</td>
		</tr>
        <tr>
            <td width="20%"><strong>GST NUMBER:</strong></td>
            <td width="30%">{{$vendor->gstno}}</td>
            <td width="20%"><strong> PAN:</strong></td>
            <td width="30%">{{$vendor->panno}}</td>
        </tr>
        <tr>
            <td width="20%"><strong>AC NO:</strong></td>
            <td width="30%">{{$vendor->acno}}</td>
            <td width="20%"><strong> IFSC:</strong></td>
            <td width="30%">{{$vendor->ifsccode}}</td>
        </tr>
        <tr>
            <td width="20%"><strong>MOBILE NO:</strong></td>
            <td width="30%">{{$vendor->acno}}</td>
            <td width="20%"><strong>BRANCH NAME:</strong></td>
            <td width="30%">{{$vendor->branchname}}</td>
        </tr>
        <tr>
            <td colspan="4"><button type="button" class="btn btn-success pull-right btn-flat" onclick="payment();">PAY</button></td>
        </tr>
    </table>
</div>
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VENDOR ACCOUNT DETAILS</td>

	</tr>

</table>

<div class="well">
	<table class="table table-responsive table-bordered table-hover table-striped">
        <thead style="background: #0073b7;
    color: #fff;">
            <th>ID</th>
            <th>Transaction Date</th>
            <th>Credit</th>
            <th>Debit</th>
        </thead>
        @foreach($trns as $key=>$trn)
		<tr>
            <td width="20%"><a href="/viewdrvoucher/{{$trn->id}}" target="_blank" class="btn btn-info">{{$trn->id}}</a></td>
			<td width="20%">{{$trn->created_at}}</td>
            <td style="text-align: right" width="30%">{{$trn->credit}}</td>
            <td style="text-align: right" width="30%">{{$trn->debit}}</td>
        </tr>
        @endforeach

        <tfoot style="background: #c0c0c0;">
			<tr><td colspan='2'>Total</td>
            <td style="text-align: right" width="30%">{{$trns->sum('credit')}}</td>
            <td style="text-align: right" width="30%">{{$trns->sum('debit')}}</td>
			</tr>
            <tr style="
    background: #9e9c9c;
">
			<td colspan='3'>Balance</td>
            <td style="border-bottom:double ;text-align: right" width="30%">{{$trns->sum('credit')-$trns->sum('debit')}}</td>
</tr>

        
        </tfoot>
       
    </table>
</div>
<div class="modal fade" id="mymodal">

        <div class="modal-dialog">
          <div class="modal-content">
             <form method="post" action="/drpaymentschedule">
                {{csrf_field()}}
            <div class="modal-header">
              <h4 class="modal-title text-center">Vendor Payment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleselect">Select a Project</label>
                    <select name="projectid" class="form-control select2" style="width: 100%;">
                      <option value="">NONE</option>
                   
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>PAYMENT TYPE</label>
                    <input type="text" name="reftype" readonly="" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleselect">Select a Expense Head</label>
                    <select name="expenseheadid" class="form-control select2" style="width: 100%;">
                      <option value="">NONE</option>
                     

                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>BILL DATE</label>
                    <input type="text" class="form-control datepicker3" placeholder="Enter bill date" name="billdate" readonly="" required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleselect">BILL NO</label>
                    <input type="text" name="billno" class="form-control calc" required="" placeholder="Enter Bill No Here" autocomplete="off" onkeyup="checkbill(this.value)" required="">
          <p  class="label label-danger">If Bill No not available then Enter "NA"</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-outline-light btn-success" onclick="return confirm('Are You confirm to proceed?')">Submit</button>
            </div>
            </form>
          </div>
         </div>
        </div>

<script>
    function payment() {

    $('#mymodal').modal('show');
    }

</script>

@endsection