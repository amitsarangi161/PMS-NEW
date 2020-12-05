@extends('layouts.hr')

@section('content')
<style type="text/css">
  .select2-selection__choice {
    background-color: #e16767!important;
  }
</style>
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
  <tr class="bg-navy">
     <td class="text-center">Daily Attendance Report</td>
  </tr>

</table>


<form action="/saveattendancereportgrp" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>SELECT A GROUP NAME *</label>
          <select class="form-control select2" onchange="fetchlabour(this.value);" id="groupid"  name="groupid" required="" style="width: 100%;">
            <option value="">SELECT A GROUP</option>
               @foreach($groups as $key => $group)
               <option value="{{$group->id}}">{{$group->groupname}}</option>
               @endforeach
          </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>SELECT LABOUR*</label>
          <select class="form-control select2" id="labour"  name="labour[]" required="" style="width: 100%;" multiple>


          </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>ENTRY TIME*</label>
          <input type="text" class="form-control datetimepicker1" autocomplete="off" name="entrytime" id="entrytime">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>DEPARTURE TIME</label>
          <input type="text" class="form-control datetimepicker1" autocomplete="off" id="departuretime" name="departuretime">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Full Day/Half</label>
          <select id="nof" name="nof" class="form-control">
              <option value="8">Full Day</option>
              <option value="4">Haf Day</option>
          </select>
      </div>
    </div>
     <div class="col-md-6">
      <div class="form-group">
        <label>OT Hour</label>
        <input type="text" value="0" class="form-control" autocomplete="off" id="nofot" name="nofot">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label></label>
          <button type="button" class="btn btn-success" onclick="fetchlabourdetails();">Fetch</button>
      </div>
    </div>
  </div>

  <div style="display: none;" id="labourdtldiv">
    <table class="table">
      <thead>
        <tr>
          <td>Slno</td>
          <th>EmpId</th>
          <th>Name</th>
         <!--  <th>Entry</th>
          <th>Departure</th> -->
          <th>Day</th>
          <th>OT Hr</th>
          <th>Wages</th>
          <th>Ot Amt</th>
          <th>Tot Amt.</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody id="labourdtl">
        
      </tbody>

      
    </table>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>NUMBER OF WORKERS*</label>
          <input type="text" id="noofworkerid" class="form-control" name="noofworkerspresent">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>TOTAL WAGES*</label>
          <input type="text" id="totalwagesid" class="form-control" name="twages">
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>TOTAL OT*</label>
          <input type="text" id="totalotid" class="form-control" name="tot">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>TOTAL AMOUNT*</label>
          <input type="text" id="totalotamt" class="form-control" name="tamt">
      </div>
    </div>
  </div>

   <!--  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>ITEM DESCRIPTION*</label>
          <input type="text" class="form-control" name="itemdescription">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>UNIT(Kg/No.)*</label>
          <input type="text" class="form-control" name="unit">
      </div>
    </div>
  </div> -->

  <!--   <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>QUANTITY*</label>
          <input type="text" class="form-control" name="quantity">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>AMOUNT*</label>
          <input type="text" class="form-control" name="amount">
      </div>
    </div>
  </div> -->
<!--   <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>WORK ASSIGNMENT*</label>
          <textarea class="form-control" name="workassignment"></textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>REMARKS*</label>
          <textarea class="form-control" name="remarks"></textarea>
      </div>
    </div>
    
  </div> -->

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Group Photo*<span style="color: red;font-weight: bold;">(Multiple images uplaod)</span></label>
          <input name="photo[]" type="file" multiple="" onchange="readURL1(this)">
          <img id="imgshow1" src="#" alt="No Image Selected" style="height: 60px;width: 50px;">
      </div>
    </div>
  </div>
</div>

</div>
<div style="display: none;" id="submitbtnid">
<table class="table table-responsive">
  <tr>
    <td ><button type="submit" class="btn btn-success pull-right" onclick="return confirm('Do You Want to Proceed?')">Submit</button></td>
  </tr>
</table>
</div>

