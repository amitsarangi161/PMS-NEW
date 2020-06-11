@extends('layouts.account')

@section('content')
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VIEW PENDING ACCOUNTVERIFICATION DEBIT VOUCHER</td>
		
	</tr>
	
</table>

<div class="well">
	<table class="table">
		<tr>
			<td width="20%"><strong>ID :</strong></td>
			<td width="30%">#{{$pmsdebitvoucher->id}}</td>
			<td width="20%"><strong>VENDOR :</strong></td>
			<td width="30%"><button type="button" class="btn btn-success" onclick="openvendordetails('{{$vendor->id}}','{{$vendor->vendorname}}','{{$vendor->mobile}}','{{$vendor->bankname}}','{{$vendor->acno}}','{{$vendor->branchname}}','{{$vendor->ifsccode}}','{{trim(preg_replace('/\s+/', ' ',$vendor->details))}}','{{$vendor->photo}}','{{$vendor->vendoridproof}}')">{{$pmsdebitvoucher->vendorname}}</button></td>
		</tr>
		<tr>
	      <td width="10%"><strong>FOR PROJECT :</strong></td>
	      <td width="40%">{{$pmsdebitvoucher->projectname}}</td>
	      <td width="10%"><strong>EXPENSE HEAD:</strong></td>
	      <td width="40%">{{$pmsdebitvoucher->expenseheadname}}</td>
	    </tr>
		<tr>
			<td width="20%"><strong>BILL DATE :</strong></td>
			<td width="30%">{{$pmsdebitvoucher->billdate}}</td>
			<td width="20%"><strong>BILL NO :</strong></td>
			<td width="30%">{{$pmsdebitvoucher->billno}}</td>
		</tr>
		<tr>
			<td width="20%"><strong>BILL TYPE :</strong></td>
			<td width="30%">{{$pmsdebitvoucher->billtype}}</td>
			<td width="20%"><strong>CREATED AT  :</strong></td>
			<td width="30%">{{$pmsdebitvoucher->created_at}}</td>
		</tr>
		<tr>
			<td width="20%"></td>
			<td width="30%"></td>
			<td width="20%"><strong>STATUS :</strong></td>
			<td width="30%"><span class="label label-warning">{{$pmsdebitvoucher->status}}</span></td>
		</tr>

		
	</table>
	
</div>

<div class="box box-info collapsed-box">
<table class="table table-responsive table-hover table-bordered table-striped box-tools">
	<tr class="bg-blue">
		<td class="text-center">PREVEOUS BILL<i class="btn btn-box-tool pull-right" data-widget="collapse"> <i class="fa fa-plus"></i></td>

	</tr>
	
</table>


<div class="table-responsive box-body">
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
			<tr class="bg-navy">
		    <td>BILL NO.</td>
    	    <td>VENDOR NAME</td>
			<td>FOR PROJECT</td>
			<td>EXPENSE HEAD</td>
			<td>BILL TYPE</td>
			<td>BILL DATE</td>
			<td>BILL NO.</td>
			<td>TOTAL MRP</td>
			<td>TOTAL DISCOUNT</td>
			<td>TOTAL SGST</td>
			<td>TOTAL CGST</td>
			<td>TOTAL IGST</td>
			<td>TOTAL AMOUNT</td>
			<td>IT DEDUCTION</td>
			<td>OTHER DEDUCTION</td>
			<td>FINAL PRICE</td>
           </tr>
	</thead>
	<tbody>
		@foreach($previousbills as $previousbill)
		<tr>
			<td><a href="/viewpendingaccountdr/{{$previousbill->id}}"  class="btn btn-primary">{{$previousbill->id}}</a></td>
			<td>{{$previousbill->vendorname}}</td>
			<td>{{$previousbill->projectname}}</td>
			<td>{{$previousbill->expenseheadname}}</td>
			<td>{{$previousbill->billtype}}</td>
			<td>{{$previousbill->billdate}}</td>
			<td>{{$previousbill->billno}}</td>
			<td>{{$previousbill->tprice}}</td>
			<td>{{$previousbill->discount}}</td>
			<td>{{$previousbill->tsgst}}</td>
			<td>{{$previousbill->tcgst}}</td>
			<td>{{$previousbill->tigst}}</td>
			<td>{{$previousbill->totalamt}}</td>
			<td>{{$previousbill->itdeduction}}</td>
			<td>{{$previousbill->otherdeduction}}</td>
			<td>{{$previousbill->finalamount}}</td>
		</tr>
		@endforeach
		
	</tbody>
</table>
</div>
</div>

