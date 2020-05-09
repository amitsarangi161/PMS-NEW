@extends('layouts.app')
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
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
  <tr class="bg-navy">
     <td class="text-center">EXPENSE ENTRY</td>
  </tr>

</table>
<div class="well" style="font-size: 20px;background-color: violet;">
  <div class="table-responsive">
    <table class="table">
      <tr>

      <td><strong>TOTAL PAID AMOUNT TILL DATE :</strong>  {{$totalamt}}</td>
      <td><strong>TOTAL EXPENSE TILL DATE :</strong> {{$totalamtentry}}</td>
      <td><strong>BALANCE AMOUNT :</strong> {{$bal}}</td>
       <td><strong>+</strong> <img src="{{asset('wallet.png')}}" style="height: 40px;width: 40px;">Rs. {{$walletbalance}}</td>
      </tr>
      </tr>
      
    </table>
    
  </div>
  
</div>
<div class="well">
<table class="table  table-bordered" id="expensetable" style="display: none;background-color: #abff00;" >
  <thead>
    <tr class="bg-navy">
      <th>EXPENSE HEAD</th>
      <th>TOTAL AMOUNT RECIVED</th>
      <th>TOTAL EXPENSES MADE</th>
      <th>TOTAL BALALNCE</th>

    </tr>
  </thead>
  <tbody id="appendexpensedetails">
       
  </tbody>

  <tfoot id="expensefooters">
    
  </tfoot>
  
</table>
</div>

<form action="/saveuserexpenseentry" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
<div class="table-responsive">
  <table class="table table-responsive table-hover">
   <!--    <tr>
         <td>SELECT EMPLOYEE</td>
         <td>
          <select class="form-control select2" name="employeeid" required="">
            <option value="">Select a User</option>
            @foreach($users as $user)
               <option value="{{$user->id}}">{{$user->name}}</option>

            @endforeach
            
          </select>
         </td>
      </tr> -->

  

      <tr>
         <td><strong>SELECT A SITE/PROJECT NAME *</strong></td>
         <td>
          <select class="form-control select2 calc" id="projectid" onchange="showrequistion();"  name="projectid" required="">

            <option value="">select a project</option>

          @foreach($projects as $project)

              @if($project->projectname!='')
             <option value="{{$project->proid}}" title="{{$project->orgname}}">{{$project->projectname}}</option>
             @else

              <option value="OTHERS" title="OTHERS">OTHERS</option>
             @endif

                 
          @endforeach 
          </select>
         </td>
      </tr>



      <tr>
        <td><strong>SELECT A REQUISITION <span style="color:red;">*</span></strong></td>
        <td>
          <select class="form-control select2 calc" id="requistionno" onchange="showclient();"  name="requistion_id" required="">
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
<!--       <tr>
        <td><strong>SELECT A TYPE OF PAYMENT *</strong></td>
        <td>
          
           <input type="radio" name="type" value="OTHERS" checked> OTHERS  
           &nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <input type="radio" name="type" value="LABOUR PAYMENT"> LABOUR PAYMENT
            &nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <input type="radio" name="type" value="VEHICLE PAYMENT"> VEHICLE PAYMENT 
        </td>

      </tr> -->


      <tr>
        <td><strong>TOTAL UPDATE AMOUNT RECIVED TILL DATE</strong></td>
        <td>
          <input type="text" readonly=""  class="form-control" id="totalamt">
        </td>
      </tr>
      <tr>
        <td><strong>TOTAL EXPENSES MADE TILL DATE</strong></td>
        <td>
          <input type="text" readonly=""  class="form-control" id="totalexpense">
        </td>
      </tr>
      <tr>
        <td><strong>BALANCE AMOUNT AVILABLE</strong></td>
        <td>
          <input type="text" readonly=""  class="form-control" id="balance" name="bala1">
          <input type="hidden" id="bala" name="bala">
        </td>
      </tr>
      <tr>
        <td><strong>PARTICULARS</strong></td>
        <td>
          <select class="form-control select2" name="particularid" id="particularid">
            
          </select>
        </td>
      </tr>
       <!-- <tr>
          <td><strong>VENDOR </strong></td>
          <td>
            <select class="form-control select2" name="vendorid">
              <option value="">Select a Vendor</option>
              @foreach($vendors as $vendor)
              <option value="{{$vendor->id}}">{{$vendor->vendorname}}</option>
              @endforeach              
            </select>
          </td>
        </tr> -->
 
      <tr id="singledate">

        <td><strong>DATE OF EXPENSE *</strong></td>
        
        <td><input type="text" name="date" id="date" class="form-control datepicker1 readonly" autocomplete="off" placeholder="Date Of Expense" required=""></td>
        
      </tr>

      <tbody id="doubledate" style="display: none;">
        <tr>
          <td><strong>FROM DATE *</strong></td>
          <td><input type="text" name="fromdate" id="fromdate" class="form-control datepicker readonly" autocomplete="off" placeholder="From Date"></td>
        </tr>
        <tr>
           <td><strong>TO DATE *</strong></td>
          <td><input type="text" name="todate" id="todate" class="form-control datepicker readonly" autocomplete="off" placeholder="To Date">
          <p id="err"></p>
          </td>
        </tr>
        
      </tbody>
      <tbody id="showlabourdetails" style="display: none;background-color: aqua;">
        
      </tbody>

      <tr>
       <tr>

        <td><strong>EXPENSE AMOUNT *</strong></td>
        <td>
           <input type="text" name="amount" id="amount" placeholder="Enter Amount Here" autocomplete="off" class="form-control" required="">
        </td>
      </tr>
        <tr>
          <td><strong>DESCRIPTION *</strong></td>
          <td>
            <textarea class="form-control" name="description" required="" placeholder="Enter Expense Description"></textarea>
          </td>
        </tr>
        <tr>
           <td><strong>TRANSFER TO WALLET*</strong></td>
           <td>
             <select onchange="removeimagerequired(this.value);" name="towallet" class="form-control" required="">
                <option value="NO" selected="">NO</option>
                <option value="YES">YES</option>
               
             </select>
             <p style="color: red;"> <b>Note:-If You Have not Spent this money and you Want to surrender this Money then Yes</b></p>
           </td>
        </tr>
         <tr id="image">
        <td><strong>Upload Copy Of Invoice/Recipt * </strong></td>
        <td>
         <input type="file" id="uploadedfile" name="uploadedfile" onchange="readURL(this);" required="">
           <p class="help-block">Upload .png, .jpg or .jpeg image files only</p>

            <img style="height:70px;width:95px;" alt="noimage" id="imgshow">
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;font-size: 30px;"> <p id="errormsg" style="color: red;"></p></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success btn-lg" id="subbutton" onclick="return confirm('Do You Want to Proceed?');">SAVE</button></td>
       
      </tr>

  </table>
