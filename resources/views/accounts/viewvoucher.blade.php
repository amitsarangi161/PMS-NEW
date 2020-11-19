@extends('layouts.account')

@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
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
    <td style="background-color: #20ff38;">{{$voucher->amount}}</td>
  
  </tr>
  <tr>
    <td><strong>TDS RATE IN (%)</strong></td>
    <td>{{$voucher->tds}}</td>
    <td><strong>TDS RATE AMOUNT</strong></td>
    <td>{{$voucher->tdsamt}}</td>
  </tr>
  <tr>
    <td><strong>FINAL AMOUNT TO PAY</strong></td>
    <td style="background-color: #8bff00"><strong>{{$voucher->amounttopay}}</strong></td>
    <td></td>
    <td></td>
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
     <td><strong>CHEQUE DETAILS<strong></td>
     <td><strong>{{$voucher->chequedetails}}</strong></td>
  </tr>
    <tr>
    <td></td>
     <td></td>
     <td><a href="/approvevoucher/{{$voucher->id}}" onclick="return confirm('Do You want to Approve this Voucher?')" class="btn btn-success">APPROVE</a></td>
     <td></td>
  </tr>
</table>


@if($fromacc)
<table class="table">
  <tr class="bg-navy">
    <td class="text-center">PAYMENT DETAILS</td>
    
  </tr>
  
</table>
<table class="table">
  <tr>
    <td><strong>PAYMENT TYPE</strong></td>
    <td>{{$voucher->paymenttype}}</td>
    <td><strong>FROM BANK</strong></td>
    <td>{{$voucher->bankname}}</td>
  </tr>
    <tr>
    <td><strong>FROM AC NO</strong></td>
    <td>{{$fromacc->bankname}}</td>
    <td><strong>FROM BANK</strong></td>
    <td>{{$fromacc->acno}}</td>
  </tr>
     <tr>
    <td><strong>FROM BRANCH</strong></td>
    <td>{{$fromacc->branchname}}</td>
    <td><strong>PAYMENT REMARKS</strong></td>
    <td>{{$voucher->paymentremarks}}</td>
  </tr>
  
</table>
@endif

@if($voucher->status=='PAID' && $voucher->paymenttype=='CASH')
<table class="table">
  <tr class="bg-navy">
    <td class="text-center">CASH PAYMENT DETAILS</td>
    
  </tr>
  
</table>
<table class="table">
  <tr>
    <td><strong>PAYMENT TYPE</strong></td>
    <td>{{$voucher->paymenttype}}</td>
    <td><strong>PAYMENT REMARKS</strong></td>
    <td>{{$voucher->paymentremarks}}</td>
  </tr>
  
</table>
@endif
@if($voucher->status=='PAID' && $voucher->paymenttype=='CHEQUE')
<table class="table">
  <tr class="bg-navy">
    <td class="text-center">CHEQUE PAYMENT DETAILS</td>
    
  </tr>
  
</table>
<table class="table">
  <tr>
    <td><strong>PAYMENT TYPE</strong></td>
    <td>{{$voucher->paymenttype}}</td>
    <td><strong>PAYMENT REMARKS/CHEQUE DETAILS</strong></td>
    <td>{{$voucher->paymentremarks}}</td>
  </tr>
  
</table>
@endif







@endsection