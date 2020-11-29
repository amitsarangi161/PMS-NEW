@extends('layouts.account')

@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
<table class="table">
  <tr class="bg-blue">
    <td class="text-center">VIEW VOUCHER DETAILS</td>
    
  </tr>
  
</table>
<table class="table">
  <tr>
    <td><strong>VOUCHER N0</strong></td>
    <td>#{{$voucher->id}}</td>
    <td><strong>PAYEE NAME</strong></td>
    <td>#{{$voucher->payeename}}</td>
  </tr>
   <tr>
    <td><strong>BANK NAME</strong></td>
    <td>#{{$voucher->bankname}}</td>
    <td><strong>AC NO</strong></td>
    <td>#{{$voucher->acno}}</td>
  </tr>
  <tr>
    <td><strong>IFSC CODE</strong></td>
    <td>#{{$voucher->ifsccode}}</td>
    <td><strong>DESCRIPTION</strong></td>
    <td>{{$voucher->description}}</td>
  </tr>
  <tr>
    <td><strong>PROJECT</strong></td>
    <td style="background-color: #20ff38;">{{$voucher->projectname}}</td>
    <td><strong>EXPENSE HEAD</strong></td>
    <td>{{$voucher->expenseheadname}}</td>
  </tr>
  <tr>
    <td><strong>PARTICULAR</strong></td>
    <td>
      @if($voucher->particularname!='')
      {{$voucher->particularname}}
      @else
      NONE
      @endif

    </td>
    
    <td><strong>AMOUNT</strong></td>
    <td>{{$voucher->amount}}</td>
  </tr>
  <tr>
    <td><strong>TDS RATE IN (%)</strong></td>
    <td>{{$voucher->tds}}</td>
    <td><strong>TDS RATE AMOUNT</strong></td>
    <td>{{$voucher->tdsamt}}</td>
  </tr>
  <tr>
    <td><strong>FINAL AMOUNT TO PAY</strong></td>
    <td style="background-color: #8bff00"><strong>{{$voucher->amounttopay}}</strong>
    <input type="hidden" value="{{$voucher->amounttopay}}" id="amounttopay">
    </td>
 <td><strong>CHEQUE DETAILS<strong></td>
     <td><strong>{{$voucher->chequedetails}}</strong></td>
  </tr>
  <tr>

    <td><strong>DESCRIPTION</strong></td>
    <td>{{$voucher->description}}</td>
  </tr>
  <tr>
    <td><strong>STATUS</strong></td>
     <td>
        @if($voucher->status=='PENDING')
       <span class="label label-warning">{{$voucher->status}}</span>
        @elseif($voucher->status=='APPROVED')
          <span class="label label-success">{{$voucher->status}}</span>
         @else
          <span class="label label-danger">{{$voucher->status}}</span>
         @endif
       </td>
    <td><strong>AUTHOR</strong></td>
    <td>{{$voucher->author}}</td>
  </tr>
  <tr>
    <td><strong>CREATED_AT</strong></td>
    <td>{{$provider::changedatetimeformat($voucher->created_at)}}</td>
    <td><strong>APPROVED BY</strong></td>
    <td>{{$voucher->approvedbyname}}</td>
  </tr>
  <tr>
    <td><strong>UPLOADED FILE</strong></td>
     <td>
      <a href="{{ asset('/img/vouchers/'.$voucher->uploadedfile )}}" target="_blank">
      <img title="click to view the image" style="height:100px;width:150px;" alt="click to view" src="{{ asset('/img/vouchers/'.$voucher->uploadedfile )}}">
      <strong>Click Here To View</strong>
      </a>
     </td>
     <td colspan="2">
       <button type="button" onclick="openpay();"  class="btn btn-info btn-lg">PAY</button>
     </td>
  </tr>
</table>
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">PAY FOR REQUISITION</h4>
        </div>
        <div class="modal-body">
          <form action="/payvoucher/{{$voucher->id}}" method="post">
            {{csrf_field()}}
          <table class="table">
            <tr>
              <td><strong>FINAL AMOUNT TO PAY</strong></td>
              <td>
               <input type="text" readonly="" id="amttopay" class="form-control">
              </td>
            </tr>
            <tr>
              <td><strong>PAYMENT TYPE *</strong></td>
              <td>
                <select class="form-control clc" name="paymenttype" id="paymenttype" onchange="getbank(this.value);" required="">
                  <option value="">SELECT A PAYMENT TYPE</option>
                  <option value="ONLINE PAYMENT">ONLINE PAYMENT</option>
                  <option value="CASH">CASH</option>
                  <option value="CHEQUE">CHEQUE</option>
                </select>
              </td>
            </tr>
            <tbody style="display: none;" id="showbank">
           <tr >
              <td><strong>SELECT BANK *</strong></td>
              <td>
                <select class="form-control" name="frombankid" id="reqbank">
                  <option value="">Select a Bank</option>
                  @foreach($banks as $bank)
                          <option value="{{$bank->id}}">{{$bank->bankname}}/{{$bank->acno}}/({{$bank->branchname}})</option>
                  @endforeach
                  
                </select>
              </td>
            </tr>
            <tr>
              <td><strong>TRANSACTION ID *</strong></td>
              <td><input type="text" name="trnid" id="trnid" class="form-control" placeholder="Enter TRN ID"></td>
            </tr>
            </tbody>
             <tr>
              <td><strong>PAYMENT DATE *</strong></td>
              <td>
                <input type="text" name="date"  class="form-control datepicker" autocomplete="off" required="">
              </td>
            </tr>
        
    
            <tr>
              <td><strong>REMARKS/CHEQUE DETAILS</strong></td>
              <td>
                <textarea name="remarks" class="form-control"></textarea>
              </td>
            </tr>
             <tr>
        <td colspan="2" style="text-align: center;font-size:15px;"> <p id="errormsg" style="color: red;"></p></td>
      </tr>
            <tr>
              <td colspan="2"><button type="submit" id="subbutton" onclick="return confirm('Do You Want to Proceed?')" class="btn btn-success">SUBMIT</button></td>
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
     function openpay()
     {
        var amounttopay= $("#amounttopay").val();
        $("#amttopay").val(amounttopay);
         $("#myModal1").modal('show');
     }
    function getbank(type)
  {
    if(type=='CASH')
    {
      $("#showbank").hide();
      $('#reqbank').prop('required',false);
      $('#trnid').prop('required',false);
    }
    else if(type=='CHEQUE')
    {
          $("#showbank").hide();
      $('#reqbank').prop('required',false);
    }
    else
    {
      $("#showbank").show();
      $('#reqbank').prop('required',true);
       $('#trnid').prop('required',true);
    }

  }
</script>
@endsection