</div>
</form>




<script type="text/javascript">
$('#fromdate').change(function(){
     $("#todate").val('');
     $("#showlabourdetails").empty();
     $("#showlabourdetails").hide();
});


function showrequistion()
  {
    var projectid=$("#projectid" ).val();
if (projectid!='') {
  
  $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

  $.ajax({
           type:'POST',
          
           url:'{{url("/ajaxgetuserallrequistion")}}',
          
           data: {
                 "_token": "{{ csrf_token() }}",
                
                  projectid:projectid,
                 },

           success:function(data) { 

            $("#expensetable").hide();
                var y="<option value=''>select a requistion</option>";
                           $.each(data,function(key,value){

                            var x='<option value="'+value.id+'">Req#'+value.id+' || Rs.'+value.approvalamount+'('+value.created_at+')</option>';
                             y=y+x;
                           });
                           $("#requistionno").html(y);
                //$("#expenseheadid").select2('data', {});;
           }
      });
  }
}
function fetchdataaccordingly()
{
     var fromdate=$("#fromdate").val();
     var todate=$("#todate").val();
     var type=$('input[name=type]:checked').val();
     var projectid=$("#projectid").val();

     if (type=='LABOUR PAYMENT') {

            $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetlaboursforexpenseentry")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      fromdate:fromdate,
                      todate:todate,
                      projectid:projectid

                     },

               success:function(data) { 
                   $("#showlabourdetails").empty();
                   $("#showlabourdetails").show();
                   var x='<tr><td>DATE</td><td>NO OF LABOUR</td></tr>';
                  $.each(data.data,function(key,value)
                  {
                      x=x+'<tr><td>'+value.date+'<input type="hidden" name="dailylabour[]" value="'+value.id+'"></td>'+
                          '<td>'+value.nooflabour+'</td></tr>';
                  });

                  x=x+'<tr><td></td><td>TOTAL NO OF LABOUR='+data.totalno+'<input type="hidden" name="totalnolabour[]" value="'+data.totalno+'"></td></tr>';
               
                  $("#showlabourdetails").html(x);
               }
             });
     }

     else if (type=='VEHICLE PAYMENT') {
           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetvehiclesforexpenseentry")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      fromdate:fromdate,
                      todate:todate,
                      projectid:projectid

                     },

               success:function(data) { 

                   $("#showlabourdetails").empty();
                   $("#showlabourdetails").show();
                   var x='<tr><td>DATE</td><td>DETAILS</td></tr>';
                 $.each(data,function(key,value){
                    x=x+'<tr><td>'+value.date+'</td><td>'+value.vehiclename+'/'+value.vehicleno+'<input type="hidden" name="dailyvehicles[]" value="'+value.id+'"></td></tr>';
                 });
                 $("#showlabourdetails").html(x);

               }
             });
       
     }
}