</form>

  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT GROUP DETAILS</h4>
      </div>
      <div class="modal-body">


            <table class="table table-responsive table-hover table-bordered table-striped">


    <tr>
     <td><strong>EMPLOYEE ID<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="modeid" id="modeid" placeholder="Enter Group Name" class="form-control" required></td>
   
    
   </tr>
   <tr>
     <td><strong>EMPLOYEE NAME<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="employeename" id="modemployeename" placeholder="Enter Group Name" class="form-control" required></td>
   
    
   </tr>
   <tr>
     <td><strong>Day<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" name="totnoday" id="modtotnoofdy" placeholder="Enter Group Name" class="form-control" required readonly=""></td>
   </tr>
   <tr>
     <td><strong>Change Full day/Half day<span style="color: red"> *</span></strong></td>
     <td>
       <select class="form-control modcalc" id="modday">
          <option value="">Select type</option>
          <option value="8">Full Day</option>
          <option value="4">Half Day</option>
       </select>
     </td>
   
    
   </tr>
   <tr>
     <td><strong>OT HOURS<span style="color: red"> *</span></strong></td>
     <td><input type="text" autocomplete="off" id="modothours" placeholder="Enter Group Name" class="form-control modcalc"></td> 
   </tr>
   <tr>
     <td><strong>WAGES<span style="color: red"> *</span></strong></td>
     <td><input type="text"  readonly="" autocomplete="off" name="wages" id="modwages" placeholder="Enter Group Name" class="form-control" required></td> 
   </tr>
   <tr>
     <td><strong>OT AMOUNT<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="otamount" id="modotamount" placeholder="Enter Group Name" class="form-control" required></td> 
   </tr>
    <tr>
     <td><strong>TOTAL AMOUNT<span style="color: red"> *</span></strong></td>
     <td><input type="text" readonly="" autocomplete="off" name="totamt" id="modtotamt" placeholder="Enter Group Name" class="form-control" required></td> 
   </tr>
   <tr>
    <td colspan="2" style="text-align: right;"><button type="submit" onclick="update();" class="btn btn-success">Update</button></td>
   </tr>
</table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<script>
  $('.datetimepicker1').datetimepicker({ 
  format: 'YYYY-MM-DD hh:mm A'
});
function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function fetchlabour(groupid){
    $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchlabour")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      groupid:groupid,

                     },

               success:function(data) { 
                 $('#labour').empty();
                $.each(data, function (i, item) {
  
     $('#labour')
         .append($("<option></option>")
                    .attr("value", item.id)
                    .attr("selected", "")
                    .text(item.employeename));
});
               }
             });

  }
  function fetchlabourdetails(selected){
    var entrytime=$("#entrytime").val();
    var nof=$("#nof").val();
    var nofot=$("#nofot").val();
    var departuretime=$("#departuretime").val();
    var labour=$("#labour").val();
    var groupid=$("#groupid").val();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchlabourfromgrp")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      entrytime:entrytime,
                      departuretime:departuretime,
                      labour:labour,
                      groupid:groupid,
                      nof:nof,
                      nofot:nofot
                     },

               success:function(data) { 
                var html='';
                var totalwages=0;
                var totalot=0;
                var subtotal=0;
                $.each(data, function (i, value) {
                  html+='<tr>'+
                        '<td>'+(++i)+'</td>'+
                        '<td>'+'<input type="hidden" class="countlab" name="id[]" value="'+value.id+'">'+value.id+'</td>'+
                        '<td>'+'<input type="hidden" name="employeename[]" value="'+value.employeename+'">'+value.employeename+'</td>'+
                        // '<td>'+'<input type="hidden" name="entrytime[]" value="'+value.entrytime+'">'+value.entrytime+'</td>'+
                        // '<td>'+'<input type="hidden" name="departuretime[]" value="'+value.departuretime+'">'+value.departuretime+'</td>'+
                        /*'<td>'+'<input type="hidden" class="counttothr" name="totnoofhour[]" value="'+value.totnoofhour+'">'+value.totnoofhour+'</td>'+*/
                        '<td>'+'<input type="hidden" class="counttothr" name="totnoofday[]" id="rowday'+value.id+'" value="'+value.day+'"><p id="rowday1'+value.id+'">'+value.day+'</p></td>'+
                        '<td>'+'<input type="hidden" class="countothr" name="othours[]" id="rowothr'+value.id+'" value="'+value.othours+'"><p id="rowothr1'+value.id+'">'+value.othours+'</p></td>'+
                        '<td>'+'<input type="hidden" class="countwages" name="wages[]" value="'+value.wages+'">'+value.wages+'</td>'+
                        '<td>'+'<input type="hidden" id="rowotamt'+value.id+'" class="countotamt" name="otamount[]" value="'+value.otamount+'"><p id="rowotamt1'+value.id+'">'+value.otamount+'</p></td>'+
                        '<td>'+'<input type="hidden" id="rowtotamt'+value.id+'" class="counttotamt" name="totamt[]" value="'+value.totamt+'"><p id="rowtotamt1'+value.id+'">'+value.totamt+'</p></td>'+
                        '<td>'+'<button type="button" onclick="edit('+value.id+',\''+ value.employeename + '\',\''+value.day+'\',\''+value.othours+'\',\''+value.wages+'\',\''+value.otamount+'\',\''+value.totamt+'\')">EDIT</button>'+'</td>'+
                        '</tr>';
                
                });
                 $("#labourdtl").html(html);
                 $("#labourdtldiv").show();
                 $("#submitbtnid").show();
                 $("#fetchbtnid").hide();
                 sumofrow();

               }
             });
     }
