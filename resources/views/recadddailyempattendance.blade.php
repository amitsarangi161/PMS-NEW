@extends('layouts.app')

@section('content')
<style type="text/css">
  .select2-selection__choice {
    background-color: #e16767!important;
  }
    .container { border:2px solid #ccc; width:485px; height: 150px; overflow-y: scroll;
  }
</style>
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif
@if(Session::has('error'))
   <p class="alert alert-danger text-center">{{ Session::get('error') }}</p>
@endif

<table class="table table-responsive table-hover table-bordered table-striped">
  <tr class="bg-navy">
     <td class="text-center">Daily Attendance Report</td>
  </tr>

</table>


<form action="/saverecattendanceemployee" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>SELECT A GROUP NAME *</label>
          <select class="form-control select2" onchange="fetchemployee(this.value);" id="empgroupid"  name="empgroupid" required="" style="width: 100%;">
            <option value="">SELECT A GROUP</option>
               @foreach($empgroups as $key => $group)
               <option value="{{$group->id}}">{{$group->groupname}}</option>
               @endforeach
          </select>
      </div>
    </div>
    <div class="col-md-3">
      <label >WORKING/HOLIDAY</label>
      <select class="form-control" id="type" onchange="changeType(this.value);" name="type">
        <option value="WORKINGDAY">WORKINGDAY</option>
        <option value="HOLIDAY">HOLIDAY</option>
      </select>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ATTENDANCE DATE*</label>
          <input type="text" class="form-control datepicker1" autocomplete="off" name="date" id="attendancedate">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
          <div></div>
          <button id="save" type="button" style="margin-top: 23px;display: none;"  class="btn btn-success" onclick="fetchlabourdetails();">submit</button>
          <button id="fetch" type="button" style="margin-top: 23px;" class="btn btn-success" onclick="fetchlabourdetails();">Fetch</button>
      </div>
    </div>
  </div>

  <div  id="labourdtldiv" style="display: none;">
    <table class="table table-responsive table-hover table-bordered table-striped">
      <thead>
        <tr class="bg-navy">
          <td>Slno</td>
          <th>NAME</th>
          <th>DATE</th>
          <th>ATTENDANCE</th>
          <th>FULL/HALF</th>
        </tr>
      </thead>
      <tbody id="labourdtl">
        
      </tbody>

      
    </table>

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
  format: 'YYYY-MM-DD'
});
  $('.timepicker1').datetimepicker({ 
  format: 'hh:mm A'
});
  function changeType(val){
    //alert(val);
     if(val=='WORKINGDAY'){
         $("#save").hide();
         $("#fetch").show();

     }
     else{
       $("#save").show();
         $("#fetch").hide();
     }
  }
function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function fetchemployee(empgroupid){
    $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchemployee")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      empgroupid:empgroupid,

                     },

               success:function(data) { 
                 $('#employees').empty();
                $.each(data, function (i, item) {
  
     		 $('#employees')
         .append('<input type="checkbox" checked class="checkitems" value="'+item.id+'">'+item.employeename+'</br>');
         });
               }
             });

  }
  function fetchlabourdetails(selected){
    var attendancedate=$("#attendancedate").val();
    var empgroupid=$("#empgroupid").val();
    var type=$("#type").val();
    //alert(type);
    if (attendancedate!='' && empgroupid!='' && type!='') {
      if(type=='WORKINGDAY'){
         $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchemployeeattngrp")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                    
                      attendancedate:attendancedate,
                      empgroupid:empgroupid,
                      type:type
                     },

               success:function(data) { 
                var html='';
                $.each(data.employees, function (index, value) {
                  html+='<tr id="color'+index+'">'+
                        '<td>'+'<input type="hidden" class="countlab" name="id[]" value="'+value.id+'">'+value.id+'</td>'+
                        '<td>'+'<input type="hidden" name="employeename[]" value="'+value.employeename+'">'+value.employeename+'</td>'+
                        '<td>'+'<input type="hidden" class="countlab" name="attendancedate[]" value="'+data.attendancedate+'">'+data.attendancedate+'</td>'+
                         '<td>'+
                           '<select  class="form-control" name="present[]" onchange="changeRowColor(this.value,'+index+')">'+
                           '<option value="Y">PRESENT</option>'+
                           '<option value="N">ABSENT</option>'+
                          '</select>'+
                        '</td>'+
                        '<td>'+
                           '<select  class="form-control" name="halffull[]">'+
                           '<option value="F">FULL</option>'+
                           '<option value="H">HALF</option>'+
                          '</select>'+
                        '</td>'+
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
      else{
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxholidayemployee")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     attendancedate:attendancedate,
                     empgroupid:empgroupid,
                     type:type,
                     
                     
                     },

               success:function(data) { 
                if (data.employees==0) {
                  alert("Duplicate Entry Data alreday recorded for this date");
                }
                else
                {
                  alert("Data recorded successfully");
                }
                //redirect to view page javascript redirect
                    
               }
               
             });


      }

    }
    else{
      alert("please choose the required field correctly");
    }
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

          
     }
  function changeRowColor(value,i){
    //alert(value+i);
    var id="#color"+i;
    if (value=='N') {
      $(id).css("background-color", "red");
    }
    else{
      $(id).removeAttr("style");
    }
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
  $('#totalothrid').val(totalothr);
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