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
		 <td class="text-center">EDIT DR VOUCHER</td>
	</tr>

</table>


<form action="/updatedrvoucher/{{$pmsdebitvoucher->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
      <tr style="width: 100%">
      	 <td style="width:20%;"><strong>SELECT A VENDOR<strong></td>
      	 <td style="width:30%;">
      	 	<select class="form-control select2" name="vendorid" id="vendorid" required="" onchange="getVendorBalance();">
      	 		<option value="">Select a vendor</option>
      	 		@foreach($vendors as $vendor)
               <option value="{{$vendor->id}}" {{($pmsdebitvoucher->vendorid==$vendor->id)? 'selected': ''}}>{{$vendor->vendorname}}</option>

      	 		@endforeach
      	 		
      	 	</select>
      	 </td>
        <td style="width: 20%;"><strong>VOUCHER TYPE*</strong></td>
          <td style="width: 30%;">
            <select class="form-control select2" name="voucher_type" required="">
            <option value=''>--Select a type--</option>
            <option value='PAYMENT' {{($pmsdebitvoucher->voucher_type=='PAYMENT')? 'selected': ''}}>PAYMENT</option>
            <option value='INVOICE' {{($pmsdebitvoucher->voucher_type=='INVOICE')? 'selected': ''}}>INVOICE</option>
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
            <option value='PO' {{($pmsdebitvoucher->reftype=='PO')? 'selected': ''}}>PO</option>
            <option value='PI' {{($pmsdebitvoucher->reftype=='PI')? 'selected': ''}}>PI</option>
            <option value='ADVANCE' {{($pmsdebitvoucher->reftype=='ADVANCE')? 'selected': ''}}>ADVANCE</option>
            <option value='AGAINST INVOICE' {{($pmsdebitvoucher->reftype=='AGAINST INVOICE')? 'selected': ''}}>AGAINST INVOICE</option>
            <option value='NA' {{($pmsdebitvoucher->reftype=='NA')? 'selected': ''}}>NA</option>
            </select>
           </td>
      </tr>
      <tr style="width: 100%">
        <td style="width: 20%;"><strong>Select a Project</strong></td>
        <td style="width: 30%;">
          <select name="projectid" class="form-control select2">
            <option value="">NONE</option>
            @foreach($projects as $project)
              <option value="{{$project->id}}" {{($pmsdebitvoucher->projectid==$project->id)? 'selected': ''}}>{{$project->projectname}}</option>
            @endforeach

          </select>
        </td>

        <td style="width: 20%;"><strong>Select a Expense Head</strong></td>
        <td style="width: 30%;">
          <select name="expenseheadid" class="form-control select2">
            <option value="">NONE</option>
            @foreach($expenseheads as $expensehead)
              <option value="{{$expensehead->id}}" {{($pmsdebitvoucher->expenseheadid==$expensehead->id)? 'selected': ''}}>{{$expensehead->expenseheadname}}</option>
            @endforeach

          </select>
        </td>
      </tr>
      <tr style="width: 100%">
      	<td style="width: 20%;"><strong>BILL DATE</strong></td>
      	<td style="width: 30%;">
      		<input type="text" class="form-control datepicker3" placeholder="Enter bill date" name="billdate" value="{{$pmsdebitvoucher->billdate}}" readonly="" required="">
      	</td>
      	 <td style="width: 20%;"><strong>BILL NO</strong></td>
      	 <td style="width: 30%;"><input type="text" name="billno" class="form-control" value="{{$pmsdebitvoucher->billno}}" required="" placeholder="Enter Bill No Here" autocomplete="off" onkeyup="checkbill(this.value)" required="">
          <p  class="label label-danger">If Bill No not available then Enter "NA"</p>
         </td>
      	
      </tr>
         
      

	</table>


	<table class="table table-responsive table-hover table-bordered table-striped">
  <tr class="bg-blue">
    <td class="text-center">AMOUNT DETAILS</td>
  </tr>