<div class="box box-info collapsed-box">
<table class="table table-responsive table-hover table-bordered table-striped box-tools">
	<tr class="bg-blue">
		<td class="text-center">PREVEOUS BILL PAYMENTS<i class="btn btn-box-tool pull-right" data-widget="collapse"> <i class="fa fa-plus"></i></td>

	</tr>
	
</table>


<div class="table-responsive box-body">
<table class="table table-responsive table-hover table-bordered table-striped">
	<thead>
			<tr class="bg-navy">
		    <td>SL NO.</td>
			<td>AMOUNT</td>
			<td>PAYMENT DATE</td>
			<td>PAYMENT STATUS</td>
           </tr>
	</thead>
	<tbody>

		@foreach($debitvoucherpayments as $debitvoucherpayment)
		<tr>
			<td>{{$debitvoucherpayment->id}}</td>
			<td>{{$debitvoucherpayment->amount}}</td>
			<td>{{$debitvoucherpayment->dateofpayment}}</td>
			<td>{{$debitvoucherpayment->paymentstatus}}</td>
		</tr>
		@endforeach
		
	</tbody>
</table>
</div>
</div>





<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td class="text-center">AMOUNT DETAILS</td>
	</tr>
	
</table>

<form action="/pmsapprovedebitvouchermgr/{{$pmsdebitvoucher->id}}" method="post">

	{{csrf_field()}}
<table class="table">
	    	<tr>
	    		<td><strong>Total MRP</strong></td>
	    		<td><input type="text" id="tprice" value="{{$pmsdebitvoucher->tprice}}" name="tprice" id="tprice" class="form-control calc" required="" autocomplete="off"></td>
	    		<td><strong>Total Discount</strong></td>
	    		@if($pmsdebitvoucher->discount=='')
	    		<td><input type="text" value="0.00" class="form-control calc" id="discount" name="discount" autocomplete="off"></td>
	    		@else
	    		<td><input type="text" value="{{$pmsdebitvoucher->discount}}" class="form-control calc" id="discount" name="discount" autocomplete="off"></td>
	    		@endif
	    	</tr>

	    	<tr>
	    		<td><strong>Total SGST</strong></td>
	    		<td><input type="text" value="{{$pmsdebitvoucher->tsgst}}" class="form-control calc" id="tsgst" name="tsgst" autocomplete="off"></td>
	    		<td><strong>Total CGST</strong></td>
	    		<td><input type="text" value="{{$pmsdebitvoucher->tcgst}}" class="form-control calc" id="tcgst" name="tcgst" autocomplete="off"></td>
	    	</tr>
	    		<tr>
	    		<td><strong>Total IGST</strong></td>
	    		<td><input type="text" value="{{$pmsdebitvoucher->tigst}}" class="form-control calc" id="tigst" name="tigst" autocomplete="off"></td>
	    		<td><strong>Total Amount</strong></td>
	    		<td><input type="text" value="{{$pmsdebitvoucher->totalamt}}" class="form-control" id="totalamt" name="totalamt" readonly="" required=""></td>
	    		
	    	 </tr>
	    	 <tr>
	    		<td><strong>IT Deduction(in %)</strong></td>
	    		<td><input type="text" class="form-control dedcalc" id="itdeduction" value="{{$pmsdebitvoucher->itdeduction}}" name="itdeduction" autocomplete="off"  value="0"></td>
	    		<td><strong>OTHER DEDUCTION(in %)</strong></td>
	    		<td><input type="text" class="form-control dedcalc" value="{{$pmsdebitvoucher->otherdeduction}}" id="otherdeduction" autocomplete="off" name="otherdeduction" value="0"></td>
	    	</tr>
	    	
	    	 <tr>
	    	 	<td><strong>Final Price</strong></td>
	    		<td><input type="text" class="form-control" value="{{$pmsdebitvoucher->finalamount}}" id="finalamount" name="finalamount" readonly="" required=""></td> 
	    		<td><strong>Attach a invoice copy</strong></td>

	    	 	<td>
           <a href="{{asset('img/createdebitvoucher/'.$pmsdebitvoucher->invoicecopy)}}" target="_blank">
          		<img style="height:90px;width:90px;" src="{{asset('img/createdebitvoucher/'.$pmsdebitvoucher->invoicecopy)}}" alt="noimage" id="imgshow">
          	</a>
          	  <a href="{{asset('img/debitvoucher/'.$pmsdebitvoucher->invoicecopy)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a>
               </td>
	    	 </tr>
	    	    <!-- <tr style="visibility:hidden;">
	    		<td><strong>Approval Amount</strong></td>
	    		<td><input type="text" class="form-control" value="{{$pmsdebitvoucher->finalamount}}" id="approvalamount" name="approvalamount" required=""></td> 
	    		
	    	  </tr> -->
	</table>
	
