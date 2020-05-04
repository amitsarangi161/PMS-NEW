@inject('provider', 'App\Http\Controllers\AccountController')
   
<!DOCTYPE html>
<html>
<head>
  <title>&nbsp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <style type="text/css">
    th{font-size: 12px;}
    td{font-size: 11px;}
      td.blank{border:0!important;}
      .logo{width:100px;height:78px;margin-bottom:40px;}
      tr.noborder th {
        border: 0px solid!important;
      }
    
      .text_right{text-align: right;}
.mr-140{margin-top: -140px;}
.mr-100{margin-top: 100px;}
 @media print {
  a[href]:after {
    content: " (" attr(href) ")";
  }
}
.details th{padding-bottom:0px!important;}
td{padding: 6px!important;
}
th{padding: 7px!important;
line-height: 1!important;}
.details th{font-size:10px;}
@page  
{ 
    size: auto;   /* auto is the initial value */ 

    /* this affects the margin in the printer settings */ 
    /*margin-top: 40mm; */
} 
/*.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {*/
/*    border: 1px solid #0000007d!important;*/
/*}*/

body  
{ 
    /* this affects the margin on the content before sending to printer */ 
    margin: 0px;  
} 

    body{
      background: white;
    }

    @page  { 
      @bottom-left { 
        content: 'Kisten Übersicht 10-06-2015 14:51:59';
        /*font-size: 10px;*/
      }

      @bottom-right { 
        content: counter(page) " of " counter(pages);
        /*font-size: 10px;*/
      } 
    }
   

    table { page-break-inside:auto; }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }

@media print
{
  table { page-break-after:auto }
  tr    { page-break-inside:avoid; page-break-after:auto }
  .tbody1{ page-break-inside:avoid; page-break-after:auto }
  .dts{ page-break-inside:avoid; page-break-after:auto }
  td    { page-break-inside:avoid; page-break-after:auto }
  thead { display:table-header-group }
  tfoot { display:table-footer-group }
}
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
.invoice{font-size:18px!important;font-weight:bold;font-family:Times New Roman;}
   .noborder1 th {
        border: 0px!important;
      }