$('#todate').change(function(){
     var fromdate=$("#fromdate").val();
     var todate=$("#todate").val();
     if (fromdate!='') {
         var x = new Date(fromdate);
         var y = new Date(todate);
         if (x<=y) {
          //alert("true");
          fetchdataaccordingly();
         }
         else
         {
          alert("fromdate Must be less than todate");
           $("#todate").val('');
         }
     }
     else
     {
         alert("Enter From Date first");
         $("#todate").val('');
     }
});
  function removeimagerequired(val)
  {
    if(val=='YES')
    {
        $("#uploadedfile").removeAttr('required');

    }
    else
    {
        $("#uploadedfile").attr('required', 'required');
    }

  }

  $('input[type=radio][name=type]').change(function() {

    $("#showlabourdetails").empty();
     $("#showlabourdetails").hide();
     $("#fromdate").val('');
     $("#todate").val('');
    if (this.value == 'LABOUR PAYMENT') {
         $("#singledate").hide();
         $("#doubledate").show();
         $("#fromdate").attr('required','required');
         $("#todate").attr('required','required');
         $("#date").removeAttr('required');
         $("#image").hide();
         $("#uploadedfile").removeAttr('required');

         

    }
    else if (this.value == 'VEHICLE PAYMENT') {
       $("#singledate").hide();
       $("#doubledate").show();
        $("#fromdate").attr('required','required');
        $("#todate").attr('required','required');

        $("#date").removeAttr('required');
            $("#image").hide();
         $("#uploadedfile").removeAttr('required');
    }
    else
    {
         $("#doubledate").hide();
         $("#singledate").show();
          $("#fromdate").removeAttr('required');
          $("#todate").removeAttr('required');
          $("#date").attr('required','required');
              $("#image").show();
         $("#uploadedfile").attr('required','required');
    }
});

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

  function showclient()
  {
        /*var cn=$("#projectid option:selected" ).attr("title");
        alert (cn);
        $("#clientname").val(cn);*/
         var pid=$("#projectid").val();
         var reqid=$("#requistionno").val();
        ajaxfetchallamount(pid,reqid);
        fetchdataaccordingly();

  }


   function ajaxfetchallamount(pid,reqid)
   { 

           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetamountexpensehead")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      projectid:pid,
                      reqid:reqid,

                     },

               success:function(data) { 
                            $("#expensetable").show();
                            $("#appendexpensedetails").empty();
                             $("#expensefooters").empty();
                            var totaltotalamt=0;
                            var totaltotalexpense=0;
                            var totalbalance=0;
                          $.each(data,function(key,value){

                            if(value.totalamt!=0)
                            {
                                   totaltotalamt=totaltotalamt+value.totalamt;
                                    totaltotalexpense=totaltotalexpense+value.totalexpense;
                                     totalbalance=totalbalance+value.balance;
                               var x='<tr><td><b>'+value.expenseheadname+'</b></td>'+'<td>'+value.totalamt+'</td>'+'<td>'+value.totalexpense+'</td>'+'<td>'+value.balance+'</td></tr>';
                            }
                           

                          $("#appendexpensedetails").append(x);
                             
                          });

                        var y='<tr class="bg-gray"><td><strong>TOTAL<strong></td><td>'+totaltotalamt+'</td><td>'+totaltotalexpense+'</td><td>'+totalbalance+'</td></tr>';
                        
                        $("#expensefooters").html(y);
                }
              });
   }
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



  

$( ".calc" ).change(function() {
     var pid=$("#projectid").val();
     var eid=$("#expenseheadid").val();
     var reqid=$("#requistionno").val();
     if(pid!='' && eid!='')
     {
             $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetamountuser")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      projectid:pid,
                      expenseheadid:eid,
                      requistionid:reqid,

                     },

               success:function(data) { 
                

                $("#totalamt").val(data.totalamt);
                $("#totalexpense").val(data.totalexpense);
                $("#balance").val(data.balance);
                $("#bala").val(data.balance);
                 $("#amount").val('');
               }
             });
     }
});

$("#amount").on('change input', function(){
     
      $("#balance").val($("#bala").val()-$('#amount').val());

      var bal=$("#bala").val()-$('#amount').val();
      if(bal<0)
      {
         $("#subbutton").attr("disabled", true);
         $("#errormsg").html("Your Amount Must be less than balance amount");
      }
      else
      {
         $("#subbutton").removeAttr("disabled");
         
         $("#errormsg").html("");
      }
     
});


</script>
@endsection