@extends('layouts.account')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-info text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">DEBIT VOUCHER ENTRY</td>
	</tr>

</table>


<form action="/updatedebitvoucher/{{$debitvoucherheader->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
      <tr>
      	 <td style="width: 30%;">SELECT A VENDOR</td>
      	 <td>
      	 	<select class="form-control select2" name="vendorid" id="vendorid" required="">
      	 		<option value="">Select a vendor</option>
      	 		@foreach($vendors as $vendor)
               <option value="{{$vendor->id}}" {{($vendor->id==$debitvoucherheader->vendorid) ? 'selected':''}}>{{$vendor->vendorname}}</option>

      	 		@endforeach
      	 		
      	 	</select>
      	 </td>
      </tr>
          <tr>
      	<td>BILL DATE</td>
      	<td>
      		<input type="text" class="form-control datepicker3" placeholder="Enter bill date" name="billdate" readonly="" value="{{$debitvoucherheader->billdate}}" required="">
      	</td>
      </tr>
      <tr>
      	 <td>BILL NO</td>
      	 <td><input type="text" name="billno" class="form-control calc" required="" placeholder="Enter Bill No Here" autocomplete="off" onkeyup="checkbill(this.value)"  value="{{$debitvoucherheader->billno}}" readonly="">
          <p  class="label label-danger">If Bill No not available then Enter "NA"</p>
         </td>
      	
      </tr>
           <tr>
        <td>Select a Project</td>
        <td>
          <select name="projectid" class="form-control select2">
            <option value="">NONE</option>
            @foreach($projects as $project)
              <option value="{{$project->id}}">{{$project->projectname}}</option>
            @endforeach

          </select>
        </td>
      </tr>
      <tr>
        <td>Select a Expense Head</td>
        <td>
          <select name="expenseheadid" class="form-control select2">
            <option value="">NONE</option>
            @foreach($expenseheads as $expensehead)
              <option value="{{$expensehead->id}}">{{$expensehead->expenseheadname}}</option>
            @endforeach

          </select>
        </td>
      </tr>
  

      
      

	</table>
	<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">DEBIT VOUCHER ITEM ENTRY</td>
		
	</tr>
    </table>

