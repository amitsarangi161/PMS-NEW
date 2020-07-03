@extends('layouts.account')
@section('content')

@if ($errors->any())
     @foreach ($errors->all() as $error)
         <p class="alert alert-danger text-center">{{ $error }}</p>
     @endforeach
 @endif
  @if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
   @endif
   @if(Session::has('err'))
   <p class="alert alert-danger text-center">{{ Session::get('err') }}</p>
   @endif


<table class="table table-responsive table-hover table-bordered table-striped">
	<tr class="bg-navy">
		 <td class="text-center">VOUCHER POSTING</td>
	</tr>

</table>


<form action="/savecreatedebitvouchers" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
      <tr style="width: 100%">
      	 <td style="width:20%;"><strong>SELECT A VENDOR<strong></td>
      	 <td style="width:30%;">
      	 	<select class="form-control select2" name="vendorid" id="vendorid" required="" onchange="getVendorBalance();">
      	 		<option value="">Select a vendor</option>
      	 		@foreach($vendors as $vendor)
               <option value="{{$vendor->id}}">{{$vendor->vendorname}}</option>

      	 		@endforeach
      	 		
      	 	</select>
      	 </td>
        <td style="width: 20%;"><strong>VOUCHER TYPE*</strong></td>
          <td style="width: 30%;">
            <select class="form-control select2" name="voucher_type" required="">
            <option value=''>--Select a type--</option>
            <option value='PAYMENT'>PAYMENT</option>
            <option value='INVOICE'>INVOICE</option>
            </select>
           </td>
      </tr>
      <tr id="venderbalance">
        
      </tr>
      <tr>
        <td style="width: 20%;"><strong>PAYMENT TYPE*</strong></td>
          <td style="width: 30%;">
            <select class="form-control select2" name="reftype" required="">
            <option value=''>--Select a type--</option>
            <option value='PO'>PO</option>
            <option value='PI'>PI</option>
            <option value='ADVANCE'>ADVANCE</option>
            <option value='NA'>NA</option>
            </select>
           </td>
      </tr>
      <tr style="width: 100%">
        <td style="width: 20%;"><strong>Select a Project</strong></td>
        <td style="width: 30%;">
          <select name="projectid" class="form-control select2">
            <option value="">NONE</option>
            @foreach($projects as $project)
              <option value="{{$project->id}}">{{$project->projectname}}</option>
            @endforeach

          </select>
        </td>

        <td style="width: 20%;"><strong>Select a Expense Head</strong></td>
        <td style="width: 30%;">
          <select name="expenseheadid" class="form-control select2">
            <option value="">NONE</option>
            @foreach($expenseheads as $expensehead)
              <option value="{{$expensehead->id}}">{{$expensehead->expenseheadname}}</option>
            @endforeach

          </select>
        </td>
      </tr>
      <tr style="width: 100%">
      	<td style="width: 20%;"><strong>BILL DATE</strong></td>
      	<td style="width: 30%;">
      		<input type="text" class="form-control datepicker3" placeholder="Enter bill date" name="billdate" readonly="" required="">
      	</td>
      	 <td style="width: 20%;"><strong>BILL NO</strong></td>
      	 <td style="width: 30%;"><input type="text" name="billno" class="form-control" required="" placeholder="Enter Bill No Here" autocomplete="off" onkeyup="checkbill(this.value)" required="">
          <p  class="label label-danger">If Bill No not available then Enter "NA"</p>
         </td>
      	
      </tr>
         
      

	</table>

    <table class="table table-responsive table-hover table-bordered table-striped">
	    <tr class="bg-navy">
		 <td class="text-center">AMOUNT DETAILS</td>
	    </tr>
    </table>

	<table class="table table-responsive table-hover table-bordered table-striped">
	    	
	    	<tr>
	    		<td><strong>Total MRP</strong></td>
	    		<td ><input type="text" class="form-control calc" id="tprice" name="tprice" required="" autocomplete="off"></td>

          <td><strong>DISCOUNT</strong></td>
          <td><input type="text" class="form-control calc" id="discount" name="discount" value="0" required="" autocomplete="off"></td>
        </tr>

	    	<tr>
	    		<td><strong>Total SGST</strong></td>
	    		<td><input type="text" class="form-control calc" id="tsgst" name="tsgst" autocomplete="off" value="0"></td>
	    		<td><strong>Total CGST</strong></td>
	    		<td><input type="text" class="form-control calc" id="tcgst" name="tcgst" autocomplete="off" value="0"></td>
	    	</tr>
    		<tr>
    		<td><strong>Total IGST</strong></td>
    		<td><input type="text" class="form-control calc" id="tigst" name="tigst" autocomplete="off" value="0"></td>

	    		<td><strong>Total Amount</strong></td>
	    		<td><input type="text" class="form-control" id="totalamt" name="totalamt" readonly=""></td>
	    	 </tr>

         <tr>
          <td><strong>IT Deduction(in %)</strong></td>
          <td><input type="text" class="form-control dedcalc" id="itdeduction" name="itdeduction" autocomplete="off"  value="0"></td>

          <td><strong>OTHER DEDUCTION</strong></td>
          <td><input type="text" class="form-control dedcalc" id="otherdeduction" autocomplete="off" name="otherdeduction" value="0"></td>
         </tr>


          <tr>
          <td><strong>Final Price</strong></td>
          <td><input type="text" class="form-control" id="finalamount" name="finalamount" readonly="" required=""></td> 
          
          <td><strong>Narration</strong></td>
          <td>
            <textarea class="form-control" name="narration" placeholder="Enter  Narration"></textarea>
          </td>
        </tr>

        <tr>
          <td><strong>Attachment</strong></td>
          <td>
          <input name="invoicecopy" type="file" onchange="readURL(this);" >
            <img style="height:40px;width:40px;" alt="noimage" id="imgshow">
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
 
	 function readURL(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
                    .width(90)
                    .height(90);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
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
   deduction();

  
});

  $( ".dedcalc" ).on("change paste keyup", function() {

      
  deduction();

          
  });
function deduction(){
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
          var mrp=$("#tprice").val();

          var itdedamt=parseFloat(mrp)*(parseFloat(gitdeduction/100));
          var otheramt=parseFloat(mrp)*(parseFloat(gotherdeduction/100));

          var final=Number.parseFloat(parseFloat(subtot)-(parseFloat(itdedamt)+parseFloat(otheramt))).toFixed(2);

          $("#finalamount").val(final);
}


function getVendorBalance() {
  $("#venderbalance").removeClass('clr');
  var vid=$("#vendorid").val();
    $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/getvendorbalance")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     vid:vid,
                     },

               success:function(data) { 

                        var vendor_credit=data.credit;
                        var vendor_debit=data.debit;
                        var balance=data.balance;

                        var clr=data.clr;

                        var x='<td class='+clr+'>'+"Total Credit : "+vendor_credit+'</td>'
                              +'<td class='+clr+'>'+"Total Debit : "+vendor_debit+'</td>'
                              +'<td colspan="2" class='+clr+'>'+"Clear Balance : "+balance+'</td>';
                        $("#venderbalance").html(x);
                         

                    }


                       });
}

</script>
@endsection