@import url(https://fonts.googleapis.com/css?family=Denk+One);
@import url(https://fonts.googleapis.com/css?family=Arimo);



.rotingtxt{
  -webkit-transform: rotate(331deg);
  -moz-transform: rotate(331deg);
  -o-transform: rotate(331deg);
  transform: rotate(331deg);
  font-size: 9em;
  color: rgba(255, 5, 5, 0.17);
  font-family: 'Denk One', sans-serif;
  text-transform:uppercase;
  padding-top: 450px;
  opacity: .1;
  padding-left: 70px;
 

}


@media all {
  .rotingtxt {
    display: none;
    float: right;
  }

}

@media print {
  .rotingtxt {
    display: block;
  }

}

</style>

</head>
  <body>
<div style="position: fixed;" class="rotingtxt">{{$billheader->company}}</div>

<div class="container">
   
    <input type = "button" class="btn btn-success no-print pull-right" value = "Submit & Print" onclick ="printpage()" />


    <a href="/editbills/{{$billheader->id}}" class="btn btn-warning no-print">EDIT</a>
  <table class="table table-bordered table-striped" style="border-bottom:0px;">
      <thead>
          <tr class="noborder1">
               @php
    $source =$billheader->invoicedate;
    $date = new DateTime($source);
    $idate=$date->format('d-m-Y');
             @endphp
              <th class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="top:0;">
              <p style="font-size:20;font-weight: bold;top: 0;">Invoice No: {{$billheader->fullinvno}}</p>
              <p style="font-size:20;font-weight: bold;margin-bottom: 83px;">Invoice Date: 
              @if($billheader->invoicedate!='')
              {{$idate}}
              @endif
            </p>
            </th>
              <th class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="top:0;">
              <p class="text-center invoice" style="margin-bottom:100px;">
              @if($billheader->fullinvno!='')
              TAX INVOICE
              @else
              PROFORMA INVOICE
              @endif

            </p>
            </th>
             <th class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="top:0;">
            
              <img src="{{ asset('img/crsetup/'.$crvouchersetup->companylogo) }}" class="pull-right logo">
             

            </th>
          </tr>
      </thead>
  </table>
  <table class="table table-bordered table-striped" style="margin-top: -65px;">
    <tbody>
      <tr class="success">
        <th class="text-center" style="width:50%">Service Provider</th>
        <th class="text-center" style="width:50%">Service Receiver</th>
      </tr>
      <tr>
          <td>
               <p > <b>Name: {{$crvouchersetup->companyname}}</b></p>
            <p><b>Address :{{$crvouchersetup->address}}</b></p>
            @if($crvouchersetup->email!='')
            <p><b>Email :{{$crvouchersetup->email}}
              @endif
              <br>
            @if($crvouchersetup->contactno)
            Contact No :{{$crvouchersetup->contactno}}</b></p>
             @endif
           

               
          </td>
          
          <td>
             <p > <b>Name & Address of the party</b></p>
            <p><b>Name:{{$billheader->clientname}}</b></p>
            <p><b>Address : {{$billheader->address}}</b>
              <br>
              @if($billheader->contactno!='')
                 Contact No :  {{$billheader->contactno}}</p>
              @endif
          </td>
      </tr>
      <tr>
        <td>
          @if($crvouchersetup->panno!='')
          <b>PAN No : {{$crvouchersetup->panno}}</b>
          @endif
       <br>
          @if($crvouchersetup->gstno!='')
          <b>GST No : {{$crvouchersetup->gstno}}</b>
          @endif

        </td>
        <td>
          @if($billheader->panno!='')
          <b>PAN No : {{$billheader->panno}}</b>
          @endif
        <br>
          @if($billheader->gstno!='')
          <b>GST No : {{$billheader->gstno}}</b>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: justify;"><b>Name Of the Work : </b>{{$billheader->nameofthework}}</td>
      </tr>
      @if($billheader->refno!='' || $billheader->refdate!='')
       <tr>
        <td colspan="1">
          @if($billheader->refno!='')
          <strong>REFERENCE NO:</strong> {{$billheader->refno}}
          @endif
        </td>
        <td colspan="1">
          @if($billheader->refdate!='')
                        @php
    $source1 =$billheader->refdate;
    $date1 = new DateTime($source1);
    $bdate=$date1->format('d-m-Y');
             @endphp
          <strong>DATE: </strong> {{$bdate}}
          @endif
        </td>
       </tr>
       @endif

      <tr><td colspan="2"></td></tr>
    </tbody>
  </table>

  <table class="table table-bordered" style="margin-top: -21px;">
    <thead>
      <tr>
          <th>Sl. No.</th>
          <th>Details</th>
          <th>HSN/SAC</th>
          <th>Unit</th>
          <th>Rate (Rs.)</th>
          <th>Qty.</th>
          <th>Amount</th>
        </tr>
        @foreach($billitems as $key=>$billitem)
        <tr>
          <td>{{$billitem->slno}}</td>
        <td style="text-align: justify;">{{$billitem->workdetails}}</td>
        <td style="text-align: center;">{{$billitem->hsn}}</td>
        <td style="text-align: center;">{{$billitem->unitname}}</td>
        <td style="text-align: right;">{{ $provider::moneyFormatIndia($billitem->rate)}}</td>
        <td>{{number_format((float)$billitem->quantity, 3, '.', '')}}</td>
        <td style="text-align: right;">{{ $provider::moneyFormatIndia($billitem->amount)}}</td>
        </tr>
       
      
        @endforeach


        @php
               if($billheader->discount!=0)
               {
                   $dis=2;
               }
               else
               {
                $dis=0;
               }
               if($billheader->claimedrate!=100)
               {
                  $clm=1;
               }
               else
               {
                   $clm=0;
               }


               $col=$dis+$clm;

               if($billheader->cgstrate!='')
               {
                 $gstcount=1;
               }
               else
               {
                 $gstcount=2;
               }

        @endphp 
        <tr class="dts">
          <td colspan="3" rowspan="{{(5+$col)-$gstcount}}"></td>
          <td colspan="3" class="text-right">Total</td>
           <td style="text-align: right;">{{ $provider::moneyFormatIndia($billheader->total)}}</td>
        </tr>
        @if($billheader->discount!=0)
        <tr>
          <td colspan="3" class="text_right">{{$billheader->discountname}} @ {{abs($billheader->discount)}} % 
               @if($billheader->discount>0)
          (+)
          @else
          (-)

          @endif


        </td>
            <td style="text-align: right;">{{ $provider::moneyFormatIndia(abs($billheader->discountvalue))}}</td>
        </tr>

          <tr>
          <td colspan="3" class="text_right">SUB TOTAL </td>
           <td style="text-align: right;">{{ $provider::moneyFormatIndia($billheader->total+$billheader->discountvalue)}}</td>
          </tr>
      
        @endif
        @if($billheader->claimedrate!=100)
        <tr>
          <td colspan="3" class="text_right">Claimed in the bill ( {{ number_format((float)$billheader->claimedrate, 2, '.', '')}} %) as per work order.</td>
           <td style="text-align: right;">{{ $provider::moneyFormatIndia($billheader->claimedvalue)}}</td>
        </tr>
      
        @endif
            @if($billheader->cgstrate!='')
        <tr>
          <td colspan="3" class="text_right">Add CGST @ {{$billheader->cgstrate}} %</td>
                <td style="text-align: right;">{{ $provider::moneyFormatIndia($billheader->cgstvalue)}}</td>

        </tr>
        <tr>
          <td colspan="3" class="text_right">Add SGST @ {{$billheader->sgstrate}} %</td>
          
          <td style="text-align: right;">{{ $provider::moneyFormatIndia($billheader->sgstvalue)}}</td>
        </tr>

            @else

        <tr>
          <td colspan="3" class="text_right">Add IGST @ {{$billheader->igstrate}} %</td>
          <td style="text-align: right;">{{ $provider::moneyFormatIndia($billheader->igstvalue)}}</td>
        </tr>
        @endif
          <tr>
          <td colspan="3" class="text_right">Total Payable</td>
          
          <td style="text-align: right;">{{ $provider::moneyFormatIndia($billheader->totalpayable)}}</td>
        </tr>

        <tr>
          <td colspan="3" class="text-center">Total Invoice Amount In words</td>
          <td colspan="3" class="text_right">Advance Payment Recived </td>
          
          <td style="text-align: right;">{{ $provider::moneyFormatIndia($billheader->advancepayment)}}</td>
          
        </tr>
        

        <tr class="success">
          <th colspan="3" class="text-center" style="text-transform: capitalize;">{{$amountinword}} Only.</th>
          <th colspan="3" class="text_right">Net payble</th>
        
          <th style="text-align: right;"> {{ $provider::moneyFormatIndia($billheader->netpayable)}}</th>
        </tr>
    </thead>
  </table>

  <table class="table table-bordered tbody1" style="margin-top: -21px;">
    <tbody class="details">
      <tr>
        <th style="width: 50%"><u>Bank Details</u></th>
        <th style="width: 20%"><p class="text-center">Common Seal</p></th>
        <th rowspan="5" style="width: 30%"><p class="text-center">
          For @if($billheader->company=='SA')
              Subudhi Associates.
              @elseif($billheader->company=='STEPL')
              Subudhi Technoengineers (P)Ltd.
              @else
              ST Engineering & Consultancy Service (P)Ltd.
              @endif
           </p>
          <p class="text-center mr-100">Authorised Signatory</p></th>
      </tr>
  @if($bankdetails)
      <tr>
        <th>Account No : {{$bankdetails->acno}}</th>
        <th rowspan="4"></th>
      </tr>
      <tr>
        <th>Bank Name : {{$bankdetails->bankname}}</th>
        
      </tr>
      <tr>
        <th>Branch : {{$bankdetails->branchname}}</th>
        
      </tr>
      <tr>
        <th>IFSC Code : {{$bankdetails->ifsccode}}</th>
      </tr>
  @endif
      <tr>
        <td colspan="3">
          <u>Note:</u>
          <p>1. Please issue Cheque/Draft in favour  of <b>"{{$crvouchersetup->draftdetails}}"</b>.</p>
          
        </td>
      </tr>

    </tbody>
  </table>
</div>
  
  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
  function printpage()
  {

window.print();

  }
</script>
  </body>
</html>