<table class="table">
  <tr>
    <td><strong>Item Name</strong></td>
    <td><input type="text" placeholder="Enter Item Name" class="form-control calc" id="itemname" autocomplete="off"></td>
    <td><strong>Units</strong></td>
    <td>
      <select id="unit" class="form-control select2 calc">
        <option value="">select a unit</option>
        @foreach($units as $unit)
                <option value="{{$unit->id}}">{{$unit->unitname}}</option>
        @endforeach
        
      </select>
    </td>
      <td><strong>Quntity</strong></td>
    <td>
       <input type="text" id="qty" class="form-control calc" placeholder="Enter Quantity Here" autocomplete="off" value="1">
    </td>

    
  </tr>
  <tr>
  
    <td><strong>MRP</strong></td>
    <td><input type="text" placeholder="Enter Item MRP" class="form-control calc" id="mrp" autocomplete="off" value="0"></td>


      <td><strong>Discount(in ruppes)</strong></td>
    <td>
       <input type="text" id="discount" class="form-control calc" autocomplete="off" value="0" onclick="opendiscountmodal()" readonly="">
    </td>
    <td><strong>Price</strong></td>
    <td><input type="text" class="form-control calc" id="price" autocomplete="off" readonly="" value="0"></td>
    

    
  </tr>
 
  <tr>
    
    <td><strong>SGST RATE(in %)</strong></td>
    <td><input type="text" class="form-control calc" id="sgstrate" autocomplete="off" value="0"></td>
    <td><strong>SGST COST</strong></td>
    <td>
       <input type="text" id="sgstcost" class="form-control calc" readonly="" autocomplete="off">
    </td>

    
  </tr>
     <tr>
      
    <td><strong>CGST RATE(in %)</strong></td>
    <td><input type="text" class="form-control calc" id="cgstrate" autocomplete="off" value="0"></td>
    <td><strong>CGST COST</strong></td>
    <td>
       <input type="text" id="cgstcost" class="form-control calc" readonly="" autocomplete="off">
    </td>

    
  </tr>

   <tr>
    
    <td><strong>IGST RATE(in %)</strong></td>
    <td><input type="text" class="form-control calc" id="igstrate" autocomplete="off" value="0"></td>
    <td><strong>IGST COST</strong></td>
    <td>
    <input type="text" id="igstcost" class="form-control calc" readonly="" autocomplete="off">
    </td>

    
  </tr>
   <tr>
    
    <td><strong>TOTAL AMOUNT</strong></td>
    <td><input type="text" class="form-control" id="ttlamt" autocomplete="off" readonly=""></td>
    <td><strong>GROSS AMOUNT</strong></td>
    <td><input type="text" class="form-control" id="grossamt" autocomplete="off" readonly=""></td>
    <td><button type="button" id="addnew" class="addauthor btn btn-primary">ADD</button></td>

    
  </tr>
   </table>
      

	<table class="table table-responsive table-hover table-bordered table-striped">
	    <tr class="bg-navy">
		 <td class="text-center">ADDED REQUISITIONS DETAILS</td>
	    </tr>
    </table>
    <div class="table-responsive">
    <table class="table table-responsive table-hover table-bordered table-striped">
    	<thead>
    		<tr class="bg-primary">
    	<td>Item Name</td>
			<td>Units</td>
			<td>Qty</td>
			<td>MRP</td>
			<td>Discount</td>
			<td>Price</td>
      <td>SGST Rate</td>
      <td>SGST Cost</td>
			<td>CGST Rate</td>
			<td>CGST Cost</td>
			
			<td>IGST Rate</td>
			<td>IGST Cost</td>
			<td>TOTAL AMOUNT</td>
      <td>GROSS AMOUNT</td>
    	<th>REMOVE</th>
           </tr>
    	</thead>
       <tbody class="addnewrow">
            @foreach($debitvouchers as $debitvoucher)

            @php
                $acctualtmrp=$debitvoucher->mrp*$debitvoucher->qty;
                $acctualtdisc=$debitvoucher->discount*$debitvoucher->qty;
            @endphp

            <tr>
        
       <td>{{$debitvoucher->itemname}}<input type="hidden" name="itemname[]" value="{{$debitvoucher->itemname}}"></td>
       <td>{{$debitvoucher->unitname}}<input type="hidden" name="unit[]"value="{{$debitvoucher->unit}}" class="calcin"/></td>
       <td>{{$debitvoucher->qty}}
        <input type="hidden" name="qty[]" class="qtycountable" value="{{$debitvoucher->qty}}"/>
        <input type="hidden" class="acctualtmrpcountable" value="{{$acctualtmrp}}"/>
        <input type="hidden" class="acctualtdisccountable" value="{{$acctualtdisc}}"/>

      </td>
      <td>{{$debitvoucher->mrp}}<input type="hidden" name="mrp[]" class="mrpcountable" value="{{$debitvoucher->mrp}}"/></td>
      <td>{{$debitvoucher->discount}}<input type="hidden" name="discount[]" class="discountcountable" value="{{$debitvoucher->discount}}"/></td>
      <td>{{$debitvoucher->price}}<input type="hidden" name="price[]" class="pricecountable" value="{{$debitvoucher->price}}"/></td>
      <td>{{$debitvoucher->sgstrate}}<input type="hidden" name="sgstrate[]" value="{{$debitvoucher->sgstrate}}"/></td>
      <td>{{$debitvoucher->sgstcost}}<input type="hidden" name="sgstcost[]" class="sgstcountable" value="{{$debitvoucher->sgstcost}}"/></td>
      <td>{{$debitvoucher->cgstrate}}<input type="hidden" name="cgstrate[]" value="{{$debitvoucher->cgstrate}}"/></td>
      <td>{{$debitvoucher->cgstcost}}<input type="hidden" name="cgstcost[]" class="cgstcountable" value="{{$debitvoucher->cgstcost}}"/></td>
      <td>{{$debitvoucher->igstrate}}<input type="hidden" name="igstrate[]" value="{{$debitvoucher->igstrate}}"/></td>
      <td>{{$debitvoucher->igstcost}}<input type="hidden" name="igstcost[]" class="igstcountable" value="{{$debitvoucher->igstcost}}"/></td>
      <td>{{$debitvoucher->grossamt-($debitvoucher->sgstcost+$debitvoucher->cgstcost+$debitvoucher->igstcost)}}<input type="hidden" name="ttlamt[]" class="ttlamtcountable" value="{{$debitvoucher->grossamt-($debitvoucher->sgstcost+$debitvoucher->cgstcost+$debitvoucher->igstcost)}}"/></td>
      
      <td>{{$debitvoucher->grossamt}}<input type="hidden" name="grossamt[]" class="countable" value="{{$debitvoucher->grossamt}}"/></td>
      <td>
        <button type="button" class="btn btn-danger remove_field" id="'+counter+'">X</button>

       </td>
      </tr>

            @endforeach
			
									 
	    </tbody>	
    </table>
    </div>
    <table class="table table-responsive table-hover table-bordered table-striped">
	    <tr class="bg-navy">
		 <td class="text-center">AMOUNT DETAILS</td>
	    </tr>
    </table>

	<table class="table">
	    	<tr>
	    		<td width="50%"><strong>Total MRP</strong></td>
	    		<td width="50%"><input type="text" id="tmrp" name="tmrp" class="form-control" readonly="" value="{{$debitvoucherheader->tmrp}}" required=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total Discount</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="tdiscount" name="tdiscount" value="{{$debitvoucherheader->tdiscount}}" readonly=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total Price</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="tprice" name="tprice" readonly="" value="{{$debitvoucherheader->tprice}}" required=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total Quantity</strong></td>
	    		<td width="50%"><input type="text" class="form-control" value="{{$debitvoucherheader->tqty}}" id="tqty" name="tqty" readonly="" required=""></td>
	    	</tr>

	    	<tr>
	    		<td width="50%"><strong>Total SGST</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->tsgst}}" class="form-control" id="tsgst" name="tsgst" readonly=""></td>
	    	</tr>
	    	<tr>
	    		<td width="50%"><strong>Total CGST</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->tcgst}}" class="form-control" id="tcgst" name="tcgst" readonly=""></td>
	    	</tr>


	    		<tr>
	    		<td width="50%"><strong>Total IGST</strong></td>
	    		<td width="50%"><input type="text" value="{{$debitvoucherheader->tigst}}" class="form-control" id="tigst" name="tigst" readonly=""></td>
	    	   </tr>

	    	<tr>
	    		<td width="50%"><strong>Total Amount</strong></td>
	    		<td width="50%"><input type="text" class="form-control" id="totalamt" name="totalamt" value="{{$debitvoucherheader->totalamt}}" readonly="" required=""></td>
	    	 </tr>
          <tr>
          <td width="50%"><strong>IT Deduction(in %)</strong></td>
          <td width="50%"><input type="text" class="form-control dedcalc" id="itdeduction" value="{{$debitvoucherheader->itdeduction}}" name="itdeduction" autocomplete="off"  value="0"></td>

         </tr>
          <tr>
          <td width="50%"><strong>TDS(in %)</strong></td>
          <td width="50%"><input type="text" class="form-control dedcalc" value="{{$debitvoucherheader->otherdeduction}}" id="otherdeduction" autocomplete="off" name="otherdeduction" value="0"></td>
          
         </tr>
          <tr>
          <td width="50%"><strong>Final Price</strong></td>
          <td width="50%"><input type="text" class="form-control" value="{{$debitvoucherheader->finalamount}}" id="finalamount" name="finalamount" readonly="" required=""></td> 
          
          </tr>

	   
	    		
	
	    	 <tr>
	    	 	<td width="50%"><strong>Attach a invoice copy</strong></td>
	    	 	<td>
	    	 	<input name="invoicecopy" type="file" onchange="readURL(this);">
            <img style="height:250px;width:250px;" src="{{asset('img/debitvoucher/'.$debitvoucherheader->invoicecopy)}}" id="imgshow">

            </td>
   
	    	 </tr>

        
	</table>		