function sumofrow()
{

    var totallabour = 0;
    var totalwages=0;
    var totalotamt=0;
    var totalamt=0;
    var totalothr=0;
    var totalhr=0;
    $('.countlab').each(function (index, element) {
        totallabour =totallabour+1; 
    });
    $('.countwages').each(function (index, element) {
            totalwages = totalwages + parseFloat($(element).val());
        });
    $('.countotamt').each(function (index, element) {
            totalotamt = totalotamt + parseFloat($(element).val());
        });
    $('.counttotamt').each(function (index, element) {
            totalamt = totalamt + parseFloat($(element).val());
        });
    $('.countothr').each(function (index, element) {
            totalothr = totalothr + parseFloat($(element).val());
        });
    $('.counttothr').each(function (index, element) {
            totalhr = totalhr + parseFloat($(element).val());
        });
  $('#totalwagesid').val(totalwages.toFixed(2));
  $('#totalotid').val(totalotamt.toFixed(2));
  $('#totalotamt').val(totalamt.toFixed(2));
  $('#noofworkerid').val(totallabour);



}
function edit(id,employeename,totnoofday,othours,wages,otamount,totamt){
          $("#modeid").val(id);
          $("#modemployeename").val(employeename);
          if (totnoofday==1) {
            $("#modday").val(8);
          }
          else{
            $("#modday").val(4);
          }
          $("#modtotnoofdy").val(totnoofday);
          $("#modothours").val(othours);
          $("#modwages").val(wages);
          $("#modotamount").val(otamount);
          $("#modtotamt").val(totamt);
          $("#myModal").modal('show');
}

 $(".modcalc").on('change input', function(){
   var dayType=parseFloat($("#modday").val());
   var workingmin=dayType*60;
   var wages=parseFloat($("#modwages").val());
   var getot= parseFloat($("#modothours").val());
   if(getot){
     ot=getot;
   }
   else{
     ot=0;
   }
   var otmin=ot*60;
    var minutes=8*60;
    var wagesperminute=wages/minutes;
    var amt=parseFloat(workingmin*wagesperminute).toFixed(2);
    var otamt=parseFloat(otmin*wagesperminute).toFixed(2);
    var total=(parseFloat(amt)+parseFloat(otamt)).toFixed(2);
     $("#modotamount").val(otamt);
     $("#modtotamt").val(total);
 });
function update(){
   var id=$("#modeid").val();
    var ot= $("#modotamount").val();
     var totamt=$("#modtotamt").val();
     var dayType=$("#modday").val();
     var othr=$("#modothours").val();
     if(dayType==8){
       day=1;
     }
     else
     {
       day=0.5;
     }

var a='#rowday'+id;
var a1='#rowday1'+id;
$(a).val(day);
$(a1).text(day);
var b= '#rowothr'+id;
var b1= '#rowothr1'+id;
$(b).val(othr);
$(b1).text(othr);
var c='#rowotamt'+id;
var c1='#rowotamt1'+id;
$(c).val(ot);
$(c1).text(ot);
var d='#rowtotamt'+id;
var d1='#rowtotamt1'+id;
$(d).val(totamt);
$(d1).text(totamt);
sumofrow();
$("#myModal").modal('hide');
}
</script>
@endsection