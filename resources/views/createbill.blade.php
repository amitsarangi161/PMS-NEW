@extends('layouts.app')
@section('content')
<style type="text/css">
	tfoot tr td{
		 border: 0px;
	}
</style>
@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
@endif
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">CREATE BILL</td>
		
	</tr>
</table>


<form action="/savebill" method="post">
	{{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-blue">
		<td colspan="4" class="text-center"><strong>CLIENT DETAILS</strong></td>
		
	</tr>

	<tr>
		<td width="15%"><strong>SELECT A PROJECT</strong></td>
		<td width="35%">
			<input type="hidden" name="projectid" id="projectid">
         <select  id="nameofthework" class="form-control select2" onchange="fetchdata(this.value);" required="">
         	 <option value="">Select a Project</option>
         	 <option value="NONE">NONE</option>

         	 @foreach($projects as $project)
              <option  value="{{$project->projectname}}" clientid="{{$project->clientid}}" clientname="{{$project->clientname}}" address="{{$project->officeaddress}}" gstn="{{$project->gstn}}" panno="{{$project->panno}}" contactno="{{$project->contactno}}" email="{{$project->email}}" projectid="{{$project->id}}">{{$project->projectname}}</option>
         	 @endforeach
         </select>

		 </td>

		 <td width="15%"><strong>NAME OF THE WORK</strong></td>
		 <td width="35%">
		 	<textarea name="nameofthework" placeholder="Work Name" id="now" class="form-control" required=""></textarea>
		 </td>
		
	</tr>
	<tr>
      
		<td width="15%"><strong>SELECT A CLIENT</strong></td>
		<td width="35%">
			<select class="form-control" id="client" onchange="fetchclientdata();">
				<option value="">Select a Client</option>
				@foreach($clients as $client)
			    <option id="clint{{$client->id}}" value="{{$client->id}}" clientname="{{$client->clientname}}" address="{{$client->officeaddress}}" gstn="{{$client->gstn}}" panno="{{$client->panno}}" contactno="{{$client->contactno}}" email="{{$client->email}}">{{$client->clientname}}</option>
               
                @endforeach
				
			</select>
		</td>
		
		<td width="15%"><strong>ADDRESS:</strong></td>
		<td width="35%"><textarea name="address"  id="address" class="form-control" placeholder="Enter Address Here" required=""></textarea></td>
		
	</tr>
    <tr>
        <td width="15%"><strong>REFERENCE NO</strong></td>
		<td width="35%">
		<textarea class="form-control" name="refno" autocomplete="off" placeholder="Enter Reference No/Agreement No"></textarea>
		</td>
		<td width="15%"><strong>REFERENCE DATE</strong></td>
		<td width="35%">
          <input type="text" name="refdate" class="form-control readonly datepicker" autocomplete="off">
		</td>
		
	</tr>
	<tr>
		<td width="15%"><strong>CLIENT NAME:</strong></td>
		<td width="35%"><input type="text" name="clientname" id="clientname" placeholder="Enter Client Name Here" class="form-control" required=""></td>
		<td width="15%"><strong>CLIENT EMAIL:</strong></td>
		<td width="35%"><input type="email" name="email" id="email" class="form-control" placeholder="Enter Client Email Here"></td>
	</tr>
	<tr>
		<td width="15%"><strong>GST NO:</strong></td>
		<td width="35%"><input type="text" name="gstno" id="gstno" class="form-control" placeholder="Enter GST no Here"></td>
		<td width="15%"><strong>PAN NO:</strong></td>
		<td width="35%"><input type="text" name="panno" id="panno" class="form-control" placeholder="Enter PAN no Here"></td>
	</tr>
	<tr>
		<td width="15%"><strong>CONTACT NO:</strong></td>
		<td width="35%"><input type="text" name="contactno" id="contactno" class="form-control" placeholder="Enter Contact No Here"></td>
		<td width="15%"><strong>FAX:</strong></td>
		<td width="35%"><input type="text" name="fax" class="form-control" placeholder="Enter FAX No Here"></td>
	</tr>
	<tr>
	
		<td width="15%"><strong>BILL FROM(STEPL/SA)</strong></td>
		<td width="35%">
			<select name="company" required="" class="form-control">
				<option value="">Select a Company</option>
				<option value="SA">SA</option>
				<option value="STEPL">STEPL</option>
				<option value="STECS">STECS</option>
		    </select>
		</td>
	

	  <td width="15%"><strong>SELECT A BANK ACCOUNT *</strong></td>
		<td width="35%">
			<select name="bankid" class="form-control select2" required="">
				<option value="">Select a Bank</option>
				@foreach($banks as $bank)
                 <option value="{{$bank->id}}">AC NO:{{$bank->acno}}({{$bank->forcompany}})/{{$bank->bankname}}/{{$bank->branchname}}</option>
				@endforeach
			</select>
		</td>
	
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
			  <td><button type="button" id="addnew" class="addauthor btn btn-primary">ADD</button></td>

			
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
       <tbody class="addnewrow1">
            
			
									 
	    </tbody>	

	   		
    </table>
     <table class="table" style="background-color: cornsilk;">
	    	<tr></tr>
	    	<tr>
	    		
                <td ></td>
	    		<td ></td>
	    		<td ></td>
	    		
	    		<td ><strong>TOTAL</strong></td>
	    		<td ></td>
	    		<td ><input type="text" id="totalamt" name="total" class="form-control" readonly=""></td>
	    	</tr>
	    		<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td>
	    			<select name="discounttype" id="discounttype" onchange="chkdiscount()" class="form-control">
	    				<option value="">TENDER PREMIUM</option>
	    				@foreach($discounts as $discount)
                         <option value="{{$discount->id}}">{{$discount->discountname}}</option>
	    				@endforeach
	    			
	    	        </select>
	    	        <p style="color: red;">*<b>Note:for discount use -(ex: -20)</b></p>
	    	</td>
	    		<td><input type="text" value="0" id="discount" name="discount" class="form-control calulate" autocomplete="off" readonly=""></td>
	    		<td><input type="text" id="discountvalue" name="discountvalue" class="form-control" readonly=""></td>
	    		
	    	</tr>

	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>CLAIMED AMOUNT(in %)</strong></td>
	    		<td><input type="text" value="100" id="claimedrate" name="claimedrate" class="form-control calulate" autocomplete="off"></td>
	    		<td><input type="text" id="claimedvalue" name="claimedvalue" class="form-control" readonly=""></td>
	    		
	    	</tr>
	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>CGST RATE(in %)</strong></td>
	    		<td><input type="text" value="9" id="cgstrate" name="cgstrate" class="form-control calulate cgstchng" autocomplete="off"></td>
	    		<td><input type="text" id="cgstvalue" name="cgstvalue" class="form-control" readonly=""></td>
	    		
	    	</tr>
	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>SGST RATE(in %)</strong></td>
	    		<td><input type="text" value="9" id="sgstrate" name="sgstrate" class="form-control calulate sgstchng" autocomplete="off"></td>
	    		<td><input type="text" id="sgstvalue" name="sgstvalue" class="form-control" readonly=""></td>
	    		
	    	</tr>
	    	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>IGST RATE(in %)</strong></td>
	    		<td><input type="text" value="0" id="igstrate" name="igstrate" class="form-control calulate igstchng" autocomplete="off"></td>
	    		<td><input type="text" id="igstvalue" name="igstvalue" class="form-control" readonly=""></td>
	    		
	    	</tr>
	    	   	<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>TOTAL PAYABLE AMOUNT</strong></td>
	    		<td></td>
	    		<td><input type="text" id="totalpayble" name="totalpayable" class="form-control calulate" readonly=""></td>
	    		
	    	</tr>
	    		<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>ADVANCE PAYMENT RECIVED(Rs.)</strong></td>
	    		<td></td>
	    		<td><input type="text" value="0" id="advancepayment" name="advancepayment" class="form-control calulate"></td>
	    		
	    	</tr>
	    	  		<tr>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		
	    		<td><strong>NET PAYABLE</strong></td>
	    		<td></td>
	    		<td><input type="text" id="netpayable" readonly="" name="netpayable" class="form-control"></td>
	    		
	    		
	    	</tr>
	    </table>

    <table class="table">
    	<tr>
    		<td class="pull-right"><button type="submit" class="btn btn-success btn-lg">SAVE</button></td>
    	</tr>
    	
    </table>

</form>

    <script type="text/javascript">


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

   function fetchclientdata()
   {
   	  var clientname=$("#client option:selected" ).attr("clientname");
      var address=$("#client option:selected" ).attr("address");
      var gstno=$("#client option:selected" ).attr("gstn");
      var panno=$("#client option:selected" ).attr("panno");
      var contactno=$("#client option:selected" ).attr("contactno");
      var email=$("#client option:selected" ).attr("email");
      
      $("#clientname").val(clientname);
      $("#address").val(address);
      $("#gstno").val(gstno);
      $("#panno").val(panno);
      $("#contactno").val(contactno);
      $("#email").val(email);
   } 	

   function fetchdata(project)
   {  
 
      if(project=='NONE' || project=='')
      {
      	    $('#now').removeAttr("readonly");
      	
      	 	$('#client').removeAttr("disabled");

      	 

      }
      else
      {

      $('#now').attr('readonly','readonly');
      
      var clientname=$("#nameofthework option:selected" ).attr("clientname");
      var clientid=$("#nameofthework option:selected" ).attr("clientid");
      var address=$("#nameofthework option:selected" ).attr("address");
      var gstno=$("#nameofthework option:selected" ).attr("gstn");
      var panno=$("#nameofthework option:selected" ).attr("panno");
      var contactno=$("#nameofthework option:selected" ).attr("contactno");
      var email=$("#nameofthework option:selected" ).attr("email");
       var projectid=$("#nameofthework option:selected" ).attr("projectid");
       var nameofthework=$("#nameofthework").val();
       $("#client").val(clientid);
       $("#client").attr("disabled","disabled");


      $("#clientname").val(clientname);
      $("#address").val(address);
      $("#gstno").val(gstno);
      $("#panno").val(panno);
      $("#contactno").val(contactno);
      $("#email").val(email);
      $("#projectid").val(projectid);
      if(project!='NONE')
      {
      	  $("#now").val(nameofthework);
      }

      }

     

     
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


      
      var totalpayble=Number.parseFloat(parseFloat(tclaimedvalue)+parseFloat(tcgstvalue)+parseFloat(tsgstvalue)+parseFloat(tigstvalue)).toFixed(2);

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
    	  '<td class="col-md-1">'+Number.parseFloat(amount).toFixed(2)+'<input type="hidden" name="amount[]" class="countable" value="'+Number.parseFloat(amount).toFixed(2)+'" class="calcin"/></td>'+

    	  '<td><button type="button" class="btn btn-danger remove_field" id="'+counter+'">X</button></td></tr>');
    jQuery('.addnewrow1').append(newRow);
    count++;

    sumofduration();

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


jQuery(".addnewrow1").on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
jQuery(this).parent('td').parent('tr').remove(); counter--;
	
sumofduration();

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



    </script>

@endsection