<table class="table table-responsive">
	<tr>
		<td ><button type="submit" class="btn btn-success pull-right btn-lg" onclick="return confirm('Do You Want to Proceed?')">Submit</button></td>
	</tr>
</table>


</form>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Discount Modal</h4>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td><strong>Select Discount Type</strong></td>
            <td>
              <select id="disctype" class="form-control">
                <option value="">Select a type</option>
                <option value="PERCENTAGE">PERCENTAGE</option>
                <option value="FLAT">FLAT</option>
                
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Enter Value</strong>
            </td>
            <td>
              <input type="text" class="form-control" id="discvalue">
            </td>
          </tr>
          <tr>
            <td>
              <button type="button" class="btn btn-success" onclick="calculatedisc();">ADD DISCOUNT</button>
            </td>
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
  sumofduration();
  function calculatedisc()
  {
        var mrp=$("#mrp").val();
        if(mrp!=''){


      var disctype=$("#disctype").val();
      var discvalue=$("#discvalue").val();
      var val=0;
      if (disctype!='' && discvalue!='') {
      

        if(disctype=='PERCENTAGE')
        {
           val=mrp*(parseFloat(discvalue)/100);
           
        }
        else
        {
            val=parseFloat(discvalue);
        }
        if(val>0){
            $('#discount').val(val);
        var disctype=$("#disctype").val('');
        var discvalue=$("#discvalue").val('');
        $("#myModal").modal('hide');
        calcu();
        }
        else
        {
           alert("value Cant be negetive");
           var disctype=$("#disctype").val('');
           var discvalue=$("#discvalue").val('');
           $("#myModal").modal('hide');
        }
      
      }

      }
      else{
        alert("MRP Cant be Null");
        $("#myModal").modal('hide');
      }
  }
  function opendiscountmodal()
  {
         $("#myModal").modal('show');
  }
  function checkbill(billno)
  {

   var vendorid=$("#vendorid").val();


      $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxcheckbill")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     vendorid:vendorid,
                     billno:billno
                     
                     },

               success:function(data) { 
                    
                     if (data=="success") {
                      alert("This Bill No already Exist");
                     }
               }
             });
  }
   function readURL(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(250);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
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
          var subtot=$("#tmrp").val();
          var totalamt=$("#totalamt").val();

          var itdedamt=parseFloat(subtot)*(parseFloat(gitdeduction/100));
          var otheramt=parseFloat(subtot)*(parseFloat(gotherdeduction/100));

          var final=Number.parseFloat(parseFloat(totalamt)-(parseFloat(itdedamt)+parseFloat(otheramt))).toFixed(2);

          $("#finalamount").val(final);
          $("#approvalamount").val(final);


          

  });

  function calcu()
  {
     var qty=$("#qty").val();
    if(qty=='') {
           gqty = 0;

          }
          else
          {
            gqty=qty;
          }

    var mrp=$("#mrp").val();
         if(mrp=='') {
           gmrp = 0;
          }
          else
          {
            gmrp=mrp;
          }
       var discount=$("#discount").val();
           if(discount=='') {
           gdiscount = 0;
          }
          else
          {
            gdiscount=discount;
          }
   
   

    var sgstrate=$("#sgstrate").val();
    if(sgstrate=='') {
           gsgstrate = 0;
          }
          else
          {
            gsgstrate=sgstrate;
          }

       var cgstrate=$("#cgstrate").val();
    if(cgstrate=='') {
           gcgstrate = 0;
          }
          else
          {
            gcgstrate=cgstrate;
          }
   
    var igstrate=$("#igstrate").val();
    if(igstrate=='') {
           gigstrate = 0;
          }
          else
          {
            gigstrate=igstrate;
          }
    
    
     
   
   var calprice=parseFloat(gmrp)-parseFloat(gdiscount);
   $("#price").val(calprice);
 

   var calsgstcost=parseFloat(calprice)*(parseFloat(gsgstrate)/100)*parseFloat(gqty);
   $("#sgstcost").val(calsgstcost);
    var calcgstcost=parseFloat(calprice)*(parseFloat(gcgstrate)/100)*parseFloat(gqty);
   $("#cgstcost").val(calcgstcost);
 
    var caligstcost=parseFloat(calprice)*(parseFloat(gigstrate)/100)*parseFloat(gqty);
   $("#igstcost").val(caligstcost);

  console.log("qty"+parseFloat(gqty));
 

   var gross=Number.parseFloat((parseFloat(gqty)*parseFloat(calprice))+parseFloat(calsgstcost)+parseFloat(calcgstcost)+parseFloat(caligstcost)).toFixed(2);
   $("#grossamt").val(gross);

   var tamnt=Number.parseFloat((parseFloat(gqty)*parseFloat(calprice))).toFixed(2);
   $("#ttlamt").val(tamnt);
  }
  $( ".calc" ).on("change paste keyup", function() {

   calcu();

  
});


