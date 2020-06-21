@extends('layouts.account')
@section('content')
<style type="text/css">
.bigdrop {
    width: 700px !important;
}
.select2-container {
  width: 700px!important;
}


  .select2-container--default .select2-selection--multiple .select2-selection__choice {

    background-color: black!important;
    border: 1px solid black!important;
  
}

.select2-search__field{
  width: 650px!important;
}

</style>
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif
@if(Session::has('err'))
   <p class="alert alert-danger text-center">{{ Session::get('err') }}</p>
@endif

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<table class="table table-responsive table-hover table-bordered table-striped">
  <tr class="bg-navy">
     <td class="text-center">VOUCHER POSTING</td>
  </tr>

</table>

<div class="col-md-12">
<form action="/savevoucher" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
<div class="table-responsive">
  <table class="table table-responsive table-hover">
     <tr>
         <td><strong>ENTER VOUCHER TYPE</strong> *</td>
         <td>
          <select class="form-control select2" name="vouchertype">
              <option value="">Select Voucher Type</option>
                  <option value="INVOICE">INVOICE</option>
                  <option value="PAYMENT">PAYMENT</option>


             </select>  
         </td>
      
         <td><strong>ENTER PARTY/VENDOR</strong> *</td>
         <td>
          <select class="form-control select2" name="vouchertype">
              <option value="">Select Vendor</option>
              @foreach($vendors as $vendor)
                  <option value="{{$vendor->id}}">{{$vendor->vendorname}}</option>
                @endforeach


             </select>  
         </td>
      </tr>
      <tr>
         <td><strong>PAYMENT MODE</strong> *</td>
         <td>
          <select class="form-control select2" name="vouchertype">
              <option value="">Select Payment Mode</option>
                  <option value="CASH">CASH</option>
                  <option value="CHEQUE">CHEQUE</option>
                  <option value="ONLINE">ONLINE</option>
                  <option value="PDC">PDC</option>
                  <option value="DD">DD</option>
                  <option value="TDR">TDR</option>
                  <option value="NSC">NSC</option>


             </select>  
         </td>
      </tr>
     <!-- <tr>
         <td><strong>ENTER PAYEE NAME</strong> *</td>
         <td>
          <input type="text" name="payeename" autocomplete="off" class="form-control" placeholder="Enter Payee Name" required="">
 
         </td>
      </tr> -->
        <tr>
         <td><strong>BANK</strong> </td>
         <td>
             <select class="form-control select2" name="bankid">
              <option value="">Select a Bank</option>
                @foreach($banks as $bank)
                  <option value="{{$bank->id}}">{{$bank->bankname}}</option>
                @endforeach


             </select>  
         </td>
      </tr>
         <tr>
         <td><strong>ACCOUNT NO</strong> *</td>
           <td>
               <input type="text" name="acno" class="form-control" autocomplete="off" placeholder="Enter Payee Acount No">
           </td>
         </tr>
         <tr>
         <td><strong>IFSC</strong></td>
           <td>
               <input type="text" name="ifsccode" class="form-control" autocomplete="off"  placeholder="Enter Payee IFSC CODE">
           </td>
         </tr>
            <tr>
         <td><strong>IF CHEQUE? DETAILS</strong></td>
           <td>
               <textarea name="chequedetails" class="form-control" autocomplete="off"  placeholder="Enter CHEQUE DETAILS"></textarea>
           </td>
         </tr>
      <tr>
         <td><strong>SELECT A SITE/PROJECT NAME *</strong></td>
         <td>
          <select class="form-control select2" name="projectid" required="">

            <option value="">select a project</option>

          @foreach($projects as $project)

              @if($project->projectname!='')
             <option value="{{$project->id}}" title="{{$project->projectname}}">{{$project->projectname}}</option>
             @endif

                 
          @endforeach 
          </select>
         </td>
      </tr>
    
       <tr>
        <td><strong>EXPENSE HEAD *</strong></td>
        <td>
          <select class="form-control select2 calc" name="expenseheadid" onchange="getparticulars();" id="expenseheadid" required="">
            <option value="">Select a Expense Head</option>
            @foreach($expenseheads as $expensehead)
                <option value="{{$expensehead->id}}">{{$expensehead->expenseheadname}}</option>
            @endforeach
            
          </select>
        </td>
      </tr>


      <tr>
        <td><strong>PARTICULARS</strong></td>
        <td>
          <select class="form-control select2" name="particularid" id="particularid">
            
          </select>
        </td>
      </tr>
      

       <tr>

        <td><strong>AMOUNT *</strong></td>
        <td>
           <input type="text" name="amount" id="amount" placeholder="Enter Amount Here" autocomplete="off" class="form-control calc" required="">
        </td>
      </tr>
      <tr>

        <td><strong>TDS IN PERCENT</strong></td>
        <td>
           <input type="text" name="tds" value="0" id="tds" placeholder="Enter TDS PERCENT" autocomplete="off" class="form-control calc">
        </td>
      </tr>
        <tr>

        <td><strong>TDS AMOUNT</strong></td>
        <td>
           <input type="text" name="tdsamt" id="tdsamt" autocomplete="off" class="form-control" readonly="">
        </td>
      </tr>
       <tr>

        <td><strong>FINAL AMOUNT</strong></td>
        <td>
           <input type="text" name="amounttopay" id="amounttopay" placeholder="Enter TDS PERCENT" autocomplete="off" readonly="" class="form-control calc">
        </td>
      </tr>
        <tr>
          <td><strong>DESCRIPTION *</strong></td>
          <td>
            <textarea class="form-control" name="description" required="" placeholder="Enter  Description"></textarea>
          </td>
        </tr>
       
      <tr id="image">
        <td><strong>Upload Copy Of Invoice/Recipt </strong></td>
        <td>
         <input type="file" id="uploadedfile" name="uploadedfile" onchange="readURL(this);" >
           <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow">
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success btn-lg" id="subbutton" onclick="return confirm('Do You Want to Proceed?');">SAVE</button></td>
       
      </tr>

  </table>
</div>
</form>

</div>
<!-- <div class="col-md-4">


</div> -->

<script type="text/javascript">
$(document).ready(function(){
$('input,select').on('keypress', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
        console.log($next.length);
        if (!$next.length) {
            $next = $('[tabIndex=1]');
        }
        $next.focus();
    }
});

});




  $( ".calc" ).on("change paste keyup", function() {
       var getamt=$('#amount').val();
       if (getamt=='') {
         var amount=0;
       }
       else{
          var amount=getamt;
       }
        var gettds=$('#tds').val();
       if (gettds=='') {
         var tds=0;
       }
       else{
          var tds=gettds;
       }

       var tdsamt=parseFloat(amount)*(parseFloat(tds)/100);
       var amounttopay=amount-tdsamt;
       $("#tdsamt").val(tdsamt);
       $("#amounttopay").val(amounttopay);
  });
 
   function getparticulars()

  {
    var expenseheadid=$("#expenseheadid").val();

 $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetparticulars")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      expenseheadid:expenseheadid

                     },

               success:function(data) { 
                            var y="<option value=''>NONE</option>";
                           $.each(data,function(key,value){

                            var x='<option value="'+value.id+'">'+value.particularname+'</option>';
                             y=y+x;
                            

                           });
                           $("#particularid").html(y);

                        
                     
                 
                }
              });


  }
   function readURL(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
                    .width(95)
                    .height(70);
          
            };

            reader.readAsDataURL(input.files[0]);

        }
    }

</script>



@endsection