</table>

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
      <td><input  type="text" value="{{$pmsdebitvoucher->tsgst}}" class="form-control calc" id="tsgst" name="tsgst" autocomplete="off"></td>
      <td><strong>Total CGST</strong></td>
      <td><input  type="text" value="{{$pmsdebitvoucher->tcgst}}" class="form-control calc" id="tcgst" name="tcgst" autocomplete="off"></td>
    </tr>
    <tr>
      <td><strong>Total IGST</strong></td>
      <td><input  type="text" value="{{$pmsdebitvoucher->tigst}}" class="form-control calc" id="tigst" name="tigst" autocomplete="off"></td>
      <td><strong>Total Amount</strong></td>
      <td><input type="text" value="{{$pmsdebitvoucher->totalamt}}" class="form-control" id="totalamt" name="totalamt" readonly="" required=""></td>

    </tr>
    <tr>
      <td><strong>IT Deduction(in %)</strong></td>
      <td><input  type="text" class="form-control dedcalc" id="itdeduction" value="{{$pmsdebitvoucher->itdeduction}}" name="itdeduction" autocomplete="off" value="0"></td>
      <td><strong>OTHER DEDUCTION(in %)</strong></td>
      <td><input  type="text" class="form-control dedcalc" value="{{$pmsdebitvoucher->otherdeduction}}" id="otherdeduction" autocomplete="off" name="otherdeduction" value="0"></td>
    </tr>
    <tr>
          <td><strong>TCS AMOUNT</strong></td>
          <td><input type="text" value="{{$pmsdebitvoucher->tcsamount}}" class="form-control calc" id="tcsamount" autocomplete="off" name="tcsamount" value="0"></td>
                <td><strong>Final Price</strong></td>
      <td><input  type="text" class="form-control" value="{{$pmsdebitvoucher->finalamount}}" id="finalamount" name="finalamount"  required="" readonly=""></td>
                   
        </tr>

    <tr>
       <td><strong>Attachment</strong></td>
          <td>
          <input name="invoicecopy" type="file" onchange="readURL(this);" >
            <img style="height:40px;width:40px;" alt="noimage" id="imgshow">
          </td>
           <td><strong>Attachments</strong></td>

      <td>
        @if($pmsdebitvoucher->invoicecopy)
        <a href="{{asset('img/createdebitvoucher/'.$pmsdebitvoucher->invoicecopy)}}" target="_blank">
          <img style="height:90px;width:90px;" src="{{asset('img/createdebitvoucher/'.$pmsdebitvoucher->invoicecopy)}}" alt="noimage" id="imgshow">
        </a>
        <a href="{{asset('img/debitvoucher/'.$pmsdebitvoucher->invoicecopy)}}" class="btn btn-primary btn-sm" download>
          <span class="glyphicon glyphicon-download-alt"></span> Download
        </a>
        @else
        <p>No Attachments</p>
        @endif

      </td>
      </tr>
      <tr>
      
           <td><strong>Narration</strong></td>
          <td>
            <textarea class="form-control" name="narration" placeholder="Enter  Narration">{{$pmsdebitvoucher->narration}}</textarea>
          </td>
  
    </tr>
  </table>		

<table class="table table-responsive">
	<tr>
		<td ><button type="submit" class="btn btn-success pull-right btn-lg" onclick="return confirm('Do You Want to Proceed?')">Update</button></td>
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
          var tcsamount=$("#tcsamount").val();
        if(tcsamount=='') {
           gtcsamount = 0;
          }
          else
          {
            gtcsamount=tcsamount;
          }

      
      var totalamt=Number.parseFloat((parseFloat(gtprice)-parseFloat(gdiscount))+(parseFloat(gtcgst)+parseFloat(gtsgst)+parseFloat(gtigst)+parseFloat(gtcsamount))).toFixed(2);

      $("#totalamt").val(totalamt);
      $("#finalamount").val(Math.round(totalamt).toFixed(2));
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

          $("#finalamount").val(Math.round(final).toFixed(2));
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