var counter = 0;
var gdtotal = 0;
var count=0;
jQuery('#addnew').click(function(event){
   
  var itemname1 = jQuery('#itemname').val();
  var unitname=$( "#unit option:selected" ).text();
  var unit = jQuery('#unit').val();
  var qty1=jQuery('#qty').val();
  var mrp1=jQuery('#mrp').val();
  var discount1=jQuery('#discount').val();
  var price1=jQuery('#price').val();
  var sgstrate1=jQuery('#sgstrate').val();
  var sgstcost1=jQuery('#sgstcost').val();
  var cgstrate1=jQuery('#cgstrate').val();
  var cgstcost1=jQuery('#cgstcost').val();
  var igstrate1=jQuery('#igstrate').val();
  var igstcost1=jQuery('#igstcost').val();
  var grossamt1=jQuery('#grossamt').val();
  var ttlamt1=jQuery('#ttlamt').val();
  var acctualtmrp=parseFloat(mrp1)*parseFloat(qty1);
  var acctualtdisc=parseFloat(discount1)*parseFloat(qty1);

   
  if(itemname1!='' && unit!='' && qty1!='' && mrp1!='' && discount1!='' && grossamt1 !='')
  {   
  event.preventDefault();
    counter++;

    var newRow = jQuery('<tr>'+
        
       '<td>'+itemname1+'<input type="hidden" name="itemname[]" value="'+itemname1+'"></td>'+
        '<td>'+unitname+'<input type="hidden" name="unit[]"value="'+unit+'" class="calcin"/></td>'+
        '<td>'+qty1+
        '<input type="hidden" name="qty[]" class="qtycountable" value="'+qty1+'"/>'+
        '<input type="hidden"  class="acctualtmrpcountable" value="'+acctualtmrp+'"/>'+
        '<input type="hidden"  class="acctualtdisccountable" value="'+acctualtdisc+'"/>'+
        '</td>'+
          '<td>'+mrp1+'<input type="hidden" name="mrp[]" class="mrpcountable" value="'+mrp1+'"/></td>'+
          '<td>'+discount1+'<input type="hidden" name="discount[]" class="discountcountable" value="'+discount1+'"/></td>'+
          '<td>'+price1+'<input type="hidden" name="price[]" class="pricecountable" value="'+price1+'"/></td>'+
          '<td>'+sgstrate1+'<input type="hidden" name="sgstrate[]" value="'+sgstrate1+'"/></td>'+
          '<td>'+sgstcost1+'<input type="hidden" name="sgstcost[]" class="sgstcountable" value="'+sgstcost1+'"/></td>'+
          '<td>'+cgstrate1+'<input type="hidden" name="cgstrate[]" value="'+cgstrate1+'"/></td>'+
          '<td>'+cgstcost1+'<input type="hidden" name="cgstcost[]" class="cgstcountable" value="'+cgstcost1+'"/></td>'+
          '<td>'+igstrate1+'<input type="hidden" name="igstrate[]" value="'+igstrate1+'"/></td>'+
          '<td>'+igstcost1+'<input type="hidden" name="igstcost[]" class="igstcountable" value="'+igstcost1+'"/></td>'+

        '<td>'+ttlamt1+'<input type="hidden" name="ttlamt[]" class="ttlamtcountable" value="'+ttlamt1+'"/></td>'+
        '<td>'+grossamt1+'<input type="hidden" name="grossamt[]" class="countable" value="'+grossamt1+'"/></td>'+

        '<td><button type="button" class="btn btn-danger remove_field" id="'+counter+'">X</button></td></tr>');
    jQuery('.addnewrow').append(newRow);
    count++;

    sumofduration();
  jQuery('#itemname').val('');
  jQuery('#unit').val('');
  jQuery('#qty').val(1);
  jQuery('#mrp').val(0);
  jQuery('#discount').val(0);
  jQuery('#price').val(0);
  jQuery('#sgstrate').val(0);
  jQuery('#sgstcost').val('');
  jQuery('#cgstrate').val(0);
  jQuery('#cgstcost').val('');
  jQuery('#igstrate').val(0);
  jQuery('#igstcost').val('');
  jQuery('#grossamt').val('');
  jQuery('#ttlamt').val('');
   
   
  }
  else
  {
    alert("Please Fill Up The form Correctly");
  }
  
  
}); 