<table class="table table-responsive">
	<tr>
		<p class="alert alert-danger" style="text-align: center;font-weight: bold;font-size: 20px;" hidden="" id="errormsg"></p>
		<td ><button type="submit" id="submitbtn" class="btn btn-success pull-right btn-lg" onclick="return confirm('Do You Want to Proceed?')">VERIFIED</button></td>
	</tr>
</table>
</form>
</div>
<div id="vendormodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><strong>VENDOR DETAILS</strong></h4>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td><strong>VENDOR ID#</strong></td>
            <td><strong id="vendorid1"></strong></td>
            <td><strong>VENDOR NAME</strong></td>
            <td><strong id="vendorname1"></strong></td>
          </tr>
          <tr>
            <td><strong>VENDOR MOBILE</strong></td>
            <td><strong id="vendormobile1"></strong></td>
            <td><strong>BANK NAME</strong></td>
            <td><strong id="bankname1"></strong></td>
          </tr>
          <tr>
            <td><strong>AC NO</strong></td>
            <td><strong id="acno1"></strong></td>
            <td><strong>BRANCH NAME</strong></td>
            <td><strong id="branchname1"></strong></td>
          </tr>
          <tr>
            <td><strong>IFSC CODE</strong></td>
            <td><strong id="ifsccode1"></strong></td>
            <td><strong>DETAILS</strong></td>
            <td><strong id="details1"></strong></td>
            
          </tr>
          <tr>
            <td><strong>PHOTO</strong></td>
            <td id="photo1"></td>
            <td><strong>ID PROOF</strong></td>
            <td id="idproof1"></td>
          </tr>
          
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	function openvendordetails(vendorid,vendorname,mobile,bankname,acno,branchname,ifsccode,details,photo,vendoridproof)
   {

        

             $("#vendorid1").html(vendorid);
             $("#vendorname1").html(vendorname);
             $("#vendormobile1").html(mobile);
             $("#bankname1").html(bankname);
             $("#acno1").html(acno);

             $("#branchname1").html(branchname);
             $("#ifsccode1").html(ifsccode);
             $("#details1").html(details);
             $("#photo1").html('<a href="/img/vendor/'+photo+'" target="_blank"><img src="/img/vendor/'+photo+'" style="height:70px;width:95px;" alt="click to view"></a>');

             $("#idproof1").html('<a href="/img/vendor/'+vendoridproof+'" target="_blank"><img src="/img/vendor/'+vendoridproof+'" style="height:70px;width:95px;" alt="click to view"></a>');

             $("#vendormodal").modal('show');
   }

   function calcu()
  {
     

    var tprice=$("#tprice").val();
         if(tprice=='') {
           gtprice = 0;
          }
          else
          {
            gtprice=tprice;
          }
    var discount=$("#discount").val();
           if(discount=='') {
           gdiscount = 0;
          }
          else
          {
            gdiscount=discount;
          }

    var tsgst=$("#tsgst").val();
    if(tsgst=='') {
           gtsgst = 0;
          }
          else
          {
            gtsgst=tsgst;
          }

           var tcgst=$("#tcgst").val();
        if(tcgst=='') {
           gtcgst = 0;
          }
          else
          {
            gtcgst=tcgst;
          }

           var tigst=$("#tigst").val();
        if(tigst=='') {
           gtigst = 0;
          }
          else
          {
            gtigst=tigst;
          }

      
      var totalamt=Number.parseFloat((parseFloat(gtprice)-parseFloat(gdiscount))+(parseFloat(gtcgst)+parseFloat(gtsgst)+parseFloat(gtigst))).toFixed(2);

      $("#totalamt").val(totalamt);
      $("#finalamount").val(totalamt);
  }
	
  $( ".calc" ).on("change paste keyup", function() {

   calcu();

  
});

  $( ".dedcalc" ).on("change paste keyup", function() {

        var itdeduction=$("#itdeduction").val();
        if(itdeduction=='') {
           gitdeduction = 0;

          }
          else
          {
            gitdeduction=itdeduction;
          }

         var otherdeduction=$("#otherdeduction").val();
          if(otherdeduction=='') {
           gotherdeduction = 0;

          }
          else
          {
            gotherdeduction=otherdeduction;
          }
          var subtot=$("#totalamt").val();

          var itdedamt=parseFloat(subtot)*(parseFloat(gitdeduction/100));
          var otheramt=parseFloat(subtot)*(parseFloat(gotherdeduction/100));

          var final=Number.parseFloat(parseFloat(subtot)-(parseFloat(itdedamt)+parseFloat(otheramt))).toFixed(2);

          $("#finalamount").val(final);


          

  });


</script>


@endsection