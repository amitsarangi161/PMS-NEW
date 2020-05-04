@extends('layouts.account')
@section('content')
<style type="text/css">
	tfoot tr td{
		 border: 0px;
	}
</style>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">CREATE CREDIT VOUCHER</td>
		
	</tr>
	
</table>

<form action="/saveascreditvoucher/{{$billheader->id}}" method="post">
	{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td colspan="4" class="text-center"><strong>CLIENT DETAILS</strong></td>
		
	</tr>

	<tr>
		<td width="15%"><strong>NAME OF THE WORK</strong></td>
		<td width="35%">
			<input type="hidden" name="projectid" id="projectid" value="{{$billheader->projectid}}">
       
         <textarea name="nameofthework"  placeholder="Work Name" id="now" class="form-control" readonly="">{{$billheader->nameofthework}}</textarea>

		 </td>
		<td width="15%"><strong>ADDRESS:</strong></td>
		<td width="35%"><textarea name="address" id="address" class="form-control" placeholder="Enter Address Here" readonly="" required="">{{$billheader->address}}</textarea></td>
	</tr>
		<tr>
		<td width="15%"><strong>CLIENT NAME:</strong></td>
		<td width="35%"><input type="text" name="clientname" id="clientname" placeholder="Enter Client Name Here" readonly="" class="form-control" value="{{$billheader->clientname}}" required=""></td>
		<td width="15%"><strong>CLIENT EMAIL:</strong></td>
		<td width="35%"><input type="email" readonly="" value="{{$billheader->email}}" name="email" id="email" class="form-control" placeholder="Enter Client Email Here"></td>
	</tr>
	<tr>
		<td width="15%"><strong>GST NO:</strong></td>
		<td width="35%"><input type="text" value="{{$billheader->gstno}}" name="gstno" id="gstno" class="form-control" readonly="" placeholder="Enter GST no Here"></td>
		<td width="15%"><strong>PAN NO:</strong></td>
		<td width="35%"><input type="text" value="{{$billheader->panno}}" name="panno" id="panno" class="form-control" readonly="" placeholder="Enter PAN no Here"></td>
	</tr>
	<tr>
		<td width="15%"><strong>CONTACT NO:</strong></td>
		<td width="35%"><input type="text" name="contactno" id="contactno" class="form-control" value="{{$billheader->contactno}}" readonly="" placeholder="Enter Contact No Here"></td>
		<td width="15%"><strong>FAX:</strong></td>
		<td width="35%"><input type="text" name="fax" value="{{$billheader->fax}}" class="form-control" placeholder="Enter FAX No Here" readonly=""></td>
	</tr>

	<tr>
		<td width="15%"><strong>INVOICE NO:</strong></td>
		<td width="35%"><input type="text" name="invno" id="invno" class="form-control" value="{{$billheader->fullinvno}}" readonly=""></td>
		<td width="15%"><strong>INVOICE DATE:</strong></td>
		<td width="35%"><input type="text" name="invdate" value="{{$billheader->invoicedate}}" class="form-control" readonly=""></td>
	</tr>

	<tr>
	   
		<td width="15%"><strong>BILL FROM(STEPL/SA)</strong></td>
		<td width="35%">
			<!-- <select name="company" required="" class="form-control">
				<option value="">Select a Company</option>
				<option value="SA" {{ ( $billheader->company == 'SA') ? 'selected' : '' }}>SA</option>
				<option value="STEPL" {{ ( $billheader->company == 'STEPL') ? 'selected' : '' }}>STEPL</option>
				<option value="STECS" {{ ( $billheader->company == 'STECS') ? 'selected' : '' }}>STECS</option>
		    </select> -->
		    <input type="text" class="form-control" name="company" readonly="" value="{{$billheader->company}}">
	</td>
	</tr>
	
</table>
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
	<td class="text-center"><strong>PRICING DETAILS</strong></td>
	</tr>
</table>

<table class="table table-striped table-bordered" >
		<thead class="bg-navy">
		  <tr style="border:1px,solid,#000;">
		  	<td>SL_NO</td>
			<td>WORK DETAILS</td>
			<td>HSN/SAC</td>
			<td>UNIT</td>
            <td>RATE</td>
            <td>QTY</td>
			<td>AMOUNT</td>
			<td>ADD</td>
		  </tr>
		</thead>
			<tbody class="authorslist">
			<tr>
		     <td><input type="text" id="slno" placeholder="Serial No" class="form-control"></td>
			 <td><textarea class="form-control" id="workdetails" placeholder="Enter work Details Here"></textarea></td>
			 <td>
			 	<select class="form-control" id="hsn">
			 		<option value="">select a HSN Code</option>

			 		@foreach($hsncodes as $hsncode)
			 		<option value="{{$hsncode->hsncode}}">{{$hsncode->hsncode}}</option>
                    @endforeach			 		
			 	</select>
			 </td>
			 <td>
			 	<select class="form-control" id="unit">
			 		<option value="">Select a Unit</option>
			 		@foreach($units as $unit)
                      <option value="{{$unit->id}}">{{$unit->unitname}}</option>
			 		@endforeach
			 	</select>
			 </td>
			 <td><input type="text" id="rate" class="form-control cal"></td>
			 <td><input type="text" id="qty" class="form-control cal"></td>
			 <td><input type="text" id="amount" class="form-control" readonly=""></td>
			  <td><button type="button" id="addnew" disabled="" class="addauthor btn btn-primary">ADD</button></td>

			
		    </tr>
	    </tbody>	
	</table>
	<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
	<td class="text-center"><strong>ADDED ITEMS</strong></td>
	</tr>
    </table>

    <table class="table table-responsive table-hover table-bordered table-striped">
    	<thead>

    		<tr class="bg-primary">
            <td class="col-md-1">SL_NO</td>
    		<td class="col-md-5">WORK DETAILS</td>
			<td class="col-md-1">HSN/SAC</td>
			<td class="col-md-1">UNIT</td>
            <td class="col-md-1">RATE</td>
            <td class="col-md-1">QTY</td>
			<td class="col-md-1">AMOUNT</td>
			<td class="col-md-1">REMOVE</td>
          
           </tr>
    	</thead>
       <tbody class="addnewrow">
       	@foreach($billitems as $billitem)
       	  <td class="col-md-1">{{$billitem->slno}}<input type="hidden" name="slno[]" value="{{$billitem->slno}}"></td>
          <td class="col-md-5">{{$billitem->workdetails}}<input type="hidden" name="workdetails[]" value="{{$billitem->workdetails}}"></td>
    	  <td class="col-md-1">{{$billitem->hsn}}<input type="hidden" name="hsn[]"value="{{$billitem->hsn}}"/></td>
    	  <td class="col-md-1">{{$billitem->unitname}}<input type="hidden" name="unit[]" value="{{$billitem->unit}}"/></td>
          <td class="col-md-1">{{$billitem->rate}}<input type="hidden" name="rate[]" value="{{$billitem->rate}}" class="cal"/></td>
          <td class="col-md-1">{{$billitem->quantity}}<input type="hidden" name="qty[]" value="{{$billitem->quantity}}" class="cal"/></td>
    	  <td class="col-md-1">{{$billitem->amount}}<input type="hidden" name="amount[]" class="countable" value="{{$billitem->amount}}" class="calcin"/></td>

    	  <td><button type="button" disabled="" class="btn btn-danger remove_field">X</button></td></tr>
           

        @endforeach							 
	    </tbody>	
</table>
	    <table class="table" style="background-color: cornsilk;">
	    	<thead>
	    	<tr></tr>
	    	<tr>
	    		
                <td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>TOTAL</strong></td>
	    		<td></td>
	    		<td><input type="text" id="totalamt" value="{{$billheader->total}}" name="total" class="form-control" readonly=""></td>
	    	</tr>
	    		<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td>
	    			<select name="discounttype" id="discounttype" onchange="chkdiscount()" class="form-control">
	    				<option value="">TENDER PREMIUM</option>
	    				@foreach($discounts as $discount)
                         <option value="{{$discount->id}}" {{ ( $billheader->discounttype == $discount->id) ? 'selected' : '' }}>{{$discount->discountname}}</option>
	    				@endforeach
	    			
	    	        </select>
	    	           <p style="color: red;">*<b>Note:for discount use -(ex: -20)</b></p>
	    	</td>
	    		<td><input type="text" value="{{$billheader->discount}}" id="discount" name="discount" class="form-control calulate" autocomplete="off" {{ ( $billheader->discount > 0) ? '' : 'readonly' }}></td>
	    		<td><input type="text" id="discountvalue" value="{{$billheader->discountvalue}}" name="discountvalue" class="form-control" readonly=""></td>
	    		
	    	</tr>

	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>CLAIMED AMOUNT(in %)</strong></td>
	    		<td><input type="text" value="{{$billheader->claimedrate}}" id="claimedrate" name="claimedrate" class="form-control calulate" autocomplete="off"></td>
	    		<td><input type="text" id="claimedvalue" value="{{$billheader->claimedvalue}}" name="claimedvalue" class="form-control" readonly=""></td>
	    		
	    	</tr>

	    		<tr style="background-color: #a9e9a9;">
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td>
	    		<select id="deduction" class="form-control select2" onchange="deductioncal();">
	    				<option value="">Select Deduction Defination</option>
	    				 @foreach($deductiondefinations as $deductiondefination)
                          <option value="{{$deductiondefination->id}}">{{$deductiondefination->deductionname}}</option>
	    				 @endforeach
	    			</select>
	    		</td>
	    		<td>
	    			<input type="text" id="deductionrate" autocomplete="off" class="form-control deduct" readonly="">
	    		</td>

	    		<td>
                    <input type="text" id="deductionvalue" class="form-control" readonly="">
	    			<button type="button" id="addnew1" class="addauthor btn btn-primary">ADD</button>
	    		</td>

	    	</tr>
            </thead>
            <tbody class="addnewrow1" style="background-color: #fff;">
            	
            </tbody>
	    	<tr>
	    		<td><input type="hidden" id="totdeduct" value="{{$billheader->totaldeduction}}" name="totdeduct"></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>CGST RATE(in %)</strong></td>
	    		<td><input type="text" value="{{$billheader->cgstrate}}" id="cgstrate" name="cgstrate" class="form-control calulate cgstchng" autocomplete="off"></td>
	    		<td><input type="text" value="{{$billheader->cgstvalue}}" id="cgstvalue" name="cgstvalue" class="form-control" readonly=""></td>
	    		
	    	</tr>
	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>SGST RATE(in %)</strong></td>
	    		<td><input type="text" value="{{$billheader->sgstrate}}" id="sgstrate" name="sgstrate" class="form-control calulate sgstchng" autocomplete="off"></td>
	    		<td><input type="text" id="sgstvalue" value="{{$billheader->sgstvalue}}" name="sgstvalue" class="form-control" readonly=""></td>
	    		
	    	</tr>
	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>IGST RATE(in %)</strong></td>
	    		<td><input type="text" value="{{$billheader->igstrate}}" id="igstrate" name="igstrate" class="form-control calulate igstchng" autocomplete="off"></td>
	    		<td><input type="text" id="igstvalue" value="{{$billheader->igstvalue}}" name="igstvalue" class="form-control" readonly=""></td>
	    		
	    	 </tr>
	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>TOTAL PAYABLE AMOUNT</strong></td>
	    		<td></td>
	    		<td><input type="text" id="totalpayble" value="{{$billheader->totalpayable}}" name="totalpayable" class="form-control calulate" readonly=""></td>
	    		
	    	 </tr>
	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>ADVANCE PAYMENT RECIVED(Rs.)</strong></td>
	    		<td></td>
	    		<td><input type="text" id="advancepayment" value="{{$billheader->advancepayment}}" name="advancepayment" class="form-control calulate"></td>
	    		
	    	 </tr>
	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>NET PAYABLE</strong></td>
	    		<td></td>
	    		<td><input type="text" id="netpayable" value="{{$billheader->netpayable}}" readonly="" name="netpayable" class="form-control"></td>
	    		
	    		
	    	</tr>
	  		
    </table>
    <table class="table">
    	<tr class="bg-blue">
    		<td class="text-center"><strong>RECIVED PAYMENT DETAILS</strong></td>
    	</tr>
    	
    </table>
    <table class="table">
    	<tr>
    		<td><strong>AMOUNT CREDITED IN ACCOUNT</strong></td>
    		<td>
    			<select name="creditedinacc" class="form-control">
    				<option value="">Select A Bank Account</option>
    				<option value="CASH">CASH</option>
    				@foreach($bankaccounts as $bankaccount)
    				<option value="{{$bankaccount->id}}">{{$bankaccount->bankname}}(AC No:-{{$bankaccount->acno}} )</option>
    				@endforeach
    			</select>
    		</td>
    		<td><strong>CREDITED AMOUNT</strong></td>
    		<td><input type="text" name="creditedamt" class="form-control" placeholder="Credited Amount"></td>
    	</tr>
    	<tr>
    		<td><strong>CREDITED DATE</strong></td>
    		<td><input type="text" class="form-control datepicker readonly" name="crediteddate"></td>
    		<td><strong>BANK DEDUCTION CHARGES</strong></td>
    		<td><input type="text" name="deductioncrg" class="form-control" placeholder="Enter Bank Deduction Charges"></td>
    	</tr>
    	<td><strong>NOTES</strong></td>
    	<td><textarea class="form-control" name="notes"></textarea></td>
    	
    </table>

    <table class="table">
    	<tr>
    		<td class="pull-right"><button onclick="return confirm('Do you want to Make this bill as CRVOUCHER ?')" type="submit" class="btn btn-success btn-lg">SAVE</button></td>
    	</tr>
    	
    </table>

</form>

    <script type="text/javascript">

   function deductioncal()
   {

   	 var deductionrealvalue=$("#deduction").val();
     var deductiontext=$("#deduction option:selected" ).text();
     if(deductionrealvalue!='')
     {   
         $("#deductionrate").attr('readonly',false);
	  	 $("#deductionvalue").attr('readonly',false);
          $("#deductionrate").val('');
	  	  $("#deductionvalue").val('');
     }
     else
     {
     	 $("#deductionrate").attr('readonly',true);
	  	 $("#deductionvalue").attr('readonly',true);
	  	  $("#deductionrate").val(0);
	  	  $("#deductionvalue").val(0);
     }


   }
$( "#deductionrate" ).on("change paste keyup", function() {
    deductioncalculate();
	
});

$( "#deductionvalue" ).on("change paste keyup", function() {
    deductionratecalculate();
	
});


   function deductioncalculate()
   {


   	var claimedvalue=$("#claimedvalue").val();
	var deductionrate=$("#deductionrate" ).val();
	if(deductionrate!='')
	{
		var deductionvalue=Number.parseFloat(parseFloat(claimedvalue)*(parseFloat(deductionrate)/100)).toFixed(2);
	$("#deductionvalue").val(deductionvalue);
	}
	else
    {
    	 $("#deductionvalue").val('');
    }
	
   }

    function deductionratecalculate()
   {


   	var claimedvalue=$("#claimedvalue").val();
	var deductionrate=$("#deductionrate" ).val();
	var deductionvalue=$("#deductionvalue" ).val();

	if(deductionvalue!='')
	{
		var deductionrate=Number.parseFloat((parseFloat(deductionvalue)/parseFloat(claimedvalue))*100).toFixed(2);
	$("#deductionrate").val(deductionrate);
	}
	else
    {
    	 $("#deductionrate").val('');
    }
	
   }
   jQuery('#addnew1').click(function(event){
       var deductiontext=$( "#deduction option:selected" ).text();
       var deductionval=$("#deduction").val();
       var deductionrate=$("#deductionrate").val();
       var deductionvalue=$("#deductionvalue").val();
	  
	     if(deductionval!='' &&  deductionrate!='' && deductionvalue!='')
	     {
                   


         var newRow1 = jQuery('<tr>'+
	    		
	    		'<td></td>'+
	    		'<td></td>'+
	    		'<td></td>'+
	    		
	    		
	    		'<td><strong>'+deductiontext+' (in %) (-)</strong><input type="hidden" value="'+deductionval+'" name="deductionname[]" class="form-control" readonly></td>'+
	    		'<td><input type="text" name="deductionrate[]" value="'+deductionrate+'" class="form-control" readonly=""></td>'+
	    		 '<td><input type="text" name="deductionvalue[]" value="'+deductionvalue+'" class="form-control countable1" readonly="">'+
	    		   '<button type="button" class="btn btn-danger remove_field1" id="'+counter+'">X</button></td>'+
	    	'</tr>');


    jQuery('.addnewrow1').append(newRow1);
    sumofduration1()
	     }
	     else
	     {
	     	  alert("Deduction rate or value Can't Be Blank or Zero")
	     }
   });
   function chkdiscount()
   {
   	 var discounttype=$("#discounttype").val();
   	  if(discounttype=='')
   	  {
   	  	  $("#discount").attr('readonly',true);
   	  	  $("#discount").val(0);
   	  	  calulate();
   	  }
   	  else
   	  {
   	  	   $("#discount").attr('readonly',false);

   	  }
   }

   function fetchdata()
   {
      var clientname=$("#nameofthework option:selected" ).attr("clientname");
      var address=$("#nameofthework option:selected" ).attr("address");
      var gstno=$("#nameofthework option:selected" ).attr("gstn");
      var panno=$("#nameofthework option:selected" ).attr("panno");
      var contactno=$("#nameofthework option:selected" ).attr("contactno");
      var email=$("#nameofthework option:selected" ).attr("email");
       var projectid=$("#nameofthework option:selected" ).attr("projectid");
       var nameofthework=$("#nameofthework").val();
      $("#clientname").val(clientname);
      $("#address").val(address);
      $("#gstno").val(gstno);
      $("#panno").val(panno);
      $("#contactno").val(contactno);
      $("#email").val(email);
      $("#projectid").val(projectid);
      $("#now").val(nameofthework);
   }


   function calulate()
   {


   	   var totalamt=$("#totalamt").val();
      
      var cgstrate=$("#cgstrate").val();
      if(cgstrate!='')
      {
      	  tcgst=cgstrate;
      }
      else
      {
      	  tcgst=0;
      }
      
      var sgstrate=$("#sgstrate").val();
      if(sgstrate!='')
      {
      	  tsgst=sgstrate;
      }
      else
      {
      	  tsgst=0;
      }

      var igstrate=$("#igstrate").val();
      if(igstrate!='')
      {
      	  tigst=igstrate;
      }
      else
      {
      	  tigst=0;
      }
       var claimedrate=$("#claimedrate").val();
      if(claimedrate!='')
      {
      	  tclaimed=claimedrate;
      }
      else
      {
      	  tclaimed=0;
      }

         var discount=$("#discount").val();
      if(discount!='')
      {
      	  tdiscount=discount;
      }
      else
      {
      	  tdiscount=0;
      }

      var advancepayment=$("#advancepayment").val();
      if(advancepayment!='')
      {
      	  tadvancepayment=advancepayment;
      }
      else
      {
      	  tadvancepayment=0;
      }
      var tdiscountvalue=Number.parseFloat(parseFloat(totalamt)*(parseFloat(tdiscount)/100)).toFixed(2);
      var tclaimedvalue=Number.parseFloat((parseFloat(totalamt)+parseFloat(tdiscountvalue))*(parseFloat(tclaimed)/100)).toFixed(2);

      var tcgstvalue=Number.parseFloat(parseFloat(tclaimedvalue)*(parseFloat(tcgst)/100)).toFixed(2);
      var tsgstvalue=Number.parseFloat(parseFloat(tclaimedvalue)*(parseFloat(tsgst)/100)).toFixed(2);
      var tigstvalue=Number.parseFloat(parseFloat(tclaimedvalue)*(parseFloat(tigst)/100)).toFixed(2);

      $("#discountvalue").val(tdiscountvalue);
      $("#claimedvalue").val(tclaimedvalue);
      $("#cgstvalue").val(tcgstvalue);
      $("#sgstvalue").val(tsgstvalue);
      $("#igstvalue").val(tigstvalue);
      var totdeduct=parseFloat($("#totdeduct").val());

      
      var totalpayble=Number.parseFloat((parseFloat(tclaimedvalue)-totdeduct)+parseFloat(tcgstvalue)+parseFloat(tsgstvalue)+parseFloat(tigstvalue)).toFixed(2);

      $("#totalpayble").val(totalpayble);
      var netpayable=Number.parseFloat(parseFloat(totalpayble)-parseFloat(tadvancepayment)).toFixed(2);
      var roundedamt=Math.round(netpayable)

      var roundedvalue=netpayable-roundedamt;
      //$("#roundedvalue").html(roundedvalue);

      $("#netpayable").val(netpayable);

   }
$( ".calulate" ).on("change paste keyup", function() {
	calulate();
});

$( ".igstchng" ).on("change paste keyup", function() {
	  var igstrate=$("#igstrate").val();
      
	  if(igstrate>0)
	  { 
         
	  	 $("#cgstrate").attr('readonly',true);
	  	 $("#sgstrate").attr('readonly',true);
	  	 $("#cgstrate").val(0);
	  	 $("#sgstrate").val(0);
	    
	  	 calulate();
	  }
	  else
	  {
	  	 $("#cgstrate").attr('readonly',false);
	  	 $("#sgstrate").attr('readonly',false);
	  	 calulate();
	  }
});

$( ".cgstchng" ).on("change paste keyup", function() {
    var cgstrate=$("#cgstrate").val();

    if(cgstrate>0)
    {
    	$("#sgstrate").val(cgstrate);
    	$("#igstrate").val(0);
    	$("#igstrate").attr('readonly',true);
    	 calulate();

    }
    else
    {
    	 $("#sgstrate").val(cgstrate);
    	 $("#igstrate").attr('readonly',false);
    	 calulate();
    }



});	


$( ".cal" ).on("change paste keyup", function() {

var rate1=$("#rate").val();
if($("#qty").val()!='')
{
	var qty1=$("#qty").val();
}
else
{
	var qty1=0;
}

var amt1=parseFloat(rate1)*parseFloat(qty1);

$("#amount").val(amt1);
    
});

var counter = 0;
var gdtotal = 0;
var count=0;
jQuery('#addnew').click(function(event){
   
	var workdetails = jQuery('#workdetails').val();
	var hsn=$("#hsn").val();
	var unitname=$( "#unit option:selected" ).text();
	var unitid = jQuery('#unit').val();
	var rate=$("#rate").val();
	var amount=$("#amount").val();
	var qty=$("#qty").val();
	var slno=$("#slno").val();
  

   
	if(slno!='' && workdetails!='' && unitid!='' && rate!='' && qty!='')
	{
    event.preventDefault();
    counter++;

    var newRow = jQuery('<tr>'+
    	  '<td class="col-md-1">'+slno+'<input type="hidden" name="slno[]" value="'+slno+'"></td>'+
    	 '<td class="col-md-5">'+workdetails+'<input type="hidden" name="workdetails[]" value="'+workdetails+'"></td>'+
    	  '<td class="col-md-1">'+hsn+'<input type="hidden" name="hsn[]"value="'+hsn+'"/></td>'+
    	  '<td class="col-md-1">'+unitname+'<input type="hidden" name="unit[]" value="'+unitid+'"/></td>'+
          '<td class="col-md-1">'+rate+'<input type="hidden" name="rate[]" value="'+rate+'" class="cal"/></td>'+
          '<td class="col-md-1">'+qty+'<input type="hidden" name="qty[]" value="'+qty+'" class="cal"/></td>'+
    	  '<td class="col-md-1">'+amount+'<input type="hidden" name="amount[]" class="countable" value="'+amount+'" class="calcin"/></td>'+

    	  '<td><button type="button" class="btn btn-danger remove_field" id="'+counter+'">X</button></td></tr>');
    jQuery('.addnewrow').append(newRow);
    count++;
    $(".addnewrow1").empty();
    sumofduration();
    deductioncalculate();

    $("#workdetails").val("");
    $("#hsn").val("");
    $("#unit").val("");
    $("#rate").val("");
    $("#qty").val("");
    $("#amount").val("");
    $("#slno").val("");
     
   
	}
	else
	{
		alert("Expense Head or Amount Can't be null");
	}
	
	
}); 


jQuery(".addnewrow").on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
jQuery(this).parent('td').parent('tr').remove(); counter--;
	
sumofduration();

});
jQuery(".addnewrow1").on("click",".remove_field1", function(e){ //user click on remove text
e.preventDefault();
jQuery(this).parent('td').parent('tr').remove(); counter--;
	
sumofduration1();

});
function sumofduration()
{

    var totals = 0;
    $('.countable').each(function (index, element) {
        totals = totals + parseFloat($(element).val());
    });
    $("#totalamt").val(totals);


    
    calulate();
   
}

function sumofduration1()
{

    var totals1 = 0;
    $('.countable1').each(function (index, element) {
        totals1 = totals1 + parseFloat($(element).val());
    });
    $("#totdeduct").val(totals1);


    
    calulate();
   
}




    </script>

@endsection