jQuery(".addnewrow").on("click",".remove_field", function(e){ 
//user click on remove text
e.preventDefault();
jQuery(this).parent('td').parent('tr').remove(); counter--;
  
sumofduration();

});


    
function sumofduration()
{

     
    var totals = 0;
    var mrpcountable=0;
    var discountcountable=0;
    var pricecountable=0;
    var sgstcountable=0;
    var cgstcountable=0;
    var igstcountable=0;
    var qtycountable=0;
   


    $('.countable').each(function (index, element) {
         totals=totals+parseFloat($(element).val());
        
        
    });
    
    $('.acctualtmrpcountable').each(function (index, element) {
       mrpcountable=mrpcountable + parseFloat($(element).val());

        
       console.log(mrpcountable);
    });
   
    $('.acctualtdisccountable').each(function (index, element) {

       discountcountable=discountcountable + parseFloat($(element).val());
        console.log(discountcountable);
    });
    /*$('.pricecountable').each(function (index, element) {
        pricecountable=pricecountable + parseFloat($(element).val());
    });*/
    $('.ttlamtcountable').each(function (index, element) {
        pricecountable=pricecountable + parseFloat($(element).val());
    });
    $('.sgstcountable').each(function (index, element) {
        sgstcountable=sgstcountable + parseFloat($(element).val());
       // sgstcountable = Number.parseFloat(sgstcountable + parseFloat($(element).val())).toFixed(2);
    });
    $('.cgstcountable').each(function (index, element) {

       cgstcountable=cgstcountable + parseFloat($(element).val());
       // cgstcountable = Number.parseFloat(cgstcountable + parseFloat($(element).val())).toFixed(2);
    });
    $('.igstcountable').each(function (index, element) {
         igstcountable=igstcountable + parseFloat($(element).val());
        //igstcountable = Number.parseFloat(igstcountable + parseFloat($(element).val())).toFixed(2);
    });
    $('.qtycountable').each(function (index, element) {
        qtycountable=qtycountable + parseFloat($(element).val());
       // qtycountable = Number.parseFloat(qtycountable + parseFloat($(element).val())).toFixed(2);
    });
    
    $("#totalamt").val(Number.parseFloat(Math.round(totals)).toFixed(2));
    $("#tmrp").val(Number.parseFloat(mrpcountable).toFixed(2));
    $("#tdiscount").val(Number.parseFloat(discountcountable).toFixed(2));
    $("#tprice").val(Number.parseFloat(pricecountable).toFixed(2));
    $("#tsgst").val(Number.parseFloat(sgstcountable).toFixed(2));
    $("#tcgst").val(Number.parseFloat(cgstcountable).toFixed(2));
    $("#tigst").val(Number.parseFloat(igstcountable).toFixed(2));
    $("#tqty").val(Number.parseFloat(qtycountable).toFixed(2));
    

   
}

</script>
@endsection
